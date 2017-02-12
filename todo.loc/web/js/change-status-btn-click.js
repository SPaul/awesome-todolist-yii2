$(document).on('click', '.changestatus-btn', function(e){
    var element = this;
    $.get({
        url: url,
        data: {id : $(element).attr('data-id')},
        success: function(response){
        	changeTaskStatusHandler(response);
        },
    });
});