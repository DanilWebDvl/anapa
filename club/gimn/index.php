<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Гимн волейбольного клуба «Динамо-Анапа»");
$APPLICATION->SetTitle("Гимн");
?>
<div class="container_ui def_pt_page">
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "voleigrad",
        Array(
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "left",
            "DELAY" => "N",
            "MAX_LEVEL" => "1",
            "MENU_CACHE_GET_VARS" => array(""),
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "ROOT_MENU_TYPE" => "inner",
            "USE_EXT" => "N"
        )
    );
    ?>
</div>
<div class="container_content">
<?$APPLICATION->IncludeComponent(
	"bitrix:player", 
	".default", 
	array(
		"ADVANCED_MODE_SETTINGS" => "N",
		"AUTOSTART" => "N",
		"AUTOSTART_ON_SCROLL" => "N",
		"MUTE" => "N",
		"PATH" => "/upload/medialibrary/1fe/zvzn8kzv74oktpziqyzb7juhlehox64m.mp4",
		"PLAYBACK_RATE" => "1",
		"PLAYER_ID" => "",
		"PLAYER_TYPE" => "auto",
		"PRELOAD" => "Y",
		"REPEAT" => "none",
		"SHOW_CONTROLS" => "Y",
		"SIZE_TYPE" => "absolute",
		"SKIN" => "",
		"SKIN_PATH" => "/bitrix/js/fileman/player/videojs/skins",
		"START_TIME" => "0",
		"VOLUME" => "90",
		"COMPONENT_TEMPLATE" => ".default",
		"WIDTH" => "800",
		"HEIGHT" => "600"
	),
	false
);?>
<br>
<h2>Текст гимна</h2>

ОЛЕ-ОЛЕ, МЫ НА ВОЛЕЙБОЛЕ!<br>
 <br>
 Горы - дают нам силу,<br>
 Солнце - даёт нам страсть!<br>
 Море - бушует красиво!<br>
 Болельщик не даст упасть!<br>
 <br>
 Динамо-Анапа, все по протоколу:<br>
 Сегодня на поляне акулы волейбола.<br>
 Динамо-Анапа слышишь из колонок,<br>
 Призывает хлопать наш ловкий Акуленок.<br>
 <br>
 О-ле, о-ле, мы на волейболе!<br>
 О-ле, о-ле, Анапа победит.<br>
 О-ле, о-ле, команда в сборе!<br>
 О-ле, о-ле, Акуленок ловит бит.<br>
 <br>
 Динамо-Анапа, мы идем к победе!<br>
 Болеют за команду и взрослые и дети.<br>
 Динамо-Анапа: море по колено,<br>
 Если наш болельщик на Волейград Арене!<br>
 <br>
 Автор слов: Екатерина Макрогузова @makromuza, Андрей Дущенко<br>
Автор музыки: Никита Лободин @nikitalobodi
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>