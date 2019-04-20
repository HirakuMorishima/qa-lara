@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
{{ Form::open(['url' => '/questions', 'method' => 'post']) }}
    <div class="form-group row">
    {{ Form::label('title', '質問名') }}
    {{ Form::text('title', $title, ['class' => 'form-control']) }}
    </div>
    <div class="form-group row">
        {{ Form::label('content', '詳細') }}
        {{ Form::textarea('content', $content, ['class' => 'form-control']) }}
    </div>
    {{ Form::close() }}
    </div>
    <div class="col-md-8">
    {{ Form::open(['url' => '/questions', 'method' => 'post']) }}
    質問一覧
    <table class="table">
        <tr>
            <th>質問者</th>
            <th>メッセージ</th>
            <th>状況</th>
        </tr>
    @if(isset($subscribes))
    @foreach($subscribes as $subscribe)
        <tr>
            <td>{{Form::radio('user_id', $subscribe->user->id)}} {{ $subscribe->user->name }}</td>
            <td>{{ $subscribe->message }}</td>
            <td>{{ $subscribe->getStatusName($subscribe->status) }}</td>
        </tr>
    @endforeach
    @endif
    </table>
    {{ Form::submit('決定', ['class' => 'btn btn-primary']) }}
    {{ Form::hidden('func', 2) }}
    {{ Form::close() }}
</div>
</div>
</div>
@endsection