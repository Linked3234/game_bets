@extends('layouts.app')
@section('title', 'Параметры')
@section('header')
    Параметры
@endsection

@section('content')

    <form action="" method="POST">
        @csrf
        <div class="row">
            @foreach($params as $key => $value)
                <div class="col-4">
                    <label for="key[{{ $value->id}}"]>{{ $value->description }}</label>
                    <input type="text" name="key[{{ $value->id }}]" class="form-control" value="{{ $value->value }}" required>
                </div>
            @endforeach
            <div class="col-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success col-12">Сохранить</button>
            </div>
        </div>
    </form>

@endsection