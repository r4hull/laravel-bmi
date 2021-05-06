<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{

      protected $fillable = [
    'doctorName','doctorPosition','doctorExperience','doctorImage','doctorRating','doctorTimingFrom','doctorTimingTo','doctorFee','aboutDoctor','doctorEnquiryNumber','appoinmentDate','appoinmentTime', ];

   protected $table = 'doctordetail';


}
