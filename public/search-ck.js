function SearchCtrl(e,t){e.url="http://localhost:8000/angular";e.search=function(){t.post(e.url,{data:e.keywords}).success(function(t,n,r,i){e.status=n;e.data=t;e.result=t}).error(function(t,n,r,i){e.data=t||"Request failed";e.status=n})}}angular.module("ng").filter("tel",function(){return function(e){if(!e)return"";var t=e.toString().trim().replace(/^\+/,"");if(t.match(/[^0-9]/))return e;var n,r,i;switch(t.length){case 10:n=1;r=t.slice(0,3);i=t.slice(3);break;case 11:n=t[0];r=t.slice(1,4);i=t.slice(4);break;case 12:n=t.slice(0,3);r=t.slice(3,5);i=t.slice(5);break;default:return e}n==1&&(n="");i=i.slice(0,3)+"-"+i.slice(3);return(n+" ("+r+") "+i).trim()}});