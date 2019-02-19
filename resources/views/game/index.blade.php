@extends('layouts.app')
@section('title', 'Текущая игра')
@section('header')
    Текущая игра
@endsection

@section('content')


    <div class="col-6 game-window">
        @if(!empty($date_begin) && !empty($date_interval) && !empty($game))

            Игра начнётся в: {{ date('H:i', $date_begin) }}
            <br>
            Идёт приём заявок.
            <br>
            @if($check_user_game === true)
                <form action="{{ route('game.join') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Вступить в игру</button>
                </form>
            @else

                <span>Вы уже в заявке на игру</span>

            @endif

        @else

            В данный момент приём заявок не происходит

        @endif
    </div>

@endsection