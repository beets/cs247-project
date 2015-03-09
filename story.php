<?
$family = $_GET['family'];
$family_file = file_get_contents('./data/' . $family . '.json');
$family_json = json_decode($family_file, true);
$id = $_GET['id'];
$story = $family_json['stories'][$id];
//echo var_dump($story);

$get = 'family=' . $_GET['family'] . '&id=' . $_GET['id'];

// templates
function new_comment($commentText) { ?>
  <div class="row comment">
      <img class="col-xs-2" src="/images/user-0.jpg" />
      <div class="col-xs-10">
          <textarea name="responseText" style="height: 6em"><? echo $commentText ?></textarea>
      </div>
  </div>
<? }

?>

<? include 'templates/header.html' ?>
<? include 'templates/nav.html' ?>
<div id="request" class="container-fluid">
    <h2>Story from <? echo $story['date'] ?></h2>
    <div class="main-photo">
        <div id="step-0" class="row">
            <div class="col-xs-12 upload-photo">
                <span class="glyphicon glyphicon-camera"></span>
            </div>
        </div>
        <form action="save_response.php?<? echo $get ?>" method="post">
        <input name="date" type="text" placeholder="When was this photo taken?" />
        <? echo $story["prompt"] ?>
        <? new_comment("Type the story here")?>
        <div id="step-3" class="row">
            <div class="col-xs-10"></div>
            <div class="col-xs-2">
                <button type="submit" class="btn btn-primary" id="send">Send</button>
            </div>
        </div>
    </div>
</div>
<? include 'templates/footer.html' ?>
