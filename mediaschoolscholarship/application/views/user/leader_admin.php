<?php
///user level : admin,leader,agent : 1, leader : 2, admin : 3
    $level="Leader";
    include_once('application/libraries/phpqrcode/qrlib.php');
    
    if (ADMIN==$user['level']){
        $level="Admin";
    }
   
?>

<div class="scoreview">
    <form id="webform"  action="<?php echo site_url("user/update_goal");?>">
    <div class="info">
        <div class="name" >
             <span style="font-weight: bold"> Welcome </span> <?php echo $user['name']; ?> 
        </div>
        <div class="level" >
            <span style="font-weight: bold"> Status: </span> <?php echo $level; ?>
        </div>
        <div class="btnlog" >
            <input type="button" data-clipboard-text="txt" value="Log out" onclick="javascript :confirm_logout();">
        </div>
        
        <div class="progress" >
            <span style="font-weight: bold"> Progress: <?php echo $totalscore; ?></span> out of <?php echo $goal; ?> collected
        </div>
        <!-- 
            Admin : it should display goals
            Leader : number of agents
        -->
        <div class="leader" >  
            <?php if ($user['level']==LEADER): ?>
            <span style="font-weight: bold"> Agents: </span>  <?php echo $agentcnt; ?>
            <?php else: ?>
            <span style="font-weight: bold"> Goal: </span> 
            <input type="number" id="goal" name="goal" value="<?php echo $goal; ?>" style="width:120px; height: 30px;" />
            <?php endif; ?>
        </div>
        
        <?php if ($user['level']==ADMIN ) { 
            
        ?>
             <div class="btnlog"  >
                <input type="button" id="update_goal" value="Update Goal" onclick="javascript :update_goal();">
            </div>
            <div class="btnlog"  >
                <input type="button" value="Close Webform" onclick="javascript :confirm_logout();">
            </div>
            <div class="refreshdiv">
                <input type="button" class="refresh" onclick="window.location.href='/medschool/index.php';"/>
            </div>
        <?php } 
        if ($user['level']==LEADER ) { 
        ?>
        <div class="score"  >
           <span style="font-weight: bold"> My Team Score: <?php echo $teamscore; ?></span>
        </div>
        <?php 
        }
        else{
        ?>
        <div class="score" style="width:180px; float: left; margin-left: 70px; margin-right: 0px;">
           <span style="font-weight: bold"> Leader : </span>
           <select id="leaders">
               <?php 
               foreach ($leaders as $leader){
               ?>
               <option data-score="<?php echo $leader['score']; ?>" value="<?php echo $leader['obj']->id; ?>"><?php echo $leader['obj']->name; ?></option>
               <?php
               }
               ?>
               
           </select>
        </div>    
        <div class="score" style="width:126px; margin-left: 0px; ">
           <span style="font-weight: bold"> Score: </span>
           <span id="leaderscore" ></span>
        </div>    
        <?php
        }
        ?>
    </div>
    </form>
    <div class="status">
        <h3>Current Stats</h3>
        <div class="link" style="width: 550px;">
            <span style="font-weight: bold; width: 120px; display: inline-block; "> Your Link: </span> 
            <span id="linkurl"><?php echo $user['link']?></span>
        </div>
        <div class="btn" style="width: 200px;">
            <input type="button" id="select" value="Select" >
            <input type="button" id="copy-button" value="Copy" >
            
        </div>
        
       <div class="qrcode" style="width:550px;">
            <span style=" font-weight: bold; width: 120px; display: inline-block; position: relative; top: -49px;"> Your QR Code: </span> 
            <img src="qrcodegen.php?id=<?php echo $user['link'];?>" style="margin-top:5px; width:111px; height: 111px;"/>            
        </div>
        
        <div class="btn">
              <?php 
                         if ($user['level']==ADMIN){
                         ?>
            <input type="button" value="Report" style="margin-top:42px;" onclick="document.location.href = '/medschool/index.php/user/report'">
            <?php
                         }
            ?>
        </div>
        <div style="float:left;">
            <form id="agentform" action="<?php echo site_url("user/update_user");?>">
                <input type="hidden" id="id" name="id" value=""/>
                <input type="hidden" id="status" name="status" value=""/>
                <input type="hidden" id="approved" name="approved" value=""/>
                <table cellpadding="0" cellspacing="0" class="agentlist">
                    <tr>
                        <td> Agent </td>
                         <?php 
                         if ($user['level']==ADMIN){
                         ?>
                          <td>Email</td>
                        <?php 
                         }                        
                        
                        ?>
                        <td> Score </td>
                        <td> Active </td>
                        <td> Leader </td>
                        
                        <?php 
                            if ($user['level']==ADMIN){
                        ?>
                        <td> Password </td>
                        <td> Action </td>
                        <?php 
                            }
                       ?>
                    </tr>

                    <?php
                     $status="Yes";
                     $i=0;
                     
                     foreach ($agents as $agent){
                          $status="Yes";
                         if ($agent->status==DISABLED)
                             $status="No";
                        
                    ?>
                    <tr>
                        <td><?php echo $agent->name?></td>
                        <?php 
                         if ($user['level']==ADMIN){
                         ?>
                            <td><?php echo $agent->email?></td>
                        <?php 
                         }                        
                        
                        ?>
                        <td><?php echo $agent->score;?></td>
                        <td id="status<?php echo $agent->id; ?>"><?php echo $status; ?></td>
                        <td><?php echo $agentleaders[$i]; ?></td>
                        
                         <?php 
                            if ($user['level']==ADMIN){
                        ?>
                            <td><?php echo $agent->password; ?></td>
                            <td style="width:70px;  ">
                                <?php 
                                 if ($agent->status==DISABLED){
                                ?>
                                 <input type="button" value="Enable"  data-status="<?php echo $agent->status; ?>" data-id=<?php echo $agent->id; ?> />
                                <?php 
                                 }
                                 else{
                                ?>
                                 <input type="button" value="Disable"  data-status="<?php echo $agent->status; ?>" data-id=<?php echo $agent->id; ?> />
                                <?php
                                 }
                                ?>
                             </td>
                        <?php 
                        
                            }
                       ?>
                        
                    </tr>
                    <?php
                    $i++;
                     }
                    ?>
                </table>
              </form>
        </div>
    </div>
    <div class="agent">
        <h3>Pending Agents</h3>
        <table cellpadding="0" cellspacing="0" >
            <tr>
                <td> Agent </td>
                <td> Approve </td>                
            </tr>                
            <?php             
             foreach ($pendingagents as $agent){
            ?>
            <tr>
                <td><?php echo $agent->name?></td>
                <td><input type="button" value="Approve"  data-id=<?php echo $agent->id; ?> /></td>                
            </tr>
            <?php
                
             }
            ?>
        </table>
    </div>
   
</div>
<script type="text/javascript">
    var btn;
    function confirm_logout() {
        if(confirm("Do you want to logout?")) { 
            window.location.href = "<?php echo site_url("auth/logout");?>";
        }
    }    
    
     jQuery( document ).ready(function() {
         
         jQuery('.agentlist input[type=button]').click(function(){
             
             jQuery("#id").val(jQuery(this).attr("data-id")); 
             btn=jQuery(this);
              if (jQuery(this).attr("data-status")=="1")
                jQuery("#status").val(0);
              else
                jQuery("#status").val(1);          
              
          jQuery.post( "<?php echo site_url("user/update_user");?>", 
            { 
                id: jQuery(this).attr("data-id"),
                status:jQuery("#status").val(),
                approved:1,
            }
          )
          .done(function( data ) {
              if ("success"==data){
                  var statusid="status"+btn.attr("data-id");
                  
                  if (btn.attr("data-status")=="0"){
                      btn.attr("data-status","1");
                      btn.val('Disable');
                      jQuery("#"+statusid).text('Yes');
                   }
                  else{
                      btn.attr("data-status","0");
                      btn.val('Enable');
                      jQuery("#"+statusid).text('No');
                  }
              }    
              alert( data );
          });
          
          
      });
      
      jQuery('#update_goal').click(function(){
        jQuery.post( "<?php echo site_url("user/update_goal");?>", 
            { goal: jQuery("#goal").val()
            }
          )
          .done(function( data ) {
            alert( data );
            window.location.href='/medschool/index.php';
          });
              //jQuery("#webform").submit();
      });
      
      jQuery('#select').click(function(){
             
              jQuery("#document.body").focus();
      });
      
      jQuery('.agent input[type=button]').click(function(){
          
            
          jQuery.post( "<?php echo site_url("user/update_user");?>", 
            { 
                id: jQuery(this).attr("data-id"),
                status:1,
                approved:1,
            }
          )
          .done(function( data ) {
            alert( data );
            location.reload();
          });
          
      });
      
      jQuery( "#leaders " ).change(function(){
          jQuery('#leaderscore').text(jQuery( "#leaders option:selected" ).attr('data-score'));
      });
  });
  
  
  jQuery( window ).load(function() {
    jQuery('#leaderscore').text(jQuery( "#leaders option:selected" ).attr('data-score'));
    });
  
  var client = new ZeroClipboard( document.getElementById("copy-button") );
  
    client.on( "load", function(client) {
      // alert( "movie is loaded" );

      client.on( "complete", function(client, args) {
        // `this` is the element that was clicked
       
        client.setText( jQuery('#linkurl').text() );
        
      } );
    } );
    
    

</script>