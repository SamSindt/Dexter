document.getElementById("logout").addEventListener ("click", function () {
	var login = document.createElement("a");
	login.setAttribute ("href", "/Pokedex/login/show");
	login.setAttribute ("id", "login");
	login.innerHTML = "Login";
	this.parentNode.replaceChild(login, this);

	document.getElementById("favorites").setAttribute ("href", "/Pokedex/login/show");
	
	$.ajax({
		type: 'POST',
		url: '/Pokedex/logout/submit',
	});
});