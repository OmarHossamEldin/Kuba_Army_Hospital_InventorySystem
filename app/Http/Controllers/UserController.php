<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\activity;

class UserController extends Controller
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
        $users=User::orderBy('id','desc')->paginate(10);
        return view("users.index")->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'level' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'level' => $request->level
        ]);

        activity::create([
            'user_id'=>auth()->user()->id,
            'action'=>'إضافة',
            'description'=>$request->username.' إضافة مستخدم جديد  باسم'
        ]);
        return redirect('\users')->with('success','لقد تم انشاء المستخدم');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::findOrFail($id);
        return view('users.show')->with('user',$user);
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
        $user=User::findOrFail($id);
        return view('users.edit')->with('user',$user);
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
        if(auth()->user()->level!=1){
            return redirect('/dashboard')->with('error','ليس لديك التصريح');
        }
        $request->validate([
            'id' =>['required'],
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'level' => ['required', 'numeric', 'min:1','max:3',]
        ]);
        $user=User::findOrFail($request->id);
        $user->name=$request->name;
        $user->username=$request->username;
        $user->password=bcrypt($request->password);
        $user->level=$request->level;
        $user->save();

        activity::create([
            'user_id'=>auth()->user()->id,
            'action'=>'تعديل',
            'description'=>$request->username.' تعديل مستخدم باسم'
        ]);
        return redirect('\users')->with('success','لقد تم تعديل بيانات المستخدم');
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
        $user=User::findOrFail($id);
        if($user->activities->count()>0){
            foreach($user->activities as $activity)
            {
                $activity->delete();
            }
            activity::create([
                'user_id'=>auth()->user()->id,
                'action'=>'حذف',
                'description'=>$user->username.' حذف مستخدم باسم'
            ]);
            $user->delete();
            return redirect('/users')->with('success','تم حذف المستخدم');
        }
        activity::create([
            'user_id'=>auth()->user()->id,
            'action'=>'حذف',
            'description'=>$user->username.' حذف مستخدم باسم'
        ]);
        $user->delete();
        return redirect('/users')->with('success','تم حذف المستخدم');
    }

    public function user_activites_view(){
        return view('users.userActivities');
    }
    public function usernames(Request $request){
        $users=User::where('username','LIKE', '%' . $request->username. '%')->get();
        $names 	=[];
		if (count($users)>0)
		{
			foreach($users as $user)
			{
				array_push($names,$user->username);
            }
		}
		else
		{
			array_push($names,'Not Found');
		}
        return response()->json($names);
    }
    public function user_activites(Request $request){

        if(empty(trim($request->username))){
            $results = activity::whereBetween('created_at', [$request->start." 00:00:00", $request->end." 23:59:59"])->get(); // to get betwwen two dates
            if($results->count()>0){
                foreach($results as $result){

                    echo"<tr>
                            <td>".$result->user->name."<br>".$result->created_at->format('d M Y')."</td>
                            <td>
                                <div class='activityDetail'>
                                    <span class='timeCont'>".$result->created_at->diffForHumans()."</span>
                                    <span class='activityCont'>".$result->description."</span>
                                </div>
                            </td>
                        </tr>";
                }
            }
            else{
                echo"<tr>
                        <td col='2'>لا توجد اي انشطة مسجله علي السيستم</td>
                </tr>";
            }

        }
        else{
            $user = User::where('username',$request->username)->first(); // to get betwwen two dates
            $activeites=activity::where('user_id',$user->id)->whereBetween('created_at', [$request->start." 00:00:00", $request->end." 23:59:59"])->get();
            if($activeites->count()>0){
                foreach($activeites as $result){
                    echo"<tr>
                            <td>".$user->name."<br>".$result->created_at->format('d M Y')."</td>
                            <td>
                                <div class='activityDetail'>
                                    <span class='timeCont'>".$result->created_at->diffForHumans()."</span>
                                    <span class='activityCont'>".$result->description."</span>
                                </div>
                            </td>
                        </tr>";
                }
            }
            else{
                echo"<tr>
                    <td col='2'>لا توجد اي انشطة مسجله علي السيستم</td>
                </tr>";
            }

        }
    }
}
