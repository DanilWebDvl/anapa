<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global \CMain $APPLICATION */
/** @global \CUser $USER */
/** @global \CDatabase $DB */
/** @var \CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var array $templateData */
/** @var \CBitrixComponent $component */
$this->setFrameMode(true);

$itemsAll = $arResult['ITEMS_REFORMAT'];
$itemsLimited = array_slice($itemsAll, 0, $arParams['MAX_ELEMENT_COUNT']);
$itemsHidden = array_slice($itemsAll, $arParams['MAX_ELEMENT_COUNT']);


?>
<? if (!empty($arResult['ITEMS_REFORMAT'])): ?>
    <section class="tournament_place def_mt pos-rel">
        <div class="b_waves near_both mob_show"></div>
        <div class="container_ui">

            <div class="flex flex-between flex-tournament">
                <div class="table_place">
                    <h2 class="title_block"><?= $arParams['TITLE_BLOCK'] ?></h2>
                    <div class="table_scroll">
                        <div class="table">
                            <div class="header_table">
                                <div class="part">Место</div>
                                <div class="part"></div>
                                <div class="part_full">Команда</div>
                                <div class="part">И</div>
                                <div class="part">В</div>
                                <div class="part">П</div>
                                <div class="part">О</div>
                                <div class="part">Сеты</div>
                            </div>
                            <div class="body_table">
                                <?
                                $sb_inc = 1;
                                ?>
                                <? foreach ($itemsLimited as $arItem): ?>
                                    <div class="row_table">
                                        <div class="part black"><?= $arItem['PROPERTIES']['PLACE']['VALUE'] ?></div>
                                        <div class="part with_img">
                                            <img src="<?= $arItem['TEAM']['ICO'] ?>" alt="">
                                        </div>
                                        <div class="part_full">
                                            <span><?= $arItem['TEAM']['NAME'] ?></span>
                                        </div>
                                        <div class="part"><?= $arItem['PROPERTIES']['I']['VALUE'] ?></div>
                                        <div class="part"><?= $arItem['PROPERTIES']['B']['VALUE'] ?></div>
                                        <div class="part"><?= $arItem['PROPERTIES']['P']['VALUE'] ?></div>
                                        <div class="part"><?= $arItem['PROPERTIES']['O']['VALUE'] ?></div>
                                        <div class="part"><?= $arItem['PROPERTIES']['SET']['VALUE'] ?></div>
                                    </div>
                                <?if($sb_inc == $arParams['MAX_ELEMENT_COUNT']){
                                    break;
                                    }
                                    $sb_inc++;?>
                                <? endforeach; ?>
                                <div id="more-items-container"></div>

                            </div>
                        </div>
                    </div>
                    <script>
                        window.moreItems = <?= json_encode($itemsHidden, JSON_UNESCAPED_UNICODE) ?>;
                    </script>

                    <? if ($arParams['PAGER_SHOW_ALL'] == 'Y' && count($itemsHidden) > 0): ?>
                        <div class="full-btn">
                            <div class="btn_link" style="cursor: pointer" id="loadMoreBtn"><?= $arParams['PAGER_TITLE'] ?></div>
                        </div>
                    <? endif ?>
                    <script>
                        document.getElementById('loadMoreBtn')?.addEventListener('click', function() {
                            const container = document.getElementById('more-items-container');

                            window.moreItems.forEach(item => {
                                const row = document.createElement('div');
                            row.className = 'row_table';
                            row.innerHTML = `
            <div class="part black">${item.PROPERTIES.PLACE.VALUE}</div>
            <div class="part with_img"><img src="${item.TEAM.ICO}" alt=""></div>
            <div class="part_full"><span>${item.TEAM.NAME}</span></div>
            <div class="part">${item.PROPERTIES.I.VALUE}</div>
            <div class="part">${item.PROPERTIES.B.VALUE}</div>
            <div class="part">${item.PROPERTIES.P.VALUE}</div>
            <div class="part">${item.PROPERTIES.O.VALUE}</div>
            <div class="part">${item.PROPERTIES.SET.VALUE}</div>
        `;
                            container.appendChild(row);
                        });

                            this.remove(); // скрываем кнопку после подгрузки
                        });
                    </script>

                </div>
            </div>
        </div>
    </section>
<? endif; ?>