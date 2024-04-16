<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use App\Models\DetailPenjualanModel;
use App\Models\UserModel;
use App\Models\LevelModel;
use App\Models\TransaksiModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(){
        $breadcrumb = (object) [ 
            'title' => 'Daftar Transaksi Penjualan', 
            'list' => ['Home', 'Transaksi']
        ];
        $page = (object) ['title' => 'Daftar transaksi penjualan yang terdaftar dalam sistem'];
        $activeMenu = 'penjualan'; // set menu yang sedang aktif
        $user = UserModel::all();
        $barang = BarangModel::all();
        $penjualan = TransaksiModel::all();
        $level = LevelModel::all();
        return view('transaksi.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'user'=>$user,'penjualan'=>$penjualan, 'barang'=>$barang , 'level'=>$level, 'activeMenu' => $activeMenu]);  
    }

    public function list(Request $request){
        $trans = TransaksiModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
                ->with('user')
                ->withCount(['detail as jumlah' => function($query) {
                    $query->select(DB::raw('sum(jumlah)'));
                }]);

        //Filter berdasarkan user
        if($request->user_id){
            $trans->where('user_id', $request->user_id);
        }

        return DataTables::of($trans)
        ->addIndexColumn()
        ->addColumn('aksi', function ($tran) { // menambahkan kolom aksi
            $btn = '<a href="'.url('/transaksi/' . $tran->penjualan_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/transaksi/' . $tran->penjualan_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/transaksi/'.$tran->penjualan_id).'">'. csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function create(){
        $breadcrumb = (object) [
        'title' => 'Tambah Transaksi Penjualan',
        'list' => ['Home', 'Transaksi', 'Tambah']];
        $page = (object) ['title' => 'Tambah Transaksi Penjualan Baru'];
        $user = UserModel::all(); //ambil data user untuk ditampilkan di form
        $barang = BarangModel::all();
        $activeMenu = 'penjualan'; // set menu yang sedang aktif
        return view('transaksi.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'user'=>$user, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_kode'   => 'required|string|min:3|unique:t_penjualan,penjualan_kode',
            'user_id'          => 'required|integer',
            'pembeli'          => 'required|string|max:100',
            'penjualan_tanggal'=> 'required|date_format:Y-m-d\TH:i',
            'barang_id'        => 'required|integer',
            'jumlah'           => 'required|integer'
        ]);
        $penjualan = TransaksiModel::create([
            'penjualan_kode'   => $request->penjualan_kode,
            'user_id'          => $request->user_id,
            'pembeli'          => $request->pembeli,
            'penjualan_tanggal'=> $request->penjualan_tanggal
        ]);

        //detail penjualan
        $barang = BarangModel::findOrFail($request->barang_id);
        $harga = $barang->harga_jual;
        $penjualan_id = $penjualan->penjualan_id;

        DetailPenjualanModel::create([
            'penjualan_id'=> $penjualan_id,
            'barang_id'   => $request->barang_id,
            'harga'      => $harga,
            'jumlah'     => $request->jumlah
        ]);


        return redirect('/transaksi')->with('success','Data transaksi penjualan berhasil disimpan');
    }

    public function show(string $id)
    {
        $transaksi = TransaksiModel::with('user')->find($id);
        $user = UserModel::all();
        $barang = BarangModel::all();
        $detail = DetailPenjualanModel::all();

        $breadcrumb = (object) [
            'title' => 'Detail Transaksi Penjualan',
            'list' => ['Home', 'Transaksi', 'Detail']
        ];

        $page = (object) ['title' => 'Detail Transaksi Penjualan'];
        $activeMenu = 'penjualan'; // set menu yang sedang aktif
        
        return view('transaksi.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $transaksi, 'user'=>$user,'barang'=>$barang, 'detail'=>$detail, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $transaksi = TransaksiModel::find($id);
        $user = UserModel::all();
        $barang = BarangModel::all();
        $detail = DetailPenjualanModel::all();

        $user = UserModel::all();
        $breadcrumb = (object)[
            'title' => 'Edit Transaksi Penjualan',
            'list' => ['Home', 'Transaksi', 'Edit']
        ];
        $page = (object)['title' => 'Edit Transaksi Penjualan '];
        $activeMenu = 'penjualan'; // set menu yang sedang aktif
        return view('transaksi.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $transaksi, 'user'=>$user,'barang'=>$barang, 'detail'=>$detail, 'activeMenu' => $activeMenu]);    }


    public function update(Request $request, string $id)
    {
    $request->validate([
        'penjualan_kode'   => 'required|string|min:3|unique:t_penjualan,penjualan_kode,'. $id .',penjualan_id',
        'user_id'          => 'required|integer',
        'pembeli'          => 'required|string|max:100',
        'penjualan_tanggal'=> 'required|date_format:Y-m-d\TH:i',
        'barang_id'        => 'required|integer',
        'jumlah'           => 'required|integer'
    ]);
    TransaksiModel::find($id)->update([
        'penjualan_kode'   => $request->penjualan_kode ? ($request->penjualan_kode) : TransaksiModel::find($id)->penjualan_kode,
        'user_id'          => $request->user_id,
        'pembeli'          => $request->pembeli,
        'penjualan_tanggal'=> $request->penjualan_tanggal
    ]);

        return redirect('/transaksi')->with('success', 'Data transaksi penjualan berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = TransaksiModel::find($id);
        if(!$check){ //untuk mengecek apakah data penjualan dengan id yang dimaksud ada atau tidak
        return redirect('/transaksi')->with('error', 'Data penjualan tidak ditemukan');
    }
    try {
        // Hapus detail penjualan terlebih dahulu
        DetailPenjualanModel::where('penjualan_id', $id)->delete();
        
        // Hapus data penjualan
        $penjualan = TransaksiModel::find($id);
        if (!$penjualan) {
            return redirect('/transaksi')->with('error', 'Data transaksi penjualan tidak ditemukan');
        }
        $penjualan->delete();

        DB::commit();

        return redirect('/transaksi')->with('success', 'Data transaksi penjualan berhasil dihapus');
    } catch (\Exception $e) {
        DB::rollback();

        return redirect('/transaksi')->with('error', 'Gagal menghapus data transaksi penjualan: ' . $e->getMessage());
    }
    } 
}