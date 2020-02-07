function addLogoutAndStayListener () {

	document.getElementById("logout").addEventListener ("click", function () {
		let login = document.createElement("a");
		login.setAttribute ("href", "/Dexter/login/show");
		login.setAttribute ("id", "login");
		login.innerHTML = "Login";
		this.parentNode.replaceChild(login, this);

		document.getElementById("favorites").setAttribute ("href", "/Dexter/login/show");

		let adminElement = document.getElementById ("admin");
		if (typeof(adminElement) != 'undefined' && adminElement != null) {
			adminElement.parentNode.removeChild (adminElement);
		}
		
		$.ajax({
			type: 'POST',
			url: '/Dexter/logout/submit',
		});
	});
}

function addLogoutAndRedirectListener () {
	document.getElementById("logout").addEventListener ("click", function () {
		
		$.ajax({
			type: 'POST',
			url: '/Dexter/logout/submit',
			async:false,
		});
		window.location.replace ("/Dexter/home");
	});
}