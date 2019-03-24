<?php

$conn = new PDO("mysql:host=localhost;dbname=twilio_api",'root','');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>