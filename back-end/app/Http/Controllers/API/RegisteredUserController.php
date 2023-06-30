<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use GrahamCampbell\ResultType\Success;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)//: JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name' => ['string', 'max:50'],
            'last_name' => ['string', 'max:50'],
            'date_of_birth' => ['date', 'before:today']
        ], [
            'email.required' => 'Inserire obbligatoriamente l\'e-mail',
            'email.string' => 'L\'e-mail dev\'essere una stringa di testo',
            'email.email' => 'L\'e-mail dev\'essere in un formato valido',
            'email.max' => 'L\'e-mail non può contenere più di 255 caratteri',
            'email.unique' => 'Questa e-mail è già registrata nel nostro sistema',

            'password.required' => 'Inserire obbligatoriamente la password',
            'password.confirmed' => 'Digitare nuovamente la password per conferma',
            'password.min' => 'La password dev\'essere lunga almeno 8 caratteri',

            'first_name.string' => 'Il nome dev\'essere una stringa di testo',
            'first_name.max' => 'Il nome non può contenere più di 50 caratteri',

            'last_name.string' => 'Il cognome dev\'essere una stringa di testo',
            'last_name.max' => 'Il cognome non può contenere più di 50 caratteri',

            'date_of_birth.date' => 'La data di nascita dev\'essere una data valida',
            'date_of_birth.before' => 'La data di nascita non può essere successiva a quella odierna'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $data = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if($request->first_name) {
            $data['first_name'] = $request->first_name;
        }

        if($request->last_name) {
            $data['last_name'] = $request->last_name;
        }

        if($request->date_of_birth) {
            $data['date_of_birth'] = $request->date_of_birth;
        }

        $user = User::create($data);

        event(new Registered($user));

        Auth::login($user);

        return response()->json([
            "success" => true,
            "user_id" => Auth::id(),
        ]);
    }
}
