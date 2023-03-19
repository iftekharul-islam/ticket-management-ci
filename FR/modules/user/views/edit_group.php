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
                                <?=form_open(current_url(), array('class' => 'form-horizontal'))?>
                                        <div class="form-body">
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">Group Name</label>
                                                        <div class="col-md-9">
                                                                <?=form_input($group_name)?>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="form-body">
                                                <div class="form-group">
                                                        <label class="col-md-3 control-label">Description</label>
                                                        <div class="col-md-9">
                                                                <?=form_input($group_description)?>
                                                        </div>
                                                </div>
                                        </div>
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


