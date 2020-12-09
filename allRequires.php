<?php 
require_once ("header.php");
require_once ('CreateDb.php');
require_once ('productTemplate.php');
require_once('getStarted.php');

//function to clean spaces
function cleanInput($data){
    return trim($data);
}
?>