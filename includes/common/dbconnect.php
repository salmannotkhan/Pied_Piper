<?php
	$user = "root";
	$pass = "";
	$host = "localhost";
	$db = "piedpiper";
	$conn = new mysqli($host,$user,$pass,$db);
	session_start();