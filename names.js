/* names.js */

/* Fetches the PHP meaning query and populates the meaning paragraph */
function meaning(){
}

/* Fetches the PHP rank query and populates the table if the name exists */
function rank(){
}

/* Search button calls the meaning and rank functions and allows subsequent searches */
document.getElementById("search").addEventListener("click", function(){
	meaning();
	rank();
});