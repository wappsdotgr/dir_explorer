<?php
# Get + Store Data
$cont = $_POST['content'];
$file = $_POST['file'];
# Debug
echo '<pre>';
echo $cont;
echo '</pre>';
# Save
file_put_contents('dirs/'.$file, $cont);
# Return
header("Location: index.php");
die();
?>