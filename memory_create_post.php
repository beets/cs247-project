<?
include('common.php');

//The page that calls this URL will send values for date and prompt
$new_memory = array(
  "prompt" => trim($_POST['prompt']),
  "title" => trim($_POST['title']),
  "responses" => array(),
  "photo_url" => $_POST['photo_url']
);
$id = array_push($family_json['memories'], $new_memory) - 1;
$output = json_encode($family_json, JSON_PRETTY_PRINT);
file_put_contents($family_file_path, $output);

// Add user id here (or always assume user 0 responds
$link = 'http://'.$_SERVER['SERVER_NAME'].'/moments/index.php?family='.$family_id.'&reply='.$id;
?>

<? include 'templates/header.html' ?>
<? include 'templates/nav.html' ?>
<div id="request" class="container-fluid">
    <h2>Hooray, you've created a story!</h2>
    <div class="row main-photo-row">
        <div class="col-xs-12">
            <div class="main-photo" style="background-image:url(<?= $_POST['photo_url']?>);"></div>
        </div>
    </div>
    <h5>Send this link to your family to get their memories</h5>
    <div class="row">
        <div class="col-xs-12 form-group form-group-lg">
            <textarea name="link" class="form-control"><?= $user_name ?> wants to ask for your opinion of a photo:

    <?= $new_memory['prompt'] ?>

            

Moments is an app that helps you curate memories with your family:

<?= $link ?></textarea>
        </div>
    </div>
    <a class="btn btn-primary" href="timeline.php?<?= $_SERVER['QUERY_STRING']?>">Back to timeline</a>
</div>
<? include 'templates/footer.html' ?>
<script>
    $('textarea').click(function() {
        $(this).select();
    });
</script>
