function addLogoutAndStayListener () {

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
}

function addLogoutAndRedirectListener () {
	document.getElementById("logout").addEventListener ("click", function () {
		window.location.replace ("/Pokedex/home");
		$.ajax({
			type: 'POST',
			url: '/Pokedex/logout/submit',
		});
	});
}