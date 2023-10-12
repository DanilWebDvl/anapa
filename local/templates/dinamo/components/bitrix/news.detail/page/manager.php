<div class="sb_share"></div>
<section class="page_club_place def_pt_page">
    <div class="container_ui container_content">
        <div class="flex sponsor_list">

            <div class="part flex flex-between">
                <div class="data_sponsor">
                    <? if (!empty($arResult['PROPERTIES']['TITLE_1']['VALUE'])): ?>
                        <p class="title_sponsor"><?= $arResult['PROPERTIES']['TITLE_1']['VALUE'] ?></p>
                    <? endif ?>
                    <div class="content_sponsor">
                        <? if (!empty($arResult['PROPERTIES']['TEXT_1']['~VALUE']['TEXT'])): ?>
                            <p><b><?= $arResult['PROPERTIES']['TEXT_1']['~VALUE']['TEXT'] ?></b></p>
                        <? endif ?>
                        <? if (!empty($arResult['PROPERTIES']['QUOTE_1']['VALUE'])): ?>
                            <blockquote><?= $arResult['PROPERTIES']['QUOTE_1']['~VALUE']['TEXT'] ?></blockquote>
                        <? endif ?>
                    </div>
                </div>
                <? if (!empty($arResult['PREVIEW_PICTURE']['SRC'])): ?>
                    <div class="card_sport in_club big_card">
                        <div class="img_with_wave">
                            <div class="block"></div>
                            <img src="<?=CFile::ResizeImageGet($arResult['PREVIEW_PICTURE'], ['width' => 340, 'height' => 430])['src'] ?>" alt="<?=$arResult['PREVIEW_PICTURE']['ALT'] ?>">
                            <div class="b-wave"></div>
                        </div>
                    </div>
                <? endif ?>
            </div>

        </div>
        <? if (!empty($arResult['PROPERTIES']['ACHIV_TITLE']['VALUE'])): ?>
            <div>
                <h2>Достижения</h2>
                <div class="list_owner_data flex">
                    <div class="tabs_place">
                        <? foreach ($arResult['PROPERTIES']['ACHIV_TITLE']['VALUE'] as $key_ti => $achiv_title): ?>
                            <div><p class="tab js_tab<?=$key_ti == 0 ? ' active' : '' ?>" data-tab="<?=$key_ti + 1 ?>"><?=$achiv_title ?></p></div>
                        <? endforeach; ?>
                    </div>
                    <div class="tabs_content_place">
                        <? foreach ($arResult['PROPERTIES']['ACHIV_TEXT']['~VALUE'] as $key_tx => $achiv_text): ?>
                            <div class="tab_content js_tab_content<?=$key_tx == 0 ? ' active' : '' ?>" data-tab-content="<?=$key_tx + 1 ?>">
                                <?=$achiv_text['TEXT'] ?>
                            </div>
                        <? endforeach; ?>
                    </div>
                </div>
            </div>
        <? endif ?>
    </div>
</section>