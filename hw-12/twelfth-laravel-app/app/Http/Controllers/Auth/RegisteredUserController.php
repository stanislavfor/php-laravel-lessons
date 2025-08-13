<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
//use Illuminate\View\View;

use App\Mail\Welcome;
use Illuminate\Validation\Rule;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\{Auth, Hash, Mail};

// ВАЖНО: алиасим фасад логирования, чтобы избежать конфликта имён
use Illuminate\Support\Facades\Log as Logger;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): ViewContract|Factory|Application
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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255',
                Rule::unique('users', 'email'),
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);


//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//        ]);

        event(new Registered($user));
        Auth::login($user);

        // email
//        Mail::to($user->email)->send(new Welcome($user));
        try {
            Mail::to($user->email)->queue(new Welcome($user));
        } catch (TransportExceptionInterface $e) {
            Logger::warning('Welcome mail not sent: '.$e->getMessage());
        }

        // telegram
        try {
            Telegram::sendMessage([
                'chat_id'    => env('TELEGRAM_CHANNEL_ID', ''),
                'parse_mode' => 'HTML',
                'text'       => 'Новый пользователь зарегистрирован: '.$user->name,
            ]);
        } catch (\Throwable $e) {
            Logger::warning('Telegram send failed: '.$e->getMessage());
        }

//        return redirect(route('dashboard', absolute: false));
        return redirect()->route('dashboard');
    }
}
