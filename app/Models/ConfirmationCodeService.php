<?php

namespace App\Models;
use App\RecoverCodes;
use Illuminate\Support\Facades\Auth;

class ConfirmationCodeService
{
    const TYPE_EMAIL = SendCodeService::TYPE_EMAIL; // email
    const TYPE_TEL = SendCodeService::TYPE_TEL; // tel
    const TYPE_TELEGRAM = SendCodeService::TYPE_TELEGRAM; // tg
    public function confirmationCode($type, $code, $userid)
    {
        switch ($type) {
            case self::TYPE_TELEGRAM:
                $codeExists = \App\Models\RecoverCodes::where('code', $code)
                    ->where('created_at', '>=', now()->subMinutes(5))
                    ->where('type', self::TYPE_TELEGRAM)
                    ->where('userid', Auth::id())
                    ->where('status', 0)
                    ->exists();

                return response()->json(['exists' => $codeExists]);

            case self::TYPE_TEL:
                $codeExists = \App\Models\RecoverCodes::where('code', $code)
                    ->where('created_at', '>=', now()->subMinutes(5))
                    ->where('type', self::TYPE_TEL)
                    ->where('userid', Auth::id())
                    ->where('status', 0)
                    ->exists();

                return response()->json(['exists' => $codeExists]);

            case self::TYPE_EMAIL:
                $codeExists = \App\Models\RecoverCodes::where('code', $code)
                    ->where('created_at', '>=', now()->subMinutes(5))
                    ->where('type', self::TYPE_EMAIL)
                    ->where('userid', Auth::id())
                    ->where('status', 0)
                    ->exists();

                return response()->json(['exists' => $codeExists]);
        }
    }
}
