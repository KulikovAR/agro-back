<?php

namespace App\Services;

use App\Http\Requests\SignMe\SignMeRequest;
use App\Http\Resources\File\FileResource;
use App\Models\File;
use App\Repositories\IcRepository;
use App\Repositories\ToIcRepositoryInterface;
use App\Services\SignMe\SignMe;
use App\Traits\FileTrait;

class SignMeService
{
    use FileTrait;

    private SignMe $signMe;

    public function __construct(
        private ToIcRepositoryInterface $icRespoitory,
    ) {
        $this->signMe = new SignMe();
        $this->icRespoitory = new IcRepository();
    }

    public function signature(SignMeRequest $request): string
    {
        $user = $request->user();

        $data = $user->dataForSignMe($user);

        $file = File::where('path', $request->path)->first();
        $filet = $this->base64Encode($request->path);

        $signatureQueryData = ['filet' => $filet, 'fname' => $file->type, 'md5' => $file->md5_hash];

        $registerResult = $this->signMe->register($data);

        if (! $registerResult) {
            return response('Произошла ошибка, обратитесь к администратору. Текст ошибки: '.$registerResult)->getContent();
        }

        $user->update(['sign_me_id' => $registerResult['id'], 'sign_me_cid' => $registerResult['cid']]);

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
        $this->icRespoitory->loadFileToIc($this->base64Encode($file->path), $file->name, $file->id_1c);

        return $signatureResult;

        //        return new FileResource($file);
    }
}
