<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("all"=>" "));

$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="all"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("CP_BMS_IBLOCK_TYPE"),
			"TYPE"=>"STRING"
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("CP_BMS_IBLOCK_ID"),
			"TYPE"=>"STRING"
		),
		"TEMPLATE_NAME" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("TEMPLATE_NAME"),
			"TYPE"=>"STRING"
		),
		"SORT_BY" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("SORT_BY"),
			"TYPE"=>"STRING"
		),
		"SORT_ORDER" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("SORT_ORDER"),
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
		"TITLE_BLOCK_2" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("TITLE_BLOCK_2"),
			"TYPE"=>"STRING"
		),
		"PAGER_SHOW_ALL" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("PAGER_SHOW_ALL"),
			"TYPE"=>"STRING"
		),
	),
);
?>
