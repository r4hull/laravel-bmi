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
                         <table style="width:100%;" id="categorytable">
                           <thead>
                             <th>Category Name</th>
                             <th>Action</th>
                            </thead>
                            <tbody>
                              @foreach($category as $category)
                              <tr>
                                <td> {{$category->categoryName}} </td>
                                <td>
                                  <a href="button" class="btn btn-outline bg-success text-success border-success">Edit</a>
                                  <a href="button" class="btn btn-outline bg-danger text-danger border-danger">Delete</a>

                                 </td>
                              </tr>
                              @endforeach
                            </tbody>
                         </table>



<script>
     $(document).ready(function() {
     $('#categorytable').DataTable();
     } );
</script>




@endsection
