<?php
$this->captureOn('css');
?>
<style type="text/css">
    .crumb-bar {
        background-color: #ff6666;
    }
    .crumb-wrap{
        border: 1px solid gray;
    }
</style>
<?php
$this->captureOff();
?>

<div class="crumb-bar">This area comes from the initial controller/function defining a different controller parent to attach to.</div>
<div class="crumb-wrap">
<?php

echo $this->content;

?>
</div>