<?php
$username = 'tanderson';
$password = '12345';

$context = stream_context_create(array(
	'http' => array(
		'header'  => "Authorization: Basic " . base64_encode("$username:$password")
	)
));
$data = file_get_contents('http://localhost:8000/index.php', false, $context);

print_r($data);