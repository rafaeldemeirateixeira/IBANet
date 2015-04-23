<?php /* Smarty version Smarty-3.1.13, created on 2015-04-22 15:56:03
         compiled from "/Users/rafael/projetos/IBANet/app/view/template/forgot.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1723452695537eb901d8a43-64732124%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '37a9ae48eaa8289d241b8c5ffd1a15290570b951' => 
    array (
      0 => '/Users/rafael/projetos/IBANet/app/view/template/forgot.tpl',
      1 => 1429728900,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1723452695537eb901d8a43-64732124',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5537eb902f5af8_00256873',
  'variables' => 
  array (
    'host' => 0,
    'psa_cod' => 0,
    'nome' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5537eb902f5af8_00256873')) {function content_5537eb902f5af8_00256873($_smarty_tpl) {?><!DOCTYPE html>
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
        <script>
            /*
             * To change this license header, choose License Headers in Project Properties.
             * To change this template file, choose Tools | Templates
             * and open the template in the editor.
             */

            $(document).ready(function() {
                $("#form_login").submit(function() {

                    if (confirm("Deseja Continuar?")) {

                        if ($("#psa_email").val() == "") {
                            alert("Por favor o seu email!");
                            $("#psa_email").focus();
                            return false;
                        }

                        $("#formulario").hide();
                        $("#carregando").show();

                        return true;
                    } else {
                        return false;
                    }
                });
            });
        </script>
        <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=pt"></script>
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/css/login.css">
        <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <body>
        <div id="formulario" style="display: block;">
            <form id="form_login" method="post" action="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
Login/validationForgot/" class="login">
                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['psa_cod']->value;?>
" name="psa_cod">
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
                                </p>
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="label">
                            <section class="td">
                                <h3>Olá, você por aqui!</h3> <h2><?php echo $_smarty_tpl->tpl_vars['nome']->value;?>
</h2>
                                <h4>
                                    Informe o seu email, e lembre-se que só vai dar certo se for o email cadastrado no IBANet.
                                    Você receberá um email com as orientações para alterar sua senha.
                                </h4>
                            </section>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <section class="td">
                            Email Cadastrado:<br>
                            <input type="email" name="psa_email" id="psa_email" value="">
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
                </table>
            </form>
        </div>
        <div id="carregando" class="carregando" style="display: none;">
            <img src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/image/ajax-loader.gif">
        </div>
    </body>
</html><?php }} ?>