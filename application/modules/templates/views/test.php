<!DOCTYPE html>
<html>
    <head>

        <title>Offord &amp; Sons - Independent Jewellers in Hampshire</title>

               <link rel='stylesheet' type='text/css' media="all" href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900'>
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap/css/bootstrap.min.css')?>" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/bootstrap-select/css/bootstrap-select.min.css')?>" />
        <link rel="stylesheet" type="text/css" media="all" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?=base_url('assets/css/app.css')?>">

        <?php if(isset($css)):?>
            <?php foreach($css as $css):?>
            <link rel="stylesheet" type="text/css" href="<?=$css?>" />
            <?php endforeach;?>
        <?php endif?>

        <!--[if lt IE 9]>
            <script src="<?=base_url('assets/bootstrap/js/html5shiv.js')?>"></script>
            <script src="<?=base_url('assets/bootstrap/js/respond.min.js')?>"></script>
        <![endif]-->

        <!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
        <script type="text/javascript">
            var path = '<?=site_url();?>';
            window.cookieconsent_options = {"message":"This website uses cookies to ensure you get the best experience on our website","dismiss":"Got it!","learnMore":"More info","link":null,"theme":"dark-floating"};
        </script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
        <!-- End Cookie Consent plugin -->
   
    </head>

    <body style="background-color: #f5f5f5;">

   
        <?php $this->load->view('shared/header'); ?>


        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/jquery.hammer.js')?>"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/bootstrap-select/js/bootstrap-select.min.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('assets/js/app.js')?>"></script>
        <?php if(isset($scripts)):?>
            <?php foreach($scripts as $script):?>
            <script type="text/javascript" src="<?=$script?>"></script>
            <?php endforeach;?>
        <?php endif?>

    </body>

</html>
