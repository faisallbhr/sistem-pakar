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

        $siswaRole = Role::create([
            'name' => 'siswa'
        ]);

        $guruPermission = Permission::create([
            'name' => 'guru'
        ]);

        $siswaPermission = Permission::create([
            'name' => 'siswa'
        ]);

        $guruRole->givePermissionTo($guruPermission);
        $siswaRole->givePermissionTo($siswaPermission);

        $user = User::create([
            'name' => 'John Doe',
            'email' => 'guru@mail.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole($guruRole);

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
