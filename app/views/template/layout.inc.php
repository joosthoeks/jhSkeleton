<!DOCTYPE html>

<html>
<head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title><?php echo $settings->getSiteName(); ?> :: <?php echo $this->getPageTitle(); ?></title>

<meta name="description" content="<?php echo $this->getPageDescription(); ?>" />
<meta name="keywords" content="<?php echo $this->getPageKeywords(); ?>" />
<meta name="robots" content="index, follow" />
<meta name="robots" content="all" />
<meta name="revisit-after" content="7 days" />

<link type="text/css" rel="stylesheet" href="./css/bootstrap.min.css" />
<!--
<link type="text/css" rel="stylesheet" href="./css/leaflet.css" />
<link type="text/css" rel="stylesheet" href="./css/c3.min.css" />
-->
<?php // get page specific css:
foreach ($this->getCssArr() as $css) : ?>
<link type="text/css" rel="stylesheet" href="./<?php echo $css; ?>.css" />
<?php endforeach; ?>
<link type="text/css" rel="stylesheet" href="./css/style.css" />
<link type="image/x-icon" rel="shortcut icon" href="./img/favicon.ico" />

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

</head>

<body>
<?php
require 'navigationView.php';
?>
    
    <div class="container">
        
        <div class="page-header">
            <h1><a href="./"><?php echo $settings->getSiteName(); ?></a></h1>
            <p class="lead"><?php echo $settings->getSiteDescription(); ?></p>
        </div>
        
    </div>
    
<?php
// get page views:
foreach ($this->getViewArr() as $view) {
    require $view.'View.php';
}
?>
    
    <div class="container">
        
        <div class="row">
            <div class="col-md-12">
                <h6>Made by: Joost Hoeks</h6>
            </div>
        </div>
    
    </div>
    
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/bootstrap.min.js"></script>
<!--
<script type="text/javascript" src="./js/d3.v3.min.js" charset="utf-8"></script>
<script type="text/javascript" src="./js/queue.v1.min.js" charset="utf-8"></script>
<script type="text/javascript" src="./js/topojson.v1.min.js" charset="utf-8"></script>
<script type="text/javascript" src="./js/leaflet.js"></script>
<script type="text/javascript" src="./js/c3.min.js"></script>
-->
<script type="text/javascript" src="./js/functions.js"></script>
<?php // get page specific js:
foreach ($this->getJsArr() as $js) : ?>
<script type="text/javascript" src="./<?php echo $js; ?>.js"></script>
<?php endforeach; ?>
<script type="text/javascript" src="./js/script.js"></script>

</body>
</html>

<?php echo '<!-- This page was generated in '.(microtime(TRUE) - $GLOBALS['pageStartTime']).' seconds. -->';
