<?php
$content = file_get_contents("resources/views/home.php");
if (strpos($content, "????? ????") !== false) echo "Login button found.\n";
if (strpos($content, "30 ???") !== false) echo "30 days found.\n";
if (strpos($content, "data-target=\"30\"") !== false) echo "Data target 30 found.\n";
if (strpos($content, "???? ????????") !== false) echo "Professional service found.\n";
if (strpos($content, "id=\"join\"") === false) echo "Join section correctly removed.\n";
?>
