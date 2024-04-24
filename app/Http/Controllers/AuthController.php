<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index ()
    {
        // Kita ambil data user lalu simpan pada variable $user
        $user = Auth::user();

        // Kondisi jika user nya ada
        if ($user) {
            // Jika user nya memiliki level admin
            if ($user->level_id == '1') {
                return redirect()->intended('admin');
            }
            // Jika user nya memiliki level manager
            else if ($user->level == '2') {
            return redirect()->intended('manager');
            }
        }
        return view('login');
    }

    public function proses_login(Request $request)
    {
        // Kita buat validasi pada saat tombol login di klik, validasi nya username & password wajib di isi
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Ambil data request username & password saja
        $credential = $request->only('username', 'password');
        // Cek jika data username dan password valid (sesuai) dengan data
        if (Auth::attempt($credential)) {

            // Kalau berhasil simpan data user ya di variabel $user
            $user = Auth::user ();

            // Cek lagi jika level user admin maka arahkan ke halaman admin
            if ($user->level_id == '1') {
                //dd($user->level_id);
                return redirect()->intended('admin');
            }
            // Tapi jika level user nya user biasa maka arahkan ke halaman user
            else if ($user->level_id == '2') {
                return redirect()->intended('manager');
            }
            // Jika belum ada role maka ke halaman /
            return redirect()->intended('/');
        }
        // Jika ga ada data user yang valid maka kembalikan lagi ke halaman login, pastikan kirim pesan error juga kalau login gagal ya
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Pastikan kembali username dan password yang dimasukan sudah benar']);
    }

    public function register(){
        // Tampilan halaman form register
        return view('register');
    }

    // Aksi form register
    public function proses_register(Request $request)
    {
        // Kita buat validasi nih buat proses register, validasinya yaitu semua field wajib di isi, validasi username itu harus unique atau tidak boleh duplicate username ya
        $validator = Validator :: make($request->all(), [
            'nama' => 'required',
            'username' => 'required |unique:m_user',
            'password' => 'required'
        ]);

        // Kalau gagal kembali ke halaman register dengan munculkan pesan error
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }
        // Kalau berhasil isi level & hash passwordnya ya biar secure
        $request['level_id'] = '2';
        $request['password'] = Hash::make($request->password);

        // Masukkan semua data pada request ke table user
        UserModel::create($request->all());

        // Kalo berhasil arahkan ke halaman login
        return redirect()->route('login');
    }
    public function logout(Request $request)
    {
        // Logout itu harus menghapus session nya
        $request->session()->flush();

        // Jalan kan juga fungsi logout pada auth
        Auth::logout();
        // Kembali kan ke halaman login
        return Redirect('login');
    }
}