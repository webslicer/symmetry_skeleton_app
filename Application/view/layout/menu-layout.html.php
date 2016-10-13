<?php
$this->captureOn('css');
?>
<style type="text/css">    
    
    .top-banner .roles{
        text-align: center;
    }
    .top-banner a{
        margin-right: 10px;
    }
    
</style>
<?php
$this->captureOff();
?>
<div class="top-banner">
    Current Role: <?php echo $_SESSION['role']; ?> -- This top area uses &lt;a&gt; dom elements.
        <div class="roles">
        <a name="user" href="#">user</a><a name="manager" href="#">manager</a><a name="admin" href="#">admin</a> 
        </div>
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
    $('.top-banner a').on('click',function(){
        var currCat = $('.left-menu .selected').prop('href');
        var role = $(this).prop('name');
        window.location = '/layout/change-layout?role='+role+'&currCat='+currCat;
        return false;
    });
</script>
<?php
$this->captureOff();
?>