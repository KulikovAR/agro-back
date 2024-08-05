<?php

namespace App\Services;

use App\Http\Requests\Counteragent\CreateRequest;
use App\Http\Requests\SignMe\SignMeRequest;
use App\Http\Resources\File\FileResource;
use App\Models\File;
use App\Services\Dadata\Dadata;
use App\Services\SignMe\SignMe;
use App\Traits\FileTrait;
use Carbon\Carbon;

class SignMeService
{
    use FileTrait;
    private SignMe $signMe;
    function __construct(

    )
    {
        $this->signMe = new SignMe();
    }

    public function signature(SignMeRequest $request): string|FileResource
    {
        $user = $request->user();

        $data = array
            (
                'cinn'=>$user->inn,
                'inn'=>$user->inn,
                'company'=>1,
                'gender' => $user->gender,
                'cfaddr' => $user->juridical_address,
                'caddr' => $user->office_address,
                'esia' => 1,
                'regtype' => 2,
                'cname' => $user->short_name,
                'cfullname' => $user->full_name,
                'ceo_name' => $user->director_name,
                'ceo_surname' => $user->director_surname,
                'ps' => $user->series,
                'pn' => $user->number,
                'pdate' => Carbon::parse($user->issue_date_at)->toDateString(),
                'bdate' =>  Carbon::parse($user->bdate)->toDateString(),
                'issued' => $user->department,
                'pcode' => $user->department_code,
                'phone' => $user->phone_number,
                'lastname' => $user->patronymic,
                'cogrn' => $user->ogrn ,
                'ca' => "NKEP12",
                'ct' => "12",
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'region' => $user->region,
                'snils' => $user->snils,
            );

        $file = File::where('path', $request->path)->first();
        $filet = $this->base64Encode($request->path);

        $signatureQueryData = array('filet' => $filet, 'fname' => $file->type, 'md5' => $file->md5_hash);

        $registerResult = $this->signMe->register($data);

        if(gettype($registerResult) == 'string'){
            return response('Произошла ошибка, обратитесь к администратору')->getContent();
        }

        $user->update(['sign_me_id' => $registerResult]);

        $precheck = $this->signMe->prechek($data['inn']);

        if(!$precheck){
            return response('Ожидает подтверждения регистрации в Sign.me ')->getContent();
        }

        $user->update(['is_signer'=>true]);

        $signatureResult = $this->signMe->signature($signatureQueryData);

        if($signatureResult == "error"){

            return response('Произошла ошибка при подписание документа')->getContent();
        }


        $signatureCheckResult = $this->signMe->signatureCheck($signatureQueryData['md5']);

        if(!$signatureCheckResult){
            return $signatureResult;
        }
        $file->update(['is_signed' => true]);
        return new FileResource($file);
    }
}

