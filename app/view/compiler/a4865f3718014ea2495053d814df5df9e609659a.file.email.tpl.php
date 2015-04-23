<?php /* Smarty version Smarty-3.1.13, created on 2015-04-22 00:28:13
         compiled from "/Users/rafael/projetos/IBANet/app/view/template/email.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12218600915537137e5d3b20-80741130%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4865f3718014ea2495053d814df5df9e609659a' => 
    array (
      0 => '/Users/rafael/projetos/IBANet/app/view/template/email.tpl',
      1 => 1429673290,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12218600915537137e5d3b20-80741130',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5537137e6456b0_88448965',
  'variables' => 
  array (
    'hostImage' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5537137e6456b0_88448965')) {function content_5537137e6456b0_88448965($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>IBANet</title>
    </head>

    <body style=" font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; margin:0px; padding:0px; background:url(<?php echo $_smarty_tpl->tpl_vars['hostImage']->value;?>
bg_classico.jpg) center; font-size:14px; color:#666">
        <div style=" width:660px; margin:0px auto 20px auto; background:#fff; border:1px solid #DBDBDB;">
            <a href="http://ibalianca.com.br">
                <img src="<?php echo $_smarty_tpl->tpl_vars['hostImage']->value;?>
email_topo.png" alt="IBANet" />
            </a>
            <div style="padding:20px;">
                <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

            </div>
            <img src="<?php echo $_smarty_tpl->tpl_vars['hostImage']->value;?>
email_rodape.png" alt="IBANet" />
        </div>
    </body>
</html><?php }} ?>