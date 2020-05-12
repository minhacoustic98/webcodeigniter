<?php
class Order extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('order_model');
        if ($this->session->userdata('login') && $this->session->userdata('login_info')) {
            $this->data['infomation'] = $this->session->userdata['login_info'];
        }
    }

    function index()
	{
		//tao input dieu kien
   	    $input = array();
   	    
	     //Buoc 1:load thu vien phan trang
   	    $this->load->library('pagination');
   	    //Buoc 2:Cau hinh cho phan trang
   	    //lay tong so luong đơn hàng tu trong csdl
   	    $total_rows = $this->order_model->get_total($input);
   	    $config = array();
   	    $config['base_url']    = base_url('admin/order/index');
   	    $config['total_rows']  = $total_rows;
   	    $config['per_page']    = 10;
   	    $config['uri_segment'] = 4;//phân đoạn 4
   	    $config['next_link']   = "Trang kế tiếp";
   	    $config['prev_link']   = "Trang trước";
   	    //Khoi tao phan trang
   	    $this->pagination->initialize($config);
   	    
   	    $input['limit'] = array($config['per_page'], $this->uri->rsegment(3));
	
	    $list = array();
		$list = $this->order_model->query('select product.image_link,product.id as "product_id",product.name as "product_name",product.price,product.discount,
		web_media_mart.order.quantity,web_media_mart.order.id as "id",web_media_mart.order.amount as "money",web_media_mart.order.status as "order_status",transaction.id as "transaction_id",transaction.status,transaction.created from web_media_mart.order inner join product on web_media_mart.order.product_id=product.id inner join
		transaction on web_media_mart.order.transaction_id=transaction.id');
		

		// printData($list);
		$this->data['list']   = $list;
		$this->data['action'] = current_url();
	    $this->data['total_rows'] = $total_rows;
		// Message
		$message = $this->session->flashdata('flash_message');
		if ($message)
		{
			$this->data['message'] = $message;
		}
		
		// Hien thi view
		$this->data['temp'] = 'admin/order/index';
		$this->load->view('admin/main', $this->data);
	}
	
	/**
	 * Export du lieu ra file excel = cach don gian nhat
	 */
	function export()
	{
	    //lay toan bo giao dịch
		$list = array();
		$list = $this->order_model->query('select product.image_link,product.id as "product_id",product.name as "product_name",product.price,product.discount,
		web_media_mart.order.quantity,web_media_mart.order.id as "id",web_media_mart.order.amount as "money",web_media_mart.order.status as "order_status",transaction.id as "transaction_id",transaction.status,transaction.created from web_media_mart.order inner join product on web_media_mart.order.product_id=product.id inner join
		transaction on web_media_mart.order.transaction_id=transaction.id');
	    foreach ($list as $row)
	    {
	        $row->_amount = number_format($row->money);
	        if($row->status == 0)
	        {
	            $row->_status = 'pending';
	        }
	        elseif($row->status == 1)
	        {
	            $row->_status = 'completed';
	        }
	        elseif($row->status == 2)
	        {
	            $row->_status = 'cancel';
	        }
	        if($row->order_status == 0)
	        {
	            $row->_order_status = 'pending';
	        }
	        elseif($row->order_status == 1)
	        {
	            $row->_order_status = 'completed';
	        }
	        elseif($row->order_status == 2)
	        {
	            $row->_order_status = 'cancel';
	        }
	    }
	    $this->data['list']   = $list;
	    $this->load->view('admin/order/export', $this->data);
	}

}