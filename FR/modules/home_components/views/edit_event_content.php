

        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                   Event Content
                </div>
            </div>
            <div class="portlet-body form">
                <?=form_open_multipart('home_components/edit_event_content/' . $content->id, array('class' => 'form-horizontal'))?>
                    <div class="form-body">
                        <div class="form-group ">
                            <div class="col-md-6 margin-bottom-20">
                                <label>Placement</label>
                                <?=form_dropdown('placement', array("bottom" => "Bottom", "top" => "Top", "sidebar" => "Sidebar"), set_value('placement', $content->placement), 'class="form-control"')?>
                            </div>
                            <div class="col-md-6 margin-bottom-20">
                                <label>Select Type</label>
                                <?=form_dropdown('type', array("category" => "Category", "events" => "Events / Performer"), set_value('type', $content->type), 'class="form-control"')?>
                            </div>
                            <div class="col-md-6 margin-bottom-20">
                                <label>Event / Category url</label>
                                <input name="event_url" class="form-control" type="text" value="<?=set_value('event_url', $content->event_url)?>" placeholder="" required=""> 
                            </div>
                            <div class="col-md-12 margin-bottom-20">
                                <p style="color:red">Note *</p>
                                <p>Category Url : <b>Full URL must be taken</b></p>
                                <p>Event Url : <b>Just Take a porsion after events from url</b></p>
                            </div>
                            <div class="col-md-12 margin-bottom-20">
                                <label>Content</label>
                                <textarea name="content" class="content tinymce"> <?=set_value('content', $content->content)?></textarea>
                            </div>
                        </div>
                        <div class="portlet-title" style="background-color: #3598dc;padding:10px 5px;font-size:18px;color:white;margin-bottom:20px">
                            <div class="caption">Event Content Meta [SEO] </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 margin-bottom-20">
                                <label>SEO Title <br><span style="color: #999;">If you want a <span style="color: red">different title</span> in search engine and social media</span></label>
                                <input name="og_title" class="form-control" type="text" value="<?=set_value('og_title', $content->og_title)?>" maxlength="200"> 
                            </div>
                            <div class="col-md-6 margin-bottom-20">
                                <label>Meta Description <br><span style="color: #999;">Overwrite site meta description defined in "Settings > Information"</span></label>
                                <input name="og_description" class="form-control" type="text" value="<?=set_value('og_description', $content->og_description)?>" placeholder=""> 
                            </div>
                            <div class="col-md-12 margin-bottom-20">
                                <label>Keywords</label>
                                <input name="og_keywords" class="form-control" type="text" value="<?=set_value('og_keywords', $content->og_keywords)?>" placeholder=""> 
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn blue">Submit</button>
                                <button type="reset" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>
                <?=form_close()?>
            </div>
        </div>


<script type="text/javascript" src="assets/global/plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="assets/global/scripts/tinymce5.js"></script>
<style>.modal-body .row-fluid .form-group{ margin: 0;}.note-help.btn-group{ display: none; }</style>


