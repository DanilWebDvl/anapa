<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Динамо");
include $_SERVER['DOCUMENT_ROOT'] . 'filters.php';
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "main_slider",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array("", ""),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => Module\Project\Helpers\Utils::getIdByCode('mainslider'),
        "IBLOCK_TYPE" => "public",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "20",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array("LINK", "*"),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "SORT",
        "SORT_BY2" => "ID",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N"
    )
);?>
<?$APPLICATION->IncludeComponent(
    "custom:last.season",
    "",
    Array(
        "IBLOCK_ID" => Module\Project\Helpers\Utils::getIdByCode('calendar'),
        "IBLOCK_TYPE" => "teams",
        "TEMPLATE_NAME" => "main_calendar",
        "SORT_BY" => "PROPERTY_DATE",
        "SORT_ORDER" => "DESC"
    )
);?>

    <section class="news_slider_place">
        <div class="container_ui">
            <h2 class="title_block mb60">Новости</h2>
        </div>
        <div class="slider_multiple_2 owl-carousel">
            <? for ($i = 0; $i < 5; $i++): ?>
                <a class="news" href="">
                    <picture>
                        <img src="<?=SITE_TEMPLATE_PATH ?>/img/image.png" alt="">
                    </picture>
                    <span class="text-place flex flex-bottom smooth_back">
                    <span class="content-slide">
                        <p class="part">Начинается аккредитация СМИ на матч «Динамо» — «Ростов» 5</p>
                        <p class="data">28.06.2022</p>
                    </span>
                </span>
                </a>
            <? endfor ?>
        </div>
        <div class="container_ui container_without_p">
            <div class="nav_by_slider nav_by_slider_2"></div>
            <div class="right-btn btn_with_arrows">
                <a href="" class="btn_link">ВСЕ НОВОСТИ</a>
            </div>
        </div>
    </section>
    <section class="tournament_place def_mt pos-rel">
        <div class="b_waves near_both mob_show"></div>
        <div class="container_ui">
            <div class="flex flex-between flex-tournament">
                <div class="table_place">
                    <h2 class="title_block">Турнирная таблица</h2>
                    <div class="table_scroll">
                        <div class="table">
                            <div class="header_table">
                                <div class="part">Место</div>
                                <div class="part"></div>
                                <div class="part_full">Команда</div>
                                <div class="part">И</div>
                                <div class="part">В</div>
                                <div class="part">О</div>
                                <div class="part">П</div>
                                <div class="part">Сеты</div>
                            </div>
                            <div class="body_table">
                                <? for ($i = 0; $i < 9; $i++): ?>
                                    <div class="row_table">
                                        <div class="part black">1</div>
                                        <div class="part with_img">
                                            <img src="<?=SITE_TEMPLATE_PATH ?>/img/ico/i-d.png" alt="">
                                        </div>
                                        <div class="part_full">
                                            <span>Динамо-АК Барс</span>
                                        </div>
                                        <div class="part">26</div>
                                        <div class="part">33</div>
                                        <div class="part">44</div>
                                        <div class="part">1</div>
                                        <div class="part">78-83</div>
                                    </div>
                                <? endfor ?>
                            </div>
                        </div>
                    </div>
                    <div class="full-btn">
                        <a href="" class="btn_link">ПОКАЗАТЬ ВСЕ</a>
                    </div>
                </div>
                <div class="leader_place">
                    <h2 class="title_block">Игрок месяца</h2>
                    <div class="big_card card_sport">
                        <div class="img_with_wave">
                            <img src="<?=SITE_TEMPLATE_PATH ?>/img/woman.png" alt="">
                        </div>
                        <div class="info_card">
                            <div class="num">
                                71
                            </div>
                            <div class="more_info">
                                <p class="name">Татьяна Дмитриевна</p>
                                <p class="role">Пасующая</p>
                                <p class="birth_title">Дата рождения</p>
                                <p class="birth">28.03.2001</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="team_place def_mt pos-rel">
        <div class="container_ui">
            <h2 class="title_block mb60">Команда</h2>
        </div>
        <div class="b_waves near_both"></div>
        <div class="slider_team_place">
            <div class="slider_multiple_team owl-carousel">
                <? for ($i = 0; $i < 7; $i++): ?>
                    <div class="player">
                        <div class="card_sport">
                            <div class="img_with_wave">
                                <p class="num">8</p>
                                <img src="<?=SITE_TEMPLATE_PATH ?>/img/wonam-m.png" alt="">
                                <div class="b-wave"></div>
                            </div>
                        </div>
                        <div class="data_player">
                            <p class="name">МАРИЯ ХОЛЕЦКАЯ</p>
                            <p class="role">Пасующая</p>
                        </div>
                    </div>
                <? endfor ?>
            </div>
        </div>
        <div class="container_ui">
            <div class="nav_by_slider nav_by_slider_team"></div>
            <div class="right-btn btn_with_arrows">
                <a href="" class="btn_link">ВСЯ КОМАНДА</a>
            </div>
        </div>
    </section>
    <section class="media_place def_mt">
        <div class="container_ui">
            <h2 class="title_block mb60">Медиа</h2>
            <div class="slide_media_place">
                <div class="single_slider_media owl-carousel mob_hide">
                    <? for ($i = 0; $i < 4; $i++): ?>
                        <div class="news_part flex">

                            <div class="side_2 part color_line pink pos-rel">
                                <picture><img src="<?=SITE_TEMPLATE_PATH ?>/img/sport.jpg" alt=""></picture>
                                <div class="text-place flex flex-bottom smooth_back">
                                <span class="content-slide">
                                    <p class="link"><a href="" >Начинается аккредитация СМИ на матч «Динамо» — «Ростов»</a></p>
                                    <div class="flex flex-between flex-a-center">
                                        <p class="data">28.06.2022</p>
                                        <p class="num with_bac">235</p>
                                    </div>
                                </span>
                                </div>
                            </div>
                            <div class="side_1 flex middle_part part">
                                <div class="m_part color_line pink pos-rel">
                                    <picture><img src="<?=SITE_TEMPLATE_PATH ?>/img/sport.jpg" alt=""></picture>
                                    <div class="text-place flex flex-bottom smooth_back">
                                <span class="content-slide">
                                    <p class="link"><a href="">Начинается аккредитация СМИ на матч «Динамо» — «Ростов»</a></p>
                                    <div class="flex flex-between flex-a-center">
                                        <p class="data">28.06.2022</p>
                                    </div>
                                </span>
                                    </div>
                                </div>
                                <div class="m_part color_line pink pos-rel">
                                    <picture><img src="<?=SITE_TEMPLATE_PATH ?>/img/sport.jpg" alt=""></picture>
                                    <div class="text-place flex flex-bottom smooth_back">
                                <span class="content-slide">
                                    <p class="link"><a href="">Начинается аккредитация СМИ на матч «Динамо» — «Ростов»</a></p>
                                    <div class="flex flex-between flex-a-center">
                                        <p class="data">28.06.2022</p>
                                    </div>
                                </span>
                                    </div>
                                </div>
                                <div class="m_part color_line pink pos-rel">
                                    <picture><img src="<?=SITE_TEMPLATE_PATH ?>/img/sport.jpg" alt=""></picture>
                                    <div class="text-place flex flex-bottom smooth_back">
                                <span class="content-slide">
                                    <p class="link"><a href="">Начинается аккредитация СМИ на матч «Динамо» — «Ростов»</a></p>
                                    <div class="flex flex-between flex-a-center">
                                        <p class="data">28.06.2022</p>
                                    </div>
                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="side_3 part color_line blue pos-rel">
                                <picture class="video_ico"><img src="<?=SITE_TEMPLATE_PATH ?>/img/sport.jpg" alt=""></picture>
                                <div class="text-place flex flex-bottom smooth_back">
                                <span class="content-slide">
                                    <p class="link"><a href="">Начинается аккредитация СМИ на матч «Динамо» — «Ростов»</a></p>
                                    <div class="flex flex-between flex-a-center">
                                        <p class="data">28.06.2022</p>
                                    </div>
                                </span>
                                </div>
                            </div>

                        </div>
                    <? endfor ?>
                </div>
                <div class="mob_show">
                    <div class="media_mob_list">
                        <div class="part color_line pink pos-rel news_part">
                            <p class="num with_bac mob_show">235</p>
                            <picture><img src="<?=SITE_TEMPLATE_PATH ?>/img/sport.jpg" alt=""></picture>
                            <div class="text-place flex flex-bottom smooth_back">
                        <span class="content-slide">
                            <p class="link"><a href="">Начинается аккредитация СМИ на матч «Динамо» — «Ростов»</a></p>
                            <div class="flex flex-between flex-a-center">
                                <p class="data">28.06.2022</p>
                                <p class="num mob_hide">235</p>
                            </div>
                        </span>
                            </div>
                        </div>
                        <div class="part color_line pink pos-rel news_part">
                            <p class="num with_bac mob_show">235</p>
                            <picture><img src="<?=SITE_TEMPLATE_PATH ?>/img/sport.jpg" alt=""></picture>
                            <div class="text-place flex flex-bottom smooth_back">
                        <span class="content-slide">
                            <p class="link"><a href="">Начинается аккредитация СМИ на матч «Динамо» — «Ростов»</a></p>
                            <div class="flex flex-between flex-a-center">
                                <p class="data">28.06.2022</p>
                                <p class="num mob_hide">235</p>
                            </div>
                        </span>
                            </div>
                        </div>
                        <div class="part color_line blue pos-rel news_part">
                            <picture class="video_ico"><img src="<?=SITE_TEMPLATE_PATH ?>/img/sport.jpg" alt=""></picture>
                            <div class="text-place flex flex-bottom smooth_back">
                        <span class="content-slide">
                            <p class="link"><a href="">Начинается аккредитация СМИ на матч «Динамо» — «Ростов»</a></p>
                            <div class="flex flex-between flex-a-center">
                                <p class="data">28.06.2022</p>
                                <p class="num mob_hide">235</p>
                            </div>
                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container_ui container_without_p">
                    <div class="nav_by_slider nav_by_slider_media"></div>
                    <div class="right-btn btn_with_arrows">
                        <a href="" class="btn_link">ВСЕ МЕДИА</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>