<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption"> Customers (Total <?=$noofusers?>)</div>
        <div class="pull-right"><a href="user/customers" class="btn btn-success" style="margin-top:3px;">Refresh</a></div>
    </div>
    <div class="portlet-body">
        <div class="margin-bottom-20" style="max-width: 425px;">
            <form method="post" action="user/customers">
                <div class="input-group input-group-lg">
                    <input class="form-control" placeholder="Enter name, email, phone etc" type="text" name="keyword" value="<?=set_value("keyword")?>" required>
                    <span class="input-group-btn">
                        <button class="btn green" type="submit">Search user!</button>
                    </span>
                </div>
            </form>
        </div>
        <table class="table table-striped table-bordered table-hover" style="margin-bottom: 0;">
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
                        <?=!empty($user->active)? anchor("user/deactivate/" . $user->username . '?re=user/customers', 'Deactivate' ,array('onclick' => 'return confirm(\'Are you sure to deactivate this user?\')', 'class' => 'label btn-xs label-danger')) : anchor("user/activate/" . $user->username . '?re=user/customers', 'Activate' ,array('onclick' => 'return confirm(\'Do you want to activate this user again?\')', 'class' => 'label btn-xs label-success'))?>
                        <?=anchor("user/edit/" . $user->username . '?re=user/customers', 'Edit' ,array('class' => 'label btn-xs label-info'))?>
                    </td>
                </tr>
                <?php endforeach;?> </tbody>
        </table>
        
        <?=!empty($links)? '<div class="pagination margin-top-20">' . $links . '</div>' : ''?>
        
    </div>
</div>
