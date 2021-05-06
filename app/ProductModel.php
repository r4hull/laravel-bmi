<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{

      protected $fillable = [
             'categoryId','subCategoryId','productName','productPrice','productDiscount','ProductStatus','productImage','productSlideImage','description','noOfItem','quantity','units','benefit','info', ];

      protected $table = 'products';

}
