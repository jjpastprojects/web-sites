@extends('layouts.default')

	@section('content')
		<div class="row">
			<div class="col-sm-4">
				<div class="box-info text-center user-profile-2">
					<h4> Task # {!! str_pad($task->id, 3, 0, STR_PAD_LEFT) !!} </h4>
					<h5>{!! $task->task_title !!}</h5>
					<ul class="list-group">
					  <li class="list-group-item">
						<span class="badge success">{!! App\Classes\Helper::showDate($task->start_date) !!}</span>
						Start Date
					  </li>
					  <li class="list-group-item">
						<span class="badge danger">{!! App\Classes\Helper::showDate($task->due_date) !!}</span>
						Due Date
					  </li>
					  <li class="list-group-item">
						<span class="badge danger">{!! isset($task->hours) ? $task->hours.' Hr' : 'NA' !!}</span>
						Hours Assigned
					  </li>
					</ul>
				</div>
				<div class="box-info">
					<h2>Members</h2>
					<ul class="media-list">
						@foreach($task->User as $user)
							<li class="media">
								<a class="pull-left" href="#">
								  {!! App\Classes\Helper::getAvatar($user->id) !!}
								</a>
								<div class="media-body">
								  <h4 class="media-heading"><a href="#">{!! $user->first_name." ".$user->last_name !!}</a> </h4>
								  <p>{!! $user->Location->location." in ". $user->Location->Client->client_name !!} Client</p>
								</div>
							</li>
						@endforeach
					</ul>
				</div>
			</div>
			
			<div class="col-sm-8">
				<div class="box-info full">

					<ul class="nav nav-tabs nav-justified">
					  <li class="active"><a href="#detail" data-toggle="tab"><i class="fa fa-arrows"></i> Detail</a></li>
					  <li><a href="#comment" data-toggle="tab"><i class="fa fa-comment"></i> Comments</a></li>
					  <li><a href="#note" data-toggle="tab"><i class="fa fa-pencil"></i> Note</a></li>
					  <li><a href="#attachment" data-toggle="tab"><i class="fa fa-paperclip"></i> Attachment</a></li>
					</ul>

					<div class="tab-content">
					
						
						<div class="tab-pane animated active fadeInRight" id="detail">
							<div class="user-profile-content">
								<h5><strong>Task</strong> Description</h5>
								<p>
								{!! $task->task_description !!}
								</p>
								<hr />
								<h5><strong>Task</strong> Progress {!! $task->task_progress !!}% Complete</h5>
								<div class="progress progress-sm">
								  <div class="progress-bar progress-bar-{!! App\Classes\Helper::activityTaskProgressColor($task->task_progress) !!}" role="progressbar" aria-valuenow="{!! $task->task_progress !!}" aria-valuemin="0" aria-valuemax="100" style="width: {!! $task->task_progress !!}%">
									<span class="sr-only">{!! $task->task_progress !!}% Complete</span>
								  </div>
								</div>

							@if(Entrust::can('update_progress_task'))
							  {!! Form::open(['route' => 'task.updateTaskProgress','role' => 'form', 'class'=>'task-progress-form']) !!}
							  	<div class="form-group">
								    {!! Form::label('task_progress','Progress',[])!!}
									<div class="input-group">
										{!! Form::input('number','task_progress',isset($task->task_progress) ? $task->task_progress : '',['class'=>'form-control','placeholder'=>'Enter Task Progress'])!!}
							    		<span class="input-group-addon">%</span>
							    	</div>
							    </div>
							    {!! Form::hidden('task_id',$task->id) !!}
							    {!! Form::submit('Save',['class' => 'btn btn-primary pull-right']) !!}
							  {!! Form::close() !!}
							@endif
							  <div class="clear"></div>

							</div>
						</div>
						
						<div class="tab-pane animated fadeInRight" id="comment">
							<div class="user-profile-content">
								{!! Form::open(['route' => 'comment.store','role' => 'form', 'class'=>'comment-form']) !!}
								  <div class="form-group">
								    {!! Form::textarea('comment','',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Comment'])!!}
								  </div>
								  {!! Form::hidden('task_id',$task->id) !!}
								  {!! Form::submit('Save',['class' => 'btn btn-primary pull-right']) !!}
								{!! Form::close() !!}

								<h2><strong>Comment</strong> List</h2>
								<div class="scroll-widget">
									<ul class="media-list">
									@foreach($comments as $comment)
									  <li class="media">
										<a class="pull-left" href="#">
										  {!! App\Classes\Helper::getAvatar($comment->user_id) !!}
										</a>
										<div class="media-body">
										  <h4 class="media-heading"><a href="#">{!! $comment->first_name." ".$comment->last_name !!}</a> <small>{!! App\Classes\Helper::showDateTime($comment->created_at) !!}</small></h4>
										  <p>{!! $comment->comment !!}</p>

										  @if(Entrust::hasRole('admin') || Auth::user()->username == $comment->username)
											{!! Form::open(array('route' => array('comment.destroy', $comment->id), 'method' => 'delete')) !!}
										        <button type="submit" class="btn btn-danger btn-xs pull-right" data-submit-confirm-text = "Yes"><i class="fa fa-trash"></i> Delete</button>
										    {!! Form::close() !!}
									      @endif
										</div>
									  </li>
									@endforeach
									</ul>
								</div>
							</div>
						</div>
						
						<div class="tab-pane animated fadeInRight" id="note">
							<div class="user-profile-content">
									@if(isset($note->id))
									{!! Form::open(['method' => 'PUT','route' => ['note.update', $note->id],'class' => 'note-form']) !!}
									@else
									{!! Form::open(['method' => 'POST','route' => ['note.store'],'class' => 'note-form']) !!}
									@endif
									   <div class="form-group">
									    {!! Form::textarea('note_content',isset($note->note_content) ? $note->note_content : '',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Comment'])!!}
									   </div>
								  {!! Form::hidden('task_id',$task->id) !!}
								  {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
								{!! Form::close() !!}
							</div>
						</div>

						<div class="tab-pane animated fadeInRight" id="attachment">
							<div class="user-profile-content">
								{!! Form::open(['files'=>'true','route' => 'attachment.store','role' => 'form', 'class'=>'attachment-form']) !!}
								  <div class="form-group">
								    {!! Form::label('attachment_title','Title',[])!!}
									{!! Form::input('text','attachment_title','',['class'=>'form-control','placeholder'=>'Enter Title'])!!}
								  </div>
								  <div class="form-group">
								  	<input type="file" name="file" id="file" class="btn btn-default" title="Select File">
								  </div>
								  <div class="form-group">
								    {!! Form::textarea('attachment_description','',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Description'])!!}
								  </div>
								  {!! Form::hidden('task_id',$task->id) !!}
								  {!! Form::submit('Save',['class' => 'btn btn-primary pull-right']) !!}	
								{!! Form::close() !!}
								<h2><strong>Attachment</strong> List</h2>
								<div class="table-responsive">
									<table class="table table-hover table-striped">
										<thead>
											<tr>
												<th>Title</th>
												<th>Description</th>
												<th>File</th>
												<th>Date & Time</th>
												<th>Option</th>
											</tr>
										</thead>
										<tbody>
											@foreach($attachments as $attachment)
												<tr>
													<td>{!! $attachment->attachment_title !!}</td>
													<td>{!! $attachment->attachment_description !!}</td>
													<td><a href="{!! URL::to('/uploads/attachment_files/'.$attachment->file) !!}">Click Here</a></td>
													<td>{!! App\Classes\Helper::showDateTime($attachment->created_at) !!}</td>
													<td>
														@if(Entrust::hasRole('admin') || Auth::user()->username == $attachment->attachment_username)
														{!! Form::open(array('route' => array('attachment.destroy', $attachment->id), 'method' => 'delete')) !!}
													        <button type="submit" class="btn btn-danger btn-xs pull-right" data-submit-confirm-text = "Yes"><i class="fa fa-trash"></i> Delete</button>
													    {!! Form::close() !!}
												        @endif
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>
	@stop