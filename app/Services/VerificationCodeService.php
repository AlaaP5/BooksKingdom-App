<?php

namespace App\Services;

use App\Mail\SendCodeMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class VerificationCodeService
{
    public function sendCode($request)
    {
        try {
            $code = random_int(1000, 9999);
            $user = User::where('email', $request->email)->first();
            $user->code = $code;
            $user->StatusCode = false;
            $user->save();

            Mail::to($user->email)->send(new SendCodeMail($user));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
