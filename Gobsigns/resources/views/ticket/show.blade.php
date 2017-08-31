@extends('layouts.default')

	@section('content')
				<div class="row">
					<div class="col-sm-4">
						<div class="box-info text-center user-profile-2">
							<h4> Ticket # {!! str_pad($ticket->id, 3, 0, STR_PAD_LEFT) !!} </h4>
							<h5>{!! $ticket->ticket_subject !!}</h5>
							<h5>by <strong>{!! $ticket->User->first_name." ".$ticket->User->last_name !!}</strong></h5>
							<h5>({!!$ticket->User->Location->location." in ".$ticket->User->Location->Client->client_name !!} Dept)</h5>
							<ul class="list-group">
							  <li class="list-group-item">
								<span class="badge success">{!! App\Classes\Helper::showDate($ticket->created_at) !!}</span>
								Generated On
							  </li>
							  <li class="list-group-item">
								<span class="label label-success pull-right">{!! ucfirst($ticket->ticket_priority) !!}</span>
								Priority
							  </li>
							  <li class="list-group-item">
								<span class="label label-success pull-right">{!! ucfirst($ticket->ticket_status) !!}</span>
								Status
							  </li>
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
										<h5><strong>Ticket</strong> Description</h5>
										<p>
										{!! $ticket->ticket_description !!}
										</p>
										<hr />


									  {!! Form::open(['route' => 'ticket.updateTicketStatus','role' => 'form', 'class'=>'ticket-status-form']) !!}
									  	<div class="form-group">
										    {!! Form::label('ticket_status','Status',[])!!}
										    {!! Form::select('ticket_status', [
										    	null=>'Select One',
										    	'open' => 'Open',
										    	'closed' => 'Close'
										    	]
										    	, isset($ticket->ticket_status) ? $ticket->ticket_status : '',['class'=>'form-control input-xlarge select2me','placeholder'=>'Select Status'])!!}
									    </div>
									    {!! Form::hidden('ticket_id',$ticket->id) !!}
									    {!! Form::submit('Save',['class' => 'btn btn-primary pull-right']) !!}
									  {!! Form::close() !!}
									  <div class="clear"></div>

									</div>
								</div>
								<div class="tab-pane animated fadeInRight" id="comment">
									<div class="user-profile-content">
										{!! Form::open(['route' => 'ticket_comment.store','role' => 'form', 'class'=>'comment-form']) !!}
										  <div class="form-group">
										    {!! Form::textarea('comment','',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Comment'])!!}
										  </div>
										  {!! Form::hidden('ticket_id',$ticket->id) !!}
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
													{!! Form::open(array('route' => array('ticket_comment.destroy', $comment->id), 'method' => 'delete')) !!}
												        <button type="submit" class="btn btn-danger btn-xs pull-right" data-submit-confirm-text = "Yes"><i class="fa fa-trash"></i> Delete</button>
												    {!! Form::close() !!}
											      @endif
												</div>
											  </li>
											@endforeach
											</ul>
										</div>
									</div>
									<div class="user-profile-content">
									</div>
								</div>
								<div class="tab-pane animated fadeInRight" id="note">
									<div class="user-profile-content">
											@if(isset($note->id))
											{!! Form::open(['method' => 'PUT','route' => ['ticket_note.update', $note->id],'class' => 'note-form']) !!}
											@else
											{!! Form::open(['method' => 'POST','route' => ['ticket_note.store'],'class' => 'note-form']) !!}
											@endif
											   <div class="form-group">
											    {!! Form::textarea('note_content',isset($note->note_content) ? $note->note_content : '',['size' => '30x3', 'class' => 'form-control summernote', 'placeholder' => 'Enter Comment'])!!}
											   </div>
										  {!! Form::hidden('ticket_id',$ticket->id) !!}
										  {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
										{!! Form::close() !!}
									</div>
									<div class="user-profile-content">
									</div>
								</div>
								<div class="tab-pane animated fadeInRight" id="attachment">
									<div class="user-profile-content">
										{!! Form::open(['files'=>'true','route' => 'ticket_attachment.store','role' => 'form', 'class'=>'attachment-form']) !!}
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
										  {!! Form::hidden('ticket_id',$ticket->id) !!}
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
																{!! Form::open(array('route' => array('ticket_attachment.destroy', $attachment->id), 'method' => 'delete')) !!}
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
									<div class="user-profile-content">
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
	@stop