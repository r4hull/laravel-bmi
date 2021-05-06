@extends('layouts.app')

@section('content')




<div class="card col-lg-12">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">All Product List</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div>

<div class="alert alert-info bg-white alert-styled-left alert-arrow-left alert-dismissible">
         <button type="button" class="close" data-dismiss="alert"> </button>
                          <form method="post" action="/question" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                              <div class="col-lg-2">
                                <select class="form-control" name="questionCategory">
                                  <option>Select...</option>
                                  <option value="Normal">Normal</option>
                                  <option value="UnderWeight">UnderWeight</option>
                                  <option value="OverWeight">OverWeight</option>
                                  <option value="Obesity">Obesity</option>

                                </select>
                              </div>
                            <div class="col-lg-2">
                            <input type="text" name="question" class="form-control" placeholder="Category Name">
                            </div>
                            <div class="col-lg-2">
                            <input type="file" name="questionImage" class="form-control" required>
                            </div>
                            <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            </div>
                          </form>
                        </div>
                        <br>

                        <div class="content">
                         <table style="width:100%;" id="sbtTable">
                           <thead>
                             <th>Question Image</th>
                             <th>Category Name</th>
                             <th>Category</th>
                             <th>Action</th>
                            </thead>
                            <tbody>
                              @foreach($question as $question)
                              <tr>
                                <td><img src="{{$question->questionImage}}" height="40" width="40"></td>
                                <td> {{$question->question}} </td>
                                <td> {{$question->questionCategory}} </td>
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
                </div>
            </div>
        </div>
    </div>
</div>


<script>
     $(document).ready(function() {
     $('#sbtTable').DataTable();
     } );
</script>




@endsection
