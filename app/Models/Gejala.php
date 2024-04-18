<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    use HasFactory;
    protected $fillable = ['*'];
    public function fillTable()
    {
        $gejala = [
            [
                "kode" => "G001",
                "deskripsi" => "Sering Merasa Sedih"
            ],
            [
                "kode" => "G002",
                "deskripsi" => "Sering kelelahan melakukan aktifitas ringan"
            ],
            [
                "kode" => "G003",
                "deskripsi" => "Kurang konsentrasi dalam belajar "
            ],
            [
                "kode" => "G004",
                "deskripsi" => "Mudah merasa bosan"
            ],
            [
                "kode" => "G005",
                "deskripsi" => "Sering Melamun"
            ],
            [
                "kode" => "G006",
                "deskripsi" => "Tidak semangat melakukan sesuatu"
            ],
            [
                "kode" => "G007",
                "deskripsi" => "Merasa Risau"
            ],
            [
                "kode" => "G008",
                "deskripsi" => "Pesimis"
            ],
            [
                "kode" => "G009",
                "deskripsi" => "Sering menangis secara tiba-tiba"
            ],
            [
                "kode" => "G010",
                "deskripsi" => "Gangguan susah Tidur"
            ],
            [
                "kode" => "G011",
                "deskripsi" => "Merasa Cemas Berlebihan"
            ],
            [
                "kode" => "G012",
                "deskripsi" => "Kecewa dengan diri sendiri"
            ],
            [
                "kode" => "G013",
                "deskripsi" => "Terganggu dengan banyak hal"
            ],
            [
                "kode" => "G014",
                "deskripsi" => "Sering murung"
            ],
            [
                "kode" => "G015",
                "deskripsi" => "Kehilangan minat terhadap hoby"
            ],
            [
                "kode" => "G016",
                "deskripsi" => "Merasa kesepian"
            ],
            [
                "kode" => "G017",
                "deskripsi" => "Sering merasa bersalah"
            ],
            [
                "kode" => "G018",
                "deskripsi" => "Merasa dihakimi"
            ],
            [
                "kode" => "G019",
                "deskripsi" => "Membenci Diri Sendiri"
            ],
            [
                "kode" => "G020",
                "deskripsi" => "Mudah tersinggung"
            ],
            [
                "kode" => "G021",
                "deskripsi" => "Kehilangan Nafsu makan "
            ],
            [
                "kode" => "G022",
                "deskripsi" => "Khawatir tentang penampilan"
            ],
            [
                "kode" => "G023",
                "deskripsi" => "Mudah Marah"
            ],
            [
                "kode" => "G024",
                "deskripsi" => "Suka menyendiri"
            ],
            [
                "kode" => "G025",
                "deskripsi" => "Pikiran Untuk Bunuh Diri"
            ],
            [
                "kode" => "G026",
                "deskripsi" => "Sulit mengambil keputusan"
            ],
            [
                "kode" => "G027",
                "deskripsi" => "Sulit melakukan kegiatan dengan Baik"
            ],
            [
                "kode" => "G028",
                "deskripsi" => "Ada penambahan dan penurunan berat badan"
            ],
            [
                "kode" => "G029",
                "deskripsi" => "Kurang percaya diri"
            ],
        ];

        return $gejala;
    }
}
