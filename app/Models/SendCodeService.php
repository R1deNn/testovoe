<?php

namespace App\Models;
class SendCodeService
{
    const TYPE_EMAIL = '1'; // email
    const TYPE_TEL = '2'; // tel
    const TYPE_TELEGRAM = '3'; // tg

    public function createCode($type, $userid)
    {
        $randCode = rand(1111, 9999);

        $code = RecoverCodes::create([
            'userid' => $userid,
            'code' => $randCode,
            'type' => $type
        ]);

        return $randCode;
    }

    public function sendCode($type, $code, $userid)
    {
        switch ($type) {
            case self::TYPE_TELEGRAM:
                if(app('config')->get('app.env') == 'local'){
                    $response = [
                        'code' => $code . " - TELEGRAM",
                    ];
                    return response()->json($response);
                }
                $response = [
                    'code' => 'success',
                ];
                return response()->json($response);

            case self::TYPE_EMAIL:
                if(app('config')->get('app.env') == 'local'){
                    $response = [
                        'code' => $code . " - EMAIL",
                    ];
                    return response()->json($response);
                }
                $response = [
                    'code' => 'success',
                ];
                return response()->json($response);

            case self::TYPE_TEL:
                if(app('config')->get('app.env') == 'local'){
                    $response = [
                        'code' => $code . " - TEL",
                    ];
                    return response()->json($response);
                }
                $response = [
                    'code' => 'success',
                ];
                return response()->json($response);
        }
    }
}
