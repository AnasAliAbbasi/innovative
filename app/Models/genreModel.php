<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genreModel extends Model
{
    use HasFactory;

    public $table = 'genres';

    protected $fillable = ['file_id' , 'genre'];

}
