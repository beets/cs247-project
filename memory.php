<?
include('common.php');
$memory = $memories[$_GET['id']];
$edit_mode = $_GET['edit'];

function display_response($response) {
    global $family_json;
?>
<div class="response">
    <h4><?= $family_json['members'][$response['member']] ?></h4>
    <? if ($response['text']) { ?>
    <div>
        <p><?= nl2br($response['text'])?></p>
    </div>
    <? } else { ?>
        <video src="<?= $response['video_url']?>" controls></video>
    <? } ?>
</div>
<? } ?>

<? include 'templates/header.html' ?>
<? include 'templates/nav.html' ?>
<pre>
* Add link back to timeline?
* Color for each user
</pre>
<div id="memory" class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <h1><?= $memory['title'] ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <img class="main-photo img" src="<?= $memory['photo_url']?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h2><?= $memory['prompt'] ?></h2>
        </div>
    </div>
    <? if ($edit_mode) { ?>
        <div class="buttons">
            <button class="btn btn-primary" id="video">Video</button>
            <button class="btn btn-primary" id="text">Type</button>
        </div>
        <form id="photo-upload" action="json_upload.php" method="post" enctype="multipart/form-data" style="display:none">
            <input type="file" name="photo" accept="video/*" capture="">
            <input type="submit" name="upload" value="Upload">
        </form>
        <form action="memory_update.php?<?=$_SERVER['QUERY_STRING'] ?>" method="post" id="memory-update" style="display:none">
            <input type=hidden name="video_url" />
            <div class="form-group">
                <textarea name=text class="form-control"></textarea>
            </div>
            <button class="btn btn-primary" type=submit>Add memory</button>
        </form>
    <? } else { ?>
        <? //for ($i = count($memory['responses']); $i >= 0; --$i) { ?>
        <? for ($i = 0; $i < count($memory['responses']); ++$i) { ?>
            <? display_response($memory['responses'][$i]) ?>
        <? } ?>
    <? } ?>
</div>
<? include 'templates/footer.html' ?>
<script>
$(function() {
    $('button#video').click(function() {
        $('#photo-upload input[name=photo]').click();
        // XXX don't hide buttons / deal with error or back
        // XXX add reminder to point camera forward
        $('.buttons').hide();
    });
    $('button#text').click(function() {
        $('.buttons').hide();
    });
    $('form#photo-upload input[name=photo]').change(function() {
        $('form#photo-upload').submit();
        // XXX show some spinner (or just do a non-ajax submit
    });
    $('form#photo-upload').submit(function(event) {
        event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening
        var data = new FormData();
        data.append('photo', $('input[type=file]')[0].files[0]);
        $.ajax({
            url: 'json_upload.php?<?= $get ?>',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR) {
                if (data.url) {
                    // Success
                    $('form#memory-update input[name=video_url]').val(data.url);
                    $('form#memory-update').submit();
                } else {
                    // Handle errors here
                    console.log('ERRORS: ' + data.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors here
                console.log('ERRORS: ' + textStatus);
            },
            complete: function() {
                // STOP LOADING SPINNER
            }
        });
        return false;
    });
});
</script>
