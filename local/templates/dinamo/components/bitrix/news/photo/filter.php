<?
global $arrFilterAll;
if (!empty($_GET['year'])) {
    $arYears = explode(',', $_GET['year']);
    $filterYear["LOGIC"] = "OR";
    foreach ($arYears as $year) {
        $filterYear[] = ['=UF_SYS_YEAR' => $year];
    }
}
if (!empty($_GET['month'])) {
    $arMonths = explode(',', $_GET['month']);
    $filterMonth["LOGIC"] = "OR";
    foreach ($arMonths as $month) {
        $filterMonth[] = ['=UF_SYS_MONTH' => $month];
    }
}

$arrFilterAll[] = [
    'LOGIC' => 'AND',
    $filterYear,
    $filterMonth
];
?>