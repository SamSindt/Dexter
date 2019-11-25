function favorite (element, pkid) {
	var newEl = document.createElement("h1");
	newEl.setAttribute ("class", "fave");
	newEl.setAttribute ("id", "faved");
	newEl.setAttribute ("onclick", "unfavorite(this, " + String(pkid) + ")");
	newEl.innerHTML = "★";
	element.parentNode.replaceChild(newEl, element);
	
	$.ajax({
		type: 'POST',
		url: 'addFavorite.php',
		data: {
			'pkid': pkid
		}
	});
}

function unfavorite (element, pkid) {
	var newEl = document.createElement("h1");
	newEl.setAttribute ("class", "fave");
	newEl.setAttribute ("id", "unfaved");
	newEl.setAttribute ("onclick", "favorite(this, " + String(pkid) + ")");
	newEl.innerHTML = "☆";
	element.parentNode.replaceChild(newEl, element);
	
	$.ajax({
		type: 'POST',
		url: 'deleteFavorite.php',
		data: {
			'pkid': pkid
		}
	});
}

function unfaveList (pkid) {
	var child = document.getElementById(String(pkid));
	var parent = child.parentNode;
	parent.removeChild(child);
	
	$.ajax({
		type: 'POST',
		url: 'deleteFavorite.php',
		data: {
			'pkid': pkid
		}
	});
}