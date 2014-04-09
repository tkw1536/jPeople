jpeople_server_name = jpeople_image_server = window.location.host;
jpeople_server_image_prefix = window.location.pathname + "/image.php?id=";
jpeople_server_path = window.location.pathname + "/ajax.php";

$(function(){
	var searchQuery = getParameterByName("q"); 
	var inputField = $("#q"); 

	//do we have something to search for?
	if(searchQuery !== ""){
		inputField.val(searchQuery);
		doSearch(searchQuery); 
	}

	//add a throttled event handler
	inputField.on("keyup input paste", debounce(function(){
		doSearch(inputField.val()); 
	}, 250)); 
}); 

//render an error message
function renderError(){
	$("#results").empty().append(
		$("<div>").addClass("row marketing").append(
			$("<div>").addClass("col-lg-12").append(
				$("<div>")
				.addClass("alert alert-danger")
				.text("You do not have permissions to search for people or the server is broken. ")
				.prepend(
					$("<b>").text("Error: ")
				)
			)
		)
		
	)
}

//render an error message
function renderEmpty(){
	$("#results").empty().append(
		$("<div>").addClass("row marketing").append(
			$("<div>").addClass("col-lg-12").append(
				$("<div>")
				.addClass("alert alert-info")
				.text("There are no results. Please try again. ")
				.prepend(
					$("<b>").text("Information: ")
				)
			)
		)
		
	)
}

//render all the people results
function renderPeople(res){
	$("#results").empty(); 

	if(res.length == 0){
		renderEmpty(); 
		return; 
	}

	for(var i=0;i<res.length;i++){
		var person = res[i]; 

		$("<div>").addClass("row marketing").append(
			$("#dummyresult").clone().removeClass("hidden")
		)
		.appendTo("#results")
		.find("span.replace").each(function(){
			var me = $(this);
			var attr = person[me.attr("id")]; 

			if(typeof attr !== "undefined" && attr !== ""){
				me.text(attr); 
			} else {
				var e = me.hide().closest("span.group").hide(); 
			}
		})
		.end().find(".resimg")
			.attr("src", person.photo)
			.wrap(
				$("<a>").attr("href", "?q="+encodeURIComponent("id:"+person.id+" eid:"+person.eid))
			).end()
		.find(".maillink").attr("href", "mailto:"+person["email"]).end()
		.find(".calllink").attr("href", "tel:0049421200"+person["phone"]); 
	}
}

//do some searching
function doSearch(query){
	
	//replace the history, very useful
	window.history.replaceState( {} , location.pathname, location.pathname + "?q=" + encodeURIComponent(query));

	//do the actual search thingy here
	window.jpeople.search(query, function(res){
		if(res === false){
			//error, weird
			renderError(); 
		} else {
			renderPeople(res); 
		}
	}); 
}