<?php /* Smarty version Smarty-3.1.13, created on 2015-04-02 20:35:12
         compiled from "/Users/rafael/projetos/IBANet/app/view/template/404.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1549247930550ac602900dc9-06700653%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0d19874b101a4136c3666e2763d4f74c17e528a' => 
    array (
      0 => '/Users/rafael/projetos/IBANet/app/view/template/404.tpl',
      1 => 1428006910,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1549247930550ac602900dc9-06700653',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_550ac6029a2877_00751985',
  'variables' => 
  array (
    'host' => 0,
    'hostImage' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550ac6029a2877_00751985')) {function content_550ac6029a2877_00751985($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title>404 - Página inválida</title>
  
  <style type="text/css">
    body { background-color: #efefef; color: #333; font-family: Georgia,Palatino,'Book Antiqua',serif;padding:0;margin:0;text-align:center; }
    p {font-style:italic;}
    div.dialog {
      width: 490px;
      margin: 4em auto 0 auto;
    }
    img { border:none; }
  </style>
  
</head>

<body>
  <!-- This file lives in public/404.html -->
  <div class="dialog">
    <a href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
Index"><img src="<?php echo $_smarty_tpl->tpl_vars['hostImage']->value;?>
404.png" /></a>
    <p>A página que você estava procurando não existe, me desculpe.</p>
  </div>
</body>
</html><?php }} ?>