<?php /* Smarty version Smarty-3.1.13, created on 2015-04-22 14:12:07
         compiled from "/Users/rafael/projetos/IBANet/app/view/template/password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7992752815537b5ec739543-47591600%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f51a0582944dfc868043dc51b24501468f4a0071' => 
    array (
      0 => '/Users/rafael/projetos/IBANet/app/view/template/password.tpl',
      1 => 1429722098,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7992752815537b5ec739543-47591600',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5537b5ec819214_60541169',
  'variables' => 
  array (
    'host' => 0,
    'psa_cod' => 0,
    'nome' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5537b5ec819214_60541169')) {function content_5537b5ec819214_60541169($_smarty_tpl) {?><!DOCTYPE html>
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

                        if ($("#psa_pwd").val() == "") {
                            alert("Por favor informe a senha!");
                            $("#psa_pwd").focus();
                            return false;
                        }

                        if ($("#psa_pwd2").val() == "") {
                            alert("Por favor confirme a senha!");
                            $("#psa_pwd2").focus();
                            return false;
                        }

                        if ($("#psa_pwd").val() != $("#psa_pwd2").val()) {
                            alert("As senha informadas não conferem!");
                            $("#psa_pwd").val("");
                            $("#psa_pwd2").val("");
                            $("#psa_pwd").focus();
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
Login/setPasswordUser/" class="login">
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
                                <h3>Olá, é você mesmo?</h3> <h2><?php echo $_smarty_tpl->tpl_vars['nome']->value;?>
</h2>
                                <h4>
                                    Se for, informe a sua senha para acessar o IBANet. Você deve informar a senha e repeti-la para confirmar e em seguida, marcar "<b>Não sou um robô</b>" e clicar na seta.
                                </h4>
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
                            Confirme a Senha:<br>
                            <input type="password" name="psa_pwd2" id="psa_pwd2" value="">
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