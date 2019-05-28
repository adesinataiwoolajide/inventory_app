@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        @if(auth()->user()->hasRole('Administrator') OR(
                            auth()->user()->hasRole('Admin')) OR(
                            auth()->user()->hasRole('Accountant')))
                            <li class="breadcrumb-item"><a href="{{route('payment.index')}}">View Payments</a></li>
                            <li class="breadcrumb-item"><a href="{{route('payment.create')}}">Add Payment</a></li>
                            <li class="breadcrumb-item active" aria-current="page">List of Payment</li>
                        @endif
			         </ol>
			   	</div>
			</div>
   			
			<div class="row">
		    	<div class="col-lg-12">
                    @include('partials._message')
		          	<div class="card">
                        @if(auth()->user()->hasRole('Administrator') OR(
                            auth()->user()->hasRole('Admin')))
                            @if(count($payment) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> The List is Empty
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> 
                                    List of Saved Order Payment In All Ware House
                                </div>
                                
                                <div class="card-body">
                                
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> S/N</th>
                                                    <th> Transaction ID</th>
                                                    <th> Distributor </th>
                                                    <th> Ware House </th>
                                                    <th> Total Amount </th>
                                                    <th> Amount Paid </th>
                                                    <th> Credit </th>
                                                    {{-- <th> Payment</th> --}}
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th> S/N</th>
                                                    <th> Distributor </th>
                                                    <th> Ware House </th>
                                                    <th> Transaction ID</th>
                                                    <th> Total Amount </th>
                                                    <th> Amount Paid </th>
                                                    <th> Credit </th>
                                                    {{-- <th> Payment</th> --}}
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $number =1; ?>
                                                @foreach($payment as $orders)
                                                    <tr>
                                                        <td>{{$number}}
                                                            @if(auth()->user()->hasRole('Administrator') OR 
                                                                (auth()->user()->hasRole('Admin')))
                                                                <a href="{{route('payment.delete', $orders->order->transaction_number)}}" 
                                                                onclick="return(confirmToDelete());" class="btn btn-danger">
                                                                <i class="fa fa-trash-o"></i></a>
                                                            @endif
                                                            @can('payment-edit')
                                                                <a href="{{route('payment.edit', $orders->order->transaction_number)}}" 
                                                                    onclick="return(confirmToEdit());" class="btn btn-success">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <a href="{{route('payment.details', $orders->order->transaction_number)}}" 
                                                                    class="btn btn-primary">
                                                                    <i class="fa fa-list"></i>
                                                                </a>  
                                                            @endcan
                                                        </td>
                                                        
                                                        <td>{{$orders->order->transaction_number}}</td>
                                                        <td>{{$orders->distributor->name}}</td>
                                                        <td>{{$orders->warehouse->name}}</td>
                                                        <td> &#8358;<?php echo number_format($orders->total_amount) ?> </td>
                                                        <td> &#8358;<?php echo number_format($orders->paid_amount) ?></td>
                                                        <td> 
                                                            @if($orders->credit ==0)
                                                                <p style="color: green"> No Credit </p>
                                                            @else
                                                                <p style="color: red"> &#8358;<?php echo number_format($orders->credit) ?> </p>
                                                            @endif
                                                        </td>
                                                    
                                                    </tr>
                                                    
                                                    <?php
                                                    $number++; ?>
                                                @endforeach
                                            </tbody>
                                        
                                        </table>
                                    </div>
                                    
                                </div> 
                                    
                            @endif
                        @else
                            @if(count($pay) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> The List of Order Payments in {{$inv->name}} Ware House is Empty
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> 
                                    List of Saved Order Payments in {{$inv->name}} Ware House
                                </div>
                                
                                <div class="card-body">
                                
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> S/N</th>
                                                    <th> Transaction ID</th>
                                                    <th> Distributor </th>
                                                    <th> Ware House </th>
                                                    <th> Total Amount </th>
                                                    <th> Amount Paid </th>
                                                    <th> Credit </th>
                                                    {{-- <th> Payment</th> --}}
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th> S/N</th>
                                                    <th> Distributor </th>
                                                    <th> Ware House </th>
                                                    <th> Transaction ID</th>
                                                    <th> Total Amount </th>
                                                    <th> Amount Paid </th>
                                                    <th> Credit </th>
                                                    {{-- <th> Payment</th> --}}
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $number =1; ?>
                                                @foreach($pay as $orders)
                                                    <tr>
                                                        <td>{{$number}}
                                                            @if(auth()->user()->hasRole('Administrator') OR (auth()->user()->hasRole('Admin')))
                                                                <a href="{{route('payment.delete', $orders->order->transaction_number)}}" 
                                                                onclick="return(confirmToDelete());" class="btn btn-danger">
                                                                <i class="fa fa-trash-o"></i></a>
                                                            @endif
                                                            @can('payment-edit')
                                                                <a href="{{route('payment.edit', $orders->order->transaction_number)}}" 
                                                                    onclick="return(confirmToEdit());" class="btn btn-success">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                                <a href="{{route('payment.details', $orders->order->transaction_number)}}" 
                                                                    class="btn btn-primary">
                                                                    <i class="fa fa-list"></i>
                                                                </a>  
                                                            @endcan
                                                        </td>
                                                        
                                                        <td>{{$orders->order->transaction_number}}</td>
                                                        <td>{{$orders->distributor->name}}</td>
                                                        <td>{{$orders->warehouse->name}}</td>
                                                        <td> &#8358;<?php echo number_format($orders->total_amount) ?> </td>
                                                        <td> &#8358;<?php echo number_format($orders->paid_amount) ?></td>
                                                        <td> 
                                                            @if($orders->credit ==0)
                                                                <p style="color: green"> No Credit </p>
                                                            @else
                                                                <p style="color: red"> &#8358;<?php echo number_format($orders->credit) ?> </p>
                                                            @endif
                                                        </td>
                                                    
                                                    </tr>
                                                    
                                                    <?php
                                                    $number++; ?>
                                                @endforeach
                                            </tbody>
                                        
                                        </table>
                                    </div>
                                    
                                </div> 
                                    
                            @endif
                        @endif
	              	</div>
	            </div>
	        </div>
	     </div>
	</div>


    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
@endsection