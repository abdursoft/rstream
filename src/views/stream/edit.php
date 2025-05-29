<?php

use Abdur\RStream\Class\Rstream;

wp_enqueue_media();

if ($_GET['rstream_edit']) {
    $rstream = (new Rstream)->getRStream($_GET['rstream_edit']);
}
?>
<div class="modal-body">
    <div class="rssStatus mx-auto"></div>
    <form id="advertsForm" onsubmit="return false">
        <div class="form-group">
            <label for="rstream_video_title">Video Title</label>
            <input type="text" id="rstream_video_title" class="form-control" name="title" value="<?= $rstream->title ?>" placeholder="Video title">
        </div>
        <div class="form-group my-2">
            <label for="rstreamPoster">Thumbnail</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="rstreamPoster" name="poster"  value="<?= $rstream->thumbnail ?>" autocomplete="off" placeholder="https://domain.com/images/rss.jpg" aria-label="poster.png" aria-describedby="rstreamGetPoster">
                <div class="input-group-append">
                    <span class="input-group-text fa fa-cloud-upload cursor-pointer" style="cursor:pointer;" id="rstreamGetPoster"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="video_url">Video URL</label>
            <input type="url" id="video_url" class="form-control" name="video_url" value="<?= $rstream->video ?>" placeholder="Adverts redirect URL">
            <input type="hidden" name="id" value="<?= $rstream->id ?>">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary submitBTN">Save</button>
        </div>
    </form>
</div>

<script>
    $("#advertsForm").on('submit', (e) => {
        e.preventDefault();
        var post_data = $("#advertsForm").serialize() + "&action=rstream_add_data&param=post_rstream_data";
        $.post(ajaxurl['ajaxurl'], post_data, function(response) {
            var data = $.parseJSON(response);
            var textClass = '';
            if (data['status'] == 'success') {
                textClass = 'alert alert-success';
            } else {
                textClass = 'alert alert-danger';
            }
            $('.rssStatus').html('<div class="' + textClass + '">' + data['message'] + '</div>');
            $("#advertsForm")[0].reset();
        });
    })


    $('#rstreamGetPoster').on('click', function() {
        var images = wp.media({
            title: 'Select a poster',
            multiple: false
        }).open().on('select', function() {
            var uploadImages = images.state().get('selection').first();
            var selectedImage = uploadImages.toJSON();
            $('#rstreamPoster').val(selectedImage.url);
        });
    })
</script>