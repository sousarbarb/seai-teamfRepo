<?php
/* Smarty version 3.1.33, created on 2019-12-18 00:13:57
  from 'C:\xampp\htdocs\seai-teamfRepo\SEAI_WebPages\templates\common\slideshow.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5df9613550c8b1_65900767',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b8a3d0da5c357626789a4ebf8afa88f1686d5285' => 
    array (
      0 => 'C:\\xampp\\htdocs\\seai-teamfRepo\\SEAI_WebPages\\templates\\common\\slideshow.tpl',
      1 => 1576088465,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5df9613550c8b1_65900767 (Smarty_Internal_Template $_smarty_tpl) {
?><!                               SLIDE-SHOW                                    >
    <div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/slideshow/auv2.jpg" class="d-block w-100" >
        <div class="carousel-caption d-none d-md-block">
          <h5>First slide label</h5>
          <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/slideshow/auv3.jpg" class="d-block w-100">
        <div class="carousel-caption d-none d-md-block">
          <h5>Second slide label</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/slideshow/networked_systems.png" class="d-block w-100" >
        <div class="carousel-caption d-none d-md-block">
          <h5>Third slide label</h5>
          <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<?php }
}
