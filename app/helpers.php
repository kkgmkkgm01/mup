<?php
if (! function_exists('my_is_current_controller')) {
    /**
     * 現在のコントローラ名が、複数の名前のどれかに一致するかどうかを判別する
     *
     * @param  array $names コントローラ名 (可変長引数)
     * @return bool
     */
    function my_is_current_controller(...$names)
    {
        $current = explode('.', Route::currentRouteName())[0];
        return in_array($current, $names, true);
    }

    function random($length = 8)
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }
}


    /**
     * URLパラメータを追加・削除・上書きする関数
     *
     * @param  string $url URL
     * @param  array $par パラメータと値の連想配列
     * @return string パラメータ変更後の関数
     */
    function url_param_change($url, $par=Array()){
        if (substr($url,0,7) == 'http://' || substr($url,0,8) == 'https://') {
        //渡されたURLがhttp://かhttps://から始まる時
        $querystring = $url["query"];
        }else{
        //渡されたURLが上記以外のとき
        $querystring = substr(mb_strstr($url,'?'),1);
        }
        if(isset($querystring)) {
            parse_str($querystring,$query);
        }else{
            $query = Array();
        }
        foreach($par as $key => $value){
            if($key && is_null($value)) unset($query[$key]);
            else $query[$key] = $value;
        }
        $query = str_replace("=&", "&", http_build_query($query));
        $query = preg_replace("/=$/", "", $query);
        $generatestr = strtok($url,'?') . "?" . htmlspecialchars($query, ENT_QUOTES);
        return $generatestr;
    }