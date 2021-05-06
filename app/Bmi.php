<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bmi extends Model
{

      protected $fillable = [
    'userId', 'userAge', 'userWeight', 'userHeight',  ];





    protected $table = 'bmi';


}
