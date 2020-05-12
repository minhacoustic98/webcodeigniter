<?php
class Cart extends MY_Controller {

    function __construct()
    {
        //Call cart library
        parent::__construct();
       
    }

    //Add product to cart

    function add()
    {
        //Get product which added to cart
        $this->load->model('product_model');
        $id=intval($this->uri->segment(3));
        $product=$this->product_model->get_info($id);
        if(!$product){
            redirect();
        }
        //Total products
        $qty=1;
        $price=$product->price;
        if($product->discount>0)
        {
            $price=$product->price-$product->discount;
        }
        //Product info
        $data=array();
        $data['id']=$product->id;
        $data['qty']=$qty;
        $data['name']=url_title($product->name);
        $data['image_link']=$product->image_link;
        $data['price']=$price;
        $this->cart->insert($data);

        //Redirect to cart details page
        redirect(base_url('cart'));

    }

    function index()
    {
        //Showing list product in cart

        $carts=$this->cart->contents();
        $total_items=$this->cart->total_items();
        $this->data['carts']=$carts;
        $this->data['total_items']=$total_items;

        $this->data['temp']='site/cart/index';
        $this->load->view('site/layout',$this->data);
    }

    function update()
    {
        $carts=$this->cart->contents();

        foreach($carts as $key=>$row){
            $total_qty=$this->input->post('qty_'.$row['id']);
            $data=array();
            $data['rowid']=$key;
            $data['qty']=$total_qty;
            $this->cart->update($data);

            
        }
        redirect(base_url('cart'));
    }

   

    function delete()
    {
        $id=$this->uri->rsegment(3);
        if(intval($id)>0)
        {
            $carts=$this->cart->contents();

            foreach($carts as $key=>$row){
                if($row['id']==$id){
                    $data=array();
                    $data['rowid']=$key;
                    $data['qty']=0;
                    $this->cart->update($data);
                }
            }
        }
        else{
            $this->cart->destroy();
        }

       redirect(base_url('cart'));
    }
}