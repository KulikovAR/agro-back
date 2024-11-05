<?php

namespace App\Services;

use App\Enums\OrganizationTypeEnum;
use App\Http\Requests\SignMe\SignMeRequest;
use App\Models\File;
use App\Repositories\IcRepository;
use App\Repositories\ToIcRepositoryInterface;
use App\Services\SignMe\SignMe;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Storage;

class SignMeService
{
    use FileTrait;

    private SignMe $signMe;

    public function __construct(
        private ToIcRepositoryInterface $icRespoitory,
    ) {
        $this->signMe       = new SignMe;
        $this->icRespoitory = new IcRepository;
    }

    public function signature(SignMeRequest $request): string
    {
        $user          = $request->user();
        $data          = $user->dataForSignMe($user);
        $file          = File::where('path', $request->path)->first();
        $filet         = $this->base64Encode($request->path);
        $fileContents  = Storage::disk('public')->get($request->path);
        $fileExtension = $this->getExtension($request->path);
        $llc           = false;

        if ($user->type == OrganizationTypeEnum::IP->value) {
            $signatureQueryData = ['filet' => $filet, 'fname' => $file->type . '.' . $fileExtension, 'md5' => md5($fileContents), 'company_inn' => $user->inn, 'user_ph' => $user->phone_number];
            $precheckRegister   = $this->signMe->prechekRegister($data['inn']);
        } else {
            $signatureQueryData = ['filet' => $filet, 'fname' => $file->type . '.' . $fileExtension, 'md5' => md5($fileContents), 'company_inn' => $user->cinn, 'user_ph' => $user->phone_number];
            $precheckRegister   = $this->signMe->prechekRegister($data['cinn'], true);
        }

        if (!$precheckRegister) {
            $registerResult = $this->signMe->register($data);

            if (json_decode($registerResult) == null) {
                return response('Обратитесь к администратору. Текст ошибки: ' . $registerResult)->getContent();
            }

            $registerResult = json_decode($registerResult, true);

            $user->update(['sign_me_id' => $registerResult['id'], 'sign_me_cid' => $registerResult['cid']]);
        }

        $precheck = $this->signMe->prechek($data['inn']);

        if (!$precheck) {
            return response('Ожидает подтверждения регистрации в Sign.me ')->getContent();
        }

        $user->update(['is_signer' => true]);

        $precheckActivation = $this->signMe->prechekActivation($data['cogrn']);
        // dd($precheckActivation);
        if (!$precheckActivation && !$user->company_activate) {
            $comactivate = $this->signMe->comactivate($user->sign_me_cid);

            return $comactivate;
        }

        $user->update(['company_activate' => true]);

        $signatureResult = $this->signMe->signature($signatureQueryData);

        if ($signatureResult == 'error') {

            return response('Произошла ошибка при подписание документа')->getContent();
        }

        return $signatureResult;
    }
}
