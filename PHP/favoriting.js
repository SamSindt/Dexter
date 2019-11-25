function favorite (element, pkid) {
	var newEl = document.createElement("h1");
	newEl.setAttribute ("class", "fave");
	newEl.setAttribute ("id", "faved");
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