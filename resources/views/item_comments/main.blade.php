@php
if ($page == null) {
$page = 1;
}
$pagerhtml="";
if ($item_comments->previousPageUrl() == null) {
$pagerhtml .= "<li class='page-item disabled'><a href='' rel='prev' aria-label='« Previous' class='page-link'>«</a></li>";
} else {
$pagerhtml .= "<li class='page-item'><a href='" . url_param_change("./".basename(preg_replace("/(.*)(\/comments)/", "$1", Request::fullurl())),array("page"=>1)) . "' rel='prev' aria-label='« Previous' class='page-link'
        onclick='commentPageChange(1);return false;'>«</a></li>";
}
if ($item_comments->previousPageUrl() == null) {
$pagerhtml .= "<li class='page-item disabled'><a href='' rel='prev' aria-label='« Previous' class='page-link'>‹</a></li>";
} else {
$pagerhtml .= "<li class='page-item'><a href='" . url_param_change("./".basename(preg_replace("/(.*)(\/comments)/", "$1", Request::fullurl())),array("page"=>($page-1))) . "' rel='prev' aria-label='« Previous' class='page-link'
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
        @for ($i = $paging_start_page; $i < $paging_end_page; $i++)
            @php
            $link_page=$i;
            if ($page==$link_page) {
            $pagerhtml .="<li aria-current='page' class='page-item active'><a href='' onclick='return false;' class='page-link'>".$link_page."</a> </li>";
            } else { 
            $pagerhtml .="<li class='page-item'><a href='" . url_param_change("./".basename(preg_replace("/(.*)(\/comments)/", "$1", Request::fullurl())),array("page"=>$link_page)) . "' onclick='commentPageChange(".$link_page.");return false;' class='page-link'>".$link_page."</a></li>";
            }
            @endphp
            @endfor

            @php
            if ($item_comments->nextPageUrl() == null) {
            $pagerhtml .= "<li class='page-item disabled'><a href='' rel='next' aria-label='Next »' class='page-link'>›</a></li>";
            } else {
            $pagerhtml .= "<li class='page-item'><a href='" . url_param_change("./".basename(preg_replace("/(.*)(\/comments)/", "$1", Request::fullurl())),array("page"=>($page+1))) . "' rel='next' aria-label='Next »' class='page-link'
                    onclick='commentPageChange(" . ($page+1) . ");return false;'>›</a></li>";
            }
            if ($item_comments->nextPageUrl() == null) {
            $pagerhtml .= "<li class='page-item disabled'><a href='' rel='next' aria-label='Next »' class='page-link'>»</a></li>";
            } else {
            $pagerhtml .= "<li class='page-item'><a href='" . url_param_change("./".basename(preg_replace("/(.*)(\/comments)/", "$1", Request::fullurl())),array("page"=>$item_comments->lastPage())) . "' rel='next' aria-label='Next »' class='page-link'
                    onclick='commentPageChange(" . $item_comments->lastPage() . ");return false;'>»</a></li>";
            }
            @endphp


            {{-- このコメントは正常に取得が出来たかどうか判定に使用する為削除しないこと --}}
            <!-- Comment Start -->
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

            {{-- このコメントは正常に取得が出来たかどうか判定に使用する為削除しないこと --}}
            <!-- Comment End -->