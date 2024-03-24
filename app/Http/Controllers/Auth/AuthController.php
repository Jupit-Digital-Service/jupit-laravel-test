<?php

namespace App\Http\Controllers\Auth;

use App\Actions\AuthenticationActions;
use App\Events\NewSignupEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tests\Feature\Auth\NewSignupEventTest;

class AuthController extends Controller
{
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $v = Validator::make( $request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if($v->fails()){
            return $this->validationErrorResponse($v->errors());
        }

        try {
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);
            //dispatch event
            NewSignupEvent::dispatch($user);
            return $this->successResponse([], 'Registration successful', 201);
        }catch (\Throwable $th){
            return $this->errorResponse([], $th->getMessage());
        }
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $v = Validator::make( $request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if($v->fails()){
            return $this->validationErrorResponse($v->errors());
        }

        try {
            //try authenticating the user
            $token = AuthenticationActions::login($request);
            return $this->successResponse($token, 'Login successful');
        }catch (\Throwable $th){
            //if the error code is 400, credentials are invalid
            if ($th->getCode() == Response::HTTP_BAD_REQUEST)
                return $this->errorResponse([], $th->getMessage());
            //else this error details should be seen only by engineer
            report($th);
            return $this->errorResponse([], 'Sorry an error occurred, our engineers has been notified');
        }
    }

    public function user()
    {
        return Auth::user();
    }
}
