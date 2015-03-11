<?
include('common.php');
$memory = $memories[$_GET['id']];
$edit_mode = $_GET['edit'];

function display_response($response) {
    global $family_json;
?>
<div class="response">
    <h4><?= $family_json['members'][$response['member']] ?></h4>
    <div>
        <p><?= nl2br($response['text'])?></p>
    </div>
</div>
<? } ?>

<? include 'templates/header.html' ?>
<? include 'templates/nav.html' ?>
<pre>
* Add link back to timeline?
* Color for each user
</pre>
<div id="memory" class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <h1><?= $memory['title'] ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <img class="main-photo img" src="<?= $memory['photo_url']?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h2><?= $memory['prompt'] ?></h2>
        </div>
    </div>
    <? if ($edit_mode) { ?>
        <form action="memory_update.php?<?=$_SERVER['QUERY_STRING'] ?>" method="post">
            <div class="form-group">
                <textarea name=text class="form-control"></textarea>
            </div>
            <button class="btn btn-primary" type=submit>Add memory</button>
        </form>
    <? } else { ?>
        <? //for ($i = count($memory['responses']); $i >= 0; --$i) { ?>
        <? for ($i = 0; $i < count($memory['responses']); ++$i) { ?>
            <? display_response($memory['responses'][$i]) ?>
        <? } ?>
    <? } ?>
</div>
<? include 'templates/footer.html' ?>
