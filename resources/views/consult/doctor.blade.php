@extends('layouts.app')

@section('content')



<div class="card col-lg-12">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Add Product</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div>

					<div class="card-body">
                          <form method="post" action="/postDoctor" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            <div class="col-lg-2">
                              <label>Doctor Name</label>
                            <input type="text" name="doctorName" class="form-control" placeholder="">
                            </div>
                            <div class="col-lg-2">
                              <label>Doctor Position</label>
                            <input type="text" name="doctorPosition" class="form-control" placeholder="">
                            </div>
                            <div class="col-lg-2">
                              <label>Doctor Experience</label>
                            <input type="text" name="doctorExperience" class="form-control" placeholder="">
                            </div>
                            <div class="col-lg-2">
                              <label>Doctor Timing From</label>
                            <input type="time" name="doctorTimingFrom" class="form-control" placeholder="">
                            </div>
                            <div class="col-lg-2">
                              <label>Doctor Timing To</label>
                            <input type="time" name="doctorTimingTo" class="form-control" placeholder="">
                            </div>
                            <div class="col-lg-2">
                              <label>Doctor Fee</label>
                            <input type="text" name="doctorFee" class="form-control" placeholder="">
                            </div>
                            <div class="col-lg-2">
                              <label>Doctor Enquiry</label>
                            <input type="text" name="doctorEnquiryNumber" class="form-control" placeholder="">
                            </div>
                            <div class="col-lg-2">
                              <label>Doctor Image</label>
                            <input type="file" name="doctorImage" class="form-control" placeholder="">
                            </div>
                            <div class="col-lg-2">
                              <label>Doctor Rating</label>
                            <input type="number" name="doctorRating" class="form-control" placeholder="">
                            </div>
                            <div class="col-lg-2">
                              <label>Appoinment Date</label>
                            <input type="time" name="appoinmentDate" class="form-control" placeholder="">
                            </div>
                            <div class="col-lg-2">
                              <label>Appoinment Time</label>
                            <input type="time" name="appoinmentTime" class="form-control" placeholder="">
                            </div>
                            <div class="col-lg-12">
                              <label>About Doctor</label>
                            <textarea name="aboutDoctor" rows="5" cols="100%" class="form-control" placeholder="Write Something About doctor...">
                            </textarea>
                            </div>
                            <div class="col-lg-4">
                            <button type="submit" class="btn btn-primary" style="margin-top:28px;">Save</button>
                            </div>
                            </div>
                          </form>

                        </div>


                        <div class="content">
                         <h3>Doctors Details</h3>
                         <table style="width:100%;" id="doctorTable">
                           <thead>
                             <th>Doctor Image</th>
                             <th>Doctor Name</th>
                             <th>Doctor Position</th>
                             <th>Doctor Experience</th>
                             <th>Doctor Timing From</th>
                             <th>Doctor Timing To</th>
                             <th>Doctor Fee</th>
                             <th>Doctor Enquiry</th>
                             <th>Action</th>
                            </thead>
                            <tbody>
                            <tbody>
                              @foreach($doctor as $doctor)
                              <tr>
                                 <td> <img src="{{$doctor->doctorImage}}" height="40" width="40"></td>
                                 <td> {{$doctor->doctorName}} </td>
                                 <td> {{$doctor->doctorPosition}} </td>
                                 <td> {{$doctor->doctorExperience}} </td>
                                 <td> {{$doctor->doctorTimingFrom}} </td>
                                 <td> {{$doctor->doctorTimingTo}} </td>
                                 <td> {{$doctor->doctorFee }} </td>
                                 <td> {{$doctor->doctorEnquiryNumber}} </td>
                                 <td>
                                  <button class="btn btn-flat btn-success">Edit</button>
                                  <button class="btn btn-flat btn-danger">Delete</button>
                                 </td>
                              </tr>
                              @endforeach
                            </tbody>
                         </table>
                        </div>

                    </div>

                    <script>
                         $(document).ready(function() {
                         $('#doctorTable').DataTable();
                         });
                    </script>






@endsection
