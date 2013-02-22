<?php

function print_header( $embed = false ) {
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>IsValid | Quantify the results of A/B tests</title>

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Styles -->
		<link href="static/<?= $embed ? 'embed' : 'styles' ?>.css" rel="stylesheet">

		<!-- Scripts -->
		<script src="static/scripts.min.js"></script>

		<!-- Fonts -->
		<script type="text/javascript" src="//use.typekit.net/ivm8epx.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	</head>
<?php
}
