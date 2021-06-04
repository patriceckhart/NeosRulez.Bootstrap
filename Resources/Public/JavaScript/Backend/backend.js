var neosIsReady = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}
neosIsReady(() => {
    setInterval(function(){
        document.querySelectorAll('.neos-nodetypes-columnlayouts-twocolumn, .neos-nodetypes-columnlayouts-threecolumn, .neos-nodetypes-columnlayouts-fourcolumn, .row').forEach(columnNodeType => {
            columnNodeType.querySelectorAll('.neos-contentcollection').forEach(contentCollection => {
                var children = contentCollection.innerHTML.trim();
                if(!children) {
                    contentCollection.innerHTML += '<div class="style__addEmptyContentCollectionOverlay___2cOs0"></div>';
                }
            });
        });
    }, 100);
});
