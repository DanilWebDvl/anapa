<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("all"=>" "));

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("CP_BMS_IBLOCK_TYPE"),
			"TYPE"=>"LIST",
			"VALUES"=>$arTypesEx,
			"DEFAULT"=>"catalog",
			"ADDITIONAL_VALUES"=>"N",
			"REFRESH" => "Y",
		),
		"IBLOCK_ID_PHOTO" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("IBLOCK_ID_PHOTO"),
			"TYPE"=>"STRING"
		),
		"IBLOCK_ID_VIDEO" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("IBLOCK_ID_VIDEO"),
			"TYPE"=>"STRING"
		),
		"PAGER_LINK" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("PAGER_LINK"),
			"TYPE"=>"STRING"
		),
		"PAGER_TITLE" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("PAGER_TITLE"),
			"TYPE"=>"STRING"
		),
		"TITLE_BLOCK" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("TITLE_BLOCK"),
			"TYPE"=>"STRING"
		),
	),
);
?>
