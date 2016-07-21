// jQuery.support.transition
// to verify that CSS3 transition is supported (or any of its browser-specific implementations)
$.support.transition = (function(){ 
    var thisBody = document.body || document.documentElement,
    thisStyle = thisBody.style,
    support = thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.OTransition !== undefined || thisStyle.transition !== undefined;
    
    return support; 
})();