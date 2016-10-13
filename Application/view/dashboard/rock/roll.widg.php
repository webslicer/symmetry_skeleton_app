<div id="roll-subview" class="draggable ui-widget-content">
  <p>Sub-view of roll.</p>
  <h2>Motto: <?php echo $this->motto; ?></h2>
  <div>I am going to listen to the changes that "hard" does and then update my number accordingly.<br>
  Observe my ajax request being pushed in the same request as hard's.</div>
  <div id="roll-count">0</div>
</div>
<?php $this->captureOn('js');?>
<script type="text/javascript">

$(function(){
   $(document).on('rollbaby',function(e, number){
       $.jsonBurst('/dashboard/rock/multiply',
            {'number':number},
            function(data){
               $('#roll-count').html(data.number);
           }
        );
   });
});
</script>
<?php $this->captureOff();?>