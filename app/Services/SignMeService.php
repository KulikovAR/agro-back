<?php

namespace App\Services;

use App\Http\Requests\Counteragent\CreateRequest;
use App\Services\Dadata\Dadata;
use App\Services\SignMe\SignMe;

class SignMeService
{

    private SignMe $signMe;
    function __construct(

    )
    {
        $this->signMe = new SignMe();
    }

    public function signature(CreateRequest $request)
    {
        $cfaddr = $request->juridical_address = 'cfaddr';
        $caddr = $request->office_address = 'office_address';
        $cname = $request->short_name = 'cname';
        $cFullName = $request->full_name = 'cfullname';
        $ceoName = $request->director_name = 'ceo_name';
        $ceoSurname = $request->director_surname = 'ceo_surname';
        $ps = $request->series = 'ps';
        $pn = $request->number = 'pn';
        $pdate = $request->issued_date_at = 'pdate';
        $issued = $request->department = 'issued';
        $pcode = $request->department_code = 'department_code';
        $cogrn = $request->ogrn = 'cogrn';
        $phone = $request->phone_number = 'phone';
        $lastname = $request->patronymic = 'lastname';
        $data = $request->except(['ogrn', 'juridical_address', 'office_address', 'full_name', 'short_name', 'director_name','director_surname', 'series','number', 'issued_date_at', 'department', 'department_code','phone_number', 'patronymic']);
            + array('cinn'=>$request->inn, 'company'=>1, 'gender' => $request->gender, 'cfaddr' => $cfaddr, 'caddr' => $caddr, 'esia' => 1, 'regtype' => 2, 'cname' => $cname, 'cfullname' => $cFullName, 'ceo_name' => $ceoName, 'ceo_surname' => $ceoSurname, 'ps' => $ps, 'pn' => $pn, 'pdate' => $pdate, 'issued' => $issued, 'pcode' => $pcode, 'phone' => $phone, 'last_name' => $lastname, 'ca' => "NKEP12", 'ct' => "12");

        $registerResult = $this->signMe->register($data);
    }
}
