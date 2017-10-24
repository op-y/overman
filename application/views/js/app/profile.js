$("#msgModalBtnOK").click(function(){
    $("#msgModal").modal("toggle");
});

$("#profileUpdate").click(function(){
    var tel = $("#tel").val();
    var email = $("#email").val();
    $.ajax({ 
        type:"POST",
        url:"./ajaxUpdateProfile", 
        data:{tel:tel, email:email},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            info = $.parseJSON(data);
            $("#msgModalBody").empty();
            var para=$('<p>' + info.status + ':' + info.message +'</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
        },
        error: function(){
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
        }         
    });
});


$("#passwordUpdate").click(function(){
    var p0 = $("#oldPassword").val();
    var p1 = $("#newPassword").val();
    var p2 = $("#newPassword2").val();
    if(p1 != p2) {
        $("#msgModalBody").empty();
        var para=$('<p>与输入的新密码不一致!</p>');
        $("#msgModalBody").append(para);
        $("#msgModal").modal("toggle");
        return
    }
    $.ajax({ 
        type:"POST",
        url:"./ajaxUpdatePassword", 
        data:{oldPassword:p0, newPassword:p1},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            info = $.parseJSON(data);
            $("#msgModalBody").empty();
            var para=$('<p>' + info.status + ':' + info.message +'</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
        },
        error: function(){
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
        }         
    });
});

$("#newPassword").blur(function(){
    var p1 = $("#newPassword").val();
    if(p1 == "" || p1 == undifend) {
        $("#msgModalBody").empty();
        var para=$('<p>密码不能为空!</p>');
        $("#msgModalBody").append(para);
        $("#msgModal").modal("toggle");
    }
});

$("#newPassword2").blur(function(){
    var p1 = $("#newPassword").val();
    var p2 = $("#newPassword2").val();

    if(p1 != p2) {
        $("#msgModalBody").empty();
        var para=$('<p>与输入的新密码不一致!</p>');
        $("#msgModalBody").append(para);
        $("#msgModal").modal("toggle");
    }
});
