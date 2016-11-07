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
    document.getElementById("graph").innerHTML = "";

    // gets value of name from select box
    var name = document.getElementById("allnames");
    name = name.options[name.selectedIndex].value;

    // gets which gender radio button is checked
    var gender = $("input[name='gender']:checked").val();

    $.get({
        url : 'babynames.php',
        type : 'GET',
        data : {type: "rank", name: name, gender: gender},
        asynch : false
    }).always(function(data, statusText, xhr){
            console.log(xhr.status);
    }).done(function(data){
        // if return data is not empty
        if( typeof data !== 'undefined' ){
            // set up first row of graph
            graph = document.getElementById("graph");
            var node = document.createElement("tr");
            parentNode = graph.appendChild(node);

            // add th nodes with years from 1890 - 2010 in 10 year increments
            var thData = 1890;
            while ( thData <= 2010 ){
                node = document.createElement("th");    // create th node
                node.appendChild( document.createTextNode(thData) );    // append year to th node
                parentNode.appendChild(node);   // appends th node to parent tr node

                thData += 10;   // increments year
            }

            node = document.createElement("tr");    // this tr node will hold bar divs
            parentNode = graph.appendChild(node);   // appends to graph (after first tr node)

            // turn xml data into usable text
            var xmlDoc = $.parseXML( data ),
                $xml = $( xmlDoc );

            // iterates through rank elements in xml, makes table entry for each one
            $xml.find('rank').each(function(){
                node = document.createElement("td");    // creates td tag
                var tdRef = parentNode.appendChild(node);   // appends td to tr parent, saves ref to td

                node = document.createElement("div");   // creates div tag
                var rank = $(this).text();        // gets the rank from xml
                node.appendChild( document.createTextNode(rank) );  // adds rank to inside of div

                tdRef.appendChild(node);    // adds div to td node
            });
            setDivHeight();
        } // if
    }); // done
}

function setDivHeight(){
    var divList = $('td div'); // gets all divs within td tags

    // iterate through list of divs to set height
    for(var i = 0; i < divList.length; i++){
        // gets rank number from div and makes it an int
        var height = divList[i].innerHTML;
        height = parseInt(height);

        // if unranked/1000th
        if( height == 0 || height == 1000 ) {
            divList[i].style.height = "0px";
        }
        // if height needs to be calculated
        else{
            height = (1000 - height) / 4;   // find inverse rank and divide by 4
            height = parseInt(height);  // make decimal back into int
            divList[i].style.height = height + "px"; // sets height
        }
    }
}


/* Search button calls the meaning and rank functions and allows subsequent searches */
document.getElementById("search").addEventListener("click", function(e){
	$("#resultsarea").show(); // un-hides the display area with all the info
	// nested = document.getElementById("allnames");
    // nested = nested.options[nested.selectedIndex].value;
	// document.getElementById("nested").innerHTML = nested;
	e.preventDefault();
	meaning();
	rank();
});