<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPenjualanModel extends Model
{
    use HasFactory;

    protected $table = 't_penjualan_detail';
    protected $primaryKey = 'detail_id';
    protected $fillable = ['detail_id', 'penjualan_id', 'barang_id', 'harga','jumlah'];

    public function barang(): BelongsTo{
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }

    public function penjualan(): BelongsTo{
        return $this->belongsTo(TransaksiModel::class, 'penjualan_id', 'penjualan-id');
    }
}