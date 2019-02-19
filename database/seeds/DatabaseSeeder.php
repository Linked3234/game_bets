<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // администратор
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Администратор',
            'email' => 'ivanov@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'Администратор',
            'balance' => '500',
        ]);

        // несколько ботов
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Иванов13',
            'email' => 'ivanov13@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'Бот',
            'balance' => '999999',
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Петров13',
            'email' => 'petrov13@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'Бот',
            'balance' => '999999',
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Сидоров',
            'email' => 'sidorov@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'Бот',
            'balance' => '999999',
        ]);

        DB::table('users')->insert([
            'id' => 5,
            'name' => 'Жуков',
            'email' => 'gukov@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'Бот',
            'balance' => '999999',
        ]);


        // базовые параметры
        DB::table('configs')->insert([
            'id' => 1,
            'key' => 'time_interval',
            'value' => '120',
            'description' => 'Время до начала новой игры'
        ]);


        DB::table('configs')->insert([
            'id' => 2,
            'key' => 'time_bet',
            'value' => '60',
            'description' => 'Время для ставки'
        ]);


        DB::table('configs')->insert([
            'id' => 3,
            'key' => 'percent_win',
            'value' => '1',
            'description' => 'Процент от победы'
        ]);

        DB::table('configs')->insert([
            'id' => 4,
            'key' => 'time_step',
            'value' => '60',
            'description' => 'Время на ход игрока'
        ]);

        DB::table('configs')->insert([
            'id' => 5,
            'key' => 'price_entry',
            'value' => '0.5',
            'description' => 'Стоимость вступления в игру'
        ]);



    }
}
