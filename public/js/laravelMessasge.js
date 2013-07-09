@if (!is_null(Session::get('message')))

		$msg = '{{ Session::get('message') }}';
		var msgObj = eval("(" + $msg + ')');

	$("#msgAlert").show();

	$msgClass = msgObj.msgType;
	$msgHdr   = msgObj.msgHdr;
	$msgBody  = msgObj.msgBody;


	$msgClass != "" ? $("#msgAlert").addClass($msgClass) : $("#msgAlert").addClass('alert-block');
	$msgHdr != "" ? $("#msgHdr").html($msgHdr) : '';

	$("#msgBody").html($msgBody);

@endif
