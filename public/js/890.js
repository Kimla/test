(self.webpackChunk=self.webpackChunk||[]).push([[890],{7890:()=>{!function(e,t){if("function"!=typeof e.createEvent)return!1;var n,o,r,i,u,s,a,h,c,p=function(e){var t=e.toLowerCase(),n="MS"+e;return navigator.msPointerEnabled?n:!!window.PointerEvent&&t},d=function(e){return"on"+e in window&&e},l={useJquery:!t.IGNORE_JQUERY&&"undefined"!=typeof jQuery,swipeThreshold:t.SWIPE_THRESHOLD||100,tapThreshold:t.TAP_THRESHOLD||150,dbltapThreshold:t.DBL_TAP_THRESHOLD||200,longtapThreshold:t.LONG_TAP_THRESHOLD||1e3,tapPrecision:t.TAP_PRECISION/2||30,justTouchEvents:t.JUST_ON_TOUCH_DEVICES},T=!1,g=d("touchstart")||p("PointerDown"),f=d("touchend")||p("PointerUp"),v=d("touchmove")||p("PointerMove"),E=function(e){return!e.pointerId||void 0===n||e.pointerId===n},w=function(e,t,n){for(var o=t.split(" "),r=o.length;r--;)e.addEventListener(o[r],n,!1)},m=function(e){var t=Boolean(e.targetTouches&&e.targetTouches.length);switch(!0){case Boolean(e.target.touches):return e.target.touches[0];case t&&void 0!==e.targetTouches[0].pageX:return e.targetTouches[0];case t&&Boolean(e.targetTouches[0].touches):return e.targetTouches[0].touches[0];default:return e}},P=function(e){return(e.targetTouches||e.target.touches||[]).length>1},y=function(){return(new Date).getTime()},_=function(t,n,i,u){var s=e.createEvent("Event");if(s.originalEvent=i,(u=u||{}).x=o,u.y=r,l.useJquery&&(s=jQuery.Event(n,{originalEvent:i}),jQuery(t).trigger(s,u)),s.initEvent){for(var a in u)s[a]=u[a];s.initEvent(n,!0,!0),t.dispatchEvent(s)}for(;t;)t["on"+n]&&t["on"+n](s),t=t.parentNode},H=0;w(e,g+(l.justTouchEvents?"":" mousedown"),(function(e){if(E(e)&&!P(e)&&(n=e.pointerId,"mousedown"!==e.type&&(T=!0),"mousedown"!==e.type||!T)){var t=m(e);i=o=t.pageX,u=r=t.pageY,c=setTimeout((function(){_(e.target,"longtap",e),a=e.target}),l.longtapThreshold),s=y(),H++}})),w(e,f+(l.justTouchEvents?"":" mouseup"),(function(e){if(E(e)&&!P(e))if(n=void 0,"mouseup"===e.type&&T)T=!1;else{var t=[],p=y(),d=u-r,g=i-o;if(clearTimeout(h),clearTimeout(c),g<=-l.swipeThreshold&&t.push("swiperight"),g>=l.swipeThreshold&&t.push("swipeleft"),d<=-l.swipeThreshold&&t.push("swipedown"),d>=l.swipeThreshold&&t.push("swipeup"),t.length){for(var f=0;f<t.length;f++){var v=t[f];_(e.target,v,e,{distance:{x:Math.abs(g),y:Math.abs(d)}})}H=0}else i>=o-l.tapPrecision&&i<=o+l.tapPrecision&&u>=r-l.tapPrecision&&u<=r+l.tapPrecision&&s+l.tapThreshold-p>=0&&(_(e.target,H>=2&&a===e.target?"dbltap":"tap",e),a=e.target),h=setTimeout((function(){H=0}),l.dbltapThreshold)}})),w(e,v+(l.justTouchEvents?"":" mousemove"),(function(e){if(E(e)&&("mousemove"!==e.type||!T)){var t=m(e);o=t.pageX,r=t.pageY}})),t.tocca=function(e){for(var t in e)l[t]=e[t];return l}}(document,window)}}]);