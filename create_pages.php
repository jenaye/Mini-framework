<?php
if (php_sapi_name() != 'cli') {
	echo 'CGI Mode !';
	exit;
}

if ($argc < 2) {
	exit('paramètre manquant !');
}

$path = __DIR__.'/pages/'.$argv[1];
if (strpos($path, '.php') === false) {
	$path = $path.'.php';
}

require 'core/contenu.php';
$file = fopen($path, 'w');

$contenu = new Contenu();
$contenu->add('Voici la page generer par le framework')->add_sauts(1)
// ajout d'une tabulation
	->addTab()->add('<h1>je vous invite a modifier son contenu</h1>')->add_sauts(1)
	->add('<hr>By jenaye');

$contenu->writeFile($file);
fclose($file);
chmod($path, 0777);