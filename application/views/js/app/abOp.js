$("#abOpOK").click(function(){
    var redis     = $("#abOp_redis").val();
    var key       = $("#abOp_key").val();
    var opType    = $("#abOp_op").val();
    var separator = $("#abOp_sep").val();
    var ids       = $("#abOp_ids").val();

    $.ajax({ 
        type:"POST",
        url:"./ajaxDoABOp", 
        context: document.body, 
        data:{redis:redis, key:key, opType:opType, separator:separator, ids:ids},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            stat = $.parseJSON(data);
            $("#msgModalBody").empty();
            var para=$('<p>状态码: '+stat.code +'</p><p>返回信息: '+stat.message+'</p>');
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

$("#msgModalBtnOK").click(function(){
    $("#msgModal").modal("toggle");
});
