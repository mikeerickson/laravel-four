/*
	app.js
	 created by:  Mike Erickson, codedungeon@gmail.com
	 created:     2013-09-02 16:50:31
	 modified:    2013-09-20 16:06:28

	You can change either of these values:

		- timeInterval = number of milliseconds before div is displayed
		- checkInterval = number of milliseconds to check pool (The higher the value, the more latency)

	Revision History

	2013-09-02: Initial Relese
	2013-09-20: Refactored to use storage object (remove requirements for cookies)
*/

var timeInterval  = 1000*60*60*24	     // timeInterval (24hrs)
,   checkInterval = 1000*2          	 // check interval (every 10 seconds it will check)
,   storageKey    = 'dt_nextTime'
,   _nextTime     = 0;


/* ------------------------------------------------------------------------------------
   Testing code:  Remove the next two lines when ready for production
   ------------------------------------------------------------------------------------ */

// store.remove(storageKey); // clear
timeInterval = 1000 * 10;





// get last setting
_nextTime = store.get(storageKey);

// setup timer objects
if (typeof _nextTime === 'undefined') {
	_nextTime = getNextTime();
	store.set(storageKey,_nextTime);
}

function checkTime () {
	_nextTime = store.get(storageKey);
	if(getCurrentTime() >= _nextTime)
		showDiv('test');
}

function getNextTime() {
	return new Date().getTime() + timeInterval;
}

function getNextDisplayTime() {
	return strftime('%Y-%m-%d %H:%M:%S',new Date(store.get(storageKey)));
}

function getCurrentTime() {
	return new Date().getTime();
}

function hideDiv() {
	document.getElementById('test').style.display = "none";
	_nextTime = getNextTime();
	store.set(storageKey,_nextTime);	// update counter
}

function showDiv(divID) {
	document.getElementById(divID).style.display = "inline";
}

setInterval(checkTime,checkInterval); // start checker thread (will check every 'check' intervals)
