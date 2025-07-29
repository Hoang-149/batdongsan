<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:Users,username',
            'email' => 'required|string|email|max:255|unique:Users,email',
            'phone_number' => 'required|string|max:15|unique:Users,phone_number|regex:/^[0-9]{10,15}$/',
            'password' => 'required|string|min:8|confirmed',
            'full_name' => 'nullable|string|max:255',
        ], [
            'username.unique' => 'Tên người dùng đã được sử dụng.',
            'email.unique' => 'Email đã được sử dụng.',
            'phone_number.unique' => 'Số điện thoại đã được sử dụng.',
            'phone_number.regex' => 'Số điện thoại không hợp lệ.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Vui lòng kiểm tra thông tin đăng ký.');
        }

        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password_hash' => Hash::make($request->password),
                'full_name' => $request->full_name,
                'is_verified' => 0,
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Optionally log the user in after registration
            // Auth::login($user);

            return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đăng ký thất bại. Vui lòng thử lại.')->withInput();
        }
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Vui lòng kiểm tra thông tin đăng nhập.');
        }

        $identifier = trim($request->input('identifier') ?? '');
        $identifier = preg_replace('/\s+/', '', $identifier);

        $password = $request->input('password');
        $remember = $request->has('remember');

        // Try to find user by email or phone_number
        $user = User::where('email', $identifier)
            ->orWhere('phone_number', $identifier)
            ->first();

        if ($user && Hash::check($password, $user->password_hash)) {
            Auth::login($user, $remember);

            Log::info('success!');

            return redirect()->route('profile')
                ->with('success', 'Login successfully.');
        }

        return redirect()->back()
            ->withInput($request->only('identifier', 'remember'))
            ->with('error', 'Thông tin đăng nhập không chính xác.');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Đăng xuất thành công!');
    }
}
