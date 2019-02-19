<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{

    public function index()
    {

        return view('configs.index', [
            'params' => Config::all()
        ]);

    }


    /**
     * обновление параметров администратора
     */
    public function update(Request $request)
    {

        foreach($request->key as $key => $value)
        {

            Config::where('id', $key)->update([
                'value' => $value,
            ]);

        }

        return redirect(route('configs.index'));

    }

}
