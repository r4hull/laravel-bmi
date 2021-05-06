@extends('layouts.app')

@section('content')




<div class="card col-lg-12">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Add FAQ</h5>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div>

					<div class="card-body">
                            <form method="post" action="/addFaq" enctype="multipart/form-data">
                              @csrf
                                 <div class="col-lg-4">
                                   <label>Faq Name</label>
                                   <input type="text" name="faqName" class="form-control">
                                 </div>

                                 <div class="col-lg-12">
                                   <label>Faq Description</label>
                                   <textarea type="text" cols="100%" rows="5" name="faqDetail" class="form-control">
                                   </textarea>
                                 </div>

                                 <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                                 </div>
                               </form>
                            </div>
                          </div>







@endsection
