var options = {
    events_source: '/index.php/ajaxGetEvents',
    tmpl_path: '/application/views/templates/calendar-templates/',
    tmpl_cache: false,
    language: 'zh-CN',
    view: 'week',
    first_day: 1,
    weekbox: true,
    display_week_numbers: true,
    onAfterViewLoad: function(view) {
        $('#dateTitle').text(this.getTitle());
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


$("#event_btn_new").click(function(){
    $("#event-modal").modal("toggle");
});

$("#event_modalBtn_cancel").click(function(){
    $("#event-modal").modal("toggle");
});

$("#event_modalBtn_commit").click(function(){
    var valueTitle = $("#event_modalField_title").val();
    var valueURL = $("#event_modalField_url").val();
    var valueClass = $("#event_modalField_class").val();
    var valueStart =$("#event_modalField_start").val();
    var valueEnd =$("#event_modalField_end").val();
    $.ajax({ 
        type:"POST",
        url:"./ajaxAddEvent", 
        context: document.body, 
        data:{title:valueTitle, url:valueURL, kind:valueClass, start:valueStart, end:valueEnd},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
            $("#event_modal").modal("toggle");
            clear();
            flush();
        },
        success: function(data){
            alert("添加成功!");
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
});

function clear() {
    $("#event_modalField_title").val("");
    $("#event_modalField_url").val("");
    $("#event_modalField_class").val("event-info");
    $("#event_modalField_start").val("");
    $("#event_modalField_end").val("");
}

function flush() {
    window.location.reload()
}
