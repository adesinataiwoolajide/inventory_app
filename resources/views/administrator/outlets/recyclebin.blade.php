@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
						@can('outlet-restore')
							<li class="breadcrumb-item"><a href="{{route('outlet.restore')}}">Restore Deleted Outlets</a></li>
						@endcan
						@can('outlet-create')
							<li class="breadcrumb-item"><a href="{{route('outlet.create')}}">Add  outlet</a></li>
						@endcan	
						{{-- @can('assign-create')
							<li class="breadcrumb-item"><a href="{{route('assign.outlet.create')}}">
								Assign An Outlet</a></li>
						@endcan --}}
						<li class="breadcrumb-item active" aria-current="page">Saved Outlets</li>
			         </ol>
			   	</div>
			</div>
   			  
			 <div class="row">
		    	<div class="col-lg-12">
                    @include('partials._message')
		          	<div class="card">
		          		@if(count($outlet) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
			            	</div>

			            @else
			            	<div class="card-header"><i class="fa fa-table"></i> List of Deleted Outlets</div>
		            		<div class="card-body">
		              			<div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
		              					<thead>
						                    <tr>
						                        <th>S/N</th>
												<th>Outlet Name</th>
												<th>Distributor Name</th>
												<th>Time Deleted</th>
						                    </tr>
						                </thead>

						                <tfoot>
						                    <tr>
												<th>S/N</th>
												<th>Outlet Name</th>
												<th>Distributor Name</th>
												<th>Time Deleted</th>
						                    </tr>
						                </tfoot>
						                <tbody>
						                	<?php $number =1; ?>
						                	@foreach($outlet as $outlets)
							                    <tr>
													<td>{{$number}}
														@if(auth()->user()->hasRole('Administrator') OR(
															auth()->user()->hasRole('Admin')))
														{{-- @can('outlet-restore') --}}
															<a href="{{route('outlet.undelete', $outlets->outlet_id)}}"
																onclick="return(confirmToRestore());" class="btn btn-success">
																<i class="fa fa-trash-o"></i>Restore
															</a>
														@endif
							                        </td>
							                        <td>{{$outlets->outlet_name}}</td>
							                        <td>{{$outlets->distributor->name}} </td>
													<td>{{$outlets->deleted_at}}</td>
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