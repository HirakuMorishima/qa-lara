<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscribe;
use App\Question;

class SubscribeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // 応募状況の表示
    public function index()
    {
        $query = Subscribe::query();
        $query->where('user_id', auth()->id());
        $subscribes = $query->get();
        return view('subscribes.index', compact('subscribes'));
    }
    // 応募画面
    public function show($id)
    {
        $question = Question::find($id);
        $query = Subscribe::query();
        $query->where('user_id',auth()->id());
        $query->where('question_id', $id);
        $query->where('status', 1);
        $data = $query->first();
        
        $question_id = $id;
        $user_id = auth()->id();
        if (isset($data)) {
            $message = $data->message;
        } else {
            $message = '';
        }
        return view('subscribes.show',compact('question','message','question_id', 'user_id'));
    }
    // 応募・納品
    public function store(Request $request)
    {
        $question = Question::find($request->question_id);
        $query = Subscribe::query();
        $query->where('user_id', $request->user_id);
        $query->where('question_id', $request->question);
        $query->where('status', $request->status);
        $data = $query->first();
        
        if(!isset($data)) {
            $data = new Subscribe();
            $data->user_id = $request->user_id;
            $data->question_id = $request->question_id;
            $data->status = $request->status;
        }
        $data->message = $request->message;
        $question_id = $data->question_id;
        $user_id = $data->user_id;
        $message = $data->message;
        if ($request->status == 1) {
            // 応募
            $data->save();
            return view('subscribes.store', compact('question','message','question_id', 'user_id'));
    } else if($request->status == 3) {
        // 納品
        $query = Subscribe::query();
        $query->where('question_id', $question_id);
        $query->where('user_id', $user_id);
        $query->where('status', 2);
        $subscribes = $query->first();
        if (isset($subscribes)) {
            // 決定する人が特定できた時
            $subscribes->status = 3;
            $subscribes->save();
        }
        return $this->index();
    }
}
}