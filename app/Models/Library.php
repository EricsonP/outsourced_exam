<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;
    public $table = 'library';
    public $timestamps = true;

    public function books()
    {
        return $this->hasMany('App\Models\Book', 'library_id', 'id');
    }
}
