<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\View\View;
use Symfony\Component\Mailer\Transport\Smtp\Auth\LoginAuthenticator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'min:8'],
        ], [
            'email.required' => 'Inserire obbligatoriamente l\'e-mail',
            'email.string' => 'L\'e-mail dev\'essere una stringa di testo',
            'email.email' => 'L\'e-mail dev\'essere in un formato valido',
            'email.max' => 'L\'e-mail non può contenere più di 255 caratteri',

            'password.required' => 'Inserire obbligatoriamente la password',
            'password.min' => 'La password dev\'essere lunga almeno 8 caratteri',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $request->authenticate();

        $user = User::where('email', $request->email)->first();

        if($user) {
            return response()->json([
                "success" => true,
                "user_id" => Auth::id(),
            ]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)//: RedirectResponse
    {
        Auth::guard('web')->logout();

        return response()->json([
            "success" => true,
            "user_id" => $request->userID
        ]);
    }
}
