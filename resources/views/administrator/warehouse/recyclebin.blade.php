@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
				    	<li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('warehouse.restore')}}">Restore Deleted Ware Houses</a></li>
                        <li class="breadcrumb-item"><a href="{{route('warehouse.create')}}">Add  Ware House</a></li>
			            <li class="breadcrumb-item active" aria-current="page">Saved  Warehouses</li>
			         </ol>
			   	</div>
			</div>

			 <div class="row">
		    	<div class="col-lg-12">
                    @include('partials._message')
		          	<div class="card">
		          		@if(count($warehouse) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
			            	</div>

			            @else
			            	<div class="card-header"><i class="fa fa-table"></i> List of Deleted Warehouses</div>
		            		<div class="card-body">
		              			<div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
		              					<thead>
						                    <tr>
                                                <<th>S/N</th>
                                                <th>Ware House</th>
                                                <th>State</th>
                                                <th>Country </th>
                                                <th>Manager </th>
                                                <th>Start Date </th>
                                                
						                    </tr>
						                </thead>

						                <tfoot>
						                    <tr>
                                                <th>S/N</th>
                                                <th>Ware House</th>
                                                <th>State</th>
                                                <th>Country </th>
                                                <th>Manager </th>
                                                <th>Start Date </th>
                                                
						                    </tr>
						                </tfoot>
						                <tbody>
						                	<?php $number =1; ?>
						                	@foreach($warehouse as $warehouses)
							                    <tr>
							                        <td>{{$number}}
                                                        <a href="{{route('warehouse.undelete', $warehouses->ware_house_id)}}"
                                                            onclick="return(confirmToRestore());" class="btn btn-success">
                                                            <i class="fa fa-trash-o"></i>Restore
                                                        </a>
							                        </td>
							                        <td>{{$warehouses->name}}</td> 
                                                    <td>{{$warehouses->state}}</td> 
                                                    <td>{{$warehouses->country}}</td> 
                                                    <td>{{$warehouses->user_id}}</td> 
                                                    <td>{{$warehouses->start_date}}</td> 
                                                    
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