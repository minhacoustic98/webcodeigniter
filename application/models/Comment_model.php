<?php
class Comment_model extends CI_Model
{
    public function fetch_comments($id = null,$product_id)
    {
        $this->db->select('*');
        $where=array();
        if (isset($id) && $id != null)
        {
            $where['parent_id']=$id;
            $where['product_id']=$product_id;
            $this->db->where($where);
        }
           
        else  {
             $where['parent_id']=0;
             $where['product_id']=$product_id;
            $this->db->where($where);
            $this->db->order_by('created', 'desc');
        }

        $this->db->from('comment');
        return $this->db->get()->result_array();
    }
    public function insert($data)
    {
        $this->db->insert('comment', $data);
        return true;
    }
    public function get_sub_comments($id,$product_id)
    {

        $sub_comments = $this->fetch_comments($id,$product_id);
        if (!empty($sub_comments)) {
            $text = '';
            foreach ($sub_comments as $key => $row_sub_comment) {

                $text   .= '<div class="pl-5 pr-5"> 
                <table class="table table-hover">
                <tr>
                   <td> 
                       <p style="color:#ff6633"><b>' . $row_sub_comment['user_name'] . '</b></p>
                       <p style="width: 500px;font-style:italic;color:brown;">' . $row_sub_comment['content'] . '</p> 
                       <h6><a  data-parent= "' . $row_sub_comment['id'] . '" class="comment_reply" style="display: block;
                       color: #fff;
                       background:orange;
                       padding: 5px;
                       width: 40px;
                       margin-bottom: 10px;cursor:pointer">
                       Reply</a> <span class="float-right">
                      <small>commented on: ' .get_date($row_sub_comment['created']). '</small></span></h6> 

                       <div id="reply_form' . $row_sub_comment['id'] . '" 
                       class="reply_form"></div> 
                 </td> </tr>';

                $text   .= '</table>' . $this->get_sub_comments($row_sub_comment['id'],$product_id) . '
                                       </div>';
            }
            return $text;
        } else return false;
    }


    public function html_comments($comments,$product_id)
    {
        if (!empty($comments)) {
            $html = '';
            foreach ($comments as $key => $comment_row) {
                $html  .= '<div class="pl-5 pr-5"> 
                                         <table class="table table-hover">
                                              <tr>
                                                 <td> 
                                                     <p style="color:red"><b>' . $comment_row['user_name'] . '</b></p>
                                                     <p style="width: 500px;font-style:italic;color:green;">' . $comment_row['content'] . '</p> 
                                                     <h6><a  data-parent= "' . $comment_row['id'] . '" class="comment_reply" style="display: block;
                                                     color: #fff;
                                                     background:greenyellow;
                                                     padding: 5px;
                                                     width: 40px;
                                                     margin-bottom: 10px;cursor:pointer">
                                                     Reply</a> <span class="float-right">
                                                    <small>commented on: ' .get_date($comment_row['created']). '</small></span></h6> 

                                                     <div id="reply_form' . $comment_row['id'] . '" 
                                                     class="reply_form"></div> 
                                               </td> </tr>';

                $html   .= '</table>' . $this->get_sub_comments($comment_row['id'],$product_id) . '
                                     </div>';
            }
            return $html;
        } else return false;
    }
}
