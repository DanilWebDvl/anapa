<?
namespace Module\Project\Handlers;

use Bitrix\Main\EventManager;

class Events
{
    public static function initEvents()
    {
        $eventManager = EventManager::getInstance();

        // element add/update
        $eventManager->addEventHandler("iblock", "OnBeforeIBlockElementUpdate", '\Module\Project\Handlers\Iblock::beforeSaveElement');
        $eventManager->addEventHandler("iblock", "OnBeforeIBlockElementAdd", '\Module\Project\Handlers\Iblock::beforeSaveElement');

        // section add/update
        $eventManager->addEventHandler("iblock", "OnBeforeIBlockSectionUpdate", '\Module\Project\Handlers\Iblock::beforeSaveSection');
        $eventManager->addEventHandler("iblock", "OnBeforeIBlockSectionAdd", '\Module\Project\Handlers\Iblock::beforeSaveSection');
    }
}
?>