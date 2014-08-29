<!DOCTYPE html>

<html>
<head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title><?php echo $siteName; ?> :: <?php echo $pageTitle; ?></title>

<meta name="description" content="<?php echo $pageDescription; ?>" />
<meta name="keywords" content="<?php echo $pageKeywords; ?>" />
<meta name="robots" content="index, follow" />
<meta name="robots" content="all" />
<meta name="revisit-after" content="7 days" />

<link type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="./css/style.css" />
<link type="image/x-icon" rel="shortcut icon" href="./img/favicon.ico" />

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

</head>

<body>

    <div class="container">
        
        <div class="page-header">
            <h1><a href="./"><?php echo $siteName; ?></a></h1>
            <p class="lead"><?php echo $siteDescription; ?></p>
        </div>
        
<?php
// get page views:
foreach ($requireViewArr as $view) {
    require $appPath.'views/'.$view.'View.php';
}
?>
        
        
        <div class="row">
            <div class="col-md-12">
                <h6>Made by: Joost Hoeks</h6>
            </div>
        </div>
    
    </div>
    
<script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/jhAjax.js"></script>
<script type="text/javascript" src="./js/script.js"></script>

</body>
</html>

<?php echo '<!-- This page was generated in '.(microtime(TRUE) - $pageStartTime).' seconds. -->';
