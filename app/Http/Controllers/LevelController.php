<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\LevelDataTable;
use App\Models\LevelModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class LevelController extends Controller
{
    public function index(LevelDataTable $dataTable){
        return $dataTable->render('level.index');
    }

    public function create(){
        return view('level.create');
    }

    public function store(Request $request):RedirectResponse{
        $validated = $request->validate([
            'level_kode' => 'bail|required|unique:post|max:255',
            'level_nama' => 'bail|required|unique:post|max:255',
        ]);
        levelModel::create([
            'level_kode' =>$request->kodelevel,
            'level_nama' =>$request->namalevel,
        ]);
        return redirect('/level');
    }

    public function edit($id){
        $level = levelModel::find($id);
        return view('level.edit', ['data' => $level]);
    }

    public function storeEdit(Request $request, $id){
        $level = levelModel::find($id);

        $level->level_kode = $request->kodelevel;
        $level->level_nama = $request->namalevel;
        $level->save();

        return redirect('/level');
    }

    public function hapus($id){
        $level = LevelModel::find($id);
        $level->delete($id);

        return redirect('/level');
    }
}