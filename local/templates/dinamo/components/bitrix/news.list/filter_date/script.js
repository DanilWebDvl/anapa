$(document).ready(function () {
    $('body').on('change', '.filter_burger .checkbox input', function () {

        let arYear = [], arMonth = [], data = {};
        $('.filter_burger .checkbox input').each(function (index, node) {

            if ($(node).attr('name') === 'year' && $(node).is(":checked")) {
                arYear.push($(node).attr('value'));
            }
            if ($(node).attr('name') === 'month' && $(node).is(":checked")) {
                arMonth.push($(node).attr('value'));
            }

        });

        if (arYear.length > 0) {
            data.year = arYear.join()
        }

        if (arMonth.length > 0) {
            data.month = arMonth.join()
        }

        $.ajax({
            url: document.location.href,
            method: 'GET',
            data: data,
            success: (result) => {
                html = $(result).find('.js_page_filtrable').html();
                $('body').find('.js_page_filtrable').html(html);
            },
            error: (jqXHR, textStatus, errorThrown) => {

            },
        });

    });
});