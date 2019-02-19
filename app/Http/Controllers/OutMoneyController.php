<?php

namespace App\Http\Controllers;

use App\Models\OutMoney;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutMoneyController extends Controller
{

    /**
     * список заявок на вывод средств
     */
    public function index()
    {

        return view('out_money.index', [
            'out_moneys' => OutMoney::where('user_id', Auth::id())->orderBy('date', 'desc')->get(),
        ]);

    }


    /**
     * заявки пользователей
     */
    public function user_outs()
    {

        return view('out_money.user_outs', [
            'out_moneys' => OutMoney::orderBy('date', 'desc')->get(),
        ]);

    }


    /**
     * новая заявка на вывод средств
     */
    public function create()
    {

        return view('out_money.create');

    }


    /**
     * сохранение заявки
     */
    public function store(Request $request)
    {

        $put_money = new OutMoney;
        $put_money->user_id = Auth::id();
        $put_money->date = time();
        $put_money->sum = $request->sum;
        $put_money->description = $request->description;
        $put_money->save();

        return redirect(route('out_money.index'));

    }


    /**
     * списание средств с баланса (данные с формы)
     */
    public function change_status(Request $request)
    {

        // меняем статус заявки
        OutMoney::where('id', $request->order_id)->update([
            'status' => $request->status,
            'comment' => $request->comment,
        ]);

        // достаём заявку
        $order = OutMoney::find($request->order_id);

        // если статус был "одобрено", и текущий статус в базе - "на проверке" пополняем пользователю баланс на указанную сумму
        if($request->status == 'Одобрено')
        {

            $this->out_balance($order->user_id, $order->sum);

        }

        return redirect(route('out_money.user_outs'));

    }


    /**
     * снятие средств с баланса (обработчик)
     */
    public function out_balance($user_id, $sum)
    {

        $user = User::find($user_id);

        if(!empty($user))
        {

            $new_balance = $user->balance - $sum;

            User::where('id', $user_id)->update([
                'balance' => $new_balance,
            ]);

            return true;

        } else {

            return false;

        }

    }

}
