<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }
    
    public function message()
    {
        // 送信時宛先リスト
        $users = User::all()->pluck('name', 'id');
        // 送信済みメッセージ
        $messagesFromUser = User::find(auth()->id())->messagesFromUser;
        // 自分宛の受信メッセージを全て取得
        $messagesToUser = User::find(auth()->id())->messagesToUser;
        return view('message', compact('users','messagesFromUser', 'messagesToUser'));
    }
    
    public function send(Request $request)
    {
        // メッセージ送信
        $message = new Message();
        $message->title = $request->title;
        $message->body = $request->body;
        $message->to_user_id = $request->to;
        $message->from_user_id = auth()->id();
        $message->save();
    
        // 送信時宛先リスト
        $users = User::all()->pluck('name','id');
        // 送信済みメッセージ
        $messagesFromUser = User::find(auth()->id())->messagesFromUser;
        // 自分宛の受信メッセージを全て取得
        $messagesToUser = User::find(auth()->id())->messagesToUser;
        
        return view('message', compact('users', 'messagesFromUser', 'messagesToUser'));
    }
}
