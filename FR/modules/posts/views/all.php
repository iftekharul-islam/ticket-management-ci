<div class="portlet box blue">
    <div class="portlet-title" style="background: rgba(0, 0, 0, 0) linear-gradient(90deg, #3598dc 0%, rgb(8, 9, 8) 100%) repeat scroll 0% 0%;">
        <div class="caption"> Listing </div>
    </div>
    <div class="portlet-body">
        <div style="border: 1px solid #ddd;padding: 7px;margin-bottom: 5px;text-align: center;">
            <a href="posts/all">All</a> (<?=$all?>) | <a href="posts/all?status=published">Published</a> (<?=$published?>) | <a href="posts/all?status=drafted">Drafts</a> (<?=$drafts?>) | <a href="posts/all?status=deleted">Trash</a> (<?=$trash?>)
        </div>
        <table class="table table-striped table-bordered table-hover" id="listing">
            <thead>
                <tr>
                    <th>Thumb</th>
                    <th>Title</th>
                    <th>Categories</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
        <div class="clearfix"></div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" />

<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script>
jQuery(document).ready(function() {
    $('#listing').DataTable( {
        dom: 'lfrtip',
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: "<?=$callback?>"
    });
});
</script>
