!function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=2)}({2:function(e,t,n){"use strict";n.r(t);var r={};n.r(r),n.d(r,"metadata",(function(){return f})),n.d(r,"settings",(function(){return l}));var o=document.querySelector(".search-toggle"),i=document.getElementById("search-menu"),c=document.querySelector(".close-search-menu"),u=!1,a=function(){u=!1,i.classList.remove("is-visible"),o.setAttribute("aria-expanded",!1)},s=function(e){var t;e.preventDefault(),u?a():(t=document.querySelector("#search-menu .search-field"),u=!0,i.classList.add("is-visible"),o.setAttribute("aria-expanded",!0),t.focus())},d=function(e){var t=e.target;!u||o.contains(t)||i.contains(t)||a()},f={name:"search-menu",type:"module"},l={init:function(){o.addEventListener("click",s),o.addEventListener("touchend",s),c.addEventListener("click",s),c.addEventListener("touchend",s),document.addEventListener("click",d),document.addEventListener("keyup",(function(e){u&&("Escape"!==e.key&&"Esc"!==e.key||a())}))}};var v,p=document.querySelectorAll("[data-src]"),b={rootMargin:"100px 0px",threshold:0},m=p.length,y=function(e){var t=e.getAttribute("data-src");if(t&&void 0!==t){var n=e.getAttribute("data-srcset"),r=e.getAttribute("data-sizes");e.src=t,n&&(e.srcset=n),r&&(e.sizes=r)}};var g=function(e,t){e.forEach((function(e){0===m&&v.disconnect(),e.isIntersecting&&(m--,y(e.target),t.unobserve(e.target))}))};function h(){"IntersectionObserver"in window?(v=new IntersectionObserver(g,b),p.forEach((function(e){v.observe(e)}))):function(e){for(var t=0;t<e.length;t++){var n=e[t];y(n)}}(p)}[r].forEach((function(e){if(e){var t=e.metadata,n=e.settings;"module"===t.type&&(0,n.init)()}})),h()}});