<?php

namespace App\RecoverCodes;

interface TelegramEventIntefrace
{
    public function getCode() : string;
    public function getTelegramId() : string;
}
