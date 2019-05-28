@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('payment.details', $payment->payment_number)}}"> Payment Details</a></li>
                        @if(auth()->user()->hasRole('Administrator') OR (auth()->user()->hasRole('Admin'))
                            OR (auth()->user()->hasRole('Accountant')))
                            <li class="breadcrumb-item"><a href="{{route('payment.update', $payment->payment_number)}}">Edit Payment</a></li>
                            <li class="breadcrumb-item"><a href="{{route('payment.create')}}">Add Payment</a></li>
                            <li class="breadcrumb-item"><a href="{{route('payment.index')}}">View Payments</a></li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">View The Payment Details</li>
                        
			         </ol>
			   	</div>
            </div>
           
            
            <div class="row">
                <div class="col-lg-12">
                    @include('partials._message')
                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> 
                            Product Order List for @foreach($buyers as $see) 
                                {{$see->name}}
                            @endforeach
                        </div>
                        
                        <div class="card-body">
                            <?php
                            $num =1;
                            $total = array(); ?>
                            <div class="table-responsive">
                                <table id="default-datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S/N </th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($viewOrder as $listOrder)<?php
                                            $cal = $listOrder->quantity * $listOrder->unit_amount;
                                            array_push($total, $cal); ?>
                                            <tr>
                                                <td>{{$num}} </td>
                                                <td>{{$listOrder->inventory->product_name}}
                                                    {{-- @foreach(ProductStock($listOrder->stock_id) as $stock)
                                                        {{$stock->product_name}}
                                                    @endforeach --}}
                                                </td>
                                                <td><?php echo number_format($listOrder->quantity) ?></td> 
                                                <td>&#8358;<?php echo number_format($listOrder->unit_amount)  ?></td> 
                                                <td>&#8358;<?php echo number_format($listOrder->total_amount)  ?></td>

                                            </tr>
                                            <?php 
                                            $num++; ?>
                                        @endforeach
                                    </tbody>
                                    <tbody>
                                        <td></td> 
                                        <td></td> 
                                        <td></td> 
                                        <td></td> 
                                        
                                    </tbody>
                                    @foreach($buyers as $see)
                                        <tbody>
                                            <td>Credit Limit</td> 
                                            <td>&#8358;<?php echo number_format($see->credit_limit) ?></td> 
                                            <td></td> 
                                            <td>Transaction Number</td> 
                                            <td>{{$orderDetails->transaction_number}}</td>   
                                        </tbody>
                                        <tbody>
                                            <td>Credit Payment</td> 
                                            <td>&#8358;<?php echo number_format($see->credit_reduction_per_month) ?></td> 
                                            <td></td> 
                                            <td>Invoice Number</td> 
                                            <td>{{$orderDetails->invoice_number}}</td>   
                                        </tbody>
                                    @endforeach
                                    <tbody>
                                        <td></td> 
                                        <td></td> 
                                        <td></td> 
                                        <td>Total</td> 
                                        <td>&#8358;<?php echo number_format($price) ?></td> 
                                    </tbody>
                                    <tbody>
                                        <td></td> 
                                        <td></td> 
                                        <td></td> 
                                        <td>Paid</td> 
                                        <td>&#8358;<?php echo number_format($payment->paid_amount) ?></td> 
                                    </tbody>
                                    <tbody>
                                        <td></td> 
                                        <td></td> 
                                        <td></td> 
                                        <td>Credit</td> 
                                        <td>&#8358;<?php echo number_format($payment->credit) ?></td> 
                                    </tbody>
                                
                                </table>
                            </div>
                            
                        </div> 
                            
                    
                    </div>
                </div>

            </div>
	     </div>
	</div>

    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
@endsection