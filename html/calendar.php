<? include 'header.php'?>
<? include 'main_banner.php'?>
<? setTitle('Календарь'); ?>
<main>
    <section class="page_calendar_place def_pt_page">
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
                <div class="table_place calendar_table">
                    <div class="table_scroll">
                        <div class="table">
                            <div class="header_table">
                                <div class="part">Июнь</div>
                            </div>
                            <div class="body_table">
                                <? for ($i = 0; $i < 3; $i++): ?>
                                    <div class="row_table">
                                        <div class="part_small text_center black"><?=$i + 9 ?></div>
                                        <div class="part_full with_img">
                                            <span class="text_right">Динамо-АК Барс Динамо-АК</span>
                                            <span><img src="img/team.png" alt=""></span>
                                            <span class="text_center">– : –</span>
                                            <span><img src="img/team.png" alt=""></span>
                                            <span>Динамо-АК Барс</span>
                                        </div>
                                        <div class="part">Премьер-лига</div>
                                        <div class="part">«Волей Град»</div>
                                    </div>
                                <? endfor ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table_place calendar_table mt60">
                    <div class="table_scroll">
                        <div class="table">
                            <div class="header_table">
                                <div class="part">Июль</div>
                            </div>
                            <div class="body_table">
                                <? for ($i = 0; $i < 3; $i++): ?>
                                    <div class="row_table">
                                        <div class="part_small text_center black"><?=$i + 9 ?></div>
                                        <div class="part_full with_img">
                                            <span class="text_right">Уралочка-НТМК</span>
                                            <span><img src="img/team.png" alt=""></span>
                                            <span class="text_center">– : –</span>
                                            <span><img src="img/team.png" alt=""></span>
                                            <span>Динамо (Краснодар)</span>
                                        </div>
                                        <div class="part">Премьер-лига</div>
                                        <div class="part">«Волей Град»</div>
                                    </div>
                                <? endfor ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table_place calendar_table mt60">
                    <div class="table_scroll">
                        <div class="table">
                            <div class="header_table">
                                <div class="part">Август</div>
                            </div>
                            <div class="body_table">
                                <? for ($i = 0; $i < 3; $i++): ?>
                                    <div class="row_table">
                                        <div class="part_small text_center black"><?=$i + 9 ?></div>
                                        <div class="part_full with_img">
                                            <span class="text_right">Динамо-АК Барс Динамо-АК</span>
                                            <span><img src="img/team.png" alt=""></span>
                                            <span class="text_center">– : –</span>
                                            <span><img src="img/team.png" alt=""></span>
                                            <span>Динамо-АК Барс</span>
                                        </div>
                                        <div class="part">Премьер-лига</div>
                                        <div class="part">«Волей Град»</div>
                                    </div>
                                <? endfor ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table_place calendar_table mt60">
                    <div class="table_scroll">
                        <div class="table">
                            <div class="header_table">
                                <div class="part">Сентябрь</div>
                            </div>
                            <div class="body_table">
                                <? for ($i = 0; $i < 3; $i++): ?>
                                    <div class="row_table">
                                        <div class="part_small text_center black"><?=$i + 9 ?></div>
                                        <div class="part_full with_img">
                                            <span class="text_right">Ленинградка</span>
                                            <span><img src="img/team.png" alt=""></span>
                                            <span class="text_center">– : –</span>
                                            <span><img src="img/team.png" alt=""></span>
                                            <span>Тулица</span>
                                        </div>
                                        <div class="part">Премьер-лига</div>
                                        <div class="part">«Волей Град»</div>
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