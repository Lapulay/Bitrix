<?php
if (!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!== true)die();
//print_r($arResult["LIST_VALUES"]);
$APPLICATION->SetTitle("Статус");
$APPLICATION->AddChainItem($APPLICATION->GetTitle(),'/about/');
?>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


    <form action="" method="POST">

        <input type="hidden" name="form_id" value="Add_status" />
        <table class="table table-bordered">
            <thead class="active">
            <tr >
                <th>Название</th>
                <th>Статус</th>
            </tr>
            </thead>
            <div class="form-group">
            <tr>
                <td>
                    <select class="form-control" name = 'TASK'>
                        <? foreach ($arResult['TASKS'] as  $key=>$task): ?>
                        <option value="<?=$key?>"><?= $task['NAME']?></option>
                        <?endforeach; ?>
                    </select>
                </td>

                <td>
                    <select class="form-control" name='STATUS'>

                        <?foreach($arResult["LIST_VALUES"] as $key => $el):?>
                            <? if (in_array($el['CODE'], $arResult['ROLE']['AVAILABLE_STATUS'])): ?>
                            <option value="<?=$key?>"><?= $el['VALUE']?></option>
                            <?endif;?>
                        <?endforeach; ?>
                    </select>
                </td>

            </tr>
            </div>
        </table>
        <input type="submit" class="btn btn-success" value="Сохранить">

    </form>

