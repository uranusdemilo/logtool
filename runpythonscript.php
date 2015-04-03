<h1>Test Page</h1><BR>

<?php
$ipaddr = '22.33.44.55';
$command = escapeshellcmd('python web.py' . $ipaddr);
$output = shell_exec($command);

?>

