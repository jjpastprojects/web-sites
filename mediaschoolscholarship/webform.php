<head>
    <link rel="stylesheet" type="text/css" href="include/css/layout.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    
     <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
</head>

<?php 
    if (!isset($_REQUEST['agentid'])  ) {
        $agentid=1;
    }
    else{
        $agentid=$_REQUEST['agentid'];
    }
    
    
?>
<form action="index.php/user/webformregister" class="webform" id="webform">
    <input type="hidden" name="agentid" id="agentid" value="<?php echo $agentid; ?>"/>
    Name* : <input type="text" name="name" id="name" required=""/> <br/>
    Email* : <input type="email" name="email" id="email" required=""  pattern="^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$"/> <br/>
    Phone* : <input type="text" name="phone" id="phone" required="" pattern="^\(\d{3}\) ?\d{3}( |-)?\d{4}|^\d{3}( |-)?\d{3}( |-)?\d{4}"/> <br/>
    Home Address : <input type="text" name="address" id="address" required="" pattern="^(?n:(?<address1>(\d{1,5}(\ 1\/[234])?(\x20[A-Z]([a-z])+)+ )|(P\.O\.\ Box\ \d{1,5}))\s{1,2}(?i:(?<address2>(((APT|B LDG|DEPT|FL|HNGR|LOT|PIER|RM|S(LIP|PC|T(E|OP))|TRLR|UNIT)\x20\w{1,5})|(BSMT|FRNT|LBBY|LOWR|OFC|PH|REAR|SIDE|UPPR)\.?)\s{1,2})?)(?<city>[A-Z]([a-z])+(\.?)(\x20[A-Z]([a-z])+){0,2})\, \x20(?<state>A[LKSZRAP]|C[AOT]|D[EC]|F[LM]|G[AU]|HI|I[ADL N]|K[SY]|LA|M[ADEHINOPST]|N[CDEHJMVY]|O[HKR]|P[ARW]|RI|S[CD] |T[NX]|UT|V[AIT]|W[AIVY])\x20(?<zipcode>(?!0{5})\d{5}(-\d {4})?))$"/><br/>
    <input type="submit" value="submit"/>
</form>
<script>
   jQuery( window ).load(function() {
  
        jQuery('#webform').submit(function(e){
            
            e.preventDefault();

            if(!jQuery(this)[0].checkValidity()){
               return false;
            }   
        
          jQuery.post( "index.php/user/webformregister", 
            { 
                name: jQuery("#name").val(),
                agentid: jQuery("#agentid").val(),
                email: jQuery("#email").val(),
                phone: jQuery("#phone").val(),
                address: jQuery("#address").val(),
                
            }
          )
          .done(function( data ) {
             if (data!="Success"){
                 jQuery('#dlgmsg').text(data);
                jQuery('#dialog-message').attr('title','Medschoolscholarship');
                    jQuery( "#dialog-message" ).dialog({

                          modal: true,
                          resizable: false,
                          maxWidth:600,
                            maxHeight: 500,
                            width: 350,
                            height: 250,
                          buttons: {
                           
                          }
                    });
                     $("div").draggable({disabled:true});
                 $("div").removeClass(' ui-draggable-disabled ui-state-disabled');
             }
            else{ 
                alert(1);
                jQuery('#dlgmsg').text("Your leader will contact you with the login information.");
                jQuery('#dialog-message').attr('title','Medschoolscholarship');
                jQuery( "#dialog-message" ).dialog({               
                    modal: true,
                    resizable: false,
                    maxWidth:600,
                      maxHeight: 500,
                      width: 350,
                      height: 250,
                    buttons: {
                      Login: function() {

                            window.location.href = "http://213.240.249.236/medschool/index.php";
                      },
                    }
                  });

                $("div").draggable({disabled:true});
                 $("div").removeClass(' ui-draggable-disabled ui-state-disabled');
             }
              });
         
      });
      });
 </script>
 
 <div id="dialog-message" title="Registration Successful." style="display: none;">
  <p >
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 30px 0;"></span>
    <span id="dlgmsg">Your leader will contact you with the login information.</span>
  </p>
</div>