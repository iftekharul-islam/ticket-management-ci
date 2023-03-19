
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Edit Category
                </div>
            </div>
            <div class="portlet-body form">
                <?=form_open_multipart('posts/edit_categories/' . $category->id, array('class' => 'form-horizontal'))?>
                    <div class="form-body">
                        <div class="clearfix">
                            <div class="col-md-6 margin-bottom-20">
                                <label>Name <span style="color:red">*</span></label>
                                <input name="name" class="form-control" type="text" value="<?=set_value('name', $category->name)?>" maxlength="30" required> 
                            </div>
                            <div class="col-md-6 margin-bottom-20">
                                <label>Url Slug </label>
                                <input name="url" class="form-control" type="text" value="<?=set_value('url', $category->url)?>" placeholder="Leave empty to generate from the name"> 
                            </div>
                            <div class="col-md-6 margin-bottom-20">
                                <label>Parent Category</label>
                                <?php $cats = array("0" => "-- Select --"); foreach($categories as $cat){ if($cat->status == "active") $cats[$cat->id] = $cat->name; } ?>
                                <?=form_dropdown('parent_id', $cats, set_value('parent_id', $category->parent_id), 'class="form-control select2me"')?>
                            </div>
                            <div class="col-md-6 margin-bottom-20">
                                <label>Short Description</label>
                                <input name="description" class="form-control" type="text" value="<?=set_value('description', $category->description)?>" maxlength="200"> 
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

