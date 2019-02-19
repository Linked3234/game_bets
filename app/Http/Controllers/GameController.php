<?php

namespace App\Http\Controllers;

use App\Game;
use App\Models\Claim;
use App\Models\Config;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

    /**
     * вывод информации по текущей игре
     */
    public function index()
    {

        // если есть игры с открытыми заявками, проверяем не истекло ли время. Если истекло - начинаем игру
        $this->check_orders();

        // текущая игра
        $game = Game::where('winner_id', '0')
            ->where('beginning', 0)
            ->where('successed', 0)
            ->first();

        if (!empty($game))
        {
            // время до начала игры
            $date_begin = $game->date_begin + Config::where('key', 'time_interval')->first()->value;

            // кол-во секунд до начала игры
            $date_interval = time() - $date_begin;
        } else {

            $date_begin = 0;
            $date_interval = 0;

        }
        
        // проверяем, состоит ли пользователь уже в текущей игре
        $check_user_game = $this->check_user_game();

        return view('game.index', [
            'game' => $game,
            'date_begin' => $date_begin,
            'date_interval' => $date_interval,
            'check_user_game' => $check_user_game,
        ]);

    }


    /**
     * проверяем, состоит ли пользователь в текущей игре
     */
    public function check_user_game()
    {

        $game = Game::where('beginning', 0)
            ->first();

        if(empty($game))
        {

            return false;

        } else {

            $claim = Claim::where('user_id', Auth::id())
                ->where('game_id', $game->id)
                ->first();

            if(empty($claim))
            {

                return true;

            } else {

                return false;

            }

        }
        
    }


    /**
     * проверяем есть ли открытые заявки.
     * Если есть и время истекло - то меняем параметр beginning = 1
     * Проверяем, сколько игроков в игре. Если 1 - подключаем бота.
     * Если игроков нет - вступают боты
     */
    public function check_orders()
    {

        $game = Game::where('beginning', 0)
            ->first();

        if(!empty($game))
        {

            $current_time = time();
            $begin_time = $game->date_begin;

            if($current_time >= $begin_time)
            {

                Game::where('id', $game->id)->update([
                    'beginning' => 1,
                ]);

                // проверяем заявки
                $claims = Claim::where('game_id', $game->id)->count();
echo $claims;
                // если игроков нет - подключаем ботов
                if($claims === 0)
                {

                    $this->claim_get_bots($game->id, 2);

                } elseif($claims === 1)
                {

                    $this->claim_get_bots($game->id, 1);

                }

            }


        }

    }


    /**
     * подключает ботов к игре
     * args: game id, count bots
     */
    public function claim_get_bots($game_id, $count_bots):void
    {

        $bots = User::where('role', 'Бот')
            ->inRandomOrder()
            ->limit($count_bots)
            ->get();

        foreach($bots as $key => $value)
        {

            $claim = new Claim;
            $claim->game_id = $game_id;
            $claim->user_id = $value->id;
            $claim->date = time();
            $claim->save();

        }

    }



    /**
     * определение начала новой игры
     * - если у всех игр определён winner_id (все игры были завершены) - начинаем отсчёт до начала новой игры
     */
    public function check_start():void
    {

        $game = Game::where('successed', '0')
            ->first();

        if(empty($game))
        {

            $current_time = time();
            $time_interval = Config::where('key', 'time_interval')->first()->value;
            $date_begin = $current_time + $time_interval;

            $game = new Game;
            $game->created = time();
            $game->date_begin = $date_begin;
            $game->save();
        }

    }
    
    
    /**
     * вступление игрока в игру
     */
    public function join_game()
    {

        // вызываем метод check_start, который закроет заявки где игра уже должна идти, и кидаем в заявку игрока (если есть незакрытая заявка)
        $this->check_start();

        $game = Game::where('beginning', 0)->first();

        if(!empty($game))
        {

            // проверяем, вступал ли уже пользователь в эту игру
            $claim_check = Claim::where('game_id', $game->id)
                ->where('user_id', Auth::id())->first();

            if(empty($claim_check))
            {

                $claim = new Claim;
                $claim->game_id = $game->id;
                $claim->user_id = Auth::id();
                $claim->date = time();
                $claim->save();

            }

        }

        return redirect(route('game.index'));
        
    }



}
