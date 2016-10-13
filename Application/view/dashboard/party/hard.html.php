full view of hard.
<h1>Motto: <?php echo $this->motto; ?></h1>
<ul>
    <?php
    if(!empty($fib)){
        foreach($fib as $number){
            echo('<li>'.$number.'</li>');
        }
    }
    ?>
</ul>

<div>
    This view has the same motto data as the subview, but as a full page also has additional data to display returned from the controller.<br/>
    This way you can present a summarized view and a detailed view of the same result set from the same controller function.
</div>