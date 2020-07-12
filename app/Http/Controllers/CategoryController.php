<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\product;
use App\activity;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->level!=1){
            return redirect('/dashboard')->with('error','ليس لديك التصريح');
        }
        $categories= category::with('products')->orderBy('id','desc')->paginate(20);
        return view('categories.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->level!=1){
            return redirect('/dashboard')->with('error','ليس لديك التصريح');
        }
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationData=$request->validate([
            'Catename' =>'required'
        ]);

        category::create([
            'name'=>$request->Catename,
        ]);

        activity::create([
            'user_id'=>auth()->user()->id,
            'action'=>'إضافة',
            'description'=>'قسم جديد باسم '.$request->Catename
        ]);

        return redirect('\categories/create')->with('success','لقد تم إضافة قسم جديد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(auth()->user()->level!=1){
            return redirect('/dashboard')->with('error','ليس لديك التصريح');
        }
        $category=category::findOrFail($id);
        return view('categories.show')->with('category',$category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->level!=1){
            return redirect('/dashboard')->with('error','ليس لديك التصريح');
        }
        $category= category::findOrFail($id);
        return view('categories.edit')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validationData=$request->validate([
            'name' =>'required|unique:categories'
        ]);
        $category=category::findOrfail($id);
        $category->name=$request->name;
        $category->save();

        activity::create([
            'user_id'=>auth()->user()->id,
            'action'=>'تعديل',
            'description'=>'تعديل قسم باسم '.$request->name
        ]);

        return redirect('\categories/')->with('success','تم تعديل القسم');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->level!=1){
            return redirect('/dashboard')->with('error','ليس لديك التصريح');
        }
        $category =category::findOrFail($id);
        $count=0;
        foreach ($category->products as $product) {
            $count++;
        }
        if($count>0){
            return redirect()->back()->with('error','برجاء التاكد من ان القسم خالي من الأصناف لكي يتم حذفة');
        }
        else{
            $category->delete();

            activity::create([
                'user_id'=>auth()->user()->id,
                'action'=>'حذف',
                'description'=>'حذف قسم باسم '.$category->name
            ]);

            return redirect('\categories/')->with('success','تم حذف القسم');
        }
    }
}
