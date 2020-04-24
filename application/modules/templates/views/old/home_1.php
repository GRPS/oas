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
        
        <link href="<?=base_url('assets/smint/css/demo.css')?>" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="<?=base_url('assets/smint/js/jquery.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/smint/js/jquery.smint.js')?>"></script>
        
        <script type="text/javascript">
	
            $(document).ready( function() {
                $('.subMenu').smint({
                    'scrollSpeed' : 1000
                });
            });

        </script>

    </head>
    
    <body>
        
        <div class="wrap">
            
            <div class="section sTop">
		<div class="inner">
			<img id="logo" class="img-responsive" src="http://www.offordandsons.co.uk/img/logo.jpg" alt="Offord &amp; Sons Logo">
		</div>
            </div>

            <div class="subMenu" >
                    <div class="inner">
                            <a href="#sTop" class="subNavBtn">Home</a>                            
                            <a href="#s1" class="subNavBtn">About Us</a> 
                            <a href="#s2" class="subNavBtn">Products</a> 
                            <a href="#s3" class="subNavBtn">Information</a>
                            <a href="#s4" class="subNavBtn">Contact Us</a>
                    </div>
            </div>

            <div class="section s1">
                    <div class="inner ">
                            <h1>About Us</h1>
                            
                            <p><a href="#s4" class="intLink">Want to contact us?</a></p>
                    </div>
            </div>

            <div class="section s2">
                    <div class="inner">
                            <h1>Products</h1>
                    </div>
            </div>



            <div class="section s3">
                    <div class="inner">
                            <h1>Information</h1>
                    </div>
            </div>

            <div class="section s4">
                    <div class="inner">
                            <h1>Contact Us</h1>
                            
                            <p><a href="#sTop" class="intLink">Back to Top</a></p>
                    </div>
            </div>
            
        </div> <!-- wrap -->
        
    </body>
    
</html>
