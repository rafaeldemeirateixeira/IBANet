<!-- start id-form -->
<link rel="stylesheet" href="{$host}public/css/multi-select.css" />
<script src="{$host}public/javascript/pesquisa.js"></script>
<script src="{$host}public/javascript/jquery.validate.js"></script>
<script src="{$host}public/javascript/jquery.multi-select.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('#{$form.name}').validate({
        rules: {
        {foreach from=$fields key=j item=validate}
            {if $validate.type eq "text" && $validate.required eq 1}
                {$validate.name}: {
                    required: {$validate.required},
                    minlength: 1
                },
            {/if}
            {if $validate.type eq "date" && $validate.required eq 1}
                {$validate.name}: {
                    required: {$validate.required},
                    minlength: 10
                },
            {/if}
            {if $validate.type eq "search" && $validate.required eq 1}
                {$validate.name}: {
                    required: {$validate.required},
                    minlength: 3
                },
            {/if}
            {if $validate.type eq "select" && $validate.required eq 1}
                {$validate.name}: {
                    required: {$validate.required}
                },
            {/if}
            {if $validate.type eq "textarea" && $validate.required eq 1}
                {$validate.name}: {
                    required: {$validate.required}
                },
            {/if}
        {/foreach}
        },
        messages: {
        {foreach from=$fields key=j item=validate}
            {if $validate.type eq "text" && $validate.required eq 1}
                {$validate.name}: {
                    required: "{$validate.mensagem}",
                    minlength: "O campo nome deve conter no mínimo 3 caracteres."
                },
            {/if}
        {/foreach}
        }
    });
});
</script>

<form name="{$form.name}" id="{$form.name}" action="{$form.action}" method="{$form.method}" {if $form.confirm eq true}onSubmit="if(!confirm('Deseja continuar?'))return false;"{/if}>
    <div class="row uniform 50%">
        <table border="0" cellpadding="5" cellspacing="0" id="id-form" width="100%">
            {foreach from=$fields key=id item=field}
                {if $field.type eq "progressbar"}
                    <tr>
                        <td colspan="2">
                            {$field.label}:
                            <div id="{$field.name}"></div>{$field.value}%
                            <script>
                                $("#{$field.name}").progressbar({
                                    value: {$field.value}
                                });
                            </script>
                        </td>
                    </tr>
                {/if}
                {if $field.type eq "search"}
                    <tr>
                        <td colspan="2">
                            {$field.label}:
                            <input autocomplete="off" onkeyup="pesquisa('{$field.name}', '{$field.url}', '{$field.name}Result')" id="{$field.name}" name="{$field.name}" value="{$field.value}" type="text" placeholder="{$field.label}"/>
                            <input id="{$field.name}Hidden" type="hidden" value="" name="{$field.nameHidden}">
                            <div style="display:none;" id="{$field.name}Result" class="pesquisa"></div>
                        </td>
                    </tr>
                {/if}
                {if $field.type eq "text"}
                    <tr>
                        <td colspan="2">
                            {$field.label}:
                            <input id="{$field.name}" title="Preencha o campo Tipo" name="{$field.name}" value="{$field.value}" type="text" placeholder="{$field.label}"/>
                            <i>{$field.obs}</i>
                        </td>
                    </tr>
                {/if}
                {if $field.type eq "date"}
                    <script>
                        $(function(){
                            $("#{$field.name}").datepicker({
                                inline: true
                            });
                        });
                    </script>
                    <tr>
                        <td colspan="2">
                            {$field.label}:
                            <input id="{$field.name}" title="Selecione uma data" name="{$field.name}" value="{$field.value}" type="text" placeholder="{$field.label}"/>
                        </td>
                    </tr>
                {/if}

                {if $field.type eq "password"}
                    <tr>
                        <td colspan="2">
                            {$field.label}:
                            <input id="{$field.name}" name="{$field.name}" value="{$field.value}" type="password" placeholder="{$field.label}"/>
                        </td>
                    </tr>
                {/if}
                {if $field.type eq "select"}
                    <tr>
                        <td colspan="2">
                            {$field.label}:
                            <select name="{$field.name}" id="{$field.name}">
                                <option value="">Selecione...</option>
                                {foreach from=$field.option key=idS item=option}
                                    <option value="{$option.value}" {if $option.selected eq 1 || $option.value eq $field.selected}selected{/if}>{$option.label}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                {/if}
                {if $field.type eq "multi"}
                    <tr>
                        <td colspan="2">
                            {$field.label}:
                            <select multiple="multiple" name="{$field.name}[]" id="{$field.name}">
                                {foreach from=$field.option key=idS item=option}
                                    <option value="{$option.value}" {if $option.selected eq 1}selected{/if}>{$option.label}</option>
                                {/foreach}
                            </select>
                            <script>$('#{$field.name}').multiSelect()</script>
                        </td>
                    </tr>
                {/if}
                {if $field.type eq "textarea"}
                    <tr>
                        <td colspan="2">
                            {$field.label}:
                            <textarea name="{$field.name}" id="{$field.name}" rows="" cols="" placeholder="{$field.label}">{$field.value}</textarea>
                            <i>{$field.obs}</i>
                        </td>
                    </tr>
                {/if}
                {if $field.type eq "file"}
                    <tr>
                        <td colspan="2">
                            <input type="file" name="{$field.name}" id="{$field.name}" />
                        </td>
                    </tr>
                {/if}
                {if $field.type eq "checkbox"}
                    <tr>
                        <th valign="top" align="right">
                            <input id="{$field.name}" {if $field.checked eq true}checked="checked"{/if} title="Preencha o campo Tipo" name="{$field.name}" value="{$field.value}" type="checkbox" />
                        </th>
                        <td>
                            {$field.label}
                        </td>
                    </tr>
                {/if}
                {if $field.type eq "hidden"}
                    <tr>
                        <td colspan="2" valign="top" align="right">
                            <input name="{$field.name}" value="{$field.value}" type="hidden" />
                        </td>
                    </tr>
                {/if}
                {if $field.type eq "label"}
                    <tr>
                        <th valign="top" align="right">{$field.label}:</th>
                        <td>
                            <h3>{$field.text}</h3>
                        </td>
                    </tr>
                {/if}
            {/foreach}
            <tr>
                <td valign="top" colspan="2" align="center">
                    <input type="submit" value="{$form.button}" class="form-submit" />
                    <input type="reset" value="Reset" class="form-reset"  />
                </td>
            </tr>
        </table>
    </div>
</form>
<!-- end id-form  -->