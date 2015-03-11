<? include('common.php');

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

function existing_memory($id, $memory) {
  global $get;
  ?>
  <li class="existing-memory">
    <a href="memory.php?<?= $get ?>&id=<?= $id ?>">
        <div class="tl-circ"></div>
        <div class="timeline-panel">
            <div class="tl-body">
              <div class="images row">
                  <? if ($memory['photo_url']) { ?>
                  <img src="<?= $memory['photo_url'] ?>" class="img img-responsive center"/>
                  <? } ?>
              </div>
              <h4 class="title"><?= $memory['title'] ?></h4>
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
            <? for ($i = count($memories) - 1; $i >= 0; --$i) { ?>
            <? existing_memory($i, $memories[$i]); ?>
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
