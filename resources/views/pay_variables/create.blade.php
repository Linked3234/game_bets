@extends('layouts.app')
@section('title', 'Новый способ')
@section('header')
    <a href="{{ route('pay_variables.index') }}">Способы пополнения баланса</a> / Новый
@endsection

@section('content')
    <form action="{{ route('pay_variables.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <label for="name">Название</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-12">
                <label for="description">Описание</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="col-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success col-12">Добавить</button>
            </div>
        </div>
    </form>
@endsection