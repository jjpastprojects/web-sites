<?php

class PopUp_Domination_Admin extends PopUp_Domination {
    
    function __construct(){
        parent::check_installed();
    }
    
    /**
    * mailing_ajax()
    *
    * a connecting function for loading in the APIs.
    */
    
    function mailing_ajax(){
        define('POPUP_DOM_PATH',$this->plugin_path);
        include POPUP_DOM_PATH.'inc/provider.php';
    }
    
    /**
    * list_camps()
    *
    * loads up the campaigns from the db for the intial campaign page.
    */
    
    function list_camps(){
        $camps = $this->get_db($this->prefix.'campaigns');
        if(!empty($camps[0])){
            $count = 0;
            foreach($camps as $c){
                $tmp = unserialize($c['data']);
                $toggled[$c['id']] = $tmp['toggled'];
                $temppreview = $tmp['template']['template'];
                $temppreviewcolor = $tmp['template']['color'];
                $temppreviewcolor = strtolower($temppreviewcolor);
                $temppreviewcolor = str_replace(' ','-',$temppreviewcolor);
                $tempname[$c['id']] = $temppreview;
                $previewurl[$c['id']] = $this->theme_url.$temppreview.'/previews/'.$temppreviewcolor.'.jpg';
                if($prevsize[$c['id']] = @getimagesize($previewurl[$c['id']])){
                    $prevsize[$c['id']] = getimagesize($previewurl[$c['id']]);
                    $height[$c['id']] = ($prevsize[$c['id']][1])/1.1;
                    $width[$c['id']] = ($prevsize[$c['id']][0])/1.1;
                }else{
                    $height[$c['id']] = '';
                    $width[$c['id']] = '';
                }
                $count++;
            }
        }else{
            $count = 0; 
        }
        include POPUP_DOM_PATH.'admin/tpl/list_camps.php';
    }
    
    /**
    * promote()
    *
    * works out if the powered by link should appear and saves it.
    */
    
    function promote($in){
        if(isset($_POST['update'])){
            $popdom = $_POST['popup_domination'];
            $this->update('promote', $popdom['promote'],false);
            $this->update('clickbank', $popdom['clickbank'],false);
            $this->saved = true;
        }
        if($promote = $this->option('promote')){
            if($promote == 'Y'){
                $clickbank = $this->option('clickbank');
            }
        } else {
            $promote = 'N';
        }
        if(isset($prev['promote'])){
            $promote = $prev['promote'];
            if($promote == 'Y'){
                $clickbank = (isset($prev['clickbank']))?$prev['clickbank']:'';
            }
        } else {
            $promote = 'N';
        }
        include POPUP_DOM_PATH.'admin/tpl/promote.php';
    }
    
    /**
    * load_abtesting()
    *
    * loads up the a/b campaigns from the db for the intial a/b campaign page.
    */
    
    function load_abtesting(){
        $camps = $this->get_db($this->prefix.'ab');
        if(!empty($camps[0])){
            foreach($camps as $c){
                $temp = unserialize($c['campaigns']);
                foreach($temp as $t){
                    $d = $this->get_db($this->prefix.'campaigns', array('campaign' => $t));
                    $tmp = unserialize($d[0]['data']);
                    $temppreview = $tmp['template']['template'];
                    $temppreviewcolor = $tmp['template']['color'];
                    $temppreviewcolor = strtolower($temppreviewcolor);
                    $temppreviewcolor = str_replace(' ','-',$temppreviewcolor);
                    $tempname[$c['id']][$t] = $temppreview;
                    $previewurl[$c['id']][$t] = $this->theme_url.$temppreview.'/previews/'.$temppreviewcolor.'.jpg';
                    if($prevsize[$c['id']][$t] = @getimagesize($previewurl[$c['id']][$t])){
                        $prevsize[$c['id']][$t] = getimagesize($previewurl[$c['id']][$t]);
                        $height[$c['id']][$t] = ($prevsize[$c['id']][$t][1])/1.1;
                        $width[$c['id']][$t] = ($prevsize[$c['id']][$t][0])/1.1;
                    }else{
                        $height[$c['id']][$t] = '';
                        $width[$c['id']][$t] = '';
                    }
                    $count++;
                }
            }
        }
        include POPUP_DOM_PATH.'admin/tpl/list_ab.php';
    }
    
    /**
    * uploader()
    *
    * loads the PHP file to process the theme uploading process.
    */
    
    function uploader($in){
        include POPUP_DOM_PATH.'admin/tpl/themeuploader.php';
    }
    
    /**
    * awebercookies()
    *
    * sets cookies needed for the aweber API process.
    */
    
    function awebercookies(){
        setcookie('accessToken','',time()-60*60*24*100,'/'.$_POST['wpurl'].'inc/');
        setcookie('accessTokenSecret','',time()-60*60*24*100,'/'.$_POST['wpurl'].'inc/');
        setcookie('awTokenSecret','',time()-60*60*24*100,'/');
        setcookie('awToken','',time()-60*60*24*100,'/');
        setcookie('aw_getlists','',time()-60*60*24*100,'/');
        $this->update('formapi', '', false);
    }
    
    /**
    * upload_theme()
    *
    * saves and unzips the upload zip themes file.
    */
    
    function upload_theme(){
        require(POPUP_DOM_PATH.'php.php');
        $file = new qqUploadedFileXhr();
        $name = $file->getName();
        $save = $file->save(POPUP_DOM_PATH.'/tmp/'.$name);
        if($save == '1')
        {
            $zip = new ZipArchive();
            if ($zip->open(POPUP_DOM_PATH.'/tmp/'.$name) === TRUE) {
                $zip->extractTo(POPUP_DOM_PATH.'themes/');
                $zip->close();
                unlink(POPUP_DOM_PATH.'tmp'.$name);
                echo '{success:true}';
            } 
            else 
            {
                echo 'Cannot use PHP ZIP functionality, please contact your web provider to enable this feature.';
            }

        }
        
        else{
            echo '{success:false}';
        }
        die();
    }
    
    /**
    * checkabname()
    *
    * checks the a/b split campaign name to make sure it's unique.
    */
    
    function checkabname($name){
        $check = $this->get_db($this->prefix.'ab',array('name'=>$name));
        if(empty($check[0])){
            echo 'false';
        }else{
            echo $check[0]['id'];
        }
    }
    
    /**
    * checkcampname()
    *
    * checks the campaign name to make sure it's unique.
    */
    
    function checkcampname($name){
        $table = '';
        $check = '';
        $name = trim($name);
        if ($_POST['type'] == 'campaign') {
            $table = $this->prefix.'campaigns';
            $check = $this->get_db($table,array('campaign'=>$name));
        } else if ($_POST['type'] == 'ab') {
            $table = $this->prefix.'ab';
            $check = $this->get_db($table,array('name'=>$name));
        } else {
            echo 'Unsupported type';
            die();
        }
        if(empty($check[0])){
            echo 'false';
        }else{
            echo $check[0]['id'];
        }
        die();
    }
    
    /**
    * deletecamp()
    *
    * deletes a campaign from the database.
    */
    
    function deletecamp($campid){
        echo $this->delete_db($this->prefix.'campaigns',array('id'=>$campid));
    }
    
    
    /**
    * togglecamp()
    *
    * toggles a campaign from the database.
    */
    
    function togglecamps($campid){
        echo $this->toggle_db($this->prefix.'campaigns',array('id'=>$campid));
    }
    
    
    function togglecamp($in){
        if(isset($in['action']) && $this->verify_token($in['_token'])):
            if(strtolower($in['action']) == 'save'):
                    $update = $in['popup_domination'];
                    if(!isset($_POST['campaignid'])){$campaignid = '0';}else{$campaignid = $_POST['campaignid'];};
                    $superupdate = array();
                    
                    $togglestate = 0;
                    
                    $superupdate['toggled'] = $togglestate;
                    
                    $check = $this->get_db($this->prefix . 'campaigns',array('id' =>$campaignid));
                    if(empty($check[0])){
                        $save = $this->write_db($this->prefix . 'campaigns',array('campaign'=> $campname, 'data' => $superupdate, 'desc' => $campdesc));
                        $this->campid = $save['id'];
                    }else{
                        $save = $this->write_db($this->prefix . 'campaigns',array('campaign'=> $campname, 'data' => $superupdate, 'desc' => $campdesc),true,'id',$campaignid);
                    }
            endif;
        endif;
        echo $togglestate;
        $this->saved = true;
        $this->load_camp($in);
    }

    
    
    /**
    * deletestats()
    *
    * deletes analytics data for the campaign selected for deletion.
    */
    
    function deletestats($campname){
        echo $this->delete_db($this->prefix.'analytics',array('campname'=>$campname));
    }
    
    /**
    * deleteab()
    *
    * deletes a a/b campaign selected for deletion.
    */
        
    function deleteab($campid){
        echo $this->delete_db($this->prefix.'ab',array('id'=>$campid));
    }
    
    /**
    * saveab()
    *
    * saves all the data from the a/b split campaign setup panel.
    */
    
    function saveab($in){
        if(isset($in['action']) && $this->verify_token($in['_token'])):
            if(strtolower($in['action']) == 'save'):
                $ab['name'] = stripslashes($_POST['campname']);
                $ab['desc'] = stripslashes($_POST['campaigndesc']);
                $ab['campaigns'] = serialize($_POST['campaign']);
                $ab['settings'] = serialize(array('visitsplit' => $_POST['numbervisitsplit'], 'page' => $_POST['conversionpage']));
                if(isset($_GET['id'])){
                    $camp_id = $_GET['id'];
                    $data = $this->get_db($this->prefix.'ab',array('id'=>$camp_id));
                }else{
                    $data = $this->get_db($this->prefix.'ab',array('name'=>$ab['name']));
                }   
                if(empty($data[0])){
                    $save = $this->write_db($this->prefix.'ab',array('campaigns'=> $ab['campaigns'], 'absettings' => $ab['settings'], 'name' => $ab['name'], 'desc' => $ab['desc']));
                    $this->campid = $save['id'];
                }else{
                    $save = $this->write_db($this->prefix.'ab',array('campaigns'=> $ab['campaigns'], 'absettings' => $ab['settings'], 'name' => $ab['name'], 'desc' => $ab['desc']),true, 'id', $camp_id);
                }
                $this->update_msg = 'Settings saved.';
            endif;
        endif;
        $this->saved = true;
        $furl = $this->plugin_url.'admin/index.php?section=absplit&action=edit&id='.$this->campid.'&message=1';
        echo '<script>window.location.href="'.$furl.'"</script>';
    }
    
    /**
    * abpanel()
    *
    * saves all the data from the a/b split campaign setup panel.
    */
    
    function abpanel($in){
        $id = -1;
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data = $this->get_db($this->prefix.'ab',array('id'=>$id));
            $abdesc = $data[0]['desc'];
            $abname = $data[0]['name'];
            $ab_campaigns = unserialize($data[0]['campaigns']);
            $absettings = unserialize($data[0]['absettings']);
            $abstats = unserialize($data[0]['astats']);
        }else{
            $campaigns = array();
        }
        $campaigns = $this->get_db($this->prefix.'campaigns');
        include POPUP_DOM_PATH.'admin/tpl/abpanel.php';
    }
    
    /**
    * load_analytics()
    *
    * loads all the data for the analytics page.
    */
    
    function load_analytics(){
        $data = array();
        $camps = $this->get_db($this->prefix.'campaigns');
        foreach($camps as $c){
            $tmp = $this->get_db($this->prefix.'analytics', array('campname' => $c['campaign']));
            $line = $data[] = $tmp[0];
            $id[$c['id']] = $tmp[0]['id'];
            $name = $c['campaign'];
            $tmp = unserialize($c['data']);
            $temppreview = $tmp['template']['template'];
            $temppreviewcolor = $tmp['template']['color'];
            $temppreviewcolor = strtolower($temppreviewcolor);
            $temppreviewcolor = str_replace(' ','-',$temppreviewcolor);
            $previewurl[$c['id']] = $this->theme_url.$temppreview.'/previews/'.$temppreviewcolor.'.jpg';
            $anay[$name] = $line;
            if($prevsize[$c['id']] = @getimagesize($previewurl[$c['id']])){
                $prevsize[$c['id']] = getimagesize($previewurl[$c['id']]);
                $height[$c['id']] = ($prevsize[$c['id']][1])/1.1;
                $width[$c['id']] = ($prevsize[$c['id']][0])/1.1;
            }else{
                $height[$c['id']] = '';
                $width[$c['id']] = '';
            }
        }
        include POPUP_DOM_PATH.'admin/tpl/list_analytics.php';
    }
    
    /**
    * mailing_settings()
    *
    * loads up all the defaults for the mailing panel settings.
    */
    
    function mailing_settings($in){
        $formhtml = $this->option('formhtml');
        if(empty($formhtml)){
            $apidata = $this->option('formapi');
            $apidata = unserialize(base64_decode($apidata));
            $formhtml = '';
        }else{
            $form = $this->input_val($formhtml);
            $name_box =  $this->option('name_box');
            $email_box = $this->option('email_box');
            $custom1_box = $this->option('custom1_box');
            $custom2_box = $this->option('custom2_box');
            $hidden = $this->option('hidden_fields');
            $apidata = '';
        }
        $redirecturl = $this->option('redirecturl');
        $this->update_msg = 'Settings saved.';
        
        include POPUP_DOM_PATH.'admin/tpl/mailingpanel.php';
    }
    
    /**
    * save_mailing()
    *
    * Big function for saving all the mailing list data after user hits Save.
    */
        
    function save_mailing($in){
        if(isset($_POST['submit'])){
            $mailingdata = $_POST;
            $arr = array('provider','password','apikey','apiextra','password', 'username', 'listsid', 'customf', 'custom1', 'custom2', 'cc_custom1', 'cc_custom2', 'listname','redirecturl', 'disablename');            
            foreach($arr as $a){
                if(isset($_POST[$a])){
                    $data[$a] = $_POST[$a];
                }
            }
            
            if(isset($data['disablename']) && $data['disablename'] != ''){
                $this->option('disable_name', 'Y', false);
            }else{
                $this->option('disable_name', 'N', false);
            }
            
            $this->option('formapi', base64_encode(serialize($data)), false);
            if($data['provider'] == 'nm'){
                $this->update('action', $this->plugin_url.'inc/email.php', false);
            }else{
                $this->update('action', '', false);
            }
            
            
            
            if(!empty($data['redirecturl'])){
                if(!empty($mailingdata['redirecturl'])){
                    $this->update('redirecturl', $mailingdata['redirecturl']);
                    $this->update('redirectcheck', 'Y');
                }else{
                    $this->update('redirecturl', '');
                    $this->update('redirectcheck', 'N');
                }
            }else{
                $this->update('redirecturl', '');
                $this->update('redirectcheck', 'N');
            }
            $this->option('formhtml', '', false);
        }else{  
            if(isset($_POST['customformsubmit'])){
                $customform = $_POST;
                if(isset($customform['popup_domination']['action'])){
                    $this->update('action', $customform['popup_domination']['action'], false);
                }else{
                    $this->update('action', '', false);
                }
                if(isset($customform['popup_domination']['name_box'])){
                    $this->update('name_box', $this->encode2($customform['popup_domination']['name_box']), false);
                }else{
                    $this->update('name_box', '', false);
                }
                if(isset($customform['popup_domination']['email_box'])){
                    $this->update('email_box', $customform['popup_domination']['email_box'], false);
                }else{
                    $this->update('email_box', '', false);
                }
                if(isset($customform['popup_domination']['custom1_box'])){
                    $this->update('custom1_box', $customform['popup_domination']['custom1_box'], false);
                }else{
                    $this->update('custom1_box', '', false);
                }
                if(isset($customform['popup_domination']['custom2_box'])){
                    $this->update('custom2_box', $customform['popup_domination']['custom2_box'], false);
                }else{
                    $this->update('custom2_box', '', false);
                }
                if(isset($customform['popup_domination']['formhtml'])){
                    $this->update('formhtml', $this->encode2($customform['popup_domination']['formhtml']));
                }else{
                    $this->update('formhtml', '', false);
                }
                if(isset($customform['popup_domination']['new_window'])){
                    $this->option('new_window', $customform['popup_domination']['new_window'], false);
                }else{
                    $this->option('new_window', 'N', false);
                }
                if(isset($customform['popup_domination']['hidden_fields'])){
                    $this->update('hidden_fields', $this->encode2($customform['popup_domination']['hidden_fields']), false);
                }else{
                    $this->update('hidden_fields', '', false);
                }
                if(isset($customform['popup_domination']['disable_name']) && $customform['popup_domination']['disable_name'] != ''){
                    $this->option('disable_name', $customform['popup_domination']['disable_name'], false);
                }else{
                    $this->option('disable_name', 'N', false);
                }
                
                $data['provider'] = 'form';
                $this->option('formapi', base64_encode(serialize($data)), false);
            }
        }
        $formhtml = $this->option('formhtml');
        if(empty($formhtml)){
            $apidata = $this->option('formapi');
            $apidata = unserialize(base64_decode($apidata));
            $formhtml = '';
        }else{
            $form = $this->input_val($formhtml);
            $name_box =  $this->option('name_box');
            $email_box = $this->option('email_box');
            $custom1_box = $this->option('custom1_box');
            $custom2_box = $this->option('custom2_box');
            $apidata = '';
        }
        $redirecturl = $this->option('redirecturl');
        $redirectcheck = $this->option('redirectcheck');
        $this->update_msg = 'Settings saved.';
        if(!isset($campaignid)){
            $campaignid = '';   
        }
        if(!isset($name_box)){
            $name_box = ''; 
        }
        if(!isset($email_box)){
            $email_box = '';    
        }
        $this->saved = true;
        $this->mailing_settings($in);
    }
    
    /**
    * show_analytics()
    *
    * loads all the data to show on the analytics front page.
    */
    
    function show_analytics(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $data = $this->get_db($this->prefix.'analytics', array('id' => $id));
            $prevmonths = unserialize($data[0]['previousdata']);
        }
        include POPUP_DOM_PATH.'admin/tpl/analytics_panel.php';
    }
    
    /**
    * save_camps()
    *
    * saves all the data set in the campaign creation panel to the DB.
    */

    function save_camps($in){
        if(isset($in['action']) && $this->verify_token($in['_token'])):
            if(strtolower($in['action']) == 'save'):
                    $update = $in['popup_domination'];
                    if(!isset($_POST['campaignid'])){$campaignid = '0';}else{$campaignid = $_POST['campaignid'];};
                    $superupdate = array();
                    $tmparr = array('template', 'color', 'button_color');       
                    $fieldsarr = array();
                    $tmpsch = array('cookie_time','delay','unload_msg', 'impression_count', 'show_opt');
                    $tmparr2 = array('clickbank' => $this->option('clickbank'), 'disable_name' => 'N', 
                                     'unload_msg' => $this->option('unload_msg'), 'new_window' => 'N');
                    $arr = array();
                    $arrt = array();
                    foreach($tmparr as $t){
                        if(!isset($update[$t])){
                            $update[$t] = '';
                            if(isset($tmparr2[$t]) && $tmparr2[$t])
                                $update[$t] = $tmparr2[$t];
                        }
                        $arr[$t] = strtolower(stripslashes($update[$t]));
                        $arr[$t] = str_replace(' ','-',$arr[$t]);
                    }
                    foreach($tmpsch as $t){
                        if(!isset($update[$t])){
                            $update[$t] = '';
                            if(isset($tmparr2[$t]) && $tmparr2[$t])
                                $update[$t] = $tmparr2[$t];
                        }
                        $arrsch[$t] = stripslashes($update[$t]);
                    }
                    $t = $this->get_theme_info($update['template']);
                    if(isset($t['fields']) && count($t['fields']) > 0 && isset($in['popup_domination_fields'])){
                        foreach($t['fields'] as $f){
                            $arr['field_'.$f['field_opts']['id']] = $in['popup_domination_fields'][$f['field_opts']['id']];
                        }
                    }
                    $campname = stripslashes($_POST['campname']);
                    $campdesc = stripslashes($_POST['campaigndesc']);
                    foreach($arr as $a => $b){
                        $superupdate['template'][$a] = $b;
                    }
                    foreach($arrsch as $a => $b){
                        $superupdate['schedule'][$a] = $b;
                    }
                    $this->option('formhtml',$this->encode2($update['formhtml']),false);
                    $fields = array();
                    if(isset($in['field_name']) && isset($in['field_vals']) && count($in['field_name']) == count($in['field_vals'])){
                        $fl = count($in['field_name']);
                        for($i=0;$i<$fl;$i++){
                            if(!empty($in['field_name'][$i])){
                                $fields[$in['field_name'][$i]] = $in['field_vals'][$i];
                            }
                        }
                    }
                    $images = array();
                    if(isset($in['field_img']) && count($in['field_img'])){
                        $img = $in['field_img'];
                        $fl = count($img);
                        for($i=0;$i<$fl;$i++){
                            if(!empty($img[$i])){
                                $images[] = $img[$i];
                            }
                        }
                    }
                    $superupdate['images'] = $images;
                    
                    $togglestate = 0;
                    
                    $superupdate['toggled'] = $togglestate;
                    
                    $list = array();
                    if(isset($in['list_item']) && count($in['list_item']) > 0){
                        foreach($in['list_item'] as $l){
                            $list[] = $l;
                        }
                    }
                    
                    $superupdate['list'] = $list;
                    if(isset($superupdate['template']['field_fb-sec']) && !empty($superupdate['template']['field_fb-sec']) && isset($superupdate['template']['field_fb-id']) && !empty($superupdate['template']['field_fb-id'])){
                        $this->update('facebook_enabled','Y');
                        $this->update('facebook_sec', $superupdate['template']['field_fb-sec']);
                        $this->update('facebook_id', $superupdate['template']['field_fb-id']);
                    }else{
                        $this->update('facebook_enabled','N');
                        
                    }
                    $superupdate['num_cus'] = $_POST['extra_fields'];
                    $superupdate = serialize($superupdate);
                    if(empty($arr['color'])){
                        $arr['color'] = 'blue';
                    }
                    if(empty($arr['template'])){
                        $arr['template'] = 'lightbox';
                    }
                    if(empty($arr['button_color'])){
                        $arr['button_color'] = 'blue';
                    }
                    $extra_fields = $this->update('custom_fields', $_POST['extra_fields'] ,false);
                    $this->option('last_modified',gmdate("D, d M Y H:i:s"));
                    
                    $msg = '<div class="updated fade"><p><strong>Settings saved.</strong></p></div>';
                    $check = $this->get_db($this->prefix . 'campaigns',array('id' =>$campaignid));
                    if(empty($check[0])){
                        $save = $this->write_db($this->prefix . 'campaigns',array('campaign'=> $campname, 'data' => $superupdate, 'desc' => $campdesc));
                        $this->campid = $save['id'];
                    }else{
                        $save = $this->write_db($this->prefix . 'campaigns',array('campaign'=> $campname, 'data' => $superupdate, 'desc' => $campdesc),true,'id',$campaignid);
                    }
            endif;
        endif;
        $this->saved = true;
        $this->load_camp($in);
    }
    
    /**
    * load_camp()
    *
    * loads all the data needed when editing a campaign.
    */
    
    function load_camp($in){
        $templates = $this->get_themes();
        if(isset($_GET['id'])){
            $camp_id = $_GET['id'];
            $this->campid = $camp_id;
            $data = $this->get_db($this->prefix.'campaigns',array('id' =>$camp_id));
            $campaignid = $data[0]['id'];
            $campaign = unserialize($data[0]['data']);
            $campname = $data[0]['campaign'];
            $val = $campaign;
            $valtemp = $campaign['template']['template'];
            $valc = $campaign['template']['color'];
            $valbuttonc = $campaign['template']['button_color'];
            $campdesc =  $data[0]['desc'];
        }else if(isset($this->campid) && $this->campid != ''){
            $camp_id = $this->campid;
            $data = $this->get_db($this->prefix.'campaigns',array('id' =>$camp_id));
            $campaignid = $data[0]['id'];
            $campaign = unserialize($data[0]['data']);
            $campname = $data[0]['campaign'];
            $val = $campaign;
            $valtemp = $campaign['template']['template'];
            $valc = $campaign['template']['color'];
            $valbuttonc = $campaign['template']['button_color'];
            $campdesc =  $data[0]['desc'];
        }else{
            $valtemp = 'lightbox';
            $valc = 'blue';
            $valbuttonc = 'blue';
            $this->campaigndata = '';
            $campaignid = '';
            $val = '';
            $campaign = array('template' => '','images' => '','list' => '');
        }
        $js = '{'; $counter = 0; $opts = $opts2 = $field_str = $cur_preview = ''; 
        $cur_theme = $cur_size = array();
        $opts2 = '';
        foreach($templates as $t){
            $selected = false;
            if($t['theme'] == $valtemp){
                $selected = true;
                if(isset($t['colors'])){
                    foreach($t['colors'] as $c){
                        $selected2 = false;
                        $valc = strtolower($valc);
                        $valc = str_replace(' ','-',$valc);
                        if($valc == $c['info'][0]){
                            $selected2 = true;
                            $cur_preview = (isset($c['info'][2])) ? $c['info'][2] : '';
                            if(isset($t['size']))
                                $cur_size = $t['size'];
                        }
                        if($valc == $c['info'][0]){
                            $opts2 = $valc;
                        }
                    }
                } elseif(isset($t['img'])){
                    $cur_preview = $t['img'];
                }
            }
            if(empty($opts2)){
                $opts2 = 'blue';
            }
            $opts .= '<option value="'.$t['theme'].'"'.(($t['theme']==$valtemp)?' selected="selected"':'').'>'.$t['name'].'</option>';
            $js .= (($counter>0)?',':'').'"'.$t['theme'].'":{';
            if(count($t['colors']) > 0){
                $js .= '"colors":[';
                $count = 0;
                foreach($t['colors'] as $c){
                    $js .= (($count > 0)?',':'').'{"name":"'.$this->input_val($c['name']).'","options":["'.$this->input_val($c['info'][0]).'","'.$this->input_val($c['info'][1]).'"]'.((isset($c['info'][2]))?',"preview":"'.$this->input_val($c['info'][2]).'"':'').'}';
                    $count++;
                }
                $js .= '],';
            } elseif(isset($t['img'])){
                $js .= '"preview_image":"'.$t['img'].'",';              
            }
            if(isset($t['button_colors']) && count($t['button_colors']) > 0){
                $js .= '"button_colors":[';
                $count = 0;
                foreach($t['button_colors'] as $c){
                    $js .= (($count>0)?',':'').'{"name":"'.$c['name'].'","color_id":"'.$c['color_id'].'"}';
                    $count++;
                }
                $js .= '],';
            }
            if(isset($t['fields']) && is_array($t['fields']) && count($t['fields']) > 0){
                $js .= '"fields":[';
                $count = 0;
                foreach($t['fields'] as $f){
                    $type = 'text';
                    if(isset($f['field_opts']['type'])){
                        $type = $f['field_opts']['type'];
                    }
                    $tmp = array('"type":"'.$type.'"');
                    if($selected){
                        $field_str .= '<p id="popup_domination_field_'.$f['field_opts']['id'].'">';
                        $fieldid = 'popup_domination_field_'.$f['field_opts']['id'].'_field';
                        $field_str .= '<label for="'.$fieldid.'">'.$f['name'].'</label><span class="line">&nbsp;</span>';
                        if(isset($campaign['template']['field_'.$f['field_opts']['id']])){
                            $val = $campaign['template']['field_'.$f['field_opts']['id']];
                        }else{
                            $val = '';
                        }
                        switch($type){
                            case 'textarea':
                                $field_str .= $this->maxlength_txt($f,$val).'<br /><textarea cols="60" rows="5" name="popup_domination_fields['.$f['field_opts']['id'].']" id="'.$fieldid.'">'.$this->input_val($val).'</textarea>';
                                break;
                            case 'videoembed':
                                $field_str .= '<textarea cols="60" rows="5" name="popup_domination_fields['.$f['field_opts']['id'].']" id="'.$fieldid.'">'.$this->input_val($val).'</textarea>'.$this->videosize($f);
                                break;
                            case 'image':
                                $field_str .= '<input type="text" name="popup_domination_fields['.$f['field_opts']['id'].']" id="popup_domination_field_'.$f['field_opts']['id'].'_field" value="'.$this->input_val($val).'" /> Resizes to: (max width: '.$f['field_opts']['max_w'].', max height: '.$f['field_opts']['max_h'].') <a href="#upload_file" class="button file_upload">Upload file</a><span id="popup_domination_field_'.$f['field_opts']['id'].'_field_btns"'.(($val=='')?' style="display:none"':'').'> | <a href="#remove" class="button">Remove</a></span> <img class="waiting" style="display:none;" src="images/wpspin_light.gif" alt="" /> <span id="popup_domination_field_'.$f['field_opts']['id'].'_error" style="display:none"></span><br />Want to create a stunning eCover design to put here? Check out <a href="http://nanacast.com/vp/95449/69429/" target="_blank">eCover Creator 3D</a>.';
                                break;
                            default:
                                $field_str .= '<input type="'.$type.'" name="popup_domination_fields['.$f['field_opts']['id'].']" id="'.$fieldid.'" value="'.$this->input_val($val).'" />'.$this->maxlength_txt($f,$val);       
                                break;
                        }
                        $field_str .= '</p>';
                    }
                    foreach($f['field_opts'] as $a => $b){
                        if($a!='type')
                            $tmp[] = '"'.$a.'":"'.$b.'"';
                    }
                    $tmp = '{'.implode(',',$tmp).'}';
                    $js .= (($count > 0)?',':'').'{"name":"'.$this->input_val($f['name']).'","opts":'.$tmp.'}';
                    $count++;
                }
                $js .= '],';
            }
            if(isset($t['size']) && count($t['size']) == 2){
                $js .= '"preview_size":["'.$t['size'][0].'","'.$t['size'][1].'"],';
            }
            $lcount = 0;
            if(isset($t['list'])){
                $lcount = $t['list'];
            }
            if($selected){
                $t['list_count'] = $lcount;
                $cur_theme = $t;
            }
            $js .= '"list_count":"'.$this->input_val($lcount).'"';
            $counter++;
            if(isset($t['numfields'])){
                $this->custominputs = $t['numfields'];                  
            }else{
                $this->custominputs = 0;
            }
            $js .= ',"numfields":'.$this->custominputs.'}';
        }
        $js .= '}';
        $formhtml = $this->input_val($this->option('formhtml'));
        $options = array('name_box','email_box');
        foreach($options as $o)
            $$o = $this->input_val($this->option($o));
        $fields = '';
        if($f = $campaign['template']){
            if(!empty($f)){
                if(is_array($f))
                    $fieldsarr = $f;
                else
                    $fieldsarr = unserialize($f);
                foreach($fieldsarr as $a => $b)
                    $fields .= '<input type="hidden" name="field_name[]" value="'.$this->input_val($a).'" /><input type="hidden" name="field_vals[]" value="'.$this->input_val($b).'" />';
            }
        }
        if($f = $campaign['images']){
            if(!empty($f)){
                if(is_array($f))
                    $fieldsarr = $f;
                else
                    $fieldsarr = unserialize($f);
                foreach($fieldsarr as $b)
                    $fields .= '<input type="hidden" name="field_img[]" value="'.$this->input_val($b).'" />';
            }
        }
        $listitems = '';
        if($l = $campaign['list']){
            if(!empty($l)){
                if(is_array($l))
                    $list = $l;
                else
                    $list = unserialize($l);
                $count = 1;
                foreach($list as $a){
                    $class = '';
                    if(isset($cur_theme['list_count']) && $count > $cur_theme['list_count'])
                        $class = 'over';
                    $listitems .= '
                            <li'.(($class=='')?'':' class="'.$class.'"').'><input type="text" name="list_item[]" value="'.$this->input_val($this->encode($a)).'" /> <a href="#delete" class="thedeletebutton remove_list_item">Delete</a><div class="clear"></div></li><div class="clear"></div>';
                    $count++;
                }
            }
        }
        $show_opt = $campaign['schedule']['show_opt'];
        include POPUP_DOM_PATH.'admin/tpl/admin_panel.php';
    }
    
    /**
    * preview()
    *
    * gathers all the data and sends it through the ajax to produce up to date preview popup.
    */
        
    function preview(){
        global $in;
        if(!$this->verify_token($in['_token'])){
            exit('<p>You do not have permission to view this</p>');
        }
        $this->is_preview = true;
        $prev = $in['popup_domination'];
        $t = $prev['template'];
        if(!$themeopts = $this->get_theme_info($t)){
            exit('<p>The theme you have chosen could not be found.</p>');
        }
        if(isset($themeopts['colors']) && !($color = $this->option('color'))){
            exit('<p>You must first select a color for your theme.</p>');
        }
        if(isset($prev['color']))
            $color = $prev['color'];
            $color = strtolower($color);
            $color = str_replace(' ','-',$color);
        $clickbank = '';
        if(isset($prev['promote'])){
            $promote = $prev['promote'];
            if($promote == 'Y'){
                $clickbank = (isset($prev['clickbank']))?$prev['clickbank']:'';
            }
        } else {
            $promote = 'N';
        }
        $target = (isset($prev['new_window']) && $prev['new_window'] == 'Y') ? ' target="_blank"':'';
        $inputs = array();
        if(isset($prev['name_box']))
            $inputs['name'] = $prev['name_box'];
        if(isset($prev['email_box']))
            $inputs['email'] = $prev['email_box'];
        $tmp_fields = $in['popup_domination_fields'];
        $fields = array();
        foreach($tmp_fields as $a => $b)
            $fields[$a] = $this->encode($b);
        $inputs['hidden'] = '';
        if(isset($in['field_name']) && isset($in['field_vals']) && count($in['field_name']) == count($in['field_vals'])){
            $fl = count($in['field_name']);
            for($i=0;$i<$fl;$i++){
                if(!empty($in['field_name'][$i]) && $inputs['name'] != $in['field_name'][$i] && $inputs['email'] != $in['field_name'][$i]){
                    $inputs['hidden'] .= '<input type="hidden" name="'.$this->input_val($in['field_name'][$i]).'" value="'.$this->input_val($in['field_vals'][$i]).'" />';
                }
            }
        }
        if(isset($in['field_img']) && count($in['field_img'])){
            $fl = count($in['field_img']);
            for($i=0;$i<$fl;$i++){
                if(!empty($in['field_img'][$i])){
                    $inputs['hidden'] .= '<div style="display:none"><img src="'.$in['field_img'][$i].'" alt="" width="1" height="1" /></div>';
                }
            }
        }
        $form_action = $this->encode($prev['action']);
        $list_items = array();
        if(isset($in['list_item'])){
            $tmp_items = $in['list_item'];
            foreach($tmp_items as $tmp)
                $list_items[] = $this->encode($tmp);
        }
        $disable_name = 'N';
        if(isset($prev['disable_name']) && $prev['disable_name'] == 'Y'){
            $disable_name = 'Y';
        }
        $delay = $prev['delay'];
        $center = $themeopts['center'];
        $delay_hide = '';
        $button_color = isset($prev['button_color']) ? $prev['button_color'] : '';
        $base = dirname($this->base_name);
        $theme_url = $this->theme_url.$t.'/';
        $lightbox_id = 'popup_domination_lightbox_wrapper';
        $lightbox_close_id = 'popup_domination_lightbox_close';
        $lightbox_submit_id = 'popup_domination_opt_in';
        $cookie_time = $icount = 0;
        $custom1 = $this->option('custom1_box');
        $custom2 = $this->option('custom2_box');
        $fstr = '';
        $arr = array();
        if($disable_name == 'N'){
            $arr[] = array('class'=>'name','default'=>((isset($fields['name_default'])) ? $fields['name_default'] : ''), 'name'=>((isset($inputs['name']))?$inputs['name']:''));
        }
        $arr[] = array('class'=>'email','default'=>((isset($fields['email_default'])) ? $fields['email_default'] : ''), 'name'=>((isset($inputs['email']))?$inputs['email']:''));
        if(isset($fields['custom1_default'])){
            if($provider != 'aw' && $provider != 'form'){
                $arr[] = array('class'=>'custom1_input','default'=>((isset($fields['custom1_default'])) ? $fields['custom1_default'] : ''), 'name' => 'custom1_default');
            }else if($provider == 'aw'){
                $arr[] = array('class'=>'custom1_input','default'=>((isset($fields['custom1_default'])) ? $fields['custom2_default'] : ''), 'name' => 'custom '.$api['custom1']);
            }else{
                $arr[] = array('class'=>'custom1_input','default'=>((isset($fields['custom1_default'])) ? $fields['custom2_default'] : ''), 'name' => $custom1);
            }
        }
        if(isset($fields['custom2_default'])){
            if($provider != 'aw' && $provider != 'form'){
                $arr[] = array('class'=>'custom2_input','default'=>((isset($fields['custom2_default'])) ? $fields['custom2_default'] : ''), 'name' => 'custom2_default');
            }else if($provider == 'aw'){
                $arr[] = array('class'=>'custom2_input','default'=>((isset($fields['custom2_default'])) ? $fields['custom2_default'] : ''), 'name' => 'custom '.$api['custom2']);
            }else{
                $arr[] = array('class'=>'custom2_input','default'=>((isset($fields['custom2_default'])) ? $fields['custom2_default'] : ''), 'name' => $custom2);
            }
                }
        $fstr = '';
        foreach($arr as $a){
            $fstr .= '<input type="text" class="'.$a['class'].'" value="'.$a['default'].'" name="'.$a['name'].'" />';
        }
        $promote_link = (($promote=='Y') ? '<p class="powered"><a href="'.((!empty($clickbank))?'http://'.$clickbank.'.popdom.hop.clickbank.net/':'http://www.popupdomination.com/').'" target="_blank">Powered By PopUp Domination</a></p>':'');
        ob_start();
        include $this->theme_path.$t.'/template.php';
        $output = ob_get_contents();
        ob_end_clean();
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head profile="http://gmpg.org/xfn/11">
<script type="text/javascript" src="../javascript/jquery-1.7.min.js"></script>
<script type="text/javascript" src="../javascript/lightbox-preview.js"></script>
<link rel="stylesheet" type="text/css" href="../themes/'.$t.'/lightbox.css" />
</head><body><p style="text-align:center"><a href="#open">Re-open lightbox</a></p>'.$output.'
<script type="text/javascript">
'.$this->generate_js($delay,$center,$cookie_time,$arr,$show_opt,$unload_msg,0,'').'
</script>
</body></html>';
        exit;
    }
    
    /**
    * maxlength_txt()
    *
    * small function that shows used and remaining charcters for advised field content length.
    */

    function maxlength_txt($f,$val){
        if(isset($f['field_opts']['max'])){
            $max = intval($f['field_opts']['max']);
            $len = strlen($val);
            $txt = ' Recommended '.$max;
            $class = 'green';
            $msg = 'remaining <span>'.($max-$len).'</span>';
            if(strlen($val) > $f['field_opts']['max']){
                $class = 'red';
                $msg = 'hmm, you\'re over the limit, it might look bad';
            }
            return '<span class="recommended"><span class="'.$class.'">'.$txt.'</span> <span class="note">('.$msg.')</span></span>';
        }
        return '';
    }
    
    /**
    * videosize()
    *
    * sets a reccomended video size when the video fields are available.
    */
    
    function videosize($f){
        if(isset($f['field_opts']['max_w']) && isset($f['field_opts']['max_h'])){
            $max_w = intval($f['field_opts']['max_w']);
            $max_h = intval($f['field_opts']['max_h']);
            return '<span class="recommended"><span class="green">Recommended Video Size</span>: height = <strong>'.$max_h.'</strong>, width = <strong>'.$max_w.'</strong>.</span>';
        }
        return '';
    }
    
    /**
    * check_admin()
    *
    * checks that the admin email and the admin password is correct
    */
    
    function check_admin($email,$pass){
        global $popup_config;
        $pass = md5($popup_config['salt'].$pass);
        if($email == $this->option('admin_email') && $pass == $this->option('admin_pass')){
            $_SESSION['popup_dom_user'] = md5($popup_config['salt'].$email.'_'.$pass);
            header('Location: ./');
            exit;
        } else {
            return 'The email and password is incorrect.';
        }
    }
    
    /**
    * logout()
    *
    * logs out the user from the admin panel.
    */
    
    function logout(){
        session_destroy();
        header('Location: ./');
        exit;
    }
    
    /**
    * check_reset_code()
    *
    * compares the temp reset code with the users entered tmp password.
    */
    
    function check_reset_code(){
        global $popup_config;
        $v = 'popup_dom_user';
        $tmp = $this->option('resetcode');
        if(isset($tmp) && !empty($tmp)){
            if($_POST['login']['code'] == $tmp){
                $empty = $this->option('resetcode', '');
                echo 'worked!';
                $pass = $this->option('admin_pass', md5($popup_config['salt'].$_POST['login']['pass']));
                return true;
            } else {
                $empty = $this->option('resetcode', '');
                return false;
            }
        }
        return false;
    }
    
    /**
    * logged_in()
    *
    * checks if the user is logged in.
    */
    
    function logged_in(){
        global $popup_config;
        $v = 'popup_dom_user';
        if(isset($_SESSION[$v])){
            $str = md5($popup_config['salt'].$this->option('admin_email').'_'.$this->option('admin_pass'));
            if($_SESSION[$v] == $str){
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    
    /**
    * get_themes()
    *
    * gets the themes from the theme folder.
    */
    
    function get_themes(){
        if(count($this->themes) == 0){
            $themes = $this->get_file_list($this->theme_path,true);
            $this->themes = array();
            foreach($themes as $t){
                if($t = $this->get_theme_info($t))
                    $this->themes[] = $t;
            }
            usort($this->themes,array(&$this,'sort_array'));
        }
        return $this->themes;
    }
}

$popdom = new PopUp_Domination_Admin();
?>