<?php

use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parameters')->insert([
            [
                'name' => '1/2 sprint',
                'weight' => 1,
                'type' => 'time'
            ],
            [
                'name' => '1 sprint',
                'weight' => 2,
                'type' => 'time'
            ],
            [
                'name' => '2 sprint',
                'weight' => 3,
                'type' => 'time'
            ],
            [
                'name' => '3 sprint',
                'weight' => 4,
                'type' => 'time'
            ],
            [
                'name' => '4 sprint',
                'weight' => 8,
                'type' => 'time'
            ],
            [
                'name' => 'Acessível',
                'weight' => 1,
                'type' => 'knowledge'
            ],
            [
                'name' => 'Difícil',
                'weight' => 3,
                'type' => 'knowledge'
            ],
            [
                'name' => 'Raro',
                'weight' => 8,
                'type' => 'knowledge'
            ],
            [
                'name' => 'Baixo',
                'weight' => 1,
                'type' => 'priority'
            ],
            [
                'name' => 'Normal',
                'weight' => 2,
                'type' => 'priority'
            ],
            [
                'name' => 'Alto',
                'weight' => 5,
                'type' => 'priority'
            ],
            [
                'name' => 'Crítico',
                'weight' => 8,
                'type' => 'priority'
            ],
        ]);
    }
}
