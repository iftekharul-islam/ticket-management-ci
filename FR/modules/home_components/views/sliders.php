<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>


        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Add Slide
                </div>
            </div>
            <div class="portlet-body form">
                <?=form_open_multipart('home_components/sliders', array('class' => 'form-horizontal'))?>
                    <div class="form-body">
                        <div class="form-group ">
                            <label class="control-label col-md-3">Image <span class='label label-danger'>.png .jpg .gif</span><br><br>width x height = 2220 x 640px & Image size should be less than 500k (as minimum as possible).</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 300px; height: 93px;">
                                        
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
                                <input name="heading" class="form-control" type="text" value="<?=set_value('heading')?>" maxlength="25"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Description (Max 200 Characters)</label>
                            <div class="col-md-9">
                                <input name="description" class="form-control" type="text" value="<?=set_value('description')?>" maxlength="200"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Link </label>
                            <div class="col-md-9">
                                <input name="link" class="form-control" type="text" value="<?=set_value('link')?>"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Link title (Max 15 Characters)</label>
                            <div class="col-md-9">
                                <input name="link_title" class="form-control" type="text" value="<?=set_value('link_title')?>" maxlength="15"> 
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <span class="label label-warning">NOTE</span> <strong>Sliders will be shown in descending order. Latest entry will be shown first.</strong>
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



<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption"> Sliders </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="sample_6">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Heading</th>
                    <th>Description</th>
                    <th>Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sliders as $s):?>
                <tr>
                    <td><img src="assets/home/sliders/<?=$s->image?>" width="111"></td>
                    <td><?=$s->heading?></td>
                    <td><?=$s->description?></td>
                    <td><a href="<?=$s->link?>"><?=$s->link_title?></a></td>
                    <td>
                        <?=anchor("home_components/edit_slider/".$s->id, 'Edit', 'class="label btn-xs label-primary"')?>&nbsp;<?=anchor("home_components/delete_slider/".$s->id, 'Delete' ,array('onclick' => 'return confirm(\'Are you sure to delete the slide?\')', 'class' => 'label btn-xs label-danger'))?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
