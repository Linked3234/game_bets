@extends('layouts.app')
@section('title', 'Заявки на пополнение баланса')
@section('header')
    Заявки на пополнение баланса
@endsection

@section('content')

    <a href="{{ route('put_money.create') }}">Создать заявку</a>
    <table class="table" border="0">
        <thead>
        <th>ID</th>
        <th>Дата</th>
        <th>Сумма</th>
        <th>Статус</th>
        <th>Комментарий</th>
        </thead>
        <tbody>
            @foreach($put_moneys as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ date('d.m.Y H:i', $value->date) }}</td>
                    <td>{{ $value->sum }}</td>
                    <td>{{ $value->status }}</td>
                    <td>{{ $value->comment }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection