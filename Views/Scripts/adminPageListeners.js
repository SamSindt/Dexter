function addDeactivateListeners () {
    let deactivateButtons = document.getElementsByClassName ("deactivate");

    for (let i = 0; i < deactivateButtons.length; i++) {
        let callback = function (element) {
            let id = element.getAttribute ("id");
            let parentLi = element.parentNode;
            parentLi.parentNode.removeChild(parentLi);

            $.ajax({
                type: "POST",
                url: "/Pokedex/admin/deactivate/" + id,
            });
        }

        deactivateButtons[i].addEventListener("click", function () {
            callback (deactivateButtons[i]);
        });
    }
}