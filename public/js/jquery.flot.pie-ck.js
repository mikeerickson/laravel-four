/*
Flot plugin for rendering pie charts. The plugin assumes the data is 
coming is as a single data value for each series, and each of those 
values is a positive value or zero (negative numbers don't make 
any sense and will cause strange effects). The data values do 
NOT need to be passed in as percentage values because it 
internally calculates the total and percentages.

* Created by Brian Medendorp, June 2009
* Updated November 2009 with contributions from: btburnett3, Anthony Aragues and Xavi Ivars

* Changes:
	2009-10-22: lineJoin set to round
	2009-10-23: IE full circle fix, donut
	2009-11-11: Added basic hover from btburnett3 - does not work in IE, and center is off in Chrome and Opera
	2009-11-17: Added IE hover capability submitted by Anthony Aragues
	2009-11-18: Added bug fix submitted by Xavi Ivars (issues with arrays when other JS libraries are included as well)
		

Available options are:
series: {
	pie: {
		show: true/false
		radius: 0-1 for percentage of fullsize, or a specified pixel length, or 'auto'
		innerRadius: 0-1 for percentage of fullsize or a specified pixel length, for creating a donut effect
		startAngle: 0-2 factor of PI used for starting angle (in radians) i.e 3/2 starts at the top, 0 and 2 have the same result
		tilt: 0-1 for percentage to tilt the pie, where 1 is no tilt, and 0 is completely flat (nothing will show)
		offset: {
			top: integer value to move the pie up or down
			left: integer value to move the pie left or right, or 'auto'
		},
		stroke: {
			color: any hexidecimal color value (other formats may or may not work, so best to stick with something like '#FFF')
			width: integer pixel width of the stroke
		},
		label: {
			show: true/false, or 'auto'
			formatter:  a user-defined function that modifies the text/style of the label text
			radius: 0-1 for percentage of fullsize, or a specified pixel length
			background: {
				color: any hexidecimal color value (other formats may or may not work, so best to stick with something like '#000')
				opacity: 0-1
			},
			threshold: 0-1 for the percentage value at which to hide labels (if they're too small)
		},
		combine: {
			threshold: 0-1 for the percentage value at which to combine slices (if they're too small)
			color: any hexidecimal color value (other formats may or may not work, so best to stick with something like '#CCC'), if null, the plugin will automatically use the color of the first slice to be combined
			label: any text value of what the combined slice should be labeled
		}
		highlight: {
			opacity: 0-1
		}
	}
}

More detail and specific examples can be found in the included HTML file.

*/(function(e){function t(t){function g(e,t){if(t.series.pie.show){t.grid.show=!1;t.series.pie.label.show=="auto"&&(t.legend.show?t.series.pie.label.show=!1:t.series.pie.label.show=!0);t.series.pie.radius=="auto"&&(t.series.pie.label.show?t.series.pie.radius=.75:t.series.pie.radius=1);t.series.pie.tilt>1&&(t.series.pie.tilt=1);t.series.pie.tilt<0&&(t.series.pie.tilt=0);e.hooks.processDatapoints.push(S);e.hooks.drawOverlay.push(j);e.hooks.draw.push(k)}}function b(e,t){var n=e.getOptions();n.series.pie.show&&n.grid.hoverable&&t.unbind("mousemove").mousemove(M);n.series.pie.show&&n.grid.clickable&&t.unbind("click").click(_)}function w(e){function n(e,r){r||(r=0);for(var i=0;i<e.length;++i){for(var s=0;s<r;s++)t+="	";if(typeof e[i]=="object"){t+=""+i+":\n";n(e[i],r+1)}else t+=""+i+": "+e[i]+"\n"}}var t="";n(e);alert(t)}function E(e){for(var t=0;t<e.length;++t){var n=parseFloat(e[t].data[0][1]);n&&(f+=n)}}function S(t,i,o,u){if(!d){d=!0;r=t.getCanvas();s=e(r).parent();n=t.getOptions();t.setData(C(t.getData()))}}function T(){var e=t.getPlaceholder(),r=e.width(),i=e.height();p=s.children().filter(".legend").children().width();o=Math.min(r,i/n.series.pie.tilt)/2;a=i/2+n.series.pie.offset.top;u=r/2;n.series.pie.offset.left=="auto"?n.legend.position.match("w")?u+=p/2:u-=p/2:u+=n.series.pie.offset.left;u<o?u=o:u>r-o&&(u=r-o)}function N(e){for(var t=0;t<e.length;++t)if(typeof e[t].data=="number")e[t].data=[[1,e[t].data]];else if(typeof e[t].data=="undefined"||typeof e[t].data[0]=="undefined"){typeof e[t].data!="undefined"&&typeof e[t].data.label!="undefined"&&(e[t].label=e[t].data.label);e[t].data=[[1,0]]}return e}function C(e){e=N(e);E(e);var t=0,r=0,i=n.series.pie.combine.color,s=[];for(var o=0;o<e.length;++o){e[o].data[0][1]=parseFloat(e[o].data[0][1]);e[o].data[0][1]||(e[o].data[0][1]=0);if(e[o].data[0][1]/f<=n.series.pie.combine.threshold){t+=e[o].data[0][1];r++;i||(i=e[o].color)}else s.push({data:[[1,e[o].data[0][1]]],color:e[o].color,label:e[o].label,angle:e[o].data[0][1]*Math.PI*2/f,percent:e[o].data[0][1]/f*100})}r>0&&s.push({data:[[1,t]],color:i,label:n.series.pie.combine.label,angle:t*Math.PI*2/f,percent:t/f*100});return s}function k(t,i){function d(){ctx.clearRect(0,0,r.width,r.height);s.children().filter(".pieLabel, .pieLabelBackground").remove()}function v(){var e=5,t=15,i=10,s=.02;if(n.series.pie.radius>1)var f=n.series.pie.radius;else var f=o*n.series.pie.radius;if(f>=r.width/2-e||f*n.series.pie.tilt>=r.height/2-t||f<=i)return;ctx.save();ctx.translate(e,t);ctx.globalAlpha=s;ctx.fillStyle="#000";ctx.translate(u,a);ctx.scale(1,n.series.pie.tilt);for(var l=1;l<=i;l++){ctx.beginPath();ctx.arc(0,0,f,0,Math.PI*2,!1);ctx.fill();f-=l}ctx.restore()}function m(){function h(n,r,s){if(n<=0)return;if(s)ctx.fillStyle=r;else{ctx.strokeStyle=r;ctx.lineJoin="round"}ctx.beginPath();Math.abs(n-Math.PI*2)>1e-9?ctx.moveTo(0,0):e.browser.msie&&(n-=1e-4);ctx.arc(0,0,t,i,i+n,!1);ctx.closePath();i+=n;s?ctx.fill():ctx.stroke()}function p(){function h(t,o,f){if(t.data[0][1]==0)return;var c=n.legend.labelFormatter,h,p=n.series.pie.label.formatter;c?h=c(t.label,t):h=t.label;p&&(h=p(h,t));var d=(o+t.angle+o)/2,v=u+Math.round(Math.cos(d)*i),m=a+Math.round(Math.sin(d)*i)*n.series.pie.tilt,g='<span class="pieLabel" id="pieLabel'+f+'" style="position:absolute;top:'+m+"px;left:"+v+'px;">'+h+"</span>";s.append(g);var y=s.children("#pieLabel"+f),b=m-y.height()/2,w=v-y.width()/2;y.css("top",b);y.css("left",w);if(0-b>0||0-w>0||r.height-(b+y.height())<0||r.width-(w+y.width())<0)l=!0;if(n.series.pie.label.background.opacity!=0){var E=n.series.pie.label.background.color;E==null&&(E=t.color);var S="top:"+b+"px;left:"+w+"px;";e('<div class="pieLabelBackground" style="position:absolute;width:'+y.width()+"px;height:"+y.height()+"px;"+S+"background-color:"+E+';"> </div>').insertBefore(y).css("opacity",n.series.pie.label.background.opacity)}}var t=startAngle;if(n.series.pie.label.radius>1)var i=n.series.pie.label.radius;else var i=o*n.series.pie.label.radius;for(var c=0;c<f.length;++c){f[c].percent>=n.series.pie.label.threshold*100&&h(f[c],t,c);t+=f[c].angle}}startAngle=Math.PI*n.series.pie.startAngle;if(n.series.pie.radius>1)var t=n.series.pie.radius;else var t=o*n.series.pie.radius;ctx.save();ctx.translate(u,a);ctx.scale(1,n.series.pie.tilt);ctx.save();var i=startAngle;for(var c=0;c<f.length;++c){f[c].startAngle=i;h(f[c].angle,f[c].color,!0)}ctx.restore();ctx.save();ctx.lineWidth=n.series.pie.stroke.width;i=startAngle;for(var c=0;c<f.length;++c)h(f[c].angle,n.series.pie.stroke.color,!1);ctx.restore();L(ctx);n.series.pie.label.show&&p();ctx.restore()}if(!s)return;ctx=i;T();var f=t.getData(),p=0;while(l&&p<c){l=!1;p>0&&(o*=h);p+=1;d();n.series.pie.tilt<=.8&&v();m()}if(p>=c){d();s.prepend('<div class="error">Could not draw pie with labels contained inside canvas</div>')}if(t.setSeries&&t.insertLegend){t.setSeries(f);t.insertLegend()}}function L(e){if(n.series.pie.innerRadius>0){e.save();innerRadius=n.series.pie.innerRadius>1?n.series.pie.innerRadius:o*n.series.pie.innerRadius;e.globalCompositeOperation="destination-out";e.beginPath();e.fillStyle=n.series.pie.stroke.color;e.arc(0,0,innerRadius,0,Math.PI*2,!1);e.fill();e.closePath();e.restore();e.save();e.beginPath();e.strokeStyle=n.series.pie.stroke.color;e.arc(0,0,innerRadius,0,Math.PI*2,!1);e.stroke();e.closePath();e.restore()}}function A(e,t){for(var n=!1,r=-1,i=e.length,s=i-1;++r<i;s=r)(e[r][1]<=t[1]&&t[1]<e[s][1]||e[s][1]<=t[1]&&t[1]<e[r][1])&&t[0]<(e[s][0]-e[r][0])*(t[1]-e[r][1])/(e[s][1]-e[r][1])+e[r][0]&&(n=!n);return n}function O(e,n){var r=t.getData(),i=t.getOptions(),s=i.series.pie.radius>1?i.series.pie.radius:o*i.series.pie.radius;for(var f=0;f<r.length;++f){var l=r[f];if(l.pie.show){ctx.save();ctx.beginPath();ctx.moveTo(0,0);ctx.arc(0,0,s,l.startAngle,l.startAngle+l.angle,!1);ctx.closePath();x=e-u;y=n-a;if(ctx.isPointInPath){if(ctx.isPointInPath(e-u,n-a)){ctx.restore();return{datapoint:[l.percent,l.data],dataIndex:0,series:l,seriesIndex:f}}}else{p1X=s*Math.cos(l.startAngle);p1Y=s*Math.sin(l.startAngle);p2X=s*Math.cos(l.startAngle+l.angle/4);p2Y=s*Math.sin(l.startAngle+l.angle/4);p3X=s*Math.cos(l.startAngle+l.angle/2);p3Y=s*Math.sin(l.startAngle+l.angle/2);p4X=s*Math.cos(l.startAngle+l.angle/1.5);p4Y=s*Math.sin(l.startAngle+l.angle/1.5);p5X=s*Math.cos(l.startAngle+l.angle);p5Y=s*Math.sin(l.startAngle+l.angle);arrPoly=[[0,0],[p1X,p1Y],[p2X,p2Y],[p3X,p3Y],[p4X,p4Y],[p5X,p5Y]];arrPoint=[x,y];if(A(arrPoly,arrPoint)){ctx.restore();return{datapoint:[l.percent,l.data],dataIndex:0,series:l,seriesIndex:f}}}ctx.restore()}}return null}function M(e){D("plothover",e)}function _(e){D("plotclick",e)}function D(e,r){var i=t.offset(),o=parseInt(r.pageX-i.left),u=parseInt(r.pageY-i.top),a=O(o,u);if(n.grid.autoHighlight)for(var f=0;f<m.length;++f){var l=m[f];l.auto==e&&(!a||l.series!=a.series)&&H(l.series)}a&&P(a.series,e);var c={pageX:r.pageX,pageY:r.pageY};s.trigger(e,[c,a])}function P(e,n){typeof e=="number"&&(e=series[e]);var r=B(e);if(r==-1){m.push({series:e,auto:n});t.triggerRedrawOverlay()}else n||(m[r].auto=!1)}function H(e){if(e==null){m=[];t.triggerRedrawOverlay()}typeof e=="number"&&(e=series[e]);var n=B(e);if(n!=-1){m.splice(n,1);t.triggerRedrawOverlay()}}function B(e){for(var t=0;t<m.length;++t){var n=m[t];if(n.series==e)return t}return-1}function j(e,t){function s(e){if(e.angle<0)return;t.fillStyle="rgba(255, 255, 255, "+n.series.pie.highlight.opacity+")";t.beginPath();Math.abs(e.angle-Math.PI*2)>1e-9&&t.moveTo(0,0);t.arc(0,0,r,e.startAngle,e.startAngle+e.angle,!1);t.closePath();t.fill()}var n=e.getOptions(),r=n.series.pie.radius>1?n.series.pie.radius:o*n.series.pie.radius;t.save();t.translate(u,a);t.scale(1,n.series.pie.tilt);for(i=0;i<m.length;++i)s(m[i].series);L(t);t.restore()}var r=null,s=null,o=null,u=null,a=null,f=0,l=!0,c=10,h=.95,p=0,d=!1,v=!1,m=[];t.hooks.processOptions.push(g);t.hooks.bindEvents.push(b)}var n={series:{pie:{show:!1,radius:"auto",innerRadius:0,startAngle:1.5,tilt:1,offset:{top:0,left:"auto"},stroke:{color:"#FFF",width:1},label:{show:"auto",formatter:function(e,t){return'<div style="font-size:x-small;text-align:center;padding:2px;color:'+t.color+';">'+e+"<br/>"+Math.round(t.percent)+"%</div>"},radius:1,background:{color:null,opacity:0},threshold:0},combine:{threshold:-1,color:null,label:"Other"},highlight:{opacity:.5}}}};e.plot.plugins.push({init:t,options:n,name:"pie",version:"1.0"})})(jQuery);