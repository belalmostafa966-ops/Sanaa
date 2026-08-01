<?php
$lines = file("resources/views/home.php");
foreach($lines as $i => $line) {
    if(strpos($line, "?????") !== false || strpos($line, "??????") !== false || strpos($line, "?????") !== false) {
        echo ($i+1) . ": " . trim(substr($line, 0, 200)) . PHP_EOL;
    }
}
?>
