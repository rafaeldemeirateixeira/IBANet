<?php /* Smarty version Smarty-3.1.13, created on 2015-04-22 20:08:21
         compiled from "/Users/rafael/projetos/IBANet/app/view/template/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2011808044550838ef47a784-35005759%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '117ec6e6a9422051f7e4964e581f828505eeeba0' => 
    array (
      0 => '/Users/rafael/projetos/IBANet/app/view/template/form.tpl',
      1 => 1429744099,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2011808044550838ef47a784-35005759',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_550838ef4d24b9_16968508',
  'variables' => 
  array (
    'host' => 0,
    'form' => 0,
    'fields' => 0,
    'validate' => 0,
    'field' => 0,
    'option' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_550838ef4d24b9_16968508')) {function content_550838ef4d24b9_16968508($_smarty_tpl) {?><!-- start id-form -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/css/multi-select.css" />
<script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/pesquisa.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/jquery.validate.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['host']->value;?>
public/javascript/jquery.multi-select.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('#<?php echo $_smarty_tpl->tpl_vars['form']->value['name'];?>
').validate({
        rules: {
        <?php  $_smarty_tpl->tpl_vars['validate'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['validate']->_loop = false;
 $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['validate']->key => $_smarty_tpl->tpl_vars['validate']->value){
$_smarty_tpl->tpl_vars['validate']->_loop = true;
 $_smarty_tpl->tpl_vars['j']->value = $_smarty_tpl->tpl_vars['validate']->key;
?>
            <?php if ($_smarty_tpl->tpl_vars['validate']->value['type']=="text"&&$_smarty_tpl->tpl_vars['validate']->value['required']==1){?>
                <?php echo $_smarty_tpl->tpl_vars['validate']->value['name'];?>
: {
                    required: <?php echo $_smarty_tpl->tpl_vars['validate']->value['required'];?>
,
                    minlength: 1
                },
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['validate']->value['type']=="date"&&$_smarty_tpl->tpl_vars['validate']->value['required']==1){?>
                <?php echo $_smarty_tpl->tpl_vars['validate']->value['name'];?>
: {
                    required: <?php echo $_smarty_tpl->tpl_vars['validate']->value['required'];?>
,
                    minlength: 10
                },
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['validate']->value['type']=="search"&&$_smarty_tpl->tpl_vars['validate']->value['required']==1){?>
                <?php echo $_smarty_tpl->tpl_vars['validate']->value['name'];?>
: {
                    required: <?php echo $_smarty_tpl->tpl_vars['validate']->value['required'];?>
,
                    minlength: 3
                },
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['validate']->value['type']=="select"&&$_smarty_tpl->tpl_vars['validate']->value['required']==1){?>
                <?php echo $_smarty_tpl->tpl_vars['validate']->value['name'];?>
: {
                    required: <?php echo $_smarty_tpl->tpl_vars['validate']->value['required'];?>

                },
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['validate']->value['type']=="textarea"&&$_smarty_tpl->tpl_vars['validate']->value['required']==1){?>
                <?php echo $_smarty_tpl->tpl_vars['validate']->value['name'];?>
: {
                    required: <?php echo $_smarty_tpl->tpl_vars['validate']->value['required'];?>

                },
            <?php }?>
        <?php } ?>
        },
        messages: {
        <?php  $_smarty_tpl->tpl_vars['validate'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['validate']->_loop = false;
 $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['validate']->key => $_smarty_tpl->tpl_vars['validate']->value){
$_smarty_tpl->tpl_vars['validate']->_loop = true;
 $_smarty_tpl->tpl_vars['j']->value = $_smarty_tpl->tpl_vars['validate']->key;
?>
            <?php if ($_smarty_tpl->tpl_vars['validate']->value['type']=="text"&&$_smarty_tpl->tpl_vars['validate']->value['required']==1){?>
                <?php echo $_smarty_tpl->tpl_vars['validate']->value['name'];?>
: {
                    required: "<?php echo $_smarty_tpl->tpl_vars['validate']->value['mensagem'];?>
",
                    minlength: "O campo nome deve conter no mínimo 3 caracteres."
                },
            <?php }?>
        <?php } ?>
        }
    });
});
</script>

<form name="<?php echo $_smarty_tpl->tpl_vars['form']->value['name'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['form']->value['name'];?>
" action="<?php echo $_smarty_tpl->tpl_vars['form']->value['action'];?>
" method="<?php echo $_smarty_tpl->tpl_vars['form']->value['method'];?>
" <?php if ($_smarty_tpl->tpl_vars['form']->value['confirm']==true){?>onSubmit="if(!confirm('Deseja continuar?'))return false;"<?php }?>>
    <div class="row uniform 50%">
        <table border="0" cellpadding="5" cellspacing="0" id="id-form" width="100%">
            <?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['fields']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['field']->key;
?>
                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="progressbar"){?>
                    <tr>
                        <td colspan="2">
                            <?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
:
                            <div id="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
"></div><?php echo $_smarty_tpl->tpl_vars['field']->value['value'];?>
%
                            <script>
                                $("#<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
").progressbar({
                                    value: <?php echo $_smarty_tpl->tpl_vars['field']->value['value'];?>

                                });
                            </script>
                        </td>
                    </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="search"){?>
                    <tr>
                        <td colspan="2">
                            <?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
:
                            <input autocomplete="off" onkeyup="pesquisa('<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['url'];?>
', '<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
Result')" id="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['value'];?>
" type="text" placeholder="<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
"/>
                            <input id="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
Hidden" type="hidden" value="" name="<?php echo $_smarty_tpl->tpl_vars['field']->value['nameHidden'];?>
">
                            <div style="display:none;" id="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
Result" class="pesquisa"></div>
                        </td>
                    </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="text"){?>
                    <tr>
                        <td colspan="2">
                            <?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
:
                            <input id="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" title="Preencha o campo Tipo" name="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['value'];?>
" type="text" placeholder="<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
"/>
                            <i><?php echo $_smarty_tpl->tpl_vars['field']->value['obs'];?>
</i>
                        </td>
                    </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="date"){?>
                    <script>
                        $(function(){
                            $("#<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
").datepicker({
                                inline: true
                            });
                        });
                    </script>
                    <tr>
                        <td colspan="2">
                            <?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
:
                            <input id="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" title="Selecione uma data" name="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['value'];?>
" type="text" placeholder="<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
"/>
                        </td>
                    </tr>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="password"){?>
                    <tr>
                        <td colspan="2">
                            <?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
:
                            <input id="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['value'];?>
" type="password" placeholder="<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
"/>
                        </td>
                    </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="select"){?>
                    <tr>
                        <td colspan="2">
                            <?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
:
                            <select name="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
">
                                <option value="">Selecione...</option>
                                <?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_smarty_tpl->tpl_vars['idS'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['field']->value['option']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
 $_smarty_tpl->tpl_vars['idS']->value = $_smarty_tpl->tpl_vars['option']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['option']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['option']->value['selected']==1||$_smarty_tpl->tpl_vars['option']->value['value']==$_smarty_tpl->tpl_vars['field']->value['selected']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['option']->value['label'];?>
</option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="multi"){?>
                    <tr>
                        <td colspan="2">
                            <?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
:
                            <select multiple="multiple" name="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
[]" id="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
">
                                <?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_smarty_tpl->tpl_vars['idS'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['field']->value['option']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
 $_smarty_tpl->tpl_vars['idS']->value = $_smarty_tpl->tpl_vars['option']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['option']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['option']->value['selected']==1){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['option']->value['label'];?>
</option>
                                <?php } ?>
                            </select>
                            <script>$('#<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
').multiSelect()</script>
                        </td>
                    </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="textarea"){?>
                    <tr>
                        <td colspan="2">
                            <?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
:
                            <textarea name="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" rows="" cols="" placeholder="<?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
"><?php echo $_smarty_tpl->tpl_vars['field']->value['value'];?>
</textarea>
                            <i><?php echo $_smarty_tpl->tpl_vars['field']->value['obs'];?>
</i>
                        </td>
                    </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="file"){?>
                    <tr>
                        <td colspan="2">
                            <input type="file" name="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" />
                        </td>
                    </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="checkbox"){?>
                    <tr>
                        <th valign="top" align="right">
                            <input id="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" <?php if ($_smarty_tpl->tpl_vars['field']->value['checked']==true){?>checked="checked"<?php }?> title="Preencha o campo Tipo" name="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['value'];?>
" type="checkbox" />
                        </th>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>

                        </td>
                    </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="hidden"){?>
                    <tr>
                        <td colspan="2" valign="top" align="right">
                            <input name="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['field']->value['value'];?>
" type="hidden" />
                        </td>
                    </tr>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['field']->value['type']=="label"){?>
                    <tr>
                        <th valign="top" align="right"><?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
:</th>
                        <td>
                            <h3><?php echo $_smarty_tpl->tpl_vars['field']->value['text'];?>
</h3>
                        </td>
                    </tr>
                <?php }?>
            <?php } ?>
            <tr>
                <td valign="top" colspan="2" align="center">
                    <input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['form']->value['button'];?>
" class="form-submit" />
                    <input type="reset" value="Reset" class="form-reset"  />
                </td>
            </tr>
        </table>
    </div>
</form>
<!-- end id-form  --><?php }} ?>