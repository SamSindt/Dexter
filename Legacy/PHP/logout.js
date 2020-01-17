function logout (element) {
	var login = document.createElement("a");
	login.setAttribute ("href", "showLogin.php");
	login.innerHTML = "Login";
	element.parentNode.replaceChild(login, element);
	
	$.ajax({
		type: 'POST',
		url: '/Pokedex/logout/submit',
	});
}