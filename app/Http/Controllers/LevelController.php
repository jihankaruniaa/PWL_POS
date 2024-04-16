<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\LevelDataTable;
use App\Http\Requests\LevelStorePostRequest;
use App\Models\LevelModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;

class LevelController extends Controller
{
    // public function index(LevelDataTable $dataTable){
    //     return $dataTable->render('level.index');
    // }
    public function index(){
        $breadcrumb = (object) [ 
            'title' => 'Daftar Level User', 
            'list' => ['Home', 'Level']
        ];
        $page = (object) ['title' => 'Daftar level user yang terdaftar dalam sistem' ];
        $activeMenu = 'level'; // set menu yang sedang aktif
        $level = LevelModel::all(); // ambil data leveluntuk filter level
        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request){
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        //Filter berdasarkan level_id
        if($request->level_id){
            $levels->where('level_id', $request->level_id);
        }

        return DataTables::of($levels)
        ->addIndexColumn()
        ->addColumn('aksi', function ($level) { // menambahkan kolom aksi
                $btn = '<a href="'.url('/level/' . $level->level_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/level/' . $level->level_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/level/'.$level->level_id).'">'
                        . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function create(){
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']];
            $page = (object) ['title' => 'Tambah Level Baru'];
            $level = LevelModel::all(); // ambil data level untuk ditampilkan di form $activeMenu 'level'; 
            $activeMenu = 'level'; // set menu yang sedang aktif
            return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request){
        $request->validate([
            'level_kode' => 'required|string|min:2|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100'
        ]);
        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama
        ]);

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    public function show(string $id)
    {
        $level = LevelModel::find($id);
        $breadcrumb = (object) [
            'title' => 'Detail Level User',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) ['title' => 'Detail level'];
        $activeMenu = 'level'; // set menu yang sedang aktif
        return view('level.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $level = LevelModel::find($id);
        $breadcrumb = (object)[
            'title' => 'Edit Level User',
            'list' => ['Home', 'Level', 'Edit']
        ];
        $page = (object)['title' => 'Edit Level User'];
        $activeMenu = 'level'; // set menu yang sedang aktif
        return view('level.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|string|min:2|unique:m_level,level_kode,' . $id . ',level_id',
            'level_nama' => 'required|string|max:100'
        ]);

        $level = LevelModel::find($id);
        $level->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama
        ]);
        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = LevelModel::find($id);
        if (!$check) { // untuk mengecek apakah data level dengan id yang dimaksud ada atau tidak
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }
        try {
            LevelModel::destroy($id); // Hapus data level
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}