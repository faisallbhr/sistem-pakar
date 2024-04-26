<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kondisi extends Model
{
    use HasFactory;
    protected $fillable = ['*'];
    public function fillTable()
    {
        $kondisi = [
            [
                'deskripsi' => 'Tidak Pernah',
                'nilai' => 0.0,
            ],
            [
                'deskripsi' => 'Jarang',
                'nilai' => 0.3,
            ],
            [
                'deskripsi' => 'Sering',
                'nilai' => 0.6,
            ],
            [
                'deskripsi' => 'Pernah',
                'nilai' => 1,
            ],
        ];
        return $kondisi;
    }
}
