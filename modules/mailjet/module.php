<?php

$Module = [
    'name'              => 'mailjetapiv3',
    'variable_params'   => true
];

$ViewList                   = [];
$ViewList['inscription']    = [
	'script'    => 'inscription.php',
	'function'  => 'inscription',
    'params'    => ['e-mail']
];

$FunctionList                   = [];
$FunctionList['inscription']    = [];

?>