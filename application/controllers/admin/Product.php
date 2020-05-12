<?php
class Product extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('product_model');
        if ($this->session->userdata('login') && $this->session->userdata('login_info')) {
            $this->data['infomation'] = $this->session->userdata['login_info'];
        }
    }

    function index()
    {

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        //Total product
        $total_rows = $this->product_model->get_total();
        $this->data['total_rows'] = $total_rows;
        //Pagination
        $this->load->library('pagination');

        $config = array();
        $config['total_rows'] = $total_rows; //Number of product
        $config['base_url'] = admin_url('product/index');
        $config['per_page'] = 2;  //Number of product per page
        $config['uri_segment'] = '4'; //Pagination that repersent id of product in url
        $config['next_link'] = 'Trang kế tiếp';
        $config['prev_link'] = 'Trang trước';

        //Config pagnation
        $this->pagination->initialize($config);
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input = array();

        $input['limit'] = array($config['per_page'], $segment);

        $id = $this->input->get('id');
        $id = intval($id);
        $input['where'] = array();
        if ($id > 0) {
            $input['where']['id'] = $id;
        }

        $product_name = $this->input->get('name');
        if ($product_name) {
            $input['like'] = array('name', $product_name);
        }
        $catalog_id = $this->input->get('catalog');
        $catalog_id = intval($catalog_id);
        if ($catalog_id > 0) {
            $input['where']['menu_id'] = $catalog_id;
        }
        //List product
        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;

        //List menu
        $this->load->model('menu_model');
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $menu = $this->menu_model->get_list($input);
        foreach ($menu as $row) {
            $input['where'] = array('parent_id' => $row->id);
            $subs = $this->menu_model->get_list($input);
            $row->subs = $subs;
        }

        $this->data['menu'] = $menu;

        $this->data['temp'] = 'admin/product/index';
        $this->load->view('admin/main', $this->data);
    }

    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

        //List menu
        $this->load->model('menu_model');
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $menu = $this->menu_model->get_list($input);
        foreach ($menu as $row) {
            $input['where'] = array('parent_id' => $row->id);
            $subs = $this->menu_model->get_list($input);
            $row->subs = $subs;
        }

        $this->data['menu'] = $menu;

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên', 'required');
            $this->form_validation->set_rules('price', 'Giá', 'required');
            $this->form_validation->set_rules('quantity', 'Số lượng', 'required');
            $this->form_validation->set_rules('content', 'Nội dung', 'required');

            if ($this->form_validation->run()) {
                $name = $this->input->post('name');
                $menu_id = $this->input->post('catalog');
                $price = $this->input->post('price');
                $price = str_replace(',', '', $price);
                $discount = $this->input->post('discount');
                $discount = str_replace(',', '', $discount);
                $warranty = $this->input->post('warranty');
                $quantity = $this->input->post('quantity');
                $gift = $this->input->post('gift');
                $featured = $this->input->post('featured');
                $content = $this->input->post('content');
                $displayed = $this->input->post('display');
                //Get infomation of image when upload done
                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';

                if ($upload_data['file_name']) {
                    $image_link = $upload_data['file_name'];
                }


                $image_list = array();
                $image_list = $this->upload_library->upload_multi($upload_path, 'image_list');
                $image_list = json_encode($image_list);



                $data_product_add = array(

                    'menu_id' => $menu_id,
                    'name' => $name,
                    'price' => $price,
                    'content' => $content,
                    'discount' => $discount,
                    'quantity' => $quantity,
                    'image_link' => $image_link,
                    'warranty' => $warranty,
                    'is_displayed' => $displayed,
                    'gifts' => $gift,
                    'featured' => $featured,
                    'created' => now(),
                    'image_links' => $image_list
                );

                if ($this->product_model->create($data_product_add)) {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công!');
                } else {
                    $this->session->set_flashdata('message', 'Thêm mới thất bại ! Thử lại sau');
                }

                return redirect('admin/product');
            }
        }


        $this->data['temp'] = 'admin/product/add';
        $this->load->view('admin/main', $this->data);
    }

    function edit()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('product_model');
        $id = $this->uri->rsegment('3');

        $id = intval($id);
        $info = $this->product_model->get_info($id);

        if (!$info) {
            $this->session->set_flashdata('message', 'Không tìm thấy sản phẩm!');
            redirect(admin_url('product'));
        }

        $this->data['product'] = $info;


        //List menu
        $this->load->model('menu_model');
        $input = array();
        $input['where'] = array('parent_id' => 0);
        $menu = $this->menu_model->get_list($input);
        foreach ($menu as $row) {
            $input['where'] = array('parent_id' => $row->id);
            $subs = $this->menu_model->get_list($input);
            $row->subs = $subs;
        }

        $this->data['menu'] = $menu;
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Tên', 'required');
            $this->form_validation->set_rules('price', 'Giá', 'required');
            $this->form_validation->set_rules('quantity', 'Số lượng', 'required');
            $this->form_validation->set_rules('created', 'Ngày nhập', 'required');
            $this->form_validation->set_rules('content', 'Nội dung', 'required');

            if ($this->form_validation->run()) {
                $name = $this->input->post('name');
                $menu_id = $this->input->post('catalog');
                $price = $this->input->post('price');
                $price = str_replace(',', '', $price);
                $discount = $this->input->post('discount');
                $discount = str_replace(',', '', $discount);
                $warranty = $this->input->post('warranty');
                $quantity = $this->input->post('quantity');
                $gift = $this->input->post('gift');
                $featured = $this->input->post('featured');
                $content = $this->input->post('content');
                $displayed = $this->input->post('display');
                //Get infomation of image when upload done
                $this->load->library('upload_library');
                $upload_path = './upload/product';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';

                if ($upload_data['file_name']) {
                    $image_link = $upload_data['file_name'];
                }


                $image_list = array();
                $image_list = $this->upload_library->upload_multi($upload_path, 'image_list');
                $image_list_json = json_encode($image_list);



                $data_product_add = array(

                    'menu_id' => $menu_id,
                    'name' => $name,
                    'price' => $price,
                    'content' => $content,
                    'discount' => $discount,
                    'quantity' => $quantity,
                    'warranty' => $warranty,
                    'is_displayed' => $displayed,
                    'gifts' => $gift,
                    'featured' => $featured,
                    'created' => now()

                );

                if ($image_link = '') {
                    $data_product_add['image_link'] = $image_link;
                }

                if (!empty($image_list)) {
                    $data_product_add['image_links'] = ($image_list_json);
                }

                if ($this->product_model->update($id, $data_product_add)) {
                    $this->session->set_flashdata('message', 'Cập nhật thành công!');
                } else {
                    $this->session->set_flashdata('message', 'Cập nhật thất bại!');
                }
                redirect(admin_url('product'));
            }
        }

        $this->data['temp'] = 'admin/product/edit';
        $this->load->view('admin/main', $this->data);
    }

    function delete()
    {
        $this->load->model('product_model');
        $id = $this->uri->rsegment('3');
        $id = intval($id);
        $info = $this->product_model->get_info($id);

        if (!$info) {
            $this->session->set_flashdata('message', 'Không tìm thấy sản phẩm!');
            redirect(admin_url('product'));
        }
        if (file_exists('./upload/product/' . $info->image_link)) {
            unlink('./upload/product/' . $info->image_link);
        }
        $img_lst = json_decode($info->image_links);
        if (is_array($img_lst)) {
            foreach ($img_lst as $imgs) {
                $imgs_links = './upload/product/' . $imgs;
                if (file_exists($imgs_links)) {
                    unlink($imgs_links);
                }
            }
        }
        $this->product_model->delete($id);
        $this->session->set_flashdata('message', 'Xóa thành công!');
        redirect(admin_url('product'));
    }

    function del_multi(){
        $ids=$this->input->post('ids');
        foreach($ids as $i){
            $this->_del($i);
        }
    }

    private function _del($id){
        $info = $this->product_model->get_info($id);

        if (!$info) {
            $this->session->set_flashdata('message', 'Không tìm thấy sản phẩm!');
            redirect(admin_url('product'));
        }
        if (file_exists('./upload/product/' . $info->image_link)) {
            unlink('./upload/product/' . $info->image_link);
        }
        $img_lst = json_decode($info->image_links);
        if (is_array($img_lst)) {
            foreach ($img_lst as $imgs) {
                $imgs_links = './upload/product/' . $imgs;
                if (file_exists($imgs_links)) {
                    unlink($imgs_links);
                }
            }
        }
        
    }
}
