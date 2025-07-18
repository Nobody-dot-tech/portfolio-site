<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Validation\Rules\Password;
// use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    // use RegistersUsers;

    public function adminRegisterForm(Request $request)
    {
        return view('adminRegister');
    }

    protected function adminValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:App\Models\Admin'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'admin_level' => ['required', 'numeric'],
        ]);
    }

    protected function adminRegisterDatabase(array $data)
    {
        return Admin::create ([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Hash::make($data['password']),
            'admin_level' => $data['admin_level'],
        ]);
    }

    public function adminRegister(Request $request)
    {
        $this->adminValidator($request->all())->validate();

        $user = $this->adminRegisterDatabase($request->all());

        if ($user) {
            return view('adminRegister', ['registered' => true, 'registered_email' => $user->email]);
        }
    }
}
