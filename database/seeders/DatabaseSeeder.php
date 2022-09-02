<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Warga;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Khoirony Arief',
            'email' => 'khoirony@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        Kriteria::create([
            'nama_kriteria' => 'Status Bangunan',
            'atribut_kriteria' => 'benefit',
            'bobot_kriteria' => 3
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Milik Sendiri',
            'bobot_sub_kriteria' => 1,
            'id_kriteria' => 1
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Dinas',
            'bobot_sub_kriteria' => 2,
            'id_kriteria' => 1
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Bebas Sewa',
            'bobot_sub_kriteria' => 3,
            'id_kriteria' => 1
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Kontrakan/Sewa',
            'bobot_sub_kriteria' => 4,
            'id_kriteria' => 1
        ]);

        Kriteria::create([
            'nama_kriteria' => 'Status Lahan',
            'atribut_kriteria' => 'benefit',
            'bobot_kriteria' => 3
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Milik Sendiri',
            'bobot_sub_kriteria' => 1,
            'id_kriteria' => 2
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Milik Negara',
            'bobot_sub_kriteria' => 2,
            'id_kriteria' => 2
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Milik Orang Lain',
            'bobot_sub_kriteria' => 3,
            'id_kriteria' => 2
        ]);

        Kriteria::create([
            'nama_kriteria' => 'Luas Lantai',
            'atribut_kriteria' => 'cost',
            'bobot_kriteria' => 4
        ]);

        Kriteria::create([
            'nama_kriteria' => 'Jenis Lantai',
            'atribut_kriteria' => 'benefit',
            'bobot_kriteria' => 4
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Marmer',
            'bobot_sub_kriteria' => 1,
            'id_kriteria' => 4
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Parket/Vinyl',
            'bobot_sub_kriteria' => 2,
            'id_kriteria' => 4
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Keramik',
            'bobot_sub_kriteria' => 3,
            'id_kriteria' => 4
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Ubin/Tegel',
            'bobot_sub_kriteria' => 4,
            'id_kriteria' => 4
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Kayu/papan kualitas Tinggi',
            'bobot_sub_kriteria' => 5,
            'id_kriteria' => 4
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Semen/Bata',
            'bobot_sub_kriteria' => 6,
            'id_kriteria' => 4
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Bambu',
            'bobot_sub_kriteria' => 7,
            'id_kriteria' => 4
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Kayu/papan kualitas rendah',
            'bobot_sub_kriteria' => 8,
            'id_kriteria' => 4
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Tanah',
            'bobot_sub_kriteria' => 9,
            'id_kriteria' => 4
        ]);

        Kriteria::create([
            'nama_kriteria' => 'Jenis Dinding',
            'atribut_kriteria' => 'benefit',
            'bobot_kriteria' => 4
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Tembok',
            'bobot_sub_kriteria' => 1,
            'id_kriteria' => 5
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Plester Anyaman Bambu',
            'bobot_sub_kriteria' => 2,
            'id_kriteria' => 5
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Kayu',
            'bobot_sub_kriteria' => 3,
            'id_kriteria' => 5
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Anyaman Bambu',
            'bobot_sub_kriteria' => 4,
            'id_kriteria' => 5
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Batang Kayu',
            'bobot_sub_kriteria' => 5,
            'id_kriteria' => 5
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Bambu',
            'bobot_sub_kriteria' => 6,
            'id_kriteria' => 5
        ]);

        Kriteria::create([
            'nama_kriteria' => 'Kepemilikan Fas BAB',
            'atribut_kriteria' => 'benefit',
            'bobot_kriteria' => 3
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Sendiri',
            'bobot_sub_kriteria' => 1,
            'id_kriteria' => 6
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Bersama',
            'bobot_sub_kriteria' => 2,
            'id_kriteria' => 6
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Umum',
            'bobot_sub_kriteria' => 3,
            'id_kriteria' => 6
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Tidak Ada',
            'bobot_sub_kriteria' => 4,
            'id_kriteria' => 6
        ]);

        Kriteria::create([
            'nama_kriteria' => 'Daya Listrik',
            'atribut_kriteria' => 'cost',
            'bobot_kriteria' => 4
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Tanpa Meteran',
            'bobot_sub_kriteria' => 1,
            'id_kriteria' => 7
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => '450 Watt',
            'bobot_sub_kriteria' => 2,
            'id_kriteria' => 7
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => '900 Watt',
            'bobot_sub_kriteria' => 3,
            'id_kriteria' => 7
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => '1300 Watt',
            'bobot_sub_kriteria' => 4,
            'id_kriteria' => 7
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => '2200 Watt',
            'bobot_sub_kriteria' => 5,
            'id_kriteria' => 7
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => '>2200 Watt',
            'bobot_sub_kriteria' => 6,
            'id_kriteria' => 7
        ]);

        Kriteria::create([
            'nama_kriteria' => 'Status Penerima Bantuan Lain',
            'atribut_kriteria' => 'benefit',
            'bobot_kriteria' => 5
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Ada',
            'bobot_sub_kriteria' => 1,
            'id_kriteria' => 8
        ]);
        SubKriteria::create([
            'nama_sub_kriteria' => 'Tidak',
            'bobot_sub_kriteria' => 2,
            'id_kriteria' => 8
        ]);

        Warga::create([
            'nama_warga' => 'Bambang Ristianto',
            'alamat_warga' => 'DSN KARANG ANYAR RT 03 RW 02 DUSUN KARANG ANYAR RW 02 RT 03'
        ]);
        Warga::create([
            'nama_warga' => 'Dewantoro',
            'alamat_warga' => 'DSN KARANG ANYAR RT 03 RW 02 DUSUN KARANG ANYAR RW 02 RT 03'
        ]);
        Warga::create([
            'nama_warga' => 'Karman',
            'alamat_warga' => 'DSN TEMAJI RT 04 RW 01 DUSUN TEMAJI RW 01 RT 04'
        ]);
        Warga::create([
            'nama_warga' => 'Kasimin',
            'alamat_warga' => 'DUSUN KARANG ANYAR RT 01 RW 02'
        ]);
        Warga::create([
            'nama_warga' => 'Kastoyan',
            'alamat_warga' => 'DSN GLAGAH RT 06 RW 02 DUSUN GLAGAH RW 02 RT 06'
        ]);
        Warga::create([
            'nama_warga' => 'Kasturi',
            'alamat_warga' => 'DSN TERANGREJO RT 05 RW 01 DUSUN TERANGREJO RW 01 RT 05'
        ]);
        Warga::create([
            'nama_warga' => 'Lamsi',
            'alamat_warga' => 'DSN TERANG REJO RT 07 RW 01 DUSUN TERANGREJO RW 01 RT 07'
        ]);
        Warga::create([
            'nama_warga' => 'Lasminto',
            'alamat_warga' => 'DSN TERANGREJO RT 05 RW 01 DUSUN TERANGREJO RW 01 RT 05'
        ]);
        Warga::create([
            'nama_warga' => 'Marsidan',
            'alamat_warga' => 'DSN TERANGREJO RT 08 RW 01 DUSUN TERANGREJO RW 01 RT 08'
        ]);
        Warga::create([
            'nama_warga' => 'Masrip',
            'alamat_warga' => 'DSN KARANG ANYAR RT 03 RW 02 DUSUN KARANG ANYAR RW 02 RT 03'
        ]);
        Warga::create([
            'nama_warga' => 'Muslih',
            'alamat_warga' => 'DSN KARANG ANYAR RT 03 RW 02 DUSUN KARANG ANYAR RW 02 RT 03'
        ]);
        Warga::create([
            'nama_warga' => 'Pawit Sugianto',
            'alamat_warga' => 'DUSUN TERANGREJO RT 06 RW 01'
        ]);
        Warga::create([
            'nama_warga' => 'Sadjimin',
            'alamat_warga' => 'DSN KARANG ANYAR RT 04 RW 02 DUSUN KARANG ANYAR RW 02 RT 04'
        ]);
        Warga::create([
            'nama_warga' => 'Wiwik Setiawan',
            'alamat_warga' => 'DUSUN KARANG ANYAR RT 02 RW 02'
        ]);
        Warga::create([
            'nama_warga' => 'Warmuji',
            'alamat_warga' => 'DSN TEMAJI RT 04 RW 01 DUSUN TEMAJI RW 01 RT 04'
        ]);
        Warga::create([
            'nama_warga' => 'Wajimin',
            'alamat_warga' => 'DSN TERANGREJO RT 05 RW 01 DUSUN TERANGREJO RW 01 RT 05'
        ]);
        Warga::create([
            'nama_warga' => 'Tasmari',
            'alamat_warga' => 'DUSUN TERANGREJO RT 06 RW 01'
        ]);
        Warga::create([
            'nama_warga' => 'Tarmadi',
            'alamat_warga' => 'DSN KARANG ANYAR RT 04 RW 02 DUSUN KARANG ANYAR RW 02 RT 04'
        ]);
        Warga::create([
            'nama_warga' => 'Suwono',
            'alamat_warga' => 'DSN TERANGREJO RT 05 RW 01 DUSUN TERANGREJO RW 01 RT 05'
        ]);
        Warga::create([
            'nama_warga' => 'Sumarni',
            'alamat_warga' => 'DSN GLAGAH RT 06 RW 02'
        ]);
        Warga::create([
            'nama_warga' => 'Sucipto',
            'alamat_warga' => 'DSN KARANG ANYAR RT 03 RW 02 DUSUN KARANG ANYAR RW 02 RT 03'
        ]);
        Warga::create([
            'nama_warga' => 'Sokran',
            'alamat_warga' => 'DSN TERANGREJO RT 08 RW 01 DUSUN TERANGREJO RW 01 RT 08'
        ]);
        Warga::create([
            'nama_warga' => 'Seminah',
            'alamat_warga' => 'DSN JAJAR RT 05 RW 02 DUSUN JAJAR RW 02 RT 05'
        ]);
        Warga::create([
            'nama_warga' => 'Samiatun',
            'alamat_warga' => 'DSN KARANG ANYAR RT 03 RW 02 DUSUN KARANG ANYAR RW 02 RT 03'
        ]);
        Warga::create([
            'nama_warga' => 'Sakrun',
            'alamat_warga' => 'DUSUN TEMAJI RT 02 RW 01'
        ]);
        Warga::create([
            'nama_warga' => 'Alifan',
            'alamat_warga' => 'DSN TERANGREJO RT 08 RW 01 DUSUN TERANGREJO RW 01 RT 08'
        ]);
        Warga::create([
            'nama_warga' => 'Amin Djohari',
            'alamat_warga' => 'DSN TERANGREJO RT 05 RW 01 DUSUN TERANGREJO RW 01 RT 05'
        ]);
        Warga::create([
            'nama_warga' => 'Darim',
            'alamat_warga' => 'DUSUN KARANG ANYAR RT 01 RW 02'
        ]);
        Warga::create([
            'nama_warga' => 'Darmaji',
            'alamat_warga' => 'DSN TERANGREJO RT 05 RW 01 DUSUN TERANGREJO RW 01 RT 05'
        ]);
        Warga::create([
            'nama_warga' => 'Dasidin',
            'alamat_warga' => 'DSN JAJAR RT 5 RW'
        ]);
    }
}
