    <div class="mt" id="prefooter">     
        <div class="container">
            <div class="row">
                
                <div class="visible-xs hidden-md col-xs-12">
                    <h3 class="footer_header pb">Menu</h3>
                    <p><a class="menu" href="#menu">Open here or from the top menu option or logo.</a></p>
                </div>
                
                <div class="col-xs-12 col-md-6">
                    <h3 class="footer_header pb">Special offers</h3>
                    <?php foreach($specialoffers as $so): ?>
                    <div class="row specialoffers pt">
                        <div class="col-xs-3 col-md-2">
                            <img class="img-circle" src="<?=$this->config->item("domainIMG").$so->image;?>" alt="<?=$this->config->item("domainIMG").$so->image;?>">
                        </div>
                        <div class="col-xs-9 col-md-10">
                            <p><?=$so->content; ?></p>
                            <p><a href="<?=site_url("/".$so->url)?>">more ...</a></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="col-xs-12 col-md-4 col-md-offset-2">
                    <div>
                        <h3 class="footer_header pb">How to find us</h3>
                        <p class="footer_subheader">Winchester Branch</p>
                        <p>86 High Street<br>Winchester<br>Hampshire<br>SO23 9AP<br>
                        Tel: <a href="tel:01962867772">(01962) 867772<span class="fingerl visible-phone"><i class="icon-hand-left icon-white"></i></span></a><br>
                        </p>
                    </div>
            
                    <p class="footer_subheader">Romsey Branch</p>
                    <div>
                        3 Church Street<br>Romsey<br>Hampshire<br>SO51 8BT<br>
                        Tel: <a href="tel:01794512247">(01794) 512247<span class="fingerl visible-phone"><i class="icon-hand-left icon-white"></i></span></a><br>
                    </div>
            
                    <div class="mb">
                        <h3 class="footer_header">We are mobile</h3>
                        <p><small style="font-style:italic;">Scan this QR code to easily open this website on your mobile device.</small></p>
                        <img src="<?=site_url("/assets/img/qrcodeOASblue.png")?>" alt="Website QR Code">
                    </div>  
                </div>
                
            </div>
        </div>
    </div>
    
    <footer id="footer">
        <div class="container">
            <div class="col-sm-4 text-center pt pb">
                <a href="<?=site_url('terms-and-conditions')?>" title="See our terms and conditions.">Terms and Conditions</a>
            </div>
            <div class="col-sm-4 text-center pt pb">
                <a href="<?=site_url('terms-of-sale')?>" title="See our terms of sale.">Terms of Sale</a>
            </div>
            <div class="col-sm-4 text-center pt pb">
                <a href="<?=site_url('linked-sites')?>" title="Read about our linked sites.">Linked Sites</a>
            </div>
            <div class="col-md-12 text-center pt pb">
                <p>Copyright &copy; 2015 Offord & Sons All rights reserved.</p>
                <p>Designed and created by Graham Simmons 2015.</p>
            </div>
        </div>
    </footer>

<!--    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-8345026-2']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>-->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-8345026-2', 'auto');
  ga('send', 'pageview');

</script>