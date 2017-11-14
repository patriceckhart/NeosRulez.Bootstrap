$(function() {
    var sitelang = document.documentElement.lang;
    if(sitelang=='de'){
        var loadingtext = 'Lade Bild #%curr%...';
        var errorloadingtext = '<a href="%url%">Das Bild #%curr%</a> konnte nicht geladen werden.';
        var prev = 'Zurück (Linke Pfeiltaste)';
        var next = 'Weiter (Rechte Pfeiltaste)';
        var counter = '%curr% von %total%';
        var close = 'Schließen (ESC)';
    } else {
        var loadingtext = 'Loading image #%curr%...';
        var errorloadingtext = '<a href="%url%">The image #%curr%</a> could not be loaded.';
        var prev = 'Previous (Left arrow key)';
        var next = 'Next (Right arrow key)';
        var counter = '%curr% of %total%';
        var close = 'Close (ESC)';
    }
    $('.lightbox').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: loadingtext,
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1],
            tPrev: prev,
            tNext: next,
            tCounter: counter,
            tClose: close
        },
        image: {
            tError: errorloadingtext,
        }
    });
});
$('.topLink').click(function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
});
var $win = $(window).scroll(function() {
    if($win.scrollTop() > 200) {
        $('.topLink').css('display','block');
    } else {
        $('.topLink').css('display','none');
    }
});
/*
 * Copyright (C) 2012 PrimeBox
 *
 * This work is licensed under the Creative Commons
 * Attribution 3.0 Unported License. To view a copy
 * of this license, visit
 * http://creativecommons.org/licenses/by/3.0/.
 *
 * Documentation available at:
 * http://www.primebox.co.uk/projects/cookie-bar/
 *
 * When using this software you use it at your own risk. We hold
 * no responsibility for any damage caused by using this plugin
 * or the documentation provided.
 */
(function($){
    $.cookieBar = function(options,val){
        if(options=='cookies'){
            var doReturn = 'cookies';
        }else if(options=='set'){
            var doReturn = 'set';
        }else{
            var doReturn = false;
        }
        var sitelang = document.documentElement.lang;
        if(sitelang=='de'){
            var message = 'Ich stimme zu, dass diese Seite Cookies für Statistiken und zur optimalen Nutzung verwendet.';
            var infotext = 'Mehr Informationen';
            var btntext = 'Akzeptieren';
            var proturl = 'datenschutz.html';
        } else {
            var message = 'I agree that this site uses cookies for statistics and optimal use.';
            var infotext = 'More Information';
            var btntext = 'Accept';
            var proturl = 'dataprotection.html';
        }
        var defaults = {

            message: message+' <a href="/'+proturl+'">'+infotext+'</a>', //Message displayed on bar
            acceptButton: true, //Set to true to show accept/enable button
            acceptText: btntext, //Text on accept/enable button
            acceptFunction: function(cookieValue){if(cookieValue!='enabled' && cookieValue!='accepted') window.location = window.location.href;}, //Function to run after accept
            declineButton: false, //Set to true to show decline/disable button
            declineText: 'Disable Cookies', //Text on decline/disable button
            declineFunction: function(cookieValue){if(cookieValue=='enabled' || cookieValue=='accepted') window.location = window.location.href;}, //Function to run after decline
            policyButton: false, //Set to true to show Privacy Policy button
            policyText: 'Privacy Policy', //Text on Privacy Policy button
            policyURL: '/privacy-policy/', //URL of Privacy Policy
            autoEnable: true, //Set to true for cookies to be accepted automatically. Banner still shows
            acceptOnContinue: false, //Set to true to accept cookies when visitor moves to another page
            acceptOnScroll: false, //Set to true to accept cookies when visitor scrolls X pixels up or down
            acceptAnyClick: false, //Set to true to accept cookies when visitor clicks anywhere on the page
            expireDays: 365, //Number of days for cookieBar cookie to be stored for
            renewOnVisit: false, //Renew the cookie upon revisit to website
            forceShow: false, //Force cookieBar to show regardless of user cookie preference
            effect: 'slide', //Options: slide, fade, hide
            element: 'body', //Element to append/prepend cookieBar to. Remember "." for class or "#" for id.
            append: false, //Set to true for cookieBar HTML to be placed at base of website. Actual position may change according to CSS
            fixed: false, //Set to true to add the class "fixed" to the cookie bar. Default CSS should fix the position
            bottom: false, //Force CSS when fixed, so bar appears at bottom of website
            zindex: '', //Can be set in CSS, although some may prefer to set here
            domain: String(window.location.hostname), //Location of privacy policy
            referrer: String(document.referrer) //Where visitor has come from
        };
        var options = $.extend(defaults,options);

        //Sets expiration date for cookie
        var expireDate = new Date();
        expireDate.setTime(expireDate.getTime()+(options.expireDays*86400000));
        expireDate = expireDate.toGMTString();

        var cookieEntry = 'cb-enabled={value}; expires='+expireDate+'; path=/';

        //Retrieves current cookie preference
        var i,cookieValue='',aCookie,aCookies=document.cookie.split('; ');
        for (i=0;i<aCookies.length;i++){
            aCookie = aCookies[i].split('=');
            if(aCookie[0]=='cb-enabled'){
                cookieValue = aCookie[1];
            }
        }
        //Sets up default cookie preference if not already set
        if(cookieValue=='' && doReturn!='cookies' && options.autoEnable){
            cookieValue = 'enabled';
            document.cookie = cookieEntry.replace('{value}','enabled');
        }else if((cookieValue=='accepted' || cookieValue=='declined') && doReturn!='cookies' && options.renewOnVisit){
            document.cookie = cookieEntry.replace('{value}',cookieValue);
        }
        if(options.acceptOnContinue){
            if(options.referrer.indexOf(options.domain)>=0 && String(window.location.href).indexOf(options.policyURL)==-1 && doReturn!='cookies' && doReturn!='set' && cookieValue!='accepted' && cookieValue!='declined'){
                doReturn = 'set';
                val = 'accepted';
            }
        }
        if(doReturn=='cookies'){
            //Returns true if cookies are enabled, false otherwise
            if(cookieValue=='enabled' || cookieValue=='accepted'){
                return true;
            }else{
                return false;
            }
        }else if(doReturn=='set' && (val=='accepted' || val=='declined')){
            //Sets value of cookie to 'accepted' or 'declined'
            document.cookie = cookieEntry.replace('{value}',val);
            if(val=='accepted'){
                return true;
            }else{
                return false;
            }
        }else{
            //Sets up enable/accept button if required
            var message = options.message.replace('{policy_url}',options.policyURL);

            if(options.acceptButton){
                var acceptButton = '<a href="" class="cb-enable btn btn-primary btn-sm float-right">'+options.acceptText+'</a>';
            }else{
                var acceptButton = '';
            }
            //Sets up disable/decline button if required
            if(options.declineButton){
                var declineButton = '<a href="" class="cb-disable btn">'+options.declineText+'</a>';
            }else{
                var declineButton = '';
            }
            //Sets up privacy policy button if required
            if(options.policyButton){
                var policyButton = '<a href="'+options.policyURL+'" class="cb-policy">'+options.policyText+'</a>';
            }else{
                var policyButton = '';
            }
            //Whether to add "fixed" class to cookie bar
            if(options.fixed){
                if(options.bottom){
                    var fixed = ' class="fixed bottom"';
                }else{
                    var fixed = ' class="fixed"';
                }
            }else{
                var fixed = '';
            }
            if(options.zindex!=''){
                var zindex = ' style="z-index:'+options.zindex+';"';
            }else{
                var zindex = '';
            }

            //Displays the cookie bar if arguments met
            if(options.forceShow || cookieValue=='enabled' || cookieValue==''){
                if(options.append){
                    $(options.element).append('<div id="cookie-bar"'+fixed+zindex+'><div class="row"><div class="col-sm-8"><p>'+message+'</p></div><div class="col-sm-4">'+acceptButton+declineButton+policyButton+'</div></div></div>');
                }else{
                    //$(options.element).prepend('<div id="cookie-bar"'+fixed+zindex+'><p>'+message+acceptButton+declineButton+policyButton+'</p></div>');
                    $(options.element).append('<div id="cookie-bar"'+fixed+zindex+'><div class="row"><div class="col-sm-8"><p>'+message+'</p></div><div class="col-sm-4">'+acceptButton+declineButton+policyButton+'</div></div></div>');
                }
            }

            var removeBar = function(func){
                if(options.acceptOnScroll) $(document).off('scroll');
                if(typeof(func)==='function') func(cookieValue);
                if(options.effect=='slide'){
                    $('#cookie-bar').slideUp(300,function(){$('#cookie-bar').remove();});
                }else if(options.effect=='fade'){
                    $('#cookie-bar').fadeOut(300,function(){$('#cookie-bar').remove();});
                }else{
                    $('#cookie-bar').hide(0,function(){$('#cookie-bar').remove();});
                }
                $(document).unbind('click',anyClick);
            };
            var cookieAccept = function(){
                document.cookie = cookieEntry.replace('{value}','accepted');
                removeBar(options.acceptFunction);
            };
            var cookieDecline = function(){
                var deleteDate = new Date();
                deleteDate.setTime(deleteDate.getTime()-(864000000));
                deleteDate = deleteDate.toGMTString();
                aCookies=document.cookie.split('; ');
                for (i=0;i<aCookies.length;i++){
                    aCookie = aCookies[i].split('=');
                    if(aCookie[0].indexOf('_')>=0){
                        document.cookie = aCookie[0]+'=0; expires='+deleteDate+'; domain='+options.domain.replace('www','')+'; path=/';
                    }else{
                        document.cookie = aCookie[0]+'=0; expires='+deleteDate+'; path=/';
                    }
                }
                document.cookie = cookieEntry.replace('{value}','declined');
                removeBar(options.declineFunction);
            };
            var anyClick = function(e){
                if(!$(e.target).hasClass('cb-policy')) cookieAccept();
            };

            $('#cookie-bar .cb-enable').click(function(){cookieAccept();return false;});
            $('#cookie-bar .cb-disable').click(function(){cookieDecline();return false;});
            if(options.acceptOnScroll){
                var scrollStart = $(document).scrollTop(),scrollNew,scrollDiff;
                $(document).on('scroll',function(){
                    scrollNew = $(document).scrollTop();
                    if(scrollNew>scrollStart){
                        scrollDiff = scrollNew - scrollStart;
                    }else{
                        scrollDiff = scrollStart - scrollNew;
                    }
                    if(scrollDiff>=Math.round(options.acceptOnScroll)) cookieAccept();
                });
            }
            if(options.acceptAnyClick){
                $(document).bind('click',anyClick);
            }
        }
    };
})(jQuery);

$(document).ready(function(){
    $.cookieBar({
    });
});