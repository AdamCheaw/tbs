<?php
session_start();
require ("connMysql.php");
?>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0" name="viewport">
		<title>TbS</title>
        <link rel="shortcut icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/demand-list-style.css" type="text/css" />
		<!--<link href="css/style.css" rel="stylesheet">-->
		<link id="noScriptCSS" rel="stylesheet" href="css/noscript.css">
		<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
		<script type="text/javascript"></script>
        <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
		<!--<link rel="stylesheet" type="text/css" href="tab/css/demo.css" />-->
		<link rel="stylesheet" type="text/css" href="tab/css/tabs.css" />
		<link rel="stylesheet" type="text/css" href="tab/css/tabstyles.css" />
  		<script src="tab/js/modernizr.custom.js"></script>
		<link rel="stylesheet" href="Web-Font/style.css"></head>
	</head>
	<div id="wrapper">
		<div id="headerTopicContainer"></div>
			<div id="header">
			<?php 
				if(!isset($_SESSION['user_id'])){
					require ("header.php");
            	}else{
					require ("header_login.php");
				}
            ?></div>
		<div class="tabs tabs-style-bar">
					<nav>
						<ul>
							<li><a href="#section-bar-1" class="icon icon-home"><span>Home</span></a></li>
							<li><a href="#section-bar-2" class="icon icon-box"><span>Archive</span></a></li>
							<li><a href="#section-bar-3" class="icon icon-display"><span>Analytics</span></a></li>
							<li><a href="#section-bar-4" class="icon icon-upload"><span>Upload</span></a></li>
							<li><a href="#section-bar-5" class="icon icon-tools"><span>Settings</span></a></li>
						</ul>
					</nav>
					<div class="content-wrap">
						<section id="section-bar-1"><p>1</p></section>
						<section id="section-bar-2"><p>2</p></section>
						<section id="section-bar-3"><p>3</p></section>
						<section id="section-bar-4"><p>4</p></section>
						<section id="section-bar-5"><p>5</p></section>
					</div><!-- /content -->
				</div><!-- /tabs -->
	</div>
	<div id="this_footer">
			<?php require ("footer.php")?>
    </div> 
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="js/script-scroll.js"></script>
    <!--<script src="http://libs.useso.com/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>-->
	<script type="text/javascript" src="js/jquery.toast.js"></script>
	<script src="tab/js/cbpFWTabs.js"></script>
		<script>
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
		</script>
	</body>
</html>