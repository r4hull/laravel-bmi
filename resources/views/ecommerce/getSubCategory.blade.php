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
         <form method="post" action="/postSubCategory">
           @csrf
         <div class="row">
           <div class="col-lg-4">
             <select name="categoryId" class="form-control">
               <option>Choose Catgeory...</option>
               @foreach($category as $category)
               <option value={{$category->id}}>{{$category->categoryName}}</option>
               @endforeach
             </select>
           </div>
           <div class="col-lg-4">
             <input type="text" name="subCategoryName" class="form-control" placeholder="Sub-Category Name">
           </div>
           <div class="col-lg-4">
             <button type="submit" class="btn btn-primary">Save</button>
           </div>
         </div>
         </form>
         </div>


                        <br>
                        <div class="content">
                         <table style="width:100%;" id="subcategory">
                           <thead>
                             <th>Category Name</th>
                             <th>Sub-Category Name</th>
                             <th>Action</th>
                            </thead>
                            <tbody>
                              @foreach($subCategory as $key)
                              <tr>
                                <td> {{$key->categoryName}} </td>
                                <td> {{$key->subCategoryName}} </td>
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
</div>

<script>
     $(document).ready(function() {
     $('#subcategory').DataTable();
     } );
</script>





@endsection
