<?php
if (!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!== true)die();
//print_r($arResult['ROLE']);
$APPLICATION->SetTitle("Задача");
$APPLICATION->AddChainItem($APPLICATION->GetTitle(),'/about/');
?>


<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>



<div class="container">
    <form name="add_my_ankete" action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="form_id" value="Add_Item" />
        <div class="form-group">
        <label>Название</label>
        <input type="text" class="form-control" name="NAME" maxlength="255" value="">

        <label>Описание</label>
        <textarea name="OPISANIE" class="form-control" placeholder="Заполните поле"></textarea>

    <label>Крайний срок</label>
    <input type="text" name="SROK" class="form-control" maxlength="255" value="">

            <label>Статус(при добавлении задачи по умолчанию новая)</label>
        <select name='STATUS' class="form-control">
                <option value="1">Новая</option>
        </select>
            <br>
        <input type="submit" class="btn btn-success" value="Добавить">
        </div>
    </form>
</div>
