<!--  start product-table ..................................................................................... -->
<script src="{$host}public/javascript/jquery.splitdropbutton.js"></script>
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
            {foreach from=$grid key=id item=title}
                <td class="{$title.class}" title="{$title.title}" align="{$title.align}">{$title.label}</td>
            {/foreach}
            <td></td>
        </tr>
        {foreach from=$dataGrid key=key item=line}
            <tr>
                {foreach from=$dataGrid[$key] key=idColumn item=column}
                    <td>{if $column eq ""}N/A{else}{$column}{/if}</td>
                {/foreach}
                {if $fieldAdd.enable eq true}
                    <td><a href="{$fieldAdd.href}/{$line[$keyGrid]}">{$fieldAdd.label}</a></td>
                {/if}
                <td align="center">
                    <script>
                        $(function() {
                            $("#select_{$line[$keyGrid]}")
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
                            <img style="cursor:pointer;" src="{$hostImage}settings8.png" id="select_{$line[$keyGrid]}"/>
                        </div>
                        <ul class="metali" style="position: absolute; cursor: pointer; text-align: left;">
                            {foreach from=$gridMenu key=id item=gm}
                                <li><a class="icon {$gm.icon}" href="{$gm.href}{$line[$keyGrid]}" {if $gm.confirm eq true}onClick="if(confirm('Deseja continuar?'))window.location='{$gm.location}/{$line[$keyGrid]}';"{/if}> {$gm.label}</a></li>
                            {/foreach}
                        </ul>
                    </div>
                </td>
            </tr>
        {foreachelse}
            <tr>
                <td colspan="{$numColumn}" align="center"><i>Nenhum resultado encontrado</i></td>
            </tr>
        {/foreach}
        <tr>
            <td colspan="{$numColumn}" align="center">
                <i style="padding:1px;">
                    <div class="5u">
                        Paginação:
                        <select name="pgn" id="pgn" onchange="this.form.submit();">
                            {foreach from=$pagination key=idS item=option}
                                <option value="{$option.value}" {if $option.value eq $form.pgn}selected{/if}>{$option.label}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="5u">
                        Registros por Página:
                        <select name="reg_page" onchange="this.form.submit();">
                            <option value="10" {if $form.reg_page eq 10}selected{/if}>10</option>
                            <option value="25" {if $form.reg_page eq 25}selected{/if}>25</option>
                            <option value="50" {if $form.reg_page eq 50}selected{/if}>50</option>
                        </select>
                    </div>
                    <div class="5u">
                        Total encontrado:
                        <input type="text" value="{$form.exibir}" name="exibir" size="3">
                    </div>
                    <!--table width="80%" cellspacing="0" cellpadding="5" class="semborda">
                        <tr>
                            <td class="icon fa-pagelines" align="right">Pag:</td>
                            <td align="left">
                                <select name="pgn" id="pgn" onchange="this.form.submit();">
                                    {foreach from=$pagination key=idS item=option}
                                        <option value="{$option.value}" {if $option.value eq $form.pgn}selected{/if}>{$option.label}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td class="icon fa-asterisk" align="right">Registros por Página:</td>
                            <td align="left">
                                <select name="reg_page" onchange="this.form.submit();">
                                    <option value="10" {if $form.reg_page eq 10}selected{/if}>10</option>
                                    <option value="25" {if $form.reg_page eq 25}selected{/if}>25</option>
                                    <option value="50" {if $form.reg_page eq 50}selected{/if}>50</option>
                                </select>
                            </td>
                            <td class="icon fa-circle" align="right">Total:</td>
                            <td align="left">
                                <input type="text" value="{$form.exibir}" name="exibir" size="3">
                            </td>
                        </tr>
                    </table-->
                    <!--ul class="meta">
                        <li class="icon fa-pagelines">Pag:</li>
                        <li>
                            <select class="select_grid" name="pgn" id="pgn" onchange="this.form.submit();">
                                {foreach from=$pagination key=idS item=option}
                                    <option value="{$option.value}" {if $option.value eq $form.pgn}selected{/if}>{$option.label}</option>
                                {/foreach}
                            </select>
                        </li>
                        <li class="icon fa-asterisk">Registros por Página:</li>
                        <li>
                            <select name="reg_page" class="select_grid" onchange="this.form.submit();">
                                <option value="10" {if $form.reg_page eq 10}selected{/if}>10</option>
                                <option value="25" {if $form.reg_page eq 25}selected{/if}>25</option>
                                <option value="50" {if $form.reg_page eq 50}selected{/if}>50</option>
                            </select>
                        </li>
                        <li class="icon fa-circle">Total:</li>
                        <li><input type="text" value="{$form.exibir}" name="exibir" size="3" class="select_grid"></li>
                    </ul-->
                </i>
            </td>
        </tr>
    </table>
</form>
<!--  end product-table................................... -->