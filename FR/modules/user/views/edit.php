
        <div class="portlet box green ">
            <div class="portlet-title">
                <div class="caption"> <i class="icon-user-follow"></i>
                    <?=$page_title?>
                </div>
            </div>
            <div class="portlet-body form">
                <?=form_open( "user/edit/" . $user_data->username . (!empty($_GET['re'])? '?re=' . $_GET['re'] : ''), array( 'class'=> 'form-horizontal'))?>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">First Name *</label>
                            <div class="col-md-9">
                                <input name="first_name" value="<?=set_value('first_name', $user_data->first_name)?>" class="form-control" type="text" required=""> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Last Name *</label>
                            <div class="col-md-9">
                                <input name="last_name" value="<?=set_value('last_name', $user_data->last_name)?>" class="form-control" type="text"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Designation</label>
                            <div class="col-md-9">
                                <input name="designation" value="<?=set_value('designation', $user_data->designation)?>" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Phone</label>
                            <div class="col-md-9">
                                <input name="phone" value="<?=set_value('phone', $user_data->phone)?>" class="form-control" type="text"> 
                            </div>
                        </div>
                        <?php if($is_admin && $user_data->username != $this->session->userdata('username')){ ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label">New Password</label>
                            <div class="col-md-9">
                                <input name="password" placeholder="Enter password if & only if you would like to change" class="form-control" type="password"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Confirm Password</label>
                            <div class="col-md-9">
                                <input name="password_confirm" placeholder="Confirm password if & only if you would like to change" class="form-control" type="password"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Select Group</label>
                            <div class="col-md-9">
                                <?=form_dropdown('group', $groups, set_value('group', $this->ion_auth->get_users_groups($user_data->id)->row()->id), 'class="form-control"');?> 
                            </div>
                        </div>
                        <?php } ?>
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
