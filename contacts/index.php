<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<main>
    <div class="container_content">
        <section class="page_contacts_place def_pt_page">
            <div class="parts_contact_place">
                <div class="part_contact">
                    <span class="name_part">Телефон: </span>
                    <span class="value_part"><a href="tel:88002224752">8 (800) 222-47-52</a></span>
                </div>
                <div class="part_contact">
                    <span class="name_part">Факс:</span>
                    <span class="value_part"><a href="tel:74956427071">+7 (495) 642-70-71</a></span>
                </div>
                <div class="part_contact">
                    <span class="name_part">Электронная почта:</span>
                    <span class="value_part"><a href="mailto:office@vcdm-anapa.ru">office@vcdm-anapa.ru</a></span>
                </div>
                <div class="part_contact">
                    <span class="name_part">Пресс-служба:</span>
                    <span class="value_part"><a href="mailto:info@vcdm-anapa.ru">info@vcdm-anapa.ru</a></span>
                </div>
                <div class="part_contact">
                    <span class="name_part">Юридический адрес:</span>
                    <span class="value_part">125167, Москва, Ленинградский проспект, дом 36, 3 этаж, помещение № 198</span>
                </div>
                <div class="part_contact">
                    <span class="name_part">Фактический адрес:</span>
                    <span class="value_part">Краснодарский край, г. Анапа, просп. Южный, д. 5</span>
                </div>
            </div>
        </section>
        <section class="map_place">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A48c0e58d233f4e94f7923efcbdb048fadbebd96f87b60699e1f60b44e70d914b&amp;height=455&amp;lang=ru_RU&amp;scroll=true"></script>
        </section>
    </div>
</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>