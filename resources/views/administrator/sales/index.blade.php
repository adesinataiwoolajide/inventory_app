@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('sales.index')}}">View Sales</a></li>
                        <li class="breadcrumb-item"><a href="{{route('sales.invoice')}}">Sales Invice</a></li>
                        {{-- <li class="breadcrumb-item"><a href="{{route('sales.report')}}">Sales Report</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">List of Sales</li>
                        
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
                                    <i class="fa fa-table"></i> The List is Empty in All Ware House
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> 
                                    List of Sales in All Ware House
                                </div>
                                
                                <div class="card-body">
                                
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Opt</th>
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
                                                    <th> Opt</th>
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
                                                        <td>
                                                            {{-- @can('payment-delete')
                                                                <a href="{{route('payment.delete', $orders->order->transaction_number)}}" 
                                                                onclick="return(confirmToDelete());" class="btn btn-danger">
                                                                <i class="fa fa-trash-o"></i></a>
                                                            @endcan
                                                            
                                                            @can('payment-edit')
                                                                <a href="{{route('payment.edit', $orders->order->transaction_number)}}" 
                                                                onclick="return(confirmToEdit());" class="btn btn-success">
                                                                <i class="fa fa-pencil"></i></a>
                                                            @endcan --}}
                                                            <a href="{{route('payment.details', $orders->order->transaction_number)}}" 
                                                                class="btn btn-primary">
                                                                <i class="fa fa-list"></i></a>  
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
                                    <i class="fa fa-table"></i> The List is Empty in {{$inv->name}}
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> 
                                    List of Sales
                                </div>
                                
                                <div class="card-body">
                                
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> Opt</th>
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
                                                    <th> Opt</th>
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
                                                        <td>
                                                            {{-- @can('payment-delete')
                                                                <a href="{{route('payment.delete', $orders->order->transaction_number)}}" 
                                                                onclick="return(confirmToDelete());" class="btn btn-danger">
                                                                <i class="fa fa-trash-o"></i></a>
                                                            @endcan
                                                            
                                                            @can('payment-edit')
                                                                <a href="{{route('payment.edit', $orders->order->transaction_number)}}" 
                                                                onclick="return(confirmToEdit());" class="btn btn-success">
                                                                <i class="fa fa-pencil"></i></a>
                                                            @endcan --}}
                                                            <a href="{{route('payment.details', $orders->order->transaction_number)}}" 
                                                                class="btn btn-primary">
                                                                <i class="fa fa-list"></i></a>  
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