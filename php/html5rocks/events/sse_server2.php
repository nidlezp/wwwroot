<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache'); // recommended to prevent caching of event data.

echo "data: {""msg"": ""First message""}\n\n";
echo "event: userlogon\n";
echo "data: {""username"": ""John123""}\n\n";
echo "event: update\n";
echo "data: {""username"": ""John123"", ""emotion"": ""happy""}\n\n";

ob_flush();
flush();
?>