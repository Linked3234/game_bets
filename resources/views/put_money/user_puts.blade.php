@extends('layouts.app')
@section('title', 'Заявки на пополнение баланса')
@section('header')
    Заявки на пополнение баланса
@endsection

@section('content')

    {{--<a href="{{ route('put_money.create') }}">Создать заявку</a>--}}
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
                <td class="order_id">{{ $value->id }}</td>
                <td>{{ date('d.m.Y H:i', $value->date) }}</td>
                <td>{{ $value->sum }}</td>
                <td>
                    {{ $value->status }}
                    @if($value->status == 'На проверке')
                        <br>
                        <button class="btn btn-link change_status_put_balance" data-toggle="modal" data-target="#change_put_money_user">
                            Сменить статус
                        </button>
                    @endif
                </td>
                <td>{{ $value->comment }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="modal fade" id="change_put_money_user" tabindex="-1" role="dialog" aria-labelledby="change_put_money_user" aria-hidden="true">
        <form method="POST" action="{{ route('put_money.change_status') }}">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="change_put_money_user_title">Смена статуса</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <select name="status" class="form-control">
                                <option value="Одобрено">Одобрено</option>
                                <option value="Отказано">Отказано</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label>Комментарий (необязательно)</label>
                            <textarea name="comment" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="order_id" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Применить</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection