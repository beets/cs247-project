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
            <img class="main-photo img" src="<?= $story['imagePath']?>"/>
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
                <? $save = 0; $edit = $_GET['edit']; ?>
                <? $title = $story['title']; if ($title && !$edit) { ?>
                <h2><?= $title ?></h2>
                <? } else { $save = 1; ?>
                <div class="form-group">
                    <label for="title">Story title</label>
                    <input type="text" value="<?= $title?>" class="form-control" name="title" placeholder="The best day of my life"/>
                </div>
                <? } ?>

                <? $date = $story['date']; if ($date && !$edit) { ?>
                <h5><?= $family_json['parent']?>'s story from <?= $date ?></h5>
                <? } else { $save = 1; ?>
                <div class="form-group">
                    <label for="date">When was this photo taken?</label>
                    <input type="text" value="<?= $date?>" class="form-control" name="date" placeholder="1989"/>
                </div>
                <? } ?>

                <? $responseText = $story['responseText']; if ($responseText && !$edit) { ?>
                <div class="main-story">
                    <p><?= nl2br($responseText) ?></p>
                </div>
                <? } else { $save = 1; ?>
                <div class="form-group">
                    <label for="story">Tell us about the story</label>
                    <textarea type="text" class="form-control" name="responseText" placeholder="Tell us about the photo. Where and when was it taken? What were you thinking or feeling at the time you took it?"><?= $story['responseText']?></textarea>
                </div>
                <? } ?>

                <? if ($save) { ?>
                <button type="submit" class="btn btn-primary" id="send">Save</button>
                <? } else { ?>
                <a class="btn btn-default" id="edit" href="<?=$_SERVER['REQUEST_URI']?>&edit=1">Edit</a>
                <? } ?>
            </form>
        </div>
    </div>
</div>
<? include 'templates/footer.html' ?>
