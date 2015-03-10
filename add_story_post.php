<?
$family = $_GET['family'];
$family_file = file_get_contents('./data/' . $family . '.json');
$family_json = json_decode($family_file, true);

//The page that calls this URL will send values for date and prompt
$newStory = array(
  "prompt" => trim($_POST['prompt']),
  "responseText" => null,
  "audioPath" => null,
  "imagePath" => $_POST['photo_url']
);
$id = array_push($family_json['stories'], $newStory) - 1;
$output = json_encode($family_json, JSON_PRETTY_PRINT);
file_put_contents('data/' . $family . '.json', $output);

$link = 'http://'.$_SERVER['SERVER_NAME'].'/moments/story.php?'.$_SERVER['QUERY_STRING'].'&id='.$id;

//header('Location: timeline.php?family=' . $family);
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
    <h3>Send this link to your parent to get the story</h3>
    <div class="row">
        <div class="col-xs-12 form-group form-group-lg">
            <input type="text" name="link" class="form-control" value="<?= $link ?>" />
        </div>
    </div>
    <a class="btn btn-primary" href="timeline.php?<?= $_SERVER['QUERY_STRING']?>">Back to timeline</a>
</div>
<? include 'templates/footer.html' ?>
<script>
    $('input[name=link]').click(function() {
        $(this).select();
    });
</script>
