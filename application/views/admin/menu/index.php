<?php $this->load->view('admin/menu/head') ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">

        <?php $this->load->view('admin/message', $this->data) ?>
        <div class="title">
            <span class="titleIcon">
                <div class="checker" id="uniform-titleCheck"><span><input type="checkbox" id="titleCheck" name="titleCheck" style="opacity: 0;"></span></div>
            </span>
            <h6>Danh sách menu-danh mục</h6>
            <div class="num f12">Tổng số: <b><?php echo count($list) ?></b></div>
        </div>

        <form action="" method="get" class="form" name="filter">
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                    <tr>
                        <td style="width:10px;"><img src="<?php echo public_url('admin') ?>/images/icons/tableArrows.png"></td>
                        <td style="width:80px;">Mã số</td>
                        <td>Tên danh mục</td>
                        <td>Cấp độ</td>
                        <td>Thứ tự hiển thị</td>
                        <td style="width:100px;">Hành động</td>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="list_action itemActions">
                                <a href="#submit" id="submit" class="button blueB" url="<?php echo admin_url('menu/del_multi') ?>">
                                    <span style="color:white;">Xóa hết</span>
                                </a>
                            </div>

                            <div class="pagination">
                            </div>
                        </td>
                    </tr>
                </tfoot>

                <tbody>
                    <?php foreach ($list as $row) : ?>
                        <tr class="row_<?php echo $row->id ?>">
                            <td>
                                <div class="checker" id="uniform-undefined"><span><input type="checkbox" name="id[]" value="<?= $row->id ?>" style="opacity: 0;"></span></div>
                            </td>

                            <td class="textC"><?= $row->id; ?></td>


                            <td style="text-align: center"><span class="tipS" original-title="<?= $row->name ?>">
                                    <?= $row->name ?> </span></td>


                            <td style="text-align: center"><span class="tipS" original-title="<?= $row->level ?>">
                                    <?= $row->level ?> </span></td>


                            <td style="text-align: center"><span class="tipS" original-title="<?= $row->sort_order ?>">
                                    <?= $row->sort_order ?> </span></td>


                            <td class="option">
                                <a href="<?php echo admin_url('menu/edit/' . $row->id) ?>" class="tipS " original-title="Chỉnh sửa">
                                    <img src="<?= public_url('admin') ?>/images/icons/color/edit.png">
                                </a>

                                <a href="<?php echo admin_url('menu/delete/' . $row->id) ?>" class="tipS verify_action" original-title="Xóa">
                                    <img src="<?= public_url('admin') ?>/images/icons/color/delete.png">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>


            </table>
    </div>
</div>

<div class="clear mt-30">
</div>