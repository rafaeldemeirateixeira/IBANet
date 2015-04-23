<?php /* Smarty version Smarty-3.1.13, created on 2015-04-22 16:20:16
         compiled from "/Users/rafael/projetos/IBANet/app/view/template/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1115109722550ac17ae3d3d4-01281332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be1b0bd12baccc1629f085959a3c8666fa6da90d' => 
    array (
      0 => '/Users/rafael/projetos/IBANet/app/view/template/login.tpl',
      1 => 1429730294,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1115109722550ac17ae3d3d4-01281332',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_550ac17aeb70c5_24019182',
  'variables' => 
  array (
    'host' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550ac17aeb70c5_24019182')) {function content_550ac17aeb70c5_24019182($_smarty_tpl) {?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>IBANet - Autenticação</title>
        <script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/login.js"></script>
        <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=pt"></script>
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/css/login.css">
        <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <body>
        <div id="formulario" style="display: block;">
            <form id="form_login" method="post" action="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
Login/Authentic/" class="login">
                <table class="table" width="100%" border="0" cellpadding="5">
                    <tr>
                        <td colspan="2">
                            <section class="about">
                                <p class="about-links">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/image/logo.png">
                                </p>
                                <p class="about-author">
                                    &copy; 2012&ndash;2015 Criare Development<br>Todos os Direitos Reservados
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            Email:<br>
                            <input type="text" name="psa_email" id="psa_email" value="">
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            Senha:<br>
                            <input type="password" name="psa_pwd" id="psa_pwd" value="">
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            <div class="g-recaptcha" data-sitekey="6LeruwMTAAAAAGv0tqeK9EpbjSJHWv2J6d9IdyWF"></div>
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            <button type="submit" class="login-button"></button>
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <section class="td">
                            <p class="forgot-password">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
Login/Forgot">Esqueceu sua senha?</a>
                            </p>
                            </section>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="carregando" class="carregando" style="display: none;">
            <img src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/image/ajax-loader.gif">
        </div>
    </body>
</html><?php }} ?>