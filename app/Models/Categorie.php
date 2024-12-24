<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',        // Kolom name (VARCHAR)
        'description', // Kolom description (TEXT)
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'product_id', 'id'); 
    }

    public static function getAll()
    {
        return self::all(); // Mengambil semua data dari tabel Categorie
    }

    public static function createCategorie(array $data)
    {
        return self::create($data); // Mengambil semua data dari tabel Categorie
    }

    public static function deleteCategorieById($id)
    {
        // / Mencari kategori berdasarkan ID dan menghapusnya
        $categorie = self::find($id);

        if ($categorie) {
            // Jika kategori ditemukan, hapus
            $categorie->delete();
            return true;  // Mengembalikan true jika berhasil dihapus
        }

        // Jika kategori tidak ditemukan
        return false;
    }

    public static function findCategorieById($id)
    {
        return self::find($id); 
    }
    

    public static function updateCategorie($id, array $data)
    {
        $categorie = self::findCategorieById($id);

        if ($categorie) {
    
            // Update data kategori menggunakan array $data
            $categorie->update($data);
            
            return $categorie;
        }
    
        return null;
    }
    
}
