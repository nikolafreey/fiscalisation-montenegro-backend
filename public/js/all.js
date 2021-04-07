/*
 Copyright (C) Federico Zivolo 2017
 Distributed under the MIT License (license terms are at http://opensource.org/licenses/MIT).
 */(function(e,t){'object'==typeof exports&&'undefined'!=typeof module?module.exports=t():'function'==typeof define&&define.amd?define(t):e.Popper=t()})(this,function(){'use strict';function e(e){return e&&'[object Function]'==={}.toString.call(e)}function t(e,t){if(1!==e.nodeType)return[];var o=getComputedStyle(e,null);return t?o[t]:o}function o(e){return'HTML'===e.nodeName?e:e.parentNode||e.host}function n(e){if(!e)return document.body;switch(e.nodeName){case'HTML':case'BODY':return e.ownerDocument.body;case'#document':return e.body;}var i=t(e),r=i.overflow,p=i.overflowX,s=i.overflowY;return /(auto|scroll)/.test(r+s+p)?e:n(o(e))}function r(e){var o=e&&e.offsetParent,i=o&&o.nodeName;return i&&'BODY'!==i&&'HTML'!==i?-1!==['TD','TABLE'].indexOf(o.nodeName)&&'static'===t(o,'position')?r(o):o:e?e.ownerDocument.documentElement:document.documentElement}function p(e){var t=e.nodeName;return'BODY'!==t&&('HTML'===t||r(e.firstElementChild)===e)}function s(e){return null===e.parentNode?e:s(e.parentNode)}function d(e,t){if(!e||!e.nodeType||!t||!t.nodeType)return document.documentElement;var o=e.compareDocumentPosition(t)&Node.DOCUMENT_POSITION_FOLLOWING,i=o?e:t,n=o?t:e,a=document.createRange();a.setStart(i,0),a.setEnd(n,0);var l=a.commonAncestorContainer;if(e!==l&&t!==l||i.contains(n))return p(l)?l:r(l);var f=s(e);return f.host?d(f.host,t):d(e,s(t).host)}function a(e){var t=1<arguments.length&&void 0!==arguments[1]?arguments[1]:'top',o='top'===t?'scrollTop':'scrollLeft',i=e.nodeName;if('BODY'===i||'HTML'===i){var n=e.ownerDocument.documentElement,r=e.ownerDocument.scrollingElement||n;return r[o]}return e[o]}function l(e,t){var o=2<arguments.length&&void 0!==arguments[2]&&arguments[2],i=a(t,'top'),n=a(t,'left'),r=o?-1:1;return e.top+=i*r,e.bottom+=i*r,e.left+=n*r,e.right+=n*r,e}function f(e,t){var o='x'===t?'Left':'Top',i='Left'==o?'Right':'Bottom';return parseFloat(e['border'+o+'Width'],10)+parseFloat(e['border'+i+'Width'],10)}function m(e,t,o,i){return J(t['offset'+e],t['scroll'+e],o['client'+e],o['offset'+e],o['scroll'+e],ie()?o['offset'+e]+i['margin'+('Height'===e?'Top':'Left')]+i['margin'+('Height'===e?'Bottom':'Right')]:0)}function h(){var e=document.body,t=document.documentElement,o=ie()&&getComputedStyle(t);return{height:m('Height',e,t,o),width:m('Width',e,t,o)}}function c(e){return se({},e,{right:e.left+e.width,bottom:e.top+e.height})}function g(e){var o={};if(ie())try{o=e.getBoundingClientRect();var i=a(e,'top'),n=a(e,'left');o.top+=i,o.left+=n,o.bottom+=i,o.right+=n}catch(e){}else o=e.getBoundingClientRect();var r={left:o.left,top:o.top,width:o.right-o.left,height:o.bottom-o.top},p='HTML'===e.nodeName?h():{},s=p.width||e.clientWidth||r.right-r.left,d=p.height||e.clientHeight||r.bottom-r.top,l=e.offsetWidth-s,m=e.offsetHeight-d;if(l||m){var g=t(e);l-=f(g,'x'),m-=f(g,'y'),r.width-=l,r.height-=m}return c(r)}function u(e,o){var i=ie(),r='HTML'===o.nodeName,p=g(e),s=g(o),d=n(e),a=t(o),f=parseFloat(a.borderTopWidth,10),m=parseFloat(a.borderLeftWidth,10),h=c({top:p.top-s.top-f,left:p.left-s.left-m,width:p.width,height:p.height});if(h.marginTop=0,h.marginLeft=0,!i&&r){var u=parseFloat(a.marginTop,10),b=parseFloat(a.marginLeft,10);h.top-=f-u,h.bottom-=f-u,h.left-=m-b,h.right-=m-b,h.marginTop=u,h.marginLeft=b}return(i?o.contains(d):o===d&&'BODY'!==d.nodeName)&&(h=l(h,o)),h}function b(e){var t=e.ownerDocument.documentElement,o=u(e,t),i=J(t.clientWidth,window.innerWidth||0),n=J(t.clientHeight,window.innerHeight||0),r=a(t),p=a(t,'left'),s={top:r-o.top+o.marginTop,left:p-o.left+o.marginLeft,width:i,height:n};return c(s)}function w(e){var i=e.nodeName;return'BODY'===i||'HTML'===i?!1:'fixed'===t(e,'position')||w(o(e))}function y(e,t,i,r){var p={top:0,left:0},s=d(e,t);if('viewport'===r)p=b(s);else{var a;'scrollParent'===r?(a=n(o(t)),'BODY'===a.nodeName&&(a=e.ownerDocument.documentElement)):'window'===r?a=e.ownerDocument.documentElement:a=r;var l=u(a,s);if('HTML'===a.nodeName&&!w(s)){var f=h(),m=f.height,c=f.width;p.top+=l.top-l.marginTop,p.bottom=m+l.top,p.left+=l.left-l.marginLeft,p.right=c+l.left}else p=l}return p.left+=i,p.top+=i,p.right-=i,p.bottom-=i,p}function E(e){var t=e.width,o=e.height;return t*o}function v(e,t,o,i,n){var r=5<arguments.length&&void 0!==arguments[5]?arguments[5]:0;if(-1===e.indexOf('auto'))return e;var p=y(o,i,r,n),s={top:{width:p.width,height:t.top-p.top},right:{width:p.right-t.right,height:p.height},bottom:{width:p.width,height:p.bottom-t.bottom},left:{width:t.left-p.left,height:p.height}},d=Object.keys(s).map(function(e){return se({key:e},s[e],{area:E(s[e])})}).sort(function(e,t){return t.area-e.area}),a=d.filter(function(e){var t=e.width,i=e.height;return t>=o.clientWidth&&i>=o.clientHeight}),l=0<a.length?a[0].key:d[0].key,f=e.split('-')[1];return l+(f?'-'+f:'')}function O(e,t,o){var i=d(t,o);return u(o,i)}function L(e){var t=getComputedStyle(e),o=parseFloat(t.marginTop)+parseFloat(t.marginBottom),i=parseFloat(t.marginLeft)+parseFloat(t.marginRight),n={width:e.offsetWidth+i,height:e.offsetHeight+o};return n}function x(e){var t={left:'right',right:'left',bottom:'top',top:'bottom'};return e.replace(/left|right|bottom|top/g,function(e){return t[e]})}function S(e,t,o){o=o.split('-')[0];var i=L(e),n={width:i.width,height:i.height},r=-1!==['right','left'].indexOf(o),p=r?'top':'left',s=r?'left':'top',d=r?'height':'width',a=r?'width':'height';return n[p]=t[p]+t[d]/2-i[d]/2,n[s]=o===s?t[s]-i[a]:t[x(s)],n}function T(e,t){return Array.prototype.find?e.find(t):e.filter(t)[0]}function D(e,t,o){if(Array.prototype.findIndex)return e.findIndex(function(e){return e[t]===o});var i=T(e,function(e){return e[t]===o});return e.indexOf(i)}function C(t,o,i){var n=void 0===i?t:t.slice(0,D(t,'name',i));return n.forEach(function(t){t['function']&&console.warn('`modifier.function` is deprecated, use `modifier.fn`!');var i=t['function']||t.fn;t.enabled&&e(i)&&(o.offsets.popper=c(o.offsets.popper),o.offsets.reference=c(o.offsets.reference),o=i(o,t))}),o}function N(){if(!this.state.isDestroyed){var e={instance:this,styles:{},arrowStyles:{},attributes:{},flipped:!1,offsets:{}};e.offsets.reference=O(this.state,this.popper,this.reference),e.placement=v(this.options.placement,e.offsets.reference,this.popper,this.reference,this.options.modifiers.flip.boundariesElement,this.options.modifiers.flip.padding),e.originalPlacement=e.placement,e.offsets.popper=S(this.popper,e.offsets.reference,e.placement),e.offsets.popper.position='absolute',e=C(this.modifiers,e),this.state.isCreated?this.options.onUpdate(e):(this.state.isCreated=!0,this.options.onCreate(e))}}function k(e,t){return e.some(function(e){var o=e.name,i=e.enabled;return i&&o===t})}function W(e){for(var t=[!1,'ms','Webkit','Moz','O'],o=e.charAt(0).toUpperCase()+e.slice(1),n=0;n<t.length-1;n++){var i=t[n],r=i?''+i+o:e;if('undefined'!=typeof document.body.style[r])return r}return null}function P(){return this.state.isDestroyed=!0,k(this.modifiers,'applyStyle')&&(this.popper.removeAttribute('x-placement'),this.popper.style.left='',this.popper.style.position='',this.popper.style.top='',this.popper.style[W('transform')]=''),this.disableEventListeners(),this.options.removeOnDestroy&&this.popper.parentNode.removeChild(this.popper),this}function B(e){var t=e.ownerDocument;return t?t.defaultView:window}function H(e,t,o,i){var r='BODY'===e.nodeName,p=r?e.ownerDocument.defaultView:e;p.addEventListener(t,o,{passive:!0}),r||H(n(p.parentNode),t,o,i),i.push(p)}function A(e,t,o,i){o.updateBound=i,B(e).addEventListener('resize',o.updateBound,{passive:!0});var r=n(e);return H(r,'scroll',o.updateBound,o.scrollParents),o.scrollElement=r,o.eventsEnabled=!0,o}function I(){this.state.eventsEnabled||(this.state=A(this.reference,this.options,this.state,this.scheduleUpdate))}function M(e,t){return B(e).removeEventListener('resize',t.updateBound),t.scrollParents.forEach(function(e){e.removeEventListener('scroll',t.updateBound)}),t.updateBound=null,t.scrollParents=[],t.scrollElement=null,t.eventsEnabled=!1,t}function R(){this.state.eventsEnabled&&(cancelAnimationFrame(this.scheduleUpdate),this.state=M(this.reference,this.state))}function U(e){return''!==e&&!isNaN(parseFloat(e))&&isFinite(e)}function Y(e,t){Object.keys(t).forEach(function(o){var i='';-1!==['width','height','top','right','bottom','left'].indexOf(o)&&U(t[o])&&(i='px'),e.style[o]=t[o]+i})}function j(e,t){Object.keys(t).forEach(function(o){var i=t[o];!1===i?e.removeAttribute(o):e.setAttribute(o,t[o])})}function F(e,t,o){var i=T(e,function(e){var o=e.name;return o===t}),n=!!i&&e.some(function(e){return e.name===o&&e.enabled&&e.order<i.order});if(!n){var r='`'+t+'`';console.warn('`'+o+'`'+' modifier is required by '+r+' modifier in order to work, be sure to include it before '+r+'!')}return n}function K(e){return'end'===e?'start':'start'===e?'end':e}function q(e){var t=1<arguments.length&&void 0!==arguments[1]&&arguments[1],o=ae.indexOf(e),i=ae.slice(o+1).concat(ae.slice(0,o));return t?i.reverse():i}function V(e,t,o,i){var n=e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),r=+n[1],p=n[2];if(!r)return e;if(0===p.indexOf('%')){var s;switch(p){case'%p':s=o;break;case'%':case'%r':default:s=i;}var d=c(s);return d[t]/100*r}if('vh'===p||'vw'===p){var a;return a='vh'===p?J(document.documentElement.clientHeight,window.innerHeight||0):J(document.documentElement.clientWidth,window.innerWidth||0),a/100*r}return r}function z(e,t,o,i){var n=[0,0],r=-1!==['right','left'].indexOf(i),p=e.split(/(\+|\-)/).map(function(e){return e.trim()}),s=p.indexOf(T(p,function(e){return-1!==e.search(/,|\s/)}));p[s]&&-1===p[s].indexOf(',')&&console.warn('Offsets separated by white space(s) are deprecated, use a comma (,) instead.');var d=/\s*,\s*|\s+/,a=-1===s?[p]:[p.slice(0,s).concat([p[s].split(d)[0]]),[p[s].split(d)[1]].concat(p.slice(s+1))];return a=a.map(function(e,i){var n=(1===i?!r:r)?'height':'width',p=!1;return e.reduce(function(e,t){return''===e[e.length-1]&&-1!==['+','-'].indexOf(t)?(e[e.length-1]=t,p=!0,e):p?(e[e.length-1]+=t,p=!1,e):e.concat(t)},[]).map(function(e){return V(e,n,t,o)})}),a.forEach(function(e,t){e.forEach(function(o,i){U(o)&&(n[t]+=o*('-'===e[i-1]?-1:1))})}),n}function G(e,t){var o,i=t.offset,n=e.placement,r=e.offsets,p=r.popper,s=r.reference,d=n.split('-')[0];return o=U(+i)?[+i,0]:z(i,p,s,d),'left'===d?(p.top+=o[0],p.left-=o[1]):'right'===d?(p.top+=o[0],p.left+=o[1]):'top'===d?(p.left+=o[0],p.top-=o[1]):'bottom'===d&&(p.left+=o[0],p.top+=o[1]),e.popper=p,e}for(var _=Math.min,X=Math.floor,J=Math.max,Q='undefined'!=typeof window&&'undefined'!=typeof document,Z=['Edge','Trident','Firefox'],$=0,ee=0;ee<Z.length;ee+=1)if(Q&&0<=navigator.userAgent.indexOf(Z[ee])){$=1;break}var i,te=Q&&window.Promise,oe=te?function(e){var t=!1;return function(){t||(t=!0,window.Promise.resolve().then(function(){t=!1,e()}))}}:function(e){var t=!1;return function(){t||(t=!0,setTimeout(function(){t=!1,e()},$))}},ie=function(){return void 0==i&&(i=-1!==navigator.appVersion.indexOf('MSIE 10')),i},ne=function(e,t){if(!(e instanceof t))throw new TypeError('Cannot call a class as a function')},re=function(){function e(e,t){for(var o,n=0;n<t.length;n++)o=t[n],o.enumerable=o.enumerable||!1,o.configurable=!0,'value'in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}return function(t,o,i){return o&&e(t.prototype,o),i&&e(t,i),t}}(),pe=function(e,t,o){return t in e?Object.defineProperty(e,t,{value:o,enumerable:!0,configurable:!0,writable:!0}):e[t]=o,e},se=Object.assign||function(e){for(var t,o=1;o<arguments.length;o++)for(var i in t=arguments[o],t)Object.prototype.hasOwnProperty.call(t,i)&&(e[i]=t[i]);return e},de=['auto-start','auto','auto-end','top-start','top','top-end','right-start','right','right-end','bottom-end','bottom','bottom-start','left-end','left','left-start'],ae=de.slice(3),le={FLIP:'flip',CLOCKWISE:'clockwise',COUNTERCLOCKWISE:'counterclockwise'},fe=function(){function t(o,i){var n=this,r=2<arguments.length&&void 0!==arguments[2]?arguments[2]:{};ne(this,t),this.scheduleUpdate=function(){return requestAnimationFrame(n.update)},this.update=oe(this.update.bind(this)),this.options=se({},t.Defaults,r),this.state={isDestroyed:!1,isCreated:!1,scrollParents:[]},this.reference=o&&o.jquery?o[0]:o,this.popper=i&&i.jquery?i[0]:i,this.options.modifiers={},Object.keys(se({},t.Defaults.modifiers,r.modifiers)).forEach(function(e){n.options.modifiers[e]=se({},t.Defaults.modifiers[e]||{},r.modifiers?r.modifiers[e]:{})}),this.modifiers=Object.keys(this.options.modifiers).map(function(e){return se({name:e},n.options.modifiers[e])}).sort(function(e,t){return e.order-t.order}),this.modifiers.forEach(function(t){t.enabled&&e(t.onLoad)&&t.onLoad(n.reference,n.popper,n.options,t,n.state)}),this.update();var p=this.options.eventsEnabled;p&&this.enableEventListeners(),this.state.eventsEnabled=p}return re(t,[{key:'update',value:function(){return N.call(this)}},{key:'destroy',value:function(){return P.call(this)}},{key:'enableEventListeners',value:function(){return I.call(this)}},{key:'disableEventListeners',value:function(){return R.call(this)}}]),t}();return fe.Utils=('undefined'==typeof window?global:window).PopperUtils,fe.placements=de,fe.Defaults={placement:'bottom',eventsEnabled:!0,removeOnDestroy:!1,onCreate:function(){},onUpdate:function(){},modifiers:{shift:{order:100,enabled:!0,fn:function(e){var t=e.placement,o=t.split('-')[0],i=t.split('-')[1];if(i){var n=e.offsets,r=n.reference,p=n.popper,s=-1!==['bottom','top'].indexOf(o),d=s?'left':'top',a=s?'width':'height',l={start:pe({},d,r[d]),end:pe({},d,r[d]+r[a]-p[a])};e.offsets.popper=se({},p,l[i])}return e}},offset:{order:200,enabled:!0,fn:G,offset:0},preventOverflow:{order:300,enabled:!0,fn:function(e,t){var o=t.boundariesElement||r(e.instance.popper);e.instance.reference===o&&(o=r(o));var i=y(e.instance.popper,e.instance.reference,t.padding,o);t.boundaries=i;var n=t.priority,p=e.offsets.popper,s={primary:function(e){var o=p[e];return p[e]<i[e]&&!t.escapeWithReference&&(o=J(p[e],i[e])),pe({},e,o)},secondary:function(e){var o='right'===e?'left':'top',n=p[o];return p[e]>i[e]&&!t.escapeWithReference&&(n=_(p[o],i[e]-('right'===e?p.width:p.height))),pe({},o,n)}};return n.forEach(function(e){var t=-1===['left','top'].indexOf(e)?'secondary':'primary';p=se({},p,s[t](e))}),e.offsets.popper=p,e},priority:['left','right','top','bottom'],padding:5,boundariesElement:'scrollParent'},keepTogether:{order:400,enabled:!0,fn:function(e){var t=e.offsets,o=t.popper,i=t.reference,n=e.placement.split('-')[0],r=X,p=-1!==['top','bottom'].indexOf(n),s=p?'right':'bottom',d=p?'left':'top',a=p?'width':'height';return o[s]<r(i[d])&&(e.offsets.popper[d]=r(i[d])-o[a]),o[d]>r(i[s])&&(e.offsets.popper[d]=r(i[s])),e}},arrow:{order:500,enabled:!0,fn:function(e,o){var i;if(!F(e.instance.modifiers,'arrow','keepTogether'))return e;var n=o.element;if('string'==typeof n){if(n=e.instance.popper.querySelector(n),!n)return e;}else if(!e.instance.popper.contains(n))return console.warn('WARNING: `arrow.element` must be child of its popper element!'),e;var r=e.placement.split('-')[0],p=e.offsets,s=p.popper,d=p.reference,a=-1!==['left','right'].indexOf(r),l=a?'height':'width',f=a?'Top':'Left',m=f.toLowerCase(),h=a?'left':'top',g=a?'bottom':'right',u=L(n)[l];d[g]-u<s[m]&&(e.offsets.popper[m]-=s[m]-(d[g]-u)),d[m]+u>s[g]&&(e.offsets.popper[m]+=d[m]+u-s[g]),e.offsets.popper=c(e.offsets.popper);var b=d[m]+d[l]/2-u/2,w=t(e.instance.popper),y=parseFloat(w['margin'+f],10),E=parseFloat(w['border'+f+'Width'],10),v=b-e.offsets.popper[m]-y-E;return v=J(_(s[l]-u,v),0),e.arrowElement=n,e.offsets.arrow=(i={},pe(i,m,Math.round(v)),pe(i,h,''),i),e},element:'[x-arrow]'},flip:{order:600,enabled:!0,fn:function(e,t){if(k(e.instance.modifiers,'inner'))return e;if(e.flipped&&e.placement===e.originalPlacement)return e;var o=y(e.instance.popper,e.instance.reference,t.padding,t.boundariesElement),i=e.placement.split('-')[0],n=x(i),r=e.placement.split('-')[1]||'',p=[];switch(t.behavior){case le.FLIP:p=[i,n];break;case le.CLOCKWISE:p=q(i);break;case le.COUNTERCLOCKWISE:p=q(i,!0);break;default:p=t.behavior;}return p.forEach(function(s,d){if(i!==s||p.length===d+1)return e;i=e.placement.split('-')[0],n=x(i);var a=e.offsets.popper,l=e.offsets.reference,f=X,m='left'===i&&f(a.right)>f(l.left)||'right'===i&&f(a.left)<f(l.right)||'top'===i&&f(a.bottom)>f(l.top)||'bottom'===i&&f(a.top)<f(l.bottom),h=f(a.left)<f(o.left),c=f(a.right)>f(o.right),g=f(a.top)<f(o.top),u=f(a.bottom)>f(o.bottom),b='left'===i&&h||'right'===i&&c||'top'===i&&g||'bottom'===i&&u,w=-1!==['top','bottom'].indexOf(i),y=!!t.flipVariations&&(w&&'start'===r&&h||w&&'end'===r&&c||!w&&'start'===r&&g||!w&&'end'===r&&u);(m||b||y)&&(e.flipped=!0,(m||b)&&(i=p[d+1]),y&&(r=K(r)),e.placement=i+(r?'-'+r:''),e.offsets.popper=se({},e.offsets.popper,S(e.instance.popper,e.offsets.reference,e.placement)),e=C(e.instance.modifiers,e,'flip'))}),e},behavior:'flip',padding:5,boundariesElement:'viewport'},inner:{order:700,enabled:!1,fn:function(e){var t=e.placement,o=t.split('-')[0],i=e.offsets,n=i.popper,r=i.reference,p=-1!==['left','right'].indexOf(o),s=-1===['top','left'].indexOf(o);return n[p?'left':'top']=r[o]-(s?n[p?'width':'height']:0),e.placement=x(t),e.offsets.popper=c(n),e}},hide:{order:800,enabled:!0,fn:function(e){if(!F(e.instance.modifiers,'hide','preventOverflow'))return e;var t=e.offsets.reference,o=T(e.instance.modifiers,function(e){return'preventOverflow'===e.name}).boundaries;if(t.bottom<o.top||t.left>o.right||t.top>o.bottom||t.right<o.left){if(!0===e.hide)return e;e.hide=!0,e.attributes['x-out-of-boundaries']=''}else{if(!1===e.hide)return e;e.hide=!1,e.attributes['x-out-of-boundaries']=!1}return e}},computeStyle:{order:850,enabled:!0,fn:function(e,t){var o=t.x,i=t.y,n=e.offsets.popper,p=T(e.instance.modifiers,function(e){return'applyStyle'===e.name}).gpuAcceleration;void 0!==p&&console.warn('WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!');var s,d,a=void 0===p?t.gpuAcceleration:p,l=r(e.instance.popper),f=g(l),m={position:n.position},h={left:X(n.left),top:X(n.top),bottom:X(n.bottom),right:X(n.right)},c='bottom'===o?'top':'bottom',u='right'===i?'left':'right',b=W('transform');if(d='bottom'==c?-f.height+h.bottom:h.top,s='right'==u?-f.width+h.right:h.left,a&&b)m[b]='translate3d('+s+'px, '+d+'px, 0)',m[c]=0,m[u]=0,m.willChange='transform';else{var w='bottom'==c?-1:1,y='right'==u?-1:1;m[c]=d*w,m[u]=s*y,m.willChange=c+', '+u}var E={"x-placement":e.placement};return e.attributes=se({},E,e.attributes),e.styles=se({},m,e.styles),e.arrowStyles=se({},e.offsets.arrow,e.arrowStyles),e},gpuAcceleration:!0,x:'bottom',y:'right'},applyStyle:{order:900,enabled:!0,fn:function(e){return Y(e.instance.popper,e.styles),j(e.instance.popper,e.attributes),e.arrowElement&&Object.keys(e.arrowStyles).length&&Y(e.arrowElement,e.arrowStyles),e},onLoad:function(e,t,o,i,n){var r=O(n,t,e),p=v(o.placement,r,t,e,o.modifiers.flip.boundariesElement,o.modifiers.flip.padding);return t.setAttribute('x-placement',p),Y(t,{position:'absolute'}),o},gpuAcceleration:void 0}}},fe});
//# sourceMappingURL=popper.min.js.map

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0): util.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */
var Util = function ($) {
  /**
   * ------------------------------------------------------------------------
   * Private TransitionEnd Helpers
   * ------------------------------------------------------------------------
   */
  var transition = false;
  var MAX_UID = 1000000; // Shoutout AngusCroll (https://goo.gl/pxwQGp)

  function toType(obj) {
    return {}.toString.call(obj).match(/\s([a-zA-Z]+)/)[1].toLowerCase();
  }

  function getSpecialTransitionEndEvent() {
    return {
      bindType: transition.end,
      delegateType: transition.end,
      handle: function handle(event) {
        if ($(event.target).is(this)) {
          return event.handleObj.handler.apply(this, arguments); // eslint-disable-line prefer-rest-params
        }

        return undefined; // eslint-disable-line no-undefined
      }
    };
  }

  function transitionEndTest() {
    if (typeof window !== 'undefined' && window.QUnit) {
      return false;
    }

    return {
      end: 'transitionend'
    };
  }

  function transitionEndEmulator(duration) {
    var _this = this;

    var called = false;
    $(this).one(Util.TRANSITION_END, function () {
      called = true;
    });
    setTimeout(function () {
      if (!called) {
        Util.triggerTransitionEnd(_this);
      }
    }, duration);
    return this;
  }

  function setTransitionEndSupport() {
    transition = transitionEndTest();
    $.fn.emulateTransitionEnd = transitionEndEmulator;

    if (Util.supportsTransitionEnd()) {
      $.event.special[Util.TRANSITION_END] = getSpecialTransitionEndEvent();
    }
  }

  function escapeId(selector) {
    // We escape IDs in case of special selectors (selector = '#myId:something')
    // $.escapeSelector does not exist in jQuery < 3
    selector = typeof $.escapeSelector === 'function' ? $.escapeSelector(selector).substr(1) : selector.replace(/(:|\.|\[|\]|,|=|@)/g, '\\$1');
    return selector;
  }
  /**
   * --------------------------------------------------------------------------
   * Public Util Api
   * --------------------------------------------------------------------------
   */


  var Util = {
    TRANSITION_END: 'bsTransitionEnd',
    getUID: function getUID(prefix) {
      do {
        // eslint-disable-next-line no-bitwise
        prefix += ~~(Math.random() * MAX_UID); // "~~" acts like a faster Math.floor() here
      } while (document.getElementById(prefix));

      return prefix;
    },
    getSelectorFromElement: function getSelectorFromElement(element) {
      var selector = element.getAttribute('data-target');

      if (!selector || selector === '#') {
        selector = element.getAttribute('href') || '';
      } // If it's an ID


      if (selector.charAt(0) === '#') {
        selector = escapeId(selector);
      }

      try {
        var $selector = $(document).find(selector);
        return $selector.length > 0 ? selector : null;
      } catch (err) {
        return null;
      }
    },
    reflow: function reflow(element) {
      return element.offsetHeight;
    },
    triggerTransitionEnd: function triggerTransitionEnd(element) {
      $(element).trigger(transition.end);
    },
    supportsTransitionEnd: function supportsTransitionEnd() {
      return Boolean(transition);
    },
    isElement: function isElement(obj) {
      return (obj[0] || obj).nodeType;
    },
    typeCheckConfig: function typeCheckConfig(componentName, config, configTypes) {
      for (var property in configTypes) {
        if (Object.prototype.hasOwnProperty.call(configTypes, property)) {
          var expectedTypes = configTypes[property];
          var value = config[property];
          var valueType = value && Util.isElement(value) ? 'element' : toType(value);

          if (!new RegExp(expectedTypes).test(valueType)) {
            throw new Error(componentName.toUpperCase() + ": " + ("Option \"" + property + "\" provided type \"" + valueType + "\" ") + ("but expected type \"" + expectedTypes + "\"."));
          }
        }
      }
    }
  };
  setTransitionEndSupport();
  return Util;
}($);
//# sourceMappingURL=util.js.map
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0): alert.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */
var Alert = function ($) {
  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */
  var NAME = 'alert';
  var VERSION = '4.0.0';
  var DATA_KEY = 'bs.alert';
  var EVENT_KEY = "." + DATA_KEY;
  var DATA_API_KEY = '.data-api';
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var TRANSITION_DURATION = 150;
  var Selector = {
    DISMISS: '[data-dismiss="alert"]'
  };
  var Event = {
    CLOSE: "close" + EVENT_KEY,
    CLOSED: "closed" + EVENT_KEY,
    CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY
  };
  var ClassName = {
    ALERT: 'alert',
    FADE: 'fade',
    SHOW: 'show'
    /**
     * ------------------------------------------------------------------------
     * Class Definition
     * ------------------------------------------------------------------------
     */

  };

  var Alert =
  /*#__PURE__*/
  function () {
    function Alert(element) {
      this._element = element;
    } // Getters


    var _proto = Alert.prototype;

    // Public
    _proto.close = function close(element) {
      element = element || this._element;

      var rootElement = this._getRootElement(element);

      var customEvent = this._triggerCloseEvent(rootElement);

      if (customEvent.isDefaultPrevented()) {
        return;
      }

      this._removeElement(rootElement);
    };

    _proto.dispose = function dispose() {
      $.removeData(this._element, DATA_KEY);
      this._element = null;
    }; // Private


    _proto._getRootElement = function _getRootElement(element) {
      var selector = Util.getSelectorFromElement(element);
      var parent = false;

      if (selector) {
        parent = $(selector)[0];
      }

      if (!parent) {
        parent = $(element).closest("." + ClassName.ALERT)[0];
      }

      return parent;
    };

    _proto._triggerCloseEvent = function _triggerCloseEvent(element) {
      var closeEvent = $.Event(Event.CLOSE);
      $(element).trigger(closeEvent);
      return closeEvent;
    };

    _proto._removeElement = function _removeElement(element) {
      var _this = this;

      $(element).removeClass(ClassName.SHOW);

      if (!Util.supportsTransitionEnd() || !$(element).hasClass(ClassName.FADE)) {
        this._destroyElement(element);

        return;
      }

      $(element).one(Util.TRANSITION_END, function (event) {
        return _this._destroyElement(element, event);
      }).emulateTransitionEnd(TRANSITION_DURATION);
    };

    _proto._destroyElement = function _destroyElement(element) {
      $(element).detach().trigger(Event.CLOSED).remove();
    }; // Static


    Alert._jQueryInterface = function _jQueryInterface(config) {
      return this.each(function () {
        var $element = $(this);
        var data = $element.data(DATA_KEY);

        if (!data) {
          data = new Alert(this);
          $element.data(DATA_KEY, data);
        }

        if (config === 'close') {
          data[config](this);
        }
      });
    };

    Alert._handleDismiss = function _handleDismiss(alertInstance) {
      return function (event) {
        if (event) {
          event.preventDefault();
        }

        alertInstance.close(this);
      };
    };

    _createClass(Alert, null, [{
      key: "VERSION",
      get: function get() {
        return VERSION;
      }
    }]);

    return Alert;
  }();
  /**
   * ------------------------------------------------------------------------
   * Data Api implementation
   * ------------------------------------------------------------------------
   */


  $(document).on(Event.CLICK_DATA_API, Selector.DISMISS, Alert._handleDismiss(new Alert()));
  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */

  $.fn[NAME] = Alert._jQueryInterface;
  $.fn[NAME].Constructor = Alert;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Alert._jQueryInterface;
  };

  return Alert;
}($);
//# sourceMappingURL=alert.js.map
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0): button.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */
var Button = function ($) {
  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */
  var NAME = 'button';
  var VERSION = '4.0.0';
  var DATA_KEY = 'bs.button';
  var EVENT_KEY = "." + DATA_KEY;
  var DATA_API_KEY = '.data-api';
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var ClassName = {
    ACTIVE: 'active',
    BUTTON: 'btn',
    FOCUS: 'focus'
  };
  var Selector = {
    DATA_TOGGLE_CARROT: '[data-toggle^="button"]',
    DATA_TOGGLE: '[data-toggle="buttons"]',
    INPUT: 'input',
    ACTIVE: '.active',
    BUTTON: '.btn'
  };
  var Event = {
    CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY,
    FOCUS_BLUR_DATA_API: "focus" + EVENT_KEY + DATA_API_KEY + " " + ("blur" + EVENT_KEY + DATA_API_KEY)
    /**
     * ------------------------------------------------------------------------
     * Class Definition
     * ------------------------------------------------------------------------
     */

  };

  var Button =
  /*#__PURE__*/
  function () {
    function Button(element) {
      this._element = element;
    } // Getters


    var _proto = Button.prototype;

    // Public
    _proto.toggle = function toggle() {
      var triggerChangeEvent = true;
      var addAriaPressed = true;
      var rootElement = $(this._element).closest(Selector.DATA_TOGGLE)[0];

      if (rootElement) {
        var input = $(this._element).find(Selector.INPUT)[0];

        if (input) {
          if (input.type === 'radio') {
            if (input.checked && $(this._element).hasClass(ClassName.ACTIVE)) {
              triggerChangeEvent = false;
            } else {
              var activeElement = $(rootElement).find(Selector.ACTIVE)[0];

              if (activeElement) {
                $(activeElement).removeClass(ClassName.ACTIVE);
              }
            }
          }

          if (triggerChangeEvent) {
            if (input.hasAttribute('disabled') || rootElement.hasAttribute('disabled') || input.classList.contains('disabled') || rootElement.classList.contains('disabled')) {
              return;
            }

            input.checked = !$(this._element).hasClass(ClassName.ACTIVE);
            $(input).trigger('change');
          }

          input.focus();
          addAriaPressed = false;
        }
      }

      if (addAriaPressed) {
        this._element.setAttribute('aria-pressed', !$(this._element).hasClass(ClassName.ACTIVE));
      }

      if (triggerChangeEvent) {
        $(this._element).toggleClass(ClassName.ACTIVE);
      }
    };

    _proto.dispose = function dispose() {
      $.removeData(this._element, DATA_KEY);
      this._element = null;
    }; // Static


    Button._jQueryInterface = function _jQueryInterface(config) {
      return this.each(function () {
        var data = $(this).data(DATA_KEY);

        if (!data) {
          data = new Button(this);
          $(this).data(DATA_KEY, data);
        }

        if (config === 'toggle') {
          data[config]();
        }
      });
    };

    _createClass(Button, null, [{
      key: "VERSION",
      get: function get() {
        return VERSION;
      }
    }]);

    return Button;
  }();
  /**
   * ------------------------------------------------------------------------
   * Data Api implementation
   * ------------------------------------------------------------------------
   */


  $(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE_CARROT, function (event) {
    event.preventDefault();
    var button = event.target;

    if (!$(button).hasClass(ClassName.BUTTON)) {
      button = $(button).closest(Selector.BUTTON);
    }

    Button._jQueryInterface.call($(button), 'toggle');
  }).on(Event.FOCUS_BLUR_DATA_API, Selector.DATA_TOGGLE_CARROT, function (event) {
    var button = $(event.target).closest(Selector.BUTTON)[0];
    $(button).toggleClass(ClassName.FOCUS, /^focus(in)?$/.test(event.type));
  });
  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */

  $.fn[NAME] = Button._jQueryInterface;
  $.fn[NAME].Constructor = Button;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Button._jQueryInterface;
  };

  return Button;
}($);
//# sourceMappingURL=button.js.map
function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0): carousel.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */
var Carousel = function ($) {
  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */
  var NAME = 'carousel';
  var VERSION = '4.0.0';
  var DATA_KEY = 'bs.carousel';
  var EVENT_KEY = "." + DATA_KEY;
  var DATA_API_KEY = '.data-api';
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var TRANSITION_DURATION = 600;
  var ARROW_LEFT_KEYCODE = 37; // KeyboardEvent.which value for left arrow key

  var ARROW_RIGHT_KEYCODE = 39; // KeyboardEvent.which value for right arrow key

  var TOUCHEVENT_COMPAT_WAIT = 500; // Time for mouse compat events to fire after touch

  var Default = {
    interval: 5000,
    keyboard: true,
    slide: false,
    pause: 'hover',
    wrap: true
  };
  var DefaultType = {
    interval: '(number|boolean)',
    keyboard: 'boolean',
    slide: '(boolean|string)',
    pause: '(string|boolean)',
    wrap: 'boolean'
  };
  var Direction = {
    NEXT: 'next',
    PREV: 'prev',
    LEFT: 'left',
    RIGHT: 'right'
  };
  var Event = {
    SLIDE: "slide" + EVENT_KEY,
    SLID: "slid" + EVENT_KEY,
    KEYDOWN: "keydown" + EVENT_KEY,
    MOUSEENTER: "mouseenter" + EVENT_KEY,
    MOUSELEAVE: "mouseleave" + EVENT_KEY,
    TOUCHEND: "touchend" + EVENT_KEY,
    LOAD_DATA_API: "load" + EVENT_KEY + DATA_API_KEY,
    CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY
  };
  var ClassName = {
    CAROUSEL: 'carousel',
    ACTIVE: 'active',
    SLIDE: 'slide',
    RIGHT: 'carousel-item-right',
    LEFT: 'carousel-item-left',
    NEXT: 'carousel-item-next',
    PREV: 'carousel-item-prev',
    ITEM: 'carousel-item'
  };
  var Selector = {
    ACTIVE: '.active',
    ACTIVE_ITEM: '.active.carousel-item',
    ITEM: '.carousel-item',
    NEXT_PREV: '.carousel-item-next, .carousel-item-prev',
    INDICATORS: '.carousel-indicators',
    DATA_SLIDE: '[data-slide], [data-slide-to]',
    DATA_RIDE: '[data-ride="carousel"]'
    /**
     * ------------------------------------------------------------------------
     * Class Definition
     * ------------------------------------------------------------------------
     */

  };

  var Carousel =
  /*#__PURE__*/
  function () {
    function Carousel(element, config) {
      this._items = null;
      this._interval = null;
      this._activeElement = null;
      this._isPaused = false;
      this._isSliding = false;
      this.touchTimeout = null;
      this._config = this._getConfig(config);
      this._element = $(element)[0];
      this._indicatorsElement = $(this._element).find(Selector.INDICATORS)[0];

      this._addEventListeners();
    } // Getters


    var _proto = Carousel.prototype;

    // Public
    _proto.next = function next() {
      if (!this._isSliding) {
        this._slide(Direction.NEXT);
      }
    };

    _proto.nextWhenVisible = function nextWhenVisible() {
      // Don't call next when the page isn't visible
      // or the carousel or its parent isn't visible
      if (!document.hidden && $(this._element).is(':visible') && $(this._element).css('visibility') !== 'hidden') {
        this.next();
      }
    };

    _proto.prev = function prev() {
      if (!this._isSliding) {
        this._slide(Direction.PREV);
      }
    };

    _proto.pause = function pause(event) {
      if (!event) {
        this._isPaused = true;
      }

      if ($(this._element).find(Selector.NEXT_PREV)[0] && Util.supportsTransitionEnd()) {
        Util.triggerTransitionEnd(this._element);
        this.cycle(true);
      }

      clearInterval(this._interval);
      this._interval = null;
    };

    _proto.cycle = function cycle(event) {
      if (!event) {
        this._isPaused = false;
      }

      if (this._interval) {
        clearInterval(this._interval);
        this._interval = null;
      }

      if (this._config.interval && !this._isPaused) {
        this._interval = setInterval((document.visibilityState ? this.nextWhenVisible : this.next).bind(this), this._config.interval);
      }
    };

    _proto.to = function to(index) {
      var _this = this;

      this._activeElement = $(this._element).find(Selector.ACTIVE_ITEM)[0];

      var activeIndex = this._getItemIndex(this._activeElement);

      if (index > this._items.length - 1 || index < 0) {
        return;
      }

      if (this._isSliding) {
        $(this._element).one(Event.SLID, function () {
          return _this.to(index);
        });
        return;
      }

      if (activeIndex === index) {
        this.pause();
        this.cycle();
        return;
      }

      var direction = index > activeIndex ? Direction.NEXT : Direction.PREV;

      this._slide(direction, this._items[index]);
    };

    _proto.dispose = function dispose() {
      $(this._element).off(EVENT_KEY);
      $.removeData(this._element, DATA_KEY);
      this._items = null;
      this._config = null;
      this._element = null;
      this._interval = null;
      this._isPaused = null;
      this._isSliding = null;
      this._activeElement = null;
      this._indicatorsElement = null;
    }; // Private


    _proto._getConfig = function _getConfig(config) {
      config = _extends({}, Default, config);
      Util.typeCheckConfig(NAME, config, DefaultType);
      return config;
    };

    _proto._addEventListeners = function _addEventListeners() {
      var _this2 = this;

      if (this._config.keyboard) {
        $(this._element).on(Event.KEYDOWN, function (event) {
          return _this2._keydown(event);
        });
      }

      if (this._config.pause === 'hover') {
        $(this._element).on(Event.MOUSEENTER, function (event) {
          return _this2.pause(event);
        }).on(Event.MOUSELEAVE, function (event) {
          return _this2.cycle(event);
        });

        if ('ontouchstart' in document.documentElement) {
          // If it's a touch-enabled device, mouseenter/leave are fired as
          // part of the mouse compatibility events on first tap - the carousel
          // would stop cycling until user tapped out of it;
          // here, we listen for touchend, explicitly pause the carousel
          // (as if it's the second time we tap on it, mouseenter compat event
          // is NOT fired) and after a timeout (to allow for mouse compatibility
          // events to fire) we explicitly restart cycling
          $(this._element).on(Event.TOUCHEND, function () {
            _this2.pause();

            if (_this2.touchTimeout) {
              clearTimeout(_this2.touchTimeout);
            }

            _this2.touchTimeout = setTimeout(function (event) {
              return _this2.cycle(event);
            }, TOUCHEVENT_COMPAT_WAIT + _this2._config.interval);
          });
        }
      }
    };

    _proto._keydown = function _keydown(event) {
      if (/input|textarea/i.test(event.target.tagName)) {
        return;
      }

      switch (event.which) {
        case ARROW_LEFT_KEYCODE:
          event.preventDefault();
          this.prev();
          break;

        case ARROW_RIGHT_KEYCODE:
          event.preventDefault();
          this.next();
          break;

        default:
      }
    };

    _proto._getItemIndex = function _getItemIndex(element) {
      this._items = $.makeArray($(element).parent().find(Selector.ITEM));
      return this._items.indexOf(element);
    };

    _proto._getItemByDirection = function _getItemByDirection(direction, activeElement) {
      var isNextDirection = direction === Direction.NEXT;
      var isPrevDirection = direction === Direction.PREV;

      var activeIndex = this._getItemIndex(activeElement);

      var lastItemIndex = this._items.length - 1;
      var isGoingToWrap = isPrevDirection && activeIndex === 0 || isNextDirection && activeIndex === lastItemIndex;

      if (isGoingToWrap && !this._config.wrap) {
        return activeElement;
      }

      var delta = direction === Direction.PREV ? -1 : 1;
      var itemIndex = (activeIndex + delta) % this._items.length;
      return itemIndex === -1 ? this._items[this._items.length - 1] : this._items[itemIndex];
    };

    _proto._triggerSlideEvent = function _triggerSlideEvent(relatedTarget, eventDirectionName) {
      var targetIndex = this._getItemIndex(relatedTarget);

      var fromIndex = this._getItemIndex($(this._element).find(Selector.ACTIVE_ITEM)[0]);

      var slideEvent = $.Event(Event.SLIDE, {
        relatedTarget: relatedTarget,
        direction: eventDirectionName,
        from: fromIndex,
        to: targetIndex
      });
      $(this._element).trigger(slideEvent);
      return slideEvent;
    };

    _proto._setActiveIndicatorElement = function _setActiveIndicatorElement(element) {
      if (this._indicatorsElement) {
        $(this._indicatorsElement).find(Selector.ACTIVE).removeClass(ClassName.ACTIVE);

        var nextIndicator = this._indicatorsElement.children[this._getItemIndex(element)];

        if (nextIndicator) {
          $(nextIndicator).addClass(ClassName.ACTIVE);
        }
      }
    };

    _proto._slide = function _slide(direction, element) {
      var _this3 = this;

      var activeElement = $(this._element).find(Selector.ACTIVE_ITEM)[0];

      var activeElementIndex = this._getItemIndex(activeElement);

      var nextElement = element || activeElement && this._getItemByDirection(direction, activeElement);

      var nextElementIndex = this._getItemIndex(nextElement);

      var isCycling = Boolean(this._interval);
      var directionalClassName;
      var orderClassName;
      var eventDirectionName;

      if (direction === Direction.NEXT) {
        directionalClassName = ClassName.LEFT;
        orderClassName = ClassName.NEXT;
        eventDirectionName = Direction.LEFT;
      } else {
        directionalClassName = ClassName.RIGHT;
        orderClassName = ClassName.PREV;
        eventDirectionName = Direction.RIGHT;
      }

      if (nextElement && $(nextElement).hasClass(ClassName.ACTIVE)) {
        this._isSliding = false;
        return;
      }

      var slideEvent = this._triggerSlideEvent(nextElement, eventDirectionName);

      if (slideEvent.isDefaultPrevented()) {
        return;
      }

      if (!activeElement || !nextElement) {
        // Some weirdness is happening, so we bail
        return;
      }

      this._isSliding = true;

      if (isCycling) {
        this.pause();
      }

      this._setActiveIndicatorElement(nextElement);

      var slidEvent = $.Event(Event.SLID, {
        relatedTarget: nextElement,
        direction: eventDirectionName,
        from: activeElementIndex,
        to: nextElementIndex
      });

      if (Util.supportsTransitionEnd() && $(this._element).hasClass(ClassName.SLIDE)) {
        $(nextElement).addClass(orderClassName);
        Util.reflow(nextElement);
        $(activeElement).addClass(directionalClassName);
        $(nextElement).addClass(directionalClassName);
        $(activeElement).one(Util.TRANSITION_END, function () {
          $(nextElement).removeClass(directionalClassName + " " + orderClassName).addClass(ClassName.ACTIVE);
          $(activeElement).removeClass(ClassName.ACTIVE + " " + orderClassName + " " + directionalClassName);
          _this3._isSliding = false;
          setTimeout(function () {
            return $(_this3._element).trigger(slidEvent);
          }, 0);
        }).emulateTransitionEnd(TRANSITION_DURATION);
      } else {
        $(activeElement).removeClass(ClassName.ACTIVE);
        $(nextElement).addClass(ClassName.ACTIVE);
        this._isSliding = false;
        $(this._element).trigger(slidEvent);
      }

      if (isCycling) {
        this.cycle();
      }
    }; // Static


    Carousel._jQueryInterface = function _jQueryInterface(config) {
      return this.each(function () {
        var data = $(this).data(DATA_KEY);

        var _config = _extends({}, Default, $(this).data());

        if (typeof config === 'object') {
          _config = _extends({}, _config, config);
        }

        var action = typeof config === 'string' ? config : _config.slide;

        if (!data) {
          data = new Carousel(this, _config);
          $(this).data(DATA_KEY, data);
        }

        if (typeof config === 'number') {
          data.to(config);
        } else if (typeof action === 'string') {
          if (typeof data[action] === 'undefined') {
            throw new TypeError("No method named \"" + action + "\"");
          }

          data[action]();
        } else if (_config.interval) {
          data.pause();
          data.cycle();
        }
      });
    };

    Carousel._dataApiClickHandler = function _dataApiClickHandler(event) {
      var selector = Util.getSelectorFromElement(this);

      if (!selector) {
        return;
      }

      var target = $(selector)[0];

      if (!target || !$(target).hasClass(ClassName.CAROUSEL)) {
        return;
      }

      var config = _extends({}, $(target).data(), $(this).data());

      var slideIndex = this.getAttribute('data-slide-to');

      if (slideIndex) {
        config.interval = false;
      }

      Carousel._jQueryInterface.call($(target), config);

      if (slideIndex) {
        $(target).data(DATA_KEY).to(slideIndex);
      }

      event.preventDefault();
    };

    _createClass(Carousel, null, [{
      key: "VERSION",
      get: function get() {
        return VERSION;
      }
    }, {
      key: "Default",
      get: function get() {
        return Default;
      }
    }]);

    return Carousel;
  }();
  /**
   * ------------------------------------------------------------------------
   * Data Api implementation
   * ------------------------------------------------------------------------
   */


  $(document).on(Event.CLICK_DATA_API, Selector.DATA_SLIDE, Carousel._dataApiClickHandler);
  $(window).on(Event.LOAD_DATA_API, function () {
    $(Selector.DATA_RIDE).each(function () {
      var $carousel = $(this);

      Carousel._jQueryInterface.call($carousel, $carousel.data());
    });
  });
  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */

  $.fn[NAME] = Carousel._jQueryInterface;
  $.fn[NAME].Constructor = Carousel;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Carousel._jQueryInterface;
  };

  return Carousel;
}($);
//# sourceMappingURL=carousel.js.map
function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0): collapse.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */
var Collapse = function ($) {
  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */
  var NAME = 'collapse';
  var VERSION = '4.0.0';
  var DATA_KEY = 'bs.collapse';
  var EVENT_KEY = "." + DATA_KEY;
  var DATA_API_KEY = '.data-api';
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var TRANSITION_DURATION = 600;
  var Default = {
    toggle: true,
    parent: ''
  };
  var DefaultType = {
    toggle: 'boolean',
    parent: '(string|element)'
  };
  var Event = {
    SHOW: "show" + EVENT_KEY,
    SHOWN: "shown" + EVENT_KEY,
    HIDE: "hide" + EVENT_KEY,
    HIDDEN: "hidden" + EVENT_KEY,
    CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY
  };
  var ClassName = {
    SHOW: 'show',
    COLLAPSE: 'collapse',
    COLLAPSING: 'collapsing',
    COLLAPSED: 'collapsed'
  };
  var Dimension = {
    WIDTH: 'width',
    HEIGHT: 'height'
  };
  var Selector = {
    ACTIVES: '.show, .collapsing',
    DATA_TOGGLE: '[data-toggle="collapse"]'
    /**
     * ------------------------------------------------------------------------
     * Class Definition
     * ------------------------------------------------------------------------
     */

  };

  var Collapse =
  /*#__PURE__*/
  function () {
    function Collapse(element, config) {
      this._isTransitioning = false;
      this._element = element;
      this._config = this._getConfig(config);
      this._triggerArray = $.makeArray($("[data-toggle=\"collapse\"][href=\"#" + element.id + "\"]," + ("[data-toggle=\"collapse\"][data-target=\"#" + element.id + "\"]")));
      var tabToggles = $(Selector.DATA_TOGGLE);

      for (var i = 0; i < tabToggles.length; i++) {
        var elem = tabToggles[i];
        var selector = Util.getSelectorFromElement(elem);

        if (selector !== null && $(selector).filter(element).length > 0) {
          this._selector = selector;

          this._triggerArray.push(elem);
        }
      }

      this._parent = this._config.parent ? this._getParent() : null;

      if (!this._config.parent) {
        this._addAriaAndCollapsedClass(this._element, this._triggerArray);
      }

      if (this._config.toggle) {
        this.toggle();
      }
    } // Getters


    var _proto = Collapse.prototype;

    // Public
    _proto.toggle = function toggle() {
      if ($(this._element).hasClass(ClassName.SHOW)) {
        this.hide();
      } else {
        this.show();
      }
    };

    _proto.show = function show() {
      var _this = this;

      if (this._isTransitioning || $(this._element).hasClass(ClassName.SHOW)) {
        return;
      }

      var actives;
      var activesData;

      if (this._parent) {
        actives = $.makeArray($(this._parent).find(Selector.ACTIVES).filter("[data-parent=\"" + this._config.parent + "\"]"));

        if (actives.length === 0) {
          actives = null;
        }
      }

      if (actives) {
        activesData = $(actives).not(this._selector).data(DATA_KEY);

        if (activesData && activesData._isTransitioning) {
          return;
        }
      }

      var startEvent = $.Event(Event.SHOW);
      $(this._element).trigger(startEvent);

      if (startEvent.isDefaultPrevented()) {
        return;
      }

      if (actives) {
        Collapse._jQueryInterface.call($(actives).not(this._selector), 'hide');

        if (!activesData) {
          $(actives).data(DATA_KEY, null);
        }
      }

      var dimension = this._getDimension();

      $(this._element).removeClass(ClassName.COLLAPSE).addClass(ClassName.COLLAPSING);
      this._element.style[dimension] = 0;

      if (this._triggerArray.length > 0) {
        $(this._triggerArray).removeClass(ClassName.COLLAPSED).attr('aria-expanded', true);
      }

      this.setTransitioning(true);

      var complete = function complete() {
        $(_this._element).removeClass(ClassName.COLLAPSING).addClass(ClassName.COLLAPSE).addClass(ClassName.SHOW);
        _this._element.style[dimension] = '';

        _this.setTransitioning(false);

        $(_this._element).trigger(Event.SHOWN);
      };

      if (!Util.supportsTransitionEnd()) {
        complete();
        return;
      }

      var capitalizedDimension = dimension[0].toUpperCase() + dimension.slice(1);
      var scrollSize = "scroll" + capitalizedDimension;
      $(this._element).one(Util.TRANSITION_END, complete).emulateTransitionEnd(TRANSITION_DURATION);
      this._element.style[dimension] = this._element[scrollSize] + "px";
    };

    _proto.hide = function hide() {
      var _this2 = this;

      if (this._isTransitioning || !$(this._element).hasClass(ClassName.SHOW)) {
        return;
      }

      var startEvent = $.Event(Event.HIDE);
      $(this._element).trigger(startEvent);

      if (startEvent.isDefaultPrevented()) {
        return;
      }

      var dimension = this._getDimension();

      this._element.style[dimension] = this._element.getBoundingClientRect()[dimension] + "px";
      Util.reflow(this._element);
      $(this._element).addClass(ClassName.COLLAPSING).removeClass(ClassName.COLLAPSE).removeClass(ClassName.SHOW);

      if (this._triggerArray.length > 0) {
        for (var i = 0; i < this._triggerArray.length; i++) {
          var trigger = this._triggerArray[i];
          var selector = Util.getSelectorFromElement(trigger);

          if (selector !== null) {
            var $elem = $(selector);

            if (!$elem.hasClass(ClassName.SHOW)) {
              $(trigger).addClass(ClassName.COLLAPSED).attr('aria-expanded', false);
            }
          }
        }
      }

      this.setTransitioning(true);

      var complete = function complete() {
        _this2.setTransitioning(false);

        $(_this2._element).removeClass(ClassName.COLLAPSING).addClass(ClassName.COLLAPSE).trigger(Event.HIDDEN);
      };

      this._element.style[dimension] = '';

      if (!Util.supportsTransitionEnd()) {
        complete();
        return;
      }

      $(this._element).one(Util.TRANSITION_END, complete).emulateTransitionEnd(TRANSITION_DURATION);
    };

    _proto.setTransitioning = function setTransitioning(isTransitioning) {
      this._isTransitioning = isTransitioning;
    };

    _proto.dispose = function dispose() {
      $.removeData(this._element, DATA_KEY);
      this._config = null;
      this._parent = null;
      this._element = null;
      this._triggerArray = null;
      this._isTransitioning = null;
    }; // Private


    _proto._getConfig = function _getConfig(config) {
      config = _extends({}, Default, config);
      config.toggle = Boolean(config.toggle); // Coerce string values

      Util.typeCheckConfig(NAME, config, DefaultType);
      return config;
    };

    _proto._getDimension = function _getDimension() {
      var hasWidth = $(this._element).hasClass(Dimension.WIDTH);
      return hasWidth ? Dimension.WIDTH : Dimension.HEIGHT;
    };

    _proto._getParent = function _getParent() {
      var _this3 = this;

      var parent = null;

      if (Util.isElement(this._config.parent)) {
        parent = this._config.parent; // It's a jQuery object

        if (typeof this._config.parent.jquery !== 'undefined') {
          parent = this._config.parent[0];
        }
      } else {
        parent = $(this._config.parent)[0];
      }

      var selector = "[data-toggle=\"collapse\"][data-parent=\"" + this._config.parent + "\"]";
      $(parent).find(selector).each(function (i, element) {
        _this3._addAriaAndCollapsedClass(Collapse._getTargetFromElement(element), [element]);
      });
      return parent;
    };

    _proto._addAriaAndCollapsedClass = function _addAriaAndCollapsedClass(element, triggerArray) {
      if (element) {
        var isOpen = $(element).hasClass(ClassName.SHOW);

        if (triggerArray.length > 0) {
          $(triggerArray).toggleClass(ClassName.COLLAPSED, !isOpen).attr('aria-expanded', isOpen);
        }
      }
    }; // Static


    Collapse._getTargetFromElement = function _getTargetFromElement(element) {
      var selector = Util.getSelectorFromElement(element);
      return selector ? $(selector)[0] : null;
    };

    Collapse._jQueryInterface = function _jQueryInterface(config) {
      return this.each(function () {
        var $this = $(this);
        var data = $this.data(DATA_KEY);

        var _config = _extends({}, Default, $this.data(), typeof config === 'object' && config);

        if (!data && _config.toggle && /show|hide/.test(config)) {
          _config.toggle = false;
        }

        if (!data) {
          data = new Collapse(this, _config);
          $this.data(DATA_KEY, data);
        }

        if (typeof config === 'string') {
          if (typeof data[config] === 'undefined') {
            throw new TypeError("No method named \"" + config + "\"");
          }

          data[config]();
        }
      });
    };

    _createClass(Collapse, null, [{
      key: "VERSION",
      get: function get() {
        return VERSION;
      }
    }, {
      key: "Default",
      get: function get() {
        return Default;
      }
    }]);

    return Collapse;
  }();
  /**
   * ------------------------------------------------------------------------
   * Data Api implementation
   * ------------------------------------------------------------------------
   */


  $(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function (event) {
    // preventDefault only for <a> elements (which change the URL) not inside the collapsible element
    if (event.currentTarget.tagName === 'A') {
      event.preventDefault();
    }

    var $trigger = $(this);
    var selector = Util.getSelectorFromElement(this);
    $(selector).each(function () {
      var $target = $(this);
      var data = $target.data(DATA_KEY);
      var config = data ? 'toggle' : $trigger.data();

      Collapse._jQueryInterface.call($target, config);
    });
  });
  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */

  $.fn[NAME] = Collapse._jQueryInterface;
  $.fn[NAME].Constructor = Collapse;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Collapse._jQueryInterface;
  };

  return Collapse;
}($);
//# sourceMappingURL=collapse.js.map
function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0): dropdown.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */
var Dropdown = function ($) {
  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */
  var NAME = 'dropdown';
  var VERSION = '4.0.0';
  var DATA_KEY = 'bs.dropdown';
  var EVENT_KEY = "." + DATA_KEY;
  var DATA_API_KEY = '.data-api';
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var ESCAPE_KEYCODE = 27; // KeyboardEvent.which value for Escape (Esc) key

  var SPACE_KEYCODE = 32; // KeyboardEvent.which value for space key

  var TAB_KEYCODE = 9; // KeyboardEvent.which value for tab key

  var ARROW_UP_KEYCODE = 38; // KeyboardEvent.which value for up arrow key

  var ARROW_DOWN_KEYCODE = 40; // KeyboardEvent.which value for down arrow key

  var RIGHT_MOUSE_BUTTON_WHICH = 3; // MouseEvent.which value for the right button (assuming a right-handed mouse)

  var REGEXP_KEYDOWN = new RegExp(ARROW_UP_KEYCODE + "|" + ARROW_DOWN_KEYCODE + "|" + ESCAPE_KEYCODE);
  var Event = {
    HIDE: "hide" + EVENT_KEY,
    HIDDEN: "hidden" + EVENT_KEY,
    SHOW: "show" + EVENT_KEY,
    SHOWN: "shown" + EVENT_KEY,
    CLICK: "click" + EVENT_KEY,
    CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY,
    KEYDOWN_DATA_API: "keydown" + EVENT_KEY + DATA_API_KEY,
    KEYUP_DATA_API: "keyup" + EVENT_KEY + DATA_API_KEY
  };
  var ClassName = {
    DISABLED: 'disabled',
    SHOW: 'show',
    DROPUP: 'dropup',
    DROPRIGHT: 'dropright',
    DROPLEFT: 'dropleft',
    MENURIGHT: 'dropdown-menu-right',
    MENULEFT: 'dropdown-menu-left',
    POSITION_STATIC: 'position-static'
  };
  var Selector = {
    DATA_TOGGLE: '[data-toggle="dropdown"]',
    FORM_CHILD: '.dropdown form',
    MENU: '.dropdown-menu',
    NAVBAR_NAV: '.navbar-nav',
    VISIBLE_ITEMS: '.dropdown-menu .dropdown-item:not(.disabled)'
  };
  var AttachmentMap = {
    TOP: 'top-start',
    TOPEND: 'top-end',
    BOTTOM: 'bottom-start',
    BOTTOMEND: 'bottom-end',
    RIGHT: 'right-start',
    RIGHTEND: 'right-end',
    LEFT: 'left-start',
    LEFTEND: 'left-end'
  };
  var Default = {
    offset: 0,
    flip: true,
    boundary: 'scrollParent'
  };
  var DefaultType = {
    offset: '(number|string|function)',
    flip: 'boolean',
    boundary: '(string|element)'
    /**
     * ------------------------------------------------------------------------
     * Class Definition
     * ------------------------------------------------------------------------
     */

  };

  var Dropdown =
  /*#__PURE__*/
  function () {
    function Dropdown(element, config) {
      this._element = element;
      this._popper = null;
      this._config = this._getConfig(config);
      this._menu = this._getMenuElement();
      this._inNavbar = this._detectNavbar();

      this._addEventListeners();
    } // Getters


    var _proto = Dropdown.prototype;

    // Public
    _proto.toggle = function toggle() {
      if (this._element.disabled || $(this._element).hasClass(ClassName.DISABLED)) {
        return;
      }

      var parent = Dropdown._getParentFromElement(this._element);

      var isActive = $(this._menu).hasClass(ClassName.SHOW);

      Dropdown._clearMenus();

      if (isActive) {
        return;
      }

      var relatedTarget = {
        relatedTarget: this._element
      };
      var showEvent = $.Event(Event.SHOW, relatedTarget);
      $(parent).trigger(showEvent);

      if (showEvent.isDefaultPrevented()) {
        return;
      } // Disable totally Popper.js for Dropdown in Navbar


      if (!this._inNavbar) {
        /**
         * Check for Popper dependency
         * Popper - https://popper.js.org
         */
        if (typeof Popper === 'undefined') {
          throw new TypeError('Bootstrap dropdown require Popper.js (https://popper.js.org)');
        }

        var element = this._element; // For dropup with alignment we use the parent as popper container

        if ($(parent).hasClass(ClassName.DROPUP)) {
          if ($(this._menu).hasClass(ClassName.MENULEFT) || $(this._menu).hasClass(ClassName.MENURIGHT)) {
            element = parent;
          }
        } // If boundary is not `scrollParent`, then set position to `static`
        // to allow the menu to "escape" the scroll parent's boundaries
        // https://github.com/twbs/bootstrap/issues/24251


        if (this._config.boundary !== 'scrollParent') {
          $(parent).addClass(ClassName.POSITION_STATIC);
        }

        this._popper = new Popper(element, this._menu, this._getPopperConfig());
      } // If this is a touch-enabled device we add extra
      // empty mouseover listeners to the body's immediate children;
      // only needed because of broken event delegation on iOS
      // https://www.quirksmode.org/blog/archives/2014/02/mouse_event_bub.html


      if ('ontouchstart' in document.documentElement && $(parent).closest(Selector.NAVBAR_NAV).length === 0) {
        $('body').children().on('mouseover', null, $.noop);
      }

      this._element.focus();

      this._element.setAttribute('aria-expanded', true);

      $(this._menu).toggleClass(ClassName.SHOW);
      $(parent).toggleClass(ClassName.SHOW).trigger($.Event(Event.SHOWN, relatedTarget));
    };

    _proto.dispose = function dispose() {
      $.removeData(this._element, DATA_KEY);
      $(this._element).off(EVENT_KEY);
      this._element = null;
      this._menu = null;

      if (this._popper !== null) {
        this._popper.destroy();

        this._popper = null;
      }
    };

    _proto.update = function update() {
      this._inNavbar = this._detectNavbar();

      if (this._popper !== null) {
        this._popper.scheduleUpdate();
      }
    }; // Private


    _proto._addEventListeners = function _addEventListeners() {
      var _this = this;

      $(this._element).on(Event.CLICK, function (event) {
        event.preventDefault();
        event.stopPropagation();

        _this.toggle();
      });
    };

    _proto._getConfig = function _getConfig(config) {
      config = _extends({}, this.constructor.Default, $(this._element).data(), config);
      Util.typeCheckConfig(NAME, config, this.constructor.DefaultType);
      return config;
    };

    _proto._getMenuElement = function _getMenuElement() {
      if (!this._menu) {
        var parent = Dropdown._getParentFromElement(this._element);

        this._menu = $(parent).find(Selector.MENU)[0];
      }

      return this._menu;
    };

    _proto._getPlacement = function _getPlacement() {
      var $parentDropdown = $(this._element).parent();
      var placement = AttachmentMap.BOTTOM; // Handle dropup

      if ($parentDropdown.hasClass(ClassName.DROPUP)) {
        placement = AttachmentMap.TOP;

        if ($(this._menu).hasClass(ClassName.MENURIGHT)) {
          placement = AttachmentMap.TOPEND;
        }
      } else if ($parentDropdown.hasClass(ClassName.DROPRIGHT)) {
        placement = AttachmentMap.RIGHT;
      } else if ($parentDropdown.hasClass(ClassName.DROPLEFT)) {
        placement = AttachmentMap.LEFT;
      } else if ($(this._menu).hasClass(ClassName.MENURIGHT)) {
        placement = AttachmentMap.BOTTOMEND;
      }

      return placement;
    };

    _proto._detectNavbar = function _detectNavbar() {
      return $(this._element).closest('.navbar').length > 0;
    };

    _proto._getPopperConfig = function _getPopperConfig() {
      var _this2 = this;

      var offsetConf = {};

      if (typeof this._config.offset === 'function') {
        offsetConf.fn = function (data) {
          data.offsets = _extends({}, data.offsets, _this2._config.offset(data.offsets) || {});
          return data;
        };
      } else {
        offsetConf.offset = this._config.offset;
      }

      var popperConfig = {
        placement: this._getPlacement(),
        modifiers: {
          offset: offsetConf,
          flip: {
            enabled: this._config.flip
          },
          preventOverflow: {
            boundariesElement: this._config.boundary
          }
        }
      };
      return popperConfig;
    }; // Static


    Dropdown._jQueryInterface = function _jQueryInterface(config) {
      return this.each(function () {
        var data = $(this).data(DATA_KEY);

        var _config = typeof config === 'object' ? config : null;

        if (!data) {
          data = new Dropdown(this, _config);
          $(this).data(DATA_KEY, data);
        }

        if (typeof config === 'string') {
          if (typeof data[config] === 'undefined') {
            throw new TypeError("No method named \"" + config + "\"");
          }

          data[config]();
        }
      });
    };

    Dropdown._clearMenus = function _clearMenus(event) {
      if (event && (event.which === RIGHT_MOUSE_BUTTON_WHICH || event.type === 'keyup' && event.which !== TAB_KEYCODE)) {
        return;
      }

      var toggles = $.makeArray($(Selector.DATA_TOGGLE));

      for (var i = 0; i < toggles.length; i++) {
        var parent = Dropdown._getParentFromElement(toggles[i]);

        var context = $(toggles[i]).data(DATA_KEY);
        var relatedTarget = {
          relatedTarget: toggles[i]
        };

        if (!context) {
          continue;
        }

        var dropdownMenu = context._menu;

        if (!$(parent).hasClass(ClassName.SHOW)) {
          continue;
        }

        if (event && (event.type === 'click' && /input|textarea/i.test(event.target.tagName) || event.type === 'keyup' && event.which === TAB_KEYCODE) && $.contains(parent, event.target)) {
          continue;
        }

        var hideEvent = $.Event(Event.HIDE, relatedTarget);
        $(parent).trigger(hideEvent);

        if (hideEvent.isDefaultPrevented()) {
          continue;
        } // If this is a touch-enabled device we remove the extra
        // empty mouseover listeners we added for iOS support


        if ('ontouchstart' in document.documentElement) {
          $('body').children().off('mouseover', null, $.noop);
        }

        toggles[i].setAttribute('aria-expanded', 'false');
        $(dropdownMenu).removeClass(ClassName.SHOW);
        $(parent).removeClass(ClassName.SHOW).trigger($.Event(Event.HIDDEN, relatedTarget));
      }
    };

    Dropdown._getParentFromElement = function _getParentFromElement(element) {
      var parent;
      var selector = Util.getSelectorFromElement(element);

      if (selector) {
        parent = $(selector)[0];
      }

      return parent || element.parentNode;
    }; // eslint-disable-next-line complexity


    Dropdown._dataApiKeydownHandler = function _dataApiKeydownHandler(event) {
      // If not input/textarea:
      //  - And not a key in REGEXP_KEYDOWN => not a dropdown command
      // If input/textarea:
      //  - If space key => not a dropdown command
      //  - If key is other than escape
      //    - If key is not up or down => not a dropdown command
      //    - If trigger inside the menu => not a dropdown command
      if (/input|textarea/i.test(event.target.tagName) ? event.which === SPACE_KEYCODE || event.which !== ESCAPE_KEYCODE && (event.which !== ARROW_DOWN_KEYCODE && event.which !== ARROW_UP_KEYCODE || $(event.target).closest(Selector.MENU).length) : !REGEXP_KEYDOWN.test(event.which)) {
        return;
      }

      event.preventDefault();
      event.stopPropagation();

      if (this.disabled || $(this).hasClass(ClassName.DISABLED)) {
        return;
      }

      var parent = Dropdown._getParentFromElement(this);

      var isActive = $(parent).hasClass(ClassName.SHOW);

      if (!isActive && (event.which !== ESCAPE_KEYCODE || event.which !== SPACE_KEYCODE) || isActive && (event.which === ESCAPE_KEYCODE || event.which === SPACE_KEYCODE)) {
        if (event.which === ESCAPE_KEYCODE) {
          var toggle = $(parent).find(Selector.DATA_TOGGLE)[0];
          $(toggle).trigger('focus');
        }

        $(this).trigger('click');
        return;
      }

      var items = $(parent).find(Selector.VISIBLE_ITEMS).get();

      if (items.length === 0) {
        return;
      }

      var index = items.indexOf(event.target);

      if (event.which === ARROW_UP_KEYCODE && index > 0) {
        // Up
        index--;
      }

      if (event.which === ARROW_DOWN_KEYCODE && index < items.length - 1) {
        // Down
        index++;
      }

      if (index < 0) {
        index = 0;
      }

      items[index].focus();
    };

    _createClass(Dropdown, null, [{
      key: "VERSION",
      get: function get() {
        return VERSION;
      }
    }, {
      key: "Default",
      get: function get() {
        return Default;
      }
    }, {
      key: "DefaultType",
      get: function get() {
        return DefaultType;
      }
    }]);

    return Dropdown;
  }();
  /**
   * ------------------------------------------------------------------------
   * Data Api implementation
   * ------------------------------------------------------------------------
   */


  $(document).on(Event.KEYDOWN_DATA_API, Selector.DATA_TOGGLE, Dropdown._dataApiKeydownHandler).on(Event.KEYDOWN_DATA_API, Selector.MENU, Dropdown._dataApiKeydownHandler).on(Event.CLICK_DATA_API + " " + Event.KEYUP_DATA_API, Dropdown._clearMenus).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function (event) {
    event.preventDefault();
    event.stopPropagation();

    Dropdown._jQueryInterface.call($(this), 'toggle');
  }).on(Event.CLICK_DATA_API, Selector.FORM_CHILD, function (e) {
    e.stopPropagation();
  });
  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */

  $.fn[NAME] = Dropdown._jQueryInterface;
  $.fn[NAME].Constructor = Dropdown;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Dropdown._jQueryInterface;
  };

  return Dropdown;
}($, Popper);
//# sourceMappingURL=dropdown.js.map
function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0): modal.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */
var Modal = function ($) {
  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */
  var NAME = 'modal';
  var VERSION = '4.0.0';
  var DATA_KEY = 'bs.modal';
  var EVENT_KEY = "." + DATA_KEY;
  var DATA_API_KEY = '.data-api';
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var TRANSITION_DURATION = 300;
  var BACKDROP_TRANSITION_DURATION = 150;
  var ESCAPE_KEYCODE = 27; // KeyboardEvent.which value for Escape (Esc) key

  var Default = {
    backdrop: true,
    keyboard: true,
    focus: true,
    show: true
  };
  var DefaultType = {
    backdrop: '(boolean|string)',
    keyboard: 'boolean',
    focus: 'boolean',
    show: 'boolean'
  };
  var Event = {
    HIDE: "hide" + EVENT_KEY,
    HIDDEN: "hidden" + EVENT_KEY,
    SHOW: "show" + EVENT_KEY,
    SHOWN: "shown" + EVENT_KEY,
    FOCUSIN: "focusin" + EVENT_KEY,
    RESIZE: "resize" + EVENT_KEY,
    CLICK_DISMISS: "click.dismiss" + EVENT_KEY,
    KEYDOWN_DISMISS: "keydown.dismiss" + EVENT_KEY,
    MOUSEUP_DISMISS: "mouseup.dismiss" + EVENT_KEY,
    MOUSEDOWN_DISMISS: "mousedown.dismiss" + EVENT_KEY,
    CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY
  };
  var ClassName = {
    SCROLLBAR_MEASURER: 'modal-scrollbar-measure',
    BACKDROP: 'modal-backdrop',
    OPEN: 'modal-open',
    FADE: 'fade',
    SHOW: 'show'
  };
  var Selector = {
    DIALOG: '.modal-dialog',
    DATA_TOGGLE: '[data-toggle="modal"]',
    DATA_DISMISS: '[data-dismiss="modal"]',
    FIXED_CONTENT: '.fixed-top, .fixed-bottom, .is-fixed, .sticky-top',
    STICKY_CONTENT: '.sticky-top',
    NAVBAR_TOGGLER: '.navbar-toggler'
    /**
     * ------------------------------------------------------------------------
     * Class Definition
     * ------------------------------------------------------------------------
     */

  };

  var Modal =
  /*#__PURE__*/
  function () {
    function Modal(element, config) {
      this._config = this._getConfig(config);
      this._element = element;
      this._dialog = $(element).find(Selector.DIALOG)[0];
      this._backdrop = null;
      this._isShown = false;
      this._isBodyOverflowing = false;
      this._ignoreBackdropClick = false;
      this._originalBodyPadding = 0;
      this._scrollbarWidth = 0;
    } // Getters


    var _proto = Modal.prototype;

    // Public
    _proto.toggle = function toggle(relatedTarget) {
      return this._isShown ? this.hide() : this.show(relatedTarget);
    };

    _proto.show = function show(relatedTarget) {
      var _this = this;

      if (this._isTransitioning || this._isShown) {
        return;
      }

      if (Util.supportsTransitionEnd() && $(this._element).hasClass(ClassName.FADE)) {
        this._isTransitioning = true;
      }

      var showEvent = $.Event(Event.SHOW, {
        relatedTarget: relatedTarget
      });
      $(this._element).trigger(showEvent);

      if (this._isShown || showEvent.isDefaultPrevented()) {
        return;
      }

      this._isShown = true;

      this._checkScrollbar();

      this._setScrollbar();

      this._adjustDialog();

      $(document.body).addClass(ClassName.OPEN);

      this._setEscapeEvent();

      this._setResizeEvent();

      $(this._element).on(Event.CLICK_DISMISS, Selector.DATA_DISMISS, function (event) {
        return _this.hide(event);
      });
      $(this._dialog).on(Event.MOUSEDOWN_DISMISS, function () {
        $(_this._element).one(Event.MOUSEUP_DISMISS, function (event) {
          if ($(event.target).is(_this._element)) {
            _this._ignoreBackdropClick = true;
          }
        });
      });

      this._showBackdrop(function () {
        return _this._showElement(relatedTarget);
      });
    };

    _proto.hide = function hide(event) {
      var _this2 = this;

      if (event) {
        event.preventDefault();
      }

      if (this._isTransitioning || !this._isShown) {
        return;
      }

      var hideEvent = $.Event(Event.HIDE);
      $(this._element).trigger(hideEvent);

      if (!this._isShown || hideEvent.isDefaultPrevented()) {
        return;
      }

      this._isShown = false;
      var transition = Util.supportsTransitionEnd() && $(this._element).hasClass(ClassName.FADE);

      if (transition) {
        this._isTransitioning = true;
      }

      this._setEscapeEvent();

      this._setResizeEvent();

      $(document).off(Event.FOCUSIN);
      $(this._element).removeClass(ClassName.SHOW);
      $(this._element).off(Event.CLICK_DISMISS);
      $(this._dialog).off(Event.MOUSEDOWN_DISMISS);

      if (transition) {
        $(this._element).one(Util.TRANSITION_END, function (event) {
          return _this2._hideModal(event);
        }).emulateTransitionEnd(TRANSITION_DURATION);
      } else {
        this._hideModal();
      }
    };

    _proto.dispose = function dispose() {
      $.removeData(this._element, DATA_KEY);
      $(window, document, this._element, this._backdrop).off(EVENT_KEY);
      this._config = null;
      this._element = null;
      this._dialog = null;
      this._backdrop = null;
      this._isShown = null;
      this._isBodyOverflowing = null;
      this._ignoreBackdropClick = null;
      this._scrollbarWidth = null;
    };

    _proto.handleUpdate = function handleUpdate() {
      this._adjustDialog();
    }; // Private


    _proto._getConfig = function _getConfig(config) {
      config = _extends({}, Default, config);
      Util.typeCheckConfig(NAME, config, DefaultType);
      return config;
    };

    _proto._showElement = function _showElement(relatedTarget) {
      var _this3 = this;

      var transition = Util.supportsTransitionEnd() && $(this._element).hasClass(ClassName.FADE);

      if (!this._element.parentNode || this._element.parentNode.nodeType !== Node.ELEMENT_NODE) {
        // Don't move modal's DOM position
        document.body.appendChild(this._element);
      }

      this._element.style.display = 'block';

      this._element.removeAttribute('aria-hidden');

      this._element.scrollTop = 0;

      if (transition) {
        Util.reflow(this._element);
      }

      $(this._element).addClass(ClassName.SHOW);

      if (this._config.focus) {
        this._enforceFocus();
      }

      var shownEvent = $.Event(Event.SHOWN, {
        relatedTarget: relatedTarget
      });

      var transitionComplete = function transitionComplete() {
        if (_this3._config.focus) {
          _this3._element.focus();
        }

        _this3._isTransitioning = false;
        $(_this3._element).trigger(shownEvent);
      };

      if (transition) {
        $(this._dialog).one(Util.TRANSITION_END, transitionComplete).emulateTransitionEnd(TRANSITION_DURATION);
      } else {
        transitionComplete();
      }
    };

    _proto._enforceFocus = function _enforceFocus() {
      var _this4 = this;

      $(document).off(Event.FOCUSIN) // Guard against infinite focus loop
      .on(Event.FOCUSIN, function (event) {
        if (document !== event.target && _this4._element !== event.target && $(_this4._element).has(event.target).length === 0) {
          _this4._element.focus();
        }
      });
    };

    _proto._setEscapeEvent = function _setEscapeEvent() {
      var _this5 = this;

      if (this._isShown && this._config.keyboard) {
        $(this._element).on(Event.KEYDOWN_DISMISS, function (event) {
          if (event.which === ESCAPE_KEYCODE) {
            event.preventDefault();

            _this5.hide();
          }
        });
      } else if (!this._isShown) {
        $(this._element).off(Event.KEYDOWN_DISMISS);
      }
    };

    _proto._setResizeEvent = function _setResizeEvent() {
      var _this6 = this;

      if (this._isShown) {
        $(window).on(Event.RESIZE, function (event) {
          return _this6.handleUpdate(event);
        });
      } else {
        $(window).off(Event.RESIZE);
      }
    };

    _proto._hideModal = function _hideModal() {
      var _this7 = this;

      this._element.style.display = 'none';

      this._element.setAttribute('aria-hidden', true);

      this._isTransitioning = false;

      this._showBackdrop(function () {
        $(document.body).removeClass(ClassName.OPEN);

        _this7._resetAdjustments();

        _this7._resetScrollbar();

        $(_this7._element).trigger(Event.HIDDEN);
      });
    };

    _proto._removeBackdrop = function _removeBackdrop() {
      if (this._backdrop) {
        $(this._backdrop).remove();
        this._backdrop = null;
      }
    };

    _proto._showBackdrop = function _showBackdrop(callback) {
      var _this8 = this;

      var animate = $(this._element).hasClass(ClassName.FADE) ? ClassName.FADE : '';

      if (this._isShown && this._config.backdrop) {
        var doAnimate = Util.supportsTransitionEnd() && animate;
        this._backdrop = document.createElement('div');
        this._backdrop.className = ClassName.BACKDROP;

        if (animate) {
          $(this._backdrop).addClass(animate);
        }

        $(this._backdrop).appendTo(document.body);
        $(this._element).on(Event.CLICK_DISMISS, function (event) {
          if (_this8._ignoreBackdropClick) {
            _this8._ignoreBackdropClick = false;
            return;
          }

          if (event.target !== event.currentTarget) {
            return;
          }

          if (_this8._config.backdrop === 'static') {
            _this8._element.focus();
          } else {
            _this8.hide();
          }
        });

        if (doAnimate) {
          Util.reflow(this._backdrop);
        }

        $(this._backdrop).addClass(ClassName.SHOW);

        if (!callback) {
          return;
        }

        if (!doAnimate) {
          callback();
          return;
        }

        $(this._backdrop).one(Util.TRANSITION_END, callback).emulateTransitionEnd(BACKDROP_TRANSITION_DURATION);
      } else if (!this._isShown && this._backdrop) {
        $(this._backdrop).removeClass(ClassName.SHOW);

        var callbackRemove = function callbackRemove() {
          _this8._removeBackdrop();

          if (callback) {
            callback();
          }
        };

        if (Util.supportsTransitionEnd() && $(this._element).hasClass(ClassName.FADE)) {
          $(this._backdrop).one(Util.TRANSITION_END, callbackRemove).emulateTransitionEnd(BACKDROP_TRANSITION_DURATION);
        } else {
          callbackRemove();
        }
      } else if (callback) {
        callback();
      }
    }; // ----------------------------------------------------------------------
    // the following methods are used to handle overflowing modals
    // todo (fat): these should probably be refactored out of modal.js
    // ----------------------------------------------------------------------


    _proto._adjustDialog = function _adjustDialog() {
      var isModalOverflowing = this._element.scrollHeight > document.documentElement.clientHeight;

      if (!this._isBodyOverflowing && isModalOverflowing) {
        this._element.style.paddingLeft = this._scrollbarWidth + "px";
      }

      if (this._isBodyOverflowing && !isModalOverflowing) {
        this._element.style.paddingRight = this._scrollbarWidth + "px";
      }
    };

    _proto._resetAdjustments = function _resetAdjustments() {
      this._element.style.paddingLeft = '';
      this._element.style.paddingRight = '';
    };

    _proto._checkScrollbar = function _checkScrollbar() {
      var rect = document.body.getBoundingClientRect();
      this._isBodyOverflowing = rect.left + rect.right < window.innerWidth;
      this._scrollbarWidth = this._getScrollbarWidth();
    };

    _proto._setScrollbar = function _setScrollbar() {
      var _this9 = this;

      if (this._isBodyOverflowing) {
        // Note: DOMNode.style.paddingRight returns the actual value or '' if not set
        //   while $(DOMNode).css('padding-right') returns the calculated value or 0 if not set
        // Adjust fixed content padding
        $(Selector.FIXED_CONTENT).each(function (index, element) {
          var actualPadding = $(element)[0].style.paddingRight;
          var calculatedPadding = $(element).css('padding-right');
          $(element).data('padding-right', actualPadding).css('padding-right', parseFloat(calculatedPadding) + _this9._scrollbarWidth + "px");
        }); // Adjust sticky content margin

        $(Selector.STICKY_CONTENT).each(function (index, element) {
          var actualMargin = $(element)[0].style.marginRight;
          var calculatedMargin = $(element).css('margin-right');
          $(element).data('margin-right', actualMargin).css('margin-right', parseFloat(calculatedMargin) - _this9._scrollbarWidth + "px");
        }); // Adjust navbar-toggler margin

        $(Selector.NAVBAR_TOGGLER).each(function (index, element) {
          var actualMargin = $(element)[0].style.marginRight;
          var calculatedMargin = $(element).css('margin-right');
          $(element).data('margin-right', actualMargin).css('margin-right', parseFloat(calculatedMargin) + _this9._scrollbarWidth + "px");
        }); // Adjust body padding

        var actualPadding = document.body.style.paddingRight;
        var calculatedPadding = $('body').css('padding-right');
        $('body').data('padding-right', actualPadding).css('padding-right', parseFloat(calculatedPadding) + this._scrollbarWidth + "px");
      }
    };

    _proto._resetScrollbar = function _resetScrollbar() {
      // Restore fixed content padding
      $(Selector.FIXED_CONTENT).each(function (index, element) {
        var padding = $(element).data('padding-right');

        if (typeof padding !== 'undefined') {
          $(element).css('padding-right', padding).removeData('padding-right');
        }
      }); // Restore sticky content and navbar-toggler margin

      $(Selector.STICKY_CONTENT + ", " + Selector.NAVBAR_TOGGLER).each(function (index, element) {
        var margin = $(element).data('margin-right');

        if (typeof margin !== 'undefined') {
          $(element).css('margin-right', margin).removeData('margin-right');
        }
      }); // Restore body padding

      var padding = $('body').data('padding-right');

      if (typeof padding !== 'undefined') {
        $('body').css('padding-right', padding).removeData('padding-right');
      }
    };

    _proto._getScrollbarWidth = function _getScrollbarWidth() {
      // thx d.walsh
      var scrollDiv = document.createElement('div');
      scrollDiv.className = ClassName.SCROLLBAR_MEASURER;
      document.body.appendChild(scrollDiv);
      var scrollbarWidth = scrollDiv.getBoundingClientRect().width - scrollDiv.clientWidth;
      document.body.removeChild(scrollDiv);
      return scrollbarWidth;
    }; // Static


    Modal._jQueryInterface = function _jQueryInterface(config, relatedTarget) {
      return this.each(function () {
        var data = $(this).data(DATA_KEY);

        var _config = _extends({}, Modal.Default, $(this).data(), typeof config === 'object' && config);

        if (!data) {
          data = new Modal(this, _config);
          $(this).data(DATA_KEY, data);
        }

        if (typeof config === 'string') {
          if (typeof data[config] === 'undefined') {
            throw new TypeError("No method named \"" + config + "\"");
          }

          data[config](relatedTarget);
        } else if (_config.show) {
          data.show(relatedTarget);
        }
      });
    };

    _createClass(Modal, null, [{
      key: "VERSION",
      get: function get() {
        return VERSION;
      }
    }, {
      key: "Default",
      get: function get() {
        return Default;
      }
    }]);

    return Modal;
  }();
  /**
   * ------------------------------------------------------------------------
   * Data Api implementation
   * ------------------------------------------------------------------------
   */


  $(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function (event) {
    var _this10 = this;

    var target;
    var selector = Util.getSelectorFromElement(this);

    if (selector) {
      target = $(selector)[0];
    }

    var config = $(target).data(DATA_KEY) ? 'toggle' : _extends({}, $(target).data(), $(this).data());

    if (this.tagName === 'A' || this.tagName === 'AREA') {
      event.preventDefault();
    }

    var $target = $(target).one(Event.SHOW, function (showEvent) {
      if (showEvent.isDefaultPrevented()) {
        // Only register focus restorer if modal will actually get shown
        return;
      }

      $target.one(Event.HIDDEN, function () {
        if ($(_this10).is(':visible')) {
          _this10.focus();
        }
      });
    });

    Modal._jQueryInterface.call($(target), config, this);
  });
  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */

  $.fn[NAME] = Modal._jQueryInterface;
  $.fn[NAME].Constructor = Modal;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Modal._jQueryInterface;
  };

  return Modal;
}($);
//# sourceMappingURL=modal.js.map
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0): tab.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */
var Tab = function ($) {
  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */
  var NAME = 'tab';
  var VERSION = '4.0.0';
  var DATA_KEY = 'bs.tab';
  var EVENT_KEY = "." + DATA_KEY;
  var DATA_API_KEY = '.data-api';
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var TRANSITION_DURATION = 150;
  var Event = {
    HIDE: "hide" + EVENT_KEY,
    HIDDEN: "hidden" + EVENT_KEY,
    SHOW: "show" + EVENT_KEY,
    SHOWN: "shown" + EVENT_KEY,
    CLICK_DATA_API: "click" + EVENT_KEY + DATA_API_KEY
  };
  var ClassName = {
    DROPDOWN_MENU: 'dropdown-menu',
    ACTIVE: 'active',
    DISABLED: 'disabled',
    FADE: 'fade',
    SHOW: 'show'
  };
  var Selector = {
    DROPDOWN: '.dropdown',
    NAV_LIST_GROUP: '.nav, .list-group',
    ACTIVE: '.active',
    ACTIVE_UL: '> li > .active',
    DATA_TOGGLE: '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',
    DROPDOWN_TOGGLE: '.dropdown-toggle',
    DROPDOWN_ACTIVE_CHILD: '> .dropdown-menu .active'
    /**
     * ------------------------------------------------------------------------
     * Class Definition
     * ------------------------------------------------------------------------
     */

  };

  var Tab =
  /*#__PURE__*/
  function () {
    function Tab(element) {
      this._element = element;
    } // Getters


    var _proto = Tab.prototype;

    // Public
    _proto.show = function show() {
      var _this = this;

      if (this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && $(this._element).hasClass(ClassName.ACTIVE) || $(this._element).hasClass(ClassName.DISABLED)) {
        return;
      }

      var target;
      var previous;
      var listElement = $(this._element).closest(Selector.NAV_LIST_GROUP)[0];
      var selector = Util.getSelectorFromElement(this._element);

      if (listElement) {
        var itemSelector = listElement.nodeName === 'UL' ? Selector.ACTIVE_UL : Selector.ACTIVE;
        previous = $.makeArray($(listElement).find(itemSelector));
        previous = previous[previous.length - 1];
      }

      var hideEvent = $.Event(Event.HIDE, {
        relatedTarget: this._element
      });
      var showEvent = $.Event(Event.SHOW, {
        relatedTarget: previous
      });

      if (previous) {
        $(previous).trigger(hideEvent);
      }

      $(this._element).trigger(showEvent);

      if (showEvent.isDefaultPrevented() || hideEvent.isDefaultPrevented()) {
        return;
      }

      if (selector) {
        target = $(selector)[0];
      }

      this._activate(this._element, listElement);

      var complete = function complete() {
        var hiddenEvent = $.Event(Event.HIDDEN, {
          relatedTarget: _this._element
        });
        var shownEvent = $.Event(Event.SHOWN, {
          relatedTarget: previous
        });
        $(previous).trigger(hiddenEvent);
        $(_this._element).trigger(shownEvent);
      };

      if (target) {
        this._activate(target, target.parentNode, complete);
      } else {
        complete();
      }
    };

    _proto.dispose = function dispose() {
      $.removeData(this._element, DATA_KEY);
      this._element = null;
    }; // Private


    _proto._activate = function _activate(element, container, callback) {
      var _this2 = this;

      var activeElements;

      if (container.nodeName === 'UL') {
        activeElements = $(container).find(Selector.ACTIVE_UL);
      } else {
        activeElements = $(container).children(Selector.ACTIVE);
      }

      var active = activeElements[0];
      var isTransitioning = callback && Util.supportsTransitionEnd() && active && $(active).hasClass(ClassName.FADE);

      var complete = function complete() {
        return _this2._transitionComplete(element, active, callback);
      };

      if (active && isTransitioning) {
        $(active).one(Util.TRANSITION_END, complete).emulateTransitionEnd(TRANSITION_DURATION);
      } else {
        complete();
      }
    };

    _proto._transitionComplete = function _transitionComplete(element, active, callback) {
      if (active) {
        $(active).removeClass(ClassName.SHOW + " " + ClassName.ACTIVE);
        var dropdownChild = $(active.parentNode).find(Selector.DROPDOWN_ACTIVE_CHILD)[0];

        if (dropdownChild) {
          $(dropdownChild).removeClass(ClassName.ACTIVE);
        }

        if (active.getAttribute('role') === 'tab') {
          active.setAttribute('aria-selected', false);
        }
      }

      $(element).addClass(ClassName.ACTIVE);

      if (element.getAttribute('role') === 'tab') {
        element.setAttribute('aria-selected', true);
      }

      Util.reflow(element);
      $(element).addClass(ClassName.SHOW);

      if (element.parentNode && $(element.parentNode).hasClass(ClassName.DROPDOWN_MENU)) {
        var dropdownElement = $(element).closest(Selector.DROPDOWN)[0];

        if (dropdownElement) {
          $(dropdownElement).find(Selector.DROPDOWN_TOGGLE).addClass(ClassName.ACTIVE);
        }

        element.setAttribute('aria-expanded', true);
      }

      if (callback) {
        callback();
      }
    }; // Static


    Tab._jQueryInterface = function _jQueryInterface(config) {
      return this.each(function () {
        var $this = $(this);
        var data = $this.data(DATA_KEY);

        if (!data) {
          data = new Tab(this);
          $this.data(DATA_KEY, data);
        }

        if (typeof config === 'string') {
          if (typeof data[config] === 'undefined') {
            throw new TypeError("No method named \"" + config + "\"");
          }

          data[config]();
        }
      });
    };

    _createClass(Tab, null, [{
      key: "VERSION",
      get: function get() {
        return VERSION;
      }
    }]);

    return Tab;
  }();
  /**
   * ------------------------------------------------------------------------
   * Data Api implementation
   * ------------------------------------------------------------------------
   */


  $(document).on(Event.CLICK_DATA_API, Selector.DATA_TOGGLE, function (event) {
    event.preventDefault();

    Tab._jQueryInterface.call($(this), 'show');
  });
  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */

  $.fn[NAME] = Tab._jQueryInterface;
  $.fn[NAME].Constructor = Tab;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Tab._jQueryInterface;
  };

  return Tab;
}($);
//# sourceMappingURL=tab.js.map
function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0): tooltip.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */
var Tooltip = function ($) {
  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */
  var NAME = 'tooltip';
  var VERSION = '4.0.0';
  var DATA_KEY = 'bs.tooltip';
  var EVENT_KEY = "." + DATA_KEY;
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var TRANSITION_DURATION = 150;
  var CLASS_PREFIX = 'bs-tooltip';
  var BSCLS_PREFIX_REGEX = new RegExp("(^|\\s)" + CLASS_PREFIX + "\\S+", 'g');
  var DefaultType = {
    animation: 'boolean',
    template: 'string',
    title: '(string|element|function)',
    trigger: 'string',
    delay: '(number|object)',
    html: 'boolean',
    selector: '(string|boolean)',
    placement: '(string|function)',
    offset: '(number|string)',
    container: '(string|element|boolean)',
    fallbackPlacement: '(string|array)',
    boundary: '(string|element)'
  };
  var AttachmentMap = {
    AUTO: 'auto',
    TOP: 'top',
    RIGHT: 'right',
    BOTTOM: 'bottom',
    LEFT: 'left'
  };
  var Default = {
    animation: true,
    template: '<div class="tooltip" role="tooltip">' + '<div class="arrow"></div>' + '<div class="tooltip-inner"></div></div>',
    trigger: 'hover focus',
    title: '',
    delay: 0,
    html: false,
    selector: false,
    placement: 'top',
    offset: 0,
    container: false,
    fallbackPlacement: 'flip',
    boundary: 'scrollParent'
  };
  var HoverState = {
    SHOW: 'show',
    OUT: 'out'
  };
  var Event = {
    HIDE: "hide" + EVENT_KEY,
    HIDDEN: "hidden" + EVENT_KEY,
    SHOW: "show" + EVENT_KEY,
    SHOWN: "shown" + EVENT_KEY,
    INSERTED: "inserted" + EVENT_KEY,
    CLICK: "click" + EVENT_KEY,
    FOCUSIN: "focusin" + EVENT_KEY,
    FOCUSOUT: "focusout" + EVENT_KEY,
    MOUSEENTER: "mouseenter" + EVENT_KEY,
    MOUSELEAVE: "mouseleave" + EVENT_KEY
  };
  var ClassName = {
    FADE: 'fade',
    SHOW: 'show'
  };
  var Selector = {
    TOOLTIP: '.tooltip',
    TOOLTIP_INNER: '.tooltip-inner',
    ARROW: '.arrow'
  };
  var Trigger = {
    HOVER: 'hover',
    FOCUS: 'focus',
    CLICK: 'click',
    MANUAL: 'manual'
    /**
     * ------------------------------------------------------------------------
     * Class Definition
     * ------------------------------------------------------------------------
     */

  };

  var Tooltip =
  /*#__PURE__*/
  function () {
    function Tooltip(element, config) {
      /**
       * Check for Popper dependency
       * Popper - https://popper.js.org
       */
      if (typeof Popper === 'undefined') {
        throw new TypeError('Bootstrap tooltips require Popper.js (https://popper.js.org)');
      } // private


      this._isEnabled = true;
      this._timeout = 0;
      this._hoverState = '';
      this._activeTrigger = {};
      this._popper = null; // Protected

      this.element = element;
      this.config = this._getConfig(config);
      this.tip = null;

      this._setListeners();
    } // Getters


    var _proto = Tooltip.prototype;

    // Public
    _proto.enable = function enable() {
      this._isEnabled = true;
    };

    _proto.disable = function disable() {
      this._isEnabled = false;
    };

    _proto.toggleEnabled = function toggleEnabled() {
      this._isEnabled = !this._isEnabled;
    };

    _proto.toggle = function toggle(event) {
      if (!this._isEnabled) {
        return;
      }

      if (event) {
        var dataKey = this.constructor.DATA_KEY;
        var context = $(event.currentTarget).data(dataKey);

        if (!context) {
          context = new this.constructor(event.currentTarget, this._getDelegateConfig());
          $(event.currentTarget).data(dataKey, context);
        }

        context._activeTrigger.click = !context._activeTrigger.click;

        if (context._isWithActiveTrigger()) {
          context._enter(null, context);
        } else {
          context._leave(null, context);
        }
      } else {
        if ($(this.getTipElement()).hasClass(ClassName.SHOW)) {
          this._leave(null, this);

          return;
        }

        this._enter(null, this);
      }
    };

    _proto.dispose = function dispose() {
      clearTimeout(this._timeout);
      $.removeData(this.element, this.constructor.DATA_KEY);
      $(this.element).off(this.constructor.EVENT_KEY);
      $(this.element).closest('.modal').off('hide.bs.modal');

      if (this.tip) {
        $(this.tip).remove();
      }

      this._isEnabled = null;
      this._timeout = null;
      this._hoverState = null;
      this._activeTrigger = null;

      if (this._popper !== null) {
        this._popper.destroy();
      }

      this._popper = null;
      this.element = null;
      this.config = null;
      this.tip = null;
    };

    _proto.show = function show() {
      var _this = this;

      if ($(this.element).css('display') === 'none') {
        throw new Error('Please use show on visible elements');
      }

      var showEvent = $.Event(this.constructor.Event.SHOW);

      if (this.isWithContent() && this._isEnabled) {
        $(this.element).trigger(showEvent);
        var isInTheDom = $.contains(this.element.ownerDocument.documentElement, this.element);

        if (showEvent.isDefaultPrevented() || !isInTheDom) {
          return;
        }

        var tip = this.getTipElement();
        var tipId = Util.getUID(this.constructor.NAME);
        tip.setAttribute('id', tipId);
        this.element.setAttribute('aria-describedby', tipId);
        this.setContent();

        if (this.config.animation) {
          $(tip).addClass(ClassName.FADE);
        }

        var placement = typeof this.config.placement === 'function' ? this.config.placement.call(this, tip, this.element) : this.config.placement;

        var attachment = this._getAttachment(placement);

        this.addAttachmentClass(attachment);
        var container = this.config.container === false ? document.body : $(this.config.container);
        $(tip).data(this.constructor.DATA_KEY, this);

        if (!$.contains(this.element.ownerDocument.documentElement, this.tip)) {
          $(tip).appendTo(container);
        }

        $(this.element).trigger(this.constructor.Event.INSERTED);
        this._popper = new Popper(this.element, tip, {
          placement: attachment,
          modifiers: {
            offset: {
              offset: this.config.offset
            },
            flip: {
              behavior: this.config.fallbackPlacement
            },
            arrow: {
              element: Selector.ARROW
            },
            preventOverflow: {
              boundariesElement: this.config.boundary
            }
          },
          onCreate: function onCreate(data) {
            if (data.originalPlacement !== data.placement) {
              _this._handlePopperPlacementChange(data);
            }
          },
          onUpdate: function onUpdate(data) {
            _this._handlePopperPlacementChange(data);
          }
        });
        $(tip).addClass(ClassName.SHOW); // If this is a touch-enabled device we add extra
        // empty mouseover listeners to the body's immediate children;
        // only needed because of broken event delegation on iOS
        // https://www.quirksmode.org/blog/archives/2014/02/mouse_event_bub.html

        if ('ontouchstart' in document.documentElement) {
          $('body').children().on('mouseover', null, $.noop);
        }

        var complete = function complete() {
          if (_this.config.animation) {
            _this._fixTransition();
          }

          var prevHoverState = _this._hoverState;
          _this._hoverState = null;
          $(_this.element).trigger(_this.constructor.Event.SHOWN);

          if (prevHoverState === HoverState.OUT) {
            _this._leave(null, _this);
          }
        };

        if (Util.supportsTransitionEnd() && $(this.tip).hasClass(ClassName.FADE)) {
          $(this.tip).one(Util.TRANSITION_END, complete).emulateTransitionEnd(Tooltip._TRANSITION_DURATION);
        } else {
          complete();
        }
      }
    };

    _proto.hide = function hide(callback) {
      var _this2 = this;

      var tip = this.getTipElement();
      var hideEvent = $.Event(this.constructor.Event.HIDE);

      var complete = function complete() {
        if (_this2._hoverState !== HoverState.SHOW && tip.parentNode) {
          tip.parentNode.removeChild(tip);
        }

        _this2._cleanTipClass();

        _this2.element.removeAttribute('aria-describedby');

        $(_this2.element).trigger(_this2.constructor.Event.HIDDEN);

        if (_this2._popper !== null) {
          _this2._popper.destroy();
        }

        if (callback) {
          callback();
        }
      };

      $(this.element).trigger(hideEvent);

      if (hideEvent.isDefaultPrevented()) {
        return;
      }

      $(tip).removeClass(ClassName.SHOW); // If this is a touch-enabled device we remove the extra
      // empty mouseover listeners we added for iOS support

      if ('ontouchstart' in document.documentElement) {
        $('body').children().off('mouseover', null, $.noop);
      }

      this._activeTrigger[Trigger.CLICK] = false;
      this._activeTrigger[Trigger.FOCUS] = false;
      this._activeTrigger[Trigger.HOVER] = false;

      if (Util.supportsTransitionEnd() && $(this.tip).hasClass(ClassName.FADE)) {
        $(tip).one(Util.TRANSITION_END, complete).emulateTransitionEnd(TRANSITION_DURATION);
      } else {
        complete();
      }

      this._hoverState = '';
    };

    _proto.update = function update() {
      if (this._popper !== null) {
        this._popper.scheduleUpdate();
      }
    }; // Protected


    _proto.isWithContent = function isWithContent() {
      return Boolean(this.getTitle());
    };

    _proto.addAttachmentClass = function addAttachmentClass(attachment) {
      $(this.getTipElement()).addClass(CLASS_PREFIX + "-" + attachment);
    };

    _proto.getTipElement = function getTipElement() {
      this.tip = this.tip || $(this.config.template)[0];
      return this.tip;
    };

    _proto.setContent = function setContent() {
      var $tip = $(this.getTipElement());
      this.setElementContent($tip.find(Selector.TOOLTIP_INNER), this.getTitle());
      $tip.removeClass(ClassName.FADE + " " + ClassName.SHOW);
    };

    _proto.setElementContent = function setElementContent($element, content) {
      var html = this.config.html;

      if (typeof content === 'object' && (content.nodeType || content.jquery)) {
        // Content is a DOM node or a jQuery
        if (html) {
          if (!$(content).parent().is($element)) {
            $element.empty().append(content);
          }
        } else {
          $element.text($(content).text());
        }
      } else {
        $element[html ? 'html' : 'text'](content);
      }
    };

    _proto.getTitle = function getTitle() {
      var title = this.element.getAttribute('data-original-title');

      if (!title) {
        title = typeof this.config.title === 'function' ? this.config.title.call(this.element) : this.config.title;
      }

      return title;
    }; // Private


    _proto._getAttachment = function _getAttachment(placement) {
      return AttachmentMap[placement.toUpperCase()];
    };

    _proto._setListeners = function _setListeners() {
      var _this3 = this;

      var triggers = this.config.trigger.split(' ');
      triggers.forEach(function (trigger) {
        if (trigger === 'click') {
          $(_this3.element).on(_this3.constructor.Event.CLICK, _this3.config.selector, function (event) {
            return _this3.toggle(event);
          });
        } else if (trigger !== Trigger.MANUAL) {
          var eventIn = trigger === Trigger.HOVER ? _this3.constructor.Event.MOUSEENTER : _this3.constructor.Event.FOCUSIN;
          var eventOut = trigger === Trigger.HOVER ? _this3.constructor.Event.MOUSELEAVE : _this3.constructor.Event.FOCUSOUT;
          $(_this3.element).on(eventIn, _this3.config.selector, function (event) {
            return _this3._enter(event);
          }).on(eventOut, _this3.config.selector, function (event) {
            return _this3._leave(event);
          });
        }

        $(_this3.element).closest('.modal').on('hide.bs.modal', function () {
          return _this3.hide();
        });
      });

      if (this.config.selector) {
        this.config = _extends({}, this.config, {
          trigger: 'manual',
          selector: ''
        });
      } else {
        this._fixTitle();
      }
    };

    _proto._fixTitle = function _fixTitle() {
      var titleType = typeof this.element.getAttribute('data-original-title');

      if (this.element.getAttribute('title') || titleType !== 'string') {
        this.element.setAttribute('data-original-title', this.element.getAttribute('title') || '');
        this.element.setAttribute('title', '');
      }
    };

    _proto._enter = function _enter(event, context) {
      var dataKey = this.constructor.DATA_KEY;
      context = context || $(event.currentTarget).data(dataKey);

      if (!context) {
        context = new this.constructor(event.currentTarget, this._getDelegateConfig());
        $(event.currentTarget).data(dataKey, context);
      }

      if (event) {
        context._activeTrigger[event.type === 'focusin' ? Trigger.FOCUS : Trigger.HOVER] = true;
      }

      if ($(context.getTipElement()).hasClass(ClassName.SHOW) || context._hoverState === HoverState.SHOW) {
        context._hoverState = HoverState.SHOW;
        return;
      }

      clearTimeout(context._timeout);
      context._hoverState = HoverState.SHOW;

      if (!context.config.delay || !context.config.delay.show) {
        context.show();
        return;
      }

      context._timeout = setTimeout(function () {
        if (context._hoverState === HoverState.SHOW) {
          context.show();
        }
      }, context.config.delay.show);
    };

    _proto._leave = function _leave(event, context) {
      var dataKey = this.constructor.DATA_KEY;
      context = context || $(event.currentTarget).data(dataKey);

      if (!context) {
        context = new this.constructor(event.currentTarget, this._getDelegateConfig());
        $(event.currentTarget).data(dataKey, context);
      }

      if (event) {
        context._activeTrigger[event.type === 'focusout' ? Trigger.FOCUS : Trigger.HOVER] = false;
      }

      if (context._isWithActiveTrigger()) {
        return;
      }

      clearTimeout(context._timeout);
      context._hoverState = HoverState.OUT;

      if (!context.config.delay || !context.config.delay.hide) {
        context.hide();
        return;
      }

      context._timeout = setTimeout(function () {
        if (context._hoverState === HoverState.OUT) {
          context.hide();
        }
      }, context.config.delay.hide);
    };

    _proto._isWithActiveTrigger = function _isWithActiveTrigger() {
      for (var trigger in this._activeTrigger) {
        if (this._activeTrigger[trigger]) {
          return true;
        }
      }

      return false;
    };

    _proto._getConfig = function _getConfig(config) {
      config = _extends({}, this.constructor.Default, $(this.element).data(), config);

      if (typeof config.delay === 'number') {
        config.delay = {
          show: config.delay,
          hide: config.delay
        };
      }

      if (typeof config.title === 'number') {
        config.title = config.title.toString();
      }

      if (typeof config.content === 'number') {
        config.content = config.content.toString();
      }

      Util.typeCheckConfig(NAME, config, this.constructor.DefaultType);
      return config;
    };

    _proto._getDelegateConfig = function _getDelegateConfig() {
      var config = {};

      if (this.config) {
        for (var key in this.config) {
          if (this.constructor.Default[key] !== this.config[key]) {
            config[key] = this.config[key];
          }
        }
      }

      return config;
    };

    _proto._cleanTipClass = function _cleanTipClass() {
      var $tip = $(this.getTipElement());
      var tabClass = $tip.attr('class').match(BSCLS_PREFIX_REGEX);

      if (tabClass !== null && tabClass.length > 0) {
        $tip.removeClass(tabClass.join(''));
      }
    };

    _proto._handlePopperPlacementChange = function _handlePopperPlacementChange(data) {
      this._cleanTipClass();

      this.addAttachmentClass(this._getAttachment(data.placement));
    };

    _proto._fixTransition = function _fixTransition() {
      var tip = this.getTipElement();
      var initConfigAnimation = this.config.animation;

      if (tip.getAttribute('x-placement') !== null) {
        return;
      }

      $(tip).removeClass(ClassName.FADE);
      this.config.animation = false;
      this.hide();
      this.show();
      this.config.animation = initConfigAnimation;
    }; // Static


    Tooltip._jQueryInterface = function _jQueryInterface(config) {
      return this.each(function () {
        var data = $(this).data(DATA_KEY);

        var _config = typeof config === 'object' && config;

        if (!data && /dispose|hide/.test(config)) {
          return;
        }

        if (!data) {
          data = new Tooltip(this, _config);
          $(this).data(DATA_KEY, data);
        }

        if (typeof config === 'string') {
          if (typeof data[config] === 'undefined') {
            throw new TypeError("No method named \"" + config + "\"");
          }

          data[config]();
        }
      });
    };

    _createClass(Tooltip, null, [{
      key: "VERSION",
      get: function get() {
        return VERSION;
      }
    }, {
      key: "Default",
      get: function get() {
        return Default;
      }
    }, {
      key: "NAME",
      get: function get() {
        return NAME;
      }
    }, {
      key: "DATA_KEY",
      get: function get() {
        return DATA_KEY;
      }
    }, {
      key: "Event",
      get: function get() {
        return Event;
      }
    }, {
      key: "EVENT_KEY",
      get: function get() {
        return EVENT_KEY;
      }
    }, {
      key: "DefaultType",
      get: function get() {
        return DefaultType;
      }
    }]);

    return Tooltip;
  }();
  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */


  $.fn[NAME] = Tooltip._jQueryInterface;
  $.fn[NAME].Constructor = Tooltip;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Tooltip._jQueryInterface;
  };

  return Tooltip;
}($, Popper);
//# sourceMappingURL=tooltip.js.map
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inheritsLoose(subClass, superClass) { subClass.prototype = Object.create(superClass.prototype); subClass.prototype.constructor = subClass; subClass.__proto__ = superClass; }

function _extends() { _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; }; return _extends.apply(this, arguments); }

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v4.0.0): popover.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */
var Popover = function ($) {
  /**
   * ------------------------------------------------------------------------
   * Constants
   * ------------------------------------------------------------------------
   */
  var NAME = 'popover';
  var VERSION = '4.0.0';
  var DATA_KEY = 'bs.popover';
  var EVENT_KEY = "." + DATA_KEY;
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  var CLASS_PREFIX = 'bs-popover';
  var BSCLS_PREFIX_REGEX = new RegExp("(^|\\s)" + CLASS_PREFIX + "\\S+", 'g');

  var Default = _extends({}, Tooltip.Default, {
    placement: 'right',
    trigger: 'click',
    content: '',
    template: '<div class="popover" role="tooltip">' + '<div class="arrow"></div>' + '<h3 class="popover-header"></h3>' + '<div class="popover-body"></div></div>'
  });

  var DefaultType = _extends({}, Tooltip.DefaultType, {
    content: '(string|element|function)'
  });

  var ClassName = {
    FADE: 'fade',
    SHOW: 'show'
  };
  var Selector = {
    TITLE: '.popover-header',
    CONTENT: '.popover-body'
  };
  var Event = {
    HIDE: "hide" + EVENT_KEY,
    HIDDEN: "hidden" + EVENT_KEY,
    SHOW: "show" + EVENT_KEY,
    SHOWN: "shown" + EVENT_KEY,
    INSERTED: "inserted" + EVENT_KEY,
    CLICK: "click" + EVENT_KEY,
    FOCUSIN: "focusin" + EVENT_KEY,
    FOCUSOUT: "focusout" + EVENT_KEY,
    MOUSEENTER: "mouseenter" + EVENT_KEY,
    MOUSELEAVE: "mouseleave" + EVENT_KEY
    /**
     * ------------------------------------------------------------------------
     * Class Definition
     * ------------------------------------------------------------------------
     */

  };

  var Popover =
  /*#__PURE__*/
  function (_Tooltip) {
    _inheritsLoose(Popover, _Tooltip);

    function Popover() {
      return _Tooltip.apply(this, arguments) || this;
    }

    var _proto = Popover.prototype;

    // Overrides
    _proto.isWithContent = function isWithContent() {
      return this.getTitle() || this._getContent();
    };

    _proto.addAttachmentClass = function addAttachmentClass(attachment) {
      $(this.getTipElement()).addClass(CLASS_PREFIX + "-" + attachment);
    };

    _proto.getTipElement = function getTipElement() {
      this.tip = this.tip || $(this.config.template)[0];
      return this.tip;
    };

    _proto.setContent = function setContent() {
      var $tip = $(this.getTipElement()); // We use append for html objects to maintain js events

      this.setElementContent($tip.find(Selector.TITLE), this.getTitle());

      var content = this._getContent();

      if (typeof content === 'function') {
        content = content.call(this.element);
      }

      this.setElementContent($tip.find(Selector.CONTENT), content);
      $tip.removeClass(ClassName.FADE + " " + ClassName.SHOW);
    }; // Private


    _proto._getContent = function _getContent() {
      return this.element.getAttribute('data-content') || this.config.content;
    };

    _proto._cleanTipClass = function _cleanTipClass() {
      var $tip = $(this.getTipElement());
      var tabClass = $tip.attr('class').match(BSCLS_PREFIX_REGEX);

      if (tabClass !== null && tabClass.length > 0) {
        $tip.removeClass(tabClass.join(''));
      }
    }; // Static


    Popover._jQueryInterface = function _jQueryInterface(config) {
      return this.each(function () {
        var data = $(this).data(DATA_KEY);

        var _config = typeof config === 'object' ? config : null;

        if (!data && /destroy|hide/.test(config)) {
          return;
        }

        if (!data) {
          data = new Popover(this, _config);
          $(this).data(DATA_KEY, data);
        }

        if (typeof config === 'string') {
          if (typeof data[config] === 'undefined') {
            throw new TypeError("No method named \"" + config + "\"");
          }

          data[config]();
        }
      });
    };

    _createClass(Popover, null, [{
      key: "VERSION",
      // Getters
      get: function get() {
        return VERSION;
      }
    }, {
      key: "Default",
      get: function get() {
        return Default;
      }
    }, {
      key: "NAME",
      get: function get() {
        return NAME;
      }
    }, {
      key: "DATA_KEY",
      get: function get() {
        return DATA_KEY;
      }
    }, {
      key: "Event",
      get: function get() {
        return Event;
      }
    }, {
      key: "EVENT_KEY",
      get: function get() {
        return EVENT_KEY;
      }
    }, {
      key: "DefaultType",
      get: function get() {
        return DefaultType;
      }
    }]);

    return Popover;
  }(Tooltip);
  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */


  $.fn[NAME] = Popover._jQueryInterface;
  $.fn[NAME].Constructor = Popover;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Popover._jQueryInterface;
  };

  return Popover;
}($);
//# sourceMappingURL=popover.js.map
!function(e){e(["jquery"],function(e){return function(){function t(e,t,n){return g({type:O.error,iconClass:m().iconClasses.error,message:e,optionsOverride:n,title:t})}function n(t,n){return t||(t=m()),v=e("#"+t.containerId),v.length?v:(n&&(v=d(t)),v)}function o(e,t,n){return g({type:O.info,iconClass:m().iconClasses.info,message:e,optionsOverride:n,title:t})}function s(e){C=e}function i(e,t,n){return g({type:O.success,iconClass:m().iconClasses.success,message:e,optionsOverride:n,title:t})}function a(e,t,n){return g({type:O.warning,iconClass:m().iconClasses.warning,message:e,optionsOverride:n,title:t})}function r(e,t){var o=m();v||n(o),u(e,o,t)||l(o)}function c(t){var o=m();return v||n(o),t&&0===e(":focus",t).length?void h(t):void(v.children().length&&v.remove())}function l(t){for(var n=v.children(),o=n.length-1;o>=0;o--)u(e(n[o]),t)}function u(t,n,o){var s=!(!o||!o.force)&&o.force;return!(!t||!s&&0!==e(":focus",t).length)&&(t[n.hideMethod]({duration:n.hideDuration,easing:n.hideEasing,complete:function(){h(t)}}),!0)}function d(t){return v=e("<div/>").attr("id",t.containerId).addClass(t.positionClass),v.appendTo(e(t.target)),v}function p(){return{tapToDismiss:!0,toastClass:"toast",containerId:"toast-container",debug:!1,showMethod:"fadeIn",showDuration:300,showEasing:"swing",onShown:void 0,hideMethod:"fadeOut",hideDuration:1e3,hideEasing:"swing",onHidden:void 0,closeMethod:!1,closeDuration:!1,closeEasing:!1,closeOnHover:!0,extendedTimeOut:1e3,iconClasses:{error:"toast-error",info:"toast-info",success:"toast-success",warning:"toast-warning"},iconClass:"toast-info",positionClass:"toast-top-right",timeOut:5e3,titleClass:"toast-title",messageClass:"toast-message",escapeHtml:!1,target:"body",closeHtml:'<button type="button">&times;</button>',closeClass:"toast-close-button",newestOnTop:!0,preventDuplicates:!1,progressBar:!1,progressClass:"toast-progress",rtl:!1}}function f(e){C&&C(e)}function g(t){function o(e){return null==e&&(e=""),e.replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/'/g,"&#39;").replace(/</g,"&lt;").replace(/>/g,"&gt;")}function s(){c(),u(),d(),p(),g(),C(),l(),i()}function i(){var e="";switch(t.iconClass){case"toast-success":case"toast-info":e="polite";break;default:e="assertive"}I.attr("aria-live",e)}function a(){E.closeOnHover&&I.hover(H,D),!E.onclick&&E.tapToDismiss&&I.click(b),E.closeButton&&j&&j.click(function(e){e.stopPropagation?e.stopPropagation():void 0!==e.cancelBubble&&e.cancelBubble!==!0&&(e.cancelBubble=!0),E.onCloseClick&&E.onCloseClick(e),b(!0)}),E.onclick&&I.click(function(e){E.onclick(e),b()})}function r(){I.hide(),I[E.showMethod]({duration:E.showDuration,easing:E.showEasing,complete:E.onShown}),E.timeOut>0&&(k=setTimeout(b,E.timeOut),F.maxHideTime=parseFloat(E.timeOut),F.hideEta=(new Date).getTime()+F.maxHideTime,E.progressBar&&(F.intervalId=setInterval(x,10)))}function c(){t.iconClass&&I.addClass(E.toastClass).addClass(y)}function l(){E.newestOnTop?v.prepend(I):v.append(I)}function u(){if(t.title){var e=t.title;E.escapeHtml&&(e=o(t.title)),M.append(e).addClass(E.titleClass),I.append(M)}}function d(){if(t.message){var e=t.message;E.escapeHtml&&(e=o(t.message)),B.append(e).addClass(E.messageClass),I.append(B)}}function p(){E.closeButton&&(j.addClass(E.closeClass).attr("role","button"),I.prepend(j))}function g(){E.progressBar&&(q.addClass(E.progressClass),I.prepend(q))}function C(){E.rtl&&I.addClass("rtl")}function O(e,t){if(e.preventDuplicates){if(t.message===w)return!0;w=t.message}return!1}function b(t){var n=t&&E.closeMethod!==!1?E.closeMethod:E.hideMethod,o=t&&E.closeDuration!==!1?E.closeDuration:E.hideDuration,s=t&&E.closeEasing!==!1?E.closeEasing:E.hideEasing;if(!e(":focus",I).length||t)return clearTimeout(F.intervalId),I[n]({duration:o,easing:s,complete:function(){h(I),clearTimeout(k),E.onHidden&&"hidden"!==P.state&&E.onHidden(),P.state="hidden",P.endTime=new Date,f(P)}})}function D(){(E.timeOut>0||E.extendedTimeOut>0)&&(k=setTimeout(b,E.extendedTimeOut),F.maxHideTime=parseFloat(E.extendedTimeOut),F.hideEta=(new Date).getTime()+F.maxHideTime)}function H(){clearTimeout(k),F.hideEta=0,I.stop(!0,!0)[E.showMethod]({duration:E.showDuration,easing:E.showEasing})}function x(){var e=(F.hideEta-(new Date).getTime())/F.maxHideTime*100;q.width(e+"%")}var E=m(),y=t.iconClass||E.iconClass;if("undefined"!=typeof t.optionsOverride&&(E=e.extend(E,t.optionsOverride),y=t.optionsOverride.iconClass||y),!O(E,t)){T++,v=n(E,!0);var k=null,I=e("<div/>"),M=e("<div/>"),B=e("<div/>"),q=e("<div/>"),j=e(E.closeHtml),F={intervalId:null,hideEta:null,maxHideTime:null},P={toastId:T,state:"visible",startTime:new Date,options:E,map:t};return s(),r(),a(),f(P),E.debug&&console&&console.log(P),I}}function m(){return e.extend({},p(),b.options)}function h(e){v||(v=n()),e.is(":visible")||(e.remove(),e=null,0===v.children().length&&(v.remove(),w=void 0))}var v,C,w,T=0,O={error:"error",info:"info",success:"success",warning:"warning"},b={clear:r,remove:c,error:t,getContainer:n,info:o,options:{},subscribe:s,success:i,version:"2.1.4",warning:a};return b}()})}("function"==typeof define&&define.amd?define:function(e,t){"undefined"!=typeof module&&module.exports?module.exports=t(require("jquery")):window.toastr=t(window.jQuery)});
//# sourceMappingURL=toastr.js.map

/*!
 * jquery-confirm v3.3.4 (http://craftpip.github.io/jquery-confirm/)
 * Author: Boniface Pereira
 * Website: www.craftpip.com
 * Contact: hey@craftpip.com
 *
 * Copyright 2013-2019 jquery-confirm
 * Licensed under MIT (https://github.com/craftpip/jquery-confirm/blob/master/LICENSE)
 */


/**
 * UMD (Universal Module Definition) to support CommonJS, AMD and browser
 * Thanks to https://github.com/umdjs/umd
 */
(function(factory){
    if(typeof define === 'function' && define.amd){
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    }else if(typeof module === 'object' && module.exports){
        // Node/CommonJS
        module.exports = function(root, jQuery){
            if(jQuery === undefined){
                // require('jQuery') returns a factory that requires window to
                // build a jQuery instance, we normalize how we use modules
                // that require this pattern but the window provided is a noop
                // if it's defined (how jquery works)
                if(typeof window !== 'undefined'){
                    jQuery = require('jquery');
                }
                else{
                    jQuery = require('jquery')(root);
                }
            }
            factory(jQuery);
            return jQuery;
        };
    }else{
        // Browser globals
        factory(jQuery);
    }
}(function($){
    "use strict";

    // locally assign window
    var w = window;
    // w.jconfirm
    // w.Jconfirm;

    $.fn.confirm = function(options, option2){
        if(typeof options === 'undefined') options = {};
        if(typeof options === 'string'){
            options = {
                content: options,
                title: (option2) ? option2 : false
            };
        }
        /*
         *  Alias of $.confirm to emulate native confirm()
         */
        $(this).each(function(){
            var $this = $(this);
            if($this.attr('jc-attached')){
                console.warn('jConfirm has already been attached to this element ', $this[0]);
                return;
            }

            $this.on('click', function(e){
                e.preventDefault();
                var jcOption = $.extend({}, options);
                if($this.attr('data-title'))
                    jcOption['title'] = $this.attr('data-title');
                if($this.attr('data-content'))
                    jcOption['content'] = $this.attr('data-content');
                if(typeof jcOption['buttons'] === 'undefined')
                    jcOption['buttons'] = {};

                jcOption['$target'] = $this;
                if($this.attr('href') && Object.keys(jcOption['buttons']).length === 0){
                    var buttons = $.extend(true, {}, w.jconfirm.pluginDefaults.defaultButtons, (w.jconfirm.defaults || {}).defaultButtons || {});
                    var firstBtn = Object.keys(buttons)[0];
                    jcOption['buttons'] = buttons;
                    jcOption.buttons[firstBtn].action = function(){
                        location.href = $this.attr('href');
                    };
                }
                jcOption['closeIcon'] = false;
                var instance = $.confirm(jcOption);
            });

            $this.attr('jc-attached', true);
        });
        return $(this);
    };
    $.confirm = function(options, option2){
        if(typeof options === 'undefined') options = {};
        if(typeof options === 'string'){
            options = {
                content: options,
                title: (option2) ? option2 : false
            };
        }

        var putDefaultButtons = !(options['buttons'] === false);

        if(typeof options['buttons'] !== 'object')
            options['buttons'] = {};

        if(Object.keys(options['buttons']).length === 0 && putDefaultButtons){
            var buttons = $.extend(true, {}, w.jconfirm.pluginDefaults.defaultButtons, (w.jconfirm.defaults || {}).defaultButtons || {});
            options['buttons'] = buttons;
        }

        /*
         *  Alias of jconfirm
         */
        return w.jconfirm(options);
    };
    $.alert = function(options, option2){
        if(typeof options === 'undefined') options = {};
        if(typeof options === 'string'){
            options = {
                content: options,
                title: (option2) ? option2 : false
            };
        }

        var putDefaultButtons = !(options['buttons'] === false);

        if(typeof options.buttons !== 'object')
            options.buttons = {};

        if(Object.keys(options['buttons']).length === 0 && putDefaultButtons){
            var buttons = $.extend(true, {}, w.jconfirm.pluginDefaults.defaultButtons, (w.jconfirm.defaults || {}).defaultButtons || {});
            var firstBtn = Object.keys(buttons)[0];
            options['buttons'][firstBtn] = buttons[firstBtn];
        }
        /*
         *  Alias of jconfirm
         */
        return w.jconfirm(options);
    };
    $.dialog = function(options, option2){
        if(typeof options === 'undefined') options = {};
        if(typeof options === 'string'){
            options = {
                content: options,
                title: (option2) ? option2 : false,
                closeIcon: function(){
                    // Just close the modal
                }
            };
        }

        options['buttons'] = {}; // purge buttons

        if(typeof options['closeIcon'] === 'undefined'){
            // Dialog must have a closeIcon.
            options['closeIcon'] = function(){
            }
        }
        /*
         *  Alias of jconfirm
         */
        options.confirmKeys = [13];
        return w.jconfirm(options);
    };

    w.jconfirm = function(options){
        if(typeof options === 'undefined') options = {};
        /*
         * initial function for calling.
         */
        var pluginOptions = $.extend(true, {}, w.jconfirm.pluginDefaults);
        if(w.jconfirm.defaults){
            pluginOptions = $.extend(true, pluginOptions, w.jconfirm.defaults);
        }

        /*
         * merge options with plugin defaults.
         */
        pluginOptions = $.extend(true, {}, pluginOptions, options);
        var instance = new w.Jconfirm(pluginOptions);
        w.jconfirm.instances.push(instance);
        return instance;
    };
    w.Jconfirm = function(options){
        /*
         * constructor function Jconfirm,
         * options = user options.
         */
        $.extend(this, options);
        this._init();
    };
    w.Jconfirm.prototype = {
        _init: function(){
            var that = this;

            if(!w.jconfirm.instances.length)
                w.jconfirm.lastFocused = $('body').find(':focus');

            this._id = Math.round(Math.random() * 99999);
            /**
             * contentParsed maintains the contents for $content, before it is put in DOM
             */
            this.contentParsed = $(document.createElement('div'));

            if(!this.lazyOpen){
                setTimeout(function(){
                    that.open();
                }, 0);
            }
        },
        _buildHTML: function(){
            var that = this;

            // prefix the animation string and store in animationParsed
            this._parseAnimation(this.animation, 'o');
            this._parseAnimation(this.closeAnimation, 'c');
            this._parseBgDismissAnimation(this.backgroundDismissAnimation);
            this._parseColumnClass(this.columnClass);
            this._parseTheme(this.theme);
            this._parseType(this.type);

            /*
             * Append html.
             */
            var template = $(this.template);
            template.find('.jconfirm-box').addClass(this.animationParsed).addClass(this.backgroundDismissAnimationParsed).addClass(this.typeParsed);

            if(this.typeAnimated)
                template.find('.jconfirm-box').addClass('jconfirm-type-animated');

            if(this.useBootstrap){
                template.find('.jc-bs3-row').addClass(this.bootstrapClasses.row);
                template.find('.jc-bs3-row').addClass('justify-content-md-center justify-content-sm-center justify-content-xs-center justify-content-lg-center');

                template.find('.jconfirm-box-container').addClass(this.columnClassParsed);

                if(this.containerFluid)
                    template.find('.jc-bs3-container').addClass(this.bootstrapClasses.containerFluid);
                else
                    template.find('.jc-bs3-container').addClass(this.bootstrapClasses.container);
            }else{
                template.find('.jconfirm-box').css('width', this.boxWidth);
            }

            if(this.titleClass)
                template.find('.jconfirm-title-c').addClass(this.titleClass);

            template.addClass(this.themeParsed);
            var ariaLabel = 'jconfirm-box' + this._id;
            template.find('.jconfirm-box').attr('aria-labelledby', ariaLabel).attr('tabindex', -1);
            template.find('.jconfirm-content').attr('id', ariaLabel);
            if(this.bgOpacity !== null)
                template.find('.jconfirm-bg').css('opacity', this.bgOpacity);
            if(this.rtl)
                template.addClass('jconfirm-rtl');

            this.$el = template.appendTo(this.container);
            this.$jconfirmBoxContainer = this.$el.find('.jconfirm-box-container');
            this.$jconfirmBox = this.$body = this.$el.find('.jconfirm-box');
            this.$jconfirmBg = this.$el.find('.jconfirm-bg');
            this.$title = this.$el.find('.jconfirm-title');
            this.$titleContainer = this.$el.find('.jconfirm-title-c');
            this.$content = this.$el.find('div.jconfirm-content');
            this.$contentPane = this.$el.find('.jconfirm-content-pane');
            this.$icon = this.$el.find('.jconfirm-icon-c');
            this.$closeIcon = this.$el.find('.jconfirm-closeIcon');
            this.$holder = this.$el.find('.jconfirm-holder');
            // this.$content.css(this._getCSS(this.animationSpeed, this.animationBounce));
            this.$btnc = this.$el.find('.jconfirm-buttons');
            this.$scrollPane = this.$el.find('.jconfirm-scrollpane');

            that.setStartingPoint();

            // for loading content via URL
            this._contentReady = $.Deferred();
            this._modalReady = $.Deferred();
            this.$holder.css({
                'padding-top': this.offsetTop,
                'padding-bottom': this.offsetBottom,
            });

            this.setTitle();
            this.setIcon();
            this._setButtons();
            this._parseContent();
            this.initDraggable();

            if(this.isAjax)
                this.showLoading(false);

            $.when(this._contentReady, this._modalReady).then(function(){
                if(that.isAjaxLoading)
                    setTimeout(function(){
                        that.isAjaxLoading = false;
                        that.setContent();
                        that.setTitle();
                        that.setIcon();
                        setTimeout(function(){
                            that.hideLoading(false);
                            that._updateContentMaxHeight();
                        }, 100);
                        if(typeof that.onContentReady === 'function')
                            that.onContentReady();
                    }, 50);
                else{
                    // that.setContent();
                    that._updateContentMaxHeight();
                    that.setTitle();
                    that.setIcon();
                    if(typeof that.onContentReady === 'function')
                        that.onContentReady();
                }

                // start countdown after content has loaded.
                if(that.autoClose)
                    that._startCountDown();
            }).then(function(){
                that._watchContent();
            });

            if(this.animation === 'none'){
                this.animationSpeed = 1;
                this.animationBounce = 1;
            }

            this.$body.css(this._getCSS(this.animationSpeed, this.animationBounce));
            this.$contentPane.css(this._getCSS(this.animationSpeed, 1));
            this.$jconfirmBg.css(this._getCSS(this.animationSpeed, 1));
            this.$jconfirmBoxContainer.css(this._getCSS(this.animationSpeed, 1));
        },
        _typePrefix: 'jconfirm-type-',
        typeParsed: '',
        _parseType: function(type){
            this.typeParsed = this._typePrefix + type;
        },
        setType: function(type){
            var oldClass = this.typeParsed;
            this._parseType(type);
            this.$jconfirmBox.removeClass(oldClass).addClass(this.typeParsed);
        },
        themeParsed: '',
        _themePrefix: 'jconfirm-',
        setTheme: function(theme){
            var previous = this.theme;
            this.theme = theme || this.theme;
            this._parseTheme(this.theme);
            if(previous)
                this.$el.removeClass(previous);
            this.$el.addClass(this.themeParsed);
            this.theme = theme;
        },
        _parseTheme: function(theme){
            var that = this;
            theme = theme.split(',');
            $.each(theme, function(k, a){
                if(a.indexOf(that._themePrefix) === -1)
                    theme[k] = that._themePrefix + $.trim(a);
            });
            this.themeParsed = theme.join(' ').toLowerCase();
        },
        backgroundDismissAnimationParsed: '',
        _bgDismissPrefix: 'jconfirm-hilight-',
        _parseBgDismissAnimation: function(bgDismissAnimation){
            var animation = bgDismissAnimation.split(',');
            var that = this;
            $.each(animation, function(k, a){
                if(a.indexOf(that._bgDismissPrefix) === -1)
                    animation[k] = that._bgDismissPrefix + $.trim(a);
            });
            this.backgroundDismissAnimationParsed = animation.join(' ').toLowerCase();
        },
        animationParsed: '',
        closeAnimationParsed: '',
        _animationPrefix: 'jconfirm-animation-',
        setAnimation: function(animation){
            this.animation = animation || this.animation;
            this._parseAnimation(this.animation, 'o');
        },
        _parseAnimation: function(animation, which){
            which = which || 'o'; // parse what animation and store where. open or close?
            var animations = animation.split(',');
            var that = this;
            $.each(animations, function(k, a){
                if(a.indexOf(that._animationPrefix) === -1)
                    animations[k] = that._animationPrefix + $.trim(a);
            });
            var a_string = animations.join(' ').toLowerCase();
            if(which === 'o')
                this.animationParsed = a_string;
            else
                this.closeAnimationParsed = a_string;

            return a_string;
        },
        setCloseAnimation: function(closeAnimation){
            this.closeAnimation = closeAnimation || this.closeAnimation;
            this._parseAnimation(this.closeAnimation, 'c');
        },
        setAnimationSpeed: function(speed){
            this.animationSpeed = speed || this.animationSpeed;
            // this.$body.css(this._getCSS(this.animationSpeed, this.animationBounce));
        },
        columnClassParsed: '',
        setColumnClass: function(colClass){
            if(!this.useBootstrap){
                console.warn("cannot set columnClass, useBootstrap is set to false");
                return;
            }
            this.columnClass = colClass || this.columnClass;
            this._parseColumnClass(this.columnClass);
            this.$jconfirmBoxContainer.addClass(this.columnClassParsed);
        },
        _updateContentMaxHeight: function(){
            var height = $(window).height() - (this.$jconfirmBox.outerHeight() - this.$contentPane.outerHeight()) - (this.offsetTop + this.offsetBottom);
            this.$contentPane.css({
                'max-height': height + 'px'
            });
        },
        setBoxWidth: function(width){
            if(this.useBootstrap){
                console.warn("cannot set boxWidth, useBootstrap is set to true");
                return;
            }
            this.boxWidth = width;
            this.$jconfirmBox.css('width', width);
        },
        _parseColumnClass: function(colClass){
            colClass = colClass.toLowerCase();
            var p;
            switch(colClass){
                case 'xl':
                case 'xlarge':
                    p = 'col-md-12';
                    break;
                case 'l':
                case 'large':
                    p = 'col-md-8 col-md-offset-2';
                    break;
                case 'm':
                case 'medium':
                    p = 'col-md-6 col-md-offset-3';
                    break;
                case 's':
                case 'small':
                    p = 'col-md-4 col-md-offset-4';
                    break;
                case 'xs':
                case 'xsmall':
                    p = 'col-md-2 col-md-offset-5';
                    break;
                default:
                    p = colClass;
            }
            this.columnClassParsed = p;
        },
        initDraggable: function(){
            var that = this;
            var $t = this.$titleContainer;

            this.resetDrag();
            if(this.draggable){
                $t.on('mousedown', function(e){
                    $t.addClass('jconfirm-hand');
                    that.mouseX = e.clientX;
                    that.mouseY = e.clientY;
                    that.isDrag = true;
                });
                $(window).on('mousemove.' + this._id, function(e){
                    if(that.isDrag){
                        that.movingX = e.clientX - that.mouseX + that.initialX;
                        that.movingY = e.clientY - that.mouseY + that.initialY;
                        that.setDrag();
                    }
                });

                $(window).on('mouseup.' + this._id, function(){
                    $t.removeClass('jconfirm-hand');
                    if(that.isDrag){
                        that.isDrag = false;
                        that.initialX = that.movingX;
                        that.initialY = that.movingY;
                    }
                })
            }
        },
        resetDrag: function(){
            this.isDrag = false;
            this.initialX = 0;
            this.initialY = 0;
            this.movingX = 0;
            this.movingY = 0;
            this.mouseX = 0;
            this.mouseY = 0;
            this.$jconfirmBoxContainer.css('transform', 'translate(' + 0 + 'px, ' + 0 + 'px)');
        },
        setDrag: function(){
            if(!this.draggable)
                return;

            this.alignMiddle = false;
            var boxWidth = this.$jconfirmBox.outerWidth();
            var boxHeight = this.$jconfirmBox.outerHeight();
            var windowWidth = $(window).width();
            var windowHeight = $(window).height();
            var that = this;
            var dragUpdate = 1;
            if(that.movingX % dragUpdate === 0 || that.movingY % dragUpdate === 0){
                if(that.dragWindowBorder){
                    var leftDistance = (windowWidth / 2) - boxWidth / 2;
                    var topDistance = (windowHeight / 2) - boxHeight / 2;
                    topDistance -= that.dragWindowGap;
                    leftDistance -= that.dragWindowGap;

                    if(leftDistance + that.movingX < 0){
                        that.movingX = -leftDistance;
                    }else if(leftDistance - that.movingX < 0){
                        that.movingX = leftDistance;
                    }

                    if(topDistance + that.movingY < 0){
                        that.movingY = -topDistance;
                    }else if(topDistance - that.movingY < 0){
                        that.movingY = topDistance;
                    }
                }

                that.$jconfirmBoxContainer.css('transform', 'translate(' + that.movingX + 'px, ' + that.movingY + 'px)');
            }
        },
        _scrollTop: function(){
            if(typeof pageYOffset !== 'undefined'){
                //most browsers except IE before #9
                return pageYOffset;
            }
            else{
                var B = document.body; //IE 'quirks'
                var D = document.documentElement; //IE with doctype
                D = (D.clientHeight) ? D : B;
                return D.scrollTop;
            }
        },
        _watchContent: function(){
            var that = this;
            if(this._timer) clearInterval(this._timer);

            var prevContentHeight = 0;
            this._timer = setInterval(function(){
                if(that.smoothContent){
                    var contentHeight = that.$content.outerHeight() || 0;
                    if(contentHeight !== prevContentHeight){

                        // Commented out to prevent scroll to top when updating the content
                        // (for example when using ajax in forms in content)
                        // that.$contentPane.css({
                        //     'height': contentHeight
                        // }).scrollTop(0);
                        prevContentHeight = contentHeight;
                    }
                    var wh = $(window).height();
                    var total = that.offsetTop + that.offsetBottom + that.$jconfirmBox.height() - that.$contentPane.height() + that.$content.height();
                    if(total < wh){
                        that.$contentPane.addClass('no-scroll');
                    }else{
                        that.$contentPane.removeClass('no-scroll');
                    }
                }
            }, this.watchInterval);
        },
        _overflowClass: 'jconfirm-overflow',
        _hilightAnimating: false,
        highlight: function(){
            this.hiLightModal();
        },
        hiLightModal: function(){
            var that = this;
            if(this._hilightAnimating)
                return;

            that.$body.addClass('hilight');
            var duration = parseFloat(that.$body.css('animation-duration')) || 2;
            this._hilightAnimating = true;
            setTimeout(function(){
                that._hilightAnimating = false;
                that.$body.removeClass('hilight');
            }, duration * 1000);
        },
        _bindEvents: function(){
            var that = this;
            this.boxClicked = false;

            this.$scrollPane.click(function(e){ // Ignore propagated clicks
                if(!that.boxClicked){ // Background clicked
                    /*
                     If backgroundDismiss is a function and its return value is truthy
                     proceed to close the modal.
                     */
                    var buttonName = false;
                    var shouldClose = false;
                    var str;

                    if(typeof that.backgroundDismiss === 'function')
                        str = that.backgroundDismiss();
                    else
                        str = that.backgroundDismiss;

                    if(typeof str === 'string' && typeof that.buttons[str] !== 'undefined'){
                        buttonName = str;
                        shouldClose = false;
                    }else if(typeof str === 'undefined' || !!(str) === true){
                        shouldClose = true;
                    }else{
                        shouldClose = false;
                    }

                    if(buttonName){
                        var btnResponse = that.buttons[buttonName].action.apply(that);
                        shouldClose = (typeof btnResponse === 'undefined') || !!(btnResponse);
                    }

                    if(shouldClose)
                        that.close();
                    else
                        that.hiLightModal();
                }
                that.boxClicked = false;
            });

            this.$jconfirmBox.click(function(e){
                that.boxClicked = true;
            });

            var isKeyDown = false;
            $(window).on('jcKeyDown.' + that._id, function(e){
                if(!isKeyDown){
                    isKeyDown = true;
                }
            });
            $(window).on('keyup.' + that._id, function(e){
                if(isKeyDown){
                    that.reactOnKey(e);
                    isKeyDown = false;
                }
            });

            $(window).on('resize.' + this._id, function(){
                that._updateContentMaxHeight();
                setTimeout(function(){
                    that.resetDrag();
                }, 100);
            });
        },
        _cubic_bezier: '0.36, 0.55, 0.19',
        _getCSS: function(speed, bounce){
            return {
                '-webkit-transition-duration': speed / 1000 + 's',
                'transition-duration': speed / 1000 + 's',
                '-webkit-transition-timing-function': 'cubic-bezier(' + this._cubic_bezier + ', ' + bounce + ')',
                'transition-timing-function': 'cubic-bezier(' + this._cubic_bezier + ', ' + bounce + ')'
            };
        },
        _setButtons: function(){
            var that = this;
            /*
             * Settings up buttons
             */

            var total_buttons = 0;
            if(typeof this.buttons !== 'object')
                this.buttons = {};

            $.each(this.buttons, function(key, button){
                total_buttons += 1;
                if(typeof button === 'function'){
                    that.buttons[key] = button = {
                        action: button
                    };
                }

                that.buttons[key].text = button.text || key;
                that.buttons[key].btnClass = button.btnClass || 'btn-default';
                that.buttons[key].action = button.action || function(){
                };
                that.buttons[key].keys = button.keys || [];
                that.buttons[key].isHidden = button.isHidden || false;
                that.buttons[key].isDisabled = button.isDisabled || false;

                $.each(that.buttons[key].keys, function(i, a){
                    that.buttons[key].keys[i] = a.toLowerCase();
                });

                var button_element = $('<button type="button" class="btn"></button>')
                    .html(that.buttons[key].text)
                    .addClass(that.buttons[key].btnClass)
                    .prop('disabled', that.buttons[key].isDisabled)
                    .css('display', that.buttons[key].isHidden ? 'none' : '')
                    .click(function(e){
                        e.preventDefault();
                        var res = that.buttons[key].action.apply(that, [that.buttons[key]]);
                        that.onAction.apply(that, [key, that.buttons[key]]);
                        that._stopCountDown();
                        if(typeof res === 'undefined' || res)
                            that.close();
                    });

                that.buttons[key].el = button_element;
                that.buttons[key].setText = function(text){
                    button_element.html(text);
                };
                that.buttons[key].addClass = function(className){
                    button_element.addClass(className);
                };
                that.buttons[key].removeClass = function(className){
                    button_element.removeClass(className);
                };
                that.buttons[key].disable = function(){
                    that.buttons[key].isDisabled = true;
                    button_element.prop('disabled', true);
                };
                that.buttons[key].enable = function(){
                    that.buttons[key].isDisabled = false;
                    button_element.prop('disabled', false);
                };
                that.buttons[key].show = function(){
                    that.buttons[key].isHidden = false;
                    button_element.css('display', '');
                };
                that.buttons[key].hide = function(){
                    that.buttons[key].isHidden = true;
                    button_element.css('display', 'none');
                };
                /*
                 Buttons are prefixed with $_ or $$ for quick access
                 */
                that['$_' + key] = that['$$' + key] = button_element;
                that.$btnc.append(button_element);
            });

            if(total_buttons === 0) this.$btnc.hide();
            if(this.closeIcon === null && total_buttons === 0){
                /*
                 in case when no buttons are present & closeIcon is null, closeIcon is set to true,
                 set closeIcon to true to explicitly tell to hide the close icon
                 */
                this.closeIcon = true;
            }

            if(this.closeIcon){
                if(this.closeIconClass){
                    // user requires a custom class.
                    var closeHtml = '<i class="' + this.closeIconClass + '"></i>';
                    this.$closeIcon.html(closeHtml);
                }

                this.$closeIcon.click(function(e){
                    e.preventDefault();

                    var buttonName = false;
                    var shouldClose = false;
                    var str;

                    if(typeof that.closeIcon === 'function'){
                        str = that.closeIcon();
                    }else{
                        str = that.closeIcon;
                    }

                    if(typeof str === 'string' && typeof that.buttons[str] !== 'undefined'){
                        buttonName = str;
                        shouldClose = false;
                    }else if(typeof str === 'undefined' || !!(str) === true){
                        shouldClose = true;
                    }else{
                        shouldClose = false;
                    }
                    if(buttonName){
                        var btnResponse = that.buttons[buttonName].action.apply(that);
                        shouldClose = (typeof btnResponse === 'undefined') || !!(btnResponse);
                    }
                    if(shouldClose){
                        that.close();
                    }
                });
                this.$closeIcon.show();
            }else{
                this.$closeIcon.hide();
            }
        },
        setTitle: function(string, force){
            force = force || false;

            if(typeof string !== 'undefined')
                if(typeof string === 'string')
                    this.title = string;
                else if(typeof string === 'function'){
                    if(typeof string.promise === 'function')
                        console.error('Promise was returned from title function, this is not supported.');

                    var response = string();
                    if(typeof response === 'string')
                        this.title = response;
                    else
                        this.title = false;
                }else
                    this.title = false;

            if(this.isAjaxLoading && !force)
                return;

            this.$title.html(this.title || '');
            this.updateTitleContainer();
        },
        setIcon: function(iconClass, force){
            force = force || false;

            if(typeof iconClass !== 'undefined')
                if(typeof iconClass === 'string')
                    this.icon = iconClass;
                else if(typeof iconClass === 'function'){
                    var response = iconClass();
                    if(typeof response === 'string')
                        this.icon = response;
                    else
                        this.icon = false;
                }
                else
                    this.icon = false;

            if(this.isAjaxLoading && !force)
                return;

            this.$icon.html(this.icon ? '<i class="' + this.icon + '"></i>' : '');
            this.updateTitleContainer();
        },
        updateTitleContainer: function(){
            if(!this.title && !this.icon){
                this.$titleContainer.hide();
            }else{
                this.$titleContainer.show();
            }
        },
        setContentPrepend: function(content, force){
            if(!content)
                return;

            this.contentParsed.prepend(content);
        },
        setContentAppend: function(content){
            if(!content)
                return;

            this.contentParsed.append(content);
        },
        setContent: function(content, force){
            force = !!force;
            var that = this;
            if(content)
                this.contentParsed.html('').append(content);
            if(this.isAjaxLoading && !force)
                return;

            this.$content.html('');
            this.$content.append(this.contentParsed);
            setTimeout(function(){
                that.$body.find('input[autofocus]:visible:first').focus();
            }, 100);
        },
        loadingSpinner: false,
        showLoading: function(disableButtons){
            this.loadingSpinner = true;
            this.$jconfirmBox.addClass('loading');
            if(disableButtons)
                this.$btnc.find('button').prop('disabled', true);

        },
        hideLoading: function(enableButtons){
            this.loadingSpinner = false;
            this.$jconfirmBox.removeClass('loading');
            if(enableButtons)
                this.$btnc.find('button').prop('disabled', false);

        },
        ajaxResponse: false,
        contentParsed: '',
        isAjax: false,
        isAjaxLoading: false,
        _parseContent: function(){
            var that = this;
            var e = '&nbsp;';

            if(typeof this.content === 'function'){
                var res = this.content.apply(this);
                if(typeof res === 'string'){
                    this.content = res;
                }
                else if(typeof res === 'object' && typeof res.always === 'function'){
                    // this is ajax loading via promise
                    this.isAjax = true;
                    this.isAjaxLoading = true;
                    res.always(function(data, status, xhr){
                        that.ajaxResponse = {
                            data: data,
                            status: status,
                            xhr: xhr
                        };
                        that._contentReady.resolve(data, status, xhr);
                        if(typeof that.contentLoaded === 'function')
                            that.contentLoaded(data, status, xhr);
                    });
                    this.content = e;
                }else{
                    this.content = e;
                }
            }

            if(typeof this.content === 'string' && this.content.substr(0, 4).toLowerCase() === 'url:'){
                this.isAjax = true;
                this.isAjaxLoading = true;
                var u = this.content.substring(4, this.content.length);
                $.get(u).done(function(html){
                    that.contentParsed.html(html);
                }).always(function(data, status, xhr){
                    that.ajaxResponse = {
                        data: data,
                        status: status,
                        xhr: xhr
                    };
                    that._contentReady.resolve(data, status, xhr);
                    if(typeof that.contentLoaded === 'function')
                        that.contentLoaded(data, status, xhr);
                });
            }

            if(!this.content)
                this.content = e;

            if(!this.isAjax){
                this.contentParsed.html(this.content);
                this.setContent();
                that._contentReady.resolve();
            }
        },
        _stopCountDown: function(){
            clearInterval(this.autoCloseInterval);
            if(this.$cd)
                this.$cd.remove();
        },
        _startCountDown: function(){
            var that = this;
            var opt = this.autoClose.split('|');
            if(opt.length !== 2){
                console.error('Invalid option for autoClose. example \'close|10000\'');
                return false;
            }

            var button_key = opt[0];
            var time = parseInt(opt[1]);
            if(typeof this.buttons[button_key] === 'undefined'){
                console.error('Invalid button key \'' + button_key + '\' for autoClose');
                return false;
            }

            var seconds = Math.ceil(time / 1000);
            this.$cd = $('<span class="countdown"> (' + seconds + ')</span>')
                .appendTo(this['$_' + button_key]);

            this.autoCloseInterval = setInterval(function(){
                that.$cd.html(' (' + (seconds -= 1) + ') ');
                if(seconds <= 0){
                    that['$$' + button_key].trigger('click');
                    that._stopCountDown();
                }
            }, 1000);
        },
        _getKey: function(key){
            // very necessary keys.
            switch(key){
                case 192:
                    return 'tilde';
                case 13:
                    return 'enter';
                case 16:
                    return 'shift';
                case 9:
                    return 'tab';
                case 20:
                    return 'capslock';
                case 17:
                    return 'ctrl';
                case 91:
                    return 'win';
                case 18:
                    return 'alt';
                case 27:
                    return 'esc';
                case 32:
                    return 'space';
            }

            // only trust alphabets with this.
            var initial = String.fromCharCode(key);
            if(/^[A-z0-9]+$/.test(initial))
                return initial.toLowerCase();
            else
                return false;
        },
        reactOnKey: function(e){
            var that = this;

            /*
             Prevent keyup event if the dialog is not last!
             */
            var a = $('.jconfirm');
            if(a.eq(a.length - 1)[0] !== this.$el[0])
                return false;

            var key = e.which;
            /*
             Do not react if Enter or Space is pressed on input elements
             */
            if(this.$content.find(':input').is(':focus') && /13|32/.test(key))
                return false;

            var keyChar = this._getKey(key);

            // If esc is pressed
            if(keyChar === 'esc' && this.escapeKey){
                if(this.escapeKey === true){
                    this.$scrollPane.trigger('click');
                }
                else if(typeof this.escapeKey === 'string' || typeof this.escapeKey === 'function'){
                    var buttonKey;
                    if(typeof this.escapeKey === 'function'){
                        buttonKey = this.escapeKey();
                    }else{
                        buttonKey = this.escapeKey;
                    }

                    if(buttonKey)
                        if(typeof this.buttons[buttonKey] === 'undefined'){
                            console.warn('Invalid escapeKey, no buttons found with key ' + buttonKey);
                        }else{
                            this['$_' + buttonKey].trigger('click');
                        }
                }
            }

            // check if any button is listening to this key.
            $.each(this.buttons, function(key, button){
                if(button.keys.indexOf(keyChar) !== -1){
                    that['$_' + key].trigger('click');
                }
            });
        },
        setDialogCenter: function(){
            console.info('setDialogCenter is deprecated, dialogs are centered with CSS3 tables');
        },
        _unwatchContent: function(){
            clearInterval(this._timer);
        },
        close: function(onClosePayload){
            var that = this;

            if(typeof this.onClose === 'function')
                this.onClose(onClosePayload);

            this._unwatchContent();

            /*
             unbind the window resize & keyup event.
             */
            $(window).unbind('resize.' + this._id);
            $(window).unbind('keyup.' + this._id);
            $(window).unbind('jcKeyDown.' + this._id);

            if(this.draggable){
                $(window).unbind('mousemove.' + this._id);
                $(window).unbind('mouseup.' + this._id);
                this.$titleContainer.unbind('mousedown');
            }

            that.$el.removeClass(that.loadedClass);
            $('body').removeClass('jconfirm-no-scroll-' + that._id);
            that.$jconfirmBoxContainer.removeClass('jconfirm-no-transition');

            setTimeout(function(){
                that.$body.addClass(that.closeAnimationParsed);
                that.$jconfirmBg.addClass('jconfirm-bg-h');
                var closeTimer = (that.closeAnimation === 'none') ? 1 : that.animationSpeed;

                setTimeout(function(){
                    that.$el.remove();

                    var l = w.jconfirm.instances;
                    var i = w.jconfirm.instances.length - 1;
                    for(i; i >= 0; i--){
                        if(w.jconfirm.instances[i]._id === that._id){
                            w.jconfirm.instances.splice(i, 1);
                        }
                    }

                    // Focusing a element, scrolls automatically to that element.
                    // no instances should be open, lastFocused should be true, the lastFocused element must exists in DOM
                    if(!w.jconfirm.instances.length){
                        if(that.scrollToPreviousElement && w.jconfirm.lastFocused && w.jconfirm.lastFocused.length && $.contains(document, w.jconfirm.lastFocused[0])){
                            var $lf = w.jconfirm.lastFocused;
                            if(that.scrollToPreviousElementAnimate){
                                var st = $(window).scrollTop();
                                var ot = w.jconfirm.lastFocused.offset().top;
                                var wh = $(window).height();
                                if(!(ot > st && ot < (st + wh))){
                                    var scrollTo = (ot - Math.round((wh / 3)));
                                    $('html, body').animate({
                                        scrollTop: scrollTo
                                    }, that.animationSpeed, 'swing', function(){
                                        // gracefully scroll and then focus.
                                        $lf.focus();
                                    });
                                }else{
                                    // the element to be focused is already in view.
                                    $lf.focus();
                                }
                            }else{
                                $lf.focus();
                            }
                            w.jconfirm.lastFocused = false;
                        }
                    }

                    if(typeof that.onDestroy === 'function')
                        that.onDestroy();

                }, closeTimer * 0.40);
            }, 50);

            return true;
        },
        open: function(){
            if(this.isOpen())
                return false;

            // var that = this;
            this._buildHTML();
            this._bindEvents();
            this._open();

            return true;
        },
        setStartingPoint: function(){
            var el = false;

            if(this.animateFromElement !== true && this.animateFromElement){
                el = this.animateFromElement;
                w.jconfirm.lastClicked = false;
            }else if(w.jconfirm.lastClicked && this.animateFromElement === true){
                el = w.jconfirm.lastClicked;
                w.jconfirm.lastClicked = false;
            }else{
                return false;
            }

            if(!el)
                return false;

            var offset = el.offset();

            var iTop = el.outerHeight() / 2;
            var iLeft = el.outerWidth() / 2;

            // placing position of jconfirm modal in center of clicked element
            iTop -= this.$jconfirmBox.outerHeight() / 2;
            iLeft -= this.$jconfirmBox.outerWidth() / 2;

            // absolute position on screen
            var sourceTop = offset.top + iTop;
            sourceTop = sourceTop - this._scrollTop();
            var sourceLeft = offset.left + iLeft;

            // window halved
            var wh = $(window).height() / 2;
            var ww = $(window).width() / 2;

            var targetH = wh - this.$jconfirmBox.outerHeight() / 2;
            var targetW = ww - this.$jconfirmBox.outerWidth() / 2;

            sourceTop -= targetH;
            sourceLeft -= targetW;

            // Check if the element is inside the viewable window.
            if(Math.abs(sourceTop) > wh || Math.abs(sourceLeft) > ww)
                return false;

            this.$jconfirmBoxContainer.css('transform', 'translate(' + sourceLeft + 'px, ' + sourceTop + 'px)');
        },
        _open: function(){
            var that = this;
            if(typeof that.onOpenBefore === 'function')
                that.onOpenBefore();

            this.$body.removeClass(this.animationParsed);
            this.$jconfirmBg.removeClass('jconfirm-bg-h');
            this.$body.focus();

            that.$jconfirmBoxContainer.css('transform', 'translate(' + 0 + 'px, ' + 0 + 'px)');

            setTimeout(function(){
                that.$body.css(that._getCSS(that.animationSpeed, 1));
                that.$body.css({
                    'transition-property': that.$body.css('transition-property') + ', margin'
                });
                that.$jconfirmBoxContainer.addClass('jconfirm-no-transition');
                that._modalReady.resolve();
                if(typeof that.onOpen === 'function')
                    that.onOpen();

                that.$el.addClass(that.loadedClass);
            }, this.animationSpeed);
        },
        loadedClass: 'jconfirm-open',
        isClosed: function(){
            return !this.$el || this.$el.parent().length === 0;
        },
        isOpen: function(){
            return !this.isClosed();
        },
        toggle: function(){
            if(!this.isOpen())
                this.open();
            else
                this.close();
        }
    };

    w.jconfirm.instances = [];
    w.jconfirm.lastFocused = false;
    w.jconfirm.pluginDefaults = {
        template: '' +
            '<div class="jconfirm">' +
            '<div class="jconfirm-bg jconfirm-bg-h"></div>' +
            '<div class="jconfirm-scrollpane">' +
            '<div class="jconfirm-row">' +
            '<div class="jconfirm-cell">' +
            '<div class="jconfirm-holder">' +
            '<div class="jc-bs3-container">' +
            '<div class="jc-bs3-row">' +
            '<div class="jconfirm-box-container jconfirm-animated">' +
            '<div class="jconfirm-box" role="dialog" aria-labelledby="labelled" tabindex="-1">' +
            '<div class="jconfirm-closeIcon">&times;</div>' +
            '<div class="jconfirm-title-c">' +
            '<span class="jconfirm-icon-c"></span>' +
            '<span class="jconfirm-title"></span>' +
            '</div>' +
            '<div class="jconfirm-content-pane">' +
            '<div class="jconfirm-content"></div>' +
            '</div>' +
            '<div class="jconfirm-buttons">' +
            '</div>' +
            '<div class="jconfirm-clear">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div></div>',
        title: 'Hello',
        titleClass: '',
        type: 'default',
        typeAnimated: true,
        draggable: true,
        dragWindowGap: 15,
        dragWindowBorder: true,
        animateFromElement: true,
        /**
         * @deprecated
         */
        alignMiddle: true,
        smoothContent: true,
        content: 'Are you sure to continue?',
        buttons: {},
        defaultButtons: {
            ok: {
                action: function(){
                }
            },
            close: {
                action: function(){
                }
            }
        },
        contentLoaded: function(){
        },
        icon: '',
        lazyOpen: false,
        bgOpacity: null,
        theme: 'light',
        animation: 'scale',
        closeAnimation: 'scale',
        animationSpeed: 400,
        animationBounce: 1,
        escapeKey: true,
        rtl: false,
        container: 'body',
        containerFluid: false,
        backgroundDismiss: false,
        backgroundDismissAnimation: 'shake',
        autoClose: false,
        closeIcon: null,
        closeIconClass: false,
        watchInterval: 100,
        columnClass: 'col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1',
        boxWidth: '50%',
        scrollToPreviousElement: true,
        scrollToPreviousElementAnimate: true,
        useBootstrap: true,
        offsetTop: 40,
        offsetBottom: 40,
        bootstrapClasses: {
            container: 'container',
            containerFluid: 'container-fluid',
            row: 'row'
        },
        onContentReady: function(){

        },
        onOpenBefore: function(){

        },
        onOpen: function(){

        },
        onClose: function(){

        },
        onDestroy: function(){

        },
        onAction: function(){

        }
    };

    /**
     * This refers to the issue #241 and #246
     *
     * Problem:
     * Button A is clicked (keydown) using the Keyboard ENTER key
     * A opens the jconfirm modal B,
     * B has registered ENTER key for one of its button C
     * A is released (keyup), B gets the keyup event and triggers C.
     *
     * Solution:
     * Register a global keydown event, that tells jconfirm if the keydown originated inside jconfirm
     */
    var keyDown = false;
    $(window).on('keydown', function(e){
        if(!keyDown){
            var $target = $(e.target);
            var pass = false;
            if($target.closest('.jconfirm-box').length)
                pass = true;
            if(pass)
                $(window).trigger('jcKeyDown');

            keyDown = true;
        }
    });
    $(window).on('keyup', function(){
        keyDown = false;
    });
    w.jconfirm.lastClicked = false;
    $(document).on('mousedown', 'button, a, [jc-source]', function(){
        w.jconfirm.lastClicked = $(this);
    });
}));

/*
 * This combined file was created by the DataTables downloader builder:
 *   https://datatables.net/download
 *
 * To rebuild or modify this file with the latest versions of the included
 * software please visit:
 *   https://datatables.net/download/#bs4/dt-1.10.23/b-1.6.5/r-2.2.7/sl-1.3.1
 *
 * Included libraries:
 *   DataTables 1.10.23, Buttons 1.6.5, Responsive 2.2.7, Select 1.3.1
 */

/*!
   Copyright 2008-2020 SpryMedia Ltd.

 This source file is free software, available under the following license:
   MIT license - http://datatables.net/license

 This source file is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.

 For details please refer to: http://www.datatables.net
 DataTables 1.10.23
 ©2008-2020 SpryMedia Ltd - datatables.net/license
*/
var $jscomp=$jscomp||{};$jscomp.scope={};$jscomp.findInternal=function(k,y,z){k instanceof String&&(k=String(k));for(var q=k.length,G=0;G<q;G++){var O=k[G];if(y.call(z,O,G,k))return{i:G,v:O}}return{i:-1,v:void 0}};$jscomp.ASSUME_ES5=!1;$jscomp.ASSUME_NO_NATIVE_MAP=!1;$jscomp.ASSUME_NO_NATIVE_SET=!1;$jscomp.SIMPLE_FROUND_POLYFILL=!1;$jscomp.ISOLATE_POLYFILLS=!1;
$jscomp.defineProperty=$jscomp.ASSUME_ES5||"function"==typeof Object.defineProperties?Object.defineProperty:function(k,y,z){if(k==Array.prototype||k==Object.prototype)return k;k[y]=z.value;return k};$jscomp.getGlobal=function(k){k=["object"==typeof globalThis&&globalThis,k,"object"==typeof window&&window,"object"==typeof self&&self,"object"==typeof global&&global];for(var y=0;y<k.length;++y){var z=k[y];if(z&&z.Math==Math)return z}throw Error("Cannot find global object");};$jscomp.global=$jscomp.getGlobal(this);
$jscomp.IS_SYMBOL_NATIVE="function"===typeof Symbol&&"symbol"===typeof Symbol("x");$jscomp.TRUST_ES6_POLYFILLS=!$jscomp.ISOLATE_POLYFILLS||$jscomp.IS_SYMBOL_NATIVE;$jscomp.polyfills={};$jscomp.propertyToPolyfillSymbol={};$jscomp.POLYFILL_PREFIX="$jscp$";var $jscomp$lookupPolyfilledValue=function(k,y){var z=$jscomp.propertyToPolyfillSymbol[y];if(null==z)return k[y];z=k[z];return void 0!==z?z:k[y]};
$jscomp.polyfill=function(k,y,z,q){y&&($jscomp.ISOLATE_POLYFILLS?$jscomp.polyfillIsolated(k,y,z,q):$jscomp.polyfillUnisolated(k,y,z,q))};$jscomp.polyfillUnisolated=function(k,y,z,q){z=$jscomp.global;k=k.split(".");for(q=0;q<k.length-1;q++){var G=k[q];if(!(G in z))return;z=z[G]}k=k[k.length-1];q=z[k];y=y(q);y!=q&&null!=y&&$jscomp.defineProperty(z,k,{configurable:!0,writable:!0,value:y})};
$jscomp.polyfillIsolated=function(k,y,z,q){var G=k.split(".");k=1===G.length;q=G[0];q=!k&&q in $jscomp.polyfills?$jscomp.polyfills:$jscomp.global;for(var O=0;O<G.length-1;O++){var ma=G[O];if(!(ma in q))return;q=q[ma]}G=G[G.length-1];z=$jscomp.IS_SYMBOL_NATIVE&&"es6"===z?q[G]:null;y=y(z);null!=y&&(k?$jscomp.defineProperty($jscomp.polyfills,G,{configurable:!0,writable:!0,value:y}):y!==z&&($jscomp.propertyToPolyfillSymbol[G]=$jscomp.IS_SYMBOL_NATIVE?$jscomp.global.Symbol(G):$jscomp.POLYFILL_PREFIX+G,
G=$jscomp.propertyToPolyfillSymbol[G],$jscomp.defineProperty(q,G,{configurable:!0,writable:!0,value:y})))};$jscomp.polyfill("Array.prototype.find",function(k){return k?k:function(y,z){return $jscomp.findInternal(this,y,z).v}},"es6","es3");
(function(k){"function"===typeof define&&define.amd?define(["jquery"],function(y){return k(y,window,document)}):"object"===typeof exports?module.exports=function(y,z){y||(y=window);z||(z="undefined"!==typeof window?require("jquery"):require("jquery")(y));return k(z,y,y.document)}:k(jQuery,window,document)})(function(k,y,z,q){function G(a){var b,c,d={};k.each(a,function(e,f){(b=e.match(/^([^A-Z]+?)([A-Z])/))&&-1!=="a aa ai ao as b fn i m o s ".indexOf(b[1]+" ")&&(c=e.replace(b[0],b[2].toLowerCase()),
d[c]=e,"o"===b[1]&&G(a[e]))});a._hungarianMap=d}function O(a,b,c){a._hungarianMap||G(a);var d;k.each(b,function(e,f){d=a._hungarianMap[e];d===q||!c&&b[d]!==q||("o"===d.charAt(0)?(b[d]||(b[d]={}),k.extend(!0,b[d],b[e]),O(a[d],b[d],c)):b[d]=b[e])})}function ma(a){var b=u.defaults.oLanguage,c=b.sDecimal;c&&Va(c);if(a){var d=a.sZeroRecords;!a.sEmptyTable&&d&&"No data available in table"===b.sEmptyTable&&V(a,a,"sZeroRecords","sEmptyTable");!a.sLoadingRecords&&d&&"Loading..."===b.sLoadingRecords&&V(a,a,
"sZeroRecords","sLoadingRecords");a.sInfoThousands&&(a.sThousands=a.sInfoThousands);(a=a.sDecimal)&&c!==a&&Va(a)}}function yb(a){R(a,"ordering","bSort");R(a,"orderMulti","bSortMulti");R(a,"orderClasses","bSortClasses");R(a,"orderCellsTop","bSortCellsTop");R(a,"order","aaSorting");R(a,"orderFixed","aaSortingFixed");R(a,"paging","bPaginate");R(a,"pagingType","sPaginationType");R(a,"pageLength","iDisplayLength");R(a,"searching","bFilter");"boolean"===typeof a.sScrollX&&(a.sScrollX=a.sScrollX?"100%":
"");"boolean"===typeof a.scrollX&&(a.scrollX=a.scrollX?"100%":"");if(a=a.aoSearchCols)for(var b=0,c=a.length;b<c;b++)a[b]&&O(u.models.oSearch,a[b])}function zb(a){R(a,"orderable","bSortable");R(a,"orderData","aDataSort");R(a,"orderSequence","asSorting");R(a,"orderDataType","sortDataType");var b=a.aDataSort;"number"!==typeof b||Array.isArray(b)||(a.aDataSort=[b])}function Ab(a){if(!u.__browser){var b={};u.__browser=b;var c=k("<div/>").css({position:"fixed",top:0,left:-1*k(y).scrollLeft(),height:1,
width:1,overflow:"hidden"}).append(k("<div/>").css({position:"absolute",top:1,left:1,width:100,overflow:"scroll"}).append(k("<div/>").css({width:"100%",height:10}))).appendTo("body"),d=c.children(),e=d.children();b.barWidth=d[0].offsetWidth-d[0].clientWidth;b.bScrollOversize=100===e[0].offsetWidth&&100!==d[0].clientWidth;b.bScrollbarLeft=1!==Math.round(e.offset().left);b.bBounding=c[0].getBoundingClientRect().width?!0:!1;c.remove()}k.extend(a.oBrowser,u.__browser);a.oScroll.iBarWidth=u.__browser.barWidth}
function Bb(a,b,c,d,e,f){var g=!1;if(c!==q){var h=c;g=!0}for(;d!==e;)a.hasOwnProperty(d)&&(h=g?b(h,a[d],d,a):a[d],g=!0,d+=f);return h}function Wa(a,b){var c=u.defaults.column,d=a.aoColumns.length;c=k.extend({},u.models.oColumn,c,{nTh:b?b:z.createElement("th"),sTitle:c.sTitle?c.sTitle:b?b.innerHTML:"",aDataSort:c.aDataSort?c.aDataSort:[d],mData:c.mData?c.mData:d,idx:d});a.aoColumns.push(c);c=a.aoPreSearchCols;c[d]=k.extend({},u.models.oSearch,c[d]);Da(a,d,k(b).data())}function Da(a,b,c){b=a.aoColumns[b];
var d=a.oClasses,e=k(b.nTh);if(!b.sWidthOrig){b.sWidthOrig=e.attr("width")||null;var f=(e.attr("style")||"").match(/width:\s*(\d+[pxem%]+)/);f&&(b.sWidthOrig=f[1])}c!==q&&null!==c&&(zb(c),O(u.defaults.column,c,!0),c.mDataProp===q||c.mData||(c.mData=c.mDataProp),c.sType&&(b._sManualType=c.sType),c.className&&!c.sClass&&(c.sClass=c.className),c.sClass&&e.addClass(c.sClass),k.extend(b,c),V(b,c,"sWidth","sWidthOrig"),c.iDataSort!==q&&(b.aDataSort=[c.iDataSort]),V(b,c,"aDataSort"));var g=b.mData,h=ia(g),
l=b.mRender?ia(b.mRender):null;c=function(n){return"string"===typeof n&&-1!==n.indexOf("@")};b._bAttrSrc=k.isPlainObject(g)&&(c(g.sort)||c(g.type)||c(g.filter));b._setter=null;b.fnGetData=function(n,m,p){var t=h(n,m,q,p);return l&&m?l(t,m,n,p):t};b.fnSetData=function(n,m,p){return da(g)(n,m,p)};"number"!==typeof g&&(a._rowReadObject=!0);a.oFeatures.bSort||(b.bSortable=!1,e.addClass(d.sSortableNone));a=-1!==k.inArray("asc",b.asSorting);c=-1!==k.inArray("desc",b.asSorting);b.bSortable&&(a||c)?a&&!c?
(b.sSortingClass=d.sSortableAsc,b.sSortingClassJUI=d.sSortJUIAscAllowed):!a&&c?(b.sSortingClass=d.sSortableDesc,b.sSortingClassJUI=d.sSortJUIDescAllowed):(b.sSortingClass=d.sSortable,b.sSortingClassJUI=d.sSortJUI):(b.sSortingClass=d.sSortableNone,b.sSortingClassJUI="")}function ra(a){if(!1!==a.oFeatures.bAutoWidth){var b=a.aoColumns;Xa(a);for(var c=0,d=b.length;c<d;c++)b[c].nTh.style.width=b[c].sWidth}b=a.oScroll;""===b.sY&&""===b.sX||Ea(a);I(a,null,"column-sizing",[a])}function sa(a,b){a=Fa(a,"bVisible");
return"number"===typeof a[b]?a[b]:null}function ta(a,b){a=Fa(a,"bVisible");b=k.inArray(b,a);return-1!==b?b:null}function na(a){var b=0;k.each(a.aoColumns,function(c,d){d.bVisible&&"none"!==k(d.nTh).css("display")&&b++});return b}function Fa(a,b){var c=[];k.map(a.aoColumns,function(d,e){d[b]&&c.push(e)});return c}function Ya(a){var b=a.aoColumns,c=a.aoData,d=u.ext.type.detect,e,f,g;var h=0;for(e=b.length;h<e;h++){var l=b[h];var n=[];if(!l.sType&&l._sManualType)l.sType=l._sManualType;else if(!l.sType){var m=
0;for(f=d.length;m<f;m++){var p=0;for(g=c.length;p<g;p++){n[p]===q&&(n[p]=S(a,p,h,"type"));var t=d[m](n[p],a);if(!t&&m!==d.length-1)break;if("html"===t)break}if(t){l.sType=t;break}}l.sType||(l.sType="string")}}}function Cb(a,b,c,d){var e,f,g,h=a.aoColumns;if(b)for(e=b.length-1;0<=e;e--){var l=b[e];var n=l.targets!==q?l.targets:l.aTargets;Array.isArray(n)||(n=[n]);var m=0;for(f=n.length;m<f;m++)if("number"===typeof n[m]&&0<=n[m]){for(;h.length<=n[m];)Wa(a);d(n[m],l)}else if("number"===typeof n[m]&&
0>n[m])d(h.length+n[m],l);else if("string"===typeof n[m]){var p=0;for(g=h.length;p<g;p++)("_all"==n[m]||k(h[p].nTh).hasClass(n[m]))&&d(p,l)}}if(c)for(e=0,a=c.length;e<a;e++)d(e,c[e])}function ea(a,b,c,d){var e=a.aoData.length,f=k.extend(!0,{},u.models.oRow,{src:c?"dom":"data",idx:e});f._aData=b;a.aoData.push(f);for(var g=a.aoColumns,h=0,l=g.length;h<l;h++)g[h].sType=null;a.aiDisplayMaster.push(e);b=a.rowIdFn(b);b!==q&&(a.aIds[b]=f);!c&&a.oFeatures.bDeferRender||Za(a,e,c,d);return e}function Ga(a,
b){var c;b instanceof k||(b=k(b));return b.map(function(d,e){c=$a(a,e);return ea(a,c.data,e,c.cells)})}function S(a,b,c,d){var e=a.iDraw,f=a.aoColumns[c],g=a.aoData[b]._aData,h=f.sDefaultContent,l=f.fnGetData(g,d,{settings:a,row:b,col:c});if(l===q)return a.iDrawError!=e&&null===h&&(aa(a,0,"Requested unknown parameter "+("function"==typeof f.mData?"{function}":"'"+f.mData+"'")+" for row "+b+", column "+c,4),a.iDrawError=e),h;if((l===g||null===l)&&null!==h&&d!==q)l=h;else if("function"===typeof l)return l.call(g);
return null===l&&"display"==d?"":l}function Db(a,b,c,d){a.aoColumns[c].fnSetData(a.aoData[b]._aData,d,{settings:a,row:b,col:c})}function ab(a){return k.map(a.match(/(\\.|[^\.])+/g)||[""],function(b){return b.replace(/\\\./g,".")})}function ia(a){if(k.isPlainObject(a)){var b={};k.each(a,function(d,e){e&&(b[d]=ia(e))});return function(d,e,f,g){var h=b[e]||b._;return h!==q?h(d,e,f,g):d}}if(null===a)return function(d){return d};if("function"===typeof a)return function(d,e,f,g){return a(d,e,f,g)};if("string"!==
typeof a||-1===a.indexOf(".")&&-1===a.indexOf("[")&&-1===a.indexOf("("))return function(d,e){return d[a]};var c=function(d,e,f){if(""!==f){var g=ab(f);for(var h=0,l=g.length;h<l;h++){f=g[h].match(ua);var n=g[h].match(oa);if(f){g[h]=g[h].replace(ua,"");""!==g[h]&&(d=d[g[h]]);n=[];g.splice(0,h+1);g=g.join(".");if(Array.isArray(d))for(h=0,l=d.length;h<l;h++)n.push(c(d[h],e,g));d=f[0].substring(1,f[0].length-1);d=""===d?n:n.join(d);break}else if(n){g[h]=g[h].replace(oa,"");d=d[g[h]]();continue}if(null===
d||d[g[h]]===q)return q;d=d[g[h]]}}return d};return function(d,e){return c(d,e,a)}}function da(a){if(k.isPlainObject(a))return da(a._);if(null===a)return function(){};if("function"===typeof a)return function(c,d,e){a(c,"set",d,e)};if("string"!==typeof a||-1===a.indexOf(".")&&-1===a.indexOf("[")&&-1===a.indexOf("("))return function(c,d){c[a]=d};var b=function(c,d,e){e=ab(e);var f=e[e.length-1];for(var g,h,l=0,n=e.length-1;l<n;l++){if("__proto__"===e[l]||"constructor"===e[l])throw Error("Cannot set prototype values");
g=e[l].match(ua);h=e[l].match(oa);if(g){e[l]=e[l].replace(ua,"");c[e[l]]=[];f=e.slice();f.splice(0,l+1);g=f.join(".");if(Array.isArray(d))for(h=0,n=d.length;h<n;h++)f={},b(f,d[h],g),c[e[l]].push(f);else c[e[l]]=d;return}h&&(e[l]=e[l].replace(oa,""),c=c[e[l]](d));if(null===c[e[l]]||c[e[l]]===q)c[e[l]]={};c=c[e[l]]}if(f.match(oa))c[f.replace(oa,"")](d);else c[f.replace(ua,"")]=d};return function(c,d){return b(c,d,a)}}function bb(a){return T(a.aoData,"_aData")}function Ha(a){a.aoData.length=0;a.aiDisplayMaster.length=
0;a.aiDisplay.length=0;a.aIds={}}function Ia(a,b,c){for(var d=-1,e=0,f=a.length;e<f;e++)a[e]==b?d=e:a[e]>b&&a[e]--; -1!=d&&c===q&&a.splice(d,1)}function va(a,b,c,d){var e=a.aoData[b],f,g=function(l,n){for(;l.childNodes.length;)l.removeChild(l.firstChild);l.innerHTML=S(a,b,n,"display")};if("dom"!==c&&(c&&"auto"!==c||"dom"!==e.src)){var h=e.anCells;if(h)if(d!==q)g(h[d],d);else for(c=0,f=h.length;c<f;c++)g(h[c],c)}else e._aData=$a(a,e,d,d===q?q:e._aData).data;e._aSortData=null;e._aFilterData=null;g=
a.aoColumns;if(d!==q)g[d].sType=null;else{c=0;for(f=g.length;c<f;c++)g[c].sType=null;cb(a,e)}}function $a(a,b,c,d){var e=[],f=b.firstChild,g,h=0,l,n=a.aoColumns,m=a._rowReadObject;d=d!==q?d:m?{}:[];var p=function(x,r){if("string"===typeof x){var A=x.indexOf("@");-1!==A&&(A=x.substring(A+1),da(x)(d,r.getAttribute(A)))}},t=function(x){if(c===q||c===h)g=n[h],l=x.innerHTML.trim(),g&&g._bAttrSrc?(da(g.mData._)(d,l),p(g.mData.sort,x),p(g.mData.type,x),p(g.mData.filter,x)):m?(g._setter||(g._setter=da(g.mData)),
g._setter(d,l)):d[h]=l;h++};if(f)for(;f;){var v=f.nodeName.toUpperCase();if("TD"==v||"TH"==v)t(f),e.push(f);f=f.nextSibling}else for(e=b.anCells,f=0,v=e.length;f<v;f++)t(e[f]);(b=b.firstChild?b:b.nTr)&&(b=b.getAttribute("id"))&&da(a.rowId)(d,b);return{data:d,cells:e}}function Za(a,b,c,d){var e=a.aoData[b],f=e._aData,g=[],h,l;if(null===e.nTr){var n=c||z.createElement("tr");e.nTr=n;e.anCells=g;n._DT_RowIndex=b;cb(a,e);var m=0;for(h=a.aoColumns.length;m<h;m++){var p=a.aoColumns[m];e=(l=c?!1:!0)?z.createElement(p.sCellType):
d[m];e._DT_CellIndex={row:b,column:m};g.push(e);if(l||!(!p.mRender&&p.mData===m||k.isPlainObject(p.mData)&&p.mData._===m+".display"))e.innerHTML=S(a,b,m,"display");p.sClass&&(e.className+=" "+p.sClass);p.bVisible&&!c?n.appendChild(e):!p.bVisible&&c&&e.parentNode.removeChild(e);p.fnCreatedCell&&p.fnCreatedCell.call(a.oInstance,e,S(a,b,m),f,b,m)}I(a,"aoRowCreatedCallback",null,[n,f,b,g])}}function cb(a,b){var c=b.nTr,d=b._aData;if(c){if(a=a.rowIdFn(d))c.id=a;d.DT_RowClass&&(a=d.DT_RowClass.split(" "),
b.__rowc=b.__rowc?Ja(b.__rowc.concat(a)):a,k(c).removeClass(b.__rowc.join(" ")).addClass(d.DT_RowClass));d.DT_RowAttr&&k(c).attr(d.DT_RowAttr);d.DT_RowData&&k(c).data(d.DT_RowData)}}function Eb(a){var b,c,d=a.nTHead,e=a.nTFoot,f=0===k("th, td",d).length,g=a.oClasses,h=a.aoColumns;f&&(c=k("<tr/>").appendTo(d));var l=0;for(b=h.length;l<b;l++){var n=h[l];var m=k(n.nTh).addClass(n.sClass);f&&m.appendTo(c);a.oFeatures.bSort&&(m.addClass(n.sSortingClass),!1!==n.bSortable&&(m.attr("tabindex",a.iTabIndex).attr("aria-controls",
a.sTableId),db(a,n.nTh,l)));n.sTitle!=m[0].innerHTML&&m.html(n.sTitle);eb(a,"header")(a,m,n,g)}f&&wa(a.aoHeader,d);k(d).children("tr").attr("role","row");k(d).children("tr").children("th, td").addClass(g.sHeaderTH);k(e).children("tr").children("th, td").addClass(g.sFooterTH);if(null!==e)for(a=a.aoFooter[0],l=0,b=a.length;l<b;l++)n=h[l],n.nTf=a[l].cell,n.sClass&&k(n.nTf).addClass(n.sClass)}function xa(a,b,c){var d,e,f=[],g=[],h=a.aoColumns.length;if(b){c===q&&(c=!1);var l=0;for(d=b.length;l<d;l++){f[l]=
b[l].slice();f[l].nTr=b[l].nTr;for(e=h-1;0<=e;e--)a.aoColumns[e].bVisible||c||f[l].splice(e,1);g.push([])}l=0;for(d=f.length;l<d;l++){if(a=f[l].nTr)for(;e=a.firstChild;)a.removeChild(e);e=0;for(b=f[l].length;e<b;e++){var n=h=1;if(g[l][e]===q){a.appendChild(f[l][e].cell);for(g[l][e]=1;f[l+h]!==q&&f[l][e].cell==f[l+h][e].cell;)g[l+h][e]=1,h++;for(;f[l][e+n]!==q&&f[l][e].cell==f[l][e+n].cell;){for(c=0;c<h;c++)g[l+c][e+n]=1;n++}k(f[l][e].cell).attr("rowspan",h).attr("colspan",n)}}}}}function fa(a){var b=
I(a,"aoPreDrawCallback","preDraw",[a]);if(-1!==k.inArray(!1,b))U(a,!1);else{b=[];var c=0,d=a.asStripeClasses,e=d.length,f=a.oLanguage,g=a.iInitDisplayStart,h="ssp"==P(a),l=a.aiDisplay;a.bDrawing=!0;g!==q&&-1!==g&&(a._iDisplayStart=h?g:g>=a.fnRecordsDisplay()?0:g,a.iInitDisplayStart=-1);g=a._iDisplayStart;var n=a.fnDisplayEnd();if(a.bDeferLoading)a.bDeferLoading=!1,a.iDraw++,U(a,!1);else if(!h)a.iDraw++;else if(!a.bDestroying&&!Fb(a))return;if(0!==l.length)for(f=h?a.aoData.length:n,h=h?0:g;h<f;h++){var m=
l[h],p=a.aoData[m];null===p.nTr&&Za(a,m);var t=p.nTr;if(0!==e){var v=d[c%e];p._sRowStripe!=v&&(k(t).removeClass(p._sRowStripe).addClass(v),p._sRowStripe=v)}I(a,"aoRowCallback",null,[t,p._aData,c,h,m]);b.push(t);c++}else c=f.sZeroRecords,1==a.iDraw&&"ajax"==P(a)?c=f.sLoadingRecords:f.sEmptyTable&&0===a.fnRecordsTotal()&&(c=f.sEmptyTable),b[0]=k("<tr/>",{"class":e?d[0]:""}).append(k("<td />",{valign:"top",colSpan:na(a),"class":a.oClasses.sRowEmpty}).html(c))[0];I(a,"aoHeaderCallback","header",[k(a.nTHead).children("tr")[0],
bb(a),g,n,l]);I(a,"aoFooterCallback","footer",[k(a.nTFoot).children("tr")[0],bb(a),g,n,l]);d=k(a.nTBody);d.children().detach();d.append(k(b));I(a,"aoDrawCallback","draw",[a]);a.bSorted=!1;a.bFiltered=!1;a.bDrawing=!1}}function ja(a,b){var c=a.oFeatures,d=c.bFilter;c.bSort&&Gb(a);d?ya(a,a.oPreviousSearch):a.aiDisplay=a.aiDisplayMaster.slice();!0!==b&&(a._iDisplayStart=0);a._drawHold=b;fa(a);a._drawHold=!1}function Hb(a){var b=a.oClasses,c=k(a.nTable);c=k("<div/>").insertBefore(c);var d=a.oFeatures,
e=k("<div/>",{id:a.sTableId+"_wrapper","class":b.sWrapper+(a.nTFoot?"":" "+b.sNoFooter)});a.nHolding=c[0];a.nTableWrapper=e[0];a.nTableReinsertBefore=a.nTable.nextSibling;for(var f=a.sDom.split(""),g,h,l,n,m,p,t=0;t<f.length;t++){g=null;h=f[t];if("<"==h){l=k("<div/>")[0];n=f[t+1];if("'"==n||'"'==n){m="";for(p=2;f[t+p]!=n;)m+=f[t+p],p++;"H"==m?m=b.sJUIHeader:"F"==m&&(m=b.sJUIFooter);-1!=m.indexOf(".")?(n=m.split("."),l.id=n[0].substr(1,n[0].length-1),l.className=n[1]):"#"==m.charAt(0)?l.id=m.substr(1,
m.length-1):l.className=m;t+=p}e.append(l);e=k(l)}else if(">"==h)e=e.parent();else if("l"==h&&d.bPaginate&&d.bLengthChange)g=Ib(a);else if("f"==h&&d.bFilter)g=Jb(a);else if("r"==h&&d.bProcessing)g=Kb(a);else if("t"==h)g=Lb(a);else if("i"==h&&d.bInfo)g=Mb(a);else if("p"==h&&d.bPaginate)g=Nb(a);else if(0!==u.ext.feature.length)for(l=u.ext.feature,p=0,n=l.length;p<n;p++)if(h==l[p].cFeature){g=l[p].fnInit(a);break}g&&(l=a.aanFeatures,l[h]||(l[h]=[]),l[h].push(g),e.append(g))}c.replaceWith(e);a.nHolding=
null}function wa(a,b){b=k(b).children("tr");var c,d,e;a.splice(0,a.length);var f=0;for(e=b.length;f<e;f++)a.push([]);f=0;for(e=b.length;f<e;f++){var g=b[f];for(c=g.firstChild;c;){if("TD"==c.nodeName.toUpperCase()||"TH"==c.nodeName.toUpperCase()){var h=1*c.getAttribute("colspan");var l=1*c.getAttribute("rowspan");h=h&&0!==h&&1!==h?h:1;l=l&&0!==l&&1!==l?l:1;var n=0;for(d=a[f];d[n];)n++;var m=n;var p=1===h?!0:!1;for(d=0;d<h;d++)for(n=0;n<l;n++)a[f+n][m+d]={cell:c,unique:p},a[f+n].nTr=g}c=c.nextSibling}}}
function Ka(a,b,c){var d=[];c||(c=a.aoHeader,b&&(c=[],wa(c,b)));b=0;for(var e=c.length;b<e;b++)for(var f=0,g=c[b].length;f<g;f++)!c[b][f].unique||d[f]&&a.bSortCellsTop||(d[f]=c[b][f].cell);return d}function La(a,b,c){I(a,"aoServerParams","serverParams",[b]);if(b&&Array.isArray(b)){var d={},e=/(.*?)\[\]$/;k.each(b,function(m,p){(m=p.name.match(e))?(m=m[0],d[m]||(d[m]=[]),d[m].push(p.value)):d[p.name]=p.value});b=d}var f=a.ajax,g=a.oInstance,h=function(m){I(a,null,"xhr",[a,m,a.jqXHR]);c(m)};if(k.isPlainObject(f)&&
f.data){var l=f.data;var n="function"===typeof l?l(b,a):l;b="function"===typeof l&&n?n:k.extend(!0,b,n);delete f.data}n={data:b,success:function(m){var p=m.error||m.sError;p&&aa(a,0,p);a.json=m;h(m)},dataType:"json",cache:!1,type:a.sServerMethod,error:function(m,p,t){t=I(a,null,"xhr",[a,null,a.jqXHR]);-1===k.inArray(!0,t)&&("parsererror"==p?aa(a,0,"Invalid JSON response",1):4===m.readyState&&aa(a,0,"Ajax error",7));U(a,!1)}};a.oAjaxData=b;I(a,null,"preXhr",[a,b]);a.fnServerData?a.fnServerData.call(g,
a.sAjaxSource,k.map(b,function(m,p){return{name:p,value:m}}),h,a):a.sAjaxSource||"string"===typeof f?a.jqXHR=k.ajax(k.extend(n,{url:f||a.sAjaxSource})):"function"===typeof f?a.jqXHR=f.call(g,b,h,a):(a.jqXHR=k.ajax(k.extend(n,f)),f.data=l)}function Fb(a){return a.bAjaxDataGet?(a.iDraw++,U(a,!0),La(a,Ob(a),function(b){Pb(a,b)}),!1):!0}function Ob(a){var b=a.aoColumns,c=b.length,d=a.oFeatures,e=a.oPreviousSearch,f=a.aoPreSearchCols,g=[],h=pa(a);var l=a._iDisplayStart;var n=!1!==d.bPaginate?a._iDisplayLength:
-1;var m=function(x,r){g.push({name:x,value:r})};m("sEcho",a.iDraw);m("iColumns",c);m("sColumns",T(b,"sName").join(","));m("iDisplayStart",l);m("iDisplayLength",n);var p={draw:a.iDraw,columns:[],order:[],start:l,length:n,search:{value:e.sSearch,regex:e.bRegex}};for(l=0;l<c;l++){var t=b[l];var v=f[l];n="function"==typeof t.mData?"function":t.mData;p.columns.push({data:n,name:t.sName,searchable:t.bSearchable,orderable:t.bSortable,search:{value:v.sSearch,regex:v.bRegex}});m("mDataProp_"+l,n);d.bFilter&&
(m("sSearch_"+l,v.sSearch),m("bRegex_"+l,v.bRegex),m("bSearchable_"+l,t.bSearchable));d.bSort&&m("bSortable_"+l,t.bSortable)}d.bFilter&&(m("sSearch",e.sSearch),m("bRegex",e.bRegex));d.bSort&&(k.each(h,function(x,r){p.order.push({column:r.col,dir:r.dir});m("iSortCol_"+x,r.col);m("sSortDir_"+x,r.dir)}),m("iSortingCols",h.length));b=u.ext.legacy.ajax;return null===b?a.sAjaxSource?g:p:b?g:p}function Pb(a,b){var c=function(g,h){return b[g]!==q?b[g]:b[h]},d=Ma(a,b),e=c("sEcho","draw"),f=c("iTotalRecords",
"recordsTotal");c=c("iTotalDisplayRecords","recordsFiltered");if(e!==q){if(1*e<a.iDraw)return;a.iDraw=1*e}Ha(a);a._iRecordsTotal=parseInt(f,10);a._iRecordsDisplay=parseInt(c,10);e=0;for(f=d.length;e<f;e++)ea(a,d[e]);a.aiDisplay=a.aiDisplayMaster.slice();a.bAjaxDataGet=!1;fa(a);a._bInitComplete||Na(a,b);a.bAjaxDataGet=!0;U(a,!1)}function Ma(a,b){a=k.isPlainObject(a.ajax)&&a.ajax.dataSrc!==q?a.ajax.dataSrc:a.sAjaxDataProp;return"data"===a?b.aaData||b[a]:""!==a?ia(a)(b):b}function Jb(a){var b=a.oClasses,
c=a.sTableId,d=a.oLanguage,e=a.oPreviousSearch,f=a.aanFeatures,g='<input type="search" class="'+b.sFilterInput+'"/>',h=d.sSearch;h=h.match(/_INPUT_/)?h.replace("_INPUT_",g):h+g;b=k("<div/>",{id:f.f?null:c+"_filter","class":b.sFilter}).append(k("<label/>").append(h));var l=function(){var m=this.value?this.value:"";m!=e.sSearch&&(ya(a,{sSearch:m,bRegex:e.bRegex,bSmart:e.bSmart,bCaseInsensitive:e.bCaseInsensitive}),a._iDisplayStart=0,fa(a))};f=null!==a.searchDelay?a.searchDelay:"ssp"===P(a)?400:0;var n=
k("input",b).val(e.sSearch).attr("placeholder",d.sSearchPlaceholder).on("keyup.DT search.DT input.DT paste.DT cut.DT",f?fb(l,f):l).on("mouseup",function(m){setTimeout(function(){l.call(n[0])},10)}).on("keypress.DT",function(m){if(13==m.keyCode)return!1}).attr("aria-controls",c);k(a.nTable).on("search.dt.DT",function(m,p){if(a===p)try{n[0]!==z.activeElement&&n.val(e.sSearch)}catch(t){}});return b[0]}function ya(a,b,c){var d=a.oPreviousSearch,e=a.aoPreSearchCols,f=function(h){d.sSearch=h.sSearch;d.bRegex=
h.bRegex;d.bSmart=h.bSmart;d.bCaseInsensitive=h.bCaseInsensitive},g=function(h){return h.bEscapeRegex!==q?!h.bEscapeRegex:h.bRegex};Ya(a);if("ssp"!=P(a)){Qb(a,b.sSearch,c,g(b),b.bSmart,b.bCaseInsensitive);f(b);for(b=0;b<e.length;b++)Rb(a,e[b].sSearch,b,g(e[b]),e[b].bSmart,e[b].bCaseInsensitive);Sb(a)}else f(b);a.bFiltered=!0;I(a,null,"search",[a])}function Sb(a){for(var b=u.ext.search,c=a.aiDisplay,d,e,f=0,g=b.length;f<g;f++){for(var h=[],l=0,n=c.length;l<n;l++)e=c[l],d=a.aoData[e],b[f](a,d._aFilterData,
e,d._aData,l)&&h.push(e);c.length=0;k.merge(c,h)}}function Rb(a,b,c,d,e,f){if(""!==b){var g=[],h=a.aiDisplay;d=gb(b,d,e,f);for(e=0;e<h.length;e++)b=a.aoData[h[e]]._aFilterData[c],d.test(b)&&g.push(h[e]);a.aiDisplay=g}}function Qb(a,b,c,d,e,f){e=gb(b,d,e,f);var g=a.oPreviousSearch.sSearch,h=a.aiDisplayMaster;f=[];0!==u.ext.search.length&&(c=!0);var l=Tb(a);if(0>=b.length)a.aiDisplay=h.slice();else{if(l||c||d||g.length>b.length||0!==b.indexOf(g)||a.bSorted)a.aiDisplay=h.slice();b=a.aiDisplay;for(c=
0;c<b.length;c++)e.test(a.aoData[b[c]]._sFilterRow)&&f.push(b[c]);a.aiDisplay=f}}function gb(a,b,c,d){a=b?a:hb(a);c&&(a="^(?=.*?"+k.map(a.match(/"[^"]+"|[^ ]+/g)||[""],function(e){if('"'===e.charAt(0)){var f=e.match(/^"(.*)"$/);e=f?f[1]:e}return e.replace('"',"")}).join(")(?=.*?")+").*$");return new RegExp(a,d?"i":"")}function Tb(a){var b=a.aoColumns,c,d,e=u.ext.type.search;var f=!1;var g=0;for(c=a.aoData.length;g<c;g++){var h=a.aoData[g];if(!h._aFilterData){var l=[];var n=0;for(d=b.length;n<d;n++){f=
b[n];if(f.bSearchable){var m=S(a,g,n,"filter");e[f.sType]&&(m=e[f.sType](m));null===m&&(m="");"string"!==typeof m&&m.toString&&(m=m.toString())}else m="";m.indexOf&&-1!==m.indexOf("&")&&(Oa.innerHTML=m,m=rc?Oa.textContent:Oa.innerText);m.replace&&(m=m.replace(/[\r\n\u2028]/g,""));l.push(m)}h._aFilterData=l;h._sFilterRow=l.join("  ");f=!0}}return f}function Ub(a){return{search:a.sSearch,smart:a.bSmart,regex:a.bRegex,caseInsensitive:a.bCaseInsensitive}}function Vb(a){return{sSearch:a.search,bSmart:a.smart,
bRegex:a.regex,bCaseInsensitive:a.caseInsensitive}}function Mb(a){var b=a.sTableId,c=a.aanFeatures.i,d=k("<div/>",{"class":a.oClasses.sInfo,id:c?null:b+"_info"});c||(a.aoDrawCallback.push({fn:Wb,sName:"information"}),d.attr("role","status").attr("aria-live","polite"),k(a.nTable).attr("aria-describedby",b+"_info"));return d[0]}function Wb(a){var b=a.aanFeatures.i;if(0!==b.length){var c=a.oLanguage,d=a._iDisplayStart+1,e=a.fnDisplayEnd(),f=a.fnRecordsTotal(),g=a.fnRecordsDisplay(),h=g?c.sInfo:c.sInfoEmpty;
g!==f&&(h+=" "+c.sInfoFiltered);h+=c.sInfoPostFix;h=Xb(a,h);c=c.fnInfoCallback;null!==c&&(h=c.call(a.oInstance,a,d,e,f,g,h));k(b).html(h)}}function Xb(a,b){var c=a.fnFormatNumber,d=a._iDisplayStart+1,e=a._iDisplayLength,f=a.fnRecordsDisplay(),g=-1===e;return b.replace(/_START_/g,c.call(a,d)).replace(/_END_/g,c.call(a,a.fnDisplayEnd())).replace(/_MAX_/g,c.call(a,a.fnRecordsTotal())).replace(/_TOTAL_/g,c.call(a,f)).replace(/_PAGE_/g,c.call(a,g?1:Math.ceil(d/e))).replace(/_PAGES_/g,c.call(a,g?1:Math.ceil(f/
e)))}function za(a){var b=a.iInitDisplayStart,c=a.aoColumns;var d=a.oFeatures;var e=a.bDeferLoading;if(a.bInitialised){Hb(a);Eb(a);xa(a,a.aoHeader);xa(a,a.aoFooter);U(a,!0);d.bAutoWidth&&Xa(a);var f=0;for(d=c.length;f<d;f++){var g=c[f];g.sWidth&&(g.nTh.style.width=K(g.sWidth))}I(a,null,"preInit",[a]);ja(a);c=P(a);if("ssp"!=c||e)"ajax"==c?La(a,[],function(h){var l=Ma(a,h);for(f=0;f<l.length;f++)ea(a,l[f]);a.iInitDisplayStart=b;ja(a);U(a,!1);Na(a,h)},a):(U(a,!1),Na(a))}else setTimeout(function(){za(a)},
200)}function Na(a,b){a._bInitComplete=!0;(b||a.oInit.aaData)&&ra(a);I(a,null,"plugin-init",[a,b]);I(a,"aoInitComplete","init",[a,b])}function ib(a,b){b=parseInt(b,10);a._iDisplayLength=b;jb(a);I(a,null,"length",[a,b])}function Ib(a){var b=a.oClasses,c=a.sTableId,d=a.aLengthMenu,e=Array.isArray(d[0]),f=e?d[0]:d;d=e?d[1]:d;e=k("<select/>",{name:c+"_length","aria-controls":c,"class":b.sLengthSelect});for(var g=0,h=f.length;g<h;g++)e[0][g]=new Option("number"===typeof d[g]?a.fnFormatNumber(d[g]):d[g],
f[g]);var l=k("<div><label/></div>").addClass(b.sLength);a.aanFeatures.l||(l[0].id=c+"_length");l.children().append(a.oLanguage.sLengthMenu.replace("_MENU_",e[0].outerHTML));k("select",l).val(a._iDisplayLength).on("change.DT",function(n){ib(a,k(this).val());fa(a)});k(a.nTable).on("length.dt.DT",function(n,m,p){a===m&&k("select",l).val(p)});return l[0]}function Nb(a){var b=a.sPaginationType,c=u.ext.pager[b],d="function"===typeof c,e=function(g){fa(g)};b=k("<div/>").addClass(a.oClasses.sPaging+b)[0];
var f=a.aanFeatures;d||c.fnInit(a,b,e);f.p||(b.id=a.sTableId+"_paginate",a.aoDrawCallback.push({fn:function(g){if(d){var h=g._iDisplayStart,l=g._iDisplayLength,n=g.fnRecordsDisplay(),m=-1===l;h=m?0:Math.ceil(h/l);l=m?1:Math.ceil(n/l);n=c(h,l);var p;m=0;for(p=f.p.length;m<p;m++)eb(g,"pageButton")(g,f.p[m],m,n,h,l)}else c.fnUpdate(g,e)},sName:"pagination"}));return b}function kb(a,b,c){var d=a._iDisplayStart,e=a._iDisplayLength,f=a.fnRecordsDisplay();0===f||-1===e?d=0:"number"===typeof b?(d=b*e,d>f&&
(d=0)):"first"==b?d=0:"previous"==b?(d=0<=e?d-e:0,0>d&&(d=0)):"next"==b?d+e<f&&(d+=e):"last"==b?d=Math.floor((f-1)/e)*e:aa(a,0,"Unknown paging action: "+b,5);b=a._iDisplayStart!==d;a._iDisplayStart=d;b&&(I(a,null,"page",[a]),c&&fa(a));return b}function Kb(a){return k("<div/>",{id:a.aanFeatures.r?null:a.sTableId+"_processing","class":a.oClasses.sProcessing}).html(a.oLanguage.sProcessing).insertBefore(a.nTable)[0]}function U(a,b){a.oFeatures.bProcessing&&k(a.aanFeatures.r).css("display",b?"block":"none");
I(a,null,"processing",[a,b])}function Lb(a){var b=k(a.nTable);b.attr("role","grid");var c=a.oScroll;if(""===c.sX&&""===c.sY)return a.nTable;var d=c.sX,e=c.sY,f=a.oClasses,g=b.children("caption"),h=g.length?g[0]._captionSide:null,l=k(b[0].cloneNode(!1)),n=k(b[0].cloneNode(!1)),m=b.children("tfoot");m.length||(m=null);l=k("<div/>",{"class":f.sScrollWrapper}).append(k("<div/>",{"class":f.sScrollHead}).css({overflow:"hidden",position:"relative",border:0,width:d?d?K(d):null:"100%"}).append(k("<div/>",
{"class":f.sScrollHeadInner}).css({"box-sizing":"content-box",width:c.sXInner||"100%"}).append(l.removeAttr("id").css("margin-left",0).append("top"===h?g:null).append(b.children("thead"))))).append(k("<div/>",{"class":f.sScrollBody}).css({position:"relative",overflow:"auto",width:d?K(d):null}).append(b));m&&l.append(k("<div/>",{"class":f.sScrollFoot}).css({overflow:"hidden",border:0,width:d?d?K(d):null:"100%"}).append(k("<div/>",{"class":f.sScrollFootInner}).append(n.removeAttr("id").css("margin-left",
0).append("bottom"===h?g:null).append(b.children("tfoot")))));b=l.children();var p=b[0];f=b[1];var t=m?b[2]:null;if(d)k(f).on("scroll.DT",function(v){v=this.scrollLeft;p.scrollLeft=v;m&&(t.scrollLeft=v)});k(f).css("max-height",e);c.bCollapse||k(f).css("height",e);a.nScrollHead=p;a.nScrollBody=f;a.nScrollFoot=t;a.aoDrawCallback.push({fn:Ea,sName:"scrolling"});return l[0]}function Ea(a){var b=a.oScroll,c=b.sX,d=b.sXInner,e=b.sY;b=b.iBarWidth;var f=k(a.nScrollHead),g=f[0].style,h=f.children("div"),l=
h[0].style,n=h.children("table");h=a.nScrollBody;var m=k(h),p=h.style,t=k(a.nScrollFoot).children("div"),v=t.children("table"),x=k(a.nTHead),r=k(a.nTable),A=r[0],E=A.style,H=a.nTFoot?k(a.nTFoot):null,W=a.oBrowser,M=W.bScrollOversize,C=T(a.aoColumns,"nTh"),B=[],ba=[],X=[],lb=[],Aa,Yb=function(F){F=F.style;F.paddingTop="0";F.paddingBottom="0";F.borderTopWidth="0";F.borderBottomWidth="0";F.height=0};var ha=h.scrollHeight>h.clientHeight;if(a.scrollBarVis!==ha&&a.scrollBarVis!==q)a.scrollBarVis=ha,ra(a);
else{a.scrollBarVis=ha;r.children("thead, tfoot").remove();if(H){var ka=H.clone().prependTo(r);var la=H.find("tr");ka=ka.find("tr")}var mb=x.clone().prependTo(r);x=x.find("tr");ha=mb.find("tr");mb.find("th, td").removeAttr("tabindex");c||(p.width="100%",f[0].style.width="100%");k.each(Ka(a,mb),function(F,Y){Aa=sa(a,F);Y.style.width=a.aoColumns[Aa].sWidth});H&&Z(function(F){F.style.width=""},ka);f=r.outerWidth();""===c?(E.width="100%",M&&(r.find("tbody").height()>h.offsetHeight||"scroll"==m.css("overflow-y"))&&
(E.width=K(r.outerWidth()-b)),f=r.outerWidth()):""!==d&&(E.width=K(d),f=r.outerWidth());Z(Yb,ha);Z(function(F){X.push(F.innerHTML);B.push(K(k(F).css("width")))},ha);Z(function(F,Y){-1!==k.inArray(F,C)&&(F.style.width=B[Y])},x);k(ha).height(0);H&&(Z(Yb,ka),Z(function(F){lb.push(F.innerHTML);ba.push(K(k(F).css("width")))},ka),Z(function(F,Y){F.style.width=ba[Y]},la),k(ka).height(0));Z(function(F,Y){F.innerHTML='<div class="dataTables_sizing">'+X[Y]+"</div>";F.childNodes[0].style.height="0";F.childNodes[0].style.overflow=
"hidden";F.style.width=B[Y]},ha);H&&Z(function(F,Y){F.innerHTML='<div class="dataTables_sizing">'+lb[Y]+"</div>";F.childNodes[0].style.height="0";F.childNodes[0].style.overflow="hidden";F.style.width=ba[Y]},ka);r.outerWidth()<f?(la=h.scrollHeight>h.offsetHeight||"scroll"==m.css("overflow-y")?f+b:f,M&&(h.scrollHeight>h.offsetHeight||"scroll"==m.css("overflow-y"))&&(E.width=K(la-b)),""!==c&&""===d||aa(a,1,"Possible column misalignment",6)):la="100%";p.width=K(la);g.width=K(la);H&&(a.nScrollFoot.style.width=
K(la));!e&&M&&(p.height=K(A.offsetHeight+b));c=r.outerWidth();n[0].style.width=K(c);l.width=K(c);d=r.height()>h.clientHeight||"scroll"==m.css("overflow-y");e="padding"+(W.bScrollbarLeft?"Left":"Right");l[e]=d?b+"px":"0px";H&&(v[0].style.width=K(c),t[0].style.width=K(c),t[0].style[e]=d?b+"px":"0px");r.children("colgroup").insertBefore(r.children("thead"));m.trigger("scroll");!a.bSorted&&!a.bFiltered||a._drawHold||(h.scrollTop=0)}}function Z(a,b,c){for(var d=0,e=0,f=b.length,g,h;e<f;){g=b[e].firstChild;
for(h=c?c[e].firstChild:null;g;)1===g.nodeType&&(c?a(g,h,d):a(g,d),d++),g=g.nextSibling,h=c?h.nextSibling:null;e++}}function Xa(a){var b=a.nTable,c=a.aoColumns,d=a.oScroll,e=d.sY,f=d.sX,g=d.sXInner,h=c.length,l=Fa(a,"bVisible"),n=k("th",a.nTHead),m=b.getAttribute("width"),p=b.parentNode,t=!1,v,x=a.oBrowser;d=x.bScrollOversize;(v=b.style.width)&&-1!==v.indexOf("%")&&(m=v);for(v=0;v<l.length;v++){var r=c[l[v]];null!==r.sWidth&&(r.sWidth=Zb(r.sWidthOrig,p),t=!0)}if(d||!t&&!f&&!e&&h==na(a)&&h==n.length)for(v=
0;v<h;v++)l=sa(a,v),null!==l&&(c[l].sWidth=K(n.eq(v).width()));else{h=k(b).clone().css("visibility","hidden").removeAttr("id");h.find("tbody tr").remove();var A=k("<tr/>").appendTo(h.find("tbody"));h.find("thead, tfoot").remove();h.append(k(a.nTHead).clone()).append(k(a.nTFoot).clone());h.find("tfoot th, tfoot td").css("width","");n=Ka(a,h.find("thead")[0]);for(v=0;v<l.length;v++)r=c[l[v]],n[v].style.width=null!==r.sWidthOrig&&""!==r.sWidthOrig?K(r.sWidthOrig):"",r.sWidthOrig&&f&&k(n[v]).append(k("<div/>").css({width:r.sWidthOrig,
margin:0,padding:0,border:0,height:1}));if(a.aoData.length)for(v=0;v<l.length;v++)t=l[v],r=c[t],k($b(a,t)).clone(!1).append(r.sContentPadding).appendTo(A);k("[name]",h).removeAttr("name");r=k("<div/>").css(f||e?{position:"absolute",top:0,left:0,height:1,right:0,overflow:"hidden"}:{}).append(h).appendTo(p);f&&g?h.width(g):f?(h.css("width","auto"),h.removeAttr("width"),h.width()<p.clientWidth&&m&&h.width(p.clientWidth)):e?h.width(p.clientWidth):m&&h.width(m);for(v=e=0;v<l.length;v++)p=k(n[v]),g=p.outerWidth()-
p.width(),p=x.bBounding?Math.ceil(n[v].getBoundingClientRect().width):p.outerWidth(),e+=p,c[l[v]].sWidth=K(p-g);b.style.width=K(e);r.remove()}m&&(b.style.width=K(m));!m&&!f||a._reszEvt||(b=function(){k(y).on("resize.DT-"+a.sInstance,fb(function(){ra(a)}))},d?setTimeout(b,1E3):b(),a._reszEvt=!0)}function Zb(a,b){if(!a)return 0;a=k("<div/>").css("width",K(a)).appendTo(b||z.body);b=a[0].offsetWidth;a.remove();return b}function $b(a,b){var c=ac(a,b);if(0>c)return null;var d=a.aoData[c];return d.nTr?d.anCells[b]:
k("<td/>").html(S(a,c,b,"display"))[0]}function ac(a,b){for(var c,d=-1,e=-1,f=0,g=a.aoData.length;f<g;f++)c=S(a,f,b,"display")+"",c=c.replace(sc,""),c=c.replace(/&nbsp;/g," "),c.length>d&&(d=c.length,e=f);return e}function K(a){return null===a?"0px":"number"==typeof a?0>a?"0px":a+"px":a.match(/\d$/)?a+"px":a}function pa(a){var b=[],c=a.aoColumns;var d=a.aaSortingFixed;var e=k.isPlainObject(d);var f=[];var g=function(m){m.length&&!Array.isArray(m[0])?f.push(m):k.merge(f,m)};Array.isArray(d)&&g(d);
e&&d.pre&&g(d.pre);g(a.aaSorting);e&&d.post&&g(d.post);for(a=0;a<f.length;a++){var h=f[a][0];g=c[h].aDataSort;d=0;for(e=g.length;d<e;d++){var l=g[d];var n=c[l].sType||"string";f[a]._idx===q&&(f[a]._idx=k.inArray(f[a][1],c[l].asSorting));b.push({src:h,col:l,dir:f[a][1],index:f[a]._idx,type:n,formatter:u.ext.type.order[n+"-pre"]})}}return b}function Gb(a){var b,c=[],d=u.ext.type.order,e=a.aoData,f=0,g=a.aiDisplayMaster;Ya(a);var h=pa(a);var l=0;for(b=h.length;l<b;l++){var n=h[l];n.formatter&&f++;bc(a,
n.col)}if("ssp"!=P(a)&&0!==h.length){l=0;for(b=g.length;l<b;l++)c[g[l]]=l;f===h.length?g.sort(function(m,p){var t,v=h.length,x=e[m]._aSortData,r=e[p]._aSortData;for(t=0;t<v;t++){var A=h[t];var E=x[A.col];var H=r[A.col];E=E<H?-1:E>H?1:0;if(0!==E)return"asc"===A.dir?E:-E}E=c[m];H=c[p];return E<H?-1:E>H?1:0}):g.sort(function(m,p){var t,v=h.length,x=e[m]._aSortData,r=e[p]._aSortData;for(t=0;t<v;t++){var A=h[t];var E=x[A.col];var H=r[A.col];A=d[A.type+"-"+A.dir]||d["string-"+A.dir];E=A(E,H);if(0!==E)return E}E=
c[m];H=c[p];return E<H?-1:E>H?1:0})}a.bSorted=!0}function cc(a){var b=a.aoColumns,c=pa(a);a=a.oLanguage.oAria;for(var d=0,e=b.length;d<e;d++){var f=b[d];var g=f.asSorting;var h=f.sTitle.replace(/<.*?>/g,"");var l=f.nTh;l.removeAttribute("aria-sort");f.bSortable&&(0<c.length&&c[0].col==d?(l.setAttribute("aria-sort","asc"==c[0].dir?"ascending":"descending"),f=g[c[0].index+1]||g[0]):f=g[0],h+="asc"===f?a.sSortAscending:a.sSortDescending);l.setAttribute("aria-label",h)}}function nb(a,b,c,d){var e=a.aaSorting,
f=a.aoColumns[b].asSorting,g=function(h,l){var n=h._idx;n===q&&(n=k.inArray(h[1],f));return n+1<f.length?n+1:l?null:0};"number"===typeof e[0]&&(e=a.aaSorting=[e]);c&&a.oFeatures.bSortMulti?(c=k.inArray(b,T(e,"0")),-1!==c?(b=g(e[c],!0),null===b&&1===e.length&&(b=0),null===b?e.splice(c,1):(e[c][1]=f[b],e[c]._idx=b)):(e.push([b,f[0],0]),e[e.length-1]._idx=0)):e.length&&e[0][0]==b?(b=g(e[0]),e.length=1,e[0][1]=f[b],e[0]._idx=b):(e.length=0,e.push([b,f[0]]),e[0]._idx=0);ja(a);"function"==typeof d&&d(a)}
function db(a,b,c,d){var e=a.aoColumns[c];ob(b,{},function(f){!1!==e.bSortable&&(a.oFeatures.bProcessing?(U(a,!0),setTimeout(function(){nb(a,c,f.shiftKey,d);"ssp"!==P(a)&&U(a,!1)},0)):nb(a,c,f.shiftKey,d))})}function Pa(a){var b=a.aLastSort,c=a.oClasses.sSortColumn,d=pa(a),e=a.oFeatures,f;if(e.bSort&&e.bSortClasses){e=0;for(f=b.length;e<f;e++){var g=b[e].src;k(T(a.aoData,"anCells",g)).removeClass(c+(2>e?e+1:3))}e=0;for(f=d.length;e<f;e++)g=d[e].src,k(T(a.aoData,"anCells",g)).addClass(c+(2>e?e+1:3))}a.aLastSort=
d}function bc(a,b){var c=a.aoColumns[b],d=u.ext.order[c.sSortDataType],e;d&&(e=d.call(a.oInstance,a,b,ta(a,b)));for(var f,g=u.ext.type.order[c.sType+"-pre"],h=0,l=a.aoData.length;h<l;h++)if(c=a.aoData[h],c._aSortData||(c._aSortData=[]),!c._aSortData[b]||d)f=d?e[h]:S(a,h,b,"sort"),c._aSortData[b]=g?g(f):f}function Qa(a){if(a.oFeatures.bStateSave&&!a.bDestroying){var b={time:+new Date,start:a._iDisplayStart,length:a._iDisplayLength,order:k.extend(!0,[],a.aaSorting),search:Ub(a.oPreviousSearch),columns:k.map(a.aoColumns,
function(c,d){return{visible:c.bVisible,search:Ub(a.aoPreSearchCols[d])}})};I(a,"aoStateSaveParams","stateSaveParams",[a,b]);a.oSavedState=b;a.fnStateSaveCallback.call(a.oInstance,a,b)}}function dc(a,b,c){var d,e,f=a.aoColumns;b=function(h){if(h&&h.time){var l=I(a,"aoStateLoadParams","stateLoadParams",[a,h]);if(-1===k.inArray(!1,l)&&(l=a.iStateDuration,!(0<l&&h.time<+new Date-1E3*l||h.columns&&f.length!==h.columns.length))){a.oLoadedState=k.extend(!0,{},h);h.start!==q&&(a._iDisplayStart=h.start,a.iInitDisplayStart=
h.start);h.length!==q&&(a._iDisplayLength=h.length);h.order!==q&&(a.aaSorting=[],k.each(h.order,function(n,m){a.aaSorting.push(m[0]>=f.length?[0,m[1]]:m)}));h.search!==q&&k.extend(a.oPreviousSearch,Vb(h.search));if(h.columns)for(d=0,e=h.columns.length;d<e;d++)l=h.columns[d],l.visible!==q&&(f[d].bVisible=l.visible),l.search!==q&&k.extend(a.aoPreSearchCols[d],Vb(l.search));I(a,"aoStateLoaded","stateLoaded",[a,h])}}c()};if(a.oFeatures.bStateSave){var g=a.fnStateLoadCallback.call(a.oInstance,a,b);g!==
q&&b(g)}else c()}function Ra(a){var b=u.settings;a=k.inArray(a,T(b,"nTable"));return-1!==a?b[a]:null}function aa(a,b,c,d){c="DataTables warning: "+(a?"table id="+a.sTableId+" - ":"")+c;d&&(c+=". For more information about this error, please see http://datatables.net/tn/"+d);if(b)y.console&&console.log&&console.log(c);else if(b=u.ext,b=b.sErrMode||b.errMode,a&&I(a,null,"error",[a,d,c]),"alert"==b)alert(c);else{if("throw"==b)throw Error(c);"function"==typeof b&&b(a,d,c)}}function V(a,b,c,d){Array.isArray(c)?
k.each(c,function(e,f){Array.isArray(f)?V(a,b,f[0],f[1]):V(a,b,f)}):(d===q&&(d=c),b[c]!==q&&(a[d]=b[c]))}function pb(a,b,c){var d;for(d in b)if(b.hasOwnProperty(d)){var e=b[d];k.isPlainObject(e)?(k.isPlainObject(a[d])||(a[d]={}),k.extend(!0,a[d],e)):c&&"data"!==d&&"aaData"!==d&&Array.isArray(e)?a[d]=e.slice():a[d]=e}return a}function ob(a,b,c){k(a).on("click.DT",b,function(d){k(a).trigger("blur");c(d)}).on("keypress.DT",b,function(d){13===d.which&&(d.preventDefault(),c(d))}).on("selectstart.DT",function(){return!1})}
function Q(a,b,c,d){c&&a[b].push({fn:c,sName:d})}function I(a,b,c,d){var e=[];b&&(e=k.map(a[b].slice().reverse(),function(f,g){return f.fn.apply(a.oInstance,d)}));null!==c&&(b=k.Event(c+".dt"),k(a.nTable).trigger(b,d),e.push(b.result));return e}function jb(a){var b=a._iDisplayStart,c=a.fnDisplayEnd(),d=a._iDisplayLength;b>=c&&(b=c-d);b-=b%d;if(-1===d||0>b)b=0;a._iDisplayStart=b}function eb(a,b){a=a.renderer;var c=u.ext.renderer[b];return k.isPlainObject(a)&&a[b]?c[a[b]]||c._:"string"===typeof a?c[a]||
c._:c._}function P(a){return a.oFeatures.bServerSide?"ssp":a.ajax||a.sAjaxSource?"ajax":"dom"}function Ba(a,b){var c=ec.numbers_length,d=Math.floor(c/2);b<=c?a=qa(0,b):a<=d?(a=qa(0,c-2),a.push("ellipsis"),a.push(b-1)):(a>=b-1-d?a=qa(b-(c-2),b):(a=qa(a-d+2,a+d-1),a.push("ellipsis"),a.push(b-1)),a.splice(0,0,"ellipsis"),a.splice(0,0,0));a.DT_el="span";return a}function Va(a){k.each({num:function(b){return Sa(b,a)},"num-fmt":function(b){return Sa(b,a,qb)},"html-num":function(b){return Sa(b,a,Ta)},"html-num-fmt":function(b){return Sa(b,
a,Ta,qb)}},function(b,c){L.type.order[b+a+"-pre"]=c;b.match(/^html\-/)&&(L.type.search[b+a]=L.type.search.html)})}function fc(a){return function(){var b=[Ra(this[u.ext.iApiIndex])].concat(Array.prototype.slice.call(arguments));return u.ext.internal[a].apply(this,b)}}var u=function(a){this.$=function(f,g){return this.api(!0).$(f,g)};this._=function(f,g){return this.api(!0).rows(f,g).data()};this.api=function(f){return f?new D(Ra(this[L.iApiIndex])):new D(this)};this.fnAddData=function(f,g){var h=this.api(!0);
f=Array.isArray(f)&&(Array.isArray(f[0])||k.isPlainObject(f[0]))?h.rows.add(f):h.row.add(f);(g===q||g)&&h.draw();return f.flatten().toArray()};this.fnAdjustColumnSizing=function(f){var g=this.api(!0).columns.adjust(),h=g.settings()[0],l=h.oScroll;f===q||f?g.draw(!1):(""!==l.sX||""!==l.sY)&&Ea(h)};this.fnClearTable=function(f){var g=this.api(!0).clear();(f===q||f)&&g.draw()};this.fnClose=function(f){this.api(!0).row(f).child.hide()};this.fnDeleteRow=function(f,g,h){var l=this.api(!0);f=l.rows(f);var n=
f.settings()[0],m=n.aoData[f[0][0]];f.remove();g&&g.call(this,n,m);(h===q||h)&&l.draw();return m};this.fnDestroy=function(f){this.api(!0).destroy(f)};this.fnDraw=function(f){this.api(!0).draw(f)};this.fnFilter=function(f,g,h,l,n,m){n=this.api(!0);null===g||g===q?n.search(f,h,l,m):n.column(g).search(f,h,l,m);n.draw()};this.fnGetData=function(f,g){var h=this.api(!0);if(f!==q){var l=f.nodeName?f.nodeName.toLowerCase():"";return g!==q||"td"==l||"th"==l?h.cell(f,g).data():h.row(f).data()||null}return h.data().toArray()};
this.fnGetNodes=function(f){var g=this.api(!0);return f!==q?g.row(f).node():g.rows().nodes().flatten().toArray()};this.fnGetPosition=function(f){var g=this.api(!0),h=f.nodeName.toUpperCase();return"TR"==h?g.row(f).index():"TD"==h||"TH"==h?(f=g.cell(f).index(),[f.row,f.columnVisible,f.column]):null};this.fnIsOpen=function(f){return this.api(!0).row(f).child.isShown()};this.fnOpen=function(f,g,h){return this.api(!0).row(f).child(g,h).show().child()[0]};this.fnPageChange=function(f,g){f=this.api(!0).page(f);
(g===q||g)&&f.draw(!1)};this.fnSetColumnVis=function(f,g,h){f=this.api(!0).column(f).visible(g);(h===q||h)&&f.columns.adjust().draw()};this.fnSettings=function(){return Ra(this[L.iApiIndex])};this.fnSort=function(f){this.api(!0).order(f).draw()};this.fnSortListener=function(f,g,h){this.api(!0).order.listener(f,g,h)};this.fnUpdate=function(f,g,h,l,n){var m=this.api(!0);h===q||null===h?m.row(g).data(f):m.cell(g,h).data(f);(n===q||n)&&m.columns.adjust();(l===q||l)&&m.draw();return 0};this.fnVersionCheck=
L.fnVersionCheck;var b=this,c=a===q,d=this.length;c&&(a={});this.oApi=this.internal=L.internal;for(var e in u.ext.internal)e&&(this[e]=fc(e));this.each(function(){var f={},g=1<d?pb(f,a,!0):a,h=0,l;f=this.getAttribute("id");var n=!1,m=u.defaults,p=k(this);if("table"!=this.nodeName.toLowerCase())aa(null,0,"Non-table node initialisation ("+this.nodeName+")",2);else{yb(m);zb(m.column);O(m,m,!0);O(m.column,m.column,!0);O(m,k.extend(g,p.data()),!0);var t=u.settings;h=0;for(l=t.length;h<l;h++){var v=t[h];
if(v.nTable==this||v.nTHead&&v.nTHead.parentNode==this||v.nTFoot&&v.nTFoot.parentNode==this){var x=g.bRetrieve!==q?g.bRetrieve:m.bRetrieve;if(c||x)return v.oInstance;if(g.bDestroy!==q?g.bDestroy:m.bDestroy){v.oInstance.fnDestroy();break}else{aa(v,0,"Cannot reinitialise DataTable",3);return}}if(v.sTableId==this.id){t.splice(h,1);break}}if(null===f||""===f)this.id=f="DataTables_Table_"+u.ext._unique++;var r=k.extend(!0,{},u.models.oSettings,{sDestroyWidth:p[0].style.width,sInstance:f,sTableId:f});r.nTable=
this;r.oApi=b.internal;r.oInit=g;t.push(r);r.oInstance=1===b.length?b:p.dataTable();yb(g);ma(g.oLanguage);g.aLengthMenu&&!g.iDisplayLength&&(g.iDisplayLength=Array.isArray(g.aLengthMenu[0])?g.aLengthMenu[0][0]:g.aLengthMenu[0]);g=pb(k.extend(!0,{},m),g);V(r.oFeatures,g,"bPaginate bLengthChange bFilter bSort bSortMulti bInfo bProcessing bAutoWidth bSortClasses bServerSide bDeferRender".split(" "));V(r,g,["asStripeClasses","ajax","fnServerData","fnFormatNumber","sServerMethod","aaSorting","aaSortingFixed",
"aLengthMenu","sPaginationType","sAjaxSource","sAjaxDataProp","iStateDuration","sDom","bSortCellsTop","iTabIndex","fnStateLoadCallback","fnStateSaveCallback","renderer","searchDelay","rowId",["iCookieDuration","iStateDuration"],["oSearch","oPreviousSearch"],["aoSearchCols","aoPreSearchCols"],["iDisplayLength","_iDisplayLength"]]);V(r.oScroll,g,[["sScrollX","sX"],["sScrollXInner","sXInner"],["sScrollY","sY"],["bScrollCollapse","bCollapse"]]);V(r.oLanguage,g,"fnInfoCallback");Q(r,"aoDrawCallback",g.fnDrawCallback,
"user");Q(r,"aoServerParams",g.fnServerParams,"user");Q(r,"aoStateSaveParams",g.fnStateSaveParams,"user");Q(r,"aoStateLoadParams",g.fnStateLoadParams,"user");Q(r,"aoStateLoaded",g.fnStateLoaded,"user");Q(r,"aoRowCallback",g.fnRowCallback,"user");Q(r,"aoRowCreatedCallback",g.fnCreatedRow,"user");Q(r,"aoHeaderCallback",g.fnHeaderCallback,"user");Q(r,"aoFooterCallback",g.fnFooterCallback,"user");Q(r,"aoInitComplete",g.fnInitComplete,"user");Q(r,"aoPreDrawCallback",g.fnPreDrawCallback,"user");r.rowIdFn=
ia(g.rowId);Ab(r);var A=r.oClasses;k.extend(A,u.ext.classes,g.oClasses);p.addClass(A.sTable);r.iInitDisplayStart===q&&(r.iInitDisplayStart=g.iDisplayStart,r._iDisplayStart=g.iDisplayStart);null!==g.iDeferLoading&&(r.bDeferLoading=!0,f=Array.isArray(g.iDeferLoading),r._iRecordsDisplay=f?g.iDeferLoading[0]:g.iDeferLoading,r._iRecordsTotal=f?g.iDeferLoading[1]:g.iDeferLoading);var E=r.oLanguage;k.extend(!0,E,g.oLanguage);E.sUrl&&(k.ajax({dataType:"json",url:E.sUrl,success:function(C){ma(C);O(m.oLanguage,
C);k.extend(!0,E,C);za(r)},error:function(){za(r)}}),n=!0);null===g.asStripeClasses&&(r.asStripeClasses=[A.sStripeOdd,A.sStripeEven]);f=r.asStripeClasses;var H=p.children("tbody").find("tr").eq(0);-1!==k.inArray(!0,k.map(f,function(C,B){return H.hasClass(C)}))&&(k("tbody tr",this).removeClass(f.join(" ")),r.asDestroyStripes=f.slice());f=[];t=this.getElementsByTagName("thead");0!==t.length&&(wa(r.aoHeader,t[0]),f=Ka(r));if(null===g.aoColumns)for(t=[],h=0,l=f.length;h<l;h++)t.push(null);else t=g.aoColumns;
h=0;for(l=t.length;h<l;h++)Wa(r,f?f[h]:null);Cb(r,g.aoColumnDefs,t,function(C,B){Da(r,C,B)});if(H.length){var W=function(C,B){return null!==C.getAttribute("data-"+B)?B:null};k(H[0]).children("th, td").each(function(C,B){var ba=r.aoColumns[C];if(ba.mData===C){var X=W(B,"sort")||W(B,"order");B=W(B,"filter")||W(B,"search");if(null!==X||null!==B)ba.mData={_:C+".display",sort:null!==X?C+".@data-"+X:q,type:null!==X?C+".@data-"+X:q,filter:null!==B?C+".@data-"+B:q},Da(r,C)}})}var M=r.oFeatures;f=function(){if(g.aaSorting===
q){var C=r.aaSorting;h=0;for(l=C.length;h<l;h++)C[h][1]=r.aoColumns[h].asSorting[0]}Pa(r);M.bSort&&Q(r,"aoDrawCallback",function(){if(r.bSorted){var ba=pa(r),X={};k.each(ba,function(lb,Aa){X[Aa.src]=Aa.dir});I(r,null,"order",[r,ba,X]);cc(r)}});Q(r,"aoDrawCallback",function(){(r.bSorted||"ssp"===P(r)||M.bDeferRender)&&Pa(r)},"sc");C=p.children("caption").each(function(){this._captionSide=k(this).css("caption-side")});var B=p.children("thead");0===B.length&&(B=k("<thead/>").appendTo(p));r.nTHead=B[0];
B=p.children("tbody");0===B.length&&(B=k("<tbody/>").appendTo(p));r.nTBody=B[0];B=p.children("tfoot");0===B.length&&0<C.length&&(""!==r.oScroll.sX||""!==r.oScroll.sY)&&(B=k("<tfoot/>").appendTo(p));0===B.length||0===B.children().length?p.addClass(A.sNoFooter):0<B.length&&(r.nTFoot=B[0],wa(r.aoFooter,r.nTFoot));if(g.aaData)for(h=0;h<g.aaData.length;h++)ea(r,g.aaData[h]);else(r.bDeferLoading||"dom"==P(r))&&Ga(r,k(r.nTBody).children("tr"));r.aiDisplay=r.aiDisplayMaster.slice();r.bInitialised=!0;!1===
n&&za(r)};g.bStateSave?(M.bStateSave=!0,Q(r,"aoDrawCallback",Qa,"state_save"),dc(r,g,f)):f()}});b=null;return this},L,w,J,rb={},gc=/[\r\n\u2028]/g,Ta=/<.*?>/g,tc=/^\d{2,4}[\.\/\-]\d{1,2}[\.\/\-]\d{1,2}([T ]{1}\d{1,2}[:\.]\d{2}([\.:]\d{2})?)?$/,uc=/(\/|\.|\*|\+|\?|\||\(|\)|\[|\]|\{|\}|\\|\$|\^|\-)/g,qb=/['\u00A0,$£€¥%\u2009\u202F\u20BD\u20a9\u20BArfkɃΞ]/gi,ca=function(a){return a&&!0!==a&&"-"!==a?!1:!0},hc=function(a){var b=parseInt(a,10);return!isNaN(b)&&isFinite(a)?b:null},ic=function(a,b){rb[b]||
(rb[b]=new RegExp(hb(b),"g"));return"string"===typeof a&&"."!==b?a.replace(/\./g,"").replace(rb[b],"."):a},sb=function(a,b,c){var d="string"===typeof a;if(ca(a))return!0;b&&d&&(a=ic(a,b));c&&d&&(a=a.replace(qb,""));return!isNaN(parseFloat(a))&&isFinite(a)},jc=function(a,b,c){return ca(a)?!0:ca(a)||"string"===typeof a?sb(a.replace(Ta,""),b,c)?!0:null:null},T=function(a,b,c){var d=[],e=0,f=a.length;if(c!==q)for(;e<f;e++)a[e]&&a[e][b]&&d.push(a[e][b][c]);else for(;e<f;e++)a[e]&&d.push(a[e][b]);return d},
Ca=function(a,b,c,d){var e=[],f=0,g=b.length;if(d!==q)for(;f<g;f++)a[b[f]][c]&&e.push(a[b[f]][c][d]);else for(;f<g;f++)e.push(a[b[f]][c]);return e},qa=function(a,b){var c=[];if(b===q){b=0;var d=a}else d=b,b=a;for(a=b;a<d;a++)c.push(a);return c},kc=function(a){for(var b=[],c=0,d=a.length;c<d;c++)a[c]&&b.push(a[c]);return b},Ja=function(a){a:{if(!(2>a.length)){var b=a.slice().sort();for(var c=b[0],d=1,e=b.length;d<e;d++){if(b[d]===c){b=!1;break a}c=b[d]}}b=!0}if(b)return a.slice();b=[];e=a.length;var f,
g=0;d=0;a:for(;d<e;d++){c=a[d];for(f=0;f<g;f++)if(b[f]===c)continue a;b.push(c);g++}return b},lc=function(a,b){if(Array.isArray(b))for(var c=0;c<b.length;c++)lc(a,b[c]);else a.push(b);return a};Array.isArray||(Array.isArray=function(a){return"[object Array]"===Object.prototype.toString.call(a)});String.prototype.trim||(String.prototype.trim=function(){return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,"")});u.util={throttle:function(a,b){var c=b!==q?b:200,d,e;return function(){var f=this,g=
+new Date,h=arguments;d&&g<d+c?(clearTimeout(e),e=setTimeout(function(){d=q;a.apply(f,h)},c)):(d=g,a.apply(f,h))}},escapeRegex:function(a){return a.replace(uc,"\\$1")}};var R=function(a,b,c){a[b]!==q&&(a[c]=a[b])},ua=/\[.*?\]$/,oa=/\(\)$/,hb=u.util.escapeRegex,Oa=k("<div>")[0],rc=Oa.textContent!==q,sc=/<.*?>/g,fb=u.util.throttle,mc=[],N=Array.prototype,vc=function(a){var b,c=u.settings,d=k.map(c,function(f,g){return f.nTable});if(a){if(a.nTable&&a.oApi)return[a];if(a.nodeName&&"table"===a.nodeName.toLowerCase()){var e=
k.inArray(a,d);return-1!==e?[c[e]]:null}if(a&&"function"===typeof a.settings)return a.settings().toArray();"string"===typeof a?b=k(a):a instanceof k&&(b=a)}else return[];if(b)return b.map(function(f){e=k.inArray(this,d);return-1!==e?c[e]:null}).toArray()};var D=function(a,b){if(!(this instanceof D))return new D(a,b);var c=[],d=function(g){(g=vc(g))&&c.push.apply(c,g)};if(Array.isArray(a))for(var e=0,f=a.length;e<f;e++)d(a[e]);else d(a);this.context=Ja(c);b&&k.merge(this,b);this.selector={rows:null,
cols:null,opts:null};D.extend(this,this,mc)};u.Api=D;k.extend(D.prototype,{any:function(){return 0!==this.count()},concat:N.concat,context:[],count:function(){return this.flatten().length},each:function(a){for(var b=0,c=this.length;b<c;b++)a.call(this,this[b],b,this);return this},eq:function(a){var b=this.context;return b.length>a?new D(b[a],this[a]):null},filter:function(a){var b=[];if(N.filter)b=N.filter.call(this,a,this);else for(var c=0,d=this.length;c<d;c++)a.call(this,this[c],c,this)&&b.push(this[c]);
return new D(this.context,b)},flatten:function(){var a=[];return new D(this.context,a.concat.apply(a,this.toArray()))},join:N.join,indexOf:N.indexOf||function(a,b){b=b||0;for(var c=this.length;b<c;b++)if(this[b]===a)return b;return-1},iterator:function(a,b,c,d){var e=[],f,g,h=this.context,l,n=this.selector;"string"===typeof a&&(d=c,c=b,b=a,a=!1);var m=0;for(f=h.length;m<f;m++){var p=new D(h[m]);if("table"===b){var t=c.call(p,h[m],m);t!==q&&e.push(t)}else if("columns"===b||"rows"===b)t=c.call(p,h[m],
this[m],m),t!==q&&e.push(t);else if("column"===b||"column-rows"===b||"row"===b||"cell"===b){var v=this[m];"column-rows"===b&&(l=Ua(h[m],n.opts));var x=0;for(g=v.length;x<g;x++)t=v[x],t="cell"===b?c.call(p,h[m],t.row,t.column,m,x):c.call(p,h[m],t,m,x,l),t!==q&&e.push(t)}}return e.length||d?(a=new D(h,a?e.concat.apply([],e):e),b=a.selector,b.rows=n.rows,b.cols=n.cols,b.opts=n.opts,a):this},lastIndexOf:N.lastIndexOf||function(a,b){return this.indexOf.apply(this.toArray.reverse(),arguments)},length:0,
map:function(a){var b=[];if(N.map)b=N.map.call(this,a,this);else for(var c=0,d=this.length;c<d;c++)b.push(a.call(this,this[c],c));return new D(this.context,b)},pluck:function(a){return this.map(function(b){return b[a]})},pop:N.pop,push:N.push,reduce:N.reduce||function(a,b){return Bb(this,a,b,0,this.length,1)},reduceRight:N.reduceRight||function(a,b){return Bb(this,a,b,this.length-1,-1,-1)},reverse:N.reverse,selector:null,shift:N.shift,slice:function(){return new D(this.context,this)},sort:N.sort,
splice:N.splice,toArray:function(){return N.slice.call(this)},to$:function(){return k(this)},toJQuery:function(){return k(this)},unique:function(){return new D(this.context,Ja(this))},unshift:N.unshift});D.extend=function(a,b,c){if(c.length&&b&&(b instanceof D||b.__dt_wrapper)){var d,e=function(h,l,n){return function(){var m=l.apply(h,arguments);D.extend(m,m,n.methodExt);return m}};var f=0;for(d=c.length;f<d;f++){var g=c[f];b[g.name]="function"===g.type?e(a,g.val,g):"object"===g.type?{}:g.val;b[g.name].__dt_wrapper=
!0;D.extend(a,b[g.name],g.propExt)}}};D.register=w=function(a,b){if(Array.isArray(a))for(var c=0,d=a.length;c<d;c++)D.register(a[c],b);else{d=a.split(".");var e=mc,f;a=0;for(c=d.length;a<c;a++){var g=(f=-1!==d[a].indexOf("()"))?d[a].replace("()",""):d[a];a:{var h=0;for(var l=e.length;h<l;h++)if(e[h].name===g){h=e[h];break a}h=null}h||(h={name:g,val:{},methodExt:[],propExt:[],type:"object"},e.push(h));a===c-1?(h.val=b,h.type="function"===typeof b?"function":k.isPlainObject(b)?"object":"other"):e=f?
h.methodExt:h.propExt}}};D.registerPlural=J=function(a,b,c){D.register(a,c);D.register(b,function(){var d=c.apply(this,arguments);return d===this?this:d instanceof D?d.length?Array.isArray(d[0])?new D(d.context,d[0]):d[0]:q:d})};var nc=function(a,b){if(Array.isArray(a))return k.map(a,function(d){return nc(d,b)});if("number"===typeof a)return[b[a]];var c=k.map(b,function(d,e){return d.nTable});return k(c).filter(a).map(function(d){d=k.inArray(this,c);return b[d]}).toArray()};w("tables()",function(a){return a!==
q&&null!==a?new D(nc(a,this.context)):this});w("table()",function(a){a=this.tables(a);var b=a.context;return b.length?new D(b[0]):a});J("tables().nodes()","table().node()",function(){return this.iterator("table",function(a){return a.nTable},1)});J("tables().body()","table().body()",function(){return this.iterator("table",function(a){return a.nTBody},1)});J("tables().header()","table().header()",function(){return this.iterator("table",function(a){return a.nTHead},1)});J("tables().footer()","table().footer()",
function(){return this.iterator("table",function(a){return a.nTFoot},1)});J("tables().containers()","table().container()",function(){return this.iterator("table",function(a){return a.nTableWrapper},1)});w("draw()",function(a){return this.iterator("table",function(b){"page"===a?fa(b):("string"===typeof a&&(a="full-hold"===a?!1:!0),ja(b,!1===a))})});w("page()",function(a){return a===q?this.page.info().page:this.iterator("table",function(b){kb(b,a)})});w("page.info()",function(a){if(0===this.context.length)return q;
a=this.context[0];var b=a._iDisplayStart,c=a.oFeatures.bPaginate?a._iDisplayLength:-1,d=a.fnRecordsDisplay(),e=-1===c;return{page:e?0:Math.floor(b/c),pages:e?1:Math.ceil(d/c),start:b,end:a.fnDisplayEnd(),length:c,recordsTotal:a.fnRecordsTotal(),recordsDisplay:d,serverSide:"ssp"===P(a)}});w("page.len()",function(a){return a===q?0!==this.context.length?this.context[0]._iDisplayLength:q:this.iterator("table",function(b){ib(b,a)})});var oc=function(a,b,c){if(c){var d=new D(a);d.one("draw",function(){c(d.ajax.json())})}if("ssp"==
P(a))ja(a,b);else{U(a,!0);var e=a.jqXHR;e&&4!==e.readyState&&e.abort();La(a,[],function(f){Ha(a);f=Ma(a,f);for(var g=0,h=f.length;g<h;g++)ea(a,f[g]);ja(a,b);U(a,!1)})}};w("ajax.json()",function(){var a=this.context;if(0<a.length)return a[0].json});w("ajax.params()",function(){var a=this.context;if(0<a.length)return a[0].oAjaxData});w("ajax.reload()",function(a,b){return this.iterator("table",function(c){oc(c,!1===b,a)})});w("ajax.url()",function(a){var b=this.context;if(a===q){if(0===b.length)return q;
b=b[0];return b.ajax?k.isPlainObject(b.ajax)?b.ajax.url:b.ajax:b.sAjaxSource}return this.iterator("table",function(c){k.isPlainObject(c.ajax)?c.ajax.url=a:c.ajax=a})});w("ajax.url().load()",function(a,b){return this.iterator("table",function(c){oc(c,!1===b,a)})});var tb=function(a,b,c,d,e){var f=[],g,h,l;var n=typeof b;b&&"string"!==n&&"function"!==n&&b.length!==q||(b=[b]);n=0;for(h=b.length;n<h;n++){var m=b[n]&&b[n].split&&!b[n].match(/[\[\(:]/)?b[n].split(","):[b[n]];var p=0;for(l=m.length;p<l;p++)(g=
c("string"===typeof m[p]?m[p].trim():m[p]))&&g.length&&(f=f.concat(g))}a=L.selector[a];if(a.length)for(n=0,h=a.length;n<h;n++)f=a[n](d,e,f);return Ja(f)},ub=function(a){a||(a={});a.filter&&a.search===q&&(a.search=a.filter);return k.extend({search:"none",order:"current",page:"all"},a)},vb=function(a){for(var b=0,c=a.length;b<c;b++)if(0<a[b].length)return a[0]=a[b],a[0].length=1,a.length=1,a.context=[a.context[b]],a;a.length=0;return a},Ua=function(a,b){var c=[],d=a.aiDisplay;var e=a.aiDisplayMaster;
var f=b.search;var g=b.order;b=b.page;if("ssp"==P(a))return"removed"===f?[]:qa(0,e.length);if("current"==b)for(g=a._iDisplayStart,a=a.fnDisplayEnd();g<a;g++)c.push(d[g]);else if("current"==g||"applied"==g)if("none"==f)c=e.slice();else if("applied"==f)c=d.slice();else{if("removed"==f){var h={};g=0;for(a=d.length;g<a;g++)h[d[g]]=null;c=k.map(e,function(l){return h.hasOwnProperty(l)?null:l})}}else if("index"==g||"original"==g)for(g=0,a=a.aoData.length;g<a;g++)"none"==f?c.push(g):(e=k.inArray(g,d),(-1===
e&&"removed"==f||0<=e&&"applied"==f)&&c.push(g));return c},wc=function(a,b,c){var d;return tb("row",b,function(e){var f=hc(e),g=a.aoData;if(null!==f&&!c)return[f];d||(d=Ua(a,c));if(null!==f&&-1!==k.inArray(f,d))return[f];if(null===e||e===q||""===e)return d;if("function"===typeof e)return k.map(d,function(l){var n=g[l];return e(l,n._aData,n.nTr)?l:null});if(e.nodeName){f=e._DT_RowIndex;var h=e._DT_CellIndex;if(f!==q)return g[f]&&g[f].nTr===e?[f]:[];if(h)return g[h.row]&&g[h.row].nTr===e.parentNode?
[h.row]:[];f=k(e).closest("*[data-dt-row]");return f.length?[f.data("dt-row")]:[]}if("string"===typeof e&&"#"===e.charAt(0)&&(f=a.aIds[e.replace(/^#/,"")],f!==q))return[f.idx];f=kc(Ca(a.aoData,d,"nTr"));return k(f).filter(e).map(function(){return this._DT_RowIndex}).toArray()},a,c)};w("rows()",function(a,b){a===q?a="":k.isPlainObject(a)&&(b=a,a="");b=ub(b);var c=this.iterator("table",function(d){return wc(d,a,b)},1);c.selector.rows=a;c.selector.opts=b;return c});w("rows().nodes()",function(){return this.iterator("row",
function(a,b){return a.aoData[b].nTr||q},1)});w("rows().data()",function(){return this.iterator(!0,"rows",function(a,b){return Ca(a.aoData,b,"_aData")},1)});J("rows().cache()","row().cache()",function(a){return this.iterator("row",function(b,c){b=b.aoData[c];return"search"===a?b._aFilterData:b._aSortData},1)});J("rows().invalidate()","row().invalidate()",function(a){return this.iterator("row",function(b,c){va(b,c,a)})});J("rows().indexes()","row().index()",function(){return this.iterator("row",function(a,
b){return b},1)});J("rows().ids()","row().id()",function(a){for(var b=[],c=this.context,d=0,e=c.length;d<e;d++)for(var f=0,g=this[d].length;f<g;f++){var h=c[d].rowIdFn(c[d].aoData[this[d][f]]._aData);b.push((!0===a?"#":"")+h)}return new D(c,b)});J("rows().remove()","row().remove()",function(){var a=this;this.iterator("row",function(b,c,d){var e=b.aoData,f=e[c],g,h;e.splice(c,1);var l=0;for(g=e.length;l<g;l++){var n=e[l];var m=n.anCells;null!==n.nTr&&(n.nTr._DT_RowIndex=l);if(null!==m)for(n=0,h=m.length;n<
h;n++)m[n]._DT_CellIndex.row=l}Ia(b.aiDisplayMaster,c);Ia(b.aiDisplay,c);Ia(a[d],c,!1);0<b._iRecordsDisplay&&b._iRecordsDisplay--;jb(b);c=b.rowIdFn(f._aData);c!==q&&delete b.aIds[c]});this.iterator("table",function(b){for(var c=0,d=b.aoData.length;c<d;c++)b.aoData[c].idx=c});return this});w("rows.add()",function(a){var b=this.iterator("table",function(d){var e,f=[];var g=0;for(e=a.length;g<e;g++){var h=a[g];h.nodeName&&"TR"===h.nodeName.toUpperCase()?f.push(Ga(d,h)[0]):f.push(ea(d,h))}return f},1),
c=this.rows(-1);c.pop();k.merge(c,b);return c});w("row()",function(a,b){return vb(this.rows(a,b))});w("row().data()",function(a){var b=this.context;if(a===q)return b.length&&this.length?b[0].aoData[this[0]]._aData:q;var c=b[0].aoData[this[0]];c._aData=a;Array.isArray(a)&&c.nTr&&c.nTr.id&&da(b[0].rowId)(a,c.nTr.id);va(b[0],this[0],"data");return this});w("row().node()",function(){var a=this.context;return a.length&&this.length?a[0].aoData[this[0]].nTr||null:null});w("row.add()",function(a){a instanceof
k&&a.length&&(a=a[0]);var b=this.iterator("table",function(c){return a.nodeName&&"TR"===a.nodeName.toUpperCase()?Ga(c,a)[0]:ea(c,a)});return this.row(b[0])});var xc=function(a,b,c,d){var e=[],f=function(g,h){if(Array.isArray(g)||g instanceof k)for(var l=0,n=g.length;l<n;l++)f(g[l],h);else g.nodeName&&"tr"===g.nodeName.toLowerCase()?e.push(g):(l=k("<tr><td></td></tr>").addClass(h),k("td",l).addClass(h).html(g)[0].colSpan=na(a),e.push(l[0]))};f(c,d);b._details&&b._details.detach();b._details=k(e);b._detailsShow&&
b._details.insertAfter(b.nTr)},wb=function(a,b){var c=a.context;c.length&&(a=c[0].aoData[b!==q?b:a[0]])&&a._details&&(a._details.remove(),a._detailsShow=q,a._details=q)},pc=function(a,b){var c=a.context;c.length&&a.length&&(a=c[0].aoData[a[0]],a._details&&((a._detailsShow=b)?a._details.insertAfter(a.nTr):a._details.detach(),yc(c[0])))},yc=function(a){var b=new D(a),c=a.aoData;b.off("draw.dt.DT_details column-visibility.dt.DT_details destroy.dt.DT_details");0<T(c,"_details").length&&(b.on("draw.dt.DT_details",
function(d,e){a===e&&b.rows({page:"current"}).eq(0).each(function(f){f=c[f];f._detailsShow&&f._details.insertAfter(f.nTr)})}),b.on("column-visibility.dt.DT_details",function(d,e,f,g){if(a===e)for(e=na(e),f=0,g=c.length;f<g;f++)d=c[f],d._details&&d._details.children("td[colspan]").attr("colspan",e)}),b.on("destroy.dt.DT_details",function(d,e){if(a===e)for(d=0,e=c.length;d<e;d++)c[d]._details&&wb(b,d)}))};w("row().child()",function(a,b){var c=this.context;if(a===q)return c.length&&this.length?c[0].aoData[this[0]]._details:
q;!0===a?this.child.show():!1===a?wb(this):c.length&&this.length&&xc(c[0],c[0].aoData[this[0]],a,b);return this});w(["row().child.show()","row().child().show()"],function(a){pc(this,!0);return this});w(["row().child.hide()","row().child().hide()"],function(){pc(this,!1);return this});w(["row().child.remove()","row().child().remove()"],function(){wb(this);return this});w("row().child.isShown()",function(){var a=this.context;return a.length&&this.length?a[0].aoData[this[0]]._detailsShow||!1:!1});var zc=
/^([^:]+):(name|visIdx|visible)$/,qc=function(a,b,c,d,e){c=[];d=0;for(var f=e.length;d<f;d++)c.push(S(a,e[d],b));return c},Ac=function(a,b,c){var d=a.aoColumns,e=T(d,"sName"),f=T(d,"nTh");return tb("column",b,function(g){var h=hc(g);if(""===g)return qa(d.length);if(null!==h)return[0<=h?h:d.length+h];if("function"===typeof g){var l=Ua(a,c);return k.map(d,function(p,t){return g(t,qc(a,t,0,0,l),f[t])?t:null})}var n="string"===typeof g?g.match(zc):"";if(n)switch(n[2]){case "visIdx":case "visible":h=parseInt(n[1],
10);if(0>h){var m=k.map(d,function(p,t){return p.bVisible?t:null});return[m[m.length+h]]}return[sa(a,h)];case "name":return k.map(e,function(p,t){return p===n[1]?t:null});default:return[]}if(g.nodeName&&g._DT_CellIndex)return[g._DT_CellIndex.column];h=k(f).filter(g).map(function(){return k.inArray(this,f)}).toArray();if(h.length||!g.nodeName)return h;h=k(g).closest("*[data-dt-column]");return h.length?[h.data("dt-column")]:[]},a,c)};w("columns()",function(a,b){a===q?a="":k.isPlainObject(a)&&(b=a,
a="");b=ub(b);var c=this.iterator("table",function(d){return Ac(d,a,b)},1);c.selector.cols=a;c.selector.opts=b;return c});J("columns().header()","column().header()",function(a,b){return this.iterator("column",function(c,d){return c.aoColumns[d].nTh},1)});J("columns().footer()","column().footer()",function(a,b){return this.iterator("column",function(c,d){return c.aoColumns[d].nTf},1)});J("columns().data()","column().data()",function(){return this.iterator("column-rows",qc,1)});J("columns().dataSrc()",
"column().dataSrc()",function(){return this.iterator("column",function(a,b){return a.aoColumns[b].mData},1)});J("columns().cache()","column().cache()",function(a){return this.iterator("column-rows",function(b,c,d,e,f){return Ca(b.aoData,f,"search"===a?"_aFilterData":"_aSortData",c)},1)});J("columns().nodes()","column().nodes()",function(){return this.iterator("column-rows",function(a,b,c,d,e){return Ca(a.aoData,e,"anCells",b)},1)});J("columns().visible()","column().visible()",function(a,b){var c=
this,d=this.iterator("column",function(e,f){if(a===q)return e.aoColumns[f].bVisible;var g=e.aoColumns,h=g[f],l=e.aoData,n;if(a!==q&&h.bVisible!==a){if(a){var m=k.inArray(!0,T(g,"bVisible"),f+1);g=0;for(n=l.length;g<n;g++){var p=l[g].nTr;e=l[g].anCells;p&&p.insertBefore(e[f],e[m]||null)}}else k(T(e.aoData,"anCells",f)).detach();h.bVisible=a}});a!==q&&this.iterator("table",function(e){xa(e,e.aoHeader);xa(e,e.aoFooter);e.aiDisplay.length||k(e.nTBody).find("td[colspan]").attr("colspan",na(e));Qa(e);c.iterator("column",
function(f,g){I(f,null,"column-visibility",[f,g,a,b])});(b===q||b)&&c.columns.adjust()});return d});J("columns().indexes()","column().index()",function(a){return this.iterator("column",function(b,c){return"visible"===a?ta(b,c):c},1)});w("columns.adjust()",function(){return this.iterator("table",function(a){ra(a)},1)});w("column.index()",function(a,b){if(0!==this.context.length){var c=this.context[0];if("fromVisible"===a||"toData"===a)return sa(c,b);if("fromData"===a||"toVisible"===a)return ta(c,b)}});
w("column()",function(a,b){return vb(this.columns(a,b))});var Bc=function(a,b,c){var d=a.aoData,e=Ua(a,c),f=kc(Ca(d,e,"anCells")),g=k(lc([],f)),h,l=a.aoColumns.length,n,m,p,t,v,x;return tb("cell",b,function(r){var A="function"===typeof r;if(null===r||r===q||A){n=[];m=0;for(p=e.length;m<p;m++)for(h=e[m],t=0;t<l;t++)v={row:h,column:t},A?(x=d[h],r(v,S(a,h,t),x.anCells?x.anCells[t]:null)&&n.push(v)):n.push(v);return n}if(k.isPlainObject(r))return r.column!==q&&r.row!==q&&-1!==k.inArray(r.row,e)?[r]:[];
A=g.filter(r).map(function(E,H){return{row:H._DT_CellIndex.row,column:H._DT_CellIndex.column}}).toArray();if(A.length||!r.nodeName)return A;x=k(r).closest("*[data-dt-row]");return x.length?[{row:x.data("dt-row"),column:x.data("dt-column")}]:[]},a,c)};w("cells()",function(a,b,c){k.isPlainObject(a)&&(a.row===q?(c=a,a=null):(c=b,b=null));k.isPlainObject(b)&&(c=b,b=null);if(null===b||b===q)return this.iterator("table",function(m){return Bc(m,a,ub(c))});var d=c?{page:c.page,order:c.order,search:c.search}:
{},e=this.columns(b,d),f=this.rows(a,d),g,h,l,n;d=this.iterator("table",function(m,p){m=[];g=0;for(h=f[p].length;g<h;g++)for(l=0,n=e[p].length;l<n;l++)m.push({row:f[p][g],column:e[p][l]});return m},1);d=c&&c.selected?this.cells(d,c):d;k.extend(d.selector,{cols:b,rows:a,opts:c});return d});J("cells().nodes()","cell().node()",function(){return this.iterator("cell",function(a,b,c){return(a=a.aoData[b])&&a.anCells?a.anCells[c]:q},1)});w("cells().data()",function(){return this.iterator("cell",function(a,
b,c){return S(a,b,c)},1)});J("cells().cache()","cell().cache()",function(a){a="search"===a?"_aFilterData":"_aSortData";return this.iterator("cell",function(b,c,d){return b.aoData[c][a][d]},1)});J("cells().render()","cell().render()",function(a){return this.iterator("cell",function(b,c,d){return S(b,c,d,a)},1)});J("cells().indexes()","cell().index()",function(){return this.iterator("cell",function(a,b,c){return{row:b,column:c,columnVisible:ta(a,c)}},1)});J("cells().invalidate()","cell().invalidate()",
function(a){return this.iterator("cell",function(b,c,d){va(b,c,a,d)})});w("cell()",function(a,b,c){return vb(this.cells(a,b,c))});w("cell().data()",function(a){var b=this.context,c=this[0];if(a===q)return b.length&&c.length?S(b[0],c[0].row,c[0].column):q;Db(b[0],c[0].row,c[0].column,a);va(b[0],c[0].row,"data",c[0].column);return this});w("order()",function(a,b){var c=this.context;if(a===q)return 0!==c.length?c[0].aaSorting:q;"number"===typeof a?a=[[a,b]]:a.length&&!Array.isArray(a[0])&&(a=Array.prototype.slice.call(arguments));
return this.iterator("table",function(d){d.aaSorting=a.slice()})});w("order.listener()",function(a,b,c){return this.iterator("table",function(d){db(d,a,b,c)})});w("order.fixed()",function(a){if(!a){var b=this.context;b=b.length?b[0].aaSortingFixed:q;return Array.isArray(b)?{pre:b}:b}return this.iterator("table",function(c){c.aaSortingFixed=k.extend(!0,{},a)})});w(["columns().order()","column().order()"],function(a){var b=this;return this.iterator("table",function(c,d){var e=[];k.each(b[d],function(f,
g){e.push([g,a])});c.aaSorting=e})});w("search()",function(a,b,c,d){var e=this.context;return a===q?0!==e.length?e[0].oPreviousSearch.sSearch:q:this.iterator("table",function(f){f.oFeatures.bFilter&&ya(f,k.extend({},f.oPreviousSearch,{sSearch:a+"",bRegex:null===b?!1:b,bSmart:null===c?!0:c,bCaseInsensitive:null===d?!0:d}),1)})});J("columns().search()","column().search()",function(a,b,c,d){return this.iterator("column",function(e,f){var g=e.aoPreSearchCols;if(a===q)return g[f].sSearch;e.oFeatures.bFilter&&
(k.extend(g[f],{sSearch:a+"",bRegex:null===b?!1:b,bSmart:null===c?!0:c,bCaseInsensitive:null===d?!0:d}),ya(e,e.oPreviousSearch,1))})});w("state()",function(){return this.context.length?this.context[0].oSavedState:null});w("state.clear()",function(){return this.iterator("table",function(a){a.fnStateSaveCallback.call(a.oInstance,a,{})})});w("state.loaded()",function(){return this.context.length?this.context[0].oLoadedState:null});w("state.save()",function(){return this.iterator("table",function(a){Qa(a)})});
u.versionCheck=u.fnVersionCheck=function(a){var b=u.version.split(".");a=a.split(".");for(var c,d,e=0,f=a.length;e<f;e++)if(c=parseInt(b[e],10)||0,d=parseInt(a[e],10)||0,c!==d)return c>d;return!0};u.isDataTable=u.fnIsDataTable=function(a){var b=k(a).get(0),c=!1;if(a instanceof u.Api)return!0;k.each(u.settings,function(d,e){d=e.nScrollHead?k("table",e.nScrollHead)[0]:null;var f=e.nScrollFoot?k("table",e.nScrollFoot)[0]:null;if(e.nTable===b||d===b||f===b)c=!0});return c};u.tables=u.fnTables=function(a){var b=
!1;k.isPlainObject(a)&&(b=a.api,a=a.visible);var c=k.map(u.settings,function(d){if(!a||a&&k(d.nTable).is(":visible"))return d.nTable});return b?new D(c):c};u.camelToHungarian=O;w("$()",function(a,b){b=this.rows(b).nodes();b=k(b);return k([].concat(b.filter(a).toArray(),b.find(a).toArray()))});k.each(["on","one","off"],function(a,b){w(b+"()",function(){var c=Array.prototype.slice.call(arguments);c[0]=k.map(c[0].split(/\s/),function(e){return e.match(/\.dt\b/)?e:e+".dt"}).join(" ");var d=k(this.tables().nodes());
d[b].apply(d,c);return this})});w("clear()",function(){return this.iterator("table",function(a){Ha(a)})});w("settings()",function(){return new D(this.context,this.context)});w("init()",function(){var a=this.context;return a.length?a[0].oInit:null});w("data()",function(){return this.iterator("table",function(a){return T(a.aoData,"_aData")}).flatten()});w("destroy()",function(a){a=a||!1;return this.iterator("table",function(b){var c=b.nTableWrapper.parentNode,d=b.oClasses,e=b.nTable,f=b.nTBody,g=b.nTHead,
h=b.nTFoot,l=k(e);f=k(f);var n=k(b.nTableWrapper),m=k.map(b.aoData,function(t){return t.nTr}),p;b.bDestroying=!0;I(b,"aoDestroyCallback","destroy",[b]);a||(new D(b)).columns().visible(!0);n.off(".DT").find(":not(tbody *)").off(".DT");k(y).off(".DT-"+b.sInstance);e!=g.parentNode&&(l.children("thead").detach(),l.append(g));h&&e!=h.parentNode&&(l.children("tfoot").detach(),l.append(h));b.aaSorting=[];b.aaSortingFixed=[];Pa(b);k(m).removeClass(b.asStripeClasses.join(" "));k("th, td",g).removeClass(d.sSortable+
" "+d.sSortableAsc+" "+d.sSortableDesc+" "+d.sSortableNone);f.children().detach();f.append(m);g=a?"remove":"detach";l[g]();n[g]();!a&&c&&(c.insertBefore(e,b.nTableReinsertBefore),l.css("width",b.sDestroyWidth).removeClass(d.sTable),(p=b.asDestroyStripes.length)&&f.children().each(function(t){k(this).addClass(b.asDestroyStripes[t%p])}));c=k.inArray(b,u.settings);-1!==c&&u.settings.splice(c,1)})});k.each(["column","row","cell"],function(a,b){w(b+"s().every()",function(c){var d=this.selector.opts,e=
this;return this.iterator(b,function(f,g,h,l,n){c.call(e[b](g,"cell"===b?h:d,"cell"===b?d:q),g,h,l,n)})})});w("i18n()",function(a,b,c){var d=this.context[0];a=ia(a)(d.oLanguage);a===q&&(a=b);c!==q&&k.isPlainObject(a)&&(a=a[c]!==q?a[c]:a._);return a.replace("%d",c)});u.version="1.10.23";u.settings=[];u.models={};u.models.oSearch={bCaseInsensitive:!0,sSearch:"",bRegex:!1,bSmart:!0};u.models.oRow={nTr:null,anCells:null,_aData:[],_aSortData:null,_aFilterData:null,_sFilterRow:null,_sRowStripe:"",src:null,
idx:-1};u.models.oColumn={idx:null,aDataSort:null,asSorting:null,bSearchable:null,bSortable:null,bVisible:null,_sManualType:null,_bAttrSrc:!1,fnCreatedCell:null,fnGetData:null,fnSetData:null,mData:null,mRender:null,nTh:null,nTf:null,sClass:null,sContentPadding:null,sDefaultContent:null,sName:null,sSortDataType:"std",sSortingClass:null,sSortingClassJUI:null,sTitle:null,sType:null,sWidth:null,sWidthOrig:null};u.defaults={aaData:null,aaSorting:[[0,"asc"]],aaSortingFixed:[],ajax:null,aLengthMenu:[10,
25,50,100],aoColumns:null,aoColumnDefs:null,aoSearchCols:[],asStripeClasses:null,bAutoWidth:!0,bDeferRender:!1,bDestroy:!1,bFilter:!0,bInfo:!0,bLengthChange:!0,bPaginate:!0,bProcessing:!1,bRetrieve:!1,bScrollCollapse:!1,bServerSide:!1,bSort:!0,bSortMulti:!0,bSortCellsTop:!1,bSortClasses:!0,bStateSave:!1,fnCreatedRow:null,fnDrawCallback:null,fnFooterCallback:null,fnFormatNumber:function(a){return a.toString().replace(/\B(?=(\d{3})+(?!\d))/g,this.oLanguage.sThousands)},fnHeaderCallback:null,fnInfoCallback:null,
fnInitComplete:null,fnPreDrawCallback:null,fnRowCallback:null,fnServerData:null,fnServerParams:null,fnStateLoadCallback:function(a){try{return JSON.parse((-1===a.iStateDuration?sessionStorage:localStorage).getItem("DataTables_"+a.sInstance+"_"+location.pathname))}catch(b){return{}}},fnStateLoadParams:null,fnStateLoaded:null,fnStateSaveCallback:function(a,b){try{(-1===a.iStateDuration?sessionStorage:localStorage).setItem("DataTables_"+a.sInstance+"_"+location.pathname,JSON.stringify(b))}catch(c){}},
fnStateSaveParams:null,iStateDuration:7200,iDeferLoading:null,iDisplayLength:10,iDisplayStart:0,iTabIndex:0,oClasses:{},oLanguage:{oAria:{sSortAscending:": activate to sort column ascending",sSortDescending:": activate to sort column descending"},oPaginate:{sFirst:"First",sLast:"Last",sNext:"Next",sPrevious:"Previous"},sEmptyTable:"No data available in table",sInfo:"Showing _START_ to _END_ of _TOTAL_ entries",sInfoEmpty:"Showing 0 to 0 of 0 entries",sInfoFiltered:"(filtered from _MAX_ total entries)",
sInfoPostFix:"",sDecimal:"",sThousands:",",sLengthMenu:"Show _MENU_ entries",sLoadingRecords:"Loading...",sProcessing:"Processing...",sSearch:"Search:",sSearchPlaceholder:"",sUrl:"",sZeroRecords:"No matching records found"},oSearch:k.extend({},u.models.oSearch),sAjaxDataProp:"data",sAjaxSource:null,sDom:"lfrtip",searchDelay:null,sPaginationType:"simple_numbers",sScrollX:"",sScrollXInner:"",sScrollY:"",sServerMethod:"GET",renderer:null,rowId:"DT_RowId"};G(u.defaults);u.defaults.column={aDataSort:null,
iDataSort:-1,asSorting:["asc","desc"],bSearchable:!0,bSortable:!0,bVisible:!0,fnCreatedCell:null,mData:null,mRender:null,sCellType:"td",sClass:"",sContentPadding:"",sDefaultContent:null,sName:"",sSortDataType:"std",sTitle:null,sType:null,sWidth:null};G(u.defaults.column);u.models.oSettings={oFeatures:{bAutoWidth:null,bDeferRender:null,bFilter:null,bInfo:null,bLengthChange:null,bPaginate:null,bProcessing:null,bServerSide:null,bSort:null,bSortMulti:null,bSortClasses:null,bStateSave:null},oScroll:{bCollapse:null,
iBarWidth:0,sX:null,sXInner:null,sY:null},oLanguage:{fnInfoCallback:null},oBrowser:{bScrollOversize:!1,bScrollbarLeft:!1,bBounding:!1,barWidth:0},ajax:null,aanFeatures:[],aoData:[],aiDisplay:[],aiDisplayMaster:[],aIds:{},aoColumns:[],aoHeader:[],aoFooter:[],oPreviousSearch:{},aoPreSearchCols:[],aaSorting:null,aaSortingFixed:[],asStripeClasses:null,asDestroyStripes:[],sDestroyWidth:0,aoRowCallback:[],aoHeaderCallback:[],aoFooterCallback:[],aoDrawCallback:[],aoRowCreatedCallback:[],aoPreDrawCallback:[],
aoInitComplete:[],aoStateSaveParams:[],aoStateLoadParams:[],aoStateLoaded:[],sTableId:"",nTable:null,nTHead:null,nTFoot:null,nTBody:null,nTableWrapper:null,bDeferLoading:!1,bInitialised:!1,aoOpenRows:[],sDom:null,searchDelay:null,sPaginationType:"two_button",iStateDuration:0,aoStateSave:[],aoStateLoad:[],oSavedState:null,oLoadedState:null,sAjaxSource:null,sAjaxDataProp:null,bAjaxDataGet:!0,jqXHR:null,json:q,oAjaxData:q,fnServerData:null,aoServerParams:[],sServerMethod:null,fnFormatNumber:null,aLengthMenu:null,
iDraw:0,bDrawing:!1,iDrawError:-1,_iDisplayLength:10,_iDisplayStart:0,_iRecordsTotal:0,_iRecordsDisplay:0,oClasses:{},bFiltered:!1,bSorted:!1,bSortCellsTop:null,oInit:null,aoDestroyCallback:[],fnRecordsTotal:function(){return"ssp"==P(this)?1*this._iRecordsTotal:this.aiDisplayMaster.length},fnRecordsDisplay:function(){return"ssp"==P(this)?1*this._iRecordsDisplay:this.aiDisplay.length},fnDisplayEnd:function(){var a=this._iDisplayLength,b=this._iDisplayStart,c=b+a,d=this.aiDisplay.length,e=this.oFeatures,
f=e.bPaginate;return e.bServerSide?!1===f||-1===a?b+d:Math.min(b+a,this._iRecordsDisplay):!f||c>d||-1===a?d:c},oInstance:null,sInstance:null,iTabIndex:0,nScrollHead:null,nScrollFoot:null,aLastSort:[],oPlugins:{},rowIdFn:null,rowId:null};u.ext=L={buttons:{},classes:{},build:"bs4/dt-1.10.23/b-1.6.5/r-2.2.7/sl-1.3.1",errMode:"alert",feature:[],search:[],selector:{cell:[],column:[],row:[]},internal:{},legacy:{ajax:null},pager:{},renderer:{pageButton:{},header:{}},order:{},type:{detect:[],search:{},order:{}},_unique:0,fnVersionCheck:u.fnVersionCheck,
iApiIndex:0,oJUIClasses:{},sVersion:u.version};k.extend(L,{afnFiltering:L.search,aTypes:L.type.detect,ofnSearch:L.type.search,oSort:L.type.order,afnSortData:L.order,aoFeatures:L.feature,oApi:L.internal,oStdClasses:L.classes,oPagination:L.pager});k.extend(u.ext.classes,{sTable:"dataTable",sNoFooter:"no-footer",sPageButton:"paginate_button",sPageButtonActive:"current",sPageButtonDisabled:"disabled",sStripeOdd:"odd",sStripeEven:"even",sRowEmpty:"dataTables_empty",sWrapper:"dataTables_wrapper",sFilter:"dataTables_filter",
sInfo:"dataTables_info",sPaging:"dataTables_paginate paging_",sLength:"dataTables_length",sProcessing:"dataTables_processing",sSortAsc:"sorting_asc",sSortDesc:"sorting_desc",sSortable:"sorting",sSortableAsc:"sorting_asc_disabled",sSortableDesc:"sorting_desc_disabled",sSortableNone:"sorting_disabled",sSortColumn:"sorting_",sFilterInput:"",sLengthSelect:"",sScrollWrapper:"dataTables_scroll",sScrollHead:"dataTables_scrollHead",sScrollHeadInner:"dataTables_scrollHeadInner",sScrollBody:"dataTables_scrollBody",
sScrollFoot:"dataTables_scrollFoot",sScrollFootInner:"dataTables_scrollFootInner",sHeaderTH:"",sFooterTH:"",sSortJUIAsc:"",sSortJUIDesc:"",sSortJUI:"",sSortJUIAscAllowed:"",sSortJUIDescAllowed:"",sSortJUIWrapper:"",sSortIcon:"",sJUIHeader:"",sJUIFooter:""});var ec=u.ext.pager;k.extend(ec,{simple:function(a,b){return["previous","next"]},full:function(a,b){return["first","previous","next","last"]},numbers:function(a,b){return[Ba(a,b)]},simple_numbers:function(a,b){return["previous",Ba(a,b),"next"]},
full_numbers:function(a,b){return["first","previous",Ba(a,b),"next","last"]},first_last_numbers:function(a,b){return["first",Ba(a,b),"last"]},_numbers:Ba,numbers_length:7});k.extend(!0,u.ext.renderer,{pageButton:{_:function(a,b,c,d,e,f){var g=a.oClasses,h=a.oLanguage.oPaginate,l=a.oLanguage.oAria.paginate||{},n,m,p=0,t=function(x,r){var A,E=g.sPageButtonDisabled,H=function(B){kb(a,B.data.action,!0)};var W=0;for(A=r.length;W<A;W++){var M=r[W];if(Array.isArray(M)){var C=k("<"+(M.DT_el||"div")+"/>").appendTo(x);
t(C,M)}else{n=null;m=M;C=a.iTabIndex;switch(M){case "ellipsis":x.append('<span class="ellipsis">&#x2026;</span>');break;case "first":n=h.sFirst;0===e&&(C=-1,m+=" "+E);break;case "previous":n=h.sPrevious;0===e&&(C=-1,m+=" "+E);break;case "next":n=h.sNext;if(0===f||e===f-1)C=-1,m+=" "+E;break;case "last":n=h.sLast;if(0===f||e===f-1)C=-1,m+=" "+E;break;default:n=a.fnFormatNumber(M+1),m=e===M?g.sPageButtonActive:""}null!==n&&(C=k("<a>",{"class":g.sPageButton+" "+m,"aria-controls":a.sTableId,"aria-label":l[M],
"data-dt-idx":p,tabindex:C,id:0===c&&"string"===typeof M?a.sTableId+"_"+M:null}).html(n).appendTo(x),ob(C,{action:M},H),p++)}}};try{var v=k(b).find(z.activeElement).data("dt-idx")}catch(x){}t(k(b).empty(),d);v!==q&&k(b).find("[data-dt-idx="+v+"]").trigger("focus")}}});k.extend(u.ext.type.detect,[function(a,b){b=b.oLanguage.sDecimal;return sb(a,b)?"num"+b:null},function(a,b){if(a&&!(a instanceof Date)&&!tc.test(a))return null;b=Date.parse(a);return null!==b&&!isNaN(b)||ca(a)?"date":null},function(a,
b){b=b.oLanguage.sDecimal;return sb(a,b,!0)?"num-fmt"+b:null},function(a,b){b=b.oLanguage.sDecimal;return jc(a,b)?"html-num"+b:null},function(a,b){b=b.oLanguage.sDecimal;return jc(a,b,!0)?"html-num-fmt"+b:null},function(a,b){return ca(a)||"string"===typeof a&&-1!==a.indexOf("<")?"html":null}]);k.extend(u.ext.type.search,{html:function(a){return ca(a)?a:"string"===typeof a?a.replace(gc," ").replace(Ta,""):""},string:function(a){return ca(a)?a:"string"===typeof a?a.replace(gc," "):a}});var Sa=function(a,
b,c,d){if(0!==a&&(!a||"-"===a))return-Infinity;b&&(a=ic(a,b));a.replace&&(c&&(a=a.replace(c,"")),d&&(a=a.replace(d,"")));return 1*a};k.extend(L.type.order,{"date-pre":function(a){a=Date.parse(a);return isNaN(a)?-Infinity:a},"html-pre":function(a){return ca(a)?"":a.replace?a.replace(/<.*?>/g,"").toLowerCase():a+""},"string-pre":function(a){return ca(a)?"":"string"===typeof a?a.toLowerCase():a.toString?a.toString():""},"string-asc":function(a,b){return a<b?-1:a>b?1:0},"string-desc":function(a,b){return a<
b?1:a>b?-1:0}});Va("");k.extend(!0,u.ext.renderer,{header:{_:function(a,b,c,d){k(a.nTable).on("order.dt.DT",function(e,f,g,h){a===f&&(e=c.idx,b.removeClass(c.sSortingClass+" "+d.sSortAsc+" "+d.sSortDesc).addClass("asc"==h[e]?d.sSortAsc:"desc"==h[e]?d.sSortDesc:c.sSortingClass))})},jqueryui:function(a,b,c,d){k("<div/>").addClass(d.sSortJUIWrapper).append(b.contents()).append(k("<span/>").addClass(d.sSortIcon+" "+c.sSortingClassJUI)).appendTo(b);k(a.nTable).on("order.dt.DT",function(e,f,g,h){a===f&&
(e=c.idx,b.removeClass(d.sSortAsc+" "+d.sSortDesc).addClass("asc"==h[e]?d.sSortAsc:"desc"==h[e]?d.sSortDesc:c.sSortingClass),b.find("span."+d.sSortIcon).removeClass(d.sSortJUIAsc+" "+d.sSortJUIDesc+" "+d.sSortJUI+" "+d.sSortJUIAscAllowed+" "+d.sSortJUIDescAllowed).addClass("asc"==h[e]?d.sSortJUIAsc:"desc"==h[e]?d.sSortJUIDesc:c.sSortingClassJUI))})}}});var xb=function(a){return"string"===typeof a?a.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;"):a};u.render=
{number:function(a,b,c,d,e){return{display:function(f){if("number"!==typeof f&&"string"!==typeof f)return f;var g=0>f?"-":"",h=parseFloat(f);if(isNaN(h))return xb(f);h=h.toFixed(c);f=Math.abs(h);h=parseInt(f,10);f=c?b+(f-h).toFixed(c).substring(2):"";return g+(d||"")+h.toString().replace(/\B(?=(\d{3})+(?!\d))/g,a)+f+(e||"")}}},text:function(){return{display:xb,filter:xb}}};k.extend(u.ext.internal,{_fnExternApiFunc:fc,_fnBuildAjax:La,_fnAjaxUpdate:Fb,_fnAjaxParameters:Ob,_fnAjaxUpdateDraw:Pb,_fnAjaxDataSrc:Ma,
_fnAddColumn:Wa,_fnColumnOptions:Da,_fnAdjustColumnSizing:ra,_fnVisibleToColumnIndex:sa,_fnColumnIndexToVisible:ta,_fnVisbleColumns:na,_fnGetColumns:Fa,_fnColumnTypes:Ya,_fnApplyColumnDefs:Cb,_fnHungarianMap:G,_fnCamelToHungarian:O,_fnLanguageCompat:ma,_fnBrowserDetect:Ab,_fnAddData:ea,_fnAddTr:Ga,_fnNodeToDataIndex:function(a,b){return b._DT_RowIndex!==q?b._DT_RowIndex:null},_fnNodeToColumnIndex:function(a,b,c){return k.inArray(c,a.aoData[b].anCells)},_fnGetCellData:S,_fnSetCellData:Db,_fnSplitObjNotation:ab,
_fnGetObjectDataFn:ia,_fnSetObjectDataFn:da,_fnGetDataMaster:bb,_fnClearTable:Ha,_fnDeleteIndex:Ia,_fnInvalidate:va,_fnGetRowElements:$a,_fnCreateTr:Za,_fnBuildHead:Eb,_fnDrawHead:xa,_fnDraw:fa,_fnReDraw:ja,_fnAddOptionsHtml:Hb,_fnDetectHeader:wa,_fnGetUniqueThs:Ka,_fnFeatureHtmlFilter:Jb,_fnFilterComplete:ya,_fnFilterCustom:Sb,_fnFilterColumn:Rb,_fnFilter:Qb,_fnFilterCreateSearch:gb,_fnEscapeRegex:hb,_fnFilterData:Tb,_fnFeatureHtmlInfo:Mb,_fnUpdateInfo:Wb,_fnInfoMacros:Xb,_fnInitialise:za,_fnInitComplete:Na,
_fnLengthChange:ib,_fnFeatureHtmlLength:Ib,_fnFeatureHtmlPaginate:Nb,_fnPageChange:kb,_fnFeatureHtmlProcessing:Kb,_fnProcessingDisplay:U,_fnFeatureHtmlTable:Lb,_fnScrollDraw:Ea,_fnApplyToChildren:Z,_fnCalculateColumnWidths:Xa,_fnThrottle:fb,_fnConvertToWidth:Zb,_fnGetWidestNode:$b,_fnGetMaxLenString:ac,_fnStringToCss:K,_fnSortFlatten:pa,_fnSort:Gb,_fnSortAria:cc,_fnSortListener:nb,_fnSortAttachListener:db,_fnSortingClasses:Pa,_fnSortData:bc,_fnSaveState:Qa,_fnLoadState:dc,_fnSettingsFromNode:Ra,_fnLog:aa,
_fnMap:V,_fnBindAction:ob,_fnCallbackReg:Q,_fnCallbackFire:I,_fnLengthOverflow:jb,_fnRenderer:eb,_fnDataSource:P,_fnRowAttributes:cb,_fnExtend:pb,_fnCalculateEnd:function(){}});k.fn.dataTable=u;u.$=k;k.fn.dataTableSettings=u.settings;k.fn.dataTableExt=u.ext;k.fn.DataTable=function(a){return k(this).dataTable(a).api()};k.each(u,function(a,b){k.fn.DataTable[a]=b});return k.fn.dataTable});


/*!
 DataTables Bootstrap 4 integration
 ©2011-2017 SpryMedia Ltd - datatables.net/license
*/
var $jscomp=$jscomp||{};$jscomp.scope={};$jscomp.findInternal=function(a,b,c){a instanceof String&&(a=String(a));for(var e=a.length,d=0;d<e;d++){var f=a[d];if(b.call(c,f,d,a))return{i:d,v:f}}return{i:-1,v:void 0}};$jscomp.ASSUME_ES5=!1;$jscomp.ASSUME_NO_NATIVE_MAP=!1;$jscomp.ASSUME_NO_NATIVE_SET=!1;$jscomp.SIMPLE_FROUND_POLYFILL=!1;$jscomp.ISOLATE_POLYFILLS=!1;
$jscomp.defineProperty=$jscomp.ASSUME_ES5||"function"==typeof Object.defineProperties?Object.defineProperty:function(a,b,c){if(a==Array.prototype||a==Object.prototype)return a;a[b]=c.value;return a};$jscomp.getGlobal=function(a){a=["object"==typeof globalThis&&globalThis,a,"object"==typeof window&&window,"object"==typeof self&&self,"object"==typeof global&&global];for(var b=0;b<a.length;++b){var c=a[b];if(c&&c.Math==Math)return c}throw Error("Cannot find global object");};$jscomp.global=$jscomp.getGlobal(this);
$jscomp.IS_SYMBOL_NATIVE="function"===typeof Symbol&&"symbol"===typeof Symbol("x");$jscomp.TRUST_ES6_POLYFILLS=!$jscomp.ISOLATE_POLYFILLS||$jscomp.IS_SYMBOL_NATIVE;$jscomp.polyfills={};$jscomp.propertyToPolyfillSymbol={};$jscomp.POLYFILL_PREFIX="$jscp$";var $jscomp$lookupPolyfilledValue=function(a,b){var c=$jscomp.propertyToPolyfillSymbol[b];if(null==c)return a[b];c=a[c];return void 0!==c?c:a[b]};
$jscomp.polyfill=function(a,b,c,e){b&&($jscomp.ISOLATE_POLYFILLS?$jscomp.polyfillIsolated(a,b,c,e):$jscomp.polyfillUnisolated(a,b,c,e))};$jscomp.polyfillUnisolated=function(a,b,c,e){c=$jscomp.global;a=a.split(".");for(e=0;e<a.length-1;e++){var d=a[e];if(!(d in c))return;c=c[d]}a=a[a.length-1];e=c[a];b=b(e);b!=e&&null!=b&&$jscomp.defineProperty(c,a,{configurable:!0,writable:!0,value:b})};
$jscomp.polyfillIsolated=function(a,b,c,e){var d=a.split(".");a=1===d.length;e=d[0];e=!a&&e in $jscomp.polyfills?$jscomp.polyfills:$jscomp.global;for(var f=0;f<d.length-1;f++){var l=d[f];if(!(l in e))return;e=e[l]}d=d[d.length-1];c=$jscomp.IS_SYMBOL_NATIVE&&"es6"===c?e[d]:null;b=b(c);null!=b&&(a?$jscomp.defineProperty($jscomp.polyfills,d,{configurable:!0,writable:!0,value:b}):b!==c&&($jscomp.propertyToPolyfillSymbol[d]=$jscomp.IS_SYMBOL_NATIVE?$jscomp.global.Symbol(d):$jscomp.POLYFILL_PREFIX+d,d=
$jscomp.propertyToPolyfillSymbol[d],$jscomp.defineProperty(e,d,{configurable:!0,writable:!0,value:b})))};$jscomp.polyfill("Array.prototype.find",function(a){return a?a:function(b,c){return $jscomp.findInternal(this,b,c).v}},"es6","es3");
(function(a){"function"===typeof define&&define.amd?define(["jquery","datatables.net"],function(b){return a(b,window,document)}):"object"===typeof exports?module.exports=function(b,c){b||(b=window);c&&c.fn.dataTable||(c=require("datatables.net")(b,c).$);return a(c,b,b.document)}:a(jQuery,window,document)})(function(a,b,c,e){var d=a.fn.dataTable;a.extend(!0,d.defaults,{dom:"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
renderer:"bootstrap"});a.extend(d.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap4",sFilterInput:"form-control form-control-sm",sLengthSelect:"custom-select custom-select-sm form-control form-control-sm",sProcessing:"dataTables_processing card",sPageButton:"paginate_button page-item"});d.ext.renderer.pageButton.bootstrap=function(f,l,A,B,m,t){var u=new d.Api(f),C=f.oClasses,n=f.oLanguage.oPaginate,D=f.oLanguage.oAria.paginate||{},h,k,v=0,y=function(q,w){var x,E=function(p){p.preventDefault();
a(p.currentTarget).hasClass("disabled")||u.page()==p.data.action||u.page(p.data.action).draw("page")};var r=0;for(x=w.length;r<x;r++){var g=w[r];if(Array.isArray(g))y(q,g);else{k=h="";switch(g){case "ellipsis":h="&#x2026;";k="disabled";break;case "first":h=n.sFirst;k=g+(0<m?"":" disabled");break;case "previous":h=n.sPrevious;k=g+(0<m?"":" disabled");break;case "next":h=n.sNext;k=g+(m<t-1?"":" disabled");break;case "last":h=n.sLast;k=g+(m<t-1?"":" disabled");break;default:h=g+1,k=m===g?"active":""}if(h){var F=
a("<li>",{"class":C.sPageButton+" "+k,id:0===A&&"string"===typeof g?f.sTableId+"_"+g:null}).append(a("<a>",{href:"#","aria-controls":f.sTableId,"aria-label":D[g],"data-dt-idx":v,tabindex:f.iTabIndex,"class":"page-link"}).html(h)).appendTo(q);f.oApi._fnBindAction(F,{action:g},E);v++}}}};try{var z=a(l).find(c.activeElement).data("dt-idx")}catch(q){}y(a(l).empty().html('<ul class="pagination"/>').children("ul"),B);z!==e&&a(l).find("[data-dt-idx="+z+"]").trigger("focus")};return d});


/*!
 Buttons for DataTables 1.6.5
 ©2016-2020 SpryMedia Ltd - datatables.net/license
*/
(function(e){"function"===typeof define&&define.amd?define(["jquery","datatables.net"],function(A){return e(A,window,document)}):"object"===typeof exports?module.exports=function(A,z){A||(A=window);z&&z.fn.dataTable||(z=require("datatables.net")(A,z).$);return e(z,A,A.document)}:e(jQuery,window,document)})(function(e,A,z,u){function E(a,b,c){e.fn.animate?a.stop().fadeIn(b,c):(a.css("display","block"),c&&c.call(a))}function F(a,b,c){e.fn.animate?a.stop().fadeOut(b,c):(a.css("display","none"),c&&c.call(a))}
function H(a,b){a=new t.Api(a);b=b?b:a.init().buttons||t.defaults.buttons;return(new w(a,b)).container()}var t=e.fn.dataTable,M=0,N=0,x=t.ext.buttons,w=function(a,b){if(!(this instanceof w))return function(c){return(new w(c,a)).container()};"undefined"===typeof b&&(b={});!0===b&&(b={});Array.isArray(b)&&(b={buttons:b});this.c=e.extend(!0,{},w.defaults,b);b.buttons&&(this.c.buttons=b.buttons);this.s={dt:new t.Api(a),buttons:[],listenKeys:"",namespace:"dtb"+M++};this.dom={container:e("<"+this.c.dom.container.tag+
"/>").addClass(this.c.dom.container.className)};this._constructor()};e.extend(w.prototype,{action:function(a,b){a=this._nodeToButton(a);if(b===u)return a.conf.action;a.conf.action=b;return this},active:function(a,b){var c=this._nodeToButton(a);a=this.c.dom.button.active;c=e(c.node);if(b===u)return c.hasClass(a);c.toggleClass(a,b===u?!0:b);return this},add:function(a,b){var c=this.s.buttons;if("string"===typeof b){b=b.split("-");var d=this.s;c=0;for(var h=b.length-1;c<h;c++)d=d.buttons[1*b[c]];c=d.buttons;
b=1*b[b.length-1]}this._expandButton(c,a,d!==u,b);this._draw();return this},container:function(){return this.dom.container},disable:function(a){a=this._nodeToButton(a);e(a.node).addClass(this.c.dom.button.disabled).attr("disabled",!0);return this},destroy:function(){e("body").off("keyup."+this.s.namespace);var a=this.s.buttons.slice(),b;var c=0;for(b=a.length;c<b;c++)this.remove(a[c].node);this.dom.container.remove();a=this.s.dt.settings()[0];c=0;for(b=a.length;c<b;c++)if(a.inst===this){a.splice(c,
1);break}return this},enable:function(a,b){if(!1===b)return this.disable(a);a=this._nodeToButton(a);e(a.node).removeClass(this.c.dom.button.disabled).removeAttr("disabled");return this},name:function(){return this.c.name},node:function(a){if(!a)return this.dom.container;a=this._nodeToButton(a);return e(a.node)},processing:function(a,b){var c=this.s.dt,d=this._nodeToButton(a);if(b===u)return e(d.node).hasClass("processing");e(d.node).toggleClass("processing",b);e(c.table().node()).triggerHandler("buttons-processing.dt",
[b,c.button(a),c,e(a),d.conf]);return this},remove:function(a){var b=this._nodeToButton(a),c=this._nodeToHost(a),d=this.s.dt;if(b.buttons.length)for(var h=b.buttons.length-1;0<=h;h--)this.remove(b.buttons[h].node);b.conf.destroy&&b.conf.destroy.call(d.button(a),d,e(a),b.conf);this._removeKey(b.conf);e(b.node).remove();a=e.inArray(b,c);c.splice(a,1);return this},text:function(a,b){var c=this._nodeToButton(a);a=this.c.dom.collection.buttonLiner;a=c.inCollection&&a&&a.tag?a.tag:this.c.dom.buttonLiner.tag;
var d=this.s.dt,h=e(c.node),f=function(k){return"function"===typeof k?k(d,h,c.conf):k};if(b===u)return f(c.conf.text);c.conf.text=b;a?h.children(a).html(f(b)):h.html(f(b));return this},_constructor:function(){var a=this,b=this.s.dt,c=b.settings()[0],d=this.c.buttons;c._buttons||(c._buttons=[]);c._buttons.push({inst:this,name:this.c.name});for(var h=0,f=d.length;h<f;h++)this.add(d[h]);b.on("destroy",function(k,g){g===c&&a.destroy()});e("body").on("keyup."+this.s.namespace,function(k){if(!z.activeElement||
z.activeElement===z.body){var g=String.fromCharCode(k.keyCode).toLowerCase();-1!==a.s.listenKeys.toLowerCase().indexOf(g)&&a._keypress(g,k)}})},_addKey:function(a){a.key&&(this.s.listenKeys+=e.isPlainObject(a.key)?a.key.key:a.key)},_draw:function(a,b){a||(a=this.dom.container,b=this.s.buttons);a.children().detach();for(var c=0,d=b.length;c<d;c++)a.append(b[c].inserter),a.append(" "),b[c].buttons&&b[c].buttons.length&&this._draw(b[c].collection,b[c].buttons)},_expandButton:function(a,b,c,d){var h=
this.s.dt,f=0;b=Array.isArray(b)?b:[b];for(var k=0,g=b.length;k<g;k++){var m=this._resolveExtends(b[k]);if(m)if(Array.isArray(m))this._expandButton(a,m,c,d);else{var l=this._buildButton(m,c);l&&(d!==u&&null!==d?(a.splice(d,0,l),d++):a.push(l),l.conf.buttons&&(l.collection=e("<"+this.c.dom.collection.tag+"/>"),l.conf._collection=l.collection,this._expandButton(l.buttons,l.conf.buttons,!0,d)),m.init&&m.init.call(h.button(l.node),h,e(l.node),m),f++)}}},_buildButton:function(a,b){var c=this.c.dom.button,
d=this.c.dom.buttonLiner,h=this.c.dom.collection,f=this.s.dt,k=function(n){return"function"===typeof n?n(f,l,a):n};b&&h.button&&(c=h.button);b&&h.buttonLiner&&(d=h.buttonLiner);if(a.available&&!a.available(f,a))return!1;var g=function(n,p,v,y){y.action.call(p.button(v),n,p,v,y);e(p.table().node()).triggerHandler("buttons-action.dt",[p.button(v),p,v,y])};h=a.tag||c.tag;var m=a.clickBlurs===u?!0:a.clickBlurs,l=e("<"+h+"/>").addClass(c.className).attr("tabindex",this.s.dt.settings()[0].iTabIndex).attr("aria-controls",
this.s.dt.table().node().id).on("click.dtb",function(n){n.preventDefault();!l.hasClass(c.disabled)&&a.action&&g(n,f,l,a);m&&l.trigger("blur")}).on("keyup.dtb",function(n){13===n.keyCode&&!l.hasClass(c.disabled)&&a.action&&g(n,f,l,a)});"a"===h.toLowerCase()&&l.attr("href","#");"button"===h.toLowerCase()&&l.attr("type","button");d.tag?(h=e("<"+d.tag+"/>").html(k(a.text)).addClass(d.className),"a"===d.tag.toLowerCase()&&h.attr("href","#"),l.append(h)):l.html(k(a.text));!1===a.enabled&&l.addClass(c.disabled);
a.className&&l.addClass(a.className);a.titleAttr&&l.attr("title",k(a.titleAttr));a.attr&&l.attr(a.attr);a.namespace||(a.namespace=".dt-button-"+N++);d=(d=this.c.dom.buttonContainer)&&d.tag?e("<"+d.tag+"/>").addClass(d.className).append(l):l;this._addKey(a);this.c.buttonCreated&&(d=this.c.buttonCreated(a,d));return{conf:a,node:l.get(0),inserter:d,buttons:[],inCollection:b,collection:null}},_nodeToButton:function(a,b){b||(b=this.s.buttons);for(var c=0,d=b.length;c<d;c++){if(b[c].node===a)return b[c];
if(b[c].buttons.length){var h=this._nodeToButton(a,b[c].buttons);if(h)return h}}},_nodeToHost:function(a,b){b||(b=this.s.buttons);for(var c=0,d=b.length;c<d;c++){if(b[c].node===a)return b;if(b[c].buttons.length){var h=this._nodeToHost(a,b[c].buttons);if(h)return h}}},_keypress:function(a,b){if(!b._buttonsHandled){var c=function(d){for(var h=0,f=d.length;h<f;h++){var k=d[h].conf,g=d[h].node;k.key&&(k.key===a?(b._buttonsHandled=!0,e(g).click()):!e.isPlainObject(k.key)||k.key.key!==a||k.key.shiftKey&&
!b.shiftKey||k.key.altKey&&!b.altKey||k.key.ctrlKey&&!b.ctrlKey||k.key.metaKey&&!b.metaKey||(b._buttonsHandled=!0,e(g).click()));d[h].buttons.length&&c(d[h].buttons)}};c(this.s.buttons)}},_removeKey:function(a){if(a.key){var b=e.isPlainObject(a.key)?a.key.key:a.key;a=this.s.listenKeys.split("");b=e.inArray(b,a);a.splice(b,1);this.s.listenKeys=a.join("")}},_resolveExtends:function(a){var b=this.s.dt,c,d=function(g){for(var m=0;!e.isPlainObject(g)&&!Array.isArray(g);){if(g===u)return;if("function"===
typeof g){if(g=g(b,a),!g)return!1}else if("string"===typeof g){if(!x[g])throw"Unknown button type: "+g;g=x[g]}m++;if(30<m)throw"Buttons: Too many iterations";}return Array.isArray(g)?g:e.extend({},g)};for(a=d(a);a&&a.extend;){if(!x[a.extend])throw"Cannot extend unknown button type: "+a.extend;var h=d(x[a.extend]);if(Array.isArray(h))return h;if(!h)return!1;var f=h.className;a=e.extend({},h,a);f&&a.className!==f&&(a.className=f+" "+a.className);var k=a.postfixButtons;if(k){a.buttons||(a.buttons=[]);
f=0;for(c=k.length;f<c;f++)a.buttons.push(k[f]);a.postfixButtons=null}if(k=a.prefixButtons){a.buttons||(a.buttons=[]);f=0;for(c=k.length;f<c;f++)a.buttons.splice(f,0,k[f]);a.prefixButtons=null}a.extend=h.extend}return a},_popover:function(a,b,c){var d=this.c,h=e.extend({align:"button-left",autoClose:!1,background:!0,backgroundClassName:"dt-button-background",contentClassName:d.dom.collection.className,collectionLayout:"",collectionTitle:"",dropup:!1,fade:400,rightAlignClassName:"dt-button-right",
tag:d.dom.collection.tag},c),f=b.node(),k=function(){F(e(".dt-button-collection"),h.fade,function(){e(this).detach()});e(b.buttons('[aria-haspopup="true"][aria-expanded="true"]').nodes()).attr("aria-expanded","false");e("div.dt-button-background").off("click.dtb-collection");w.background(!1,h.backgroundClassName,h.fade,f);e("body").off(".dtb-collection");b.off("buttons-action.b-internal")};!1===a&&k();c=e(b.buttons('[aria-haspopup="true"][aria-expanded="true"]').nodes());c.length&&(f=c.eq(0),k());
c=e("<div/>").addClass("dt-button-collection").addClass(h.collectionLayout).css("display","none");a=e(a).addClass(h.contentClassName).attr("role","menu").appendTo(c);f.attr("aria-expanded","true");f.parents("body")[0]!==z.body&&(f=z.body.lastChild);h.collectionTitle&&c.prepend('<div class="dt-button-collection-title">'+h.collectionTitle+"</div>");E(c.insertAfter(f),h.fade);d=e(b.table().container());var g=c.css("position");"dt-container"===h.align&&(f=f.parent(),c.css("width",d.width()));if("absolute"===
g&&(c.hasClass(h.rightAlignClassName)||c.hasClass(h.leftAlignClassName)||"dt-container"===h.align)){var m=f.position();c.css({top:m.top+f.outerHeight(),left:m.left});var l=c.outerHeight(),n=d.offset().top+d.height(),p=m.top+f.outerHeight()+l;n=p-n;p=m.top-l;var v=d.offset().top,y=m.top-l-5;(n>v-p||h.dropup)&&-y<v&&c.css("top",y);m=d.offset().left;d=d.width();d=m+d;g=c.offset().left;var q=c.width();q=g+q;var r=f.offset().left,B=f.outerWidth();B=r+B;r=0;c.hasClass(h.rightAlignClassName)?(r=B-q,m>g+
r&&(g=m-(g+r),d-=q+r,r=g>d?r+d:r+g)):(r=m-g,d<q+r&&(g=m-(g+r),d-=q+r,r=g>d?r+d:r+g));c.css("left",c.position().left+r)}else"absolute"===g?(m=f.position(),c.css({top:m.top+f.outerHeight(),left:m.left}),l=c.outerHeight(),g=f.offset().top,r=0,r=f.offset().left,B=f.outerWidth(),B=r+B,g=c.offset().left,q=a.width(),q=g+q,y=m.top-l-5,n=d.offset().top+d.height(),p=m.top+f.outerHeight()+l,n=p-n,p=m.top-l,v=d.offset().top,(n>v-p||h.dropup)&&-y<v&&c.css("top",y),r="button-right"===h.align?B-q:r-g,c.css("left",
c.position().left+r)):(g=c.height()/2,g>e(A).height()/2&&(g=e(A).height()/2),c.css("marginTop",-1*g));h.background&&w.background(!0,h.backgroundClassName,h.fade,f);e("div.dt-button-background").on("click.dtb-collection",function(){});e("body").on("click.dtb-collection",function(C){var I=e.fn.addBack?"addBack":"andSelf",J=e(C.target).parent()[0];(!e(C.target).parents()[I]().filter(a).length&&!e(J).hasClass("dt-buttons")||e(C.target).hasClass("dt-button-background"))&&k()}).on("keyup.dtb-collection",
function(C){27===C.keyCode&&k()});h.autoClose&&setTimeout(function(){b.on("buttons-action.b-internal",function(C,I,J,O){O[0]!==f[0]&&k()})},0);e(c).trigger("buttons-popover.dt")}});w.background=function(a,b,c,d){c===u&&(c=400);d||(d=z.body);a?E(e("<div/>").addClass(b).css("display","none").insertAfter(d),c):F(e("div."+b),c,function(){e(this).removeClass(b).remove()})};w.instanceSelector=function(a,b){if(a===u||null===a)return e.map(b,function(f){return f.inst});var c=[],d=e.map(b,function(f){return f.name}),
h=function(f){if(Array.isArray(f))for(var k=0,g=f.length;k<g;k++)h(f[k]);else"string"===typeof f?-1!==f.indexOf(",")?h(f.split(",")):(f=e.inArray(f.trim(),d),-1!==f&&c.push(b[f].inst)):"number"===typeof f&&c.push(b[f].inst)};h(a);return c};w.buttonSelector=function(a,b){for(var c=[],d=function(g,m,l){for(var n,p,v=0,y=m.length;v<y;v++)if(n=m[v])p=l!==u?l+v:v+"",g.push({node:n.node,name:n.conf.name,idx:p}),n.buttons&&d(g,n.buttons,p+"-")},h=function(g,m){var l,n=[];d(n,m.s.buttons);var p=e.map(n,function(v){return v.node});
if(Array.isArray(g)||g instanceof e)for(p=0,l=g.length;p<l;p++)h(g[p],m);else if(null===g||g===u||"*"===g)for(p=0,l=n.length;p<l;p++)c.push({inst:m,node:n[p].node});else if("number"===typeof g)c.push({inst:m,node:m.s.buttons[g].node});else if("string"===typeof g)if(-1!==g.indexOf(","))for(n=g.split(","),p=0,l=n.length;p<l;p++)h(n[p].trim(),m);else if(g.match(/^\d+(\-\d+)*$/))p=e.map(n,function(v){return v.idx}),c.push({inst:m,node:n[e.inArray(g,p)].node});else if(-1!==g.indexOf(":name"))for(g=g.replace(":name",
""),p=0,l=n.length;p<l;p++)n[p].name===g&&c.push({inst:m,node:n[p].node});else e(p).filter(g).each(function(){c.push({inst:m,node:this})});else"object"===typeof g&&g.nodeName&&(n=e.inArray(g,p),-1!==n&&c.push({inst:m,node:p[n]}))},f=0,k=a.length;f<k;f++)h(b,a[f]);return c};w.defaults={buttons:["copy","excel","csv","pdf","print"],name:"main",tabIndex:0,dom:{container:{tag:"div",className:"dt-buttons"},collection:{tag:"div",className:""},button:{tag:"ActiveXObject"in A?"a":"button",className:"dt-button",
active:"active",disabled:"disabled"},buttonLiner:{tag:"span",className:""}}};w.version="1.6.5";e.extend(x,{collection:{text:function(a){return a.i18n("buttons.collection","Collection")},className:"buttons-collection",init:function(a,b,c){b.attr("aria-expanded",!1)},action:function(a,b,c,d){a.stopPropagation();d._collection.parents("body").length?this.popover(!1,d):this.popover(d._collection,d)},attr:{"aria-haspopup":!0}},copy:function(a,b){if(x.copyHtml5)return"copyHtml5";if(x.copyFlash&&x.copyFlash.available(a,
b))return"copyFlash"},csv:function(a,b){if(x.csvHtml5&&x.csvHtml5.available(a,b))return"csvHtml5";if(x.csvFlash&&x.csvFlash.available(a,b))return"csvFlash"},excel:function(a,b){if(x.excelHtml5&&x.excelHtml5.available(a,b))return"excelHtml5";if(x.excelFlash&&x.excelFlash.available(a,b))return"excelFlash"},pdf:function(a,b){if(x.pdfHtml5&&x.pdfHtml5.available(a,b))return"pdfHtml5";if(x.pdfFlash&&x.pdfFlash.available(a,b))return"pdfFlash"},pageLength:function(a){a=a.settings()[0].aLengthMenu;var b=Array.isArray(a[0])?
a[0]:a,c=Array.isArray(a[0])?a[1]:a;return{extend:"collection",text:function(d){return d.i18n("buttons.pageLength",{"-1":"Show all rows",_:"Show %d rows"},d.page.len())},className:"buttons-page-length",autoClose:!0,buttons:e.map(b,function(d,h){return{text:c[h],className:"button-page-length",action:function(f,k){k.page.len(d).draw()},init:function(f,k,g){var m=this;k=function(){m.active(f.page.len()===d)};f.on("length.dt"+g.namespace,k);k()},destroy:function(f,k,g){f.off("length.dt"+g.namespace)}}}),
init:function(d,h,f){var k=this;d.on("length.dt"+f.namespace,function(){k.text(f.text)})},destroy:function(d,h,f){d.off("length.dt"+f.namespace)}}}});t.Api.register("buttons()",function(a,b){b===u&&(b=a,a=u);this.selector.buttonGroup=a;var c=this.iterator(!0,"table",function(d){if(d._buttons)return w.buttonSelector(w.instanceSelector(a,d._buttons),b)},!0);c._groupSelector=a;return c});t.Api.register("button()",function(a,b){a=this.buttons(a,b);1<a.length&&a.splice(1,a.length);return a});t.Api.registerPlural("buttons().active()",
"button().active()",function(a){return a===u?this.map(function(b){return b.inst.active(b.node)}):this.each(function(b){b.inst.active(b.node,a)})});t.Api.registerPlural("buttons().action()","button().action()",function(a){return a===u?this.map(function(b){return b.inst.action(b.node)}):this.each(function(b){b.inst.action(b.node,a)})});t.Api.register(["buttons().enable()","button().enable()"],function(a){return this.each(function(b){b.inst.enable(b.node,a)})});t.Api.register(["buttons().disable()",
"button().disable()"],function(){return this.each(function(a){a.inst.disable(a.node)})});t.Api.registerPlural("buttons().nodes()","button().node()",function(){var a=e();e(this.each(function(b){a=a.add(b.inst.node(b.node))}));return a});t.Api.registerPlural("buttons().processing()","button().processing()",function(a){return a===u?this.map(function(b){return b.inst.processing(b.node)}):this.each(function(b){b.inst.processing(b.node,a)})});t.Api.registerPlural("buttons().text()","button().text()",function(a){return a===
u?this.map(function(b){return b.inst.text(b.node)}):this.each(function(b){b.inst.text(b.node,a)})});t.Api.registerPlural("buttons().trigger()","button().trigger()",function(){return this.each(function(a){a.inst.node(a.node).trigger("click")})});t.Api.register("button().popover()",function(a,b){return this.map(function(c){return c.inst._popover(a,this.button(this[0].node),b)})});t.Api.register("buttons().containers()",function(){var a=e(),b=this._groupSelector;this.iterator(!0,"table",function(c){if(c._buttons){c=
w.instanceSelector(b,c._buttons);for(var d=0,h=c.length;d<h;d++)a=a.add(c[d].container())}});return a});t.Api.register("buttons().container()",function(){return this.containers().eq(0)});t.Api.register("button().add()",function(a,b){var c=this.context;c.length&&(c=w.instanceSelector(this._groupSelector,c[0]._buttons),c.length&&c[0].add(b,a));return this.button(this._groupSelector,a)});t.Api.register("buttons().destroy()",function(){this.pluck("inst").unique().each(function(a){a.destroy()});return this});
t.Api.registerPlural("buttons().remove()","buttons().remove()",function(){this.each(function(a){a.inst.remove(a.node)});return this});var D;t.Api.register("buttons.info()",function(a,b,c){var d=this;if(!1===a)return this.off("destroy.btn-info"),F(e("#datatables_buttons_info"),400,function(){e(this).remove()}),clearTimeout(D),D=null,this;D&&clearTimeout(D);e("#datatables_buttons_info").length&&e("#datatables_buttons_info").remove();a=a?"<h2>"+a+"</h2>":"";E(e('<div id="datatables_buttons_info" class="dt-button-info"/>').html(a).append(e("<div/>")["string"===
typeof b?"html":"append"](b)).css("display","none").appendTo("body"));c!==u&&0!==c&&(D=setTimeout(function(){d.buttons.info(!1)},c));this.on("destroy.btn-info",function(){d.buttons.info(!1)});return this});t.Api.register("buttons.exportData()",function(a){if(this.context.length)return P(new t.Api(this.context[0]),a)});t.Api.register("buttons.exportInfo()",function(a){a||(a={});var b=a;var c="*"===b.filename&&"*"!==b.title&&b.title!==u&&null!==b.title&&""!==b.title?b.title:b.filename;"function"===
typeof c&&(c=c());c===u||null===c?c=null:(-1!==c.indexOf("*")&&(c=c.replace("*",e("head > title").text()).trim()),c=c.replace(/[^a-zA-Z0-9_\u00A1-\uFFFF\.,\-_ !\(\)]/g,""),(b=G(b.extension))||(b=""),c+=b);b=G(a.title);b=null===b?null:-1!==b.indexOf("*")?b.replace("*",e("head > title").text()||"Exported data"):b;return{filename:c,title:b,messageTop:K(this,a.message||a.messageTop,"top"),messageBottom:K(this,a.messageBottom,"bottom")}});var G=function(a){return null===a||a===u?null:"function"===typeof a?
a():a},K=function(a,b,c){b=G(b);if(null===b)return null;a=e("caption",a.table().container()).eq(0);return"*"===b?a.css("caption-side")!==c?null:a.length?a.text():"":b},L=e("<textarea/>")[0],P=function(a,b){var c=e.extend(!0,{},{rows:null,columns:"",modifier:{search:"applied",order:"applied"},orthogonal:"display",stripHtml:!0,stripNewlines:!0,decodeEntities:!0,trim:!0,format:{header:function(q){return d(q)},footer:function(q){return d(q)},body:function(q){return d(q)}},customizeData:null},b),d=function(q){if("string"!==
typeof q)return q;q=q.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,"");q=q.replace(/<!\-\-.*?\-\->/g,"");c.stripHtml&&(q=q.replace(/<([^>'"]*('[^']*'|"[^"]*")?)*>/g,""));c.trim&&(q=q.replace(/^\s+|\s+$/g,""));c.stripNewlines&&(q=q.replace(/\n/g," "));c.decodeEntities&&(L.innerHTML=q,q=L.value);return q};b=a.columns(c.columns).indexes().map(function(q){var r=a.column(q).header();return c.format.header(r.innerHTML,q,r)}).toArray();var h=a.table().footer()?a.columns(c.columns).indexes().map(function(q){var r=
a.column(q).footer();return c.format.footer(r?r.innerHTML:"",q,r)}).toArray():null,f=e.extend({},c.modifier);a.select&&"function"===typeof a.select.info&&f.selected===u&&a.rows(c.rows,e.extend({selected:!0},f)).any()&&e.extend(f,{selected:!0});f=a.rows(c.rows,f).indexes().toArray();var k=a.cells(f,c.columns);f=k.render(c.orthogonal).toArray();k=k.nodes().toArray();for(var g=b.length,m=[],l=0,n=0,p=0<g?f.length/g:0;n<p;n++){for(var v=[g],y=0;y<g;y++)v[y]=c.format.body(f[l],n,y,k[l]),l++;m[n]=v}b={header:b,
footer:h,body:m};c.customizeData&&c.customizeData(b);return b};e.fn.dataTable.Buttons=w;e.fn.DataTable.Buttons=w;e(z).on("init.dt plugin-init.dt",function(a,b){"dt"===a.namespace&&(a=b.oInit.buttons||t.defaults.buttons)&&!b._buttons&&(new w(b,a)).container()});t.ext.feature.push({fnInit:H,cFeature:"B"});t.ext.features&&t.ext.features.register("buttons",H);return w});


/*!
 Bootstrap integration for DataTables' Buttons
 ©2016 SpryMedia Ltd - datatables.net/license
*/
(function(c){"function"===typeof define&&define.amd?define(["jquery","datatables.net-bs4","datatables.net-buttons"],function(a){return c(a,window,document)}):"object"===typeof exports?module.exports=function(a,b){a||(a=window);b&&b.fn.dataTable||(b=require("datatables.net-bs4")(a,b).$);b.fn.dataTable.Buttons||require("datatables.net-buttons")(a,b);return c(b,a,a.document)}:c(jQuery,window,document)})(function(c,a,b,f){a=c.fn.dataTable;c.extend(!0,a.Buttons.defaults,{dom:{container:{className:"dt-buttons btn-group flex-wrap"},
button:{className:"btn btn-secondary"},collection:{tag:"div",className:"dropdown-menu",button:{tag:"a",className:"dt-button dropdown-item",active:"active",disabled:"disabled"}}},buttonCreated:function(e,d){return e.buttons?c('<div class="btn-group"/>').append(d):d}});a.ext.buttons.collection.className+=" dropdown-toggle";a.ext.buttons.collection.rightAlignClassName="dropdown-menu-right";return a.Buttons});


/*!
   Copyright 2014-2021 SpryMedia Ltd.

 This source file is free software, available under the following license:
   MIT license - http://datatables.net/license/mit

 This source file is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.

 For details please refer to: http://www.datatables.net
 Responsive 2.2.7
 2014-2021 SpryMedia Ltd - datatables.net/license
*/
var $jscomp=$jscomp||{};$jscomp.scope={};$jscomp.findInternal=function(b,k,m){b instanceof String&&(b=String(b));for(var n=b.length,p=0;p<n;p++){var y=b[p];if(k.call(m,y,p,b))return{i:p,v:y}}return{i:-1,v:void 0}};$jscomp.ASSUME_ES5=!1;$jscomp.ASSUME_NO_NATIVE_MAP=!1;$jscomp.ASSUME_NO_NATIVE_SET=!1;$jscomp.SIMPLE_FROUND_POLYFILL=!1;$jscomp.ISOLATE_POLYFILLS=!1;
$jscomp.defineProperty=$jscomp.ASSUME_ES5||"function"==typeof Object.defineProperties?Object.defineProperty:function(b,k,m){if(b==Array.prototype||b==Object.prototype)return b;b[k]=m.value;return b};$jscomp.getGlobal=function(b){b=["object"==typeof globalThis&&globalThis,b,"object"==typeof window&&window,"object"==typeof self&&self,"object"==typeof global&&global];for(var k=0;k<b.length;++k){var m=b[k];if(m&&m.Math==Math)return m}throw Error("Cannot find global object");};$jscomp.global=$jscomp.getGlobal(this);
$jscomp.IS_SYMBOL_NATIVE="function"===typeof Symbol&&"symbol"===typeof Symbol("x");$jscomp.TRUST_ES6_POLYFILLS=!$jscomp.ISOLATE_POLYFILLS||$jscomp.IS_SYMBOL_NATIVE;$jscomp.polyfills={};$jscomp.propertyToPolyfillSymbol={};$jscomp.POLYFILL_PREFIX="$jscp$";var $jscomp$lookupPolyfilledValue=function(b,k){var m=$jscomp.propertyToPolyfillSymbol[k];if(null==m)return b[k];m=b[m];return void 0!==m?m:b[k]};
$jscomp.polyfill=function(b,k,m,n){k&&($jscomp.ISOLATE_POLYFILLS?$jscomp.polyfillIsolated(b,k,m,n):$jscomp.polyfillUnisolated(b,k,m,n))};$jscomp.polyfillUnisolated=function(b,k,m,n){m=$jscomp.global;b=b.split(".");for(n=0;n<b.length-1;n++){var p=b[n];if(!(p in m))return;m=m[p]}b=b[b.length-1];n=m[b];k=k(n);k!=n&&null!=k&&$jscomp.defineProperty(m,b,{configurable:!0,writable:!0,value:k})};
$jscomp.polyfillIsolated=function(b,k,m,n){var p=b.split(".");b=1===p.length;n=p[0];n=!b&&n in $jscomp.polyfills?$jscomp.polyfills:$jscomp.global;for(var y=0;y<p.length-1;y++){var z=p[y];if(!(z in n))return;n=n[z]}p=p[p.length-1];m=$jscomp.IS_SYMBOL_NATIVE&&"es6"===m?n[p]:null;k=k(m);null!=k&&(b?$jscomp.defineProperty($jscomp.polyfills,p,{configurable:!0,writable:!0,value:k}):k!==m&&($jscomp.propertyToPolyfillSymbol[p]=$jscomp.IS_SYMBOL_NATIVE?$jscomp.global.Symbol(p):$jscomp.POLYFILL_PREFIX+p,p=
$jscomp.propertyToPolyfillSymbol[p],$jscomp.defineProperty(n,p,{configurable:!0,writable:!0,value:k})))};$jscomp.polyfill("Array.prototype.find",function(b){return b?b:function(k,m){return $jscomp.findInternal(this,k,m).v}},"es6","es3");
(function(b){"function"===typeof define&&define.amd?define(["jquery","datatables.net"],function(k){return b(k,window,document)}):"object"===typeof exports?module.exports=function(k,m){k||(k=window);m&&m.fn.dataTable||(m=require("datatables.net")(k,m).$);return b(m,k,k.document)}:b(jQuery,window,document)})(function(b,k,m,n){function p(a,c,d){var f=c+"-"+d;if(A[f])return A[f];var g=[];a=a.cell(c,d).node().childNodes;c=0;for(d=a.length;c<d;c++)g.push(a[c]);return A[f]=g}function y(a,c,d){var f=c+"-"+
d;if(A[f]){a=a.cell(c,d).node();d=A[f][0].parentNode.childNodes;c=[];for(var g=0,l=d.length;g<l;g++)c.push(d[g]);d=0;for(g=c.length;d<g;d++)a.appendChild(c[d]);A[f]=n}}var z=b.fn.dataTable,u=function(a,c){if(!z.versionCheck||!z.versionCheck("1.10.10"))throw"DataTables Responsive requires DataTables 1.10.10 or newer";this.s={dt:new z.Api(a),columns:[],current:[]};this.s.dt.settings()[0].responsive||(c&&"string"===typeof c.details?c.details={type:c.details}:c&&!1===c.details?c.details={type:!1}:c&&
!0===c.details&&(c.details={type:"inline"}),this.c=b.extend(!0,{},u.defaults,z.defaults.responsive,c),a.responsive=this,this._constructor())};b.extend(u.prototype,{_constructor:function(){var a=this,c=this.s.dt,d=c.settings()[0],f=b(k).innerWidth();c.settings()[0]._responsive=this;b(k).on("resize.dtr orientationchange.dtr",z.util.throttle(function(){var g=b(k).innerWidth();g!==f&&(a._resize(),f=g)}));d.oApi._fnCallbackReg(d,"aoRowCreatedCallback",function(g,l,h){-1!==b.inArray(!1,a.s.current)&&b(">td, >th",
g).each(function(e){e=c.column.index("toData",e);!1===a.s.current[e]&&b(this).css("display","none")})});c.on("destroy.dtr",function(){c.off(".dtr");b(c.table().body()).off(".dtr");b(k).off("resize.dtr orientationchange.dtr");c.cells(".dtr-control").nodes().to$().removeClass("dtr-control");b.each(a.s.current,function(g,l){!1===l&&a._setColumnVis(g,!0)})});this.c.breakpoints.sort(function(g,l){return g.width<l.width?1:g.width>l.width?-1:0});this._classLogic();this._resizeAuto();d=this.c.details;!1!==
d.type&&(a._detailsInit(),c.on("column-visibility.dtr",function(){a._timer&&clearTimeout(a._timer);a._timer=setTimeout(function(){a._timer=null;a._classLogic();a._resizeAuto();a._resize(!0);a._redrawChildren()},100)}),c.on("draw.dtr",function(){a._redrawChildren()}),b(c.table().node()).addClass("dtr-"+d.type));c.on("column-reorder.dtr",function(g,l,h){a._classLogic();a._resizeAuto();a._resize(!0)});c.on("column-sizing.dtr",function(){a._resizeAuto();a._resize()});c.on("preXhr.dtr",function(){var g=
[];c.rows().every(function(){this.child.isShown()&&g.push(this.id(!0))});c.one("draw.dtr",function(){a._resizeAuto();a._resize();c.rows(g).every(function(){a._detailsDisplay(this,!1)})})});c.on("draw.dtr",function(){a._controlClass()}).on("init.dtr",function(g,l,h){"dt"===g.namespace&&(a._resizeAuto(),a._resize(),b.inArray(!1,a.s.current)&&c.columns.adjust())});this._resize()},_columnsVisiblity:function(a){var c=this.s.dt,d=this.s.columns,f,g=d.map(function(t,v){return{columnIdx:v,priority:t.priority}}).sort(function(t,
v){return t.priority!==v.priority?t.priority-v.priority:t.columnIdx-v.columnIdx}),l=b.map(d,function(t,v){return!1===c.column(v).visible()?"not-visible":t.auto&&null===t.minWidth?!1:!0===t.auto?"-":-1!==b.inArray(a,t.includeIn)}),h=0;var e=0;for(f=l.length;e<f;e++)!0===l[e]&&(h+=d[e].minWidth);e=c.settings()[0].oScroll;e=e.sY||e.sX?e.iBarWidth:0;h=c.table().container().offsetWidth-e-h;e=0;for(f=l.length;e<f;e++)d[e].control&&(h-=d[e].minWidth);var r=!1;e=0;for(f=g.length;e<f;e++){var q=g[e].columnIdx;
"-"===l[q]&&!d[q].control&&d[q].minWidth&&(r||0>h-d[q].minWidth?(r=!0,l[q]=!1):l[q]=!0,h-=d[q].minWidth)}g=!1;e=0;for(f=d.length;e<f;e++)if(!d[e].control&&!d[e].never&&!1===l[e]){g=!0;break}e=0;for(f=d.length;e<f;e++)d[e].control&&(l[e]=g),"not-visible"===l[e]&&(l[e]=!1);-1===b.inArray(!0,l)&&(l[0]=!0);return l},_classLogic:function(){var a=this,c=this.c.breakpoints,d=this.s.dt,f=d.columns().eq(0).map(function(h){var e=this.column(h),r=e.header().className;h=d.settings()[0].aoColumns[h].responsivePriority;
e=e.header().getAttribute("data-priority");h===n&&(h=e===n||null===e?1E4:1*e);return{className:r,includeIn:[],auto:!1,control:!1,never:r.match(/\bnever\b/)?!0:!1,priority:h}}),g=function(h,e){h=f[h].includeIn;-1===b.inArray(e,h)&&h.push(e)},l=function(h,e,r,q){if(!r)f[h].includeIn.push(e);else if("max-"===r)for(q=a._find(e).width,e=0,r=c.length;e<r;e++)c[e].width<=q&&g(h,c[e].name);else if("min-"===r)for(q=a._find(e).width,e=0,r=c.length;e<r;e++)c[e].width>=q&&g(h,c[e].name);else if("not-"===r)for(e=
0,r=c.length;e<r;e++)-1===c[e].name.indexOf(q)&&g(h,c[e].name)};f.each(function(h,e){for(var r=h.className.split(" "),q=!1,t=0,v=r.length;t<v;t++){var B=r[t].trim();if("all"===B){q=!0;h.includeIn=b.map(c,function(w){return w.name});return}if("none"===B||h.never){q=!0;return}if("control"===B||"dtr-control"===B){q=!0;h.control=!0;return}b.each(c,function(w,D){w=D.name.split("-");var x=B.match(new RegExp("(min\\-|max\\-|not\\-)?("+w[0]+")(\\-[_a-zA-Z0-9])?"));x&&(q=!0,x[2]===w[0]&&x[3]==="-"+w[1]?l(e,
D.name,x[1],x[2]+x[3]):x[2]!==w[0]||x[3]||l(e,D.name,x[1],x[2]))})}q||(h.auto=!0)});this.s.columns=f},_controlClass:function(){if("inline"===this.c.details.type){var a=this.s.dt,c=b.inArray(!0,this.s.current);a.cells(null,function(d){return d!==c},{page:"current"}).nodes().to$().filter(".dtr-control").removeClass("dtr-control");a.cells(null,c,{page:"current"}).nodes().to$().addClass("dtr-control")}},_detailsDisplay:function(a,c){var d=this,f=this.s.dt,g=this.c.details;if(g&&!1!==g.type){var l=g.display(a,
c,function(){return g.renderer(f,a[0],d._detailsObj(a[0]))});!0!==l&&!1!==l||b(f.table().node()).triggerHandler("responsive-display.dt",[f,a,l,c])}},_detailsInit:function(){var a=this,c=this.s.dt,d=this.c.details;"inline"===d.type&&(d.target="td.dtr-control, th.dtr-control");c.on("draw.dtr",function(){a._tabIndexes()});a._tabIndexes();b(c.table().body()).on("keyup.dtr","td, th",function(g){13===g.keyCode&&b(this).data("dtr-keyboard")&&b(this).click()});var f=d.target;d="string"===typeof f?f:"td, th";
if(f!==n||null!==f)b(c.table().body()).on("click.dtr mousedown.dtr mouseup.dtr",d,function(g){if(b(c.table().node()).hasClass("collapsed")&&-1!==b.inArray(b(this).closest("tr").get(0),c.rows().nodes().toArray())){if("number"===typeof f){var l=0>f?c.columns().eq(0).length+f:f;if(c.cell(this).index().column!==l)return}l=c.row(b(this).closest("tr"));"click"===g.type?a._detailsDisplay(l,!1):"mousedown"===g.type?b(this).css("outline","none"):"mouseup"===g.type&&b(this).trigger("blur").css("outline","")}})},
_detailsObj:function(a){var c=this,d=this.s.dt;return b.map(this.s.columns,function(f,g){if(!f.never&&!f.control)return f=d.settings()[0].aoColumns[g],{className:f.sClass,columnIndex:g,data:d.cell(a,g).render(c.c.orthogonal),hidden:d.column(g).visible()&&!c.s.current[g],rowIndex:a,title:null!==f.sTitle?f.sTitle:b(d.column(g).header()).text()}})},_find:function(a){for(var c=this.c.breakpoints,d=0,f=c.length;d<f;d++)if(c[d].name===a)return c[d]},_redrawChildren:function(){var a=this,c=this.s.dt;c.rows({page:"current"}).iterator("row",
function(d,f){c.row(f);a._detailsDisplay(c.row(f),!0)})},_resize:function(a){var c=this,d=this.s.dt,f=b(k).innerWidth(),g=this.c.breakpoints,l=g[0].name,h=this.s.columns,e,r=this.s.current.slice();for(e=g.length-1;0<=e;e--)if(f<=g[e].width){l=g[e].name;break}var q=this._columnsVisiblity(l);this.s.current=q;g=!1;e=0;for(f=h.length;e<f;e++)if(!1===q[e]&&!h[e].never&&!h[e].control&&!1===!d.column(e).visible()){g=!0;break}b(d.table().node()).toggleClass("collapsed",g);var t=!1,v=0;d.columns().eq(0).each(function(B,
w){!0===q[w]&&v++;if(a||q[w]!==r[w])t=!0,c._setColumnVis(B,q[w])});t&&(this._redrawChildren(),b(d.table().node()).trigger("responsive-resize.dt",[d,this.s.current]),0===d.page.info().recordsDisplay&&b("td",d.table().body()).eq(0).attr("colspan",v));c._controlClass()},_resizeAuto:function(){var a=this.s.dt,c=this.s.columns;if(this.c.auto&&-1!==b.inArray(!0,b.map(c,function(e){return e.auto}))){b.isEmptyObject(A)||b.each(A,function(e){e=e.split("-");y(a,1*e[0],1*e[1])});a.table().node();var d=a.table().node().cloneNode(!1),
f=b(a.table().header().cloneNode(!1)).appendTo(d),g=b(a.table().body()).clone(!1,!1).empty().appendTo(d);d.style.width="auto";var l=a.columns().header().filter(function(e){return a.column(e).visible()}).to$().clone(!1).css("display","table-cell").css("width","auto").css("min-width",0);b(g).append(b(a.rows({page:"current"}).nodes()).clone(!1)).find("th, td").css("display","");if(g=a.table().footer()){g=b(g.cloneNode(!1)).appendTo(d);var h=a.columns().footer().filter(function(e){return a.column(e).visible()}).to$().clone(!1).css("display",
"table-cell");b("<tr/>").append(h).appendTo(g)}b("<tr/>").append(l).appendTo(f);"inline"===this.c.details.type&&b(d).addClass("dtr-inline collapsed");b(d).find("[name]").removeAttr("name");b(d).css("position","relative");d=b("<div/>").css({width:1,height:1,overflow:"hidden",clear:"both"}).append(d);d.insertBefore(a.table().node());l.each(function(e){e=a.column.index("fromVisible",e);c[e].minWidth=this.offsetWidth||0});d.remove()}},_responsiveOnlyHidden:function(){var a=this.s.dt;return b.map(this.s.current,
function(c,d){return!1===a.column(d).visible()?!0:c})},_setColumnVis:function(a,c){var d=this.s.dt;c=c?"":"none";b(d.column(a).header()).css("display",c);b(d.column(a).footer()).css("display",c);d.column(a).nodes().to$().css("display",c);b.isEmptyObject(A)||d.cells(null,a).indexes().each(function(f){y(d,f.row,f.column)})},_tabIndexes:function(){var a=this.s.dt,c=a.cells({page:"current"}).nodes().to$(),d=a.settings()[0],f=this.c.details.target;c.filter("[data-dtr-keyboard]").removeData("[data-dtr-keyboard]");
"number"===typeof f?a.cells(null,f,{page:"current"}).nodes().to$().attr("tabIndex",d.iTabIndex).data("dtr-keyboard",1):("td:first-child, th:first-child"===f&&(f=">td:first-child, >th:first-child"),b(f,a.rows({page:"current"}).nodes()).attr("tabIndex",d.iTabIndex).data("dtr-keyboard",1))}});u.breakpoints=[{name:"desktop",width:Infinity},{name:"tablet-l",width:1024},{name:"tablet-p",width:768},{name:"mobile-l",width:480},{name:"mobile-p",width:320}];u.display={childRow:function(a,c,d){if(c){if(b(a.node()).hasClass("parent"))return a.child(d(),
"child").show(),!0}else{if(a.child.isShown())return a.child(!1),b(a.node()).removeClass("parent"),!1;a.child(d(),"child").show();b(a.node()).addClass("parent");return!0}},childRowImmediate:function(a,c,d){if(!c&&a.child.isShown()||!a.responsive.hasHidden())return a.child(!1),b(a.node()).removeClass("parent"),!1;a.child(d(),"child").show();b(a.node()).addClass("parent");return!0},modal:function(a){return function(c,d,f){if(d)b("div.dtr-modal-content").empty().append(f());else{var g=function(){l.remove();
b(m).off("keypress.dtr")},l=b('<div class="dtr-modal"/>').append(b('<div class="dtr-modal-display"/>').append(b('<div class="dtr-modal-content"/>').append(f())).append(b('<div class="dtr-modal-close">&times;</div>').click(function(){g()}))).append(b('<div class="dtr-modal-background"/>').click(function(){g()})).appendTo("body");b(m).on("keyup.dtr",function(h){27===h.keyCode&&(h.stopPropagation(),g())})}a&&a.header&&b("div.dtr-modal-content").prepend("<h2>"+a.header(c)+"</h2>")}}};var A={};u.renderer=
{listHiddenNodes:function(){return function(a,c,d){var f=b('<ul data-dtr-index="'+c+'" class="dtr-details"/>'),g=!1;b.each(d,function(l,h){h.hidden&&(b("<li "+(h.className?'class="'+h.className+'"':"")+' data-dtr-index="'+h.columnIndex+'" data-dt-row="'+h.rowIndex+'" data-dt-column="'+h.columnIndex+'"><span class="dtr-title">'+h.title+"</span> </li>").append(b('<span class="dtr-data"/>').append(p(a,h.rowIndex,h.columnIndex))).appendTo(f),g=!0)});return g?f:!1}},listHidden:function(){return function(a,
c,d){return(a=b.map(d,function(f){var g=f.className?'class="'+f.className+'"':"";return f.hidden?"<li "+g+' data-dtr-index="'+f.columnIndex+'" data-dt-row="'+f.rowIndex+'" data-dt-column="'+f.columnIndex+'"><span class="dtr-title">'+f.title+'</span> <span class="dtr-data">'+f.data+"</span></li>":""}).join(""))?b('<ul data-dtr-index="'+c+'" class="dtr-details"/>').append(a):!1}},tableAll:function(a){a=b.extend({tableClass:""},a);return function(c,d,f){c=b.map(f,function(g){return"<tr "+(g.className?
'class="'+g.className+'"':"")+' data-dt-row="'+g.rowIndex+'" data-dt-column="'+g.columnIndex+'"><td>'+g.title+":</td> <td>"+g.data+"</td></tr>"}).join("");return b('<table class="'+a.tableClass+' dtr-details" width="100%"/>').append(c)}}};u.defaults={breakpoints:u.breakpoints,auto:!0,details:{display:u.display.childRow,renderer:u.renderer.listHidden(),target:0,type:"inline"},orthogonal:"display"};var C=b.fn.dataTable.Api;C.register("responsive()",function(){return this});C.register("responsive.index()",
function(a){a=b(a);return{column:a.data("dtr-index"),row:a.parent().data("dtr-index")}});C.register("responsive.rebuild()",function(){return this.iterator("table",function(a){a._responsive&&a._responsive._classLogic()})});C.register("responsive.recalc()",function(){return this.iterator("table",function(a){a._responsive&&(a._responsive._resizeAuto(),a._responsive._resize())})});C.register("responsive.hasHidden()",function(){var a=this.context[0];return a._responsive?-1!==b.inArray(!1,a._responsive._responsiveOnlyHidden()):
!1});C.registerPlural("columns().responsiveHidden()","column().responsiveHidden()",function(){return this.iterator("column",function(a,c){return a._responsive?a._responsive._responsiveOnlyHidden()[c]:!1},1)});u.version="2.2.7";b.fn.dataTable.Responsive=u;b.fn.DataTable.Responsive=u;b(m).on("preInit.dt.dtr",function(a,c,d){"dt"===a.namespace&&(b(c.nTable).hasClass("responsive")||b(c.nTable).hasClass("dt-responsive")||c.oInit.responsive||z.defaults.responsive)&&(a=c.oInit.responsive,!1!==a&&new u(c,
b.isPlainObject(a)?a:{}))});return u});


/*!
 Bootstrap 4 integration for DataTables' Responsive
 ©2016 SpryMedia Ltd - datatables.net/license
*/
var $jscomp=$jscomp||{};$jscomp.scope={};$jscomp.findInternal=function(a,b,c){a instanceof String&&(a=String(a));for(var e=a.length,d=0;d<e;d++){var f=a[d];if(b.call(c,f,d,a))return{i:d,v:f}}return{i:-1,v:void 0}};$jscomp.ASSUME_ES5=!1;$jscomp.ASSUME_NO_NATIVE_MAP=!1;$jscomp.ASSUME_NO_NATIVE_SET=!1;$jscomp.SIMPLE_FROUND_POLYFILL=!1;$jscomp.ISOLATE_POLYFILLS=!1;
$jscomp.defineProperty=$jscomp.ASSUME_ES5||"function"==typeof Object.defineProperties?Object.defineProperty:function(a,b,c){if(a==Array.prototype||a==Object.prototype)return a;a[b]=c.value;return a};$jscomp.getGlobal=function(a){a=["object"==typeof globalThis&&globalThis,a,"object"==typeof window&&window,"object"==typeof self&&self,"object"==typeof global&&global];for(var b=0;b<a.length;++b){var c=a[b];if(c&&c.Math==Math)return c}throw Error("Cannot find global object");};$jscomp.global=$jscomp.getGlobal(this);
$jscomp.IS_SYMBOL_NATIVE="function"===typeof Symbol&&"symbol"===typeof Symbol("x");$jscomp.TRUST_ES6_POLYFILLS=!$jscomp.ISOLATE_POLYFILLS||$jscomp.IS_SYMBOL_NATIVE;$jscomp.polyfills={};$jscomp.propertyToPolyfillSymbol={};$jscomp.POLYFILL_PREFIX="$jscp$";var $jscomp$lookupPolyfilledValue=function(a,b){var c=$jscomp.propertyToPolyfillSymbol[b];if(null==c)return a[b];c=a[c];return void 0!==c?c:a[b]};
$jscomp.polyfill=function(a,b,c,e){b&&($jscomp.ISOLATE_POLYFILLS?$jscomp.polyfillIsolated(a,b,c,e):$jscomp.polyfillUnisolated(a,b,c,e))};$jscomp.polyfillUnisolated=function(a,b,c,e){c=$jscomp.global;a=a.split(".");for(e=0;e<a.length-1;e++){var d=a[e];if(!(d in c))return;c=c[d]}a=a[a.length-1];e=c[a];b=b(e);b!=e&&null!=b&&$jscomp.defineProperty(c,a,{configurable:!0,writable:!0,value:b})};
$jscomp.polyfillIsolated=function(a,b,c,e){var d=a.split(".");a=1===d.length;e=d[0];e=!a&&e in $jscomp.polyfills?$jscomp.polyfills:$jscomp.global;for(var f=0;f<d.length-1;f++){var g=d[f];if(!(g in e))return;e=e[g]}d=d[d.length-1];c=$jscomp.IS_SYMBOL_NATIVE&&"es6"===c?e[d]:null;b=b(c);null!=b&&(a?$jscomp.defineProperty($jscomp.polyfills,d,{configurable:!0,writable:!0,value:b}):b!==c&&($jscomp.propertyToPolyfillSymbol[d]=$jscomp.IS_SYMBOL_NATIVE?$jscomp.global.Symbol(d):$jscomp.POLYFILL_PREFIX+d,d=
$jscomp.propertyToPolyfillSymbol[d],$jscomp.defineProperty(e,d,{configurable:!0,writable:!0,value:b})))};$jscomp.polyfill("Array.prototype.find",function(a){return a?a:function(b,c){return $jscomp.findInternal(this,b,c).v}},"es6","es3");
(function(a){"function"===typeof define&&define.amd?define(["jquery","datatables.net-bs4","datatables.net-responsive"],function(b){return a(b,window,document)}):"object"===typeof exports?module.exports=function(b,c){b||(b=window);c&&c.fn.dataTable||(c=require("datatables.net-bs4")(b,c).$);c.fn.dataTable.Responsive||require("datatables.net-responsive")(b,c);return a(c,b,b.document)}:a(jQuery,window,document)})(function(a,b,c,e){b=a.fn.dataTable;c=b.Responsive.display;var d=c.modal,f=a('<div class="modal fade dtr-bs-modal" role="dialog"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"/></div></div></div>');
c.modal=function(g){return function(k,h,l){if(!a.fn.modal)d(k,h,l);else if(!h){if(g&&g.header){h=f.find("div.modal-header");var m=h.find("button").detach();h.empty().append('<h4 class="modal-title">'+g.header(k)+"</h4>").append(m)}f.find("div.modal-body").empty().append(l());f.appendTo("body").modal()}}};return b.Responsive});


/*!
   Copyright 2015-2019 SpryMedia Ltd.

 This source file is free software, available under the following license:
   MIT license - http://datatables.net/license/mit

 This source file is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.

 For details please refer to: http://www.datatables.net/extensions/select
 Select for DataTables 1.3.1
 2015-2019 SpryMedia Ltd - datatables.net/license/mit
*/
(function(f){"function"===typeof define&&define.amd?define(["jquery","datatables.net"],function(k){return f(k,window,document)}):"object"===typeof exports?module.exports=function(k,p){k||(k=window);p&&p.fn.dataTable||(p=require("datatables.net")(k,p).$);return f(p,k,k.document)}:f(jQuery,window,document)})(function(f,k,p,h){function z(a,b,c){var d=function(c,b){if(c>b){var d=b;b=c;c=d}var e=!1;return a.columns(":visible").indexes().filter(function(a){a===c&&(e=!0);return a===b?(e=!1,!0):e})};var e=
function(c,b){var d=a.rows({search:"applied"}).indexes();if(d.indexOf(c)>d.indexOf(b)){var e=b;b=c;c=e}var f=!1;return d.filter(function(a){a===c&&(f=!0);return a===b?(f=!1,!0):f})};a.cells({selected:!0}).any()||c?(d=d(c.column,b.column),c=e(c.row,b.row)):(d=d(0,b.column),c=e(0,b.row));c=a.cells(c,d).flatten();a.cells(b,{selected:!0}).any()?a.cells(c).deselect():a.cells(c).select()}function v(a){var b=a.settings()[0]._select.selector;f(a.table().container()).off("mousedown.dtSelect",b).off("mouseup.dtSelect",
b).off("click.dtSelect",b);f("body").off("click.dtSelect"+a.table().node().id.replace(/[^a-zA-Z0-9\-_]/g,"-"))}function A(a){var b=f(a.table().container()),c=a.settings()[0],d=c._select.selector,e;b.on("mousedown.dtSelect",d,function(a){if(a.shiftKey||a.metaKey||a.ctrlKey)b.css("-moz-user-select","none").one("selectstart.dtSelect",d,function(){return!1});k.getSelection&&(e=k.getSelection())}).on("mouseup.dtSelect",d,function(){b.css("-moz-user-select","")}).on("click.dtSelect",d,function(c){var b=
a.select.items();if(e){var d=k.getSelection();if((!d.anchorNode||f(d.anchorNode).closest("table")[0]===a.table().node())&&d!==e)return}d=a.settings()[0];var l=f.trim(a.settings()[0].oClasses.sWrapper).replace(/ +/g,".");if(f(c.target).closest("div."+l)[0]==a.table().container()&&(l=a.cell(f(c.target).closest("td, th")),l.any())){var g=f.Event("user-select.dt");m(a,g,[b,l,c]);g.isDefaultPrevented()||(g=l.index(),"row"===b?(b=g.row,w(c,a,d,"row",b)):"column"===b?(b=l.index().column,w(c,a,d,"column",
b)):"cell"===b&&(b=l.index(),w(c,a,d,"cell",b)),d._select_lastCell=g)}});f("body").on("click.dtSelect"+a.table().node().id.replace(/[^a-zA-Z0-9\-_]/g,"-"),function(b){!c._select.blurable||f(b.target).parents().filter(a.table().container()).length||0===f(b.target).parents("html").length||f(b.target).parents("div.DTE").length||r(c,!0)})}function m(a,b,c,d){if(!d||a.flatten().length)"string"===typeof b&&(b+=".dt"),c.unshift(a),f(a.table().node()).trigger(b,c)}function B(a){var b=a.settings()[0];if(b._select.info&&
b.aanFeatures.i&&"api"!==a.select.style()){var c=a.rows({selected:!0}).flatten().length,d=a.columns({selected:!0}).flatten().length,e=a.cells({selected:!0}).flatten().length,l=function(b,c,d){b.append(f('<span class="select-item"/>').append(a.i18n("select."+c+"s",{_:"%d "+c+"s selected",0:"",1:"1 "+c+" selected"},d)))};f.each(b.aanFeatures.i,function(b,a){a=f(a);b=f('<span class="select-info"/>');l(b,"row",c);l(b,"column",d);l(b,"cell",e);var g=a.children("span.select-info");g.length&&g.remove();
""!==b.text()&&a.append(b)})}}function D(a){var b=new g.Api(a);a.aoRowCreatedCallback.push({fn:function(b,d,e){d=a.aoData[e];d._select_selected&&f(b).addClass(a._select.className);b=0;for(e=a.aoColumns.length;b<e;b++)(a.aoColumns[b]._select_selected||d._selected_cells&&d._selected_cells[b])&&f(d.anCells[b]).addClass(a._select.className)},sName:"select-deferRender"});b.on("preXhr.dt.dtSelect",function(){var a=b.rows({selected:!0}).ids(!0).filter(function(b){return b!==h}),d=b.cells({selected:!0}).eq(0).map(function(a){var c=
b.row(a.row).id(!0);return c?{row:c,column:a.column}:h}).filter(function(b){return b!==h});b.one("draw.dt.dtSelect",function(){b.rows(a).select();d.any()&&d.each(function(a){b.cells(a.row,a.column).select()})})});b.on("draw.dtSelect.dt select.dtSelect.dt deselect.dtSelect.dt info.dt",function(){B(b)});b.on("destroy.dtSelect",function(){v(b);b.off(".dtSelect")})}function C(a,b,c,d){var e=a[b+"s"]({search:"applied"}).indexes();d=f.inArray(d,e);var g=f.inArray(c,e);if(a[b+"s"]({selected:!0}).any()||
-1!==d){if(d>g){var u=g;g=d;d=u}e.splice(g+1,e.length);e.splice(0,d)}else e.splice(f.inArray(c,e)+1,e.length);a[b](c,{selected:!0}).any()?(e.splice(f.inArray(c,e),1),a[b+"s"](e).deselect()):a[b+"s"](e).select()}function r(a,b){if(b||"single"===a._select.style)a=new g.Api(a),a.rows({selected:!0}).deselect(),a.columns({selected:!0}).deselect(),a.cells({selected:!0}).deselect()}function w(a,b,c,d,e){var f=b.select.style(),g=b.select.toggleable(),h=b[d](e,{selected:!0}).any();if(!h||g)"os"===f?a.ctrlKey||
a.metaKey?b[d](e).select(!h):a.shiftKey?"cell"===d?z(b,e,c._select_lastCell||null):C(b,d,e,c._select_lastCell?c._select_lastCell[d]:null):(a=b[d+"s"]({selected:!0}),h&&1===a.flatten().length?b[d](e).deselect():(a.deselect(),b[d](e).select())):"multi+shift"==f?a.shiftKey?"cell"===d?z(b,e,c._select_lastCell||null):C(b,d,e,c._select_lastCell?c._select_lastCell[d]:null):b[d](e).select(!h):b[d](e).select(!h)}function t(a,b){return function(c){return c.i18n("buttons."+a,b)}}function x(a){a=a._eventNamespace;
return"draw.dt.DT"+a+" select.dt.DT"+a+" deselect.dt.DT"+a}function E(a,b){return-1!==f.inArray("rows",b.limitTo)&&a.rows({selected:!0}).any()||-1!==f.inArray("columns",b.limitTo)&&a.columns({selected:!0}).any()||-1!==f.inArray("cells",b.limitTo)&&a.cells({selected:!0}).any()?!0:!1}var g=f.fn.dataTable;g.select={};g.select.version="1.3.1";g.select.init=function(a){var b=a.settings()[0],c=b.oInit.select,d=g.defaults.select;c=c===h?d:c;d="row";var e="api",l=!1,u=!0,k=!0,m="td, th",p="selected",n=!1;
b._select={};!0===c?(e="os",n=!0):"string"===typeof c?(e=c,n=!0):f.isPlainObject(c)&&(c.blurable!==h&&(l=c.blurable),c.toggleable!==h&&(u=c.toggleable),c.info!==h&&(k=c.info),c.items!==h&&(d=c.items),e=c.style!==h?c.style:"os",n=!0,c.selector!==h&&(m=c.selector),c.className!==h&&(p=c.className));a.select.selector(m);a.select.items(d);a.select.style(e);a.select.blurable(l);a.select.toggleable(u);a.select.info(k);b._select.className=p;f.fn.dataTable.ext.order["select-checkbox"]=function(b,a){return this.api().column(a,
{order:"index"}).nodes().map(function(a){return"row"===b._select.items?f(a).parent().hasClass(b._select.className):"cell"===b._select.items?f(a).hasClass(b._select.className):!1})};!n&&f(a.table().node()).hasClass("selectable")&&a.select.style("os")};f.each([{type:"row",prop:"aoData"},{type:"column",prop:"aoColumns"}],function(a,b){g.ext.selector[b.type].push(function(a,d,e){d=d.selected;var c=[];if(!0!==d&&!1!==d)return e;for(var f=0,g=e.length;f<g;f++){var h=a[b.prop][e[f]];(!0===d&&!0===h._select_selected||
!1===d&&!h._select_selected)&&c.push(e[f])}return c})});g.ext.selector.cell.push(function(a,b,c){b=b.selected;var d=[];if(b===h)return c;for(var e=0,f=c.length;e<f;e++){var g=a.aoData[c[e].row];(!0===b&&g._selected_cells&&!0===g._selected_cells[c[e].column]||!(!1!==b||g._selected_cells&&g._selected_cells[c[e].column]))&&d.push(c[e])}return d});var n=g.Api.register,q=g.Api.registerPlural;n("select()",function(){return this.iterator("table",function(a){g.select.init(new g.Api(a))})});n("select.blurable()",
function(a){return a===h?this.context[0]._select.blurable:this.iterator("table",function(b){b._select.blurable=a})});n("select.toggleable()",function(a){return a===h?this.context[0]._select.toggleable:this.iterator("table",function(b){b._select.toggleable=a})});n("select.info()",function(a){return B===h?this.context[0]._select.info:this.iterator("table",function(b){b._select.info=a})});n("select.items()",function(a){return a===h?this.context[0]._select.items:this.iterator("table",function(b){b._select.items=
a;m(new g.Api(b),"selectItems",[a])})});n("select.style()",function(a){return a===h?this.context[0]._select.style:this.iterator("table",function(b){b._select.style=a;b._select_init||D(b);var c=new g.Api(b);v(c);"api"!==a&&A(c);m(new g.Api(b),"selectStyle",[a])})});n("select.selector()",function(a){return a===h?this.context[0]._select.selector:this.iterator("table",function(b){v(new g.Api(b));b._select.selector=a;"api"!==b._select.style&&A(new g.Api(b))})});q("rows().select()","row().select()",function(a){var b=
this;if(!1===a)return this.deselect();this.iterator("row",function(b,a){r(b);b.aoData[a]._select_selected=!0;f(b.aoData[a].nTr).addClass(b._select.className)});this.iterator("table",function(a,d){m(b,"select",["row",b[d]],!0)});return this});q("columns().select()","column().select()",function(a){var b=this;if(!1===a)return this.deselect();this.iterator("column",function(b,a){r(b);b.aoColumns[a]._select_selected=!0;a=(new g.Api(b)).column(a);f(a.header()).addClass(b._select.className);f(a.footer()).addClass(b._select.className);
a.nodes().to$().addClass(b._select.className)});this.iterator("table",function(a,d){m(b,"select",["column",b[d]],!0)});return this});q("cells().select()","cell().select()",function(a){var b=this;if(!1===a)return this.deselect();this.iterator("cell",function(b,a,e){r(b);a=b.aoData[a];a._selected_cells===h&&(a._selected_cells=[]);a._selected_cells[e]=!0;a.anCells&&f(a.anCells[e]).addClass(b._select.className)});this.iterator("table",function(a,d){m(b,"select",["cell",b[d]],!0)});return this});q("rows().deselect()",
"row().deselect()",function(){var a=this;this.iterator("row",function(a,c){a.aoData[c]._select_selected=!1;f(a.aoData[c].nTr).removeClass(a._select.className)});this.iterator("table",function(b,c){m(a,"deselect",["row",a[c]],!0)});return this});q("columns().deselect()","column().deselect()",function(){var a=this;this.iterator("column",function(a,c){a.aoColumns[c]._select_selected=!1;var b=new g.Api(a),e=b.column(c);f(e.header()).removeClass(a._select.className);f(e.footer()).removeClass(a._select.className);
b.cells(null,c).indexes().each(function(b){var c=a.aoData[b.row],d=c._selected_cells;!c.anCells||d&&d[b.column]||f(c.anCells[b.column]).removeClass(a._select.className)})});this.iterator("table",function(b,c){m(a,"deselect",["column",a[c]],!0)});return this});q("cells().deselect()","cell().deselect()",function(){var a=this;this.iterator("cell",function(a,c,d){c=a.aoData[c];c._selected_cells[d]=!1;c.anCells&&!a.aoColumns[d]._select_selected&&f(c.anCells[d]).removeClass(a._select.className)});this.iterator("table",
function(b,c){m(a,"deselect",["cell",a[c]],!0)});return this});var y=0;f.extend(g.ext.buttons,{selected:{text:t("selected","Selected"),className:"buttons-selected",limitTo:["rows","columns","cells"],init:function(a,b,c){var d=this;c._eventNamespace=".select"+y++;a.on(x(c),function(){d.enable(E(a,c))});this.disable()},destroy:function(a,b,c){a.off(c._eventNamespace)}},selectedSingle:{text:t("selectedSingle","Selected single"),className:"buttons-selected-single",init:function(a,b,c){var d=this;c._eventNamespace=
".select"+y++;a.on(x(c),function(){var b=a.rows({selected:!0}).flatten().length+a.columns({selected:!0}).flatten().length+a.cells({selected:!0}).flatten().length;d.enable(1===b)});this.disable()},destroy:function(a,b,c){a.off(c._eventNamespace)}},selectAll:{text:t("selectAll","Select all"),className:"buttons-select-all",action:function(){this[this.select.items()+"s"]().select()}},selectNone:{text:t("selectNone","Deselect all"),className:"buttons-select-none",action:function(){r(this.settings()[0],
!0)},init:function(a,b,c){var d=this;c._eventNamespace=".select"+y++;a.on(x(c),function(){var b=a.rows({selected:!0}).flatten().length+a.columns({selected:!0}).flatten().length+a.cells({selected:!0}).flatten().length;d.enable(0<b)});this.disable()},destroy:function(a,b,c){a.off(c._eventNamespace)}}});f.each(["Row","Column","Cell"],function(a,b){var c=b.toLowerCase();g.ext.buttons["select"+b+"s"]={text:t("select"+b+"s","Select "+c+"s"),className:"buttons-select-"+c+"s",action:function(){this.select.items(c)},
init:function(a){var b=this;a.on("selectItems.dt.DT",function(a,d,e){b.active(e===c)})}}});f(p).on("preInit.dt.dtSelect",function(a,b){"dt"===a.namespace&&g.select.init(new g.Api(b))});return g.select});



'use strict';

/*

Main javascript functions to init most of the elements

#1. CHAT APP
#2. CALENDAR INIT
#3. FORM VALIDATION
#4. DATE RANGE PICKER
#5. DATATABLES
#6. EDITABLE TABLES
#7. FORM STEPS FUNCTIONALITY
#8. SELECT 2 ACTIVATION
#9. CKEDITOR ACTIVATION
#10. CHARTJS CHARTS http://www.chartjs.org/
#11. MENU RELATED STUFF
#12. CONTENT SIDE PANEL TOGGLER
#13. EMAIL APP
#14. FULL CHAT APP
#15. CRM PIPELINE
#16. OUR OWN CUSTOM DROPDOWNS
#17. BOOTSTRAP RELATED JS ACTIVATIONS
#18. TODO Application
#19. Fancy Selector
#20. SUPPORT SERVICE
#21. Onboarding Screens Modal
#22. Colors Toggler
#23. Auto Suggest Search
#24. Element Actions

*/

// ------------------------------------
// HELPER FUNCTIONS TO TEST FOR SPECIFIC DISPLAY SIZE (RESPONSIVE HELPERS)
// ------------------------------------

function is_display_type(display_type) {
  return $('.display-type').css('content') == display_type || $('.display-type').css('content') == '"' + display_type + '"';
}
function not_display_type(display_type) {
  return $('.display-type').css('content') != display_type && $('.display-type').css('content') != '"' + display_type + '"';
}

// Initiate on click and on hover sub menu activation logic
function os_init_sub_menus() {

  // INIT MENU TO ACTIVATE ON HOVER
  var menu_timer;
  $('.menu-activated-on-hover').on('mouseenter', 'ul.main-menu > li.has-sub-menu', function () {
    var $elem = $(this);
    clearTimeout(menu_timer);
    $elem.closest('ul').addClass('has-active').find('> li').removeClass('active');
    $elem.addClass('active');
  });

  $('.menu-activated-on-hover').on('mouseleave', 'ul.main-menu > li.has-sub-menu', function () {
    var $elem = $(this);
    menu_timer = setTimeout(function () {
      $elem.removeClass('active').closest('ul').removeClass('has-active');
    }, 30);
  });

  // INIT MENU TO ACTIVATE ON CLICK
  $('.menu-activated-on-click').on('click', 'li.has-sub-menu > a', function (event) {
    var $elem = $(this).closest('li');
    if ($elem.hasClass('active')) {
      $elem.removeClass('active');
    } else {
      $elem.closest('ul').find('li.active').removeClass('active');
      $elem.addClass('active');
    }
    return false;
  });
}

$(function () {

  // #1. CHAT APP

  // $('.floated-chat-btn, .floated-chat-w .chat-close').on('click', function () {
  //   $('.floated-chat-w').toggleClass('active');
  //   return false;
  // });

  // $('.message-input').on('keypress', function (e) {
  //   if (e.which == 13) {
  //     $('.chat-messages').append('<div class="message self"><div class="message-content">' + $(this).val() + '</div></div>');
  //     $(this).val('');
  //     var $messages_w = $('.floated-chat-w .chat-messages');
  //     $messages_w.scrollTop($messages_w.prop("scrollHeight"));
  //     $messages_w.perfectScrollbar('update');
  //     return false;
  //   }
  // });

  // $('.floated-chat-w .chat-messages').perfectScrollbar();

  // #2. CALENDAR INIT

  // if ($("#fullCalendar").length) {
  //   var calendar, d, date, m, y;

  //   date = new Date();

  //   d = date.getDate();

  //   m = date.getMonth();

  //   y = date.getFullYear();

  //   calendar = $("#fullCalendar").fullCalendar({
  //     header: {
  //       left: "prev,next today",
  //       center: "title",
  //       right: "month,agendaWeek,agendaDay"
  //     },
  //     selectable: true,
  //     selectHelper: true,
  //     select: function select(start, end, allDay) {
  //       var title;
  //       title = prompt("Event Title:");
  //       if (title) {
  //         calendar.fullCalendar("renderEvent", {
  //           title: title,
  //           start: start,
  //           end: end,
  //           allDay: allDay
  //         }, true);
  //       }
  //       return calendar.fullCalendar("unselect");
  //     },
  //     editable: true,
  //     events: [{
  //       title: "Long Event",
  //       start: new Date(y, m, 3, 12, 0),
  //       end: new Date(y, m, 7, 14, 0)
  //     }, {
  //       title: "Lunch",
  //       start: new Date(y, m, d, 12, 0),
  //       end: new Date(y, m, d + 2, 14, 0),
  //       allDay: false
  //     }, {
  //       title: "Click for Google",
  //       start: new Date(y, m, 28),
  //       end: new Date(y, m, 29),
  //       url: "http://google.com/"
  //     }]
  //   });
  // }

  // #3. FORM VALIDATION

  // if ($('#formValidate').length) {
  //   $('#formValidate').validator();
  // }

  // #4. DATE RANGE PICKER

  // $('input.single-daterange').daterangepicker({ "singleDatePicker": true });
  // $('input.multi-daterange').daterangepicker({ "startDate": "03/28/2017", "endDate": "04/06/2017" });

  // #5. DATATABLES

  // if ($('#formValidate').length) {
  //   $('#formValidate').validator();
  // }
  // if ($('#dataTable1').length) {
  //   $('#dataTable1').DataTable({ buttons: ['copy', 'excel', 'pdf'] });
  // }
  // #6. EDITABLE TABLES

  // if ($('#editableTable').length) {
  //   $('#editableTable').editableTableWidget();
  // }

  // // #7. FORM STEPS FUNCTIONALITY

  // $('.step-trigger-btn').on('click', function () {
  //   var btn_href = $(this).attr('href');
  //   $('.step-trigger[href="' + btn_href + '"]').click();
  //   return false;
  // });

  // // FORM STEP CLICK
  // $('.step-trigger').on('click', function () {
  //   var prev_trigger = $(this).prev('.step-trigger');
  //   if (prev_trigger.length && !prev_trigger.hasClass('active') && !prev_trigger.hasClass('complete')) return false;
  //   var content_id = $(this).attr('href');
  //   $(this).closest('.step-triggers').find('.step-trigger').removeClass('active');
  //   $(this).prev('.step-trigger').addClass('complete');
  //   $(this).addClass('active');
  //   $('.step-content').removeClass('active');
  //   $('.step-content' + content_id).addClass('active');
  //   return false;
  // });
  // // END STEPS FUNCTIONALITY


  // // #8. SELECT 2 ACTIVATION

  // if ($('.select2').length) {
  //   $('.select2').select2();
  // }

  // // #9. CKEDITOR ACTIVATION

  // if ($('#ckeditor1').length) {
  //   CKEDITOR.replace('ckeditor1');
  // }

  // // #10. CHARTJS CHARTS http://www.chartjs.org/

  // if (typeof Chart !== 'undefined') {

  //   var fontFamily = '"Proxima Nova W01", -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
  //   // set defaults
  //   Chart.defaults.global.defaultFontFamily = fontFamily;
  //   Chart.defaults.global.tooltips.titleFontSize = 14;
  //   Chart.defaults.global.tooltips.titleMarginBottom = 4;
  //   Chart.defaults.global.tooltips.displayColors = false;
  //   Chart.defaults.global.tooltips.bodyFontSize = 12;
  //   Chart.defaults.global.tooltips.xPadding = 10;
  //   Chart.defaults.global.tooltips.yPadding = 8;

  //   // init lite line chart if element exists

  //   if ($("#liteLineChart").length) {
  //     var liteLineChart = $("#liteLineChart");

  //     var liteLineGradient = liteLineChart[0].getContext('2d').createLinearGradient(0, 0, 0, 200);
  //     liteLineGradient.addColorStop(0, 'rgba(30,22,170,0.08)');
  //     liteLineGradient.addColorStop(1, 'rgba(30,22,170,0)');

  //     var chartData = [13, 28, 19, 24, 43, 49];

  //     if (liteLineChart.data('chart-data')) chartData = liteLineChart.data('chart-data').split(',');

  //     // line chart data
  //     var liteLineData = {
  //       labels: ["January 1", "January 5", "January 10", "January 15", "January 20", "January 25"],
  //       datasets: [{
  //         label: "Sold",
  //         fill: true,
  //         lineTension: 0.4,
  //         backgroundColor: liteLineGradient,
  //         borderColor: "#8f1cad",
  //         borderCapStyle: 'butt',
  //         borderDash: [],
  //         borderDashOffset: 0.0,
  //         borderJoinStyle: 'miter',
  //         pointBorderColor: "#fff",
  //         pointBackgroundColor: "#2a2f37",
  //         pointBorderWidth: 2,
  //         pointHoverRadius: 6,
  //         pointHoverBackgroundColor: "#FC2055",
  //         pointHoverBorderColor: "#fff",
  //         pointHoverBorderWidth: 2,
  //         pointRadius: 4,
  //         pointHitRadius: 5,
  //         data: chartData,
  //         spanGaps: false
  //       }]
  //     };

  //     // line chart init
  //     var myLiteLineChart = new Chart(liteLineChart, {
  //       type: 'line',
  //       data: liteLineData,
  //       options: {
  //         legend: {
  //           display: false
  //         },
  //         scales: {
  //           xAxes: [{
  //             display: false,
  //             ticks: {
  //               fontSize: '11',
  //               fontColor: '#969da5'
  //             },
  //             gridLines: {
  //               color: 'rgba(0,0,0,0.0)',
  //               zeroLineColor: 'rgba(0,0,0,0.0)'
  //             }
  //           }],
  //           yAxes: [{
  //             display: false,
  //             ticks: {
  //               beginAtZero: true,
  //               max: 55
  //             }
  //           }]
  //         }
  //       }
  //     });
  //   }

  //   // init lite line chart V2 if element exists

  //   if ($("#liteLineChartV2").length) {
  //     var liteLineChartV2 = $("#liteLineChartV2");

  //     var liteLineGradientV2 = liteLineChartV2[0].getContext('2d').createLinearGradient(0, 0, 0, 100);
  //     liteLineGradientV2.addColorStop(0, 'rgba(40,97,245,0.1)');
  //     liteLineGradientV2.addColorStop(1, 'rgba(40,97,245,0)');

  //     var chartDataV2 = [13, 28, 19, 24, 43, 49, 40, 35, 42, 46];

  //     if (liteLineChartV2.data('chart-data')) chartDataV2 = liteLineChartV2.data('chart-data').split(',');

  //     // line chart data
  //     var liteLineDataV2 = {
  //       labels: ["1", "3", "6", "9", "12", "15", "18", "21", "24", "27"],
  //       datasets: [{
  //         label: "Balance",
  //         fill: true,
  //         lineTension: 0.35,
  //         backgroundColor: liteLineGradientV2,
  //         borderColor: "#2861f5",
  //         borderCapStyle: 'butt',
  //         borderDash: [],
  //         borderDashOffset: 0.0,
  //         borderJoinStyle: 'miter',
  //         pointBorderColor: "#2861f5",
  //         pointBackgroundColor: "#fff",
  //         pointBorderWidth: 2,
  //         pointHoverRadius: 3,
  //         pointHoverBackgroundColor: "#FC2055",
  //         pointHoverBorderColor: "#fff",
  //         pointHoverBorderWidth: 2,
  //         pointRadius: 3,
  //         pointHitRadius: 10,
  //         data: chartDataV2,
  //         spanGaps: false
  //       }]
  //     };

  //     // line chart init
  //     var myLiteLineChartV2 = new Chart(liteLineChartV2, {
  //       type: 'line',
  //       data: liteLineDataV2,
  //       options: {
  //         legend: {
  //           display: false
  //         },
  //         scales: {
  //           xAxes: [{
  //             ticks: {
  //               fontSize: '10',
  //               fontColor: '#969da5'
  //             },
  //             gridLines: {
  //               color: 'rgba(0,0,0,0.0)',
  //               zeroLineColor: 'rgba(0,0,0,0.0)'
  //             }
  //           }],
  //           yAxes: [{
  //             display: false,
  //             ticks: {
  //               beginAtZero: true,
  //               max: 55
  //             }
  //           }]
  //         }
  //       }
  //     });
  //   }

  //   // init lite line chart V2 if element exists

  //   if ($("#liteLineChartV3").length) {
  //     var liteLineChartV3 = $("#liteLineChartV3");

  //     var liteLineGradientV3 = liteLineChartV3[0].getContext('2d').createLinearGradient(0, 0, 0, 70);
  //     liteLineGradientV3.addColorStop(0, 'rgba(40,97,245,0.2)');
  //     liteLineGradientV3.addColorStop(1, 'rgba(40,97,245,0)');

  //     var chartDataV3 = [13, 28, 19, 24, 43, 49, 40, 35, 42, 46, 38];

  //     if (liteLineChartV3.data('chart-data')) chartDataV3 = liteLineChartV3.data('chart-data').split(',');

  //     // line chart data
  //     var liteLineDataV3 = {
  //       labels: ["", "FEB", "", "MAR", "", "APR", "", "MAY", "", "JUN", "", "JUL", ""],
  //       datasets: [{
  //         label: "Balance",
  //         fill: true,
  //         lineTension: 0.15,
  //         backgroundColor: liteLineGradientV3,
  //         borderColor: "#2861f5",
  //         borderCapStyle: 'butt',
  //         borderDash: [],
  //         borderDashOffset: 0.0,
  //         borderJoinStyle: 'miter',
  //         pointBorderColor: "#2861f5",
  //         pointBackgroundColor: "#fff",
  //         pointBorderWidth: 2,
  //         pointHoverRadius: 3,
  //         pointHoverBackgroundColor: "#FC2055",
  //         pointHoverBorderColor: "#fff",
  //         pointHoverBorderWidth: 0,
  //         pointRadius: 0,
  //         pointHitRadius: 10,
  //         data: chartDataV3,
  //         spanGaps: false
  //       }]
  //     };

  //     // line chart init
  //     var myLiteLineChartV3 = new Chart(liteLineChartV3, {
  //       type: 'line',
  //       data: liteLineDataV3,
  //       options: {
  //         legend: {
  //           display: false
  //         },
  //         scales: {
  //           xAxes: [{
  //             ticks: {
  //               fontSize: '10',
  //               fontColor: '#969da5'
  //             },
  //             gridLines: {
  //               color: 'rgba(0,0,0,0.0)',
  //               zeroLineColor: 'rgba(0,0,0,0.0)'
  //             }
  //           }],
  //           yAxes: [{
  //             display: false,
  //             ticks: {
  //               beginAtZero: true,
  //               max: 55
  //             }
  //           }]
  //         }
  //       }
  //     });
  //   }

  //   // init line chart if element exists
  //   if ($("#lineChart").length) {
  //     var lineChart = $("#lineChart");

  //     // line chart data
  //     var lineData = {
  //       labels: ["1", "5", "10", "15", "20", "25", "30", "35"],
  //       datasets: [{
  //         label: "Visitors Graph",
  //         fill: false,
  //         lineTension: 0.3,
  //         backgroundColor: "#fff",
  //         borderColor: "#047bf8",
  //         borderCapStyle: 'butt',
  //         borderDash: [],
  //         borderDashOffset: 0.0,
  //         borderJoinStyle: 'miter',
  //         pointBorderColor: "#fff",
  //         pointBackgroundColor: "#141E41",
  //         pointBorderWidth: 3,
  //         pointHoverRadius: 10,
  //         pointHoverBackgroundColor: "#FC2055",
  //         pointHoverBorderColor: "#fff",
  //         pointHoverBorderWidth: 3,
  //         pointRadius: 5,
  //         pointHitRadius: 10,
  //         data: [27, 20, 44, 24, 29, 22, 43, 52],
  //         spanGaps: false
  //       }]
  //     };

  //     // line chart init
  //     var myLineChart = new Chart(lineChart, {
  //       type: 'line',
  //       data: lineData,
  //       options: {
  //         legend: {
  //           display: false
  //         },
  //         scales: {
  //           xAxes: [{
  //             ticks: {
  //               fontSize: '11',
  //               fontColor: '#969da5'
  //             },
  //             gridLines: {
  //               color: 'rgba(0,0,0,0.05)',
  //               zeroLineColor: 'rgba(0,0,0,0.05)'
  //             }
  //           }],
  //           yAxes: [{
  //             display: false,
  //             ticks: {
  //               beginAtZero: true,
  //               max: 65
  //             }
  //           }]
  //         }
  //       }
  //     });
  //   }

  //   // init donut chart if element exists
  //   if ($("#barChart1").length) {
  //     var barChart1 = $("#barChart1");
  //     var barData1 = {
  //       labels: ["January", "February", "March", "April", "May", "June"],
  //       datasets: [{
  //         label: "My First dataset",
  //         backgroundColor: ["#5797FC", "#629FFF", "#6BA4FE", "#74AAFF", "#7AAEFF", '#85B4FF'],
  //         borderColor: ['rgba(255,99,132,0)', 'rgba(54, 162, 235, 0)', 'rgba(255, 206, 86, 0)', 'rgba(75, 192, 192, 0)', 'rgba(153, 102, 255, 0)', 'rgba(255, 159, 64, 0)'],
  //         borderWidth: 1,
  //         data: [24, 42, 18, 34, 56, 28]
  //       }]
  //     };
  //     // -----------------
  //     // init bar chart
  //     // -----------------
  //     new Chart(barChart1, {
  //       type: 'bar',
  //       data: barData1,
  //       options: {
  //         scales: {
  //           xAxes: [{
  //             display: false,
  //             ticks: {
  //               fontSize: '11',
  //               fontColor: '#969da5'
  //             },
  //             gridLines: {
  //               color: 'rgba(0,0,0,0.05)',
  //               zeroLineColor: 'rgba(0,0,0,0.05)'
  //             }
  //           }],
  //           yAxes: [{
  //             ticks: {
  //               beginAtZero: true
  //             },
  //             gridLines: {
  //               color: 'rgba(0,0,0,0.05)',
  //               zeroLineColor: '#6896f9'
  //             }
  //           }]
  //         },
  //         legend: {
  //           display: false
  //         },
  //         animation: {
  //           animateScale: true
  //         }
  //       }
  //     });
  //   }

  //   // init pie chart if element exists
  //   if ($("#pieChart1").length) {
  //     var pieChart1 = $("#pieChart1");

  //     // pie chart data
  //     var pieData1 = {
  //       labels: ["Red", "Blue", "Yellow", "Green", "Purple"],
  //       datasets: [{
  //         data: [300, 50, 100, 30, 70],
  //         backgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
  //         hoverBackgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
  //         borderWidth: 0
  //       }]
  //     };

  //     // -----------------
  //     // init pie chart
  //     // -----------------
  //     new Chart(pieChart1, {
  //       type: 'pie',
  //       data: pieData1,
  //       options: {
  //         legend: {
  //           position: 'bottom',
  //           labels: {
  //             boxWidth: 15,
  //             fontColor: '#3e4b5b'
  //           }
  //         },
  //         animation: {
  //           animateScale: true
  //         }
  //       }
  //     });
  //   }

  //   // -----------------
  //   // init donut chart if element exists
  //   // -----------------
  //   if ($("#donutChart").length) {
  //     var donutChart = $("#donutChart");

  //     // donut chart data
  //     var data = {
  //       labels: ["Red", "Blue", "Yellow", "Green", "Purple"],
  //       datasets: [{
  //         data: [300, 50, 100, 30, 70],
  //         backgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
  //         hoverBackgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
  //         borderWidth: 0
  //       }]
  //     };

  //     // -----------------
  //     // init donut chart
  //     // -----------------
  //     new Chart(donutChart, {
  //       type: 'doughnut',
  //       data: data,
  //       options: {
  //         legend: {
  //           display: false
  //         },
  //         animation: {
  //           animateScale: true
  //         },
  //         cutoutPercentage: 80
  //       }
  //     });
  //   }

  //   // -----------------
  //   // init donut chart if element exists
  //   // -----------------
  //   if ($("#donutChart1").length) {
  //     var donutChart1 = $("#donutChart1");

  //     // donut chart data
  //     var data1 = {
  //       labels: ["Red", "Blue", "Yellow", "Green", "Purple"],
  //       datasets: [{
  //         data: [300, 50, 100, 30, 70],
  //         backgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
  //         hoverBackgroundColor: ["#5797fc", "#7e6fff", "#4ecc48", "#ffcc29", "#f37070"],
  //         borderWidth: 6,
  //         hoverBorderColor: 'transparent'
  //       }]
  //     };

  //     // -----------------
  //     // init donut chart
  //     // -----------------
  //     new Chart(donutChart1, {
  //       type: 'doughnut',
  //       data: data1,
  //       options: {
  //         legend: {
  //           display: false
  //         },
  //         animation: {
  //           animateScale: true
  //         },
  //         cutoutPercentage: 80
  //       }
  //     });
  //   }
  // }

  // #11. MENU RELATED STUFF

  // INIT MOBILE MENU TRIGGER BUTTON
  $('.mobile-menu-trigger').on('click', function () {
    $('.menu-mobile .menu-and-user').slideToggle(200, 'swing');
    return false;
  });

  os_init_sub_menus();

  // #12. CONTENT SIDE PANEL TOGGLER

  $('.content-panel-toggler, .content-panel-close, .content-panel-open').on('click', function () {
    $('.all-wrapper').toggleClass('content-panel-active');
  });

  // // #13. EMAIL APP

  // $('.more-messages').on('click', function () {
  //   $(this).hide();
  //   $('.older-pack').slideDown(100);
  //   $('.aec-full-message-w.show-pack').removeClass('show-pack');
  //   return false;
  // });

  // $('.ae-list').perfectScrollbar({ wheelPropagation: true });

  // $('.ae-list .ae-item').on('click', function () {
  //   $('.ae-item.active').removeClass('active');
  //   $(this).addClass('active');
  //   return false;
  // });

  // // CKEDITOR ACTIVATION FOR MAIL REPLY
  // if (typeof CKEDITOR !== 'undefined') {
  //   CKEDITOR.disableAutoInline = true;
  //   if ($('#ckeditorEmail').length) {
  //     CKEDITOR.config.uiColor = '#ffffff';
  //     CKEDITOR.config.toolbar = [['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', '-', 'About']];
  //     CKEDITOR.config.height = 110;
  //     CKEDITOR.replace('ckeditor1');
  //   }
  // }

  // // EMAIL SIDEBAR MENU TOGGLER
  // $('.ae-side-menu-toggler').on('click', function () {
  //   $('.app-email-w').toggleClass('compact-side-menu');
  // });

  // // EMAIL MOBILE SHOW MESSAGE
  // $('.ae-item').on('click', function () {
  //   $('.app-email-w').addClass('forse-show-content');
  // });

  // if ($('.app-email-w').length) {
  //   if (is_display_type('phone') || is_display_type('tablet')) {
  //     $('.app-email-w').addClass('compact-side-menu');
  //   }
  // }

  // #14. FULL CHAT APP
  // function add_full_chat_message($input) {
  //   $('.chat-content').append('<div class="chat-message self"><div class="chat-message-content-w"><div class="chat-message-content">' + $input.val() + '</div></div><div class="chat-message-date">1:23pm</div><div class="chat-message-avatar"><img alt="" src="img/avatar1.jpg"></div></div>');
  //   $input.val('');
  //   var $messages_w = $('.chat-content-w');
  //   $messages_w.scrollTop($messages_w[0].scrollHeight);
  // }

  // $('.chat-btn a').on('click', function () {
  //   add_full_chat_message($('.chat-input input'));
  //   return false;
  // });
  // $('.chat-input input').on('keypress', function (e) {
  //   if (e.which == 13) {
  //     add_full_chat_message($(this));
  //     return false;
  //   }
  // });

  // #15. CRM PIPELINE
  // if ($('.pipeline').length) {
  //   // INIT DRAG AND DROP FOR PIPELINE ITEMS
  //   var dragulaObj = dragula($('.pipeline-body').toArray(), {}).on('drag', function () {}).on('drop', function (el) {}).on('over', function (el, container) {
  //     $(container).closest('.pipeline-body').addClass('over');
  //   }).on('out', function (el, container, source) {

  //     var new_pipeline_body = $(container).closest('.pipeline-body');
  //     new_pipeline_body.removeClass('over');
  //     var old_pipeline_body = $(source).closest('.pipeline-body');
  //   });
  // }

  // #16. OUR OWN CUSTOM DROPDOWNS
  $('.os-dropdown-trigger').on('mouseenter', function () {
    $(this).addClass('over');
  });
  $('.os-dropdown-trigger').on('mouseleave', function () {
    $(this).removeClass('over');
  });

  // #17. BOOTSTRAP RELATED JS ACTIVATIONS

  // - Activate tooltips
  $('[data-toggle="tooltip"]').tooltip();

  // - Activate popovers
  $('[data-toggle="popover"]').popover();

  // #18. TODO Application

  // // Tasks foldable trigger
  // $('.tasks-header-toggler').on('click', function () {
  //   $(this).closest('.tasks-section').find('.tasks-list-w').slideToggle(100);
  //   return false;
  // });

  // // Sidebar Sections foldable trigger
  // $('.todo-sidebar-section-toggle').on('click', function () {
  //   $(this).closest('.todo-sidebar-section').find('.todo-sidebar-section-contents').slideToggle(100);
  //   return false;
  // });

  // // Sidebar Sub Sections foldable trigger
  // $('.todo-sidebar-section-sub-section-toggler').on('click', function () {
  //   $(this).closest('.todo-sidebar-section-sub-section').find('.todo-sidebar-section-sub-section-content').slideToggle(100);
  //   return false;
  // });

  // // Drag init
  // if ($('.tasks-list').length) {
  //   // INIT DRAG AND DROP FOR Todo Tasks
  //   var dragulaTasksObj = dragula($('.tasks-list').toArray(), {
  //     moves: function moves(el, container, handle) {
  //       return handle.classList.contains('drag-handle');
  //     }
  //   }).on('drag', function () {}).on('drop', function (el) {}).on('over', function (el, container) {
  //     $(container).closest('.tasks-list').addClass('over');
  //   }).on('out', function (el, container, source) {

  //     var new_pipeline_body = $(container).closest('.tasks-list');
  //     new_pipeline_body.removeClass('over');
  //     var old_pipeline_body = $(source).closest('.tasks-list');
  //   });
  // }

  // // Task actions init

  // // Complete/Done
  // $('.task-btn-done').on('click', function () {
  //   $(this).closest('.draggable-task').toggleClass('complete');
  //   return false;
  // });

  // // Favorite/star
  // $('.task-btn-star').on('click', function () {
  //   $(this).closest('.draggable-task').toggleClass('favorite');
  //   return false;
  // });

  // // Delete
  // var timeoutDeleteTask;
  // $('.task-btn-delete').on('click', function () {
  //   if (confirm('Are you sure you want to delete this task?')) {
  //     var $task_to_remove = $(this).closest('.draggable-task');
  //     $task_to_remove.addClass('pre-removed');
  //     $task_to_remove.append('<a href="#" class="task-btn-undelete">Undo Delete</a>');
  //     timeoutDeleteTask = setTimeout(function () {
  //       $task_to_remove.slideUp(300, function () {
  //         $(this).remove();
  //       });
  //     }, 5000);
  //   }
  //   return false;
  // });

  // $('.tasks-list').on('click', '.task-btn-undelete', function () {
  //   $(this).closest('.draggable-task').removeClass('pre-removed');
  //   $(this).remove();
  //   if (typeof timeoutDeleteTask !== 'undefined') {
  //     clearTimeout(timeoutDeleteTask);
  //   }
  //   return false;
  // });

  // #19. Fancy Selector
  // $('.fs-selector-trigger').on('click', function () {
  //   $(this).closest('.fancy-selector-w').toggleClass('opened');
  // });

  // #20. SUPPORT SERVICE

  // $('.close-ticket-info').on('click', function () {
  //   $('.support-ticket-content-w').addClass('folded-info').removeClass('force-show-folded-info');
  //   return false;
  // });

  // $('.show-ticket-info').on('click', function () {
  //   $('.support-ticket-content-w').removeClass('folded-info').addClass('force-show-folded-info');
  //   return false;
  // });

  // $('.support-index .support-tickets .support-ticket').on('click', function () {
  //   $('.support-index').addClass('show-ticket-content');
  //   return false;
  // });

  // $('.support-index .back-to-index').on('click', function () {
  //   $('.support-index').removeClass('show-ticket-content');
  //   return false;
  // });

  // #21. Onboarding Screens Modal

  // $('.onboarding-modal.show-on-load').modal('show');
  // if ($('.onboarding-modal .onboarding-slider-w').length) {
  //   $('.onboarding-modal .onboarding-slider-w').slick({
  //     dots: true,
  //     infinite: false,
  //     adaptiveHeight: true,
  //     slidesToShow: 1,
  //     slidesToScroll: 1
  //   });
  //   $('.onboarding-modal').on('shown.bs.modal', function (e) {
  //     $('.onboarding-modal .onboarding-slider-w').slick('setPosition');
  //   });
  // }

  // #22. Colors Toggler

  // $('.floated-colors-btn').on('click', function () {
  //   if ($('body').hasClass('color-scheme-dark')) {
  //     $('.menu-w').removeClass('color-scheme-dark').addClass('color-scheme-light').removeClass('selected-menu-color-bright').addClass('selected-menu-color-light');
  //     $(this).find('.os-toggler-w').removeClass('on');
  //   } else {
  //     $('.menu-w, .top-bar').removeClass(function (index, className) {
  //       return (className.match(/(^|\s)color-scheme-\S+/g) || []).join(' ');
  //     });
  //     $('.menu-w').removeClass(function (index, className) {
  //       return (className.match(/(^|\s)color-style-\S+/g) || []).join(' ');
  //     });
  //     $('.menu-w').addClass('color-scheme-dark').addClass('color-style-transparent').removeClass('selected-menu-color-light').addClass('selected-menu-color-bright');
  //     $('.top-bar').addClass('color-scheme-transparent');
  //     $(this).find('.os-toggler-w').addClass('on');
  //   }
  //   $('body').toggleClass('color-scheme-dark');
  //   return false;
  // });

  // #23. Autosuggest Search
  // $('.autosuggest-search-activator').on('click', function () {
  //   var search_offset = $(this).offset();
  //   // If input field is in the activator - show on top of it
  //   if ($(this).find('input[type="text"]')) {
  //     search_offset = $(this).find('input[type="text"]').offset();
  //   }
  //   var search_field_position_left = search_offset.left;
  //   var search_field_position_top = search_offset.top;
  //   $('.search-with-suggestions-w').css('left', search_field_position_left).css('top', search_field_position_top).addClass('over-search-field').fadeIn(300).find('.search-suggest-input').focus();
  //   return false;
  // });

  // $('.search-suggest-input').on('keydown', function (e) {

  //   // Close if ESC was pressed
  //   if (e.which == 27) {
  //     $('.search-with-suggestions-w').fadeOut();
  //   }

  //   // Backspace/Delete pressed
  //   if (e.which == 46 || e.which == 8) {
  //     // This is a test code, remove when in real life usage
  //     $('.search-with-suggestions-w .ssg-item:last-child').show();
  //     $('.search-with-suggestions-w .ssg-items.ssg-items-blocks').show();
  //     $('.ssg-nothing-found').hide();
  //   }

  //   // Imitate item removal on search, test code
  //   if (e.which != 27 && e.which != 8 && e.which != 46) {
  //     // This is a test code, remove when in real life usage
  //     $('.search-with-suggestions-w .ssg-item:last-child').hide();
  //     $('.search-with-suggestions-w .ssg-items.ssg-items-blocks').hide();
  //     $('.ssg-nothing-found').show();
  //   }
  // });

  // $('.close-search-suggestions').on('click', function () {
  //   $('.search-with-suggestions-w').fadeOut();
  //   return false;
  // });

  // #24. Element Actions
  // $('.element-action-fold').on('click', function () {
  //   var $wrapper = $(this).closest('.element-wrapper');
  //   $wrapper.find('.element-box-tp, .element-box').toggle(0);
  //   var $icon = $(this).find('i');

  //   if ($wrapper.hasClass('folded')) {
  //     $icon.removeClass('os-icon-plus-circle').addClass('os-icon-minus-circle');
  //     $wrapper.removeClass('folded');
  //   } else {
  //     $icon.removeClass('os-icon-minus-circle').addClass('os-icon-plus-circle');
  //     $wrapper.addClass('folded');
  //   }
  //   return false;
  // });
});

/**
 * Copyright (c) Tiny Technologies, Inc. All rights reserved.
 */
!function(){"use strict";var r=function(e){if(null===e)return"null";if(e===undefined)return"undefined";var t=typeof e;return"object"==t&&(Array.prototype.isPrototypeOf(e)||e.constructor&&"Array"===e.constructor.name)?"array":"object"==t&&(String.prototype.isPrototypeOf(e)||e.constructor&&"String"===e.constructor.name)?"string":t},t=function(e){return{eq:e}},s=t(function(e,t){return e===t}),i=function(o){return t(function(e,t){if(e.length!==t.length)return!1;for(var n=e.length,r=0;r<n;r++)if(!o.eq(e[r],t[r]))return!1;return!0})},c=function(e,r){return n=i(e),o=function(e){return t=e,n=r,Array.prototype.slice.call(t).sort(n);var t,n},t(function(e,t){return n.eq(o(e),o(t))});var n,o},u=function(u){return t(function(e,t){var n=Object.keys(e),r=Object.keys(t);if(!c(s).eq(n,r))return!1;for(var o=n.length,i=0;i<o;i++){var a=n[i];if(!u.eq(e[a],t[a]))return!1}return!0})},l=t(function(e,t){if(e===t)return!0;var n=r(e);return n===r(t)&&(-1!==["undefined","boolean","number","string","function","xml","null"].indexOf(n)?e===t:"array"===n?i(l).eq(e,t):"object"===n&&u(l).eq(e,t))}),te=function(){},a=function(n,r){return function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];return n(r.apply(null,e))}},S=function(e){return function(){return e}},o=function(e){return e};function N(r){for(var o=[],e=1;e<arguments.length;e++)o[e-1]=arguments[e];return function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];var n=o.concat(e);return r.apply(null,n)}}var e,n,f,d=function(t){return function(e){return!t(e)}},m=function(e){return function(){throw new Error(e)}},p=function(e){return e()},y=function(e){e()},b=S(!1),w=S(!0),g=function(){return h},h=(e=function(e){return e.isNone()},{fold:function(e,t){return e()},is:b,isSome:b,isNone:w,getOr:f=function(e){return e},getOrThunk:n=function(e){return e()},getOrDie:function(e){throw new Error(e||"error: getOrDie called on none.")},getOrNull:S(null),getOrUndefined:S(undefined),or:f,orThunk:n,map:g,each:te,bind:g,exists:b,forall:w,filter:g,equals:e,equals_:e,toArray:function(){return[]},toString:S("none()")}),v=function(n){var e=S(n),t=function(){return o},r=function(e){return e(n)},o={fold:function(e,t){return t(n)},is:function(e){return n===e},isSome:w,isNone:b,getOr:e,getOrThunk:e,getOrDie:e,getOrNull:e,getOrUndefined:e,or:t,orThunk:t,map:function(e){return v(e(n))},each:function(e){e(n)},bind:r,exists:r,forall:r,filter:function(e){return e(n)?o:h},toArray:function(){return[n]},toString:function(){return"some("+n+")"},equals:function(e){return e.is(n)},equals_:function(e,t){return e.fold(b,function(e){return t(n,e)})}};return o},U={some:v,none:g,from:function(e){return null===e||e===undefined?h:v(e)}},C=function(r){return function(e){return n=typeof(t=e),(null===t?"null":"object"==n&&(Array.prototype.isPrototypeOf(t)||t.constructor&&"Array"===t.constructor.name)?"array":"object"==n&&(String.prototype.isPrototypeOf(t)||t.constructor&&"String"===t.constructor.name)?"string":n)===r;var t,n}},x=function(t){return function(e){return typeof e===t}},E=function(t){return function(e){return t===e}},K=C("string"),k=C("object"),_=C("array"),A=E(null),R=x("boolean"),T=E(undefined),X=function(e){return null===e||e===undefined},V=function(e){return!X(e)},D=x("function"),O=x("number"),B=Array.prototype.slice,P=Array.prototype.indexOf,L=Array.prototype.push,I=function(e,t){return P.call(e,t)},M=function(e,t){return-1<I(e,t)},F=function(e,t){for(var n=0,r=e.length;n<r;n++){if(t(e[n],n))return!0}return!1},z=function(e,t){for(var n=e.length,r=new Array(n),o=0;o<n;o++){var i=e[o];r[o]=t(i,o)}return r},Y=function(e,t){for(var n=0,r=e.length;n<r;n++){t(e[n],n)}},j=function(e,t){for(var n=e.length-1;0<=n;n--){t(e[n],n)}},H=function(e,t){for(var n=[],r=0,o=e.length;r<o;r++){var i=e[r];t(i,r)&&n.push(i)}return n},q=function(e,t,n){return j(e,function(e){n=t(n,e)}),n},$=function(e,t,n){return Y(e,function(e){n=t(n,e)}),n},W=function(e,t){return function(e,t,n){for(var r=0,o=e.length;r<o;r++){var i=e[r];if(t(i,r))return U.some(i);if(n(i,r))break}return U.none()}(e,t,b)},G=function(e,t){for(var n=0,r=e.length;n<r;n++){if(t(e[n],n))return U.some(n)}return U.none()},J=function(e,t){return function(e){for(var t=[],n=0,r=e.length;n<r;++n){if(!_(e[n]))throw new Error("Arr.flatten item "+n+" was not an array, input: "+e);L.apply(t,e[n])}return t}(z(e,t))},Q=function(e,t){for(var n=0,r=e.length;n<r;++n){if(!0!==t(e[n],n))return!1}return!0},Z=function(e){var t=B.call(e,0);return t.reverse(),t},ee=function(e,t){return H(e,function(e){return!M(t,e)})},ne=function(e,t){return 0<=t&&t<e.length?U.some(e[t]):U.none()},re=function(e){return ne(e,0)},oe=function(e){return ne(e,e.length-1)},ie=D(Array.from)?Array.from:function(e){return B.call(e)},ae=Object.keys,ue=Object.hasOwnProperty,se=function(e,t){for(var n=ae(e),r=0,o=n.length;r<o;r++){var i=n[r];t(e[i],i)}},ce=function(e,n){return le(e,function(e,t){return{k:t,v:n(e,t)}})},le=function(e,r){var o={};return se(e,function(e,t){var n=r(e,t);o[n.k]=n.v}),o},fe=function(n){return function(e,t){n[t]=e}},de=function(e,n,r,o){return se(e,function(e,t){(n(e,t)?r:o)(e,t)}),{}},me=function(e,t){var n={},r={};return de(e,t,fe(n),fe(r)),{t:n,f:r}},pe=function(e,t){var n={};return de(e,t,fe(n),te),n},ge=function(e){return n=function(e){return e},r=[],se(e,function(e,t){r.push(n(e,t))}),r;var n,r},he=function(e,t){return ve(e,t)?U.from(e[t]):U.none()},ve=function(e,t){return ue.call(e,t)},ye=function(e,t){return ve(e,t)&&e[t]!==undefined&&null!==e[t]},be=Array.isArray,Ce=function(e,t,n){var r,o;if(!e)return!1;if(n=n||e,e.length!==undefined){for(r=0,o=e.length;r<o;r++)if(!1===t.call(n,e[r],r,e))return!1}else for(r in e)if(e.hasOwnProperty(r)&&!1===t.call(n,e[r],r,e))return!1;return!0},we=function(n,r){var o=[];return Ce(n,function(e,t){o.push(r(e,t,n))}),o},xe=function(n,r){var o=[];return Ce(n,function(e,t){r&&!r(e,t,n)||o.push(e)}),o},Se=function(e,t){if(e)for(var n=0,r=e.length;n<r;n++)if(e[n]===t)return n;return-1},Ne=function(e,t,n,r){for(var o=T(n)?e[0]:n,i=0;i<e.length;i++)o=t.call(r,o,e[i],i);return o},Ee=function(e,t,n){for(var r=0,o=e.length;r<o;r++)if(t.call(n,e[r],r,e))return r;return-1},ke=function(e){return e[e.length-1]},_e=function(){return(_e=Object.assign||function(e){for(var t,n=1,r=arguments.length;n<r;n++)for(var o in t=arguments[n])Object.prototype.hasOwnProperty.call(t,o)&&(e[o]=t[o]);return e}).apply(this,arguments)};function Ae(){for(var e=0,t=0,n=arguments.length;t<n;t++)e+=arguments[t].length;for(var r=Array(e),o=0,t=0;t<n;t++)for(var i=arguments[t],a=0,u=i.length;a<u;a++,o++)r[o]=i[a];return r}var Re,Te,De,Oe,Be,Pe,Le,Ie=function(e,t){var n=function(e,t){for(var n=0;n<e.length;n++){var r=e[n];if(r.test(t))return r}return undefined}(e,t);if(!n)return{major:0,minor:0};var r=function(e){return Number(t.replace(n,"$"+e))};return Fe(r(1),r(2))},Me=function(){return Fe(0,0)},Fe=function(e,t){return{major:e,minor:t}},Ue={nu:Fe,detect:function(e,t){var n=String(t).toLowerCase();return 0===e.length?Me():Ie(e,n)},unknown:Me},ze=function(e,t){var n=String(t).toLowerCase();return W(e,function(e){return e.search(n)})},je=function(e,n){return ze(e,n).map(function(e){var t=Ue.detect(e.versionRegexes,n);return{current:e.name,version:t}})},He=function(e,n){return ze(e,n).map(function(e){var t=Ue.detect(e.versionRegexes,n);return{current:e.name,version:t}})},Ve=function(e,t){return-1!==e.indexOf(t)},qe=function(e,t){return n=e,o=0,""===(r=t)||n.length>=r.length&&n.substr(o,o+r.length)===r;var n,r,o},$e=function(t){return function(e){return e.replace(t,"")}},We=$e(/^\s+|\s+$/g),Ke=$e(/^\s+/g),Xe=$e(/\s+$/g),Ye=/.*?version\/\ ?([0-9]+)\.([0-9]+).*/,Ge=function(t){return function(e){return Ve(e,t)}},Je=[{name:"Edge",versionRegexes:[/.*?edge\/ ?([0-9]+)\.([0-9]+)$/],search:function(e){return Ve(e,"edge/")&&Ve(e,"chrome")&&Ve(e,"safari")&&Ve(e,"applewebkit")}},{name:"Chrome",versionRegexes:[/.*?chrome\/([0-9]+)\.([0-9]+).*/,Ye],search:function(e){return Ve(e,"chrome")&&!Ve(e,"chromeframe")}},{name:"IE",versionRegexes:[/.*?msie\ ?([0-9]+)\.([0-9]+).*/,/.*?rv:([0-9]+)\.([0-9]+).*/],search:function(e){return Ve(e,"msie")||Ve(e,"trident")}},{name:"Opera",versionRegexes:[Ye,/.*?opera\/([0-9]+)\.([0-9]+).*/],search:Ge("opera")},{name:"Firefox",versionRegexes:[/.*?firefox\/\ ?([0-9]+)\.([0-9]+).*/],search:Ge("firefox")},{name:"Safari",versionRegexes:[Ye,/.*?cpu os ([0-9]+)_([0-9]+).*/],search:function(e){return(Ve(e,"safari")||Ve(e,"mobile/"))&&Ve(e,"applewebkit")}}],Qe=[{name:"Windows",search:Ge("win"),versionRegexes:[/.*?windows\ nt\ ?([0-9]+)\.([0-9]+).*/]},{name:"iOS",search:function(e){return Ve(e,"iphone")||Ve(e,"ipad")},versionRegexes:[/.*?version\/\ ?([0-9]+)\.([0-9]+).*/,/.*cpu os ([0-9]+)_([0-9]+).*/,/.*cpu iphone os ([0-9]+)_([0-9]+).*/]},{name:"Android",search:Ge("android"),versionRegexes:[/.*?android\ ?([0-9]+)\.([0-9]+).*/]},{name:"OSX",search:Ge("mac os x"),versionRegexes:[/.*?mac\ os\ x\ ?([0-9]+)_([0-9]+).*/]},{name:"Linux",search:Ge("linux"),versionRegexes:[]},{name:"Solaris",search:Ge("sunos"),versionRegexes:[]},{name:"FreeBSD",search:Ge("freebsd"),versionRegexes:[]},{name:"ChromeOS",search:Ge("cros"),versionRegexes:[/.*?chrome\/([0-9]+)\.([0-9]+).*/]}],Ze={browsers:S(Je),oses:S(Qe)},et="Firefox",tt=function(e){var t=e.current,n=e.version,r=function(e){return function(){return t===e}};return{current:t,version:n,isEdge:r("Edge"),isChrome:r("Chrome"),isIE:r("IE"),isOpera:r("Opera"),isFirefox:r(et),isSafari:r("Safari")}},nt={unknown:function(){return tt({current:undefined,version:Ue.unknown()})},nu:tt,edge:S("Edge"),chrome:S("Chrome"),ie:S("IE"),opera:S("Opera"),firefox:S(et),safari:S("Safari")},rt="Windows",ot="Android",it="Solaris",at="FreeBSD",ut="ChromeOS",st=function(e){var t=e.current,n=e.version,r=function(e){return function(){return t===e}};return{current:t,version:n,isWindows:r(rt),isiOS:r("iOS"),isAndroid:r(ot),isOSX:r("OSX"),isLinux:r("Linux"),isSolaris:r(it),isFreeBSD:r(at),isChromeOS:r(ut)}},ct={unknown:function(){return st({current:undefined,version:Ue.unknown()})},nu:st,windows:S(rt),ios:S("iOS"),android:S(ot),linux:S("Linux"),osx:S("OSX"),solaris:S(it),freebsd:S(at),chromeos:S(ut)},lt=function(e,t){var n,r,o,i,a,u,s,c,l,f,d,m,p=Ze.browsers(),g=Ze.oses(),h=je(p,e).fold(nt.unknown,nt.nu),v=He(g,e).fold(ct.unknown,ct.nu);return{browser:h,os:v,deviceType:(r=h,o=e,i=t,a=(n=v).isiOS()&&!0===/ipad/i.test(o),u=n.isiOS()&&!a,s=n.isiOS()||n.isAndroid(),c=s||i("(pointer:coarse)"),l=a||!u&&s&&i("(min-device-width:768px)"),f=u||s&&!l,d=r.isSafari()&&n.isiOS()&&!1===/safari/i.test(o),m=!f&&!l&&!d,{isiPad:S(a),isiPhone:S(u),isTablet:S(l),isPhone:S(f),isTouch:S(c),isAndroid:n.isAndroid,isiOS:n.isiOS,isWebView:S(d),isDesktop:S(m)})}},ft=function(e){return window.matchMedia(e).matches},dt=(De=!(Re=function(){return lt(navigator.userAgent,ft)}),function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];return De||(De=!0,Te=Re.apply(null,e)),Te}),mt=function(){return dt()},pt=navigator.userAgent,gt=mt(),ht=gt.browser,vt=gt.os,yt=gt.deviceType,bt=/WebKit/.test(pt)&&!ht.isEdge(),Ct="FormData"in window&&"FileReader"in window&&"URL"in window&&!!URL.createObjectURL,wt=-1!==pt.indexOf("Windows Phone"),xt={opera:ht.isOpera(),webkit:bt,ie:!(!ht.isIE()&&!ht.isEdge())&&ht.version.major,gecko:ht.isFirefox(),mac:vt.isOSX()||vt.isiOS(),iOS:yt.isiPad()||yt.isiPhone(),android:vt.isAndroid(),contentEditable:!0,transparentSrc:"data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7",caretAfter:!0,range:window.getSelection&&"Range"in window,documentMode:ht.isIE()?document.documentMode||7:10,fileApi:Ct,ceFalse:!0,cacheSuffix:null,container:null,experimentalShadowDom:!1,canHaveCSP:!ht.isIE(),desktop:yt.isDesktop(),windowsPhone:wt,browser:{current:ht.current,version:ht.version,isChrome:ht.isChrome,isEdge:ht.isEdge,isFirefox:ht.isFirefox,isIE:ht.isIE,isOpera:ht.isOpera,isSafari:ht.isSafari},os:{current:vt.current,version:vt.version,isAndroid:vt.isAndroid,isChromeOS:vt.isChromeOS,isFreeBSD:vt.isFreeBSD,isiOS:vt.isiOS,isLinux:vt.isLinux,isOSX:vt.isOSX,isSolaris:vt.isSolaris,isWindows:vt.isWindows},deviceType:{isDesktop:yt.isDesktop,isiPad:yt.isiPad,isiPhone:yt.isiPhone,isPhone:yt.isPhone,isTablet:yt.isTablet,isTouch:yt.isTouch,isWebView:yt.isWebView}},St=/^\s*|\s*$/g,Nt=function(e){return null===e||e===undefined?"":(""+e).replace(St,"")},Et=function(e,t){return t?!("array"!==t||!be(e))||typeof e===t:e!==undefined},kt=function(e,n,r,o){o=o||this,e&&(r&&(e=e[r]),Ce(e,function(e,t){return!1!==n.call(o,e,t,r)&&void kt(e,n,r,o)}))},_t={trim:Nt,isArray:be,is:Et,toArray:function(e){if(be(e))return e;for(var t=[],n=0,r=e.length;n<r;n++)t[n]=e[n];return t},makeMap:function(e,t,n){var r;for(t=t||",","string"==typeof(e=e||[])&&(e=e.split(t)),n=n||{},r=e.length;r--;)n[e[r]]={};return n},each:Ce,map:we,grep:xe,inArray:Se,hasOwn:function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},extend:function(e){for(var t=[],n=1;n<arguments.length;n++)t[n-1]=arguments[n];for(var r=0;r<t.length;r++){var o,i=t[r];for(var a in i){!i.hasOwnProperty(a)||(o=i[a])!==undefined&&(e[a]=o)}}return e},create:function(e,t,n){var r,o,i,a=this,u=0,s=(e=/^((static) )?([\w.]+)(:([\w.]+))?/.exec(e))[3].match(/(^|\.)(\w+)$/i)[2],c=a.createNS(e[3].replace(/\.\w+$/,""),n);if(!c[s]){if("static"===e[2])return c[s]=t,void(this.onCreate&&this.onCreate(e[2],e[3],c[s]));t[s]||(t[s]=te,u=1),c[s]=t[s],a.extend(c[s].prototype,t),e[5]&&(r=a.resolve(e[5]).prototype,o=e[5].match(/\.(\w+)$/i)[1],i=c[s],c[s]=u?function(){return r[o].apply(this,arguments)}:function(){return this.parent=r[o],i.apply(this,arguments)},c[s].prototype[s]=c[s],a.each(r,function(e,t){c[s].prototype[t]=r[t]}),a.each(t,function(e,t){r[t]?c[s].prototype[t]=function(){return this.parent=r[t],e.apply(this,arguments)}:t!==s&&(c[s].prototype[t]=e)})),a.each(t["static"],function(e,t){c[s][t]=e})}},walk:kt,createNS:function(e,t){var n,r;for(t=t||window,e=e.split("."),n=0;n<e.length;n++)t[r=e[n]]||(t[r]={}),t=t[r];return t},resolve:function(e,t){var n,r;for(t=t||window,n=0,r=(e=e.split(".")).length;n<r&&(t=t[e[n]]);n++);return t},explode:function(e,t){return!e||Et(e,"array")?e:we(e.split(t||","),Nt)},_addCacheSuffix:function(e){var t=xt.cacheSuffix;return t&&(e+=(-1===e.indexOf("?")?"?":"&")+t),e}},At=function(e){if(null===e||e===undefined)throw new Error("Node cannot be null or undefined");return{dom:e}},Rt={fromHtml:function(e,t){var n=(t||document).createElement("div");if(n.innerHTML=e,!n.hasChildNodes()||1<n.childNodes.length)throw console.error("HTML does not have a single root node",e),new Error("HTML must have a single root node");return At(n.childNodes[0])},fromTag:function(e,t){var n=(t||document).createElement(e);return At(n)},fromText:function(e,t){var n=(t||document).createTextNode(e);return At(n)},fromDom:At,fromPoint:function(e,t,n){return U.from(e.dom.elementFromPoint(t,n)).map(At)}},Tt=function(e,t){for(var n=[],r=function(e){return n.push(e),t(e)},o=t(e);(o=o.bind(r)).isSome(););return n},Dt=function(e,t){var n=e.dom;if(1!==n.nodeType)return!1;var r=n;if(r.matches!==undefined)return r.matches(t);if(r.msMatchesSelector!==undefined)return r.msMatchesSelector(t);if(r.webkitMatchesSelector!==undefined)return r.webkitMatchesSelector(t);if(r.mozMatchesSelector!==undefined)return r.mozMatchesSelector(t);throw new Error("Browser lacks native selectors")},Ot=function(e){return 1!==e.nodeType&&9!==e.nodeType&&11!==e.nodeType||0===e.childElementCount},Bt=function(e,t){return e.dom===t.dom},Pt=function(e,t){return n=e.dom,r=t.dom,o=n,i=r,a=Node.DOCUMENT_POSITION_CONTAINED_BY,0!=(o.compareDocumentPosition(i)&a);var n,r,o,i,a},Lt=function(e,t){return mt().browser.isIE()?Pt(e,t):(n=t,r=e.dom,o=n.dom,r!==o&&r.contains(o));var n,r,o},It=("undefined"!=typeof window||Function("return this;")(),function(e){return e.dom.nodeName.toLowerCase()}),Mt=function(e){return e.dom.nodeType},Ft=function(t){return function(e){return Mt(e)===t}},Ut=Ft(1),zt=Ft(3),jt=Ft(9),Ht=Ft(11),Vt=function(e){return Rt.fromDom(e.dom.ownerDocument)},qt=function(e){return jt(e)?e:Vt(e)},$t=function(e){return Rt.fromDom(qt(e).dom.defaultView)},Wt=function(e){return U.from(e.dom.parentNode).map(Rt.fromDom)},Kt=function(e){return U.from(e.dom.previousSibling).map(Rt.fromDom)},Xt=function(e){return U.from(e.dom.nextSibling).map(Rt.fromDom)},Yt=function(e){return Z(Tt(e,Kt))},Gt=function(e){return Tt(e,Xt)},Jt=function(e){return z(e.dom.childNodes,Rt.fromDom)},Qt=function(e,t){var n=e.dom.childNodes;return U.from(n[t]).map(Rt.fromDom)},Zt=function(e){return Qt(e,0)},en=function(e){return Qt(e,e.dom.childNodes.length-1)},tn=function(e){return Ht(e)&&V(e.dom.host)},nn=D(Element.prototype.attachShadow)&&D(Node.prototype.getRootNode),rn=S(nn),on=nn?function(e){return Rt.fromDom(e.dom.getRootNode())}:qt,an=function(e){return tn(e)?e:function(e){var t=e.dom.head;if(null===t||t===undefined)throw new Error("Head is not available yet");return Rt.fromDom(t)}(qt(e))},un=function(e){return Rt.fromDom(e.dom.host)},sn=function(e){return V(e.dom.shadowRoot)},cn=function(t,n){Wt(t).each(function(e){e.dom.insertBefore(n.dom,t.dom)})},ln=function(e,t){Xt(e).fold(function(){Wt(e).each(function(e){dn(e,t)})},function(e){cn(e,t)})},fn=function(t,n){Zt(t).fold(function(){dn(t,n)},function(e){t.dom.insertBefore(n.dom,e.dom)})},dn=function(e,t){e.dom.appendChild(t.dom)},mn=function(t,e){Y(e,function(e){dn(t,e)})},pn=function(e){e.dom.textContent="",Y(Jt(e),function(e){gn(e)})},gn=function(e){var t=e.dom;null!==t.parentNode&&t.parentNode.removeChild(t)},hn=function(e){var t,n=Jt(e);0<n.length&&(t=e,Y(n,function(e){cn(t,e)})),gn(e)},vn=function(e){var t=zt(e)?e.dom.parentNode:e.dom;if(t===undefined||null===t||null===t.ownerDocument)return!1;var n,r,o,i,a=t.ownerDocument;return o=Rt.fromDom(t),i=on(o),(tn(i)?U.some(i):U.none()).fold(function(){return a.body.contains(t)},(n=vn,r=un,function(e){return n(r(e))}))},yn=function(n,r){return{left:n,top:r,translate:function(e,t){return yn(n+e,r+t)}}},bn=yn,Cn=function(e,t){return e!==undefined?e:t!==undefined?t:0},wn=function(e){var t,n=e.dom,r=n.ownerDocument.body;return r===n?bn(r.offsetLeft,r.offsetTop):vn(e)?(t=n.getBoundingClientRect(),bn(t.left,t.top)):bn(0,0)},xn=function(e){var t=e!==undefined?e.dom:document,n=t.body.scrollLeft||t.documentElement.scrollLeft,r=t.body.scrollTop||t.documentElement.scrollTop;return bn(n,r)},Sn=function(e,t,n){var r=(n!==undefined?n.dom:document).defaultView;r&&r.scrollTo(e,t)},Nn=function(e,t){mt().browser.isSafari()&&D(e.dom.scrollIntoViewIfNeeded)?e.dom.scrollIntoViewIfNeeded(!1):e.dom.scrollIntoView(t)},En=function(e,t,n,r){return{x:e,y:t,width:n,height:r,right:e+n,bottom:t+r}},kn=function(e){var t,n,r=e===undefined?window:e,o=r.document,i=xn(Rt.fromDom(o));return n=(t=r)===undefined?window:t,U.from(n.visualViewport).fold(function(){var e=r.document.documentElement,t=e.clientWidth,n=e.clientHeight;return En(i.left,i.top,t,n)},function(e){return En(Math.max(e.pageLeft,i.left),Math.max(e.pageTop,i.top),e.width,e.height)})},_n=function(t){return function(e){return!!e&&e.nodeType===t}},An=function(e){return!!e&&!Object.getPrototypeOf(e)},Rn=_n(1),Tn=function(e){var n=e.map(function(e){return e.toLowerCase()});return function(e){if(e&&e.nodeName){var t=e.nodeName.toLowerCase();return M(n,t)}return!1}},Dn=function(r,e){var o=e.toLowerCase().split(" ");return function(e){var t;if(Rn(e))for(t=0;t<o.length;t++){var n=e.ownerDocument.defaultView.getComputedStyle(e,null);if((n?n.getPropertyValue(r):null)===o[t])return!0}return!1}},On=function(t){return function(e){return Rn(e)&&e.hasAttribute(t)}},Bn=function(e){return Rn(e)&&e.hasAttribute("data-mce-bogus")},Pn=function(e){return Rn(e)&&"TABLE"===e.tagName},Ln=function(t){return function(e){if(Rn(e)){if(e.contentEditable===t)return!0;if(e.getAttribute("data-mce-contenteditable")===t)return!0}return!1}},In=Tn(["textarea","input"]),Mn=_n(3),Fn=_n(8),Un=_n(9),zn=_n(11),jn=Tn(["br"]),Hn=Tn(["img"]),Vn=Ln("true"),qn=Ln("false"),$n=Tn(["td","th"]),Wn=Tn(["video","audio","object","embed"]),Kn=function(e){return e.style!==undefined&&D(e.style.getPropertyValue)},Xn=function(e,t,n){if(!(K(n)||R(n)||O(n)))throw console.error("Invalid call to Attribute.set. Key ",t,":: Value ",n,":: Element ",e),new Error("Attribute value was not simple");e.setAttribute(t,n+"")},Yn=function(e,t,n){Xn(e.dom,t,n)},Gn=function(e,t){var n=e.dom;se(t,function(e,t){Xn(n,t,e)})},Jn=function(e,t){var n=e.dom.getAttribute(t);return null===n?undefined:n},Qn=function(e,t){return U.from(Jn(e,t))},Zn=function(e,t){e.dom.removeAttribute(t)},er=function(e,t){var n=e.dom;se(t,function(e,t){!function(e,t,n){if(!K(n))throw console.error("Invalid call to CSS.set. Property ",t,":: Value ",n,":: Element ",e),new Error("CSS value must be a string: "+n);Kn(e)&&e.style.setProperty(t,n)}(n,t,e)})},tr=function(e,t){var n=e.dom,r=window.getComputedStyle(n).getPropertyValue(t);return""!==r||vn(e)?r:nr(n,t)},nr=function(e,t){return Kn(e)?e.style.getPropertyValue(t):""},rr=function(e,t){var n=e.dom,r=nr(n,t);return U.from(r).filter(function(e){return 0<e.length})},or=function(e){var t={},n=e.dom;if(Kn(n))for(var r=0;r<n.style.length;r++){var o=n.style.item(r);t[o]=n.style[o]}return t},ir=mt().browser,ar=function(e){return W(e,Ut)},ur=function(e,t){return e.children&&M(e.children,t)},sr=function(e,t,n){var r,o,i,a=0,u=0,s=e.ownerDocument;if(n=n||e,t){if(n===e&&t.getBoundingClientRect&&"static"===tr(Rt.fromDom(e),"position"))return{x:a=(o=t.getBoundingClientRect()).left+(s.documentElement.scrollLeft||e.scrollLeft)-s.documentElement.clientLeft,y:u=o.top+(s.documentElement.scrollTop||e.scrollTop)-s.documentElement.clientTop};for(r=t;r&&r!==n&&r.nodeType&&!ur(r,n);)a+=r.offsetLeft||0,u+=r.offsetTop||0,r=r.offsetParent;for(r=t.parentNode;r&&r!==n&&r.nodeType&&!ur(r,n);)a-=r.scrollLeft||0,u-=r.scrollTop||0,r=r.parentNode;u+=(i=Rt.fromDom(t),ir.isFirefox()&&"table"===It(i)?ar(Jt(i)).filter(function(e){return"caption"===It(e)}).bind(function(o){return ar(Gt(o)).map(function(e){var t=e.dom.offsetTop,n=o.dom.offsetTop,r=o.dom.offsetHeight;return t<=n?-r:0})}).getOr(0):0)}return{x:a,y:u}},cr={},lr={exports:cr};Oe=undefined,Be=cr,Pe=lr,Le=undefined,function(e){"object"==typeof Be&&void 0!==Pe?Pe.exports=e():"function"==typeof Oe&&Oe.amd?Oe([],e):("undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this).EphoxContactWrapper=e()}(function(){return function l(i,a,u){function s(t,e){if(!a[t]){if(!i[t]){var n="function"==typeof Le&&Le;if(!e&&n)return n(t,!0);if(c)return c(t,!0);var r=new Error("Cannot find module '"+t+"'");throw r.code="MODULE_NOT_FOUND",r}var o=a[t]={exports:{}};i[t][0].call(o.exports,function(e){return s(i[t][1][e]||e)},o,o.exports,l,i,a,u)}return a[t].exports}for(var c="function"==typeof Le&&Le,e=0;e<u.length;e++)s(u[e]);return s}({1:[function(e,t,n){var r,o,i=t.exports={};function a(){throw new Error("setTimeout has not been defined")}function u(){throw new Error("clearTimeout has not been defined")}function s(e){if(r===setTimeout)return setTimeout(e,0);if((r===a||!r)&&setTimeout)return r=setTimeout,setTimeout(e,0);try{return r(e,0)}catch(t){try{return r.call(null,e,0)}catch(t){return r.call(this,e,0)}}}!function(){try{r="function"==typeof setTimeout?setTimeout:a}catch(e){r=a}try{o="function"==typeof clearTimeout?clearTimeout:u}catch(e){o=u}}();var c,l=[],f=!1,d=-1;function m(){f&&c&&(f=!1,c.length?l=c.concat(l):d=-1,l.length&&p())}function p(){if(!f){var e=s(m);f=!0;for(var t=l.length;t;){for(c=l,l=[];++d<t;)c&&c[d].run();d=-1,t=l.length}c=null,f=!1,function(e){if(o===clearTimeout)return clearTimeout(e);if((o===u||!o)&&clearTimeout)return o=clearTimeout,clearTimeout(e);try{o(e)}catch(t){try{return o.call(null,e)}catch(t){return o.call(this,e)}}}(e)}}function g(e,t){this.fun=e,this.array=t}function h(){}i.nextTick=function(e){var t=new Array(arguments.length-1);if(1<arguments.length)for(var n=1;n<arguments.length;n++)t[n-1]=arguments[n];l.push(new g(e,t)),1!==l.length||f||s(p)},g.prototype.run=function(){this.fun.apply(null,this.array)},i.title="browser",i.browser=!0,i.env={},i.argv=[],i.version="",i.versions={},i.on=h,i.addListener=h,i.once=h,i.off=h,i.removeListener=h,i.removeAllListeners=h,i.emit=h,i.prependListener=h,i.prependOnceListener=h,i.listeners=function(e){return[]},i.binding=function(e){throw new Error("process.binding is not supported")},i.cwd=function(){return"/"},i.chdir=function(e){throw new Error("process.chdir is not supported")},i.umask=function(){return 0}},{}],2:[function(e,f,t){(function(t){function r(){}function a(e){if("object"!=typeof this)throw new TypeError("Promises must be constructed via new");if("function"!=typeof e)throw new TypeError("not a function");this._state=0,this._handled=!1,this._value=undefined,this._deferreds=[],l(e,this)}function o(r,o){for(;3===r._state;)r=r._value;0!==r._state?(r._handled=!0,a._immediateFn(function(){var e,t=1===r._state?o.onFulfilled:o.onRejected;if(null!==t){try{e=t(r._value)}catch(n){return void u(o.promise,n)}i(o.promise,e)}else(1===r._state?i:u)(o.promise,r._value)})):r._deferreds.push(o)}function i(e,t){try{if(t===e)throw new TypeError("A promise cannot be resolved with itself.");if(t&&("object"==typeof t||"function"==typeof t)){var n=t.then;if(t instanceof a)return e._state=3,e._value=t,void s(e);if("function"==typeof n)return void l((r=n,o=t,function(){r.apply(o,arguments)}),e)}e._state=1,e._value=t,s(e)}catch(i){u(e,i)}var r,o}function u(e,t){e._state=2,e._value=t,s(e)}function s(e){2===e._state&&0===e._deferreds.length&&a._immediateFn(function(){e._handled||a._unhandledRejectionFn(e._value)});for(var t=0,n=e._deferreds.length;t<n;t++)o(e,e._deferreds[t]);e._deferreds=null}function c(e,t,n){this.onFulfilled="function"==typeof e?e:null,this.onRejected="function"==typeof t?t:null,this.promise=n}function l(e,t){var n=!1;try{e(function(e){n||(n=!0,i(t,e))},function(e){n||(n=!0,u(t,e))})}catch(r){if(n)return;n=!0,u(t,r)}}var e,n;e=this,n=setTimeout,a.prototype["catch"]=function(e){return this.then(null,e)},a.prototype.then=function(e,t){var n=new this.constructor(r);return o(this,new c(e,t,n)),n},a.all=function(e){var s=Array.prototype.slice.call(e);return new a(function(o,i){if(0===s.length)return o([]);var a=s.length;for(var e=0;e<s.length;e++)!function u(t,e){try{if(e&&("object"==typeof e||"function"==typeof e)){var n=e.then;if("function"==typeof n)return void n.call(e,function(e){u(t,e)},i)}s[t]=e,0==--a&&o(s)}catch(r){i(r)}}(e,s[e])})},a.resolve=function(t){return t&&"object"==typeof t&&t.constructor===a?t:new a(function(e){e(t)})},a.reject=function(n){return new a(function(e,t){t(n)})},a.race=function(o){return new a(function(e,t){for(var n=0,r=o.length;n<r;n++)o[n].then(e,t)})},a._immediateFn="function"==typeof t?function(e){t(e)}:function(e){n(e,0)},a._unhandledRejectionFn=function(e){"undefined"!=typeof console&&console&&console.warn("Possible Unhandled Promise Rejection:",e)},a._setImmediateFn=function(e){a._immediateFn=e},a._setUnhandledRejectionFn=function(e){a._unhandledRejectionFn=e},void 0!==f&&f.exports?f.exports=a:e.Promise||(e.Promise=a)}).call(this,e("timers").setImmediate)},{timers:3}],3:[function(s,e,c){(function(e,t){var r=s("process/browser.js").nextTick,n=Function.prototype.apply,o=Array.prototype.slice,i={},a=0;function u(e,t){this._id=e,this._clearFn=t}c.setTimeout=function(){return new u(n.call(setTimeout,window,arguments),clearTimeout)},c.setInterval=function(){return new u(n.call(setInterval,window,arguments),clearInterval)},c.clearTimeout=c.clearInterval=function(e){e.close()},u.prototype.unref=u.prototype.ref=function(){},u.prototype.close=function(){this._clearFn.call(window,this._id)},c.enroll=function(e,t){clearTimeout(e._idleTimeoutId),e._idleTimeout=t},c.unenroll=function(e){clearTimeout(e._idleTimeoutId),e._idleTimeout=-1},c._unrefActive=c.active=function(e){clearTimeout(e._idleTimeoutId);var t=e._idleTimeout;0<=t&&(e._idleTimeoutId=setTimeout(function(){e._onTimeout&&e._onTimeout()},t))},c.setImmediate="function"==typeof e?e:function(e){var t=a++,n=!(arguments.length<2)&&o.call(arguments,1);return i[t]=!0,r(function(){i[t]&&(n?e.apply(null,n):e.call(null),c.clearImmediate(t))}),t},c.clearImmediate="function"==typeof t?t:function(e){delete i[e]}}).call(this,s("timers").setImmediate,s("timers").clearImmediate)},{"process/browser.js":1,timers:3}],4:[function(e,t,n){var r=e("promise-polyfill"),o="undefined"!=typeof window?window:Function("return this;")();t.exports={boltExport:o.Promise||r}},{"promise-polyfill":2}]},{},[4])(4)});var fr=lr.exports.boltExport,dr=function(e){var n=U.none(),t=[],r=function(e){o()?a(e):t.push(e)},o=function(){return n.isSome()},i=function(e){Y(e,a)},a=function(t){n.each(function(e){setTimeout(function(){t(e)},0)})};return e(function(e){o()||(n=U.some(e),i(t),t=[])}),{get:r,map:function(n){return dr(function(t){r(function(e){t(n(e))})})},isReady:o}},mr={nu:dr,pure:function(t){return dr(function(e){e(t)})}},pr=function(e){setTimeout(function(){throw e},0)},gr=function(n){var e=function(e){n().then(e,pr)};return{map:function(e){return gr(function(){return n().then(e)})},bind:function(t){return gr(function(){return n().then(function(e){return t(e).toPromise()})})},anonBind:function(e){return gr(function(){return n().then(function(){return e.toPromise()})})},toLazy:function(){return mr.nu(e)},toCached:function(){var e=null;return gr(function(){return null===e&&(e=n()),e})},toPromise:n,get:e}},hr=function(e){return gr(function(){return new fr(e)})},vr=function(a,e){return e(function(r){var o=[],i=0;0===a.length?r([]):Y(a,function(e,t){var n;e.get((n=t,function(e){o[n]=e,++i>=a.length&&r(o)}))})})},yr=function(n){return{is:function(e){return n===e},isValue:w,isError:b,getOr:S(n),getOrThunk:S(n),getOrDie:S(n),or:function(e){return yr(n)},orThunk:function(e){return yr(n)},fold:function(e,t){return t(n)},map:function(e){return yr(e(n))},mapError:function(e){return yr(n)},each:function(e){e(n)},bind:function(e){return e(n)},exists:function(e){return e(n)},forall:function(e){return e(n)},toOptional:function(){return U.some(n)}}},br=function(n){return{is:b,isValue:b,isError:w,getOr:o,getOrThunk:function(e){return e()},getOrDie:function(){return m(String(n))()},or:function(e){return e},orThunk:function(e){return e()},fold:function(e,t){return e(n)},map:function(e){return br(n)},mapError:function(e){return br(e(n))},each:te,bind:function(e){return br(n)},exists:b,forall:w,toOptional:U.none}},Cr={value:yr,error:br,fromOption:function(e,t){return e.fold(function(){return br(t)},yr)}},wr=function(a){if(!_(a))throw new Error("cases must be an array");if(0===a.length)throw new Error("there must be at least one case");var u=[],n={};return Y(a,function(e,r){var t=ae(e);if(1!==t.length)throw new Error("one and only one name per case");var o=t[0],i=e[o];if(n[o]!==undefined)throw new Error("duplicate key detected:"+o);if("cata"===o)throw new Error("cannot have a case named cata (sorry)");if(!_(i))throw new Error("case arguments must be an array");u.push(o),n[o]=function(){for(var n=[],e=0;e<arguments.length;e++)n[e]=arguments[e];var t=n.length;if(t!==i.length)throw new Error("Wrong number of arguments to case "+o+". Expected "+i.length+" ("+i+"), got "+t);return{fold:function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];if(e.length!==a.length)throw new Error("Wrong number of arguments to fold. Expected "+a.length+", got "+e.length);return e[r].apply(null,n)},match:function(e){var t=ae(e);if(u.length!==t.length)throw new Error("Wrong number of arguments to match. Expected: "+u.join(",")+"\nActual: "+t.join(","));if(!Q(u,function(e){return M(t,e)}))throw new Error("Not all branches were specified when using match. Specified: "+t.join(", ")+"\nRequired: "+u.join(", "));return e[o].apply(null,n)},log:function(e){console.log(e,{constructors:u,constructor:o,params:n})}}}}),n},xr=(wr([{bothErrors:["error1","error2"]},{firstError:["error1","value2"]},{secondError:["value1","error2"]},{bothValues:["value1","value2"]}]),function(e){return e.fold(o,o)});function Sr(e,t,n,r,o){return e(n,r)?U.some(n):D(o)&&o(n)?U.none():t(n,r,o)}var Nr,Er,kr,_r,Ar,Rr,Tr=function(e,t,n){for(var r=e.dom,o=D(n)?n:b;r.parentNode;){r=r.parentNode;var i=Rt.fromDom(r);if(t(i))return U.some(i);if(o(i))break}return U.none()},Dr=function(e,t,n){return Sr(function(e,t){return t(e)},Tr,e,t,n)},Or=function(e,t){return W(e.dom.childNodes,function(e){return t(Rt.fromDom(e))}).map(Rt.fromDom)},Br=function(e,t,n){return Tr(e,function(e){return Dt(e,t)},n)},Pr=function(e,t){return n=t,o=(r=e)===undefined?document:r.dom,Ot(o)?U.none():U.from(o.querySelector(n)).map(Rt.fromDom);var n,r,o},Lr=function(e,t,n){return Sr(Dt,Br,e,t,n)},Ir=window.Promise?window.Promise:(Nr=function(n,r){return function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];n.apply(r,e)}},Er=Array.isArray||function(e){return"[object Array]"===Object.prototype.toString.call(e)},_r=(kr=function(e){if("object"!=typeof this)throw new TypeError("Promises must be constructed via new");if("function"!=typeof e)throw new TypeError("not a function");this._state=null,this._value=null,this._deferreds=[],Ar(e,Nr(Fr,this),Nr(Ur,this))}).immediateFn||"function"==typeof setImmediate&&setImmediate||function(e){return setTimeout(e,1)},Ar=function(e,t,n){var r=!1;try{e(function(e){r||(r=!0,t(e))},function(e){r||(r=!0,n(e))})}catch(o){if(r)return;r=!0,n(o)}},kr.prototype["catch"]=function(e){return this.then(null,e)},kr.prototype.then=function(n,r){var o=this;return new kr(function(e,t){Mr.call(o,new jr(n,r,e,t))})},kr.all=function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];var s=Array.prototype.slice.call(1===e.length&&Er(e[0])?e[0]:e);return new kr(function(o,i){if(0===s.length)return o([]);for(var a=s.length,u=function(t,e){try{if(e&&("object"==typeof e||"function"==typeof e)){var n=e.then;if("function"==typeof n)return void n.call(e,function(e){u(t,e)},i)}s[t]=e,0==--a&&o(s)}catch(r){i(r)}},e=0;e<s.length;e++)u(e,s[e])})},kr.resolve=function(t){return t&&"object"==typeof t&&t.constructor===kr?t:new kr(function(e){e(t)})},kr.reject=function(n){return new kr(function(e,t){t(n)})},kr.race=function(o){return new kr(function(e,t){for(var n=0,r=o.length;n<r;n++)o[n].then(e,t)})},kr);function Mr(r){var o=this;null!==this._state?_r(function(){var e,t=o._state?r.onFulfilled:r.onRejected;if(null!==t){try{e=t(o._value)}catch(n){return void r.reject(n)}r.resolve(e)}else(o._state?r.resolve:r.reject)(o._value)}):this._deferreds.push(r)}function Fr(e){try{if(e===this)throw new TypeError("A promise cannot be resolved with itself.");if(e&&("object"==typeof e||"function"==typeof e)){var t=e.then;if("function"==typeof t)return void Ar(Nr(t,e),Nr(Fr,this),Nr(Ur,this))}this._state=!0,this._value=e,zr.call(this)}catch(n){Ur.call(this,n)}}function Ur(e){this._state=!1,this._value=e,zr.call(this)}function zr(){for(var e=0,t=this._deferreds.length;e<t;e++)Mr.call(this,this._deferreds[e]);this._deferreds=null}function jr(e,t,n,r){this.onFulfilled="function"==typeof e?e:null,this.onRejected="function"==typeof t?t:null,this.resolve=n,this.reject=r}var Hr,Vr=function(e,t){return"number"!=typeof t&&(t=0),setTimeout(e,t)},qr=function(e,t){return"number"!=typeof t&&(t=1),setInterval(e,t)},$r=function(n,r){var o,e=function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];clearTimeout(o),o=Vr(function(){n.apply(this,e)},r)};return e.stop=function(){clearTimeout(o)},e},Wr={requestAnimationFrame:function(e,t){Rr?Rr.then(e):Rr=new Ir(function(e){!function(e,t){for(var n=window.requestAnimationFrame,r=["ms","moz","webkit"],o=0;o<r.length&&!n;o++)n=window[r[o]+"RequestAnimationFrame"];(n=n||function(e){window.setTimeout(e,0)})(e,t)}(e,t=t||document.body)}).then(e)},setTimeout:Vr,setInterval:qr,setEditorTimeout:function(e,t,n){return Vr(function(){e.removed||t()},n)},setEditorInterval:function(e,t,n){var r=qr(function(){e.removed?clearInterval(r):t()},n);return r},debounce:$r,throttle:$r,clearInterval:function(e){return clearInterval(e)},clearTimeout:function(e){return clearTimeout(e)}},Kr=function(m,p){void 0===p&&(p={});var g=0,h={},v=Rt.fromDom(m),y=qt(v),b=p.maxLoadTime||5e3,n=function(e,t,n){var r,o=_t._addCacheSuffix(e),i=he(h,o).getOrThunk(function(){return{id:"mce-u"+g++,passed:[],failed:[],count:0}});(h[o]=i).count++;var a,u,s,c=function(e,t){for(var n=e.length;n--;)e[n]();i.status=t,i.passed=[],i.failed=[],r&&(r.onload=null,r.onerror=null,r=null)},l=function(){return c(i.passed,2)},f=function(){return c(i.failed,3)},d=function(){var e;e=d,function(){for(var e=m.styleSheets,t=e.length;t--;){var n=e[t].ownerNode;if(n&&n.id===r.id)return l(),1}}()||(Date.now()-u<b?Wr.setTimeout(e):f())};t&&i.passed.push(t),n&&i.failed.push(n),1!==i.status&&(2!==i.status?3!==i.status?(i.status=1,a=Rt.fromTag("link",y.dom),Gn(a,{rel:"stylesheet",type:"text/css",id:i.id}),u=Date.now(),p.contentCssCors&&Yn(a,"crossOrigin","anonymous"),p.referrerPolicy&&Yn(a,"referrerpolicy",p.referrerPolicy),(r=a.dom).onload=d,r.onerror=f,s=a,dn(an(v),s),Yn(a,"href",o)):f():l())},o=function(t){return hr(function(e){n(t,a(e,S(Cr.value(t))),a(e,S(Cr.error(t))))})},t=function(e){var r=_t._addCacheSuffix(e);he(h,r).each(function(e){var t,n;0==--e.count&&(delete h[r],t=e.id,n=an(v),Pr(n,"#"+t).each(gn))})};return{load:n,loadAll:function(e,n,r){var t;t=z(e,o),vr(t,hr).get(function(e){var t=function(e,t){for(var n=[],r=[],o=0,i=e.length;o<i;o++){var a=e[o];(t(a,o)?n:r).push(a)}return{pass:n,fail:r}}(e,function(e){return e.isValue()});0<t.fail.length?r(t.fail.map(xr)):n(t.pass.map(xr))})},unload:t,unloadAll:function(e){Y(e,function(e){t(e)})},_setReferrerPolicy:function(e){p.referrerPolicy=e}}},Xr=(Hr=new WeakMap,{forElement:function(e,t){var n=on(e).dom;return U.from(Hr.get(n)).getOrThunk(function(){var e=Kr(n,t);return Hr.set(n,e),e})}}),Yr=(Gr.prototype.current=function(){return this.node},Gr.prototype.next=function(e){return this.node=this.findSibling(this.node,"firstChild","nextSibling",e),this.node},Gr.prototype.prev=function(e){return this.node=this.findSibling(this.node,"lastChild","previousSibling",e),this.node},Gr.prototype.prev2=function(e){return this.node=this.findPreviousNode(this.node,"lastChild","previousSibling",e),this.node},Gr.prototype.findSibling=function(e,t,n,r){var o,i;if(e){if(!r&&e[t])return e[t];if(e!==this.rootNode){if(o=e[n])return o;for(i=e.parentNode;i&&i!==this.rootNode;i=i.parentNode)if(o=i[n])return o}}},Gr.prototype.findPreviousNode=function(e,t,n,r){var o,i,a;if(e){if(o=e[n],this.rootNode&&o===this.rootNode)return;if(o){if(!r)for(a=o[t];a;a=a[t])if(!a[t])return a;return o}if((i=e.parentNode)&&i!==this.rootNode)return i}},Gr);function Gr(e,t){this.node=e,this.rootNode=t,this.current=this.current.bind(this),this.next=this.next.bind(this),this.prev=this.prev.bind(this),this.prev2=this.prev2.bind(this)}var Jr,Qr,Zr=function(t){var n;return function(e){return(n=n||function(e,t){for(var n={},r=0,o=e.length;r<o;r++){var i=e[r];n[String(i)]=t(i,r)}return n}(t,w)).hasOwnProperty(It(e))}},eo=Zr(["h1","h2","h3","h4","h5","h6"]),to=Zr(["article","aside","details","div","dt","figcaption","footer","form","fieldset","header","hgroup","html","main","nav","section","summary","body","p","dl","multicol","dd","figure","address","center","blockquote","h1","h2","h3","h4","h5","h6","listing","xmp","pre","plaintext","menu","dir","ul","ol","li","hr","table","tbody","thead","tfoot","th","tr","td","caption"]),no=function(e){return Ut(e)&&!to(e)},ro=function(e){return Ut(e)&&"br"===It(e)},oo=Zr(["h1","h2","h3","h4","h5","h6","p","div","address","pre","form","blockquote","center","dir","fieldset","header","footer","article","section","hgroup","aside","nav","figure"]),io=Zr(["ul","ol","dl"]),ao=Zr(["li","dd","dt"]),uo=Zr(["thead","tbody","tfoot"]),so=Zr(["td","th"]),co=Zr(["pre","script","textarea","style"]),lo="\ufeff",fo="\xa0",mo=lo,po=function(e){return e===lo},go=function(e){return e.replace(/\uFEFF/g,"")},ho=Rn,vo=Mn,yo=function(e){return vo(e)&&(e=e.parentNode),ho(e)&&e.hasAttribute("data-mce-caret")},bo=function(e){return vo(e)&&po(e.data)},Co=function(e){return yo(e)||bo(e)},wo=function(e){return e.firstChild!==e.lastChild||!jn(e.firstChild)},xo=function(e){var t=e.container();return!!Mn(t)&&(t.data.charAt(e.offset())===mo||e.isAtStart()&&bo(t.previousSibling))},So=function(e){var t=e.container();return!!Mn(t)&&(t.data.charAt(e.offset()-1)===mo||e.isAtEnd()&&bo(t.nextSibling))},No=function(e,t,n){var r,o=t.ownerDocument.createElement(e);o.setAttribute("data-mce-caret",n?"before":"after"),o.setAttribute("data-mce-bogus","all"),o.appendChild(((r=document.createElement("br")).setAttribute("data-mce-bogus","1"),r));var i=t.parentNode;return n?i.insertBefore(o,t):t.nextSibling?i.insertBefore(o,t.nextSibling):i.appendChild(o),o},Eo=function(e){return vo(e)&&e.data[0]===mo},ko=function(e){return vo(e)&&e.data[e.data.length-1]===mo},_o=function(e){return e&&e.hasAttribute("data-mce-caret")?(t=e.getElementsByTagName("br"),n=t[t.length-1],Bn(n)&&n.parentNode.removeChild(n),e.removeAttribute("data-mce-caret"),e.removeAttribute("data-mce-bogus"),e.removeAttribute("style"),e.removeAttribute("_moz_abspos"),e):null;var t,n},Ao=Vn,Ro=qn,To=jn,Do=Mn,Oo=Tn(["script","style","textarea"]),Bo=Tn(["img","input","textarea","hr","iframe","video","audio","object","embed"]),Po=Tn(["table"]),Lo=Co,Io=function(e){return!Lo(e)&&(Do(e)?!Oo(e.parentNode):Bo(e)||To(e)||Po(e)||Mo(e))},Mo=function(e){return!1===(Rn(t=e)&&"true"===t.getAttribute("unselectable"))&&Ro(e);var t},Fo=function(e,t){return Io(e)&&function(e,t){for(e=e.parentNode;e&&e!==t;e=e.parentNode){if(Mo(e))return!1;if(Ao(e))return!0}return!0}(e,t)},Uo=/^[ \t\r\n]*$/,zo=function(e){return Uo.test(e)},jo=function(e,t){var n,r,o,i=Rt.fromDom(t),a=Rt.fromDom(e);return n=a,r="pre,code",o=N(Bt,i),Br(n,r,o).isSome()},Ho=function(e,t){return Io(e)&&!1===(o=t,Mn(r=e)&&zo(r.data)&&!1===jo(r,o))||Rn(n=e)&&"A"===n.nodeName&&!n.hasAttribute("href")&&(n.hasAttribute("name")||n.hasAttribute("id"))||Vo(e);var n,r,o},Vo=On("data-mce-bookmark"),qo=On("data-mce-bogus"),$o=(Jr="data-mce-bogus",Qr="all",function(e){return Rn(e)&&e.getAttribute(Jr)===Qr}),Wo=function(e,t){return void 0===t&&(t=!0),function(e,t){var n,r=0;if(Ho(e,e))return!1;if(!(n=e.firstChild))return!0;var o=new Yr(n,e);do{if(t){if($o(n)){n=o.next(!0);continue}if(qo(n)){n=o.next();continue}}if(jn(n))r++,n=o.next();else{if(Ho(n,e))return!1;n=o.next()}}while(n);return r<=1}(e.dom,t)},Ko=function(e,t){return V(e)&&(Ho(e,t)||no(Rt.fromDom(e)))},Xo=function(e){return"span"===e.nodeName.toLowerCase()&&"bookmark"===e.getAttribute("data-mce-type")},Yo=function(e,t){return Mn(e)&&0<e.data.length&&(o=new Yr(n=e,r=t).prev(!1),i=new Yr(n,r).next(!1),a=T(o)||Ko(o,r),u=T(i)||Ko(i,r),a&&u);var n,r,o,i,a,u},Go=function(e,t,n){var r=n||t;if(Rn(t)&&Xo(t))return t;for(var o,i,a,u=t.childNodes,s=u.length-1;0<=s;s--)Go(e,u[s],r);return!Rn(t)||1===(o=t.childNodes).length&&Xo(o[0])&&t.parentNode.insertBefore(o[0],t),zn(a=t)||Un(a)||Ho(t,r)||Rn(i=t)&&0<i.childNodes.length||Yo(t,r)||e.remove(t),t},Jo=_t.makeMap,Qo=/[&<>\"\u0060\u007E-\uD7FF\uE000-\uFFEF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g,Zo=/[<>&\u007E-\uD7FF\uE000-\uFFEF]|[\uD800-\uDBFF][\uDC00-\uDFFF]/g,ei=/[<>&\"\']/g,ti=/&#([a-z0-9]+);?|&([a-z0-9]+);/gi,ni={128:"\u20ac",130:"\u201a",131:"\u0192",132:"\u201e",133:"\u2026",134:"\u2020",135:"\u2021",136:"\u02c6",137:"\u2030",138:"\u0160",139:"\u2039",140:"\u0152",142:"\u017d",145:"\u2018",146:"\u2019",147:"\u201c",148:"\u201d",149:"\u2022",150:"\u2013",151:"\u2014",152:"\u02dc",153:"\u2122",154:"\u0161",155:"\u203a",156:"\u0153",158:"\u017e",159:"\u0178"},ri={'"':"&quot;","'":"&#39;","<":"&lt;",">":"&gt;","&":"&amp;","`":"&#96;"},oi={"&lt;":"<","&gt;":">","&amp;":"&","&quot;":'"',"&apos;":"'"},ii=function(e,t){var n,r,o,i={};if(e){for(e=e.split(","),t=t||10,n=0;n<e.length;n+=2)r=String.fromCharCode(parseInt(e[n],t)),ri[r]||(o="&"+e[n+1]+";",i[r]=o,i[o]=r);return i}},ai=ii("50,nbsp,51,iexcl,52,cent,53,pound,54,curren,55,yen,56,brvbar,57,sect,58,uml,59,copy,5a,ordf,5b,laquo,5c,not,5d,shy,5e,reg,5f,macr,5g,deg,5h,plusmn,5i,sup2,5j,sup3,5k,acute,5l,micro,5m,para,5n,middot,5o,cedil,5p,sup1,5q,ordm,5r,raquo,5s,frac14,5t,frac12,5u,frac34,5v,iquest,60,Agrave,61,Aacute,62,Acirc,63,Atilde,64,Auml,65,Aring,66,AElig,67,Ccedil,68,Egrave,69,Eacute,6a,Ecirc,6b,Euml,6c,Igrave,6d,Iacute,6e,Icirc,6f,Iuml,6g,ETH,6h,Ntilde,6i,Ograve,6j,Oacute,6k,Ocirc,6l,Otilde,6m,Ouml,6n,times,6o,Oslash,6p,Ugrave,6q,Uacute,6r,Ucirc,6s,Uuml,6t,Yacute,6u,THORN,6v,szlig,70,agrave,71,aacute,72,acirc,73,atilde,74,auml,75,aring,76,aelig,77,ccedil,78,egrave,79,eacute,7a,ecirc,7b,euml,7c,igrave,7d,iacute,7e,icirc,7f,iuml,7g,eth,7h,ntilde,7i,ograve,7j,oacute,7k,ocirc,7l,otilde,7m,ouml,7n,divide,7o,oslash,7p,ugrave,7q,uacute,7r,ucirc,7s,uuml,7t,yacute,7u,thorn,7v,yuml,ci,fnof,sh,Alpha,si,Beta,sj,Gamma,sk,Delta,sl,Epsilon,sm,Zeta,sn,Eta,so,Theta,sp,Iota,sq,Kappa,sr,Lambda,ss,Mu,st,Nu,su,Xi,sv,Omicron,t0,Pi,t1,Rho,t3,Sigma,t4,Tau,t5,Upsilon,t6,Phi,t7,Chi,t8,Psi,t9,Omega,th,alpha,ti,beta,tj,gamma,tk,delta,tl,epsilon,tm,zeta,tn,eta,to,theta,tp,iota,tq,kappa,tr,lambda,ts,mu,tt,nu,tu,xi,tv,omicron,u0,pi,u1,rho,u2,sigmaf,u3,sigma,u4,tau,u5,upsilon,u6,phi,u7,chi,u8,psi,u9,omega,uh,thetasym,ui,upsih,um,piv,812,bull,816,hellip,81i,prime,81j,Prime,81u,oline,824,frasl,88o,weierp,88h,image,88s,real,892,trade,89l,alefsym,8cg,larr,8ch,uarr,8ci,rarr,8cj,darr,8ck,harr,8dl,crarr,8eg,lArr,8eh,uArr,8ei,rArr,8ej,dArr,8ek,hArr,8g0,forall,8g2,part,8g3,exist,8g5,empty,8g7,nabla,8g8,isin,8g9,notin,8gb,ni,8gf,prod,8gh,sum,8gi,minus,8gn,lowast,8gq,radic,8gt,prop,8gu,infin,8h0,ang,8h7,and,8h8,or,8h9,cap,8ha,cup,8hb,int,8hk,there4,8hs,sim,8i5,cong,8i8,asymp,8j0,ne,8j1,equiv,8j4,le,8j5,ge,8k2,sub,8k3,sup,8k4,nsub,8k6,sube,8k7,supe,8kl,oplus,8kn,otimes,8l5,perp,8m5,sdot,8o8,lceil,8o9,rceil,8oa,lfloor,8ob,rfloor,8p9,lang,8pa,rang,9ea,loz,9j0,spades,9j3,clubs,9j5,hearts,9j6,diams,ai,OElig,aj,oelig,b0,Scaron,b1,scaron,bo,Yuml,m6,circ,ms,tilde,802,ensp,803,emsp,809,thinsp,80c,zwnj,80d,zwj,80e,lrm,80f,rlm,80j,ndash,80k,mdash,80o,lsquo,80p,rsquo,80q,sbquo,80s,ldquo,80t,rdquo,80u,bdquo,810,dagger,811,Dagger,81g,permil,81p,lsaquo,81q,rsaquo,85c,euro",32),ui=function(e,t){return e.replace(t?Qo:Zo,function(e){return ri[e]||e})},si=function(e,t){return e.replace(t?Qo:Zo,function(e){return 1<e.length?"&#"+(1024*(e.charCodeAt(0)-55296)+(e.charCodeAt(1)-56320)+65536)+";":ri[e]||"&#"+e.charCodeAt(0)+";"})},ci=function(e,t,n){return n=n||ai,e.replace(t?Qo:Zo,function(e){return ri[e]||n[e]||e})},li={encodeRaw:ui,encodeAllRaw:function(e){return(""+e).replace(ei,function(e){return ri[e]||e})},encodeNumeric:si,encodeNamed:ci,getEncodeFunc:function(e,t){var n=ii(t)||ai,r=Jo(e.replace(/\+/g,","));return r.named&&r.numeric?function(e,t){return e.replace(t?Qo:Zo,function(e){return ri[e]!==undefined?ri[e]:n[e]!==undefined?n[e]:1<e.length?"&#"+(1024*(e.charCodeAt(0)-55296)+(e.charCodeAt(1)-56320)+65536)+";":"&#"+e.charCodeAt(0)+";"})}:r.named?t?function(e,t){return ci(e,t,n)}:ci:r.numeric?si:ui},decode:function(e){return e.replace(ti,function(e,t){return t?65535<(t="x"===t.charAt(0).toLowerCase()?parseInt(t.substr(1),16):parseInt(t,10))?(t-=65536,String.fromCharCode(55296+(t>>10),56320+(1023&t))):ni[t]||String.fromCharCode(t):oi[e]||ai[e]||(n=e,(r=Rt.fromTag("div").dom).innerHTML=n,r.textContent||r.innerText||n);var n,r})}},fi={},di={},mi=_t.makeMap,pi=_t.each,gi=_t.extend,hi=_t.explode,vi=_t.inArray,yi=function(e,t){return(e=_t.trim(e))?e.split(t||" "):[]},bi=function(e,n){var r;return e&&(r={},"string"==typeof e&&(e={"*":e}),pi(e,function(e,t){r[t]=r[t.toUpperCase()]=("map"===n?mi:hi)(e,/[, ]/)})),r},Ci=function(i){var e,s,t,n,r,o,a,c,u,l,S={},f={},N=[],d={},m={},p=function(e,t,n){var r=i[e];return r?r=mi(r,/[, ]/,mi(r.toUpperCase(),/[, ]/)):(r=fi[e])||(r=mi(t," ",mi(t.toUpperCase()," ")),r=gi(r,n),fi[e]=r),r},g=(e=(i=i||{}).schema,c={},u=function(e,t,n){var r,o,i=function(e,t){for(var n={},r=0,o=e.length;r<o;r++)n[e[r]]=t||{};return n};t=t||"","string"==typeof(n=n||[])&&(n=yi(n));for(var a=yi(e),u=a.length;u--;)o={attributes:i(r=yi([s,t].join(" "))),attributesOrder:r,children:i(n,di)},c[a[u]]=o},l=function(e,t){for(var n,r,o,i=yi(e),a=i.length,u=yi(t);a--;)for(n=c[i[a]],r=0,o=u.length;r<o;r++)n.attributes[u[r]]={},n.attributesOrder.push(u[r])},fi[e]?fi[e]:(s="id accesskey class dir lang style tabindex title role",t="address blockquote div dl fieldset form h1 h2 h3 h4 h5 h6 hr menu ol p pre table ul",n="a abbr b bdo br button cite code del dfn em embed i iframe img input ins kbd label map noscript object q s samp script select small span strong sub sup textarea u var #text #comment","html4"!==e&&(s+=" contenteditable contextmenu draggable dropzone hidden spellcheck translate",t+=" article aside details dialog figure main header footer hgroup section nav",n+=" audio canvas command datalist mark meter output picture progress time wbr video ruby bdi keygen"),"html5-strict"!==e&&(s+=" xml:lang",n=[n,a="acronym applet basefont big font strike tt"].join(" "),pi(yi(a),function(e){u(e,"",n)}),t=[t,o="center dir isindex noframes"].join(" "),r=[t,n].join(" "),pi(yi(o),function(e){u(e,"",r)})),r=r||[t,n].join(" "),u("html","manifest","head body"),u("head","","base command link meta noscript script style title"),u("title hr noscript br"),u("base","href target"),u("link","href rel media hreflang type sizes hreflang"),u("meta","name http-equiv content charset"),u("style","media type scoped"),u("script","src async defer type charset"),u("body","onafterprint onbeforeprint onbeforeunload onblur onerror onfocus onhashchange onload onmessage onoffline ononline onpagehide onpageshow onpopstate onresize onscroll onstorage onunload",r),u("address dt dd div caption","",r),u("h1 h2 h3 h4 h5 h6 pre p abbr code var samp kbd sub sup i b u bdo span legend em strong small s cite dfn","",n),u("blockquote","cite",r),u("ol","reversed start type","li"),u("ul","","li"),u("li","value",r),u("dl","","dt dd"),u("a","href target rel media hreflang type",n),u("q","cite",n),u("ins del","cite datetime",r),u("img","src sizes srcset alt usemap ismap width height"),u("iframe","src name width height",r),u("embed","src type width height"),u("object","data type typemustmatch name usemap form width height",[r,"param"].join(" ")),u("param","name value"),u("map","name",[r,"area"].join(" ")),u("area","alt coords shape href target rel media hreflang type"),u("table","border","caption colgroup thead tfoot tbody tr"+("html4"===e?" col":"")),u("colgroup","span","col"),u("col","span"),u("tbody thead tfoot","","tr"),u("tr","","td th"),u("td","colspan rowspan headers",r),u("th","colspan rowspan headers scope abbr",r),u("form","accept-charset action autocomplete enctype method name novalidate target",r),u("fieldset","disabled form name",[r,"legend"].join(" ")),u("label","form for",n),u("input","accept alt autocomplete checked dirname disabled form formaction formenctype formmethod formnovalidate formtarget height list max maxlength min multiple name pattern readonly required size src step type value width"),u("button","disabled form formaction formenctype formmethod formnovalidate formtarget name type value","html4"===e?r:n),u("select","disabled form multiple name required size","option optgroup"),u("optgroup","disabled label","option"),u("option","disabled label selected value"),u("textarea","cols dirname disabled form maxlength name readonly required rows wrap"),u("menu","type label",[r,"li"].join(" ")),u("noscript","",r),"html4"!==e&&(u("wbr"),u("ruby","",[n,"rt rp"].join(" ")),u("figcaption","",r),u("mark rt rp summary bdi","",n),u("canvas","width height",r),u("video","src crossorigin poster preload autoplay mediagroup loop muted controls width height buffered",[r,"track source"].join(" ")),u("audio","src crossorigin preload autoplay mediagroup loop muted controls buffered volume",[r,"track source"].join(" ")),u("picture","","img source"),u("source","src srcset type media sizes"),u("track","kind src srclang label default"),u("datalist","",[n,"option"].join(" ")),u("article section nav aside main header footer","",r),u("hgroup","","h1 h2 h3 h4 h5 h6"),u("figure","",[r,"figcaption"].join(" ")),u("time","datetime",n),u("dialog","open",r),u("command","type label icon disabled checked radiogroup command"),u("output","for form name",n),u("progress","value max",n),u("meter","value min max low high optimum",n),u("details","open",[r,"summary"].join(" ")),u("keygen","autofocus challenge disabled form keytype name")),"html5-strict"!==e&&(l("script","language xml:space"),l("style","xml:space"),l("object","declare classid code codebase codetype archive standby align border hspace vspace"),l("embed","align name hspace vspace"),l("param","valuetype type"),l("a","charset name rev shape coords"),l("br","clear"),l("applet","codebase archive code object alt name width height align hspace vspace"),l("img","name longdesc align border hspace vspace"),l("iframe","longdesc frameborder marginwidth marginheight scrolling align"),l("font basefont","size color face"),l("input","usemap align"),l("select"),l("textarea"),l("h1 h2 h3 h4 h5 h6 div p legend caption","align"),l("ul","type compact"),l("li","type"),l("ol dl menu dir","compact"),l("pre","width xml:space"),l("hr","align noshade size width"),l("isindex","prompt"),l("table","summary width frame rules cellspacing cellpadding align bgcolor"),l("col","width align char charoff valign"),l("colgroup","width align char charoff valign"),l("thead","align char charoff valign"),l("tr","align char charoff valign bgcolor"),l("th","axis align char charoff valign nowrap bgcolor width height"),l("form","accept"),l("td","abbr axis scope align char charoff valign nowrap bgcolor width height"),l("tfoot","align char charoff valign"),l("tbody","align char charoff valign"),l("area","nohref"),l("body","background bgcolor text link vlink alink")),"html4"!==e&&(l("input button select textarea","autofocus"),l("input textarea","placeholder"),l("a","download"),l("link script img","crossorigin"),l("img","loading"),l("iframe","sandbox seamless allowfullscreen loading")),pi(yi("a form meter progress dfn"),function(e){c[e]&&delete c[e].children[e]}),delete c.caption.children.table,delete c.script,fi[e]=c));!1===i.verify_html&&(i.valid_elements="*[*]");var h=bi(i.valid_styles),v=bi(i.invalid_styles,"map"),y=bi(i.valid_classes,"map"),b=p("whitespace_elements","pre script noscript style textarea video audio iframe object code"),C=p("self_closing_elements","colgroup dd dt li option p td tfoot th thead tr"),w=p("short_ended_elements","area base basefont br col frame hr img input isindex link meta param embed source wbr track"),x=p("boolean_attributes","checked compact declare defer disabled ismap multiple nohref noresize noshade nowrap readonly selected autoplay loop controls"),E="td th iframe video audio object script code",k=p("non_empty_elements",E+" pre",w),_=p("move_caret_before_on_enter_elements",E+" table",w),A=p("text_block_elements","h1 h2 h3 h4 h5 h6 p div address pre form blockquote center dir fieldset header footer article section hgroup aside main nav figure"),R=p("block_elements","hr table tbody thead tfoot th tr td li ol ul caption dl dt dd noscript menu isindex option datalist select optgroup figcaption details summary",A),T=p("text_inline_elements","span strong b em i font strike u var cite dfn code mark q sup sub samp");pi((i.special||"script noscript iframe noframes noembed title style textarea xmp").split(" "),function(e){m[e]=new RegExp("</"+e+"[^>]*>","gi")});var D=function(e){return new RegExp("^"+e.replace(/([?+*])/g,".$1")+"$")},O=function(e){var t,n,r,o,i,a,u,s,c,l,f,d,m,p,g,h,v,y,b=/^([#+\-])?([^\[!\/]+)(?:\/([^\[!]+))?(?:(!?)\[([^\]]+)])?$/,C=/^([!\-])?(\w+[\\:]:\w+|[^=:<]+)?(?:([=:<])(.*))?$/,w=/[*?+]/;if(e){var x=yi(e,",");for(S["@"]&&(h=S["@"].attributes,v=S["@"].attributesOrder),t=0,n=x.length;t<n;t++)if(i=b.exec(x[t])){if(p=i[1],c=i[2],g=i[3],s=i[5],a={attributes:d={},attributesOrder:m=[]},"#"===p&&(a.paddEmpty=!0),"-"===p&&(a.removeEmpty=!0),"!"===i[4]&&(a.removeEmptyAttrs=!0),h&&(se(h,function(e,t){d[t]=e}),m.push.apply(m,v)),s)for(r=0,o=(s=yi(s,"|")).length;r<o;r++)if(i=C.exec(s[r])){if(u={},f=i[1],l=i[2].replace(/[\\:]:/g,":"),p=i[3],y=i[4],"!"===f&&(a.attributesRequired=a.attributesRequired||[],a.attributesRequired.push(l),u.required=!0),"-"===f){delete d[l],m.splice(vi(m,l),1);continue}p&&("="===p&&(a.attributesDefault=a.attributesDefault||[],a.attributesDefault.push({name:l,value:y}),u.defaultValue=y),":"===p&&(a.attributesForced=a.attributesForced||[],a.attributesForced.push({name:l,value:y}),u.forcedValue=y),"<"===p&&(u.validValues=mi(y,"?"))),w.test(l)?(a.attributePatterns=a.attributePatterns||[],u.pattern=D(l),a.attributePatterns.push(u)):(d[l]||m.push(l),d[l]=u)}h||"@"!==c||(h=d,v=m),g&&(a.outputName=c,S[g]=a),w.test(c)?(a.pattern=D(c),N.push(a)):S[c]=a}}},B=function(e){S={},N=[],O(e),pi(g,function(e,t){f[t]=e.children})},P=function(e){var a=/^(~)?(.+)$/;e&&(fi.text_block_elements=fi.block_elements=null,pi(yi(e,","),function(e){var t,n=a.exec(e),r="~"===n[1],o=r?"span":"div",i=n[2];f[i]=f[o],d[i]=o,r||(R[i.toUpperCase()]={},R[i]={}),S[i]||(t=S[o],delete(t=gi({},t)).removeEmptyAttrs,delete t.removeEmpty,S[i]=t),pi(f,function(e,t){e[o]&&(f[t]=e=gi({},f[t]),e[i]=e[o])})}))},L=function(e){var o=/^([+\-]?)([A-Za-z0-9_\-.\u00b7\u00c0-\u00d6\u00d8-\u00f6\u00f8-\u037d\u037f-\u1fff\u200c-\u200d\u203f-\u2040\u2070-\u218f\u2c00-\u2fef\u3001-\ud7ff\uf900-\ufdcf\ufdf0-\ufffd]+)\[([^\]]+)]$/;fi[i.schema]=null,e&&pi(yi(e,","),function(e){var t,n,r=o.exec(e);r&&(n=r[1],t=n?f[r[2]]:f[r[2]]={"#comment":{}},t=f[r[2]],pi(yi(r[3],"|"),function(e){"-"===n?delete t[e]:t[e]={}}))})},I=function(e){var t,n=S[e];if(n)return n;for(t=N.length;t--;)if((n=N[t]).pattern.test(e))return n};i.valid_elements?B(i.valid_elements):(pi(g,function(e,t){S[t]={attributes:e.attributes,attributesOrder:e.attributesOrder},f[t]=e.children}),"html5"!==i.schema&&pi(yi("strong/b em/i"),function(e){var t=yi(e,"/");S[t[1]].outputName=t[0]}),pi(yi("ol ul sub sup blockquote span font a table tbody strong em b i"),function(e){S[e]&&(S[e].removeEmpty=!0)}),pi(yi("p h1 h2 h3 h4 h5 h6 th td pre div address caption li"),function(e){S[e].paddEmpty=!0}),pi(yi("span"),function(e){S[e].removeEmptyAttrs=!0})),P(i.custom_elements),L(i.valid_children),O(i.extended_valid_elements),L("+ol[ul|ol],+ul[ul|ol]"),pi({dd:"dl",dt:"dl",li:"ul ol",td:"tr",th:"tr",tr:"tbody thead tfoot",tbody:"table",thead:"table",tfoot:"table",legend:"fieldset",area:"map",param:"video audio object"},function(e,t){S[t]&&(S[t].parentsRequired=yi(e))}),i.invalid_elements&&pi(hi(i.invalid_elements),function(e){S[e]&&delete S[e]}),I("span")||O("span[!data-mce-type|*]");return{children:f,elements:S,getValidStyles:function(){return h},getValidClasses:function(){return y},getBlockElements:function(){return R},getInvalidStyles:function(){return v},getShortEndedElements:function(){return w},getTextBlockElements:function(){return A},getTextInlineElements:function(){return T},getBoolAttrs:function(){return x},getElementRule:I,getSelfClosingElements:function(){return C},getNonEmptyElements:function(){return k},getMoveCaretBeforeOnEnterElements:function(){return _},getWhiteSpaceElements:function(){return b},getSpecialElements:function(){return m},isValidChild:function(e,t){var n=f[e.toLowerCase()];return!(!n||!n[t.toLowerCase()])},isValid:function(e,t){var n,r,o=I(e);if(o){if(!t)return!0;if(o.attributes[t])return!0;if(n=o.attributePatterns)for(r=n.length;r--;)if(n[r].pattern.test(e))return!0}return!1},getCustomElements:function(){return d},addValidElements:O,setValidElements:B,addCustomElements:P,addValidChildren:L}},wi=function(e,t,n,r){var o=function(e){return 1<(e=parseInt(e,10).toString(16)).length?e:"0"+e};return"#"+o(t)+o(n)+o(r)},xi=function(b,e){var s,c,C=this,w=/rgb\s*\(\s*([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)\s*\)/gi,x=/(?:url(?:(?:\(\s*\"([^\"]+)\"\s*\))|(?:\(\s*\'([^\']+)\'\s*\))|(?:\(\s*([^)\s]+)\s*\))))|(?:\'([^\']+)\')|(?:\"([^\"]+)\")/gi,S=/\s*([^:]+):\s*([^;]+);?/g,N=/\s+$/,E={},k=lo;b=b||{},e&&(s=e.getValidStyles(),c=e.getInvalidStyles());for(var t=("\\\" \\' \\; \\: ; : "+k).split(" "),_=0;_<t.length;_++)E[t[_]]=k+_,E[k+_]=t[_];return{toHex:function(e){return e.replace(w,wi)},parse:function(e){var t,n,r,o,i,a,u,s,c={},l=b.url_converter,f=b.url_converter_scope||C,d=function(e,t,n){var r=c[e+"-top"+t];if(r){var o=c[e+"-right"+t];if(o){var i=c[e+"-bottom"+t];if(i){var a=c[e+"-left"+t];if(a){var u=[r,o,i,a];for(_=u.length-1;_--&&u[_]===u[_+1];);-1<_&&n||(c[e+t]=-1===_?u[0]:u.join(" "),delete c[e+"-top"+t],delete c[e+"-right"+t],delete c[e+"-bottom"+t],delete c[e+"-left"+t])}}}}},m=function(e){var t,n=c[e];if(n){for(t=(n=n.split(" ")).length;t--;)if(n[t]!==n[0])return!1;return c[e]=n[0],!0}},p=function(e){return o=!0,E[e]},g=function(e,t){return o&&(e=e.replace(/\uFEFF[0-9]/g,function(e){return E[e]})),t||(e=e.replace(/\\([\'\";:])/g,"$1")),e},h=function(e){return String.fromCharCode(parseInt(e.slice(1),16))},v=function(e){return e.replace(/\\[0-9a-f]+/gi,h)},y=function(e,t,n,r,o,i){if(o=o||i)return"'"+(o=g(o)).replace(/\'/g,"\\'")+"'";if(t=g(t||n||r),!b.allow_script_urls){var a=t.replace(/[\s\r\n]+/g,"");if(/(java|vb)script:/i.test(a))return"";if(!b.allow_svg_data_urls&&/^data:image\/svg/i.test(a))return""}return l&&(t=l.call(f,t,"style")),"url('"+t.replace(/\'/g,"\\'")+"')"};if(e){for(e=(e=e.replace(/[\u0000-\u001F]/g,"")).replace(/\\[\"\';:\uFEFF]/g,p).replace(/\"[^\"]+\"|\'[^\']+\'/g,function(e){return e.replace(/[;:]/g,p)});t=S.exec(e);)if(S.lastIndex=t.index+t[0].length,n=t[1].replace(N,"").toLowerCase(),r=t[2].replace(N,""),n&&r){if(n=v(n),r=v(r),-1!==n.indexOf(k)||-1!==n.indexOf('"'))continue;if(!b.allow_script_urls&&("behavior"===n||/expression\s*\(|\/\*|\*\//.test(r)))continue;"font-weight"===n&&"700"===r?r="bold":"color"!==n&&"background-color"!==n||(r=r.toLowerCase()),r=(r=r.replace(w,wi)).replace(x,y),c[n]=o?g(r,!0):r}d("border","",!0),d("border","-width"),d("border","-color"),d("border","-style"),d("padding",""),d("margin",""),i="border",u="border-style",s="border-color",m(a="border-width")&&m(u)&&m(s)&&(c[i]=c[a]+" "+c[u]+" "+c[s],delete c[a],delete c[u],delete c[s]),"medium none"===c.border&&delete c.border,"none"===c["border-image"]&&delete c["border-image"]}return c},serialize:function(i,a){var u="",e=function(e){var t,n=s[e];if(n)for(var r=0,o=n.length;r<o;r++)e=n[r],(t=i[e])&&(u+=(0<u.length?" ":"")+e+": "+t+";")};return a&&s?(e("*"),e(a)):se(i,function(e,t){var n,r,o;!e||c&&(n=t,r=a,(o=c["*"])&&o[n]||(o=c[r])&&o[n])||(u+=(0<u.length?" ":"")+t+": "+e+";")}),u}}},Si=/^(?:mouse|contextmenu)|click/,Ni={keyLocation:1,layerX:1,layerY:1,returnValue:1,webkitMovementX:1,webkitMovementY:1,keyIdentifier:1,mozPressure:1},Ei=b,ki=w,_i=function(e,t,n,r){e.addEventListener?e.addEventListener(t,n,r||!1):e.attachEvent&&e.attachEvent("on"+t,n)},Ai=function(e,t,n,r){e.removeEventListener?e.removeEventListener(t,n,r||!1):e.detachEvent&&e.detachEvent("on"+t,n)},Ri=function(e,t){var n,r,o,i,a,u,s=t||{};for(n in e)Ni[n]||(s[n]=e[n]);return s.target||(s.target=s.srcElement||document),s.composedPath&&(s.composedPath=function(){return e.composedPath()}),e&&(a=e,Si.test(a.type))&&e.pageX===undefined&&e.clientX!==undefined&&(o=(r=s.target.ownerDocument||document).documentElement,i=r.body,s.pageX=e.clientX+(o&&o.scrollLeft||i&&i.scrollLeft||0)-(o&&o.clientLeft||i&&i.clientLeft||0),s.pageY=e.clientY+(o&&o.scrollTop||i&&i.scrollTop||0)-(o&&o.clientTop||i&&i.clientTop||0)),s.preventDefault=function(){s.defaultPrevented=!0,s.isDefaultPrevented=ki,e&&(e.preventDefault?e.preventDefault():e.returnValue=!1)},s.stopPropagation=function(){s.cancelBubble=!0,s.isPropagationStopped=ki,e&&(e.stopPropagation?e.stopPropagation():e.cancelBubble=!0)},!(s.stopImmediatePropagation=function(){s.isImmediatePropagationStopped=ki,s.stopPropagation()})==((u=s).isDefaultPrevented===ki||u.isDefaultPrevented===Ei)&&(s.isDefaultPrevented=!0===s.defaultPrevented?ki:Ei,s.isPropagationStopped=!0===s.cancelBubble?ki:Ei,s.isImmediatePropagationStopped=Ei),"undefined"==typeof s.metaKey&&(s.metaKey=!1),s},Ti=(Di.prototype.bind=function(e,t,n,r){var o,i,a,u,s,c,l=this,f=window,d=function(e){l.executeHandlers(Ri(e||f.event),o)};if(e&&3!==e.nodeType&&8!==e.nodeType){e[l.expando]?o=e[l.expando]:(o=l.count++,e[l.expando]=o,l.events[o]={}),r=r||e;for(var m=t.split(" "),p=m.length;p--;)s=d,u=c=!1,"DOMContentLoaded"===(a=m[p])&&(a="ready"),l.domLoaded&&"ready"===a&&"complete"===e.readyState?n.call(r,Ri({type:a})):(l.hasMouseEnterLeave||(u=l.mouseEnterLeave[a])&&(s=function(e){var t=e.currentTarget,n=e.relatedTarget;if(n&&t.contains)n=t.contains(n);else for(;n&&n!==t;)n=n.parentNode;n||((e=Ri(e||f.event)).type="mouseout"===e.type?"mouseleave":"mouseenter",e.target=t,l.executeHandlers(e,o))}),l.hasFocusIn||"focusin"!==a&&"focusout"!==a||(c=!0,u="focusin"===a?"focus":"blur",s=function(e){(e=Ri(e||f.event)).type="focus"===e.type?"focusin":"focusout",l.executeHandlers(e,o)}),(i=l.events[o][a])?"ready"===a&&l.domLoaded?n(Ri({type:a})):i.push({func:n,scope:r}):(l.events[o][a]=i=[{func:n,scope:r}],i.fakeName=u,i.capture=c,i.nativeHandler=s,"ready"===a?function(e,t,n){var r,o=e.document,i={type:"ready"};n.domLoaded?t(i):(r=function(){Ai(e,"DOMContentLoaded",r),Ai(e,"load",r),n.domLoaded||(n.domLoaded=!0,t(i)),e=null},"complete"===o.readyState||"interactive"===o.readyState&&o.body?r():_i(e,"DOMContentLoaded",r),n.domLoaded||_i(e,"load",r))}(e,s,l):_i(e,u||a,s,c)));return e=i=null,n}},Di.prototype.unbind=function(n,e,t){var r,o,i;if(!n||3===n.nodeType||8===n.nodeType)return this;var a=n[this.expando];if(a){if(i=this.events[a],e){for(var u,s,c,l,f=e.split(" "),d=f.length;d--;)if(l=i[o=f[d]]){if(t)for(r=l.length;r--;)l[r].func===t&&(u=l.nativeHandler,s=l.fakeName,c=l.capture,(l=l.slice(0,r).concat(l.slice(r+1))).nativeHandler=u,l.fakeName=s,l.capture=c,i[o]=l);t&&0!==l.length||(delete i[o],Ai(n,l.fakeName||o,l.nativeHandler,l.capture))}}else se(i,function(e,t){Ai(n,e.fakeName||t,e.nativeHandler,e.capture)}),i={};for(o in i)if(ve(i,o))return this;delete this.events[a];try{delete n[this.expando]}catch(m){n[this.expando]=null}}return this},Di.prototype.fire=function(e,t,n){var r;if(!e||3===e.nodeType||8===e.nodeType)return this;var o=Ri(null,n);for(o.type=t,o.target=e;(r=e[this.expando])&&this.executeHandlers(o,r),(e=e.parentNode||e.ownerDocument||e.defaultView||e.parentWindow)&&!o.isPropagationStopped(););return this},Di.prototype.clean=function(e){var t,n;if(!e||3===e.nodeType||8===e.nodeType)return this;if(e[this.expando]&&this.unbind(e),e.getElementsByTagName||(e=e.document),e&&e.getElementsByTagName)for(this.unbind(e),t=(n=e.getElementsByTagName("*")).length;t--;)(e=n[t])[this.expando]&&this.unbind(e);return this},Di.prototype.destroy=function(){this.events={}},Di.prototype.cancel=function(e){return e&&(e.preventDefault(),e.stopImmediatePropagation()),!1},Di.prototype.executeHandlers=function(e,t){var n=this.events[t],r=n&&n[e.type];if(r)for(var o=0,i=r.length;o<i;o++){var a=r[o];if(a&&!1===a.func.call(a.scope,e)&&e.preventDefault(),e.isImmediatePropagationStopped())return}},Di.Event=new Di,Di);function Di(){this.domLoaded=!1,this.events={},this.count=1,this.expando="mce-data-"+(+new Date).toString(32),this.hasMouseEnterLeave="onmouseenter"in document.documentElement,this.hasFocusIn="onfocusin"in document.documentElement,this.count=1}var Oi,Bi,Pi,Li,Ii,Mi,Fi,Ui,zi,ji,Hi,Vi,qi,$i,Wi,Ki,Xi,Yi="sizzle"+-new Date,Gi=window.document,Ji=0,Qi=0,Zi=Da(),ea=Da(),ta=Da(),na=function(e,t){return e===t&&(ji=!0),0},ra=typeof undefined,oa={}.hasOwnProperty,ia=[],aa=ia.pop,ua=ia.push,sa=ia.push,ca=ia.slice,la=ia.indexOf||function(e){for(var t=0,n=this.length;t<n;t++)if(this[t]===e)return t;return-1},fa="[\\x20\\t\\r\\n\\f]",da="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",ma="\\["+fa+"*("+da+")(?:"+fa+"*([*^$|!~]?=)"+fa+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+da+"))|)"+fa+"*\\]",pa=":("+da+")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+ma+")*)|.*)\\)|)",ga=new RegExp("^"+fa+"+|((?:^|[^\\\\])(?:\\\\.)*)"+fa+"+$","g"),ha=new RegExp("^"+fa+"*,"+fa+"*"),va=new RegExp("^"+fa+"*([>+~]|"+fa+")"+fa+"*"),ya=new RegExp("="+fa+"*([^\\]'\"]*?)"+fa+"*\\]","g"),ba=new RegExp(pa),Ca=new RegExp("^"+da+"$"),wa={ID:new RegExp("^#("+da+")"),CLASS:new RegExp("^\\.("+da+")"),TAG:new RegExp("^("+da+"|[*])"),ATTR:new RegExp("^"+ma),PSEUDO:new RegExp("^"+pa),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+fa+"*(even|odd|(([+-]|)(\\d*)n|)"+fa+"*(?:([+-]|)"+fa+"*(\\d+)|))"+fa+"*\\)|)","i"),bool:new RegExp("^(?:checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped)$","i"),needsContext:new RegExp("^"+fa+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+fa+"*((?:-\\d)?\\d*)"+fa+"*\\)|)(?=[^-]|$)","i")},xa=/^(?:input|select|textarea|button)$/i,Sa=/^h\d$/i,Na=/^[^{]+\{\s*\[native \w/,Ea=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,ka=/[+~]/,_a=/'|\\/g,Aa=new RegExp("\\\\([\\da-f]{1,6}"+fa+"?|("+fa+")|.)","ig"),Ra=function(e,t,n){var r="0x"+t-65536;return r!=r||n?t:r<0?String.fromCharCode(65536+r):String.fromCharCode(r>>10|55296,1023&r|56320)};try{sa.apply(ia=ca.call(Gi.childNodes),Gi.childNodes),ia[Gi.childNodes.length].nodeType}catch(_k){sa={apply:ia.length?function(e,t){ua.apply(e,ca.call(t))}:function(e,t){for(var n=e.length,r=0;e[n++]=t[r++];);e.length=n-1}}}var Ta=function(e,t,n,r){var o,i,a,u,s,c,l,f,d,m;if((t?t.ownerDocument||t:Gi)!==Vi&&Hi(t),n=n||[],!e||"string"!=typeof e)return n;if(1!==(u=(t=t||Vi).nodeType)&&9!==u)return[];if($i&&!r){if(o=Ea.exec(e))if(a=o[1]){if(9===u){if(!(i=t.getElementById(a))||!i.parentNode)return n;if(i.id===a)return n.push(i),n}else if(t.ownerDocument&&(i=t.ownerDocument.getElementById(a))&&Xi(t,i)&&i.id===a)return n.push(i),n}else{if(o[2])return sa.apply(n,t.getElementsByTagName(e)),n;if((a=o[3])&&Oi.getElementsByClassName)return sa.apply(n,t.getElementsByClassName(a)),n}if(Oi.qsa&&(!Wi||!Wi.test(e))){if(f=l=Yi,d=t,m=9===u&&e,1===u&&"object"!==t.nodeName.toLowerCase()){for(c=Ii(e),(l=t.getAttribute("id"))?f=l.replace(_a,"\\$&"):t.setAttribute("id",f),f="[id='"+f+"'] ",s=c.length;s--;)c[s]=f+Ma(c[s]);d=ka.test(e)&&La(t.parentNode)||t,m=c.join(",")}if(m)try{return sa.apply(n,d.querySelectorAll(m)),n}catch(p){}finally{l||t.removeAttribute("id")}}}return Fi(e.replace(ga,"$1"),t,n,r)};function Da(){var n=[];function r(e,t){return n.push(e+" ")>Bi.cacheLength&&delete r[n.shift()],r[e+" "]=t}return r}function Oa(e){return e[Yi]=!0,e}function Ba(e,t){var n=t&&e,r=n&&1===e.nodeType&&1===t.nodeType&&(~t.sourceIndex||1<<31)-(~e.sourceIndex||1<<31);if(r)return r;if(n)for(;n=n.nextSibling;)if(n===t)return-1;return e?1:-1}function Pa(a){return Oa(function(i){return i=+i,Oa(function(e,t){for(var n,r=a([],e.length,i),o=r.length;o--;)e[n=r[o]]&&(e[n]=!(t[n]=e[n]))})})}function La(e){return e&&typeof e.getElementsByTagName!=ra&&e}function Ia(){}function Ma(e){for(var t=0,n=e.length,r="";t<n;t++)r+=e[t].value;return r}function Fa(a,e,t){var u=e.dir,s=t&&"parentNode"===u,c=Qi++;return e.first?function(e,t,n){for(;e=e[u];)if(1===e.nodeType||s)return a(e,t,n)}:function(e,t,n){var r,o,i=[Ji,c];if(n){for(;e=e[u];)if((1===e.nodeType||s)&&a(e,t,n))return!0}else for(;e=e[u];)if(1===e.nodeType||s){if((r=(o=e[Yi]||(e[Yi]={}))[u])&&r[0]===Ji&&r[1]===c)return i[2]=r[2];if((o[u]=i)[2]=a(e,t,n))return!0}}}function Ua(o){return 1<o.length?function(e,t,n){for(var r=o.length;r--;)if(!o[r](e,t,n))return!1;return!0}:o[0]}function za(e,t,n,r,o){for(var i,a=[],u=0,s=e.length,c=null!=t;u<s;u++)(i=e[u])&&(n&&!n(i,r,o)||(a.push(i),c&&t.push(u)));return a}function ja(m,p,g,h,v,e){return h&&!h[Yi]&&(h=ja(h)),v&&!v[Yi]&&(v=ja(v,e)),Oa(function(e,t,n,r){var o,i,a,u=[],s=[],c=t.length,l=e||function(e,t,n){for(var r=0,o=t.length;r<o;r++)Ta(e,t[r],n);return n}(p||"*",n.nodeType?[n]:n,[]),f=!m||!e&&p?l:za(l,u,m,n,r),d=g?v||(e?m:c||h)?[]:t:f;if(g&&g(f,d,n,r),h)for(o=za(d,s),h(o,[],n,r),i=o.length;i--;)(a=o[i])&&(d[s[i]]=!(f[s[i]]=a));if(e){if(v||m){if(v){for(o=[],i=d.length;i--;)(a=d[i])&&o.push(f[i]=a);v(null,d=[],o,r)}for(i=d.length;i--;)(a=d[i])&&-1<(o=v?la.call(e,a):u[i])&&(e[o]=!(t[o]=a))}}else d=za(d===t?d.splice(c,d.length):d),v?v(null,t,d,r):sa.apply(t,d)})}Oi=Ta.support={},Li=Ta.isXML=function(e){var t=e&&(e.ownerDocument||e).documentElement;return!!t&&"HTML"!==t.nodeName},Hi=Ta.setDocument=function(e){var t,s=e?e.ownerDocument||e:Gi,n=s.defaultView;return s!==Vi&&9===s.nodeType&&s.documentElement?(qi=(Vi=s).documentElement,$i=!Li(s),n&&n!==function(e){try{return e.top}catch(t){}return null}(n)&&(n.addEventListener?n.addEventListener("unload",function(){Hi()},!1):n.attachEvent&&n.attachEvent("onunload",function(){Hi()})),Oi.attributes=!0,Oi.getElementsByTagName=!0,Oi.getElementsByClassName=Na.test(s.getElementsByClassName),Oi.getById=!0,Bi.find.ID=function(e,t){if(typeof t.getElementById!=ra&&$i){var n=t.getElementById(e);return n&&n.parentNode?[n]:[]}},Bi.filter.ID=function(e){var t=e.replace(Aa,Ra);return function(e){return e.getAttribute("id")===t}},Bi.find.TAG=Oi.getElementsByTagName?function(e,t){if(typeof t.getElementsByTagName!=ra)return t.getElementsByTagName(e)}:function(e,t){var n,r=[],o=0,i=t.getElementsByTagName(e);if("*"!==e)return i;for(;n=i[o++];)1===n.nodeType&&r.push(n);return r},Bi.find.CLASS=Oi.getElementsByClassName&&function(e,t){if($i)return t.getElementsByClassName(e)},Ki=[],Wi=[],Oi.disconnectedMatch=!0,Wi=Wi.length&&new RegExp(Wi.join("|")),Ki=Ki.length&&new RegExp(Ki.join("|")),t=Na.test(qi.compareDocumentPosition),Xi=t||Na.test(qi.contains)?function(e,t){var n=9===e.nodeType?e.documentElement:e,r=t&&t.parentNode;return e===r||!(!r||1!==r.nodeType||!(n.contains?n.contains(r):e.compareDocumentPosition&&16&e.compareDocumentPosition(r)))}:function(e,t){if(t)for(;t=t.parentNode;)if(t===e)return!0;return!1},na=t?function(e,t){if(e===t)return ji=!0,0;var n=!e.compareDocumentPosition-!t.compareDocumentPosition;return n||(1&(n=(e.ownerDocument||e)===(t.ownerDocument||t)?e.compareDocumentPosition(t):1)||!Oi.sortDetached&&t.compareDocumentPosition(e)===n?e===s||e.ownerDocument===Gi&&Xi(Gi,e)?-1:t===s||t.ownerDocument===Gi&&Xi(Gi,t)?1:zi?la.call(zi,e)-la.call(zi,t):0:4&n?-1:1)}:function(e,t){if(e===t)return ji=!0,0;var n,r=0,o=e.parentNode,i=t.parentNode,a=[e],u=[t];if(!o||!i)return e===s?-1:t===s?1:o?-1:i?1:zi?la.call(zi,e)-la.call(zi,t):0;if(o===i)return Ba(e,t);for(n=e;n=n.parentNode;)a.unshift(n);for(n=t;n=n.parentNode;)u.unshift(n);for(;a[r]===u[r];)r++;return r?Ba(a[r],u[r]):a[r]===Gi?-1:u[r]===Gi?1:0},s):Vi},Ta.matches=function(e,t){return Ta(e,null,null,t)},Ta.matchesSelector=function(e,t){if((e.ownerDocument||e)!==Vi&&Hi(e),t=t.replace(ya,"='$1']"),Oi.matchesSelector&&$i&&(!Ki||!Ki.test(t))&&(!Wi||!Wi.test(t)))try{var n=(void 0).call(e,t);if(n||Oi.disconnectedMatch||e.document&&11!==e.document.nodeType)return n}catch(_k){}return 0<Ta(t,Vi,null,[e]).length},Ta.contains=function(e,t){return(e.ownerDocument||e)!==Vi&&Hi(e),Xi(e,t)},Ta.attr=function(e,t){(e.ownerDocument||e)!==Vi&&Hi(e);var n=Bi.attrHandle[t.toLowerCase()],r=n&&oa.call(Bi.attrHandle,t.toLowerCase())?n(e,t,!$i):undefined;return r!==undefined?r:Oi.attributes||!$i?e.getAttribute(t):(r=e.getAttributeNode(t))&&r.specified?r.value:null},Ta.error=function(e){throw new Error("Syntax error, unrecognized expression: "+e)},Ta.uniqueSort=function(e){var t,n=[],r=0,o=0;if(ji=!Oi.detectDuplicates,zi=!Oi.sortStable&&e.slice(0),e.sort(na),ji){for(;t=e[o++];)t===e[o]&&(r=n.push(o));for(;r--;)e.splice(n[r],1)}return zi=null,e},Pi=Ta.getText=function(e){var t,n="",r=0,o=e.nodeType;if(o){if(1===o||9===o||11===o){if("string"==typeof e.textContent)return e.textContent;for(e=e.firstChild;e;e=e.nextSibling)n+=Pi(e)}else if(3===o||4===o)return e.nodeValue}else for(;t=e[r++];)n+=Pi(t);return n},(Bi=Ta.selectors={cacheLength:50,createPseudo:Oa,match:wa,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(e){return e[1]=e[1].replace(Aa,Ra),e[3]=(e[3]||e[4]||e[5]||"").replace(Aa,Ra),"~="===e[2]&&(e[3]=" "+e[3]+" "),e.slice(0,4)},CHILD:function(e){return e[1]=e[1].toLowerCase(),"nth"===e[1].slice(0,3)?(e[3]||Ta.error(e[0]),e[4]=+(e[4]?e[5]+(e[6]||1):2*("even"===e[3]||"odd"===e[3])),e[5]=+(e[7]+e[8]||"odd"===e[3])):e[3]&&Ta.error(e[0]),e},PSEUDO:function(e){var t,n=!e[6]&&e[2];return wa.CHILD.test(e[0])?null:(e[3]?e[2]=e[4]||e[5]||"":n&&ba.test(n)&&(t=Ii(n,!0))&&(t=n.indexOf(")",n.length-t)-n.length)&&(e[0]=e[0].slice(0,t),e[2]=n.slice(0,t)),e.slice(0,3))}},filter:{TAG:function(e){var t=e.replace(Aa,Ra).toLowerCase();return"*"===e?function(){return!0}:function(e){return e.nodeName&&e.nodeName.toLowerCase()===t}},CLASS:function(e){var t=Zi[e+" "];return t||(t=new RegExp("(^|"+fa+")"+e+"("+fa+"|$)"))&&Zi(e,function(e){return t.test("string"==typeof e.className&&e.className||typeof e.getAttribute!=ra&&e.getAttribute("class")||"")})},ATTR:function(n,r,o){return function(e){var t=Ta.attr(e,n);return null==t?"!="===r:!r||(t+="","="===r?t===o:"!="===r?t!==o:"^="===r?o&&0===t.indexOf(o):"*="===r?o&&-1<t.indexOf(o):"$="===r?o&&t.slice(-o.length)===o:"~="===r?-1<(" "+t+" ").indexOf(o):"|="===r&&(t===o||t.slice(0,o.length+1)===o+"-"))}},CHILD:function(m,e,t,p,g){var h="nth"!==m.slice(0,3),v="last"!==m.slice(-4),y="of-type"===e;return 1===p&&0===g?function(e){return!!e.parentNode}:function(e,t,n){var r,o,i,a,u,s,c=h!=v?"nextSibling":"previousSibling",l=e.parentNode,f=y&&e.nodeName.toLowerCase(),d=!n&&!y;if(l){if(h){for(;c;){for(i=e;i=i[c];)if(y?i.nodeName.toLowerCase()===f:1===i.nodeType)return!1;s=c="only"===m&&!s&&"nextSibling"}return!0}if(s=[v?l.firstChild:l.lastChild],v&&d){for(u=(r=(o=l[Yi]||(l[Yi]={}))[m]||[])[0]===Ji&&r[1],a=r[0]===Ji&&r[2],i=u&&l.childNodes[u];i=++u&&i&&i[c]||(a=u=0)||s.pop();)if(1===i.nodeType&&++a&&i===e){o[m]=[Ji,u,a];break}}else if(d&&(r=(e[Yi]||(e[Yi]={}))[m])&&r[0]===Ji)a=r[1];else for(;(i=++u&&i&&i[c]||(a=u=0)||s.pop())&&((y?i.nodeName.toLowerCase()!==f:1!==i.nodeType)||!++a||(d&&((i[Yi]||(i[Yi]={}))[m]=[Ji,a]),i!==e)););return(a-=g)===p||a%p==0&&0<=a/p}}},PSEUDO:function(e,i){var t,a=Bi.pseudos[e]||Bi.setFilters[e.toLowerCase()]||Ta.error("unsupported pseudo: "+e);return a[Yi]?a(i):1<a.length?(t=[e,e,"",i],Bi.setFilters.hasOwnProperty(e.toLowerCase())?Oa(function(e,t){for(var n,r=a(e,i),o=r.length;o--;)e[n=la.call(e,r[o])]=!(t[n]=r[o])}):function(e){return a(e,0,t)}):a}},pseudos:{not:Oa(function(e){var r=[],o=[],u=Mi(e.replace(ga,"$1"));return u[Yi]?Oa(function(e,t,n,r){for(var o,i=u(e,null,r,[]),a=e.length;a--;)(o=i[a])&&(e[a]=!(t[a]=o))}):function(e,t,n){return r[0]=e,u(r,null,n,o),r[0]=null,!o.pop()}}),has:Oa(function(t){return function(e){return 0<Ta(t,e).length}}),contains:Oa(function(t){return t=t.replace(Aa,Ra),function(e){return-1<(e.textContent||e.innerText||Pi(e)).indexOf(t)}}),lang:Oa(function(n){return Ca.test(n||"")||Ta.error("unsupported lang: "+n),n=n.replace(Aa,Ra).toLowerCase(),function(e){var t;do{if(t=$i?e.lang:e.getAttribute("xml:lang")||e.getAttribute("lang"))return(t=t.toLowerCase())===n||0===t.indexOf(n+"-")}while((e=e.parentNode)&&1===e.nodeType);return!1}}),target:function(e){var t=window.location&&window.location.hash;return t&&t.slice(1)===e.id},root:function(e){return e===qi},focus:function(e){return e===Vi.activeElement&&(!Vi.hasFocus||Vi.hasFocus())&&!!(e.type||e.href||~e.tabIndex)},enabled:function(e){return!1===e.disabled},disabled:function(e){return!0===e.disabled},checked:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&!!e.checked||"option"===t&&!!e.selected},selected:function(e){return e.parentNode&&e.parentNode.selectedIndex,!0===e.selected},empty:function(e){for(e=e.firstChild;e;e=e.nextSibling)if(e.nodeType<6)return!1;return!0},parent:function(e){return!Bi.pseudos.empty(e)},header:function(e){return Sa.test(e.nodeName)},input:function(e){return xa.test(e.nodeName)},button:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&"button"===e.type||"button"===t},text:function(e){var t;return"input"===e.nodeName.toLowerCase()&&"text"===e.type&&(null==(t=e.getAttribute("type"))||"text"===t.toLowerCase())},first:Pa(function(){return[0]}),last:Pa(function(e,t){return[t-1]}),eq:Pa(function(e,t,n){return[n<0?n+t:n]}),even:Pa(function(e,t){for(var n=0;n<t;n+=2)e.push(n);return e}),odd:Pa(function(e,t){for(var n=1;n<t;n+=2)e.push(n);return e}),lt:Pa(function(e,t,n){for(var r=n<0?n+t:n;0<=--r;)e.push(r);return e}),gt:Pa(function(e,t,n){for(var r=n<0?n+t:n;++r<t;)e.push(r);return e})}}).pseudos.nth=Bi.pseudos.eq,Y(["radio","checkbox","file","password","image"],function(e){var t;Bi.pseudos[e]=(t=e,function(e){return"input"===e.nodeName.toLowerCase()&&e.type===t})}),Y(["submit","reset"],function(e){var n;Bi.pseudos[e]=(n=e,function(e){var t=e.nodeName.toLowerCase();return("input"===t||"button"===t)&&e.type===n})}),Ia.prototype=Bi.filters=Bi.pseudos,Bi.setFilters=new Ia,Ii=Ta.tokenize=function(e,t){var n,r,o,i,a,u,s,c=ea[e+" "];if(c)return t?0:c.slice(0);for(a=e,u=[],s=Bi.preFilter;a;){for(i in n&&!(r=ha.exec(a))||(r&&(a=a.slice(r[0].length)||a),u.push(o=[])),n=!1,(r=va.exec(a))&&(n=r.shift(),o.push({value:n,type:r[0].replace(ga," ")}),a=a.slice(n.length)),Bi.filter)Bi.filter.hasOwnProperty(i)&&(!(r=wa[i].exec(a))||s[i]&&!(r=s[i](r))||(n=r.shift(),o.push({value:n,type:i,matches:r}),a=a.slice(n.length)));if(!n)break}return t?a.length:a?Ta.error(e):ea(e,u).slice(0)},Mi=Ta.compile=function(e,t){var n,h,v,y,b,r,o=[],i=[],a=ta[e+" "];if(!a){for(n=(t=t||Ii(e)).length;n--;)(a=function f(e){for(var o,t,n,r=e.length,i=Bi.relative[e[0].type],a=i||Bi.relative[" "],u=i?1:0,s=Fa(function(e){return e===o},a,!0),c=Fa(function(e){return-1<la.call(o,e)},a,!0),l=[function(e,t,n){var r=!i&&(n||t!==Ui)||((o=t).nodeType?s:c)(e,t,n);return o=null,r}];u<r;u++)if(t=Bi.relative[e[u].type])l=[Fa(Ua(l),t)];else{if((t=Bi.filter[e[u].type].apply(null,e[u].matches))[Yi]){for(n=++u;n<r&&!Bi.relative[e[n].type];n++);return ja(1<u&&Ua(l),1<u&&Ma(e.slice(0,u-1).concat({value:" "===e[u-2].type?"*":""})).replace(ga,"$1"),t,u<n&&f(e.slice(u,n)),n<r&&f(e=e.slice(n)),n<r&&Ma(e))}l.push(t)}return Ua(l)}(t[n]))[Yi]?o.push(a):i.push(a);(a=ta(e,(h=i,y=0<(v=o).length,b=0<h.length,r=function(e,t,n,r,o){var i,a,u,s=0,c="0",l=e&&[],f=[],d=Ui,m=e||b&&Bi.find.TAG("*",o),p=Ji+=null==d?1:Math.random()||.1,g=m.length;for(o&&(Ui=t!==Vi&&t);c!==g&&null!=(i=m[c]);c++){if(b&&i){for(a=0;u=h[a++];)if(u(i,t,n)){r.push(i);break}o&&(Ji=p)}y&&((i=!u&&i)&&s--,e&&l.push(i))}if(s+=c,y&&c!==s){for(a=0;u=v[a++];)u(l,f,t,n);if(e){if(0<s)for(;c--;)l[c]||f[c]||(f[c]=aa.call(r));f=za(f)}sa.apply(r,f),o&&!e&&0<f.length&&1<s+v.length&&Ta.uniqueSort(r)}return o&&(Ji=p,Ui=d),l},y?Oa(r):r))).selector=e}return a},Fi=Ta.select=function(e,t,n,r){var o,i,a,u,s,c="function"==typeof e&&e,l=!r&&Ii(e=c.selector||e);if(n=n||[],1===l.length){if(2<(i=l[0]=l[0].slice(0)).length&&"ID"===(a=i[0]).type&&Oi.getById&&9===t.nodeType&&$i&&Bi.relative[i[1].type]){if(!(t=(Bi.find.ID(a.matches[0].replace(Aa,Ra),t)||[])[0]))return n;c&&(t=t.parentNode),e=e.slice(i.shift().value.length)}for(o=wa.needsContext.test(e)?0:i.length;o--&&(a=i[o],!Bi.relative[u=a.type]);)if((s=Bi.find[u])&&(r=s(a.matches[0].replace(Aa,Ra),ka.test(i[0].type)&&La(t.parentNode)||t))){if(i.splice(o,1),!(e=r.length&&Ma(i)))return sa.apply(n,r),n;break}}return(c||Mi(e,l))(r,t,!$i,n,ka.test(e)&&La(t.parentNode)||t),n},Oi.sortStable=Yi.split("").sort(na).join("")===Yi,Oi.detectDuplicates=!!ji,Hi(),Oi.sortDetached=!0;var Ha=document,Va=Array.prototype.push,qa=Array.prototype.slice,$a=/^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,Wa=Ti.Event,Ka=_t.makeMap("children,contents,next,prev"),Xa=function(e){return void 0!==e},Ya=function(e){return"string"==typeof e},Ga=function(e,t){var n,r=(t=t||Ha).createElement("div"),o=t.createDocumentFragment();for(r.innerHTML=e;n=r.firstChild;)o.appendChild(n);return o},Ja=function(e,t,n,r){var o;if(Ya(t))t=Ga(t,fu(e[0]));else if(t.length&&!t.nodeType){if(t=gu.makeArray(t),r)for(o=t.length-1;0<=o;o--)Ja(e,t[o],n,r);else for(o=0;o<t.length;o++)Ja(e,t[o],n,r);return e}if(t.nodeType)for(o=e.length;o--;)n.call(e[o],t);return e},Qa=function(e,t){return e&&t&&-1!==(" "+e.className+" ").indexOf(" "+t+" ")},Za=function(e,t,n){var r,o;return t=gu(t)[0],e.each(function(){n&&r===this.parentNode||(r=this.parentNode,o=t.cloneNode(!1),this.parentNode.insertBefore(o,this)),o.appendChild(this)}),e},eu=_t.makeMap("fillOpacity fontWeight lineHeight opacity orphans widows zIndex zoom"," "),tu=_t.makeMap("checked compact declare defer disabled ismap multiple nohref noshade nowrap readonly selected"," "),nu={"for":"htmlFor","class":"className",readonly:"readOnly"},ru={"float":"cssFloat"},ou={},iu={},au=function(e,t){return new gu.fn.init(e,t)},uu=/^\s*|\s*$/g,su=function(e){return null===e||e===undefined?"":(""+e).replace(uu,"")},cu=function(e,t){var n,r,o,i;if(e)if((n=e.length)===undefined){for(r in e)if(e.hasOwnProperty(r)&&(i=e[r],!1===t.call(i,r,i)))break}else for(o=0;o<n&&(i=e[o],!1!==t.call(i,o,i));o++);return e},lu=function(e,n){var r=[];return cu(e,function(e,t){n(t,e)&&r.push(t)}),r},fu=function(e){return e?9===e.nodeType?e:e.ownerDocument:Ha};au.fn=au.prototype={constructor:au,selector:"",context:null,length:0,init:function(e,t){var n,r,o=this;if(!e)return o;if(e.nodeType)return o.context=o[0]=e,o.length=1,o;if(t&&t.nodeType)o.context=t;else{if(t)return gu(e).attr(t);o.context=t=document}if(Ya(e)){if(!(n="<"===(o.selector=e).charAt(0)&&">"===e.charAt(e.length-1)&&3<=e.length?[null,e,null]:$a.exec(e)))return gu(t).find(e);if(n[1])for(r=Ga(e,fu(t)).firstChild;r;)Va.call(o,r),r=r.nextSibling;else{if(!(r=fu(t).getElementById(n[2])))return o;if(r.id!==n[2])return o.find(e);o.length=1,o[0]=r}}else this.add(e,!1);return o},toArray:function(){return _t.toArray(this)},add:function(e,t){var n,r;if(Ya(e))return this.add(gu(e));if(!1!==t)for(n=gu.unique(this.toArray().concat(gu.makeArray(e))),this.length=n.length,r=0;r<n.length;r++)this[r]=n[r];else Va.apply(this,gu.makeArray(e));return this},attr:function(t,n){var e,r=this;if("object"==typeof t)cu(t,function(e,t){r.attr(e,t)});else{if(!Xa(n)){if(r[0]&&1===r[0].nodeType){if((e=ou[t])&&e.get)return e.get(r[0],t);if(tu[t])return r.prop(t)?t:undefined;null===(n=r[0].getAttribute(t,2))&&(n=undefined)}return n}this.each(function(){var e;if(1===this.nodeType){if((e=ou[t])&&e.set)return void e.set(this,n);null===n?this.removeAttribute(t,2):this.setAttribute(t,n,2)}})}return r},removeAttr:function(e){return this.attr(e,null)},prop:function(e,t){var n=this;if("object"==typeof(e=nu[e]||e))cu(e,function(e,t){n.prop(e,t)});else{if(!Xa(t))return n[0]&&n[0].nodeType&&e in n[0]?n[0][e]:t;this.each(function(){1===this.nodeType&&(this[e]=t)})}return n},css:function(n,r){var e,o,i=this,t=function(e){return e.replace(/-(\D)/g,function(e,t){return t.toUpperCase()})},a=function(e){return e.replace(/[A-Z]/g,function(e){return"-"+e})};if("object"==typeof n)cu(n,function(e,t){i.css(e,t)});else if(Xa(r))n=t(n),"number"!=typeof r||eu[n]||(r=r.toString()+"px"),i.each(function(){var e=this.style;if((o=iu[n])&&o.set)o.set(this,r);else{try{this.style[ru[n]||n]=r}catch(t){}null!==r&&""!==r||(e.removeProperty?e.removeProperty(a(n)):e.removeAttribute(n))}});else{if(e=i[0],(o=iu[n])&&o.get)return o.get(e);if(!e.ownerDocument.defaultView)return e.currentStyle?e.currentStyle[t(n)]:"";try{return e.ownerDocument.defaultView.getComputedStyle(e,null).getPropertyValue(a(n))}catch(u){return undefined}}return i},remove:function(){for(var e,t=this.length;t--;)e=this[t],Wa.clean(e),e.parentNode&&e.parentNode.removeChild(e);return this},empty:function(){for(var e,t=this.length;t--;)for(e=this[t];e.firstChild;)e.removeChild(e.firstChild);return this},html:function(e){var t;if(Xa(e)){t=this.length;try{for(;t--;)this[t].innerHTML=e}catch(n){gu(this[t]).empty().append(e)}return this}return this[0]?this[0].innerHTML:""},text:function(e){var t;if(Xa(e)){for(t=this.length;t--;)"innerText"in this[t]?this[t].innerText=e:this[0].textContent=e;return this}return this[0]?this[0].innerText||this[0].textContent:""},append:function(){return Ja(this,arguments,function(e){(1===this.nodeType||this.host&&1===this.host.nodeType)&&this.appendChild(e)})},prepend:function(){return Ja(this,arguments,function(e){(1===this.nodeType||this.host&&1===this.host.nodeType)&&this.insertBefore(e,this.firstChild)},!0)},before:function(){return this[0]&&this[0].parentNode?Ja(this,arguments,function(e){this.parentNode.insertBefore(e,this)}):this},after:function(){return this[0]&&this[0].parentNode?Ja(this,arguments,function(e){this.parentNode.insertBefore(e,this.nextSibling)},!0):this},appendTo:function(e){return gu(e).append(this),this},prependTo:function(e){return gu(e).prepend(this),this},replaceWith:function(e){return this.before(e).remove()},wrap:function(e){return Za(this,e)},wrapAll:function(e){return Za(this,e,!0)},wrapInner:function(e){return this.each(function(){gu(this).contents().wrapAll(e)}),this},unwrap:function(){return this.parent().each(function(){gu(this).replaceWith(this.childNodes)})},clone:function(){var e=[];return this.each(function(){e.push(this.cloneNode(!0))}),gu(e)},addClass:function(e){return this.toggleClass(e,!0)},removeClass:function(e){return this.toggleClass(e,!1)},toggleClass:function(o,i){var e=this;return"string"!=typeof o||(-1!==o.indexOf(" ")?cu(o.split(" "),function(){e.toggleClass(this,i)}):e.each(function(e,t){var n,r=Qa(t,o);r!==i&&(n=t.className,r?t.className=su((" "+n+" ").replace(" "+o+" "," ")):t.className+=n?" "+o:o)})),e},hasClass:function(e){return Qa(this[0],e)},each:function(e){return cu(this,e)},on:function(e,t){return this.each(function(){Wa.bind(this,e,t)})},off:function(e,t){return this.each(function(){Wa.unbind(this,e,t)})},trigger:function(e){return this.each(function(){"object"==typeof e?Wa.fire(this,e.type,e):Wa.fire(this,e)})},show:function(){return this.css("display","")},hide:function(){return this.css("display","none")},slice:function(){return gu(qa.apply(this,arguments))},eq:function(e){return-1===e?this.slice(e):this.slice(e,+e+1)},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},find:function(e){for(var t=[],n=0,r=this.length;n<r;n++)gu.find(e,this[n],t);return gu(t)},filter:function(n){return gu("function"==typeof n?lu(this.toArray(),function(e,t){return n(t,e)}):gu.filter(n,this.toArray()))},closest:function(n){var r=[];return n instanceof gu&&(n=n[0]),this.each(function(e,t){for(;t;){if("string"==typeof n&&gu(t).is(n)){r.push(t);break}if(t===n){r.push(t);break}t=t.parentNode}}),gu(r)},offset:function(e){var t,n,r,o,i=0,a=0;return e?this.css(e):((t=this[0])&&(r=(n=t.ownerDocument).documentElement,t.getBoundingClientRect&&(i=(o=t.getBoundingClientRect()).left+(r.scrollLeft||n.body.scrollLeft)-r.clientLeft,a=o.top+(r.scrollTop||n.body.scrollTop)-r.clientTop)),{left:i,top:a})},push:Va,sort:Array.prototype.sort,splice:Array.prototype.splice},_t.extend(au,{extend:_t.extend,makeArray:function(e){return(t=e)&&t===t.window||e.nodeType?[e]:_t.toArray(e);var t},inArray:function(e,t){var n;if(t.indexOf)return t.indexOf(e);for(n=t.length;n--;)if(t[n]===e)return n;return-1},isArray:_t.isArray,each:cu,trim:su,grep:lu,find:Ta,expr:Ta.selectors,unique:Ta.uniqueSort,text:Ta.getText,contains:Ta.contains,filter:function(e,t,n){var r=t.length;for(n&&(e=":not("+e+")");r--;)1!==t[r].nodeType&&t.splice(r,1);return t=1===t.length?gu.find.matchesSelector(t[0],e)?[t[0]]:[]:gu.find.matches(e,t)}});var du=function(e,t,n){var r=[],o=e[t];for("string"!=typeof n&&n instanceof gu&&(n=n[0]);o&&9!==o.nodeType;){if(n!==undefined){if(o===n)break;if("string"==typeof n&&gu(o).is(n))break}1===o.nodeType&&r.push(o),o=o[t]}return r},mu=function(e,t,n,r){var o=[];for(r instanceof gu&&(r=r[0]);e;e=e[t])if(!n||e.nodeType===n){if(r!==undefined){if(e===r)break;if("string"==typeof r&&gu(e).is(r))break}o.push(e)}return o},pu=function(e,t,n){for(e=e[t];e;e=e[t])if(e.nodeType===n)return e;return null};cu({parent:function(e){var t=e.parentNode;return t&&11!==t.nodeType?t:null},parents:function(e){return du(e,"parentNode")},next:function(e){return pu(e,"nextSibling",1)},prev:function(e){return pu(e,"previousSibling",1)},children:function(e){return mu(e.firstChild,"nextSibling",1)},contents:function(e){return _t.toArray(("iframe"===e.nodeName?e.contentDocument||e.contentWindow.document:e).childNodes)}},function(r,o){au.fn[r]=function(t){var n=[];this.each(function(){var e=o.call(n,this,t,n);e&&(gu.isArray(e)?n.push.apply(n,e):n.push(e))}),1<this.length&&(Ka[r]||(n=gu.unique(n)),0===r.indexOf("parents")&&(n=n.reverse()));var e=gu(n);return t?e.filter(t):e}}),cu({parentsUntil:function(e,t){return du(e,"parentNode",t)},nextUntil:function(e,t){return mu(e,"nextSibling",1,t).slice(1)},prevUntil:function(e,t){return mu(e,"previousSibling",1,t).slice(1)}},function(o,i){au.fn[o]=function(t,e){var n=[];this.each(function(){var e=i.call(n,this,t,n);e&&(gu.isArray(e)?n.push.apply(n,e):n.push(e))}),1<this.length&&(n=gu.unique(n),0!==o.indexOf("parents")&&"prevUntil"!==o||(n=n.reverse()));var r=gu(n);return e?r.filter(e):r}}),au.fn.is=function(e){return!!e&&0<this.filter(e).length},au.fn.init.prototype=au.fn,au.overrideDefaults=function(n){var r,o=function(e,t){return r=r||n(),0===arguments.length&&(e=r.element),t=t||r.context,new o.fn.init(e,t)};return gu.extend(o,this),o},au.attrHooks=ou,au.cssHooks=iu;var gu=au,hu=_t.each,vu=_t.grep,yu=xt.ie,bu=/^([a-z0-9],?)+$/i,Cu=function(e,t){var n=t.attr("style"),r=(r=e.serialize(e.parse(n),t[0].nodeName))||null;t.attr("data-mce-style",r)},wu=function(e,t){var n,r,o=0;if(e)for(n=e.nodeType,e=e.previousSibling;e;e=e.previousSibling)r=e.nodeType,(!t||3!==r||r!==n&&e.nodeValue.length)&&(o++,n=r);return o},xu=function(a,u){void 0===u&&(u={});var n,r,o,i,e,t,s={},c=window,l={},f=0,d=Xr.forElement(Rt.fromDom(a),{contentCssCors:u.contentCssCors,referrerPolicy:u.referrerPolicy}),m=[],p=u.schema?u.schema:Ci({}),g=xi({url_converter:u.url_converter,url_converter_scope:u.url_converter_scope},u.schema),h=u.ownEvents?new Ti:Ti.Event,v=p.getBlockElements(),y=gu.overrideDefaults(function(){return{context:a,element:$.getRoot()}}),b=function(e){return e&&a&&K(e)?a.getElementById(e):e},C=function(e){return y("string"==typeof e?b(e):e)},w=function(e,t,n){var r,o,i=C(e);return i.length&&(o=(r=W[t])&&r.get?r.get(i,t):i.attr(t)),void 0===o&&(o=n||""),o},x=function(e){var t=b(e);return t?t.attributes:[]},S=function(e,t,n){""===n&&(n=null);var r,o=C(e),i=o.attr(t);o.length&&((r=W[t])&&r.set?r.set(o,n,t):o.attr(t,n),i!==n&&u.onSetAttrib&&u.onSetAttrib({attrElm:o,attrName:t,attrValue:n}))},N=function(){return u.root_element||a.body},E=function(e,t){return sr(a.body,b(e),t)},k=function(e,t,n){var r=C(e);return n?r.css(t):("float"===(t=t.replace(/-(\D)/g,function(e,t){return t.toUpperCase()}))&&(t=xt.browser.isIE()?"styleFloat":"cssFloat"),r[0]&&r[0].style?r[0].style[t]:undefined)},_=function(e){var t,n;return e=b(e),t=k(e,"width"),n=k(e,"height"),-1===t.indexOf("px")&&(t=0),-1===n.indexOf("px")&&(n=0),{w:parseInt(t,10)||e.offsetWidth||e.clientWidth,h:parseInt(n,10)||e.offsetHeight||e.clientHeight}},A=function(e,t){if(!e)return!1;if(!Array.isArray(e)){if("*"===t)return 1===e.nodeType;if(bu.test(t)){for(var n=t.toLowerCase().split(/,/),r=e.nodeName.toLowerCase(),o=n.length-1;0<=o;o--)if(n[o]===r)return!0;return!1}if(e.nodeType&&1!==e.nodeType)return!1}var i=Array.isArray(e)?e:[e];return 0<Ta(t,i[0].ownerDocument||i[0],null,i).length},R=function(e,t,n,r){var o,i=[],a=b(e);for(r=r===undefined,n=n||("BODY"!==N().nodeName?N().parentNode:null),_t.is(t,"string")&&(t="*"===(o=t)?function(e){return 1===e.nodeType}:function(e){return A(e,o)});a&&!(a===n||X(a.nodeType)||Un(a)||zn(a));){if(!t||"function"==typeof t&&t(a)){if(!r)return[a];i.push(a)}a=a.parentNode}return r?i:null},T=function(e,t,n){var r=t;if(e)for("string"==typeof t&&(r=function(e){return A(e,t)}),e=e[n];e;e=e[n])if("function"==typeof r&&r(e))return e;return null},D=function(e,n,r){var o,t="string"==typeof e?b(e):e;if(!t)return!1;if(_t.isArray(t)&&(t.length||0===t.length))return o=[],hu(t,function(e,t){e&&o.push(n.call(r,"string"==typeof e?b(e):e,t))}),o;var i=r||this;return n.call(i,t)},O=function(e,t){C(e).each(function(e,n){hu(t,function(e,t){S(n,t,e)})})},B=function(e,r){var t=C(e);yu?t.each(function(e,t){if(!1!==t.canHaveHTML){for(;t.firstChild;)t.removeChild(t.firstChild);try{t.innerHTML="<br>"+r,t.removeChild(t.firstChild)}catch(n){gu("<div></div>").html("<br>"+r).contents().slice(1).appendTo(t)}return r}}):t.html(r)},P=function(e,n,r,o,i){return D(e,function(e){var t="string"==typeof n?a.createElement(n):n;return O(t,r),o&&("string"!=typeof o&&o.nodeType?t.appendChild(o):"string"==typeof o&&B(t,o)),i?t:e.appendChild(t)})},L=function(e,t,n){return P(a.createElement(e),e,t,n,!0)},I=li.encodeAllRaw,M=function(e,t){var n=C(e);return t?n.each(function(){for(var e;e=this.firstChild;)3===e.nodeType&&0===e.data.length?this.removeChild(e):this.parentNode.insertBefore(e,this)}).remove():n.remove(),1<n.length?n.toArray():n[0]},F=function(e,t,n){C(e).toggleClass(t,n).each(function(){""===this.className&&gu(this).attr("class",null)})},U=function(t,e,n){return D(e,function(e){return _t.is(e,"array")&&(t=t.cloneNode(!0)),n&&hu(vu(e.childNodes),function(e){t.appendChild(e)}),e.parentNode.replaceChild(t,e)})},z=function(e){if(Rn(e)){var t="a"===e.nodeName.toLowerCase()&&!w(e,"href")&&w(e,"id");if(w(e,"name")||w(e,"data-mce-bookmark")||t)return!0}return!1},j=function(){return a.createRange()},H=function(e,t,n,r){if(_t.isArray(e)){for(var o=e.length,i=[];o--;)i[o]=H(e[o],t,n,r);return i}return!u.collect||e!==a&&e!==c||m.push([e,t,n,r]),h.bind(e,t,n,r||$)},V=function(e,t,n){if(_t.isArray(e)){for(var r=e.length,o=[];r--;)o[r]=V(e[r],t,n);return o}if(0<m.length&&(e===a||e===c))for(r=m.length;r--;){var i=m[r];e!==i[0]||t&&t!==i[1]||n&&n!==i[2]||h.unbind(i[0],i[1],i[2])}return h.unbind(e,t,n)},q=function(e){if(e&&Rn(e)){var t=e.getAttribute("data-mce-contenteditable");return t&&"inherit"!==t?t:"inherit"!==e.contentEditable?e.contentEditable:null}return null},$={doc:a,settings:u,win:c,files:l,stdMode:!0,boxModel:!0,styleSheetLoader:d,boundEvents:m,styles:g,schema:p,events:h,isBlock:function(e){if("string"==typeof e)return!!v[e];if(e){var t=e.nodeType;if(t)return!(1!==t||!v[e.nodeName])}return!1},$:y,$$:C,root:null,clone:function(t,e){if(!yu||1!==t.nodeType||e)return t.cloneNode(e);var n=a.createElement(t.nodeName);return hu(x(t),function(e){S(n,e.nodeName,w(t,e.nodeName))}),n},getRoot:N,getViewPort:function(e){var t=kn(e);return{x:t.x,y:t.y,w:t.width,h:t.height}},getRect:function(e){e=b(e);var t=E(e),n=_(e);return{x:t.x,y:t.y,w:n.w,h:n.h}},getSize:_,getParent:function(e,t,n){var r=R(e,t,n,!1);return r&&0<r.length?r[0]:null},getParents:R,get:b,getNext:function(e,t){return T(e,t,"nextSibling")},getPrev:function(e,t){return T(e,t,"previousSibling")},select:function(e,t){return Ta(e,b(t)||u.root_element||a,[])},is:A,add:P,create:L,createHTML:function(e,t,n){var r,o="";for(r in o+="<"+e,t)t.hasOwnProperty(r)&&null!==t[r]&&"undefined"!=typeof t[r]&&(o+=" "+r+'="'+I(t[r])+'"');return void 0!==n?o+">"+n+"</"+e+">":o+" />"},createFragment:function(e){var t,n=a.createElement("div"),r=a.createDocumentFragment();for(r.appendChild(n),e&&(n.innerHTML=e);t=n.firstChild;)r.appendChild(t);return r.removeChild(n),r},remove:M,setStyle:function(e,t,n){var r=K(t)?C(e).css(t,n):C(e).css(t);u.update_styles&&Cu(g,r)},getStyle:k,setStyles:function(e,t){var n=C(e).css(t);u.update_styles&&Cu(g,n)},removeAllAttribs:function(e){return D(e,function(e){for(var t=e.attributes,n=t.length-1;0<=n;n--)e.removeAttributeNode(t.item(n))})},setAttrib:S,setAttribs:O,getAttrib:w,getPos:E,parseStyle:function(e){return g.parse(e)},serializeStyle:function(e,t){return g.serialize(e,t)},addStyle:function(e){var t,n;if($!==xu.DOM&&a===document){if(s[e])return;s[e]=!0}(n=a.getElementById("mceDefaultStyles"))||((n=a.createElement("style")).id="mceDefaultStyles",n.type="text/css",(t=a.getElementsByTagName("head")[0]).firstChild?t.insertBefore(n,t.firstChild):t.appendChild(n)),n.styleSheet?n.styleSheet.cssText+=e:n.appendChild(a.createTextNode(e))},loadCSS:function(e){Y((e=e||"").split(","),function(e){l[e]=!0,d.load(e,te)})},addClass:function(e,t){C(e).addClass(t)},removeClass:function(e,t){F(e,t,!1)},hasClass:function(e,t){return C(e).hasClass(t)},toggleClass:F,show:function(e){C(e).show()},hide:function(e){C(e).hide()},isHidden:function(e){return"none"===C(e).css("display")},uniqueId:function(e){return(e||"mce_")+f++},setHTML:B,getOuterHTML:function(e){var t="string"==typeof e?b(e):e;return Rn(t)?t.outerHTML:gu("<div></div>").append(gu(t).clone()).html()},setOuterHTML:function(e,t){C(e).each(function(){try{if("outerHTML"in this)return void(this.outerHTML=t)}catch(e){}M(gu(this).html(t),!0)})},decode:li.decode,encode:I,insertAfter:function(e,t){var r=b(t);return D(e,function(e){var t=r.parentNode,n=r.nextSibling;return n?t.insertBefore(e,n):t.appendChild(e),e})},replace:U,rename:function(t,e){var n;return t.nodeName!==e.toUpperCase()&&(n=L(e),hu(x(t),function(e){S(n,e.nodeName,w(t,e.nodeName))}),U(n,t,!0)),n||t},findCommonAncestor:function(e,t){for(var n,r=e;r;){for(n=t;n&&r!==n;)n=n.parentNode;if(r===n)break;r=r.parentNode}return!r&&e.ownerDocument?e.ownerDocument.documentElement:r},toHex:function(e){return g.toHex(_t.trim(e))},run:D,getAttribs:x,isEmpty:function(e,t){var n,r,o=0;if(z(e))return!1;if(e=e.firstChild){var i=new Yr(e,e.parentNode),a=p?p.getWhiteSpaceElements():{};t=t||(p?p.getNonEmptyElements():null);do{if(n=e.nodeType,Rn(e)){var u=e.getAttribute("data-mce-bogus");if(u){e=i.next("all"===u);continue}if(r=e.nodeName.toLowerCase(),t&&t[r]){if("br"!==r)return!1;o++,e=i.next();continue}if(z(e))return!1}if(8===n)return!1;if(3===n&&!zo(e.nodeValue))return!1;if(3===n&&e.parentNode&&a[e.parentNode.nodeName]&&zo(e.nodeValue))return!1;e=i.next()}while(e)}return o<=1},createRng:j,nodeIndex:wu,split:function(e,t,n){var r,o,i,a=j();if(e&&t)return a.setStart(e.parentNode,wu(e)),a.setEnd(t.parentNode,wu(t)),r=a.extractContents(),(a=j()).setStart(t.parentNode,wu(t)+1),a.setEnd(e.parentNode,wu(e)+1),o=a.extractContents(),(i=e.parentNode).insertBefore(Go($,r),e),n?i.insertBefore(n,e):i.insertBefore(t,e),i.insertBefore(Go($,o),e),M(e),n||t},bind:H,unbind:V,fire:function(e,t,n){return h.fire(e,t,n)},getContentEditable:q,getContentEditableParent:function(e){for(var t=N(),n=null;e&&e!==t&&null===(n=q(e));e=e.parentNode);return n},destroy:function(){if(0<m.length)for(var e=m.length;e--;){var t=m[e];h.unbind(t[0],t[1],t[2])}se(l,function(e,t){d.unload(t),delete l[t]}),Ta.setDocument&&Ta.setDocument()},isChildOf:function(e,t){for(;e;){if(t===e)return!0;e=e.parentNode}return!1},dumpRng:function(e){return"startContainer: "+e.startContainer.nodeName+", startOffset: "+e.startOffset+", endContainer: "+e.endContainer.nodeName+", endOffset: "+e.endOffset}},W=(n=g,o=function(){return $},i=(r=u).keep_values,e={set:function(e,t,n){r.url_converter&&(t=r.url_converter.call(r.url_converter_scope||o(),t,n,e[0])),e.attr("data-mce-"+n,t).attr(n,t)},get:function(e,t){return e.attr("data-mce-"+t)||e.attr(t)}},t={style:{set:function(e,t){null===t||"object"!=typeof t?(i&&e.attr("data-mce-style",t),null!==t&&"string"==typeof t?(e.removeAttr("style"),e.css(n.parse(t))):e.attr("style",t)):e.css(t)},get:function(e){var t=e.attr("data-mce-style")||e.attr("style");return t=n.serialize(n.parse(t),e[0].nodeName)}}},i&&(t.href=t.src=e),t);return $};xu.DOM=xu(document),xu.nodeIndex=wu;var Su=xu.DOM,Nu=_t.each,Eu=_t.grep,ku=(_u.prototype._setReferrerPolicy=function(e){this.settings.referrerPolicy=e},_u.prototype.loadScript=function(e,t,n){var r=Su,o=function(){r.remove(i),a&&(a.onerror=a.onload=a=null)},i=r.uniqueId(),a=document.createElement("script");a.id=i,a.type="text/javascript",a.src=_t._addCacheSuffix(e),this.settings.referrerPolicy&&r.setAttrib(a,"referrerpolicy",this.settings.referrerPolicy),a.onload=function(){o(),t()},a.onerror=function(){o(),D(n)?n():"undefined"!=typeof console&&console.log&&console.log("Failed to load script: "+e)},(document.getElementsByTagName("head")[0]||document.body).appendChild(a)},_u.prototype.isDone=function(e){return 2===this.states[e]},_u.prototype.markDone=function(e){this.states[e]=2},_u.prototype.add=function(e,t,n,r){var o=this.states[e];this.queue.push(e),o===undefined&&(this.states[e]=0),t&&(this.scriptLoadedCallbacks[e]||(this.scriptLoadedCallbacks[e]=[]),this.scriptLoadedCallbacks[e].push({success:t,failure:r,scope:n||this}))},_u.prototype.load=function(e,t,n,r){return this.add(e,t,n,r)},_u.prototype.remove=function(e){delete this.states[e],delete this.scriptLoadedCallbacks[e]},_u.prototype.loadQueue=function(e,t,n){this.loadScripts(this.queue,e,t,n)},_u.prototype.loadScripts=function(n,e,t,r){var o=this,i=[],a=function(t,e){Nu(o.scriptLoadedCallbacks[e],function(e){D(e[t])&&e[t].call(e.scope)}),o.scriptLoadedCallbacks[e]=undefined};o.queueLoadedCallbacks.push({success:e,failure:r,scope:t||this});var u=function(){var e,t=Eu(n);n.length=0,Nu(t,function(e){2!==o.states[e]?3!==o.states[e]?1!==o.states[e]&&(o.states[e]=1,o.loading++,o.loadScript(e,function(){o.states[e]=2,o.loading--,a("success",e),u()},function(){o.states[e]=3,o.loading--,i.push(e),a("failure",e),u()})):a("failure",e):a("success",e)}),o.loading||(e=o.queueLoadedCallbacks.slice(0),o.queueLoadedCallbacks.length=0,Nu(e,function(e){0===i.length?D(e.success)&&e.success.call(e.scope):D(e.failure)&&e.failure.call(e.scope,i)}))};u()},_u.ScriptLoader=new _u,_u);function _u(e){void 0===e&&(e={}),this.states={},this.queue=[],this.scriptLoadedCallbacks={},this.queueLoadedCallbacks=[],this.loading=0,this.settings=e}var Au=function(e){var t=e;return{get:function(){return t},set:function(e){t=e}}},Ru={},Tu=Au("en"),Du=function(){return he(Ru,Tu.get())},Ou={getData:function(){return ce(Ru,function(e){return _e({},e)})},setCode:function(e){e&&Tu.set(e)},getCode:function(){return Tu.get()},add:function(e,t){var n=Ru[e];n||(Ru[e]=n={}),se(t,function(e,t){n[t.toLowerCase()]=e})},translate:function(e){var t,n,r=Du().getOr({}),o=function(e){return D(e)?Object.prototype.toString.call(e):i(e)?"":""+e},i=function(e){return""===e||null===e||e===undefined},a=function(e){var t=o(e);return he(r,t.toLowerCase()).map(o).getOr(t)},u=function(e){return e.replace(/{context:\w+}$/,"")};if(i(e))return"";if(k(t=e)&&ve(t,"raw"))return o(e.raw);if(_(n=e)&&1<n.length){var s=e.slice(1);return u(a(e[0]).replace(/\{([0-9]+)\}/g,function(e,t){return ve(s,t)?o(s[t]):e}))}return u(a(e))},isRtl:function(){return Du().bind(function(e){return he(e,"_dir")}).exists(function(e){return"rtl"===e})},hasCode:function(e){return ve(Ru,e)}},Bu=function(){var o=[],r={},s={},i=[],c=function(t,n){var e=H(i,function(e){return e.name===t&&e.state===n});Y(e,function(e){return e.callback()})},l=function(e){var t;return s[e]&&(t=s[e].dependencies),t||[]},f=function(e,t){return"object"==typeof t?t:"string"==typeof e?{prefix:"",resource:t,suffix:""}:{prefix:e.prefix,resource:t,suffix:e.suffix}},d=function(o,i,a,u,e){var t,n;r[o]||(0!==(t="string"==typeof i?i:i.prefix+i.resource+i.suffix).indexOf("/")&&-1===t.indexOf("://")&&(t=Bu.baseURL+"/"+t),r[o]=t.substring(0,t.lastIndexOf("/")),n=function(){var n,e,t,r;c(o,"loaded"),n=i,e=a,t=u,r=l(o),Y(r,function(e){var t=f(n,e);d(t.resource,t,undefined,undefined)}),e&&(t?e.call(t):e.call(ku))},s[o]?n():ku.ScriptLoader.add(t,n,u,e))},e=function(e,t,n){void 0===n&&(n="added"),ve(s,e)&&"added"===n||ve(r,e)&&"loaded"===n?t():i.push({name:e,state:n,callback:t})};return{items:o,urls:r,lookup:s,_listeners:i,get:function(e){return s[e]?s[e].instance:undefined},dependencies:l,requireLangPack:function(t,n){!1!==Bu.languageLoad&&e(t,function(){var e=Ou.getCode();!e||n&&-1===(","+(n||"")+",").indexOf(","+e+",")||ku.ScriptLoader.add(r[t]+"/langs/"+e+".js")},"loaded")},add:function(e,t,n){var r=t;return o.push(r),s[e]={instance:r,dependencies:n},c(e,"added"),r},remove:function(e){delete r[e],delete s[e]},createUrl:f,addComponents:function(e,t){var n=r[e];Y(t,function(e){ku.ScriptLoader.add(n+"/"+e)})},load:d,waitFor:e}};Bu.languageLoad=!0,Bu.baseURL="",Bu.PluginManager=Bu(),Bu.ThemeManager=Bu();var Pu=function(n,r){var o=null;return{cancel:function(){null!==o&&(clearTimeout(o),o=null)},throttle:function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];null===o&&(o=setTimeout(function(){n.apply(null,e),o=null},r))}}},Lu=function(n,r){var o=null;return{cancel:function(){null!==o&&(clearTimeout(o),o=null)},throttle:function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];null!==o&&clearTimeout(o),o=setTimeout(function(){n.apply(null,e),o=null},r)}}},Iu=function(e,t){var n=Jn(e,t);return n===undefined||""===n?[]:n.split(" ")},Mu=function(e){return e.dom.classList!==undefined},Fu=function(e,t){return o=t,i=Iu(n=e,r="class").concat([o]),Yn(n,r,i.join(" ")),!0;var n,r,o,i},Uu=function(e,t){return o=t,0<(i=H(Iu(n=e,r="class"),function(e){return e!==o})).length?Yn(n,r,i.join(" ")):Zn(n,r),!1;var n,r,o,i},zu=function(e,t){Mu(e)?e.dom.classList.add(t):Fu(e,t)},ju=function(e){0===(Mu(e)?e.dom.classList:Iu(e,"class")).length&&Zn(e,"class")},Hu=function(e,t){return Mu(e)&&e.dom.classList.contains(t)},Vu=function(e,t){var n=[];return Y(Jt(e),function(e){t(e)&&(n=n.concat([e])),n=n.concat(Vu(e,t))}),n},qu=function(e,t){return n=t,o=(r=e)===undefined?document:r.dom,Ot(o)?[]:z(o.querySelectorAll(n),Rt.fromDom);var n,r,o},$u=S("mce-annotation"),Wu=S("data-mce-annotation"),Ku=S("data-mce-annotation-uid"),Xu=function(r,e){var t=r.selection.getRng(),n=Rt.fromDom(t.startContainer),o=Rt.fromDom(r.getBody()),i=e.fold(function(){return"."+$u()},function(e){return"["+Wu()+'="'+e+'"]'}),a=Qt(n,t.startOffset).getOr(n),u=Lr(a,i,function(e){return Bt(e,o)}),s=function(e,t){return n=t,(r=e.dom)&&r.hasAttribute&&r.hasAttribute(n)?U.some(Jn(e,t)):U.none();var n,r};return u.bind(function(e){return s(e,""+Ku()).bind(function(n){return s(e,""+Wu()).map(function(e){var t=Yu(r,n);return{uid:n,name:e,elements:t}})})})},Yu=function(e,t){var n=Rt.fromDom(e.getBody());return qu(n,"["+Ku()+'="'+t+'"]')},Gu=function(i,e){var a=Au({}),c=function(e,t){u(e,function(e){return t(e),e})},u=function(e,t){var n=a.get(),r=t(n.hasOwnProperty(e)?n[e]:{listeners:[],previous:Au(U.none())});n[e]=r,a.set(n)},t=Lu(function(){var e,t,n,r=a.get(),o=(e=ae(r),(n=B.call(e,0)).sort(t),n);Y(o,function(e){u(e,function(u){var s=u.previous.get();return Xu(i,U.some(e)).fold(function(){var t;s.isSome()&&(c(t=e,function(e){Y(e.listeners,function(e){return e(!1,t)})}),u.previous.set(U.none()))},function(e){var t,n,r,o=e.uid,i=e.name,a=e.elements;s.is(o)||(n=o,r=a,c(t=i,function(e){Y(e.listeners,function(e){return e(!0,t,{uid:n,nodes:z(r,function(e){return e.dom})})})}),u.previous.set(U.some(o)))}),{previous:u.previous,listeners:u.listeners}})})},30);i.on("remove",function(){t.cancel()}),i.on("NodeChange",function(){t.throttle()});return{addListener:function(e,t){u(e,function(e){return{previous:e.previous,listeners:e.listeners.concat([t])}})}}},Ju=function(e,n){e.on("init",function(){e.serializer.addNodeFilter("span",function(e){Y(e,function(t){var e;e=t,U.from(e.attr(Wu())).bind(n.lookup).each(function(e){!1===e.persistent&&t.unwrap()})})})})},Qu=0,Zu=function(e){var t=(new Date).getTime();return e+"_"+Math.floor(1e9*Math.random())+ ++Qu+String(t)},es=function(e,t){var n,r,o=Vt(e).dom,i=Rt.fromDom(o.createDocumentFragment()),a=(n=t,(r=(o||document).createElement("div")).innerHTML=n,Jt(Rt.fromDom(r)));mn(i,a),pn(e),dn(e,i)},ts=function(e,t){return Rt.fromDom(e.dom.cloneNode(t))},ns=function(e){return ts(e,!1)},rs=function(e){return ts(e,!0)},os=function(e,t,n){void 0===n&&(n=b);var r=new Yr(e,t),o=function(e){for(var t;(t=r[e]())&&!Mn(t)&&!n(t););return U.from(t).filter(Mn)};return{current:function(){return U.from(r.current()).filter(Mn)},next:function(){return o("next")},prev:function(){return o("prev")},prev2:function(){return o("prev2")}}},is=function(t,e){var i=e||function(e){return t.isBlock(e)||jn(e)||qn(e)},a=function(e,t,n,r){if(Mn(e)){var o=r(e,t,e.data);if(-1!==o)return U.some({container:e,offset:o})}return n().bind(function(e){return a(e.container,e.offset,n,r)})};return{backwards:function(e,t,n,r){var o=os(e,r,i);return a(e,t,function(){return o.prev().map(function(e){return{container:e,offset:e.length}})},n).getOrNull()},forwards:function(e,t,n,r){var o=os(e,r,i);return a(e,t,function(){return o.next().map(function(e){return{container:e,offset:0}})},n).getOrNull()}}},as=function(e,t,n){return e.isSome()&&t.isSome()?U.some(n(e.getOrDie(),t.getOrDie())):U.none()},us=Math.round,ss=function(e){return e?{left:us(e.left),top:us(e.top),bottom:us(e.bottom),right:us(e.right),width:us(e.width),height:us(e.height)}:{left:0,top:0,bottom:0,right:0,width:0,height:0}},cs=function(e,t){return e=ss(e),t||(e.left=e.left+e.width),e.right=e.left,e.width=0,e},ls=function(e,t,n){return 0<=e&&e<=Math.min(t.height,n.height)/2},fs=function(e,t){var n=Math.min(t.height/2,e.height/2);return e.bottom-n<t.top||!(e.top>t.bottom)&&ls(t.top-e.bottom,e,t)},ds=function(e,t){return e.top>t.bottom||!(e.bottom<t.top)&&ls(t.bottom-e.top,e,t)},ms=function(e,t,n){return t>=e.left&&t<=e.right&&n>=e.top&&n<=e.bottom},ps=function(e){var t=e.startContainer,n=e.startOffset;return t.hasChildNodes()&&e.endOffset===n+1?t.childNodes[n]:null},gs=function(e,t){return 1===e.nodeType&&e.hasChildNodes()&&(t>=e.childNodes.length&&(t=e.childNodes.length-1),e=e.childNodes[t]),e},hs=new RegExp("[\u0300-\u036f\u0483-\u0487\u0488-\u0489\u0591-\u05bd\u05bf\u05c1-\u05c2\u05c4-\u05c5\u05c7\u0610-\u061a\u064b-\u065f\u0670\u06d6-\u06dc\u06df-\u06e4\u06e7-\u06e8\u06ea-\u06ed\u0711\u0730-\u074a\u07a6-\u07b0\u07eb-\u07f3\u0816-\u0819\u081b-\u0823\u0825-\u0827\u0829-\u082d\u0859-\u085b\u08e3-\u0902\u093a\u093c\u0941-\u0948\u094d\u0951-\u0957\u0962-\u0963\u0981\u09bc\u09be\u09c1-\u09c4\u09cd\u09d7\u09e2-\u09e3\u0a01-\u0a02\u0a3c\u0a41-\u0a42\u0a47-\u0a48\u0a4b-\u0a4d\u0a51\u0a70-\u0a71\u0a75\u0a81-\u0a82\u0abc\u0ac1-\u0ac5\u0ac7-\u0ac8\u0acd\u0ae2-\u0ae3\u0b01\u0b3c\u0b3e\u0b3f\u0b41-\u0b44\u0b4d\u0b56\u0b57\u0b62-\u0b63\u0b82\u0bbe\u0bc0\u0bcd\u0bd7\u0c00\u0c3e-\u0c40\u0c46-\u0c48\u0c4a-\u0c4d\u0c55-\u0c56\u0c62-\u0c63\u0c81\u0cbc\u0cbf\u0cc2\u0cc6\u0ccc-\u0ccd\u0cd5-\u0cd6\u0ce2-\u0ce3\u0d01\u0d3e\u0d41-\u0d44\u0d4d\u0d57\u0d62-\u0d63\u0dca\u0dcf\u0dd2-\u0dd4\u0dd6\u0ddf\u0e31\u0e34-\u0e3a\u0e47-\u0e4e\u0eb1\u0eb4-\u0eb9\u0ebb-\u0ebc\u0ec8-\u0ecd\u0f18-\u0f19\u0f35\u0f37\u0f39\u0f71-\u0f7e\u0f80-\u0f84\u0f86-\u0f87\u0f8d-\u0f97\u0f99-\u0fbc\u0fc6\u102d-\u1030\u1032-\u1037\u1039-\u103a\u103d-\u103e\u1058-\u1059\u105e-\u1060\u1071-\u1074\u1082\u1085-\u1086\u108d\u109d\u135d-\u135f\u1712-\u1714\u1732-\u1734\u1752-\u1753\u1772-\u1773\u17b4-\u17b5\u17b7-\u17bd\u17c6\u17c9-\u17d3\u17dd\u180b-\u180d\u18a9\u1920-\u1922\u1927-\u1928\u1932\u1939-\u193b\u1a17-\u1a18\u1a1b\u1a56\u1a58-\u1a5e\u1a60\u1a62\u1a65-\u1a6c\u1a73-\u1a7c\u1a7f\u1ab0-\u1abd\u1abe\u1b00-\u1b03\u1b34\u1b36-\u1b3a\u1b3c\u1b42\u1b6b-\u1b73\u1b80-\u1b81\u1ba2-\u1ba5\u1ba8-\u1ba9\u1bab-\u1bad\u1be6\u1be8-\u1be9\u1bed\u1bef-\u1bf1\u1c2c-\u1c33\u1c36-\u1c37\u1cd0-\u1cd2\u1cd4-\u1ce0\u1ce2-\u1ce8\u1ced\u1cf4\u1cf8-\u1cf9\u1dc0-\u1df5\u1dfc-\u1dff\u200c-\u200d\u20d0-\u20dc\u20dd-\u20e0\u20e1\u20e2-\u20e4\u20e5-\u20f0\u2cef-\u2cf1\u2d7f\u2de0-\u2dff\u302a-\u302d\u302e-\u302f\u3099-\u309a\ua66f\ua670-\ua672\ua674-\ua67d\ua69e-\ua69f\ua6f0-\ua6f1\ua802\ua806\ua80b\ua825-\ua826\ua8c4\ua8e0-\ua8f1\ua926-\ua92d\ua947-\ua951\ua980-\ua982\ua9b3\ua9b6-\ua9b9\ua9bc\ua9e5\uaa29-\uaa2e\uaa31-\uaa32\uaa35-\uaa36\uaa43\uaa4c\uaa7c\uaab0\uaab2-\uaab4\uaab7-\uaab8\uaabe-\uaabf\uaac1\uaaec-\uaaed\uaaf6\uabe5\uabe8\uabed\ufb1e\ufe00-\ufe0f\ufe20-\ufe2f\uff9e-\uff9f]"),vs=function(e){return"string"==typeof e&&768<=e.charCodeAt(0)&&hs.test(e)},ys=Rn,bs=Io,Cs=Dn("display","block table"),ws=Dn("float","left right"),xs=function(){for(var n=[],e=0;e<arguments.length;e++)n[e]=arguments[e];return function(e){for(var t=0;t<n.length;t++)if(!n[t](e))return!1;return!0}}(ys,bs,d(ws)),Ss=d(Dn("white-space","pre pre-line pre-wrap")),Ns=Mn,Es=jn,ks=xu.nodeIndex,_s=gs,As=function(e){return"createRange"in e?e.createRange():xu.DOM.createRng()},Rs=function(e){return e&&/[\r\n\t ]/.test(e)},Ts=function(e){return!!e.setStart&&!!e.setEnd},Ds=function(e){var t,n=e.startContainer,r=e.startOffset;return!!(Rs(e.toString())&&Ss(n.parentNode)&&Mn(n)&&(t=n.data,Rs(t[r-1])||Rs(t[r+1])))},Os=function(e){return 0===e.left&&0===e.right&&0===e.top&&0===e.bottom},Bs=function(e){var t=e.getClientRects(),n=0<t.length?ss(t[0]):ss(e.getBoundingClientRect());return!Ts(e)&&Es(e)&&Os(n)?function(e){var t=e.ownerDocument,n=As(t),r=t.createTextNode(fo),o=e.parentNode;o.insertBefore(r,e),n.setStart(r,0),n.setEnd(r,1);var i=ss(n.getBoundingClientRect());return o.removeChild(r),i}(e):Os(n)&&Ts(e)?function(e){var t=e.startContainer,n=e.endContainer,r=e.startOffset,o=e.endOffset;if(t===n&&Mn(n)&&0===r&&1===o){var i=e.cloneRange();return i.setEndAfter(n),Bs(i)}return null}(e):n},Ps=function(e,t){var n=cs(e,t);return n.width=1,n.right=n.left+1,n},Ls=function(e){var t,n,r=[],o=function(e){var t,n;0!==e.height&&(0<r.length&&(t=e,n=r[r.length-1],t.left===n.left&&t.top===n.top&&t.bottom===n.bottom&&t.right===n.right)||r.push(e))},i=function(e,t){var n=As(e.ownerDocument);if(t<e.data.length){if(vs(e.data[t]))return r;if(vs(e.data[t-1])&&(n.setStart(e,t),n.setEnd(e,t+1),!Ds(n)))return o(Ps(Bs(n),!1)),r}0<t&&(n.setStart(e,t-1),n.setEnd(e,t),Ds(n)||o(Ps(Bs(n),!1))),t<e.data.length&&(n.setStart(e,t),n.setEnd(e,t+1),Ds(n)||o(Ps(Bs(n),!0)))};if(Ns(e.container()))return i(e.container(),e.offset()),r;if(ys(e.container()))if(e.isAtEnd())n=_s(e.container(),e.offset()),Ns(n)&&i(n,n.data.length),xs(n)&&!Es(n)&&o(Ps(Bs(n),!1));else{if(n=_s(e.container(),e.offset()),Ns(n)&&i(n,0),xs(n)&&e.isAtEnd())return o(Ps(Bs(n),!1)),r;t=_s(e.container(),e.offset()-1),xs(t)&&!Es(t)&&(!Cs(t)&&!Cs(n)&&xs(n)||o(Ps(Bs(t),!1))),xs(n)&&o(Ps(Bs(n),!0))}return r},Is=function(t,n,e){var r=function(){return e=e||Ls(Is(t,n))};return{container:S(t),offset:S(n),toRange:function(){var e=As(t.ownerDocument);return e.setStart(t,n),e.setEnd(t,n),e},getClientRects:r,isVisible:function(){return 0<r().length},isAtStart:function(){return Ns(t),0===n},isAtEnd:function(){return Ns(t)?n>=t.data.length:n>=t.childNodes.length},isEqual:function(e){return e&&t===e.container()&&n===e.offset()},getNode:function(e){return _s(t,e?n-1:n)}}};Is.fromRangeStart=function(e){return Is(e.startContainer,e.startOffset)},Is.fromRangeEnd=function(e){return Is(e.endContainer,e.endOffset)},Is.after=function(e){return Is(e.parentNode,ks(e)+1)},Is.before=function(e){return Is(e.parentNode,ks(e))},Is.isAbove=function(e,t){return as(re(t.getClientRects()),oe(e.getClientRects()),fs).getOr(!1)},Is.isBelow=function(e,t){return as(oe(t.getClientRects()),re(e.getClientRects()),ds).getOr(!1)},Is.isAtStart=function(e){return!!e&&e.isAtStart()},Is.isAtEnd=function(e){return!!e&&e.isAtEnd()},Is.isTextPosition=function(e){return!!e&&Mn(e.container())},Is.isElementPosition=function(e){return!1===Is.isTextPosition(e)};var Ms,Fs,Us=function(e,t){Mn(t)&&0===t.data.length&&e.remove(t)},zs=function(e,t,n){var r,o,i,a,u,s,c;zn(n)?(i=e,a=t,u=n,s=U.from(u.firstChild),c=U.from(u.lastChild),a.insertNode(u),s.each(function(e){return Us(i,e.previousSibling)}),c.each(function(e){return Us(i,e.nextSibling)})):(r=e,o=n,t.insertNode(o),Us(r,o.previousSibling),Us(r,o.nextSibling))},js=Mn,Hs=Bn,Vs=xu.nodeIndex,qs=function(e){var t=e.parentNode;return Hs(t)?qs(t):t},$s=function(e){return e?Ne(e.childNodes,function(e,t){return Hs(t)&&"BR"!==t.nodeName?e=e.concat($s(t)):e.push(t),e},[]):[]},Ws=function(t){return function(e){return t===e}},Ks=function(e){var t=js(e)?"text()":e.nodeName.toLowerCase();return t+"["+function(e){var r=$s(qs(e)),t=Ee(r,Ws(e),e);r=r.slice(0,t+1);var n=Ne(r,function(e,t,n){return js(t)&&js(r[n-1])&&e++,e},0);return r=xe(r,Tn([e.nodeName])),(t=Ee(r,Ws(e),e))-n}(e)+"]"},Xs=function(e,t){var n,r,o,i=[],a=t.container(),u=t.offset();return js(a)?n=function(e,t){for(;(e=e.previousSibling)&&js(e);)t+=e.data.length;return t}(a,u):(u>=(r=a.childNodes).length?(n="after",u=r.length-1):n="before",a=r[u]),i.push(Ks(a)),o=function(e,t,n){var r=[];for(t=t.parentNode;t!==e&&(!n||!n(t));t=t.parentNode)r.push(t);return r}(e,a),o=xe(o,d(Bn)),(i=i.concat(we(o,Ks))).reverse().join("/")+","+n},Ys=function(e,t){if(!t)return null;var n=t.split(","),r=n[0].split("/"),o=1<n.length?n[1]:"before",i=Ne(r,function(e,t){var n,r,o,i,a=/([\w\-\(\)]+)\[([0-9]+)\]/.exec(t);return a?("text()"===a[1]&&(a[1]="#text"),n=e,r=a[1],o=parseInt(a[2],10),i=$s(n),i=xe(i,function(e,t){return!js(e)||!js(i[t-1])}),(i=xe(i,Tn([r])))[o]):null},e);return i?js(i)?function(e,t){for(var n,r=e,o=0;js(r);){if(n=r.data.length,o<=t&&t<=o+n){e=r,t-=o;break}if(!js(r.nextSibling)){e=r,t=n;break}o+=n,r=r.nextSibling}return js(e)&&t>e.data.length&&(t=e.data.length),Is(e,t)}(i,parseInt(o,10)):(o="after"===o?Vs(i)+1:Vs(i),Is(i.parentNode,o)):null},Gs=qn,Js=function(e,t,n,r,o){var i,a=r[o?"startContainer":"endContainer"],u=r[o?"startOffset":"endOffset"],s=[],c=0,l=e.getRoot();for(Mn(a)?s.push(n?function(e,t,n){for(var r=e(t.data.slice(0,n)).length,o=t.previousSibling;o&&Mn(o);o=o.previousSibling)r+=e(o.data).length;return r}(t,a,u):u):(u>=(i=a.childNodes).length&&i.length&&(c=1,u=Math.max(0,i.length-1)),s.push(e.nodeIndex(i[u],n)+c));a&&a!==l;a=a.parentNode)s.push(e.nodeIndex(a,n));return s},Qs=function(e,t,n){var r=0;return _t.each(e.select(t),function(e){if("all"!==e.getAttribute("data-mce-bogus"))return e!==n&&void r++}),r},Zs=function(e,t){var n,r=t?"start":"end",o=e[r+"Container"],i=e[r+"Offset"];Rn(o)&&"TR"===o.nodeName&&(o=(n=o.childNodes)[Math.min(t?i:i-1,n.length-1)])&&(i=t?0:o.childNodes.length,e["set"+(t?"Start":"End")](o,i))},ec=function(e){return Zs(e,!0),Zs(e,!1),e},tc=function(e,t){var n;if(Rn(e)&&(e=gs(e,t),Gs(e)))return e;if(Co(e)){if(Mn(e)&&yo(e)&&(e=e.parentNode),n=e.previousSibling,Gs(n))return n;if(n=e.nextSibling,Gs(n))return n}},nc=function(e,t,n){var r=n.getNode(),o=r?r.nodeName:null,i=n.getRng();if(Gs(r)||"IMG"===o)return{name:o,index:Qs(n.dom,o,r)};var a,u,s,c,l,f,d,m=tc((a=i).startContainer,a.startOffset)||tc(a.endContainer,a.endOffset);return m?{name:o=m.tagName,index:Qs(n.dom,o,m)}:(u=e,c=t,l=i,f=(s=n).dom,(d={}).start=Js(f,u,c,l,!0),s.isCollapsed()||(d.end=Js(f,u,c,l,!1)),d)},rc=function(e,t,n){var r={"data-mce-type":"bookmark",id:t,style:"overflow:hidden;line-height:0px"};return n?e.create("span",r,"&#xFEFF;"):e.create("span",r)},oc=function(e,t){var n=e.dom,r=e.getRng(),o=n.uniqueId(),i=e.isCollapsed(),a=e.getNode(),u=a.nodeName;if("IMG"===u)return{name:u,index:Qs(n,u,a)};var s,c=ec(r.cloneRange());i||(c.collapse(!1),s=rc(n,o+"_end",t),zs(n,c,s)),(r=ec(r)).collapse(!0);var l=rc(n,o+"_start",t);return zs(n,r,l),e.moveToBookmark({id:o,keep:!0}),{id:o}},ic=function(e,t,n){return 2===t?nc(go,n,e):3===t?(o=(r=e).getRng(),{start:Xs(r.dom.getRoot(),Is.fromRangeStart(o)),end:Xs(r.dom.getRoot(),Is.fromRangeEnd(o))}):t?{rng:e.getRng()}:oc(e,!1);var r,o},ac=N(nc,o,!0),uc=xu.DOM,sc=function(e,t,n){var r=e.getParam(t,n);if(-1===r.indexOf("="))return r;var o=e.getParam(t,"","hash");return o.hasOwnProperty(e.id)?o[e.id]:n},cc=function(e){return e.getParam("content_security_policy","")},lc=function(e){if(e.getParam("force_p_newlines",!1))return"p";var t=e.getParam("forced_root_block","p");return!1===t?"":!0===t?"p":t},fc=function(e){return e.getParam("forced_root_block_attrs",{})},dc=function(e){return e.getParam("automatic_uploads",!0,"boolean")},mc=function(e){return e.getParam("icons","","string")},pc=function(e){return e.getParam("referrer_policy","","string")},gc=function(e){return e.getParam("language","en","string")},hc=function(e){return e.getParam("indent_use_margin",!1)},vc=function(e){var t=e.getParam("font_css",[]);return _(t)?t:z(t.split(","),We)},yc=function(e){var t=e.getParam("object_resizing");return!1!==t&&!xt.iOS&&(K(t)?t:"table,img,figure.image,div,video,iframe")},bc=function(e){return e.getParam("event_root")},Cc=function(e){return e.getParam("theme")},wc=function(e){return!1!==e.getParam("inline_boundaries")},xc=function(e){return e.getParam("plugins","","string")},Sc=Rn,Nc=Mn,Ec=function(e){var t=e.parentNode;t&&t.removeChild(e)},kc=function(e){var t=go(e);return{count:e.length-t.length,text:t}},_c=function(e){for(var t;-1!==(t=e.data.lastIndexOf(mo));)e.deleteData(t,1)},Ac=function(e,t){return Oc(e),t},Rc=function(e,t){var n,r,o=t.container(),i=(n=ie(o.childNodes),(-1===(r=I(n,e))?U.none():U.some(r)).map(function(e){return e<t.offset()?Is(o,t.offset()-1):t}).getOr(t));return Oc(e),i},Tc=function(e,t){return Nc(e)&&t.container()===e?(r=t,o=kc((n=e).data.substr(0,r.offset())),i=kc(n.data.substr(r.offset())),0<(o.text+i.text).length?(_c(n),Is(n,r.offset()-o.count)):r):Ac(e,t);var n,r,o,i},Dc=function(e,t){return Is.isTextPosition(t)?Tc(e,t):(n=e,((r=t).container()===n.parentNode?Rc:Ac)(n,r));var n,r},Oc=function(e){Sc(e)&&Co(e)&&(wo(e)?e.removeAttribute("data-mce-caret"):Ec(e)),Nc(e)&&(_c(e),0===e.data.length&&Ec(e))},Bc=mt().browser,Pc=qn,Lc=Wn,Ic=$n,Mc=function(e,t,n){var r,o,i,a,u=cs(t.getBoundingClientRect(),n),s="BODY"===e.tagName?(r=e.ownerDocument.documentElement,o=e.scrollLeft||r.scrollLeft,e.scrollTop||r.scrollTop):(a=e.getBoundingClientRect(),o=e.scrollLeft-a.left,e.scrollTop-a.top);return u.left+=o,u.right+=o,u.top+=s,u.bottom+=s,u.width=1,0<(i=t.offsetWidth-t.clientWidth)&&(n&&(i*=-1),u.left+=i,u.right+=i),u},Fc=function(e,i,a,t){var n,u,s=Au(U.none()),r=lc(e),c=0<r.length?r:"p",l=function(){!function(e){for(var t=qu(Rt.fromDom(e),"*[contentEditable=false],video,audio,embed,object"),n=0;n<t.length;n++){var r,o=t[n].dom,i=o.previousSibling;ko(i)&&(1===(r=i.data).length?i.parentNode.removeChild(i):i.deleteData(r.length-1,1)),i=o.nextSibling,Eo(i)&&(1===(r=i.data).length?i.parentNode.removeChild(i):i.deleteData(0,1))}}(i),u&&(Oc(u),u=null),s.get().each(function(e){gu(e.caret).remove(),s.set(U.none())}),n&&(Wr.clearInterval(n),n=null)},f=function(){n=Wr.setInterval(function(){t()?gu("div.mce-visual-caret",i).toggleClass("mce-visual-caret-hidden"):gu("div.mce-visual-caret",i).addClass("mce-visual-caret-hidden")},500)};return{show:function(t,e){var n,r;if(l(),Ic(e))return null;if(!a(e))return u=function(e,t){var n,r=e.ownerDocument.createTextNode(mo),o=e.parentNode;if(t){if(n=e.previousSibling,vo(n)){if(Co(n))return n;if(ko(n))return n.splitText(n.data.length-1)}o.insertBefore(r,e)}else{if(n=e.nextSibling,vo(n)){if(Co(n))return n;if(Eo(n))return n.splitText(1),n}e.nextSibling?o.insertBefore(r,e.nextSibling):o.appendChild(r)}return r}(e,t),r=e.ownerDocument.createRange(),zc(u.nextSibling)?(r.setStart(u,0),r.setEnd(u,0)):(r.setStart(u,1),r.setEnd(u,1)),r;u=No(c,e,t),n=Mc(i,e,t),gu(u).css("top",n.top);var o=gu('<div class="mce-visual-caret" data-mce-bogus="all"></div>').css(n).appendTo(i)[0];return s.set(U.some({caret:o,element:e,before:t})),s.get().each(function(e){t&&gu(e.caret).addClass("mce-visual-caret-before")}),f(),(r=e.ownerDocument.createRange()).setStart(u,0),r.setEnd(u,0),r},hide:l,getCss:function(){return".mce-visual-caret {position: absolute;background-color: black;background-color: currentcolor;}.mce-visual-caret-hidden {display: none;}*[data-mce-caret] {position: absolute;left: -1000px;right: auto;top: 0;margin: 0;padding: 0;}"},reposition:function(){s.get().each(function(e){var t=Mc(i,e.element,e.before);gu(e.caret).css(_e({},t))})},destroy:function(){return Wr.clearInterval(n)}}},Uc=function(){return Bc.isIE()||Bc.isEdge()||Bc.isFirefox()},zc=function(e){return Pc(e)||Lc(e)},jc=function(e){return zc(e)||Pn(e)&&Uc()},Hc=qn,Vc=Wn,qc=Dn("display","block table table-cell table-caption list-item"),$c=Co,Wc=yo,Kc=Rn,Xc=Io,Yc=function(e,t){for(var n;n=e(t);)if(!Wc(n))return n;return null},Gc=function(e,t,n,r,o){var i=new Yr(e,r),a=Hc(e)||Wc(e);if(t<0){if(a&&n(e=Yc(i.prev.bind(i),!0)))return e;for(;e=Yc(i.prev.bind(i),o);)if(n(e))return e}if(0<t){if(a&&n(e=Yc(i.next.bind(i),!0)))return e;for(;e=Yc(i.next.bind(i),o);)if(n(e))return e}return null},Jc=function(e,t){for(;e&&e!==t;){if(qc(e))return e;e=e.parentNode}return null},Qc=function(e,t,n){return Jc(e.container(),n)===Jc(t.container(),n)},Zc=function(e,t){if(!t)return null;var n=t.container(),r=t.offset();return Kc(n)?n.childNodes[r+e]:null},el=function(e,t){var n=t.ownerDocument.createRange();return e?(n.setStartBefore(t),n.setEndBefore(t)):(n.setStartAfter(t),n.setEndAfter(t)),n},tl=function(e,t,n){for(var r,o,i,a=e?"previousSibling":"nextSibling";n&&n!==t;){if(r=n[a],$c(r)&&(r=r[a]),Hc(r)||Vc(r)){if(i=n,Jc(r,o=t)===Jc(i,o))return r;break}if(Xc(r))break;n=n.parentNode}return null},nl=N(el,!0),rl=N(el,!1),ol=function(e,t,n){var r,o,i=N(tl,!0,t),a=N(tl,!1,t),u=n.startContainer,s=n.startOffset;if(yo(u)){if(Kc(u)||(u=u.parentNode),"before"===(o=u.getAttribute("data-mce-caret"))&&(r=u.nextSibling,jc(r)))return nl(r);if("after"===o&&(r=u.previousSibling,jc(r)))return rl(r)}if(!n.collapsed)return n;if(Mn(u)){if($c(u)){if(1===e){if(r=a(u))return nl(r);if(r=i(u))return rl(r)}if(-1===e){if(r=i(u))return rl(r);if(r=a(u))return nl(r)}return n}if(ko(u)&&s>=u.data.length-1)return 1===e&&(r=a(u))?nl(r):n;if(Eo(u)&&s<=1)return-1===e&&(r=i(u))?rl(r):n;if(s===u.data.length)return(r=a(u))?nl(r):n;if(0===s)return(r=i(u))?rl(r):n}return n},il=function(e,t){return U.from(Zc(e?0:-1,t)).filter(Hc)},al=function(e,t,n){var r=ol(e,t,n);return-1===e?Is.fromRangeStart(r):Is.fromRangeEnd(r)},ul=function(e){return U.from(e.getNode()).map(Rt.fromDom)},sl=function(e,t){for(;t=e(t);)if(t.isVisible())return t;return t},cl=function(e,t){var n=Qc(e,t);return!(n||!jn(e.getNode()))||n};(Fs=Ms=Ms||{})[Fs.Backwards=-1]="Backwards",Fs[Fs.Forwards=1]="Forwards";var ll,fl,dl,ml,pl=qn,gl=Mn,hl=Rn,vl=jn,yl=Io,bl=function(e){return Bo(e)||!!Mo(t=e)&&!0!==$(ie(t.getElementsByTagName("*")),function(e,t){return e||Ao(t)},!1);var t},Cl=Fo,wl=function(e,t){return e.hasChildNodes()&&t<e.childNodes.length?e.childNodes[t]:null},xl=function(e,t){if(0<e){if(yl(t.previousSibling)&&!gl(t.previousSibling))return Is.before(t);if(gl(t))return Is(t,0)}if(e<0){if(yl(t.nextSibling)&&!gl(t.nextSibling))return Is.after(t);if(gl(t))return Is(t,t.data.length)}return!(e<0)||vl(t)?Is.before(t):Is.after(t)},Sl=function(e,t,n){var r,o,i,a;if(!hl(n)||!t)return null;if(t.isEqual(Is.after(n))&&n.lastChild){if(a=Is.after(n.lastChild),e<0&&yl(n.lastChild)&&hl(n.lastChild))return vl(n.lastChild)?Is.before(n.lastChild):a}else a=t;var u,s,c,l=a.container(),f=a.offset();if(gl(l)){if(e<0&&0<f)return Is(l,--f);if(0<e&&f<l.length)return Is(l,++f);r=l}else{if(e<0&&0<f&&(o=wl(l,f-1),yl(o)))return!bl(o)&&(i=Gc(o,e,Cl,o))?gl(i)?Is(i,i.data.length):Is.after(i):gl(o)?Is(o,o.data.length):Is.before(o);if(0<e&&f<l.childNodes.length&&(o=wl(l,f),yl(o)))return vl(o)?(u=n,(c=(s=o).nextSibling)&&yl(c)?gl(c)?Is(c,0):Is.before(c):Sl(Ms.Forwards,Is.after(s),u)):!bl(o)&&(i=Gc(o,e,Cl,o))?gl(i)?Is(i,0):Is.before(i):gl(o)?Is(o,0):Is.after(o);r=o||a.getNode()}if((0<e&&a.isAtEnd()||e<0&&a.isAtStart())&&(r=Gc(r,e,w,n,!0),Cl(r,n)))return xl(e,r);o=Gc(r,e,Cl,n);var d=ke(H(function(e,t){for(var n=[];e&&e!==t;)n.push(e),e=e.parentNode;return n}(l,n),pl));return!d||o&&d.contains(o)?o?xl(e,o):null:a=0<e?Is.after(d):Is.before(d)},Nl=function(t){return{next:function(e){return Sl(Ms.Forwards,e,t)},prev:function(e){return Sl(Ms.Backwards,e,t)}}},El=function(e){return Is.isTextPosition(e)?0===e.offset():Io(e.getNode())},kl=function(e){if(Is.isTextPosition(e)){var t=e.container();return e.offset()===t.data.length}return Io(e.getNode(!0))},_l=function(e,t){return!Is.isTextPosition(e)&&!Is.isTextPosition(t)&&e.getNode()===t.getNode(!0)},Al=function(e,t,n){return e?!_l(t,n)&&(r=t,!(!Is.isTextPosition(r)&&jn(r.getNode())))&&kl(t)&&El(n):!_l(n,t)&&El(t)&&kl(n);var r},Rl=function(e,t,n){var r=Nl(t);return U.from(e?r.next(n):r.prev(n))},Tl=function(t,n,r){return Rl(t,n,r).bind(function(e){return Qc(r,e,n)&&Al(t,r,e)?Rl(t,n,e):U.some(e)})},Dl=function(t,n,e,r){return Tl(t,n,e).bind(function(e){return r(e)?Dl(t,n,e,r):U.some(e)})},Ol=function(e,t){var n,r,o,i,a,u=e?t.firstChild:t.lastChild;return Mn(u)?U.some(Is(u,e?0:u.data.length)):u?Io(u)?U.some(e?Is.before(u):jn(a=u)?Is.before(a):Is.after(a)):(r=t,o=u,i=(n=e)?Is.before(o):Is.after(o),Rl(n,r,i)):U.none()},Bl=N(Rl,!0),Pl=N(Rl,!1),Ll=N(Ol,!0),Il=N(Ol,!1),Ml="_mce_caret",Fl=function(e){return Rn(e)&&e.id===Ml},Ul=function(e,t){for(;t&&t!==e;){if(t.id===Ml)return t;t=t.parentNode}return null},zl=function(e,t){return Rn(t)&&e.isBlock(t)&&!t.innerHTML&&!xt.ie&&(t.innerHTML='<br data-mce-bogus="1" />'),t},jl=function(e,t,n){return!(!1!==t.hasChildNodes()||!Ul(e,t))&&(o=n,i=(r=t).ownerDocument.createTextNode(mo),r.appendChild(i),o.setStart(i,0),o.setEnd(i,0),!0);var r,o,i},Hl=function(e,t,n,r){var o,i,a,u,s=n[t?"start":"end"],c=e.getRoot();if(s){for(a=s[0],i=c,o=s.length-1;1<=o;o--){if(u=i.childNodes,jl(c,i,r))return!0;if(s[o]>u.length-1)return!!jl(c,i,r)||function(e,t){return Il(e).fold(b,function(e){return t.setStart(e.container(),e.offset()),t.setEnd(e.container(),e.offset()),!0})}(i,r);i=u[s[o]]}3===i.nodeType&&(a=Math.min(s[0],i.nodeValue.length)),1===i.nodeType&&(a=Math.min(s[0],i.childNodes.length)),t?r.setStart(i,a):r.setEnd(i,a)}return!0},Vl=function(e){return Mn(e)&&0<e.data.length},ql=function(e,t,n){var r,o,i,a,u,s,c=e.get(n.id+"_"+t),l=n.keep;if(c){if(r=c.parentNode,s=(u=(o="start"===t?l?c.hasChildNodes()?(r=c.firstChild,1):Vl(c.nextSibling)?(r=c.nextSibling,0):Vl(c.previousSibling)?(r=c.previousSibling,c.previousSibling.data.length):(r=c.parentNode,e.nodeIndex(c)+1):e.nodeIndex(c):l?c.hasChildNodes()?(r=c.firstChild,1):Vl(c.previousSibling)?(r=c.previousSibling,c.previousSibling.data.length):(r=c.parentNode,e.nodeIndex(c)):e.nodeIndex(c),r),o),!l){for(a=c.previousSibling,i=c.nextSibling,_t.each(_t.grep(c.childNodes),function(e){Mn(e)&&(e.nodeValue=e.nodeValue.replace(/\uFEFF/g,""))});c=e.get(n.id+"_"+t);)e.remove(c,!0);a&&i&&a.nodeType===i.nodeType&&Mn(a)&&!xt.opera&&(o=a.nodeValue.length,a.appendData(i.nodeValue),e.remove(i),u=a,s=o)}return U.some(Is(u,s))}return U.none()},$l=function(e,t){var n,r,o,i,a,u,s,c,l,f,d,m,p,g,h=e.dom;if(t){if(g=t,_t.isArray(g.start))return m=t,p=(d=h).createRng(),Hl(d,!0,m,p)&&Hl(d,!1,m,p)?U.some(p):U.none();if(K(t.start))return U.some((c=t,l=(s=h).createRng(),f=Ys(s.getRoot(),c.start),l.setStart(f.container(),f.offset()),f=Ys(s.getRoot(),c.end),l.setEnd(f.container(),f.offset()),l));if(t.hasOwnProperty("id"))return a=ql(o=h,"start",i=t),u=ql(o,"end",i),as(a,u.or(a),function(e,t){var n=o.createRng();return n.setStart(zl(o,e.container()),e.offset()),n.setEnd(zl(o,t.container()),t.offset()),n});if(t.hasOwnProperty("name"))return n=h,r=t,U.from(n.select(r.name)[r.index]).map(function(e){var t=n.createRng();return t.selectNode(e),t});if(t.hasOwnProperty("rng"))return U.some(t.rng)}return U.none()},Wl=ic,Kl=function(t,e){$l(t,e).each(function(e){t.setRng(e)})},Xl=function(e){return Rn(e)&&"SPAN"===e.tagName&&"bookmark"===e.getAttribute("data-mce-type")},Yl=(ll=fo,function(e){return ll===e}),Gl=function(e){return""!==e&&-1!==" \f\n\r\t\x0B".indexOf(e)},Jl=function(e){return!Gl(e)&&!Yl(e)},Ql=function(e){return!!e.nodeType},Zl=function(e,t,n){var r,o,i,a,u=n.startOffset,s=n.startContainer;if((n.startContainer!==n.endContainer||!(a=n.startContainer.childNodes[n.startOffset])||!/^(IMG)$/.test(a.nodeName))&&1===s.nodeType)for(u<(i=s.childNodes).length?(s=i[u],r=new Yr(s,e.getParent(s,e.isBlock))):(s=i[i.length-1],(r=new Yr(s,e.getParent(s,e.isBlock))).next(!0)),o=r.current();o;o=r.next())if(3===o.nodeType&&!rf(o))return n.setStart(o,0),void t.setRng(n)},ef=function(e,t,n){if(e){var r=t?"nextSibling":"previousSibling";for(e=n?e:e[r];e;e=e[r])if(1===e.nodeType||!rf(e))return e}},tf=function(e,t){return Ql(t)&&(t=t.nodeName),!!e.schema.getTextBlockElements()[t.toLowerCase()]},nf=function(e,t,n){return e.schema.isValidChild(t,n)},rf=function(e,t){if(void 0===t&&(t=!1),V(e)&&Mn(e)){var n=t?e.data.replace(/ /g,"\xa0"):e.data;return zo(n)}return!1},of=function(e,n){return"string"!=typeof e?e=e(n):n&&(e=e.replace(/%(\w+)/g,function(e,t){return n[t]||e})),e},af=function(e,t){return e=""+((e=e||"").nodeName||e),t=""+((t=t||"").nodeName||t),e.toLowerCase()===t.toLowerCase()},uf=function(e,t,n){return"color"!==n&&"backgroundColor"!==n||(t=e.toHex(t)),"fontWeight"===n&&700===t&&(t="bold"),"fontFamily"===n&&(t=t.replace(/[\'\"]/g,"").replace(/,\s+/g,",")),""+t},sf=function(e,t,n){return uf(e,e.getStyle(t,n),n)},cf=function(t,e){var n;return t.getParent(e,function(e){return(n=t.getStyle(e,"text-decoration"))&&"none"!==n}),n},lf=function(e,t,n){return e.getParents(t,n,e.getRoot())},ff=function(t,e,n){var r=["inline","block","selector","attributes","styles","classes"],a=function(e){return pe(e,function(e,t){return F(r,function(e){return e===t})})};return F(t.formatter.get(e),function(e){var i=a(e);return F(t.formatter.get(n),function(e){var t,n,r,o=a(e);return t=i,n=o,void 0===r&&(r=l),u(r).eq(t,n)})})},df=function(e){return ye(e,"block")},mf=function(e){return ye(e,"selector")},pf=function(e){return ye(e,"inline")},gf=Xl,hf=lf,vf=rf,yf=tf,bf=function(e,t){for(var n=t;n;){if(Rn(n)&&e.getContentEditable(n))return"false"===e.getContentEditable(n)?n:t;n=n.parentNode}return t},Cf=function(e,t,n,r){for(var o=t.data,i=n;e?0<=i:i<o.length;e?i--:i++)if(r(o.charAt(i)))return e?i+1:i;return-1},wf=function(e,t,n){return Cf(e,t,n,function(e){return Yl(e)||Gl(e)})},xf=function(e,t,n){return Cf(e,t,n,Jl)},Sf=function(i,e,t,n,a,r){var u,s=i.getParent(t,i.isBlock)||e,o=function(e,t,n){var r=is(i),o=a?r.backwards:r.forwards;return U.from(o(e,t,function(e,t){return gf(e.parentNode)?-1:n(a,u=e,t)},s))};return o(t,n,wf).bind(function(e){return r?o(e.container,e.offset+(a?-1:0),xf):U.some(e)}).orThunk(function(){return u?U.some({container:u,offset:a?0:u.length}):U.none()})},Nf=function(e,t,n,r,o){Mn(r)&&0===r.nodeValue.length&&r[o]&&(r=r[o]);for(var i=hf(e,r),a=0;a<i.length;a++)for(var u=0;u<t.length;u++){var s=t[u];if(!("collapsed"in s&&s.collapsed!==n.collapsed)&&e.is(i[a],s.selector))return i[a]}return r},Ef=function(t,e,n,r){var o,i,a=t.dom,u=a.getRoot();if(e[0].wrapper||(i=a.getParent(n,e[0].block,u)),i||(o=a.getParent(n,"LI,TD,TH"),i=a.getParent(Mn(n)?n.parentNode:n,function(e){return e!==u&&yf(t,e)},o)),i&&e[0].wrapper&&(i=hf(a,i,"ul,ol").reverse()[0]||i),!i)for(i=n;i[r]&&!a.isBlock(i[r])&&(i=i[r],!af(i,"br")););return i||n},kf=function(e,t,n,r){var o=n.parentNode;return!V(n[r])&&(!(o!==t&&!X(o)&&!e.isBlock(o))||kf(e,t,o,r))},_f=function(e,t,n,r,o){var i,a,u=n,s=o?"previousSibling":"nextSibling",c=e.getRoot();if(Mn(n)&&!vf(n)&&(o?0<r:r<n.data.length))return n;for(;;){if(!t[0].block_expand&&e.isBlock(u))return u;for(i=u[s];i;i=i[s]){var l=Mn(i)&&!kf(e,c,i,s);if(!gf(i)&&(!jn(a=i)||!a.getAttribute("data-mce-bogus")||a.nextSibling)&&!vf(i,l))return u}if(u===c||u.parentNode===c){n=u;break}u=u.parentNode}return n},Af=function(e){return gf(e.parentNode)||gf(e)},Rf=function(e,t,n,r){void 0===r&&(r=!1);var o=t.startContainer,i=t.startOffset,a=t.endContainer,u=t.endOffset,s=e.dom;return Rn(o)&&o.hasChildNodes()&&(o=gs(o,i),Mn(o)&&(i=0)),Rn(a)&&a.hasChildNodes()&&(a=gs(a,t.collapsed?u:u-1),Mn(a)&&(u=a.nodeValue.length)),o=bf(s,o),a=bf(s,a),Af(o)&&(o=gf(o)?o:o.parentNode,o=t.collapsed?o.previousSibling||o:o.nextSibling||o,Mn(o)&&(i=t.collapsed?o.length:0)),Af(a)&&(a=gf(a)?a:a.parentNode,a=t.collapsed?a.nextSibling||a:a.previousSibling||a,Mn(a)&&(u=t.collapsed?0:a.length)),t.collapsed&&(Sf(s,e.getBody(),o,i,!0,r).each(function(e){var t=e.container,n=e.offset;o=t,i=n}),Sf(s,e.getBody(),a,u,!1,r).each(function(e){var t=e.container,n=e.offset;a=t,u=n})),(n[0].inline||n[0].block_expand)&&(n[0].inline&&Mn(o)&&0!==i||(o=_f(s,n,o,i,!0)),n[0].inline&&Mn(a)&&u!==a.nodeValue.length||(a=_f(s,n,a,u,!1))),n[0].selector&&!1!==n[0].expand&&!n[0].inline&&(o=Nf(s,n,t,o,"previousSibling"),a=Nf(s,n,t,a,"nextSibling")),(n[0].block||n[0].selector)&&(o=Ef(e,n,o,"previousSibling"),a=Ef(e,n,a,"nextSibling"),n[0].block&&(s.isBlock(o)||(o=_f(s,n,o,i,!0)),s.isBlock(a)||(a=_f(s,n,a,u,!1)))),Rn(o)&&(i=s.nodeIndex(o),o=o.parentNode),Rn(a)&&(u=s.nodeIndex(a)+1,a=a.parentNode),{startContainer:o,startOffset:i,endContainer:a,endOffset:u}},Tf=function(e,t){var n=e.childNodes;return t>=n.length?t=n.length-1:t<0&&(t=0),n[t]||e},Df=function(e,t,u){var n=t.startContainer,r=t.startOffset,o=t.endContainer,i=t.endOffset,s=function(e){var t=e[0];return 3===t.nodeType&&t===n&&r>=t.nodeValue.length&&e.splice(0,1),t=e[e.length-1],0===i&&0<e.length&&t===o&&3===t.nodeType&&e.splice(e.length-1,1),e},c=function(e,t,n){for(var r=[];e&&e!==n;e=e[t])r.push(e);return r},a=function(e,t){do{if(e.parentNode===t)return e;e=e.parentNode}while(e)},l=function(e,t,n){for(var r=n?"nextSibling":"previousSibling",o=e,i=o.parentNode;o&&o!==t;o=i){i=o.parentNode;var a=c(o===e?o:o[r],r);a.length&&(n||a.reverse(),u(s(a)))}};if(1===n.nodeType&&n.hasChildNodes()&&(n=Tf(n,r)),1===o.nodeType&&o.hasChildNodes()&&(o=Tf(o,i-1)),n===o)return u(s([n]));for(var f=e.findCommonAncestor(n,o),d=n;d;d=d.parentNode){if(d===o)return l(n,f,!0);if(d===f)break}for(d=o;d;d=d.parentNode){if(d===n)return l(o,f);if(d===f)break}var m=a(n,f)||n,p=a(o,f)||o;l(n,m,!0);var g=c(m===n?m:m.nextSibling,"nextSibling",p===o?p.nextSibling:p);g.length&&u(s(g)),l(o,p)},Of=function(e){var t=[];if(e)for(var n=0;n<e.rangeCount;n++)t.push(e.getRangeAt(n));return t},Bf=function(e){return H(J(e,function(e){var t=ps(e);return t?[Rt.fromDom(t)]:[]}),so)},Pf=function(e,t){var n=qu(t,"td[data-mce-selected],th[data-mce-selected]");return 0<n.length?n:Bf(e)},Lf=function(e){return Pf(Of(e.selection.getSel()),Rt.fromDom(e.getBody()))},If=function(t){return Zt(t).fold(S([t]),function(e){return[t].concat(If(e))})},Mf=function(t){return en(t).fold(S([t]),function(e){return"br"===It(e)?Kt(e).map(function(e){return[t].concat(Mf(e))}).getOr([]):[t].concat(Mf(e))})},Ff=function(o,e){return as((a=(i=e).startContainer,u=i.startOffset,Mn(a)?0===u?U.some(Rt.fromDom(a)):U.none():U.from(a.childNodes[u]).map(Rt.fromDom)),(n=(t=e).endContainer,r=t.endOffset,Mn(n)?r===n.data.length?U.some(Rt.fromDom(n)):U.none():U.from(n.childNodes[r-1]).map(Rt.fromDom)),function(e,t){var n=W(If(o),N(Bt,e)),r=W(Mf(o),N(Bt,t));return n.isSome()&&r.isSome()}).getOr(!1);var t,n,r,i,a,u},Uf=function(e,t,n,r){var o=n,i=new Yr(n,o),a=pe(e.schema.getMoveCaretBeforeOnEnterElements(),function(e,t){return!M(["td","th","table"],t.toLowerCase())});do{if(Mn(n)&&0!==_t.trim(n.nodeValue).length)return void(r?t.setStart(n,0):t.setEnd(n,n.nodeValue.length));if(a[n.nodeName])return void(r?t.setStartBefore(n):"BR"===n.nodeName?t.setEndBefore(n):t.setEndAfter(n))}while(n=r?i.next():i.prev());"BODY"===o.nodeName&&(r?t.setStart(o,0):t.setEnd(o,o.childNodes.length))},zf=function(e){var t=e.selection.getSel();return t&&0<t.rangeCount},jf=function(r,o){var e=Lf(r);0<e.length?Y(e,function(e){var t=e.dom,n=r.dom.createRng();n.setStartBefore(t),n.setEndAfter(t),o(n,!0)}):o(r.selection.getRng(),!1)},Hf=function(e,t,n){var r=oc(e,t);n(r),e.moveToBookmark(r)},Vf=(fl=zt,dl="text",{get:function(e){if(!fl(e))throw new Error("Can only get "+dl+" value of a "+dl+" node");return ml(e).getOr("")},getOption:ml=function(e){return fl(e)?U.from(e.dom.nodeValue):U.none()},set:function(e,t){if(!fl(e))throw new Error("Can only set raw "+dl+" value of a "+dl+" node");e.dom.nodeValue=t}}),qf=function(e){return Vf.get(e)},$f=function(r,o,i,a){return Wt(o).fold(function(){return"skipping"},function(e){return"br"===a||zt(n=o)&&qf(n)===mo?"valid":Ut(t=o)&&Hu(t,$u())?"existing":Fl(o.dom)?"caret":nf(r,i,a)&&nf(r,It(e),i)?"valid":"invalid-child";var t,n})},Wf=function(e,t,n,r){var o=t.uid,i=void 0===o?Zu("mce-annotation"):o,a=function(e,t){var n={};for(var r in e)Object.prototype.hasOwnProperty.call(e,r)&&t.indexOf(r)<0&&(n[r]=e[r]);if(null!=e&&"function"==typeof Object.getOwnPropertySymbols)for(var o=0,r=Object.getOwnPropertySymbols(e);o<r.length;o++)t.indexOf(r[o])<0&&Object.prototype.propertyIsEnumerable.call(e,r[o])&&(n[r[o]]=e[r[o]]);return n}(t,["uid"]),u=Rt.fromTag("span",e);zu(u,$u()),Yn(u,""+Ku(),i),Yn(u,""+Wu(),n);var s,c=r(i,a),l=c.attributes,f=void 0===l?{}:l,d=c.classes,m=void 0===d?[]:d;return Gn(u,f),s=u,Y(m,function(e){zu(s,e)}),u},Kf=function(i,e,t,n,r){var a=[],u=Wf(i.getDoc(),r,t,n),s=Au(U.none()),c=function(){s.set(U.none())},l=function(e){Y(e,o)},o=function(e){var t,n;switch($f(i,e,"span",It(e))){case"invalid-child":c();var r=Jt(e);l(r),c();break;case"valid":var o=s.get().getOrThunk(function(){var e=ns(u);return a.push(e),s.set(U.some(e)),e});cn(t=e,n=o),dn(n,t)}};return Df(i.dom,e,function(e){var t;c(),t=z(e,Rt.fromDom),l(t)}),a},Xf=function(u,s,c,l){u.undoManager.transact(function(){var e,t,n,r,o=u.selection,i=o.getRng(),a=0<Lf(u).length;i.collapsed&&!a&&(n=Rf(e=u,t=i,[{inline:!0}]),t.setStart(n.startContainer,n.startOffset),t.setEnd(n.endContainer,n.endOffset),e.selection.setRng(t)),o.getRng().collapsed&&!a?(r=Wf(u.getDoc(),l,s,c.decorate),es(r,fo),o.getRng().insertNode(r.dom),o.select(r.dom)):Hf(o,!1,function(){jf(u,function(e){Kf(u,e,s,c.decorate,l)})})})},Yf=function(u){var n,r=(n={},{register:function(e,t){n[e]={name:e,settings:t}},lookup:function(e){return n.hasOwnProperty(e)?U.from(n[e]).map(function(e){return e.settings}):U.none()}});Ju(u,r);var o=Gu(u);return{register:function(e,t){r.register(e,t)},annotate:function(t,n){r.lookup(t).each(function(e){Xf(u,t,e,n)})},annotationChanged:function(e,t){o.addListener(e,t)},remove:function(e){Xu(u,U.some(e)).each(function(e){var t=e.elements;Y(t,hn)})},getAll:function(e){var t,n,r,o,i,a=(t=u,n=e,r=Rt.fromDom(t.getBody()),o=qu(r,"["+Wu()+'="'+n+'"]'),i={},Y(o,function(e){var t=Jn(e,Ku()),n=i.hasOwnProperty(t)?i[t]:[];i[t]=n.concat([e])}),i);return ce(a,function(e){return z(e,function(e){return e.dom})})}}},Gf=function(e){return{getBookmark:N(Wl,e),moveToBookmark:N(Kl,e)}};Gf.isBookmarkNode=Xl;var Jf=function(e,t){for(;t&&t!==e;){if(Vn(t)||qn(t))return t;t=t.parentNode}return null},Qf=function(t,n,e){if(e.collapsed)return!1;if(xt.browser.isIE()&&e.startOffset===e.endOffset-1&&e.startContainer===e.endContainer){var r=e.startContainer.childNodes[e.startOffset];if(Rn(r))return F(r.getClientRects(),function(e){return ms(e,t,n)})}return F(e.getClientRects(),function(e){return ms(e,t,n)})},Zf=function(e,t,n){return e.fire(t,n)},ed={BACKSPACE:8,DELETE:46,DOWN:40,ENTER:13,LEFT:37,RIGHT:39,SPACEBAR:32,TAB:9,UP:38,END:35,HOME:36,modifierPressed:function(e){return e.shiftKey||e.ctrlKey||e.altKey||ed.metaKeyPressed(e)},metaKeyPressed:function(e){return xt.mac?e.metaKey:e.ctrlKey&&!e.altKey}},td=qn,nd=function(r,l){var f,d,m,p,c,g,h,v,y,b,C,w,x,S,N,E="data-mce-selected",k=l.dom,_=_t.each,A=l.getDoc(),R=document,T=Math.abs,D=Math.round,O=l.getBody(),B={nw:[0,0,-1,-1],ne:[1,0,1,-1],se:[1,1,1,1],sw:[0,1,-1,1]},P=function(e){return e&&("IMG"===e.nodeName||l.dom.is(e,"figure.image"))},L=function(e){return Wn(e)||k.hasClass(e,"mce-preview-object")},n=function(e){var t=e.target;!function(e,t){if("longpress"!==e.type&&0!==e.type.indexOf("touch"))return P(e.target)&&!Qf(e.clientX,e.clientY,t);var n=e.touches[0];return P(e.target)&&!Qf(n.clientX,n.clientY,t)}(e,l.selection.getRng())||e.isDefaultPrevented()||l.selection.select(t)},I=function(e){return k.is(e,"figure.image")?[e.querySelector("img")]:k.hasClass(e,"mce-preview-object")&&V(e.firstElementChild)?[e,e.firstElementChild]:[e]},M=function(e){var t=yc(l);return!!t&&("false"!==e.getAttribute("data-mce-resize")&&(e!==l.getBody()&&(k.hasClass(e,"mce-preview-object")?Dt(Rt.fromDom(e.firstElementChild),t):Dt(Rt.fromDom(e),t))))},a=function(e,t,n){var r;V(n)&&(r=I(e),Y(r,function(e){e.style[t]||!l.schema.isValid(e.nodeName.toLowerCase(),t)?k.setStyle(e,t,n):k.setAttrib(e,t,""+n)}))},F=function(e,t,n){a(e,"width",t),a(e,"height",n)},U=function(e){var t,n,r,o,i,a,u,s=e.screenX-g,c=e.screenY-h;w=s*p[2]+v,x=c*p[3]+y,w=w<5?5:w,x=x<5?5:x,((P(f)||L(f))&&!1!==l.getParam("resize_img_proportional",!0,"boolean")?!ed.modifierPressed(e):ed.modifierPressed(e))&&(T(s)>T(c)?(x=D(w*b),w=D(x/b)):(w=D(x/b),x=D(w*b))),F(d,w,x),t=0<(t=p.startPos.x+s)?t:0,n=0<(n=p.startPos.y+c)?n:0,k.setStyles(m,{left:t,top:n,display:"block"}),m.innerHTML=w+" &times; "+x,p[2]<0&&d.clientWidth<=w&&k.setStyle(d,"left",void 0+(v-w)),p[3]<0&&d.clientHeight<=x&&k.setStyle(d,"top",void 0+(y-x)),(s=O.scrollWidth-S)+(c=O.scrollHeight-N)!==0&&k.setStyles(m,{left:t-s,top:n-c}),C||(r=l,o=f,i=v,a=y,u="corner-"+p.name,r.fire("ObjectResizeStart",{target:o,width:i,height:a,origin:u}),C=!0)},z=function(){var e,t,n,r,o,i=C;C=!1,i&&(a(f,"width",w),a(f,"height",x)),k.unbind(A,"mousemove",U),k.unbind(A,"mouseup",z),R!==A&&(k.unbind(R,"mousemove",U),k.unbind(R,"mouseup",z)),k.remove(d),k.remove(m),k.remove(c),u(f),i&&(e=l,t=f,n=w,r=x,o="corner-"+p.name,e.fire("ObjectResized",{target:t,width:n,height:r,origin:o}),k.setAttrib(f,"style",k.getAttrib(f,"style"))),l.nodeChanged()},u=function(e){H();var t=k.getPos(e,O),i=t.x,a=t.y,n=e.getBoundingClientRect(),u=n.width||n.right-n.left,s=n.height||n.bottom-n.top;f!==e&&(j(),f=e,w=x=0);var r=l.fire("ObjectSelected",{target:e}),o=k.getAttrib(f,E,"1");M(e)&&!r.isDefaultPrevented()?_(B,function(r,o){var t=function(e){var t,n=I(f)[0];g=e.screenX,h=e.screenY,v=n.clientWidth,y=n.clientHeight,b=y/v,(p=r).name=o,p.startPos={x:u*r[0]+i,y:s*r[1]+a},S=O.scrollWidth,N=O.scrollHeight,c=k.add(O,"div",{"class":"mce-resize-backdrop"}),k.setStyles(c,{position:"fixed",left:"0",top:"0",width:"100%",height:"100%"}),d=L(t=f)?k.create("img",{src:xt.transparentSrc}):t.cloneNode(!0),k.addClass(d,"mce-clonedresizable"),k.setAttrib(d,"data-mce-bogus","all"),d.contentEditable="false",k.setStyles(d,{left:i,top:a,margin:0}),F(d,u,s),d.removeAttribute(E),O.appendChild(d),k.bind(A,"mousemove",U),k.bind(A,"mouseup",z),R!==A&&(k.bind(R,"mousemove",U),k.bind(R,"mouseup",z)),m=k.add(O,"div",{"class":"mce-resize-helper","data-mce-bogus":"all"},v+" &times; "+y)},e=k.get("mceResizeHandle"+o);e&&k.remove(e),e=k.add(O,"div",{id:"mceResizeHandle"+o,"data-mce-bogus":"all","class":"mce-resizehandle",unselectable:!0,style:"cursor:"+o+"-resize; margin:0; padding:0"}),11===xt.ie&&(e.contentEditable=!1),k.bind(e,"mousedown",function(e){e.stopImmediatePropagation(),e.preventDefault(),t(e)}),r.elm=e,k.setStyles(e,{left:u*r[0]+i-e.offsetWidth/2,top:s*r[1]+a-e.offsetHeight/2})}):j(),k.getAttrib(f,E)||f.setAttribute(E,o)},j=function(){H(),f&&f.removeAttribute(E),se(B,function(e,t){var n=k.get("mceResizeHandle"+t);n&&(k.unbind(n),k.remove(n))})},o=function(e){var t,n=function(e,t){if(e)do{if(e===t)return!0}while(e=e.parentNode)};C||l.removed||(_(k.select("img[data-mce-selected],hr[data-mce-selected]"),function(e){e.removeAttribute(E)}),t="mousedown"===e.type?e.target:r.getNode(),n(t=k.$(t).closest("table,img,figure.image,hr,video,span.mce-preview-object")[0],O)&&(s(),n(r.getStart(!0),t)&&n(r.getEnd(!0),t))?u(t):j())},i=function(e){return td(Jf(l.getBody(),e))},H=function(){se(B,function(e){e.elm&&(k.unbind(e.elm),delete e.elm)})},s=function(){try{l.getDoc().execCommand("enableObjectResizing",!1,"false")}catch(e){}};l.on("init",function(){var e;s(),(xt.browser.isIE()||xt.browser.isEdge())&&(l.on("mousedown click",function(e){var t=e.target,n=t.nodeName;C||!/^(TABLE|IMG|HR)$/.test(n)||i(t)||(2!==e.button&&l.selection.select(t,"TABLE"===n),"mousedown"===e.type&&l.nodeChanged())}),e=function(e){var t=function(e){Wr.setEditorTimeout(l,function(){return l.selection.select(e)})};if(i(e.target)||Wn(e.target))return e.preventDefault(),void t(e.target);/^(TABLE|IMG|HR)$/.test(e.target.nodeName)&&(e.preventDefault(),"IMG"===e.target.tagName&&t(e.target))},k.bind(O,"mscontrolselect",e),l.on("remove",function(){return k.unbind(O,"mscontrolselect",e)}));var t=Wr.throttle(function(e){l.composing||o(e)});l.on("nodechange ResizeEditor ResizeWindow ResizeContent drop FullscreenStateChanged",t),l.on("keyup compositionend",function(e){f&&"TABLE"===f.nodeName&&t(e)}),l.on("hide blur",j),l.on("contextmenu longpress",n,!0)}),l.on("remove",H);return{isResizable:M,showResizeRect:u,hideResizeRect:j,updateResizeRect:o,destroy:function(){f=d=c=null}}},rd=function(e){return Vn(e)||qn(e)},od=function(e,t,n){var r,o,i,a,u,s=n;if(s.caretPositionFromPoint)(o=s.caretPositionFromPoint(e,t))&&((r=n.createRange()).setStart(o.offsetNode,o.offset),r.collapse(!0));else if(n.caretRangeFromPoint)r=n.caretRangeFromPoint(e,t);else if(s.body.createTextRange){r=s.body.createTextRange();try{r.moveToPoint(e,t),r.collapse(!0)}catch(c){r=function(e,n,t){var r,o=t.elementFromPoint(e,n),i=t.body.createTextRange();if(o&&"HTML"!==o.tagName||(o=t.body),i.moveToElementText(o),0<(r=(r=_t.toArray(i.getClientRects())).sort(function(e,t){return(e=Math.abs(Math.max(e.top-n,e.bottom-n)))-(t=Math.abs(Math.max(t.top-n,t.bottom-n)))})).length){n=(r[0].bottom+r[0].top)/2;try{return i.moveToPoint(e,n),i.collapse(!0),i}catch(a){}}return null}(e,t,n)}return i=r,a=n.body,u=i&&i.parentElement?i.parentElement():null,qn(function(e,t,n){for(;e&&e!==t;){if(n(e))return e;e=e.parentNode}return null}(u,a,rd))?null:i}return r},id=function(e,t){return e&&t&&e.startContainer===t.startContainer&&e.startOffset===t.startOffset&&e.endContainer===t.endContainer&&e.endOffset===t.endOffset},ad=function(e,t,n){return null!==function(e,t,n){for(;e&&e!==t;){if(n(e))return e;e=e.parentNode}return null}(e,t,n)},ud=function(e){return e&&"TABLE"===e.nodeName},sd=function(e,t,n){for(var r=new Yr(t,e.getParent(t.parentNode,e.isBlock)||e.getRoot());t=r[n?"prev":"next"]();)if(jn(t))return!0},cd=function(e,t,n,r,o){var i,a,u=e.getRoot(),s=e.schema.getNonEmptyElements(),c=e.getParent(o.parentNode,e.isBlock)||u;if(r&&jn(o)&&t&&e.isEmpty(c))return U.some(Is(o.parentNode,e.nodeIndex(o)));for(var l,f,d=new Yr(o,c);a=d[r?"prev":"next"]();){if("false"===e.getContentEditableParent(a)||(f=u,Co(l=a)&&!1===ad(l,f,Fl)))return U.none();if(Mn(a)&&0<a.nodeValue.length)return!1===function(e,t,n){return ad(e,t,function(e){return e.nodeName===n})}(a,u,"A")?U.some(Is(a,r?a.nodeValue.length:0)):U.none();if(e.isBlock(a)||s[a.nodeName.toLowerCase()])return U.none();i=a}return n&&i?U.some(Is(i,0)):U.none()},ld=function(e,t,n,r){var o,i,a,u,s=e.getRoot(),c=!1,l=r[(n?"start":"end")+"Container"],f=r[(n?"start":"end")+"Offset"],d=Rn(l)&&f===l.childNodes.length,m=e.schema.getNonEmptyElements(),p=n;if(Co(l))return U.none();if(Rn(l)&&f>l.childNodes.length-1&&(p=!1),Un(l)&&(l=s,f=0),l===s){if(p&&(o=l.childNodes[0<f?f-1:0])){if(Co(o))return U.none();if(m[o.nodeName]||ud(o))return U.none()}if(l.hasChildNodes()){if(f=Math.min(!p&&0<f?f-1:f,l.childNodes.length-1),l=l.childNodes[f],f=Mn(l)&&d?l.data.length:0,!t&&l===s.lastChild&&ud(l))return U.none();if(function(e,t){for(;t&&t!==e;){if(qn(t))return!0;t=t.parentNode}return!1}(s,l)||Co(l))return U.none();if(l.hasChildNodes()&&!1===ud(l)){var g=new Yr(o=l,s);do{if(qn(o)||Co(o)){c=!1;break}if(Mn(o)&&0<o.nodeValue.length){f=p?0:o.nodeValue.length,l=o,c=!0;break}if(m[o.nodeName.toLowerCase()]&&(!(i=o)||!/^(TD|TH|CAPTION)$/.test(i.nodeName))){f=e.nodeIndex(o),l=o.parentNode,p||f++,c=!0;break}}while(o=p?g.next():g.prev())}}}return t&&(Mn(l)&&0===f&&cd(e,d,t,!0,l).each(function(e){l=e.container(),f=e.offset(),c=!0}),Rn(l)&&(!(o=(o=l.childNodes[f])||l.childNodes[f-1])||!jn(o)||(u="A",(a=o).previousSibling&&a.previousSibling.nodeName===u)||sd(e,o,!1)||sd(e,o,!0)||cd(e,d,t,!0,o).each(function(e){l=e.container(),f=e.offset(),c=!0}))),p&&!t&&Mn(l)&&f===l.nodeValue.length&&cd(e,d,t,!1,l).each(function(e){l=e.container(),f=e.offset(),c=!0}),c?U.some(Is(l,f)):U.none()},fd=function(e,t){var n=t.collapsed,r=t.cloneRange(),o=Is.fromRangeStart(t);return ld(e,n,!0,r).each(function(e){n&&Is.isAbove(o,e)||r.setStart(e.container(),e.offset())}),n||ld(e,n,!1,r).each(function(e){r.setEnd(e.container(),e.offset())}),n&&r.collapse(!0),id(t,r)?U.none():U.some(r)},dd=function(e,t){return e.splitText(t)},md=function(e){var t=e.startContainer,n=e.startOffset,r=e.endContainer,o=e.endOffset;return t===r&&Mn(t)?0<n&&n<t.nodeValue.length&&(t=(r=dd(t,n)).previousSibling,n<o?(t=r=dd(r,o-=n).previousSibling,o=r.nodeValue.length,n=0):o=0):(Mn(t)&&0<n&&n<t.nodeValue.length&&(t=dd(t,n),n=0),Mn(r)&&0<o&&o<r.nodeValue.length&&(o=(r=dd(r,o).previousSibling).nodeValue.length)),{startContainer:t,startOffset:n,endContainer:r,endOffset:o}},pd=function(n){return{walk:function(e,t){return Df(n,e,t)},split:md,normalize:function(t){return fd(n,t).fold(b,function(e){return t.setStart(e.startContainer,e.startOffset),t.setEnd(e.endContainer,e.endOffset),!0})}}};pd.compareRanges=id,pd.getCaretRangeFromPoint=od,pd.getSelectedNode=ps,pd.getNode=gs;var gd,hd,vd,yd,bd,Cd=(gd="height",hd=function(e){var t=e.dom;return vn(e)?t.getBoundingClientRect().height:t.offsetHeight},{set:function(e,t){if(!O(t)&&!t.match(/^[0-9]+$/))throw new Error(gd+".set accepts only positive integer values. Value was "+t);var n=e.dom;Kn(n)&&(n.style[gd]=t+"px")},get:vd=function(e){var t=hd(e);if(t<=0||null===t){var n=tr(e,gd);return parseFloat(n)||0}return t},getOuter:vd,aggregate:yd=function(o,e){return $(e,function(e,t){var n=tr(o,t),r=n===undefined?0:parseInt(n,10);return isNaN(r)?e:e+r},0)},max:function(e,t,n){var r=yd(e,n);return r<t?t-r:0}}),wd=function(r,e){return r.view(e).fold(S([]),function(e){var t=r.owner(e),n=wd(r,t);return[e].concat(n)})},xd=/* */Object.freeze({__proto__:null,view:function(e){var t;return(e.dom===document?U.none():U.from(null===(t=e.dom.defaultView)||void 0===t?void 0:t.frameElement)).map(Rt.fromDom)},owner:qt}),Sd=function(e){var t,n,r,o=Rt.fromDom(document),i=xn(o),a=(t=e,r=(n=xd).owner(t),wd(n,r)),u=wn(e),s=q(a,function(e,t){var n=wn(t);return{left:e.left+n.left,top:e.top+n.top}},{left:0,top:0});return bn(s.left+u.left+i.left,s.top+u.top+i.top)},Nd=function(e){return"textarea"===It(e)},Ed=function(e,t){var n,r=function(e){var t=e.dom.ownerDocument,n=t.body,r=t.defaultView,o=t.documentElement;if(n===e.dom)return bn(n.offsetLeft,n.offsetTop);var i=Cn(null==r?void 0:r.pageYOffset,o.scrollTop),a=Cn(null==r?void 0:r.pageXOffset,o.scrollLeft),u=Cn(o.clientTop,n.clientTop),s=Cn(o.clientLeft,n.clientLeft);return wn(e).translate(a-s,i-u)}(e),o=(n=e,Cd.get(n));return{element:e,bottom:r.top+o,height:o,pos:r,cleanup:t}},kd=function(e,t){var n=function(e,t){var n=Jt(e);if(0===n.length||Nd(e))return{element:e,offset:t};if(t<n.length&&!Nd(n[t]))return{element:n[t],offset:0};var r=n[n.length-1];return Nd(r)?{element:e,offset:t}:"img"===It(r)?{element:r,offset:1}:zt(r)?{element:r,offset:qf(r).length}:{element:r,offset:Jt(r).length}}(e,t),r=Rt.fromHtml('<span data-mce-bogus="all">\ufeff</span>');return cn(n.element,r),Ed(r,function(){return gn(r)})},_d=function(n,r,o,i){Dd(n,function(e,t){return Rd(n,r,o,i)},o)},Ad=function(e,t,n,r,o){var i,a,u={elm:r.element.dom,alignToTop:o};i=u,e.fire("ScrollIntoView",i).isDefaultPrevented()||(n(t,xn(t).top,r,o),a=u,e.fire("AfterScrollIntoView",a))},Rd=function(e,t,n,r){var o=Rt.fromDom(e.getBody()),i=Rt.fromDom(e.getDoc());o.dom.offsetWidth;var a=kd(Rt.fromDom(n.startContainer),n.startOffset);Ad(e,i,t,a,r),a.cleanup()},Td=function(e,t,n,r){var o,i=Rt.fromDom(e.getDoc());Ad(e,i,n,(o=t,Ed(Rt.fromDom(o),te)),r)},Dd=function(e,t,n){var r=n.startContainer,o=n.startOffset,i=n.endContainer,a=n.endOffset;t(Rt.fromDom(r),Rt.fromDom(i));var u=e.dom.createRng();u.setStart(r,o),u.setEnd(i,a),e.selection.setRng(n)},Od=function(e,t,n,r){var o,i=e.pos;n?Sn(i.left,i.top,r):(o=i.top-t+e.height,Sn(i.left,o,r))},Bd=function(e,t,n,r,o){var i=n+t,a=r.pos.top,u=r.bottom,s=n<=u-a;a<t?Od(r,n,!1!==o,e):i<a?Od(r,n,s?!1!==o:!0===o,e):i<u&&!s&&Od(r,n,!0===o,e)},Pd=function(e,t,n,r){var o=e.dom.defaultView.innerHeight;Bd(e,t,o,n,r)},Ld=function(e,t,n,r){var o=e.dom.defaultView.innerHeight;Bd(e,t,o,n,r);var i=Sd(n.element),a=kn(window);i.top<a.y?Nn(n.element,!1!==r):i.top>a.bottom&&Nn(n.element,!0===r)},Id=function(e,t,n){return _d(e,Pd,t,n)},Md=function(e,t,n){return Td(e,t,Pd,n)},Fd=function(e,t,n){return _d(e,Ld,t,n)},Ud=function(e,t,n){return Td(e,t,Ld,n)},zd=function(e,t,n){(e.inline?Id:Fd)(e,t,n)},jd=function(e){var t=on(e).dom;return e.dom===t.activeElement},Hd=function(e){return void 0===e&&(e=Rt.fromDom(document)),U.from(e.dom.activeElement).map(Rt.fromDom)},Vd=function(e,t,n,r){return{start:e,soffset:t,finish:n,foffset:r}},qd=wr([{before:["element"]},{on:["element","offset"]},{after:["element"]}]),$d=(qd.before,qd.on,qd.after,function(e){return e.fold(o,o,o)}),Wd=wr([{domRange:["rng"]},{relative:["startSitu","finishSitu"]},{exact:["start","soffset","finish","foffset"]}]),Kd={domRange:Wd.domRange,relative:Wd.relative,exact:Wd.exact,exactFromRange:function(e){return Wd.exact(e.start,e.soffset,e.finish,e.foffset)},getWin:function(e){var t=e.match({domRange:function(e){return Rt.fromDom(e.startContainer)},relative:function(e,t){return $d(e)},exact:function(e,t,n,r){return e}});return $t(t)},range:Vd},Xd=mt().browser,Yd=function(e,t){var n=zt(t)?qf(t).length:Jt(t).length+1;return n<e?n:e<0?0:e},Gd=function(e){return Kd.range(e.start,Yd(e.soffset,e.start),e.finish,Yd(e.foffset,e.finish))},Jd=function(e,t){return!An(t.dom)&&(Lt(e,t)||Bt(e,t))},Qd=function(t){return function(e){return Jd(t,e.start)&&Jd(t,e.finish)}},Zd=function(e){return!0===e.inline||Xd.isIE()},em=function(e){return Kd.range(Rt.fromDom(e.startContainer),e.startOffset,Rt.fromDom(e.endContainer),e.endOffset)},tm=function(e){var t,n,r=$t(e);return t=r.dom,((n=t.getSelection())&&0!==n.rangeCount?U.from(n.getRangeAt(0)):U.none()).map(em).filter(Qd(e))},nm=function(e){var t=document.createRange();try{return t.setStart(e.start.dom,e.soffset),t.setEnd(e.finish.dom,e.foffset),U.some(t)}catch(n){return U.none()}},rm=function(e){var t=Zd(e)?tm(Rt.fromDom(e.getBody())):U.none();e.bookmark=t.isSome()?t:e.bookmark},om=function(r){return(r.bookmark?r.bookmark:U.none()).bind(function(e){return t=Rt.fromDom(r.getBody()),n=e,U.from(n).filter(Qd(t)).map(Gd);var t,n}).bind(nm)},im={isEditorUIElement:function(e){var t=e.className.toString();return-1!==t.indexOf("tox-")||-1!==t.indexOf("mce-")}},am=function(n,e){var t,r;mt().browser.isIE()?(r=n).on("focusout",function(){rm(r)}):(t=e,n.on("mouseup touchend",function(e){t.throttle()})),n.on("keyup NodeChange",function(e){var t;"nodechange"===(t=e).type&&t.selectionChange||rm(n)})},um=function(r){var o=Pu(function(){rm(r)},0);r.on("init",function(){var e,t,n;r.inline&&(e=r,t=o,n=function(){t.throttle()},xu.DOM.bind(document,"mouseup",n),e.on("remove",function(){xu.DOM.unbind(document,"mouseup",n)})),am(r,o)}),r.on("remove",function(){o.cancel()})},sm=xu.DOM,cm=function(t,e){var n=t.getParam("custom_ui_selector","","string");return null!==sm.getParent(e,function(e){return im.isEditorUIElement(e)||!!n&&t.dom.is(e,n)})},lm=function(n,e){var t=e.editor;um(t),t.on("focusin",function(){var e=n.focusedEditor;e!==t&&(e&&e.fire("blur",{focusedEditor:t}),n.setActive(t),(n.focusedEditor=t).fire("focus",{blurredEditor:e}),t.focus(!0))}),t.on("focusout",function(){Wr.setEditorTimeout(t,function(){var e=n.focusedEditor;cm(t,function(e){try{var t=on(Rt.fromDom(e.getElement()));return Hd(t).fold(function(){return document.body},function(e){return e.dom})}catch(n){return document.body}}(t))||e!==t||(t.fire("blur",{focusedEditor:null}),n.focusedEditor=null)})}),bd||(bd=function(e){var t=n.activeEditor;t&&function(e){if(rn()&&V(e.target)){var t=Rt.fromDom(e.target);if(Ut(t)&&sn(t)&&e.composed&&e.composedPath){var n=e.composedPath();if(n)return re(n)}}return U.from(e.target)}(e).each(function(e){e.ownerDocument===document&&(e===document.body||cm(t,e)||n.focusedEditor!==t||(t.fire("blur",{focusedEditor:null}),n.focusedEditor=null))})},sm.bind(document,"focusin",bd))},fm=function(e,t){e.focusedEditor===t.editor&&(e.focusedEditor=null),e.activeEditor||(sm.unbind(document,"focusin",bd),bd=null)},dm=function(t,e){return((n=e).collapsed?U.from(gs(n.startContainer,n.startOffset)).map(Rt.fromDom):U.none()).bind(function(e){return uo(e)?U.some(e):!1===Lt(t,e)?U.some(t):U.none()});var n},mm=function(t,e){dm(Rt.fromDom(t.getBody()),e).bind(function(e){return Ll(e.dom)}).fold(function(){t.selection.normalize()},function(e){return t.selection.setRng(e.toRange())})},pm=function(e){if(e.setActive)try{e.setActive()}catch(t){e.focus()}else e.focus()},gm=function(e){return jd(e)||Hd(on(t=e)).filter(function(e){return t.dom.contains(e.dom)}).isSome();var t},hm=function(r){var e=on(Rt.fromDom(r.getElement()));return Hd(e).filter(function(e){return t=e.dom,!((n=t.classList)!==undefined&&(n.contains("tox-edit-area")||n.contains("tox-edit-area__iframe")||n.contains("mce-content-body")))&&cm(r,e.dom);var t,n}).isSome()},vm=function(e){return e.inline?(n=e.getBody())&&gm(Rt.fromDom(n)):(t=e).iframeElement&&jd(Rt.fromDom(t.iframeElement));var t,n},ym=function(t){var e=t.selection,n=t.getBody(),r=e.getRng();t.quirks.refreshContentEditable(),t.bookmark!==undefined&&!1===vm(t)&&om(t).each(function(e){t.selection.setRng(e),r=e});var o,i,a=(o=t,i=e.getNode(),o.dom.getParent(i,function(e){return"true"===o.dom.getContentEditable(e)}));if(t.$.contains(n,a))return pm(a),mm(t,r),void bm(t);t.inline||(xt.opera||pm(n),t.getWin().focus()),(xt.gecko||t.inline)&&(pm(n),mm(t,r)),bm(t)},bm=function(e){return e.editorManager.setActive(e)},Cm=function(e,t,n,r,o){var i=n?t.startContainer:t.endContainer,a=n?t.startOffset:t.endOffset;return U.from(i).map(Rt.fromDom).map(function(e){return r&&t.collapsed?e:Qt(e,o(e,a)).getOr(e)}).bind(function(e){return Ut(e)?U.some(e):Wt(e).filter(Ut)}).map(function(e){return e.dom}).getOr(e)},wm=function(e,t,n){return Cm(e,t,!0,n,function(e,t){return Math.min(e.dom.childNodes.length,t)})},xm=function(e,t,n){return Cm(e,t,!1,n,function(e,t){return 0<t?t-1:t})},Sm=function(e,t){for(var n=e;e&&Mn(e)&&0===e.length;)e=t?e.nextSibling:e.previousSibling;return e||n},Nm=function(n,e){return z(e,function(e){var t=n.fire("GetSelectionRange",{range:e});return t.range!==e?t.range:e})},Em={"#text":3,"#comment":8,"#cdata":4,"#pi":7,"#doctype":10,"#document-fragment":11},km=function(e,t,n){var r=n?"lastChild":"firstChild",o=n?"prev":"next";if(e[r])return e[r];if(e!==t){var i=e[o];if(i)return i;for(var a=e.parent;a&&a!==t;a=a.parent)if(i=a[o])return i}},_m=function(e){var t="a"===e.name&&!e.attr("href")&&e.attr("id");return e.attr("name")||e.attr("id")&&!e.firstChild||e.attr("data-mce-bookmark")||t},Am=(Rm.create=function(e,t){var n=new Rm(e,Em[e]||1);return t&&se(t,function(e,t){n.attr(t,e)}),n},Rm.prototype.replace=function(e){return e.parent&&e.remove(),this.insert(e,this),this.remove(),this},Rm.prototype.attr=function(e,t){var n,r=this;if("string"!=typeof e)return e!==undefined&&null!==e&&se(e,function(e,t){r.attr(t,e)}),r;if(n=r.attributes){if(t===undefined)return n.map[e];if(null===t){if(e in n.map){delete n.map[e];for(var o=n.length;o--;)if(n[o].name===e)return n.splice(o,1),r}return r}if(e in n.map){for(o=n.length;o--;)if(n[o].name===e){n[o].value=t;break}}else n.push({name:e,value:t});return n.map[e]=t,r}},Rm.prototype.clone=function(){var e,t=new Rm(this.name,this.type);if(e=this.attributes){var n=[];n.map={};for(var r=0,o=e.length;r<o;r++){var i=e[r];"id"!==i.name&&(n[n.length]={name:i.name,value:i.value},n.map[i.name]=i.value)}t.attributes=n}return t.value=this.value,t.shortEnded=this.shortEnded,t},Rm.prototype.wrap=function(e){return this.parent.insert(e,this),e.append(this),this},Rm.prototype.unwrap=function(){for(var e=this.firstChild;e;){var t=e.next;this.insert(e,this,!0),e=t}this.remove()},Rm.prototype.remove=function(){var e=this.parent,t=this.next,n=this.prev;return e&&(e.firstChild===this?(e.firstChild=t)&&(t.prev=null):n.next=t,e.lastChild===this?(e.lastChild=n)&&(n.next=null):t.prev=n,this.parent=this.next=this.prev=null),this},Rm.prototype.append=function(e){e.parent&&e.remove();var t=this.lastChild;return t?((t.next=e).prev=t,this.lastChild=e):this.lastChild=this.firstChild=e,e.parent=this,e},Rm.prototype.insert=function(e,t,n){e.parent&&e.remove();var r=t.parent||this;return n?(t===r.firstChild?r.firstChild=e:t.prev.next=e,e.prev=t.prev,(e.next=t).prev=e):(t===r.lastChild?r.lastChild=e:t.next.prev=e,e.next=t.next,(e.prev=t).next=e),e.parent=r,e},Rm.prototype.getAll=function(e){for(var t=[],n=this.firstChild;n;n=km(n,this))n.name===e&&t.push(n);return t},Rm.prototype.empty=function(){if(this.firstChild){for(var e=[],t=this.firstChild;t;t=km(t,this))e.push(t);for(var n=e.length;n--;)(t=e[n]).parent=t.firstChild=t.lastChild=t.next=t.prev=null}return this.firstChild=this.lastChild=null,this},Rm.prototype.isEmpty=function(e,t,n){void 0===t&&(t={});var r=this.firstChild;if(_m(this))return!1;if(r)do{if(1===r.type){if(r.attr("data-mce-bogus"))continue;if(e[r.name])return!1;if(_m(r))return!1}if(8===r.type)return!1;if(3===r.type&&!function(e){if(zo(e.value)){var t=e.parent;return!t||"span"===t.name&&!t.attr("style")||!/^[ ]+$/.test(e.value)}}(r))return!1;if(3===r.type&&r.parent&&t[r.parent.name]&&zo(r.value))return!1;if(n&&n(r))return!1}while(r=km(r,this));return!0},Rm.prototype.walk=function(e){return km(this,null,e)},Rm);function Rm(e,t){this.name=e,1===(this.type=t)&&(this.attributes=[],this.attributes.map={})}var Tm=function(e,t){return e.replace(t.re,function(e){return he(t.uris,e).getOr(e)})},Dm=["img","video"],Om=function(e,t,n){return!e.allow_html_data_urls&&(/^data:image\//i.test(t)?(r=e.allow_svg_data_urls,o=n,!(X(r)?M(Dm,o):r)&&/^data:image\/svg\+xml/i.test(t)):/^data:/i.test(t));var r,o},Bm=function(e,t,n){var r,o,i=1,a=e.getShortEndedElements(),u=/<([!?\/])?([A-Za-z0-9\-_:.]+)(\s(?:[^'">]+(?:"[^"]*"|'[^']*'))*[^"'>]*(?:"[^">]*|'[^'>]*)?|\s*|\/)>/g;for(u.lastIndex=r=n;o=u.exec(t);){if(r=u.lastIndex,"/"===o[1])i--;else if(!o[1]){if(o[2]in a)continue;i++}if(0===i)break}return r},Pm=function(W,K){void 0===K&&(K=Ci()),!1!==(W=W||{}).fix_self_closing&&(W.fix_self_closing=!0);var X=W.comment?W.comment:te,Y=W.cdata?W.cdata:te,G=W.text?W.text:te,J=W.start?W.start:te,Q=W.end?W.end:te,Z=W.pi?W.pi:te,ee=W.doctype?W.doctype:te,n=function(f,e){void 0===e&&(e="html");for(var t,i,n,d,r,o,a,m,u,s,c,l,p,g,h,v,y,b,C,w=f.html,x=0,S=[],N=0,E=li.decode,k=_t.makeMap("src,href,data,background,action,formaction,poster,xlink:href"),_=/((java|vb)script|mhtml):/i,A="html"===e?0:1,R=function(e){for(var t,n=S.length;n--&&S[n].name!==e;);if(0<=n){for(t=S.length-1;n<=t;t--)(e=S[t]).valid&&Q(e.name);S.length=n}},T=function(e,t){return G(Tm(e,f),t)},D=function(e){""!==e&&(">"===e.charAt(0)&&(e=" "+e),W.allow_conditional_comments||"[if"!==e.substr(0,3).toLowerCase()||(e=" "+e),X(Tm(e,f)))},O=function(e,t){var n=e||"",r=!qe(n,"--"),o=function(e,t,n){void 0===n&&(n=0);var r=e.toLowerCase();if(-1!==r.indexOf("[if ",n)&&(u=n,/^\s*\[if [\w\W]+\]>.*<!\[endif\](--!?)?>/.test(r.substr(u)))){var o=r.indexOf("[endif]",n);return r.indexOf(">",o)}if(t){var i=r.indexOf(">",n);return-1!==i?i:r.length}var a=/--!?>/g;a.lastIndex=n;var u,s=a.exec(e);return s?s.index+s[0].length:r.length}(w,r,t);return e=w.substr(t,o-t),D(r?n+e:e),o+1},B=function(e,t,n,r,o){var i,a,u,s;if(t=t.toLowerCase(),u=t in F?t:E(n||r||o||""),n=Tm(u,f),U&&!m&&!1==(0===(s=t).indexOf("data-")||0===s.indexOf("aria-"))){if(!(i=g[t])&&h){for(a=h.length;a--&&!(i=h[a]).pattern.test(t););-1===a&&(i=null)}if(!i)return;if(i.validValues&&!(n in i.validValues))return}if(k[t]&&!W.allow_script_urls){var c=n.replace(/[\s\u0000-\u001F]+/g,"");try{c=decodeURIComponent(c)}catch(l){c=unescape(c)}if(_.test(c))return;if(Om(W,c,e))return}m&&(t in k||0===t.indexOf("on"))||(d.map[t]=n,d.push({name:t,value:n}))},P=new RegExp("<(?:(?:!--([\\w\\W]*?)--!?>)|(?:!\\[CDATA\\[([\\w\\W]*?)\\]\\]>)|(?:![Dd][Oo][Cc][Tt][Yy][Pp][Ee]([\\w\\W]*?)>)|(?:!(--)?)|(?:\\?([^\\s\\/<>]+) ?([\\w\\W]*?)[?/]>)|(?:\\/([A-Za-z][A-Za-z0-9\\-_\\:\\.]*)>)|(?:([A-Za-z][A-Za-z0-9\\-_:.]*)(\\s(?:[^'\">]+(?:\"[^\"]*\"|'[^']*'))*[^\"'>]*(?:\"[^\">]*|'[^'>]*)?|\\s*|\\/)>))","g"),L=/([\w:\-]+)(?:\s*=\s*(?:(?:\"((?:[^\"])*)\")|(?:\'((?:[^\'])*)\')|([^>\s]+)))?/g,I=K.getShortEndedElements(),M=W.self_closing_elements||K.getSelfClosingElements(),F=K.getBoolAttrs(),U=W.validate,z=W.remove_internals,j=W.fix_self_closing,H=K.getSpecialElements(),V=w+">";t=P.exec(V);){var q=t[0];if(x<t.index&&T(E(w.substr(x,t.index-x))),i=t[7])":"===(i=i.toLowerCase()).charAt(0)&&(i=i.substr(1)),R(i);else if(i=t[8]){if(t.index+q.length>w.length){T(E(w.substr(t.index))),x=t.index+q.length;continue}":"===(i=i.toLowerCase()).charAt(0)&&(i=i.substr(1)),u=i in I,j&&M[i]&&0<S.length&&S[S.length-1].name===i&&R(i);var $=function(e,t){var n=e.exec(t);if(n){var r=n[1],o=n[2];return"string"==typeof r&&"data-mce-bogus"===r.toLowerCase()?o:null}return null}(L,t[9]);if(null!==$){if("all"===$){x=Bm(K,w,P.lastIndex),P.lastIndex=x;continue}c=!1}if(!U||(s=K.getElementRule(i))){if(c=!0,U&&(g=s.attributes,h=s.attributePatterns),(p=t[9])?((m=-1!==p.indexOf("data-mce-type"))&&z&&(c=!1),(d=[]).map={},p.replace(L,function(e,t,n,r,o){return B(i,t,n,r,o),""})):(d=[]).map={},U&&!m){if(v=s.attributesRequired,y=s.attributesDefault,b=s.attributesForced,s.removeEmptyAttrs&&!d.length&&(c=!1),b)for(r=b.length;r--;)a=(l=b[r]).name,"{$uid}"===(C=l.value)&&(C="mce_"+N++),d.map[a]=C,d.push({name:a,value:C});if(y)for(r=y.length;r--;)(a=(l=y[r]).name)in d.map||("{$uid}"===(C=l.value)&&(C="mce_"+N++),d.map[a]=C,d.push({name:a,value:C}));if(v){for(r=v.length;r--&&!(v[r]in d.map););-1===r&&(c=!1)}if(l=d.map["data-mce-bogus"]){if("all"===l){x=Bm(K,w,P.lastIndex),P.lastIndex=x;continue}c=!1}}c&&J(i,d,u)}else c=!1;if(n=H[i]){n.lastIndex=x=t.index+q.length,x=(t=n.exec(w))?(c&&(o=w.substr(x,t.index-x)),t.index+t[0].length):(o=w.substr(x),w.length),c&&(0<o.length&&T(o,!0),Q(i)),P.lastIndex=x;continue}u||(p&&p.indexOf("/")===p.length-1?c&&Q(i):S.push({name:i,valid:c}))}else if(i=t[1])D(i);else if(i=t[2]){if(!(1==A||W.preserve_cdata||0<S.length&&K.isValidChild(S[S.length-1].name,"#cdata"))){x=O("",t.index+2),P.lastIndex=x;continue}Y(i)}else if(i=t[3])ee(i);else{if((i=t[4])||"<!"===q){x=O(i,t.index+q.length),P.lastIndex=x;continue}if(i=t[5]){if(1!=A){x=O("?",t.index+2),P.lastIndex=x;continue}Z(i,t[6])}}x=t.index+q.length}for(x<w.length&&T(E(w.substr(x))),r=S.length-1;0<=r;r--)(i=S[r]).valid&&Q(i.name)};return{parse:function(e,t){void 0===t&&(t="html"),n(function(e){for(var t,n=/data:[^;]+;base64,([a-z0-9\+\/=]+)/gi,r=[],o={},i=Zu("img"),a=0,u=0;t=n.exec(e);){var s=t[0],c=i+"_"+u++;o[c]=s,a<t.index&&r.push(e.substr(a,t.index-a)),r.push(c),a=t.index+s.length}var l=new RegExp(i+"_[0-9]+","g");return 0===a?{prefix:i,uris:o,html:e,re:l}:(a<e.length&&r.push(e.substr(a)),{prefix:i,uris:o,html:r.join(""),re:l})}(e),t)}}};Pm.findEndTag=Bm;var Lm,Im,Mm=function(e,t){var n,r,o,i,a,u,s,c=t,l=/<(\w+) [^>]*data-mce-bogus="all"[^>]*>/g,f=e.schema;a=e.getTempAttrs(),u=c,s=new RegExp(["\\s?("+a.join("|")+')="[^"]+"'].join("|"),"gi"),c=u.replace(s,"");for(var d=f.getShortEndedElements();i=l.exec(c);)r=l.lastIndex,o=i[0].length,n=d[i[1]]?r:Pm.findEndTag(f,c,r),c=c.substring(0,r-o)+c.substring(n),l.lastIndex=r-o;return go(c)},Fm=Mm,Um=function(e,t,n,r){var o,i,a,u,s;return t.format=n,t.get=!0,t.getInner=!0,t.no_events||e.fire("BeforeGetContent",t),o="raw"===t.format?_t.trim(Fm(e.serializer,r.innerHTML)):"text"===t.format?e.dom.isEmpty(r)?"":go(r.innerText||r.textContent):"tree"===t.format?e.serializer.serialize(r,t):(a=(i=e).serializer.serialize(r,t),u=lc(i),s=new RegExp("^(<"+u+"[^>]*>(&nbsp;|&#160;|\\s|\xa0|<br \\/>|)<\\/"+u+">[\r\n]*|<br \\/>[\r\n]*)$"),a.replace(s,"")),M(["text","tree"],t.format)||co(Rt.fromDom(r))?t.content=o:t.content=_t.trim(o),t.no_events||e.fire("GetContent",t),t.content},zm=_t.each,jm=function(o){return{compare:function(e,t){if(e.nodeName!==t.nodeName)return!1;var n=function(n){var r={};return zm(o.getAttribs(n),function(e){var t=e.nodeName.toLowerCase();0!==t.indexOf("_")&&"style"!==t&&0!==t.indexOf("data-")&&(r[t]=o.getAttrib(n,t))}),r},r=function(e,t){var n,r;for(r in e)if(e.hasOwnProperty(r)){if(void 0===(n=t[r]))return!1;if(e[r]!==n)return!1;delete t[r]}for(r in t)if(t.hasOwnProperty(r))return!1;return!0};return!!r(n(e),n(t))&&(!!r(o.parseStyle(o.getAttrib(e,"style")),o.parseStyle(o.getAttrib(t,"style")))&&(!Xl(e)&&!Xl(t)))}}},Hm=_t.makeMap,Vm=function(e){var u=[],s=(e=e||{}).indent,c=Hm(e.indent_before||""),l=Hm(e.indent_after||""),f=li.getEncodeFunc(e.entity_encoding||"raw",e.entities),d="html"===e.element_format;return{start:function(e,t,n){var r,o,i,a;if(s&&c[e]&&0<u.length&&0<(a=u[u.length-1]).length&&"\n"!==a&&u.push("\n"),u.push("<",e),t)for(r=0,o=t.length;r<o;r++)i=t[r],u.push(" ",i.name,'="',f(i.value,!0),'"');u[u.length]=!n||d?">":" />",n&&s&&l[e]&&0<u.length&&0<(a=u[u.length-1]).length&&"\n"!==a&&u.push("\n")},end:function(e){var t;u.push("</",e,">"),s&&l[e]&&0<u.length&&0<(t=u[u.length-1]).length&&"\n"!==t&&u.push("\n")},text:function(e,t){0<e.length&&(u[u.length]=t?e:f(e))},cdata:function(e){u.push("<![CDATA[",e,"]]>")},comment:function(e){u.push("\x3c!--",e,"--\x3e")},pi:function(e,t){t?u.push("<?",e," ",f(t),"?>"):u.push("<?",e,"?>"),s&&u.push("\n")},doctype:function(e){u.push("<!DOCTYPE",e,">",s?"\n":"")},reset:function(){u.length=0},getContent:function(){return u.join("").replace(/\n$/,"")}}},qm=function(t,p){void 0===p&&(p=Ci());var g=Vm(t);(t=t||{}).validate=!("validate"in t)||t.validate;return{serialize:function(e){var f=t.validate,d={3:function(e){g.text(e.value,e.raw)},8:function(e){g.comment(e.value)},7:function(e){g.pi(e.name,e.value)},10:function(e){g.doctype(e.value)},4:function(e){g.cdata(e.value)},11:function(e){if(e=e.firstChild)for(;m(e),e=e.next;);}};g.reset();var m=function(e){var t,n,r,o,i,a,u,s,c,l=d[e.type];if(l)l(e);else{if(t=e.name,n=e.shortEnded,r=e.attributes,f&&r&&1<r.length&&((a=[]).map={},c=p.getElementRule(e.name))){for(u=0,s=c.attributesOrder.length;u<s;u++)(o=c.attributesOrder[u])in r.map&&(i=r.map[o],a.map[o]=i,a.push({name:o,value:i}));for(u=0,s=r.length;u<s;u++)(o=r[u].name)in a.map||(i=r.map[o],a.map[o]=i,a.push({name:o,value:i}));r=a}if(g.start(e.name,r,n),!n){if(e=e.firstChild)for(;m(e),e=e.next;);g.end(t)}}};return 1!==e.type||t.inner?d[11](e):m(e),g.getContent()}}},$m=function(n,r,o){return U.from(o.container()).filter(Mn).exists(function(e){var t=n?0:-1;return r(e.data.charAt(o.offset()+t))})},Wm=N($m,!0,Gl),Km=N($m,!1,Gl),Xm=function(e){var t=e.container();return Mn(t)&&(0===t.data.length||po(t.data)&&Gf.isBookmarkNode(t.parentNode))},Ym=function(t,n){return function(e){return U.from(Zc(t?0:-1,e)).filter(n).isSome()}},Gm=function(e){return Hn(e)&&"block"===tr(Rt.fromDom(e),"display")},Jm=function(e){return qn(e)&&!(Rn(t=e)&&"all"===t.getAttribute("data-mce-bogus"));var t},Qm=Ym(!0,Gm),Zm=Ym(!1,Gm),ep=Ym(!0,Wn),tp=Ym(!1,Wn),np=Ym(!0,Pn),rp=Ym(!1,Pn),op=Ym(!0,Jm),ip=Ym(!1,Jm),ap=function(e){var t=qu(e,"br"),n=H(function(e){for(var t=[],n=e.dom;n;)t.push(Rt.fromDom(n)),n=n.lastChild;return t}(e).slice(-1),ro);t.length===n.length&&Y(n,gn)},up=function(e){pn(e),dn(e,Rt.fromHtml('<br data-mce-bogus="1">'))},sp=function(n){en(n).each(function(t){Kt(t).each(function(e){to(n)&&ro(t)&&to(e)&&gn(t)})})},cp=function(e,t,n){return Lt(t,e)?function(e,t){for(var n=D(t)?t:b,r=e.dom,o=[];null!==r.parentNode&&r.parentNode!==undefined;){var i=r.parentNode,a=Rt.fromDom(i);if(o.push(a),!0===n(a))break;r=i}return o}(e,function(e){return n(e)||Bt(e,t)}).slice(0,-1):[]},lp=function(e,t){return cp(e,t,b)},fp=function(e,t){return[e].concat(lp(e,t))},dp=function(e,t,n){return Dl(e,t,n,Xm)},mp=function(e,t){return W(fp(Rt.fromDom(t.container()),e),to)},pp=function(e,n,r){return dp(e,n.dom,r).forall(function(t){return mp(n,r).fold(function(){return!1===Qc(t,r,n.dom)},function(e){return!1===Qc(t,r,n.dom)&&Lt(e,Rt.fromDom(t.container()))})})},gp=function(t,n,r){return mp(n,r).fold(function(){return dp(t,n.dom,r).forall(function(e){return!1===Qc(e,r,n.dom)})},function(e){return dp(t,e.dom,r).isNone()})},hp=N(gp,!1),vp=N(gp,!0),yp=N(pp,!1),bp=N(pp,!0),Cp=function(e){return ul(e).exists(ro)},wp=function(e,t,n){var r=H(fp(Rt.fromDom(n.container()),t),to),o=re(r).getOr(t);return Rl(e,o.dom,n).filter(Cp)},xp=function(e,t){return ul(t).exists(ro)||wp(!0,e,t).isSome()},Sp=function(e,t){return n=t,U.from(n.getNode(!0)).map(Rt.fromDom).exists(ro)||wp(!1,e,t).isSome();var n},Np=N(wp,!1),Ep=N(wp,!0),kp=function(e){return Is.isTextPosition(e)&&!e.isAtStart()&&!e.isAtEnd()},_p=function(e,t){var n=H(fp(Rt.fromDom(t.container()),e),to);return re(n).getOr(e)},Ap=function(e,t){return kp(t)?Km(t):Km(t)||Pl(_p(e,t).dom,t).exists(Km)},Rp=function(e,t){return kp(t)?Wm(t):Wm(t)||Bl(_p(e,t).dom,t).exists(Wm)},Tp=function(e){return ul(e).bind(function(e){return Dr(e,Ut)}).exists(function(e){return t=tr(e,"white-space"),M(["pre","pre-wrap"],t);var t})},Dp=function(e,t){return r=t,Pl(e.dom,r).isNone()||(n=t,Bl(e.dom,n).isNone())||hp(e,t)||vp(e,t)||Sp(e,t)||xp(e,t);var n,r},Op=function(e,t){return!Tp(t)&&(hp(e,t)||yp(e,t)||Sp(e,t)||Ap(e,t))},Bp=function(e,t){return!Tp(t)&&(vp(e,t)||bp(e,t)||xp(e,t)||Rp(e,t))},Pp=function(e,t){return Op(e,t)||Bp(e,(r=(n=t).container(),o=n.offset(),Mn(r)&&o<r.data.length?Is(r,o+1):n));var n,r,o},Lp=function(e,t){return Yl(e.charAt(t))},Ip=function(e){var t=e.container();return Mn(t)&&Ve(t.data,fo)},Mp=function(e){var n,t=e.data,r=(n=t.split(""),z(n,function(e,t){return Yl(e)&&0<t&&t<n.length-1&&Jl(n[t-1])&&Jl(n[t+1])?" ":e}).join(""));return r!==t&&(e.data=r,!0)},Fp=function(l,e){return U.some(e).filter(Ip).bind(function(e){var t,n,r,o,i,a,u,s,c=e.container();return(i=l,u=(a=c).data,s=Is(a,0),!(!Lp(u,0)||Pp(i,s)||(a.data=" "+u.slice(1),0))||Mp(c)||(t=l,r=(n=c).data,o=Is(n,r.length-1),!(!Lp(r,r.length-1)||Pp(t,o)||(n.data=r.slice(0,-1)+" ",0))))?U.some(e):U.none()})},Up=function(t){var e=Rt.fromDom(t.getBody());t.selection.isCollapsed()&&Fp(e,Is.fromRangeStart(t.selection.getRng())).each(function(e){t.selection.setRng(e.toRange())})},zp=function(e,t,n){var r,o,i,a,u,s,c,l;0!==n&&(r=Rt.fromDom(e),o=Tr(r,to).getOr(r),i=e.data.slice(t,t+n),a=t+n>=e.data.length&&Bp(o,Is(e,e.data.length)),u=0===t&&Op(o,Is(e,0)),e.replaceData(t,n,(c=u,l=a,$(s=i,function(e,t){return Gl(t)||Yl(t)?e.previousCharIsSpace||""===e.str&&c||e.str.length===s.length-1&&l?{previousCharIsSpace:!1,str:e.str+fo}:{previousCharIsSpace:!0,str:e.str+" "}:{previousCharIsSpace:!1,str:e.str+t}},{previousCharIsSpace:!1,str:""}).str)))},jp=function(e,t){var n=e.data.slice(t),r=n.length-Ke(n).length;return zp(e,t,r)},Hp=function(e,t){var n=e.data.slice(0,t),r=n.length-Xe(n).length;return zp(e,t-r,r)},Vp=function(e,t,n,r){void 0===r&&(r=!0);var o=Xe(e.data).length,i=r?e:t,a=r?t:e;return r?i.appendData(a.data):i.insertData(0,a.data),gn(Rt.fromDom(a)),n&&jp(i,o),i},qp=function(e,t){return r=e,o=(n=t).container(),i=n.offset(),!1===Is.isTextPosition(n)&&o===r.parentNode&&i>Is.before(r).offset()?Is(t.container(),t.offset()-1):t;var n,r,o,i},$p=function(e){return Io(e.previousSibling)?U.some((t=e.previousSibling,Mn(t)?Is(t,t.data.length):Is.after(t))):e.previousSibling?Il(e.previousSibling):U.none();var t},Wp=function(e){return Io(e.nextSibling)?U.some((t=e.nextSibling,Mn(t)?Is(t,0):Is.before(t))):e.nextSibling?Ll(e.nextSibling):U.none();var t},Kp=function(r,o){return $p(o).orThunk(function(){return Wp(o)}).orThunk(function(){return e=r,t=o,n=Is.before(t.previousSibling?t.previousSibling:t.parentNode),Pl(e,n).fold(function(){return Bl(e,Is.after(t))},U.some);var e,t,n})},Xp=function(n,r){return Wp(r).orThunk(function(){return $p(r)}).orThunk(function(){return t=r,Bl(e=n,Is.after(t)).fold(function(){return Pl(e,Is.before(t))},U.some);var e,t})},Yp=function(e,t,n){return(e?Xp:Kp)(t,n).map(N(qp,n))},Gp=function(t,n,e){e.fold(function(){t.focus()},function(e){t.selection.setRng(e.toRange(),n)})},Jp=function(e,t){return t&&ve(e.schema.getBlockElements(),It(t))},Qp=function(e){if(Wo(e)){var t=Rt.fromHtml('<br data-mce-bogus="1">');return pn(e),dn(e,t),U.some(Is.before(t.dom))}return U.none()},Zp=function(e,t,a){var n,r,o,i,u=Kt(e).filter(zt),s=Xt(e).filter(zt);return gn(e),r=s,o=t,i=function(e,t,n){var r=e.dom,o=t.dom,i=r.data.length;return Vp(r,o,a),n.container()===o?Is(r,i):n},((n=u).isSome()&&r.isSome()&&o.isSome()?U.some(i(n.getOrDie(),r.getOrDie(),o.getOrDie())):U.none()).orThunk(function(){return a&&(u.each(function(e){return Hp(e.dom,e.dom.length)}),s.each(function(e){return jp(e.dom,0)})),t})},eg=function(t,n,e,r){void 0===r&&(r=!0);var o,i,a=Yp(n,t.getBody(),e.dom),u=Tr(e,N(Jp,t),(o=t.getBody(),function(e){return e.dom===o})),s=Zp(e,a,(i=e,ve(t.schema.getTextInlineElements(),It(i))));t.dom.isEmpty(t.getBody())?(t.setContent(""),t.selection.setCursorLocation()):u.bind(Qp).fold(function(){r&&Gp(t,n,s)},function(e){r&&Gp(t,n,U.some(e))})},tg=function(e,t){return{start:e,end:t}},ng=wr([{removeTable:["element"]},{emptyCells:["cells"]},{deleteCellSelection:["rng","cell"]}]),rg=function(e,t){return Lr(Rt.fromDom(e),"td,th",t)},og=function(e,t){return Br(e,"table",t)},ig=function(e){return!Bt(e.start,e.end)},ag=function(e,t){return og(e.start,t).bind(function(r){return og(e.end,t).bind(function(e){return t=Bt(r,e),n=r,t?U.some(n):U.none();var t,n})})},ug=function(e){return qu(e,"td,th")},sg=function(r,e){var t=rg(e.startContainer,r),n=rg(e.endContainer,r);return e.collapsed?U.none():as(t,n,tg).fold(function(){return t.fold(function(){return n.bind(function(t){return og(t,r).bind(function(e){return re(ug(e)).map(function(e){return tg(e,t)})})})},function(t){return og(t,r).bind(function(e){return oe(ug(e)).map(function(e){return tg(t,e)})})})},function(e){return cg(r,e)?U.none():(n=r,og((t=e).start,n).bind(function(e){return oe(ug(e)).map(function(e){return tg(t.start,e)})}));var t,n})},cg=function(e,t){return ag(t,e).isSome()},lg=function(e,t,n){return e.filter(function(e){return ig(e)&&cg(n,e)}).orThunk(function(){return sg(n,t)}).bind(function(e){return ag(t=e,n).map(function(e){return{rng:t,table:e,cells:ug(e)}});var t})},fg=function(e,t){return G(e,function(e){return Bt(e,t)})},dg=function(e,r,o){return e.filter(function(e){return n=o,!ig(t=e)&&ag(t,n).exists(function(e){var t=e.dom.rows;return 1===t.length&&1===t[0].cells.length})&&Ff(e.start,r);var t,n}).map(function(e){return e.start})},mg=function(n){return as(fg((r=n).cells,r.rng.start),fg(r.cells,r.rng.end),function(e,t){return r.cells.slice(e,t+1)}).map(function(e){var t=n.cells;return e.length===t.length?ng.removeTable(n.table):ng.emptyCells(e)});var r},pg=function(e,t){var n,r,o,i,a,u=(n=e,function(e){return Bt(n,e)}),s=(o=u,i=rg((r=t).startContainer,o),a=rg(r.endContainer,o),as(i,a,tg));return dg(s,t,u).map(function(e){return ng.deleteCellSelection(t,e)}).orThunk(function(){return lg(s,t,u).bind(mg)})},gg=function(e){var t;return(8===Mt(t=e)||"#comment"===It(t)?Kt:en)(e).bind(gg).orThunk(function(){return U.some(e)})},hg=function(e,t){return Y(t,up),e.selection.setCursorLocation(t[0].dom,0),!0},vg=function(e,t,n){t.deleteContents();var r,o,i=gg(n).getOr(n),a=Rt.fromDom(e.dom.getParent(i.dom,e.dom.isBlock));return Wo(a)&&(up(a),e.selection.setCursorLocation(a.dom,0)),Bt(n,a)||(r=Wt(a).is(n)?[]:Wt(o=a).map(Jt).map(function(e){return H(e,function(e){return!Bt(o,e)})}).getOr([]),Y(r.concat(Jt(n)),function(e){Bt(e,a)||Lt(e,a)||gn(e)})),!0},yg=function(e,t){return eg(e,!1,t),!0},bg=function(n,e,r,t){return wg(e,t).fold(function(){return t=n,pg(e,r).map(function(e){return e.fold(N(yg,t),N(hg,t),N(vg,t))});var t},function(e){return xg(n,e)}).getOr(!1)},Cg=function(e,t){return W(fp(t,e),so)},wg=function(e,t){return W(fp(t,e),function(e){return"caption"===It(e)})},xg=function(e,t){return up(t),e.selection.setCursorLocation(t.dom,0),U.some(!0)},Sg=function(u,s,c,l,f){return Tl(c,u.getBody(),f).bind(function(e){return o=c,i=f,a=e,Ll((r=l).dom).bind(function(t){return Il(r.dom).map(function(e){return o?i.isEqual(t)&&a.isEqual(e):i.isEqual(e)&&a.isEqual(t)})}).getOr(!0)?xg(u,l):(t=l,n=e,wg(s,Rt.fromDom(n.getNode())).map(function(e){return!1===Bt(e,t)}));var t,n,r,o,i,a}).or(U.some(!0))},Ng=function(o,i,a,e){var u=Is.fromRangeStart(o.selection.getRng());return Cg(a,e).bind(function(e){return Wo(e)?xg(o,e):(t=a,n=e,r=u,Tl(i,o.getBody(),r).bind(function(e){return Cg(t,Rt.fromDom(e.getNode())).map(function(e){return!1===Bt(e,n)})}));var t,n,r}).getOr(!1)},Eg=function(e,t){return(e?np:rp)(t)},kg=function(a,u,r){var s=Rt.fromDom(a.getBody());return wg(s,r).fold(function(){return Ng(a,u,s,r)||(e=a,t=u,n=Is.fromRangeStart(e.selection.getRng()),Eg(t,n)||Rl(t,e.getBody(),n).exists(function(e){return Eg(t,e)}));var e,t,n},function(e){return t=a,n=u,r=s,o=e,i=Is.fromRangeStart(t.selection.getRng()),(Wo(o)?xg(t,o):Sg(t,r,n,o,i)).getOr(!1);var t,n,r,o,i})},_g=function(e,t){var n,r,o,i,a,u=Rt.fromDom(e.selection.getStart(!0)),s=Lf(e);return e.selection.isCollapsed()&&0===s.length?kg(e,t,u):(n=e,r=u,o=Rt.fromDom(n.getBody()),i=n.selection.getRng(),0!==(a=Lf(n)).length?hg(n,a):bg(n,o,i,r))},Ag=function(a){var u=Is.fromRangeStart(a),s=Is.fromRangeEnd(a),c=a.commonAncestorContainer;return Rl(!1,c,s).map(function(e){return!Qc(u,s,c)&&Qc(u,e,c)?(t=u.container(),n=u.offset(),r=e.container(),o=e.offset(),(i=document.createRange()).setStart(t,n),i.setEnd(r,o),i):a;var t,n,r,o,i}).getOr(a)},Rg=function(e){return e.collapsed?e:Ag(e)},Tg=function(e,t){var n,r;return e.getBlockElements()[t.name]&&((r=t).firstChild&&r.firstChild===r.lastChild)&&("br"===(n=t.firstChild).name||n.value===fo)},Dg=function(e,t){var n,r,o,i=t.firstChild,a=t.lastChild;return i&&"meta"===i.name&&(i=i.next),a&&"mce_marker"===a.attr("id")&&(a=a.prev),r=a,o=(n=e).getNonEmptyElements(),r&&(r.isEmpty(o)||Tg(n,r))&&(a=a.prev),!(!i||i!==a)&&("ul"===i.name||"ol"===i.name)},Og=function(e){return e&&e.firstChild&&e.firstChild===e.lastChild&&((t=e.firstChild).data===fo||jn(t));var t},Bg=function(e){return 0<e.length&&(!(t=e[e.length-1]).firstChild||Og(t))?e.slice(0,-1):e;var t},Pg=function(e,t){var n=e.getParent(t,e.isBlock);return n&&"LI"===n.nodeName?n:null},Lg=function(e,t){var n=Is.after(e),r=Nl(t).prev(n);return r?r.toRange():null},Ig=function(t,e,n){var r,o,i,a,u=t.parentNode;return _t.each(e,function(e){u.insertBefore(e,t)}),r=t,o=n,i=Is.before(r),(a=Nl(o).next(i))?a.toRange():null},Mg=function(e,o,i,t){var n,r,a,u,s,c,l,f,d,m,p,g,h,v,y,b,C,w,x,S,N=(n=o,r=t,c=e.serialize(r),l=n.createFragment(c),u=(a=l).firstChild,s=a.lastChild,u&&"META"===u.nodeName&&u.parentNode.removeChild(u),s&&"mce_marker"===s.id&&s.parentNode.removeChild(s),a),E=Pg(o,i.startContainer),k=Bg((f=N.firstChild,_t.grep(f.childNodes,function(e){return"LI"===e.nodeName}))),_=o.getRoot(),A=function(e){var t=Is.fromRangeStart(i),n=Nl(o.getRoot()),r=1===e?n.prev(t):n.next(t);return!r||Pg(o,r.getNode())!==E};return A(1)?Ig(E,k,_):A(2)?(d=E,m=k,p=_,o.insertAfter(m.reverse(),d),Lg(m[0],p)):(h=k,v=_,y=g=E,C=(b=i).cloneRange(),w=b.cloneRange(),C.setStartBefore(y),w.setEndAfter(y),x=[C.cloneContents(),w.cloneContents()],(S=g.parentNode).insertBefore(x[0],g),_t.each(h,function(e){S.insertBefore(e,g)}),S.insertBefore(x[1],g),S.removeChild(g),Lg(h[h.length-1],v))},Fg=$n,Ug=function(e){var t=e.dom,n=Rg(e.selection.getRng());e.selection.setRng(n);var r,o,i,a=t.getParent(n.startContainer,Fg);r=t,o=n,null!==(i=a)&&i===r.getParent(o.endContainer,Fg)&&Ff(Rt.fromDom(i),o)?vg(e,n,Rt.fromDom(a)):e.getDoc().execCommand("Delete",!1,null)},zg=function(e,t,n){var r,o,i,a,u,s,c,l,f,d=e.selection,m=e.dom;/^ | $/.test(t)&&(s=m,c=d.getRng(),l=t,f=Rt.fromDom(s.getRoot()),l=Op(f,Is.fromRangeStart(c))?l.replace(/^ /,"&nbsp;"):l.replace(/^&nbsp;/," "),t=l=Bp(f,Is.fromRangeEnd(c))?l.replace(/(&nbsp;| )(<br( \/)>)?$/,"&nbsp;"):l.replace(/&nbsp;(<br( \/)?>)?$/," "));var p=e.parser,g=n.merge,h=qm({validate:e.getParam("validate")},e.schema),v='<span id="mce_marker" data-mce-type="bookmark">&#xFEFF;</span>',y={content:t,format:"html",selection:!0,paste:n.paste};if((y=e.fire("BeforeSetContent",y)).isDefaultPrevented())e.fire("SetContent",{content:y.content,format:"html",selection:!0,paste:n.paste});else{-1===(t=y.content).indexOf("{$caret}")&&(t+="{$caret}"),t=t.replace(/\{\$caret\}/,v);var b,C,w=(a=d.getRng()).startContainer||(a.parentElement?a.parentElement():null),x=e.getBody();w===x&&d.isCollapsed()&&m.isBlock(x.firstChild)&&(b=e,(C=x.firstChild)&&!b.schema.getShortEndedElements()[C.nodeName])&&m.isEmpty(x.firstChild)&&((a=m.createRng()).setStart(x.firstChild,0),a.setEnd(x.firstChild,0),d.setRng(a)),d.isCollapsed()||Ug(e);var S,N,E,k,_,A,R,T,D,O,B,P,L,I,M={context:(r=d.getNode()).nodeName.toLowerCase(),data:n.data,insert:!0},F=p.parse(t,M);if(!0===n.paste&&Dg(e.schema,F)&&Pg(m,r))return a=Mg(h,m,d.getRng(),F),d.setRng(a),void e.fire("SetContent",y);if(!function(e){for(var t=e;t=t.walk();)1===t.type&&t.attr("data-mce-fragment","1")}(F),"mce_marker"===(u=F.lastChild).attr("id"))for(u=(i=u).prev;u;u=u.walk(!0))if(3===u.type||!m.isBlock(u.name)){e.schema.isValidChild(u.parent.name,"span")&&u.parent.insert(i,u,"br"===u.name);break}if(e._selectionOverrides.showBlockCaretContainer(r),M.invalid){for(e.selection.setContent(v),r=d.getNode(),o=e.getBody(),9===r.nodeType?r=u=o:u=r;u!==o;)u=(r=u).parentNode;t=r===o?o.innerHTML:m.getOuterHTML(r),t=h.serialize(p.parse(t.replace(/<span (id="mce_marker"|id=mce_marker).+?<\/span>/i,function(){return h.serialize(F)}))),r===o?m.setHTML(o,t):m.setOuterHTML(r,t)}else t=h.serialize(F),S=e,N=t,"all"===(E=r).getAttribute("data-mce-bogus")?E.parentNode.insertBefore(S.dom.createFragment(N),E):(k=E.firstChild,_=E.lastChild,!k||k===_&&"BR"===k.nodeName?S.dom.setHTML(E,N):S.selection.setContent(N));R=g,O=(A=e).schema.getTextInlineElements(),B=A.dom,R&&(T=A.getBody(),D=jm(B),_t.each(B.select("*[data-mce-fragment]"),function(e){for(var t=e.parentNode;t&&t!==T;t=t.parentNode)O[e.nodeName.toLowerCase()]&&D.compare(t,e)&&B.remove(e,!0)})),function(n,e){var t,r,o=n.dom,i=n.selection;if(e){i.scrollIntoView(e);var a=function(e){for(var t=n.getBody();e&&e!==t;e=e.parentNode)if("false"===o.getContentEditable(e))return e;return null}(e);if(a)return o.remove(e),i.select(a);var u=o.createRng(),s=e.previousSibling;s&&3===s.nodeType?(u.setStart(s,s.nodeValue.length),xt.ie||(r=e.nextSibling)&&3===r.nodeType&&(s.appendData(r.data),r.parentNode.removeChild(r))):(u.setStartBefore(e),u.setEndBefore(e));var c=o.getParent(e,o.isBlock);o.remove(e),c&&o.isEmpty(c)&&(n.$(c).empty(),u.setStart(c,0),u.setEnd(c,0),Fg(c)||c.getAttribute("data-mce-fragment")||!(t=function(e){var t=Is.fromRangeStart(e);if(t=Nl(n.getBody()).next(t))return t.toRange()}(u))?o.add(c,o.create("br",{"data-mce-bogus":"1"})):(u=t,o.remove(c))),i.setRng(u)}}(e,m.get("mce_marker")),P=e.getBody(),_t.each(P.getElementsByTagName("*"),function(e){e.removeAttribute("data-mce-fragment")}),L=m,I=d.getStart(),U.from(L.getParent(I,"td,th")).map(Rt.fromDom).each(sp),e.fire("SetContent",y),e.addVisual()}},jg=function(e,t){t(e),e.firstChild&&jg(e.firstChild,t),e.next&&jg(e.next,t)},Hg=function(e,t,n){var r=function(e,n,t){var r={},o={},i=[];for(var a in t.firstChild&&jg(t.firstChild,function(t){Y(e,function(e){e.name===t.name&&(r[e.name]?r[e.name].nodes.push(t):r[e.name]={filter:e,nodes:[t]})}),Y(n,function(e){"string"==typeof t.attr(e.name)&&(o[e.name]?o[e.name].nodes.push(t):o[e.name]={filter:e,nodes:[t]})})}),r)r.hasOwnProperty(a)&&i.push(r[a]);for(var u in o)o.hasOwnProperty(u)&&i.push(o[u]);return i}(e,t,n);Y(r,function(t){Y(t.filter.callbacks,function(e){e(t.nodes,t.filter.name,{})})})},Vg=function(e){return e instanceof Am},qg=function(e,t){var r;e.dom.setHTML(e.getBody(),t),vm(r=e)&&Ll(r.getBody()).each(function(e){var t=e.getNode(),n=Pn(t)?Ll(t).getOr(e):e;r.selection.setRng(n.toRange())})},$g=function(u,s,c){return c.format=c.format?c.format:"html",c.set=!0,c.content=Vg(s)?"":s,c.no_events||u.fire("BeforeSetContent",c),Vg(s)||(s=c.content),U.from(u.getBody()).fold(S(s),function(e){return Vg(s)?function(e,t,n,r){Hg(e.parser.getNodeFilters(),e.parser.getAttributeFilters(),n);var o=qm({validate:e.validate},e.schema).serialize(n);return r.content=co(Rt.fromDom(t))?o:_t.trim(o),qg(e,r.content),r.no_events||e.fire("SetContent",r),n}(u,e,s,c):(t=u,n=e,o=c,0===(r=s).length||/^\s+$/.test(r)?(a='<br data-mce-bogus="1">',"TABLE"===n.nodeName?r="<tr><td>"+a+"</td></tr>":/^(UL|OL)$/.test(n.nodeName)&&(r="<li>"+a+"</li>"),r=(i=lc(t))&&t.schema.isValidChild(n.nodeName.toLowerCase(),i.toLowerCase())?(r=a,t.dom.createHTML(i,fc(t),r)):r||'<br data-mce-bogus="1">',qg(t,r),t.fire("SetContent",o)):("raw"!==o.format&&(r=qm({validate:t.validate},t.schema).serialize(t.parser.parse(r,{isRootContent:!0,insert:!0}))),o.content=co(Rt.fromDom(n))?r:_t.trim(r),qg(t,o.content),o.no_events||t.fire("SetContent",o)),o.content);var t,n,r,o,i,a})},Wg=function(e,t){return r=t,((o=(n=e).dom).parentNode?Or(Rt.fromDom(o.parentNode),function(e){return!Bt(n,e)&&r(e)}):U.none()).isSome();var n,r,o},Kg=function(e){return D(e)?e:b},Xg=function(e,t,n){var r=t(e),o=Kg(n);return r.orThunk(function(){return o(e)?U.none():function(e,t,n){for(var r=e.dom,o=Kg(n);r.parentNode;){r=r.parentNode;var i=Rt.fromDom(r),a=t(i);if(a.isSome())return a;if(o(i))break}return U.none()}(e,t,o)})},Yg=af,Gg=function(e,t,n){var r=e.formatter.get(n);if(r)for(var o=0;o<r.length;o++)if(!1===r[o].inherit&&e.dom.is(t,r[o].selector))return!0;return!1},Jg=function(t,e,n,r){var o=t.dom.getRoot();return e!==o&&(e=t.dom.getParent(e,function(e){return!!Gg(t,e,n)||(e.parentNode===o||!!eh(t,e,n,r,!0))}),eh(t,e,n,r))},Qg=function(e,t,n){return!!Yg(t,n.inline)||(!!Yg(t,n.block)||(n.selector?1===t.nodeType&&e.is(t,n.selector):void 0))},Zg=function(e,t,n,r,o,i){var a,u,s,c=n[r];if(n.onmatch)return n.onmatch(t,n,r);if(c)if("undefined"==typeof c.length){for(a in c)if(c.hasOwnProperty(a)){if(u="attributes"===r?e.getAttrib(t,a):sf(e,t,a),o&&!u&&!n.exact)return;if((!o||n.exact)&&!Yg(u,uf(e,of(c[a],i),a)))return}}else for(s=0;s<c.length;s++)if("attributes"===r?e.getAttrib(t,c[s]):sf(e,t,c[s]))return n;return n},eh=function(e,t,n,r,o){var i,a,u,s,c=e.formatter.get(n),l=e.dom;if(c&&t)for(a=0;a<c.length;a++)if(i=c[a],Qg(e.dom,t,i)&&Zg(l,t,i,"attributes",o,r)&&Zg(l,t,i,"styles",o,r)){if(s=i.classes)for(u=0;u<s.length;u++)if(!e.dom.hasClass(t,s[u]))return;return i}},th=function(e,t,n,r){if(r)return Jg(e,r,t,n);if(r=e.selection.getNode(),Jg(e,r,t,n))return!0;var o=e.selection.getStart();return!(o===r||!Jg(e,o,t,n))},nh=function(r,t){var n=function(e){return Bt(e,Rt.fromDom(r.getBody()))};return U.from(r.selection.getStart(!0)).bind(function(e){return Xg(Rt.fromDom(e),function(n){return function(e,t){for(var n=0;n<e.length;n++){var r=t(e[n],n);if(r.isSome())return r}return U.none()}(t,function(e){return t=e,eh(r,n.dom,t)?U.some(t):U.none();var t})},n)}).getOrNull()},rh=function(o,i,e){return $(e,function(e,t){var n,r=(n=t,F(o.formatter.get(n),function(t){var n=function(e){return 1<e.length&&"%"===e.charAt(0)};return F(["styles","attributes"],function(e){return he(t,e).exists(function(e){var t=_(e)?e:ge(e);return F(t,n)})})}));return o.formatter.matchNode(i,t,{},r)?e.concat([t]):e},[])},oh=mo,ih="_mce_caret",ah=function(e){return 0<function(e){for(var t=[];e;){if(3===e.nodeType&&e.nodeValue!==oh||1<e.childNodes.length)return[];1===e.nodeType&&t.push(e),e=e.firstChild}return t}(e).length},uh=function(e){if(e){var t=new Yr(e,e);for(e=t.current();e;e=t.next())if(Mn(e))return e}return null},sh=function(e){var t=Rt.fromTag("span");return Gn(t,{id:ih,"data-mce-bogus":"1","data-mce-type":"format-caret"}),e&&dn(t,Rt.fromText(oh)),t},ch=function(e,t,n){void 0===n&&(n=!0);var r,o,i,a,u,s,c,l,f=e.dom,d=e.selection;ah(t)?eg(e,!1,Rt.fromDom(t),n):(r=d.getRng(),o=f.getParent(t,f.isBlock),i=r.startContainer,a=r.startOffset,u=r.endContainer,s=r.endOffset,(l=uh(t))&&l.nodeValue.charAt(0)===oh&&l.deleteData(0,1),c=l,f.remove(t,!0),i===c&&0<a&&r.setStart(c,a-1),u===c&&0<s&&r.setEnd(c,s-1),o&&f.isEmpty(o)&&up(Rt.fromDom(o)),d.setRng(r))},lh=function(e,t,n){void 0===n&&(n=!0);var r=e.dom,o=e.selection;if(t)ch(e,t,n);else if(!(t=Ul(e.getBody(),o.getStart())))for(;t=r.get(ih);)ch(e,t,!1)},fh=function(e,t){return e.appendChild(t),t},dh=function(e,t){var n=q(e,function(e,t){return fh(e,t.cloneNode(!1))},t);return fh(n,n.ownerDocument.createTextNode(oh))},mh=function(e,t,n,r){var o,i,a,u,s,c,l,f,d,m,p,g,h,v=e.dom,y=e.selection,b=[],C=y.getRng(),w=C.startContainer,x=C.startOffset,S=w;for(3===w.nodeType&&(x!==w.nodeValue.length&&(o=!0),S=S.parentNode);S;){if(eh(e,S,t,n,r)){i=S;break}S.nextSibling&&(o=!0),b.push(S),S=S.parentNode}i&&(o?(a=y.getBookmark(),C.collapse(!0),u=Rf(e,C,e.formatter.get(t),!0),u=md(u),e.formatter.remove(t,n,u,r),y.moveToBookmark(a)):(s=Ul(e.getBody(),i),c=sh(!1).dom,m=c,p=null!==s?s:i,g=(d=e).dom,(h=g.getParent(p,N(tf,d)))&&g.isEmpty(h)?p.parentNode.replaceChild(m,p):(ap(Rt.fromDom(p)),g.isEmpty(p)?p.parentNode.replaceChild(m,p):g.insertAfter(m,p)),l=function(t,e,n,r,o,i){var a=t.formatter,u=t.dom,s=H(ae(a.get()),function(e){return e!==r&&!Ve(e,"removeformat")}),c=rh(t,n,s);if(0<H(c,function(e){return!ff(t,e,r)}).length){var l=n.cloneNode(!1);return u.add(e,l),a.remove(r,o,l,i),u.remove(l),U.some(l)}return U.none()}(e,c,i,t,n,r),f=dh(b.concat(l.toArray()),c),ch(e,s,!1),y.setCursorLocation(f,1),v.isEmpty(i)&&v.remove(i)))},ph=function(i){i.on("mouseup keydown",function(e){var t,n,r,o;t=i,n=e.keyCode,r=t.selection,o=t.getBody(),lh(t,null,!1),8!==n&&46!==n||!r.isCollapsed()||r.getStart().innerHTML!==oh||lh(t,Ul(o,r.getStart())),37!==n&&39!==n||lh(t,Ul(o,r.getStart()))})},gh=function(e,t){return e.schema.getTextInlineElements().hasOwnProperty(It(t))&&!Fl(t.dom)&&!Bn(t.dom)},hh={},vh=xe,yh=Ce;Im=function(e){var t,n=e.selection.getRng(),r=Tn(["pre"]);n.collapsed||(t=e.selection.getSelectedBlocks(),yh(vh(vh(t,r),function(e){return r(e.previousSibling)&&-1!==Se(t,e.previousSibling)}),function(e){var t,n;t=e.previousSibling,gu(n=e).remove(),gu(t).append("<br><br>").append(n.childNodes)}))},hh[Lm="pre"]||(hh[Lm]=[]),hh[Lm].push(Im);var bh=_t.each,Ch=function(e){return Rn(e)&&!Xl(e)&&!Fl(e)&&!Bn(e)},wh=function(e,t){for(var n=e;n;n=n[t]){if(Mn(n)&&0!==n.nodeValue.length)return e;if(Rn(n)&&!Xl(n))return n}return e},xh=function(e,t,n){var r,o,i=jm(e);if(t&&n&&(t=wh(t,"previousSibling"),n=wh(n,"nextSibling"),i.compare(t,n))){for(r=t.nextSibling;r&&r!==n;)r=(o=r).nextSibling,t.appendChild(o);return e.remove(n),_t.each(_t.grep(n.childNodes),function(e){t.appendChild(e)}),t}return n},Sh=function(e,t,n,r){var o;r&&!1!==t.merge_siblings&&(o=xh(e,ef(r),r),xh(e,o,ef(o,!0)))},Nh=function(e,t,n){bh(e.childNodes,function(e){Ch(e)&&(t(e)&&n(e),e.hasChildNodes()&&Nh(e,t,n))})},Eh=function(t,n){return function(e){return!(!e||!sf(t,e,n))}},kh=function(r,o,i){return function(e){var t,n;r.setStyle(e,o,i),""===e.getAttribute("style")&&e.removeAttribute("style"),t=r,"SPAN"===(n=e).nodeName&&0===t.getAttribs(n).length&&t.remove(n,!0)}},_h=wr([{keep:[]},{rename:["name"]},{removed:[]}]),Ah=/^(src|href|style)$/,Rh=_t.each,Th=af,Dh=function(e,t,n){return e.isChildOf(t,n)&&t!==n&&!e.isBlock(n)},Oh=function(e,t,n){var r,o=t[n?"startContainer":"endContainer"],i=t[n?"startOffset":"endOffset"];return Rn(o)&&(r=o.childNodes.length-1,!n&&i&&i--,o=o.childNodes[r<i?r:i]),Mn(o)&&n&&i>=o.nodeValue.length&&(o=new Yr(o,e.getBody()).next()||o),Mn(o)&&!n&&0===i&&(o=new Yr(o,e.getBody()).prev()||o),o},Bh=function(e,t){var n=t?"firstChild":"lastChild";if(/^(TR|TH|TD)$/.test(e.nodeName)&&e[n]){var r=e[n];return"TR"===e.nodeName&&r[n]||r}return e},Ph=function(e,t,n,r){var o=e.create(n,r);return t.parentNode.insertBefore(o,t),o.appendChild(t),o},Lh=function(e,t,n,r,o){var i=Rt.fromDom(t),a=Rt.fromDom(e.create(r,o)),u=(n?Gt:Yt)(i);return mn(a,u),n?(cn(i,a),fn(a,i)):(ln(i,a),dn(a,i)),a.dom},Ih=function(e,t,n,r){return!(t=ef(t,n,r))||"BR"===t.nodeName||e.isBlock(t)},Mh=function(e,r,o,t,i){var n,a,u,s,c,l=e.dom;if(u=l,!(Th(s=t,(c=r).inline)||Th(s,c.block)||c.selector&&(Rn(s)&&u.is(s,c.selector))||(a=t,r.links&&"A"===a.nodeName)))return _h.keep();var f,d,m,p,g,h,v,y=t;if(r.inline&&"all"===r.remove&&_(r.preserve_attributes)){var b=H(l.getAttribs(y),function(e){return M(r.preserve_attributes,e.name.toLowerCase())});if(l.removeAllAttribs(y),Y(b,function(e){return l.setAttrib(y,e.name,e.value)}),0<b.length)return _h.rename("span")}if("all"!==r.remove){Rh(r.styles,function(e,t){e=uf(l,of(e,o),t+""),O(t)&&(t=e,i=null),!r.remove_similar&&i&&!Th(sf(l,i,t),e)||l.setStyle(y,t,""),n=!0}),n&&""===l.getAttrib(y,"style")&&(y.removeAttribute("style"),y.removeAttribute("data-mce-style")),Rh(r.attributes,function(e,t){var n;if(e=of(e,o),O(t)&&(t=e,i=null),r.remove_similar||!i||Th(l.getAttrib(i,t),e)){if("class"===t&&(e=l.getAttrib(y,t))&&(n="",Y(e.split(/\s+/),function(e){/mce\-\w+/.test(e)&&(n+=(n?" ":"")+e)}),n))return void l.setAttrib(y,t,n);"class"===t&&y.removeAttribute("className"),Ah.test(t)&&y.removeAttribute("data-mce-"+t),y.removeAttribute(t)}}),Rh(r.classes,function(e){e=of(e,o),i&&!l.hasClass(i,e)||l.removeClass(y,e)});for(var C=l.getAttribs(y),w=0;w<C.length;w++){var x=C[w].nodeName;if(0!==x.indexOf("_")&&0!==x.indexOf("data-"))return _h.keep()}}return"none"!==r.remove?(f=e,m=r,g=(d=y).parentNode,h=f.dom,v=lc(f),m.block&&(v?g===h.getRoot()&&(m.list_block&&Th(d,m.list_block)||Y(ie(d.childNodes),function(e){nf(f,v,e.nodeName.toLowerCase())?p?p.appendChild(e):(p=Ph(h,e,v),h.setAttribs(p,f.settings.forced_root_block_attrs)):p=0})):h.isBlock(d)&&!h.isBlock(g)&&(Ih(h,d,!1)||Ih(h,d.firstChild,!0,!0)||d.insertBefore(h.create("br"),d.firstChild),Ih(h,d,!0)||Ih(h,d.lastChild,!1,!0)||d.appendChild(h.create("br")))),m.selector&&m.inline&&!Th(m.inline,d)||h.remove(d,!0),_h.removed()):_h.keep()},Fh=function(t,e,n,r,o){return Mh(t,e,n,r,o).fold(b,function(e){return t.dom.rename(r,e),!0},w)},Uh=function(e,t,n,r,o,i,a,u){var s,c,l,f=e.dom;if(n){for(var d=n.parentNode,m=r.parentNode;m&&m!==d;m=m.parentNode){s=f.clone(m,!1);for(var p=0;p<t.length&&null!==(s=function(t,e,n,r){return Mh(t,e,n,r,r).fold(S(r),function(e){return t.dom.createFragment().appendChild(r),t.dom.rename(r,e)},S(null))}(e,t[p],u,s));p++);s&&(c&&s.appendChild(c),l=l||s,c=s)}!i||a.mixed&&f.isBlock(n)||(r=f.split(n,r)),c&&(o.parentNode.insertBefore(c,o),l.appendChild(o),a.inline&&Sh(f,a,0,c))}return r},zh=function(s,c,l,e,f){var t,d=s.formatter.get(c),m=d[0],i=!0,a=s.dom,n=s.selection,u=function(e){var n,t,r,o,i,a,u=(t=e,r=c,o=l,i=f,Y(lf((n=s).dom,t.parentNode).reverse(),function(e){var t;a||"_start"===e.id||"_end"===e.id||(t=eh(n,e,r,o,i))&&!1!==t.split&&(a=e)}),a);return Uh(s,d,u,e,e,!0,m,l)},p=function(e){var t,n;Rn(e)&&a.getContentEditable(e)&&(t=i,i="true"===a.getContentEditable(e),n=!0);var r=ie(e.childNodes);if(i&&!n)for(var o=0;o<d.length&&!Fh(s,d[o],l,e,e);o++);if(m.deep&&r.length){for(o=0;o<r.length;o++)p(r[o]);n&&(i=t)}},g=function(e){var t,n=a.get(e?"_start":"_end"),r=n[e?"firstChild":"lastChild"];return Xl(t=r)&&Rn(t)&&("_start"===t.id||"_end"===t.id)&&(r=r[e?"firstChild":"lastChild"]),Mn(r)&&0===r.data.length&&(r=e?n.previousSibling||n.nextSibling:n.nextSibling||n.previousSibling),a.remove(n,!0),r},r=function(e){var t,n,r=Rf(s,e,d,e.collapsed);if(m.split){if(r=md(r),(t=Oh(s,r,!0))!==(n=Oh(s,r))){if(t=Bh(t,!0),n=Bh(n,!1),Dh(a,t,n)){var o=U.from(t.firstChild).getOr(t);return u(Lh(a,o,!0,"span",{id:"_start","data-mce-type":"bookmark"})),void g(!0)}if(Dh(a,n,t)){o=U.from(n.lastChild).getOr(n);return u(Lh(a,o,!1,"span",{id:"_end","data-mce-type":"bookmark"})),void g(!1)}t=Ph(a,t,"span",{id:"_start","data-mce-type":"bookmark"}),n=Ph(a,n,"span",{id:"_end","data-mce-type":"bookmark"});var i=a.createRng();i.setStartAfter(t),i.setEndBefore(n),Df(a,i,function(e){Y(e,function(e){Xl(e)||Xl(e.parentNode)||u(e)})}),u(t),u(n),t=g(!0),n=g()}else t=n=u(t);r.startContainer=t.parentNode?t.parentNode:t,r.startOffset=a.nodeIndex(t),r.endContainer=n.parentNode?n.parentNode:n,r.endOffset=a.nodeIndex(n)+1}Df(a,r,function(e){Y(e,function(t){p(t);Y(["underline","line-through","overline"],function(e){Rn(t)&&s.dom.getStyle(t,"text-decoration")===e&&t.parentNode&&cf(a,t.parentNode)===e&&Fh(s,{deep:!1,exact:!0,inline:"span",styles:{textDecoration:e}},null,t)})})})};if(e)Ql(e)?((t=a.createRng()).setStartBefore(e),t.setEndAfter(e),r(t)):r(e);else if("false"!==a.getContentEditable(n.getNode()))n.isCollapsed()&&m.inline&&!Lf(s).length?mh(s,c,l,f):(Hf(n,!0,function(){jf(s,r)}),m.inline&&th(s,c,l,n.getStart())&&Zl(a,n,n.getRng()),s.nodeChanged());else{e=n.getNode();for(var o=0;o<d.length&&(!d[o].ceFalseOverride||!Fh(s,d[o],l,e,e));o++);}},jh=_t.each,Hh=function(i,e,a,u){jh(e,function(t){var r,e,n,o;jh(i.dom.select(t.inline,u),function(e){Ch(e)&&Fh(i,t,a,e,t.exact?e:null)}),r=i.dom,n=u,(e=t).clear_child_styles&&(o=e.links?"*:not(a)":"*",bh(r.select(o,n),function(n){Ch(n)&&bh(e.styles,function(e,t){r.setStyle(n,t,"")})}))})},Vh=_t.each,qh=ye,$h=function(E,k,_,r){var e,t,n,o,A=E.formatter.get(k),R=A[0],i=!r&&E.selection.isCollapsed(),a=E.dom,u=E.selection,T=function(n,e){var t;e=e||R,n&&(e.onformat&&e.onformat(n,e,_,r),Vh(e.styles,function(e,t){a.setStyle(n,t,of(e,_))}),!e.styles||(t=a.getAttrib(n,"style"))&&a.setAttrib(n,"data-mce-style",t),Vh(e.attributes,function(e,t){a.setAttrib(n,t,of(e,_))}),Vh(e.classes,function(e){e=of(e,_),a.hasClass(n,e)||a.addClass(n,e)}))},m=function(e,t){var n=!1;return!!mf(R)&&(Vh(e,function(e){if(!("collapsed"in e&&e.collapsed!==i))return a.is(t,e.selector)&&!Fl(t)?(T(t,e),!(n=!0)):void 0}),n)},s=function(S,e,t,c){var N=[],l=!0,f=R.inline||R.block,d=S.create(f);T(d),Df(S,e,function(e){var u,s=function(e){var t=!1,n=l,r=e.nodeName.toLowerCase(),o=e.parentNode.nodeName.toLowerCase();if(Rn(e)&&S.getContentEditable(e)&&(n=l,l="true"===S.getContentEditable(e),t=!0),jn(e)&&!function(e,t,n,r){if(e.getParam("format_empty_lines",!1,"boolean")&&pf(t)){var o=_e(_e({},e.schema.getTextBlockElements()),{td:{},th:{},li:{},dt:{},dd:{},figcaption:{},caption:{},details:{},summary:{}}),i=Wg(Rt.fromDom(n),function(e){return Fl(e.dom)});return ye(o,r)&&Wo(Rt.fromDom(n.parentNode),!1)&&!i}return!1}(E,R,e,o))return u=null,void(df(R)&&S.remove(e));if(R.wrapper&&eh(E,e,k,_))u=null;else{if(l&&!t&&df(R)&&!R.wrapper&&tf(E,r)&&nf(E,o,f)){var i=S.rename(e,f);return T(i),N.push(i),void(u=null)}if(mf(R)){var a=m(A,e);if(!qh(R,"inline")||a)return void(u=null)}!l||t||!nf(E,f,r)||!nf(E,o,f)||!c&&3===e.nodeType&&1===e.nodeValue.length&&65279===e.nodeValue.charCodeAt(0)||Fl(e)||qh(R,"inline")&&S.isBlock(e)?(u=null,Vh(_t.grep(e.childNodes),s),t&&(l=n),u=null):(u||(u=S.clone(d,!1),e.parentNode.insertBefore(u,e),N.push(u)),u.appendChild(e))}};Vh(e,s)}),!0===R.links&&Vh(N,function(e){var t=function(e){"A"===e.nodeName&&T(e,R),Vh(_t.grep(e.childNodes),t)};t(e)}),Vh(N,function(e){var n,t,r,o,i,a,u,s,c,l,f,d,m,p,g,h,v,y,b,C,w=function(e){var n=!1;return Vh(e.childNodes,function(e){if((t=e)&&1===t.nodeType&&!Xl(t)&&!Fl(t)&&!Bn(t))return n=e,!1;var t}),n},x=(n=0,Vh(e.childNodes,function(e){var t;V(t=e)&&Mn(t)&&0===t.length||Xl(e)||n++}),n);!(1<N.length)&&S.isBlock(e)||0!==x?(pf(R)||R.wrapper)&&(R.exact||1!==x||((C=w(y=e))&&!Xl(C)&&Qg(S,C,R)&&(b=S.clone(C,!1),T(b),S.replace(b,y,!0),S.remove(C,!0)),e=b||y),Hh(E,A,_,e),p=R,g=k,h=_,eh(m=E,(v=e).parentNode,g,h)&&Fh(m,p,h,v)||p.merge_with_parents&&m.dom.getParent(v.parentNode,function(e){if(eh(m,e,g,h))return Fh(m,p,h,v),!0}),c=S,f=_,d=e,(l=R).styles&&l.styles.backgroundColor&&Nh(d,Eh(c,"fontSize"),kh(c,"backgroundColor",of(l.styles.backgroundColor,f))),i=S,u=e,s=function(e){var t;1===e.nodeType&&e.parentNode&&1===e.parentNode.nodeType&&(t=cf(i,e.parentNode),i.getStyle(e,"color")&&t?i.setStyle(e,"text-decoration",t):i.getStyle(e,"text-decoration")===t&&i.setStyle(e,"text-decoration",null))},(a=R).styles&&(a.styles.color||a.styles.textDecoration)&&(_t.walk(u,s,"childNodes"),s(u)),t=S,o=e,"sub"!==(r=R).inline&&"sup"!==r.inline||(Nh(o,Eh(t,"fontSize"),kh(t,"fontSize","")),t.remove(t.select("sup"===r.inline?"sub":"sup",o),!0)),Sh(S,R,0,e)):S.remove(e,!0)})};if("false"!==a.getContentEditable(u.getNode())){R&&(r?Ql(r)?m(A,r)||((e=a.createRng()).setStartBefore(r),e.setEndAfter(r),s(a,Rf(E,e,A),0,!0)):s(a,r,0,!0):i&&pf(R)&&!Lf(E).length?function(e,t,n){var r,o=e.selection,i=o.getRng(),a=i.startOffset,u=i.startContainer.nodeValue,s=Ul(e.getBody(),o.getStart());s&&(r=uh(s));var c,l,f,d,m=/[^\s\u00a0\u00ad\u200b\ufeff]/;u&&0<a&&a<u.length&&m.test(u.charAt(a))&&m.test(u.charAt(a-1))?(c=o.getBookmark(),i.collapse(!0),l=Rf(e,i,e.formatter.get(t)),l=md(l),e.formatter.apply(t,n,l),o.moveToBookmark(c)):(s&&r.nodeValue===oh||(f=e.getDoc(),d=sh(!0).dom,r=(s=f.importNode(d,!0)).firstChild,i.insertNode(s),a=1),e.formatter.apply(t,n,s),o.setCursorLocation(r,a))}(E,k,_):(t=u.getNode(),n=A[0],E.settings.forced_root_block||!n.defaultBlock||a.getParent(t,a.isBlock)||$h(E,n.defaultBlock),u.setRng(Rg(u.getRng())),Hf(u,!0,function(e){jf(E,function(e,t){var n=t?e:Rf(E,e,A);s(a,n)})}),Zl(a,u,u.getRng()),E.nodeChanged()),o=E,yh(hh[k],function(e){e(o)}))}else{r=u.getNode();for(var c=0,l=A.length;c<l;c++){var f=A[c];if(f.ceFalseOverride&&mf(f)&&a.is(r,f.selector))return void T(r,f)}}},Wh=function(r,e,t,n){var o=ae(t.get()),i={},a={},u=H(lf(r.dom,e),function(e){return 1===e.nodeType&&!e.getAttribute("data-mce-bogus")});se(n,function(e,n){_t.each(u,function(t){return r.formatter.matchNode(t,n,{},e.similar)?(-1===o.indexOf(n)&&(Y(e.callbacks,function(e){e(!0,{node:t,format:n,parents:u})}),i[n]=e.callbacks),a[n]=e.callbacks,!1):!Gg(r,t,n)&&void 0})});var s=Kh(t.get(),a,e,u);t.set(_e(_e({},i),s))},Kh=function(e,n,r,o){return me(e,function(e,t){return!!ve(n,t)||(Y(e,function(e){e(!1,{node:r,format:t,parents:o})}),!1)}).t},Xh=function(e,o,i,a,t){var n,r,u,s,c,l,f,d;return null===o.get()&&(r=e,u=Au({}),(n=o).set({}),r.on("NodeChange",function(e){Wh(r,e.element,u,n.get())})),c=i,l=a,f=t,d=(s=o).get(),Y(c.split(","),function(e){d[e]||(d[e]={similar:f,callbacks:[]}),d[e].callbacks.push(l)}),s.set(d),{unbind:function(){return t=i,n=a,r=(e=o).get(),Y(t.split(","),function(e){r[e].callbacks=H(r[e].callbacks,function(e){return e!==n}),0===r[e].callbacks.length&&delete r[e]}),void e.set(r);var e,t,n,r}}},Yh=function(e,t){var n=(t||document).createDocumentFragment();return Y(e,function(e){n.appendChild(e.dom)}),Rt.fromDom(n)},Gh=function(e,t,n){return{element:e,width:t,rows:n}},Jh=function(e,t){return{element:e,cells:t}},Qh=function(e,t){var n=parseInt(Jn(e,t),10);return isNaN(n)?1:n},Zh=function(e){return $(e,function(e,t){return t.cells.length>e?t.cells.length:e},0)},ev=function(e,t){for(var n=e.rows,r=0;r<n.length;r++)for(var o=n[r].cells,i=0;i<o.length;i++)if(Bt(o[i],t))return U.some({x:i,y:r});return U.none()},tv=function(e,t,n,r,o){for(var i=[],a=e.rows,u=n;u<=o;u++){var s=a[u].cells,c=t<r?s.slice(t,r+1):s.slice(r,t+1);i.push(Jh(a[u].element,c))}return i},nv=function(e){var o=Gh(ns(e),0,[]);return Y(qu(e,"tr"),function(n,r){Y(qu(n,"td,th"),function(e,t){!function(e,t,n,r,o){for(var i=Qh(o,"rowspan"),a=Qh(o,"colspan"),u=e.rows,s=n;s<n+i;s++){u[s]||(u[s]=Jh(rs(r),[]));for(var c=t;c<t+a;c++){u[s].cells[c]=s===n&&c===t?o:ns(o)}}}(o,function(e,t,n){for(;r=t,o=n,((i=e.rows)[o]?i[o].cells:[])[r];)t++;var r,o,i;return t}(o,t,r),r,n,e)})}),Gh(o.element,Zh(o.rows),o.rows)},rv=function(e){return n=z((t=e).rows,function(e){var t=z(e.cells,function(e){var t=rs(e);return Zn(t,"colspan"),Zn(t,"rowspan"),t}),n=ns(e.element);return mn(n,t),n}),r=ns(t.element),o=Rt.fromTag("tbody"),mn(o,n),dn(r,o),r;var t,n,r,o},ov=function(l,e,t){return ev(l,e).bind(function(c){return ev(l,t).map(function(e){return t=l,r=e,o=(n=c).x,i=n.y,a=r.x,u=r.y,s=i<u?tv(t,o,i,a,u):tv(t,o,u,a,i),Gh(t.element,Zh(s),s);var t,n,r,o,i,a,u,s})})},iv=function(t,n){return W(t,function(e){return"li"===It(e)&&Ff(e,n)}).fold(S([]),function(e){return W(t,function(e){return"ul"===It(e)||"ol"===It(e)}).map(function(e){var t=Rt.fromTag(It(e)),n=pe(or(e),function(e,t){return qe(t,"list-style")});return er(t,n),[Rt.fromTag("li"),t]}).getOr([])})},av=function(e,t){var n,r=Rt.fromDom(t.commonAncestorContainer),o=fp(r,e),i=H(o,function(e){return no(e)||eo(e)}),a=iv(o,t),u=i.concat(a.length?a:ao(n=r)?Wt(n).filter(io).fold(S([]),function(e){return[n,e]}):io(n)?[n]:[]);return z(u,ns)},uv=function(){return Yh([])},sv=function(e,t){return n=Rt.fromDom(t.cloneContents()),r=av(e,t),o=$(r,function(e,t){return dn(t,e),t},n),0<r.length?Yh([o]):o;var n,r,o},cv=function(e,o){return t=e,n=o[0],Br(n,"table",N(Bt,t)).bind(function(e){var t=o[0],n=o[o.length-1],r=nv(e);return ov(r,t,n).map(function(e){return Yh([rv(e)])})}).getOrThunk(uv);var t,n},lv=function(e,t){var n,r,o=Pf(t,e);return 0<o.length?cv(e,o):(n=e,0<(r=t).length&&r[0].collapsed?uv():sv(n,r[0]))},fv=function(e,t){return 0<=t&&t<e.length&&Gl(e.charAt(t))},dv=function(e,t){var n=go(e.innerText);return t?n.replace(/^[ \f\n\r\t\v]+/,""):n},mv=function(f){return U.from(f.selection.getRng()).map(function(e){var t=U.from(f.dom.getParent(e.commonAncestorContainer,f.dom.isBlock)),n=f.getBody(),r=t.map(function(e){return e.nodeName}).getOr("div").toLowerCase(),o=xt.browser.isIE()&&"pre"!==r,i=f.dom.add(n,r,{"data-mce-bogus":"all",style:"overflow: hidden; opacity: 0;"},e.cloneContents()),a=dv(i,o),u=go(i.textContent);if(f.dom.remove(i),fv(u,0)||fv(u,u.length-1)){var s=t.getOr(n),c=dv(s,o),l=c.indexOf(a);return-1===l?a:(fv(c,l-1)?" ":"")+a+(fv(c,l+a.length)?" ":"")}return a}).getOr("")},pv=function(e,t,n){if(void 0===n&&(n={}),n.get=!0,n.format=t,n.selection=!0,(n=e.fire("BeforeGetContent",n)).isDefaultPrevented())return e.fire("GetContent",n),n.content;if("text"===n.format)return mv(e);n.getInner=!0;var r,o,i,a,u,s,c,l=(o=n,i=(r=e).selection.getRng(),a=r.dom.create("body"),u=r.selection.getSel(),s=Nm(r,Of(u)),(c=o.contextual?lv(Rt.fromDom(r.getBody()),s).dom:i.cloneContents())&&a.appendChild(c),r.selection.serializer.serialize(a,o));return"tree"===n.format?l:(n.content=e.selection.isCollapsed()?"":l,e.fire("GetContent",n),n.content)},gv=function(e){return Rn(e)?e.outerHTML:Mn(e)?li.encodeRaw(e.data,!1):Fn(e)?"\x3c!--"+e.data+"--\x3e":""},hv=function(e,t,n){var r,o=function(e){var t,n=document.createElement("div"),r=document.createDocumentFragment();for(e&&(n.innerHTML=e);t=n.firstChild;)r.appendChild(t);return r}(t);e.hasChildNodes()&&n<e.childNodes.length?(r=e.childNodes[n]).parentNode.insertBefore(o,r):e.appendChild(o)},vv=function(e,o){var i=0;Y(e,function(e){var t,n,r;0===e[0]?i++:1===e[0]?(hv(o,e[1],i),i++):2===e[0]&&(n=i,(t=o).hasChildNodes()&&n<t.childNodes.length&&(r=t.childNodes[n]).parentNode.removeChild(r))})},yv=function(e,t){var p,g,n,h,v,c,y,l,r,o=z(ie(t.childNodes),gv);return vv((g=e,n=(p=o).length+g.length+2,h=new Array(n),v=new Array(n),c=function(e,t,n,r,o){var i=l(e,t,n,r);if(null===i||i.start===t&&i.diag===t-r||i.end===e&&i.diag===e-n)for(var a=e,u=n;a<t||u<r;)a<t&&u<r&&p[a]===g[u]?(o.push([0,p[a]]),++a,++u):r-n<t-e?(o.push([2,p[a]]),++a):(o.push([1,g[u]]),++u);else{c(e,i.start,n,i.start-i.diag,o);for(var s=i.start;s<i.end;++s)o.push([0,p[s]]);c(i.end,t,i.end-i.diag,r,o)}},y=function(e,t,n,r){for(var o=e;o-t<r&&o<n&&p[o]===g[o-t];)++o;return{start:e,end:o,diag:t}},l=function(e,t,n,r){var o=t-e,i=r-n;if(0==o||0==i)return null;var a,u,s,c,l,f=o-i,d=i+o,m=(d%2==0?d:1+d)/2;for(h[1+m]=e,v[1+m]=t+1,a=0;a<=m;++a){for(u=-a;u<=a;u+=2){for(s=u+m,u===-a||u!==a&&h[s-1]<h[s+1]?h[s]=h[s+1]:h[s]=h[s-1]+1,l=(c=h[s])-e+n-u;c<t&&l<r&&p[c]===g[l];)h[s]=++c,++l;if(f%2!=0&&f-a<=u&&u<=f+a&&v[s-f]<=h[s])return y(v[s-f],u+e-n,t,r)}for(u=f-a;u<=f+a;u+=2){for(s=u+m-f,u===f-a||u!==f+a&&v[s+1]<=v[s-1]?v[s]=v[s+1]-1:v[s]=v[s-1],l=(c=v[s]-1)-e+n-u;e<=c&&n<=l&&p[c]===g[l];)v[s]=c--,l--;if(f%2==0&&-a<=u&&u<=a&&v[s]<=h[s+f])return y(v[s],u+e-n,t,r)}}},r=[],c(0,p.length,0,g.length,r),r),t),t},bv=Au(U.none()),Cv=function(n){var e,t=(e=n.getBody(),H(z(ie(e.childNodes),gv),function(e){return 0<e.length})),r=J(t,function(e){var t=Mm(n.serializer,e);return 0<t.length?[t]:[]}),o=r.join("");return-1!==o.indexOf("</iframe>")?{type:"fragmented",fragments:r,content:"",bookmark:null,beforeBookmark:null}:{type:"complete",fragments:null,content:o,bookmark:null,beforeBookmark:null}},wv=function(e,t,n){"fragmented"===t.type?yv(t.fragments,e.getBody()):e.setContent(t.content,{format:"raw"}),e.selection.moveToBookmark(n?t.beforeBookmark:t.bookmark)},xv=function(e){return"fragmented"===e.type?e.fragments.join(""):e.content},Sv=function(e){var t=Rt.fromTag("body",bv.get().getOrThunk(function(){var e=document.implementation.createHTMLDocument("undo");return bv.set(U.some(e)),e}));return es(t,xv(e)),Y(qu(t,"*[data-mce-bogus]"),hn),t.dom.innerHTML},Nv=function(e,t){return!(!e||!t)&&(r=t,xv(e)===xv(r)||(n=t,Sv(e)===Sv(n)));var n,r},Ev=function(e){return 0===e.get()},kv=function(e,t,n){Ev(n)&&(e.typing=t)},_v=function(e,t){e.typing&&(kv(e,!1,t),e.add())},Av=function(f){return{undoManager:{beforeChange:function(e,t){return n=f,r=t,void(Ev(e)&&r.set(U.some(ac(n.selection))));var n,r},addUndoLevel:function(e,t,n,r,o,i){return function(e,t,n,r,o,i,a){var u=Cv(e);if(i=i||{},i=_t.extend(i,u),!1===Ev(r)||e.removed)return null;var s=t.data[n.get()];if(e.fire("BeforeAddUndo",{level:i,lastLevel:s,originalEvent:a}).isDefaultPrevented())return null;if(s&&Nv(s,i))return null;t.data[n.get()]&&o.get().each(function(e){t.data[n.get()].beforeBookmark=e});var c=e.getParam("custom_undo_redo_levels",0,"number");if(c&&t.data.length>c){for(var l=0;l<t.data.length-1;l++)t.data[l]=t.data[l+1];t.data.length--,n.set(t.data.length)}i.bookmark=ac(e.selection),n.get()<t.data.length-1&&(t.data.length=n.get()+1),t.data.push(i),n.set(t.data.length-1);var f={level:i,lastLevel:s,originalEvent:a};return 0<n.get()?(e.setDirty(!0),e.fire("AddUndo",f),e.fire("change",f)):e.fire("AddUndo",f),i}(f,e,t,n,r,o,i)},undo:function(e,t,n){return r=f,i=t,a=n,(o=e).typing&&(o.add(),o.typing=!1,kv(o,!1,i)),0<a.get()&&(a.set(a.get()-1),u=o.data[a.get()],wv(r,u,!0),r.setDirty(!0),r.fire("Undo",{level:u})),u;var r,o,i,a,u},redo:function(e,t){return n=f,o=t,(r=e).get()<o.length-1&&(r.set(r.get()+1),i=o[r.get()],wv(n,i,!1),n.setDirty(!0),n.fire("Redo",{level:i})),i;var n,r,o,i},clear:function(e,t){return n=f,o=t,(r=e).data=[],o.set(0),r.typing=!1,void n.fire("ClearUndos");var n,r,o},reset:function(e){return(t=e).clear(),void t.add();var t},hasUndo:function(e,t){return n=f,r=e,0<t.get()||r.typing&&r.data[0]&&!Nv(Cv(n),r.data[0]);var n,r},hasRedo:function(e,t){return n=e,t.get()<n.data.length-1&&!n.typing;var n},transact:function(e,t,n){return o=n,_v(r=e,t),r.beforeChange(),r.ignore(o),r.add();var r,o},ignore:function(e,t){try{e.set(e.get()+1),t()}finally{e.set(e.get()-1)}},extra:function(e,t,n,r){return o=f,a=t,u=n,s=r,void((i=e).transact(u)&&(c=i.data[a.get()].bookmark,l=i.data[a.get()-1],wv(o,l,!0),i.transact(s)&&(i.data[a.get()-1].beforeBookmark=c)));var o,i,a,u,s,c,l}},formatter:{match:function(e,t,n){return th(f,e,t,n)},matchAll:function(e,t){return o=e,i=t,a=[],u={},n=(r=f).selection.getStart(),r.dom.getParent(n,function(e){for(var t=0;t<o.length;t++){var n=o[t];!u[n]&&eh(r,e,n,i)&&(u[n]=!0,a.push(n))}},r.dom.getRoot()),a;var r,o,i,a,u,n},matchNode:function(e,t,n,r){return eh(f,e,t,n,r)},canApply:function(e){return function(e,t){var n,r,o,i,a,u=e.formatter.get(t),s=e.dom;if(u)for(n=e.selection.getStart(),r=lf(s,n),i=u.length-1;0<=i;i--){if(!(a=u[i].selector)||u[i].defaultBlock)return!0;for(o=r.length-1;0<=o;o--)if(s.is(r[o],a))return!0}return!1}(f,e)},closest:function(e){return nh(f,e)},apply:function(e,t,n){return $h(f,e,t,n)},remove:function(e,t,n,r){return zh(f,e,t,n,r)},toggle:function(e,t,n){return o=e,i=t,a=n,u=(r=f).formatter.get(o),void(!th(r,o,i,a)||"toggle"in u[0]&&!u[0].toggle?$h:zh)(r,o,i,a);var r,o,i,a,u},formatChanged:function(e,t,n,r){return Xh(f,e,t,n,r)}},editor:{getContent:function(e,t){return n=f,r=e,o=t,U.from(n.getBody()).fold(S("tree"===r.format?new Am("body",11):""),function(e){return Um(n,r,o,e)});var n,r,o},setContent:function(e,t){return $g(f,e,t)},insertContent:function(e,t){return zg(f,e,t)},addVisual:function(e){return t=e,a=(i=f).dom,n=V(t)?t:i.getBody(),T(i.hasVisual)&&(i.hasVisual=i.getParam("visual",!0,"boolean")),Y(a.select("table,a",n),function(e){switch(e.nodeName){case"TABLE":var t=i.getParam("visual_table_class","mce-item-table","string"),n=a.getAttrib(e,"border");n&&"0"!==n||!i.hasVisual?a.removeClass(e,t):a.addClass(e,t);break;case"A":var r,o;a.getAttrib(e,"href")||(r=a.getAttrib(e,"name")||e.id,o=i.getParam("visual_anchor_class","mce-item-anchor","string"),r&&i.hasVisual?a.addClass(e,o):a.removeClass(e,o))}}),void i.fire("VisualAid",{element:t,hasVisual:i.hasVisual});var i,t,a,n}},selection:{getContent:function(e,t){return pv(f,e,t)}},raw:{getModel:function(){return U.none()}}}},Rv=function(e){return ve(e.plugins,"rtc")},Tv=function(e){var c=e;return he(e.plugins,"rtc").fold(function(){return c.rtcInstance=Av(e),U.none()},function(e){return U.some(e.setup().then(function(e){var t,o,n,i,a,r,u,s;return c.rtcInstance=(o=function(e){return k(e)?e:{}},n=m("Unimplemented feature for rtc"),i=(t=e).undoManager,a=t.formatter,r=t.editor,u=t.selection,s=t.raw,{undoManager:{beforeChange:te,addUndoLevel:n,undo:function(){return i.undo()},redo:function(){return i.redo()},clear:function(){return i.clear()},reset:function(){return i.reset()},hasUndo:function(){return i.hasUndo()},hasRedo:function(){return i.hasRedo()},transact:function(e,t,n){return i.transact(n)},ignore:function(e,t){return i.ignore(t)},extra:function(e,t,n,r){return i.extra(n,r)}},formatter:{match:function(e,t,n){return a.match(e,o(t))},matchAll:n,matchNode:n,canApply:function(e){return a.canApply(e)},closest:function(e){return a.closest(e)},apply:function(e,t,n){return a.apply(e,o(t))},remove:function(e,t,n,r){return a.remove(e,o(t))},toggle:function(e,t,n){return a.toggle(e,o(t))},formatChanged:function(e,t,n,r){return a.formatChanged(t,n,r)}},editor:{getContent:function(e,t){return r.getContent(e)},setContent:function(e,t){return r.setContent(e,t)},insertContent:function(e,t){return r.insertContent(e)},addVisual:te},selection:{getContent:function(e,t){return u.getContent(t)}},raw:{getModel:function(){return U.some(s.getRawModel())}}}),e.rtc.isRemote},function(e){var t,n;return c.rtcInstance=(t=S(null),n=S(""),{undoManager:{beforeChange:te,addUndoLevel:t,undo:t,redo:t,clear:te,reset:te,hasUndo:b,hasRedo:b,transact:t,ignore:te,extra:te},formatter:{match:b,matchAll:S([]),matchNode:b,canApply:b,closest:n,apply:te,remove:te,toggle:te,formatChanged:S({unbind:te})},editor:{getContent:n,setContent:n,insertContent:te,addVisual:te},selection:{getContent:n},raw:{getModel:S(U.none())}}),Ir.reject(e)}))})},Dv=function(e){return e.rtcInstance?e.rtcInstance:Av(e)},Ov=function(e){var t=e.rtcInstance;if(t)return t;throw new Error("Failed to get RTC instance not yet initialized.")},Bv=function(e,t){void 0===t&&(t={});var n,r,o=t.format?t.format:"html";return n=o,r=t,Ov(e).selection.getContent(n,r)},Pv=function(e){return 0===e.dom.length?(gn(e),U.none()):U.some(e)},Lv=function(e,t,s,c){e.bind(function(u){return(c?Hp:jp)(u.dom,c?u.dom.length:0),t.filter(zt).map(function(e){return t=e,n=s,r=c,o=u.dom,i=t.dom,a=r?o.length:i.length,void(r?(Vp(o,i,!1,!r),n.setStart(i,a)):(Vp(i,o,!1,!r),n.setEnd(i,a)));var t,n,r,o,i,a})}).orThunk(function(){var e;return(e=c,t.filter(function(e){return Gf.isBookmarkNode(e.dom)}).bind(e?Xt:Kt).or(t).filter(zt)).map(function(e){return r=c,void Wt(n=e).each(function(e){var t=n.dom;r&&Op(e,Is(t,0))?jp(t,0):!r&&Bp(e,Is(t,t.length))&&Hp(t,t.length)});var n,r})})},Iv=function(e,t,n){void 0===n&&(n={});var r,o,i=(r=t,_e(_e({format:"html"},n),{set:!0,selection:!0,content:r}));i.no_events||!(i=e.fire("BeforeSetContent",i)).isDefaultPrevented()?(n.content=function(e,t){if("raw"===t.format)return t.content;var n=e.selection.getRng(),r=e.dom.getParent(n.commonAncestorContainer,e.dom.isBlock),o=r?{context:r.nodeName.toLowerCase()}:{},i=e.parser.parse(t.content,_e(_e({isRootContent:!0,forced_root_block:!1},o),t));return qm({validate:e.validate},e.schema).serialize(i)}(e,i),function(e,t){var n=U.from(t.firstChild).map(Rt.fromDom),r=U.from(t.lastChild).map(Rt.fromDom);e.deleteContents(),e.insertNode(t);var o=n.bind(Kt).filter(zt).bind(Pv),i=r.bind(Xt).filter(zt).bind(Pv);Lv(o,n,e,!0),Lv(i,r,e,!1),e.collapse(!1)}(o=e.selection.getRng(),o.createContextualFragment(n.content)),e.selection.setRng(o),zd(e,o),i.no_events||e.fire("SetContent",i)):e.fire("SetContent",i)},Mv=function(e,t,n){var r;e&&e.hasOwnProperty(t)&&(0===(r=H(e[t],function(e){return e!==n})).length?delete e[t]:e[t]=r)};var Fv,Uv,zv=function(e){return!!e.select},jv=function(e){return!(!e||!e.ownerDocument)&&Lt(Rt.fromDom(e.ownerDocument),Rt.fromDom(e))},Hv=function(u,s,e,c){var l,f,i,n,a,d,r=function(e,t){return a||(a={},d={},n.on("NodeChange",function(e){var n=e.element,r=i.getParents(n,null,i.getRoot()),o={};_t.each(a,function(e,n){_t.each(r,function(t){if(i.is(t,n))return d[n]||(_t.each(e,function(e){e(!0,{node:t,selector:n,parents:r})}),d[n]=e),o[n]=e,!1})}),_t.each(d,function(e,t){o[t]||(delete d[t],_t.each(e,function(e){e(!1,{node:n,selector:t,parents:r})}))})})),a[e]||(a[e]=[]),a[e].push(t),{unbind:function(){Mv(a,e,t),Mv(d,e,t)}}},t=function(e,t){return Iv(c,e,t)},o=function(e){var t=p();t.collapse(!!e),g(t)},m=function(){return s.getSelection?s.getSelection():s.document.selection},p=function(){var e,t,n,r=function(e,t,n){try{return t.compareBoundaryPoints(e,n)}catch(r){return-1}},o=s.document;if(c.bookmark!==undefined&&!1===vm(c)){var i=om(c);if(i.isSome())return i.map(function(e){return Nm(c,[e])[0]}).getOr(o.createRange())}try{(e=m())&&!An(e.anchorNode)&&(t=0<e.rangeCount?e.getRangeAt(0):e.createRange?e.createRange():o.createRange(),t=Nm(c,[t])[0])}catch(a){}return(t=t||(o.createRange?o.createRange():o.body.createTextRange())).setStart&&9===t.startContainer.nodeType&&t.collapsed&&(n=u.getRoot(),t.setStart(n,0),t.setEnd(n,0)),l&&f&&(0===r(t.START_TO_START,t,l)&&0===r(t.END_TO_END,t,l)?t=f:f=l=null),t},g=function(e,t){var n;if((r=e)&&(zv(r)||jv(r.startContainer)&&jv(r.endContainer))){var r,o=zv(e)?e:null;if(o){f=null;try{o.select()}catch(a){}}else{var i=m();if(e=c.fire("SetSelectionRange",{range:e,forward:t}).range,i){f=e;try{i.removeAllRanges(),i.addRange(e)}catch(a){}!1===t&&i.extend&&(i.collapse(e.endContainer,e.endOffset),i.extend(e.startContainer,e.startOffset)),l=0<i.rangeCount?i.getRangeAt(0):null}e.collapsed||e.startContainer!==e.endContainer||!i.setBaseAndExtent||xt.ie||e.endOffset-e.startOffset<2&&e.startContainer.hasChildNodes()&&(n=e.startContainer.childNodes[e.startOffset])&&"IMG"===n.tagName&&(i.setBaseAndExtent(e.startContainer,e.startOffset,e.endContainer,e.endOffset),i.anchorNode===e.startContainer&&i.focusNode===e.endContainer||i.setBaseAndExtent(n,0,n,1)),c.fire("AfterSetSelectionRange",{range:e,forward:t})}}},h=function(){var e=m(),t=null==e?void 0:e.anchorNode,n=null==e?void 0:e.focusNode;if(!e||!t||!n||An(t)||An(n))return!0;var r=u.createRng();r.setStart(t,e.anchorOffset),r.collapse(!0);var o=u.createRng();return o.setStart(n,e.focusOffset),o.collapse(!0),r.compareBoundaryPoints(r.START_TO_START,o)<=0},v={bookmarkManager:null,controlSelection:null,dom:i=u,win:s,serializer:e,editor:n=c,collapse:o,setCursorLocation:function(e,t){var n=u.createRng();V(e)&&V(t)?(n.setStart(e,t),n.setEnd(e,t),g(n),o(!1)):(Uf(u,n,c.getBody(),!0),g(n))},getContent:function(e){return Bv(c,e)},setContent:t,getBookmark:function(e,t){return y.getBookmark(e,t)},moveToBookmark:function(e){return y.moveToBookmark(e)},select:function(e,t){var r,n,o;return r=u,n=e,o=t,U.from(n).map(function(e){var t=r.nodeIndex(e),n=r.createRng();return n.setStart(e.parentNode,t),n.setEnd(e.parentNode,t+1),o&&(Uf(r,n,e,!0),Uf(r,n,e,!1)),n}).each(g),e},isCollapsed:function(){var e=p(),t=m();return!(!e||e.item)&&(e.compareEndPoints?0===e.compareEndPoints("StartToEnd",e):!t||e.collapsed)},isForward:h,setNode:function(e){return t(u.getOuterHTML(e)),e},getNode:function(){return function(e,t){var n,r;if(!t)return e;n=t.startContainer,r=t.endContainer;var o=t.startOffset,i=t.endOffset,a=t.commonAncestorContainer;return!t.collapsed&&(n===r&&i-o<2&&n.hasChildNodes()&&(a=n.childNodes[o]),3===n.nodeType&&3===r.nodeType&&(n=n.length===o?Sm(n.nextSibling,!0):n.parentNode,r=0===i?Sm(r.previousSibling,!1):r.parentNode,n&&n===r))?n:a&&3===a.nodeType?a.parentNode:a}(c.getBody(),p())},getSel:m,setRng:g,getRng:p,getStart:function(e){return wm(c.getBody(),p(),e)},getEnd:function(e){return xm(c.getBody(),p(),e)},getSelectedBlocks:function(e,t){return function(e,t,n,r){var o,i=[],a=e.getRoot();if(n=e.getParent(n||wm(a,t,t.collapsed),e.isBlock),r=e.getParent(r||xm(a,t,t.collapsed),e.isBlock),n&&n!==a&&i.push(n),n&&r&&n!==r)for(var u=new Yr(o=n,a);(o=u.next())&&o!==r;)e.isBlock(o)&&i.push(o);return r&&n!==r&&r!==a&&i.push(r),i}(u,p(),e,t)},normalize:function(){var e=p(),t=m();if(1<Of(t).length||!zf(c))return e;var n=fd(u,e);return n.each(function(e){g(e,h())}),n.getOr(e)},selectorChanged:function(e,t){return r(e,t),v},selectorChangedWithUnbind:r,getScrollContainer:function(){for(var e,t=u.getRoot();t&&"BODY"!==t.nodeName;){if(t.scrollHeight>t.clientHeight){e=t;break}t=t.parentNode}return e},scrollIntoView:function(e,t){return r=e,o=t,void((n=c).inline?Md:Ud)(n,r,o);var n,r,o},placeCaretAt:function(e,t){return g(od(e,t,c.getDoc()))},getBoundingClientRect:function(){var e=p();return e.collapsed?Is.fromRangeStart(e).getClientRects()[0]:e.getBoundingClientRect()},destroy:function(){s=l=f=null,b.destroy()}},y=Gf(v),b=nd(v,c);return v.bookmarkManager=y,v.controlSelection=b,v},Vv=function(e,a,u){e.addNodeFilter("font",function(e){Y(e,function(e){var t,n=a.parse(e.attr("style")),r=e.attr("color"),o=e.attr("face"),i=e.attr("size");r&&(n.color=r),o&&(n["font-family"]=o),i&&(n["font-size"]=u[parseInt(e.attr("size"),10)-1]),e.name="span",e.attr("style",a.serialize(n)),t=e,Y(["color","face","size"],function(e){t.attr(e,null)})})})},qv=function(e,t){var n,r=xi();t.convert_fonts_to_spans&&Vv(e,r,_t.explode(t.font_size_legacy_values)),n=r,e.addNodeFilter("strike",function(e){Y(e,function(e){var t=n.parse(e.attr("style"));t["text-decoration"]="line-through",e.name="span",e.attr("style",n.serialize(t))})})},$v=function(e){var t,n=decodeURIComponent(e).split(","),r=/data:([^;]+)/.exec(n[0]);return r&&(t=r[1]),{type:t,data:n[1]}},Wv=function(e,t){var n;try{n=atob(t)}catch(_k){return U.none()}for(var r=new Uint8Array(n.length),o=0;o<r.length;o++)r[o]=n.charCodeAt(o);return U.some(new Blob([r],{type:e}))},Kv=function(e){return 0===e.indexOf("blob:")?(i=e,new Ir(function(e,t){var n=function(){t("Cannot convert "+i+" to Blob. Resource might not exist or is inaccessible.")};try{var r=new XMLHttpRequest;r.open("GET",i,!0),r.responseType="blob",r.onload=function(){200===r.status?e(r.response):n()},r.onerror=n,r.send()}catch(o){n()}})):0===e.indexOf("data:")?(o=e,new Ir(function(e){var t=$v(o),n=t.type,r=t.data;Wv(n,r).fold(function(){return e(new Blob([]))},e)})):null;var i,o},Xv=0,Yv=function(e){return(e||"blobid")+Xv++},Gv=function(r,o,i,t){var e,n,a,u,s;0!==o.src.indexOf("blob:")?(n=(e=$v(o.src)).data,a=e.type,u=n,(s=r.getByData(u,a))?i({image:o,blobInfo:s}):Kv(o.src).then(function(e){s=r.create(Yv(),e,u),r.add(s),i({image:o,blobInfo:s})},function(e){t(e)})):(s=r.getByUri(o.src))?i({image:o,blobInfo:s}):Kv(o.src).then(function(t){var n;n=t,new Ir(function(e){var t=new FileReader;t.onloadend=function(){e(t.result)},t.readAsDataURL(n)}).then(function(e){u=$v(e).data,s=r.create(Yv(),t,u),r.add(s),i({image:o,blobInfo:s})})},function(e){t(e)})},Jv=function(i,a){var u={};return{findAll:function(e,n){n=n||w;var t,r=H((t=e)?ie(t.getElementsByTagName("img")):[],function(e){var t=e.src;return xt.fileApi&&!e.hasAttribute("data-mce-bogus")&&!e.hasAttribute("data-mce-placeholder")&&t&&t!==xt.transparentSrc&&(0===t.indexOf("blob:")?!i.isUploaded(t)&&n(e):0===t.indexOf("data:")&&n(e))}),o=z(r,function(n){if(u[n.src]!==undefined)return new Ir(function(t){u[n.src].then(function(e){return"string"==typeof e?e:void t({image:n,blobInfo:e.blobInfo})})});var e=new Ir(function(e,t){Gv(a,n,e,t)}).then(function(e){return delete u[e.image.src],e})["catch"](function(e){return delete u[n.src],e});return u[n.src]=e});return Ir.all(o)}}},Qv=function(e,t,n,r){(e.padd_empty_with_br||t.insert)&&n[r.name]?r.empty().append(new Am("br",1)).shortEnded=!0:r.empty().append(new Am("#text",3)).value=fo},Zv=function(e,t){return e&&e.firstChild&&e.firstChild===e.lastChild&&e.firstChild.name===t},ey=function(r,e,t,n){return n.isEmpty(e,t,function(e){return t=e,(n=r.getElementRule(t.name))&&n.paddEmpty;var t,n})},ty=function(e,o){var i=o.blob_cache,t=function(t){var e,n,r=t.attr("src");(e=t).attr("src")===xt.transparentSrc||e.attr("data-mce-placeholder")||t.attr("data-mce-bogus")||((n=/data:([^;]+);base64,([a-z0-9\+\/=]+)/i.exec(r))?U.some({type:n[1],data:decodeURIComponent(n[2])}):U.none()).filter(function(){return function(e,t){if(t.images_dataimg_filter){var n=new Image;return n.src=e.attr("src"),se(e.attributes.map,function(e,t){n.setAttribute(t,e)}),t.images_dataimg_filter(n)}return!0}(t,o)}).bind(function(e){var t=e.type,n=e.data;return U.from(i.getByData(n,t)).orThunk(function(){return Wv(t,n).map(function(e){var t=i.create(Yv(),e,n);return i.add(t),t})})}).each(function(e){t.attr("src",e.blobUri())})};i&&e.addAttributeFilter("src",function(e){return Y(e,t)})},ny=function(e,g){var h=e.schema;g.remove_trailing_brs&&e.addNodeFilter("br",function(e,t,n){var r,o,i,a,u,s,c,l,f=e.length,d=_t.extend({},h.getBlockElements()),m=h.getNonEmptyElements(),p=h.getWhiteSpaceElements();for(d.body=1,r=0;r<f;r++)if(i=(o=e[r]).parent,d[o.parent.name]&&o===i.lastChild){for(u=o.prev;u;){if("span"!==(s=u.name)||"bookmark"!==u.attr("data-mce-type")){"br"===s&&(o=null);break}u=u.prev}o&&(o.remove(),ey(h,m,p,i)&&(c=h.getElementRule(i.name))&&(c.removeEmpty?i.remove():c.paddEmpty&&Qv(g,n,d,i)))}else{for(a=o;i&&i.firstChild===a&&i.lastChild===a&&!d[(a=i).name];)i=i.parent;a===i&&!0!==g.padd_empty_with_br&&((l=new Am("#text",3)).value=fo,o.replace(l))}}),e.addAttributeFilter("href",function(e){var t,n,r=e.length;if(!g.allow_unsafe_link_target)for(;r--;){var o=e[r];"a"===o.name&&"_blank"===o.attr("target")&&o.attr("rel",(t=o.attr("rel"),n=t?_t.trim(t):"",/\b(noopener)\b/g.test(n)?n:n.split(" ").filter(function(e){return 0<e.length}).concat(["noopener"]).sort().join(" ")))}}),g.allow_html_in_named_anchor||e.addAttributeFilter("id,name",function(e){for(var t,n,r,o,i=e.length;i--;)if("a"===(o=e[i]).name&&o.firstChild&&!o.attr("href"))for(r=o.parent,t=o.lastChild;n=t.prev,r.insert(t,o),t=n;);}),g.fix_list_elements&&e.addNodeFilter("ul,ol",function(e){for(var t,n,r,o=e.length;o--;){"ul"!==(r=(n=e[o]).parent).name&&"ol"!==r.name||(n.prev&&"li"===n.prev.name?n.prev.append(n):((t=new Am("li",1)).attr("style","list-style-type: none"),n.wrap(t)))}}),g.validate&&h.getValidClasses()&&e.addAttributeFilter("class",function(e){for(var t,n,r,o,i,a,u,s=e.length,c=h.getValidClasses();s--;){for(n=(t=e[s]).attr("class").split(" "),i="",r=0;r<n.length;r++)o=n[r],u=!1,(a=c["*"])&&a[o]&&(u=!0),a=c[t.name],!u&&a&&a[o]&&(u=!0),u&&(i&&(i+=" "),i+=o);i.length||(i=null),t.attr("class",i)}}),ty(e,g)},ry=_t.makeMap,oy=_t.each,iy=_t.explode,ay=_t.extend,uy=function(A,R){void 0===R&&(R=Ci());var T={},D=[],O={},B={};(A=A||{}).validate=!("validate"in A)||A.validate,A.root_name=A.root_name||"body";var e,t,P=function(e){var t,n,r=e.name;r in T&&((n=O[r])?n.push(e):O[r]=[e]),t=D.length;for(;t--;)(r=D[t].name)in e.attributes.map&&((n=B[r])?n.push(e):B[r]=[e]);return e},n={schema:R,addAttributeFilter:function(e,n){oy(iy(e),function(e){for(var t=0;t<D.length;t++)if(D[t].name===e)return void D[t].callbacks.push(n);D.push({name:e,callbacks:[n]})})},getAttributeFilters:function(){return[].concat(D)},addNodeFilter:function(e,n){oy(iy(e),function(e){var t=T[e];t||(T[e]=t=[]),t.push(n)})},getNodeFilters:function(){var e=[];for(var t in T)T.hasOwnProperty(t)&&e.push({name:t,callbacks:T[t]});return e},filterNode:P,parse:function(e,u){var t,n,r,o,i,s,a,c,l=[];u=u||{},O={},B={};var f,d=ay(ry("script,style,head,html,body,title,meta,param"),R.getBlockElements()),m=R.getNonEmptyElements(),p=R.children,g=A.validate,h="forced_root_block"in u?u.forced_root_block:A.forced_root_block,v=!1===(f=h)?"":!0===f?"p":f,y=R.getWhiteSpaceElements(),b=/^[ \t\r\n]+/,C=/[ \t\r\n]+$/,w=/[ \t\r\n]+/g,x=/^[ \t\r\n]+$/,S=y.hasOwnProperty(u.context)||y.hasOwnProperty(A.root_name),N=function(e,t){var n,r=new Am(e,t);return e in T&&((n=O[e])?n.push(r):O[e]=[r]),r},E=function(e){for(var t,n,r,o=R.getBlockElements(),i=e.prev;i&&3===i.type;){if(0<(n=i.value.replace(C,"")).length)return void(i.value=n);if(t=i.next){if(3===t.type&&t.value.length){i=i.prev;continue}if(!o[t.name]&&"script"!==t.name&&"style"!==t.name){i=i.prev;continue}}r=i.prev,i.remove(),i=r}},k=Pm({validate:g,allow_html_data_urls:A.allow_html_data_urls,allow_svg_data_urls:A.allow_svg_data_urls,allow_script_urls:A.allow_script_urls,allow_conditional_comments:A.allow_conditional_comments,preserve_cdata:A.preserve_cdata,self_closing_elements:function(e){var t,n={};for(t in e)"li"!==t&&"p"!==t&&(n[t]=e[t]);return n}(R.getSelfClosingElements()),cdata:function(e){c.append(N("#cdata",4)).value=e},text:function(e,t){var n,r,o;S||(e=e.replace(w," "),r=c.lastChild,o=d,r&&(o[r.name]||"br"===r.name)&&(e=e.replace(b,""))),0!==e.length&&((n=N("#text",3)).raw=!!t,c.append(n).value=e)},comment:function(e){c.append(N("#comment",8)).value=e},pi:function(e,t){c.append(N(e,7)).value=t,E(c)},doctype:function(e){c.append(N("#doctype",10)).value=e,E(c)},start:function(e,t,n){var r,o,i,a,u=g?R.getElementRule(e):{};if(u){for((r=N(u.outputName||e,1)).attributes=t,r.shortEnded=n,c.append(r),(a=p[c.name])&&p[r.name]&&!a[r.name]&&l.push(r),o=D.length;o--;)(i=D[o].name)in t.map&&((s=B[i])?s.push(r):B[i]=[r]);d[e]&&E(r),n||(c=r),!S&&y[e]&&(S=!0)}},end:function(e){var t,n,r,o,i,a=g?R.getElementRule(e):{};if(a){if(d[e]&&!S){if((t=c.firstChild)&&3===t.type)if(0<(n=t.value.replace(b,"")).length)t.value=n,t=t.next;else for(r=t.next,t.remove(),t=r;t&&3===t.type;)n=t.value,r=t.next,0!==n.length&&!x.test(n)||(t.remove(),t=r),t=r;if((t=c.lastChild)&&3===t.type)if(0<(n=t.value.replace(C,"")).length)t.value=n,t=t.prev;else for(r=t.prev,t.remove(),t=r;t&&3===t.type;)n=t.value,r=t.prev,0!==n.length&&!x.test(n)||(t.remove(),t=r),t=r}if(S&&y[e]&&(S=!1),a.removeEmpty&&ey(R,m,y,c))return o=c.parent,d[c.name]?c.empty().remove():c.unwrap(),void(c=o);a.paddEmpty&&(Zv(i=c,"#text")&&i.firstChild.value===fo||ey(R,m,y,c))&&Qv(A,u,d,c),c=c.parent}}},R),_=c=new Am(u.context||A.root_name,11);if(k.parse(e,u.format),g&&l.length&&(u.context?u.invalid=!0:function(e){for(var t,n,r,o,i,a,u,s,c,l,f=ry("tr,td,th,tbody,thead,tfoot,table"),d=R.getNonEmptyElements(),m=R.getWhiteSpaceElements(),p=R.getTextBlockElements(),g=R.getSpecialElements(),h=0;h<e.length;h++)if((t=e[h]).parent&&!t.fixed)if(p[t.name]&&"li"===t.parent.name){for(c=t.next;c&&p[c.name];)c.name="li",c.fixed=!0,t.parent.insert(c,t.parent),c=c.next;t.unwrap(t)}else{for(r=[t],n=t.parent;n&&!R.isValidChild(n.name,t.name)&&!f[n.name];n=n.parent)r.push(n);if(n&&1<r.length){for(r.reverse(),o=i=P(r[0].clone()),s=0;s<r.length-1;s++){for(R.isValidChild(i.name,r[s].name)?(a=P(r[s].clone()),i.append(a)):a=i,u=r[s].firstChild;u&&u!==r[s+1];)l=u.next,a.append(u),u=l;i=a}ey(R,d,m,o)?n.insert(t,r[0],!0):(n.insert(o,r[0],!0),n.insert(t,o)),n=r[0],(ey(R,d,m,n)||Zv(n,"br"))&&n.empty().remove()}else if(t.parent){if("li"===t.name){if((c=t.prev)&&("ul"===c.name||"ol"===c.name)){c.append(t);continue}if((c=t.next)&&("ul"===c.name||"ol"===c.name)){c.insert(t,c.firstChild,!0);continue}t.wrap(P(new Am("ul",1)));continue}R.isValidChild(t.parent.name,"div")&&R.isValidChild("div",t.name)?t.wrap(P(new Am("div",1))):g[t.name]?t.empty().remove():t.unwrap()}}}(l)),v&&("body"===_.name||u.isRootContent)&&function(){var e,t,n=_.firstChild,r=function(e){e&&((n=e.firstChild)&&3===n.type&&(n.value=n.value.replace(b,"")),(n=e.lastChild)&&3===n.type&&(n.value=n.value.replace(C,"")))};if(R.isValidChild(_.name,v.toLowerCase())){for(;n;)e=n.next,3===n.type||1===n.type&&"p"!==n.name&&!d[n.name]&&!n.attr("data-mce-type")?(t||((t=N(v,1)).attr(A.forced_root_block_attrs),_.insert(t,n)),t.append(n)):(r(t),t=null),n=e;r(t)}}(),!u.invalid){for(a in O)if(O.hasOwnProperty(a)){for(s=T[a],o=(t=O[a]).length;o--;)t[o].parent||t.splice(o,1);for(n=0,r=s.length;n<r;n++)s[n](t,a,u)}for(n=0,r=D.length;n<r;n++)if((s=D[n]).name in B){for(o=(t=B[s.name]).length;o--;)t[o].parent||t.splice(o,1);for(o=0,i=s.callbacks.length;o<i;o++)s.callbacks[o](t,s.name,u)}}return _}};return ny(n,A),e=n,(t=A).inline_styles&&qv(e,t),n},sy=function(e,t,n){return o=n,(r=e)&&r.hasEventListeners("PreProcess")&&!o.no_events?function(e,t,n){var r,o,i=e.dom;t=t.cloneNode(!0);var a,u,s=document.implementation;return s.createHTMLDocument&&(r=s.createHTMLDocument(""),_t.each("BODY"===t.nodeName?t.childNodes:[t],function(e){r.body.appendChild(r.importNode(e,!0))}),t="BODY"!==t.nodeName?r.body.firstChild:r.body,o=i.doc,i.doc=r),a=e,u=_e(_e({},n),{node:t}),a.fire("PreProcess",u),o&&(i.doc=o),t}(e,t,n):t;var r,o},cy=function(e,t,n){-1===_t.inArray(t,n)&&(e.addAttributeFilter(n,function(e,t){for(var n=e.length;n--;)e[n].attr(t,null)}),t.push(n))},ly=function(e,t,n,r,o){var i,a,u,s,c,l,f=(i=r,qm(t,n).serialize(i));return a=e,s=f,(u=o).no_events||!a?s:(c=a,l=_e(_e({},u),{content:s}),c.fire("PostProcess",l).content)},fy=function(y,b){var e=["data-mce-selected"],C=b&&b.dom?b.dom:xu.DOM,w=b&&b.schema?b.schema:Ci(y);y.entity_encoding=y.entity_encoding||"named",y.remove_trailing_brs=!("remove_trailing_brs"in y)||y.remove_trailing_brs;var t,s,c,x=uy(y,w);s=y,c=C,(t=x).addAttributeFilter("data-mce-tabindex",function(e,t){for(var n,r=e.length;r--;)(n=e[r]).attr("tabindex",n.attr("data-mce-tabindex")),n.attr(t,null)}),t.addAttributeFilter("src,href,style",function(e,t){for(var n,r,o=e.length,i="data-mce-"+t,a=s.url_converter,u=s.url_converter_scope;o--;)(r=(n=e[o]).attr(i))!==undefined?(n.attr(t,0<r.length?r:null),n.attr(i,null)):(r=n.attr(t),"style"===t?r=c.serializeStyle(c.parseStyle(r),n.name):a&&(r=a.call(u,r,t,n.name)),n.attr(t,0<r.length?r:null))}),t.addAttributeFilter("class",function(e){for(var t,n,r=e.length;r--;)(n=(t=e[r]).attr("class"))&&(n=t.attr("class").replace(/(?:^|\s)mce-item-\w+(?!\S)/g,""),t.attr("class",0<n.length?n:null))}),t.addAttributeFilter("data-mce-type",function(e,t,n){for(var r,o=e.length;o--;){"bookmark"!==(r=e[o]).attr("data-mce-type")||n.cleanup||(U.from(r.firstChild).exists(function(e){return!po(e.value)})?r.unwrap():r.remove())}}),t.addNodeFilter("noscript",function(e){for(var t,n=e.length;n--;)(t=e[n].firstChild)&&(t.value=li.decode(t.value))}),t.addNodeFilter("script,style",function(e,t){for(var n,r,o,i=e.length,a=function(e){return e.replace(/(<!--\[CDATA\[|\]\]-->)/g,"\n").replace(/^[\r\n]*|[\r\n]*$/g,"").replace(/^\s*((<!--)?(\s*\/\/)?\s*<!\[CDATA\[|(<!--\s*)?\/\*\s*<!\[CDATA\[\s*\*\/|(\/\/)?\s*<!--|\/\*\s*<!--\s*\*\/)\s*[\r\n]*/gi,"").replace(/\s*(\/\*\s*\]\]>\s*\*\/(-->)?|\s*\/\/\s*\]\]>(-->)?|\/\/\s*(-->)?|\]\]>|\/\*\s*-->\s*\*\/|\s*-->\s*)\s*$/g,"")};i--;)r=(n=e[i]).firstChild?n.firstChild.value:"","script"===t?((o=n.attr("type"))&&n.attr("type","mce-no/type"===o?null:o.replace(/^mce\-/,"")),"xhtml"===s.element_format&&0<r.length&&(n.firstChild.value="// <![CDATA[\n"+a(r)+"\n// ]]>")):"xhtml"===s.element_format&&0<r.length&&(n.firstChild.value="\x3c!--\n"+a(r)+"\n--\x3e")}),t.addNodeFilter("#comment",function(e){for(var t,n=e.length;n--;)t=e[n],s.preserve_cdata&&0===t.value.indexOf("[CDATA[")?(t.name="#cdata",t.type=4,t.value=c.decode(t.value.replace(/^\[CDATA\[|\]\]$/g,""))):0===t.value.indexOf("mce:protected ")&&(t.name="#text",t.type=3,t.raw=!0,t.value=unescape(t.value).substr(14))}),t.addNodeFilter("xml:namespace,input",function(e,t){for(var n,r=e.length;r--;)7===(n=e[r]).type?n.remove():1===n.type&&("input"!==t||n.attr("type")||n.attr("type","text"))}),t.addAttributeFilter("data-mce-type",function(e){Y(e,function(e){"format-caret"===e.attr("data-mce-type")&&(e.isEmpty(t.schema.getNonEmptyElements())?e.remove():e.unwrap())})}),t.addAttributeFilter("data-mce-src,data-mce-href,data-mce-style,data-mce-selected,data-mce-expando,data-mce-type,data-mce-resize,data-mce-placeholder",function(e,t){for(var n=e.length;n--;)e[n].attr(t,null)});return{schema:w,addNodeFilter:x.addNodeFilter,addAttributeFilter:x.addAttributeFilter,serialize:function(e,t){void 0===t&&(t={});var n,r,o,i,a,u,s,c,l,f,d,m,p=_e({format:"html"},t),g=sy(b,e,p),h=(n=C,r=g,i=go((o=p).getInner?r.innerHTML:n.getOuterHTML(r)),o.selection||co(Rt.fromDom(r))?i:_t.trim(i)),v=(a=x,u=h,d=(s=p).selection?_e({forced_root_block:!1},s):s,m=a.parse(u,d),l=function(e){return e&&"br"===e.name},f=m.lastChild,!l(f)||l(c=f.prev)&&(f.remove(),c.remove()),m);return"tree"===p.format?v:ly(b,y,w,v,p)},addRules:function(e){w.addValidElements(e)},setRules:function(e){w.setValidElements(e)},addTempAttr:N(cy,x,e),getTempAttrs:S(e),getNodeFilters:x.getNodeFilters,getAttributeFilters:x.getAttributeFilters}},dy=function(e,t){var n=fy(e,t);return{schema:n.schema,addNodeFilter:n.addNodeFilter,addAttributeFilter:n.addAttributeFilter,serialize:n.serialize,addRules:n.addRules,setRules:n.setRules,addTempAttr:n.addTempAttr,getTempAttrs:n.getTempAttrs,getNodeFilters:n.getNodeFilters,getAttributeFilters:n.getAttributeFilters}},my=function(e,t){void 0===t&&(t={});var n,r,o=t.format?t.format:"html";return n=t,r=o,Dv(e).editor.getContent(n,r)},py=function(e,t,n){return void 0===n&&(n={}),r=t,o=n,Dv(e).editor.setContent(r,o);var r,o},gy=xu.DOM,hy=function(e){return U.from(e).each(function(e){return e.destroy()})},vy=function(e){var t,n,r,o,i;e.removed||(t=e._selectionOverrides,n=e.editorUpload,r=e.getBody(),o=e.getElement(),r&&e.save({is_removing:!0}),e.removed=!0,e.unbindAllNativeEvents(),e.hasHiddenInput&&o&&gy.remove(o.nextSibling),e.fire("remove"),e.editorManager.remove(e),!e.inline&&r&&(i=e,gy.setStyle(i.id,"display",i.orgDisplay)),e.fire("detach"),gy.remove(e.getContainer()),hy(t),hy(n),e.destroy())},yy=function(e,t){var n,r,o,i=e.selection,a=e.dom;e.destroyed||(t||e.removed?(t||(e.editorManager.off("beforeunload",e._beforeUnload),e.theme&&e.theme.destroy&&e.theme.destroy(),hy(i),hy(a)),(r=(n=e).formElement)&&(r._mceOldSubmit&&(r.submit=r._mceOldSubmit,r._mceOldSubmit=null),gy.unbind(r,"submit reset",n.formEventDelegate)),(o=e).contentAreaContainer=o.formElement=o.container=o.editorContainer=null,o.bodyElement=o.contentDocument=o.contentWindow=null,o.iframeElement=o.targetElm=null,o.selection&&(o.selection=o.selection.win=o.selection.dom=o.selection.dom.doc=null),e.destroyed=!0):e.remove())},by=Object.prototype.hasOwnProperty,Cy=(Fv=function(e,t){return k(e)&&k(t)?Cy(e,t):t},function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];if(0===e.length)throw new Error("Can't merge zero objects");for(var n={},r=0;r<e.length;r++){var o=e[r];for(var i in o)by.call(o,i)&&(n[i]=Fv(n[i],o[i]))}return n}),wy=mt().deviceType,xy=wy.isTouch(),Sy=wy.isPhone(),Ny=wy.isTablet(),Ey=["lists","autolink","autosave"],ky={table_grid:!1,object_resizing:!1,resize:!1},_y=function(e){var t=_(e)?e.join(" "):e,n=z(K(t)?t.split(" "):[],We);return H(n,function(e){return 0<e.length})},Ay=function(n,e){var t,r,o=me(e,function(e,t){return M(n,t)});return t=o.t,r=o.f,{sections:S(t),settings:S(r)}},Ry=function(e,t){return e.sections().hasOwnProperty(t)},Ty=function(e,t){return he(e,"toolbar_mode").orThunk(function(){return he(e,"toolbar_drawer").map(function(e){return!1===e?"wrap":e})}).getOr(t)},Dy=function(e,t,n,r){return e&&(a=i="mobile",u=(o=t).sections(),Ry(o,i)&&u[i].theme===a)?H(r,N(M,Ey)):e&&Ry(t,"mobile")?r:n;var o,i,a,u},Oy=function(e,t,n,r){var o,i,a,u=_y(n.forced_plugins),s=_y(r.plugins),c=Ry(o=t,i="mobile")?o.sections()[i]:{},l=c.plugins?_y(c.plugins):s,f=Dy(e,t,s,l),d=(a=f,[].concat(_y(u)).concat(_y(a)));if(xt.browser.isIE()&&M(d,"rtc"))throw new Error("RTC plugin is not supported on IE 11.");return _t.extend(r,{plugins:d.join(" ")})},By=function(e,t,n,r,o){var i,a,u,s,c,l,f,d=e?{mobile:(i=o.mobile||{},a=t,u={resize:!1,toolbar_mode:Ty(i,"scrolling"),toolbar_sticky:!1},_e(_e(_e({},ky),u),a?{menubar:!1}:{}))}:{},m=Ay(["mobile"],Cy(d,o)),p=_t.extend(n,r,m.settings(),(f=m,e&&Ry(f,"mobile")?function(e,t,n){void 0===n&&(n={});var r=e.sections(),o=r.hasOwnProperty(t)?r[t]:{};return _t.extend({},n,o)}(m,"mobile"):{}),{validate:!0,external_plugins:(s=r,c=m.settings(),l=c.external_plugins?c.external_plugins:{},s&&s.external_plugins?_t.extend({},s.external_plugins,l):l)});return Oy(e,m,r,p)},Py=function(e,t,n,r,o){var i,a,u,s,c=(i=n,a=xy,u=e,s={id:t,theme:"silver",toolbar_mode:Ty(o,"floating"),plugins:"",document_base_url:i,add_form_submit_trigger:!0,submit_patch:!0,add_unload_trigger:!0,convert_urls:!0,relative_urls:!0,remove_script_host:!0,object_resizing:!0,doctype:"<!DOCTYPE html>",visual:!0,font_size_legacy_values:"xx-small,small,medium,large,x-large,xx-large,300%",forced_root_block:"p",hidden_input:!0,inline_styles:!0,convert_fonts_to_spans:!0,indent:!0,indent_before:"p,h1,h2,h3,h4,h5,h6,blockquote,div,title,style,pre,script,td,th,ul,ol,li,dl,dt,dd,area,table,thead,tfoot,tbody,tr,section,summary,article,hgroup,aside,figure,figcaption,option,optgroup,datalist",indent_after:"p,h1,h2,h3,h4,h5,h6,blockquote,div,title,style,pre,script,td,th,ul,ol,li,dl,dt,dd,area,table,thead,tfoot,tbody,tr,section,summary,article,hgroup,aside,figure,figcaption,option,optgroup,datalist",entity_encoding:"named",url_converter:u.convertURL,url_converter_scope:u},_e(_e({},s),a?ky:{}));return By(Sy||Ny,Sy,c,r,o)},Ly=function(e,t,n){return U.from(t.settings[n]).filter(e)},Iy=function(e,t,n,r){var o,i,a,u=t in e.settings?e.settings[t]:n;return"hash"===r?(a={},"string"==typeof(i=u)?Y(0<i.indexOf("=")?i.split(/[;,](?![^=;,]*(?:[;,]|$))/):i.split(","),function(e){var t=e.split("=");1<t.length?a[_t.trim(t[0])]=_t.trim(t[1]):a[_t.trim(t[0])]=_t.trim(t[0])}):a=i,a):"string"===r?Ly(K,e,t).getOr(n):"number"===r?Ly(O,e,t).getOr(n):"boolean"===r?Ly(R,e,t).getOr(n):"object"===r?Ly(k,e,t).getOr(n):"array"===r?Ly(_,e,t).getOr(n):"string[]"===r?Ly((o=K,function(e){return _(e)&&Q(e,o)}),e,t).getOr(n):"function"===r?Ly(D,e,t).getOr(n):u},My=(Uv={},{add:function(e,t){Uv[e]=t},get:function(e){return Uv[e]?Uv[e]:{icons:{}}},has:function(e){return ve(Uv,e)}}),Fy=function(e,t){return t.dom[e]},Uy=function(e,t){return parseInt(tr(t,e),10)},zy=N(Fy,"clientWidth"),jy=N(Fy,"clientHeight"),Hy=N(Uy,"margin-top"),Vy=N(Uy,"margin-left"),qy=function(e,t,n){var r,o,i,a,u,s,c,l,f,d,m,p=Rt.fromDom(e.getBody()),g=e.inline?p:(r=p,Rt.fromDom(qt(r).dom.documentElement)),h=(o=e.inline,a=t,u=n,s=(i=g).dom.getBoundingClientRect(),{x:a-(o?s.left+i.dom.clientLeft+Vy(i):0),y:u-(o?s.top+i.dom.clientTop+Hy(i):0)});return l=h.x,f=h.y,d=zy(c=g),m=jy(c),0<=l&&0<=f&&l<=d&&f<=m},$y=function(e){var t,n=e.inline?e.getBody():e.getContentAreaContainer();return t=n,U.from(t).map(Rt.fromDom).map(vn).getOr(!1)},Wy=function(n){var t,o=[],i=function(){var e,t=n.theme;return t&&t.getNotificationManagerImpl?t.getNotificationManagerImpl():{open:e=function(){throw new Error("Theme did not provide a NotificationManager implementation.")},close:e,reposition:e,getArgs:e}},a=function(){return U.from(o[0])},u=function(){0<o.length&&i().reposition(o)},s=function(t){G(o,function(e){return e===t}).each(function(e){o.splice(e,1)})},r=function(r,e){if(void 0===e&&(e=!0),!n.removed&&$y(n))return e&&n.fire("BeforeOpenNotification",{notification:r}),W(o,function(e){return t=i().getArgs(e),n=r,!(t.type!==n.type||t.text!==n.text||t.progressBar||t.timeout||n.progressBar||n.timeout);var t,n}).getOrThunk(function(){n.editorManager.setActive(n);var e,t=i().open(r,function(){s(t),u(),a().fold(function(){return n.focus()},function(e){return Rt.fromDom(e.getEl()).dom.focus()})});return e=t,o.push(e),u(),n.fire("OpenNotification",_e({},t)),t})};return(t=n).on("SkinLoaded",function(){var e=t.getParam("service_message");e&&r({text:e,type:"warning",timeout:0},!1)}),t.on("ResizeEditor ResizeWindow NodeChange",function(){Wr.requestAnimationFrame(u)}),t.on("remove",function(){Y(o.slice(),function(e){i().close(e)})}),{open:r,close:function(){a().each(function(e){i().close(e),s(e),u()})},getNotifications:function(){return o}}},Ky=Bu.PluginManager,Xy=Bu.ThemeManager;var Yy,Gy,Jy=function(n){var r=[],o=function(){var e,t=n.theme;return t&&t.getWindowManagerImpl?t.getWindowManagerImpl():{open:e=function(){throw new Error("Theme did not provide a WindowManager implementation.")},openUrl:e,alert:e,confirm:e,close:e,getParams:e,setParams:e}},i=function(n,r){return function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];return r?r.apply(n,e):undefined}},a=function(e){var t;r.push(e),t=e,n.fire("OpenWindow",{dialog:t})},u=function(t){var e;e=t,n.fire("CloseWindow",{dialog:e}),0===(r=H(r,function(e){return e!==t})).length&&n.focus()},s=function(e){n.editorManager.setActive(n),rm(n);var t=e();return a(t),t};return n.on("remove",function(){Y(r,function(e){o().close(e)})}),{open:function(e,t){return s(function(){return o().open(e,t,u)})},openUrl:function(e){return s(function(){return o().openUrl(e,u)})},alert:function(e,t,n){var r=o();r.alert(e,i(n||r,t))},confirm:function(e,t,n){var r=o();r.confirm(e,i(n||r,t))},close:function(){U.from(r[r.length-1]).each(function(e){o().close(e),u(e)})}}},Qy=function(e,t){e.notificationManager.open({type:"error",text:t})},Zy=function(e,t){e._skinLoaded?Qy(e,t):e.on("SkinLoaded",function(){Qy(e,t)})},eb=function(e,t,n){Zf(e,t,{message:n}),console.error(n)},tb=function(e,t,n){return n?"Failed to load "+e+": "+n+" from url "+t:"Failed to load "+e+" url: "+t},nb=function(e,t,n){eb(e,"PluginLoadError",tb("plugin",t,n))},rb=function(e){for(var t=[],n=1;n<arguments.length;n++)t[n-1]=arguments[n];var r=window.console;r&&(r.error?r.error.apply(r,Ae([e],t)):r.log.apply(r,Ae([e],t)))},ob=function(e){return ib(e,(n=(t=e).getParam("content_css"),K(n)?z(n.split(","),We):_(n)?n:!1===n||t.inline?[]:["default"]));var t,n},ib=function(t,e){var n=t.editorManager.baseURL+"/skins/content",r="content"+t.editorManager.suffix+".css",o=!0===t.inline;return z(e,function(e){return/^[a-z0-9\-]+$/i.test(e)&&!o?n+"/"+e+"/"+r:t.documentBaseURI.toAbsolute(e)})},ab=function(e){var t;e.contentCSS=e.contentCSS.concat(ob(e),ib(t=e,vc(t)))},ub=function(){var n={},r=function(e,t){return{status:e,resultUri:t}},t=function(e){return e in n};return{hasBlobUri:t,getResultUri:function(e){var t=n[e];return t?t.resultUri:null},isPending:function(e){return!!t(e)&&1===n[e].status},isUploaded:function(e){return!!t(e)&&2===n[e].status},markPending:function(e){n[e]=r(1,null)},markUploaded:function(e,t){n[e]=r(2,t)},removeFailed:function(e){delete n[e]},destroy:function(){n={}}}},sb=0,cb=function(e){return e+sb+++(t=function(){return Math.round(4294967295*Math.random()).toString(36)},"s"+(new Date).getTime().toString(36)+t()+t()+t());var t},lb=function(u,s){var o={},n=function(e,r,o,t){var i=new XMLHttpRequest;i.open("POST",s.url),i.withCredentials=s.credentials,i.upload.onprogress=function(e){t(e.loaded/e.total*100)},i.onerror=function(){o("Image upload failed due to a XHR Transport error. Code: "+i.status)},i.onload=function(){var e,t,n;i.status<200||300<=i.status?o("HTTP Error: "+i.status):(e=JSON.parse(i.responseText))&&"string"==typeof e.location?r((t=s.basePath,n=e.location,t?t.replace(/\/$/,"")+"/"+n.replace(/^\//,""):n)):o("Invalid JSON: "+i.responseText)};var n=new FormData;n.append("file",e.blob(),e.filename()),i.send(n)},c=function(e,t){return{url:t,blobInfo:e,status:!0}},l=function(e,t,n){return{url:"",blobInfo:e,status:!1,error:{message:t,options:n}}},f=function(e,t){_t.each(o[e],function(e){e(t)}),delete o[e]},r=function(e,r){return e=_t.grep(e,function(e){return!u.isUploaded(e.blobUri())}),Ir.all(_t.map(e,function(e){return u.isPending(e.blobUri())?(n=e.blobUri(),new Ir(function(e){o[n]=o[n]||[],o[n].push(e)})):(i=e,t=s.handler,a=r,u.markPending(i.blobUri()),new Ir(function(r){var n;try{var o=function(){n&&n.close()};t(i,function(e){o(),u.markUploaded(i.blobUri(),e),f(i.blobUri(),c(i,e)),r(c(i,e))},function(e,t){var n=t||{};o(),u.removeFailed(i.blobUri()),f(i.blobUri(),l(i,e,n)),r(l(i,e,n))},function(t){t<0||100<t||U.from(n).orThunk(function(){return U.from(a).map(p)}).each(function(e){(n=e).progressBar.value(t)})})}catch(e){r(l(i,e.message,{}))}}));var i,t,a,n}))};return!1===D(s.handler)&&(s.handler=n),{upload:function(e,t){return s.url||s.handler!==n?r(e,t):new Ir(function(e){e([])})}}},fb=function(e){return function(){return e.notificationManager.open({text:e.translate("Image uploading..."),type:"info",timeout:-1,progressBar:!0})}},db=function(e,t){return lb(t,{url:e.getParam("images_upload_url","","string"),basePath:e.getParam("images_upload_base_path","","string"),credentials:e.getParam("images_upload_credentials",!1,"boolean"),handler:e.getParam("images_upload_handler",null,"function")})},mb=function(s){var n,i,e,t,r,o,c=(n=[],i=function(e){if(!e.blob||!e.base64)throw new Error("blob and base64 representations of the image are required for BlobInfo to be created");var t=e.id||cb("blobid"),n=e.name||t,r=e.blob;return{id:S(t),name:S(n),filename:S(e.filename||n+"."+({"image/jpeg":"jpg","image/jpg":"jpg","image/gif":"gif","image/png":"png","image/apng":"apng","image/avif":"avif","image/svg+xml":"svg","image/webp":"webp","image/bmp":"bmp","image/tiff":"tiff"}[r.type.toLowerCase()]||"dat")),blob:S(r),base64:S(e.base64),blobUri:S(e.blobUri||URL.createObjectURL(r)),uri:S(e.uri)}},{create:function(e,t,n,r,o){if(K(e))return i({id:e,name:r,filename:o,blob:t,base64:n});if(k(e))return i(e);throw new Error("Unknown input type")},add:function(e){t(e.id())||n.push(e)},get:t=function(t){return e(function(e){return e.id()===t})},getByUri:function(t){return e(function(e){return e.blobUri()===t})},getByData:function(t,n){return e(function(e){return e.base64()===t&&e.blob().type===n})},findFirst:e=function(e){return W(n,e).getOrUndefined()},removeByUri:function(t){n=H(n,function(e){return e.blobUri()!==t||void URL.revokeObjectURL(e.blobUri())})},destroy:function(){Y(n,function(e){URL.revokeObjectURL(e.blobUri())}),n=[]}}),a=ub(),u=[],l=function(n){var r=Au(null);n.on("change AddUndo",function(e){r.set(_e({},e.level))});return{fireIfChanged:function(){var t=n.undoManager.data;oe(t).filter(function(e){return!Nv(r.get(),e)}).each(function(e){n.setDirty(!0),n.fire("change",{level:e,lastLevel:ne(t,t.length-2).getOrNull()})})}}}(s),f=function(t){return function(e){return s.selection?t(e):[]}},d=function(e,t,n){for(var r=0;-1!==(r=e.indexOf(t,r))&&(e=e.substring(0,r)+n+e.substr(r+t.length),r+=n.length-t.length+1),-1!==r;);return e},m=function(e,t,n){var r='src="'+n+'"'+(n===xt.transparentSrc?' data-mce-placeholder="1"':"");return e=d(e,'src="'+t+'"',r),e=d(e,'data-mce-src="'+t+'"','data-mce-src="'+n+'"')},p=function(t,n){Y(s.undoManager.data,function(e){"fragmented"===e.type?e.fragments=z(e.fragments,function(e){return m(e,t,n)}):e.content=m(e.content,t,n)})},g=function(e,t){var n,r=s.convertURL(t,"src");p(e.src,t),s.$(e).attr({src:s.getParam("images_reuse_filename",!1,"boolean")?(n=t)+(-1===n.indexOf("?")?"?":"&")+(new Date).getTime():t,"data-mce-src":r})},h=function(n){return r=r||db(s,a),b().then(f(function(u){var e=z(u,function(e){return e.blobInfo});return r.upload(e,fb(s)).then(f(function(e){var a=[],t=z(e,function(e,t){var n,r,o=u[t].blobInfo,i=u[t].image;return e.status&&s.getParam("images_replace_blob_uris",!0,"boolean")?(c.removeByUri(i.src),g(i,e.url)):e.error&&(e.error.options.remove&&(p(i.getAttribute("src"),xt.transparentSrc),a.push(i)),n=s,r=e.error.message,Zy(n,Ou.translate(["Failed to upload image: {0}",r]))),{element:i,status:e.status,uploadUri:e.url,blobInfo:o}});return 0<t.length&&l.fireIfChanged(),0<a.length&&(Rv(s)?console.error("Removing images on failed uploads is currently unsupported for RTC"):s.undoManager.transact(function(){Y(a,function(e){s.dom.remove(e),c.removeByUri(e.src)})})),n&&n(t),t}))}))},v=function(e){if(dc(s))return h(e)},y=function(t){return!1!==Q(u,function(e){return e(t)})&&(0!==t.getAttribute("src").indexOf("data:")||s.getParam("images_dataimg_filter",w,"function")(t))},b=function(){return(o=o||Jv(a,c)).findAll(s.getBody(),y).then(f(function(e){return e=H(e,function(e){return"string"!=typeof e||void Zy(s,e)}),Y(e,function(e){p(e.image.src,e.blobInfo.blobUri()),e.image.src=e.blobInfo.blobUri(),e.image.removeAttribute("data-mce-src")}),e}))},C=function(e){return e.replace(/src="(blob:[^"]+)"/g,function(e,n){var t=a.getResultUri(n);if(t)return'src="'+t+'"';var r=c.getByUri(n);return(r=r||$(s.editorManager.get(),function(e,t){return e||t.editorUpload&&t.editorUpload.blobCache.getByUri(n)},null))?'src="data:'+r.blob().type+";base64,"+r.base64()+'"':e})};return s.on("SetContent",function(){(dc(s)?v:b)()}),s.on("RawSaveContent",function(e){e.content=C(e.content)}),s.on("GetContent",function(e){e.source_view||"raw"===e.format||"tree"===e.format||(e.content=C(e.content))}),s.on("PostRender",function(){s.parser.addNodeFilter("img",function(e){Y(e,function(e){var t,n=e.attr("src");c.getByUri(n)||(t=a.getResultUri(n))&&e.attr("src",t)})})}),{blobCache:c,addFilter:function(e){u.push(e)},uploadImages:h,uploadImagesAuto:v,scanForImages:b,destroy:function(){c.destroy(),a.destroy(),o=r=null}}},pb=function(e){var r,t,n={},o=function(e,t){e&&("string"!=typeof e?_t.each(e,function(e,t){o(t,e)}):(_(t)||(t=[t]),_t.each(t,function(e){"undefined"==typeof e.deep&&(e.deep=!e.selector),"undefined"==typeof e.split&&(e.split=!e.selector||e.inline),"undefined"==typeof e.remove&&e.selector&&!e.inline&&(e.remove="none"),e.selector&&e.inline&&(e.mixed=!0,e.block_expand=!0),"string"==typeof e.classes&&(e.classes=e.classes.split(/\s+/))}),n[e]=t))};return o((r=e.dom,t={valigntop:[{selector:"td,th",styles:{verticalAlign:"top"}}],valignmiddle:[{selector:"td,th",styles:{verticalAlign:"middle"}}],valignbottom:[{selector:"td,th",styles:{verticalAlign:"bottom"}}],alignleft:[{selector:"figure.image",collapsed:!1,classes:"align-left",ceFalseOverride:!0,preview:"font-family font-size"},{selector:"figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",styles:{textAlign:"left"},inherit:!1,preview:!1,defaultBlock:"div"},{selector:"img,table",collapsed:!1,styles:{"float":"left"},preview:"font-family font-size"}],aligncenter:[{selector:"figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",styles:{textAlign:"center"},inherit:!1,preview:"font-family font-size",defaultBlock:"div"},{selector:"figure.image",collapsed:!1,classes:"align-center",ceFalseOverride:!0,preview:"font-family font-size"},{selector:"img",collapsed:!1,styles:{display:"block",marginLeft:"auto",marginRight:"auto"},preview:!1},{selector:"table",collapsed:!1,styles:{marginLeft:"auto",marginRight:"auto"},preview:"font-family font-size"}],alignright:[{selector:"figure.image",collapsed:!1,classes:"align-right",ceFalseOverride:!0,preview:"font-family font-size"},{selector:"figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",styles:{textAlign:"right"},inherit:!1,preview:"font-family font-size",defaultBlock:"div"},{selector:"img,table",collapsed:!1,styles:{"float":"right"},preview:"font-family font-size"}],alignjustify:[{selector:"figure,p,h1,h2,h3,h4,h5,h6,td,th,tr,div,ul,ol,li",styles:{textAlign:"justify"},inherit:!1,defaultBlock:"div",preview:"font-family font-size"}],bold:[{inline:"strong",remove:"all",preserve_attributes:["class","style"]},{inline:"span",styles:{fontWeight:"bold"}},{inline:"b",remove:"all",preserve_attributes:["class","style"]}],italic:[{inline:"em",remove:"all",preserve_attributes:["class","style"]},{inline:"span",styles:{fontStyle:"italic"}},{inline:"i",remove:"all",preserve_attributes:["class","style"]}],underline:[{inline:"span",styles:{textDecoration:"underline"},exact:!0},{inline:"u",remove:"all",preserve_attributes:["class","style"]}],strikethrough:[{inline:"span",styles:{textDecoration:"line-through"},exact:!0},{inline:"strike",remove:"all",preserve_attributes:["class","style"]},{inline:"s",remove:"all",preserve_attributes:["class","style"]}],forecolor:{inline:"span",styles:{color:"%value"},links:!0,remove_similar:!0,clear_child_styles:!0},hilitecolor:{inline:"span",styles:{backgroundColor:"%value"},links:!0,remove_similar:!0,clear_child_styles:!0},fontname:{inline:"span",toggle:!1,styles:{fontFamily:"%value"},clear_child_styles:!0},fontsize:{inline:"span",toggle:!1,styles:{fontSize:"%value"},clear_child_styles:!0},lineheight:{selector:"h1,h2,h3,h4,h5,h6,p,li,td,th,div",defaultBlock:"p",styles:{lineHeight:"%value"}},fontsize_class:{inline:"span",attributes:{"class":"%value"}},blockquote:{block:"blockquote",wrapper:!0,remove:"all"},subscript:{inline:"sub"},superscript:{inline:"sup"},code:{inline:"code"},link:{inline:"a",selector:"a",remove:"all",split:!0,deep:!0,onmatch:function(e,t,n){return Rn(e)&&e.hasAttribute("href")},onformat:function(n,e,t){_t.each(t,function(e,t){r.setAttrib(n,t,e)})}},removeformat:[{selector:"b,strong,em,i,font,u,strike,s,sub,sup,dfn,code,samp,kbd,var,cite,mark,q,del,ins",remove:"all",split:!0,expand:!1,block_expand:!0,deep:!0},{selector:"span",attributes:["style","class"],remove:"empty",split:!0,expand:!1,deep:!0},{selector:"*",attributes:["style","class"],split:!1,expand:!1,deep:!0}]},_t.each("p h1 h2 h3 h4 h5 h6 div address pre div dt dd samp".split(/\s/),function(e){t[e]={block:e,remove:"all"}}),t)),o(e.getParam("formats")),{get:function(e){return e?n[e]:n},has:function(e){return ve(n,e)},register:o,unregister:function(e){return e&&n[e]&&delete n[e],n}}},gb=_t.each,hb=xu.DOM,vb=function(e,t){var n,o,r,m=t&&t.schema||Ci({}),p=function(e){o="string"==typeof e?{name:e,classes:[],attrs:{}}:e;var t,n,r=hb.create(o.name);return t=r,(n=o).classes.length&&hb.addClass(t,n.classes.join(" ")),hb.setAttribs(t,n.attrs),r},g=function(n,e,t){var r,o,i,a,u,s,c,l=0<e.length&&e[0],f=l&&l.name,d=(a=f,u="string"!=typeof(i=n)?i.nodeName.toLowerCase():i,s=m.getElementRule(u),!(!(c=s&&s.parentsRequired)||!c.length)&&(a&&-1!==_t.inArray(c,a)?a:c[0]));if(d)f===d?(o=e[0],e=e.slice(1)):o=d;else if(l)o=e[0],e=e.slice(1);else if(!t)return n;return o&&(r=p(o)).appendChild(n),t&&(r||(r=hb.create("div")).appendChild(n),_t.each(t,function(e){var t=p(e);r.insertBefore(t,n)})),g(r,e,o&&o.siblings)};return e&&e.length?(o=e[0],n=p(o),(r=hb.create("div")).appendChild(g(n,e.slice(1),o.siblings)),r):""},yb=function(e){var t,a={classes:[],attrs:{}};return"*"!==(e=a.selector=_t.trim(e))&&(t=e.replace(/(?:([#\.]|::?)([\w\-]+)|(\[)([^\]]+)\]?)/g,function(e,t,n,r,o){switch(t){case"#":a.attrs.id=n;break;case".":a.classes.push(n);break;case":":-1!==_t.inArray("checked disabled enabled read-only required".split(" "),n)&&(a.attrs[n]=n)}var i;return"["!==r||(i=o.match(/([\w\-]+)(?:\=\"([^\"]+))?/))&&(a.attrs[i[1]]=i[2]),""})),a.name=t||"div",a},bb=function(n,e){var t,r,o,i="",a=(o=n.getParam("preview_styles","font-family font-size font-weight font-style text-decoration text-transform color background-color border border-radius outline text-shadow"),K(o)?o:"");if(""===a)return"";var u=function(e){return e.replace(/%(\w+)/g,"")};if("string"==typeof e){if(!(e=n.formatter.get(e)))return;e=e[0]}if("preview"in e){var s=he(e,"preview");if(s.is(!1))return"";a=s.getOr(a)}t=e.block||e.inline||"span";var c,l=(c=e.selector)&&"string"==typeof c?(c=(c=c.split(/\s*,\s*/)[0]).replace(/\s*(~\+|~|\+|>)\s*/g,"$1"),_t.map(c.split(/(?:>|\s+(?![^\[\]]+\]))/),function(e){var t=_t.map(e.split(/(?:~\+|~|\+)/),yb),n=t.pop();return t.length&&(n.siblings=t),n}).reverse()):[],f=l.length?(l[0].name||(l[0].name=t),t=e.selector,vb(l,n)):vb([t],n),d=hb.select(t,f)[0]||f.firstChild;return gb(e.styles,function(e,t){var n=u(e);n&&hb.setStyle(d,t,n)}),gb(e.attributes,function(e,t){var n=u(e);n&&hb.setAttrib(d,t,n)}),gb(e.classes,function(e){var t=u(e);hb.hasClass(d,t)||hb.addClass(d,t)}),n.fire("PreviewFormats"),hb.setStyles(f,{position:"absolute",left:-65535}),n.getBody().appendChild(f),r=hb.getStyle(n.getBody(),"fontSize",!0),r=/px$/.test(r)?parseInt(r,10):0,gb(a.split(" "),function(e){var t=hb.getStyle(d,e,!0);if(!("background-color"===e&&/transparent|rgba\s*\([^)]+,\s*0\)/.test(t)&&(t=hb.getStyle(n.getBody(),e,!0),"#ffffff"===hb.toHex(t).toLowerCase())||"color"===e&&"#000000"===hb.toHex(t).toLowerCase())){if("font-size"===e&&/em|%$/.test(t)){if(0===r)return;t=parseFloat(t)/(/%$/.test(t)?100:1)*r+"px"}"border"===e&&t&&(i+="padding:0 2px;"),i+=e+":"+t+";"}}),n.fire("AfterPreviewFormats"),hb.remove(f),i},Cb=function(s){var e=pb(s),u=Au(null);return function(e){e.addShortcut("meta+b","","Bold"),e.addShortcut("meta+i","","Italic"),e.addShortcut("meta+u","","Underline");for(var t=1;t<=6;t++)e.addShortcut("access+"+t,"",["FormatBlock",!1,"h"+t]);e.addShortcut("access+7","",["FormatBlock",!1,"p"]),e.addShortcut("access+8","",["FormatBlock",!1,"div"]),e.addShortcut("access+9","",["FormatBlock",!1,"address"])}(s),ph(s),{get:e.get,has:e.has,register:e.register,unregister:e.unregister,apply:function(e,t,n){var r,o,i;r=e,o=t,i=n,Ov(s).formatter.apply(r,o,i)},remove:function(e,t,n,r){var o,i,a,u;o=e,i=t,a=n,u=r,Ov(s).formatter.remove(o,i,a,u)},toggle:function(e,t,n){var r,o,i;r=e,o=t,i=n,Ov(s).formatter.toggle(r,o,i)},match:function(e,t,n){return r=e,o=t,i=n,Ov(s).formatter.match(r,o,i);var r,o,i},closest:function(e){return t=e,Ov(s).formatter.closest(t);var t},matchAll:function(e,t){return n=e,r=t,Ov(s).formatter.matchAll(n,r);var n,r},matchNode:function(e,t,n,r){return o=e,i=t,a=n,u=r,Ov(s).formatter.matchNode(o,i,a,u);var o,i,a,u},canApply:function(e){return t=e,Ov(s).formatter.canApply(t);var t},formatChanged:function(e,t,n){return r=u,o=e,i=t,void 0===(a=n)&&(a=!1),Ov(s).formatter.formatChanged(r,o,i,a);var r,o,i,a},getCssText:N(bb,s)}},wb=function(n,r,o){var i=Au(!1),a=function(e){kv(r,!1,o),r.add({},e)};n.on("init",function(){r.add()}),n.on("BeforeExecCommand",function(e){var t=e.command.toLowerCase();"undo"!==t&&"redo"!==t&&"mcerepaint"!==t&&(_v(r,o),r.beforeChange())}),n.on("ExecCommand",function(e){var t=e.command.toLowerCase();"undo"!==t&&"redo"!==t&&"mcerepaint"!==t&&a(e)}),n.on("ObjectResizeStart cut",function(){r.beforeChange()}),n.on("SaveContent ObjectResized blur",a),n.on("dragend",a),n.on("keyup",function(e){var t=e.keyCode;e.isDefaultPrevented()||((33<=t&&t<=36||37<=t&&t<=40||45===t||e.ctrlKey)&&(a(),n.nodeChanged()),46!==t&&8!==t||n.nodeChanged(),i.get()&&r.typing&&!1===Nv(Cv(n),r.data[0])&&(!1===n.isDirty()&&(n.setDirty(!0),n.fire("change",{level:r.data[0],lastLevel:null})),n.fire("TypingUndo"),i.set(!1),n.nodeChanged()))}),n.on("keydown",function(e){var t,n=e.keyCode;e.isDefaultPrevented()||(33<=n&&n<=36||37<=n&&n<=40||45===n?r.typing&&a(e):(t=e.ctrlKey&&!e.altKey||e.metaKey,!(n<16||20<n)||224===n||91===n||r.typing||t||(r.beforeChange(),kv(r,!0,o),r.add({},e),i.set(!0))))}),n.on("mousedown",function(e){r.typing&&a(e)});n.on("input",function(e){var t,n;e.inputType&&("insertReplacementText"===e.inputType||"insertText"===(n=e).inputType&&null===n.data||("insertFromPaste"===(t=e).inputType||"insertFromDrop"===t.inputType))&&a(e)}),n.on("AddUndo Undo Redo ClearUndos",function(e){e.isDefaultPrevented()||n.nodeChanged()})},xb=function(s){var e,c=Au(U.none()),l=Au(0),f=Au(0),d={data:[],typing:!1,beforeChange:function(){var e,t;e=l,t=c,Ov(s).undoManager.beforeChange(e,t)},add:function(e,t){return n=d,r=f,o=l,i=c,a=e,u=t,Ov(s).undoManager.addUndoLevel(n,r,o,i,a,u);var n,r,o,i,a,u},undo:function(){return e=d,t=l,n=f,Ov(s).undoManager.undo(e,t,n);var e,t,n},redo:function(){return e=s,t=f,n=d.data,Ov(e).undoManager.redo(t,n);var e,t,n},clear:function(){var e,t;e=d,t=f,Ov(s).undoManager.clear(e,t)},reset:function(){var e;e=d,Ov(s).undoManager.reset(e)},hasUndo:function(){return e=d,t=f,Ov(s).undoManager.hasUndo(e,t);var e,t},hasRedo:function(){return e=d,t=f,Ov(s).undoManager.hasRedo(e,t);var e,t},transact:function(e){return t=d,n=l,r=e,Ov(s).undoManager.transact(t,n,r);var t,n,r},ignore:function(e){var t,n;t=l,n=e,Ov(s).undoManager.ignore(t,n)},extra:function(e,t){var n,r,o,i;n=d,r=f,o=e,i=t,Ov(s).undoManager.extra(n,r,o,i)}};return Rv(s)||wb(s,d,l),(e=s).addShortcut("meta+z","","Undo"),e.addShortcut("meta+y,meta+shift+z","","Redo"),d},Sb=[9,27,ed.HOME,ed.END,19,20,44,144,145,33,34,45,16,17,18,91,92,93,ed.DOWN,ed.UP,ed.LEFT,ed.RIGHT].concat(xt.browser.isFirefox()?[224]:[]),Nb="data-mce-placeholder",Eb=function(e){return"keydown"===e.type||"keyup"===e.type},kb=function(e){var t=e.keyCode;return t===ed.BACKSPACE||t===ed.DELETE},_b=function(a){var e,u=a.dom,s=lc(a),c=(e=a).getParam("placeholder",uc.getAttrib(e.getElement(),"placeholder"),"string"),l=function(e,t){var n,r,o,i;!function(e){if(Eb(e)){var t=e.keyCode;return!kb(e)&&(ed.metaKeyPressed(e)||e.altKey||112<=t&&t<=123||M(Sb,t))}return!1}(e)&&(n=a.getBody(),r=!(Eb(o=e)&&!(kb(o)||"keyup"===o.type&&229===o.keyCode))&&function(e,t,n){if(Wo(Rt.fromDom(t),!1)){var r=""===n,o=t.firstElementChild;return!o||!e.getStyle(t.firstElementChild,"padding-left")&&!e.getStyle(t.firstElementChild,"padding-right")&&(r?!e.isBlock(o):n===o.nodeName.toLowerCase())}return!1}(u,n,s),""!==u.getAttrib(n,Nb)===r&&!t||(u.setAttrib(n,Nb,r?c:null),u.setAttrib(n,"aria-placeholder",r?c:null),i=r,a.fire("PlaceholderToggle",{state:i}),a.on(r?"keydown":"keyup",l),a.off(r?"keyup":"keydown",l)))};c&&a.on("init",function(e){l(e,!0),a.on("change SetContent ExecCommand",l),a.on("paste",function(e){return Wr.setEditorTimeout(a,function(){return l(e)})})})},Ab=/[\u0591-\u07FF\uFB1D-\uFDFF\uFE70-\uFEFC]/,Rb=function(e,t){return Dt(Rt.fromDom(t),e.getParam("inline_boundaries_selector","a[href],code,.mce-annotation","string"))},Tb=function(e){return"rtl"===xu.DOM.getStyle(e,"direction",!0)||(t=e.textContent,Ab.test(t));var t},Db=function(e,t,n){var r,o,i,a=(r=e,o=t,i=n,H(xu.DOM.getParents(i.container(),"*",o),r));return U.from(a[a.length-1])},Ob=function(e,t){if(!t)return t;var n=t.container(),r=t.offset();return e?bo(n)?Mn(n.nextSibling)?Is(n.nextSibling,0):Is.after(n):xo(t)?Is(n,r+1):t:bo(n)?Mn(n.previousSibling)?Is(n.previousSibling,n.previousSibling.data.length):Is.before(n):So(t)?Is(n,r-1):t},Bb=N(Ob,!0),Pb=N(Ob,!1),Lb=function(e,t){return Lt(e,t)?Dr(t,function(e){return oo(e)||ao(e)},(n=e,function(e){return Bt(n,Rt.fromDom(e.dom.parentNode))})):U.none();var n},Ib=function(e){var t,n,r;e.dom.isEmpty(e.getBody())&&(e.setContent(""),n=(t=e).getBody(),r=n.firstChild&&t.dom.isBlock(n.firstChild)?n.firstChild:n,t.selection.setCursorLocation(r,0))},Mb=function(e,t){return{from:e,to:t}},Fb=function(e,t){var n=Rt.fromDom(e),r=Rt.fromDom(t.container());return Lb(n,r).map(function(e){return{block:e,position:t}})},Ub=function(o,i,e){var t=Fb(o,Is.fromRangeStart(e)),n=t.bind(function(e){return Rl(i,o,e.position).bind(function(e){return Fb(o,e).map(function(e){return t=o,n=i,jn((r=e).position.getNode())&&!1===Wo(r.block)?Ol(!1,r.block.dom).bind(function(e){return e.isEqual(r.position)?Rl(n,t,e).bind(function(e){return Fb(t,e)}):U.some(r)}).getOr(r):r;var t,n,r})})});return as(t,n,Mb).filter(function(e){return!1===Bt((r=e).from.block,r.to.block)&&Wt((n=e).from.block).bind(function(t){return Wt(n.to.block).filter(function(e){return Bt(t,e)})}).isSome()&&(!1===qn((t=e).from.block.dom)&&!1===qn(t.to.block.dom));var t,n,r})},zb=function(e){var t,n=(t=Jt(e),G(t,to).fold(function(){return t},function(e){return t.slice(0,e)}));return Y(n,gn),n},jb=function(e,t){var n=fp(t,e);return W(n.reverse(),function(e){return Wo(e)}).each(gn)},Hb=function(e,t,n,r){if(Wo(n))return up(n),Ll(n.dom);0===H(Yt(r),function(e){return!Wo(e)}).length&&Wo(t)&&cn(r,Rt.fromTag("br"));var o=Pl(n.dom,Is.before(r.dom));return Y(zb(t),function(e){cn(r,e)}),jb(e,t),o},Vb=function(e,t,n){if(Wo(n))return gn(n),Wo(t)&&up(t),Ll(t.dom);var r=Il(n.dom);return Y(zb(t),function(e){dn(n,e)}),jb(e,t),r},qb=function(e,t){return Lt(t,e)?(n=fp(e,t),U.from(n[n.length-1])):U.none();var n},$b=function(e,t){Ol(e,t.dom).map(function(e){return e.getNode()}).map(Rt.fromDom).filter(ro).each(gn)},Wb=function(e,t,n){return $b(!0,t),$b(!1,n),qb(t,n).fold(N(Vb,e,t,n),N(Hb,e,t,n))},Kb=function(e,t,n,r){return t?Wb(e,r,n):Wb(e,n,r)},Xb=function(t,n){var e,r,o,i=Rt.fromDom(t.getBody()),a=(e=i.dom,r=n,((o=t.selection.getRng()).collapsed?Ub(e,r,o):U.none()).bind(function(e){return Kb(i,n,e.from.block,e.to.block)}));return a.each(function(e){t.selection.setRng(e.toRange())}),a.isSome()},Yb=function(e,t){var n=Rt.fromDom(t),r=N(Bt,e);return Tr(n,so,r).isSome()},Gb=function(e,t){var n,r,o=Pl(e.dom,Is.fromRangeStart(t)).isNone(),i=Bl(e.dom,Is.fromRangeEnd(t)).isNone();return!(Yb(n=e,(r=t).startContainer)||Yb(n,r.endContainer))&&o&&i},Jb=function(e){var n,r,o,t,i=Rt.fromDom(e.getBody()),a=e.selection.getRng();return Gb(i,a)?((t=e).setContent(""),t.selection.setCursorLocation(),!0):(n=i,r=e.selection,o=r.getRng(),as(Lb(n,Rt.fromDom(o.startContainer)),Lb(n,Rt.fromDom(o.endContainer)),function(e,t){return!1===Bt(e,t)&&(o.deleteContents(),Kb(n,!0,e,t).each(function(e){r.setRng(e.toRange())}),!0)}).getOr(!1))},Qb=function(e,t){return!e.selection.isCollapsed()&&Jb(e)},Zb=Vn,eC=qn,tC=function(e,t,n,r,o){return U.from(t._selectionOverrides.showCaret(e,n,r,o))},nC=function(e,t){var n,r;return e.fire("BeforeObjectSelected",{target:t}).isDefaultPrevented()?U.none():U.some(((r=(n=t).ownerDocument.createRange()).selectNode(n),r))},rC=function(e,t,n){var r=ol(1,e.getBody(),t),o=Is.fromRangeStart(r),i=o.getNode();if(zc(i))return tC(1,e,i,!o.isAtEnd(),!1);var a=o.getNode(!0);if(zc(a))return tC(1,e,a,!1,!1);var u=e.dom.getParent(o.getNode(),function(e){return eC(e)||Zb(e)});return zc(u)?tC(1,e,u,!1,n):U.none()},oC=function(e,t,n){return t.collapsed?rC(e,t,n).getOr(t):t},iC=function(e){return op(e)||ep(e)},aC=function(e){return ip(e)||tp(e)},uC=function(n,r,e,t,o,i){var a,u;return tC(t,n,i.getNode(!o),o,!0).each(function(e){var t;r.collapsed?(t=r.cloneRange(),o?t.setEnd(e.startContainer,e.startOffset):t.setStart(e.endContainer,e.endOffset),t.deleteContents()):r.deleteContents(),n.selection.setRng(e)}),a=n.dom,Mn(u=e)&&0===u.data.length&&a.remove(u),!0},sC=function(e,t){var n=e.selection.getRng();if(!Mn(n.commonAncestorContainer))return!1;var r=t?Ms.Forwards:Ms.Backwards,o=Nl(e.getBody()),i=N(sl,t?o.next:o.prev),a=t?iC:aC,u=al(r,e.getBody(),n),s=Ob(t,i(u));if(!s||!cl(u,s))return!1;if(a(s))return uC(e,n,u.getNode(),r,t,s);var c=i(s);return!!(c&&a(c)&&cl(s,c))&&uC(e,n,u.getNode(),r,t,c)},cC=wr([{remove:["element"]},{moveToElement:["element"]},{moveToPosition:["position"]}]),lC=function(e,t,n,r){var o=r.getNode(!1===t);return Lb(Rt.fromDom(e),Rt.fromDom(n.getNode())).map(function(e){return Wo(e)?cC.remove(e.dom):cC.moveToElement(o)}).orThunk(function(){return U.some(cC.moveToElement(o))})},fC=function(u,s,c){return Rl(s,u,c).bind(function(e){return a=e.getNode(),so(Rt.fromDom(a))||ao(Rt.fromDom(a))?U.none():(t=u,o=e,i=function(e){return no(Rt.fromDom(e))&&!Qc(r,o,t)},il(!(n=s),r=c).fold(function(){return il(n,o).fold(b,i)},i)?U.none():s&&qn(e.getNode())||!1===s&&qn(e.getNode(!0))?lC(u,s,c,e):s&&ip(c)||!1===s&&op(c)?U.some(cC.moveToPosition(e)):U.none());var t,n,r,o,i,a})},dC=function(r,e,o){return i=e,a=o.getNode(!1===i),u=i?"after":"before",Rn(a)&&a.getAttribute("data-mce-caret")===u?(t=e,n=o.getNode(!1===e),(t&&qn(n.nextSibling)?U.some(cC.moveToElement(n.nextSibling)):!1===t&&qn(n.previousSibling)?U.some(cC.moveToElement(n.previousSibling)):U.none()).fold(function(){return fC(r,e,o)},U.some)):fC(r,e,o).bind(function(e){return t=r,n=o,e.fold(function(e){return U.some(cC.remove(e))},function(e){return U.some(cC.moveToElement(e))},function(e){return Qc(n,e,t)?U.none():U.some(cC.moveToPosition(e))});var t,n});var t,n,i,a,u},mC=function(e,t){return U.from(Jf(e.getBody(),t))},pC=function(a,u){var e=a.selection.getNode();return mC(a,e).filter(qn).fold(function(){return e=a.getBody(),t=u,n=a.selection.getRng(),r=ol(t?1:-1,e,n),o=Is.fromRangeStart(r),i=Rt.fromDom(e),(!1===t&&ip(o)?U.some(cC.remove(o.getNode(!0))):t&&op(o)?U.some(cC.remove(o.getNode())):!1===t&&op(o)&&Sp(i,o)?Np(i,o).map(function(e){return cC.remove(e.getNode())}):t&&ip(o)&&xp(i,o)?Ep(i,o).map(function(e){return cC.remove(e.getNode())}):dC(e,t,o)).exists(function(e){return e.fold(function(e){return o._selectionOverrides.hideFakeCaret(),eg(o,i,Rt.fromDom(e)),!0},(r=i=u,function(e){var t=r?Is.before(e):Is.after(e);return n.selection.setRng(t.toRange()),!0}),(t=n=o=a,function(e){return t.selection.setRng(e.toRange()),!0}));var t,n,r,o,i});var e,t,n,r,o,i},w)},gC=function(t,n){var e=t.selection.getNode();return!!qn(e)&&mC(t,e.parentNode).filter(qn).fold(function(){var e;return e=Rt.fromDom(t.getBody()),Y(qu(e,".mce-offscreen-selection"),gn),eg(t,n,Rt.fromDom(t.selection.getNode())),Ib(t),!0},w)},hC=function(e){var t,n=e.dom,r=e.selection,o=Jf(e.getBody(),r.getNode());return Vn(o)&&n.isBlock(o)&&n.isEmpty(o)&&(t=n.create("br",{"data-mce-bogus":"1"}),n.setHTML(o,""),o.appendChild(t),r.setRng(Is.before(t).toRange())),!0},vC=function(e,t){return(e.selection.isCollapsed()?pC:gC)(e,t)},yC=function(e,t){return!!e.selection.isCollapsed()&&(n=e,r=t,o=Is.fromRangeStart(n.selection.getRng()),Rl(r,n.getBody(),o).filter(function(e){return(r?Qm:Zm)(e)}).bind(function(e){return U.from(Zc(r?0:-1,e))}).exists(function(e){return n.selection.select(e),!0}));var n,r,o},bC=Mn,CC=function(e){return bC(e)&&e.data[0]===mo},wC=function(e){return bC(e)&&e.data[e.data.length-1]===mo},xC=function(e){return e.ownerDocument.createTextNode(mo)},SC=function(e,t){return(e?function(e){if(bC(e.previousSibling))return wC(e.previousSibling)||e.previousSibling.appendData(mo),e.previousSibling;if(bC(e))return CC(e)||e.insertData(0,mo),e;var t=xC(e);return e.parentNode.insertBefore(t,e),t}:function(e){if(bC(e.nextSibling))return CC(e.nextSibling)||e.nextSibling.insertData(0,mo),e.nextSibling;if(bC(e))return wC(e)||e.appendData(mo),e;var t=xC(e);return e.nextSibling?e.parentNode.insertBefore(t,e.nextSibling):e.parentNode.appendChild(t),t})(t)},NC=N(SC,!0),EC=N(SC,!1),kC=function(e,t){return Mn(e.container())?SC(t,e.container()):SC(t,e.getNode())},_C=function(e,t){var n=t.get();return n&&e.container()===n&&bo(n)},AC=function(n,e){return e.fold(function(e){Oc(n.get());var t=NC(e);return n.set(t),U.some(Is(t,t.length-1))},function(e){return Ll(e).map(function(e){if(_C(e,n))return Is(n.get(),1);Oc(n.get());var t=kC(e,!0);return n.set(t),Is(t,1)})},function(e){return Il(e).map(function(e){if(_C(e,n))return Is(n.get(),n.get().length-1);Oc(n.get());var t=kC(e,!1);return n.set(t),Is(t,t.length-1)})},function(e){Oc(n.get());var t=EC(e);return n.set(t),U.some(Is(t,1))})},RC=function(e,t){for(var n=0;n<e.length;n++){var r=e[n].apply(null,t);if(r.isSome())return r}return U.none()},TC=wr([{before:["element"]},{start:["element"]},{end:["element"]},{after:["element"]}]),DC=function(e,t){var n=Jc(t,e);return n||e},OC=function(e,t,n){var r=Bb(n),o=DC(t,r.container());return Db(e,o,r).fold(function(){return Bl(o,r).bind(N(Db,e,o)).map(function(e){return TC.before(e)})},U.none)},BC=function(e,t){return null===Ul(e,t)},PC=function(e,t,n){return Db(e,t,n).filter(N(BC,t))},LC=function(e,t,n){var r=Pb(n);return PC(e,t,r).bind(function(e){return Pl(e,r).isNone()?U.some(TC.start(e)):U.none()})},IC=function(e,t,n){var r=Bb(n);return PC(e,t,r).bind(function(e){return Bl(e,r).isNone()?U.some(TC.end(e)):U.none()})},MC=function(e,t,n){var r=Pb(n),o=DC(t,r.container());return Db(e,o,r).fold(function(){return Pl(o,r).bind(N(Db,e,o)).map(function(e){return TC.after(e)})},U.none)},FC=function(e){return!1===Tb(zC(e))},UC=function(e,t,n){return RC([OC,LC,IC,MC],[e,t,n]).filter(FC)},zC=function(e){return e.fold(o,o,o,o)},jC=function(e){return e.fold(S("before"),S("start"),S("end"),S("after"))},HC=function(e){return e.fold(TC.before,TC.before,TC.after,TC.after)},VC=function(e){return e.fold(TC.start,TC.start,TC.end,TC.end)},qC=function(a,e,u,t,n,s){return as(Db(e,u,t),Db(e,u,n),function(e,t){return e!==t&&(r=t,o=Jc(e,n=u),i=Jc(r,n),o&&o===i)?TC.after(a?e:t):s;var n,r,o,i}).getOr(s)},$C=function(e,r){return e.fold(w,function(e){return n=r,!(jC(t=e)===jC(n)&&zC(t)===zC(n));var t,n})},WC=function(e,t){return e?t.fold(a(U.some,TC.start),U.none,a(U.some,TC.after),U.none):t.fold(U.none,a(U.some,TC.before),U.none,a(U.some,TC.end))},KC=function(e,a,u,s){var t=Ob(e,s),c=UC(a,u,t);return UC(a,u,t).bind(N(WC,e)).orThunk(function(){return n=a,r=u,o=c,i=Ob(t=e,s),Rl(t,r,i).map(N(Ob,t)).fold(function(){return o.map(HC)},function(e){return UC(n,r,e).map(N(qC,t,n,r,i,e)).filter(N($C,o))}).filter(FC);var t,n,r,o,i})},XC=(N(KC,!1),N(KC,!0),function(e,t,n){var r=e?1:-1;return t.setRng(Is(n.container(),n.offset()+r).toRange()),t.getSel().modify("move",e?"forward":"backward","word"),!0}),YC=function(e,t){var n=t.selection.getRng(),r=e?Is.fromRangeEnd(n):Is.fromRangeStart(n);return!!D(t.selection.getSel().modify)&&(e&&xo(r)?XC(!0,t.selection,r):!(e||!So(r))&&XC(!1,t.selection,r))},GC=function(e,t){var n=e.dom.createRng();n.setStart(t.container(),t.offset()),n.setEnd(t.container(),t.offset()),e.selection.setRng(n)},JC=function(e,t){e?t.setAttribute("data-mce-selected","inline-boundary"):t.removeAttribute("data-mce-selected")},QC=function(t,e,n){return AC(e,n).map(function(e){return GC(t,e),n})},ZC=function(e,t){var n,r;e.selection.isCollapsed()&&!0!==e.composing&&t.get()&&(n=Is.fromRangeStart(e.selection.getRng()),Is.isTextPosition(n)&&!1===(xo(r=n)||So(r))&&(GC(e,Dc(t.get(),n)),t.set(null)))},ew=function(e,t,n){return!!wc(e)&&(o=t,i=n,a=(r=e).getBody(),u=Is.fromRangeStart(r.selection.getRng()),s=N(Rb,r),KC(i,s,a,u).bind(function(e){return QC(r,o,e)}).isSome());var r,o,i,a,u,s},tw=function(e,t,n){return!!wc(t)&&YC(e,t)},nw=function(d){var m=Au(null),p=N(Rb,d);return d.on("NodeChange",function(e){var n,r,o,t,i,a,u,s,c,l,f;!wc(d)||xt.browser.isIE()&&e.initial||(a=p,u=d.dom,s=e.parents,c=z(qu(Rt.fromDom(u.getRoot()),'*[data-mce-selected="inline-boundary"]'),function(e){return e.dom}),l=H(c,a),f=H(s,a),Y(ee(l,f),N(JC,!1)),Y(ee(f,l),N(JC,!0)),ZC(d,m),n=p,r=d,o=m,t=e.parents,r.selection.isCollapsed()&&(i=H(t,n),Y(i,function(e){var t=Is.fromRangeStart(r.selection.getRng());UC(n,r.getBody(),t).bind(function(e){return QC(r,o,e)})})))}),m},rw=N(tw,!0),ow=N(tw,!1),iw=function(t,n){return function(e){return AC(n,e).exists(function(e){return GC(t,e),!0})}},aw=function(r,o,i,a){var u=r.getBody(),s=N(Rb,r);r.undoManager.ignore(function(){var e,t,n;r.selection.setRng((e=i,t=a,(n=document.createRange()).setStart(e.container(),e.offset()),n.setEnd(t.container(),t.offset()),n)),r.execCommand("Delete"),UC(s,u,Is.fromRangeStart(r.selection.getRng())).map(VC).map(iw(r,o))}),r.nodeChanged()},uw=function(n,r,i,o){var e,t,a=(e=n.getBody(),t=o.container(),Jc(t,e)||e),u=N(Rb,n),s=UC(u,a,o);return s.bind(function(e){return i?e.fold(S(U.some(VC(e))),U.none,S(U.some(HC(e))),U.none):e.fold(U.none,S(U.some(HC(e))),U.none,S(U.some(VC(e))))}).map(iw(n,r)).getOrThunk(function(){var t=Tl(i,a,o),e=t.bind(function(e){return UC(u,a,e)});return as(s,e,function(){return Db(u,a,o).exists(function(e){return!!as(Ll(o=e),Il(o),function(e,t){var n=Ob(!0,e),r=Ob(!1,t);return Bl(o,n).forall(function(e){return e.isEqual(r)})}).getOr(!0)&&(eg(n,i,Rt.fromDom(e)),!0);var o})}).orThunk(function(){return e.bind(function(e){return t.map(function(e){return i?aw(n,r,o,e):aw(n,r,e,o),!0})})}).getOr(!1)})},sw=function(e,t,n){if(e.selection.isCollapsed()&&wc(e)){var r=Is.fromRangeStart(e.selection.getRng());return uw(e,t,n,r)}return!1},cw=function(e){return 1===Jt(e).length},lw=function(e,t,n,r){var o,i,a,u,s,c=N(gh,t),l=z(H(r,c),function(e){return e.dom});0===l.length?eg(t,e,n):(i=n.dom,a=l,u=sh(!1),s=dh(a,u.dom),cn(Rt.fromDom(i),u),gn(Rt.fromDom(i)),o=Is(s,0),t.selection.setRng(o.toRange()))},fw=function(r,o){var t,e=Rt.fromDom(r.getBody()),n=Rt.fromDom(r.selection.getStart()),s=H((t=fp(n,e),G(t,to).fold(S(t),function(e){return t.slice(0,e)})),cw);return oe(s).exists(function(e){var t,i,a,u,n=Is.fromRangeStart(r.selection.getRng());return i=o,a=n,u=e.dom,!(!as(Ll(u),Il(u),function(e,t){var n=Ob(!0,e),r=Ob(!1,t),o=Ob(!1,a);return i?Bl(u,o).exists(function(e){return e.isEqual(r)&&a.isEqual(n)}):Pl(u,o).exists(function(e){return e.isEqual(n)&&a.isEqual(r)})}).getOr(!0)||Fl((t=e).dom)&&ah(t.dom))&&(lw(o,r,e,s),!0)})},dw=function(e,t){return!!e.selection.isCollapsed()&&fw(e,t)},mw=function(e,t,n){return e._selectionOverrides.hideFakeCaret(),eg(e,t,Rt.fromDom(n)),!0},pw=function(e,t){return e.selection.isCollapsed()?(i=e,u=(a=t)?ep:tp,s=a?Ms.Forwards:Ms.Backwards,c=al(s,i.getBody(),i.selection.getRng()),u(c)?mw(i,a,c.getNode(!a)):U.from(Ob(a,c)).filter(function(e){return u(e)&&cl(c,e)}).exists(function(e){return mw(i,a,e.getNode(!a))})):(r=t,o=(n=e).selection.getNode(),!!Wn(o)&&mw(n,r,o));var n,r,o,i,a,u,s,c},gw=function(e){var t=parseInt(e,10);return isNaN(t)?0:t},hw=function(e,t){return(e||"table"===It(t)?"margin":"padding")+("rtl"===tr(t,"direction")?"-right":"-left")},vw=function(e){var r,t=bw(e);return!e.mode.isReadOnly()&&(1<t.length||(r=e,Q(t,function(e){var t=hw(hc(r),e),n=rr(e,t).map(gw).getOr(0);return"false"!==r.dom.getContentEditable(e.dom)&&0<n})))},yw=function(e){return io(e)||ao(e)},bw=function(e){return H(z(e.selection.getSelectedBlocks(),Rt.fromDom),function(e){return!yw(e)&&!Wt(e).map(yw).getOr(!1)&&Dr(e,function(e){return Vn(e.dom)||qn(e.dom)}).exists(function(e){return Vn(e.dom)})})},Cw=function(e,c){var l=e.dom,t=e.selection,n=e.formatter,r=e.getParam("indentation","40px","string"),f=/[a-z%]+$/i.exec(r)[0],d=parseInt(r,10),m=hc(e),o=lc(e);e.queryCommandState("InsertUnorderedList")||e.queryCommandState("InsertOrderedList")||""!==o||l.getParent(t.getNode(),l.isBlock)||n.apply("div"),Y(bw(e),function(e){var t,n,r,o,i,a,u,s;t=l,n=c,r=m,o=d,i=f,a=e.dom,s=hw(r,Rt.fromDom(a)),"outdent"===n?(u=Math.max(0,gw(a.style[s])-o),t.setStyle(a,s,u?u+i:"")):(u=gw(a.style[s])+o+i,t.setStyle(a,s,u))})},ww=function(e,t){if(e.selection.isCollapsed()&&vw(e)){var n=e.dom,r=e.selection.getRng(),o=Is.fromRangeStart(r),i=n.getParent(r.startContainer,n.isBlock);if(null!==i&&hp(Rt.fromDom(i),o))return Cw(e,"outdent"),!0}return!1},xw=function(e,t){e.getDoc().execCommand(t,!1,null)},Sw=function(n,r){n.addCommand("delete",function(){var e,t;t=r,ww(e=n)||vC(e,!1)||sC(e,!1)||sw(e,t,!1)||Xb(e,!1)||_g(e)||yC(e,!1)||pw(e,!1)||Qb(e)||dw(e,!1)||(xw(e,"Delete"),Ib(e))}),n.addCommand("forwardDelete",function(){var e,t;t=r,vC(e=n,!0)||sC(e,!0)||sw(e,t,!0)||Xb(e,!0)||_g(e)||yC(e,!0)||pw(e,!0)||Qb(e)||dw(e,!0)||xw(e,"ForwardDelete")})},Nw=function(e){return e.touches===undefined||1!==e.touches.length?U.none():U.some(e.touches[0])},Ew=function(a){var u=Au(U.none()),s=Au(!1),r=Lu(function(e){a.fire("longpress",_e(_e({},e),{type:"longpress"})),s.set(!0)},400);a.on("touchstart",function(n){Nw(n).each(function(e){r.cancel();var t={x:e.clientX,y:e.clientY,target:n.target};r.throttle(n),s.set(!1),u.set(U.some(t))})},!0),a.on("touchmove",function(e){r.cancel(),Nw(e).each(function(i){u.get().each(function(e){var t,n,r,o;t=i,n=e,r=Math.abs(t.clientX-n.x),o=Math.abs(t.clientY-n.y),(5<r||5<o)&&(u.set(U.none()),s.set(!1),a.fire("longpresscancel"))})})},!0),a.on("touchend touchcancel",function(t){r.cancel(),"touchcancel"!==t.type&&u.get().filter(function(e){return e.target.isEqualNode(t.target)}).each(function(){s.get()?t.preventDefault():a.fire("tap",_e(_e({},t),{type:"tap"}))})},!0)},kw=function(e,t){return e.hasOwnProperty(t.nodeName)},_w=function(e){var t,n,r,o=e.dom,i=e.selection,a=e.schema,u=a.getBlockElements(),s=i.getStart(),c=e.getBody(),l=lc(e);if(s&&Rn(s)&&l){var f=c.nodeName.toLowerCase();if(a.isValidChild(f,l.toLowerCase())&&(d=u,m=c,p=s,!F(lp(Rt.fromDom(p),Rt.fromDom(m)),function(e){return kw(d,e.dom)}))){for(var d,m,p,g,h,v=i.getRng(),y=v.startContainer,b=v.startOffset,C=v.endContainer,w=v.endOffset,x=vm(e),s=c.firstChild;s;)if(g=u,Mn(h=s)||Rn(h)&&!kw(g,h)&&!Xl(h)){if(function(e,t){if(Mn(t)){if(0===t.nodeValue.length)return!0;if(/^\s+$/.test(t.nodeValue)&&(!t.nextSibling||kw(e,t.nextSibling)))return!0}return!1}(u,s)){s=(n=s).nextSibling,o.remove(n);continue}t||(t=o.create(l,fc(e)),s.parentNode.insertBefore(t,s),r=!0),s=(n=s).nextSibling,t.appendChild(n)}else t=null,s=s.nextSibling;r&&x&&(v.setStart(y,b),v.setEnd(C,w),i.setRng(v),e.nodeChanged())}}},Aw=function(e,t){var n;t.hasAttribute("data-mce-caret")&&(_o(t),(n=e).selection.setRng(n.selection.getRng()),e.selection.scrollIntoView(t))},Rw=function(e,t){var n,r=(n=e,Pr(Rt.fromDom(n.getBody()),"*[data-mce-caret]").fold(S(null),function(e){return e.dom}));if(r)return"compositionstart"===t.type?(t.preventDefault(),t.stopPropagation(),void Aw(e,r)):void(wo(r)&&(Aw(e,r),e.undoManager.add()))};(Gy=Yy=Yy||{})[Gy.Br=0]="Br",Gy[Gy.Block=1]="Block",Gy[Gy.Wrap=2]="Wrap",Gy[Gy.Eol=3]="Eol";var Tw,Dw,Ow=function(e,t){return e===Ms.Backwards?Z(t):t},Bw=function(e,t,n,r){for(var o,i,a,u,s,c,l=Nl(n),f=r,d=[];f&&(s=l,c=f,o=t===Ms.Forwards?s.next(c):s.prev(c));){if(jn(o.getNode(!1)))return t===Ms.Forwards?{positions:Ow(t,d).concat([o]),breakType:Yy.Br,breakAt:U.some(o)}:{positions:Ow(t,d),breakType:Yy.Br,breakAt:U.some(o)};if(o.isVisible()){if(e(f,o)){var m=(i=t,a=f,jn((u=o).getNode(i===Ms.Forwards))?Yy.Br:!1===Qc(a,u)?Yy.Block:Yy.Wrap);return{positions:Ow(t,d),breakType:m,breakAt:U.some(o)}}d.push(o),f=o}else f=o}return{positions:Ow(t,d),breakType:Yy.Eol,breakAt:U.none()}},Pw=function(n,r,o,e){return r(o,e).breakAt.map(function(e){var t=r(o,e).positions;return n===Ms.Backwards?t.concat(e):[e].concat(t)}).getOr([])},Lw=function(e,i){return $(e,function(e,o){return e.fold(function(){return U.some(o)},function(r){return as(re(r.getClientRects()),re(o.getClientRects()),function(e,t){var n=Math.abs(i-e.left);return Math.abs(i-t.left)<=n?o:r}).or(e)})},U.none())},Iw=function(t,e){return re(e.getClientRects()).bind(function(e){return Lw(t,e.left)})},Mw=N(Bw,Is.isAbove,-1),Fw=N(Bw,Is.isBelow,1),Uw=N(Pw,-1,Mw),zw=N(Pw,1,Fw),jw=function(t){var e=function(e){return z(e,function(e){return(e=ss(e)).node=t,e})};if(Rn(t))return e(t.getClientRects());if(Mn(t)){var n=t.ownerDocument.createRange();return n.setStart(t,0),n.setEnd(t,t.data.length),e(n.getClientRects())}},Hw=function(e){return J(e,jw)};(Dw=Tw=Tw||{})[Dw.Up=-1]="Up",Dw[Dw.Down=1]="Down";var Vw=function(o,i,a,e,u,t){var s=0,c=[],n=function(e){var t,n,r=Hw([e]);for(-1===o&&(r=r.reverse()),t=0;t<r.length;t++)if(n=r[t],!a(n,l)){if(0<c.length&&i(n,ke(c))&&s++,n.line=s,u(n))return!0;c.push(n)}},l=ke(t.getClientRects());if(!l)return c;var r=t.getNode();return n(r),function(e,t,n,r){for(;r=Gc(r,e,Fo,t);)if(n(r))return}(o,e,n,r),c},qw=N(Vw,Tw.Up,fs,ds),$w=N(Vw,Tw.Down,ds,fs),Ww=function(n){return function(e){return t=n,e.line>t;var t}},Kw=function(n){return function(e){return t=n,e.line===t;var t}},Xw=qn,Yw=Gc,Gw=function(e,t){return Math.abs(e.left-t)},Jw=function(e,t){return Math.abs(e.right-t)},Qw=function(e,t){return e>=t.left&&e<=t.right},Zw=function(e,t){return e>=t.top&&e<=t.bottom},ex=function(e,o){return Ne(e,function(e,t){var n=Math.min(Gw(e,o),Jw(e,o)),r=Math.min(Gw(t,o),Jw(t,o));return Qw(o,t)||!Qw(o,e)&&(r===n&&Xw(t.node)||r<n)?t:e})},tx=function(e,t,n,r,o){var i=Yw(r,e,Fo,t,!o);do{if(!i||n(i))return}while(i=Yw(i,e,Fo,t))},nx=function(e,t,n){var r,o,i=Hw(H(ie(e.getElementsByTagName("*")),jc)),a=H(i,N(Zw,n));if(u=ex(a,t)){var u,s=!Pn(u.node)&&!Wn(u.node);if((u=ex(function(e,r,t){void 0===t&&(t=!0);var o=[],n=function(t,e){var n=H(Hw([e]),function(e){return!t(e,r)});return o=o.concat(n),0===n.length};return o.push(r),tx(Tw.Up,e,N(n,fs),r.node,t),tx(Tw.Down,e,N(n,ds),r.node,t),o}(e,u,s),t))&&jc(u.node))return o=t,{node:(r=u).node,before:Gw(r,o)<Jw(r,o)}}return null},rx=function(e,t){e.selection.setRng(t),zd(e,e.selection.getRng())},ox=function(e,t,n){return U.some(oC(e,t,n))},ix=function(e,t,n,r,o,i){var a=t===Ms.Forwards,u=Nl(e.getBody()),s=N(sl,a?u.next:u.prev),c=a?r:o;if(!n.collapsed){var l=ps(n);if(i(l))return tC(t,e,l,t===Ms.Backwards,!1)}var f=al(t,e.getBody(),n);if(c(f))return nC(e,f.getNode(!a));var d=Ob(a,s(f)),m=yo(n.startContainer);if(!d)return m?U.some(n):U.none();if(c(d))return tC(t,e,d.getNode(!a),a,!1);var p=s(d);return p&&c(p)&&cl(d,p)?tC(t,e,p.getNode(!a),a,!1):m?ox(e,d.toRange(),!1):U.none()},ax=function(t,e,n,r,o,i){var a=al(e,t.getBody(),n),u=ke(a.getClientRects()),s=e===Tw.Down;if(!u)return U.none();var c,l=(s?$w:qw)(t.getBody(),Ww(1),a),f=H(l,Kw(1)),d=u.left,m=ex(f,d);if(m&&i(m.node)){var p=Math.abs(d-m.left),g=Math.abs(d-m.right);return tC(e,t,m.node,p<g,!1)}if(c=r(a)?a.getNode():o(a)?a.getNode(!0):ps(n)){var h=function(e,t,n,r){var o,i,a,u,s=Nl(t),c=[],l=0,f=function(e){return ke(e.getClientRects())},d=1===e?(o=s.next,i=ds,a=fs,Is.after(r)):(o=s.prev,i=fs,a=ds,Is.before(r)),m=f(d);do{if(d.isVisible()&&!a(u=f(d),m)){if(0<c.length&&i(u,ke(c))&&l++,(u=ss(u)).position=d,u.line=l,n(u))return c;c.push(u)}}while(d=o(d));return c}(e,t.getBody(),Ww(1),c),v=ex(H(h,Kw(1)),d);if(v)return ox(t,v.position.toRange(),!1);if(v=ke(H(h,Kw(0))))return ox(t,v.position.toRange(),!1)}return 0===f.length?ux(t,s).filter(s?o:r).map(function(e){return oC(t,e.toRange(),!1)}):U.none()},ux=function(e,t){var n=e.selection.getRng(),r=e.getBody();if(t){var o=Is.fromRangeEnd(n),i=Fw(r,o);return oe(i.positions)}o=Is.fromRangeStart(n),i=Mw(r,o);return re(i.positions)},sx=function(t,e,n){return ux(t,e).filter(n).exists(function(e){return t.selection.setRng(e.toRange()),!0})},cx=qn,lx=function(e,t,n){var r,o,i=Nl(e.getBody()),a=N(sl,1===t?i.next:i.prev);if(n.collapsed&&""!==lc(e)){var u,s=e.dom.getParent(n.startContainer,"PRE");if(!s)return;a(Is.fromRangeStart(n))||(o=(r=e).dom.create(lc(r)),(!xt.ie||11<=xt.ie)&&(o.innerHTML='<br data-mce-bogus="1">'),u=o,1===t?e.$(s).after(u):e.$(s).before(u),e.selection.select(u,!0),e.selection.collapse())}},fx=function(e,t){var n=t?Ms.Forwards:Ms.Backwards,r=e.selection.getRng();return ix(e,n,r,op,ip,cx).orThunk(function(){return lx(e,n,r),U.none()})},dx=function(e,t){var n=t?1:-1,r=e.selection.getRng();return ax(e,n,r,function(e){return op(e)||np(e)},function(e){return ip(e)||rp(e)},cx).orThunk(function(){return lx(e,n,r),U.none()})},mx=function(t,e){return fx(t,e).exists(function(e){return rx(t,e),!0})},px=function(t,e){return dx(t,e).exists(function(e){return rx(t,e),!0})},gx=function(e,t){return sx(e,t,t?ip:op)},hx=function(e){return M(["figcaption"],It(e))},vx=function(e){var t=document.createRange();return t.setStartBefore(e.dom),t.setEndBefore(e.dom),t},yx=function(e,t,n){(n?dn:fn)(e,t)},bx=function(e,t,n,r){return""===t?(l=e,f=r,d=Rt.fromTag("br"),yx(l,d,f),vx(d)):(o=e,i=r,a=t,u=n,s=Rt.fromTag(a),c=Rt.fromTag("br"),Gn(s,u),dn(s,c),yx(o,s,i),vx(c));var o,i,a,u,s,c,l,f,d},Cx=function(e,t,n){return t?(o=e.dom,Fw(o,n).breakAt.isNone()):(r=e.dom,Mw(r,n).breakAt.isNone());var r,o},wx=function(t,n){var e,r,o=Rt.fromDom(t.getBody()),i=Is.fromRangeStart(t.selection.getRng()),a=lc(t),u=fc(t);return e=i,r=N(Bt,o),Dr(Rt.fromDom(e.container()),to,r).filter(hx).exists(function(){if(Cx(o,n,i)){var e=bx(o,a,u,n);return t.selection.setRng(e),!0}return!1})},xx=function(e,t){return!!e.selection.isCollapsed()&&wx(e,t)},Sx=function(e,r){return J(z(e,function(e){return _e({shiftKey:!1,altKey:!1,ctrlKey:!1,metaKey:!1,keyCode:0,action:te},e)}),function(e){return t=e,(n=r).keyCode===t.keyCode&&n.shiftKey===t.shiftKey&&n.altKey===t.altKey&&n.ctrlKey===t.ctrlKey&&n.metaKey===t.metaKey?[e]:[];var t,n})},Nx=function(e){for(var t=[],n=1;n<arguments.length;n++)t[n-1]=arguments[n];return function(){return e.apply(null,t)}},Ex=function(e,t){return W(Sx(e,t),function(e){return e.action()})},kx=function(t,e){var n=e?Ms.Forwards:Ms.Backwards,r=t.selection.getRng();return ix(t,n,r,ep,tp,Wn).exists(function(e){return rx(t,e),!0})},_x=function(t,e){var n=e?1:-1,r=t.selection.getRng();return ax(t,n,r,ep,tp,Wn).exists(function(e){return rx(t,e),!0})},Ax=function(e,t){return sx(e,t,t?tp:ep)},Rx=function(o,e){return J(e,function(e){var t,n,r=(t=ss(e.getBoundingClientRect()),n=-1,{left:t.left-n,top:t.top-n,right:t.right+2*n,bottom:t.bottom+2*n,width:t.width+n,height:t.height+n});return[{x:r.left,y:o(r),cell:e},{x:r.right,y:o(r),cell:e}]})},Tx=function(e,t,n,r,o){var i,a,u=qu(Rt.fromDom(n),"td,th,caption").map(function(e){return e.dom}),s=H(Rx(e,u),function(e){return t(e,o)});return i=r,a=o,$(s,function(e,r){return e.fold(function(){return U.some(r)},function(e){var t=Math.sqrt(Math.abs(e.x-i)+Math.abs(e.y-a)),n=Math.sqrt(Math.abs(r.x-i)+Math.abs(r.y-a));return U.some(n<t?r:e)})},U.none()).map(function(e){return e.cell})},Dx=N(Tx,function(e){return e.bottom},function(e,t){return e.y<t}),Ox=N(Tx,function(e){return e.top},function(e,t){return e.y>t}),Bx=function(t,n){return re(n.getClientRects()).bind(function(e){return Dx(t,e.left,e.top)}).bind(function(e){return Iw(Il(t=e).map(function(e){return Mw(t,e).positions.concat(e)}).getOr([]),n);var t})},Px=function(t,n){return oe(n.getClientRects()).bind(function(e){return Ox(t,e.left,e.top)}).bind(function(e){return Iw(Ll(t=e).map(function(e){return[e].concat(Fw(t,e).positions)}).getOr([]),n);var t})},Lx=function(e,t,n){var r,o,i,a,u=e(t,n);return(a=u).breakType===Yy.Wrap&&0===a.positions.length||!jn(n.getNode())&&((i=u).breakType===Yy.Br&&1===i.positions.length)?(r=e,o=t,!u.breakAt.exists(function(e){return r(o,e).breakAt.isSome()})):u.breakAt.isNone()},Ix=N(Lx,Mw),Mx=N(Lx,Fw),Fx=function(t,e,n,r){var o,i,a,u,s=t.selection.getRng(),c=e?1:-1;return!(!Uc()||(o=e,i=s,a=n,u=Is.fromRangeStart(i),!Ol(!o,a).exists(function(e){return e.isEqual(u)})))&&(tC(c,t,n,!e,!1).each(function(e){rx(t,e)}),!0)},Ux=function(e,t){var n=t.getNode(e);return Rn(n)&&"TABLE"===n.nodeName?U.some(n):U.none()},zx=function(u,s,c){var e=Ux(!!s,c),t=!1===s;e.fold(function(){return rx(u,c.toRange())},function(a){return Ol(t,u.getBody()).filter(function(e){return e.isEqual(c)}).fold(function(){return rx(u,c.toRange())},function(e){return n=s,o=a,t=c,void((i=lc(r=u))?r.undoManager.transact(function(){var e=Rt.fromTag(i);Gn(e,fc(r)),dn(e,Rt.fromTag("br")),(n?ln:cn)(Rt.fromDom(o),e);var t=r.dom.createRng();t.setStart(e.dom,0),t.setEnd(e.dom,0),rx(r,t)}):rx(r,t.toRange()));var n,r,o,t,i})})},jx=function(e,t,n,r){var o,i,a,u,s,c,l=e.selection.getRng(),f=Is.fromRangeStart(l),d=e.getBody();if(!t&&Ix(r,f)){var m=(u=d,Bx(s=n,c=f).orThunk(function(){return re(c.getClientRects()).bind(function(e){return Lw(Uw(u,Is.before(s)),e.left)})}).getOr(Is.before(s)));return zx(e,t,m),!0}if(t&&Mx(r,f)){m=(o=d,Px(i=n,a=f).orThunk(function(){return re(a.getClientRects()).bind(function(e){return Lw(zw(o,Is.after(i)),e.left)})}).getOr(Is.after(i)));return zx(e,t,m),!0}return!1},Hx=function(n,r,o){return U.from(n.dom.getParent(n.selection.getNode(),"td,th")).bind(function(t){return U.from(n.dom.getParent(t,"table")).map(function(e){return o(n,r,e,t)})}).getOr(!1)},Vx=function(e,t){return Hx(e,t,Fx)},qx=function(e,t){return Hx(e,t,jx)},$x=function(i,a){i.on("keydown",function(e){var t,n,r,o;!1===e.isDefaultPrevented()&&(t=i,n=a,r=e,o=mt().os,Ex([{keyCode:ed.RIGHT,action:Nx(mx,t,!0)},{keyCode:ed.LEFT,action:Nx(mx,t,!1)},{keyCode:ed.UP,action:Nx(px,t,!1)},{keyCode:ed.DOWN,action:Nx(px,t,!0)},{keyCode:ed.RIGHT,action:Nx(Vx,t,!0)},{keyCode:ed.LEFT,action:Nx(Vx,t,!1)},{keyCode:ed.UP,action:Nx(qx,t,!1)},{keyCode:ed.DOWN,action:Nx(qx,t,!0)},{keyCode:ed.RIGHT,action:Nx(kx,t,!0)},{keyCode:ed.LEFT,action:Nx(kx,t,!1)},{keyCode:ed.UP,action:Nx(_x,t,!1)},{keyCode:ed.DOWN,action:Nx(_x,t,!0)},{keyCode:ed.RIGHT,action:Nx(ew,t,n,!0)},{keyCode:ed.LEFT,action:Nx(ew,t,n,!1)},{keyCode:ed.RIGHT,ctrlKey:!o.isOSX(),altKey:o.isOSX(),action:Nx(rw,t,n)},{keyCode:ed.LEFT,ctrlKey:!o.isOSX(),altKey:o.isOSX(),action:Nx(ow,t,n)},{keyCode:ed.UP,action:Nx(xx,t,!1)},{keyCode:ed.DOWN,action:Nx(xx,t,!0)}],r).each(function(e){r.preventDefault()}))})},Wx=function(o,i){o.on("keydown",function(e){var t,n,r;!1===e.isDefaultPrevented()&&(t=o,n=i,r=e,Ex([{keyCode:ed.BACKSPACE,action:Nx(ww,t,!1)},{keyCode:ed.BACKSPACE,action:Nx(vC,t,!1)},{keyCode:ed.DELETE,action:Nx(vC,t,!0)},{keyCode:ed.BACKSPACE,action:Nx(sC,t,!1)},{keyCode:ed.DELETE,action:Nx(sC,t,!0)},{keyCode:ed.BACKSPACE,action:Nx(sw,t,n,!1)},{keyCode:ed.DELETE,action:Nx(sw,t,n,!0)},{keyCode:ed.BACKSPACE,action:Nx(_g,t,!1)},{keyCode:ed.DELETE,action:Nx(_g,t,!0)},{keyCode:ed.BACKSPACE,action:Nx(yC,t,!1)},{keyCode:ed.DELETE,action:Nx(yC,t,!0)},{keyCode:ed.BACKSPACE,action:Nx(pw,t,!1)},{keyCode:ed.DELETE,action:Nx(pw,t,!0)},{keyCode:ed.BACKSPACE,action:Nx(Qb,t,!1)},{keyCode:ed.DELETE,action:Nx(Qb,t,!0)},{keyCode:ed.BACKSPACE,action:Nx(Xb,t,!1)},{keyCode:ed.DELETE,action:Nx(Xb,t,!0)},{keyCode:ed.BACKSPACE,action:Nx(dw,t,!1)},{keyCode:ed.DELETE,action:Nx(dw,t,!0)}],r).each(function(e){r.preventDefault()}))}),o.on("keyup",function(e){var t,n;!1===e.isDefaultPrevented()&&(t=o,n=e,Ex([{keyCode:ed.BACKSPACE,action:Nx(hC,t)},{keyCode:ed.DELETE,action:Nx(hC,t)}],n))})},Kx=function(e,t){var n,r,o=t,i=e.dom,a=e.schema.getMoveCaretBeforeOnEnterElements();if(t){!/^(LI|DT|DD)$/.test(t.nodeName)||(r=function(e){for(;e;){if(1===e.nodeType||3===e.nodeType&&e.data&&/[\r\n\s]/.test(e.data))return e;e=e.nextSibling}}(t.firstChild))&&/^(UL|OL|DL)$/.test(r.nodeName)&&t.insertBefore(i.doc.createTextNode(fo),t.firstChild);var u=i.createRng();if(t.normalize(),t.hasChildNodes()){for(var s=new Yr(t,t);n=s.current();){if(Mn(n)){u.setStart(n,0),u.setEnd(n,0);break}if(a[n.nodeName.toLowerCase()]){u.setStartBefore(n),u.setEndBefore(n);break}o=n,n=s.next()}n||(u.setStart(o,0),u.setEnd(o,0))}else jn(t)?t.nextSibling&&i.isBlock(t.nextSibling)?(u.setStartBefore(t),u.setEndBefore(t)):(u.setStartAfter(t),u.setEndAfter(t)):(u.setStart(t,0),u.setEnd(t,0));e.selection.setRng(u),zd(e,u)}},Xx=function(e){return U.from(e.dom.getParent(e.selection.getStart(!0),e.dom.isBlock))},Yx=function(e,t){return e&&e.parentNode&&e.parentNode.nodeName===t},Gx=function(e){return e&&/^(OL|UL|LI)$/.test(e.nodeName)},Jx=function(e){var t=e.parentNode;return/^(LI|DT|DD)$/.test(t.nodeName)?t:e},Qx=function(e,t,n){for(var r=e[n?"firstChild":"lastChild"];r&&!Rn(r);)r=r[n?"nextSibling":"previousSibling"];return r===t},Zx=function(e,t,n,r,o){var i,a,u,s,c,l,f,d,m,p=e.dom,g=e.selection.getRng();n!==e.getBody()&&(Gx(i=n)&&Gx(i.parentNode)&&(o="LI"),a=o?t(o):p.create("BR"),Qx(n,r,!0)&&Qx(n,r,!1)?Yx(n,"LI")?(u=Jx(n),p.insertAfter(a,u),(null===(m=(d=n).parentNode)||void 0===m?void 0:m.firstChild)===d?p.remove(u):p.remove(n)):p.replace(a,n):(Qx(n,r,!0)?Yx(n,"LI")?(p.insertAfter(a,Jx(n)),a.appendChild(p.doc.createTextNode(" ")),a.appendChild(n)):n.parentNode.insertBefore(a,n):Qx(n,r,!1)?p.insertAfter(a,Jx(n)):(n=Jx(n),(s=g.cloneRange()).setStartAfter(r),s.setEndAfter(n),c=s.extractContents(),"LI"===o&&(f="LI",(l=c).firstChild&&l.firstChild.nodeName===f)?(a=c.firstChild,p.insertAfter(c,n)):(p.insertAfter(c,n),p.insertAfter(a,n))),p.remove(r)),Kx(e,a))},eS=function(e){e.innerHTML='<br data-mce-bogus="1">'},tS=function(e,t){return e.nodeName===t||e.previousSibling&&e.previousSibling.nodeName===t},nS=function(e,t){return t&&e.isBlock(t)&&!/^(TD|TH|CAPTION|FORM)$/.test(t.nodeName)&&!/^(fixed|absolute)/i.test(t.style.position)&&"true"!==e.getContentEditable(t)},rS=function(e,t,n){return!1===Mn(t)?n:e?1===n&&t.data.charAt(n-1)===mo?0:n:n===t.data.length-1&&t.data.charAt(n)===mo?t.data.length:n},oS=function(e,t){for(var n,r=e.getRoot(),o=t;o!==r&&"false"!==e.getContentEditable(o);)"true"===e.getContentEditable(o)&&(n=o),o=o.parentNode;return o!==r?n:r},iS=function(e,t){var n=lc(e);n&&n.toLowerCase()===t.tagName.toLowerCase()&&function(e,o,t){var i=e.dom;U.from(t.style).map(i.parseStyle).each(function(e){var t=or(Rt.fromDom(o)),n=_e(_e({},t),e);i.setStyles(o,n)});var n=U.from(t["class"]).map(function(e){return e.split(/\s+/)}),r=U.from(o.className).map(function(e){return H(e.split(/\s+/),function(e){return""!==e})});as(n,r,function(t,e){var n=H(e,function(e){return!M(t,e)}),r=Ae(t,n);i.setAttrib(o,"class",r.join(" "))});var a=["style","class"],u=pe(t,function(e,t){return!M(a,t)});i.setAttribs(o,u)}(e,t,fc(e))},aS=function(a,e){var t,u,i,s,n,r,o,c,l,f=a.dom,d=a.schema,m=d.getNonEmptyElements(),p=a.selection.getRng(),g=function(e){var t,n=u,r=d.getTextInlineElements(),o=e||"TABLE"===c||"HR"===c?f.create(e||N):s.cloneNode(!1),i=o;if(!1===a.getParam("keep_styles",!0))f.setAttrib(o,"style",null),f.setAttrib(o,"class",null);else do{if(r[n.nodeName]){if(Fl(n)||Xl(n))continue;t=n.cloneNode(!1),f.setAttrib(t,"id",""),o.hasChildNodes()?t.appendChild(o.firstChild):i=t,o.appendChild(t)}}while((n=n.parentNode)&&n!==E);return iS(a,o),eS(i),o},h=function(e){var t,n,r=rS(e,u,i);if(Mn(u)&&(e?0<r:r<u.nodeValue.length))return!1;if(u.parentNode===s&&l&&!e)return!0;if(e&&Rn(u)&&u===s.firstChild)return!0;if(tS(u,"TABLE")||tS(u,"HR"))return l&&!e||!l&&e;var o=new Yr(u,s);for(Mn(u)&&(e&&0===r?o.prev():e||r!==u.nodeValue.length||o.next());t=o.current();){if(Rn(t)){if(!t.getAttribute("data-mce-bogus")&&(n=t.nodeName.toLowerCase(),m[n]&&"br"!==n))return!1}else if(Mn(t)&&!zo(t.nodeValue))return!1;e?o.prev():o.next()}return!0},v=function(){n=/^(H[1-6]|PRE|FIGURE)$/.test(c)&&"HGROUP"!==C?g(N):g(),a.getParam("end_container_on_empty_block",!1)&&nS(f,o)&&f.isEmpty(s)?n=f.split(o,s):f.insertAfter(n,s),Kx(a,n)};fd(f,p).each(function(e){p.setStart(e.startContainer,e.startOffset),p.setEnd(e.endContainer,e.endOffset)}),u=p.startContainer,i=p.startOffset,N=lc(a);var y=!(!e||!e.shiftKey),b=!(!e||!e.ctrlKey);Rn(u)&&u.hasChildNodes()&&(l=i>u.childNodes.length-1,u=u.childNodes[Math.min(i,u.childNodes.length-1)]||u,i=l&&Mn(u)?u.nodeValue.length:0);var C,w,x,S,N,E=oS(f,u);E&&((N&&!y||!N&&y)&&(u=function(e,t,n,r,o){var i,a,u,s,c,l,f=t||"P",d=e.dom,m=oS(d,r),p=d.getParent(r,d.isBlock);if(!p||!nS(d,p)){if(c=(p=p||m)===e.getBody()||(l=p)&&/^(TD|TH|CAPTION)$/.test(l.nodeName)?p.nodeName.toLowerCase():p.parentNode.nodeName.toLowerCase(),!p.hasChildNodes())return i=d.create(f),iS(e,i),p.appendChild(i),n.setStart(i,0),n.setEnd(i,0),i;for(u=r;u.parentNode!==p;)u=u.parentNode;for(;u&&!d.isBlock(u);)u=(a=u).previousSibling;if(a&&e.schema.isValidChild(c,f.toLowerCase())){for(i=d.create(f),iS(e,i),a.parentNode.insertBefore(i,a),u=a;u&&!d.isBlock(u);)s=u.nextSibling,i.appendChild(u),u=s;n.setStart(r,o),n.setEnd(r,o)}}return r}(a,N,p,u,i)),s=f.getParent(u,f.isBlock),o=s?f.getParent(s.parentNode,f.isBlock):null,c=s?s.nodeName.toUpperCase():"","LI"!==(C=o?o.nodeName.toUpperCase():"")||b||(o=(s=o).parentNode,c=C),/^(LI|DT|DD)$/.test(c)&&f.isEmpty(s)?Zx(a,g,o,s,N):N&&s===a.getBody()||(N=N||"P",yo(s)?(n=_o(s),f.isEmpty(s)&&eS(s),iS(a,n),Kx(a,n)):h()?v():h(!0)?(n=s.parentNode.insertBefore(g(),s),Kx(a,tS(s,"HR")?n:s)):((S=(x=p).cloneRange()).setStart(x.startContainer,rS(!0,x.startContainer,x.startOffset)),S.setEnd(x.endContainer,rS(!1,x.endContainer,x.endOffset)),(t=S.cloneRange()).setEndAfter(s),r=t.extractContents(),w=r,Y(Vu(Rt.fromDom(w),zt),function(e){var t=e.dom;t.nodeValue=go(t.nodeValue)}),function(e){for(;Mn(e)&&(e.nodeValue=e.nodeValue.replace(/^[\r\n]+/,"")),e=e.firstChild;);}(r),n=r.firstChild,f.insertAfter(r,s),function(e,t,n){var r,o,i,a=n,u=[];if(a){for(;a=a.firstChild;){if(e.isBlock(a))return;Rn(a)&&!t[a.nodeName.toLowerCase()]&&u.push(a)}for(r=u.length;r--;)!(a=u[r]).hasChildNodes()||a.firstChild===a.lastChild&&""===a.firstChild.nodeValue?e.remove(a):(o=e,(i=a)&&"A"===i.nodeName&&o.isEmpty(i)&&e.remove(a))}}(f,m,n),function(e,t){t.normalize();var n=t.lastChild;n&&!/^(left|right)$/gi.test(e.getStyle(n,"float",!0))||e.add(t,"br")}(f,s),f.isEmpty(s)&&eS(s),n.normalize(),f.isEmpty(n)?(f.remove(n),v()):(iS(a,n),Kx(a,n))),f.setAttrib(n,"id",""),a.fire("NewBlock",{newBlock:n})))},uS=function(e,t,n){var r=e.dom.createRng();n?(r.setStartBefore(t),r.setEndBefore(t)):(r.setStartAfter(t),r.setEndAfter(t)),e.selection.setRng(r),zd(e,r)},sS=function(e,t){var n,r,o=e.selection,i=e.dom,a=o.getRng();fd(i,a).each(function(e){a.setStart(e.startContainer,e.startOffset),a.setEnd(e.endContainer,e.endOffset)});var u,s=a.startOffset,c=a.startContainer;1===c.nodeType&&c.hasChildNodes()&&(u=s>c.childNodes.length-1,c=c.childNodes[Math.min(s,c.childNodes.length-1)]||c,s=u&&3===c.nodeType?c.nodeValue.length:0);var l=i.getParent(c,i.isBlock),f=l?i.getParent(l.parentNode,i.isBlock):null,d=f?f.nodeName.toUpperCase():"",m=!(!t||!t.ctrlKey);"LI"!==d||m||(l=f),c&&3===c.nodeType&&s>=c.nodeValue.length&&!function(e,t,n){for(var r,o=new Yr(t,n),i=e.getNonEmptyElements();r=o.next();)if(i[r.nodeName.toLowerCase()]||0<r.length)return!0}(e.schema,c,l)&&(n=i.create("br"),a.insertNode(n),a.setStartAfter(n),a.setEndAfter(n),r=!0),n=i.create("br"),zs(i,a,n),uS(e,n,r),e.undoManager.add()},cS=function(e,t){var n=Rt.fromTag("br");cn(Rt.fromDom(t),n),e.undoManager.add()},lS=function(e,t){fS(e.getBody(),t)||ln(Rt.fromDom(t),Rt.fromTag("br"));var n=Rt.fromTag("br");ln(Rt.fromDom(t),n),uS(e,n.dom,!1),e.undoManager.add()},fS=function(e,t){return n=Is.after(t),!!jn(n.getNode())||Bl(e,Is.after(t)).map(function(e){return jn(e.getNode())}).getOr(!1);var n},dS=function(e){return e&&"A"===e.nodeName&&"href"in e},mS=function(e){return e.fold(b,dS,dS,b)},pS=function(e,t){t.fold(te,N(cS,e),N(lS,e),te)},gS=function(e,t){var n,r,o,i=(r=N(Rb,n=e),o=Is.fromRangeStart(n.selection.getRng()),UC(r,n.getBody(),o).filter(mS));i.isSome()?i.each(N(pS,e)):sS(e,t)},hS=function(e,t){return Xx(e).filter(function(e){return 0<t.length&&Dt(Rt.fromDom(e),t)}).isSome()},vS=wr([{br:[]},{block:[]},{none:[]}]),yS=function(e,t){return hS(n=e,n.getParam("no_newline_selector",""));var n},bS=function(n){return function(e,t){return""===lc(e)===n}},CS=function(n){return function(e,t){return Xx(e).filter(function(e){return ao(Rt.fromDom(e))}).isSome()===n}},wS=function(n,r){return function(e,t){return Xx(e).fold(S(""),function(e){return e.nodeName.toUpperCase()})===n.toUpperCase()===r}},xS=function(e){return wS("pre",e)},SS=function(n){return function(e,t){return e.getParam("br_in_pre",!0)===n}},NS=function(e,t){return hS(n=e,n.getParam("br_newline_selector",".mce-toc h2,figcaption,caption"));var n},ES=function(e,t){return t},kS=function(e){var t=lc(e),n=function(e,t){for(var n,r=e.getRoot(),o=t;o!==r&&"false"!==e.getContentEditable(o);)"true"===e.getContentEditable(o)&&(n=o),o=o.parentNode;return o!==r?n:r}(e.dom,e.selection.getStart());return n&&e.schema.isValidChild(n.nodeName,t||"P")},_S=function(e,t){return function(n,r){return $(e,function(e,t){return e&&t(n,r)},!0)?U.some(t):U.none()}},AS=function(e,t){return RC([_S([yS],vS.none()),_S([wS("summary",!0)],vS.br()),_S([xS(!0),SS(!1),ES],vS.br()),_S([xS(!0),SS(!1)],vS.block()),_S([xS(!0),SS(!0),ES],vS.block()),_S([xS(!0),SS(!0)],vS.br()),_S([CS(!0),ES],vS.br()),_S([CS(!0)],vS.block()),_S([bS(!0),ES,kS],vS.block()),_S([bS(!0)],vS.br()),_S([NS],vS.br()),_S([bS(!1),ES],vS.br()),_S([kS],vS.block())],[e,!(!t||!t.shiftKey)]).getOr(vS.none())},RS=function(e,t){AS(e,t).fold(function(){gS(e,t)},function(){aS(e,t)},te)},TS=function(o){o.on("keydown",function(e){var t,n,r;e.keyCode===ed.ENTER&&(t=o,(n=e).isDefaultPrevented()||(n.preventDefault(),(r=t.undoManager).typing&&(r.typing=!1,r.add()),t.undoManager.transact(function(){!1===t.selection.isCollapsed()&&t.execCommand("Delete"),RS(t,n)})))})},DS=function(r){r.on("keydown",function(e){var t,n;!1===e.isDefaultPrevented()&&(t=r,n=e,Ex([{keyCode:ed.END,action:Nx(gx,t,!0)},{keyCode:ed.HOME,action:Nx(gx,t,!1)},{keyCode:ed.END,action:Nx(Ax,t,!0)},{keyCode:ed.HOME,action:Nx(Ax,t,!1)}],n).each(function(e){n.preventDefault()}))})},OS=mt().browser,BS=function(t){var e,n;e=t,n=Pu(function(){e.composing||Up(e)},0),OS.isIE()&&(e.on("keypress",function(e){n.throttle()}),e.on("remove",function(e){n.cancel()})),t.on("input",function(e){!1===e.isComposing&&Up(t)})},PS=function(n,r){var e=r.container(),t=r.offset();return Mn(e)?(e.insertData(t,n),U.some(Is(e,t+n.length))):ul(r).map(function(e){var t=Rt.fromText(n);return(r.isAtEnd()?ln:cn)(e,t),Is(t.dom,n.length)})},LS=N(PS,fo),IS=N(PS," "),MS=function(r,o){return function(e){return t=r,(!Tp(n=e)&&(Dp(t,n)||Ap(t,n)||Rp(t,n))?LS:IS)(o);var t,n}},FS=function(e){var t,n,r=Is.fromRangeStart(e.selection.getRng()),o=Rt.fromDom(e.getBody());if(e.selection.isCollapsed()){var i=N(Rb,e),a=Is.fromRangeStart(e.selection.getRng());return UC(i,e.getBody(),a).bind((n=o,function(e){return e.fold(function(e){return Pl(n.dom,Is.before(e))},function(e){return Ll(e)},function(e){return Il(e)},function(e){return Bl(n.dom,Is.after(e))})})).bind(MS(o,r)).exists((t=e,function(e){return t.selection.setRng(e.toRange()),t.nodeChanged(),!0}))}return!1},US=function(r){r.on("keydown",function(e){var t,n;!1===e.isDefaultPrevented()&&(t=r,n=e,Ex([{keyCode:ed.SPACEBAR,action:Nx(FS,t)}],n).each(function(e){n.preventDefault()}))})},zS=function(e){var t,n=nw(e);return(t=e).on("keyup compositionstart",N(Rw,t)),$x(e,n),Wx(e,n),TS(e),US(e),BS(e),DS(e),n},jS=(HS.prototype.nodeChanged=function(e){var t,n,r,o=this.editor.selection;this.editor.initialized&&o&&!this.editor.getParam("disable_nodechange")&&!this.editor.mode.isReadOnly()&&(r=this.editor.getBody(),(t=o.getStart(!0)||r).ownerDocument===this.editor.getDoc()&&this.editor.dom.isChildOf(t,r)||(t=r),n=[],this.editor.dom.getParent(t,function(e){return e===r||void n.push(e)}),(e=e||{}).element=t,e.parents=n,this.editor.fire("NodeChange",e))},HS.prototype.isSameElementPath=function(e){var t,n=this.editor.$(e).parentsUntil(this.editor.getBody()).add(e);if(n.length===this.lastPath.length){for(t=n.length;0<=t&&n[t]===this.lastPath[t];t--);if(-1===t)return this.lastPath=n,!0}return this.lastPath=n,!1},HS);function HS(r){var o;this.lastPath=[],this.editor=r;var t=this;"onselectionchange"in r.getDoc()||r.on("NodeChange click mouseup keyup focus",function(e){var t=r.selection.getRng(),n={startContainer:t.startContainer,startOffset:t.startOffset,endContainer:t.endContainer,endOffset:t.endOffset};"nodechange"!==e.type&&id(n,o)||r.fire("SelectionChange"),o=n}),r.on("contextmenu",function(){r.fire("SelectionChange")}),r.on("SelectionChange",function(){var e=r.selection.getStart(!0);!e||!xt.range&&r.selection.isCollapsed()||zf(r)&&!t.isSameElementPath(e)&&r.dom.isChildOf(e,r.getBody())&&r.nodeChanged({selectionChange:!0})}),r.on("mouseup",function(e){!e.isDefaultPrevented()&&zf(r)&&("IMG"===r.selection.getNode().nodeName?Wr.setEditorTimeout(r,function(){r.nodeChanged()}):r.nodeChanged())})}var VS=function(e){var t,n;(t=e).on("click",function(e){t.dom.getParent(e.target,"details")&&e.preventDefault()}),(n=e).parser.addNodeFilter("details",function(e){Y(e,function(e){e.attr("data-mce-open",e.attr("open")),e.attr("open","open")})}),n.serializer.addNodeFilter("details",function(e){Y(e,function(e){var t=e.attr("data-mce-open");e.attr("open",K(t)?t:null),e.attr("data-mce-open",null)})})},qS=function(e){return Rn(e)&&oo(Rt.fromDom(e))},$S=function(a){a.on("click",function(e){var t,n,r,o,i;3<=e.detail&&(r=(t=a).selection.getRng(),o=Is.fromRangeStart(r),i=Is.fromRangeEnd(r),Is.isElementPosition(o)&&(n=o.container(),qS(n)&&Ll(n).each(function(e){return r.setStart(e.container(),e.offset())})),Is.isElementPosition(i)&&(n=o.container(),qS(n)&&Il(n).each(function(e){return r.setEnd(e.container(),e.offset())})),t.selection.setRng(Rg(r)))})},WS=function(e){var t=e.getBoundingClientRect(),n=e.ownerDocument,r=n.documentElement,o=n.defaultView;return{top:t.top+o.pageYOffset-r.clientTop,left:t.left+o.pageXOffset-r.clientLeft}},KS=function(e,t){return n=(u=e).inline?WS(u.getBody()):{left:0,top:0},a=(i=e).getBody(),r=i.inline?{left:a.scrollLeft,top:a.scrollTop}:{left:0,top:0},{pageX:(o=function(e,t){if(t.target.ownerDocument===e.getDoc())return{left:t.pageX,top:t.pageY};var n,r,o,i,a,u=WS(e.getContentAreaContainer()),s=(r=(n=e).getBody(),o=n.getDoc().documentElement,i={left:r.scrollLeft,top:r.scrollTop},a={left:r.scrollLeft||o.scrollLeft,top:r.scrollTop||o.scrollTop},n.inline?i:a);return{left:t.pageX-u.left+s.left,top:t.pageY-u.top+s.top}}(e,t)).left-n.left+r.left,pageY:o.top-n.top+r.top};var n,r,o,i,a,u},XS=qn,YS=Vn,GS=function(e){e&&e.parentNode&&e.parentNode.removeChild(e)},JS=function(u,s){return function(e){var t,n,r,o,i,a;0===e.button&&(t=W(s.dom.getParents(e.target),function(){for(var n=[],e=0;e<arguments.length;e++)n[e]=arguments[e];return function(e){for(var t=0;t<n.length;t++)if(n[t](e))return!0;return!1}}(XS,YS)).getOr(null),i=s.getBody(),XS(a=t)&&a!==i&&(n=s.dom.getPos(t),r=s.getBody(),o=s.getDoc().documentElement,u.set({element:t,dragging:!1,screenX:e.screenX,screenY:e.screenY,maxX:(s.inline?r.scrollWidth:o.offsetWidth)-2,maxY:(s.inline?r.scrollHeight:o.offsetHeight)-2,relX:e.pageX-n.x,relY:e.pageY-n.y,width:t.offsetWidth,height:t.offsetHeight,ghost:function(e,t,n,r){var o=e.dom,i=t.cloneNode(!0);o.setStyles(i,{width:n,height:r}),o.setAttrib(i,"data-mce-selected",null);var a=o.create("div",{"class":"mce-drag-container","data-mce-bogus":"all",unselectable:"on",contenteditable:"false"});return o.setStyles(a,{position:"absolute",opacity:.5,overflow:"hidden",border:0,padding:0,margin:0,width:n,height:r}),o.setStyles(i,{margin:0,boxSizing:"border-box"}),a.appendChild(i),a}(s,t,t.offsetWidth,t.offsetHeight)})))}},QS=function(e,h){var v=Wr.throttle(function(e,t){h._selectionOverrides.hideFakeCaret(),h.selection.placeCaretAt(e,t)},0);return h.on("remove",v.stop),function(g){return e.on(function(e){var t,n,r,o,i,a,u,s,c,l,f,d,m,p=Math.max(Math.abs(g.screenX-e.screenX),Math.abs(g.screenY-e.screenY));if(!e.dragging&&10<p){if(h.fire("dragstart",{target:e.element}).isDefaultPrevented())return;e.dragging=!0,h.focus()}e.dragging&&(d=e,t={pageX:(m=KS(h,g)).pageX-d.relX,pageY:m.pageY+5},l=e.ghost,f=h.getBody(),l.parentNode!==f&&f.appendChild(l),n=e.ghost,r=t,o=e.width,i=e.height,a=e.maxX,u=e.maxY,c=s=0,n.style.left=r.pageX+"px",n.style.top=r.pageY+"px",r.pageX+o>a&&(s=r.pageX+o-a),r.pageY+i>u&&(c=r.pageY+i-u),n.style.width=o-s+"px",n.style.height=i-c+"px",v(g.clientX,g.clientY))})}},ZS=function(e,l){return function(c){e.on(function(e){var t,n,r,o,i,a,u,s;e.dragging&&(u=(o=l).selection,s=u.getSel().getRangeAt(0).startContainer,i=3===s.nodeType?s.parentNode:s,a=e.element,i===a||o.dom.isChildOf(i,a)||XS(i)||(n=e.element,(r=n.cloneNode(!0)).removeAttribute("data-mce-selected"),t=r,l.fire("drop",{clientX:c.clientX,clientY:c.clientY}).isDefaultPrevented()||l.undoManager.transact(function(){GS(e.element),l.insertContent(l.dom.getOuterHTML(t)),l._selectionOverrides.hideFakeCaret()})))}),eN(e)}},eN=function(e){e.on(function(e){GS(e.ghost)}),e.clear()},tN=function(e){var t,n,r,o=(t=Au(U.none()),{clear:function(){return t.set(U.none())},set:function(e){return t.set(U.some(e))},isSet:function(){return t.get().isSome()},on:function(e){return t.get().each(e)}}),i=xu.DOM,a=document,u=JS(o,e),s=QS(o,e),c=ZS(o,e),l=(n=o,function(){n.on(function(e){e.dragging&&r.fire("dragend")}),eN(n)});(r=e).on("mousedown",u),e.on("mousemove",s),e.on("mouseup",c),i.bind(a,"mousemove",s),i.bind(a,"mouseup",l),e.on("remove",function(){i.unbind(a,"mousemove",s),i.unbind(a,"mouseup",l)})},nN=function(e){var n,i,a,u,t;tN(e),(n=e).on("drop",function(e){var t="undefined"!=typeof e.clientX?n.getDoc().elementFromPoint(e.clientX,e.clientY):null;!XS(t)&&"false"!==n.dom.getContentEditableParent(t)||e.preventDefault()}),e.getParam("block_unsupported_drop",!0,"boolean")&&(a=function(e){var t;e.isDefaultPrevented()||(t=e.dataTransfer)&&(M(t.types,"Files")||0<t.files.length)&&(e.preventDefault(),"drop"===e.type&&Zy(i,"Dropped file type is not supported"))},u=function(e){cm(i,e.target)&&a(e)},t=function(){var t=xu.DOM,n=i.dom,r=document,o=i.inline?i.getBody():i.getDoc(),e=["drop","dragover"];Y(e,function(e){t.bind(r,e,u),n.bind(o,e,a)}),i.on("remove",function(){Y(e,function(e){t.unbind(r,e,u),n.unbind(o,e,a)})})},(i=e).on("init",function(){Wr.setEditorTimeout(i,t,0)}))},rN=Vn,oN=qn,iN=function(e,t){return Jf(e.getBody(),t)},aN=function(u){var s,c=u.selection,l=u.dom,f=l.isBlock,d=u.getBody(),m=Fc(u,d,f,function(){return vm(u)}),p="sel-"+l.uniqueId(),i="data-mce-selected",g=function(e){return e!==d&&(oN(e)||Wn(e))&&l.isChildOf(e,d)},h=function(e){e&&c.setRng(e)},r=c.getRng,v=function(e,t,n,r){return void 0===r&&(r=!0),u.fire("ShowCaret",{target:t,direction:e,before:n}).isDefaultPrevented()?null:(r&&c.scrollIntoView(t,-1===e),m.show(n,t))},t=function(e){return Co(e)||Eo(e)||ko(e)},y=function(e){return t(e.startContainer)||t(e.endContainer)},b=function(e){var t=u.schema.getShortEndedElements(),n=l.createRng(),r=e.startContainer,o=e.startOffset,i=e.endContainer,a=e.endOffset;return ve(t,r.nodeName.toLowerCase())?0===o?n.setStartBefore(r):n.setStartAfter(r):n.setStart(r,o),ve(t,i.nodeName.toLowerCase())?0===a?n.setEndBefore(i):n.setEndAfter(i):n.setEnd(i,a),n},C=function(e){var t=e.cloneNode(!0),n=u.fire("ObjectSelected",{target:e,targetClone:t});if(n.isDefaultPrevented())return null;var r=function(e,t,n){var r=u.$,o=Pr(Rt.fromDom(u.getBody()),"#"+p).fold(function(){return r([])},function(e){return r([e.dom])});0===o.length&&(o=r('<div data-mce-bogus="all" class="mce-offscreen-selection"></div>').attr("id",p)).appendTo(u.getBody());var i=l.createRng();t===n&&xt.ie?(o.empty().append('<p style="font-size: 0" data-mce-bogus="all">\xa0</p>').append(t),i.setStartAfter(o[0].firstChild.firstChild),i.setEndAfter(t)):(o.empty().append(fo).append(t).append(fo),i.setStart(o[0].firstChild,1),i.setEnd(o[0].lastChild,0)),o.css({top:l.getPos(e,u.getBody()).y}),o[0].focus();var a=c.getSel();return a.removeAllRanges(),a.addRange(i),i}(e,n.targetClone,t),o=Rt.fromDom(e);return Y(qu(Rt.fromDom(u.getBody()),"*[data-mce-selected]"),function(e){Bt(o,e)||Zn(e,i)}),l.getAttrib(e,i)||e.setAttribute(i,"1"),s=e,S(),r},w=function(e,t){if(!e)return null;if(e.collapsed){if(!y(e)){var n=t?1:-1,r=al(n,d,e),o=r.getNode(!t);if(jc(o))return v(n,o,!!t&&!r.isAtEnd(),!1);var i=r.getNode(t);if(jc(i))return v(n,i,!t&&!r.isAtEnd(),!1)}return null}var a=e.startContainer,u=e.startOffset,s=e.endOffset;if(3===a.nodeType&&0===u&&oN(a.parentNode)&&(a=a.parentNode,u=l.nodeIndex(a),a=a.parentNode),1!==a.nodeType)return null;if(s===u+1&&a===e.endContainer){var c=a.childNodes[u];if(g(c))return C(c)}return null},x=function(){s&&s.removeAttribute(i),Pr(Rt.fromDom(u.getBody()),"#"+p).each(gn),s=null},S=function(){m.hide()};return xt.ceFalse&&function(){u.on("mouseup",function(e){var t=r();t.collapsed&&qy(u,e.clientX,e.clientY)&&rC(u,t,!1).each(h)}),u.on("click",function(e){var t=iN(u,e.target);t&&(oN(t)&&(e.preventDefault(),u.focus()),rN(t)&&l.isChildOf(t,c.getNode())&&x())}),u.on("blur NewBlock",x),u.on("ResizeWindow FullscreenStateChanged",m.reposition);var a=function(e){var t=Nl(e);if(!e.firstChild)return!1;var n,r=Is.before(e.firstChild),o=t.next(r);return o&&!(op(n=o)||ip(n)||ep(n)||tp(n))},i=function(e,t){var n,r,o=l.getParent(e,f),i=l.getParent(t,f);return!(!o||e===i||!l.isChildOf(o,i)||!1!==oN(iN(u,o)))||o&&(n=o,r=i,!(l.getParent(n,f)===l.getParent(r,f)))&&a(o)};u.on("tap",function(e){var t=e.target,n=iN(u,t);oN(n)?(e.preventDefault(),nC(u,n).each(w)):g(t)&&nC(u,t).each(w)},!0),u.on("mousedown",function(e){var t,n,r,o=e.target;o!==d&&"HTML"!==o.nodeName&&!l.isChildOf(o,d)||!1===qy(u,e.clientX,e.clientY)||((t=iN(u,o))?oN(t)?(e.preventDefault(),nC(u,t).each(w)):(x(),rN(t)&&e.shiftKey||Qf(e.clientX,e.clientY,c.getRng())||(S(),c.placeCaretAt(e.clientX,e.clientY))):g(o)?nC(u,o).each(w):!1===jc(o)&&(x(),S(),(n=nx(d,e.clientX,e.clientY))&&(i(o,n.node)||(e.preventDefault(),r=v(1,n.node,n.before,!1),u.getBody().focus(),h(r)))))}),u.on("keypress",function(e){ed.modifierPressed(e)||oN(c.getNode())&&e.preventDefault()}),u.on("GetSelectionRange",function(e){var t=e.range;if(s){if(!s.parentNode)return void(s=null);(t=t.cloneRange()).selectNode(s),e.range=t}}),u.on("SetSelectionRange",function(e){e.range=b(e.range);var t=w(e.range,e.forward);t&&(e.range=t)});var n,e,o;u.on("AfterSetSelectionRange",function(e){var t,n=e.range,r=n.startContainer.parentNode;y(n)||"mcepastebin"===r.id||S(),t=r,l.hasClass(t,"mce-offscreen-selection")||x()}),u.on("copy",function(e){var t,n,r=e.clipboardData;e.isDefaultPrevented()||!e.clipboardData||xt.ie||(t=(n=l.get(p))?n.getElementsByTagName("*")[0]:n)&&(e.preventDefault(),r.clearData(),r.setData("text/html",t.outerHTML),r.setData("text/plain",t.outerText||t.innerText))}),nN(u),e=Pu(function(){var e,t;n.removed||!n.getBody().contains(document.activeElement)||(e=n.selection.getRng()).collapsed&&(t=oC(n,e,!1),n.selection.setRng(t))},0),(n=u).on("focus",function(){e.throttle()}),n.on("blur",function(){e.cancel()}),(o=u).on("init",function(){o.on("focusin",function(e){var t,n,r=e.target;Wn(r)&&(t=Jf(o.getBody(),r),n=qn(t)?t:r,o.selection.getNode()!==n&&nC(o,n).each(function(e){return o.selection.setRng(e)}))})})}(),{showCaret:v,showBlockCaretContainer:function(e){e.hasAttribute("data-mce-caret")&&(_o(e),h(r()),c.scrollIntoView(e))},hideFakeCaret:S,destroy:function(){m.destroy(),s=null}}},uN=function(u){var s,n,r,o=_t.each,c=ed.BACKSPACE,l=ed.DELETE,f=u.dom,d=u.selection,e=u.parser,t=xt.gecko,i=xt.ie,a=xt.webkit,m="data:text/mce-internal,",p=i?"Text":"URL",g=function(e,t){try{u.getDoc().execCommand(e,!1,t)}catch(n){}},h=function(e){return e.isDefaultPrevented()},v=function(){u.shortcuts.add("meta+a",null,"SelectAll")},y=function(){u.on("keydown",function(e){if(!h(e)&&e.keyCode===c&&d.isCollapsed()&&0===d.getRng().startOffset){var t=d.getNode().previousSibling;if(t&&t.nodeName&&"table"===t.nodeName.toLowerCase())return e.preventDefault(),!1}})},b=function(){u.inline||(u.contentStyles.push("body {min-height: 150px}"),u.on("click",function(e){var t;if("HTML"===e.target.nodeName){if(11<xt.ie)return void u.getBody().focus();t=u.selection.getRng(),u.getBody().focus(),u.selection.setRng(t),u.selection.normalize(),u.nodeChanged()}}))},C=te;return u.on("keydown",function(e){var t;if(!h(e)&&e.keyCode===ed.BACKSPACE){var n=(t=d.getRng()).startContainer,r=t.startOffset,o=f.getRoot(),i=n;if(t.collapsed&&0===r){for(;i&&i.parentNode&&i.parentNode.firstChild===i&&i.parentNode!==o;)i=i.parentNode;"BLOCKQUOTE"===i.tagName&&(u.formatter.toggle("blockquote",null,i),(t=f.createRng()).setStart(n,0),t.setEnd(n,0),d.setRng(t))}}}),s=function(e){var t=f.create("body"),n=e.cloneContents();return t.appendChild(n),d.serializer.serialize(t,{format:"html"})},u.on("keydown",function(e){var t,n,r,o,i,a=e.keyCode;if(!h(e)&&(a===l||a===c)){if(t=u.selection.isCollapsed(),n=u.getBody(),t&&!f.isEmpty(n))return;if(!t&&(r=u.selection.getRng(),o=s(r),(i=f.createRng()).selectNode(u.getBody()),o!==s(i)))return;e.preventDefault(),u.setContent(""),n.firstChild&&f.isBlock(n.firstChild)?u.selection.setCursorLocation(n.firstChild,0):u.selection.setCursorLocation(n,0),u.nodeChanged()}}),xt.windowsPhone||u.on("keyup focusin mouseup",function(e){ed.modifierPressed(e)||d.normalize()},!0),a&&(u.inline||f.bind(u.getDoc(),"mousedown mouseup",function(e){var t;if(e.target===u.getDoc().documentElement)if(t=d.getRng(),u.getBody().focus(),"mousedown"===e.type){if(Co(t.startContainer))return;d.placeCaretAt(e.clientX,e.clientY)}else d.setRng(t)}),u.on("click",function(e){var t=e.target;/^(IMG|HR)$/.test(t.nodeName)&&"false"!==f.getContentEditableParent(t)&&(e.preventDefault(),u.selection.select(t),u.nodeChanged()),"A"===t.nodeName&&f.hasClass(t,"mce-item-anchor")&&(e.preventDefault(),d.select(t))}),lc(u)&&u.on("init",function(){g("DefaultParagraphSeparator",lc(u))}),u.on("init",function(){u.dom.bind(u.getBody(),"submit",function(e){e.preventDefault()})}),y(),e.addNodeFilter("br",function(e){for(var t=e.length;t--;)"Apple-interchange-newline"===e[t].attr("class")&&e[t].remove()}),xt.iOS?(u.inline||u.on("keydown",function(){document.activeElement===document.body&&u.getWin().focus()}),b(),u.on("click",function(e){var t=e.target;do{if("A"===t.tagName)return void e.preventDefault()}while(t=t.parentNode)}),u.contentStyles.push(".mce-content-body {-webkit-touch-callout: none}")):v()),11<=xt.ie&&(b(),y()),xt.ie&&(v(),g("AutoUrlDetect",!1),u.on("dragstart",function(e){var t,n,r;(t=e).dataTransfer&&(u.selection.isCollapsed()&&"IMG"===t.target.tagName&&d.select(t.target),0<(n=u.selection.getContent()).length&&(r=m+escape(u.id)+","+escape(n),t.dataTransfer.setData(p,r)))}),u.on("drop",function(e){var t,n,r,o,i,a;h(e)||(t=(i=e).dataTransfer&&(a=i.dataTransfer.getData(p))&&0<=a.indexOf(m)?(a=a.substr(m.length).split(","),{id:unescape(a[0]),html:unescape(a[1])}):null)&&t.id!==u.id&&(e.preventDefault(),n=od(e.x,e.y,u.getDoc()),d.setRng(n),r=t.html,o=!0,u.queryCommandSupported("mceInsertClipboardContent")?u.execCommand("mceInsertClipboardContent",!1,{content:r,internal:o}):u.execCommand("mceInsertContent",!1,r))})),t&&(u.on("keydown",function(e){if(!h(e)&&e.keyCode===c){if(!u.getBody().getElementsByTagName("hr").length)return;if(d.isCollapsed()&&0===d.getRng().startOffset){var t=d.getNode(),n=t.previousSibling;if("HR"===t.nodeName)return f.remove(t),void e.preventDefault();n&&n.nodeName&&"hr"===n.nodeName.toLowerCase()&&(f.remove(n),e.preventDefault())}}}),Range.prototype.getClientRects||u.on("mousedown",function(e){var t;h(e)||"HTML"!==e.target.nodeName||((t=u.getBody()).blur(),Wr.setEditorTimeout(u,function(){t.focus()}))}),n=function(){var e=f.getAttribs(d.getStart().cloneNode(!1));return function(){var t=d.getStart();t!==u.getBody()&&(f.setAttrib(t,"style",null),o(e,function(e){t.setAttributeNode(e.cloneNode(!0))}))}},r=function(){return!d.isCollapsed()&&f.getParent(d.getStart(),f.isBlock)!==f.getParent(d.getEnd(),f.isBlock)},u.on("keypress",function(e){var t;if(!h(e)&&(8===e.keyCode||46===e.keyCode)&&r())return t=n(),u.getDoc().execCommand("delete",!1,null),t(),e.preventDefault(),!1}),f.bind(u.getDoc(),"cut",function(e){var t;!h(e)&&r()&&(t=n(),Wr.setEditorTimeout(u,function(){t()}))}),u.getParam("readonly")||u.on("BeforeExecCommand mousedown",function(){g("StyleWithCSS",!1),g("enableInlineTableEditing",!1),yc(u)||g("enableObjectResizing",!1)}),u.on("SetContent ExecCommand",function(e){"setcontent"!==e.type&&"mceInsertLink"!==e.command||o(f.select("a"),function(e){var t=e.parentNode,n=f.getRoot();if(t.lastChild===e){for(;t&&!f.isBlock(t);){if(t.parentNode.lastChild!==t||t===n)return;t=t.parentNode}f.add(t,"br",{"data-mce-bogus":1})}})}),u.contentStyles.push("img:-moz-broken {-moz-force-broken-image-icon:1;min-width:24px;min-height:24px}"),xt.mac&&u.on("keydown",function(e){!ed.metaKeyPressed(e)||e.shiftKey||37!==e.keyCode&&39!==e.keyCode||(e.preventDefault(),u.selection.getSel().modify("move",37===e.keyCode?"backward":"forward","lineboundary"))}),y()),{refreshContentEditable:C,isHidden:function(){if(!t||u.removed)return!1;var e=u.selection.getSel();return!e||!e.rangeCount||0===e.rangeCount}}},sN=xu.DOM,cN=function(e){return pe(e,function(e){return!1===T(e)})},lN=function(e){var t,n=e.settings,r=e.editorUpload.blobCache;return cN({allow_conditional_comments:n.allow_conditional_comments,allow_html_data_urls:n.allow_html_data_urls,allow_svg_data_urls:n.allow_svg_data_urls,allow_html_in_named_anchor:n.allow_html_in_named_anchor,allow_script_urls:n.allow_script_urls,allow_unsafe_link_target:n.allow_unsafe_link_target,convert_fonts_to_spans:n.convert_fonts_to_spans,fix_list_elements:n.fix_list_elements,font_size_legacy_values:n.font_size_legacy_values,forced_root_block:n.forced_root_block,forced_root_block_attrs:n.forced_root_block_attrs,padd_empty_with_br:n.padd_empty_with_br,preserve_cdata:n.preserve_cdata,remove_trailing_brs:n.remove_trailing_brs,inline_styles:n.inline_styles,root_name:(t=e).inline?t.getElement().nodeName.toLowerCase():undefined,validate:!0,blob_cache:r,images_dataimg_filter:n.images_dataimg_filter})},fN=function(u){var e=u.dom.getRoot();u.inline||zf(u)&&u.selection.getStart(!0)!==e||Ll(e).each(function(e){var t,n,r,o,i=e.getNode(),a=Pn(i)?Ll(i).getOr(e):e;xt.browser.isIE()?(t=u,n=a.toRange(),r=Rt.fromDom(t.getBody()),o=(Zd(t)?U.from(n):U.none()).map(em).filter(Qd(r)),t.bookmark=o.isSome()?o:t.bookmark):u.selection.setRng(a.toRange())})},dN=function(e){var t;e.bindPendingEventDelegates(),e.initialized=!0,e.fire("Init"),e.focus(!0),fN(e),e.nodeChanged({initial:!0}),e.execCallback("init_instance_callback",e),(t=e).settings.auto_focus&&Wr.setEditorTimeout(t,function(){var e=!0===t.settings.auto_focus?t:t.editorManager.get(t.settings.auto_focus);e.destroyed||e.focus()},100)},mN=function(e){return e.inline?e.ui.styleSheetLoader:e.dom.styleSheetLoader},pN=function(e,t){var n,r,o,i,a=mN(e),u=vc(e),s=function(){a.unloadAll(t),e.inline||e.ui.styleSheetLoader.unloadAll(u)},c=function(){e.removed?s():(e.on("remove",s),dN(e))};Ir.all((n=e,r=t,o=u,i=[new Ir(function(e,t){return mN(n).loadAll(r,e,t)})],n.inline?i:i.concat([new Ir(function(e,t){return n.ui.styleSheetLoader.loadAll(o,e,t)})]))).then(c)["catch"](c)},gN=function(t,e){var n=t.settings,r=t.getDoc(),o=t.getBody();n.browser_spellcheck||n.gecko_spellcheck||(r.body.spellcheck=!1,sN.setAttrib(o,"spellcheck","false")),t.quirks=uN(t),t.fire("PostRender");var i,a,u,s,c,l,f=t.getParam("directionality",Ou.isRtl()?"rtl":undefined);f!==undefined&&(o.dir=f),n.protect&&t.on("BeforeSetContent",function(t){_t.each(n.protect,function(e){t.content=t.content.replace(e,function(e){return"\x3c!--mce:protected "+escape(e)+"--\x3e"})})}),t.on("SetContent",function(){t.addVisual(t.getBody())}),!1===e&&t.load({initial:!0,format:"html"}),t.startContent=t.getContent({format:"raw"}),t.on("compositionstart compositionend",function(e){t.composing="compositionstart"===e.type}),0<t.contentStyles.length&&(i="",_t.each(t.contentStyles,function(e){i+=e+"\r\n"}),t.dom.addStyle(i)),pN(t,t.contentCSS),n.content_style&&(a=t,u=n.content_style,s=Rt.fromDom(a.getBody()),c=an(on(s)),l=Rt.fromTag("style"),Yn(l,"type","text/css"),dn(l,Rt.fromText(u)),dn(c,l),a.on("remove",function(){gn(l)}))},hN=function(t,e){var n=t.settings,r=t.getElement(),o=t.getDoc();n.inline||(t.getElement().style.visibility=t.orgVisibility),e||t.inline||(o.open(),o.write(t.iframeHTML),o.close()),t.inline&&(sN.addClass(r,"mce-content-body"),t.contentDocument=o=document,t.contentWindow=window,t.bodyElement=r,t.contentAreaContainer=r);var u,i,a,s,c=t.getBody();c.disabled=!0,t.readonly=!!n.readonly,t.readonly||(t.inline&&"static"===sN.getStyle(c,"position",!0)&&(c.style.position="relative"),c.contentEditable=t.getParam("content_editable_state",!0)),c.disabled=!1,t.editorUpload=mb(t),t.schema=Ci(n),t.dom=xu(o,{keep_values:!0,url_converter:t.convertURL,url_converter_scope:t,hex_colors:n.force_hex_style_colors,update_styles:!0,root_element:t.inline?t.getBody():null,collect:function(){return t.inline},schema:t.schema,contentCssCors:t.getParam("content_css_cors",!1,"boolean"),referrerPolicy:pc(t),onSetAttrib:function(e){t.fire("SetAttrib",e)}}),t.parser=((i=uy(lN(u=t),u.schema)).addAttributeFilter("src,href,style,tabindex",function(e,t){for(var n,r,o=e.length,i=u.dom,a="data-mce-"+t;o--;)if((r=(n=e[o]).attr(t))&&!n.attr(a)){if(0===r.indexOf("data:")||0===r.indexOf("blob:"))continue;"style"===t?((r=i.serializeStyle(i.parseStyle(r),n.name)).length||(r=null),n.attr(a,r),n.attr(t,r)):"tabindex"===t?(n.attr(a,r),n.attr(t,null)):n.attr(a,u.convertURL(r,t,n.name))}}),i.addNodeFilter("script",function(e){for(var t=e.length;t--;){var n=e[t],r=n.attr("type")||"no/type";0!==r.indexOf("mce-")&&n.attr("type","mce-"+r)}}),u.settings.preserve_cdata&&i.addNodeFilter("#cdata",function(e){for(var t=e.length;t--;){var n=e[t];n.type=8,n.name="#comment",n.value="[CDATA["+u.dom.encode(n.value)+"]]"}}),i.addNodeFilter("p,h1,h2,h3,h4,h5,h6,div",function(e){for(var t=e.length,n=u.schema.getNonEmptyElements();t--;){var r=e[t];r.isEmpty(n)&&0===r.getAll("br").length&&(r.append(new Am("br",1)).shortEnded=!0)}}),i),t.serializer=dy((s=(a=t).settings,_e(_e({},lN(a)),cN({url_converter:s.url_converter,url_converter_scope:s.url_converter_scope,element_format:s.element_format,entities:s.entities,entity_encoding:s.entity_encoding,indent:s.indent,indent_after:s.indent_after,indent_before:s.indent_before,block_elements:s.block_elements,boolean_attributes:s.boolean_attributes,custom_elements:s.custom_elements,extended_valid_elements:s.extended_valid_elements,invalid_elements:s.invalid_elements,invalid_styles:s.invalid_styles,move_caret_before_on_enter_elements:s.move_caret_before_on_enter_elements,non_empty_elements:s.non_empty_elements,schema:s.schema,self_closing_elements:s.self_closing_elements,short_ended_elements:s.short_ended_elements,special:s.special,text_block_elements:s.text_block_elements,text_inline_elements:s.text_inline_elements,valid_children:s.valid_children,valid_classes:s.valid_classes,valid_elements:s.valid_elements,valid_styles:s.valid_styles,verify_html:s.verify_html,whitespace_elements:s.whitespace_elements}))),t),t.selection=Hv(t.dom,t.getWin(),t.serializer,t),t.annotator=Yf(t),t.formatter=Cb(t),t.undoManager=xb(t),t._nodeChangeDispatcher=new jS(t),t._selectionOverrides=aN(t),Ew(t),VS(t),Rv(t)||$S(t);var l,f,d=Rv(l=t)?Au(null):zS(l);Sw(t,d),lc(f=t)&&f.on("NodeChange",N(_w,f)),_b(t),t.fire("PreInit"),Tv(t).fold(function(){gN(t,!1)},function(e){t.setProgressState(!0),e.then(function(e){t.setProgressState(!1),gN(t,e)},function(e){t.notificationManager.open({type:"error",text:String(e)}),gN(t,!0)})})},vN=xu.DOM,yN=function(e){var t=e.getParam("doctype","<!DOCTYPE html>")+"<html><head>";e.getParam("document_base_url","")!==e.documentBaseUrl&&(t+='<base href="'+e.documentBaseURI.getURI()+'" />'),t+='<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';var n=sc(e,"body_id","tinymce"),r=sc(e,"body_class","");return cc(e)&&(t+='<meta http-equiv="Content-Security-Policy" content="'+cc(e)+'" />'),t+='</head><body id="'+n+'" class="mce-content-body '+r+'" data-id="'+e.id+'"><br></body></html>'},bN=function(e,t){var n,r,o,i,a=e.editorManager.translate("Rich Text Area. Press ALT-0 for help."),u=(n=e.id,r=a,t.height,o=e.getParam("iframe_attrs",{}),i=Rt.fromTag("iframe"),Gn(i,o),Gn(i,{id:n+"_ifr",frameBorder:"0",allowTransparency:"true",title:r}),zu(i,"tox-edit-area__iframe"),i.dom);u.onload=function(){u.onload=null,e.fire("load")};var s=function(e,t){if(document.domain!==window.location.hostname&&xt.browser.isIE()){var n=cb("mce");e[n]=function(){hN(e)};var r='javascript:(function(){document.open();document.domain="'+document.domain+'";var ed = window.parent.tinymce.get("'+e.id+'");document.write(ed.iframeHTML);document.close();ed.'+n+"(true);})()";return vN.setAttrib(t,"src",r),!0}return!1}(e,u);return e.contentAreaContainer=t.iframeContainer,e.iframeElement=u,e.iframeHTML=yN(e),vN.add(t.iframeContainer,u),s},CN=xu.DOM,wN=function(t,n,e){var r=Ky.get(e),o=Ky.urls[e]||t.documentBaseUrl.replace(/\/$/,"");if(e=_t.trim(e),r&&-1===_t.inArray(n,e)){if(_t.each(Ky.dependencies(e),function(e){wN(t,n,e)}),t.plugins[e])return;try{var i=new r(t,o,t.$);(t.plugins[e]=i).init&&(i.init(t,o),n.push(e))}catch(_k){!function(e,t,n){var r=Ou.translate(["Failed to initialize plugin: {0}",t]);Zf(e,"PluginLoadError",{message:r}),rb(r,n),Zy(e,r)}(t,e,_k)}}},xN=function(e){return e.replace(/^\-/,"")},SN=function(e){return{editorContainer:e,iframeContainer:e,api:{}}},NN=function(e){var t,n,r=e.getElement();return e.inline?SN(null):(t=r,n=CN.create("div"),CN.insertAfter(n,t),SN(n))},EN=function(e){var t,n,r,o=e.getElement();return e.orgDisplay=o.style.display,K(Cc(e))?e.theme.renderUI():D(Cc(e))?(n=(t=e).getElement(),(r=Cc(t)(t,n)).editorContainer.nodeType&&(r.editorContainer.id=r.editorContainer.id||t.id+"_parent"),r.iframeContainer&&r.iframeContainer.nodeType&&(r.iframeContainer.id=r.iframeContainer.id||t.id+"_iframecontainer"),r.height=r.iframeHeight?r.iframeHeight:n.offsetHeight,r):NN(e)},kN=function(e){var n,t,r,o,i,a,u,s,c;e.fire("ScriptsLoaded"),n=e,t=_t.trim(mc(n)),r=n.ui.registry.getAll().icons,o=_e(_e({},My.get("default").icons),My.get(t).icons),se(o,function(e,t){ve(r,t)||n.ui.registry.addIcon(t,e)}),u=Cc(i=e),K(u)?(i.settings.theme=xN(u),a=Xy.get(u),i.theme=new a(i,Xy.urls[u]),i.theme.init&&i.theme.init(i,Xy.urls[u]||i.documentBaseUrl.replace(/\/$/,""),i.$)):i.theme={},s=e,c=[],_t.each(xc(s).split(/[ ,]/),function(e){wN(s,c,xN(e))});var l,f,d,m=EN(e);l=e,f=U.from(m.api).getOr({}),d={show:U.from(f.show).getOr(te),hide:U.from(f.hide).getOr(te),disable:U.from(f.disable).getOr(te),isDisabled:U.from(f.isDisabled).getOr(b),enable:function(){l.mode.isReadOnly()||U.from(f.enable).map(y)}},l.ui=_e(_e({},l.ui),d);var p,g,h,v={editorContainer:m.editorContainer,iframeContainer:m.iframeContainer};return e.editorContainer=v.editorContainer?v.editorContainer:null,ab(e),e.inline?hN(e):(h=bN(p=e,g=v),g.editorContainer&&(vN.get(g.editorContainer).style.display=p.orgDisplay,p.hidden=vN.isHidden(g.editorContainer)),p.getElement().style.display="none",vN.setAttrib(p.id,"aria-hidden","true"),void(h||hN(p)))},_N=xu.DOM,AN=function(e){return"-"===e.charAt(0)},RN=function(e,t){var n,r=gc(t),o=t.getParam("language_url","","string");!1===Ou.hasCode(r)&&"en"!==r&&(n=""!==o?o:t.editorManager.baseURL+"/langs/"+r+".js",e.add(n,te,undefined,function(){eb(t,"LanguageLoadError",tb("language",n,r))}))},TN=function(t,e,n){return U.from(e).filter(function(e){return 0<e.length&&!My.has(e)}).map(function(e){return{url:t.editorManager.baseURL+"/icons/"+e+"/icons"+n+".js",name:U.some(e)}})},DN=function(e,o,t){var n,r=TN(o,"default",t),i=(n=o,U.from(n.getParam("icons_url","","string")).filter(function(e){return 0<e.length}).map(function(e){return{url:e,name:U.none()}}).orThunk(function(){return TN(o,mc(o),"")}));Y(function(e){for(var t=[],n=function(e){t.push(e)},r=0;r<e.length;r++)e[r].each(n);return t}([r,i]),function(r){e.add(r.url,te,undefined,function(){var e,t,n;e=o,t=r.url,n=r.name.getOrUndefined(),eb(e,"IconsLoadError",tb("icons",t,n))})})},ON=function(e,t){var n,r,o,i,a,u,s=ku.ScriptLoader;n=s,o=t,i=function(){var r,o;RN(s,e),DN(s,e,t),r=e,o=t,_t.each(r.getParam("external_plugins"),function(e,t){Ky.load(t,e,te,undefined,function(){nb(r,e,t)}),r.settings.plugins+=" "+t}),_t.each(xc(r).split(/[ ,]/),function(e){var t,n;(e=_t.trim(e))&&!Ky.urls[e]&&(AN(e)?(e=e.substr(1,e.length),t=Ky.dependencies(e),_t.each(t,function(e){var t={prefix:"plugins/",resource:e,suffix:"/plugin"+o+".js"},n=Ky.createUrl(t,e);Ky.load(n.resource,n,te,undefined,function(){nb(r,n.prefix+n.resource+n.suffix,n.resource)})})):(n={prefix:"plugins/",resource:e,suffix:"/plugin"+o+".js"},Ky.load(e,n,te,undefined,function(){nb(r,n.prefix+n.resource+n.suffix,e)})))}),s.loadQueue(function(){e.removed||kN(e)},e,function(){e.removed||kN(e)})},u=Cc(r=e),K(u)?(AN(u)||Xy.urls.hasOwnProperty(u)||((a=r.getParam("theme_url"))?Xy.load(u,r.documentBaseURI.toAbsolute(a)):Xy.load(u,"themes/"+u+"/theme"+o+".js")),n.loadQueue(function(){Xy.waitFor(u,i)})):i()},BN=function(t){var e=t.id;Ou.setCode(gc(t));var n,r,o,i,a,u=function(){_N.unbind(window,"ready",u),t.render()};Ti.Event.domLoaded?t.getElement()&&xt.contentEditable&&(n=Rt.fromDom(t.getElement()),r=$(n.dom.attributes,function(e,t){return e[t.name]=t.value,e},{}),t.on("remove",function(){j(n.dom.attributes,function(e){return Zn(n,e.name),0}),Gn(n,r)}),t.ui.styleSheetLoader=(o=n,i=t,Xr.forElement(o,{contentCssCors:i.getParam("content_css_cors"),referrerPolicy:pc(i)})),t.getParam("inline")?t.inline=!0:(t.orgVisibility=t.getElement().style.visibility,t.getElement().style.visibility="hidden"),(a=t.getElement().form||_N.getParent(e,"form"))&&(t.formElement=a,t.getParam("hidden_input")&&!In(t.getElement())&&(_N.insertAfter(_N.create("input",{type:"hidden",name:e}),e),t.hasHiddenInput=!0),t.formEventDelegate=function(e){t.fire(e.type,e)},_N.bind(a,"submit reset",t.formEventDelegate),t.on("reset",function(){t.resetContent()}),!t.getParam("submit_patch")||a.submit.nodeType||a.submit.length||a._mceOldSubmit||(a._mceOldSubmit=a.submit,a.submit=function(){return t.editorManager.triggerSave(),t.setDirty(!1),a._mceOldSubmit(a)})),t.windowManager=Jy(t),t.notificationManager=Wy(t),"xml"===t.getParam("encoding")&&t.on("GetContent",function(e){e.save&&(e.content=_N.encode(e.content))}),t.getParam("add_form_submit_trigger")&&t.on("submit",function(){t.initialized&&t.save()}),t.getParam("add_unload_trigger")&&(t._beforeUnload=function(){!t.initialized||t.destroyed||t.isHidden()||t.save({format:"raw",no_events:!0,set_dirty:!1})},t.editorManager.on("BeforeUnload",t._beforeUnload)),t.editorManager.add(t),ON(t,t.suffix)):_N.bind(window,"ready",u)},PN=function(e,t){return n=t,Ov(e).editor.addVisual(n);var n},LN={"font-size":"size","font-family":"face"},IN=function(n,t,e){return Xg(Rt.fromDom(e),function(e){return rr(t=e,n).orThunk(function(){return"font"===It(t)?he(LN,n).bind(function(e){return Qn(t,e)}):U.none()});var t},function(e){return Bt(Rt.fromDom(t),e)})},MN=function(o){return function(r,e){return U.from(e).map(Rt.fromDom).filter(Ut).bind(function(e){return IN(o,r,e.dom).or((t=o,n=e.dom,U.from(xu.DOM.getStyle(n,t,!0))));var t,n}).getOr("")}},FN=MN("font-size"),UN=a(function(e){return e.replace(/[\'\"\\]/g,"").replace(/,\s+/g,",")},MN("font-family")),zN=function(e){return Ll(e.getBody()).map(function(e){var t=e.container();return Mn(t)?t.parentNode:t})},jN=function(e,t){return n=e,U.from(n.selection.getRng()).bind(function(e){var t=n.getBody();return e.startContainer===t&&0===e.startOffset?U.none():U.from(n.selection.getStart(!0))}).orThunk(N(zN,e)).map(Rt.fromDom).filter(Ut).map(t);var n},HN=function(e,t){if(/^[0-9.]+$/.test(t)){var n=parseInt(t,10);if(1<=n&&n<=7){var r=(a=e,_t.explode(a.getParam("font_size_style_values","xx-small,x-small,small,medium,large,x-large,xx-large"))),o=(i=e,_t.explode(i.getParam("font_size_classes","")));return o?o[n-1]||t:r[n-1]||t}return t}return t;var i,a},VN=function(e,t){var n,r=HN(e,t);e.formatter.toggle("fontname",{value:(n=r.split(/\s*,\s*/),z(n,function(e){return-1===e.indexOf(" ")||qe(e,'"')||qe(e,"'")?e:"'"+e+"'"}).join(","))}),e.nodeChanged()},qN=function(e,t){var n,r,o,i,a="string"!=typeof(n=t)?(r=_t.extend({paste:n.paste,data:{paste:n.paste}},n),{content:n.content,details:r}):{content:n,details:{}};o=a.content,i=a.details,Dv(e).editor.insertContent(o,i)},$N=_t.each,WN=_t.map,KN=_t.inArray,XN=(YN.prototype.execCommand=function(t,n,r,e){var o,i,a=!1,u=this;if(!u.editor.removed){if(/^(mceAddUndoLevel|mceEndUndoLevel|mceBeginUndoLevel|mceRepaint)$/.test(t)||e&&e.skip_focus?(i=u.editor,om(i).each(function(e){return i.selection.setRng(e)})):u.editor.focus(),(e=u.editor.fire("BeforeExecCommand",{command:t,ui:n,value:r})).isDefaultPrevented())return!1;var s=t.toLowerCase();if(o=u.commands.exec[s])return o(s,n,r),u.editor.fire("ExecCommand",{command:t,ui:n,value:r}),!0;if($N(this.editor.plugins,function(e){if(e.execCommand&&e.execCommand(t,n,r))return u.editor.fire("ExecCommand",{command:t,ui:n,value:r}),!(a=!0)}),a)return a;if(u.editor.theme&&u.editor.theme.execCommand&&u.editor.theme.execCommand(t,n,r))return u.editor.fire("ExecCommand",{command:t,ui:n,value:r}),!0;try{a=u.editor.getDoc().execCommand(t,n,r)}catch(c){}return!!a&&(u.editor.fire("ExecCommand",{command:t,ui:n,value:r}),!0)}},YN.prototype.queryCommandState=function(e){var t;if(!this.editor.quirks.isHidden()&&!this.editor.removed){if(e=e.toLowerCase(),t=this.commands.state[e])return t(e);try{return this.editor.getDoc().queryCommandState(e)}catch(n){}return!1}},YN.prototype.queryCommandValue=function(e){var t;if(!this.editor.quirks.isHidden()&&!this.editor.removed){if(e=e.toLowerCase(),t=this.commands.value[e])return t(e);try{return this.editor.getDoc().queryCommandValue(e)}catch(n){}}},YN.prototype.addCommands=function(e,n){void 0===n&&(n="exec");var r=this;$N(e,function(t,e){$N(e.toLowerCase().split(","),function(e){r.commands[n][e]=t})})},YN.prototype.addCommand=function(e,o,i){var a=this;e=e.toLowerCase(),this.commands.exec[e]=function(e,t,n,r){return o.call(i||a.editor,t,n,r)}},YN.prototype.queryCommandSupported=function(e){if(e=e.toLowerCase(),this.commands.exec[e])return!0;try{return this.editor.getDoc().queryCommandSupported(e)}catch(t){}return!1},YN.prototype.addQueryStateHandler=function(e,t,n){var r=this;e=e.toLowerCase(),this.commands.state[e]=function(){return t.call(n||r.editor)}},YN.prototype.addQueryValueHandler=function(e,t,n){var r=this;e=e.toLowerCase(),this.commands.value[e]=function(){return t.call(n||r.editor)}},YN.prototype.hasCustomCommand=function(e){return e=e.toLowerCase(),!!this.commands.exec[e]},YN.prototype.execNativeCommand=function(e,t,n){return t===undefined&&(t=!1),n===undefined&&(n=null),this.editor.getDoc().execCommand(e,t,n)},YN.prototype.isFormatMatch=function(e){return this.editor.formatter.match(e)},YN.prototype.toggleFormat=function(e,t){this.editor.formatter.toggle(e,t?{value:t}:undefined),this.editor.nodeChanged()},YN.prototype.storeSelection=function(e){this.selectionBookmark=this.editor.selection.getBookmark(e)},YN.prototype.restoreSelection=function(){this.editor.selection.moveToBookmark(this.selectionBookmark)},YN.prototype.setupCommands=function(i){var a=this;this.addCommands({"mceResetDesignMode,mceBeginUndoLevel":te,"mceEndUndoLevel,mceAddUndoLevel":function(){i.undoManager.add()},"Cut,Copy,Paste":function(e){var t,n,r=i.getDoc();try{a.execNativeCommand(e)}catch(o){t=!0}"paste"!==e||r.queryCommandEnabled(e)||(t=!0),!t&&r.queryCommandSupported(e)||(n=i.translate("Your browser doesn't support direct access to the clipboard. Please use the Ctrl+X/C/V keyboard shortcuts instead."),xt.mac&&(n=n.replace(/Ctrl\+/g,"\u2318+")),i.notificationManager.open({text:n,type:"error"}))},unlink:function(){var e;i.selection.isCollapsed()?(e=i.dom.getParent(i.selection.getStart(),"a"))&&i.dom.remove(e,!0):i.formatter.remove("link")},"JustifyLeft,JustifyCenter,JustifyRight,JustifyFull,JustifyNone":function(e){var t=e.substring(7);"full"===t&&(t="justify"),$N("left,center,right,justify".split(","),function(e){t!==e&&i.formatter.remove("align"+e)}),"none"!==t&&a.toggleFormat("align"+t)},"InsertUnorderedList,InsertOrderedList":function(e){var t;a.execNativeCommand(e);var n=i.dom.getParent(i.selection.getNode(),"ol,ul");n&&(t=n.parentNode,/^(H[1-6]|P|ADDRESS|PRE)$/.test(t.nodeName)&&(a.storeSelection(),i.dom.split(t,n),a.restoreSelection()))},"Bold,Italic,Underline,Strikethrough,Superscript,Subscript":function(e){a.toggleFormat(e)},"ForeColor,HiliteColor":function(e,t,n){a.toggleFormat(e,n)},FontName:function(e,t,n){VN(i,n)},FontSize:function(e,t,n){var r,o;o=n,(r=i).formatter.toggle("fontsize",{value:HN(r,o)}),r.nodeChanged()},LineHeight:function(e,t,n){var r,o;o=n,(r=i).undoManager.transact(function(){r.formatter.toggle("lineheight",{value:String(o)}),r.nodeChanged()})},RemoveFormat:function(e){i.formatter.remove(e)},mceBlockQuote:function(){a.toggleFormat("blockquote")},FormatBlock:function(e,t,n){return a.toggleFormat(n||"p")},mceCleanup:function(){var e=i.selection.getBookmark();i.setContent(i.getContent()),i.selection.moveToBookmark(e)},mceRemoveNode:function(e,t,n){var r=n||i.selection.getNode();r!==i.getBody()&&(a.storeSelection(),i.dom.remove(r,!0),a.restoreSelection())},mceSelectNodeDepth:function(e,t,n){var r=0;i.dom.getParent(i.selection.getNode(),function(e){if(1===e.nodeType&&r++===n)return i.selection.select(e),!1},i.getBody())},mceSelectNode:function(e,t,n){i.selection.select(n)},mceInsertContent:function(e,t,n){qN(i,n)},mceInsertRawHTML:function(e,t,n){i.selection.setContent("tiny_mce_marker");var r=i.getContent();i.setContent(r.replace(/tiny_mce_marker/g,function(){return n}))},mceInsertNewLine:function(e,t,n){RS(i,n)},mceToggleFormat:function(e,t,n){a.toggleFormat(n)},mceSetContent:function(e,t,n){i.setContent(n)},"Indent,Outdent":function(e){Cw(i,e)},mceRepaint:te,InsertHorizontalRule:function(){i.execCommand("mceInsertContent",!1,"<hr />")},mceToggleVisualAid:function(){i.hasVisual=!i.hasVisual,i.addVisual()},mceReplaceContent:function(e,t,n){i.execCommand("mceInsertContent",!1,n.replace(/\{\$selection\}/g,i.selection.getContent({format:"text"})))},mceInsertLink:function(e,t,n){"string"==typeof n&&(n={href:n});var r=i.dom.getParent(i.selection.getNode(),"a");n.href=n.href.replace(/ /g,"%20"),r&&n.href||i.formatter.remove("link"),n.href&&i.formatter.apply("link",n,r)},selectAll:function(){var e,t=i.dom.getParent(i.selection.getStart(),Vn);t&&((e=i.dom.createRng()).selectNodeContents(t),i.selection.setRng(e))},mceNewDocument:function(){i.setContent("")},InsertLineBreak:function(e,t,n){return gS(i,n),!0}});var e=function(r){return function(){var e=i.selection,t=e.isCollapsed()?[i.dom.getParent(e.getNode(),i.dom.isBlock)]:e.getSelectedBlocks(),n=WN(t,function(e){return!!i.formatter.matchNode(e,r)});return-1!==KN(n,!0)}};a.addCommands({JustifyLeft:e("alignleft"),JustifyCenter:e("aligncenter"),JustifyRight:e("alignright"),JustifyFull:e("alignjustify"),"Bold,Italic,Underline,Strikethrough,Superscript,Subscript":function(e){return a.isFormatMatch(e)},mceBlockQuote:function(){return a.isFormatMatch("blockquote")},Outdent:function(){return vw(i)},"InsertUnorderedList,InsertOrderedList":function(e){var t=i.dom.getParent(i.selection.getNode(),"ul,ol");return t&&("insertunorderedlist"===e&&"UL"===t.tagName||"insertorderedlist"===e&&"OL"===t.tagName)}},"state"),a.addCommands({Undo:function(){i.undoManager.undo()},Redo:function(){i.undoManager.redo()}}),a.addQueryValueHandler("FontName",function(){return jN(t=i,function(e){return UN(t.getBody(),e.dom)}).getOr("");var t},this),a.addQueryValueHandler("FontSize",function(){return jN(t=i,function(e){return FN(t.getBody(),e.dom)}).getOr("");var t},this),a.addQueryValueHandler("LineHeight",function(){return jN(t=i,function(n){var e=Rt.fromDom(t.getBody());return Xg(n,function(e){return rr(e,"line-height")},N(Bt,e)).getOrThunk(function(){var e=parseFloat(tr(n,"line-height")),t=parseFloat(tr(n,"font-size"));return String(e/t)})}).getOr("");var t},this)},YN);function YN(e){this.commands={state:{},exec:{},value:{}},this.editor=e,this.setupCommands(e)}var GN="data-mce-contenteditable",JN=function(e,t,n){var r,o;Hu(e,t)&&!1===n?(o=t,Mu(r=e)?r.dom.classList.remove(o):Uu(r,o),ju(r)):n&&zu(e,t)},QN=function(e,t,n){try{e.getDoc().execCommand(t,!1,String(n))}catch(r){}},ZN=function(e,t){e.dom.contentEditable=t?"true":"false"},eE=function(e,t){var n,r,o,i=Rt.fromDom(e.getBody());JN(i,"mce-content-readonly",t),t?(e.selection.controlSelection.hideResizeRect(),e._selectionOverrides.hideFakeCaret(),o=e,U.from(o.selection.getNode()).each(function(e){e.removeAttribute("data-mce-selected")}),e.readonly=!0,ZN(i,!1),Y(qu(i,'*[contenteditable="true"]'),function(e){Yn(e,GN,"true"),ZN(e,!1)})):(e.readonly=!1,ZN(i,!0),Y(qu(i,"*["+GN+'="true"]'),function(e){Zn(e,GN),ZN(e,!0)}),QN(e,"StyleWithCSS",!1),QN(e,"enableInlineTableEditing",!1),QN(e,"enableObjectResizing",!1),(vm(r=e)||hm(r))&&e.focus(),(n=e).selection.setRng(n.selection.getRng()),e.nodeChanged())},tE=function(e){return e.readonly},nE=function(t){t.parser.addAttributeFilter("contenteditable",function(e){tE(t)&&Y(e,function(e){e.attr(GN,e.attr("contenteditable")),e.attr("contenteditable","false")})}),t.serializer.addAttributeFilter(GN,function(e){tE(t)&&Y(e,function(e){e.attr("contenteditable",e.attr(GN))})}),t.serializer.addTempAttr(GN)},rE=function(a,u){var e,t;"click"!==u.type||ed.metaKeyPressed(u)||(e=Rt.fromDom(u.target),t=a,Lr(e,"a",function(e){return Bt(e,Rt.fromDom(t.getBody()))}).bind(function(e){return Qn(e,"href")}).each(function(e){var t,n,r,o,i;u.preventDefault(),/^#/.test(e)?(t=a.dom.select(e+',[name="'+(qe(n=e,r="#")?(o=n,i=r.length,o.substring(i)):n)+'"]')).length&&a.selection.scrollIntoView(t[0],!0):window.open(e,"_blank","rel=noopener noreferrer,menubar=yes,toolbar=yes,location=yes,status=yes,resizable=yes,scrollbars=yes")}))},oE=_t.makeMap("focus blur focusin focusout click dblclick mousedown mouseup mousemove mouseover beforepaste paste cut copy selectionchange mouseout mouseenter mouseleave wheel keydown keypress keyup input beforeinput contextmenu dragstart dragend dragover draggesture dragdrop drop drag submit compositionstart compositionend compositionupdate touchstart touchmove touchend touchcancel"," "),iE=(aE.isNative=function(e){return!!oE[e.toLowerCase()]},aE.prototype.fire=function(e,t){var n=e.toLowerCase(),r=t||{};r.type=n,r.target||(r.target=this.scope),r.preventDefault||(r.preventDefault=function(){r.isDefaultPrevented=w},r.stopPropagation=function(){r.isPropagationStopped=w},r.stopImmediatePropagation=function(){r.isImmediatePropagationStopped=w},r.isDefaultPrevented=b,r.isPropagationStopped=b,r.isImmediatePropagationStopped=b),this.settings.beforeFire&&this.settings.beforeFire(r);var o=this.bindings[n];if(o)for(var i=0,a=o.length;i<a;i++){var u=o[i];if(u.once&&this.off(n,u.func),r.isImmediatePropagationStopped())return r.stopPropagation(),r;if(!1===u.func.call(this.scope,r))return r.preventDefault(),r}return r},aE.prototype.on=function(e,t,n,r){if(!1===t&&(t=b),t){var o={func:t};r&&_t.extend(o,r);for(var i=e.toLowerCase().split(" "),a=i.length;a--;){var u=i[a],s=this.bindings[u];s||(s=this.bindings[u]=[],this.toggleEvent(u,!0)),n?s.unshift(o):s.push(o)}}return this},aE.prototype.off=function(e,t){var n=this;if(e)for(var r=e.toLowerCase().split(" "),o=r.length;o--;){var i=r[o],a=this.bindings[i];if(!i)return se(this.bindings,function(e,t){n.toggleEvent(t,!1),delete n.bindings[t]}),this;if(a){if(t)for(var u=a.length;u--;)a[u].func===t&&(a=a.slice(0,u).concat(a.slice(u+1)),this.bindings[i]=a);else a.length=0;a.length||(this.toggleEvent(e,!1),delete this.bindings[i])}}else se(this.bindings,function(e,t){n.toggleEvent(t,!1)}),this.bindings={};return this},aE.prototype.once=function(e,t,n){return this.on(e,t,n,{once:!0})},aE.prototype.has=function(e){return e=e.toLowerCase(),!(!this.bindings[e]||0===this.bindings[e].length)},aE);function aE(e){this.bindings={},this.settings=e||{},this.scope=this.settings.scope||this,this.toggleEvent=this.settings.toggleEvent||b}var uE,sE=function(n){return n._eventDispatcher||(n._eventDispatcher=new iE({scope:n,toggleEvent:function(e,t){iE.isNative(e)&&n.toggleNativeEvent&&n.toggleNativeEvent(e,t)}})),n._eventDispatcher},cE={fire:function(e,t,n){if(this.removed&&"remove"!==e&&"detach"!==e)return t;var r=sE(this).fire(e,t);if(!1!==n&&this.parent)for(var o=this.parent();o&&!r.isPropagationStopped();)o.fire(e,r,!1),o=o.parent();return r},on:function(e,t,n){return sE(this).on(e,t,n)},off:function(e,t){return sE(this).off(e,t)},once:function(e,t){return sE(this).once(e,t)},hasEventListeners:function(e){return sE(this).has(e)}},lE=xu.DOM,fE=function(e,t){if("selectionchange"===t)return e.getDoc();if(!e.inline&&/^mouse|touch|click|contextmenu|drop|dragover|dragend/.test(t))return e.getDoc().documentElement;var n=bc(e);return n?(e.eventRoot||(e.eventRoot=lE.select(n)[0]),e.eventRoot):e.getBody()},dE=function(e,t,n){var r;(r=e).hidden||tE(r)?tE(e)&&rE(e,n):e.fire(t,n)},mE=function(i,a){var e;if(i.delegates||(i.delegates={}),!i.delegates[a]&&!i.removed){var t=fE(i,a);if(bc(i)){if(uE||(uE={},i.editorManager.on("removeEditor",function(){i.editorManager.activeEditor||uE&&(se(uE,function(e,t){i.dom.unbind(fE(i,t))}),uE=null)})),uE[a])return;e=function(e){for(var t=e.target,n=i.editorManager.get(),r=n.length;r--;){var o=n[r].getBody();o!==t&&!lE.isChildOf(t,o)||dE(n[r],a,e)}},uE[a]=e,lE.bind(t,a,e)}else e=function(e){dE(i,a,e)},lE.bind(t,a,e),i.delegates[a]=e}},pE=_e(_e({},cE),{bindPendingEventDelegates:function(){var t=this;_t.each(t._pendingNativeEvents,function(e){mE(t,e)})},toggleNativeEvent:function(e,t){var n=this;"focus"!==e&&"blur"!==e&&(t?n.initialized?mE(n,e):n._pendingNativeEvents?n._pendingNativeEvents.push(e):n._pendingNativeEvents=[e]:n.initialized&&(n.dom.unbind(fE(n,e),e,n.delegates[e]),delete n.delegates[e]))},unbindAllNativeEvents:function(){var n=this,e=n.getBody(),t=n.dom;n.delegates&&(se(n.delegates,function(e,t){n.dom.unbind(fE(n,t),t,e)}),delete n.delegates),!n.inline&&e&&t&&(e.onload=null,t.unbind(n.getWin()),t.unbind(n.getDoc())),t&&(t.unbind(e),t.unbind(n.getContainer()))}}),gE=["design","readonly"],hE=function(e,t,n,r){var o,i=n[t.get()],a=n[r];try{a.activate()}catch(_k){return void console.error("problem while activating editor mode "+r+":",_k)}i.deactivate(),i.editorReadOnly!==a.editorReadOnly&&eE(e,a.editorReadOnly),t.set(r),o=r,e.fire("SwitchMode",{mode:o})},vE=function(t){var e,n,r=Au("design"),o=Au({design:{activate:te,deactivate:te,editorReadOnly:!1},readonly:{activate:te,deactivate:te,editorReadOnly:!0}});return(e=t).serializer?nE(e):e.on("PreInit",function(){nE(e)}),(n=t).on("ShowCaret",function(e){tE(n)&&e.preventDefault()}),n.on("ObjectSelected",function(e){tE(n)&&e.preventDefault()}),{isReadOnly:function(){return tE(t)},set:function(e){return function(e,t,n,r){if(r!==n.get()){if(!ve(t,r))throw new Error("Editor mode '"+r+"' is invalid");e.initialized?hE(e,n,t,r):e.on("init",function(){return hE(e,n,t,r)})}}(t,o.get(),r,e)},get:function(){return r.get()},register:function(e,t){o.set(function(e,t,n){var r;if(M(gE,t))throw new Error("Cannot override default mode "+t);return _e(_e({},e),((r={})[t]=_e(_e({},n),{deactivate:function(){try{n.deactivate()}catch(_k){console.error("problem while deactivating editor mode "+t+":",_k)}}}),r))}(o.get(),e,t))}}},yE=_t.each,bE=_t.explode,CE={f1:112,f2:113,f3:114,f4:115,f5:116,f6:117,f7:118,f8:119,f9:120,f10:121,f11:122,f12:123},wE=_t.makeMap("alt,ctrl,shift,meta,access"),xE=function(e){var t,n={};yE(bE(e.toLowerCase(),"+"),function(e){e in wE?n[e]=!0:/^[0-9]{2,}$/.test(e)?n.keyCode=parseInt(e,10):(n.charCode=e.charCodeAt(0),n.keyCode=CE[e]||e.toUpperCase().charCodeAt(0))});var r=[n.keyCode];for(t in wE)n[t]?r.push(t):n[t]=!1;return n.id=r.join(","),n.access&&(n.alt=!0,xt.mac?n.ctrl=!0:n.shift=!0),n.meta&&(xt.mac?n.meta=!0:(n.ctrl=!0,n.meta=!1)),n},SE=(NE.prototype.add=function(e,n,t,r){var o=this,i=o.normalizeCommandFunc(t);return yE(bE(_t.trim(e)),function(e){var t=o.createShortcut(e,n,i,r);o.shortcuts[t.id]=t}),!0},NE.prototype.remove=function(e){var t=this.createShortcut(e);return!!this.shortcuts[t.id]&&(delete this.shortcuts[t.id],!0)},NE.prototype.normalizeCommandFunc=function(e){var t=this,n=e;return"string"==typeof n?function(){t.editor.execCommand(n,!1,null)}:_t.isArray(n)?function(){t.editor.execCommand(n[0],n[1],n[2])}:n},NE.prototype.createShortcut=function(e,t,n,r){var o=_t.map(bE(e,">"),xE);return o[o.length-1]=_t.extend(o[o.length-1],{func:n,scope:r||this.editor}),_t.extend(o[0],{desc:this.editor.translate(t),subpatterns:o.slice(1)})},NE.prototype.hasModifier=function(e){return e.altKey||e.ctrlKey||e.metaKey},NE.prototype.isFunctionKey=function(e){return"keydown"===e.type&&112<=e.keyCode&&e.keyCode<=123},NE.prototype.matchShortcut=function(e,t){return!!t&&t.ctrl===e.ctrlKey&&t.meta===e.metaKey&&t.alt===e.altKey&&t.shift===e.shiftKey&&!!(e.keyCode===t.keyCode||e.charCode&&e.charCode===t.charCode)&&(e.preventDefault(),!0)},NE.prototype.executeShortcutAction=function(e){return e.func?e.func.call(e.scope):null},NE);function NE(e){this.shortcuts={},this.pendingPatterns=[],this.editor=e;var n=this;e.on("keyup keypress keydown",function(t){!n.hasModifier(t)&&!n.isFunctionKey(t)||t.isDefaultPrevented()||(yE(n.shortcuts,function(e){if(n.matchShortcut(t,e))return n.pendingPatterns=e.subpatterns.slice(0),"keydown"===t.type&&n.executeShortcutAction(e),!0}),n.matchShortcut(t,n.pendingPatterns[0])&&(1===n.pendingPatterns.length&&"keydown"===t.type&&n.executeShortcutAction(n.pendingPatterns[0]),n.pendingPatterns.shift()))})}var EE=function(){var e,t,n,r,o,i,a,u,s=(t={},n={},r={},o={},i={},a={},{addButton:(u=function(n,r){return function(e,t){return n[e.toLowerCase()]=_e(_e({},t),{type:r})}})(e={},"button"),addGroupToolbarButton:u(e,"grouptoolbarbutton"),addToggleButton:u(e,"togglebutton"),addMenuButton:u(e,"menubutton"),addSplitButton:u(e,"splitbutton"),addMenuItem:u(t,"menuitem"),addNestedMenuItem:u(t,"nestedmenuitem"),addToggleMenuItem:u(t,"togglemenuitem"),addAutocompleter:u(n,"autocompleter"),addContextMenu:u(o,"contextmenu"),addContextToolbar:u(i,"contexttoolbar"),addContextForm:u(i,"contextform"),addSidebar:u(a,"sidebar"),addIcon:function(e,t){return r[e.toLowerCase()]=t},getAll:function(){return{buttons:e,menuItems:t,icons:r,popups:n,contextMenus:o,contextToolbars:i,sidebars:a}}});return{addAutocompleter:s.addAutocompleter,addButton:s.addButton,addContextForm:s.addContextForm,addContextMenu:s.addContextMenu,addContextToolbar:s.addContextToolbar,addIcon:s.addIcon,addMenuButton:s.addMenuButton,addMenuItem:s.addMenuItem,addNestedMenuItem:s.addNestedMenuItem,addSidebar:s.addSidebar,addSplitButton:s.addSplitButton,addToggleButton:s.addToggleButton,addGroupToolbarButton:s.addGroupToolbarButton,addToggleMenuItem:s.addToggleMenuItem,getAll:s.getAll}},kE=_t.each,_E=_t.trim,AE="source protocol authority userInfo user password host port relative path directory file query anchor".split(" "),RE={ftp:21,http:80,https:443,mailto:25},TE=(DE.parseDataUri=function(e){var t,n=decodeURIComponent(e).split(","),r=/data:([^;]+)/.exec(n[0]);return r&&(t=r[1]),{type:t,data:n[1]}},DE.getDocumentBaseUrl=function(e){var t=0!==e.protocol.indexOf("http")&&"file:"!==e.protocol?e.href:e.protocol+"//"+e.host+e.pathname;return/^[^:]+:\/\/\/?[^\/]+\//.test(t)&&(t=t.replace(/[\?#].*$/,"").replace(/[\/\\][^\/]+$/,""),/[\/\\]$/.test(t)||(t+="/")),t},DE.prototype.setPath=function(e){var t=/^(.*?)\/?(\w+)?$/.exec(e);this.path=t[0],this.directory=t[1],this.file=t[2],this.source="",this.getURI()},DE.prototype.toRelative=function(e){var t;if("./"===e)return e;var n=new DE(e,{base_uri:this});if("mce_host"!==n.host&&this.host!==n.host&&n.host||this.port!==n.port||this.protocol!==n.protocol&&""!==n.protocol)return n.getURI();var r=this.getURI(),o=n.getURI();return r===o||"/"===r.charAt(r.length-1)&&r.substr(0,r.length-1)===o?r:(t=this.toRelPath(this.path,n.path),n.query&&(t+="?"+n.query),n.anchor&&(t+="#"+n.anchor),t)},DE.prototype.toAbsolute=function(e,t){var n=new DE(e,{base_uri:this});return n.getURI(t&&this.isSameOrigin(n))},DE.prototype.isSameOrigin=function(e){if(this.host==e.host&&this.protocol==e.protocol){if(this.port==e.port)return!0;var t=RE[this.protocol];if(t&&(this.port||t)==(e.port||t))return!0}return!1},DE.prototype.toRelPath=function(e,t){var n,r,o=0,i="",a=e.substring(0,e.lastIndexOf("/")).split("/"),u=t.split("/");if(a.length>=u.length)for(n=0,r=a.length;n<r;n++)if(n>=u.length||a[n]!==u[n]){o=n+1;break}if(a.length<u.length)for(n=0,r=u.length;n<r;n++)if(n>=a.length||a[n]!==u[n]){o=n+1;break}if(1===o)return t;for(n=0,r=a.length-(o-1);n<r;n++)i+="../";for(n=o-1,r=u.length;n<r;n++)i+=n!==o-1?"/"+u[n]:u[n];return i},DE.prototype.toAbsPath=function(e,t){var n,r,o=0,i=[],a=/\/$/.test(t)?"/":"",u=e.split("/"),s=t.split("/");for(kE(u,function(e){e&&i.push(e)}),u=i,n=s.length-1,i=[];0<=n;n--)0!==s[n].length&&"."!==s[n]&&(".."!==s[n]?0<o?o--:i.push(s[n]):o++);return 0!==(r=(n=u.length-o)<=0?Z(i).join("/"):u.slice(0,n).join("/")+"/"+Z(i).join("/")).indexOf("/")&&(r="/"+r),a&&r.lastIndexOf("/")!==r.length-1&&(r+=a),r},DE.prototype.getURI=function(e){var t;return void 0===e&&(e=!1),this.source&&!e||(t="",e||(this.protocol?t+=this.protocol+"://":t+="//",this.userInfo&&(t+=this.userInfo+"@"),this.host&&(t+=this.host),this.port&&(t+=":"+this.port)),this.path&&(t+=this.path),this.query&&(t+="?"+this.query),this.anchor&&(t+="#"+this.anchor),this.source=t),this.source},DE);function DE(e,t){e=_E(e),this.settings=t||{};var n,r,o,i,a=this.settings.base_uri,u=this;/^([\w\-]+):([^\/]{2})/i.test(e)||/^\s*#/.test(e)?u.source=e:(n=0===e.indexOf("//"),0!==e.indexOf("/")||n||(e=(a&&a.protocol||"http")+"://mce_host"+e),/^[\w\-]*:?\/\//.test(e)||(r=this.settings.base_uri?this.settings.base_uri.path:new DE(document.location.href).directory,e=this.settings.base_uri&&""==this.settings.base_uri.protocol?"//mce_host"+u.toAbsPath(r,e):(o=/([^#?]*)([#?]?.*)/.exec(e),(a&&a.protocol||"http")+"://mce_host"+u.toAbsPath(r,o[1])+o[2])),e=e.replace(/@@/g,"(mce_at)"),i=/^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@\/]*):?([^:@\/]*))?@)?(\[[a-zA-Z0-9:.%]+\]|[^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/.exec(e),kE(AE,function(e,t){var n=(n=i[t])&&n.replace(/\(mce_at\)/g,"@@");u[e]=n}),a&&(u.protocol||(u.protocol=a.protocol),u.userInfo||(u.userInfo=a.userInfo),u.port||"mce_host"!==u.host||(u.port=a.port),u.host&&"mce_host"!==u.host||(u.host=a.host),u.source=""),n&&(u.protocol=""))}var OE=xu.DOM,BE=_t.extend,PE=_t.each,LE=_t.resolve,IE=xt.ie,ME=(FE.prototype.render=function(){BN(this)},FE.prototype.focus=function(e){var t,n;n=e,(t=this).removed||(n?bm:ym)(t)},FE.prototype.hasFocus=function(){return vm(this)},FE.prototype.execCallback=function(e){for(var t=[],n=1;n<arguments.length;n++)t[n-1]=arguments[n];var r,o=this.settings[e];if(o)return this.callbackLookup&&(r=this.callbackLookup[e])&&(o=r.func,r=r.scope),"string"==typeof o&&(r=(r=o.replace(/\.\w+$/,""))?LE(r):0,o=LE(o),this.callbackLookup=this.callbackLookup||{},this.callbackLookup[e]={func:o,scope:r}),o.apply(r||this,t)},FE.prototype.translate=function(e){return Ou.translate(e)},FE.prototype.getParam=function(e,t,n){return Iy(this,e,t,n)},FE.prototype.hasPlugin=function(e,t){return!(!M(xc(this).split(/[ ,]/),e)||t&&Ky.get(e)===undefined)},FE.prototype.nodeChanged=function(e){this._nodeChangeDispatcher.nodeChanged(e)},FE.prototype.addCommand=function(e,t,n){this.editorCommands.addCommand(e,t,n)},FE.prototype.addQueryStateHandler=function(e,t,n){this.editorCommands.addQueryStateHandler(e,t,n)},FE.prototype.addQueryValueHandler=function(e,t,n){this.editorCommands.addQueryValueHandler(e,t,n)},FE.prototype.addShortcut=function(e,t,n,r){this.shortcuts.add(e,t,n,r)},FE.prototype.execCommand=function(e,t,n,r){return this.editorCommands.execCommand(e,t,n,r)},FE.prototype.queryCommandState=function(e){return this.editorCommands.queryCommandState(e)},FE.prototype.queryCommandValue=function(e){return this.editorCommands.queryCommandValue(e)},FE.prototype.queryCommandSupported=function(e){return this.editorCommands.queryCommandSupported(e)},FE.prototype.show=function(){this.hidden&&(this.hidden=!1,this.inline?this.getBody().contentEditable="true":(OE.show(this.getContainer()),OE.hide(this.id)),this.load(),this.fire("show"))},FE.prototype.hide=function(){var e=this,t=e.getDoc();e.hidden||(IE&&t&&!e.inline&&t.execCommand("SelectAll"),e.save(),e.inline?(e.getBody().contentEditable="false",e===e.editorManager.focusedEditor&&(e.editorManager.focusedEditor=null)):(OE.hide(e.getContainer()),OE.setStyle(e.id,"display",e.orgDisplay)),e.hidden=!0,e.fire("hide"))},FE.prototype.isHidden=function(){return!!this.hidden},FE.prototype.setProgressState=function(e,t){this.fire("ProgressState",{state:e,time:t})},FE.prototype.load=function(e){var t=this.getElement();if(this.removed)return"";if(t){(e=e||{}).load=!0;var n=In(t)?t.value:t.innerHTML,r=this.setContent(n,e);return e.element=t,e.no_events||this.fire("LoadContent",e),e.element=t=null,r}},FE.prototype.save=function(e){var t,n,r=this,o=r.getElement();if(o&&r.initialized&&!r.removed)return(e=e||{}).save=!0,e.element=o,e.content=r.getContent(e),e.no_events||r.fire("SaveContent",e),"raw"===e.format&&r.fire("RawSaveContent",e),t=e.content,In(o)?o.value=t:(!e.is_removing&&r.inline||(o.innerHTML=t),(n=OE.getParent(r.id,"form"))&&PE(n.elements,function(e){if(e.name===r.id)return e.value=t,!1})),e.element=o=null,!1!==e.set_dirty&&r.setDirty(!1),t},FE.prototype.setContent=function(e,t){return py(this,e,t)},FE.prototype.getContent=function(e){return my(this,e)},FE.prototype.insertContent=function(e,t){t&&(e=BE({content:e},t)),this.execCommand("mceInsertContent",!1,e)},FE.prototype.resetContent=function(e){e===undefined?py(this,this.startContent,{format:"raw"}):py(this,e),this.undoManager.reset(),this.setDirty(!1),this.nodeChanged()},FE.prototype.isDirty=function(){return!this.isNotDirty},FE.prototype.setDirty=function(e){var t=!this.isNotDirty;this.isNotDirty=!e,e&&e!==t&&this.fire("dirty")},FE.prototype.getContainer=function(){return this.container||(this.container=OE.get(this.editorContainer||this.id+"_parent")),this.container},FE.prototype.getContentAreaContainer=function(){return this.contentAreaContainer},FE.prototype.getElement=function(){return this.targetElm||(this.targetElm=OE.get(this.id)),this.targetElm},FE.prototype.getWin=function(){var e;return this.contentWindow||(e=this.iframeElement)&&(this.contentWindow=e.contentWindow),this.contentWindow},FE.prototype.getDoc=function(){var e;return this.contentDocument||(e=this.getWin())&&(this.contentDocument=e.document),this.contentDocument},FE.prototype.getBody=function(){var e=this.getDoc();return this.bodyElement||(e?e.body:null)},FE.prototype.convertURL=function(e,t,n){var r=this.settings;return r.urlconverter_callback?this.execCallback("urlconverter_callback",e,n,!0,t):!r.convert_urls||n&&"LINK"===n.nodeName||0===e.indexOf("file:")||0===e.length?e:r.relative_urls?this.documentBaseURI.toRelative(e):e=this.documentBaseURI.toAbsolute(e,r.remove_script_host)},FE.prototype.addVisual=function(e){PN(this,e)},FE.prototype.remove=function(){vy(this)},FE.prototype.destroy=function(e){yy(this,e)},FE.prototype.uploadImages=function(e){return this.editorUpload.uploadImages(e)},FE.prototype._scanForImages=function(){return this.editorUpload.scanForImages()},FE.prototype.addButton=function(){throw new Error("editor.addButton has been removed in tinymce 5x, use editor.ui.registry.addButton or editor.ui.registry.addToggleButton or editor.ui.registry.addSplitButton instead")},FE.prototype.addSidebar=function(){throw new Error("editor.addSidebar has been removed in tinymce 5x, use editor.ui.registry.addSidebar instead")},FE.prototype.addMenuItem=function(){throw new Error("editor.addMenuItem has been removed in tinymce 5x, use editor.ui.registry.addMenuItem instead")},FE.prototype.addContextToolbar=function(){throw new Error("editor.addContextToolbar has been removed in tinymce 5x, use editor.ui.registry.addContextToolbar instead")},FE);function FE(e,t,n){var r=this;this.plugins={},this.contentCSS=[],this.contentStyles=[],this.loadedCSS={},this.isNotDirty=!1,this.editorManager=n,this.documentBaseUrl=n.documentBaseURL,BE(this,pE),this.settings=Py(this,e,this.documentBaseUrl,n.defaultSettings,t),this.settings.suffix&&(n.suffix=this.settings.suffix),this.suffix=n.suffix,this.settings.base_url&&n._setBaseUrl(this.settings.base_url),this.baseUri=n.baseURI,this.settings.referrer_policy&&(ku.ScriptLoader._setReferrerPolicy(this.settings.referrer_policy),xu.DOM.styleSheetLoader._setReferrerPolicy(this.settings.referrer_policy)),Bu.languageLoad=this.settings.language_load,Bu.baseURL=n.baseURL,this.id=e,this.setDirty(!1),this.documentBaseURI=new TE(this.settings.document_base_url,{base_uri:this.baseUri}),this.baseURI=this.baseUri,this.inline=!!this.settings.inline,this.shortcuts=new SE(this),this.editorCommands=new XN(this),this.settings.cache_suffix&&(xt.cacheSuffix=this.settings.cache_suffix.replace(/^[\?\&]+/,"")),this.ui={registry:EE(),styleSheetLoader:undefined,show:te,hide:te,enable:te,disable:te,isDisabled:b};var o=vE(this);this.mode=o,this.setMode=o.set,n.fire("SetupEditor",{editor:this}),this.execCallback("setup",this),this.$=gu.overrideDefaults(function(){return{context:r.inline?r.getBody():r.getDoc(),element:r.getBody()}})}var UE,zE=xu.DOM,jE=_t.explode,HE=_t.each,VE=_t.extend,qE=0,$E=!1,WE=[],KE=[],XE=function(t){var n=t.type;HE(QE.get(),function(e){switch(n){case"scroll":e.fire("ScrollWindow",t);break;case"resize":e.fire("ResizeWindow",t)}})},YE=function(e){e!==$E&&(e?gu(window).on("resize scroll",XE):gu(window).off("resize scroll",XE),$E=e)},GE=function(t){var e=KE;delete WE[t.id];for(var n=0;n<WE.length;n++)if(WE[n]===t){WE.splice(n,1);break}return KE=H(KE,function(e){return t!==e}),QE.activeEditor===t&&(QE.activeEditor=0<KE.length?KE[0]:null),QE.focusedEditor===t&&(QE.focusedEditor=null),e.length!==KE.length},JE="CSS1Compat"!==document.compatMode,QE=_e(_e({},cE),{baseURI:null,baseURL:null,defaultSettings:{},documentBaseURL:null,suffix:null,$:gu,majorVersion:"5",minorVersion:"7.1",releaseDate:"2021-03-17",editors:WE,i18n:Ou,activeEditor:null,focusedEditor:null,settings:{},setup:function(){var e,t="",n=TE.getDocumentBaseUrl(document.location);/^[^:]+:\/\/\/?[^\/]+\//.test(n)&&(n=n.replace(/[\?#].*$/,"").replace(/[\/\\][^\/]+$/,""),/[\/\\]$/.test(n)||(n+="/"));var r,o=window.tinymce||window.tinyMCEPreInit;if(o)e=o.base||o.baseURL,t=o.suffix;else{for(var i,a=document.getElementsByTagName("script"),u=0;u<a.length;u++){if(""!==(i=a[u].src||"")){var s=i.substring(i.lastIndexOf("/"));if(/tinymce(\.full|\.jquery|)(\.min|\.dev|)\.js/.test(i)){-1!==s.indexOf(".min")&&(t=".min"),e=i.substring(0,i.lastIndexOf("/"));break}}}!e&&document.currentScript&&(-1!==(i=document.currentScript.src).indexOf(".min")&&(t=".min"),e=i.substring(0,i.lastIndexOf("/")))}this.baseURL=new TE(n).toAbsolute(e),this.documentBaseURL=n,this.baseURI=new TE(this.baseURL),this.suffix=t,(r=this).on("AddEditor",N(lm,r)),r.on("RemoveEditor",N(fm,r))},overrideDefaults:function(e){var t=e.base_url;t&&this._setBaseUrl(t);var n=e.suffix;e.suffix&&(this.suffix=n);var r=(this.defaultSettings=e).plugin_base_urls;r!==undefined&&se(r,function(e,t){Bu.PluginManager.urls[t]=e})},init:function(r){var n,u=this,s=_t.makeMap("area base basefont br col frame hr img input isindex link meta param embed source wbr track colgroup option table tbody tfoot thead tr th td script noscript style textarea video audio iframe object menu"," "),c=function(e){var t=e.id;return t||(t=he(e,"name").filter(function(e){return!zE.get(e)}).getOrThunk(zE.uniqueId),e.setAttribute("id",t)),t},l=function(e,t){return t.constructor===RegExp?t.test(e.className):zE.hasClass(e,t)},f=function(e){n=e},e=function(){var o,i=0,a=[],n=function(e,t,n){var r=new ME(e,t,u);a.push(r),r.on("init",function(){++i===o.length&&f(a)}),r.targetElm=r.targetElm||n,r.render()};zE.unbind(window,"ready",e),function(e){var t=r[e];if(t)t.apply(u,[])}("onpageload"),o=gu.unique(function(t){var n=[];if(xt.browser.isIE()&&xt.browser.version.major<11)return rb("TinyMCE does not support the browser you are using. For a list of supported browsers please see: https://www.tinymce.com/docs/get-started/system-requirements/"),[];if(JE)return rb("Failed to initialize the editor as the document is not in standards mode. TinyMCE requires standards mode."),[];if(t.types)return HE(t.types,function(e){n=n.concat(zE.select(e.selector))}),n;if(t.selector)return zE.select(t.selector);if(t.target)return[t.target];switch(t.mode){case"exact":var e=t.elements||"";0<e.length&&HE(jE(e),function(t){var e=zE.get(t);e?n.push(e):HE(document.forms,function(e){HE(e.elements,function(e){e.name===t&&(t="mce_editor_"+qE++,zE.setAttrib(e,"id",t),n.push(e))})})});break;case"textareas":case"specific_textareas":HE(zE.select("textarea"),function(e){t.editor_deselector&&l(e,t.editor_deselector)||t.editor_selector&&!l(e,t.editor_selector)||n.push(e)})}return n}(r)),r.types?HE(r.types,function(t){_t.each(o,function(e){return!zE.is(e,t.selector)||(n(c(e),VE({},r,t),e),!1)})}):(_t.each(o,function(e){var t;(t=u.get(e.id))&&t.initialized&&!(t.getContainer()||t.getBody()).parentNode&&(GE(t),t.unbindAllNativeEvents(),t.destroy(!0),t.removed=!0,t=null)}),0===(o=_t.grep(o,function(e){return!u.get(e.id)})).length?f([]):HE(o,function(e){var t;t=e,r.inline&&t.tagName.toLowerCase()in s?rb("Could not initialize inline editor on invalid inline target element",e):n(c(e),r,e)}))};return u.settings=r,zE.bind(window,"ready",e),new Ir(function(t){n?t(n):f=function(e){t(e)}})},get:function(t){return 0===arguments.length?KE.slice(0):K(t)?W(KE,function(e){return e.id===t}).getOr(null):O(t)&&KE[t]?KE[t]:null},add:function(e){var n=this;return WE[e.id]===e||(null===n.get(e.id)&&("length"!==e.id&&(WE[e.id]=e),WE.push(e),KE.push(e)),YE(!0),n.activeEditor=e,n.fire("AddEditor",{editor:e}),UE||(UE=function(e){var t=n.fire("BeforeUnload");if(t.returnValue)return e.preventDefault(),e.returnValue=t.returnValue,t.returnValue},window.addEventListener("beforeunload",UE))),e},createEditor:function(e,t){return this.add(new ME(e,t,this))},remove:function(e){var t,n,r=this;if(e){if(!K(e))return n=e,A(r.get(n.id))?null:(GE(n)&&r.fire("RemoveEditor",{editor:n}),0===KE.length&&window.removeEventListener("beforeunload",UE),n.remove(),YE(0<KE.length),n);HE(zE.select(e),function(e){(n=r.get(e.id))&&r.remove(n)})}else for(t=KE.length-1;0<=t;t--)r.remove(KE[t])},execCommand:function(e,t,n){var r=this.get(n);switch(e){case"mceAddEditor":return this.get(n)||new ME(n,this.settings,this).render(),!0;case"mceRemoveEditor":return r&&r.remove(),!0;case"mceToggleEditor":return r?(r.isHidden()?r.show():r.hide(),!0):(this.execCommand("mceAddEditor",!1,n),!0)}return!!this.activeEditor&&this.activeEditor.execCommand(e,t,n)},triggerSave:function(){HE(KE,function(e){e.save()})},addI18n:function(e,t){Ou.add(e,t)},translate:function(e){return Ou.translate(e)},setActive:function(e){var t=this.activeEditor;this.activeEditor!==e&&(t&&t.fire("deactivate",{relatedTarget:e}),e.fire("activate",{relatedTarget:t})),this.activeEditor=e},_setBaseUrl:function(e){this.baseURL=new TE(this.documentBaseURL).toAbsolute(e.replace(/\/+$/,"")),this.baseURI=new TE(this.baseURL)}});QE.setup();var ZE,ek,tk,nk,rk=Math.min,ok=Math.max,ik=Math.round,ak=function(e,t,n){var r=t.x,o=t.y,i=e.w,a=e.h,u=t.w,s=t.h,c=(n||"").split("");return"b"===c[0]&&(o+=s),"r"===c[1]&&(r+=u),"c"===c[0]&&(o+=ik(s/2)),"c"===c[1]&&(r+=ik(u/2)),"b"===c[3]&&(o-=a),"r"===c[4]&&(r-=i),"c"===c[3]&&(o-=ik(a/2)),"c"===c[4]&&(r-=ik(i/2)),uk(r,o,i,a)},uk=function(e,t,n,r){return{x:e,y:t,w:n,h:r}},sk={inflate:function(e,t,n){return uk(e.x-t,e.y-n,e.w+2*t,e.h+2*n)},relativePosition:ak,findBestRelativePosition:function(e,t,n,r){for(var o,i=0;i<r.length;i++)if((o=ak(e,t,r[i])).x>=n.x&&o.x+o.w<=n.w+n.x&&o.y>=n.y&&o.y+o.h<=n.h+n.y)return r[i];return null},intersect:function(e,t){var n=ok(e.x,t.x),r=ok(e.y,t.y),o=rk(e.x+e.w,t.x+t.w),i=rk(e.y+e.h,t.y+t.h);return o-n<0||i-r<0?null:uk(n,r,o-n,i-r)},clamp:function(e,t,n){var r=e.x,o=e.y,i=e.x+e.w,a=e.y+e.h,u=t.x+t.w,s=t.y+t.h,c=ok(0,t.x-r),l=ok(0,t.y-o),f=ok(0,i-u),d=ok(0,a-s);return r+=c,o+=l,n&&(i+=c,a+=l,r-=f,o-=d),uk(r,o,(i-=f)-r,(a-=d)-o)},create:uk,fromClientRect:function(e){return uk(e.left,e.top,e.width,e.height)}},ck=(ZE={},ek={},{load:function(r,o){var i='Script at URL "'+o+'" failed to load',a='Script at URL "'+o+"\" did not call `tinymce.Resource.add('"+r+"', data)` within 1 second";if(ZE[r]!==undefined)return ZE[r];var e=new Ir(function(e,t){var n=function(e,t,n){void 0===n&&(n=1e3);var r=!1,o=null,i=function(n){return function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];r||(r=!0,null!==o&&(clearTimeout(o),o=null),n.apply(null,e))}},a=i(e),u=i(t);return{start:function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];r||null!==o||(o=setTimeout(function(){return u.apply(null,e)},n))},resolve:a,reject:u}}(e,t);ek[r]=n.resolve,ku.ScriptLoader.loadScript(o,function(){return n.start(a)},function(){return n.reject(i)})});return ZE[r]=e},add:function(e,t){ek[e]!==undefined&&(ek[e](t),delete ek[e]),ZE[e]=Ir.resolve(t)}}),lk=_t.each,fk=_t.extend,dk=function(){};dk.extend=tk=function(n){var o=this.prototype,r=function(){var e,t,n;if(!nk&&(this.init&&this.init.apply(this,arguments),t=this.Mixins))for(e=t.length;e--;)(n=t[e]).init&&n.init.apply(this,arguments)},t=function(){return this};nk=!0;var i=new this;return nk=!1,n.Mixins&&(lk(n.Mixins,function(e){for(var t in e)"init"!==t&&(n[t]=e[t])}),o.Mixins&&(n.Mixins=o.Mixins.concat(n.Mixins))),n.Methods&&lk(n.Methods.split(","),function(e){n[e]=t}),n.Properties&&lk(n.Properties.split(","),function(e){var t="_"+e;n[e]=function(e){return e!==undefined?(this[t]=e,this):this[t]}}),n.Statics&&lk(n.Statics,function(e,t){r[t]=e}),n.Defaults&&o.Defaults&&(n.Defaults=fk({},o.Defaults,n.Defaults)),se(n,function(e,t){var n,r;"function"==typeof e&&o[t]?i[t]=(n=t,r=e,function(){var e=this._super;this._super=o[n];var t=r.apply(this,arguments);return this._super=e,t}):i[t]=e}),r.prototype=i,(r.constructor=r).extend=tk,r};var mk=Math.min,pk=Math.max,gk=Math.round,hk={serialize:function(e){var t=JSON.stringify(e);return K(t)?t.replace(/[\u0080-\uFFFF]/g,function(e){var t=e.charCodeAt(0).toString(16);return"\\u"+"0000".substring(t.length)+t}):t},parse:function(e){try{return JSON.parse(e)}catch(t){}}},vk={callbacks:{},count:0,send:function(t){var n=this,r=xu.DOM,o=t.count!==undefined?t.count:n.count,i="tinymce_jsonp_"+o;n.callbacks[o]=function(e){r.remove(i),delete n.callbacks[o],t.callback(e)},r.add(r.doc.body,"script",{id:i,src:t.url,type:"text/javascript"}),n.count++}},yk=_e(_e({},cE),{send:function(e){var t,n=0,r=function(){!e.async||4===t.readyState||1e4<n++?(e.success&&n<1e4&&200===t.status?e.success.call(e.success_scope,""+t.responseText,t,e):e.error&&e.error.call(e.error_scope,1e4<n?"TIMED_OUT":"GENERAL",t,e),t=null):Wr.setTimeout(r,10)};if(e.scope=e.scope||this,e.success_scope=e.success_scope||e.scope,e.error_scope=e.error_scope||e.scope,e.async=!1!==e.async,e.data=e.data||"",yk.fire("beforeInitialize",{settings:e}),(t=new XMLHttpRequest).overrideMimeType&&t.overrideMimeType(e.content_type),t.open(e.type||(e.data?"POST":"GET"),e.url,e.async),e.crossDomain&&(t.withCredentials=!0),e.content_type&&t.setRequestHeader("Content-Type",e.content_type),e.requestheaders&&_t.each(e.requestheaders,function(e){t.setRequestHeader(e.key,e.value)}),t.setRequestHeader("X-Requested-With","XMLHttpRequest"),(t=yk.fire("beforeSend",{xhr:t,settings:e}).xhr).send(e.data),!e.async)return r();Wr.setTimeout(r,10)}}),bk=_t.extend,Ck=(wk.sendRPC=function(e){return(new wk).send(e)},wk.prototype.send=function(e){var n=e.error,r=e.success,o=bk(this.settings,e);o.success=function(e,t){void 0===(e=hk.parse(e))&&(e={error:"JSON Parse error."}),e.error?n.call(o.error_scope||o.scope,e.error,t):r.call(o.success_scope||o.scope,e.result)},o.error=function(e,t){n&&n.call(o.error_scope||o.scope,e,t)},o.data=hk.serialize({id:e.id||"c"+this.count++,method:e.method,params:e.params}),o.content_type="application/json",yk.send(o)},wk);function wk(e){this.settings=bk({},e),this.count=0}try{var xk,Sk="__storage_test__";(xk=window.localStorage).setItem(Sk,Sk),xk.removeItem(Sk)}catch(_k){xk=function(){return n={},r=[],e={getItem:function(e){var t=n[e];return t||null},setItem:function(e,t){r.push(e),n[e]=String(t)},key:function(e){return r[e]},removeItem:function(t){r=r.filter(function(e){return e===t}),delete n[t]},clear:function(){r=[],n={}},length:0},Object.defineProperty(e,"length",{get:function(){return r.length},configurable:!1,enumerable:!1}),e;var n,r,e}()}var Nk,Ek={geom:{Rect:sk},util:{Promise:Ir,Delay:Wr,Tools:_t,VK:ed,URI:TE,Class:dk,EventDispatcher:iE,Observable:cE,I18n:Ou,XHR:yk,JSON:hk,JSONRequest:Ck,JSONP:vk,LocalStorage:xk,Color:function(e){var n={},u=0,s=0,c=0,t=function(e){var t;return"object"==typeof e?"r"in e?(u=e.r,s=e.g,c=e.b):"v"in e&&function(e,t,n){if(e=(parseInt(e,10)||0)%360,t=parseInt(t,10)/100,n=parseInt(n,10)/100,t=pk(0,mk(t,1)),n=pk(0,mk(n,1)),0!==t){var r=e/60,o=n*t,i=o*(1-Math.abs(r%2-1)),a=n-o;switch(Math.floor(r)){case 0:u=o,s=i,c=0;break;case 1:u=i,s=o,c=0;break;case 2:u=0,s=o,c=i;break;case 3:u=0,s=i,c=o;break;case 4:u=i,s=0,c=o;break;case 5:u=o,s=0,c=i;break;default:u=s=c=0}u=gk(255*(u+a)),s=gk(255*(s+a)),c=gk(255*(c+a))}else u=s=c=gk(255*n)}(e.h,e.s,e.v):(t=/rgb\s*\(\s*([0-9]+)\s*,\s*([0-9]+)\s*,\s*([0-9]+)[^\)]*\)/gi.exec(e))?(u=parseInt(t[1],10),s=parseInt(t[2],10),c=parseInt(t[3],10)):(t=/#([0-F]{2})([0-F]{2})([0-F]{2})/gi.exec(e))?(u=parseInt(t[1],16),s=parseInt(t[2],16),c=parseInt(t[3],16)):(t=/#([0-F])([0-F])([0-F])/gi.exec(e))&&(u=parseInt(t[1]+t[1],16),s=parseInt(t[2]+t[2],16),c=parseInt(t[3]+t[3],16)),u=u<0?0:255<u?255:u,s=s<0?0:255<s?255:s,c=c<0?0:255<c?255:c,n};return e&&t(e),n.toRgb=function(){return{r:u,g:s,b:c}},n.toHsv=function(){return e=u,t=s,n=c,o=0,i=mk(e/=255,mk(t/=255,n/=255)),a=pk(e,pk(t,n)),i===a?{h:0,s:0,v:100*(o=i)}:(r=(a-i)/a,{h:gk(60*((e===i?3:n===i?1:5)-(e===i?t-n:n===i?e-t:n-e)/((o=a)-i))),s:gk(100*r),v:gk(100*o)});var e,t,n,r,o,i,a},n.toHex=function(){var e=function(e){return 1<(e=parseInt(e,10).toString(16)).length?e:"0"+e};return"#"+e(u)+e(s)+e(c)},n.parse=t,n},ImageUploader:function(n){var e=ub(),r=db(n,e);return{upload:function(e,t){return void 0===t&&(t=!0),r.upload(e,t?fb(n):undefined)}}}},dom:{EventUtils:Ti,Sizzle:Ta,DomQuery:gu,TreeWalker:Yr,TextSeeker:is,DOMUtils:xu,ScriptLoader:ku,RangeUtils:pd,Serializer:dy,StyleSheetLoader:Kr,ControlSelection:nd,BookmarkManager:Gf,Selection:Hv,Event:Ti.Event},html:{Styles:xi,Entities:li,Node:Am,Schema:Ci,SaxParser:Pm,DomParser:uy,Writer:Vm,Serializer:qm},Env:xt,AddOnManager:Bu,Annotator:Yf,Formatter:Cb,UndoManager:xb,EditorCommands:XN,WindowManager:Jy,NotificationManager:Wy,EditorObservable:pE,Shortcuts:SE,Editor:ME,FocusManager:im,EditorManager:QE,DOM:xu.DOM,ScriptLoader:ku.ScriptLoader,PluginManager:Ky,ThemeManager:Xy,IconManager:My,Resource:ck,trim:_t.trim,isArray:_t.isArray,is:_t.is,toArray:_t.toArray,makeMap:_t.makeMap,each:_t.each,map:_t.map,grep:_t.grep,inArray:_t.inArray,extend:_t.extend,create:_t.create,walk:_t.walk,createNS:_t.createNS,resolve:_t.resolve,explode:_t.explode,_addCacheSuffix:_t._addCacheSuffix,isOpera:xt.opera,isWebKit:xt.webkit,isIE:xt.ie,isGecko:xt.gecko,isMac:xt.mac},kk=_t.extend(QE,Ek);Nk=kk,window.tinymce=Nk,window.tinyMCE=Nk,function(e){if("object"==typeof module)try{module.exports=e}catch(t){}}(kk)}();

/* Ephox Fluffy plugin
 *
 * Copyright 2010-2016 Ephox Corporation.  All rights reserved.
 *
 * Version: 2.5.0-13
 */

!function(){"use strict";function o(n){return function(){return n}}function n(){return f}var u="undefined"!=typeof window?window:Function("return this;")(),t=function(n,t){return{isRequired:n,applyPatch:t}},i=function(i,o){return function(){for(var n=[],t=0;t<arguments.length;t++)n[t]=arguments[t];var r=o.apply(this,n),e=void 0===r?n:r;return i.apply(this,e)}},r=function(n,t){if(n)for(var r=0;r<t.length;r++)t[r].isRequired(n)&&t[r].applyPatch(n);return n},a=o(!1),c=o(!0),f={fold:function(n,t){return n()},is:a,isSome:a,isNone:c,getOr:s,getOrThunk:l,getOrDie:function(n){throw new Error(n||"error: getOrDie called on none.")},getOrNull:o(null),getOrUndefined:o(void 0),or:s,orThunk:l,map:n,each:function(){},bind:n,exists:a,forall:c,filter:n,equals:e,equals_:e,toArray:function(){return[]},toString:o("none()")};function e(n){return n.isNone()}function l(n){return n()}function s(n){return n}function g(e){return function(n){return r=typeof(t=n),(null===t?"null":"object"==r&&(Array.prototype.isPrototypeOf(t)||t.constructor&&"Array"===t.constructor.name)?"array":"object"==r&&(String.prototype.isPrototypeOf(t)||t.constructor&&"String"===t.constructor.name)?"string":r)===e;var t,r}}function d(n,t){return r=n,e=t,-1<D.call(r,e);var r,e}function p(n,t){return function(n){for(var t=[],r=0,e=n.length;r<e;++r){if(!A(n[r]))throw new Error("Arr.flatten item "+r+" was not an array, input: "+n);P.apply(t,n[r])}return t}(function(n,t){for(var r=n.length,e=new Array(r),i=0;i<r;i++){var o=n[i];e[i]=t(o,i)}return e}(n,t))}function v(u){return function(){for(var n=new Array(arguments.length),t=0;t<n.length;t++)n[t]=arguments[t];if(0===n.length)throw new Error("Can't merge zero objects");for(var r={},e=0;e<n.length;e++){var i=n[e];for(var o in i)U.call(i,o)&&(r[o]=u(r[o],i[o]))}return r}}function h(n,t){for(var r=T(n),e=0,i=r.length;e<i;e++){var o=r[e];t(n[o],o)}}function y(r){return function(n,t){r[t]=n}}function m(n,t){var r,e,i,o={},u={};return r=t,e=y(o),i=y(u),h(n,function(n,t){(r(n,t)?e:i)(n,t)}),{t:o,f:u}}function E(n,t){return C(n,t)?j(n[t]):S()}function w(n){if(_(n)||""===n)return[];var t=A(n)?p(n,function(n){return n.split(/[\s+,]/)}):n.split(/[\s+,]/);return p(t,function(n){return 0<n.length?[n.trim()]:[]})}function O(n,t){var r=N(n,t),e=w(t.plugins),i=E(r,"custom_plugin_urls").getOr({}),o=m(i,function(n,t){return d(e,t)}),u=E(r,"external_plugins").getOr({}),a={};h(o.t,function(n,t){a[t]=n});var c=R(a,u);return R(t,0===T(c).length?{}:{external_plugins:c})}var M,b=function(r){function n(){return i}function t(n){return n(r)}var e=o(r),i={fold:function(n,t){return t(r)},is:function(n){return r===n},isSome:c,isNone:a,getOr:e,getOrThunk:e,getOrDie:e,getOrNull:e,getOrUndefined:e,or:n,orThunk:n,map:function(n){return b(n(r))},each:function(n){n(r)},bind:t,exists:t,forall:t,filter:function(n){return n(r)?i:f},toArray:function(){return[r]},toString:function(){return"some("+r+")"},equals:function(n){return n.is(r)},equals_:function(n,t){return n.fold(a,function(n){return t(r,n)})}};return i},S=n,j=function(n){return null==n?f:b(n)},x=g("object"),A=g("array"),_=(M=void 0,function(n){return M===n}),D=Array.prototype.indexOf,P=Array.prototype.push,U=Object.prototype.hasOwnProperty,N=v(function(n,t){return x(n)&&x(t)?N(n,t):t}),R=v(function(n,t){return t}),T=Object.keys,q=Object.hasOwnProperty,C=function(n,t){return q.call(n,t)},I={getCustomPluginUrls:O,patch:t(function(){return!0},function(r){r.EditorManager.init=i(r.EditorManager.init,function(n){return[O(r.defaultSettings,n)]}),r.EditorManager.createEditor=i(r.EditorManager.createEditor,function(n,t){return[n,O(r.defaultSettings,t)]})})};function k(){for(var n=0,t=0,r=arguments.length;t<r;t++)n+=arguments[t].length;var e=Array(n),i=0;for(t=0;t<r;t++)for(var o=arguments[t],u=0,a=o.length;u<a;u++,i++)e[i]=o[u];return e}function L(n,t){return function(n,t){for(var r=null!=t?t:u,e=0;e<n.length&&null!=r;++e)r=r[n[e]];return r}(n.split("."),t)}function V(n){return parseInt(n,10)}function z(n,t){var r=n-t;return 0==r?0:0<r?1:-1}function B(n,t,r){return{major:n,minor:t,patch:r}}function F(n){var t=/([0-9]+)\.([0-9]+)\.([0-9]+)(?:(\-.+)?)/.exec(n);return t?B(V(t[1]),V(t[2]),V(t[3])):B(0,0,0)}function $(n,t){return!!n&&-1===function(n,t){var r=z(n.major,t.major);if(0!==r)return r;var e=z(n.minor,t.minor);if(0!==e)return e;var i=z(n.patch,t.patch);return 0!==i?i:0}(F([(r=n).majorVersion,r.minorVersion].join(".").split(".").slice(0,3).join(".")),F(t));var r}function G(o){return function(n){var t=L("tinymce.util.Tools",u),r=w(n.plugins),e=o.defaultSettings.forced_plugins||[],i=0<e.length?r.concat(e):r;return[t.extend({},n,{plugins:i})]}}function H(){return(new Date).getTime()}function J(e){return function(){var n,t,r=(t="position",(((n=e).currentStyle?n.currentStyle[t]:window.getComputedStyle(n,null)[t])||"").toLowerCase());return"absolute"===r||"fixed"===r}}function K(n){n.parentNode.removeChild(n)}function Q(n,t){n.notificationManager?n.notificationManager.open({text:t,type:"warning",timeout:0,icon:""}):n.windowManager.alert(t)}function W(n){var t,r,e=L("tinymce.util.URI",u);(t=n.base_url)&&(this.baseURL=new e(this.documentBaseURL).toAbsolute(t.replace(/\/+$/,"")),this.baseURI=new e(this.baseURL)),r=n.suffix,n.suffix&&(this.suffix=r),this.defaultSettings=n}function X(n){return[L("tinymce.util.Tools",u).extend({},this.defaultSettings,n)]}function Y(n){r(n,[en.patch,on.patch,Z.patch,I.patch])}var Z={patch:t(function(n){return $(n,"4.7.0")},function(r){r.EditorManager.init=i(r.EditorManager.init,G(r.EditorManager)),r.EditorManager.createEditor=i(r.EditorManager.createEditor,function(n,t){return k([n],G(r.EditorManager)(t))})})},nn=function(n,t,r,e,i){var o,u=H();o=setInterval(function(){n()&&(clearInterval(o),t()),H()-u>i&&(clearInterval(o),r())},e)},tn=function(n,t){var r,e=((r=document.createElement("div")).style.display="none",r.className="mce-floatpanel",r);document.body.appendChild(e),nn(J(e),function(){K(e),n()},function(){K(e),t()},10,5e3)},rn=function(n){n.EditorManager.on("AddEditor",function(n){var t=n.editor,r=t.settings.service_message;r&&tn(function(){Q(t,r)},function(){alert(r)})})},en={patch:t(function(n){return"function"!=typeof n.overrideDefaults},function(r){rn(r),r.overrideDefaults=W,r.EditorManager.init=i(r.EditorManager.init,X),r.EditorManager.createEditor=i(r.EditorManager.createEditor,function(n,t){return k([n],X.call(r,t))})})},on={patch:t(function(n){return $(n,"4.5.0")},function(n){var e;n.overrideDefaults=i(n.overrideDefaults,(e=n,function(n){var t=n.plugin_base_urls;for(var r in t)e.PluginManager.urls[r]=t[r]}))})};Y(u.tinymce)}();

(function(cloudSettings) {
    tinymce.overrideDefaults(cloudSettings);
})({"rtc_tenant_id":"no-api-key","imagetools_proxy":"https://imageproxy.tiny.cloud/2/image","suffix":".min","linkchecker_service_url":"https://hyperlinking.tiny.cloud","spellchecker_rpc_url":"https://spelling.tiny.cloud","spellchecker_api_key":"no-api-key","tinydrive_service_url":"https://catalog.tiny.cloud","api_key":"no-api-key","imagetools_api_key":"no-api-key","tinydrive_api_key":"no-api-key","forced_plugins":["chiffer"],"referrer_policy":"origin","content_css_cors":true,"custom_plugin_urls":{},"chiffer_snowplow_service_url":"https://sp.tinymce.com/i","mediaembed_api_key":"no-api-key","rtc_service_url":"https://rtc.tiny.cloud","linkchecker_api_key":"no-api-key","mediaembed_service_url":"https://hyperlinking.tiny.cloud","service_message":"This domain is not registered with Tiny Cloud.  Please see the \u003ca target=\"_blank\" href=\"https://www.tiny.cloud/docs/quick-start/\"\u003equick start guide\u003c/a\u003e or \u003ca target=\"_blank\" href=\"https://www.tiny.cloud/auth/signup/\"\u003ecreate an account\u003c/a\u003e."});
tinymce.baseURL = "https://cdn.tiny.cloud/1/no-api-key/tinymce/5.7.1-108"

/* Ephox chiffer plugin
*
* Copyright 2010-2019 Tiny Technologies Inc. All rights reserved.
*
* Version: 1.6.0-13
*/

!function(){"use strict";function o(){}function i(){return(new Date).getTime()}function t(t,n){var r,c,e,n=(r=t,c=n,{send:function(t,n,e){var t="?aid="+c+"&tna=tinymce_cloud&p=web&dtm="+n+"&stm="+i()+"&tz="+("undefined"!=typeof Intl?encodeURIComponent(Intl.DateTimeFormat().resolvedOptions().timeZone):"N%2FA")+"&e=se&se_ca="+t,o=document.createElement("img");o.src=r.chiffer_snowplow_service_url+t;t=function(t){return function(){o.onload=null,o.onerror=null,e(t)}};o.onload=t(!0),o.onerror=t(!1)}});return e=n,{sendStat:function(t){return function(){e.send(t,i(),o)}}}}var e,n,r,c,u,a=(e="string",function(t){return t=typeof(n=t),(null===n?"null":"object"==t&&(Array.prototype.isPrototypeOf(n)||n.constructor&&"Array"===n.constructor.name)?"array":"object"==t&&(String.prototype.isPrototypeOf(n)||n.constructor&&"String"===n.constructor.name)?"string":t)===e;var n});r=tinymce.defaultSettings,c={load:o},u=function(t){t=t.api_key;return a(t)?t:void 0}(r),c=void 0===u?c:((n=t(r,u)).sendStat("script_load")(),{load:function(t){t.once("init",n.sendStat("init")),t.once("focus",n.sendStat("focus")),t.on("ExportPdf",n.sendStat("export_pdf")),t.on("PastePreProcess",function(t){null==t.source||n.sendStat("powerpaste_"+t.source)()})}}),tinymce.PluginManager.add("chiffer",c.load)}();
