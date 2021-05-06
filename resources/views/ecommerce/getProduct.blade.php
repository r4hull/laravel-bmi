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
						<form method="post" action="/postProduct" enctype="multipart/form-data">
              @csrf
							<div class="row">
								<div class="col-md-6">
									<fieldset>
										<legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Product details</legend>

										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Enter Product Name:</label>
											<div class="col-lg-9">
												<input type="text" name="productName" class="form-control" placeholder="...">
											</div>
										</div>

										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Choose Category</label>
											<div class="col-lg-9">
                        <select name="categoryId" class="form-control">
                          @foreach($category as $category)
                          <option value="{{$category->id}}">{{$category->categoryName}}</option>
                          @endforeach
                        </select>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Choose Sub Category</label>
											<div class="col-lg-9">
                        <select name="categoryId" class="form-control">

                        </select>
                      </div>

										</div>

                    <div class="form-group row">
											<label class="col-lg-3 col-form-label">Enter Product Price:</label>
											<div class="col-lg-9">
												<input type="text" name="productPrice" class="form-control" placeholder="...">
											</div>
										</div>

                    <div class="form-group row">
											<label class="col-lg-3 col-form-label">Enter Price Discount:</label>
											<div class="col-lg-9">
												<input type="text" name="productDiscount" class="form-control" placeholder="...">
											</div>
										</div>

										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Attach screenshot:</label>
											<div class="col-lg-9">
												<div class="uniform-uploader"><input type="file" name="productImage" class="form-input-styled" data-fouc=""><span class="filename" style="user-select: none;">No file selected</span><span class="action btn bg-pink-400" style="user-select: none;">Choose File</span></div>
											</div>
										</div>


									</fieldset>
								</div>

								<div class="col-md-6">
									<fieldset>
					                	<legend class="font-weight-semibold"><i class="icon-truck mr-2"></i> More Details</legend>

										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Value:</label>
											<div class="col-lg-9">
												<div class="row">
													<div class="col-md-6">
														 <input type="number" name="noOfItem" class="form-control" placeholder="No Of Item">
													</div>

													<div class="col-md-6">
													   <input type="number" name="quantity" class="form-control" placeholder="Quantity">
													</div>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Product Status</label>
											<div class="col-lg-9">
                        <select name="ProductStatus" class="form-control">
                          <option>Choose Status...</option>
                          <option value="In Stock"> In Stock</option>
                          <option value="Out Of Stock"> Out Of Stock</option>
                        </select>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Type Of Grams:</label>
											<div class="col-lg-9">
                        <select name="grams" class="form-control">
                          <option value="Grams">Grams</option>
                          <option value="Kgs">Kilograms</option>
                        </select>
											</div>
										</div>
                    <div class="form-group row">
                      <label class="col-lg-3 col-form-label">Benefit</label>
                      <div class="col-lg-9">
                        <textarea rows="5" cols="5" name="benefit" class="form-control" placeholder="Enter your benefits here"></textarea>
                      </div>
                    </div>

                    <div class="form-group row">
											<label class="col-lg-3 col-form-label">Additional message:</label>
											<div class="col-lg-9">
												<textarea rows="5" cols="5" name="info" class="form-control" placeholder="Enter your Additional message here"></textarea>
											</div>
										</div>



										<div class="form-group row">
											<label class="col-lg-3 col-form-label">Additional message:</label>
											<div class="col-lg-9">
												<textarea rows="5" cols="5" name="description" class="form-control" placeholder="Enter your message here"></textarea>
											</div>
										</div>
									</fieldset>
								</div>
							</div>

							<div class="text-right">
								<button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
							</div>
						</form>
					</div>
				</div>








@endsection
