<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{

      protected $fillable = [
        'question','questionImage','questionCategory', ];

 protected $table = 'questionbank';


}
