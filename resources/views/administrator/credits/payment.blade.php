@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        @if(auth()->user()->hasRole('Administrator') 
                            OR auth()->user()->hasRole('Admin') OR auth()->user()->hasRole('Accountant'))
                            <li class="breadcrumb-item"><a href="{{route('credit.payment')}}">Credit Payment</a></li>
                            <li class="breadcrumb-item"><a href="{{route('credit.index')}}">View All Credits</a></li>
                            <li class="breadcrumb-item"><a href="{{route('credit.paid')}}">Paid Credit</a></li>
                            <li class="breadcrumb-item"><a href="{{route('credit.unpaid')}}">UnPaid Credit</a></li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">List of Credit</li>
                        
			         </ol>
			   	</div>
			</div>
   			
			<div class="row">
		    	<div class="col-lg-12">
                    @include('partials._message')
		          	<div class="card">
                        @if(auth()->user()->hasRole('Administrator') OR(
                            auth()->user()->hasRole('Admin')))
                            @if(count($credit) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> The List is Empty In All Ware House
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> 
                                    List of All Credit Payments In All Ware House
                                </div>
                                
                                <div class="card-body">
                                
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> S/N</th>
                                                    <th> Payment ID</th>
                                                    <th> Distributor </th>
                                                    <th> Ware House</th>
                                                    <th> Amount Paid </th>
                                                    <th> Credit Amount </th>
                                                    <th>Outstanding </th>
                                                    <th> Time Added </th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th> S/N</th>
                                                    <th> Payment ID</th>
                                                    <th> Distributor </th>
                                                    <th> Ware House</th>
                                                    <th> Amount Paid </th>
                                                    <th> Credit Amount </th>
                                                    <th>Outstanding </th>
                                                    <th> Time Added </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $number =1; ?>
                                                @foreach($credit as $credits)
                                                    <tr>
                                                        <td>{{$number}}</td>
                                                        <td>{{$credits->payment_number}}</td>
                                                        <td>{{$credits->distributor->name}}</td>
                                                        {{-- <td>{{$credits->payment_number}}</td>
                                                        <td>{{$credits->distributor->name}}</td>
                                                        <td>{{$credits->warehouse->name}}</td> --}}
                                                        <td> {{$credits->warehouse->name}} </td>
                                                        <td><p style="color: green">&#8358;<?php echo number_format($credits->amount_paid) ?> </p></td>
                                                        <td><p style="color: red"> &#8358;<?php echo number_format($credits->credit->credit_amount) ?></p></td>
                                                        <td>&#8358;<?php echo number_format($credits->credit->credit_amount - $credits->amount_paid ) ?></td>
                                                        <td>{{$credits->created_at}}</td>
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
                            @if(count($cre) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> The List is Empty in {{$inv->name}} Ware House
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> 
                                    List of All Credit Payments in {{$inv->name}} Ware House
                                </div>
                                
                                <div class="card-body">
                                
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> S/N</th>
                                                    <th> Payment ID</th>
                                                    <th> Distributor </th>
                                                    <th> Ware House</th>
                                                    <th> Amount Paid </th>
                                                    <th> Credit Amount </th>
                                                    <th>Outstanding </th>
                                                    <th> Time Added </th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th> S/N</th>
                                                    <th> Payment ID</th>
                                                    <th> Distributor </th>
                                                    <th> Ware House</th>
                                                    <th> Amount Paid </th>
                                                    <th> Credit Amount </th>
                                                    <th>Outstanding </th>
                                                    <th> Time Added </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $number =1; ?>
                                                @foreach($cre as $credi)
                                                    <tr>
                                                        <td>{{$number}}</td>
                                                        <td>{{$credi->payment_number}}</td>
                                                        <td>{{$credi->distributor->name}}</td>
                                                        {{-- <td>{{$credits->payment_number}}</td>
                                                        <td>{{$credits->distributor->name}}</td>
                                                        <td>{{$credits->warehouse->name}}</td> --}}
                                                        <td> {{$credi->warehouse->name}} </td>
                                                        <td><p style="color: green">&#8358;<?php echo number_format($credits->amount_paid) ?> </p></td>
                                                        <td><p style="color: red"> &#8358;<?php echo number_format($credits->credit->credit_amount) ?></p></td>
                                                        <td>&#8358;<?php echo number_format($credits->credit->credit_amount - $credits->amount_paid ) ?></td>
                                                        <td>{{$credi->created_at}}</td>
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