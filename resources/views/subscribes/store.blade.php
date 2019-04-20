@extends('layouts.app')

@section('content')
<div class="container">
    応募
    <table class="table">
        <tr>
            <th>タイトル</th>
            <th>クライアント</th>
        </tr>
        <tr>
            <td>{{ $question->title }}</td>
            <td>{{ $question->user->name }}</td>
        </tr>
    </table>
<div class="row justify-content-center">
<div class="col-md-8" style="height: 100px;">
質問の回答に完了しました。質問者から連絡があるまでお待ちください。
<a href="{{ url('/subscribes') }}" class="btn btn-primary">質問状況</a>
</div>
<div class="col-md-8">
    回答メッセージ
</div>
<div class="col-md-8">{{ $message }}</div>
</div>
</div>
</div>
@endsection