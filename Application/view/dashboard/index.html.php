<?php $this->captureOn('css');?>
<style type="text/css">
 .draggable { width: 200px; height: 250px; padding: 5px; float: left; margin: 0 10px 10px 0; font-size: .9em; }
.ui-widget-header p, .ui-widget-content p { margin: 0; }
.draggable a {
    text-decoration:underline;
    color:blue;
}
#roll-count, #hard-count {
    background-color: yellow;
}
</style>
<?php $this->captureOff();?>
Load sub-views...<br/>

<?php
if($this->subviews){
    foreach($this->subviews as $view){
        echo $view;
    }
}

$this->captureOn('js');
?>
<script type="text/javascript">
$(function(){
	$( ".draggable" ).draggable({ snap: true });
	$( ".draggable" ).on( "dragstop", function( event, ui ) {
	    var coord = {};
		$('.draggable').each(function(){
		    coord[$(this).attr('id')] = {left:$(this).css('left'),top:$(this).css('top')};
		});
		sessionStorage.coord = JSON.stringify(coord);
	} );
	if(sessionStorage.coord == undefined){
		var coord = {};
		$('.draggable').each(function(){
		    coord[$(this).attr('id')] = {left:$(this).css('left'),top:$(this).css('top')};
		});
		sessionStorage.coord = JSON.stringify(coord);
	} else {
	    var initCoord = JSON.parse(sessionStorage.coord);
	    $('.draggable').each(function(){
		    if(initCoord[$(this).attr('id')] != undefined){
		    	$(this).css('left',initCoord[$(this).attr('id')].left);
		    	$(this).css('top',initCoord[$(this).attr('id')].top);
		    }
		});
	}
    
});
</script>
<?php 
$this->captureOff();?>