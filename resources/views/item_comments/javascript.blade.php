<script type="application/javascript">

    //コメント一覧ページネーションクリック時処理
    function commentPageChange(page) {

        $("#comment_table").empty();
        $("#comment_table").append("<span class=\"loading\">{{ __('読み込み中') }}<span></span></span>");

        $.ajax({
            url: './{{$key}}/comments?page=' + page,
            type: "GET"
        }).done(function (response_data) {
            if (response_data.indexOf('<!-- Comment End -->') != -1) {
                $("#comment_wrap").empty();
                $("#comment_wrap").append(response_data);
                var params = getParameter();
                params['page'] = page;
                window.history.replaceState(null, null, setParameter(params));
            }
        }).fail(function () {
            alert("コメントの取得に失敗しました。");
        });

    };
    //コメント一覧bottomページネーションクリック時にtopページネーションへスクロール
    $(document).on("click", "#pagination_bottom li.page-item a.page-link", function () {
        $('html,body').animate({ scrollTop: $("#pagination_top").get(0).offsetTop }, 'fast');
    });

</script>