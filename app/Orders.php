<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

      protected $fillable = [
             'userId', 'cartId','categoryId','productId','address', 'pinCode', 'city', ];

      protected $table = 'orders';

}
