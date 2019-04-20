<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

class PageController extends Controller
{
    // 質問一覧
    public function list()
    {
        $list = Question::all();
        return view('pages.questionList', compact('list'));
    }
    // 案件詳細
    public function show($id)
    {
        $question = Question::find($id);
        // 改行の置き換え
        $question->content = str_replace("\r\n", '<br>', $question->content);
        return view('pages.question', compact('question'));
    }
}
