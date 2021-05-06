<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppoinmentModel extends Model
{

      protected $fillable = [
    'userId','patientId', 'doctorId', 'appoinmentDate', 'appoinmentTime',  ];





    protected $table = 'bookappoinment';


}
