function callNoty(type, text) {
    var notification_html = [];
    if ((text == undefined || text == '') && type == 'warning')
        text = "Sorry, system has failed to process your request. Please try again or contact your administrator.";
    notification_html['warning'] = '<div class="activity-item"> <i class="fa fa-tasks text-warning"></i> <div class="activity"> '+text+' </div> </div>',
    notification_html['error'] = '<div class="activity-item"> <i class="fa fa-close text-success"></i> <div class="activity"> '+text+' </div> </div>',
    notification_html['information'] = '<div class="activity-item"> <i class="fa fa-comment text-danger"></i> <div class="activity"> '+text+' </div> </div>',
    notification_html['success'] = '<div class="activity-item"> <i class="fa fa-check text-success"></i> <div class="activity"> '+text+' </div> </div>';
    var n = noty({
        text: notification_html[type],
        type: type,
        layout: 'topRight',
        closeWith: ['click'],
        theme: 'relax',
        dismissQueue: true,
        killer      : true,
        maxVisible: 1,
        timeout: 5000,
        animation: {
            open: 'animated bounceInRight',
            close: 'animated bounceOutRight',
            easing: 'swing',
            speed: 500
        }
    });
}

function sessionExpireHandler(){
    window.location.href = base_url;
}

function callLoader(text) {
    if (text == '' || text == undefined)
        text = "Please wait while data is being processed";
    var type = 'information';
    var noty_loader = noty({
        text         : '<div class="activity-item"> <i class="fa fa-refresh fa-spin"></i> <div class="activity" style="font-size: 14px;font-weight: bold;"> '+text+' </div> </div>',
        type         : type,
        layout       : 'topRight',
        closeWith    : [],
        modal        : true,
        theme        : 'relax',
        dismissQueue : true,
        killer       : true,
        maxVisible   : 1,
        animation: {
            open: {height: 'toggle'}, // jQuery animate function property object
            close: {height: 'toggle'}, // jQuery animate function property object
            easing: 'swing', // easing
            speed: 200 // opening & closing animation speed
        }
    });
}

function endLoader(){
    $.noty.closeAll()
}