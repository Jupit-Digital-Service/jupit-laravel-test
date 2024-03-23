<?php


namespace App\Actions;


use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationActions
{
    /**
     * @throws \Exception
     */
    public static function login($request): string
    {

        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            throw new \Exception('Invalid credentials', Response::HTTP_BAD_REQUEST);
        }


        return auth()->user()->createToken('basic-access-token')->plainTextToken;
    }


}
