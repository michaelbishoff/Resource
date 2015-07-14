var URL;

$(".block").click(function(){
    var route;
    var current = window.location.href;
    var direction = $(this).parent().attr("id");
    var not_this_page = function(current, route) {
        var r_len = route.length;
        var diff_len = current.length - r_len;
        current = current.substr(diff_len, r_len);
        
        if (route == current) {
            return false;
        }
        return true;
    }
    
    if(direction == "title") {
        route = "/index.php";
        console.log(1);
        console.log(route);
        if (not_this_page(current, route)) {
            window.location.href = route;
        }
    }
    else if (direction == "add-new") {
        route = "add_new/index.php";
        if (not_this_page(current, route)) {
            window.location.href = route;
        }
    }
    else {
        route = "show_all.php";
        if (not_this_page(current, route)) {
            window.location.href = route;
        }
    }
});

/*
$("#explore").click(function(){
    // Setup the ajax request
    $.ajax({
        url: "explore.php", // where we want to submit the form to
        data: {"explore": "true"},
        dataType: 'json',
        type: 'post',
        success: function(result) {
            if(!result) {
                console.error("Failed ajax request");
            }
        }
    });
});
*/