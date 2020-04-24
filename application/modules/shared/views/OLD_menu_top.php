        <div class="visible-xs" style="position:absolute; top:0px; width:100%; padding-top:10px; z-index:100; color:#fff; height:50px; background-color:#7DA2B0; color:#ffffff;">
            <i class="fa fa-home fa-2x home_show" aria-hidden="true" style="margin-left:20px;"></i>
            <a class="mlink" href="tel:01962867772"><i class="fa fa-phone fa-2x" aria-hidden="true" style="margin-left:40px;"></i></a>
            <a class="mlink" href="mailto:shop@offordandsons.co.uk"><i class="fa fa-envelope fa-2x" aria-hidden="true" style="margin-left:40px;"></i></a>
            <i class="fa fa-shopping-cart fa-2x shopping_cart_show finger" aria-hidden="true" style="margin-left:40px;" title="Goto shopping cart"><span class="shopping_cart label label-default" style="position:absolute; font-size:55%; border-radius: 1em;"><?=$cart_badge->cnt?></span></span></i>
            <i class="finger fa fa-bars fa-2x pull-right" aria-hidden="true" style="margin-right:20px;" onclick="modalPlay2('show');"></i>
        </div>

<div id="modeltop2" style="display:none; position:fixed; overflow:hidden; right:0; left:0; top:0; bottom:0; background-color: #ffffff; z-index:1000;">
    <div onclick="modalPlay2('hide');" style="background-color: #7DA2B0; color:#ffffff; font-weight: bold; font-size:150%; text-align:center; position:absolute; top:0px; width:100%; line-height:60px; height:60px; border-bottom:1px solid #c4c4c4;">
        Menu
        <span style="top:20px; right:20px;" class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span>
    </div>
    <div id="modelmiddle2" style="margin-top:60px; overflow:auto; background-color: #ffffff;">
        <ul id="modalMenu">
            <li><a href="<?=base_url()?>">Home</a></li>
            <li><a href="<?=base_url('about-us')?>">About Us</a></li>
            <li style="padding:10px; text-indent:20px; ">Shop</li>
                <ul class="sub">
                    <li><a href="<?=base_url('product/bangles')?>">Bangles</a></li>
                    <li><a href="<?=base_url('product/bracelets')?>">Bracelets</a></li>
                    <li><a href="<?=base_url('product/brooches')?>">Brooches</a></li>
                    <li><a href="<?=base_url('product/cufflinks')?>">Cufflinks</a></li>
                    <li><a href="<?=base_url('product/earrings')?>">Earrings</a></li>
                    <li><a href="<?=base_url('product/giftware')?>">Giftware</a></li>
                    <li><a href="<?=base_url('product/necklaces')?>">Necklaces</a></li>
                    <li><a href="<?=base_url('product/nicole barr')?>">Nicole Barr</a></li>
                    <li><a href="<?=base_url('product/pendants')?>">Pendants</a></li>
                    <!--<li><a href="<?=base_url('product/pewter')?>">Pewter</a></li>-->
                    <li><a href="<?=base_url('product/rings')?>">Rings</a></li>
                    <li><a href="<?=base_url('product/saturno')?>">Saturno</a></li>
                    <li><a href="<?=base_url('product/silvants')?>">Silvants</a></li>
                    <li><a href="<?=base_url('product/silver')?>">Silver</a></li>
                    <li><a href="<?=base_url('product/special-offers')?>">Special Offers</a></li>
                    <li><a href="<?=base_url('product/watches')?>">Watches</a></li>
                    <li><a target="_new" href="https://issuu.com/gecko_marketing/docs/gekc096_fg01_web_lo">Fiorelli Gold</a></li>
                    <li><a target="_new" href="https://issuu.com/gecko_marketing/docs/gekc082_f17_web?e=4882196/15167429">Fiorelli Jewellery</a></li>
                    <!--<li><a href="#">Nicole Barr</a></li>-->
                    <li><a target="_new" href="http://www.michelherbelin.co.uk/AFF48">Michel Herbelin</a></li>
                </ul>
            <li style="padding:10px; text-indent:20px; ">Bespoke Jewellery</li>
                <ul class="sub">
                    <li><a href="<?=base_url('bespoke-jewellery/design')?>">Design</a></li>
                    <li><a href="<?=base_url('bespoke-jewellery/gallery')?>">Gallery</a></li>
                    <li><a href="<?=base_url('bespoke-jewellery/testimonials')?>">Testimonials</a></li>
                </ul>
            <li><a href="<?=base_url('product/rings/engagement')?>">Engagement Rings</a></li>
            <li><a href="<?=base_url('product/rings/wedding')?>">Wedding Rings</a></li>
            <li style="padding:10px; text-indent:20px; ">Services</li>
                <ul class="sub">
                    <li><a href="<?=base_url('old-gold')?>">Sell your old gold</a></li>
                    <li><a href="<?=base_url('repairs-and-restorations')?>">Repairs and Restorations</a></li>
                    <li><a href="<?=base_url('jewellery-refurbishment')?>">Jewellery refurbishment</a></li>
                    <li><a href="<?=base_url('services')?>">Jewellery servicing</a></li>
                    <li><a href="<?=base_url('valuations')?>">Valuations</a></li>
                </ul>              
            <li style="padding:10px; text-indent:20px; ">Info</li>
                <ul class="sub">
                    <li><a href="<?=base_url('jewellery-insurance')?>">Jewellery Insurance</a></li>
                    <li><a href="<?=base_url('anniversaries')?>">Anniversaries</a></li>
                    <li><a href="<?=base_url('birthstones')?>">Birthstones</a></li>
                    <li><a href="<?=base_url('zodiac-stones')?>">Zodiac Stones</a></li>
                    <li><a href="<?=base_url('diamonds')?>">Diamonds</a></li>
                    <li><a href="<?=base_url('pearls')?>">Pearls</a></li>
                </ul> 
           
            <!--<li><a href="<?=base_url('blog')?>">Blog</a></li>-->
            <li><a href="<?=base_url('contact-us')?>">Contact Us</a></li>
        </ul>       
    </div>
</div>

        <nav class="hidden-xs navbar navbar-default mbn" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
    	    <span class="sr-only">Toggle navigation</span>
    	    <span class="icon-bar"></span>
    	    <span class="icon-bar"></span>
    	    <span class="icon-bar"></span>
            </button>
        </div>
        <!--/.navbar-header-->

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="<?=base_url()?>">Home</a></li>
                <li><a href="<?=base_url('about-us')?>">About Us</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Shop <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu multi-column columns-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li><a href="<?=base_url('product/bangles')?>">Bangles</a></li>
                                    <li><a href="<?=base_url('product/bracelets')?>">Bracelets</a></li>
                                    <li><a href="<?=base_url('product/brooches')?>">Brooches</a></li>
                                    <li><a href="<?=base_url('product/cufflinks')?>">Cufflinks</a></li>
                                    <li><a href="<?=base_url('product/earrings')?>">Earrings</a></li>
                                    <li><a href="<?=base_url('product/giftware')?>">Giftware</a></li>
                                    <li><a href="<?=base_url('product/necklaces')?>">Necklaces</a></li>
                                    <li><a href="<?=base_url('product/nicole barr')?>">Nicole Barr</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li><a href="<?=base_url('product/pendants')?>">Pendants</a></li>
                                    <!--<li><a href="<?=base_url('product/pewter')?>">Pewter</a></li>-->
                                    <li><a href="<?=base_url('product/rings')?>">Rings</a></li>
                                    <li><a href="<?=base_url('product/saturno')?>">Saturno</a></li>
                                    <li><a href="<?=base_url('product/Silver')?>">Silver</a></li>
                                    <li><a href="<?=base_url('product/special-offers')?>">Special Offers</a></li>
                                    <li><a href="<?=base_url('product/watches')?>">Watches</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="multi-column-dropdown">
                                    <li><a target="_new" href="https://issuu.com/gecko_marketing/docs/gekc096_fg01_web_lo">Fiorelli Gold</a></li>
                                    <li><a target="_new" href="https://issuu.com/gecko_marketing/docs/gekc082_f17_web?e=4882196/15167429">Fiorelli Jewellery</a></li>
                                    <li><a target="_new" href="http://www.michelherbelin.co.uk/AFF48">Michel Herbelin</a></li>
                                    <!--<li><a href="#">Nicole Barr</a></li>-->
                                </ul>
                            </div>
                        </div>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="<?=base_url('bespoke-jewellery/design')?>" class="dropdown-toggle" data-toggle="dropdown">Bespoke Jewellery <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url('bespoke-jewellery/design')?>">Design</a></li>
                        <li><a href="<?=base_url('bespoke-jewellery/gallery')?>">Gallery</a></li>
                        <li><a href="<?=base_url('bespoke-jewellery/testimonials')?>">Testimonials</a></li>
                    </ul>
                </li>
                <li><a href="<?=base_url('product/rings/engagement')?>">Engagement Rings</a></li>
                <li><a href="<?=base_url('product/rings/wedding')?>">Wedding Rings</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Services <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url('old-gold')?>">Sell your old gold</a></li>
                        <li><a href="<?=base_url('repairs-and-restorations')?>">Repairs and Restorations</a></li>
                        <li><a href="<?=base_url('jewellery-refurbishment')?>">Jewellery refurbishment</a></li>
                        <li><a href="<?=base_url('services')?>">Jewellery servicing</a></li>
                        <li><a href="<?=base_url('valuations')?>">Valuations</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Info <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url('jewellery-insurance')?>">Jewellery Insurance</a></li>
                        <li><a href="<?=base_url('anniversaries')?>">Anniversaries</a></li>
                        <li><a href="<?=base_url('birthstones')?>">Birthstones</a></li>
                        <li><a href="<?=base_url('zodiac-stones')?>">Zodiac Stones</a></li>
                        <li><a href="<?=base_url('diamonds')?>">Diamonds</a></li>
                        <li><a href="<?=base_url('pearls')?>">Pearls</a></li>
                    </ul>
                </li>
                <!--<li><a href="<?=base_url('blog')?>">Blog</a></li>-->
                <li><a href="<?=base_url('contact-us')?>">Contact Us</a></li>
            </ul>
        </div>
        <!--/.navbar-collapse-->
    </nav>

<script>

    function modalPlay2(s) {
        if(s == "hide") {
            $('#modeltop2').hide();
            $('body').css("overflow", "auto");
        } else {
            $('#modeltop2').show();
            $('body').css("overflow", "hidden");
        }
    }
</script>