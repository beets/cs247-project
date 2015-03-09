<?
$family = $_GET['family'];
$family_file = file_get_contents('./data/' . $family . '.json');
$family_json = json_decode($family_file, true);
//echo var_dump($family_json);
$parent = $family_json['parent'];
$stories = $family_json['stories'];

$get = 'family=' . $_GET['family'];

function new_story() {
  global $get;
  ?>
  <li class="timeline-inverted timeline_new">
    <div class="tl-circ"></div>
    <div class="timeline-panel">
      <div class="tl-heading">
        <h4>Start a new story</h4>
      </div>
      <div class="tl-body">
        <div class="images row">
            <div class="col-xs-4"><a class="add_story" href="add_story.php?<? echo $get ?>">+</a></div>
        </div>
      </div>
    </div>
  </li>
<? }

function existing_story($id, $story) {
  global $get;
  ?>
  <li class="timeline-inverted existing-story">
    <a href="story.php?<? echo $get ?>&id=<? echo $id ?>">
        <div class="tl-circ"></div>
        <div class="timeline-panel">
            <div class="tl-heading">
              <h4><? echo $story['date'] ?></h4>
            </div>
            <div class="tl-body">
              <div class="images row">
                  <? if ($story['imagePath']) { ?>
                  <img src="<? echo $story['imagePath'] ?>" class="img img-responsive"/>
                  <? } ?>
                  <? /*if ($story['prompt']) { ?>
                    <p><? echo $story['prompt'] ?></p>
                  <? } ?>
                  <? if ($story['responseText']) { ?>
                    <p><? echo $story['responseText'] ?></p>
                  <? }*/ ?>
              </div>
            </div>
        </div>
    </a>
  </li>
<? }

?>

<? include 'templates/header.html' ?>
<? include 'templates/nav.html' ?>
<div id="request" class="container-fluid">
    <div class="row header">
        <img class="col-xs-3" src="./data/<? echo $family ?>/parent.jpg" />
        <h1 class="col-xs-9"><? echo $parent ?>'s lifetime of experiences</h1>
    </div>
    <ul class="timeline">
        <? new_story() ?>
        <? for ($i = 0; $i < count($stories); ++$i) { ?>
        <? existing_story($i, $stories[$i]); ?>
        <? } ?>
    </ul>
</div>
<? include 'templates/footer.html' ?>
