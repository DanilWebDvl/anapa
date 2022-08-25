<?
namespace Module\Project\Handlers;

use Bitrix\Main\EventManager;

class Events
{
    public static function initEvents()
    {
        $eventManager = EventManager::getInstance();

        $eventManager->addEventHandler("iblock", "OnBeforeIBlockElementUpdate", '\Module\Project\Handlers\Iblock::beforeSaveElement');
        $eventManager->addEventHandler("iblock", "OnBeforeIBlockElementAdd", '\Module\Project\Handlers\Iblock::beforeSaveElement');
    }
}
?>