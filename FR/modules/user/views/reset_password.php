    <div class="row">
        <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet box green ">
                        <div class="portlet-title">
                                <div class="caption">
                                        <i class="fa fa-users"></i> Edit Group
                                </div>
                        </div>
                        <div class="portlet-body form">
                                <?=form_open('user/reset_password/' . $code, array('class' => 'form-horizontal'))?>
                                        <div class="form-body">
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">New Password</label>
                                                        <div class="col-md-9">
                                                                <?=form_input($new_password)?>
                                                                <span class="help-block"> At least 8 characters long. </span>
                                                        </div>                                                        
                                                </div>
                                        </div>
                                        <div class="form-body">
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">Confirm New Password</label>
                                                        <div class="col-md-9">
                                                                <?=form_input($new_password_confirm)?>
                                                        </div>
                                                </div>
                                        </div>
                                        <?=form_input($csrf)?>
                                        <div class="form-actions">
                                                <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Submit</button>
                                                                <button type="reset" class="btn default">Reset</button>
                                                        </div>
                                                </div>
                                        </div>
                                <?php echo form_close();?>
                        </div>
                </div>
        </div>
</div>


