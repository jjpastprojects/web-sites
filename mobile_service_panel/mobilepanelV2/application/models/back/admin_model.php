<?php
class Admin_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }
   
   
    function all_users($id="")
    {
        if($id>0)
            $this->db->where('id',$id);
        
        $query = $this->db->get("users");
        //echo $this->db->last_query();exit;
        return $query->result();
    }

    
	function image_detail($id="")
	{
		if($id>0)
            $this->db->where('id',$id);
        
        $query = $this->db->get("user_photos");
      // echo $this->db->last_query();exit;
        return $query->result();
	}
	function get_information($id="")
	{
		if($id>0)
            $this->db->where('user_id',$id);
        
        $query = $this->db->get("other_info");
		$result_arr=$query->result();
		if($query->num_rows()>0){
		$result_arr=$query->result();
		
		$result_arr[0]->front=$this->get_photo($result_arr[0]->front);
		$result_arr[0]->left_view=$this->get_photo($result_arr[0]->left_view);
		$result_arr[0]->right_view=$this->get_photo($result_arr[0]->right_view);
		$result_arr[0]->rear=$this->get_photo($result_arr[0]->rear);
		
		
		$result_arr[0]->peeling_wood=$this->get_photo($result_arr[0]->peeling_wood);
		$result_arr[0]->rotten_wood=$this->get_photo($result_arr[0]->rotten_wood);
		$result_arr[0]->extra1=$this->get_photo($result_arr[0]->extra1);
		$result_arr[0]->extra2=$this->get_photo($result_arr[0]->extra2);
		$result_arr[0]->extra3=$this->get_photo($result_arr[0]->extra3);
		}
      // echo $this->db->last_query();exit;
  return $result_arr;
	}
	function get_photo($id="")
	{
		if($id>0){
            $this->db->where('id',$id);
        
        $query = $this->db->get("photos");
		$result_arr=$query->result();
			if($query->num_rows()>0){
				 return $result_arr[0]->photo_name;
			}
		}
		
      // echo $this->db->last_query();exit;
     
      	return 'no_image.jpg';
     
       
	}
	function get_user_info($id)
	{
		$this->db->where('id',$id);
        
        $query = $this->db->get("user");
		return $query->result();
	}
	
		function get_details_dt()
	{
		       $requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'id', 
	1 => 'name',
	2 =>'phone_no',
	3=> 'address',
	4 =>'email'
);

// getting total number records without any search
$sql = "SELECT user.id FROM `user` ";

$query=$this->db->query($sql);
$totalData = $query->num_rows();
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT user.*  FROM `user` 

  where 1=1 ";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( name LIKE '".$requestData['search']['value']."%' ";  
$sql.=" OR email LIKE '".$requestData['search']['value']."%' ";
$sql.=" OR phone_no LIKE '".$requestData['search']['value']."%' ";
$sql.=" OR address LIKE '".$requestData['search']['value']."%' ";  
	$sql.=" OR email LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR createdon LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR des LIKE '".$requestData['search']['value']."%' )";
}
$query=$this->db->query($sql);
$totalFiltered = $query->num_rows(); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
//echo $sql;

$query=$this->db->query($sql);

$data = array();

 // preparing an array
 $i=($requestData['start'])+1;
foreach ($query->result() as $row){
	$nestedData=array(); 
	     
           $id=$row->id;
	
	$nestedData[] = $i;
	$nestedData[] = $row->name;
		$nestedData[] = $row->phone_no;
	$nestedData[] = $row->address;
	$nestedData[] = '<a href="mailto:">'.$row->email.'</a>';
	
	$nestedData[] = '<a href="'.site_url("admin/information").'/'.$id.'"><lable style="font-size: 15px;">View</lable></a>';
	date_default_timezone_set("UTC");
		$nestedData[] = date("d-m-Y",strtotime($row->createdon));
//	$nestedData[]= '<a href="javascript:void(0);" onclick="delete_group_image('.$temp.')" title="Remove"><i class="icon-trash"></i></a> 
   //                 <img src="'.base_url().'/images/loaders/loader19.gif" id="image_'.$id.'" style="display: none;"/>';
	
	$data[] = $nestedData;
	$i++;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);
//print_r($json_data);
return $json_data;
//echo json_encode($json_data);  // send data as json format
	   
	}
	
	
	
  
    function get_admin()
    {
        
         
        $query = $this->db->get("admin");
        //echo $this->db->last_query();exit;
        return $query->result();
    }
    function save_profile($id="0")
    {
         
            $this->db->select('*');
            $this->db->where("id ='".$_POST['id']."' AND password='".$_POST['password']."' ");
            $query = $this->db->get('admin');
           
                if ($query->num_rows() > 0)
                {
                    
                 $arr_field = array("username" =>$_POST['username'],
                                    "password"=>$_POST['newpassword']
                
                            );
                 $id=$_POST['id'];           
                $this->db->where('id', $id);
                $query = $this->db->update('admin', $arr_field);
                
                return $query;  
        		}
                
              
    }
    
   
}
?>