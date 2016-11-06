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
    function (e) {
    	//alert("Data loaded " + data);
        $("#meaning").innerHTML = e;
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

	$.get("babynames.php",
        {
            type: "rank",
            name: name,
            gender: gender
        },
        function(data){
		//$("#grapharea").append(data);
            //alert ("rank data" + data);
            document.getElementById("graph").innerHTML = data;
	});	// query to php file
		/*.done(function(data){	// will run if success
			alert(data);
		})
		.fail(function(){	// will run if error occurs
			$("#grapharea").append("<p>FAILURE</p>");
		});*/
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