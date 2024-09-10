<?php

namespace App\Enums;

enum SignMeApiEnum:string
{
    case PRECHEK = "/register/precheck";
    case REGISTER = "/register/api";
    case SIGNATURE = "/signapi/sjson";
    case SIGNATURE_CHECK = "/signaturecheck/json";
    case COMACTIVAE = "/register/comactivate";
}
