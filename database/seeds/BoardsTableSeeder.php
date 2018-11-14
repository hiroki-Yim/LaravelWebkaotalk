<?php

use Illuminate\Database\Seeder;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Board::create([
        //     'author' => 'hongki',
        //     'title' => 'testseed',
        //     'content' => 'testgood',
        //연관배열 형태로 만들어서 뿌려줌
        //]);
        factory(App\Board::class, 30)->create(); // 몇개 만들지 정함 
    }
}
