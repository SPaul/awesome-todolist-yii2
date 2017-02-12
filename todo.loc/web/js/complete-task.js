
$(document).on('click', '.changestatus-btn', function(e){
    var element = this;
    $.get({
        url: '".Url::to(['changestatus'])."',
        data: {id : $(element).attr('data-id')},
        success: changestatusHandler(response);
    });
});