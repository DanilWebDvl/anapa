<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Context;
use Bitrix\Main\Loader;

Loader::includeModule('module.project');
$docRoot = Context::getCurrent()->getServer()->getDocumentRoot();

if(file_exists($docRoot .'/local/php_interface/sb_tool/init.php')){
    include $docRoot .'/local/php_interface/sb_tool/init.php';
}

//Подключаем глобальные константы проекта
if (file_exists($docRoot . '/local/php_interface/include/define.php')) {
    require_once $docRoot . '/local/php_interface/include/define.php';
}

function initParser() {
    $parser = new \Module\Project\Parser\SaveVolley();
    $parser->parse();

    return "initParser();";
}
?>