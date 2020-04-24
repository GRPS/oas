<!DOCTYPE html>
<html>
    <head>
        
        <title><?=$meta['title']?></title>        
    
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <meta name="description" content="<?=$meta['description']?>">
        <meta name="keywords" content="<?=$meta['keywords']?>">
        <meta name="author" content="Graham Simmons">
        
        <link href="<?=base_url('assets/onepage/demo.css')?>" rel="stylesheet" type="text/css">
        
        <script type="text/javascript">
	


        </script>
        
        <style>
		.section-wrapper {
			margin-top: -50px;
			padding-top: 50px;
		}

		.section-wrapper:first-child .section {
			padding-top: 100px;
		}

		#nav {
			background: #00009C;
			left: 0;
			list-style: none;
			overflow: hidden;
			padding-top: 9px;
			position: fixed;
			right: 0;
			text-align: center;
			top: 0;
		}
		#nav li {
			display: inline-block;
			margin-bottom: 0;
		}
		#nav a {
			background: #00009C;
			color: #fff;
			display: block;
			padding: 10px;
		}
		#nav a:hover {
			background: none;
			color: #dedede;
		}
		#nav .current a {
			background: #fff;
			color: #000;
		}
	</style>

    </head>
    
    <body>

        <ul id="nav">
		<li class="current"><a href="#section-1">Home</a></li>
		<li><a href="#section-2">Products</a></li>
                <li><a href="#section-3">Services</a></li>
		<li><a href="#section-4">Contact Us</a></li>
	</ul>

	<div id="container">
		<div class="section-wrapper" id="section-1">
			<div class="section">
				<h1>Horizontal Nav</h1>
				<p>To account for the offset of the horizontal nav, add top negative margin and top padding. For example, the navigation on this page is 50px tall. So to each section, add a -50px top margin and 50px to offset the height of the nav. That means when you go to each section, it will scroll to the exact top of the section while accounting for the height of the nav.</p>
			</div>
		</div>

		<div class="section-wrapper" id="section-2">
			<div class="section">
				<h2>Products</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
		</div>

		<div class="section-wrapper" id="section-3">
			<div class="section">
				<h2>Services</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
		</div>
            
                <div class="section-wrapper" id="section-4">
			<div class="section">
				<h2>Contact Us</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
		</div>
            
	</div>

	<!--[if lte IE 8]><script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><![endif]-->
	<!--[if gt IE 8]><!--><script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script><!--<![endif]-->
        
	<script>
		$(document).ready(function() {
			$('#nav').onePageNav();
		});
	</script>
        
        <script type="text/javascript" src="<?=base_url('assets/onepage/jquery.nav.js')?>"></script>
        
    </body>
    
</html>
