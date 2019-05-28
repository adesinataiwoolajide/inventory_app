@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
				    	<li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{route('category.create')}}">Add  Category</a></li>
						@if(auth()->user()->hasRole('Administrator') OR auth()->user()->hasRole('Admin'))
							<li class="breadcrumb-item"><a href="{{route('category.restore')}}">
							Restore Deleted Categories</a></li>
						@endif
			            <li class="breadcrumb-item active" aria-current="page">Save Product Categories</li>
			         </ol>
			   	</div>
			</div>
   			<div class="row">
		    	<div class="col-lg-12">

		    		@include('partials._message')
		          	<div class="card">
		            	<div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Add New Product Category Details</div>
	            		<div class="card-body">
	            			<form action="{{route('category.save')}}" method="POST" enctype="multipart/form-data">
	            				{{ csrf_field() }}
		            			<div class="form-group row ">
		            				<div class="col-sm-6">
					                    <input type="text" class="form-control form-control-rounded" value="{{ old('category_name') }}" name="category_name" required placeholder="Enter The Category Name">
					                    <span style="color: red">** This Field is Required **</span>
					                     @if ($errors->has('category_name'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
										        <button type="button" class="close" data-dismiss="alert">&times;</button>
										        <div class="alert-icon contrast-alert">
										            <i class="fa fa-check"></i>
										        </div>
										        <div class="alert-message">
										            <span><strong>Error!</strong> {{ $errors->first('category_name') }} !</span>
										        </div>
										    </div>
                                        @endif  
					                </div>

					                <div class="col-sm-6" align="center">
					                    <button type="submit" class="btn btn-success btn-lg btn-block">ADD THE  CATEGORY </button>
					                </div>
						            
					            </div>
				            </form>
		            	</div>
		            </div>
		        </div>
		    </div>
			 <div class="row">
		    	<div class="col-lg-12">
		          	<div class="card">
		          		@if(count($category) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
			            	</div>

			            @else
			            	<div class="card-header"><i class="fa fa-table"></i> List of Saved Product Categories</div>
		            		<div class="card-body">
		              			<div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
		              					<thead>
						                    <tr>
												<th>Category Name</th>
												<th>Time Added</th>
												<th>Operations </th>
						                    </tr>
						                </thead>

						                <tfoot>
						                    <tr>
												<th>Category Name</th>
												<th>Time Added</th>
												<th>Operations </th>
						                    </tr>
						                </tfoot>
						                <tbody>
						                	<?php $number =1; ?>
						                	@foreach($category as $categories)
							                    <tr>
							                        <td>{{$categories->category_name}}</td>
													<td>{{$categories->created_at}}</td>
													<td>@if(auth()->user()->hasRole('Administrator') OR(
														auth()->user()->hasRole('Admin')))
															<a href="{{route('category.delete', $categories->category_id)}}" 
																onclick="return(confirmToDelete());" class="btn btn-danger">
																<i class="fa fa-trash-o"></i> Delete
															</a>
														@endif
														@can('category-edit')
															<a href="{{route('category.edit', $categories->category_id)}}" 
																onclick="return(confirmToEdit());" class="btn btn-success">
																<i class="fa fa-pencil"></i>Edit
															</a>
														@endcan 
													</td>
							                    </tr><?php
							                    $number++; ?>
							                @endforeach
						                </tbody>
		              				</table>
		              			</div>
		              		</div>
		             	@endif
	              	</div>
	            </div>
	        </div>
	     </div>
	</div>
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
@endsection