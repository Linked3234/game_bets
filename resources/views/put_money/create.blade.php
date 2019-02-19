@extends('layouts.app')
@section('title', 'Новая заявка')
@section('header')
    <a href="{{ route('put_money.index') }}">Заявки на пополнение баланса</a> / Новая
@endsection

@section('content')
    <form action="{{ route('put_money.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-3">
                <label for="sum">Способ пополнения</label>
                <select name="put_variable_id" class="form-control" required>
                    @foreach($pay_variables as $key => $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-3">
                <label for="sum">Сумма</label>
                <input type="number" name="sum" min="1" class="form-control" required>
            </div>
            <div class="col-3">
                <label for="description">Дата пополнения</label>
                <input type="date" name="description" class="form-control" required>
            </div>
            <div class="col-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success col-12">Отправить</button>
            </div>
        </div>
    </form>
@endsection