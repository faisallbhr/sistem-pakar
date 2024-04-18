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
                'deskripsi' => 'Tidak Tahu',
                'nilai' => 0.0,
            ],
            [
                'deskripsi' => 'Tidak Yakin',
                'nilai' => 0.2,
            ],
            [
                'deskripsi' => 'Mungkin',
                'nilai' => 0.4,
            ],
            [
                'deskripsi' => 'Kemungkinan Besar',
                'nilai' => 0.6,
            ],
            [
                'deskripsi' => 'Hampir Pasti',
                'nilai' => 0.8,
            ],
            [
                'deskripsi' => 'Pasti',
                'nilai' => 1,
            ],
        ];
        return $kondisi;
    }
}
