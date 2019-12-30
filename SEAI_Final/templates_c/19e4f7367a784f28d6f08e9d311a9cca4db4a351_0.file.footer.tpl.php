<?php
/* Smarty version 3.1.33, created on 2019-12-30 10:32:16
  from '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/common/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e09d230bb3347_04405261',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19e4f7367a784f28d6f08e9d311a9cca4db4a351' => 
    array (
      0 => '/usr/users2/2015/up201503070/public_html/SEAI_Final/templates/common/footer.tpl',
      1 => 1576088465,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e09d230bb3347_04405261 (Smarty_Internal_Template $_smarty_tpl) {
?><!--                             FOOTER                                  -->

<footer>
  <div class="rodapes">
    <p></p>
    <p>Universidade do Porto - Faculdade de Engenharia<br>
       Dep. de Eng. Electrotécnica e de Computadores<br>
       Rua Dr. Roberto Frias s/n, sala I203/4<br>
       4200-465 Porto, Portugal<br>
       <p></p>
        Phone +351 22 508 1539<br>
        Fax   +351 22 508 1443<br>
        Voip  +351 22 041 3211 / 3223<br>
        Email  lsts@fe.up.pt</p>

  </div>
  <nav id="rodape">
    <ul>
      <li><div class="input-div">
        <img src = "<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/logo/lsts.png" width=70px height=70px class = "info" >
    <div class="popup-box">Hello! i am a small popup</div>
</div></li>

      <!--<li><img src = "<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/logo/feup.png" width=150px height=50px></li>-->
      <!--<li><img src = "<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
images/logo/lsts.png" widht=300px height=100px></li>-->
      

    </ul>
  </nav>

</footer>

<?php echo '<script'; ?>
>
$(".info").on('click', function() {

  $(".popup-box").toggle();
})
<?php echo '</script'; ?>
>

</body>
</html>
<?php }
}
