$(function(){$("select").chosen({allow_single_deselect:!0});$(".chosen-container").css("width","130px").css("font-size","11px");$.expr[":"].containsIgnoreCase=function(e,t,n){return jQuery(e).text().toUpperCase().indexOf(n[3].toUpperCase())>=0};$("#queryFilterClear").on("click",function(){$("#queryFilter").val("");$("#mainList").find("tr").show()});$("#queryValue").on("keyup",function(){this.value.length?$("#queryFindBtn").removeAttr("disabled"):$("#queryFindBtn").attr("disabled","disabled")});$("#toolbarQuery").on("click",function(){$elem=$("#queryText");if($elem.text()=="Show Query"){$elem.text("Hide Query");$("#formAdvancedQuery").show()}else{$elem.text("Show Query");$("#formAdvancedQuery").hide()}$("#queryValue").val().length==0?$("#queryFindBtn").attr("disabled","disabled"):$("#queryFindBtn").removeAttr("disabled")});if($("#queryValue").val()){$("#queryText").text("Hide Query");$("#formAdvancedQuery").show()}$("#queryFilter").keyup(function(){$("#mainList").find("tr").hide();var e=this.value.split(" "),t=$("#mainList").find("tr");$.each(e,function(e,n){n.length&&(t=t.filter("*:containsIgnoreCase('"+n+"')"))});t.show()}).focus(function(){this.value="";$(this).css({color:"black"});$(this).unbind("focus")}).css({color:"#C0C0C0"});$("#contact").parsley({listeners:{onFormSubmit:function(e,t){if(!e){$("#msgAlert").show();$("#msgAlert").addClass("alert-error");$("#msgHdr").html("Validation Error");$("#msgBody").html("You have errors in your form, pleaes correct and try again.")}}}})});