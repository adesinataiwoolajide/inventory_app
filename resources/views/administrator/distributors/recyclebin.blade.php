@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
				    	<li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('distributor.restore')}}">Restore Deleted Distributors</a></li>
                        <li class="breadcrumb-item"><a href="{{route('distributor.create')}}">Add Distributor</a></li>
			            <li class="breadcrumb-item active" aria-current="page">Deleted Product Distributors</li>
			         </ol>
			   	</div>
			</div>

			 <div class="row">
		    	<div class="col-lg-12">
					@include('partials._message')
		          	<div class="card">
                        
		          		@if(count($distributor) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
			            	</div>

			            @else
			            	<div class="card-header"><i class="fa fa-table"></i> List of Deleted Product Distributors</div>
		            		<div class="card-body">
		              			<div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
		              					<thead>
						                    <tr>
                                                <th>S/N</th>
                                                <th> Name</th>
                                                <th>Phone Number</th>
                                                <th> Email </th>
                                    
						                    </tr>
						                </thead>

						                <tfoot>
						                    <tr>
                                                <th>S/N</th>
                                                <th> Name</th>
                                                <th>Phone Number</th>
                                                <th> Email </th>
                                                
												
						                    </tr>
						                </tfoot>
						                <tbody>
						                	<?php $number =1; ?>
						                	@foreach($distributor as $distributors)
							                    <tr>
													<td>{{$number}}
														@if(auth()->user()->hasRole('Administrator') OR(
															auth()->user()->hasRole('Admin')))
                                                        	<a href="{{route('distributor.undelete', $distributors->distributor_id)}}"
															onclick="return(confirmToRestore());"
															 class="btn btn-success">
                                                            <i class="fa fa-trash-o"></i>Restore
														</a>
														@endif
							                        </td>
							                        <td>{{$distributors->name}}</td> 
                                                    <td>{{$distributors->phone_one}}</td> 
                                                    <td>{{$distributors->email}}</td> 
                                        
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