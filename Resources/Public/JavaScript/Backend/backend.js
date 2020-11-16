contentCollectionOverlay = '<div class="style__addEmptyContentCollectionOverlay___2cOs0"></div>';
function addOutline() {
    $('.neosrulez-multicolumn .neos-contentcollection').each(function() {
        if ($(this).is(':empty')){
            $(this).append(contentCollectionOverlay);
        }
    });
    setTimeout(addOutline, 200);
}
addOutline();