<?php


namespace Module\Project\Controller;

use Bitrix\Main\Engine\Controller,
    Module\Project\FavoriteTable,
    Bitrix\Main\Loader;

class Reviews extends Controller
{

    /**
     * @return array
     */
    public function configureActions()
    {
        return [
            'toggleLike' => ['prefilters' => []],
            'listLike' => ['prefilters' => []]
        ];
    }

    /**
     * Получаем число просмотров
     */
    public function getViewCount($iblockId, $elementId)
    {
        $result = false;
        // подключение модуля инфоблоков
        Loader::includeModule('iblock');
        if (!empty($iblockId) && !empty($elementId)) {
            $iblock = \Bitrix\Iblock::wakeUp($iblockId)->getEntityDataClass();
            // объект элемента
            /** @var \Bitrix\Iblock\Elements\EO_ElementLink $element */
            $element = $iblock::getByPrimary($elementId)->fetchObject();
            $result = $element->getShowCounter();
        }

        return $result;
    }


    public function toggleLikeAction($elementId, $count)
    {
        $elementId = intval($elementId);

        return FavoriteTable::toggleFavorite($elementId, $count);
    }

    /**
     * @return array
     * @throws \Bitrix\Main\ArgumentException
     */
    public function listLikeAction()
    {
        return FavoriteTable::getByUser();
    }


}