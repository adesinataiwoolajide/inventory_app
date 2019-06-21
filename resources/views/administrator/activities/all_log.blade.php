@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
				    	<li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
						
						@if(auth()->user()->hasRole('Administrator') OR auth()->user()->hasRole('Admin'))
							<li class="breadcrumb-item"><a href="{{route('log.index')}}">
							All Activity Log</a></li>
						@endif
						<li class="breadcrumb-item"><a href="{{route('log.user')}}">My Log</a></li>
			            <li class="breadcrumb-item active" aria-current="page">All Activities Log</li>
			         </ol>
			   	</div>
			</div>
   			
			 <div class="row">
				@include('partials._message')
		    	<div class="col-lg-12">
		          	<div class="card">
		          		@if(count($log) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
			            	</div>

			            @else
			            	<div class="card-header"><i class="fa fa-table"></i> List of Saved Activity Log</div>
		            		<div class="card-body">
		              			<div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
		              					<thead>
						                    <tr>
						                        <th>S/N</th>
												<th>Full Name</th>
												<th>E-Mail</th>
												<th>Action</th>
												<th>Time Added</th>
						                    </tr>
						                </thead>

						                <tfoot>
						                    <tr>
												<th>S/N</th>
												<th>Full Name</th>
												<th>E-Mail</th>
												<th>Action</th>
												<th>Time Added</th>
						                    </tr>
						                </tfoot>
						                <tbody>
						                	<?php $number =1; ?>
						                	@foreach($log as $logs)
							                    <tr>
													<td>{{$number}}</td>
							                        <td>{{$logs->user->name}}</td>
													<td>{{$logs->user->email}}</td>
													<td>{{$logs->operations}}</td>
													<td>{{$logs->created_at}}</td>
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