<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddCart extends Model
{

      protected $fillable = [
             'userId','categoryId','subCategoryId','productId','quantity','units','productPrice', ];

      protected $table = 'addcart';

}
