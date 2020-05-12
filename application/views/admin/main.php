<html>
    <head>
       <?php $this->load->view('admin/head') ?> 
    </head>
    <body>
        <!-- Left side content -->
        <div id="left_content">
            <?php $this->load->view('admin/left',$this->data) ?>
        </div>
        <!-- -->

        <div id="rightSide">
            
             <?php $this->load->view('admin/header',$this->data) ?>

            <!--Content -->

                <?php $this->load->view($temp) ?>
            <!-- -->
            
             <?php $this->load->view('admin/footer') ?>
        </div>

        <div class="clear"></div>
    </body>
</html>