<? include 'header.php'?>
<? include 'main_banner.php'?>
<? setTitle('Новости'); ?>
<main>
    <section class="page_news_place def_pt_page">
        <div class="container_ui">
            <? include 'filter_news.php'?>
            <div class="match_results_place calendar_slider_place mb100">
                <div class="match_results_list flex">
                    <? for ($i = 0; $i < 3; $i++): ?>
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
            <div class="pager_cards_list flex">
                <? for ($i = 0; $i < 12; $i++): ?>
                    <div class="pager_card pos-rel">
                        <picture><img src="img/sport2.jpg" alt=""></picture>
                        <div class="text-place flex flex-bottom smooth_back color_line sky">
                        <span class="content-slide">
                            <p class="link"><a href="article.php">Тут какое-то описание видео в две строки максимум...</a></p>
                            <div class="flex flex-between flex-a-center">
                                <p class="data">28.06.2022</p>
                            </div>
                            <p>Хайлайты с матча</p>
                        </span>
                        </div>
                    </div>
                <? endfor; ?>
            </div>
        </div>
    </section>
</main>
<? include 'footer.php'?>