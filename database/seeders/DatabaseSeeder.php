<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Gejala;
use App\Models\Artikel;
use App\Models\Depresi;
use App\Models\Kondisi;
use App\Models\Keputusan;
use Illuminate\Database\Seeder;
use Database\Seeders\DashboardTableSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $guruRole = Role::create([
            'name' => 'guru'
        ]);

        $kelas1Role = Role::create([
            'name' => 'kelas 7'
        ]);

        $kelas2Role = Role::create([
            'name' => 'kelas 8'
        ]);

        $kelas3Role = Role::create([
            'name' => 'kelas 9'
        ]);

        $guru = User::create([
            'name' => 'NOVIA ZAHRUL SHOFI',
            'email' => 'noviaguru@gmail.com',
            'password' => bcrypt('password')
        ]);

        $kelas1 = User::create([
            'name' => 'Novia',
            'email' => 'noviasiswa@gmail.com',
            'password' => bcrypt('password')
        ]);

        $kelas2 = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('password')
        ]);

        $kelas3 = User::create([
            'name' => 'Samuel Smith',
            'email' => 'samuelsmith@gmail.com',
            'password' => bcrypt('password')
        ]);

        $guru->assignRole($guruRole);
        $kelas1->assignRole($kelas1Role);
        $kelas2->assignRole($kelas2Role);
        $kelas3->assignRole($kelas3Role);

        $gejala = new Gejala();
        $depresi = new Depresi();
        $kondisi = new Kondisi();
        $keputusan = new Keputusan();
        $artikel = new Artikel();

        Gejala::insert($gejala->fillTable());
        Depresi::insert($depresi->fillTable());
        Kondisi::insert($kondisi->fillTable());
        Keputusan::insert($keputusan->fillTable());
        Artikel::insert($artikel->fillTable());
    }
}
