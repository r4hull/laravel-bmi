<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{

      protected $fillable = [
             'categoryName','addedBy',  ];
      protected $table = 'category';

}
