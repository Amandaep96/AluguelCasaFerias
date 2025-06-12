<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Validation\Rules;
use Illuminate\View\View as ViewView;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): ViewView
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:50', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nif' => ['required', 'string', 'max:10', 'unique:'.User::class],
            'morada' => ['required', 'string', 'max:100'],
            'telefone' => ['required', 'string', 'max:15'],


            'g-recaptcha-response' => ['required', function ($attribute, $value, $fail) use ($request) {
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => config('services.google.recaptcha_secret_key'),
                    'response' => $value,
                    'remoteip' => $request->ip(),
                ]);

                if (!($response->json()['success'] ?? false)) {
                    $fail('A verificação reCAPTCHA falhou. Por favor, tente novamente.');
                }
            }],
        ],

        [
            'g-recaptcha-response.required' => 'Por favor, complete a verificação reCAPTCHA.',
            'g-recaptcha-response.g-recaptcha-response' => 'A verificação reCAPTCHA falhou.',
        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nif' => $request->nif,
            'morada' => $request->morada,
            'telefone' => $request->telefone,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
