<?php
$this->captureOn('css');
?>
<style type="text/css">
    a.selected {
        font-weight: bold;
    }
</style>
<?php
$this->captureOff();
?>
<ul>
<?php
foreach($categories as $link=>$cat){
    $current = false;
    if(is_array($cat)){
        $current = true;
        $cat = $cat['selected'];
    }
    echo('<a href="'.$this->basePath.'/'.$link.'"'.($current?' class="selected"':'').'>'.$cat.'</a><br/>'."\r\n");
}
?>

</ul>