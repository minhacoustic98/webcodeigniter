<?php
class Product extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        //Load product model

        $this->load->model('product_model');
        $this->load->model('comment_model');
        $this->load->model('user_model');
    }

    public function index()
    {
        //Buoc 1:load thu vien phan trang
        $this->load->library('pagination');
        //Buoc 2:Cau hinh cho phan trang
        //lay tong so luong san pham tu trong csdl
        $total_rows = $this->product_model->get_total();
        $this->data['total_rows'] = $total_rows;
        
        $config = array();
        $config['base_url']    = base_url('product/index');
        $config['total_rows']  = $total_rows;
        $config['per_page']    = 6;
        $config['uri_segment'] = 3;
        $config['next_link']   = "Trang kế tiếp";
        $config['prev_link']   = "Trang trước";
    
        //Khoi tao phan trang
        $this->pagination->initialize($config);
    
        //lay danh sach san pham trong csdl,moi lan lay limit 3 san pham
        //$this->uri->segment(n): lay ra phan doan thu n tren link url
        $segment = $this->uri->segment(3);
        $segment = intval($segment);
        $input = array();
        $input['limit'] = array($config['per_page'], $segment);
        
        $products = $this->product_model->get_list($input);
        $this->data['list'] = $products;
    
        // Hien thi view
        $this->data['temp'] = 'site/product/index';
        $this->load->view('site/layout', $this->data);
    }
    


    //Show product list depend catalog
    function catalog()
    {
        //get id

        $id = $this->uri->rsegment(3);
        $id = intval($id);

        //get info catalog

        $this->load->model('menu_model');
        $catalog = $this->menu_model->get_info($id);
        if (!$catalog) {
            redirect();
        }

        $this->data['catalog'] = $catalog;
        $input = array();
        //Check is parent_id
        if ($catalog->parent_id == 0) {
            $input_cate = array();
            $input_cate['where'] = array('parent_id' => $id);
            $catalog_sub = $this->menu_model->get_list($input_cate);
            if (!empty($catalog_sub)) {
                $catalog_sub_id = array();

                foreach ($catalog_sub as $catalog_id_sub) {
                    $catalog_sub_id[] = $catalog_id_sub->id;
                }
                $this->db->where_in('menu_id', $catalog_sub_id);
            } else {
                $input['where'] = array('menu_id' => $id);
            }
        } else {
            $input['where'] = array('menu_id' => $id);
        }





        //Get product
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;
        //Pagination
        $this->load->library('pagination');

        $config = array();
        $config['total_rows'] = $total_rows; //Number of product
        $config['base_url'] = base_url('product/catalog/' . $id);
        $config['per_page'] = 2;  //Number of product per page
        $config['uri_segment'] = '4'; //Pagination that repersent id of product in url
        $config['next_link'] = 'Trang kế tiếp';
        $config['prev_link'] = 'Trang trước';

        //Config pagnation
        $this->pagination->initialize($config);
        $segment = $this->uri->segment(4);
        $segment = intval($segment);


        $input['limit'] = array($config['per_page'], $segment);

        //lay danh sach san pham
        if (isset($catalog_sub_id)) {
            $this->db->where_in('menu_id', $catalog_sub_id);
        }

        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;
        $this->data['temp'] = 'site/product/catalog';
        $this->load->view('site/layout', $this->data);
    }

    function view()
    {
        //View product detail
        $id = intval($this->uri->rsegment(3));
        $product = $this->product_model->get_info($id);
        if (!$product) {
            redirect();
        }

        //lấy số điểm trung bình đánh giá
        $product->raty = ($product->rate_count > 0) ? $product->rate_total / $product->rate_count : 0;
        $this->data['product'] = $product;


        //lấy danh sách ảnh sản phẩm kèm theo
        $image_list = @json_decode($product->image_links);
        $this->data['image_list'] = $image_list;

        //cap nhat lai luot xem cua san pham
        $data = array();
        $data['view'] = $product->view + 1;
        $this->product_model->update($product->id, $data);

        $catalog = $this->menu_model->get_info($product->menu_id);
        $this->data['catalog'] = $catalog;

        $this->data['product_id']=$id;

        if($this->session->userdata('user_login'))
        {
            $id=$this->session->userdata('user_login');
            $user_data=$this->user_model->get_info($id);
            $this->data['user_login']=$user_data;
        }

        $this->data['html']=$this->all_comments();
        $this->data['temp'] = 'site/product/view';
        $this->load->view('site/layout', $this->data);
    }

    function insert()
    {
        if($this->input->post())
        {
            $product_id=$this->input->post('product_ids');
            $name=$this->input->post('u_name');
            $email=$this->input->post('u_email');
            $parent_id=0;
            $content=$this->input->post('comment');
            $created=now();
            $data=array(
                'product_id'=>$product_id,
                'parent_id'=>$parent_id,
                'user_name'=>$name,
                'user_email'=>$email,
                'content'=>$content,
                'created'=>$created
            );

            if($this->comment_model->insert($data))
            {
               redirect(base_url('product/view/'.$product_id));
            }
        }
    }

    public function all_comments()
	{
        //fetch comment
        $id=intval($this->uri->rsegment('3'));

        $comments = $this->comment_model->fetch_comments(null,$id);
        // echo '<pre>';
        // print_r($comments);
        // echo '</pre>';
		$html_comments = $this->comment_model->html_comments($comments,$id);
		return $html_comments;
		//fetch comment
    }
    
    function reply()
    {
        

           if($this->input->post())
           {
               
             $product_id=$this->input->post('product_id');
             $parent_id=$this->input->post('parent');
             $input=array(
                 'product_id'=>$product_id,
                 'parent_id'=>$parent_id,
                 'user_name'=>$this->input->post('name'),
                 'user_email'=>$this->input->post('email'),
                 'content'=>$this->input->post('comment'),
                 'created'=>now()
             );

               $this->comment_model->insert($input);
               $data['html'] = $this->all_comments();
               $data['result'] = true;
               $data['content']=$this->comment_model->get_sub_comments($parent_id,$product_id);
           }
           else{


               $data['result'] = false;
           }
           echo json_encode($data);
    }

    function search()
    {
        //Search by name
        if ($this->uri->rsegment(3) == 1) {
            $key = $this->input->get('term');
        } else {
            $key = $this->input->get('key-search');
        }


        $this->data['key'] = trim($key);
        $input = array();
        $input['like'] = array('name', $key);
        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;

        if ($this->uri->rsegment(3) == 1) {
            $result = array();
            foreach ($list as $row) {
                $item = array();
                $item['id'] = $row->id;
                $item['label'] = $row->name;
                $item['value'] = $row->name;
                $result[] = $item;
            }
            //Fetch data by json format
            die(json_encode($result));
        } else {

            //Load view

            $this->data['temp'] = 'site/product/search';
            $this->load->view('site/layout', $this->data);
        }
    }

    function search_price()
    {
        $price_from = intval($this->input->get('price_from'));
        $price_to = intval($this->input->get('price_to'));

        $this->data['price_from'] = $price_from;
        $this->data['price_to'] = $price_to;
        //Filter by price

        $input = array();
        $input['where'] = array('price>=' => $price_from, 'price<=' => $price_to);
        $list = $this->product_model->get_list($input);

        $this->data['list'] = $list;
        $this->data['temp'] = 'site/product/search_price';
        $this->load->view('site/layout', $this->data);
    }

    /**
     * Danh gia sản phẩm
     */
    function raty()
    {
        $result = array();

        // Lay thong tin
        $id = $this->input->post('id'); //lấy id sản phẩm gửi lên từ trang ajax
        $id = (!is_numeric($id)) ? 0 : $id;
        $info = $this->product_model->get_info($id); //lấy thông tin sản phẩm cần đánh giá
        if (!$info) {
            exit();
        }

        //kiem tra xem khach da binh chon hay chua
        $raty    = $this->session->userdata('session_raty');
        $raty   = (!is_array($raty)) ? array() : $raty;
        $result = array();
        //nếu đã tồn tại id sản phẩm này trong session đánh giá
        if (isset($raty[$id])) {
            $result['msg'] = 'Bạn chỉ được đánh giá 1 lần cho sản phẩm này';
            $output        = json_encode($result); //trả về mã json
            echo $output;
            exit();
        }
        //cap nhat trang thai da binh chon
        $raty[$id] = TRUE;
        $this->session->set_userdata('session_raty', $raty);

        $score = $this->input->post('score'); //lấy số điểm post lên từ trang ajax
        $data  = array();
        $data['rate_total'] = $info->rate_total + $score; //tổng số điểm
        $data['rate_count'] = $info->rate_count + 1; //tổng số lượt đánh giá
        //cập nhật lại đánh gia cho sản phẩm
        $this->product_model->update($id, $data);

        // Khai bao du lieu tra ve
        $result['complete'] = TRUE;
        $result['msg']      = 'Cám ơn bạn đã đánh giá cho sản phẩm này';
        $output             = json_encode($result); //trả về mã json
        echo $output;
        exit();
    }
}
