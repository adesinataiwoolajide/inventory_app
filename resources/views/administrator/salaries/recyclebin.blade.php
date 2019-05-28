@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        @if(auth()->user()->hasRole('Administrator') OR auth()->user()->hasRole('Admin') 
                            OR auth()->user()->hasRole('Admin'))
							<li class="breadcrumb-item"><a href="{{route('salary.restore')}}">
							Restore Deleted Salaries</a></li>
						@endif
                        <li class="breadcrumb-item"><a href="{{route('salary.index')}}">View All Salaries</a></li>
                        
			            <li class="breadcrumb-item active" aria-current="page">Deleted Employee Salaries</li>
			         </ol>
			   	</div>
            </div>
            @include('partials._message')
   			
			<div class="row">
		    	<div class="col-lg-12">
		          	<div class="card">
						
                        @if(count($salary) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
                            </div>

                        @else
                            <div class="card-header"><i class="fa fa-table"></i> List of Deleted Employee Salaries in All Ware House</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th> Name</th>
                                                <th>Daily Pay</th>
                                                <th>Over Time</th>
                                                <th>Rate </th>
                                                <th>Hours</th>
                                                <th>Total</th>
                                                <th>Month</th>
                                                <th>Ware House</th>
                                                <th>Time Added</th>
                                                <th>Operations </th>
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                                <th> Name</th>
                                                <th>Daily Pay</th>
                                                <th>Over Time</th>
                                                <th>Rate </th>
                                                <th>Hours</th>
                                                <th>Total</th>
                                                <th>Month</th>
                                                <th>Ware House</th>
                                                <th>Time Added</th>
                                                <th>Operations </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $number =1; ?>
                                            @foreach($salary as $salaries)
                                                <tr>
                                                    <td>{{$salaries->employee->full_name . " ". $salaries->employee->contract_type}}</td>
                                                    <td>&#8358;<?php echo number_format($salaries->basic_salary) ?></td>
                                                    <td>&#8358;<?php echo number_format($salaries->over_time) ?></td>
                                                    <td>{{$salaries->rate}}</td>
                                                    <td>{{$salaries->hours}}</td>
                                                    <td>&#8358;<?php echo number_format($salaries->total) ?></td>
                                                    <td>{{$salaries->month}} </td>
                                                    <td>{{$salaries->warehouse->name}} </td>
                                                    <td>{{$salaries->created_at}}</td>
                                                    <td>@if(auth()->user()->hasRole('Administrator') OR(
                                                        auth()->user()->hasRole('Admin')))
                                                            <a href="{{route('salary.undelete', $salaries->salary_id)}}" 
                                                                onclick="return(confirmToRestore());" class="btn btn-success">
                                                                <i class="fa fa-trash-o"></i> Restore
                                                            </a>
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