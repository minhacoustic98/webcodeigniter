<?php
class News extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
        if($this->session->userdata('login')&&$this->session->userdata('login_info')){
            $this->data['infomation']=$this->session->userdata['login_info'];
         }
    }

    function index()
    {

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        //Total news
        $total_rows = $this->news_model->get_total();
        $this->data['total_rows'] = $total_rows;
        //Pagination
        $this->load->library('pagination');

        $config = array();
        $config['total_rows'] = $total_rows; //Number of news
        $config['base_url'] = admin_url('news/index');
        $config['per_page'] = 2;  //Number of news per page
        $config['uri_segment'] = '4'; //Pagination that repersent id of news in url
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

        $title = $this->input->get('title');
        if ($title) {
            $input['like'] = array('name', $title);
        }
      
        //List news
        $list = $this->news_model->get_list($input);
        $this->data['list'] = $list;

     

        $this->data['temp'] = 'admin/news/index';
        $this->load->view('admin/main', $this->data);
    }

    function add()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');

    

        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
            $this->form_validation->set_rules('intro', 'Giới thiệu', 'required');
            $this->form_validation->set_rules('content', 'Nội dung', 'required');

            if ($this->form_validation->run()) {
                $title = $this->input->post('title');
                $intro = $this->input->post('intro');
                $created = $this->input->post('created');
                $created = str_replace('/', '-', $created);
                $time = strtotime($created);
                $newformat = date('Y-m-d', $time);
                $featured = $this->input->post('featured');
                $content = $this->input->post('content');
                $count=0;
                //Get infomation of image when upload done
                $this->load->library('upload_library');
                $upload_path = './upload/news';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';

                if ($upload_data['file_name']) {
                    $image_link = $upload_data['file_name'];
                }


            



                $data_news_add = array(

                    'title' => $title,
                    'intro' => $intro,
                    'content' => $content,
                    'image_link' => $image_link,
                    'created' => $newformat,
                    'featured' => $featured,
                    'count_view' => $count
                );

                if ($this->news_model->create($data_news_add)) {
                    $this->session->set_flashdata('message', 'Thêm mới dữ liệu thành công!');
                } else {
                    $this->session->set_flashdata('message', 'Thêm mới thất bại ! Thử lại sau');
                }

                return redirect('admin/news');
            }
        }


        $this->data['temp'] = 'admin/news/add';
        $this->load->view('admin/main', $this->data);
    }

    function edit(){
        $this->load->library('form_validation');
        $this->load->helper('form');
        $id = $this->uri->rsegment('3');

        $id = intval($id);
        $info = $this->news_model->get_info($id);

        if (!$info) {
            $this->session->set_flashdata('message', 'Không tìm thấy tin tức!');
            redirect(admin_url('news'));
        }

        $this->data['news'] = $info;

        if ($this->input->post()) {
            $this->form_validation->set_rules('title', 'Tiêu đề', 'required');
            $this->form_validation->set_rules('intro', 'Giới thiệu', 'required');
            $this->form_validation->set_rules('content', 'Nội dung', 'required');

            if ($this->form_validation->run()) {
                $title = $this->input->post('title');
                $intro = $this->input->post('intro');
                $created = $this->input->post('created');
                $created = str_replace('/', '-', $created);
                $time = strtotime($created);
                $newformat = date('Y-m-d', $time);
                $featured = $this->input->post('featured');
                $content = $this->input->post('content');

                //Get infomation of image when upload done
                $this->load->library('upload_library');
                $upload_path = './upload/news';
                $upload_data = $this->upload_library->upload($upload_path, 'image');
                $image_link = '';

                if ($upload_data['file_name']) {
                    $image_link = $upload_data['file_name'];
                }

                $data_news_update = array(

                    'title' => $title,
                    'intro' => $intro,
                    'content' => $content,
                    'created' => $newformat,
                    'featured' => $featured,
                  
                );
              
                if ($image_link!= '') {
                    $data_news_update['image_link'] = $image_link;
                }

                if ($this->news_model->update($id, $data_news_update)) {
                    $this->session->set_flashdata('message', 'Cập nhật thành công!');
                } else {
                    $this->session->set_flashdata('message', 'Cập nhật thất bại!');
                }
                redirect(admin_url('news'));
            }
        }

        $this->data['temp'] = 'admin/news/edit';
        $this->load->view('admin/main', $this->data);
    }

    function delete()
    {
        $id = $this->uri->rsegment('3');
        $id = intval($id);
        $info = $this->news_model->get_info($id);

        if (!$info) {
            $this->session->set_flashdata('message', 'Không tìm thấy tin tức!');
            redirect(admin_url('news'));
        }
        if (file_exists('./upload/news/' . $info->image_link)) {
            unlink('./upload/news/' . $info->image_link);
        }
      
        $this->news_model->delete($id);
        $this->session->set_flashdata('message', 'Xóa thành công!');
        redirect(admin_url('news'));
    }

    function del_multi(){
        $ids=$this->input->post('ids');
        foreach($ids as $i){
            $this->_del($i);
        }
    }

    private function _del($id){
        $info = $this->news_model->get_info($id);

        if (!$info) {
            $this->session->set_flashdata('message', 'Không tìm thấy tin tức!');
            redirect(admin_url('news'));
        }
        if (file_exists('./upload/news/' . $info->image_link)) {
            unlink('./upload/news/' . $info->image_link);
        }
        
    }

}