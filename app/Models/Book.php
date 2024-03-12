<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Book extends Model
{
    use HasFactory;
    public $table = 'books';
    public $timestamps = true;
    protected $appends = ['status'];

    public function library()
    {
        return $this->belongsTo('App\Models\Library', 'library_id', 'id');
    }

    public function getStatusAttribute()
    {
        $book = Transaction::where('book_id', $this->id)->where('status', 'borrowed')->first();
        if($book){
            return 'borrowed';
        }
        return 'available';
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'book_id', 'id');
    }
}
