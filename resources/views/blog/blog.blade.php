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
                            <form method="post" action="/updateImage" enctype="multipart/form-data">
                              @csrf
                                 <div class="col-lg-4">
                                   <label>Update Image</label>
                                   <input type="file" name="blogImg" class="form-control">
                                   <br>
                                   <button type="submit" class="btn btn-primary">Save</button>
                                 </div>


                               </form>
                            </div>
                          <div class="row">
                            <div class="card">
                            <form method="post" action="/addPost" enctype="multipart/form-data">
                              @csrf
                                 <div class="col-lg-4">
                                   <label>Post Name</label>
                                   <input type="text" name="postName" class="form-control">
                                 </div>

                                 <div class="col-lg-12">
                                   <label>Post Description</label>
                                   <textarea type="text" cols="100%" rows="5" name="postDetail" class="form-control">
                                   </textarea>
                                 </div>
                                 <br>
                                 <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                                 </div>
                               </form>
                            </div>
                            </div>
                          </div>







@endsection
