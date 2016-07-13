<?php

namespace App;
use App\Author;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
}
