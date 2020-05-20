<?php
session_start();
require('controller/frontEnd.php');

$ControllerFrontEnd = new ControllerfrontEnd();

if (isset($_GET['action'])) {
   
} 
else {
    $ControllerFrontEnd->Show_HomePage();
}