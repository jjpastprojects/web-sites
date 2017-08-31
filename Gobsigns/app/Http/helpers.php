<?php

function delete_form($param, $label = ''){
	$form = Form::open(['method' => 'DELETE','route' => $param,'class' => 'form-inline']);
	$form .= HTML::decode(Form::button('<i class="fa fa-trash-o"></i> '.$label,['data-toggle' => 'tooltip','title' => 'Delete','class' => 'btn btn-danger btn-xs','data-submit-confirm-text' => 'Yes']));
	return $form .= Form::close();
}

function withEmpty($selectList, $emptyLabel='') {
	return array(''=>$emptyLabel) + $selectList->toArray();
}

function showMessage() {
	if (Session::has('errors')) {

		$error = Session::get('errors')->First();
		echo "<div class='alert alert-danger alert-dismissable'>
                <i class='fa fa-ban'></i>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <b>$error</b>
            </div>";

	} 
	elseif (Session::has('success')) {

		$success = Session::get('success');
		echo "<div class='alert alert-success alert-dismissable'>
                <i class='fa fa-check'></i>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <b>$success</b>
            </div>";
	}
}