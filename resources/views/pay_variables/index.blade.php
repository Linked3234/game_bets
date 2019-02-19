@extends('layouts.app')
@section('title', 'Способы пополнения')
@section('header')
    Способы пополнения баланса
@endsection

@section('content')

    <a href="{{ route('pay_variables.create') }}">Добавить</a>
    <table class="table" border="0">
        <thead>
        <th>ID</th>
        <th>Название</th>
        <th>Описание</th>
        <th>Действия</th>
        </thead>
        <tbody>
        @foreach($pay_variables as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->description }}</td>
                <td>
                    <a href="{{ route('pay_variables.edit', ['id' => $value->id]) }}">Редактировать</a>
                    <form method="POST" action="{{ route('pay_variables.destroy', ['id' => $value->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-link" onclick="if(confirm('Подтвердите удаление')){return true;}else{return false;}">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection