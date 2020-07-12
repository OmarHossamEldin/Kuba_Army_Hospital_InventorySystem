<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Output;
use App\OutputDetail;
use App\stock_balance;
use App\activity;
use App\product;

class OutputController extends Controller
{
    public function create()
    {
        $lastOutput = Output::orderBy('id', 'desc')->get();
        $Products=product::all();
        return view('output.create')->with([
            'lastOutput'=>$lastOutput,
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
            $output=Output::create([
                'id'=>$request->id,
                'place'=>$request->place,
                'State'=>'تم',
                'notes'=>$request->notes
            ]);
            foreach($request->items as $item)
            {
                OutputDetail::create([
                    'output_id'=>$output->id,
                    'product_id'=>$item[0],
                    'quantity'=>$item[2]
                ]);
                $stock=stock_balance::where("product_id",$item[0])->first();
                $stock->quantity=$stock->quantity-$item[2];
                $stock->save();
            }
            activity::create([
                'user_id'=>auth()->user()->id,
                'action'=>'اضافة',
                'description'=>'تم اضافة صرف'
            ]);
            return $data=['success','تم إضافة صرف بنجاح'];
        }
        else{
            return $data=['error','برجاء ملء اليبانات للصرف'];
        }
    }

    public function index()
    {
        $date=date('Y-m-d', time());
        $outputs= Output::whereBetween('created_at', [$date." 00:00:00", $date." 23:59:59"])->orderBy('created_at','desc')->get();
        return view('output.index')->with('outputs',$outputs);
    }

    public function show(Output $output)
    {
        return view('output.show')->with('output',$output);
    }

    public function outputhistory($start,$end)
    {
        $Outputs= Output::whereBetween('created_at', [$start." 00:00:00", $end." 23:59:59"])->orderBy('created_at','desc')->get();
        if(count($Outputs)>0){
            foreach($Outputs as $Output){
                echo "<tr>
                    <td>$Output->id</td>
                    <td>$Output->place</td>
                    <td>".$Output->created_at->toFormattedDateString()."</td>
                    <td>$Output->State</td>
                    <td>$Output->notes</td>
                    <td><a href='\outputs/show/$Output->id'><i class='fas fa-2x fa-ellipsis-h'></i></a></td>
                </tr>";
           }
        }
        else{
            echo "<tr>
                <td>0</td>
                <td>لا توجد اي مصروفات في هذه الفتره</td>
                <td>لا توجد اي مصروفات في هذه الفتره</td>
                <td>لا توجد اي مصروفات في هذه الفتره</td>
                <td>لا توجد اي مصروفات في هذه الفتره</td>
                <td>لا توجد اي مصروفات في هذه الفتره</td>
            </tr>";
        }
    }

    public function delete(Output $output)
    {
        // then, loop over all input details
        foreach ($output->OutputDetails as $inpd) {
            // for each input detail, seach in the stock balances with the input
            // detail product id to minus the quantity
            $stock = stock_balance::where("product_id", $inpd->product_id)->first();
            $stock->quantity = $stock->quantity + $inpd->quantity;
            $stock->save();
            // delete input detail
            $inpd->delete();
        }
        // delete the input
        $output->delete();

        activity::create([
            'user_id'=>auth()->user()->id,
            'action'=>'حذف',
            'description'=>'تم حذف صرف'
        ]);
        return redirect('/outputs')->with('success','تم حذف صرف');
    }
}
