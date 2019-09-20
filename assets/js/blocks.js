!function(e){var t={};function n(l){if(t[l])return t[l].exports;var o=t[l]={i:l,l:!1,exports:{}};return e[l].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,l){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:l})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var l=Object.create(null);if(n.r(l),Object.defineProperty(l,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(l,o,function(t){return e[t]}.bind(null,o));return l},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/wp-content/themes/hrs.wsu.edu/assets/js/",n(n.s=1)}([function(e,t){!function(){e.exports=this.wp.element}()},function(e,t,n){"use strict";n.r(t);var l=wp.i18n.__,o=wp.blocks,a=o.registerBlockStyle,r=o.unregisterBlockStyle,c=function(){a("core/button",{name:"text",label:l("Text")}),a("core/button",{name:"small",label:l("Small")}),a("core/list",{name:"alpha",label:l("Alphabetical")}),wp.domReady((function(){r("core/button","squared")}))},i=n(0),s=wp.i18n,u=s.__,b=s._x,m=wp.blocks.registerBlockType,p=wp.components,d=p.Dashicon,f=p.IconButton,g=p.PanelBody,h=p.ToggleControl,y=wp.editor,v=y.InspectorControls,w=y.URLInput,k=y.RichText,O=wp.element.Fragment,j="hrs-wsu-edu/notifications",B={message:{type:"string",source:"html",selector:"p"},showActionButton:{type:"boolean",default:!0},actionButtonUrl:{type:"string",source:"attribute",selector:"a",attribute:"href"},actionButtonTitle:{type:"string",source:"attribute",selector:"a",attribute:"title"},actionButtonText:{type:"string",source:"html",selector:"a"}};var E=wp.i18n,_=E.__,x=E._x,S=wp.blocks.registerBlockType,C=wp.editor.InnerBlocks,T="hrs-wsu-edu/callouts",N=[["core/paragraph",{fontSize:"large",placeholder:"Callout title…"}],["core/paragraph",{placeholder:"Enter the callout message or replace…"}]];var A=wp.i18n,P=A.__,D=A._x,I=wp.blocks.registerBlockType,U=wp.editor.InnerBlocks,M="hrs-wsu-edu/sidebar",z=[["core/column",{placeholder:"Content"}],["core/column",{placeholder:"Sidebar."}]],F=["core/column"];c(),m(j,{title:u("Notification"),description:u("Show a brief notification message with optional action button."),icon:"block-default",category:"layout",keywords:[u("callout"),u("message"),u("link")],attributes:B,supports:{align:!0},styles:[{name:"default",label:b("Default","block style"),isDefault:!0},{name:"positive",label:b("Positive","block style")},{name:"caution",label:b("Caution","block style")},{name:"warning",label:b("Warning","block style")}],edit:function(e){var t=e.className,n=e.attributes,l=e.setAttributes,o=e.isSelected,a=n.message,r=n.showActionButton,c=n.actionButtonUrl,s=n.actionButtonText,b=n.actionButtonTitle;return Object(i.createElement)(O,null,Object(i.createElement)(v,null,Object(i.createElement)(g,{title:u("Action Button Settings")},Object(i.createElement)(h,{label:u("Show Action Button"),checked:r,onChange:function(e){return l({showActionButton:e})}}))),Object(i.createElement)("div",{className:t,title:b},Object(i.createElement)(k,{placeholder:u("Write message…"),value:a,onChange:function(e){return l({message:e})},formattingControls:["bold","italic"],className:"hrs-wsu-edu-block-notifications__message",keepPlaceholderOnFocus:!0}),r&&Object(i.createElement)(k,{placeholder:u("Add text… "),value:s,onChange:function(e){return l({actionButtonText:e})},formattingControls:[],className:"wp-block-button__link",keepPlaceholderOnFocus:!0})),o&&r&&Object(i.createElement)("form",{className:"block-library-button__inline-link",onSubmit:function(e){return e.preventDefault()}},Object(i.createElement)(d,{icon:"admin-links"}),Object(i.createElement)(w,{value:c,onChange:function(e){return l({actionButtonUrl:e})}}),Object(i.createElement)(f,{icon:"editor-break",label:u("Apply"),type:"submit"})))},save:function(e){var t=e.attributes,n=t.message,l=t.showActionButton,o=t.actionButtonUrl,a=t.actionButtonText,r=t.actionButtonTitle;return Object(i.createElement)("div",null,Object(i.createElement)(k.Content,{tagName:"p",value:n}),l&&Object(i.createElement)(k.Content,{tagName:"a",className:"wp-block-button__link",href:o,title:r,value:a}))}}),S(T,{title:_("Callout"),description:_("Display content in a callout module."),icon:"index-card",category:"layout",keywords:[_("callout"),_("message")],supports:{align:!0},styles:[{name:"default",label:x("Default","block style"),isDefault:!0},{name:"positive",label:x("Positive","block style")},{name:"caution",label:x("Caution","block style")},{name:"warning",label:x("Warning","block style")}],edit:function(e){var t=e.className;return Object(i.createElement)("div",{className:t},void 0!==e.insertBlocksAfter&&Object(i.createElement)(C,{template:N,templateInsertUpdatesSelection:!1}))},save:function(){return Object(i.createElement)("div",null,Object(i.createElement)(C.Content,null))}}),I(M,{title:P("Sidebar"),description:P("Display content in a sidebar-style layout (two-thirds and one-third)."),icon:Object(i.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"468 268 24 24"},Object(i.createElement)("path",{fill:"none",d:"M468 268h24v24h-24v-24z"}),Object(i.createElement)("path",{d:"M472 272h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-16a2 2 0 0 1-2-2v-12c0-1.1.9-2 2-2zm0 2v12h10v-12h-10zm12 0v12h4v-12h-4z"})),category:"layout",keywords:[P("sidebar"),P("columns")],supports:{align:["wide","full"]},styles:[{name:"sidebar-right",label:D("Sidebar on right","block style"),isDefault:!0},{name:"sidebar-left",label:D("Sidebar on left","block style")}],edit:function(e){var t=e.className;return Object(i.createElement)("div",{className:"".concat(t," wp-block-columns")},void 0!==e.insertBlocksAfter&&Object(i.createElement)(U,{template:z,templateLock:"all",templateInsertUpdatesSelection:!1,allowedBlocks:F}))},save:function(){return Object(i.createElement)("div",{className:"wp-block-columns"},Object(i.createElement)(U.Content,null))}})}]);
//# sourceMappingURL=blocks.js.map