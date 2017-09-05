$("formGroup").on('change', function(){
    if($("formGroup").val() == "enum" )
            $("#values").show();

    if($("formGroup").val() != "enum" )
            $("#values").hide();
});

$("formGroup").on('keydown', function(){
    if($("formGroup").val() == "enum" )
            $("#values").show();

    if($("formGroup").val() != "enum" )
            $("#values").hide();
});

$("#column_add").on('click', function(){

   min =new Number($("input[name=min]").val());
   max =new  Number($("input[name=max]").val());


   if(min < max){

       formGroup =  "<div  class=\"form-group\">";
       formGroup += $(".form-group").html();
       formGroup += "</div>";

       formGroup = formGroup.replace("name=\"0\"", "name=\""+min+"\"");

       type = $("input[name=type").val();
       if(type == "enum"){

        formGroup= new DOMParser().parseFromString(formGroup,"text/html" )

        formGroup.getElementsByTagName("option")[0].removeAttribute("selected");
        formGroup.getElementsByTagName("option")[min].setAttribute("selected", "selected");
         
        formGroup = new XMLSerializer().serializeToString(formGroup); 
       }

        $("#form-groups").append(formGroup); 

   }

   min = min+1;
   $("input[name=min]").val(min);
});


$('.save_page').click(function(){
    save_page = $(this);
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    $.post('/page/save',
            {
                title: save_page.attr('page_title')
            },
            function(data, status){
                save_page.attr('value',  save_page.attr('after'));
    });
    
});

$('.delete_page').click(function(){
    save_page = $(this);
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    $.post('/page/delete',
            {
                title: save_page.attr('page_title')
            },
            function(data, status){
                save_page.attr('value',  save_page.attr('after'));
    });
    
});
