<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            ['barang_id' => 1, 'barang_kode' => 'B1', 'kategori_id' => '1', 'barang_nama' => 'Tirai Gulung', 'harga_beli' => 700000, 'harga_jual' => 850000],
            ['barang_id' => 2, 'barang_kode' => 'B2', 'kategori_id' => '1', 'barang_nama' => 'Tirai Lipat', 'harga_beli' => 40000, 'harga_jual' => 50000],
            ['barang_id' => 3, 'barang_kode' => 'B3', 'kategori_id' => '2', 'barang_nama' => 'Meja TV', 'harga_beli' => 2000000, 'harga_jual' => 2200000],
            ['barang_id' => 4, 'barang_kode' => 'B4', 'kategori_id' => '2', 'barang_nama' => 'Lemari', 'harga_beli' => 1200000, 'harga_jual' => 1400000],
            ['barang_id' => 5, 'barang_kode' => 'B5', 'kategori_id' => '3', 'barang_nama' => 'Tapresi Gantung', 'harga_beli' => 370000, 'harga_jual' => 400000],
            ['barang_id' => 6, 'barang_kode' => 'B6', 'kategori_id' => '3', 'barang_nama' => 'Buket Artifisial', 'harga_beli' => 30000, 'harga_jual' => 40000],
            ['barang_id' => 7, 'barang_kode' => 'B7', 'kategori_id' => '4', 'barang_nama' => 'Swedish meatballs', 'harga_beli' => 50000, 'harga_jual' => 60000],
            ['barang_id' => 8, 'barang_kode' => 'B8', 'kategori_id' => '4', 'barang_nama' => 'Coklat mousse', 'harga_beli' => 25000, 'harga_jual' => 30000],
            ['barang_id' => 9, 'barang_kode' => 'B9', 'kategori_id' => '5', 'barang_nama' => 'Hot chocolate', 'harga_beli' => 20000, 'harga_jual' => 25000],
            ['barang_id' => 10, 'barang_kode' => 'B10', 'kategori_id' => '5', 'barang_nama' => 'Latte', 'harga_beli' => 15000, 'harga_jual' => 20000]
        ];
        DB::table('m_barang')->insert($data);
    }
}
