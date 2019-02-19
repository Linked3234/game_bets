<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayVariable;

class PayVariableController extends Controller
{

    /**
     *  список способов оплаты
     */
    public function index()
    {

        return view('pay_variables.index', [
            'pay_variables' => PayVariable::all(),
        ]);

    }


    /**
     * новый способ
     */
    public function create()
    {

        return view('pay_variables.create');

    }


    /**
     * сохранение способа
     */
    public function store(Request $request)
    {

        $pay_variable = new PayVariable;
        $pay_variable->name = $request->name;
        $pay_variable->description = $request->description;
        $pay_variable->save();

        return redirect(route('pay_variables.index'));

    }


    /**
     * редактирование способа
     */
    public function edit($id)
    {

        $pay_variable = PayVariable::find($id);

        return view('pay_variables.edit', [
            'pay_variable' => $pay_variable,
        ]);

    }

    /**
     * сохранение изменений
     */
    public function update($id, Request $request)
    {

        PayVariable::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect(route('pay_variables.index'));

    }

    /**
     * удаление способа оплаты
     */
    public function destroy($id)
    {

        PayVariable::where('id', $id)->delete();

        return redirect(route('pay_variables.index'));

    }

}
