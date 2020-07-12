<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\product;
use App\stock_balance;

class PageController extends Controller
{

    public function loginForm()
    {
        return view('login');
    }

    public function signin(Request $request)
    {
        $request->validate([
            "username"=>"required|string|max:255",
            "password"=>"required"
        ]);

        if (Auth::attempt(['username'=>$request->username,'password'=>$request->password]))
        {
            return redirect('dashboard')->with('success','لقد تم تسجيل الدخول بنجاح'); 
        }
        else{
            return redirect()->back()->withInput($request->only('username'))->with('error','برجاء التاكد من اسم المستخدم وكلمة المرور');
        }
    }
    public function dashboard()
    {
        $Products=product::all();
        $stockLimits=[];
        foreach ($Products as $Product) {
            $balance=stock_balance::where('product_id',$Product->id)->first();
            $balance->quantity <= $Product->limit ? array_push($stockLimits,['id'=>$Product->id,'name'=>$Product->name,'quantity'=>$balance->quantity]) : array_push($stockLimits,);
        }
        return view('dashboard')->with('stockLimits',$stockLimits);
    }

    public function signout()
    {
        Auth::logout();
        return redirect('/')->with('success','تم تسجيل الخروج بنجاح');
    }
    public function report()
    {
        return view('report');
    }
    
}
