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
        <div class="col-sm-6">
            <div class="main-photo" style="background-image:url(<?= $story['imagePath']?>);"></div>
            <div class="row comment">
                <img class="col-xs-2" src="./data/<?= $family ?>/user.jpg" />
                <div class="col-xs-10">
                    <p><?= $story["prompt"] ?></p>
                </div>
            </div>
            <? //story($family, $story)?>
        </div>
        <div class="col-sm-6 form-group">
            <form action="story_update_json.php?<?= $get ?>" method="post">
                <div class="form-group">
                    <label for="title">Story title</label>
                    <input type="text" value="<?= $story['title']?>" class="form-control" name="title" placeholder="The best day of my life"/>
                </div>
                <div class="form-group">
                    <label for="date">When was this photo taken?</label>
                    <input type="text" value="<?= $story['date']?>" class="form-control" name="date" placeholder="1989"/>
                </div>
                <div class="form-group">
                    <label for="story">Tell us about the story</label>
                    <textarea type="text" class="form-control" name="responseText" placeholder="Tell us about the photo. Where and when was it taken? What were you thinking or feeling at the time you took it?"><?= $story['responseText']?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="send">Save</button>
            </form>
        </div>
    </div>
</div>
<? include 'templates/footer.html' ?>
