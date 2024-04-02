<?php

namespace App\Http\Controllers;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use App\DataTables\KategoriDataTable;
use Illuminate\Http\RedirectResponse;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request):RedirectResponse{
        $validated = $request->validate([
            'kategori_kode' => 'bail|required|unique:post|max:255',
            'kategori_nama' => 'bail|required|unique:post|max:255',
        ]);
        KategoriModel::create([
            'kategori_kode' => $request->kodeKategori,
            'namaKategori' => $request->namaKategori,
        ]);
        //The post is valid
        return redirect('/kategori');
    }

    public function edit($id)
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', ['kategori' => $kategori]);
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriModel::find($id);
        $kategori->kategori_kode = $request->kodeKategori;
        $kategori->kategori_nama = $request->namaKategori;
        $kategori->save();
        return redirect('/kategori');
    }

    public function delete($id)
    {
        $kategori = KategoriModel::find($id);
        $kategori->delete();
        return redirect('/kategori');
    }
}
