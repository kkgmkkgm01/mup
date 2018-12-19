<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF トークン --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if (! Request::is('/')){{ $title }} | @endif{{ Config::get('sitesetting.title') }}</title>

    {{-- JS --}}
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

    {{-- CSS --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sticky-footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel sticky-top p-0 ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="topimg" src="{{ asset('img/toplogo.svg') }}" alt="{{ Config::get('sitesetting.title') }}" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- Navbarの左側 --}}
                    <ul class="navbar-nav mr-auto">
                        {{-- 「記事」と「ユーザー」へのリンク --}}
                        <li class="nav-item @if (my_is_current_controller('posts')) bg-green01 @endif">
                            <a class="nav-link d-flex align-items-center @if (my_is_current_controller('posts')) text-white @endif"
                                href="{{ url('posts') }}">
                                {{ __('Posts') }}
                            </a>
                        </li>
                        <li class="nav-item @if (my_is_current_controller('users')) bg-green01 @endif">
                            <a class="nav-link d-flex align-items-center @if (my_is_current_controller('users')) text-white @endif"
                                href="{{ url('users') }}">
                                {{ __('Users') }}
                            </a>
                        </li>
                        <li class="nav-item @if (my_is_current_controller('items')) bg-green01 @endif">
                            <a class="nav-link d-flex align-items-center @if (my_is_current_controller('items')) text-white @endif"
                                href="{{ url('items') }}">
                                {{ __('Items') }}
                            </a>
                        </li>
                    </ul>


                    {{-- Navbarの右側 --}}
                    <ul class="navbar-nav ml-auto">
                        {{-- 投稿ボタン --}}
                        <li class="nav-item">
                            <a href="{{ url('posts/create') }}" id="new-post" class="btn btn-success">
                                {{ __('New Post') }}
                            </a>
                        </li>

                        {{-- 認証関連のリンク --}}
                        @guest
                        {{-- 「ログイン」と「ユーザー登録」へのリンク --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @else
                        {{-- 「プロフィール」と「ログアウト」のドロップダウンメニュー --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-user" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                                <a class="dropdown-item" href="{{ url('users/'.auth()->user()->id) }}">
                                    {{ __('Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{--1カラム表示--}}
        @if (my_is_current_controller('login') || my_is_current_controller('register') ||
        my_is_current_controller('password'))
        <div class="container py-3">

            {{-- フラッシュ・メッセージ --}}
            @if (session('my_status'))
            <div class="container mt-2">
                <div class="alert alert-success">
                    {{ session('my_status') }}
                </div>
            </div>
            @endif

            <main>
                @yield('content')
            </main>
        </div>

        {{--2カラム表示--}}
        @else
        <div class="container py-3">
            <div class="row">
                <div class="col-sm-7">

                        {{-- フラッシュ・メッセージ --}}
                        @if (session('my_status'))
                        <div class="container mt-2">
                            <div class="alert alert-success">
                                {{ session('my_status') }}
                            </div>
                        </div>
                        @endif
            
                    <main>
                        @yield('content')
                    </main>
                </div>
                <div class="col-sm-5">
                    <div class="card sb-card my-3">
                        <div class="card-body">
                            <h4>Recent Comment:</h4>
                            <table class="othergoodslist rowLink[0,1,hover]">

                                <tr>
                                    <td class="othergoodselement ogle1">
                                        <div class="othergoodsthumb">
                                            <div class="othergoodsgenre">
                                                <div class="othergoodsgenrein"><img src="https://detali15.ru/upload/medialibrary/cff/icon-camera.png"
                                                        alt="PS3" /></div>
                                            </div>
                                            <div class="othergoodsthumbin"><img src="https://www.gokurakuyu.ne.jp/uploads/media/2018/04/20180424082708.jpg"
                                                    width="65" height="75" /></div>
                                        </div>
                                    </td>
                                    <td class="othergoodselement ogle2">
                                        <div class="othergoodstitle breakword"><a class="rowLinkTarget" href="#">く遠くのからないじなタダシはいていねえ」「あの姉あねは弟を自分で一本あげるような、いました。その川。</a><br />￥3,100<br />Date
                                            13/06/23<br />Update 13/03/23</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="othergoodsspace" colspan=2>
                                        <div class="othergoodsborder"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="othergoodselement ogle1">
                                        <div class="othergoodsthumb">
                                            <div class="othergoodsgenre">
                                                <div class="othergoodsgenrein"><img src="https://detali15.ru/upload/medialibrary/cff/icon-camera.png"
                                                        alt="XBOX360" /></div>
                                            </div>
                                            <div class="othergoodsthumbin"><img src="https://4.bp.blogspot.com/-LfCwSI0ujRI/WgjwLco_WfI/AAAAAAAADhg/dO7kCvGXR1km6leKVU7eJHkDbeI7vDhGgCLcBGAs/s1600/4b31f83de077bcd06b13959da4de391e_s.jpg"
                                                    width="65" height="75" /></div>
                                        </div>
                                    </td>
                                    <td class="othergoodselement ogle2">
                                        <div class="othergoodstitle breakword"><a class="rowLinkTarget" href="#">時計うで、そっちかくひとりの女の子はすぐに銀河ぎんと水の中で見たことは、ぎざぎざぎざの赤い腕木うで。</a><br />￥3,100<br />Cool<br />Date
                                            13/03/23<br />Update 13/06/23</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="othergoodsspace" colspan=2>
                                        <div class="othergoodsborder"></div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="othergoodselement ogle1">
                                        <div class="othergoodsthumb">
                                            <div class="othergoodsgenre">
                                                <div class="othergoodsgenrein"><img src="https://detali15.ru/upload/medialibrary/cff/icon-camera.png"
                                                        alt="Wii" /></div>
                                            </div>
                                            <div class="othergoodsthumbin"><img src="https://www.fuji-yurari.jp/yrrAdm/wp-content/uploads/2017/11/curry.jpg"
                                                    width="65" height="75" /></div>
                                        </div>
                                    </td>
                                    <td class="othergoodselement ogle2">
                                        <div class="othergoodstitle breakword"><a class="rowLinkTarget" href="#">んなのです。私の義務ぎむだと言いうような約束やく弓ゆみにそのことを考えてふり返かえし、窓から終おわ。</a><br />￥3,100<br />Cool<br />Date
                                            13/03/23<br />Update 13/06/23</div>
                                    </td>
                                </tr>

                            </table>

                        </div>
                    </div>

                    <div class="card sb-card my-3">
                        <div class="card-body">
                            <h4>Popular:</h4>
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                        </div>
                    </div>
                    <div class="card sb-card my-3">
                        <div class="card-body">
                            <h4>Cal Ranking:</h4>
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                        </div>
                    </div>
                    <div class="card sb-card my-3">
                        <div class="card-body">
                            <h4>New:</h4>
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                            aaa<br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <footer class="footer">
            <div class="container-fluid">
                <div class="row bg-dark text-white">
                    <div class="col-md-12 text-center">
                        <span>Copyright ©2017-2018 </span>
                        <a href="#">TestCompany inc,</a>
                    </div>
                </div> <!-- ./row -->
            </div><!-- ./container-fluid-->
        </footer>
    </div>

    {{-- JavaScript --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>