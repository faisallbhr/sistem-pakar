<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depresi extends Model
{
    use HasFactory;
    protected $fillable = ['*'];
    public function fillTable()
    {
        $depresi = [
            [
                "kode" => "P000",
                "deskripsi" => "Tidak Depresi"
            ],
            [
                "kode" => "P001",
                "deskripsi" => "Gangguan Mood"
            ],
            [
                "kode" => "P002",
                "deskripsi" => "Depresi Ringan"
            ],
            [
                "kode" => "P003",
                "deskripsi" => "Depresi Sedang"
            ],
            [
                "kode" => "P004",
                "deskripsi" => "Depresi Berat"
            ],
            
        ];
        return $depresi;
    }
}
