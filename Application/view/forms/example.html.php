<?php $this->captureOn('css');?>
<style type="text/css">
    form div.errMsg {
        color: #bd362f;
    }
</style>
<?php $this->captureOff();?>

<form method="post">
    <div>This is a self sustaining form</div>
    Name: <input type="text" value="<?php echo $this->name;?>" name="name" />
    <div class="errMsg"><?php echo $this->errMsg['name'];?></div>
    <br/>
    Address: <input type="text" value="<?php echo $this->address;?>" name="address" />
    <div class="errMsg"><?php echo $this->errMsg['address'];?></div>
    <br/>
    State: <input type="text" value="<?php echo $this->state;?>" name="state" />
    <div class="errMsg"><?php echo $this->errMsg['state'];?></div>
    <br/>
    Some random field: <input type="text" value="" name="fxParam" />
    <br/>
    <input type="submit" value="Go" />
</form>