<?php

namespace Odorik\Sms\Facades;

use Illuminate\Support\Facades\Facade;

class OdorikSms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Odorik\Sms\OdorikSmsService::class;
    }
}