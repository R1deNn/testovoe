<?php

namespace App\Http\Controllers;

use App\Models\RecoverCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    const TYPE_EMAIL = '1'; // email
    const TYPE_TEL = '2'; // tel
    const TYPE_TELEGRAM = '3'; // tg

    public function createCode($type)
    {
        $randCode = rand(1111, 9999);

        $code = RecoverCodes::create([
            'userid' => Auth::id(),
            'code' => $randCode,
            'type' => $type
        ]);

        return $randCode;
    }
    public function telegram(Request $request)
    {
        $randCode = $this->createCode(self::TYPE_TELEGRAM);

        if(app('config')->get('app.env') == 'local'){
            $response = [
                'code' => $randCode,
            ];
            return response()->json($response);
        }
        $response = [
            'code' => 'success',
        ];
        return response()->json($response);
    }

    public function email(Request $request)
    {
        $randCode = $this->createCode(self::TYPE_EMAIL);

        if(app('config')->get('app.env') == 'local'){
            $response = [
                'code' => $randCode,
            ];
            return response()->json($response);
        }
        $response = [
            'code' => 'success',
        ];
        return response()->json($response);
    }

    public function tel(Request $request)
    {
        $randCode = $this->createCode(self::TYPE_TEL);

        if(app('config')->get('app.env') == 'local'){
            $response = [
                'code' => $randCode,
            ];
            return response()->json($response);
        }
        $response = [
            'code' => 'success',
        ];
        return response()->json($response);
    }

    public function telegramSubmit(Request $request)
    {
        $code = $request->input('code');

        $codeExists = RecoverCodes::where('code', $code)
            ->where('created_at', '>=', now()->subMinutes(5))
            ->where('type', self::TYPE_TELEGRAM)
            ->where('userid', Auth::id())
            ->where('status', 0)
            ->exists();

        return response()->json(['exists' => $codeExists]);
    }
    public function emailSubmit(Request $request)
    {
        $code = $request->input('code');

        $codeExists = RecoverCodes::where('code', $code)
            ->where('created_at', '>=', now()->subMinutes(5))
            ->where('type', self::TYPE_EMAIL)
            ->where('userid', Auth::id())
            ->where('status', 0)
            ->exists();

        return response()->json(['exists' => $codeExists]);
    }
    public function telSubmit(Request $request)
    {
        $code = $request->input('code');

        $codeExists = RecoverCodes::where('code', $code)
            ->where('created_at', '>=', now()->subMinutes(5))
            ->where('type', self::TYPE_TEL)
            ->where('userid', Auth::id())
            ->where('status', 0)
            ->exists();

        return response()->json(['exists' => $codeExists]);
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $code = RecoverCodes::where('userid', Auth::id())
            ->where('status', 0)
            ->first();
        $code->status = 1;
        $code->save();

        return redirect()->back()->with('success', 'Пароль изменен');
    }
}
