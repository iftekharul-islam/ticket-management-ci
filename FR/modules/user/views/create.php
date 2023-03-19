
        <div class="portlet box green ">
            <div class="portlet-title">
                <div class="caption"> <i class="icon-user-follow"></i>
                    <?=$page_title?>
                </div>
            </div>
            <div class="portlet-body form">
                <?=form_open( "user/create", array( 'class'=> 'form-horizontal'))?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">First Name *</label>
                            <div class="col-md-9">
                                <input name="first_name" value="<?=set_value('first_name')?>" class="form-control" type="text" required=""> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last Name *</label>
                            <div class="col-md-9">
                                <input name="last_name" value="<?=set_value('last_name')?>" class="form-control" type="text" required=""> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Designation</label>
                            <div class="col-md-9">
                                <input name="company" value="<?=set_value('designation')?>" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Phone</label>
                            <div class="col-md-9">
                                <input name="phone" value="<?=set_value('phone')?>" class="form-control" type="text"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email *</label>
                            <div class="col-md-9">
                                <input name="email" value="<?=set_value('email')?>" class="form-control" type="email" required=""> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password *</label>
                            <div class="col-md-9">
                                <input name="password" value="" class="form-control" type="password" required=""> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Confirm Password *</label>
                            <div class="col-md-9">
                                <input name="password_confirm" value="" class="form-control" type="password" required=""> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Select Group</label>
                            <div class="col-md-9">
                                <?=form_dropdown( 'group', $groups, set_value('group'), 'class="form-control"');?> 
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
                <?=form_close();?>
            </div>
        </div>
