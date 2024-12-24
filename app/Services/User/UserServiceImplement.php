<?php

namespace App\Services\User;

use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserServiceImplement extends Service implements UserService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;


    public function __construct(UserRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }


    /**
     * create user and register
     * @param array $data
     * @return mixed|null
     */
    public function createUser(array $data)
    {
        try {
            // Lakukan validasi
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'password' => 'required|string',
                'role' => 'required|string|in:staff gudang,admin,manajer gudang',
            ]);

            // Jika validasi gagal, lemparkan pengecualian
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            // Hash password sebelum disimpan
            $data['password'] = Hash::make($data['password']);

            // Simpan data user menggunakan repository dan kembalikan data user yang baru disimpan
            $user = $this->mainRepository->createUser($data);

            // Kembalikan data user yang baru disimpan
            return $user;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return null; // Pastikan ini mengembalikan null jika ada kesalahan
        }
    }

    /**
     * validasi dan login service
     * @param array $credentials
     * @return string
     */
    public function validateAndLogin(array $credentials)
    {
        // Validasi input
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kembalikan pesan error jika validasi gagal
        if ($validator->fails()) {
            return 'validation_failed';
        }

        // Proses autentikasi
        if ($this->mainRepository->attemptLogin($credentials)) {
            $user = $this->mainRepository->getAuthenticatedUser();
            session(['role' => $user->role]);

            // Tentukan rute berdasarkan role
            if ($user->role === 'admin') {
                return route('dashboard');
            } elseif ($user->role === 'staff gudang') {
                return route('dashboard_staff');
            } elseif ($user->role === 'manajer gudang') {
                return route('dashboard_manager');
            }

            Auth::logout(); // Role tidak dikenali
            return 'unknown_role';
        }

        return 'failed';
    }

    public function createProduct(array $data)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($data, [
            'category_id' => 'required|exists:categories,id', // Pastikan category_id valid
            'supplier_id' => 'required|exists:suppliers,id', // Pastikan category_id valid
            'name' => 'required|string',
            'sku' => 'required|string',
            'description' => 'required|string',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'minimum_stock' => 'required|numeric',
        ]);

        // Jika validasi gagal, lemparkan exception
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validatedData = $validator->validated();

        // Jika ada file gambar, simpan ke storage dan dapatkan path-nya
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $filePath = $data['image']->store('images', 'public');
            $validatedData['image'] = Storage::url($filePath); // URL publik untuk disimpan ke database
        }

        // Simpan data produk melalui repository
        return $this->mainRepository->createProduct($validatedData);
    }

    public function getAllProduck()
    {
        return $this->mainRepository->getAllProduck();
    }

    public function getAllUser()
    {
        return $this->mainRepository->getAllUser();
    }

    public function countProduk()
    {
        return $this->mainRepository->countProduk();
    }

    public function findUserById($id)
    {
        return $this->mainRepository->findUserById($id);
    }

    public function updateUser($id, array $data)
    {
        try {
            // Lakukan validasi
            $validator = Validator::make($data, [
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email',
                'password' => 'sometimes|string',
                'role' => 'sometimes|string|in:staff gudang,admin,manajer gudang',
            ]);
    
            // Jika validasi gagal, lemparkan pengecualian
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
    
            // Jika password disertakan dalam data, hash terlebih dahulu
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }
    
            // Update data user menggunakan repository dan kembalikan data user yang diperbarui
            $user = $this->mainRepository->updateUser($id, $data);
    
            return $user;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return null; // Pastikan ini mengembalikan null jika ada kesalahan
        }
    }

    public function deleteUserById($id)
    {
        return $this->mainRepository->deleteUserById($id);
    }
    
}
