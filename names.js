/* names.js */


/* Fetches the PHP meaning query and populates the meaning paragraph */
function meaning(){
    // var sel = $("#allnames");
    // var name = sel.options[sel.selectedIndex].value;

	var nested = document.getElementById("allnames");
	nested = nested.options[nested.selectedIndex].value;

    $.get("babynames.php",
    {
       type: "meaning",
       name: nested
    },
    function (data) {
    	//alert("Data loaded " + data);
        document.getElementById("meaning").innerHTML = data;
    });
}



/* Fetches the PHP rank query and populates the table if the name exists */
function rank(){

	//$("#grapharea").append("<p>TESTING</p>");

	// var sel = $("#allnames");							// getting values of gender/name
	// var name = sel.options[sel.selectedIndex].value;
	// var gender = $('input[name=gender]:checked').value;

    var name = document.getElementById("allnames");
    name = name.options[name.selectedIndex].value;

    var gender = $("input[name='gender']:checked").val();

    $.ajax({
        url : 'babynames.php',
        type : 'GET',
        data : {type: "rank", name: name, gender: gender}
    }).always(function(data, statusText, xhr){
            console.log(xhr.status);
    }).done(function(data){
        document.getElementById("graph").innerHTML = data;
    });

	/*$.get("babynames.php", {type: "rank", name: name, gender: gender},
        function(data){
	        if()
            document.getElementById("graph").innerHTML = data;
	    }
    );*/	// query to php file
}

/* Search button calls the meaning and rank functions and allows subsequent searches */
document.getElementById("search").addEventListener("click", function(e){
	$("#resultsarea").show(); // un-hides the display area with all the info
	nested = document.getElementById("allnames");
    nested = nested.options[nested.selectedIndex].value;
	document.getElementById("nested").innerHTML = nested;
	e.preventDefault();
	meaning();
	rank();
});