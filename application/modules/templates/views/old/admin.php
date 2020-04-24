<!DOCTYPE html>
<html>
    <head>
        
        <title>Admin</title>        
    
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="Graham Simmons">
        
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel='shortcut icon' type='image/x-icon' href='<?=base_url('assets/ico/favicon.ico')?>' />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css')?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap-select/css/bootstrap-select.min.css')?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap-table-master/bootstrap-table.css')?>" />
        <?php if(isset($css)):?>
            <?php foreach($css as $css):?>
            <link rel="stylesheet" type="text/css" href="<?=$css?>" />
            <?php endforeach;?>
        <?php endif?>
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/app.css')?>">
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/mmenu/css/jquery.mmenu.all.css')?>">
        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
        
        <!--[if lt IE 9]>
            <script src="<?=base_url('assets/bootstrap/js/html5shiv.js')?>"></script>
            <script src="<?=base_url('assets/bootstrap/js/respond.min.js')?>"></script>
        <![endif]-->

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url('assets/ico/favicon.png')?>">
        <link rel="shortcut icon" href="<?=base_url('assets/ico/favicon.ico')?>">
    
        <script type="text/javascript">
        var path = '<?=site_url();?>';
        var img_wait_small = '<img src="<?=site_url();?><?=$this->config->item("wait_small")?>">';
        var POA = '<?=$this->config->item("PriceOnApplication");?>';
        </script>
        
        <style>
            .fa {
                    margin: 0 10px 0 0px !important;
                    font-size: 16px !important;
                    width: 10px !important;
                }
        </style>
    </head>
    
    <body>
        
        <div id="wrap">
            
            <div class="header">
                <a class="menu" href="#menu"><span class="pull-left" style="margin-left:50px; color:#fff;">Menu</span></a>   
            </div> <!-- header -->

            <div class="content">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-sm-5 mt">                        
                            <a href="#menu" title="Open menu."><img id="logo" class="img-responsive" src="<?=$this->config->item("domainIMG").'logo_b.png';?>" alt="Offord &amp; Sons Logo"></a>
                        </div>

                        <div class="col-sm-7 mt">
                            <a class="btn btn-danger btn-sm pull-right mb" href="<?=base_url('auth/logout')?>" alt="Log out of admin."><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Logout</a>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 view">                        
                            <?php $this->load->view($view)?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <?php echo Modules::run('storage')?>
                        </div>
                    </div>
                    
                </div>
            </div> <!-- content -->
            
        </div> <!-- wrap -->

        
        <nav id="menu"><?=(isset($menu->content)?$menu->content:$menu)?></nav>     
        
        <script type="text/javascript" src="<?=base_url('assets/tinymce/tinymce.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/jquery.hammer.js')?>"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets/mmenu/js/jquery.mmenu.min.all.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap-select/js/bootstrap-select.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap-table-master/bootstrap-table.js')?>"></script>
        <?php if(isset($scripts)):?>
            <?php foreach($scripts as $script):?>
            <script type="text/javascript" src="<?=$script?>"></script>
            <?php endforeach;?>
        <?php endif?>
        <script type="text/javascript" src="<?=base_url('assets/js/admin.js')?>"></script>
        
    </body>
    
</html>
