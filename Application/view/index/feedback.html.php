<style type="text/css">
.error-container {
    border:1px solid #55FF55;
    margin:10px;
    padding:10px;
}
</style>
<div class="error-container">
Feedback:<br/>
<?php
    echo($this->msg);
?>

</div>
<br/>
Notice how there is no menu highlighted as this is a Controller not detected to show as a selectable category.<br/>
You can however call this directly. /index/feedback?msg=Hello