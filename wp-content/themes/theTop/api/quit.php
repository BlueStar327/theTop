<?php
/*
Template Name: quit
*/

session_start();
// remove all session variables

session_unset();

// destroy teh session
session_destroy();
echo "Close your account.";
?>