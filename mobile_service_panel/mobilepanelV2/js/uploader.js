function uploadImage(url,formID,fileUpload,fileName,originalName,loading,filePreview,source)
{
        var formData = new FormData($('#'+formID)[0]);   
        var original_name='test';
        /*var ele = document.getElementById(fileUpload);
        var original_name=ele.files[0].name;
        $("."+filePreview).text(original_name);*/
        /*var file_size=ele.files[0].size/1024;
        if(file_size>50){
            $("."+filePreview).text("File Size Exceed from 50KB");
            return false;
        }*/
        
        formData.append('file_upload_name', fileUpload);
        formData.append('source', source);
        $.ajax({
            url: url, 
            type: 'POST',
            //Ajax events
            beforeSend: function(){category_beforeHandler(loading);},
            success: function(response) {
                setTimeout(function(){
                category_completeHandler(response,fileName,originalName,fileUpload,loading,original_name,source);
                },1500);
                },
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            timeout:100000
        });
}

function category_beforeHandler(loading)
{
   $('#'+loading).css('display','inline');
}
function category_completeHandler(response,fileName,originalName,fileUpload,loading,original_name,source)
{
    $('#'+loading).css('display','none');
    var temp=JSON.parse(response);
    if(temp.upload_flag==1){
        $("#"+fileName).val(temp.image_name);
        $("#"+originalName).val(temp.orig_name);
        error_file=true;
    }
    else{
        error_file=false;
        alert(temp.message);
        /*$('#'+fileUpload).css({"border-color": "#CE5454", 
                               "border-weight":"1px", 
                               "border-style":"solid",
                               "boxShadow": " 0 1px 3px 0 #CE5454",
                               "animation":".7s 1 shake linear",
                               "transition":"all 250ms ease-in-out 0s"});*/
    }
}


function addMoreFileUpload(formID,div_id,site_url)
{
    var form_action=site_url+'file/upload_image';
   var length=$("#screen_container").children('.par').length;
   var count=parseInt(length);
   var new_div_id = div_id+'_extra_div'+count;
    var HTML='<div class="par control-group" id="'+new_div_id+'">\
    			    <label for="appThumb" class="control-label">App Screen</label>\
    			    <div class="control-label">\
                        <div data-provides="fileupload" class="fileupload fileupload-new ">\
            				<div class="input-append">\
                				<div class="uneditable-input span3">\
                				    <i class="iconfa-file fileupload-exists"></i>\
                				    <span id="fileupload-preview_'+count+'" class="fileupload-preview"></span>\
                				</div>\
                				<span class="btn btn-file">\
                                    <span class="fileupload-new">Select file</span>\
                				    <span class="fileupload-exists">Change</span>\
                				    <input type="file" name="screen_file" onchange="uploadImage(\''+form_action+'\',\'form1\',\'screen_file\',\'screen_photo_name_'+count+'\',\'screen_original_name_'+count+'\',\'screen_file_loading_'+count+'\',\'fileupload-preview_'+count+'\',\'screen\')" />\
                                    <input type="hidden" id="screen_photo_name_'+count+'" name="screen_photo_name_'+count+'" value="" />\
                                    <input type="hidden" id="screen_original_name_'+count+'" name="screen_original_name_'+count+'" value="" />\
                                </span>\
                                <a class="btn fileupload-exists" onclick="removeFileUpload(\''+new_div_id+'\')"><i class="icon-trash"></i> Remove</a>\
                            </div>\
                            <div id="screen_file_loading_'+count+'" style="display: none;">\
                                <img src="'+site_url+'images/loading2.gif" />\
                            </div>\
        			    </div>\
                    </div>\
    			</div>';
    
    var file_num_counter=$("#file_num_counter").val();
    file_num_counter++;           
    $("#file_num_counter").val(file_num_counter);
    
                
    $('#'+div_id).append(HTML);
}

function removeFileUpload(child_div_id)
{
    //alert(child_div_id);
    $("#" + child_div_id).remove();
    //$('#' + counterImage).val($('#' + counterImage).val()-1);
}

function removeimg(url, Id, classname)
  {
     //alert(classname);return false;
     var baseUrl=url+'file/for_remove_screen';
     var img_id =Id;
   
    $('#'+img_id).remove();
    $.ajax({type:'POST',
         url: baseUrl, 
         data:{"img_id":img_id}, 
         success: function(result){
            if(result){
                $("."+classname).remove();
            }
         }
     });
	 return false;
  }
  