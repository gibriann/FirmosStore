<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Customer;
use App\Mail\forgetPasswordMail;
use Carbon\Carbon; 
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use DB; 
use Mail; 

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    protected function postregister(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:255',
            'phone_number' => 'required|min:11|max:13|unique:customers,phone_number'
        ];

        
        $customMessage = [
            'required' => 'Silahkan Masukan :attribute',
            'unique' => ':attribute Telah Digunakan',
            'min' => ':attribute minimal :min',
            'max' => ':attribute maksimal :max',
        ];
        
        $attributeName = [
            'name' => 'Nama',
            'email' => 'Alamat Email',
            'password' => 'Password',
            'phone_number' => 'Nomor Telepon',
        ];

        $this->validate($request, $rules, $customMessage, $attributeName);

        $user = User::create([
            'name' => $request->name,
            'role_id' => 3,
            'user_status_id' => 1,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Customer::create([
            'user_id' => $user->id,
            'phone_number' => $request->phone_number,
        ]);

        Alert::success('Berhasil','Silahkan melakukan login');
        return redirect('/login');
    }

    protected function postlogin(Request $request)
    {
        
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);

        if(Auth::attempt($request->only('email','password'))){
            if (Auth::user()->user_status_id == 1) {
                if(Auth::user()->role_id == 1||Auth::user()->role_id == 2){
                    Alert::toast('Anda berhasil masuk ke dalam sistem','success');
                    return redirect(route('dashboard'));
                }elseif (Auth::user()->role_id == 3) {
                    return redirect ('/');
                }
            }else{
                Alert::error('Login Gagal','Akses Ditolak');
                return redirect ('/login');
            }
        }
        Alert::error('Login Gagal','Email atau Password Anda Salah');
        return redirect ('/login');
    }

    protected function logout()
    {
        Auth::logout();
        return redirect ('/login');
    }

    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $email = $request->email;
        $user = User::where('email', $email)->first();
        $nama = $user->name;

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        Mail::to($email)->send(new forgetPasswordMail($email, $token, $nama));

        Alert::success('','Kami telah mengirim email untuk mengubah password anda');
        return redirect(route('login'));
    }

    public function showResetPasswordForm($token) { 
        return view('auth.resetPassword', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        // return $request;
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where([
                            'email' => $request->email, 
                            'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            Alert::error('error','Invalid Token!');
            return back()->withInput();
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        Alert::success('Berhasil','Password Anda berhasil diganti');
        return redirect(route('login'));
    }
}
