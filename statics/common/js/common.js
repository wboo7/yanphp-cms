$(function () {




    //.pagination ajax
    if ($('a.ajax-pagination').length > 0) {
        $(document).on('click', 'a.ajax-pagination', function (e) {
            e.preventDefault();
            var container = $(this).data('ajax-container');
            var $container = $(container);

            $.ajax({
                url: $(this).attr('href'),
                dataType: 'html',
                type: 'get',
                success: function (c) {
                    var data = '<div>' + c + '</div>';
                    var html = $(data).find(container).html();
                    $container.html(html);
                    lazyLoad();
                }
            });

        });

    }
});