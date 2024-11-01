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
        $this->signMe = new SignMe;
        $this->icRespoitory = new IcRepository;
    }

    public function signature(SignMeRequest $request): string
    {
        $user = $request->user();
        // dd($user);
        $data = $user->dataForSignMe($user);
        // dd(json_encode($data));
        $file = File::where('path', $request->path)->first();
        $filet = $this->base64Encode($request->path);
        $fileContents = Storage::disk('public')->get($request->path);
        $fileExtension = $this->getExtension($request->path);

        if ($user->type == OrganizationTypeEnum::IP->value) {
            $signatureQueryData = ['filet' => $filet, 'fname' => $file->type.'.'.$fileExtension, 'md5' => md5($fileContents), 'company_inn' => $user->inn, 'user_ph' => $user->phone_number];
        } else {
            $signatureQueryData = ['filet' => $filet, 'fname' => $file->type.'.'.$fileExtension, 'md5' => md5($fileContents), 'company_inn' => $user->cinn, 'user_ph' => $user->phone_number];
        }

        // dd($signatureQueryData);
        $precheckRegister = $this->signMe->prechekRegister($data['inn']);

        // dd($data['cinn']);
        if (! $precheckRegister) {
            $registerResult = $this->signMe->register($data);

            if (! $registerResult) {
                return response('Произошла ошибка, обратитесь к администратору. Текст ошибки: '.$registerResult)->getContent();
            }

            $user->update(['sign_me_id' => $registerResult['id'], 'sign_me_cid' => $registerResult['cid']]);
        }

        $precheck = $this->signMe->prechek($data['inn']);

        if (! $precheck) {
            return response('Ожидает подтверждения регистрации в Sign.me ')->getContent();
        }

        $user->update(['is_signer' => true]);

        $precheckActivation = $this->signMe->prechekActivation($data['cogrn']);

        if (! $precheckActivation) {
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
