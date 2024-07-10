<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->fullname = 'Admin';
        $admin->username = 'admin';
        $admin->jenis_kelamin = 'Laki-laki';
        $admin->alamat = 'Indonesia';
        $admin->no_telepon = 1234567890;
        $admin->email = 'admin@gmail.com';
        $admin->is_admin = 1;
        $admin->password = Hash::make('1234567890'); // Ganti 'password' dengan password yang diinginkan
        $admin->save();
    }
}
