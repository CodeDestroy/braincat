@extends('layouts.app')

@section('content')
<div>Спасибо за регистрацию</div>
<p>Последний шаг. Подтвердите свою учётную запись по ссылке из письма, отправленного на вашу электронную почту.</p>
<form method="POST" action="{{route('verification.send')}}">
<button type="submit">Отправить заного</button>
</form>
@endsection
