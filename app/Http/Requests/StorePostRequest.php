<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Ubah menjadi true jika Anda ingin request ini diizinkan
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'kategori_kode' => 'required',
            'kategori_nama' => 'required',
            'username' => 'required',
            'nama' => 'required',
            'password' => 'required',
            'level_id' => 'required',
        ];
    }

    public function store(StorePostRequest $request): RedirectResponse{
        //the incoming request is valid...

        //retieve the validation input data...
        $validated = $request->validated();

        //retieve a portion of the validated input data...
        $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
        $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);
        $validated = $request->safe()->only(['username', 'nama', 'password', 'level_id']);
        $validated = $request->safe()->except(['username', 'nama', 'password', 'level_id']);
        $validated = $request->safe()->only(['level_kode', 'level_nama']);
        $validated = $request->safe()->except(['level_kode', 'level_nama']);

        //store the post
        return redirect('/kategori');
        return redirect('/user');
        return redirect('/level');
    }
}