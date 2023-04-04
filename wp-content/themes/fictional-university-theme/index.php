<?php
    $names = array('Brad','John','Jane',"Meowsalot");

    $counting = 0;

    while($counting < count($names)) {
        echo "<li>Hi, my name is $names[$counting].</li>";
        $counting++;
    }

    $count = 1;

    while($count <101) {
        echo "<li>$count</li>";
        $count++;
    }
?>

<p>Hi, my name is <?php echo $names[3]?>.</p>