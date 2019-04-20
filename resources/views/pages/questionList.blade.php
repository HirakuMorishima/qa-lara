@extends('layouts.app')

@section('content')
<div class="container">
    質問一覧
    <table class="table">
        <tr>
            <th>タイトル</th>
            <th>質問者</th>
        </tr>
        
        @foreach($list as $question)
        <tr>
            <td><a href="/question/{{ $question->id }}">{{ $question->title }}</a></td>
            <td>{{ $question->user->name }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection