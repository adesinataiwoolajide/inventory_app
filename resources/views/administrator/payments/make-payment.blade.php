@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('payment.add', $orderDetails->transaction_number)}}">Make Payment</a></li>
                        @if(auth()->user()->hasRole('Administrator') OR(
                        auth()->user()->hasRole('Admin')) OR(
                        auth()->user()->hasRole('Admin')))
                            <li class="breadcrumb-item"><a href="{{route('payment.create')}}">Add Payment</a></li>
                            <li class="breadcrumb-item"><a href="{{route('payment.index')}}">View Payments</a></li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">List of Order Invoice</li>
                        
			         </ol>
			   	</div>
			</div>
            <div class="row">
                <div class="col-lg-12">

                    @include('partials._message')
                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Add 
                            New Payment Details</div>
                        <div class="card-body">
                            <form action="{{route('payment.save')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group row ">
                                    <div class="col-sm-4">
                                        <label>Distributor Name</label>
                                        @foreach($buyers as $see)
                                            <input type="text" name="distri" class="form-control form-control-rounded" 
                                            required placeholder="Enter The Distributor Name" readonly value="{{$see->name}}">
                                            <input type="hidden" name="distributor_id" value="{{$see->distributor_id}}" >
                                        @endforeach
                                        
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
                                    
                                    <div class="col-sm-4">
                                        <label>Total Amount</label>
                                        <input type="number" name="totalamount" class="form-control form-control-rounded" required 
                                        placeholder="Enter Total Amount" value="{{$price}}" readonly>
                                        <input type="hidden" name="total_amount" value="{{$price}}">
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('total_amount'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('total_amount') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Amount Paid</label>
                                        <input type="number" name="paid_amount" class="form-control form-control-rounded" 
                                        required 
                                        placeholder="Enter Amount Paid" value="{{old('paid_amount')}}">
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('paid_amount'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('paid_amount') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                        
                                    </div>
                                    <input type="hidden" name="details_id" value="{{$orderDetails->details_id}}">
                                    <input type="hidden" name="transaction_number" 
                                        value="{{$orderDetails->transaction_number}}">
                                    @if(auth()->user()->hasRole('Administrator') OR(
                                        auth()->user()->hasRole('Admin')))
                                        <div class="col-sm-12" align="center">
                                            <p> YOU MUST BELONG TO A WARE HOUSE TO ADD PAYMENT </p>
                                        </div>
                                    @else
                                        <div class="col-sm-12" align="center">
                                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                                ADD THE PAYMENT 
                                            </button>
                                        </div>
                                    @endif
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                   
                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> 
                            Product Order List 
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
                                        <tbody>
                                            <td></td> 
                                            <td></td> 
                                            <td></td> 
                                            <td>Transaction Number</td> 
                                            <td>{{$orderDetails->transaction_number}}</td>   
                                        </tbody>
                                        <tbody>
                                            <td></td> 
                                            <td></td> 
                                            <td></td> 
                                            <td>Invoice Number</td> 
                                            <td>{{$orderDetails->invoice_number}}</td>   
                                        </tbody>
                                        <tbody>
                                            <td></td> 
                                            <td></td> 
                                            <td></td> 
                                            <td>Total</td> 
                                            <td>&#8358;<?php echo number_format($price) ?></td> 
                                        </tbody>
                                
                                </table>
                            </div>
                            
                        </div> 
                            
                    
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> 
                            Credit Management
                        </div>
                        
                        <div class="card-body">
                            <table  class="table table-bordered">
                                @foreach($buyers as $see)
                                    <tbody>
                                        <tr> 
                                            <td>Credit Limit: &#8358;<?php echo number_format($see->credit_limit) ?></td>
                                            
                                        </tr>
                                    </tbody>

                                    <tbody>
                                        <tr> 
                                            <td>Credit Reduction: &#8358;<?php echo number_format($see->credit_reduction_per_month) ?></td>
                                            
                                        </tr>
                                    </tbody>
                                @endforeach
                                <tbody>
                                    @if(count($credit) ==0)
                                        <tr> 
                                            
                                            <td><p style="color: green">No Debt</p></td>
                                        </tr>
                                    @else
                                        @foreach($credit as $credits)
                                            <tr> 
                                                <td>&#8358;
                                                    <?php echo number_format($credits->credit_amount); ?>
                                                
                                                    @if($credits->paid_status ==1)
                                                        <p style="color:greenyellow"> Paid </p>
                                                    @else
                                                        <p style="color:red"> Pending </p>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            <table>
                        </div>
                    </div>
                </div>
            </div>
	     </div>
	</div>

    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
@endsection