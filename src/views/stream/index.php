
<?php
use Abdur\RStream\Class\Table;

wp_enqueue_media();

if (isset($_GET['rstream_add'])) {
    include_once plugin_dir_path(__FILE__) . "/add.php";
} elseif (isset($_GET['rstream_edit'])) {
    include_once plugin_dir_path(__FILE__) . "/edit.php";
} else {

?>
<style>
    .paginate_button {
        border-radius: 0 !important;
    }

    .abs_video_item>td>a {
        color: coral !important;
        text-decoration: none;
        font-size: 24px;
    }
</style>
    <div class="p-4">
        <div class="rssStatus mx-auto"></div>
        <div class="w-100 mt-5">
            <table id="example" class="display w-100 mt-5" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Thumbnail</th>
                        <th>Shortcode</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="videoTableBody">
                    <?= (new Table())->rstreamItemsTable() ?>
                </tbody>
            </table>
        </div>
    </div>



    <script>
        function deleteRStreamVideo(id) {
            if (confirm('Are you sure to delete this podcast?')) {
                const postData = {
                    'id': id,
                    'action': 'rstream_delete',
                    'param': 'delete_rstream'
                }
                $.post(ajaxurl['ajaxurl'], postData, function(response) {
                    const data = JSON.parse(response);
                    if (data.status == 'success') {
                        $('#example').DataTable().destroy();
                        $("#videoTableBody").html(data.RStreams);
                        renderTable("#example");
                        $(".rssStatus").html(`<div class='alert alert-success'>${data.message}</div>`);
                    } else {
                        $(".rssStatus").html(`<div class='alert alert-danger'>${data.message}</div>`);
                    }
                });
            }
        }


        function renderTable(container) {
            var table = $(container).DataTable({
                select: false,
                "columnDefs": [{
                    className: "Video",
                    "targets": [0],
                    "visible": true,
                    "searchable": false
                }]
            });
        }

        $(window).on('load', () => {
            renderTable("#example");
        })
    </script>
<?php
}
?>