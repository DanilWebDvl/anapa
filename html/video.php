<? include 'header.php'?>
<? include 'main_banner.php'?>
<? setTitle('Видео'); ?>
    <main>
        <section class="page_interviews_place def_pt_page">
            <div class="container_ui">
                <? include 'filter_media.php'?>
                <div class="pager_cards_list grid">
                    <? for ($i = 0; $i < 6; $i++): ?>
                        <div class="pager_card pos-rel" href="img/Frog.mp4" data-fancybox="gallery">
                            <picture class="video_ico"><img src="img/sport2.jpg" alt=""></picture>
                            <div class="text-place flex flex-bottom smooth_back color_line sky">
                                <span class="content-slide">
                                    <p class="link"><a href="">Тут какое-то описание видео в две строки максимум...</a></p>
                                    <div class="flex flex-between flex-a-center pos-rel">
                                        <p class="data">28.06.2022</p>
                                        <span class="video_ico_mini"></span>
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