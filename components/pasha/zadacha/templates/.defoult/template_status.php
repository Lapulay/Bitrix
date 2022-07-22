<?php
if (!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!== true)die();
print_r($arResult["LIST_VALUES"]);
?>
<form action="" method="POST">
    <input type="hidden" name="form_id" value="Add_status" />
    <table>
        <tr>
            <td>Название</td>
            <td>Статус</td>

        </tr>


        <tr>
            <td>
                <select name = 'TASK'>
                    <? foreach ($arResult['TASKS'] as  $key=>$task): ?>
                    <option value="<?=$key?>"><?= $task['NAME']?></option>
                    <?endforeach; ?>
                </select>
            </td>
            <td>
                <select name='STATUS'>

                    <?foreach($arResult["LIST_VALUES"] as $key => $el):?>
                        <? if (in_array($el['CODE'], $arResult['ROLE']['AVAILABLE_STATUS'])): ?>
                        <option value="<?=$key?>"><?= $el['VALUE']?></option>
                        <?endif;?>
                    <?endforeach; ?>
                </select>
            </td>
        </tr>


    </table>

    <input type="submit" value="Сохранить">
</form>
