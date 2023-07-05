<?php
//TODO passare autorizzazione al front per pulsanti header 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)//: RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class, 'regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name' => ['nullable', 'string', 'max:50'],
            'last_name' => ['nullable', 'string', 'max:50'],
            'date_of_birth' => ['nullable', 'date', 'before:' . Carbon::now()->subYears(18)->format('Y-m-d')]
        ]);

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

        return redirect(RouteServiceProvider::HOME);
    }
}
