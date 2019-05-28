@extends("layouts.app")
    @section("content")
    <div class="clearfix"></div>
    <div class="content-wrapper">
   		<div class="container-fluid">
   			<div class="row pt-2 pb-2">
		        <div class="col-sm-9">
				    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('administrator.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('salary.index')}}">View All Salaries</a></li>
                        @if(auth()->user()->hasRole('Administrator') OR auth()->user()->hasRole('Admin') 
                            OR auth()->user()->hasRole('Admin'))
							<li class="breadcrumb-item"><a href="{{route('salary.restore')}}">
							Restore Deleted Salaries</a></li>
						@endif
			            <li class="breadcrumb-item active" aria-current="page">Saved Employee Salaries</li>
			         </ol>
			   	</div>
            </div>
            @include('partials._message')
   			<div class="row">
		    	<div class="col-lg-12">

		    		
		          	<div class="card">
						<div class="card-header"><i class="fa fa-table"></i> Please Fill The Below Form To Update The
							Employee Salary
						</div>
	            		<div class="card-body">
	            			<form action="{{route('salary.update', $salar->salary_id)}}" method="POST" enctype="multipart/form-data">
	            				{{ csrf_field() }}
		            			<div class="form-group row ">
		            				<div class="col-sm-4">
										<label>Employee Name</label>
										<select class="form-control form-control-rounded" name="employee_id" required>
											<option value="{{$salar->employee->employee_id}}"> {{$salar->employee->full_name}} </option>
											<option value=""> </option>
											@if(auth()->user()->hasRole('Administrator') 
												OR auth()->user()->hasRole('Admin')){
												@foreach ($employee as $employees)
													<option value="{{$employees->employee_id}}">{{$employees->full_name}} </option>
												@endforeach
												
											@else
											@foreach ($emp as $emplo)
												@if(count($emp) ==0)
													<option value="">No Employee was found for {{$inv->name}} </option>
												@else
													<option value="{{$emplo->employee_id}}">{{$emplo->full_name}} </option>
												@endif
												
											@endforeach
											@endif
										<select>
					                    <span style="color: red">** This Field is Required **</span>
					                     @if ($errors->has('employee_id'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
										        <button type="button" class="close" data-dismiss="alert">&times;</button>
										        <div class="alert-icon contrast-alert">
										            <i class="fa fa-check"></i>
										        </div>
										        <div class="alert-message">
										            <span><strong>Error!</strong> {{ $errors->first('employee_id') }} !</span>
										        </div>
										    </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-4">
										<label>Over Time</label>
										<?php
										$overtime = array("Yes", "No"); ?>
										<select name="over_time" class="form-control 
                                        	form-control-rounded" required>
                                            <option value="<?php if(($salar->over_time) != 0){ 
                                                echo "Yes"; }else{ echo "No"; } ?>"><?php 
                                                if(($salar->over_time) != 0){ 
                                                    echo "Yes"; }else{ echo "No"; } ?>
                                            </option>
											
                                            <option value=""> </option>
                                            @foreach($overtime as $over)
                                                <option value="{{$over}}">{{$over}} </option>
                                            @endforeach
                                        </select>
					                    <span style="color: red">** This Field is Required **</span>
					                     @if ($errors->has('over_time'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
										        <button type="button" class="close" data-dismiss="alert">&times;</button>
										        <div class="alert-icon contrast-alert">
										            <i class="fa fa-check"></i>
										        </div>
										        <div class="alert-message">
										            <span><strong>Error!</strong> {{ $errors->first('over_time') }} !</span>
										        </div>
										    </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-4">
										<label>Rate</label>
                                        <input type="number" class="form-control form-control-rounded" value="{{$salar->rate}}" name="rate" required placeholder="Enter The Rate" >
					                    <span style="color: red">** This Field is Required **</span>
					                     @if ($errors->has('rate'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
										        <button type="button" class="close" data-dismiss="alert">&times;</button>
										        <div class="alert-icon contrast-alert">
										            <i class="fa fa-check"></i>
										        </div>
										        <div class="alert-message">
										            <span><strong>Error!</strong> {{ $errors->first('rate') }} !</span>
										        </div>
										    </div>
                                        @endif  
                                    </div>
                                    <div class="col-sm-4">
										<label>Daily Work Hours</label>
										<select name="hours" class="form-control 
											form-control-rounded" required>
											
											<option value="{{$salar->hours}}">{{$salar->hours}} </option>
											
                                            <option value=""> </option>
                                            @for($i =0; $i <=15; $i++)
                                                <option value="{{$i}}">{{$i}} </option>
                                            @endfor
                                        </select>
					                    <span style="color: red">** This Field is Required **</span>
					                     @if ($errors->has('hours'))
                                            <div class="alert alert-danger alert-dismissible" role="alert">
										        <button type="button" class="close" data-dismiss="alert">&times;</button>
										        <div class="alert-icon contrast-alert">
										            <i class="fa fa-check"></i>
										        </div>
										        <div class="alert-message">
										            <span><strong>Error!</strong> {{ $errors->first('hours') }} !</span>
										        </div>
										    </div>
                                        @endif  
									</div>
									
									<div class="col-sm-4">
										<label>Weekly Working </label>
										<select name="weekly" class="form-control 
											form-control-rounded" required>
											
											<option value="{{$salar->weekly}}">{{$salar->weekly}} </option>
											
											<option value=""> </option>
											@for($k =0; $k <=7; $k++)
												<option value="{{$k}}">{{$k}} </option>
											@endfor
										</select>
										<span style="color: red">** This Field is Required **</span>
											@if ($errors->has('weekly'))
											<div class="alert alert-danger alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
												<div class="alert-icon contrast-alert">
													<i class="fa fa-check"></i>
												</div>
												<div class="alert-message">
													<span><strong>Error!</strong> {{ $errors->first('weekly') }} !</span>
												</div>
											</div>
										@endif  
									</div>

									<div class="col-sm-4">
										<label>Numbers of Week</label>
										<select name="monthly" class="form-control 
											form-control-rounded" required>
											
											<option value="{{$salar->weekly}}">{{$salar->weekly}} </option>
											<option value="{{old('monthly')}}"> {{old('monthly')}}</option>
											<option value=""> </option>
											@for($y =0; $y <=5; $y++)
												<option value="{{$y}}">{{$y}} </option>
											@endfor
										</select>
										<span style="color: red">** This Field is Required **</span>
											@if ($errors->has('monthly'))
											<div class="alert alert-danger alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
												<div class="alert-icon contrast-alert">
													<i class="fa fa-check"></i>
												</div>
												<div class="alert-message">
													<span><strong>Error!</strong> {{ $errors->first('monthly') }} !</span>
												</div>
											</div>
										@endif  
									</div>

					                <div class="col-sm-12" align="center">
					                    <button type="submit" class="btn btn-success btn-lg btn-block">UPDATE THE SALARY </button>
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
						@if(auth()->user()->hasRole('Administrator') 
							OR auth()->user()->hasRole('Admin')){
							@if(count($salary) ==0)
								<div class="card-header" align="center" style="color: red">
									<i class="fa fa-table"></i> The List is Empty
								</div>

							@else
								<div class="card-header"><i class="fa fa-table"></i> List of Saved Employee Salaries</div>
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
													<th>Time Added</th>
													<th>Operations </th>
												</tr>
											</tfoot>
											<tbody>
												<?php $number =1; ?>
												@foreach($salary as $salaries)
													<tr>
														<td>{{$salaries->employee->full_name}}</td>
														<td>&#8358;<?php echo number_format($salaries->basic_salary) ?></td>
														<td>&#8358;<?php echo number_format($salaries->over_time) ?></td>
														<td>{{$salaries->rate}}</td>
														<td>{{$salaries->hours}}</td>
														<td>&#8358;<?php echo number_format($salaries->total) ?></td>
														<td>{{$salaries->month}} </td>
														<td>{{$salaries->created_at}}</td>
														<td>@if(auth()->user()->hasRole('Administrator') OR(
															auth()->user()->hasRole('Admin')))
																<a href="{{route('salary.delete', $salaries->salary_id)}}" 
																	onclick="return(confirmToDelete());" class="btn btn-danger">
																	<i class="fa fa-trash-o"></i> Delete
																</a>
															@endif
															@can('salary-edit')
																<a href="{{route('category.edit', $salaries->salary_id)}}" 
																	onclick="return(confirmToEdit());" class="btn btn-success">
																	<i class="fa fa-pencil"></i>Edit
																</a>
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
						@if(count($sal) ==0)
							<div class="card-header" align="center" style="color: red">
								<i class="fa fa-table"></i> The List is Empty in {{$inv->name}} Ware House
							</div>

						@else
							<div class="card-header"><i class="fa fa-table"></i> List of Saved Employee Salaries in 
								{{$inv->name}} Ware House</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="default-datatable" class="table table-bordered">
										<thead>
											<tr>
												<th> Name</th>
												<th>Daily Pay</th>
												<th>Over Time</th>
												<th>Rate </th>
												<th>Daily Hours</th>
												
												<th>Total</th>
												<th>Month</th>
												<th>Time Added</th>
												<th>Operations </th>
											</tr>
										</thead>

										<tfoot>
											<tr>
												<th>Daily Pay</th>
												<th>Basic Salary</th>
												<th>Over Time</th>
												<th>Rate </th>
												<th>Hours</th>
												<th>Total</th>
												<th>Month</th>
												<th>Time Added</th>
												<th>Operations </th>
											</tr>
										</tfoot>
										<tbody>
											<?php $number =1; ?>
											@foreach($sal as $sala)
												<tr>
													<td>{{$sala->employee->full_name}}</td>
													<td>&#8358;<?php echo number_format($sala->basic_salary) ?></td>
													<td>&#8358;<?php echo number_format($sala->over_time) ?></td>
													<td>{{$sala->rate}}</td>
													<td>{{$sala->hours}}</td>
													<td>&#8358;<?php echo number_format($sala->total) ?></td>
													<td> {{$sala->month}}</td>
													<td>{{$sala->created_at}}</td>
													<td>@if(auth()->user()->hasRole('Administrator') OR(
														auth()->user()->hasRole('Admin')))
															<a href="{{route('salary.delete', $sala->salary_id)}}" 
																onclick="return(confirmToDelete());" class="btn btn-danger">
																<i class="fa fa-trash-o"></i> Delete
															</a>
														@endif
														@can('salary-edit')
															<a href="{{route('category.edit', $sala->salary_id)}}" 
																onclick="return(confirmToEdit());" class="btn btn-success">
																<i class="fa fa-pencil"></i>Edit
															</a>
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