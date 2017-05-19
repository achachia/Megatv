/*
jQWidgets v3.7.1 (2015-Feb)
Copyright (c) 2011-2015 jQWidgets.
License: http://jqwidgets.com/license/
*/

(function(a){a.jqx.jqxWidget("jqxTooltip","",{});a.extend(a.jqx._jqxTooltip.prototype,{defineInstance:function(){var b={width:"auto",height:"auto",position:"default",enableBrowserBoundsDetection:true,content:"",left:0,top:0,absolutePositionX:0,absolutePositionY:0,trigger:"hover",showDelay:100,autoHide:true,autoHideDelay:3000,closeOnClick:true,disabled:false,animationShowDelay:200,animationHideDelay:"fast",showArrow:true,name:"",opacity:0.9,rtl:false,_isOpen:false,opening:null,value:null,_eventsMap:{mousedown:a.jqx.mobile.getTouchEventName("touchstart"),mouseup:a.jqx.mobile.getTouchEventName("touchend")},events:["open","close","opening","closing"]};a.extend(true,this,b);return b},createInstance:function(d){this._isTouchDevice=a.jqx.mobile.isTouchDevice();var f=a.data(document.body,"_tooltipIDArray"+this.name);if(!f){this.ID_Array=new Array();a.data(document.body,"_tooltipIDArray"+this.name,this.ID_Array)}else{this.ID_Array=f}var e=this._generatekey();var c="jqxtooltip"+e;this.ID_Array.push({tooltipID:c,tooltipHost:this.host});var b=a('<div id="'+c+'"><div id ="'+c+'Main"><div id="'+c+'Text"></div></div><div id="'+c+'Arrow"></div></div>');if(a.jqx.browser.msie){b.addClass(this.toThemeProperty("jqx-noshadow"))}a("body").append(b);this._setTheme();var g=a("#"+c);g.css("visibility","hidden");g.css("display","none");g.css("opacity",0);g.css("z-index",99999);if(this.showArrow==false){a("#"+c+"Arrow").css("visibility","hidden");a("#"+c+"Arrow").css("display","none")}this._setSize();this._setContent();if(this.disabled==false){this._trigger();if(this.closeOnClick==true){this._clickHide()}}},open:function(){if(arguments){if(arguments.length){if(arguments.length==2){this.position="absolute";this.left=arguments[0];this.top=arguments[1];this.absolutePositionX=arguments[0];this.absolutePositionY=arguments[1]}}}if(this.disabled==false&&this._id()!="removed"){if(this.position=="mouse"||this.position=="mouseenter"){var b=this.position;this.position="default";this._raiseEvent("2");this._setPosition();this._animateShow();this.position=b}else{this._raiseEvent("2");this._setPosition();this._animateShow()}}},close:function(c){var e=this;if(typeof(c)==="object"&&a.isEmptyObject(c)){c=this.animationHideDelay}var b=new Number(a(this._id()).css("opacity")).toFixed(2);var d=function(){clearTimeout(e.autoHideTimeout);e._raiseEvent("3");a(e._id()).animate({opacity:0},c,function(){a(e._id()).css("visibility","hidden");a(e._id()).css("display","none");e._raiseEvent("1");e._isOpen=false})};if(this._isOpen==false&&b!=0){a(e._id()).stop();d();return}if(this._isOpen==true&&b==this.opacity){d()}},destroy:function(){var c=this.ID_Array.length;this._removeHandlers();a(this._id()).remove();for(var b=0;b<c;b++){if(this.ID_Array[b].tooltipHost===this.host){this.ID_Array.splice(b,1);break}}a(this.element).removeData("jqxTooltip")},refresh:function(d){if(d==true){return}if(this.rtl){a(this._id()+"Text").addClass(this.toThemeProperty("jqx-rtl"));a(this._id()+"Text").css({direction:"rtl"})}var c=this;var b=new Number(a(this._id()).css("opacity")).toFixed(2);if(this._id()!="removed"){if(this.disabled==true&&this._isOpen==true&&b==this.opacity){clearTimeout(this.autoHideTimeout);a(this._id()).stop();a(this._id()).animate({opacity:0},this.animationHideDelay,function(){a(c._id()).css("visibility","hidden");a(c._id()).css("display","none");c._isOpen=false})}this._setTheme();this._setContent();this._setSize();if(this.position!="mouse"&&this.position!="mouseenter"){this._setPosition()}this._removeHandlers();if(this.disabled==false){this._trigger();if(this.closeOnClick==true){this._clickHide()}}}},propertyChangedHandler:function(b,c,e,d){if(c=="content"){this.changeContentFlag=true}b.refresh()},_raiseEvent:function(g,e){var c=this.events[g];var f=new a.Event(c);f.owner=this;f.args=e;try{var b=this.host.trigger(f)}catch(d){}return b},_generatekey:function(){var b=function(){return(((1+Math.random())*65536)|0).toString(16).substring(1)};return(b()+b())},_id:function(){var b,c;var e=this.ID_Array.length;for(var d=0;d<e;d++){if(this.ID_Array[d].tooltipHost===this.host){b=this.ID_Array[d].tooltipID;c="#"+b;break}}if(c==undefined){c="removed"}return c},_setPosition:function(f){if((this._isOpen==false&&a(this._id()).css("opacity")==0)||this.changeContentFlag==true){if(!f&&(this.position=="mouse"||this.position=="mouseenter")){return}a(this._id()).css("display","block");this.changeContentFlag=false;this.documentTop=a(document).scrollTop();this.documentLeft=a(document).scrollLeft();this.windowWidth=a(window).width();this.windowHeight=a(window).height();this.host_width=this.host.outerWidth();this.host_height=this.host.outerHeight();this.tooltip_width=a(this._id()).width();this.tooltip_height=a(this._id()).height();this.host_offset=this.host.offset();this.tooltip_offset=a(this._id()).offset();this.default_offset=30;this.offset_horizontal=parseInt(this.left);this.offset_vertical=parseInt(this.top);var d=a(this._id()+"Arrow");var g=a(this._id()+"Main");this.arrow_size=5;this.tooltip_main_offset=g.offset();this.tooltip_arrow_offset;switch(this.position){case"top":this.tooltip_offset.left=this.host_offset.left+this.host_width/2-this.tooltip_width/2+this.offset_horizontal;this.tooltip_offset.top=this.host_offset.top-this.tooltip_height-this.arrow_size+this.offset_vertical;this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.css({"border-width":this.arrow_size+"px "+this.arrow_size+"px  0px"});this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=this.tooltip_main_offset.left+((g.width())/2-this.arrow_size);this.tooltip_arrow_offset.top=this.tooltip_main_offset.top+g.height();d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left});break;case"bottom":this.tooltip_offset.left=this.host_offset.left+this.host_width/2-this.tooltip_width/2+this.offset_horizontal;this.tooltip_offset.top=this.host_offset.top+this.host_height+this.arrow_size+this.offset_vertical;this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.css({"border-width":"0 "+this.arrow_size+"px "+this.arrow_size+"px"});this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=this.tooltip_main_offset.left+((g.width())/2-this.arrow_size);this.tooltip_arrow_offset.top=this.tooltip_main_offset.top-this.arrow_size;d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left});break;case"left":this.tooltip_offset.left=-1+this.host_offset.left-this.tooltip_width-this.arrow_size+this.offset_horizontal;this.tooltip_offset.top=this.host_offset.top+this.host_height/2-this.tooltip_height/2+this.offset_vertical;this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.css({"border-width":this.arrow_size+"px 0px "+this.arrow_size+"px "+this.arrow_size+"px"});this.tooltip_main_offset=g.offset();this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=1+this.tooltip_main_offset.left+g.width();this.tooltip_arrow_offset.top=this.tooltip_main_offset.top+(g.height())/2-this.arrow_size;d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left});break;case"right":this.tooltip_offset.left=this.host_offset.left+this.host_width+this.arrow_size+this.offset_horizontal;this.tooltip_offset.top=this.host_offset.top+this.host_height/2-this.tooltip_height/2+this.offset_vertical;this.tooltip_offset.top=parseInt(this.tooltip_offset.top);this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.css({"border-width":this.arrow_size+"px "+this.arrow_size+"px "+this.arrow_size+"px 0px"});this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=(this.tooltip_main_offset.left-this.arrow_size);this.tooltip_arrow_offset.top=this.tooltip_main_offset.top+(g.height())/2-this.arrow_size;d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left});break;case"top-left":this.tooltip_offset.left=this.host_offset.left+this.default_offset-this.tooltip_width+this.offset_horizontal;this.tooltip_offset.top=this.host_offset.top-this.tooltip_height-this.arrow_size+this.offset_vertical;this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.css({"border-width":this.arrow_size+"px "+this.arrow_size+"px  0px"});this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=this.tooltip_main_offset.left+g.width()-6*this.arrow_size;this.tooltip_arrow_offset.top=this.tooltip_main_offset.top+g.height();d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left});break;case"bottom-left":this.tooltip_offset.left=this.host_offset.left+this.default_offset-this.tooltip_width+this.offset_horizontal;this.tooltip_offset.top=this.host_offset.top+this.host_height+this.arrow_size+this.offset_vertical;this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.css({"border-width":"0 "+this.arrow_size+"px "+this.arrow_size+"px"});this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=this.tooltip_main_offset.left+g.width()-6*this.arrow_size;this.tooltip_arrow_offset.top=this.tooltip_main_offset.top-this.arrow_size;d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left});break;case"top-right":this.tooltip_offset.left=this.host_offset.left+this.host_width-this.default_offset+this.offset_horizontal;this.tooltip_offset.top=this.host_offset.top-this.tooltip_height-this.arrow_size+this.offset_vertical;this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.css({"border-width":this.arrow_size+"px "+this.arrow_size+"px  0px"});this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=this.tooltip_main_offset.left+4*this.arrow_size;this.tooltip_arrow_offset.top=this.tooltip_main_offset.top+g.height();d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left});break;case"bottom-right":this.tooltip_offset.left=this.host_offset.left+this.host_width-this.default_offset+this.offset_horizontal;this.tooltip_offset.top=this.host_offset.top+this.host_height+this.arrow_size+this.offset_vertical;this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.css({"border-width":"0 "+this.arrow_size+"px "+this.arrow_size+"px"});this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=this.tooltip_main_offset.left+4*this.arrow_size;this.tooltip_arrow_offset.top=this.tooltip_main_offset.top-this.arrow_size;d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left});break;case"absolute":a(this._id()).offset({top:this.absolutePositionY,left:this.absolutePositionX});d.css({"border-width":"0px"});break;case"mouse":var e=this;if(this._isTouchDevice==false){switch(this.trigger){case"hover":if(this.mouseHoverTimeout){clearTimeout(this.mouseHoverTimeout)}this.mouseHoverTimeout=setTimeout(function(){e.tooltip_offset.left=f.pageX+10;e.tooltip_offset.top=f.pageY+10;e._detectBrowserBounds()},this.showDelay);break;case"click":this.tooltip_offset.left=f.pageX+10;this.tooltip_offset.top=f.pageY+10;this._detectBrowserBounds();break}}else{var b=f.pageX;var i=f.pageY;if(f.originalEvent){var h=null;if(f.originalEvent.touches&&f.originalEvent.touches.length){var h=f.originalEvent.touches[0]}else{if(f.originalEvent.changedTouches&&f.originalEvent.changedTouches.length){var h=f.originalEvent.changedTouches[0]}}if(h!=undefined){b=h.pageX;i=h.pageY}}this.tooltip_offset.left=b+10;this.tooltip_offset.top=i+10;this._detectBrowserBounds()}d.css({"border-width":"0px"});break;case"mouseenter":var c={top:f.pageY,left:f.pageX};if((c.top<(this.host_offset.top+10))&&(c.top>(this.host_offset.top-10))){this.tooltip_offset.left=c.left-this.tooltip_width/2;this.tooltip_offset.top=this.host_offset.top-this.tooltip_height-this.arrow_size;this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.css({"border-width":this.arrow_size+"px "+this.arrow_size+"px  0px"});this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=this.tooltip_main_offset.left+((g.width())/2-this.arrow_size);this.tooltip_arrow_offset.top=this.tooltip_main_offset.top+g.height();d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left})}else{if((c.top<((this.host_offset.top+this.host_height)+10))&&(c.top>((this.host_offset.top+this.host_height)-10))){this.tooltip_offset.left=c.left-this.tooltip_width/2;this.tooltip_offset.top=this.host_offset.top+this.host_height+this.arrow_size;this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.css({"border-width":"0 "+this.arrow_size+"px "+this.arrow_size+"px"});this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=this.tooltip_main_offset.left+((g.width())/2-this.arrow_size);this.tooltip_arrow_offset.top=this.tooltip_main_offset.top-this.arrow_size;d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left})}else{if((c.left<(this.host_offset.left+10))&&(c.left>(this.host_offset.left-10))){this.tooltip_offset.left=this.host_offset.left-this.tooltip_width-this.arrow_size;this.tooltip_offset.top=c.top-this.tooltip_height/2;this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.css({"border-width":this.arrow_size+"px 0px "+this.arrow_size+"px "+this.arrow_size+"px"});this.tooltip_main_offset=g.offset();this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=this.tooltip_main_offset.left+g.width();this.tooltip_arrow_offset.top=this.tooltip_main_offset.top+(g.height())/2-this.arrow_size;d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left})}else{if((c.left<(this.host_offset.left+this.host_width+10))&&(c.left>(this.host_offset.left+this.host_width-10))){this.tooltip_offset.left=this.host_offset.left+this.host_width+this.arrow_size;this.tooltip_offset.top=c.top-this.tooltip_height/2;this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.css({"border-width":this.arrow_size+"px "+this.arrow_size+"px "+this.arrow_size+"px 0px"});this.tooltip_main_offset=g.offset();this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=(this.tooltip_main_offset.left-this.arrow_size);this.tooltip_arrow_offset.top=this.tooltip_main_offset.top+(g.height())/2-this.arrow_size;d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left})}}}}break;case"default":this.tooltip_offset.left=this.host_offset.left+this.host_width-this.default_offset;this.tooltip_offset.top=this.host_offset.top+this.host_height+this.arrow_size;this._detectBrowserBounds();this.tooltip_main_offset=g.offset();d.removeClass(this.toThemeProperty("jqx-tooltip-arrow-l-r"));d.addClass(this.toThemeProperty("jqx-tooltip-arrow-t-b"));d.css({"border-width":"0 "+this.arrow_size+"px "+this.arrow_size+"px"});this.tooltip_arrow_offset=d.offset();this.tooltip_arrow_offset.left=this.tooltip_main_offset.left+4*this.arrow_size;this.tooltip_arrow_offset.top=this.tooltip_main_offset.top-this.arrow_size;d.offset({top:this.tooltip_arrow_offset.top,left:this.tooltip_arrow_offset.left});break}}},_setContent:function(){a(this._id()+"Text").html(this.content)},opened:function(){return this._isOpen&&this.host.css("display")=="block"&&this.host.css("visibility")=="visible"},_animateShow:function(){this._closeAll();clearTimeout(this.autoHideTimeout);var b=new Number(a(this._id()).css("opacity")).toFixed(2);if(this._isOpen==false&&b==0){var c=this;var e=a(this._id());e.css("visibility","visible");e.css("display","block");e.stop();e.css("opacity",0);if(this.opening){var d=this.opening(this);if(d===false){return}}e.animate({opacity:this.opacity},this.animationShowDelay,function(){c._raiseEvent("0");c._isOpen=true;var f=a.data(document.body,"_openedTooltip"+c.name);c.openedTooltip=c;a.data(document.body,"_openedTooltip"+c.name,c);if(c.autoHideTimeout){clearTimeout(c.autoHideTimeout)}if(c.autoHideDelay>0&&c.autoHide===true){c.autoHideTimeout=setTimeout(function(){c._autoHide()},c.autoHideDelay)}})}},_trigger:function(){if(this._id()!="removed"){this._enterFlag;this._leaveFlag;var b=this;if(this._isTouchDevice==false){switch(this.trigger){case"hover":if(this.position=="mouse"){this.addHandler(this.host,"mousemove.tooltip",function(c){if(b._enterFlag==1){b._raiseEvent("2");b._setPosition(c);clearTimeout(b.hoverShowTimeout);b.hoverShowTimeout=setTimeout(function(){b._animateShow();b._enterFlag=0},b.showDelay)}});this.addHandler(this.host,"mouseenter.tooltip",function(){if(b._leaveFlag!=0){b._enterFlag=1}});this.addHandler(this.host,"mouseleave.tooltip",function(e){b._leaveFlag=1;clearTimeout(b.hoverShowTimeout);var f=a(b._id()).offset();var d=a(b._id()).width();var c=a(b._id()).height();if(parseInt(e.pageX)<parseInt(f.left)||parseInt(e.pageX)>parseInt(f.left)+d){b.close()}if(parseInt(e.pageY)<parseInt(f.top)||parseInt(e.pageY)>parseInt(f.top)+c){b.close()}});this.addHandler(a(this._id()),"mouseleave.tooltip",function(c){b._checkBoundariesAuto(c);if(b._clickFlag!=0&&b._autoFlag!=0){b._leaveFlag=0}else{b._leaveFlag=1;b.close()}})}else{this.addHandler(this.host,"mouseenter.tooltip",function(c){clearTimeout(b.hoverShowTimeout);b.hoverShowTimeout=setTimeout(function(){b._raiseEvent("2");b._setPosition(c);b._animateShow()},b.showDelay)});this.addHandler(this.host,"mouseleave.tooltip",function(f){b._leaveFlag=1;clearTimeout(b.hoverShowTimeout);if(b.autoHide){var d=f.pageX;var j=f.pageY;var g=a(b._id()).offset();var i=g.left;var h=g.top;var e=a(b._id()).width();var c=a(b._id()).height();if(parseInt(d)<parseInt(i)||parseInt(d)>parseInt(i)+e||parseInt(j)<parseInt(h)||parseInt(j)>parseInt(h)+c){b.close()}}});this.addHandler(a(this._id()),"mouseleave.tooltip",function(c){b._checkBoundariesAuto(c);if(b._clickFlag!=0&&b._autoFlag!=0){b._leaveFlag=0}else{b._leaveFlag=1;if(b.autoHide){b.close()}}})}break;case"click":this.addHandler(this.host,"click.tooltip",function(c){if(b.position=="mouseenter"){b.position="mouse"}b._raiseEvent("2");b._setPosition(c);b._animateShow()});break;case"none":break}}else{if(this.trigger!="none"){this.addHandler(this.host,"touchstart.tooltip",function(c){if(b.position=="mouseenter"){b.position="mouse"}b._raiseEvent("2");b._setPosition(c);b._animateShow()})}}}},_autoHide:function(){var c=this;var b=new Number(a(this._id()).css("opacity")).toFixed(2);if(this.autoHide==true&&this._isOpen==true&&b>=this.opacity){c._raiseEvent("3");a(c._id()).animate({opacity:0},c.animationHideDelay,function(){a(c._id()).css("visibility","hidden");a(c._id()).css("display","none");c._raiseEvent("1");c._isOpen=false})}},_clickHide:function(){var b=this;this.addHandler(a(this._id()),"click.tooltip",function(c){b._checkBoundariesClick(c);b.close()})},_setSize:function(){a(this._id()).css({width:this.width,height:this.height})},resize:function(){this._setSize()},_setTheme:function(){var e=this._id();var d=a(e+"Main");var c=a(e+"Text");var b=a(e+"Arrow");d.addClass(this.toThemeProperty("jqx-widget"));c.addClass(this.toThemeProperty("jqx-widget"));b.addClass(this.toThemeProperty("jqx-widget"));d.addClass(this.toThemeProperty("jqx-fill-state-normal"));c.addClass(this.toThemeProperty("jqx-fill-state-normal"));b.addClass(this.toThemeProperty("jqx-fill-state-normal"));a(e).addClass(this.toThemeProperty("jqx-tooltip"));a(e).addClass(this.toThemeProperty("jqx-popup"));d.addClass(this.toThemeProperty("jqx-tooltip-main"));c.addClass(this.toThemeProperty("jqx-tooltip-text"));b.addClass(this.toThemeProperty("jqx-tooltip-arrow"))},_initialPosition:function(){var b=this.position;this.position="default";this._setPosition();this.position=b},_detectBrowserBounds:function(){var b=this._id();if(this.enableBrowserBoundsDetection){if(this.tooltip_offset.top<this.documentTop&&this.tooltip_offset.left<0){a(b).offset({top:this.documentTop,left:this.documentLeft})}else{if(this.tooltip_offset.top<this.documentTop&&(this.tooltip_offset.left+this.tooltip_width)>this.windowWidth+this.documentLeft){a(b).offset({top:this.documentTop,left:(this.windowWidth+this.documentLeft-this.tooltip_width)})}else{if(this.tooltip_offset.top<this.documentTop){a(b).offset({top:this.documentTop,left:this.tooltip_offset.left})}else{if((this.tooltip_offset.top+this.tooltip_height)>(this.windowHeight+this.documentTop)&&this.tooltip_offset.left<0){a(b).offset({top:(this.windowHeight+this.documentTop-this.tooltip_height),left:this.documentLeft})}else{if((this.tooltip_offset.top+this.tooltip_height)>(this.windowHeight+this.documentTop)&&(this.tooltip_offset.left+this.tooltip_width)>this.windowWidth+this.documentLeft){a(b).offset({top:(this.windowHeight+this.documentTop-this.tooltip_height),left:(this.windowWidth+this.documentLeft-this.tooltip_width)})}else{if((this.tooltip_offset.top+this.tooltip_height)>(this.windowHeight+this.documentTop)){a(b).offset({top:(this.windowHeight+this.documentTop-this.tooltip_height),left:this.tooltip_offset.left})}else{if(this.tooltip_offset.left<0){a(b).offset({top:this.tooltip_offset.top,left:this.documentLeft})}else{if((this.tooltip_offset.left+this.tooltip_width)>this.windowWidth+this.documentLeft){a(b).offset({top:this.tooltip_offset.top,left:(this.windowWidth+this.documentLeft-this.tooltip_width)})}else{a(b).offset({top:this.tooltip_offset.top,left:this.tooltip_offset.left})}}}}}}}}}else{a(b).offset({top:this.tooltip_offset.top,left:this.tooltip_offset.left})}},_checkBoundaries:function(b){if(b.pageX>=this.host_offset.left&&b.pageX<=(this.host_offset.left+this.host_width)&&b.pageY>=this.host_offset.top&&b.pageY<=(this.host_offset.top+this.host_height)){return true}else{return false}},_checkBoundariesClick:function(b){if(this._checkBoundaries(b)){this._clickFlag=1}else{this._clickFlag=0}},_checkBoundariesAuto:function(b){if(this._checkBoundaries(b)){this._autoFlag=1}else{this._autoFlag=0}},_removeHandlers:function(){this.removeHandler(this.host,"mouseenter.tooltip");this.removeHandler(this.host,"mousemove.tooltip");this.removeHandler(this.host,"mouseleave.tooltip");this.removeHandler(this.host,"click.tooltip");this.removeHandler(this.host,"touchstart.tooltip");this.removeHandler(a(this._id()),"click.tooltip");this.removeHandler(a(this._id()),"mouseleave.tooltip")},_closeAll:function(){var d=this.ID_Array.length;for(var c=0;c<d;c++){var b="#"+this.ID_Array[c].tooltipID;if(b!=this._id()){a(b).css({opacity:0,visibility:"hidden",display:"none"});this._isOpen=false}}}})})(jqxBaseFramework);