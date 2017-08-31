  <link href="<?php echo base_url();?>plugins/lou-multi-select/css/multi-select.css" media="screen" rel="stylesheet" type="text/css">
 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Assign Permission to Company Admin</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin')?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Assign Permission to Company Admin</li>
          </ol>
        </section>	

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8">
              <div class="box">
                 <div class="alert alert-success alert-dismissable" id="Form-Success" style="display: none "></div>
     			 <div class="alert alert-danger alert-dismissable" id="Form-Error" style="display: none"></div>
                <div class="box-header">
                <h3 class="pull-left" style="margin: 0;">Company Admin:<?php if(isset($cname)) echo $cname['name'];?></h3> 	
   				<button class="btn btn-primary pull-right" onclick="window.history.back();">Back</button>
                </div><!-- /.box-header -->
                <div class="box-body">

    <form id="assign_permission">
    	<input type="hidden" value="<?php if(isset($id)) echo $id;?>" id="id" name="id"/>
			<select multiple="multiple" id="permission_select" name="permision_select[]">
			<?php for($i=0;$i<count($permissions);$i++) { ?>
				<option value="<?php if(isset($permissions)) echo $permissions[$i]['id'];?>" <?php if(isset($assign_permission)){if(in_array($permissions[$i]['id'], $assign_permission)){ echo "selected"; }else{if($permissions[$i]['id']=='1'){ echo "selected"; } }  }?> ><?php echo $permissions[$i]['permission_name'] ?></option>	
			<?php } ?>	
    		</select>
	<div class="box-footer ">
		<button type="submit" id="submit_permission"  class="btn btn-primary " style="margin-left:25% ">Submit</button>
	</div>   
  </form>
  
</div><!-- /.box-body -->
</div>
</div>
</div> 
</section>
</div>
 
 <?php $this->view("pages/footer");?>
 </div><!-- ./wrapper -->   
        
<script src="<?php echo base_url();?>plugins/lou-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>dist/js/demo.js"></script>
<script>
	$('#permission_select').multiSelect()
</script>
<script>
// var FormID="assign_moderator";
         
 // var SubmitFile="<?php //echo site_url() ?>/Moderator/Save_permission";
  
 // var RedirectUrl="<?php //echo site_url()?>/Moderator/show_permission";
  
//formvalidation(FormID,SubmitFile,RedirectUrl);
$("#assign_permission").unbind('submit').submit(function(e){
	e.preventDefault();
	$("#Form-Success").html("");
	$("#Form-Error").html("");
	var formData = new FormData(this);
	$.ajax({
	url		:	"<?php echo site_url('admin/addCompantAdminPermission'); ?>",
	type	:	"POST",
	processData: false,
	contentType: false,
	data	:	formData,
	dataType: "JSON",
	success	:	function(data){
	//alert(JSON.stringify(data));	
	var responseData =  JSON.stringify(data);
	 //alert(responseData);
	 var response = JSON.parse(responseData);
// alert(response);
	if (response.status == 1)
	{
	$("#Form-Success").append("<li>"+response.message+"</li>");
	$("#Form-Success").css("display","block");
	window.location='<?php echo site_url('admin'); ?>';
	}else{
	$("#Form-Error").append("<li>"+response.message+"</li>");
	$("#Form-Error").css("display","block");
	 $("#Form-Error").fadeOut(1000);

	}
	$("html, body").animate({ scrollTop: 0 }, "slow");
	}
	});
	//global error is false
	//}
	});

	
//}
</script>
</body>
</html>