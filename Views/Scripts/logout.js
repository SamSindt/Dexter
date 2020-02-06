function addLogoutAndStayListener () {

	document.getElementById("logout").addEventListener ("click", function () {
		let login = document.createElement("a");
		login.setAttribute ("href", "/Pokedex/login/show");
		login.setAttribute ("id", "login");
		login.innerHTML = "Login";
		this.parentNode.replaceChild(login, this);

		document.getElementById("favorites").setAttribute ("href", "/Pokedex/login/show");

		let adminElement = document.getElementById ("admin");
		if (typeof(adminElement) != 'undefined' && adminElement != null) {
			adminElement.parentNode.removeChild (adminElement);
		}
		
		$.ajax({
			type: 'POST',
			url: '/Pokedex/logout/submit',
		});
	});
}

function addLogoutAndRedirectListener () {
	document.getElementById("logout").addEventListener ("click", function () {
		
		$.ajax({
			type: 'POST',
			url: '/Pokedex/logout/submit',
			async:false,
		});
		window.location.replace ("/Pokedex/home");
	});
}