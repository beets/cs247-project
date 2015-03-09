<?
$family = $_GET['family'];
$family_file = file_get_contents('./data/' . $family . '.json');
$family_json = json_decode($family_file, true);
//echo var_dump($family_json);
$parent = $family_json['parent'];
$stories = $family_json['stories'];

$get = 'family=' . $_GET['family'];

?>

<? include 'templates/header.html' ?>
<? include 'templates/nav.html' ?>
<div id="request" class="container-fluid">
    <h2>Add a story</h2>
    <div id=step-1 class="main-photo">
        <div class="upload-photo">
            <div class="row" id="instructions">
                <div class="col-xs-12">
                    <h5>Step 1: Upload an photo</h5>
                </div>
            </div>
            <div id="photo-form" class="row">
                <form id="photo-upload" action="json_upload.php" method="post" enctype="multipart/form-data">
                    <div class="col-xs-6">
                        <input type="file" name="photo" accept="image/*" capture="">
                    </div>
                    <div class="col-xs-6">
                        <input type="submit" name="upload" value="Upload">
                    </div>
                </form>
            </div>
            <div id="photo-uploaded" class="row" style="display:none">
                <img class="img img-responsive col-xs-12" />
            </div>
        </div>
    </div>
    <form id="save_story" action="save_story.php?<? echo $get ?>" method="post" onkeypress="return event.keyCode != 13;">
    <div id=step-2 style="display:none">
        <div class="row instructions">
            <div class="col-xs-12">
                <h5>Step 2: When was this photo taken?</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <input name="date" type="text" placeholder="1989" />
            </div>
        </div>
    </div>
    <div id=step-3 style="display:none">
        <input name="photo_url" type="hidden" />
        <div class="row instructions">
            <div class="col-xs-12">
                <h5>Step 3: Write a message for your parent</h5>
            </div>
        </div>
        <div class="row comment">
            <img class="col-xs-2" src="./data/<? echo $family ?>/user.jpg" />
            <div class="col-xs-10">
                <textarea name="prompt" style="height: 6em">Hi Dad! I found this picture of you. The kids would love to hear more about it. Where were we when we took that photo?</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10"></div>
            <div class="col-xs-2">
                <button type="submit" class="btn btn-primary" id="send">Send</button>
            </div>
        </div>
    </div>
    </form>
</div>
<? include 'templates/footer.html' ?>
<script>
$(function() {
    function step3() {
        $('#step-2 .instructions h5').text('Story date');
        $('#step-3').show();
        $('#step-3 textarea').focus();
    };
    $('#step-2 input').focusout(function() {
        step3();
    });
    $('form#photo-upload').submit(function(event) {
        event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening
        var data = new FormData();
        data.append('photo', $('input[type=file]')[0].files[0]);
        $.ajax({
            url: 'json_upload.php?<? echo $get ?>',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR) {
                if (data.url) {
                    // Success
                    $('#photo-form').hide();
                    $('#instructions').hide();
                    $('#step-2').show();
                    $('#photo-uploaded img').attr('src', data.url);
                    $('#photo-uploaded').show();
                    $('form#save_story input[name=photo_url]').val(data.url);
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
