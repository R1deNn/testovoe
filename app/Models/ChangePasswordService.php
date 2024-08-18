<?php

namespace App\Models;

use App\Models\User;
use App\Models\RecoverCodes;
use Illuminate\Support\Facades\Hash;

class ChangePasswordService
{
    public function changePasswordUser($userid, $password)
    {
        $user = User::find($userid);
        $user->password = Hash::make($password);
        $user->save();

        $code = RecoverCodes::where('userid', $userid)
            ->where('status', 0)
            ->first();
        $code->status = 1;
        $code->save();

        return true;
    }
}
