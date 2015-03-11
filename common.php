<?
$family_id = $_GET['family'];
$user_id = $_GET['user'];

$family_file_path = './data/' . $family_id . '.json';
$family_file = file_get_contents($family_file_path);

$family_json = json_decode($family_file, true);
$user_name = $family_json['members'][$user_id];
$memories = $family_json['memories'];

$get = 'family=' . $family_id . '&user=' . $user_id;
?>
