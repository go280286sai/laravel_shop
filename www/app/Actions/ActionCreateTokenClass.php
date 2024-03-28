<?php

namespace App\Actions;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActionCreateTokenClass
{
    /**
     * @return string
     */
    public static function getToken(): string
    {
        try {
            $token = DB::table('personal_access_tokens')
                ->where('tokenable_id', '=', Auth::id())
                ->select('token')
                ->get();

            if (count($token) > 0) {
                $token = $token[0]->token;
            } else {
                $token = Auth::user()->createToken('API TOKEN')->plainTextToken;
            }
        } catch (Exception $e) {
            $token = Auth::user()->createToken('API TOKEN')->plainTextToken;
        }


        return $token;
    }
}
