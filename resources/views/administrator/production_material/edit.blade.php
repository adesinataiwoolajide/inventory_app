@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('variant.edit', $var->variant_id)}}">Edit Production Material</a></li>
                        <li class="breadcrumb-item"><a href="{{route('variant.create')}}">Add Product Material</a></li>
                        @if(auth()->user()->hasRole('Administrator') OR auth()->user()->hasRole('Admin'))
                            <li class="breadcrumb-item"><a href="{{route('variant.restore')}}">Restore Product Material</a></li>
                        @endif
			            <li class="breadcrumb-item active" aria-current="page">Editing Product Material</li>
			         </ol>
			   	</div>
			</div>
   			<div class="row">
		    	<div class="col-lg-12">

		    		@include('partials._message')
		          	<div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Update The Variant Details</div>
	            		<div class="card-body">
	            			<form action="{{route('variant.update', $var->variant_id)}}" method="POST" enctype="multipart/form-data">
	            				{{ csrf_field() }}
		            			<div class="form-group row ">
		            				<div class="col-sm-4">
                                        <label>Variant Name</label>
					                    <select class="form-control form-control-rounded" name="variant_name" required>
                                            <option value="{{$var->variant_name}}">{{$var->variant_name}} </option>
                                            <option value=""> </option>
                                            <option value="Cap seal (Small and Big)">Cap seal (Small and Big) </option>
                                            <option value="Celotapes">Celotapes </option>
                                            <option value="Cooking Gas (kg)">Cooking Gas (kg) </option>
                                            <option value="Diesel (litres)">Diesel (litres) </option>
                                            <option value="Face Mask">Face Mask </option>
                                            <option value="Gloves">Gloves </option>
                                            <option value="GY"> GY</option>
                                            <option value="GB"> GB</option>
                                            <option value="GYGN"> GYGN</option>
                                            <option value="Label">Label </option>
                                            <option value="Nurse Cap">Nurse Cap </option>
                                            <option value="Nylon">Nylon </option>
                                            <option value="Unidentified"> Unidentified</option>
                                            <option value="Water (litres)">Water (litres) </option> 
                                        <select>
					                    <span style="color: red">** This Field is Required **</span>
					                     @if ($errors->has('variant_name'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
										        <button type="button" class="close" data-dismiss="alert">&times;</button>
										        <div class="alert-icon contrast-alert">
										            <i class="fa fa-check"></i>
										        </div>
										        <div class="alert-message">
										            <span><strong>Error!</strong> {{ $errors->first('variant_name') }} !</span>
										        </div>
										    </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Variant Size</label>
                                        <select class="form-control form-control-rounded" name="variant_size" required>
                                            <option value="{{$var->variant_size}}">{{$var->variant_size}} </option>
                                            <option value=""> </option>
                                            <option value="20 Litres"> 20 Ltrs</option>
                                            <option value="25 Litres"> 25 Ltrs</option>
                                            <option value="Null">Null </option>
                                        <select>
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('variant_size'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('variant_size') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Category Name</label>
                                        <select class="form-control form-control-rounded" name="category_id" required>
                                            
                                            <option value="{{$var->category->category_id}}"> {{$var->category->category_name}} </option> 
                                           
                                            
                                            <option value=""> </option>
                                            @foreach($category as $categories)
                                                <option value="{{$categories->category_id}}">
                                                    {{$categories->category_name}} </option>
                                            @endforeach
                                        <select>
                                        <span style="color: red">** This Field is Required **</span>
                                            @if ($errors->has('category_id'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <div class="alert-icon contrast-alert">
                                                    <i class="fa fa-check"></i>
                                                </div>
                                                <div class="alert-message">
                                                    <span><strong>Error!</strong> {{ $errors->first('category_id') }} !</span>
                                                </div>
                                            </div>
                                        @endif  
                                    </div>
                                    <input type="hidden" value="{{$var->variant_name}}" name="prev_name">

					                <div class="col-sm-12" align="center">
					                    <button type="submit" class="btn btn-success btn-lg btn-block">UPDATE THE 
                                            VARIANT </button>
					                </div>
						            
					            </div>
				            </form>
		            	</div>
		            </div>
		        </div>
		    </div>
			 <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        @if(count($variant) ==0)
                            <div class="card-header" align="center" style="color: red">
                                <i class="fa fa-table"></i> The List is Empty
                            </div>

                        @else
                            <div class="card-header"><i class="fa fa-table"></i> List of Saved Product Materials</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="default-datatable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                {{-- <th>S/N</th> --}}
                                                <th>Material Name</th>
                                                <th>Material Size</th>
                                                <th>Category</th>
                                                <th> Time Added </th>
                                                <th> Operations </th>
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                                {{-- <th>S/N</th> --}}
                                                <th>Material Name</th>
                                                <th>Material Size</th>
                                                <th>Category</th>
                                                <th> Time Added </th>
                                                <th> Operations </th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $number =1; ?>
                                            @foreach($variant as $variants)
                                                <tr>
                                                    
                                                    <td>{{$variants->variant_name}}</td>
                                                    <td>{{$variants->variant_size}}</td>
                                                    <td>
                                                        {{$variants->category->category_name}}
                                                        
                                                    </td>
                                                    <td>{{$variants->created_at}} </td>
                                                    <td>@if(auth()->user()->hasRole('Administrator') OR(
                                                        auth()->user()->hasRole('Admin')))
                                                        <a href="{{route('variant.delete', $variants->variant_id)}}" 
                                                            onclick="return(confirmToDelete());" 
                                                            class="btn btn-danger">
                                                            <i class="fa fa-trash-o"></i>Delete</a>
                                                        @endif
                                                        <a href="{{route('variant.edit', $variants->variant_id)}}" 
                                                            onclick="return(confirmToEdit());" class="btn btn-success"><i class="fa fa-pencil"></i>
                                                            Edit
                                                        </a>
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