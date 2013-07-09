humane.baseCls = 'humane-original';

function displayMessage(whatToSay, type) {
	switch (type) {
		case "success":
			humane.info = humane.spawn({
				addnCls: 'humane-jackedup-success',
				timeout: 2000
			});
			break;
		case "error":
			humane.info = humane.spawn({
				addnCls: 'humane-jackedup-error',
				timeout: 2000
			});
			break;
		case "info":
			humane.info = humane.spawn({
				addnCls: 'humane-jackedup-info',
				timeout: 2000
			});
			break;
		default:
			humane.info = humane.spawn({
				addnCls: 'humane-jackedup-success',
				timeout: 2000
			});
	}
	humane.info(whatToSay);

}