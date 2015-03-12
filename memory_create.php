<?  include 'common.php'; ?>

<? include 'templates/header.html' ?>
<? include 'templates/nav.html' ?>
<form id="photo-upload" action="json_upload.php" method="post" enctype="multipart/form-data" style="display:none">
    <input type="file" name="photo" accept="image/*" capture="">
    <input type="submit" name="upload" value="Upload">
</form>
<div id="create" class="container-fluid">
    <h2>Add a story</h2>
    <h5>First, upload a photo</h5>
    <form id="create_story" action="memory_create_post.php?<?= $get ?>" method="post" onkeypress="return event.keyCode != 13;">
    <div id="photo-form">
        <div class="upload-photo">
            <span class="glyphicon glyphicon-camera"></span>
            <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate" style="display:none"></span>
        </div>
        <div class="img-container main-photo" style="display:none">
            <img class="img" src=""/>
            <input type=text name=title class="form-control" placeholder="Caption this photo" />
        </div>
        <input name="photo_url" type="hidden" />
    </div>
    <div id="photo-uploaded" class="row" style="display:none">
        <img class="img img-responsive col-xs-12" />
    </div>
    <div id=step-3 style="display:none">
        <div class="form-group">
            <label for="prompt"><h5>Ask your family to add to this memory</h5></label>
            <textarea rows="5" name=prompt class="form-control" placeholder="What makes you smile when you this photo?"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" id="send">Send</button>
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
                    $('#photo-form .upload-photo').hide();
                    $('.main-photo img').attr('src', data.url);
                    $('.main-photo').show();
                    $('form#create_story input[name=photo_url]').val(data.url);
                    $('#step-3').slideDown();
                    setTimeout(function() {
                        $("html, body").animate({ scrollTop: $(document).height() }, "easeInOutQuint");
                    }, 0);
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
