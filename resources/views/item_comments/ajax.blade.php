


<!-- //////////////////////javascriptでDOMの生成をしないようにしたため使用しないことに/////////////////////// -->
<!-- //////////////////////javascriptでDOMの生成をしないようにしたため使用しないことに/////////////////////// -->
<!-- //////////////////////javascriptでDOMの生成をしないようにしたため使用しないことに/////////////////////// -->
<!-- //////////////////////javascriptでDOMの生成をしないようにしたため使用しないことに/////////////////////// -->
<!-- //////////////////////javascriptでDOMの生成をしないようにしたため使用しないことに/////////////////////// -->

<!-- pagenate -->
@php
if ($page == null) {
$page = 1;
}
$pagerhtml="";
if ($item_comments->previousPageUrl() == null) {
$pagerhtml .= "<li class='page-item disabled'><a href='' rel='prev' aria-label='« Previous' class='page-link'>«</a></li>";
} else {
$pagerhtml .= "<li class='page-item'><a href='javascript:void(0)' rel='prev' aria-label='« Previous' class='page-link'
        onclick='commentPageChange(1);return false;'>«</a></li>";
}
if ($item_comments->previousPageUrl() == null) {
$pagerhtml .= "<li class='page-item disabled'><a href='' rel='prev' aria-label='« Previous' class='page-link'>‹</a></li>";
} else {
$pagerhtml .= "<li class='page-item'><a href='javascript:void(0)' rel='prev' aria-label='« Previous' class='page-link'
        onclick='commentPageChange(" . ($page-1) . ");return false;'>‹</a></li>";
}
@endphp

@php
$paging_start_page = $page-2;
if ($paging_start_page-2 < 0) { $paging_start_page=1; } if ($paging_start_page+5> $item_comments->lastPage()) {
    $paging_start_page = $item_comments->lastPage() - 4;
    if($paging_start_page <= 0) { $paging_start_page=1; } } $paging_end_page=$paging_start_page + 5; if
        ($paging_end_page> $item_comments->lastPage()){
        $paging_end_page = $item_comments->lastPage()+1;
        }
        @endphp
        @for ($i = $paging_start_page; $i < $paging_end_page; $i++) @php $link_page=$i; if ($page==$link_page) {
            $pagerhtml .="<li aria-current='page' class='page-item active'><a href='javascript:void(0)' onclick='return false;' class='page-link'>".$link_page."</a></li>";
            } else {
            $pagerhtml .= "<li class='page-item'><a href='javascript:void(0)' onclick='commentPageChange(".$link_page.");return false;'
                    class='page-link'>".$link_page."</a></li>";
            }
            @endphp
            @endfor

            @php
            if ($item_comments->nextPageUrl() == null) {
            $pagerhtml .= "<li class='page-item disabled'><a href='' rel='next' aria-label='Next »' class='page-link'>›</a></li>";
            } else {
            $pagerhtml .= "<li class='page-item'><a href='javascript:void(0)' rel='next' aria-label='Next »' class='page-link'
                    onclick='commentPageChange(" . ($page+1) . ");return false;'>›</a></li>";
            }
            if ($item_comments->nextPageUrl() == null) {
            $pagerhtml .= "<li class='page-item disabled'><a href='' rel='next' aria-label='Next »' class='page-link'>»</a></li>";
            } else {
            $pagerhtml .= "<li class='page-item'><a href='javascript:void(0)' rel='next' aria-label='Next »' class='page-link'
                    onclick='commentPageChange(" . $item_comments->lastPage() . ");return false;'>»</a></li>";
            }
            @endphp

            <ul class="pagination" id="pagination_top">
                @php
                echo $pagerhtml;
                @endphp
            </ul>

            <table class="table table-striped" id="comment_table">
                @foreach ($item_comments as $item_comment)
                <tr>
                    <td>
                        {{ $item_comment->id }}
                    </td>
                    <td>
                        {{ $item_comment->comment }}
                    </td>
                </tr>
                @endforeach
            </table>

            <ul class="pagination" id="pagination_bottom">
                @php
                echo $pagerhtml;
                @endphp
            </ul>

            <script type="application/javascript">

                function commentPageChange(page) {
                    var params = getParameter();
                    params['page'] = page;
                    window.history.replaceState(null, null, setParameter(params));

                    $("#comment_table").empty();
                    $("#comment_table").append("読み込み中...");
                    $.getJSON('./{{$key}}/comments/json?page=' + page, null, function (json) {

                        //グローバルパラメータ
                        var next_page_url = json.next_page_url;
                        var prev_page_url = json.prev_page_url;
                        var last_page = json.last_page;
                        var total = json.total;
                        var per_page = json.per_page;
                        var current_page = json.current_page;

                        $("#comment_table").empty();
                        //テーブル描画
                        for (row in json.data) {
                            var id = json.data[row].id;
                            var comment = json.data[row].comment;

                            $("#comment_table").append("<tr>\
                    <td>"+ id + "</td>\
                    <td>"+ comment + "</td>\
                </tr>");
                        }

                        //ページネーターを描画
                        $("#pagination_top, #pagination_bottom").empty();
                        //Prev 制御
                        if (prev_page_url == null) {
                            $("#pagination_top, #pagination_bottom").append("<li class='page-item disabled'><a href='' rel='prev' aria-label='« Previous' class='page-link'>«</a></li>");
                        } else {
                            $("#pagination_top, #pagination_bottom").append("<li class='page-item'><a href='javascript:void(0)' rel='prev' aria-label='« Previous' class='page-link' onclick='commentPageChange(1);return false;'>«</a></li>");
                        }
                        if (prev_page_url == null) {
                            $("#pagination_top, #pagination_bottom").append("<li class='page-item disabled'><a href='' rel='prev' aria-label='« Previous' class='page-link'>‹</a></li>");
                        } else {
                            $("#pagination_top, #pagination_bottom").append("<li class='page-item'><a href='javascript:void(0)' rel='prev' aria-label='« Previous' class='page-link' onclick='commentPageChange(" + (page - 1) + ");return false;'>‹</a></li>");
                        }

                        //ページリンク
                        paging_start_page = page - 2;
                        if (paging_start_page - 2 < 0) {
                            paging_start_page = 1
                        }
                        if (paging_start_page + 5 > last_page) {
                            paging_start_page = last_page - 4
                            if (paging_start_page <= 0) {
                                paging_start_page = 1
                            }
                        }
                        paging_end_page = paging_start_page + 5;
                        if (paging_end_page > last_page) {
                            paging_end_page = last_page + 1;
                        }
                        for (var i = paging_start_page; i < paging_end_page; i++) {
                            var link_page = i;

                            //activeにするかどうか
                            if (page == link_page) {
                                $("#pagination_top, #pagination_bottom").append("<li aria-current='page' class='page-item active'><a href='javascript:void(0)' onclick='return false;' class='page-link'>" + link_page + "</a></li>");
                            } else {
                                $("#pagination_top, #pagination_bottom").append("<li class='page-item'><a href='javascript:void(0)' onclick='commentPageChange(" + link_page + ");return false;' class='page-link'>" + link_page + "</a></li>");
                            }
                        }

                        //Next制御
                        if (next_page_url == null) {
                            $("#pagination_top, #pagination_bottom").append("<li class='page-item disabled'><a href='' rel='next' aria-label='Next »' class='page-link'>›</a></li>");
                        } else {
                            $("#pagination_top, #pagination_bottom").append("<li class='page-item'><a href='javascript:void(0)' rel='next' aria-label='Next »' class='page-link' onclick='commentPageChange(" + (page + 1) + ");return false;'>›</a></li>");
                        }
                        if (next_page_url == null) {
                            $("#pagination_top, #pagination_bottom").append("<li class='page-item disabled'><a href='' rel='next' aria-label='Next »' class='page-link'>»</a></li>");
                        } else {
                            $("#pagination_top, #pagination_bottom").append("<li class='page-item'><a href='javascript:void(0)' rel='next' aria-label='Next »' class='page-link' onclick='commentPageChange(" + last_page + ");return false;'>»</a></li>");
                        }

                    });
                };
                    //bottomページネーションクリック時にtopページネーションへスクロール
                    $(document).on("click","#pagination_bottom li.page-item a.page-link", function() {
                        $('html,body').animate({ scrollTop: $("#pagination_top").get(0).offsetTop }, 'fast');
                    });


            </script>
