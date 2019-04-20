<!-- メッセージを送信するフォーム -->
{{ Form::open(['url' => '/send', 'method' => 'post']) }}
    {{ Form::label('to', '宛先') }}
    {{ Form::select('to', $users) }}
    <br>
    {{ Form::label('title', 'タイトル') }}
    {{ Form::text('title') }}
    <br>
    {{ Form::label('body', '本文') }}
    {{ Form::textarea('body') }}
    <br>
    {{ Form::submit('送信') }}
{{ Form::close() }}

受信メッセージ
<table>
    <tr>
        <th>タイトル</th>
        <th>送信者</th>
    </tr>
@foreach($messagesToUser as $message)
    <tr>
        <td>{{ $message->title }}</td>
        <td>{{ $message->fromUser->name }}</td>
    </tr>
@endforeach
</table>
<br><br>

送信済みメッセージ
<table>
    <tr>
        <th>タイトル</th>
        <th>宛先</th>
    </tr>
@foreach($messagesFromUser as $message)
    <tr>
        <td>{{ $message->title }}</td>
        <td>{{ $message->toUser->name }}</td>
    </tr>
@endforeach
</table>