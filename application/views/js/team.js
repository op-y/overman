var options = {
    events_source: '/index.php/ajaxGetRota',
    tmpl_path: '/application/views/templates/calendar-templates/',
    tmpl_cache: false,
    language: 'zh-CN',
    view: 'week',
    first_day: 1,
    weekbox: true,
    display_week_numbers: true,
    onAfterViewLoad: function(view) {
        //$('#dateTitle').text(this.getTitle());
        $('.btn-group button').removeClass('active');
        $('button[data-calendar-view="' + view + '"]').addClass('active');
    },
    classes: {
        months: {
            general: 'label'
        }
    },
    modal: "#info-modal",
    modal_type: "template",
    modal_title: function(event) { return event.title }
};

var calendar = $('#calendar').calendar(options);

$('.btn-group button[data-calendar-nav]').each(function() {
    var $this = $(this);
    $this.click(function() {
        calendar.navigate($this.data('calendar-nav'));
    }); 
}); 

$('.btn-group button[data-calendar-view]').each(function() {
    var $this = $(this);
    $this.click(function() {
        calendar.view($this.data('calendar-view'));
    }); 
}); 


$("#duty_btn_update").click(function(){
    $("#duty-modal").modal("toggle");
});

$("#duty_modalBtn_cancel").click(function(){
    $("#duty-modal").modal("toggle");
});

$("#duty_modalBtn_commit").click(function(){
    $("#duty-modal").modal("toggle");
});

function flush() {
    window.location.reload()
}
