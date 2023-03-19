
        <div class="portlet box green">
            <div class="portlet-title" style="background: rgba(0, 0, 0, 0) linear-gradient(90deg, #26a69a 0%, rgb(8, 9, 8) 100%) repeat scroll 0% 0%;">
                <div class="caption">
                    Add New Post Category
                </div>
            </div>
            <div class="portlet-body form">
                <?=form_open_multipart('posts/categories', array('class' => 'form-horizontal'))?>
                    <div class="form-body">
                        <div class="clearfix">
                            <div class="col-md-6 margin-bottom-20">
                                <label>Name <span style="color:red">*</span></label>
                                <input name="name" class="form-control" type="text" value="<?=set_value('name')?>" maxlength="30" required> 
                            </div>
                            <div class="col-md-6 margin-bottom-20">
                                <label>Url Slug </label>
                                <input name="url" class="form-control" type="text" value="<?=set_value('url')?>" placeholder="Leave empty to generate from the name"> 
                            </div>
                            <div class="col-md-6 margin-bottom-20">
                                <label>Parent Category</label>
                                <?php $cats = array("0" => "-- Select --"); foreach($categories as $cat){ if($cat->status == "active") $cats[$cat->id] = $cat->name; } ?>
                                <?=form_dropdown('parent_id', $cats, set_value('parent_id'), 'class="form-control select2me"')?>
                            </div>
                            <div class="col-md-6 margin-bottom-20">
                                <label>Short Description</label>
                                <input name="description" class="form-control" type="text" value="<?=set_value('description')?>" maxlength="200"> 
                            </div>
                        </div>
                    </div>
                    <div class="form-actions text-center">
                        <button type="submit" class="btn blue">Submit</button>
                        <button type="reset" class="btn red">Cancel</button>
                    </div>
                <?=form_close()?>
            </div>
        </div>



<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption"> List </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="sample_6">
            <thead>
                <tr>
                    <th></th>
                    <th>Parent Name</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>URL Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category):?>
                <tr>
                    <td></td>
                    <td><?=(empty($category->parent_id)? "" : $this->mfrk->get_by_id('post_categories', $category->parent_id)->name)?></td>
                    <td><?=$category->name?></td>
                    <td><?=$category->description?></td>
                    <td><a href="blog/category/<?=$category->url?>"><?=$category->url?></a></td>
                    <td>
                        <?=anchor("posts/edit_categories/".$category->id, 'Edit' ,'class="label btn-xs label-info"')?>
                        <?=$category->status == "active"? anchor("posts/deactivate_category/".$category->id, 'Deactivate', array('onclick' => 'return confirm(\'Are you sure to Deactivate this category & Hide from frontend? You can Reactivate it any time later.\')', 'class' => 'label btn-xs label-danger')) : anchor("posts/activate_category/".$category->id, 'Activate' ,'class="label btn-xs label-primary"')?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>


<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css" />
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css" />
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" />

<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<script>
jQuery(document).ready(function() {
    TableAdvanced.init();
});
</script>