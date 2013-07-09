$(function() {
	console.log('Moment JS Date: '+moment().format('MMMM Do YYYY, h:mm:ss a'));
	console.log(moment().subtract('seconds', 32).fromNow());

	$('select').select2();
/* 			alert(jQuery.fn.jquery); */
	$.expr[':'].containsIgnoreCase = function(n,i,m){
		return jQuery(n).text().toUpperCase().indexOf(m[3].toUpperCase())>=0;
	};

	$("#queryFilter").keyup(function(){
		$("#mainList").find("tr").hide();
		var data = this.value.split(" ");
		var jo = $("#mainList").find("tr");
		$.each(data, function(i, v){

		//Use the new containsIgnoreCase function instead
		if(v.length)
			jo = jo.filter("*:containsIgnoreCase('"+v+"')");
			// jo = jo.filter("*:contains('"+v+"')");
	});

	jo.show();

	}).focus(function(){
		this.value="";
		$(this).css({"color":"black"});
		$(this).unbind('focus');
	}).css({"color":"#C0C0C0"});

	// dont move this into main.js, needs to stay here ot work
	$('#contact').parsley( {listeners: {
	    onFormSubmit: function ( isFormValid, event ) {
	        if ( !isFormValid  ) {
				$("#msgAlert").show();
				$("#msgAlert").addClass('alert-error');
				$("#msgHdr").html("Validation Error");
				$("#msgBody").html("You have errors in your form, pleaes correct and try again.");
	        }
	    }
	}});

});
