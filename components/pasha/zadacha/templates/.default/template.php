<?php
if (!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!== true)die();
//print_r($arResult['ROLE']);
?>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


<table class="table  table-striped table-bordered" >
    <thead>
    <tr>
        <th>Название</th>
        <th>Описание</th>
        <th>Крайний срок</th>
        <th>Статус</th>
    </tr>
    </thead>

    <? foreach ($arResult['TASKS'] as  $key=>$task): ?>
    <tr>
        <td><?= $task['NAME']?></td>
        <td><?= $task['OPISANIE']?></td>
        <td><?= $task['SROK']?></td>
        <td>
            <?= $task['STATUS']?></td>
        <? if ($arResult['ROLE']['ACTIVE']=="KURATOR"):?>
        <td><a href="?ID=<?=$key?> "class="btn btn-danger" >Удалить</td>
        <? endif;?>


    </tr>

    <?endforeach; ?>
</table>
<? if ($arResult['ROLE']['ACTIVE']=="KURATOR"):?>
<a href="?iblock_Add=Y"  class="btn btn-primary">добавить</a>
<? endif;?>

<a href="?iblock_status=Y" class="btn btn-primary">Изменить статус</a>

