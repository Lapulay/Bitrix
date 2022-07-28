<?php
if (!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!== true)die();
?>

<?php
    $this->addExternalCss("/local/css/bootstrap.min.css");
    $this->addExternalJS("/local/js/bootstrap.bundle.min.js");
?>

<table class="table  table-striped table-bordered" >
    <thead>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Крайний срок</th>
            <th>Статус</th>
        </tr>
    </thead>

    <? foreach ($arResult['TASKS'] as  $key=>$arTask): ?>
        <tr>
            <td>
                <?= $arTask['NAME']?>
            </td>
            <td>
                <?= $arTask['OPISANIE']?>
            </td>
            <td>
                <?= $arTask['SROK']?>
            </td>
            <td>
                <?= $arTask['STATUS']?>
            </td>
            <? if ($arResult['ROLE']['ACTIVE']=="KURATOR"):?>
                <td>
                    <a href="?ID=<?=$key?> "class="btn btn-danger" >Удалить
                </td>
            <? endif;?>
        </tr>
    <?endforeach; ?>
</table>

    <? if ($arResult['ROLE']['ACTIVE']=="KURATOR"):?>
        <a href="?iblock_Add=Y"  class="btn btn-primary">добавить</a>
    <? endif;?>

    <a href="?iblock_status=Y" class="btn btn-primary">Изменить статус</a>

