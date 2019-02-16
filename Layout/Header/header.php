<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inchoo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Here is a precise description of my awesome webpage.">
</head>
<body>

<!-- Inc -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

<!-- Style.Inc -->


<!-- Header -->
<?php
if(!isset($_COOKIE['login'])) { require "header.out.php"; }
else { require "header.in.php"; }

// Header Style
require "header_style.php";
?>
