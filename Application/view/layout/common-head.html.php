<?php

?>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $this->title; ?></title>
        <meta name="description" content="">

        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="/css/main.css">
        <?php 
            echo $this->css;
            echo $this->getCapture('css');
        ?>
        <!--[if lt IE 9]>
          <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <![endif]-->
        <!--[if gte IE 9]><!-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <!--<![endif]-->
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
        <script src="<?php echo $this->basePath; ?>/js/modernizr-custom.js"></script>
        <script src="<?php echo $this->basePath; ?>/js/jsonburst.js"></script>
        <script type="text/javascript">
            $.jsonBurst.options({url:'/dashboard/ajax-burst'});
        </script>
    </head>