

function confirmDelete(msg) {
	if (confirm("Eintrag von: " + msg + "\nwirklich löschen?") == true) {
		return true;
	}
	else {
		return false;
	}
}

function checkValues(form) {

	return true;
}

function goBack() {
    window.history.back();
    return false;
}