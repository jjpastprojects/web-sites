	<div class="table-responsive">
		<table class="table table-hover datatable">
			<thead>
				<tr>
					@foreach($col_heads as $col_head)
					@if($col_head == 'Option')
					<th style="width:120px;">{!! $col_head !!}</th>
					@else
					<th>{!! $col_head !!}</th>
					@endif
					@endforeach
				</tr>
			</thead>
			<tbody>
			</tbody>
			@if(isset($col_foots))
			<tfoot>
				<tr>
					@foreach($col_foots as $col_foot)
					<th>{!! $col_foot !!}</th>
					@endforeach
				</tr>
			</tfoot>
			@endif
		</table>
	</div>