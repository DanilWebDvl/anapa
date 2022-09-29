function handlePager(sender, navNum, appendItems) {
    var $sender = $(sender);
    $.ajax({
        method: "POST",
        data: {"navNum": navNum},
        url: $sender.attr("href"),
        dataType: "json"
    }).done(function (data) {
        $(".pagen" + navNum).html(data.pagen);
        var $items = $(".items" + navNum);

        if (appendItems) {
            $items.append(data.items);
        } else {
            $items.html(data.items);

            $([document.documentElement, document.body]).animate({
                scrollTop: $items.offset().top - $("header").offset().top
            }, 500);
        }

        $items.trigger("paginate");
    });
}