@extends('layouts.app')

@section('content')
<div class="container">
    質問詳細
    <table class="table">
        <tr>
            <th>タイトル</th>
            <th>質問者</th>
        </tr>
        <tr>
            <th>{{ $question->title }}</th>
            <th>{{ $question->user->name }}</th>
        </tr>
        <tr>
            <th colspan="2">質問内容</th>
        </tr>
        <tr>
            <th>{!! $question->content !!}</th>
        </tr>
    </table>
    <a href="{{ url('/subscribes', $question->id) }}" class="btn btn-primary btn-lg">回答</a>
</div>
@endsection