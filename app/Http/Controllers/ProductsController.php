<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use App\category;
use App\stock_balance;
use App\activity;

class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=product::orderBy('created_at','desc')->paginate(100);
        $Total=stock_balance::sum('quantity');
        return view('products.index')->with(['products'=>$products,'Total'=>$Total]);
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
        $barcode = mt_rand(100000, 999999)+1;
        $categories=category::all();
        $info=array(
            'barcode'=>$barcode,
            'categories'=>$categories,
        );
        return view('products.create')->with($info);
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
            'id'=>'required|numeric|unique:products',
            'name'=>'required',
            'category'=>'required|numeric',
            'limit'=>'required|numeric'
        ]);

        product::create([
            'id'            =>$request->id,
            'name'          =>$request->name,
            'category_id'   =>$request->category,
            'limit'         =>$request->limit,
            'notes'         =>$request->notes
        ]);

        stock_balance::create([
            'product_id'=>$request->id,
            'quantity'  =>0
        ]);

        activity::create([
            'user_id'=>auth()->user()->id,
            'action'=>'إضافة',
            'description'=>'إضافة صنف جديد بتسلسل '.$request->id
        ]);

        return redirect('\products/create')->with('success','تم إضافة صنف جديد');
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
        $product=product::findOrFail($id);
        return view('products.show')->with('product',$product);
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
        $product= product::findOrFail($id);
        $categories=category::all();

        $info =array(
            'product'=> $product,
            'categories'=>$categories,
        );

        return view('products.edit')->with($info);
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
            'category'=>'required|numeric',
            'limit'=>'required|numeric',
            'Quantity'=>'required|numeric'
        ]);

        $product =product::findOrFail($id);
        $product->category_id=$request->category;
        $product->limit=$request->limit;
        $product->notes=$request->notes;
        $product->save();

        $stock= stock_balance::select('id')->where('product_id',$request->barcode)->first();
        $product=stock_balance::findOrFail($stock->id);
        $product->quantity=$request->Quantity;
        $product->save();

        activity::create([
            'user_id'=>auth()->user()->id,
            'action'=>'تعديل',
            'description'=>'تعديل صنف بتسلسل '.$id
        ]);

        return redirect('\products/')->with('success','تم تعديل الصنف');
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
            return redirect()->back()->with('error','ليس لديك التصريح');
        }
    }

    public function item(Request $request)
    {
        $products=product::where('name','LIKE', '%' . $request->itemname. '%')->get();
        $names 	=[];
		if (count($products)>0)
		{
			foreach($products as $product)
			{
				array_push($names,$product->name);
            }
		}
		else
		{
			array_push($names,'Not Found');
		}
        return response()->json($names);
    }

    public function itemselection(Request $request)
    {
        $input = $request->item;
        if(is_numeric($input)){
            // return **TRUE** if it is numeric
            $product= product::findOrFail($input);
            return response()->json(['0'=>'success','1'=>"<tr>
                                                            <td>".$product->id."</td>
                                                            <td>".$product->name."</td>
                                                            <td>".$product->category->name."</td>
                                                            <td>".$product->tradeMark->name."</td>
                                                            <td>".$product->stock->quantity."</td>
                                                            <td><a href='\products/".$product->id."'><i class='fas fa-2x fa-ellipsis-h'></i></a></td>
                                                        </tr>"]);
        }
        elseif(is_string($input)){
            // return **TRUE** if it is string
            $product=product::where('name',$input)->first();
            return response()->json(['0'=>'success','1'=>"<tr>
                                                            <td>".$product->id."</td>
                                                            <td>".$product->name."</td>
                                                            <td>".$product->category->name."</td>
                                                            <td>".$product->tradeMark->name."</td>
                                                            <td>".$product->stock->quantity."</td>
                                                            <td><a href='\products/".$product->id."'><i class='fas fa-2x fa-ellipsis-h'></i></a></td>
                                                        </tr>"]);
        }
        else{
            return response()->json(['0'=>'error','1'=>"برجاء إدخال التسلسل او اسم الصنف"]);
        }
    }

    public function itemid(Request $request)
    {
        $products=product::where('name', $request->itemname)->first();

        return response()->json($products);
    }
    public function iteminfo(Request $request)
    {
        $product=product::findOrFail($request->itemid);
        return response()->json([$product,$product->stock]);
    }
}
