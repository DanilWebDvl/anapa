<? include 'header.php'?>
<? include 'main_banner.php'?>
<? setTitle('Турнирная таблица'); ?>
<main>
    <section class="page_tournament_place def_pt_page">
        <div class="container_ui flex double_side">
            <div class="left-side">
                <div class="filter_left">
                    <div class="filter_part active">
                        <a href="">Cезон 21/22</a>
                    </div>
                    <div class="filter_part">
                        <a href="">Cезон 20/21</a>
                    </div>
                    <div class="filter_part">
                        <a href="">Cезон 19/20</a>
                    </div>
                </div>
            </div>
            <div class="right-side">
                <div class="table_place">
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
                                        <div class="part black"><?=$i + 1 ?></div>
                                        <div class="part with_img">
                                            <img src="img/team.png" alt="">
                                        </div>
                                        <div class="part_full">
                                            <span>Локомотив-2 СШОР</span>
                                        </div>
                                        <div class="part">0</div>
                                        <div class="part">0</div>
                                        <div class="part">0</div>
                                        <div class="part">0</div>
                                        <div class="part">0-0</div>
                                    </div>
                                <? endfor ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<? include 'footer.php'?>