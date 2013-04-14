/*
Flot plugin for stacking data sets, i.e. putting them on top of each
other, for accumulative graphs.

The plugin assumes the data is sorted on x (or y if stacking
horizontally). For line charts, it is assumed that if a line has an
undefined gap (from a null point), then the line above it should have
the same gap - insert zeros instead of "null" if you want another
behaviour. This also holds for the start and end of the chart. Note
that stacking a mix of positive and negative values in most instances
doesn't make sense (so it looks weird).

Two or more series are stacked when their "stack" attribute is set to
the same key (which can be any number or string or just "true"). To
specify the default stack, you can set

  series: {
    stack: null or true or key (number/string)
  }

or specify it for a specific series

  $.plot($("#placeholder"), [{ data: [ ... ], stack: true }])
  
The stacking order is determined by the order of the data series in
the array (later series end up on top of the previous).

Internally, the plugin modifies the datapoints in each series, adding
an offset to the y value. For line series, extra data points are
inserted through interpolation. If there's a second y value, it's also
adjusted (e.g for bar charts or filled areas).
*/(function(e){function n(e){function t(e,t){var n=null;for(var r=0;r<t.length;++r){if(e==t[r])break;t[r].stack==e.stack&&(n=t[r])}return n}function n(e,n,r){if(n.stack==null)return;var i=t(n,e.getData());if(!i)return;var s=r.pointsize,o=r.points,u=i.datapoints.pointsize,a=i.datapoints.points,f=[],l,c,h,p,d,v,g=n.lines.show,y=n.bars.horizontal,b=s>2&&(y?r.format[2].x:r.format[2].y),w=g&&n.lines.steps,E=!0,S=y?1:0,x=y?0:1,T=0,N=0,C;for(;;){if(T>=o.length)break;C=f.length;if(o[T]==null){for(m=0;m<s;++m)f.push(o[T+m]);T+=s}else if(N>=a.length){if(!g)for(m=0;m<s;++m)f.push(o[T+m]);T+=s}else if(a[N]==null){for(m=0;m<s;++m)f.push(null);E=!0;N+=u}else{l=o[T+S];c=o[T+x];p=a[N+S];d=a[N+x];v=0;if(l==p){for(m=0;m<s;++m)f.push(o[T+m]);f[C+x]+=d;v=d;T+=s;N+=u}else if(l>p){if(g&&T>0&&o[T-s]!=null){h=c+(o[T-s+x]-c)*(p-l)/(o[T-s+S]-l);f.push(p);f.push(h+d);for(m=2;m<s;++m)f.push(o[T+m]);v=d}N+=u}else{if(E&&g){T+=s;continue}for(m=0;m<s;++m)f.push(o[T+m]);g&&N>0&&a[N-u]!=null&&(v=d+(a[N-u+x]-d)*(l-p)/(a[N-u+S]-p));f[C+x]+=v;T+=s}E=!1;C!=f.length&&b&&(f[C+2]+=v)}if(w&&C!=f.length&&C>0&&f[C]!=null&&f[C]!=f[C-s]&&f[C+1]!=f[C-s+1]){for(m=0;m<s;++m)f[C+s+m]=f[C+m];f[C+1]=f[C-s+1]}}r.points=f}e.hooks.processDatapoints.push(n)}var t={series:{stack:null}};e.plot.plugins.push({init:n,options:t,name:"stack",version:"1.2"})})(jQuery);