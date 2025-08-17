<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $primaryKey='fav_no';
    protected $fillable=['user_fk','pr_fk'];
    //
}
