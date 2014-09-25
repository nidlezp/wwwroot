(function(){var e,t,n,r,i,s=[].slice;t=function(){function e(){this.events={}}return e.prototype.emit=function(){var e,t,n,r,i,o;t=arguments[0],e=2>arguments.length?[]:s.call(arguments,1);if(!this.events[t])return!1;o=this.events[t];for(r=0,i=o.length;r<i;r++)n=o[r],n.apply(null,e);return!0},e.prototype.addListener=function(e,t){var n,r;return this.emit("newListener",e,t),((r=(n=this.events)[e])!=null?r:n[e]=[]).push(t),this},e.prototype.on=e.prototype.addListener,e.prototype.once=function(e,t){var n,r=this;return n=function(){return r.removeListener(e,n),t.apply(null,arguments)},this.on(e,n),this},e.prototype.removeListener=function(e,t){var n;return this.events[e]?(this.events[e]=function(){var r,i,s,o;s=this.events[e],o=[];for(r=0,i=s.length;r<i;r++)n=s[r],n!==t&&o.push(n);return o}.call(this),this):this},e.prototype.removeAllListeners=function(e){return e!=null?delete this.events[e]:this.events={},this},e.prototype.off=e.prototype.removeListener,e.prototype.offAll=e.prototype.removeAllListeners,e}(),e=function(){},n={create:function(e){return e==null&&(e={}),i.extend(this.clone(),e)},clone:function(){return i.create(this)},extend:function(e){return i.extend(this,e)},get:function(e){return this._.props[e]},getAll:function(){return this._.props},set:function(e,t,n){var r;n==null&&(n=!1);if(typeof e=="object"){for(r in e)t=e[r],this.set(r,t);return this}return this._.props[e]=t,n||(this.emit("change",e,t),this.emit("change:"+e,t)),this},has:function(e){return this._.props[e]!=null},remove:function(e,t){return t==null&&(t=!1),delete this._.props[e],t||(this.emit("change",e),this.emit("change:"+e),this.emit("remove",e),this.emit("remove:"+e)),this},emit:function(){var e,t,n;return t=arguments[0],e=2>arguments.length?[]:s.call(arguments,1),(n=this._.events).emit.apply(n,[t].concat(s.call(e))),i.emit.apply(i,[t,this].concat(s.call(e))),this},on:function(e,t){return this._.events.on(e,t.bind(this)),this},once:function(e,t){return this._.events.once(e,t.bind(this)),this},off:function(){var e,t;return e=1>arguments.length?[]:s.call(arguments,0),(t=this._.events).off.apply(t,e),this},offAll:function(){var e,t;return e=1>arguments.length?[]:s.call(arguments,0),(t=this._.events).offAll.apply(t,e),this}},r=-1,i={_:{},events:new t,emitter:t,create:function(e){var t;return t=i.nu(e),i.extend(t,n),t.guid=++r,t._=i._[t.guid]={props:{},events:new i.emitter},t},nu:function(t){return e.prototype=t,new e},clone:function(e){return i.extend({},e)},extend:function(e,t){var n,r;for(n in t)r=t[n],e[n]=r;return e}},i.extend(i,i.events),typeof module!="undefined"&&module!==null?module.exports=i:window.mixer=i}).call(this),function(){var e,t,n,r,i,s,o,u,a,f=function(e,t){return function(){return e.apply(t,arguments)}},l=[].slice,c=[].indexOf||function(e){for(var t=0,n=this.length;t<n;t++)if(t in this&&this[t]===e)return t;return-1};e={},String.prototype.trim||(String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g,"")}),e.Binding=function(){function u(n,s,u,a,l){this.el=n,this.type=s,this.model=u,this.keypath=a,this.options=l!=null?l:{},this.unbind=f(this.unbind,this),this.bind=f(this.bind,this),this.publish=f(this.publish,this),this.sync=f(this.sync,this),this.set=f(this.set,this),this.formattedValue=f(this.formattedValue,this),this.isBidirectional=f(this.isBidirectional,this),this.routine=function(){switch(this.options.special){case"event":return i(this.type);case"class":return r(this.type);case"iteration":return o(this.type);default:return e.routines[this.type]||t(this.type)}}.call(this),this.formatters=this.options.formatters||[]}return u.prototype.isBidirectional=function(){var e;return(e=this.type)==="value"||e==="checked"||e==="unchecked"},u.prototype.formattedValue=function(t){var n,r,i,s,o,u,a,f;u=this.formatters;for(s=0,o=u.length;s<o;s++)r=u[s],n=r.split(/\s+/),i=n.shift(),t=this.model[i]instanceof Function?(a=this.model)[i].apply(a,[t].concat(l.call(n))):e.formatters[i]?(f=e.formatters)[i].apply(f,[t].concat(l.call(n))):void 0;return t},u.prototype.set=function(e){return e=e instanceof Function&&this.options.special!=="event"?this.formattedValue(e.call(this.model)):this.formattedValue(e),this.options.special==="event"?this.currentListener=this.routine(this.el,this.model,e,this.currentListener):this.options.special==="iteration"?this.routine(this.el,e,this):this.routine(this.el,e)},u.prototype.sync=function(){return this.set(this.options.bypass?this.model[this.keypath]:e.config.adapter.read(this.model,this.keypath))},u.prototype.publish=function(){return e.config.adapter.publish(this.model,this.keypath,s(this.el))},u.prototype.bind=function(){var t,r,i,s,o,u,a,f;this.options.bypass?this.sync():(e.config.adapter.subscribe(this.model,this.keypath,this.sync),e.config.preloadData&&this.sync(),this.isBidirectional()&&n(this.el,"change",this.publish));if((u=this.options.dependencies)!=null?u.length:void 0){a=this.options.dependencies,f=[];for(s=0,o=a.length;s<o;s++)t=a[s],/^\./.test(t)?(i=this.model,r=t.substr(1)):(t=t.split("."),i=this.view.models[t.shift()],r=t.join(".")),f.push(e.config.adapter.subscribe(i,r,this.sync));return f}},u.prototype.unbind=function(){var t,n,r,i,s,o;this.options.bypass||(e.config.adapter.unsubscribe(this.model,this.keypath,this.sync),this.isBidirectional()&&a(this.el,"change",this.publish));if((i=this.options.dependencies)!=null?i.length:void 0){s=this.options.dependencies,o=[];for(n=0,r=s.length;n<r;n++)t=s[n],o.push(e.config.adapter.unsubscribe(this.model,t,this.sync));return o}},u}(),e.View=function(){function t(e,t){this.els=e,this.models=t,this.publish=f(this.publish,this),this.sync=f(this.sync,this),this.unbind=f(this.unbind,this),this.bind=f(this.bind,this),this.select=f(this.select,this),this.build=f(this.build,this),this.bindingRegExp=f(this.bindingRegExp,this),this.els.jquery||this.els instanceof Array||(this.els=[this.els]),this.build()}return t.prototype.bindingRegExp=function(){var t;return t=e.config.prefix,t?RegExp("^data-"+t+"-"):/^data-/},t.prototype.build=function(){var t,n,r,i,s,o,u,a,f,l,h,p,d,v,m,g=this;this.bindings=[],f=[],o=null,t=this.bindingRegExp(),i=/^on-/,n=/^class-/,s=/^each-/,a=function(r){var u,a,l,h,p,d,v,m,y,b,w,E,S,x,T,N,C,k,L,A,O,M,_,D,P,H;if(c.call(f,r)<0){D=r.attributes;for(N=0,A=D.length;N<A;N++){a=D[N];if(t.test(a.name)){T=a.name.replace(t,"");if(s.test(T)&&!g.models[T.replace(s,"")]){P=r.getElementsByTagName("*");for(C=0,O=P.length;C<O;C++)y=P[C],f.push(y);o=[a]}}}H=o||r.attributes;for(k=0,M=H.length;k<M;k++){a=H[k];if(t.test(a.name)){b={},T=a.name.replace(t,""),S=function(){var e,t,n,r;n=a.value.split("|"),r=[];for(e=0,t=n.length;e<t;e++)E=n[e],r.push(E.trim());return r}(),h=function(){var e,t,n,r;n=S.shift().split("<"),r=[];for(e=0,t=n.length;e<t;e++)p=n[e],r.push(p.trim());return r}(),w=h.shift(),x=w.split(/\.|:/),b.formatters=S,b.bypass=w.indexOf(":")!==-1,x[0]?m=g.models[x.shift()]:(m=g.models,x.shift()),v=x.join(".");if(m){if(d=h.shift())b.dependencies=d.split(/\s+/);i.test(T)&&(T=T.replace(i,""),b.special="event"),n.test(T)&&(T=T.replace(n,""),b.special="class"),s.test(T)&&(T=T.replace(s,""),b.special="iteration"),l=new e.Binding(r,T,m,v,b),l.view=g,g.bindings.push(l)}}if(o){for(L=0,_=o.length;L<_;L++)u=o[L],r.removeAttribute(u.name);o=null}}}},v=this.els;for(l=0,p=v.length;l<p;l++){r=v[l],a(r),m=r.getElementsByTagName("*");for(h=0,d=m.length;h<d;h++)u=m[h],a(u)}},t.prototype.select=function(e){var t,n,r,i,s;i=this.bindings,s=[];for(n=0,r=i.length;n<r;n++)t=i[n],e(t)&&s.push(t);return s},t.prototype.bind=function(){var e,t,n,r,i;r=this.bindings,i=[];for(t=0,n=r.length;t<n;t++)e=r[t],i.push(e.bind());return i},t.prototype.unbind=function(){var e,t,n,r,i;r=this.bindings,i=[];for(t=0,n=r.length;t<n;t++)e=r[t],i.push(e.unbind());return i},t.prototype.sync=function(){var e,t,n,r,i;r=this.bindings,i=[];for(t=0,n=r.length;t<n;t++)e=r[t],i.push(e.sync());return i},t.prototype.publish=function(){var e,t,n,r,i;r=this.select(function(e){return e.isBidirectional()}),i=[];for(t=0,n=r.length;t<n;t++)e=r[t],i.push(e.publish());return i},t}(),n=function(e,t,n,r){var i;return i=function(e){return n.call(r,e)},window.jQuery!=null?(e=jQuery(e),e.on!=null?e.on(t,i):e.bind(t,i)):window.addEventListener!=null?e.addEventListener(t,i,!1):(t="on"+t,e.attachEvent(t,i)),i},a=function(e,t,n){return window.jQuery!=null?(e=jQuery(e),e.off!=null?e.off(t,n):e.unbind(t,n)):window.removeEventListener?e.removeEventListener(t,n,!1):(t="on"+t,e.detachEvent(t,n))},s=function(e){var t,n,r,i;switch(e.type){case"checkbox":return e.checked;case"select-multiple":i=[];for(n=0,r=e.length;n<r;n++)t=e[n],t.selected&&i.push(t.value);return i;default:return e.value}},i=function(e){return function(t,r,i,s){return s&&a(t,e,s),n(t,e,i,r)}},r=function(e){return function(t,n){var r,i;r=" "+t.className+" ",i=r.indexOf(" "+e+" ")!==-1;if(!n===i)return t.className=n?""+t.className+" "+e:r.replace(" "+e+" "," ").trim()}},o=function(e){return function(t,n,r){var i,s,o,a,f,l,c,h,p,d,v,m,g,y,b;if(r.iterated!=null){m=r.iterated;for(h=0,d=m.length;h<d;h++)a=m[h],a.view.unbind(),a.el.parentNode.removeChild(a.el)}else r.marker=document.createComment(" rivets: each-"+e+" "),t.parentNode.insertBefore(r.marker,t),t.parentNode.removeChild(t);r.iterated=[],b=[];for(p=0,v=n.length;p<v;p++){s=n[p],i={},g=r.view.models;for(l in g)f=g[l],i[l]=f;i[e]=s,o=t.cloneNode(!0),c=r.iterated[r.iterated.length-1]||r.marker,r.marker.parentNode.insertBefore(o,(y=c.nextSibling)!=null?y:null),b.push(r.iterated.push({el:o,view:u.bind(o,i)}))}return b}},t=function(e){return function(t,n){return n?t.setAttribute(e,n):t.removeAttribute(e)}},e.routines={enabled:function(e,t){return e.disabled=!t},disabled:function(e,t){return e.disabled=!!t},checked:function(e,t){return e.type==="radio"?e.checked=e.value===t:e.checked=!!t},unchecked:function(e,t){return e.type==="radio"?e.checked=e.value!==t:e.checked=!t},show:function(e,t){return e.style.display=t?"":"none"},hide:function(e,t){return e.style.display=t?"none":""},html:function(e,t){return e.innerHTML=t!=null?t:""},value:function(e,t){var n,r,i,s,o;if(e.type!=="select-multiple")return e.value=t!=null?t:"";if(t!=null){o=[];for(r=0,i=e.length;r<i;r++)n=e[r],o.push(n.selected=(s=n.value,c.call(t,s)>=0));return o}},text:function(e,t){return e.innerText!=null?e.innerText=t!=null?t:"":e.textContent=t!=null?t:""}},e.config={preloadData:!0},e.formatters={},u={routines:e.routines,formatters:e.formatters,config:e.config,configure:function(t){var n,r;t==null&&(t={});for(n in t)r=t[n],e.config[n]=r},bind:function(t,n){var r;return n==null&&(n={}),r=new e.View(t,n),r.bind(),r}},typeof module!="undefined"&&module!==null?module.exports=u:this.rivets=u}.call(this),function(){var e,t=[].slice;e=function(){var e;return e={efns:[],fns:[],completed:!1,wrap:function(){return function(){var n,r;return r=arguments[0],n=2>arguments.length?[]:t.call(arguments,1),r!=null?e.abort(r):e.resolve.apply(e,n)}},resolve:function(){var n,r,i,s,o;r=1>arguments.length?[]:t.call(arguments,0),e.val=r,e.completed=!0,o=e.fns;for(i=0,s=o.length;i<s;i++)n=o[i],n.apply(null,r);return e},abort:function(t){var n,r,i,s;e.err=t,e.completed=!0,s=e.efns;for(r=0,i=s.length;r<i;r++)n=s[r],n(t);return e},fail:function(t){return e.err?t(e.err):e.efns.push(t),e},when:function(t){return e.val?t.apply(null,e.val):e.fns.push(t),e}}},e.join=function(){var n,r,i,s,o,u,a;o=1>arguments.length?[]:t.call(arguments,0),n=[],i=e(),r=function(){var e,s;return e=1>arguments.length?[]:t.call(arguments,0),s=o.pop(),s?s.when(function(){var e;return e=1>arguments.length?[]:t.call(arguments,0),n.push(e),r.apply(null,e)}):i.resolve.apply(i,n)};for(u=0,a=o.length;u<a;u++)s=o[u],s.fail(i.abort);return r(),i},typeof module!="undefined"&&module!==null?module.exports=e:window.swear=e}.call(this),function(){var e,t,n,r={}.hasOwnProperty,i=function(e,t){function i(){this.constructor=e}for(var n in t)r.call(t,n)&&(e[n]=t[n]);return i.prototype=t.prototype,e.prototype=new i,e.__super__=t.prototype,e};e={lastHash:null,listeners:[],listen:function(e){return n.hash.listeners.push(e)},trigger:function(e){var t,r,i,s;e==null&&(e=n.hash.value()),n.hash.lastHash=e,s=n.hash.listeners;for(r=0,i=s.length;r<i;r++)t=s[r],t(e)},value:function(t){return t&&(window.location.hash=t),e=window.location.hash.replace("#",""),e===""&&(e="/"),e}},t={},i(t,e),t.value=function(e){return e&&(n.hash.lastHash=e,window.location.hash=e),window.location.hash.replace("#","")},t.check=function(){var e;e=n.hash.value(),e!==n.hash.lastHash&&n.hash.trigger(e),setTimeout(n.hash.check,100)},n={lastMatch:null,routes:[],route:function(e,t){var r,i,s;return s="^"+e+"$",s=s.replace(/([?=,\/])/g,"\\$1").replace(/:([\w\d]+)/g,"([^/]*)"),i={route:e,names:e.match(/:([\w\d]+)/g),pattern:RegExp(s),fn:t},n.routes.push(i),r=n.hash.value(),n.isMatch(r,i)&&n.triggerMatch(r,i),n},isMatch:function(e,t){return t.pattern.exec(e)!=null},triggerMatch:function(e,t){var r,i,s,o,u,a,f;n.lastMatch=e,o={};if(t.names){r=t.pattern.exec(e).slice(1),f=t.names;for(i=u=0,a=f.length;u<a;i=++u)s=f[i],o[s.substring(1)]=r[i]}t.fn(o)},matches:function(e){var t,r,i,s,o;s=n.routes,o=[];for(r=0,i=s.length;r<i;r++)t=s[r],n.isMatch(e,t)&&o.push(t);return o},test:function(e){var t,r,i,s;r=n.matches(e);if(r.length<=0)return;for(i=0,s=r.length;i<s;i++)t=r[i],n.triggerMatch(e,t)}},typeof window.onhashchange!="undefined"?(n.hash=e,window.onhashchange=function(){return n.hash.trigger(n.hash.value())}):(n.hash=t,setTimeout(n.hash.check,100)),n.hash.listen(n.test),n.hash.check&&n.hash.check(),window.rooter=n}.call(this),function(){var e,t,n,r,i=[].indexOf||function(e){for(var t=0,n=this.length;t<n;t++)if(t in this&&this[t]===e)return t;return-1},s=[].slice;window.dermis={stack:[],use:function(e){return dermis.stack.push(e)},runStack:function(e,t,n){var r,i;if(dermis.stack.length===0)return n();r=-1,i=function(){var s;return s=dermis.stack[++r],s==null?n():s(e,t,i)},i()},current:null,cache:{},handleRoute:function(e){return dermis.cache[e]||(dermis.cache[e]=swear(),require([e],function(t){var n,r;return(r=t.name)==null&&(t.name=e),n=mixer.create().extend(t),n.init?(n.on("ready",function(){return dermis.cache[e].resolve(n)}),n.emit("loading"),n.init()):dermis.cache[e].resolve(n)})),function(t){return dermis.cache[e].completed||dermis.emit("preshow",dermis.cache[e]),dermis.cache[e].when(function(e){return dermis.runStack(e,t,function(){var n,r;return(n=dermis.current)!=null&&typeof n.hide=="function"&&n.hide(),(r=dermis.current)!=null&&r.emit("hide"),e.show(t),e.emit("show"),dermis.current=e})})}},rivets:{adapter:{subscribe:function(e,t,n){return t===""&&e.isCollection&&(e.on("remove",n),e.on("add",n)),e.on(t!==""?"change:"+t:"change",n)},unsubscribe:function(e,t,n){return t===""&&e.isCollection&&(e.off("remove",n),e.off("add",n)),e.off(t!==""?"change:"+t:"change",n)},read:function(e,t){return t===""&&e.isCollection&&(t="items"),e.get(t)},publish:function(e,t,n){return t===""&&e.isCollection&&(t="items"),e.set(t,n)}},routines:{val:function(e,t){var n,r,s,o,u;if(e.type!=="select-multiple")return e.value=t!=null?t:"";if(t!=null){u=[];for(r=0,s=e.length;r<s;r++)n=e[r],u.push(n.selected=(o=n.value,i.call(t,o)>=0));return u}}},formatters:{plural:function(e){return e!==1},exists:function(e){return e!=null},overZero:function(e){return e>0},length:function(e){return e!=null?e.length:0}}},modelPreset:{bind:function(e){return dermis.bind(e,this)}},collectionPreset:{isCollection:!0,remove:function(){var e,t,n;return t=1>arguments.length?[]:s.call(arguments,0),n=function(){var n,r,s,o;s=this.get("items"),o=[];for(n=0,r=s.length;n<r;n++)e=s[n],i.call(t,e)<0&&o.push(e);return o}.call(this),this.set("items",n),this.emit("remove",t)},push:function(){var e,t,n,r,o,u=this;t=1>arguments.length?[]:s.call(arguments,0);for(r=0,o=t.length;r<o;r++)e=t[r],(e!=null?e.on:void 0)!=null&&function(e){var t;return t=function(){return i.call(u.get("items"),e)<0?e.off("change",t):u.emit("change:child",e)},e.on("change",t)}(e);return n=this.get("items").concat(t),this.set("items",n),this.emit("add",n)}},route:function(e,t){var n,r,i;n=e==="/"?"index":((r=/\/(.*?)\//.exec(e))!=null?r[1]:void 0)||((i=/\/(.*)/.exec(e))!=null?i[1]:void 0),t==null&&(t="routes/"+n),rooter.route(e,dermis.handleRoute(t))},model:function(e){return mixer.create().extend(dermis.modelPreset).extend(e)},collection:function(e){return mixer.create().extend(dermis.modelPreset).extend(dermis.collectionPreset).set("items",[]).extend(e)},bind:function(e,t){return rivets.configure({adapter:dermis.rivets.adapter}),rivets.bind(e,t)}},n=dermis.rivets.formatters;for(e in n)t=n[e],rivets.formatters[e]=t;r=dermis.rivets.routines;for(e in r)t=r[e],rivets.routines[e]=t;mixer.extend(dermis,mixer)}.call(this);