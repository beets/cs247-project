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
            <div class="col-xs-4"><a class="add_story" href="add_story.php?<?= $get ?>">+</a></div>
        </div>
      </div>
    </div>
  </li>
<? }

function existing_story($id, $story) {
  global $get;
  ?>
  <li class="<?= ($id % 2) ? "timeline-inverted" : "" ?> existing-story">
    <a href="story.php?<?= $get ?>&id=<?= $id ?>">
        <div class="tl-circ"></div>
        <div class="tl-date">
           <h4><?= $story['date'] ?></h4>
        </div>
        <div class="timeline-panel">
            <div class="tl-body">
              <div class="images row">
                  <? if ($story['imagePath']) { ?>
                  <img src="<?= $story['imagePath'] ?>" class="img img-responsive"/>
                  <? } ?>
              </div>
              <h4 class="title"><?= $story['title'] ?></h4>
            </div>
        </div>
    </a>
  </li>
<? }

?>

<? include 'templates/header.html' ?>
<? include 'templates/nav.html' ?>
<div id="main-timeline" class="container-fluid">
    <h1><?= $parent ?>'s lifetime of experiences</h1>
    <div class="row header">
        <img class="grandpa-main" src="./data/<?= $family ?>/parent.jpg" />
    </div>
    <div class="timeline-container">
        <ul class="timeline">
            <? for ($i = count($stories) - 1; $i >= 0; --$i) { ?>
            <? existing_story($i, $stories[$i]); ?>
            <? } ?>
        </ul>
    </div>
</div>
<a id="add-story" href="add_story.php?<?= $_SERVER['QUERY_STRING']?>">
    <span class="glyphicon glyphicon-plus"></span>
</a>
<? include 'templates/footer.html' ?>
<script>
$(function() {
    
});
</script>
