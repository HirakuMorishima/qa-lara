@extends('layouts.app')

@section('content')
<div class="container">
    応募
    <table class="table">
        <tr>
            <th>タイトル</th>
            <th>回答者</th>
        </tr>
        <tr>
            <td>{{ $question->title }}</td>
            <td>{{ $question->user->name }}</td>
        </tr>
    </table>
    <div class="row justify-content-center">
    <div class="col-md-8" style="height: 100px;">
        質問に回答しますか？<br>
    </div>
    <div class="col-md-8">
        {{ Form::open(['url' => '/subscribes', 'method' => 'post']) }}
            <div class="form-group row">
                {{ Form::label('message', '応募メッセージ') }}
                {{ Form::textarea('message', $message, ['class' => 'form-control']) }}
                {{ Form::hidden('question_id', $question_id) }}
                {{ Form::hidden('user_id', $user_id) }}
                {{ Form::hidden('status', 1) }}
            </div>
            <div class="form-group row">
                {{ Form::submit('応募', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
</div>
</div>
</div>
@endsection