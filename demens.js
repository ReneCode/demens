

function confirmDelete(msg) {
	if (confirm("Eintrag von: " + msg + "\nwirklich löschen?") == true) {
		return true;
	}
	else {
		return false;
	}
}



function checkValues(form) {
	// check that fields (ids of the fields)
	var check = ['author', 'status'];
	for (var i=0; i<check.length; i++) {
		var element = document.getElementById(check[i]);
		var ok = true;
		if (element) {
			switch (element.nodeName.toLowerCase()) {
			case 'select':
				if (element.value == ''  ||  element.value == 'Bitte auswählen') {
					ok = false;
				}
				break;
			}
			if (!ok) {
				element.focus();		
				return false;
			}
		}
	}
	return true;
}

function goBack() {
    window.history.back();
    return false;
}