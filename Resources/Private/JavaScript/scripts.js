if(document.getElementById('top__anchor')) {
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
}

function adjustBgVideo() {
    if($('.video-foreground').length) {
        $('.video-foreground').each(function() {
            $iFrame = $(this).find('iframe');
            if($iFrame.length == 0) {
                $iFrame = $(this).find('video');
            }
            $iFrameWidth = $iFrame.width();
            $iFrameHeight = $iFrame.height();
            $iFrameParent = $(this).parent().parent().parent().parent();
            $iFrameParentHeight = $iFrameParent.height();
            $iFramePosition = ($iFrameHeight / 2) - ($iFrameParentHeight / 2);
            $iFrame.css('margin-top', '-' + $iFramePosition + 'px');
        });
    }
}

var iOS = false, p = navigator.platform;
if( p === 'iPad' || p === 'iPhone' || p === 'iPod' ){
    iOS = true;
}

function resize() {
    adjustBgVideo();
}

let defaultNavbarCp = true;

$(document).ready(function(){
    resize();
    if($('.navbar-cp').length) {
        $('a.nav-link.dropdown-toggle').on('click', function(e) {
            if(defaultNavbarCp) {
                e.preventDefault();
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    let thisDropdownToggleNext = $(this).next();
                    if (!thisDropdownToggleNext.hasClass('show')) {
                        location.href = $(this).attr('href');
                    }
                } else {
                    location.href = $(this).attr('href');
                }
            }
        });
    }
    function onElementHeightChange(element, callback) {
        let lastHeight = element.clientHeight, newHeight;
        (function run() {
            newHeight = element.clientHeight;
            if (lastHeight !== newHeight)
                callback(newHeight)
            lastHeight = newHeight
            if (element.onElementHeightChangeTimer)
                clearTimeout(element.onElementHeightChangeTimer)
            element.onElementHeightChangeTimer = setTimeout(run, 1)
        })();
    }
    onElementHeightChange(document.body, function(h) {
        window.dispatchEvent(new Event('resize'));
    });
});

if (iOS == true) {
} else {
    $(window).resize(function() {
        resize();
    });
}

const insertAfterEl = (referenceNode, newNode) => {
	referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

if(window.fsLightboxInstances) {
	const lightboxes = window.fsLightboxInstances;
	Object.keys(lightboxes).forEach((lightbox, i) => {
		const lightboxItem = Object.values(lightboxes)[i];
		lightboxItem.props.onOpen = () => {
			const lightBoxElements = lightboxItem.elements.a;
			if(lightBoxElements) {
				lightBoxElements.forEach((lightboxEl, k) => {
					if(lightboxEl.dataset.caption) {
						const caption = lightboxEl.dataset.caption;
						if(lightboxItem.props && lightboxItem.props.sources) {
							if(lightboxItem.props.sources[k]) {
								const src = lightboxItem.props.sources[k];
								const lightBoxImage = document.querySelector(`img[src="${src}"]`);
								if(!lightBoxImage.nextSibling) {
									const captionDiv = document.createElement('div');
									captionDiv.classList.add('text-white');
									captionDiv.classList.add('text-center');
									captionDiv.classList.add('my-2');
									captionDiv.innerHTML = caption;
									insertAfterEl(lightBoxImage, captionDiv);
								}
							}
						}
					}
				});
			}
		}
	});
}
