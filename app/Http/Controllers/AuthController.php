<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function adminLogin()
    {
        $title = 'Login';
        return view('admin.auth.login', [
            'title' => $title,
        ]);
    }

    public function processAdminLogin(Request $request)
    {
        $remember = false;
        if($request->has('remember')){
            $remember = true;
        }
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();

            return to_route('admin.dashboard');
        }

        return back()->with([
            'message' => 'Email hoặc mật khẩu không đúng',
        ])->onlyInput('email');
    }

    public function processAdminLogout(Request $request)
    {
        if(Auth::check()){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return to_route('admin.login');
        }
    }

    public function processClientLogout(Request $request)
    {
        if(Auth::check()){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return to_route('client.index');
        }
    }

    public function clientLogin()
    {
        $title = 'Login';
        return view('client.auth.login', [
            'title' => $title,
        ]);
    }

    public function clientRegister() 
    {
        $title = 'Register';
        return view('client.auth.register', [
            'title' => $title,
        ]);
    }

    public function processClientLogin(Request $request)
    {
        $remember = false;
        if($request->has('remember')){
            $remember = true;
        }
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();

            return to_route('client.index');
        }

        return back()->with([
            'message' => 'Email hoặc mật khẩu không đúng',
        ])->onlyInput('email');
    }

    public function processClientRegister(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'name' => ['required', 'string'],
            'phone' => ['required', 'numeric'],
        ]);

        User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'name' => $validated['name'],
            'phone' => $validated['phone'],
        ]);

        return to_route('client.login')
            ->with('email', $validated['email'])
            ->with('password', $validated['password'])
            ->with('message', 'Đăng ký tài khoản thành công');
    }

    public function socialLogin(string $provider_name)
    {
        $provider = Provider::query()->where('name', $provider_name)->first();
        if (!$provider) abort(404);

        return Socialite::driver($provider_name)->redirect();
    }

    public function socialCallback(string $provider_name)
    {
        $provider = Provider::query()->where('name', $provider_name)->first();
        if (!$provider) abort(404);

        $data = Socialite::driver($provider_name)->user();
        
        $user = User::query()
            ->where('email', $data->getEmail())
            ->where('provider_id', $provider->id)
            ->first();
        
        if (!$user) {
            $user = User::create([
                'name' => $data->getName(),
                'email' => $data->getEmail(),
                'provider_id' => $provider->id,
            ]);
        }

        Auth::login($user, true);

        return to_route('client.index');
    }
}
