$('.up').click(function() {
    var newVotes;
    
    if ($(this).hasClass('on')) { // This is on
        newVotes = parseInt($(this).parent().children(".totalVotes").text()) - 1;
        $(this).parent().children(".totalVotes").text(newVotes);
    }
    else if ($('.down').hasClass('on')) { // Switching from Down to Up
        $('.down').removeClass('on');
        
        newVotes = parseInt($(this).parent().children(".totalVotes").text()) + 2;
        $(this).parent().children(".totalVotes").text(newVotes);
    }
    else { // Both off
        newVotes = parseInt($(this).parent().children(".totalVotes").text()) + 1;
        $(this).parent().children(".totalVotes").text(newVotes);
    }
    
    // Create the post object. The id is the unique key in the DB
    var data = {"votes":newVotes, "resultId":$(this).parent().attr("id")};

    // Setup the ajax request
    $.ajax({
        url: "explore.php", // where we want to submit the form to
        data: data,
        dataType: 'json',
        type: 'post',
        success: function(result) {
            if(!result) {
                console.error("Failed ajax request");
            }
        }
    });
});

$('.down').click(function() {
    var newVotes;
    
    if ($(this).hasClass('on')) { // This is on
        newVotes = parseInt($(this).parent().children(".totalVotes").text()) + 1;
        $(this).parent().children(".totalVotes").text(newVotes);
    }
    else if ($('.up').hasClass('on')) { // Switching from Up to Down
        $('.up').removeClass('on');
        
        newVotes = parseInt($(this).parent().children(".totalVotes").text()) - 2;
        $(this).parent().children(".totalVotes").text(newVotes);
    }
    else { // Both off
        newVotes = parseInt($(this).parent().children(".totalVotes").text()) - 1;
        $(this).parent().children(".totalVotes").text(newVotes);   
    }
    
    // Create the post object. The id is the unique key in the DB
    var data = {"votes":newVotes, "resultId":$(this).parent().attr("id")};

    // Setup the ajax request
    $.ajax({
        url: "explore.php", // where we want to submit the form to
        data: data,
        dataType: 'json',
        type: 'post',
        success: function(result) {
            if(!result) {
                console.error("Failed ajax request");
            }
        }
    });
});

$('.vote').click(function () {
    $(this).toggleClass('on');
});

/*    var moveAmount = 110;
    
    for (var i = 2; i < parseInt($('#numResults').text()); i++){
        $('#result' + i).animate({
            'marginTop' : "+=" + moveAmount+ "px"
        });
        moveAmount += 110;
    }
*/
$(document).ready(function() {
    var numResults = parseInt($('#numResults').text());
    if (numResults > 5){
	$("#results").height( numResults * 110);
    }
});
