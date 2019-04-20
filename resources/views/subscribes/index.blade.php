@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
            質問
            <table class="table">
                <tr>
                    <th>クライアント</th>
                    <th>案件名</th>
                    <th>状況</th>
                    <th>管理</th>
                </tr>
            @if(isset($subscribes))
            @foreach($subscribes as $subscribe)
                <tr>
                    <td>{{ $subscribe->question->user->name }}</td>
                    <td>{{ $subscribe->question->title }}</td>
                    <td>{{ $subscribe->status }}</td>
                    <td>
                        {{ Form::open(['url' => '/subscribes', 'method' => 'post']) }}
                        {{ Form::hidden('question_id', $subscribe->question->id) }}
                        {{ Form::hidden('user_id', $subscribe->user->id) }}
                        {{ Form::hidden('status', 3) }}
                        {{ Form::submit('納品', ['class' => 'btn btn-primary btn-sm']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            @endif
            </table>
        </div>
    </div>
</div>
@endsection