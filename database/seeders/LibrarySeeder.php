<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Library;
use App\Models\Book;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lib1 = new Library();
        $lib1->library_name = 'Library 1';
        $lib1->save();

        for($x=1; $x<=10; $x++){
            $book = new Book();
            $book->library_id = $lib1->id;
            $book->book_name = 'Book' . $x;
            $book->save();
        }
        
        $lib2 = new Library();
        $lib2->library_name = 'Library 2';
        $lib2->save();

        for($y=1; $y<=10; $y++){
            $book = new Book();
            $book->library_id = $lib2->id;
            $book->book_name = 'Book' . $y;
            $book->save();
        }
    }
}
