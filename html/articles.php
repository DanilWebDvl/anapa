<? include 'header.php'?>
<? include 'main_banner.php'?>
<? setTitle('Статьи'); ?>
    <main>
        <section class="page_articles_place def_pt_page">
            <div class="container_ui">
                <? include 'filter_news.php'?>
                <div class="pager_cards_list flex mt60">
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
                <? include 'pagination.php'?>
            </div>
        </section>
    </main>
<? include 'footer.php'?>