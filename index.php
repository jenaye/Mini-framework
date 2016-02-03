 <?php
 	$pages = scandir('pages/');
 	if(isset($_GET['page']) && !empty($_GET['page'])){
 	  if(in_array($_GET['page'].'.php',$pages)){
 		   	$page = $_GET['page'];
       	}else{
          $page = "erreur";

   }
 }
  else{

    $page = "home";
  }

  $pages_functions = scandir('functions/');
  if(in_array($page.'.func.php',$pages_functions)) {

    include 'functions/'.$page.'.func.php';
  }
 ?>



 <!DOCTYPE html>
  <html>
    <head>
      <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
        <link rel="stylesheet" href="css/side-menu.css">
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
        <link rel="stylesheet" href="css/side-menu-old-ie.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta charset="UTF-8">
    <?php include 'core/navbar.php';?>
    </head>

    <body>      
    		<?php
        include 'pages/'.$page.'.php';
        ?> 
    </body>
  </html>

