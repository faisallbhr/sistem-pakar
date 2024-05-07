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
            ['kode' => 'G001', 'deskripsi' => 'Sedih', 'mb' => 0.6, 'md' => 0.2],
            ['kode' => 'G002', 'deskripsi' => 'Kelelahan melakukan aktivitas ringan', 'mb' => 0.4, 'md' => 0.2],
            ['kode' => 'G003', 'deskripsi' => 'Kurang konsentrasi dalam belajar', 'mb' => 1.0, 'md' => 0.0],
            ['kode' => 'G004', 'deskripsi' => 'Mudah merasa bosan', 'mb' => 0.4, 'md' => 0.2],
            ['kode' => 'G005', 'deskripsi' => 'Sering melamun', 'mb' => 0.8, 'md' => 0.2],
            ['kode' => 'G006', 'deskripsi' => 'Tidak semangat melakukan sesuatu', 'mb' => 0.6, 'md' => 0.2],
            ['kode' => 'G007', 'deskripsi' => 'Risau', 'mb' => 0.4, 'md' => 0.2],
            ['kode' => 'G008', 'deskripsi' => 'Pesimis', 'mb' => 0.6, 'md' => 0.2],
            ['kode' => 'G009', 'deskripsi' => 'Menangis secara tiba-tiba', 'mb' => 0.8, 'md' => 0.0],
            ['kode' => 'G010', 'deskripsi' => 'Memiliki gangguan susah tidur', 'mb' => 1.0, 'md' => 0.0],
            ['kode' => 'G011', 'deskripsi' => 'Cemas berlebihan', 'mb' => 0.6, 'md' => 0.2],
            ['kode' => 'G012', 'deskripsi' => 'Kecewa dengan diri sendiri', 'mb' => 0.6, 'md' => 0.0],
            ['kode' => 'G013', 'deskripsi' => 'Terganggu dengan banyak hal', 'mb' => 0.8, 'md' => 0.2],
            ['kode' => 'G014', 'deskripsi' => 'Sering murung', 'mb' => 0.6, 'md' => 0.2],
            ['kode' => 'G015', 'deskripsi' => 'Kehilangan minat terhadap hobi', 'mb' => 0.6, 'md' => 0.2],
            ['kode' => 'G016', 'deskripsi' => 'Kesepian', 'mb' => 0.8, 'md' => 0.0],
            ['kode' => 'G017', 'deskripsi' => 'Bersalah', 'mb' => 0.8, 'md' => 0.2],
            ['kode' => 'G018', 'deskripsi' => 'Dihakimi', 'mb' => 1.0, 'md' => 0.0],
            ['kode' => 'G019', 'deskripsi' => 'Membenci diri sendiri', 'mb' => 1.0, 'md' => 0.0],
            ['kode' => 'G020', 'deskripsi' => 'Mudah tersinggung', 'mb' => 0.8, 'md' => 0.2],
            ['kode' => 'G021', 'deskripsi' => 'Kehilangan nafsu makan', 'mb' => 0.8, 'md' => 0.2],
            ['kode' => 'G022', 'deskripsi' => 'Khawatir tentang penampilan', 'mb' => 0.6, 'md' => 0.2],
            ['kode' => 'G023', 'deskripsi' => 'Mudah marah', 'mb' => 0.6, 'md' => 0.2],
            ['kode' => 'G024', 'deskripsi' => 'Suka menyendiri', 'mb' => 0.6, 'md' => 0.2],
            ['kode' => 'G025', 'deskripsi' => 'Memiliki pikiran untuk bunuh diri', 'mb' => 1.0, 'md' => 0.0],
            ['kode' => 'G026', 'deskripsi' => 'Sulit mengambil keputusan', 'mb' => 0.8, 'md' => 0.2],
            ['kode' => 'G027', 'deskripsi' => 'Sulit melakukan kegiatan dengan baik', 'mb' => 0.8, 'md' => 0.2],
            ['kode' => 'G028', 'deskripsi' => 'Ada penambahan dan penurunan berat badan', 'mb' => 0.6, 'md' => 0.2],
            ['kode' => 'G029', 'deskripsi' => 'Kurang percaya diri', 'mb' => 0.8, 'md' => 0.0],
        ];

        return $gejala;
    }
}
