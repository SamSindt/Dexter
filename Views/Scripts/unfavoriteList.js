function addUnfavoriteListeners () {
    let unfavoriteButtons = document.getElementsByClassName("unfavorite");

    for (let i = 0; i < unfavoriteButtons.length; i++) {
        let callback = function (element) {
            
            let id = element.getAttribute ("id");
            let parentLi = element.parentNode;
            parentLi.parentNode.removeChild(parentLi);
        
            $.ajax({
                type: "POST",
                url: "/Dexter/favorites/unfavorite/" + id,
            });
        };

        unfavoriteButtons[i].addEventListener("click", function () {
            callback (unfavoriteButtons[i]);
        });
    }
}

