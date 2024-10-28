<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showRegisterForm() {
        return view('users.auth.register');
    }

    public function registerButton() {
        return view('users.auth.login');
    }

    public function userRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[\pL\pN\s]+$/u',
            'name_kana' => 'required|string|max:255|regex:/^[ァ-ヶー]+$/u',
            'email' => 'required|string|email|max:255|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required|string|min:8|max:255|confirmed',
            'profile_image' => 'nullable|string|max:255',
            'grade_id' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'name_kana' => $request->name_kana,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        //return response()->json(['success' => true]);
        return redirect()->route('user.show.login')->with('success', 'ユーザー登録が完了しました。');
    }
    public function __construct() {
        $this->middleware('guest');
    }
}
