<?
$family_name = strtolower(str_replace(' ', '_', $_GET['family_name']));
$user_name = trim(urldecode($_GET['user_name']));
$file_path = './data/' . $family_name . '.json';

$file_json;
if (!file_exists($file_path)) {
  $family_json = array(
    'family' => trim(urldecode($_GET['family_name'])),
    'members' => array(),
    'memories' => array()
  );
} else {
  $family_file = file_get_contents('./data/' . $family_name . '.json');
  $family_json = json_decode($family_file, true);
}

$user_id = -1;
for ($i = 0; $i < count($family_json['members']); ++$i) {
    if ($family_json['members'][$i] == $user_name) {
        $user_id = $i;
        break;
    }
}
if ($user_id < 0) {
    array_push($family_json['members'], $user_name);
    $user_id = 0;
}
$output = json_encode($family_json, JSON_PRETTY_PRINT);
file_put_contents($file_path, $output);

$get = 'family=' . $family_name . '&user=' . $user_id;
header('Location: timeline.php?' . $get);
die();
?>
