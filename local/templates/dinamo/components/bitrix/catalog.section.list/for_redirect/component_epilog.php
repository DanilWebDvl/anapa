<?php
$arResult['SECTIONS'] = array_reverse($arResult['SECTIONS']);
if (!empty($arResult['SECTIONS'][0]['SECTION_PAGE_URL']))
    LocalRedirect($arResult['SECTIONS'][0]['SECTION_PAGE_URL']);