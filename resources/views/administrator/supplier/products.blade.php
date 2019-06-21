@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('supplier.product', $sup->supplier_id)}}"> 
                            Supplier's Products</a></li>
                        <li class="breadcrumb-item"><a href="{{route('supplier.create')}}">Add Supplier</a></li>
                        
			            <li class="breadcrumb-item active" aria-current="page">Saved Products</li>
			         </ol>
			   	</div>
            </div>
            @include('partials._message')
   			
			 <div class="row">
		    	<div class="col-lg-12">
		          	<div class="card">
                        @if(auth()->user()->hasRole('Administrator') OR(
							auth()->user()->hasRole('Admin')))
                            @if(count($product) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> No Product Waswas Supplied {{$sup->name}}
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i> List of Saved Products for {{$sup->name}}</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Name</th>
                                                    <th>Qty </th>
                                                    <th>Price </th>
                                                    <th>Category</th>
                                                    <th>Variants </th>
                                                    <th>Supplier </th>
                                                    <th>Ware House </th>
                                                    <th>Time Added </th>
                                                    <th> Operations </th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <
                                                    <th>Name</th>
                                                    <th>Qty </th>
                                                    <th>Price </th>
                                                    <th>Category</th>
                                                    <th>Variants </th>
                                                    <th>Supplier </th>
                                                    <th>Ware House </th>
                                                    <th>Time Added </th>
                                                    <th> Operations </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $number =1; ?>
                                                @foreach($product as $products)
                                                    <tr>
                                                        
                                                        <td>{{$products->product_name}}</td> 
                                                        <td><?php echo number_format($products->quantity) ?></td> 
                                                        <td>&#8358;<?php echo number_format($products->amount) ?></td> 
                                                        
                                                        <td>{{$products->category->category_name}}
                                                            {{-- @foreach(ProductCategory($products->category_id) as $categories)
                                                                {{$categories->category_name}}
                                                            @endforeach --}}
                                                        </td>
                                                        <td>{{$products->variant->variant_name}}
                                                            {{-- @foreach(ProductVariants($products->variant_id) as $vari)
                                                                {{$vari->variant_name}}
                                                            @endforeach --}}
                                                        </td> 
                                                        
                                                        <td>{{$products->supplier->name}}
                                                            {{-- @foreach(ProductSupplier($products->supplier_id) as $suppl)
                                                                {{$suppl->name}}
                                                            @endforeach --}}
                                                        </td> 
                                                    
                                                        <td>{{$products->warehouse->name}}
                                                            {{-- @foreach(WareHouseDetails($products->ware_house_id) as $wareh)
                                                                {{$wareh->name}}
                                                            @endforeach --}}
                                                        </td> 
                                                        <td>{{$products->created_at }}</td>
                                                        <td>
                                                            @if(auth()->user()->hasRole('Administrator') OR(
                                                                auth()->user()->hasRole('Admin')))
                                                                <a href="{{route('product.delete', $products->product_id)}}" 
                                                                    onclick="return(confirmToDelete());" class="btn btn-danger">
                                                                    <i class="fa fa-trash-o">
                                                                </i></a>
                                                            @endif
                                                            @can('product-edit')
                                                                <a href="{{route('product.edit', $products->product_id)}}" 
                                                                    onclick="return(confirmToEdit());" class="btn btn-success">
                                                                    <i class="fa fa-pencil">
                                                                </i></a>
                                                            @endcan
                                                        </td>
                                                    </tr><?php
                                                    $number++; ?>
                                                @endforeach
                                            </tbody>
                                        
                                        </table>
                                    </div>
                                </div>
                            @endif
                       
                        @else
                            @if(count($prod) ==0)
                                <div class="card-header" align="center" style="color: red">
                                    <i class="fa fa-table"></i> No Product Was Supplied By {{$sup->name}} to {{$inv->name}} Ware House
                                </div>

                            @else
                                <div class="card-header"><i class="fa fa-table"></i>
                                     List of Product Was Supplied By {{$sup->name}} to {{$inv->name}} Ware House
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="default-datatable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Name</th>
                                                    <th>Qty </th>
                                                    <th>Price </th>
                                                    <th>Category</th>
                                                    <th>Variants </th>
                                                    <th>Supplier </th>
                                                    <th>Ware House </th>
                                                    <th> Time Added </th>
                                                    <th> Operations </th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    
                                                    <th>Name</th>
                                                    <th>Qty </th>
                                                    <th>Price </th>
                                                    <th>Category</th>
                                                    <th>Variants </th>
                                                    <th>Supplier </th>
                                                    <th>Ware House </th>
                                                    <th> Time Added </th>
                                                    <th> Operations </th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php $number =1; ?>
                                                @foreach($prod as $prods)
                                                    <tr>
                                                        
                                                        <td>{{$prods->product_name}}</td> 
                                                        <td><?php echo number_format($prods->quantity) ?></td> 
                                                        <td>&#8358;<?php echo number_format($prods->amount) ?></td> 
                                                        
                                                        <td>{{$prods->category->category_name}}
                                                            {{-- @foreach(ProductCategory($products->category_id) as $categories)
                                                                {{$categories->category_name}}
                                                            @endforeach --}}
                                                        </td>
                                                        <td>{{$prods->variant->variant_name}}
                                                            {{-- @foreach(ProductVariants($products->variant_id) as $vari)
                                                                {{$vari->variant_name}}
                                                            @endforeach --}}
                                                        </td> 
                                                        
                                                        <td>{{$prods->supplier->name}}
                                                            {{-- @foreach(ProductSupplier($products->supplier_id) as $suppl)
                                                                {{$suppl->name}}
                                                            @endforeach --}}
                                                        </td> 
                                                    
                                                        <td>{{$prods->warehouse->name}}
                                                            {{-- @foreach(WareHouseDetails($products->ware_house_id) as $wareh)
                                                                {{$wareh->name}}
                                                            @endforeach --}}
                                                        </td> 
                                                        <td>{{$prods->created_at }}</td>
                                                        <td>
                                                            @if(auth()->user()->hasRole('Administrator') OR(
															auth()->user()->hasRole('Admin')))
                                                            {{-- @can('product-delete') --}}
                                                                <a href="{{route('product.delete', $prods->product_id)}}" 
                                                                    onclick="return(confirmToDelete());" class="btn btn-danger">
                                                                    <i class="fa fa-trash-o">
                                                                </i>Delete</a>
                                                            @endif
                                                            @can('product-edit')
                                                                <a href="{{route('product.edit', $prods->product_id)}}" 
                                                                    onclick="return(confirmToEdit());" class="btn btn-success">
                                                                    <i class="fa fa-pencil">
                                                                </i>Edit </a>
                                                            @endcan
                                                        </td>
                                                    </tr><?php
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