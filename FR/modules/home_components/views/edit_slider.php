<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>


        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Edit Slide
                </div>
            </div>
            <div class="portlet-body form">
                <?=form_open_multipart('home_components/edit_slider/' . $slider->id, array('class' => 'form-horizontal'))?>
                    <div class="form-body">
                        <div class="form-group ">
                            <label class="control-label col-md-3">Image <span class='label label-danger'>.png .jpg .gif</span><br><br>width x height = 2220 x 640px & Image size should be less than 500k (as minimum as possible).</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 300px; height: 93px;">
                                        <img src="assets/home/sliders/<?=!empty($slider->image)? $slider->image : ""?>">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput" style="width: 300px; height: 93px;">
                                        
                                    </div>
                                    <div>
                                        <span class="btn default btn-file">
                                        <span class="fileinput-new">
                                        Select image </span>
                                        <span class="fileinput-exists">
                                        Change </span>
                                        <input type="file" name="image">
                                        </span>
                                        <a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
                                        Remove </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Heading (Max 25 Characters)</label>
                            <div class="col-md-9">
                                <input name="heading" class="form-control" type="text" value="<?=set_value('heading', $slider->heading)?>" maxlength="25"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Description (Max 200 Characters)</label>
                            <div class="col-md-9">
                                <input name="description" class="form-control" type="text" value="<?=set_value('description', $slider->description)?>" maxlength="200"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Link </label>
                            <div class="col-md-9">
                                <input name="link" class="form-control" type="text" value="<?=set_value('link', $slider->link)?>"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Link title (Max 15 Characters)</label>
                            <div class="col-md-9">
                                <input name="link_title" class="form-control" type="text" value="<?=set_value('link_title', $slider->link_title)?>" maxlength="15"> 
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <span class="label label-warning">NOTE</span> <strong>Sliders will be shown in descending order (3,2,1).</strong>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Serial No.</label>
                            <div class="col-md-9">
                                <input name="serial" class="form-control" type="number" value="<?=set_value('serial', $slider->serial)?>" maxlength="2"> 
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


<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
