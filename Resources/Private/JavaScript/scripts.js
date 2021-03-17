function scrollToTop(){
    window.scrollTo({top: 0, behavior: 'smooth'});
}
scrollToTopAnchor = document.getElementById('top__anchor');
scrollToTopAnchor.addEventListener('click', scrollToTop);

let lastKnownScrollPosition = 0;
let ticking = false;

function showScrollToTopAnchor(scrollPos) {
    if(lastKnownScrollPosition >= 400) {
        scrollToTopAnchor.classList.add('show');
    } else {
        scrollToTopAnchor.classList.remove('show');
    }
}

document.addEventListener('scroll', function(e) {
    lastKnownScrollPosition = window.scrollY;
    if (!ticking) {
        window.requestAnimationFrame(function() {
            showScrollToTopAnchor(lastKnownScrollPosition);
            ticking = false;
        });
        ticking = true;
    }
});

function adjustBgVideo() {
    if($('.video-foreground').length) {
        $('.video-foreground').each(function() {
            $iFrame = $(this).find('iframe');
            $iFrameWidth = $iFrame.width();
            $iFrameHeight = $iFrame.height();
            $iFrameParent = $(this).parent().parent().parent().parent();
            $iFrameParentHeight = $iFrameParent.height();
            $iFramePosition = ($iFrameHeight / 2) - ($iFrameParentHeight / 2);
            $iFrame.css('margin-top', '-' + $iFramePosition + 'px');
        });
    }
}
adjustBgVideo();