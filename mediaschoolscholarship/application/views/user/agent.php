<?php
    
?>

<div class="scoreview">
    <div class="info">
        <div class="name" >
             <span style="font-weight: bold">Welcome </span> <?php echo $user['name']; ?>
        </div>
        <div class="level" >            
            <span style="font-weight: bold"> Status: </span> Agent
        </div>
        <div class="btnlog" >
            <input type="button" value="Log out" onclick="javascript :confirm_logout();">
        </div>
        <div class="progress" >
            <span style="font-weight: bold"> Progress:  <?php echo $totalscore?> </span> out of <?php echo $goal; ?> collected
            
        </div>
        <div class="leader" >
            <span style="font-weight: bold"> Leader: </span> <?php echo $leader['name']?>
        </div>
        
        <div class="score" >
            <span style="font-weight: bold"> Your Score: </span> <?php echo $score?>
        </div>
    </div>
    <div class="detail">
         <div class="link" >
            <span style="font-weight: bold; width: 120px; display: inline-block; "> Your Link: </span> 
            <span id="linkurl"><?php echo $user['link']?></span>
        </div>
        <div class="btn"  style="width: 200px;">
             <input type="button" id="select" value="Select" >
            <input type="button" id="copy-button" value="Copy" >
            
        </div>
        
        <div class="qrcode" >
            <span style=" font-weight: bold; width: 120px; position: relative; top: -49px; display: inline-block;"> Your QR Code: </span>             
            <img src="qrcodegen.php?id=<?php echo $user['link'];?>" style="margin-top:5px; width:111px; height: 111px;"/>            
        </div>
        <div class="btn">
            <input type="button" value="Copy" >
        </div>
    </div>
  
</div>

<script type="text/javascript">

    function confirm_logout() {
        if(confirm("Do you want to logout?")) { 
            window.location.href = "<?php echo site_url("auth/logout");?>";
        }
    }
    jQuery('#select').click(function(){
             
              jQuery("#document.body").focus();
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