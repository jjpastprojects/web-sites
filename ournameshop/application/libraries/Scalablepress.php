<?php

require_once(APPPATH . 'libraries/library.php');

Class Scalablepress extends Library
{

    protected $api_url = 'https://api.scalablepress.com/v2/';

    public function __construct()
    {
        parent::__construct();
        $this->ci->load->library('rest');
        $config = array(
            'server' => $this->api_url,
            'http_user' => 'u',
            'http_pass' => $this->ci->config->item('sp_api_key'),
            'http_auth' => 'basic',
                //'ssl_verify_peer' => TRUE,
                //'ssl_cainfo'      => '/certs/cert.pem'
        );

        $this->ci->rest->initialize($config);
    }

    public function test()
    {
        $this->design();
    }

    public function order($orderToken)
    {
        $res = $this->ci->rest->post('order', array('orderToken'=>$orderToken));
        return $res;
    }
    
    public function design($image_url)
    {
        //current method is hardcoded for mugs only
        $params = array(
            'type' => 'mug',
            'sides' => array(
                'front' => array(
                    'artwork' => $image_url,
                )
            )
        );
        $res = $this->ci->rest->post('design', $params);
        return isset($res->designId)?$res->designId:null;
    }

    public function quote($params)
    {
        $res = $this->ci->rest->post('quote/bulk', $params);
        return $res;
    }
    
    public function delete_order($orderId)
    {
        $res = $this->ci->rest->delete('order/'.$orderId, $params);
 
        return $res;
    }

    //      -d "products[0][id]=gildan-sweatshirt-crew" \
//  -d "products[0][color]=ash" \
//  -d "products[0][quantity]=12" \
//  -d "products[0][size]=lrg" \
//  -d "address[name]=My Customer" \
//  -d "address[address1]=123 Scalable Drive" \
//  -d "address[city]=West Pressfield" \
//  -d "address[state]=CA" \
//  -d "address[zip]=12345" \
//  -d "designId=53ed3a23b3730f0e27a66513"
    
    public function place_order($order_id)
    {
        $order = $this->ci->orders->get($order_id);
        
        // $items = $this->ci->cart_items->by_cart($order->cart_id);  	 
        $items = $this->ci->cart_items->join_surfaces()->by_cart($order->cart_id);
       
        $itemsarray = array();
        $params=array();
        $i=0;
        foreach ($items as $key => $item)
        {

            if (!is_scalablepress_product($item->product_type))
                continue;
            //$design_id=$this->design('http://sugar.lodob.com/333.png');
            $design_id='56b9e97e0dae15076d46b36b';
            if(!$design_id)
                return false;
            
            $params['items'][$i]['type']='mug';
            $params['items'][$i]['designId']=$design_id;
            $params['items'][$i]['products'][0]['id']='beverage-mug';
            $params['items'][$i]['products'][0]['color']='white';
            $params['items'][$i]['products'][0]['quantity']=$item->q;
            $params['items'][$i]['products'][0]['size']='15oz';
            $params['items'][$i]['address']['name']=$order->name; 
            $params['items'][$i]['address']['address1']=$order->address; 
            $params['items'][$i]['address']['city']=$order->city; 
            $params['items'][$i]['address']['state']=$order->state; 
            $params['items'][$i]['address']['zip']=$order->zip; 
            $i++;   
        }
        $params['data']['breakdown']='true';
        $quote_res=$this->quote($params);
        if(isset($quote_res->orderToken))
            $res=$this->order($quote_res->orderToken);
        
        if(isset($res->orderId))
            return $res;
        
        return false;
    }

}
