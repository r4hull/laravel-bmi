<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    
      protected $fillable = [
   'companyId','accountName','initialBalance','accountNumber','branchCode','branchName',   ];
 
    
    


    protected $table = 'accountlist';


}
