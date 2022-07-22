<?php
if (!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!== true)die();
print_r($arResult['ROLE']);
?>

<table>
    <tr>
        <td>Название</td>
        <td>Описание</td>
        <td>Крайний срок</td>
        <td>Статус</td>

    </tr>

    <? foreach ($arResult['TASKS'] as  $key=>$task): ?>
    <tr>
        <td><?= $task['NAME']?></td>
        <td><?= $task['OPISANIE']?></td>
        <td><?= $task['SROK']?></td>
        <td>
            <?= $task['STATUS']?></td>
        <? if ($arResult['ROLE']['ACTIVE']=="KURATOR"):?>
        <td><a href="?ID=<?=$key?>" >Удалить</td>
        <? endif;?>


    </tr>

    <?endforeach; ?>
</table>
<? if ($arResult['ROLE']['ACTIVE']=="KURATOR"):?>
<a href="?iblock_Add=Y">добавить</a>
<? endif;?>

<a href="?iblock_status=Y" >Изменить статус</a>

