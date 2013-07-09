function formFocus() {
	if (document.forms.length > 0) {
		var formElements = ["text", "checkbox", "radio", "select-one", "select-multiple", "textarea"];
		var form = document.forms[document.forms.length - 1];
		for (var j = 0; j < form.elements.length; j++) {
			var field = form.elements[j];
			for (var x = 0; x < formElements.length; x++) {
				if (field.getAttribute("type") == formElements[x]) {
					field.focus();
					return false;
				}
			}
		}
	}
}
