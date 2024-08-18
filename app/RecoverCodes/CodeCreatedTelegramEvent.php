<?php

namespace App\RecoverCodes;

class CodeCreatedTelegramEvent implements TelegramEventIntefrace
{
    private $code;
    private $telegramId;

    public function __construct($code, $telegramId)
    {
        $this->code = $code;
        $this->telegramId = $telegramId;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getTelegramId(): string
    {
        return $this->telegramId;
    }
}
