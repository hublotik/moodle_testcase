/*
YUI 3.17.2 (build 9c3c78e)
Copyright 2014 Yahoo! Inc. All rights reserved.
Licensed under the BSD License.
http://yuilibrary.com/license/
*/

YUI.add("widget-position-constrain",function(e,t){function m(e){}var n="constrain",r="constrain|xyChange",i="constrainChange",s="preventOverlap",o="align",u="",a="bindUI",f="xy",l="x",c="y",h=e.Node,p="viewportRegion",d="region",v;m.ATTRS={constrain:{value:null,setter:"_setConstrain"},preventOverlap:{value:!1}},v=m._PREVENT_OVERLAP={x:{tltr:1,blbr:1,brbl:1,trtl:1},y:{trbr:1,tlbl:1,bltl:1,brtr:1}},m.prototype={initializer:function(){this._posNode||e.error("WidgetPosition needs to be added to the Widget, before WidgetPositionConstrain is added"),e.after(this._bindUIPosConstrained,this,a)},getConstrainedXY:function(e,t){t=t||this.get(n);var r=this._getRegion(t===!0?null:t),i=this._posNode.get(d);return[this._constrain(e[0],l,i,r),this._constrain(e[1],c,i,r)]},constrain:function(e,t){var r,i,s=t||this.get(n);s&&(r=e||this.get(f),i=this.getConstrainedXY(r,s),(i[0]!==r[0]||i[1]!==r[1])&&this.set(f,i,{constrained:!0}))},_setConstrain:function(e){return e===!0?e:h.one(e)},_constrain:function(e,t,n,r){if(r){this.get(s)&&(e=this._preventOverlap(e,t,n,r));var i=t==l,o=i?r.width:r.height,u=i?n.width:n.height,a=i?r.left:r.top,f=i?r.right-u:r.bottom-u;if(e<a||e>f)u<o?e<a?e=a:e>f&&(e=f):e=a}return e},_preventOverlap:function(e,t,n,r){var i=this.get(o),s=t===l,a,f,c,h,p,d;return i&&i.points&&v[t][i.points.join(u)]&&(f=this._getRegion(i.node),f&&(a=s?n.width:n.height,c=s?f.left:f.top,h=s?f.right:f.bottom,p=s?f.left-r.left:f.top-r.top,d=s?r.right-f.right:r.bottom-f.bottom),e>c?d<a&&p>a&&(e=c-a):p<a&&d>a&&(e=h)),e},_bindUIPosConstrained:function(){this.after(i,this._afterConstrainChange),this._enableConstraints(this.get(n))},_afterConstrainChange:function(e){this._enableConstraints(e.newVal)},_enableConstraints:function(e){e?(this.constrain(),this._cxyHandle=this._cxyHandle||this.on(r,this._constrainOnXYChange)):this._cxyHandle&&(this._cxyHandle.detach(),this._cxyHandle=null)},_constrainOnXYChange:function(e){e.constrained||(e.newVal=this.getConstrainedXY(e.newVal))},_getRegion:function(e){var t;return e?(e=h.one(e),e&&(t=e.get(d))):t=this._posNode.get(p),t}},e.WidgetPositionConstrain=m},"3.17.2",{requires:["widget-position"]});
