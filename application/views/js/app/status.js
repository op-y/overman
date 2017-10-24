function changeService(id, name) {
    $("#linkDiv").addClass("hide");
    $("#links").empty();

    refreshTitle(name);

    $.ajax({ 
        type:"POST",
        url:"./ajaxGetDeployment", 
        data:{id:id},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            deployment = $.parseJSON(data);
            refreshDeployment(id, name, deployment);
        },
        error: function(){
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
        }         
    });
}

function refreshTitle(name){
    $("#srvTitle").text(name);
}

function refreshDeployment(id, name, data){
    if(data.deployment == null) {
        $("#statusJDKStatusBtn").attr("disabled", true);
        $("#statusPodLogBtn").attr("disabled", true);
        $("#statusDeploy").val("");
        $("#statusEnv").val("");
        $("#statusIDC").val("");
    } else {
        $("#statusDeploy").val(data.deployment.k8sServiceName);
        $("#statusEnv").val(data.deployment.namespace);
        $("#statusIDC").val(data.deployment.idc);
        $("#statusJDKStatusBtn").attr("disabled", false);
        $("#statusPodLogBtn").attr("disabled", false);
    }
}

/*
 * run jdk command
 */
$("#statusJDKStatusBtn").click(function(){
    var deployName = $("#statusDeploy").val();
    var env         = $("#statusEnv").val();
    var idc         = $("#statusIDC").val();
    var command     = $("#statusJDKCommand").val();

    $.ajax({ 
        type:"POST",
        url:"./ajaxGetJDKStatus", 
        context: document.body, 
        data:{deployName:deployName, env:env, idc:idc, command:command},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            $("#links").empty();
            var msgs = $.parseJSON(data);
            $.each(msgs.message, function(i, msg){
                var a = $('<a target="_blank" href="'+msg+'">'+msg+'</a>')
                $("#links").append(a);
                $("#links").append('<br />');
            });
            $("#linkDiv").removeClass("hide");
        },
        error: function(){
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
        }         
    });
    $(this).attr("disabled",false); 
})

/*
 * get pod log
 */
$("#statusPodLogBtn").click(function(){
    var deployName  = $("#statusDeploy").val();
    var env         = $("#statusEnv").val();
    var idc         = $("#statusIDC").val();

    $.ajax({ 
        type:"POST",
        url:"./ajaxGetPodLog", 
        context: document.body, 
        data:{deployName:deployName, env:env, idc:idc},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            var msgs = $.parseJSON(data);
            $("#links").empty();
            $.each(msgs.message, function(i, msg){
                var a = $('<a target="_blank" href="'+msg+'">'+msg+'</a>')
                $("#links").append(a);
                $("#links").append('<br />');
            });
            $("#linkDiv").removeClass("hide");
        },
        error: function(){
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
        }         
    });
    $(this).attr("disabled",false); 
})

