@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
						@can('outlet-create')
							<li class="breadcrumb-item"><a href="{{route('outlet.create')}}">Add Outlet</a></li>
						@endcan
						@if(auth()->user()->hasRole('Administrator') OR(
							auth()->user()->hasRole('Admin')))
							<li class="breadcrumb-item"><a href="{{route('outlet.restore')}}">Restore Deleted Outlets</a></li>	
						
							{{-- <li class="breadcrumb-item"><a href="{{route('assign.outlet.create')}}">
								Assign An Outlet</a></li> --}}
						@endif
			            <li class="breadcrumb-item active" aria-current="page">Saved Outlets</li>
			         </ol>
			   	</div>
			</div>
			@include('partials._message')
			@if(auth()->user()->hasRole('Administrator') OR(
				auth()->user()->hasRole('Admin')))
				<div class="row">
					<div class="col-lg-12">

						<div class="card">
							<div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Add New Outlet Details</div>
							<div class="card-body">
								<form action="{{route('outlet.save')}}" method="POST" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="form-group row ">
										<div class="col-sm-6">
											<label>Outlet Name</label>
											<input type="text" class="form-control form-control-rounded" value="{{ old('outlet_name') }}" name="outlet_name" required placeholder="Enter The Outlet Name">
											<span style="color: red">** This Field is Required **</span>
											@if ($errors->has('outlet_name'))
												<div class="alert alert-danger alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert">&times;</button>
													<div class="alert-icon contrast-alert">
														<i class="fa fa-check"></i>
													</div>
													<div class="alert-message">
														<span><strong>Error!</strong> {{ $errors->first('outlet_name') }} !</span>
													</div>
												</div>
											@endif  
										</div>
										<div class="col-sm-6">
											<label>Distributor Name</label>
											<select name="distributor_id" class="form-control form-control-rounded" required>
												<option value="">-- Select The Distributor -- </option>
												<option value="{{ old('outlet_name') }}"> {{ old('outlet_name') }}</option>
												{{-- <option value=""> </option> --}}
												@foreach($distributor as $distributors)
													<option value="{{$distributors->distributor_id}}">{{$distributors->name}} </option>
												@endforeach
											</select>
											<span style="color: red">** This Field is Required **</span>
											@if ($errors->has('distributor_id'))
												<div class="alert alert-danger alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert">&times;</button>
													<div class="alert-icon contrast-alert">
														<i class="fa fa-check"></i>
													</div>
													<div class="alert-message">
														<span><strong>Error!</strong> {{ $errors->first('distributor_id') }} !</span>
													</div>
												</div>
											@endif  
										</div>

										<div class="col-sm-12" align="center">
											<button type="submit" class="btn btn-success btn-lg btn-block">ADD THE OUTLET </button>
										</div>
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			@endif
			 <div class="row">
		    	<div class="col-lg-12">
		          	<div class="card">
		          		@if(count($outlet) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
			            	</div>

			            @else
			            	<div class="card-header"><i class="fa fa-table"></i> List of Saved Outlets</div>
		            		<div class="card-body">
		              			<div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
		              					<thead>
						                    <tr>
						                        
												<th>Outlet Name</th>
												<th>Distributor Name</th>
												<th>Time Added</th>
												<th>Operations</th>
						                    </tr>
						                </thead>

						                <tfoot>
						                    <tr>
												
												<th>Outlet Name</th>
												<th>Distributor Name</th>
												<th>Time Added</th>
												<th>Operations</th>
						                    </tr>
						                </tfoot>
						                <tbody>
						                	<?php $number =1; ?>
						                	@foreach($outlet as $outlets)
							                    <tr>
													
													<td>{{$outlets->outlet_name}}</td>
													<td>{{$outlets->distributor->name}} </td>
													<td>{{$outlets->created_at}}</td>
													<td>
														@if(auth()->user()->hasRole('Administrator') OR(
															auth()->user()->hasRole('Admin')))
														{{-- @can('outlet-delete') --}}
															<a href="{{route('outlet.delete', $outlets->outlet_id)}}" 
															class="btn btn-danger" onclick="return(confirmToDelete());">
															<i class="fa fa-trash-o"></i></a>
														
															<a href="{{route('outlet.edit', $outlets->outlet_id)}}" 
															class="btn btn-success" onclick="return(confirmToEdit());">
															<i class="fa fa-pencil"></i></a>
														@endif
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