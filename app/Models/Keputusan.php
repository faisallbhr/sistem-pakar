<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keputusan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function fillTable()
    {
        $rule = [
            // Data untuk kode rule 1 (P001)
            ['kode_rule' => '1', 'kode_gejala' => 'G001', 'kode_depresi' => 'P001', 'cf' => 0.8],
            ['kode_rule' => '1', 'kode_gejala' => 'G002', 'kode_depresi' => 'P001', 'cf' => 0.8],
            ['kode_rule' => '1', 'kode_gejala' => 'G003', 'kode_depresi' => 'P001', 'cf' => 0.8],
            ['kode_rule' => '1', 'kode_gejala' => 'G004', 'kode_depresi' => 'P001', 'cf' => 0.8],
            ['kode_rule' => '1', 'kode_gejala' => 'G005', 'kode_depresi' => 'P001', 'cf' => 0.8],
            ['kode_rule' => '1', 'kode_gejala' => 'G007', 'kode_depresi' => 'P001', 'cf' => 0.8],

            // Data untuk kode rule 2 (P002)
            ['kode_rule' => '2', 'kode_gejala' => 'G001', 'kode_depresi' => 'P002', 'cf' => 0.8],
            ['kode_rule' => '2', 'kode_gejala' => 'G002', 'kode_depresi' => 'P002', 'cf' => 0.8],
            ['kode_rule' => '2', 'kode_gejala' => 'G006', 'kode_depresi' => 'P002', 'cf' => 0.8],
            ['kode_rule' => '2', 'kode_gejala' => 'G008', 'kode_depresi' => 'P002', 'cf' => 0.8],
            ['kode_rule' => '2', 'kode_gejala' => 'G010', 'kode_depresi' => 'P002', 'cf' => 0.8],
            ['kode_rule' => '2', 'kode_gejala' => 'G011', 'kode_depresi' => 'P002', 'cf' => 0.8],
            ['kode_rule' => '2', 'kode_gejala' => 'G014', 'kode_depresi' => 'P002', 'cf' => 0.8],
            ['kode_rule' => '2', 'kode_gejala' => 'G015', 'kode_depresi' => 'P002', 'cf' => 0.8],
            ['kode_rule' => '2', 'kode_gejala' => 'G016', 'kode_depresi' => 'P002', 'cf' => 0.8],
            ['kode_rule' => '2', 'kode_gejala' => 'G022', 'kode_depresi' => 'P002', 'cf' => 0.8],

            // Data untuk kode rule 3 (P003)
            ['kode_rule' => '3', 'kode_gejala' => 'G001', 'kode_depresi' => 'P003', 'cf' => 0.5],
            ['kode_rule' => '3', 'kode_gejala' => 'G009', 'kode_depresi' => 'P003', 'cf' => 0.5],
            ['kode_rule' => '3', 'kode_gejala' => 'G010', 'kode_depresi' => 'P003', 'cf' => 0.5],
            ['kode_rule' => '3', 'kode_gejala' => 'G011', 'kode_depresi' => 'P003', 'cf' => 0.5],
            ['kode_rule' => '3', 'kode_gejala' => 'G012', 'kode_depresi' => 'P003', 'cf' => 0.5],
            ['kode_rule' => '3', 'kode_gejala' => 'G013', 'kode_depresi' => 'P003', 'cf' => 0.5],
            ['kode_rule' => '3', 'kode_gejala' => 'G016', 'kode_depresi' => 'P003', 'cf' => 0.5],
            ['kode_rule' => '3', 'kode_gejala' => 'G017', 'kode_depresi' => 'P003', 'cf' => 0.5],
            ['kode_rule' => '3', 'kode_gejala' => 'G020', 'kode_depresi' => 'P003', 'cf' => 0.5],
            ['kode_rule' => '3', 'kode_gejala' => 'G022', 'kode_depresi' => 'P003', 'cf' => 0.5],
            ['kode_rule' => '3', 'kode_gejala' => 'G023', 'kode_depresi' => 'P003', 'cf' => 0.5],
            ['kode_rule' => '3', 'kode_gejala' => 'G027', 'kode_depresi' => 'P003', 'cf' => 0.5],

            // Data untuk kode rule 4 (P004)
            ['kode_rule' => '4', 'kode_gejala' => 'G001', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G009', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G010', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G012', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G013', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G016', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G018', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G019', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G020', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G021', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G024', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G025', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G026', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G027', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G028', 'kode_depresi' => 'P004', 'cf' => 0.1],
            ['kode_rule' => '4', 'kode_gejala' => 'G029', 'kode_depresi' => 'P004', 'cf' => 0.1],
        ];
        return $rule;
    }
}
