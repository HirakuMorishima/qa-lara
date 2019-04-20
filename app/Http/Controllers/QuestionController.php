<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Carbon\Carbon;
use App\Subscribe;
use App\Portfolio;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = Question::where('user_id', '=' , auth()->id())->first();
        if (isset($data)) {
            $title = $data->title;
            $content = $data->content;
            
            $query = Subscribe::query();
            $query->where('question_id', $data->id);
            $subscribes = $query->get();
        } else {
            $title = "";
            $content = "";
            $subscribes = null;
        }
        return view('questions.index', compact('title', 'content', 'subscribes'));
    }
    public function store(Request $request)
    {
        $data = Question::where('user_id', '=', auth()->id())->first();
        if(!isset($data)) {
            $data = new Question();
        }
        // 新規追加
        $data->title = $request->title;
        $data->content = $request->content;
        $data->user_id = auth()->id();
        $data->wish_at = date_format(Carbon::now(), 'Y-m-d');
        if($request->func == 1) {
            // 質問登録
                $data->save();
        }else if ($request->func == 2) {
            // 回答者から決定
            $query = Subscribe::query();
            $query->where('question_id', $data->id);
            $query->where('status','<>',1);
            if ($query->count() == 0) {
                // 回答者だけの時は指定の人を決定とする
                $query = Subscribe::query();
                $query->where('question_id', $data->id);
                $query->where('user_id', $request->user_id);
                $query->where('status', 1);
                $subscribes = $query->first();
                if (isset($subscribes)) {
                    // 決定する人が特定できた時
                    $subscribes->status = 2;
                    $subscribes->save();
                }
            } else {
                // 回答があるか確かめる
                $query = Subscribe::query();
                $query->where('question_id', 'data->id');
                $query->where('user_id', $request->user_id);
                $query->where('status',3);
                if ($query->count() == 1) {
                    // 納品がある
                    $subscribes = $query->first();
                    if (isset($subscribes)) {
                        // 決定する人が特定できた時
                        $subscribes->status = 4;
                        $subscribes->save();
                        // ポートフォリオに入れる
                        $portfolio = new Portfolio();
                        $portfolio->user_id = $request->user_id;
                        $question = Question::find($data->id);
                        $portfolio->title = $question->title;
                        $portfolio->content = '';
                        $portfolio->save();
                    }
                }
            }
        }

        return $this->index();
    }

}