

        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Logos
                </div>
            </div>
            <div class="portlet-body form">
                <?=form_open_multipart('settings/logos', array('class' => 'form-horizontal'))?>
                    <div class="form-body">
                        <div class="form-group ">
                            <label class="control-label col-md-3">Backend Logo -<br> Upload <span class='label label-danger'>.png</span> File</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 300px; height: 100px;">
                                        <img src="assets/logo/backend-logo.png" alt=""/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 300px; height: 100px;"></div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> Select image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="backend-logo">
                                        </span>
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-md-3">Frontend Logo -<br> Upload <span class='label label-danger'>.png</span> File</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 300px; height: 100px;">
                                        <img src="assets/logo/logo.png" alt=""/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 300px; height: 100px;"> </div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> Select image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="logo">
                                        </span>
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                    </div>
                                </div>
                                <br>Max size is 500k & (max width x max height) is (600px x 200px) for each logo.
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" name='submit' value='submit' class="btn blue">Upload</button>
                                <button type="reset" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>
                <?=form_close()?>
            </div>
        </div>

<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
