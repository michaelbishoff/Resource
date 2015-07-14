$(document).ready(function() {
    var numResults = parseInt($('#numCategories').text());
    if (numResults > 15){
	//	$("#results").height( (numResults / 3) * 110);
	$("#results").height( ((numResults / 3) * 17) + "%");
    }
});

/*

$(document).ready(function() {
    var moveRight = 30;
	var moveDown = 0;
	for (var i = 1; i < parseInt($('#numCategories').text()); i++){
	    if (i % 3 == 0){
		moveRight = 0;
		moveDown += 10;
	    }
        
	    $('#category' + i).animate({
		    'marginLeft' : "+=" + moveRight + "%",
			'marginTop' : "+=" + moveDown + "%"
			});
	    moveRight += 30;
	}
});
*/

function padText() {
    var block_h = $("#category").height();
    var list = $("div[id^='cat-word']");
    console.log(list);
}

function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}