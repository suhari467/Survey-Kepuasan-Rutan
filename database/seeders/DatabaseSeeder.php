<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Service;
use App\Models\Question;
use App\Models\Instansi;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'keterangan' => 'Administrator'
        ]);

        Role::create([
            'name' => 'user',
            'keterangan' => 'User'
        ]);

        User::create([
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi' // password
        ]);

        Service::create([
            'name' => 'Umum'
        ]);

        Question::create([
            'service_id' => 1,
            'pertanyaan' => 'Apakah pendapat anda tentang layanan ini ?'
        ]);

        Instansi::create([
            'nama_instansi' => 'Rumah Tahanan Negara KELAS IIB Sengkang',
            'alamat_instansi' => 'Jl. Datu Ulaweng, Desa Lempa, Kec. Pammana, Kab. Wajo, Provinsi Sulawesi Selatan',
            'informasi_instansi' => 'Jangan lupa untuk selalu hadir tepat waktu, integritas di negara kita sangat di junjung tinggi baik oleh para aparatur negara maupun masyarakat',
            'email' => 'antrianrutansengkang@gmail.com',
            'ukuran_logo' => 250,
            'status' => 1
        ]);

        // \App\Models\User::factory(3)->create();
    }
}
