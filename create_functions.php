<?php
if (php_sapi_name() != 'cli') {
	echo 'CGI Mode !';
	exit;
}

if ($argc < 2) {
	exit('paramètre manquant !');
}

$path = __DIR__.'/functions/'.$argv[1];
if (strpos($path, '.php') === false) {
	$path = $path.'.php';
}

require 'core/contenu.php';
$file = fopen($path, 'w');
// var_dump($argv);
// recuperation du nom de la function tappé
$name = ucfirst(basename($path,'.php'));

$contenu = new Contenu();
$contenu->add('<?php')->add_sauts(2)
  ->add("class $name {")->add_sauts(2)
  ->addTab(1)->add('public function Votrefunction() {')->add_sauts(1)
  ->addTab(2)->add('return "Une phrase par exemple";')->add_sauts(1)
  ->addTab(6)->add('} ')->add_sauts(1)
  ->addTab(3)->add('}')->add_sauts(1)
  ->addTab(2)->add('// Ceci est un commentaire php')
  ->add_sauts(1)->add('?>');


$contenu->writeFile($file);
fclose($file);
chmod($path, 0777);