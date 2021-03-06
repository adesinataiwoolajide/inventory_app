@extends('layouts.app')

@section('content')
    
    <div class="content-wrapper">
        <div class="container-fluid">
            @include('partials._message')
            @if(( Auth::user()->email_verified_at) == "")
                <div class="card mt-12 gradient-orange" style="color:white">
                    <div class="media-body" align="center">
                        
                        <span class="text-white" align="center">You Have Not Verify Your Account,<br>
                             Please Kindly Visit Your E-Mail for the verification link</span>
                    </div>
                   
                </div>
            @else
            
                

                @if ((auth()->user()->hasRole('Administrator')) OR
                    (auth()->user()->hasRole('Admin')) OR 
                    (auth()->user()->hasRole('Editor')) OR
                    (auth()->user()->hasRole('Receptionist')))
                    <div class="card mt-3 gradient-forest">
                        <div class="card-content">
                            <div class="row row-group m-0"  style="">
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" 
                                    onclick="location.href='{{route('product.create')}}'">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">{{count($product)}}</h4>
                                                <span class="text-white">Total <br> Products</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-basket-loaded text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:90%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" 
                                onclick="location.href='{{route('supplier.create')}}'">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">{{count($supplier)}}</h4>
                                                <span class="text-white">Our<br>  Suppliers</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-wallet text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:90%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" 
                                    onclick="location.href='{{route('distributor.create')}}'">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">{{count($distributor)}}</h4>
                                                <span class="text-white">Our  <br>Distributors</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-users text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:90%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href='{{route('monthly.report')}}'">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">{{date('M, Y')}}</h4>
                                                <span class="text-white">Monthly <br> Sales</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-building text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12 col-lg-6 col-xl-3" onclick="location.href='{{route('variant.create')}}'" 
                            style="">
                            <div class="card gradient-army">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white">Production <br> Materials</span>
                                            <h3 class="text-white">{{count($categories)}}</h3>
                                        </div>
                                        <div class="w-icon">
                                            <i class="fa fa-cogs text-white"></i>
                                        </div>
                                    </div>
                                    <div id="widget-chart-1"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-6 col-xl-3" onclick="location.href='{{route('inventory.index')}}'" 
                            style="">
                            <div class="card gradient-dusk">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white"> Product <br> Stock</span>
                                            <h3 class="text-white">{{count($inventory)}}</h3>
                                        </div>
                                        <div class="w-icon">
                                            <i class="fa fa-users text-white"></i>
                                        </div>
                                    </div>
                                    <div id="widget-chart-2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-3" onclick="location.href='{{route('order.index')}}'" style="">
                            <div class="card gradient-forest">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white">Customer <br>Orders</span>
                                            <h3 class="text-white">{{count($order)}}</h3>
                                        </div>
                                        <div class="w-icon">
                                            <i class="fa fa-building text-white"></i>
                                        </div>
                                    </div>
                                    <div id="widget-chart-4"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 col-xl-3" onclick="location.href='{{route('log.user')}}'" style="">
                            <div class="card gradient-orange">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white">Activity <br> Log</span>
                                            <h3 class="text-white">{{count($log)}}</h3>
                                        </div>
                                        <div class="w-icon">
                                            <i class="fa fa-cloud text-white"></i>
                                        </div>
                                    </div>
                                    <div id="widget-chart-2"></div>
                                </div>
                            </div>
                        </div>

                    
                    </div>
                @endif
                @if ((auth()->user()->hasRole('Administrator')) OR
                    (auth()->user()->hasRole('Admin')) OR 
                    (auth()->user()->hasRole('Accountant')))
                    <div class="row">
                        <div class="col-12 col-lg-6 col-xl-3" onclick="location.href='{{route('payment.index')}}'" 
                            style="">
                            <div class="card gradient-army">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white">Manage <br> Payment</span>
                                            <h3 class="text-white">{{count($payment)}}</h3>
                                        </div>
                                        <div class="w-icon">
                                            <i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                    <div id="widget-chart-4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-3" onclick="location.href='{{route('order.invoice')}}'" 
                            style="">
                            <div class="card gradient-forest">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white">Manage <br> Invoice</span>
                                            <h3 class="text-white">{{count($invoice)}}</h3>
                                        </div>
                                        <div class="w-icon">
                                            <i class="ti-book text-white"></i>
                                        </div>
                                    </div>
                                    <div id="widget-chart-6"></div>
                                </div>
                            </div>
                        </div>
                    
                       
                        <div class="col-12 col-lg-6 col-xl-3" onclick="location.href='{{route('sales.index')}}'" style="">
                            <div class="card gradient-dusk">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white">Sales <br> List</span>
                                            <h3 class="text-white">{{count($payment)}}</h3>
                                        </div>
                                        <div class="w-icon">
                                            <i class="fa fa-shopping-cart text-white"></i>
                                        </div>
                                    </div>
                                    <div id="widget-chart-3"></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                @endif<!--End Row-->
                @if (auth()->user()->hasRole('Accountant'))

                    <div class="card mt-3 gradient-forest">
                        <div class="card-content">
                            <div class="row row-group m-0"  style="">
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" 
                                    onclick="location.href='{{route('credit.paid')}}'">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white"></h4>
                                                <span class="text-white">Paid <br> Credit</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="fa fa-money text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:90%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" 
                                onclick="location.href='{{route('credit.index')}}'">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white"></h4>
                                                <span class="text-white"> All Credit <br>  Mgt</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-wallet text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:90%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" 
                                    onclick="location.href='{{route('salary.index')}}'">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white"></h4>
                                                <span class="text-white">Staff  <br>Salary</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="fa fa-users text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:90%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href='{{route('credit.unpaid')}}'">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white"></h4>
                                                <span class="text-white">Un Paid <br> Credit</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="fa fa-list text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
               
                
            @endif   
        </div>
        
    </div>
@endsection