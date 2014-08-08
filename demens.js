

function confirmDelete(msg) {
	if (confirm("Eintrag von: " + msg + "\nwirklich löschen?") == true) {
		return true;
	}
	else {
		return false;
	}
}