<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PasswordRestController extends Controller
{
    public function resetPassword()
    {
        return view('resetPassword.reset');
    }

    public function ChangingPassword(Request $request)
    {
        $request->validate([
            "password"=>"required|string|min:8|confirmed"
        ]);
        
        $user=User::findOrFail(auth()->user()->id);
        $user->password=bcrypt($request->password);
        $user->save();

        return redirect('dashboard')->with('success','لقد تم اعادة تعين كلمة المرور');
    }
}
