<?php /* Smarty version Smarty-3.1.13, created on 2015-04-22 20:55:40
         compiled from "/Users/rafael/projetos/IBANet/app/view/template/grid.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30678133155076fbc4435c9-89184435%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '04e7875455812ec24c5c50fd796825aa651477d4' => 
    array (
      0 => '/Users/rafael/projetos/IBANet/app/view/template/grid.tpl',
      1 => 1429746938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30678133155076fbc4435c9-89184435',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_55076fbc4d9c00_82876565',
  'variables' => 
  array (
    'host' => 0,
    'grid' => 0,
    'title' => 0,
    'dataGrid' => 0,
    'key' => 0,
    'column' => 0,
    'fieldAdd' => 0,
    'keyGrid' => 0,
    'line' => 0,
    'hostImage' => 0,
    'gridMenu' => 0,
    'gm' => 0,
    'numColumn' => 0,
    'pagination' => 0,
    'option' => 0,
    'form' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55076fbc4d9c00_82876565')) {function content_55076fbc4d9c00_82876565($_smarty_tpl) {?><!--  start product-table ..................................................................................... -->
<script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/jquery.splitdropbutton.js"></script>
<style>
    .ui-button {
        display: inline-block;
        padding: 0;
        line-height: normal;
        margin-right: .1em;
        cursor: pointer;
        vertical-align: middle;
        text-align: center;
        overflow: visible; /* removes extra width in IE */
    }
</style>
<form method="POST" action="" id="grid" name="grid">
    <table cellspacing="0" cellpadding="5" class="bordasimples" style="width:100%">
        <tr class="linetitle">
            <?php  $_smarty_tpl->tpl_vars['title'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['title']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['grid']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['title']->key => $_smarty_tpl->tpl_vars['title']->value){
$_smarty_tpl->tpl_vars['title']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['title']->key;
?>
                <td class="<?php echo $_smarty_tpl->tpl_vars['title']->value['class'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['title']->value['title'];?>
" align="<?php echo $_smarty_tpl->tpl_vars['title']->value['align'];?>
"><?php echo $_smarty_tpl->tpl_vars['title']->value['label'];?>
</td>
            <?php } ?>
            <td></td>
        </tr>
        <?php  $_smarty_tpl->tpl_vars['line'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['line']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['dataGrid']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['line']->key => $_smarty_tpl->tpl_vars['line']->value){
$_smarty_tpl->tpl_vars['line']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['line']->key;
?>
            <tr>
                <?php  $_smarty_tpl->tpl_vars['column'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['column']->_loop = false;
 $_smarty_tpl->tpl_vars['idColumn'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['dataGrid']->value[$_smarty_tpl->tpl_vars['key']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['column']->key => $_smarty_tpl->tpl_vars['column']->value){
$_smarty_tpl->tpl_vars['column']->_loop = true;
 $_smarty_tpl->tpl_vars['idColumn']->value = $_smarty_tpl->tpl_vars['column']->key;
?>
                    <td><?php if ($_smarty_tpl->tpl_vars['column']->value==''){?>N/A<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['column']->value;?>
<?php }?></td>
                <?php } ?>
                <?php if ($_smarty_tpl->tpl_vars['fieldAdd']->value['enable']==true){?>
                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['fieldAdd']->value['href'];?>
/<?php echo $_smarty_tpl->tpl_vars['line']->value[$_smarty_tpl->tpl_vars['keyGrid']->value];?>
"><?php echo $_smarty_tpl->tpl_vars['fieldAdd']->value['label'];?>
</a></td>
                <?php }?>
                <td align="center">
                    <script>
                        $(function() {
                            $("#select_<?php echo $_smarty_tpl->tpl_vars['line']->value[$_smarty_tpl->tpl_vars['keyGrid']->value];?>
")
                                    .click(function() {
                                        var menu = $(this).parent().next().show().position({
                                            my: "left top",
                                            at: "left bottom",
                                            of: this
                                        });
                                        $(document).one("click", function() {
                                            menu.hide();
                                        });
                                        return false;
                                    })
                                    .parent()
                                    .next()
                                    .hide()
                                    .menu();
                        });
                    </script>
                    <div>
                        <div>
                            <img style="cursor:pointer;" src="<?php echo $_smarty_tpl->tpl_vars['hostImage']->value;?>
settings8.png" id="select_<?php echo $_smarty_tpl->tpl_vars['line']->value[$_smarty_tpl->tpl_vars['keyGrid']->value];?>
"/>
                        </div>
                        <ul class="metali" style="position: absolute; cursor: pointer; text-align: left;">
                            <?php  $_smarty_tpl->tpl_vars['gm'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['gm']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['gridMenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['gm']->key => $_smarty_tpl->tpl_vars['gm']->value){
$_smarty_tpl->tpl_vars['gm']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['gm']->key;
?>
                                <li><a class="icon <?php echo $_smarty_tpl->tpl_vars['gm']->value['icon'];?>
" href="<?php echo $_smarty_tpl->tpl_vars['gm']->value['href'];?>
<?php echo $_smarty_tpl->tpl_vars['line']->value[$_smarty_tpl->tpl_vars['keyGrid']->value];?>
" <?php if ($_smarty_tpl->tpl_vars['gm']->value['confirm']==true){?>onClick="if(confirm('Deseja continuar?'))window.location='<?php echo $_smarty_tpl->tpl_vars['gm']->value['location'];?>
/<?php echo $_smarty_tpl->tpl_vars['line']->value[$_smarty_tpl->tpl_vars['keyGrid']->value];?>
';"<?php }?>> <?php echo $_smarty_tpl->tpl_vars['gm']->value['label'];?>
</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php }
if (!$_smarty_tpl->tpl_vars['line']->_loop) {
?>
            <tr>
                <td colspan="<?php echo $_smarty_tpl->tpl_vars['numColumn']->value;?>
" align="center"><i>Nenhum resultado encontrado</i></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="<?php echo $_smarty_tpl->tpl_vars['numColumn']->value;?>
" align="center">
                <i style="padding:1px;">
                    <div class="5u">
                        Paginação:
                        <select name="pgn" id="pgn" onchange="this.form.submit();">
                            <?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_smarty_tpl->tpl_vars['idS'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['pagination']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
 $_smarty_tpl->tpl_vars['idS']->value = $_smarty_tpl->tpl_vars['option']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['option']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['option']->value['value']==$_smarty_tpl->tpl_vars['form']->value['pgn']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['option']->value['label'];?>
</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="5u">
                        Registros por Página:
                        <select name="reg_page" onchange="this.form.submit();">
                            <option value="10" <?php if ($_smarty_tpl->tpl_vars['form']->value['reg_page']==10){?>selected<?php }?>>10</option>
                            <option value="25" <?php if ($_smarty_tpl->tpl_vars['form']->value['reg_page']==25){?>selected<?php }?>>25</option>
                            <option value="50" <?php if ($_smarty_tpl->tpl_vars['form']->value['reg_page']==50){?>selected<?php }?>>50</option>
                        </select>
                    </div>
                    <div class="5u">
                        Total encontrado:
                        <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['exibir'];?>
" name="exibir" size="3">
                    </div>
                    <!--table width="80%" cellspacing="0" cellpadding="5" class="semborda">
                        <tr>
                            <td class="icon fa-pagelines" align="right">Pag:</td>
                            <td align="left">
                                <select name="pgn" id="pgn" onchange="this.form.submit();">
                                    <?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_smarty_tpl->tpl_vars['idS'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['pagination']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
 $_smarty_tpl->tpl_vars['idS']->value = $_smarty_tpl->tpl_vars['option']->key;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['option']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['option']->value['value']==$_smarty_tpl->tpl_vars['form']->value['pgn']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['option']->value['label'];?>
</option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td class="icon fa-asterisk" align="right">Registros por Página:</td>
                            <td align="left">
                                <select name="reg_page" onchange="this.form.submit();">
                                    <option value="10" <?php if ($_smarty_tpl->tpl_vars['form']->value['reg_page']==10){?>selected<?php }?>>10</option>
                                    <option value="25" <?php if ($_smarty_tpl->tpl_vars['form']->value['reg_page']==25){?>selected<?php }?>>25</option>
                                    <option value="50" <?php if ($_smarty_tpl->tpl_vars['form']->value['reg_page']==50){?>selected<?php }?>>50</option>
                                </select>
                            </td>
                            <td class="icon fa-circle" align="right">Total:</td>
                            <td align="left">
                                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['exibir'];?>
" name="exibir" size="3">
                            </td>
                        </tr>
                    </table-->
                    <!--ul class="meta">
                        <li class="icon fa-pagelines">Pag:</li>
                        <li>
                            <select class="select_grid" name="pgn" id="pgn" onchange="this.form.submit();">
                                <?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_smarty_tpl->tpl_vars['idS'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['pagination']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
 $_smarty_tpl->tpl_vars['idS']->value = $_smarty_tpl->tpl_vars['option']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['option']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['option']->value['value']==$_smarty_tpl->tpl_vars['form']->value['pgn']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['option']->value['label'];?>
</option>
                                <?php } ?>
                            </select>
                        </li>
                        <li class="icon fa-asterisk">Registros por Página:</li>
                        <li>
                            <select name="reg_page" class="select_grid" onchange="this.form.submit();">
                                <option value="10" <?php if ($_smarty_tpl->tpl_vars['form']->value['reg_page']==10){?>selected<?php }?>>10</option>
                                <option value="25" <?php if ($_smarty_tpl->tpl_vars['form']->value['reg_page']==25){?>selected<?php }?>>25</option>
                                <option value="50" <?php if ($_smarty_tpl->tpl_vars['form']->value['reg_page']==50){?>selected<?php }?>>50</option>
                            </select>
                        </li>
                        <li class="icon fa-circle">Total:</li>
                        <li><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['exibir'];?>
" name="exibir" size="3" class="select_grid"></li>
                    </ul-->
                </i>
            </td>
        </tr>
    </table>
</form>
<!--  end product-table................................... --><?php }} ?>