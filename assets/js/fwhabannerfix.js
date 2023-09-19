/*
check on github
https://github.com/tuliocll/freewha-bannerfix
*/
                        
function fwhaBannerFix(){
    var allDiv = document.querySelectorAll("div[style='text-align:right;position:fixed;bottom:3px;right:3px;width:100%;z-index:999999;cursor:pointer;line-height:0;display:block;']");

    for (var i = 0, l = allDiv.length; i < l; i++) {
    var div = allDiv[i];
    //here we insert the same style, removing only the width 100%.
    //DONT REMOVE THE BANNER, IF YOU WANT REMOVE IT ONLY 1$, BUY HERE: https://www.freewebhostingarea.com/removeads.html
    div.style = 'text-align:right;position:fixed;bottom:3px;right:0px;z-index:999999;cursor:pointer;line-height:0;display:none;';
    }
}
window.onload = fwhaBannerFix;
