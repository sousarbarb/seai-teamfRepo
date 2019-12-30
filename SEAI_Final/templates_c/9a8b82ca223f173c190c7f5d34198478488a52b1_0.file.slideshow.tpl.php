<?php
/* Smarty version 3.1.33, created on 2019-12-30 10:32:16
  from '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/initial/slideshow.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e09d230b89002_81349696',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a8b82ca223f173c190c7f5d34198478488a52b1' => 
    array (
      0 => '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/initial/slideshow.tpl',
      1 => 1576088465,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e09d230b89002_81349696 (Smarty_Internal_Template $_smarty_tpl) {
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
