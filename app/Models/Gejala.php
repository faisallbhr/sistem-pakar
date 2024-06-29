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
                'kode' => 'G001',
                'deskripsi' => 'Sedih',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G002',
                'deskripsi' => 'Kelelahan melakukan aktivitas ringan',
                'mb' => 0.8,
                'md' => 0.2
            ],
            [
                'kode' => 'G003',
                'deskripsi' => 'Kurang konsentrasi dalam belajar',
                'mb' => 0.6,
                'md' => 0.4
            ],
            [
                'kode' => 'G004',
                'deskripsi' => 'Mudah merasa bosan',
                'mb' => 0.6,
                'md' => 0.4
            ],
            [
                'kode' => 'G005',
                'deskripsi' => 'Sering melamun',
                'mb' => 0.8,
                'md' => 0.2
            ],
            [
                'kode' => 'G006',
                'deskripsi' => 'Tidak semangat melakukan sesuatu',
                'mb' => 0.7,
                'md' => 0.3
            ],
            [
                'kode' => 'G007',
                'deskripsi' => 'Risau',
                'mb' => 0.6,
                'md' => 0.4
            ],
            [
                'kode' => 'G008',
                'deskripsi' => 'Pesimis',
                'mb' => 0.7,
                'md' => 0.3
            ],
            [
                'kode' => 'G009',
                'deskripsi' => 'Menangis secara tiba-tiba',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G010',
                'deskripsi' => 'Memiliki gangguan susah tidur',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G011',
                'deskripsi' => 'Cemas berlebihan',
                'mb' => 0.7,
                'md' => 0.3
            ],
            [
                'kode' => 'G012',
                'deskripsi' => 'Kecewa dengan diri sendiri',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G013',
                'deskripsi' => 'Terganggu dengan banyak hal',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G014',
                'deskripsi' => 'Sering murung',
                'mb' => 0.7,
                'md' => 0.3
            ],
            [
                'kode' => 'G015',
                'deskripsi' => 'Kehilangan minat terhadap hobi',
                'mb' => 0.7,
                'md' => 0.3
            ],
            [
                'kode' => 'G016',
                'deskripsi' => 'Kesepian',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G017',
                'deskripsi' => 'Bersalah',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G018',
                'deskripsi' => 'Dihakimi',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G019',
                'deskripsi' => 'Membenci diri sendiri',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G020',
                'deskripsi' => 'Mudah tersinggung',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G021',
                'deskripsi' => 'Kehilangan nafsu makan',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G022',
                'deskripsi' => 'Khawatir tentang penampilan',
                'mb' => 0.7,
                'md' => 0.3
            ],
            [
                'kode' => 'G023',
                'deskripsi' => 'Mudah marah',
                'mb' => 0.7,
                'md' => 0.3
            ],
            [
                'kode' => 'G024',
                'deskripsi' => 'Suka menyendiri',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G025',
                'deskripsi' => 'Memiliki pikiran untuk bunuh diri',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G026',
                'deskripsi' => 'Sulit mengambil keputusan',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G027',
                'deskripsi' => 'Sulit melakukan kegiatan dengan baik',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G028',
                'deskripsi' => 'Ada penambahan dan penurunan berat badan',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G029',
                'deskripsi' => 'Kurang percaya diri',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G030',
                'deskripsi' => 'Tidak dapat melihat hal yang positif dari suatu kejadian',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G031',
                'deskripsi' => 'Sulit untuk meningkatkan inisiatif dalam melakukan sesuatu',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G032',
                'deskripsi' => 'Tidak ada harapan untuk masa depan',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G033',
                'deskripsi' => 'Mengalami kesulitan keuangan akhir-akhir ini',
                'mb' => 0.7,
                'md' => 0.3
            ],
            [
                'kode' => 'G034',
                'deskripsi' => 'Pekerjaan atau pendapatan Anda cukup untuk memenuhi kebutuhan hidup Anda',
                'mb' => 0.8,
                'md' => 0.2
            ],
            [
                'kode' => 'G035',
                'deskripsi' => 'Iri dengan kepemilikan barang orang lain',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G036',
                'deskripsi' => 'Situasi ekonomi saat ini membuat Anda khawatir tentang masa depan',
                'mb' => 1.0,
                'md' => 0.0
            ],
            [
                'kode' => 'G037',
                'deskripsi' => 'Biaya hidup di lingkungan Anda membuat Anda merasa terbebani',
                'mb' => 1.0,
                'md' => 0.0
            ],
        ];

        return $gejala;
    }
}
