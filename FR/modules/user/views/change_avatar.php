<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>

<div class="row">
    <div class="col-md-12 ">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Change Avatar
                </div>
            </div>
            <div class="portlet-body form">
                <?=form_open_multipart('user/change_avatar', array('class' => 'form-horizontal'))?>
                    <div class="form-body">
                        <div class="form-group ">
                            <label class="control-label col-md-3">Change Avatar</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                        <img src="<?=(!empty($user->avatar) && file_exists('assets/avatars/' . $user->avatar))? 'assets/avatars/' . $user->avatar : 'assets/avatars/default-avatar.png' ?>" alt="<?=$user->first_name . ' ' .$user->last_name ?>"/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                        
                                    </div>
                                    <div>
                                        <span class="btn default btn-file">
                                        <span class="fileinput-new">
                                        Select image </span>
                                        <span class="fileinput-exists">
                                        Change </span>
                                        <input type="file" name="userfile">
                                        </span>
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                        Remove </a>
                                    </div>
                                </div>
                                <div class="clearfix margin-top-10">
                                    <span class="label label-danger">
                                        NOTE! 
                                    </span>
                                    &nbsp; Please Upload <span class="label label-warning">JPG</span> files only. Max size 500k. Use square image for better view.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" name="submit" value="avatar" class="btn blue">Confirm</button>
                                <button type="reset" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>
                <?=form_close()?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>