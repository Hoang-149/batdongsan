<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle callback from Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Kiểm tra xem user đã tồn tại chưa
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Nếu chưa có thì tạo mới
                $user = User::create([
                    'username'   => $googleUser->getName(),
                    'email'      => $googleUser->getEmail(),
                    'full_name'  => $googleUser->getName(),
                    'avatar'     => $googleUser->getAvatar(),
                    'password_hash' => bcrypt(uniqid()), // Tạo password random
                    'is_verified'   => 1,
                ]);
            }

            // Đăng nhập user
            Auth::login($user);

            return redirect()->route('profile')->with('success', 'Đăng nhập thành công.');
        } catch (\Exception $e) {
            // Ghi log lỗi nếu cần
            Log::error('Google login error: ' . $e->getMessage());
            return redirect('/home')->withErrors(['msg' => 'Đăng nhập Google thất bại!']);
        }
    }
}
