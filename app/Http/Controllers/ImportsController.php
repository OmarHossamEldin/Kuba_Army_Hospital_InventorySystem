<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Input;
use App\InputDetail;
use App\stock_balance;
use App\activity;
use App\product;

class ImportsController extends Controller
{
    public function create()
    {
        $lastinput=input::orderBy('id', 'desc')->get();
        $Products=product::all();        
        return view('imports.create')->with([
            'lastinput'=>$lastinput,
            'Products'=>$Products
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id"=>'required',
			"items"=>'required|array|min:1'
        ]);

        if ($validator->passes())
        {
            $input=Input::create([
                'id'=>$request->id,
                'orgin_number'=>$request->oraginNumber,
                'State'=>'إدخال',
                'notes'=>$request->notes
            ]);
            foreach($request->items as $item)
            {
                InputDetail::create([
                    'input_id'=>$input->id,
                    'product_id'=>$item[0],
                    'quantity'=>$item[2]
                ]);
                $stock=stock_balance::where("product_id",$item[0])->first();
                $stock->quantity=$stock->quantity+$item[2];
                $stock->save();
            }
            activity::create([
                'user_id'=>auth()->user()->id,
                'action'=>'اضافة',
                'description'=>'تم اضافة ادخال'
            ]);
            return $data=['success','تم إضافة ادخال بنجاح'];
        }
        else{
            return $data=['error','برجاء ملء الأصناف للإدخال'];
        }
    }

    public function index()
    {
        $date=date('Y-m-d', time());
        $inputs= Input::whereBetween('created_at', [$date." 00:00:00", $date." 23:59:59"])->orderBy('created_at','desc')->get();
        return view('imports.index')->with('inputs',$inputs);
    }

    public function show(Input $import)
    {
        return view('imports.show')->with('import',$import);
    }

    public function inputhistory($start,$end)
    {
        $inputs= Input::whereBetween('created_at', [$start." 00:00:00", $end." 23:59:59"])->orderBy('created_at','desc')->get();
        if(count($inputs)>0){
            foreach($inputs as $input){
                echo "<tr>
                    <td>$input->id</td>
                    <td>$input->orgin_number</td>
                    <td>".$input->created_at->toFormattedDateString()."</td>
                    <td>$input->State</td>
                    <td>$input->notes</td>
                    <td><a href='\imports/show/$input->id'><i class='fas fa-2x fa-ellipsis-h'></i></a></td>
                </tr>";
           }
        }
        else{
            echo "<tr>
                <td>0</td>
                <td>لا توجد اي توريدات في هذه الفتره</td>
                <td>لا توجد اي توريدات في هذه الفتره</td>
                <td>لا توجد اي توريدات في هذه الفتره</td>
                <td>لا توجد اي توريدات في هذه الفتره</td>
                <td>لا توجد اي توريدات في هذه الفتره</td>
            </tr>";
        }
    }
    public function delete(Input $import)
    {
        // then, loop over all input details
        foreach ($import->inputDetails as $inpd) {
            // for each input detail, seach in the stock balances with the input
            // detail product id to minus the quantity
            $stock = stock_balance::where("product_id", $inpd->product_id)->first();
            $stock->quantity = $stock->quantity - $inpd->quantity;
            $stock->save();
            // delete input detail
            $inpd->delete();
        }
        // delete the input
        $import->delete();

        activity::create([
            'user_id'=>auth()->user()->id,
            'action'=>'حذف',
            'description'=>'تم حذف توريد'
        ]);
        return redirect('/imports')->with('success','تم حذف ادخال');
    }
}
