<?
$family = $_GET['family'];
$family_file = file_get_contents('./data/' . $family . '.json');
$family_json = json_decode($family_file, true);
$id = $_GET['id'];
$story = $family_json['stories'][$id];
//echo var_dump($story);

$get = 'family=' . $_GET['family'] . '&id=' . $_GET['id'];

// templates
function story($family, $story) { ?>
  <div class="row comment">
      <img class="col-xs-2" src="./data/<?= $family ?>/parent.jpg" />
      <div class="col-xs-10">
          <? if (!$story['responseText']) { ?>
          <textarea name="responseText" class="form-control" style="height: 6em" placeholder="Type the story here"></textarea>
          <? } else { ?>
          <p><?= $story['responseText'] ?></p>
          <? } ?>
      </div>
  </div>
<? }

?>

<? include 'templates/header.html' ?>
<? include 'templates/nav.html' ?>
<div id="request" class="container-fluid">
    <div class="row">
        <div class="col-xs-6">
            <div class="main-photo" style="background-image:url(<?= $story['imagePath']?>);"></div>
        </div>
        <div class="col-xs-6 form-group">
            <form action="story_update_json.php?<?= $get ?>" method="post">
                <input name="date" type="hidden" placeholder="When was this photo taken?" />
                <div class="row">&nbsp;</div>
                <div class="row comment">
                    <img class="col-xs-2" src="./data/<?= $family ?>/user.jpg" />
                    <div class="col-xs-10">
                        <p><?= $story["prompt"] ?></p>
                    </div>
                </div>
                <? story($family, $story)?>
                <div id="step-3" class="row">
                    <div class="col-xs-10"></div>
                    <div class="col-xs-2">
                        <button type="submit" class="btn btn-primary" id="send">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<? include 'templates/footer.html' ?>
