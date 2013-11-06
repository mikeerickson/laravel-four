var delayedDisplay = function () {

	var _timeInterval  = 1000*60*60*24	     // timeInterval (24hrs)
	,   checkInterval  = 1000*2          	 // check interval (every 10 seconds it will check)
	,   storageKey     = 'dt_nextTime'
	,   _nextTime      = 0
	,   _displayDiv    = 'test';

	// private callback
	function checkTime () {
		_nextTime = store.get(storageKey);
		if(getCurrentTime() >= _nextTime)
			showDiv(_displayDiv);
	}

	function resetTimer() {
		_nextTime = getNextTime();
		store.set(_nextTime);
	}

	function setDiv(divID) {
		_displayDiv = divID;
	}

	function getDiv() {
		return _displayDiv;
	}

	function setTimeInterval(timeInt) {
		_timeInterval = timeInt;
		_nextTime = getNextTime();
		store.set(storageKey,_nextTime);
	}

	function getTimeInterval() {
		return _timeInterval;
	}

	function getNextTime() {
		return new Date().getTime() + _timeInterval;
	}

	function getNextDisplayTime() {
		return strftime('%Y-%m-%d %H:%M:%S',new Date(store.get(storageKey)));
	}

	function getCurrentTime() {
		return new Date().getTime();
	}

	function hideDiv() {
		document.getElementById(_displayDiv).style.display = "none";
		_nextTime = getNextTime();
		store.set(storageKey,_nextTime);	// update counter
	}

	function showDiv() {
		document.getElementById(_displayDiv).style.display = "inline";
	}

	function startTimer(options) {

		if(typeof options === 'object') {
			if(typeof options.timeInterval !== 'undefined') {
				setTimeInterval(options.timeInterval);
				console.log(_timeInterval);
			}
		}

		_nextTime = store.get(storageKey);
		if (typeof _nextTime === 'undefined') {
			_nextTime = getNextTime();
			store.set(storageKey,_nextTime);
		}

		setInterval(checkTime,checkInterval); // start checker thread (will check every 'check' intervals)
	}

   return {
        startTimer:         startTimer,
        setTimeInterval:    setTimeInterval,
        setDiv:             setDiv,
        hideDiv:            hideDiv,
        showDiv:            showDiv,
        getNextTime:        getNextTime,
        resetTimer:         resetTimer,
        getNextDisplayTime: getNextDisplayTime
    };

}();


