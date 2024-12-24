<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    private $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(Request $request)
    {
        // Gunakan metode createUser untuk membuat user baru
        $user = $this->userService->createUser($request->all());

        if ($user) {
            return redirect()->route('getAllUser')->with('success', 'Data Berhasil Di Tambahkan');
        } else {
            return response()->json([
                'success' => false,
                'code' => 400,
                'message' => 'Data could not be saved.',
            ], 400);
        }
    }

    public function getAllUser()
    {
        $pengguna = $this->userService->getAllUser(); // Ambil semua supplier
        return view('project.content.layouts.admin.data_pengguna', compact('pengguna'), ['title' => 'Data Pengguna']);
    }

    public function findUserById($id)
    {
        // Mengambil data pengguna berdasarkan ID
        $findUserById = $this->userService->findUserById($id);
    
        // Mengecek apakah data pengguna ditemukan
        if (!$findUserById) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        // Menampilkan tampilan dengan data pengguna
        return view('project.content.crud.lihat_pengguna', compact('findUserById'))->with('title', 'Lihat Pengguna');
    }

    public function updateUser(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
            'role'
        ]);

        try {
            $supplier = $this->userService->updateUser($id, $data);
            return redirect()->route('getAllUser')->with('success', 'Pengguna berhasil diubah');
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Categorie not found'], 404);
        }
    }

    public function findUpdateUser($id)
    {
        $findUpdateUser = $this->userService->findUserById($id);

        if (!$findUpdateUser) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // return response()->json($productService);
        return view('project.content.crud.edit_pengguna', compact('findUpdateUser'), ['title' => 'Edit Categori']);
    }

    public function deleteUserById($id)
    {
        $deleted = $this->userService->deleteUserById($id);

        if ($deleted) {
            return redirect()->route('getAllUser')->with('success', 'User berhasil dihapus.');
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
