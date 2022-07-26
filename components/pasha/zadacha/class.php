<?php
if(!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED!==true)die();
class CAddzadacha extends CBitrixComponent

{
    public $componentPage = "";

    function displayTemplate()
    {

        CModule::IncludeModule('iblock');
        $result = CIBlockElement::GetList([], ['IBLOCK_ID' => 1], false, false, ['ID', 'NAME', 'PROPERTY_OPISANIE', 'PROPERTY_SROK', 'PROPERTY_STATUS']);

        $tasks = [];
        while ($element = $result->fetch()) {
            $tasks[$element['ID']] = ['NAME' => $element['NAME'],
                'OPISANIE' => $element['PROPERTY_OPISANIE_VALUE'],
                'SROK' => $element['PROPERTY_SROK_VALUE'],
                'STATUS' => $element['PROPERTY_STATUS_VALUE']];
        }

        $this->arResult['TASKS'] = $tasks;

        $arProperties = [];
        $obEnums = CIBlockPropertyEnum::GetList(array("DEF" => "DESC", "SORT" => "ASC"), array("IBLOCK_ID" => 1));
        while ($arEnum = $obEnums->GetNext()) {
            $arProperties[$arEnum['ID']]=['VALUE'=>$arEnum['VALUE'], 'CODE'=>$arEnum['XML_ID']];
            [$arEnum['ID']] = $arEnum;
            [$arEnum['ID']]=$arEnum['VALUE'];
        }
        $this->arResult['LIST_VALUES']=$arProperties;

    }


    public function delete($id)
    {
        CIBlockElement::Delete($id);

    }
    function accessUser(){
        $arRoles=['ACTIVE'=>"", 'AVAILABLE_STATUS'=>[]];

        global $USER;
        $arGroups = $USER->GetUserGroupArray();
        $sGroupsSep=implode("|", $arGroups);
//        echo "<pre>"; print_r($arGroups); echo "</pre>";

      $arCodeGroup = CGroup::GetList($by = "c_sort", $order = "asc", array("ID" => $sGroupsSep));

       while ($arEnum = $arCodeGroup ->GetNext()) {
          $arTest[$arEnum['ID']]=$arEnum['STRING_ID'];


      }
//        echo "<pre>"; print_r($arTest); echo "</pre>";

        if (in_array("KURATOR", $arTest) || in_array("ADMIN", $arTest)) {
            $arRoles['ACTIVE']="KURATOR";
            $arRoles['AVAILABLE_STATUS']=["ZAVERSHENA", "OTMENENA"];
        }
        if (in_array("PODOPECHNIY", $arTest)) {
            $arRoles['ACTIVE']="PODOPECHNIY";
            $arRoles['AVAILABLE_STATUS']=["COMPLITED", "REJECTED", "PERFORMED"];
        }
        $this->arResult['ROLE']=$arRoles;

    }

    function createElement()
    {
        $el = new CIBlockElement;
        $PROP = array();
        $PROP[1] = $_POST["NAME"];
        $PROP['OPISANIE'] = $_POST['OPISANIE'];
        $PROP['SROK'] = $_POST['SROK'];
        $PROP['STATUS'] = $_POST['STATUS'];
        $arLoadProductArray = array(
            'IBLOCK_ID' => 1,
            "NAME" => $_POST["NAME"],
            "ID" => $_POST["ID"],
            "PROPERTY_VALUES" => $PROP,

        );
        $el->Add($arLoadProductArray);
        $this->notificationEmail();
    }

    function editingStatus($statusID, $elementId)
    {
        CModule::IncludeModule('iblock');


        $PROPERTY_CODE = "STATUS";
        $PROPERTY_VALUE = $statusID;


        CIBlockElement::SetPropertyValuesEx($elementId, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
        $this->notificationEmail();

    }

    function notificationEmail(){

        $PROP[1] = $_POST["NAME"];
        $PROP['OPISANIE'] = $_POST['OPISANIE'];
        $PROP['SROK'] = $_POST['SROK'];
        $PROP['STATUS'] = $_POST['STATUS'];
        $arEventFields = array(
            'IBLOCK_ID' => 1,
            "NAME" => ($_POST["NAME"]),
            "OPISANIE" => ($_POST["OPISANIE"]),
            "SROK" => ($_POST["SROK"]),
            "STATUS" => ($_POST["STATUS"]),
        );
        $this->mailerByAdd($arEventFields);
        $this->mailerByModyfy($arEventFields);

    }
    function mailerByAdd($arEventFields){
        CEvent::Send('MAIL_NOTIFICATION',  's1', $arEventFields, 'N', '11',array());
    }

    function mailerByModyfy($arEventFields){
        CEvent::Send('MAIL_NOTIFICATION',  's1', $arEventFields, 'N', '12',array());
    }

    function Requests()
    {
        $componentPage;

        if (!empty($_REQUEST["iblock_Add"])) {
            $this->componentPage = "template_test";
        }

        if (isset($_REQUEST['ID'])) {
            $this->delete($_REQUEST['ID']);
        }
        if(!empty($_REQUEST["iblock_status"])){
            $this->componentPage = "template_status";
        }
        if (isset($_POST['STATUS'])&&$_POST['form_id']=='Add_status'){
            $this->editingStatus($_POST['STATUS'], $_POST['TASK']);
        }
        if ($_POST['form_id']=='Add_Item'){
            $this->createElement();
        }
    }

    function executeComponent()
    {
        $this->accessUser();
        $this->displayTemplate();
        $this->Requests();
       // $this->createElement();
//        $this->delete($name);
        $this->includeComponentTemplate($this->componentPage);

    }
}



