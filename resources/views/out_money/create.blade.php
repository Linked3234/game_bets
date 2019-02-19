@extends('layouts.app')
@section('title', 'Новая заявка')
@section('header')
    <a href="{{ route('out_money.index') }}">Заявки на снятие средств</a> / Новая
@endsection

@section('content')
    <form action="{{ route('out_money.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <label for="description">Способ вывода</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>
            <div class="col-4">
                <label for="sum">Сумма</label>
                <input type="number" name="sum" min="1" class="form-control" required>
            </div>
            <div class="col-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success col-12">Отправить</button>
            </div>
        </div>
    </form>
@endsection