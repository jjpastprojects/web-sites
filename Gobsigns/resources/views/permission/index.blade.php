@extends('layouts.default')

	@section('content')
		<div class="page-heading animated fadeInDownBig">
			<h1>Permission</h1>
		</div>
		
		<div class="row">
			<div class="col-sm-8">
				<div class="box-info full">
					<h2><strong>Listing All</strong> Permissions</h2>
					
                	<?php 
                	$DATA=array();
					$QA=array();
					foreach ($permissions as $permission){
						$linkToEdit = "<a href='permission/$permission->id/edit' class='DTTT_button_small'> <i class='fa fa-edit'></i> Edit</a>";
						$linkToDelete = "<a href='permission/$permission->id/delete' class='DTTT_button_small'> <i class='fa fa-trash-o'></i> Delete</a>";
						$Option = "$linkToEdit $linkToDelete";
						$QA[] = array($permission->name,$Option);	
					}
					unset($permission);
					
					$DATA['aaData'] = $QA;
					$fp = fopen('data.txt', 'w');
					fwrite($fp, json_encode($DATA));
					fclose($fp); ?>
					<div class="table-responsive">
						<table class="table table-hover datatable">
							<thead>
								<tr>
									<th>Name</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="box-info">
					<h2><strong>Create New Permission</strong> </h2>
					{!! Form::open(['route' => 'permission.store','role' => 'form', 'class'=>'permission-form']) !!}
						@include('permission._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>

	@stop