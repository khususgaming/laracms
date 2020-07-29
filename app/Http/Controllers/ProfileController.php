<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.profile');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'passwordlama' => 'required'
        ]);
        if(! empty($request->get('passwordlama'))) {
            if(Hash::check($request->get('passwordlama'), Auth::user()->password)) {
                $user = User::find($id);
                $status = '';
                if(! empty($request->get('nama'))) {
                    $bool = 1;
                    $user->name =  $request->get('nama');
                    $status .= '<li>Nama anda berhasil di ubah.</li>';
                }
                if(! empty($request->get('email'))) {
                    $bool = 1;
                    $user->email =  $request->get('email');
                    $status .= '<li>Email anda berhasil di ubah.</li>';
                }
                if(! empty($request->get('passwordbaru'))) {
                    if(! empty($request->get('ulangipasswordbaru'))) {
                        if($request->get('passwordbaru') == $request->get('ulangipasswordbaru')) {
                            $bool = 1;
                            $user->password = Hash::make($request->get('passwordbaru'));
                            $status .= '<li>Password anda berhasil di ubah.</li>';
                        } else {
                            $bool = 0;
                            $status = '<li>Password Baru dengan Ulangi Password Baru anda tidak sama.</li>';
                        }
                    } else {
                        $bool = 0;
                        $status = '<li>Ulangi Password Baru anda kosong.</li>';
                    }
                }
                $user->save();
            } else {
                $bool = 0;
                $status = 'Password lama anda salah.';
            }
        } else {
            $bool = 0;
            $status = 'Password lama anda kosong';
        }
        return redirect()
            ->route('profile.index')
            ->with('bool', $bool)
            ->with('status', $status);
    }
}
