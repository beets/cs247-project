<? include('common.php');

function new_story() {
  global $get;
  ?>
  <li class="timeline-inverted timeline_new">
    <a href="memory_create.php?<?= $get ?>">
    <div class="tl-circ"></div>
    <div class="timeline-panel">
      <div class="tl-heading">
        <h4>Start a new story</h4>
      </div>
      <div class="tl-body">
        <div class="images row">
            <div class="col-xs-4"><div class="add_story">+</div></div>
        </div>
      </div>
    </div>
    </a>
  </li>
<? }

function existing_memory($id, $memory) {
  global $get, $user_id;
  $responses = $memory['responses'];
  $completed = false;
  $video_count = 0;
  $text_count = 0;
  for ($i = 0; $i < count($responses); ++$i) {
    if ($responses[$i]['member'] == $user_id) {
      $completed = true;
      if ($responses[$i]['video_url']) {
        $video_count++;
      } else {
        $text_count++;
      }
    }
  }
  $url = 'memory.php?' . $get . '&id=' . $id;
  $class = '';
  if ($completed) {
      $class .= 'memory-completed';
  } else {
      $url .= '&edit=1';
  }
  ?>
  <li class="existing-memory timeline-inverted <?=$class?>">
    <a href="<?= $url ?>">
        <div class="tl-circ">
            <? if (!$completed) { ?>
            <span class="glyphicon glyphicon-pencil"></span>
            <? } else { ?>
            <span class="glyphicon glyphicon-ok"></span>
            <? } ?>
        </div>
        <div class="timeline-panel">
            <div class="tl-body">
              <div class="images row">
                  <img src="<?= $memory['photo_url'] ?>" class="img img-responsive center"/>
              </div>
              <h4 class="title"><?= $memory['title'] ?></h4>
              <div class="text-right">
                <span class="glyphicon glyphicon-facetime-video"></span> <?= $video_count ?>&nbsp;&nbsp; 
                <span class="glyphicon glyphicon-envelope"></span> <?= $text_count ?></p>
            </div>
        </div>
    </a>
  </li>
<? }

?>

<? include 'templates/header.html' ?>
<? include 'templates/nav.html' ?>
<div id="main-timeline" class="container-fluid">
    <h1><?= $family_name ?> memories</h1>
    <div class="timeline-container">
        <ul class="timeline">
            <? if (count($memories) == 0) {
                new_story();
            } ?>
            <? for ($i = count($memories) - 1; $i >= 0; --$i) { ?>
            <? existing_memory($i, $memories[$i]); ?>
            <? } ?>
        </ul>
    </div>
</div>
<a id="add-story" href="memory_create.php?<?= $get?>">
    <span class="glyphicon glyphicon-plus"></span>
</a>
<? include 'templates/footer.html' ?>
<script>
$(function() {
    
});
</script>
