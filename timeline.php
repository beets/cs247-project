<? include('common.php');

function new_story() {
  global $get, $user_id;
  ?>
  <li class="timeline-inverted timeline_new">
    <a class="show" href="memory_create.php?<?= $get ?>">
    <div class="tl-circ bg-user-<?=$user_id?>"></div>
    <div class="timeline-panel">
      <div class="tl-body">
          <div class="add_story bg-user-<?=$user_id?>">
            <span class="glyphicon glyphicon-plus"></span>
            <span>Add a story</span>
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
      if (isset($responses[$i]['video_url'])) {
        $video_count++;
      } else {
        $text_count++;
      }
    }
  }
  $url = 'memory.php?' . $get . '&id=' . $id;
  $class = '';
  if ($completed || $memory['user'] == $user_id) {
      $class .= 'memory-completed';
  } else {
      $url .= '&edit=1';
  }
  ?>
  <li class="existing-memory timeline-inverted <?=$class?>">
    <a class="show" href="<?= $url ?>">
        <div class="tl-circ bg-user-<?=$memory['user']?>">
        </div>
        <div class="timeline-panel">
            <div class="tl-body">
              <div class="img-container">
                  <img src="<?= $memory['photo_url'] ?>" class="img center"/>
                  <div class="request-status">
                    <? for ($i = 0; $i < count($responses); ++$i) { $response = $responses[$i]; ?>
                    <span class="glyphicon glyphicon-<?= isset($response['video_url']) ? 'facetime-video' : 'comment'?> user-<?=$response['member']?>"></span>
                    <? } ?>
                  </div>
              </div>
              <h4 class="title"><?= $memory['title'] ?></h4>
        </div>
    </a>
  </li>
<? }

?>

<? include 'templates/header.html' ?>
<? include 'templates/nav.html' ?>
<div id="main-timeline" class="container-fluid">
    <h1><?= $family_json['family'] ?> memories</h1>
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
<div id="tl-footer">
    <a id="add-story" href="memory_create.php?<?= $get?>">
        <span class="glyphicon glyphicon-plus bg-user-<?=$user_id?>"></span>
    </a>
      <ul class="nav navbar-nav navbar-right">
        <? for ($i = 0; $i < count($family_json['members']) && $i < 3; ++$i) { ?>
        <li><a href="#"><span class="user-circ bg-user-<?=$i?>"></span> <?=$family_json['members'][$i]?></a></li>
        <? } ?>
      </ul>
</div>
<? include 'templates/footer.html' ?>
