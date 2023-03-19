<?=form_open( "settings/general_info", array( 'class'=> 'form-horizontal'))?>
    <div class="portlet box blue-hoki">
        <div class="portlet-title">
            <div class="caption"> Information </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Company</label>
                    <div class="col-md-9">
                        <input name="company" class="form-control" required="required" maxlength="255" value="<?=$site->company?>" id="" type="text"> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Contact Person</label>
                    <div class="col-md-9">
                        <input name="contact_person" class="form-control" maxlength="200" value="<?=$site->contact_person?>" id="" type="text"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Contact Number</label>
                    <div class="col-md-9">
                        <input name="phone" class="form-control" maxlength="100" value="<?=$site->phone?>" id="" type="text"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Email Address</label>
                    <div class="col-md-9">
                        <input name="email" class="form-control" value="<?=$site->email?>" type="email"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Address</label>
                    <div class="col-md-9">
                        <input name="address" class="form-control" value="<?=$site->address?>" type="text"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Reply Email</label>
                    <div class="col-md-9">
                        <input name="reply_email" class="form-control" value="<?=$site->reply_email?>" type="email" placeholder="Email address to be shown to users in system generated emails."> </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 control-label">App / Site Title</label>
                    <div class="col-md-9">
                        <input name="app_title" class="form-control" value="<?=$site->app_title?>" type="text" placeholder="Titlebar text for backend & frontend"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tagline</label>
                    <div class="col-md-9">
                        <input name="tagline" class="form-control" value="<?=$site->tagline?>" type="text" placeholder="Titlebar text for backend & frontend"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Footer Text</label>
                    <div class="col-md-9">
                        <input name="footer_text" class="form-control" value="<?=$site->footer_text?>" type="text"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Footer Link</label>
                    <div class="col-md-9">
                        <input name="footer_link" class="form-control" value="<?=$site->footer_link?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Facebook Link</label>
                    <div class="col-md-9">
                        <input name="facebook" class="form-control" value="<?=$site->facebook?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Twitter Link</label>
                    <div class="col-md-9">
                        <input name="twitter" class="form-control" value="<?=$site->twitter?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Instagram Link</label>
                    <div class="col-md-9">
                        <input name="instagram" class="form-control" value="<?=$site->instagram?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Short Description for search engine (max 160 characters)</label>
                    <div class="col-md-9">
                        <textarea name="description" class="form-control"><?=$site->description?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Keywords for search engine (comma separated)</label>
                    <div class="col-md-9">
                        <textarea name="keywords" class="form-control"><?=$site->keywords?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Insert Codes before closing <strong>Head</strong> tag</label>
                    <div class="col-md-9">
                        <textarea name="before_head_end_tag" class="form-control"><?=$site->before_head_end_tag?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Insert Codes before closing <strong>Body</strong> tag</label>
                    <div class="col-md-9">
                        <textarea name="before_body_end_tag" class="form-control"><?=$site->before_body_end_tag?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-actions fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green"><i class="fa fa-check"></i> Update</button>
                            <button type="reset" class="btn default">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
    <?=form_close();?>