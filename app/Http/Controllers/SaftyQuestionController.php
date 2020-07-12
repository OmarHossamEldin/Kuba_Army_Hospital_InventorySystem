<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SaftyQuestion;
use App\User;
use Illuminate\Support\Facades\Auth;

class SaftyQuestionController extends Controller
{
    public function create()
    {
        $question=[
            "ما هو رقم المنزل واسم الشارع الذي كنت تعيش فيه وانت طفل/طفله؟",
            "ما هي الأرقام الأربعة الأخيرة من رقم هاتف طفلك؟",
            "ما المدرسة الابتدائية التي التحقت بها؟",
            "في أي  مدينة كانت أول وظيفة لك؟",
            "في أي مدينة أو مدينة تسكن حاليا؟",
            "ما هو الاسم الأوسط لأكبر اطفالك؟",
            "ما هي آخر خمسة أرقام من رقم رخصة القيادة/ البطاقة الخاصة بك؟",
            "ما هو اسم جدتك (على جانب والدتك)؟",
            "في أي مدينة يعيش اقرب اصدقائك؟",
            "في أي ساعة من اليوم ولدت؟",
            "في أي وقت من ساعة ولد طفلك الأول؟"
        ];

        // get random index from array $questions
        $key = array_rand($question);
    
        $info=[
            "question"=>$question,
            "key"=>$key
        ];
        
        return view('safetyQuestion.create')->with($info);
    }

    public function store(Request $request)
    {
        $request->validate([
            'answer'=>'required|string|max:255',
            'key'=>'required'
        ]);
        if(count(auth()->user()->SaftyQuestion)>0)
        {
            foreach(auth()->user()->SaftyQuestion as $saftyQuestion)
            {
                $saftyQuestion->delete();
            }
        }
        SaftyQuestion::create([
            'user_id'=>auth()->user()->id,
            'key'=>$request->key,
            'answer'=>$request->answer
        ]);
        return redirect('dashboard')->with('success','لقد تم حفظ الاجابة بنجاح'); 
    }

    public function checkUserNameForm()
    {
        return view('safetyQuestion.usernameform');
    }

    public function checkUserName(Request $request)
    {
        $request->validate([
            'username'=>'required'
        ]);
        if($User=User::where('username',$request->username)->first())
        {
            if($Question=$User->first()->saftyquestion->first())
            {
                $question=[
                    "ما هو رقم المنزل واسم الشارع الذي كنت تعيش فيه وانت طفل/طفله؟",
                    "ما هي الأرقام الأربعة الأخيرة من رقم هاتف طفلك؟",
                    "ما المدرسة الابتدائية التي التحقت بها؟",
                    "في أي  مدينة كانت أول وظيفة لك؟",
                    "في أي مدينة أو مدينة تسكن حاليا؟",
                    "ما هو الاسم الأوسط لأكبر اطفالك؟",
                    "ما هي آخر خمسة أرقام من رقم رخصة القيادة/ البطاقة الخاصة بك؟",
                    "ما هو اسم جدتك (على جانب والدتك)؟",
                    "في أي مدينة يعيش اقرب اصدقائك؟",
                    "في أي ساعة من اليوم ولدت؟",
                    "في أي وقت من ساعة ولد طفلك الأول؟"
                ];
                $question=$questions[$Question->key];
                
                $info=[
                    'User'=>$User,
                    'question'=>$question
                ];

                return view('safetyQuestion.show')->with($info);
            }
        }
        else{
            return redirect()->back()->withInput($request->only('username'))->with('error','برجاء التاكد من اسم المستخدم');
        }  
    }
    public function checkTheAnswer(Request $request,User $User)
    {
        $request->validate([
            'answer'=>'required'
        ]);
        if($User->saftyquestion[0]->answer===$request->answer)
        {
            Auth::login($User);
            return redirect('\resetPassword')->with('success','تم تأكيد الاجابه برجاء تغير كلمه المرور'); 
        }
        else{
            return redirect('/')->with('error','اجابة خاطئة');
        }
    }

}
