<?php if(!isset($slider_html)): ?>
<?php if($page->h1 == ""): ?>
<ol class="breadcrumb mt">
    <li><h1 style="font-size:100%; margin-top:10px;"><?=$title;?></h1></li>
</ol>
<?php else: ?>
<hr>
<h1 class="h2"><?=$page->h1;?></h1>
<h2 style="font-size:120%; margin-top:10px;"><i><?=$page->h2?></i></h2>
<hr>
<?php endif;?>
<?php endif;?>

<?php if($title=="xHome"?$this->load->view("slide"):"")?>

<?=strip_slashes($page->content);?>