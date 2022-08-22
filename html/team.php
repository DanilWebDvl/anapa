<? include 'header.php'?>
<? include 'main_banner.php'?>
<? setTitle('Команда'); ?>
<main>
    <section class="page_team_place def_pt_page">
        <div class="container_ui">
            <div class="filter_top flex js_team_filter">
                <div class="filter_part active js_part" data-index="0">
                    <span>Игроки</span>
                </div>
                <div class="filter_part js_part" data-index="1">
                    <span>Тренеры</span>
                </div>
                <div class="filter_part js_part" data-index="2">
                    <span>Персонал</span>
                </div>
            </div>
            <? for ($a = 0; $a < 3; $a++): ?>
                <div class="slide_team js_slide_for_top <?=($a == 0) ? 'active' : '' ?>" data-index="<?=$a ?>">
                    <div class="list_team flex">
                        <? for ($i = $a + 1; $i < 29; $i++): ?>
                            <a class="player" data-fancybox data-src="#hidden-content-<?=$i ?>" href="javascript:;">
                                <div class="card_sport">
                                    <div class="img_with_wave">
                                        <p class="num"><?=$i ?></p>
                                        <img src="img/wonam-m.png">
                                        <div class="b-wave"></div>
                                    </div>
                                </div>
                                <div class="data_player">
                                    <p class="name">МАРИЯ ХОЛЕЦКАЯ</p>
                                    <p class="role">Пасующая</p>
                                </div>
                                <div style="display: none;" id="hidden-content-<?=$i ?>" class="hide_card_sport">
                                    <div class="inner_hide_card flex flex-between">
                                        <p class="title mob_show">Тамара Романовна</p>
                                        <div class="flex card_sport_place">
                                            <div class="card_sport">
                                                <div class="img_with_wave only_bot_wave">
                                                    <img src="img/wonam-m.png">
                                                    <div class="b-wave"></div>
                                                </div>
                                            </div>
                                            <div class="data_player_place">
                                                <div class="data_player">
                                                    <p class="role">Диагональная</p>
                                                    <p class="num">№ 25</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="more_data_card">
                                            <p class="title mob_hide">Тамара Романовна</p>
                                            <div class="back_board">
                                                <div class="part_board flex">
                                                    <p class="left">Звание</p>
                                                    <p class="right">Мастер спорта</p>
                                                </div>
                                                <div class="part_board flex">
                                                    <p class="left">Дата рождения</p>
                                                    <p class="right">31.05.2005</p>
                                                </div>
                                                <div class="part_board flex">
                                                    <p class="left">Рост</p>
                                                    <p class="right">195 см</p>
                                                </div>
                                                <div class="part_board flex">
                                                    <p class="left">Хобби</p>
                                                    <p class="right">Компьютерные игры</p>
                                                </div>
                                            </div>
                                            <div class="achievements">
                                                <p class="type">Спортивные достижения</p>
                                                <ul>
                                                    <li>Двукратный бронзовый призёр чемпионата России (2018, 2022)</li>
                                                    <li>Бронзовый призёр Кубка мира (2019)</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <? endfor ?>
                    </div>
                </div>
            <? endfor ?>
        </div>
    </section>
</main>
<? include 'footer.php'?>
