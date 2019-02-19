<?php

namespace App\Http\Controllers;

use App\Models\PayVariable;
use App\Models\PutMoney;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PutMoneyController extends Controller
{

    /**
     * список заявок на пополнение баланса
     */
    public function index()
    {

        return view('put_money.index', [
            'put_moneys' => PutMoney::where('user_id', Auth::id())->orderBy('date', 'desc')->get(),
        ]);

    }


    /**
     * заявки пользователей
     */
    public function user_puts()
    {

        return view('put_money.user_puts', [
            'put_moneys' => PutMoney::orderBy('date', 'desc')->get(),
        ]);

    }


    /**
     * новая заявка на пополнение баланса
     */
    public function create()
    {

        return view('put_money.create', [
            'pay_variables' => PayVariable::all(),
        ]);

    }


    /**
     * сохранение заявки
     */
    public function store(Request $request)
    {

        $put_money = new PutMoney;
        $put_money->user_id = Auth::id();
        $put_money->put_variable_id = $request->put_variable_id;
        $put_money->date = time();
        $put_money->sum = $request->sum;
        $put_money->description = $request->description;
        $put_money->save();

        return redirect(route('put_money.index'));

    }


    /**
     * пополнение баланса (данные с формы)
     */
    public function change_status(Request $request)
    {

        // меняем статус заявки
        PutMoney::where('id', $request->order_id)->update([
            'status' => $request->status,
            'comment' => $request->comment,
        ]);

        // достаём заявку
        $order = PutMoney::find($request->order_id);

        // если статус был "одобрено", и текущий статус в базе - "на проверке" пополняем пользователю баланс на указанную сумму
        if($request->status == 'Одобрено')
        {

            $this->put_balance($order->user_id, $order->sum);

        }

        return redirect(route('put_money.user_puts'));

    }


    /**
     * пополнение баланса (обработчик)
     */
    public function put_balance($user_id, $sum)
    {

        $user = User::find($user_id);

        if(!empty($user))
        {

            $new_balance = $user->balance + $sum;

            User::where('id', $user_id)->update([
                'balance' => $new_balance,
            ]);

            return true;

        } else {

            return false;

        }

    }

}
