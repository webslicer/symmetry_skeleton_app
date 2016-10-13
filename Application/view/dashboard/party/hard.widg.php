<div id="hard-subview" class="draggable ui-widget-content">
  <p>Sub-view of hard.</p>
  <h2>Motto: <?php echo $this->motto; ?></h2>
  <div>I am going to count and my buddy "roll" will multiply by 3 but the math will be done server side.<br/>
  Observe the ajax call being done as it wraps multiple calls into one.</div>
  <div id="hard-count">0</div>
</div>
<?php $this->captureOn('js');?>
<script type="text/javascript">

setInterval(function(){
    var val = $('#hard-count').html();
    var pending = $('#hard-count').data('pending');
    if(pending !== true){
        $('#hard-count').data('pending',true);
        $.jsonBurst('/dashboard/party/add',{'number':val},function(data){
            $('#hard-count').html(data.number);
            $('#hard-count').data('pending',false);
            $(document).trigger('rollbaby',[data.number]);
        })
    }
}, 2000);
</script>
<?php $this->captureOff();?>