// --------------------------------------------------------------------
// Author  : mashimonator
// Create  : 2009/12/07
// Update  : 2009/12/07
//         : 2012/06/08 IE9でスクリプトエラーが発生するバグを修正
//         : 2012/06/08 該当tr要素hover時に背景色を変更する機能を追加
// Description : table要素の行をリンクにする
// --------------------------------------------------------------------

var tableLinkExtension = {
	//-----------------------------------------
	// 設定値
	//-----------------------------------------
	config : {
		targetClass : 'rowLink',
		linkTargetClass : 'rowLinkTarget',
		color : {
			hover : '#f5f5ff'
		}
	},
	//-----------------------------------------
	// 初期処理
	//-----------------------------------------
	initialize : function() {
		tableLinkExtension.emulateArrayContains();
		var tables = tableLinkExtension.getTargetElements( 'table', tableLinkExtension.config.targetClass);
		var reg = new RegExp(tableLinkExtension.config.targetClass + '\\[.+?\\]', 'i');
		// table数だけLOOP
		for ( var i = 0, len = tables.length; i < len; i++ ) {
			// オプション取得
			var opt = tableLinkExtension.getOption(tables[i].className.match(reg));
			// tr要素取得
			var tr = tables[i].getElementsByTagName('tr');
			for ( var x = 0, len2 = tr.length; x < len2; x++ ) {
				// a要素取得
				var a = tr[x].getElementsByTagName('a');
				if ( !a ) {
					continue;
				}
				for ( var y = 0, len3 = a.length; y < len3; y++ ) {
					if ( a[y].className.match(tableLinkExtension.config.linkTargetClass) ) {
						// td要素取得
						var td = tr[x].getElementsByTagName('td');
						for ( var n = 0, len4 = td.length; n < len4; n++ ) {
							// 情報保持
							td[n].ocolor = td[n].style.backgroundColor;
							td[n].tleopt = opt;
							// 指定されたカラムの場合
							if ( opt.contains(String(n)) ) {
								// リンク先保持
								td[n].rowLink = a[y].href;
								// イベントセット
								tableLinkExtension.addEvent( td[n], 'click', tableLinkExtension.click );
								// ポインタセット
								td[n].style.cursor = 'pointer';
								// hover有効の場合
								if ( opt.contains('hover') ) {
									// イベントセット
									tableLinkExtension.addEvent( td[n], 'mouseover', tableLinkExtension.mouseover );
									tableLinkExtension.addEvent( td[n], 'mouseout', tableLinkExtension.mouseout );
								}
							}
						}
						break;
					}
				}
			}
		}
	},
	//-----------------------------------------
	// click
	//-----------------------------------------
	click : function(e) {
		// イベント伝播ストップ
		if (e && e.stopPropagation) {
			e.preventDefault();
			e.stopPropagation();
		} else {
			window.event.returnValue = false;
			window.event.cancelBubble = true;
		}
		// 遷移
		location.href = this.rowLink;
	},
	//-----------------------------------------
	// mouseover
	//-----------------------------------------
	mouseover : function(e){
		if ( this.parentNode && this.parentNode.tagName.toUpperCase() == 'TR' ) {
			var td = this.parentNode.getElementsByTagName('td');
			for ( var x = 0, len = td.length; x < len; x++ ) {
				if ( td[x].tleopt.contains(String(x)) ) {
					td[x].style.backgroundColor = tableLinkExtension.config.color.hover;
				}
			}
		}
	},
	//-----------------------------------------
	// mouseout
	//-----------------------------------------
	mouseout : function(e){
		if ( this.parentNode && this.parentNode.tagName.toUpperCase() == 'TR' ) {
			var td = this.parentNode.getElementsByTagName('td');
			for ( var x = 0, len = td.length; x < len; x++ ) {
				td[x].style.backgroundColor = this.ocolor;
			}
		}
	},
	//-----------------------------------------
	// Class名からオプションを抽出する
	//-----------------------------------------
	getOption : function( str ) {
		var opt = new Array;
		if ( str && str != '' ) {
			// クラス名からオプション抜き出し
			str += '';
			str = str.replace(tableLinkExtension.config.targetClass, '');
			str = str.replace('[', '');
			str = str.replace(']', '');
			opt = str.split(',');
		}
		return opt;
	},
	//-----------------------------------------
	// ターゲットタグを取得する
	//-----------------------------------------
	getTargetElements : function( tag, cls ) {
		var elements = new Array();
		var targetElements = document.getElementsByTagName(tag.toUpperCase());
		for ( var i = 0, len = targetElements.length; i < len; i++ ) {
			if ( targetElements[i].className.match(cls) ) {
				elements[elements.length] = targetElements[i];
			}
		}
		return elements;
	},
	//-----------------------------------------
	// 配列のcontainsメソッドをエミュレートする
	//-----------------------------------------
	emulateArrayContains : function() {
		if( !Array.prototype.contains ){
			Array.prototype.contains = function( value ){
				for(var i in this){
					if( this.hasOwnProperty(i) && this[i] === value){
						return true;
					}
				}
				return false;
			}
		}
	},
	//-----------------------------------------
	// イベントに関数を付加する
	//-----------------------------------------
	addEvent : function( target, event, func ) {
		try {
			target.addEventListener(event, func, false);
		} catch (e) {
			target.attachEvent('on' + event, (function(el){return function(){func.call(el);};})(target));
		}
	}
}
// 実行
tableLinkExtension.addEvent( window, 'load', tableLinkExtension.initialize );