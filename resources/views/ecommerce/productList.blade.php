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
          <table style="width:100%;" id="example">
            <thead>
              <th>Product Name</th>
              <th>Category Name</th>
              <th>Sub-Category Name</th>
              <th>Action</th>
             </thead>
             <tbody>
               @foreach($products as $products)
               <tr>
                 <td> {{$products->productName}} </td>
                 <td> {{$products->categoryName}} </td>
                 <td> {{$products->subCategoryName}} </td>
                 <td>
                   <button class="btn btn-flat btn-success">Edit</button>
                   <button class="btn btn-flat btn-danger">Delete</button>
                  </td>
               </tr>
               @endforeach
             </tbody>
          </table>

        </div>






<script>
     $(document).ready(function() {
     $('#example').DataTable();
     } );
</script>



@endsection
