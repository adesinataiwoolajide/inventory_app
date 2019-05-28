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
                                <div class="col-12 col-lg-6 col-xl-3 border-white-2" onclick="location.href='{{route('outlet.create')}}'">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">{{count($outlet)}}</h4>
                                                <span class="text-white">Our <br> Outlets</span>
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
                        <div class="col-12 col-lg-6 col-xl-3" onclick="location.href='{{route('category.create')}}'" 
                            style="">
                            <div class="card gradient-army">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white">Product <br> Categories</span>
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
                        
                        <div class="col-12 col-lg-6 col-xl-3" onclick="location.href='{{route('variant.create')}}'" 
                            style="">
                            <div class="card gradient-dusk">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white"> Product <br> Variant</span>
                                            <h3 class="text-white">{{count($variant)}}</h3>
                                        </div>
                                        <div class="w-icon">
                                            <i class="fa fa-users text-white"></i>
                                        </div>
                                    </div>
                                    <div id="widget-chart-2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-3" onclick="location.href='{{route('inventory.index')}}'" style="">
                            <div class="card gradient-forest">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white">Order <br>Inventory</span>
                                            <h3 class="text-white">{{count($inventory)}}</h3>
                                        </div>
                                        <div class="w-icon">
                                            <i class="fa fa-building text-white"></i>
                                        </div>
                                    </div>
                                    <div id="widget-chart-4"></div>
                                </div>
                            </div>
                        </div>

                        @if (auth()->user()->hasRole('Administrator'))
                            <div class="col-12 col-lg-6 col-xl-3" onclick="location.href='{{route('warehouse.create')}}'" style="">
                                <div class="card gradient-orange">
                                    <div class="card-body">
                                        <div class="media d-flex">
                                            <div class="media-body">
                                                <span class="text-white">Our Ware <br> Houses</span>
                                                <h3 class="text-white">{{count($warehouse)}}</h3>
                                            </div>
                                            <div class="w-icon">
                                                <i class="fa fa-building text-white"></i>
                                            </div>
                                        </div>
                                        <div id="widget-chart-4"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
 
                    </div>
                @endif
                @if (auth()->user()->hasRole('Administrator') OR auth()->user()->hasRole('Admin'))
                    <div class="card mt-3 gradient-dusk">
                        <div class="card-content">
                            <div class="row row-group m-0" style="">
                                <div class="col-12 col-lg-6 col-xl-4 border-white-2"  
                                    onclick="location.href='{{route('employee.create')}}'">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">{{count($employee)}}</h4>
                                                <span class="text-white">Our  <br>Employee</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="fa fa-cogs text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-4 border-white-2"  onclick="location.href='{{route('user.create')}}'">
                                    <div class="card-body">
                                        <div class="media align-items-center">
                                            <div class="media-body text-left">
                                                <h4 class="mb-0 text-white">{{count($user)}}</h4>
                                                <span class="text-white">System <br> Users</span>
                                            </div>
                                            <div class="align-self-center w-icon">
                                                <i class="icon-wallet text-white"></i></div>
                                        </div>
                                        <div class="progress-wrapper mt-3">
                                            <div class="progress" style="height:5px;">
                                                <div class="progress-bar" style="width:50%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-4 border-white-2"  
                                    onclick="location.href='{{route('log.index')}}'">
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <div class="media-body text-left">
                                                    <h4 class="mb-0 text-white">{{count($log)}}</h4>
                                                    <span class="text-white">User <br> Act Log</span>
                                                </div>
                                                <div class="align-self-center w-icon">
                                                    <i class="icon-wallet text-white"></i></div>
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
                    </div>
                @endif
                @if ((auth()->user()->hasRole('Administrator')) OR
                    (auth()->user()->hasRole('Admin')) OR 
                    (auth()->user()->hasRole('Accountant')))
                    <div class="row">
                        <div class="col-12 col-lg-6 col-xl-4" onclick="location.href='{{route('payment.index')}}'" 
                            style="">
                            <div class="card gradient-dusk">
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
                        <div class="col-12 col-lg-6 col-xl-4" onclick="location.href='{{route('order.invoice')}}'" 
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
                    
                        <div class="col-12 col-lg-6 col-xl-4" onclick="location.href='{{route('credit.index')}}'" 
                            style="">
                            <div class="card gradient-orange">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white"> Credit <br> Mgt</span>
                                            <h3 class="text-white">{{count($credit)}}</h3>
                                        </div>
                                        <div class="w-icon">
                                            <i class="ti-chart text-white"></i>
                                        </div>
                                    </div>
                                    <div id="widget-chart-7"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4" onclick="location.href='{{route('salary.index')}}'" style="">
                            <div class="card gradient-army">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white">Staff <br> Salary</span>
                                            <h3 class="text-white">0</h3>
                                        </div>
                                        <div class="w-icon">
                                            <i class="fa fa-users text-white"></i>
                                        </div>
                                    </div>
                                    <div id="widget-chart-5"></div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-12 col-lg-6 col-xl-4" onclick="location.href='{{route('order.invoice')}}'" 
                            style="">
                            <div class="card gradient-dusk">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body">
                                            <span class="text-white">Product <br> Order</span>
                                            <h3 class="text-white">{{count($order)}}</h3>
                                        </div>
                                        <div class="w-icon">
                                            <i class="fa fa-shopping-cart text-white"></i>
                                        </div>
                                    </div>
                                    <div id="widget-chart-3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-4" onclick="location.href='{{route('sales.index')}}'" style="">
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
                        @if ((auth()->user()->hasRole('Administrator')) OR
                        (auth()->user()->hasRole('Admin')) OR 
                        (auth()->user()->hasRole('Editor')) OR 
                        (auth()->user()->hasRole('Receptionist')) OR 
                        (auth()->user()->hasRole('Accountant')))
                        <div class="col-12 col-lg-6 col-xl-4" onclick="location.href='{{route('log.user')}}'" style="">
                            <div class="card gradient-forest">
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
                    @endif

                        
                    </div>
                       
        
                    
                
                @endif<!--End Row-->
                
                
            @endif   
        </div>
        
    </div>
@endsection