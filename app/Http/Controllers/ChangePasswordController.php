<?php

namespace App\Http\Controllers;

use App\Models\RecoverCodes;
use App\Models\SendCodeService;
use App\Models\ConfirmationCodeService;
use App\Models\ChangePasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    const TYPE_EMAIL = SendCodeService::TYPE_EMAIL; // email
    const TYPE_TEL = SendCodeService::TYPE_TEL; // tel
    const TYPE_TELEGRAM = SendCodeService::TYPE_TELEGRAM; // tg
    private $sendCodeService;
    private $confirmationCodeService;
    private $changePasswordService;

    public function __construct(SendCodeService $sendCodeService,
    ConfirmationCodeService $confirmationCodeService,
    ChangePasswordService $changePasswordService)
    {
        $this->sendCodeService = $sendCodeService;
        $this->confirmationCodeService = $confirmationCodeService;
        $this->changePasswordService = $changePasswordService;
    }
    public function telegram(Request $request)
    {
        $code = $this->sendCodeService->createCode(self::TYPE_TELEGRAM, Auth::id());
        $code = $this->sendCodeService->sendCode(self::TYPE_TELEGRAM, $code, Auth::id());
        return $code;
    }

    public function email(Request $request)
    {
        $code = $this->sendCodeService->createCode(self::TYPE_EMAIL, Auth::id());
        $code = $this->sendCodeService->sendCode(self::TYPE_EMAIL, $code, Auth::id());
        return $code;
    }

    public function tel(Request $request)
    {
        $code = $this->sendCodeService->createCode(self::TYPE_TEL, Auth::id());
        $code = $this->sendCodeService->sendCode(self::TYPE_TEL, $code, Auth::id());
        return $code;
    }

    public function telegramSubmit(Request $request)
    {
        $result = $this->confirmationCodeService->confirmationCode(self::TYPE_TELEGRAM, $request->input('code'), Auth::id());
        return $result;
    }
    public function emailSubmit(Request $request)
    {
        $result = $this->confirmationCodeService->confirmationCode(self::TYPE_EMAIL, $request->input('code'), Auth::id());
        return $result;
    }
    public function telSubmit(Request $request)
    {
        $result = $this->confirmationCodeService->confirmationCode(self::TYPE_TEL, $request->input('code'), Auth::id());
        return $result;
    }

    public function changePassword(Request $request)
    {
        $this->changePasswordService->changePasswordUser(Auth::id(), $request->input('password'));

        return redirect()->back()->with('success', 'Пароль изменен');
    }
}
