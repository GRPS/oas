<div id="header" class="container-fluid" style="color:#8a8a8a; background-color:#ffffff; border-bottom:1px solid #c4c4c4;">
    <div class="container">
    <div class="row" style="padding: 10px 0px;">
        <div class="col-xs-12">
            <a href="<?=base_url();?>" title="Goto home page"><img src=<?=$this->config->item("domainIMG")."logo_b.png"?> style="height:60px;"/></a>
            <h5 class="hidden-xs" style="position:absolute; right:0px; top:15px;">
                <span class="home_show"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:01962867772" style="color:rgb(138, 138, 138); text-decoration:none;" title="Click to call us">01962 867772</a></span>
                <span style="margin-left:30px;"><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:shop@offordandsons.co.uk" style="color:rgb(138, 138, 138); text-decoration:none;" title="Click to email us">shop@offordandsons.co.uk</a></span>
                <span class="shopping_cart_show finger" style="margin-left:30px;" title="Goto shopping cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="shopping_cart"><?=$cart_badge->cnt?></span></span>
                <span id="showSearchModel" class="finger" style="margin-left:30px; margin-right:20px;" data-toggle="modal" data-target="#searchModal" title="Search"><i class="fa fa-search" aria-hidden="true"></i></span>                
                
            </h5>
            <i class="finger visible-xs fa fa-search fa-2x" style="position:absolute; right:20px; top:15px;" aria-hidden="true" data-toggle="modal" data-target="#searchModal"></i>
        </div>
    </div>
    </div>
</div>
<?php $this->load->view('shared/social2'); ?>
<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <input tpe="text" class="form-control" placeholder="Enter search term" id="searchItem" autofocus>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary pull-right" onclick="doSearch();">Search</button>
      </div>
    </div>
  </div>
</div>

