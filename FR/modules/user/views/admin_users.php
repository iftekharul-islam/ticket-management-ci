<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption"> Administrators </div>
    </div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover" id="sample_6">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Last login</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user):?>
                <tr>
                    <td><?=htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8') . ' '. htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8')?></td>
                    <td><?=htmlspecialchars($user->email,ENT_QUOTES,'UTF-8')?></td>
                    <td><?=$user->phone?></td>
                    <td><?=date('Y-m-d h:i', $user->last_login)?></td>
                    <td>
                        <?=!empty($user->active)? anchor("user/deactivate/" . $user->username . '?re=user/admin_users', 'Deactivate' ,array('onclick' => 'return confirm(\'Are you sure to deactivate this user?\')', 'class' => 'label btn-xs label-danger')) : anchor("user/activate/" . $user->username . '?re=user/admin_users', 'Activate' ,array('onclick' => 'return confirm(\'Do you want to activate this user again?\')', 'class' => 'label btn-xs label-success'))?>
                        <?=anchor("user/edit/" . $user->username . "?re=user/admin_users", 'Edit' ,array('class' => 'label btn-xs label-info'))?>
                    </td>
                </tr>
                <?php endforeach;?> </tbody>
        </table>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css" />
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css" />
<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" />

<script type="text/javascript" src="assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script src="assets/admin/pages/scripts/table-advanced.js"></script>
<script>
jQuery(document).ready(function() {
    TableAdvanced.init();
});
</script>