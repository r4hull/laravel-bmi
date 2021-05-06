<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{

      protected $fillable = [
             'categoryId','subCategoryName','addedBy', ];
      protected $table = 'subcategory';

}
