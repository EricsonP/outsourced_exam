<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $table = 'transactions';
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function library()
    {
        return $this->hasOne('App\Models\Library', 'library_id', 'id');
    }

    public function book()
    {
        return $this->hasOne('App\Models\Book', 'book_id', 'id');
    }
}
