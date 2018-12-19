
    /**
     * 現在のURLにパラメータを設定したURLを返却する関数
     * @param {array} paramsArray パラメータが格納された連想配列
     * @return {string}       パラメータを設定したURL
     */
    function setParameter(paramsArray) {
        var resurl = location.href.replace(/\?.*$/, "");
        for (key in paramsArray) {
            resurl += (resurl.indexOf('?') == -1) ? '?' : '&';
            resurl += key + '=' + paramsArray[key];
        }
        return resurl;
    }


    /**
     * 現在のURLに設定されているパラメータを連想配列にして返却する関数
     * @param {array} paramsArray パラメータが格納された連想配列
     * @return {array}       パラメータを代入した連想配列
     */
    function getParameter() {
        var paramsArray = [];
        var url = location.href;
        parameters = url.split("#");
        if (parameters.length > 1) {
            url = parameters[0];
        }
        parameters = url.split("?");
        if (parameters.length > 1) {
            var params = parameters[1].split("&");
            for (i = 0; i < params.length; i++) {
                var paramItem = params[i].split("=");
                paramsArray[paramItem[0]] = paramItem[1];
            }
        }
        return paramsArray;
    };


    /**
     * URLパラメータの特定の値を取得する関数
     * @param {string} name パラメータ名
     * @param {string} url URL(省略した場合は現在のURL)
     * @return {string}       取得した値
     */
    function getParam(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }




