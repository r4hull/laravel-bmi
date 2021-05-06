<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostQuestion extends Model
{

      protected $fillable = [
    'userId', 'questionId', 'actionKey', ];





    protected $table = 'postquestion';


}
