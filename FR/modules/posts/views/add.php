
        <?=form_open_multipart('posts/add', array('class' => 'form-horizontal'))?>
        <div class="portlet box red">
            <div class="portlet-title" style="background: rgba(0, 0, 0, 0) linear-gradient(90deg, rgb(220, 0, 0) 0%, rgb(0, 0, 0) 100%) repeat scroll 0% 0%">
                <div class="caption">
                    Post Details
                </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="clearfix">
                        <div class="col-md-6 margin-bottom-20">
                            <label>Enter Title <span style="color:red">*</span></label>
                            <input name="title" class="form-control" type="text" value="<?=set_value('title')?>" maxlength="200" required> 
                        </div>
                        <div class="col-md-6 margin-bottom-20">
                            <label>Url Slug </label>
                            <input name="url" class="form-control" type="text" value="<?=set_value('url')?>" placeholder="Leave empty to generate from the Title"> 
                        </div>
                        <div class="col-md-6 margin-bottom-20">
                            <label>Select Category</label>
                            <?php $cats = array(); foreach($categories as $cat){ if($cat->status == "active") $cats[$cat->id] = $cat->name; } ?>
                            <?=form_dropdown('in_categories[]', $cats, set_value('in_categories[]'), 'class="form-control select2me" multiple="multiple"')?>
                        </div>
                        <div class="col-md-6 margin-bottom-20">
                            <label>Post Author</label>
                            <input name="author" class="form-control" type="text" value="<?=set_value('author')?>" maxlength="30" placeholder="Default value is '888 Seats'"> 
                        </div>
                        <div class="col-md-6 margin-bottom-20">
                            <label>Date</label>
                            <input name="date" class="form-control datetimepicker" type="text" value="<?=set_value('date', date("Y-m-d H:i"))?>" placeholder="yyyy-mm-dd hh:mm"> 
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="portlet-title" style="background-color: cadetblue;">
                <div class="caption"> Featured Image </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="clearfix">
                        <div class="col-md-6 margin-bottom-20">
                            <div class="row">
                                <label class="col-md-8">Upload square image. <br>200x200px for best output. <br>Max size is 300KB. <br>Allowed File types- <span class='label label-primary'>.jpg</span> <span class='label label-danger'>.png</span> <span class='label label-warning'>.gif</span></label>
                                <div class="col-md-4 text-right">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 86px; height: 86px;"></div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 86px; height: 86px;"></div>
                                        <div>
                                            <span class="btn btn-xs btn-info btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="featured_image">
                                            </span>
                                            <a href="#" class="btn btn-xs btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 margin-bottom-20">
                            <label>Alt Text</label>
                            <input name="alt_text" class="form-control" type="text" value="<?=set_value('alt_text')?>" maxlength="30" placeholder="Leave empty if same as the Title"> 
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="portlet-title" style="background-color: #67809F;">
                <div class="caption"> Contents & Excerpts </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="clearfix">
                        <div class="col-md-12 margin-bottom-40 margin-top-20">
                            <textarea name="content" class="content tinymce"> <?=set_value('content')?></textarea>
                        </div>
                        <div class="col-md-12 margin-bottom-20">
                            <label>Excerpt</label>
                            <textarea name="excerpt" class="form-control"><?=set_value('excerpt')?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="portlet-title" style="background-color: #3598dc;">
                <div class="caption"> Change Post Meta [SEO] </div>
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="clearfix">
                        <div class="col-md-6 margin-bottom-20">
                            <label>SEO Title <br><span style="color: #999;">If you want a <span style="color: red">different title</span> in search engine and social media</span></label>
                            <input name="og_title" class="form-control" type="text" value="<?=set_value('og_title')?>" maxlength="200"> 
                        </div>
                        <div class="col-md-6 margin-bottom-20">
                            <label>Meta Description <br><span style="color: #999;">Overwrite site meta description defined in "Settings > Information"</span></label>
                            <input name="og_description" class="form-control" type="text" value="<?=set_value('og_description')?>" placeholder=""> 
                        </div>
                        <div class="col-md-12 margin-bottom-20">
                            <label>Keyphrases</label>
                            <input name="og_keywords" class="form-control" type="text" value="<?=set_value('og_keywords')?>" placeholder=""> 
                        </div>
                    </div>
                </div>
                
                <div class="form-body margin-bottom-20 clearfix">
                    <div class="col-md-12">
                        <div class="clearfix" style="border: 1px dashed; padding: 20px; padding-bottom: 0;">
                            <div class="col-md-6 margin-bottom-20">
                                <input type="checkbox" value="1" name="full_width" <?=set_checkbox("full_width", "1")?>> Full Width Post without sidebar
                            </div>
                            <div class="col-md-6 margin-bottom-20">
                                <input type="checkbox" value="1" name="is_standalone" <?=set_checkbox("is_standalone", "1")?>> Standalone Post without header, footer, sidebar
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="form-actions text-center">
                    <button type="submit" class="btn blue" name="status" value="drafted">Save Draft</button>
                    <button type="submit" class="btn green" name="status" value="published">Publish</button>
                    <button type="button" class="btn btn-info" title="Save the post first to preview" onclick="alert('Save or publish the post first to preview.')">Preview</button>
                    <button type="reset" class="btn red">Cancel</button>
                </div>
            </div>
        </div>
        <?=form_close()?>

<link type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"/>
<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<link type="text/css" href="assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
<script type="text/javascript" src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript" src="assets/global/plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="assets/global/scripts/tinymce5.js"></script>
<script>
    jQuery(document).ready(function($){
        $('.datetimepicker').datetimepicker();
    });
</script>
<style>.modal-body .row-fluid .form-group{ margin: 0;}.note-help.btn-group{ display: none; }</style>
