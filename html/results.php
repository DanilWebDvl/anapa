<? include 'header.php'?>
<? include 'main_banner.php'?>
<? setTitle('Результаты'); ?>
    <main>
        <section class="page_results_place def_pt_page">
            <div class="container_ui">
                <? include 'filter_news.php'?>
                <div class="match_results_place calendar_slider_place mb60">
                    <div class="match_results_list flex">
                        <? for ($i = 0; $i < 9; $i++): ?>
                            <div class="card prev">
                                <div class="date_time flex flex-between">
                                    <div class="data_place">
                                        <p><?=$i ?>.07</p>
                                    </div>
                                    <div class="stage">
                                        <p>1/2 ФИНАЛА</p>
                                    </div>
                                    <div class="time_place">
                                        <p>18:00</p>
                                    </div>
                                </div>
                                <div class="vs_place">
                                    <div class="text_center">
                                        <img src="img/ico/i-d.png" alt="">
                                        <p class="desc">Динамо Анапа</p>
                                    </div>
                                    <p class="text_center vs_text">3 : 1</p>
                                    <div class="text_center">
                                        <img src="img/ico/i-a.png" alt="">
                                        <p class="desc">Локомотив Москва</p>
                                    </div>
                                </div>
                            </div>
                        <? endfor; ?>
                    </div>
                </div>
                <? include 'pagination.php'?>
            </div>
        </section>
    </main>
<? include 'footer.php'?>