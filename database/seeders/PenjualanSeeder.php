<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            ['penjualan_id' => 1, 'user_id' => 3, 'pembeli' => 'Jihan Karunia', 'penjualan_kode' => 'PJ1', 'penjualan_tanggal' => NOW()],
            ['penjualan_id' => 2, 'user_id' => 3, 'pembeli' => 'Andrean Reynaldi', 'penjualan_kode' => 'PJ2', 'penjualan_tanggal' => NOW()],
            ['penjualan_id' => 3, 'user_id' => 3, 'pembeli' => 'Sherina Ayu', 'penjualan_kode' => 'PJ3', 'penjualan_tanggal' => NOW()],
            ['penjualan_id' => 4, 'user_id' => 3, 'pembeli' => 'Wulan Maulidya', 'penjualan_kode' => 'PJ4', 'penjualan_tanggal' => NOW()],
            ['penjualan_id' => 5, 'user_id' => 3, 'pembeli' => 'Azka Anasiyya', 'penjualan_kode' => 'PJ5', 'penjualan_tanggal' => NOW()],
            ['penjualan_id' => 6, 'user_id' => 3, 'pembeli' => 'Zaki Lazuardi', 'penjualan_kode' => 'PJ6', 'penjualan_tanggal' => NOW()],
            ['penjualan_id' => 7, 'user_id' => 3, 'pembeli' => 'Ferdi Riansyah', 'penjualan_kode' => 'PJ7', 'penjualan_tanggal' => NOW()],
            ['penjualan_id' => 8, 'user_id' => 3, 'pembeli' => 'Daffa Yudisa', 'penjualan_kode' => 'PJ8', 'penjualan_tanggal' => NOW()],
            ['penjualan_id' => 9, 'user_id' => 3, 'pembeli' => 'Thoriq Fathurozi', 'penjualan_kode' => 'PJ9', 'penjualan_tanggal' => NOW()],
            ['penjualan_id' => 10, 'user_id' => 3, 'pembeli' => 'Fanesabhirawaning', 'penjualan_kode' => 'PJ10', 'penjualan_tanggal' => NOW()]
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
