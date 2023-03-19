<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>


        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    Add A Section or Advertisement In Homepage
                </div>
            </div>
            <div class="portlet-body form">
                <?=form_open_multipart('home_components/midsections', array('class' => 'form-horizontal'))?>
                    <div class="form-body">
                        <div class="form-group ">
                            <div class="clearfix">
                                <div class="col-md-6 margin-bottom-20">
                                    <div class="row">
                                        <label class="col-md-6">Image.<br>Max size- 300KB. <br>Allowed File types- <br><span class="label label-primary">.jpg</span> <span class="label label-danger">.png</span> <span class="label label-warning">.gif</span></label>
                                        <div class="col-md-6">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 86px; height: 86px;"></div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" data-trigger="fileinput"></div>
                                                <div>
                                                    <span class="btn btn-xs btn-info btn-file">
                                                        <span class="fileinput-new"> Select image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="image">
                                                    </span>
                                                    <a href="#" class="btn btn-xs btn-danger fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 margin-bottom-20">
                                    <label>Alt Text</label>
                                    <input name="alt_text" class="form-control" type="text" value="<?=set_value('alt_text')?>" maxlength="30" placeholder=""> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Image Link </label>
                            <div class="col-md-9">
                                <input name="link" class="form-control" type="text" value="<?=set_value('link')?>"> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">HTML Code or plain text (optional)</label>
                            <div class="col-md-9">
                                <textarea name="code" class="form-control"><?=set_value('code')?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Width of this section (relative to container width)</label>
                            <div class="col-md-4">
                                <?=form_dropdown('width', array("33.33" => "one-third", "66.66" => "two-third", "25" => "one-fourth", "50" => "half", "100" => "full-width"), set_value('width'), 'class="form-control"')?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Serial </label>
                            <div class="col-md-4">
                                <input name="serial" class="form-control" type="text" value="<?=set_value('serial')?>"> 
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



<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption"> Added Sections </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="sample_6">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Code/Text</th>
                    <th>Width</th>
                    <th>Serial</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($midsections as $s):?>
                <tr>
                    <td><?php if(!empty($s->image)){ ?><img src="assets/home/ads/<?=$s->image?>" style="max-width:200px;max-height: 150px;"><?php } ?></td>
                    <td><?=!empty($s->code)? "TRUE" : ""?></td>
                    <td><?=$s->width . "%"?></td>
                    <td><?=$s->serial?></td>
                    <td>
                        <?=anchor("home_components/edit_section/".$s->id, 'Edit', 'class="label btn-xs label-primary"')?>&nbsp;<?=anchor("home_components/delete_section/".$s->id, 'Delete' ,array('onclick' => 'return confirm(\'Are you sure to delete this section?\')', 'class' => 'label btn-xs label-danger'))?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
