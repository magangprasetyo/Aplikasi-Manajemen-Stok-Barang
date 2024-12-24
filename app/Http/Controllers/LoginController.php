<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        // Gunakan metode createUser untuk membuat user baru
        $user = $this->userService->createUser($request->all());

        // Jika user tidak null, berarti data berhasil disimpan
        if ($user) {
            return redirect()->route('sign-in2')->with('success', 'Data Berhasil Di Tambahkan');
            // return response()->json([
            //     'success' => true,
            //     'code' => 201,
            //     'data' => $user,
            //     'redirect' => route('sign-in2'),
            // ], 201);
        } else {
            // Jika data null, berarti ada kesalahan dalam penyimpanan atau validasi
            return response()->json([
                'success' => false,
                'code' => 400,
                'message' => 'Data could not be saved.',
            ], 400);
        }
    }


    public function login(Request $request)
    {
        // Ambil email dan password dari request sebagai array $credentials
        $credentials = $request->only('email', 'password');

        $loginResult = $this->userService->validateAndLogin($credentials);

        if ($loginResult === 'validation_failed') {
            return redirect()->back()->withErrors('Validasi input gagal!');
        } elseif ($loginResult === 'failed') {
            return redirect()->back()->with('error', 'Email atau password salah!');
        } elseif ($loginResult === 'unknown_role') {
            return redirect()->back()->with('error', 'Role tidak dikenali!');
        }

        return redirect()->to($loginResult)->with('success', 'Login berhasil!');
    }


    public function logout(Request $request)
    {
        // Logika logout
        Auth::logout();

        return redirect()->route('sign-in2')->with('berhasil_logout', 'Anda telah berhasil logout.');
    }
}
