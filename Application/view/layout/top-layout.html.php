<?php 
use Application\Bootstrap as App,
    Application\Helpers\View;

?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie10 lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie10 lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> 
<html class="no-js" lang="en"> <!--<![endif]-->
    <?php
    
    echo($this->includeView('layout/common-head.html.php',['title'=>$this->title]));
    ?>
    
    <body>
        <?php 
            echo $this->content;
            echo($this->includeView('layout/common-footer',['lvl'=>0]));
            echo $this->getCapture('js');
        ?>
        
    </body>
</html>