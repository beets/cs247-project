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
        <div>
            <div class="row" id="instructions">
                <div class="col-xs-12">
                    <h5>Step 1: Upload an photo</h5>
                </div>
            </div>
            <div id="photo-form" class="row">
                <div class="col-xs-12">
                    <div class="upload-photo">
                        <span class="glyphicon glyphicon-camera"></span>
                        <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display:none"></span>
                    </div>
                </div>
            </div>
            <form id="photo-upload" action="json_upload.php" method="post" enctype="multipart/form-data" style="display:none">
                <div class="col-xs-6">
                    <input type="file" name="photo" accept="image/*" capture="">
                </div>
                <div class="col-xs-6">
                    <input type="submit" name="upload" value="Upload">
                </div>
            </form>
            <div id="photo-uploaded" class="row" style="display:none">
                <img class="img img-responsive col-xs-12" />
            </div>
        </div>
    </div>
    <form id="save_story" action="save_story.php?<? echo $get ?>" method="post" onkeypress="return event.keyCode != 13;">
    <div id=step-3 style="display:none">
        <input name="photo_url" type="hidden" />
        <div class="row instructions">
            <div class="col-xs-12">
                <h5>Step 2: Write a message for your parent</h5>
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
    $('#photo-form .upload-photo .glyphicon-camera').click(function() {
        $('input[name=photo]').click();
    });
    $('form#photo-upload input[name=photo]').change(function() {
        $('.glyphicon-camera').hide();
        $('.glyphicon-refresh-animate').show();
        $('form#photo-upload').submit();
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
                    $('#photo-form .upload-photo').empty().css('background-image', 'url(' + data.url + ')');
                    $('#instructions').hide();
                    $('#step-3').show();
                    $('#step-3 textarea').focus();
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
