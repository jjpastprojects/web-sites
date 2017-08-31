<div class="normalheader transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <a class="small-header-action" href="">
                <div class="clip-header">
                    <i class="fa fa-arrow-up"></i>
                </div>
            </a>
            <div id="hbreadcrumb" class="pull-right m-t-md">
                <ol class="hbreadcrumb breadcrumb">
                    <li><span>Lastnames</span></li>
                    <li class="active"><span>List</span></li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Lastnames
            </h2>
        </div>
    </div>
</div>

<div class="content animate-panel">
	<div class="row">
		<div class="col-lg-12">
			<div class="hpanel hgreen">
	            <div class="panel-heading">
	                <div class="panel-tools">
	                    <a class="showhide"><i class="fa fa-chevron-up"></i></a>
	                    <a class="closebox"><i class="fa fa-times"></i></a>
	                </div>
                	Lastnames
	            </div>
	            <div class="panel-body table-responsive">
	            	<form action="/admin/lastnames" method="get" class="form-inline">
						<div class="form-group">
					        <input name="search" placeholder="search for lastname" type="text" class="form-control" value="<?php echo form_prep($this->input->get('search'));?>" />
					    </div>
					    <button type="submit" class="btn btn-info">Search</button>
					</form>
					<table class="margin-top table table-hover table-striped">
						<thead>
							<tr>
								<th width="40">#</th>
								<th data-sort-field="lastname">Lastname</th>
								<th data-sort-field="rank">Rank</th>
								<th data-sort-field="occurrences">Number of occurrences</th>
								<th data-sort-field="occurrences_per_100000">Occurrences per 100,000 people</th>
								<th data-sort-field="cum_prop_per_100000">Cumulative proportion per 100,000 people</th>
								<th data-sort-field="p_non_his_w_only">Percent Non-Hispanic White Only</th>
								<th data-sort-field="p_non_his_b_only">Percent Non-Hispanic Black Only</th>
								<th data-sort-field="p_non_his_a_p_only">Percent Non-Hispanic Asian and Pacific Islander Only</th>
								<th data-sort-field="p_non_his_a_i_a_n_only">Percent Non-Hispanic American Indian and Alaskan Native Only</th>
								<th data-sort-field="p_non_his_two_or_more_only">Percent Non-Hispanic of Two or More Races</th>
								<th data-sort-field="p_his_orig">Percent Hispanic Origin</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($lastnames as $l):?>
							<tr style="text-align: center;">
								<td>
									<?php echo $l->id;?>
								</td>
								<td style="text-align: left; font-weight: bold;">
									<?php echo $l->lastname;?>
								</td>
								<td>
									<?php echo $l->rank;?>
								</td>
								<td>
									<?php echo $l->occurrences;?>
								</td>
								<td>
									<?php echo $l->occurrences_per_100000;?>
								</td>
								<td>
									<?php echo $l->cum_prop_per_100000;?>
								</td>
								<td>
									<?php echo $l->p_non_his_w_only;?>%
								</td>
								<td>
									<?php echo $l->p_non_his_b_only;?>%
								</td>
								<td>
									<?php echo $l->p_non_his_a_p_only;?>%
								</td>
								<td>
									<?php echo $l->p_non_his_a_i_a_n_only;?>%
								</td>
								<td>
									<?php echo $l->p_non_his_two_or_more_only;?>%
								</td>
								<td>
									<?php echo $l->p_his_orig;?>%
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
	                <div class="col-sm-12 text-center">
	                	<?php echo isset($pagination) ? $pagination['links'] : '';?>
                	</div>
	            </div>
	        </div>
		</div>
	</div>
</div>

<script>
	$(function() {
		<?php if($this->input->get('search')):?>
           $('table tr td').highlight('<?php echo $this->input->get('search');?>', 'highlight');
        <?php endif;?>

        $('table').thsort({
            current_sort_field : '<?php echo $order_field;?>',
            current_sort_order : '<?php echo $order_dir;?>',
            qs                 : '<?php echo preg_replace('/&?sort=\w+&order=\w+/', '', $_SERVER['QUERY_STRING']);?>',
            current_url        : '<?php echo current_url();?>' 
        });
	});
</script>