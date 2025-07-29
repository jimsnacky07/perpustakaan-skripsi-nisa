<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini menangani registrasi user baru serta validasi datanya.
    | Secara default menggunakan trait RegistersUsers untuk memproses register.
    |
    */

    use RegistersUsers;

    /**
     * Ke mana user diarahkan setelah registrasi (tidak dipakai karena kita override registered()).
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Buat instance baru dari controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validator untuk validasi request registrasi.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nisn' => ['required', 'string', 'unique:anggotas', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            'jk' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'kelas' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Membuat user baru setelah registrasi valid.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Anggota::create([
            'nisn' => $data['nisn'],
            'nama' => $data['nama'],
            'jk' => $data['jk'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
            'kelas' => $data['kelas'],
            'user_id' => $user->id,
        ]);

        return $user;
    }

    /**
     * Override fungsi bawaan RegistersUsers agar setelah registrasi
     * user diarahkan ke halaman login, bukan langsung login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function registered(Request $request, $user)
    {
        Auth::logout(); // logout agar tidak auto login
        return redirect('/login')->with('success', 'Akun berhasil dibuat, silakan login.');
    }
}
