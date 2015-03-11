<?
$family_name = $_GET['family'];
$user_id = $_GET['user'];

$family_file = file_get_contents('./data/' . $family_name . '.json');

$family_json = json_decode($family_file, true);
$user_name = $family_json['members'][$user_id];
$memories = $family_json['memories'];

$get = 'family=' . $family_name . '&user=' . $user_id;
?>
