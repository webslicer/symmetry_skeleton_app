<?php
$this->captureOn('css');
?>
<style type="text/css">
    .top-banner {
        background-color: #ff6666;
    }
    .top-banner form{
        text-align: center;
    }
</style>
<?php
$this->captureOff();
?>
<div class="top-banner">
    Current Role: <?php echo $_SESSION['role']; ?> -- This top area uses an alternative view with form dom elements and buttons.
    <form method="post" action="/layout/change-layout">
        <input type="button" value="user" /><input type="button" value="manager" /><input type="button" value="admin" />
        <input type="hidden" name="currCat" /><input type="hidden" name="role" />
    </form>
    </div>
    <div class="left-menu">
    <?php echo $this->leftMenu; ?>
    
    </div>
    <div class="main-content">
    <?php
        echo $this->content;
    ?>
        
    </div><!-- end main-content -->
<?php
$this->captureOn('js');
?>
<script type="text/javascript">
    $('.top-banner form').on('click','input:button',function(){
        var currCat = $('.left-menu .selected').prop('href');
        $('.top-banner form [name=currCat]').prop('value',currCat);
        $('.top-banner form [name=role]').prop('value',$(this).val());
        $(this).parent('form').submit();
    });
</script>
<?php
$this->captureOff();
?>