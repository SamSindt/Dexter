function addUnfavoriteListener (pokemonID) {
    let oldEl = document.getElementById("faved");
    
    oldEl.addEventListener("click", function () {
        let newEl = document.createElement("h1");
        newEl.setAttribute("class", "fave");
        newEl.setAttribute("id", "unfaved");
        newEl.innerHTML = "☆";
        
        oldEl.parentNode.replaceChild(newEl, oldEl);

        $.ajax({
            type: "POST",
            url: "/Pokedex/Favorites/unfavorite/" + pokemonID,
        });

        addFavoriteListener (pokemonID);
    });   
}

function addFavoriteListener (pokemonID) {
    let oldEl = document.getElementById("unfaved");
    
    oldEl.addEventListener("click", function () {
        let newEl = document.createElement("h1");
        newEl.setAttribute("class", "fave");
        newEl.setAttribute("id", "faved");
        newEl.innerHTML = "★";

        oldEl.parentNode.replaceChild(newEl, oldEl);

        $.ajax({
            type: "POST",
            url: "/Pokedex/Favorites/favorite/" + pokemonID,
        });

        addUnfavoriteListener (pokemonID);
    });   
}