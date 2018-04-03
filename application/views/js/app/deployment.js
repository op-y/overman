function changeService(id, name) {
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
            d = $.parseJSON(data);
            refreshDeployment(id, name, d);
            
            if (d.deployment == null || d.deployment == undefined || d.deployment == "") {
                return;
            } else {
                getImagesAfterDeployment(id, name);
            }
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

function refreshTitle(name){
    $("#srvTitle").text(name);
}

function refreshDeployment(id, name, data){
    if(data.deployment == null) {
        $("#deploymentPanelDiv").addClass("hidden");
        $("#deploymentAlertDiv").removeClass("hidden");
        $("#deploymentBlockDiv").addClass("hidden");
        $("#deploymentUpdateInfoDiv").addClass("hidden");
        $("#deploymentRollbackInfoDiv").addClass("hidden");

        $("#deployment_env").val("");
        $("#deployment_idc").val("");
        $("#deployment_registry").val("");
        $("#deployment_module").val("");
    } else if (data.blocking) {
        $("#deploymentPanelDiv").addClass("hidden");
        $("#deploymentAlertDiv").addClass("hidden");
        $("#deploymentBlockDiv").removeClass("hidden");
        $("#deploymentUpdateInfoDiv").addClass("hidden");
        $("#deploymentRollbackInfoDiv").addClass("hidden");

        $("#deployment_env").val("");
        $("#deployment_idc").val("");
        $("#deployment_registry").val("");
        $("#deployment_module").val("");
    } else {
        $("#deployment_env").val(data.deployment.namespace);
        $("#deployment_idc").val(data.deployment.idc);
        $("#deployment_registry").val(data.deployment.imageRepoURL);
        $("#deployment_module").val(data.deployment.k8sServiceName);

        $("#deploymentPanelDiv").removeClass("hidden");
        $("#deploymentAlertDiv").addClass("hidden");
        $("#deploymentBlockDiv").addClass("hidden");
        $("#deploymentUpdateInfoDiv").removeClass("hidden");
        $("#deploymentRollbackInfoDiv").removeClass("hidden");
    }
}

function getImagesAfterDeployment(id, name) {
    $.ajax({ 
        type:"POST",
        url:"./ajaxGetImages", 
        data:{id:id},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            imageInfo = $.parseJSON(data);
            refreshImages(id, name, imageInfo);
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

function refreshImages(id, name, data) {
    if (0 == data.tags.length) {
        $("#ImageDiv").empty();
        var label=$('<label for="deployment_imageTag">镜像Tag:</label>');
        var input=$('<input type="text" class="form-control" id="deployment_imageTag" placeholder="Image Tag">');
        $("#ImageDiv").append(label);
        $("#ImageDiv").append(input);
    } else {
        $("#ImageDiv").empty();
        var label=$('<label for="deployment_imageTag">镜像Tag:</label>');
        var selector=$('<select class="form-control" id="deployment_imageTag"></select>');
        $.each(data.tags, function(i, tag){
            var unixtime = tag.timestamp;
            var imageDateTime = new Date(unixtime * 1000);
            var imageDateTimeString = imageDateTime.getFullYear() + "-" + (imageDateTime.getMonth()+1) + "-" + imageDateTime.getDate() + " " + imageDateTime.getHours() + ":" + imageDateTime.getMinutes() + ":" + imageDateTime.getSeconds();
            selector.append('<option value="'+tag.tag+'">'+tag.tag+" [构建于 "+imageDateTimeString+']</option>');
        });
        $("#ImageDiv").append(label);
        $("#ImageDiv").append(selector);
        var firstValue=$("#deployment_imageTag option:first").val();
        $("deployment_imageTag").val(firstValue);
    }
}

/*
 * update and show update result modal
 */
$("#deploymentUpdate").click(function(){
    var serviceId = currentId;
    var env      = $("#deployment_env").val();
    var idc      = $("#deployment_idc").val();
    var module   = $("#deployment_module").val();
    var imageTag = $("#deployment_imageTag").val();

    $(this).attr("disabled",true); 
    $.ajax({ 
        type:"POST",
        url:"./ajaxUpdate", 
        context: document.body, 
        data:{serviceId:serviceId, env:env, idc:idc, module:module, imageTag:imageTag},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            result = $.parseJSON(data);
            $("#backendCode").text(result.updateCode);
            switch(result.updateCode) {
            case 201:
                $("#backendCode").text("Update->"+result.updateCode+" THEN Pause->"+result.pauseCode);
                $("#backendMessage").text("升级开始,当前暂停");
                break;
            case 1011:
                $("#backendMessage").text("找不到对应Namespace");break;
            case 1012:
                $("#backendMessage").text("找不到对应Deployment");break;
            case 1013:
                $("#backendMessage").text("找不到对应Image");break;
            case 1014:
                $("#backendMessage").text("找不到对应Container");break;
            case 1015:
                $("#backendMessage").text("当前版本和升级版本一致");break;
            default:
                $("#backendMessage").text(result.message);break;
            }
            $("#updateModal").modal("toggle");
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
    $(this).attr("disabled",false); 
});

$("#deploymentPause").click(function(){
    var serviceId = currentId;
    var env      = $("#deployment_env").val();
    var idc      = $("#deployment_idc").val();
    var module   = $("#deployment_module").val();

    $(this).attr("disabled",true); 
    $.ajax({ 
        type:"POST",
        url:"./ajaxPause", 
        context: document.body, 
        data:{serviceId:serviceId, env:env, idc:idc, module:module},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            result = $.parseJSON(data);
            $("#backendCode").text(result.code);
            switch(result.code) {
            case 201:
                $("#backendMessage").text("升级暂停!");break;
            case 1011:
                $("#backendMessage").text("找不到对应Namespace");break;
            case 1012:
                $("#backendMessage").text("找不到对应Deployment");break;
            case 1013:
                $("#backendMessage").text("找不到对应Image");break;
            case 1014:
                $("#backendMessage").text("找不到对应Container");break;
            case 1015:
                $("#backendMessage").text("当前版本和升级版本一致");break;
            default:
                $("#backendMessage").text(result.message);break;
            }
            $("#updateModal").modal("toggle");
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
    $(this).attr("disabled",false); 
});

$("#deploymentResume").click(function(){
    var serviceId = currentId;
    var env      = $("#deployment_env").val();
    var idc      = $("#deployment_idc").val();
    var module   = $("#deployment_module").val();

    $(this).attr("disabled",true); 
    $.ajax({ 
        type:"POST",
        url:"./ajaxResume", 
        context: document.body, 
        data:{serviceId:serviceId, env:env, idc:idc, module:module},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            result = $.parseJSON(data);
            $("#backendCode").text(result.code);
            switch(result.code) {
            case 201:
                $("#backendMessage").text("升级成功!");break;
            case 1011:
                $("#backendMessage").text("找不到对应Namespace");break;
            case 1012:
                $("#backendMessage").text("找不到对应Deployment");break;
            case 1013:
                $("#backendMessage").text("找不到对应Image");break;
            case 1014:
                $("#backendMessage").text("找不到对应Container");break;
            case 1015:
                $("#backendMessage").text("当前版本和升级版本一致");break;
            default:
                $("#backendMessage").text(result.message);break;
            }
            $("#updateModal").modal("toggle");
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
    $(this).attr("disabled",false); 
});

/*
 * close update modal
 */
$("#updateModalBtnOK").click(function(){
    $("#updateModal").modal("toggle");
});


/*
 * show rollback modal
 */
$("#deploymentRollback").click(function(){
    $("#rollbackModal").modal("toggle");
});

/*
 * rollback and show update modal
 */
$("#rollbackModalBtnOK").click(function(){
    $("#rollbackModal").modal("toggle");

    var serviceId = currentId;
    var env      = $("#deployment_env").val();
    var idc      = $("#deployment_idc").val();
    var module   = $("#deployment_module").val();

    $(this).attr("disabled",true); 
    $.ajax({ 
        type:"POST",
        url:"./ajaxRollback", 
        context: document.body, 
        data:{serviceId:serviceId, env:env, idc:idc, module:module},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            result = $.parseJSON(data);
            $("#backendCode").text(result.rollbackCode);
            switch(result.rollbackCode) {
            case 201:
                $("#backendMessage").text("已经继续,开始回滚!");
                break;
            case 1011:
                $("#backendMessage").text("找不到对应Namespace");break;
            case 1012:
                $("#backendMessage").text("找不到对应Deployment");break;
            case 1013:
                $("#backendMessage").text("找不到对应Image");break;
            case 1014:
                $("#backendMessage").text("找不到对应Container");break;
            case 1015:
                $("#backendMessage").text("当前版本和升级版本一致");break;
            default:
                $("#backendMessage").text(result.message);break;
            }
            $("#updateModal").modal("toggle");
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
    $(this).attr("disabled",false); 
});

/*
 * close rollback modal
 */
$("#rollbackModalBtnClose").click(function(){
    $("#rollbackModal").modal("toggle");
});

/*
 * show status modal
 */
$("#deploymentStatus").click(function(){
    $("#statusModal").modal("toggle");
});

$("#statusModalBtnClose").click(function(){
    $("#statusModal").modal("toggle");
});

var timer = null;
$('#statusModal').on('show.bs.modal',function() {
    timer = setInterval(getStatus, 6000);
});

$('#statusModal').on('hide.bs.modal',function() {
    clearInterval(timer);
    $("#statusModalBody p").remove();
});


function getStatus(){
    var env    = $("#deployment_env").val();
    var idc    = $("#deployment_idc").val();
    var module = $("#deployment_module").val();

    $.ajax({ 
        type:"POST",
        url:"./ajaxGetDeploymentStatus", 
        context: document.body, 
        data:{circumstance:env, idc:idc, serviceName:module},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            stat = $.parseJSON(data);
            appendStatus(stat);
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

function appendStatus(stat) {
    var imageTag = "";
    $.each(stat.pod, function(key, value){
        imageTag = value.split(":")[1];
    });

    var updateStatus = "";
    if (stat.message.paused) {
        updateStatus = "已暂停...";
    } else if (stat.message.current == stat.message.expected && stat.message.available == stat.message.expected) {
        updateStatus = "已完成";
    } else {
        updateStatus = "进行中...";
    }

    var deployparam=$('<p>'
            +'<span class="label label-primary">最终镜像:'+imageTag+'</span>&nbsp;'
            +'<span class="label label-info">状态:'+ updateStatus +'</span>&nbsp;'
            +'<span class="label label-primary">期待POD:'+stat.message.expected+'</span>&nbsp;'
            +'<span class="label label-primary">当前POD:'+stat.message.current+'</span>&nbsp;'
            +'<span class="label label-success">生效POD:'+stat.message.available+'</span>&nbsp;'
            +'<span class="label label-danger">失效POD:'+stat.message.unavailable+'</span>&nbsp;'
            +'<span class="label label-warning">更新POD:'+stat.message.update+'</span>&nbsp;'
            +'</p>');

    $("#statusModalBody").append(deployparam);
}

/*
 * show history modal
 */
$("#deploymentHistory").click(function(){
    var serviceId = currentId;

    $.ajax({ 
        type:"POST",
        url:"./ajaxGetDeploymentHistory", 
        context: document.body, 
        data:{serviceId:serviceId},
        datatype: "json",
        beforeSend:function(){
            $("#historyModalBody").empty();
        },
        complete: function(){
            $("#historyModal").modal("toggle");
        },
        success: function(data){
            info = $.parseJSON(data);
            showHistory(info);
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
});

function showHistory(info) {
    if (0 == info.history.length) {
        var noneParam=$('<p>没有服务升级历史!</p>');
        $("#historyModalBody").append(noneParam);
    } else {
        var timelineUl = $('<ul class="timeline"></ul>');
        $.each(info.history, function(i, record){
            if (0 == i % 2) {
                var itemLi = $('<li></li>');
            } else {
                var itemLi = $('<li class="timeline-inverted"></li>');
            }
            if ("SUCC" == record.status) {
                var badgeDiv = $('<div class="timeline-badge success"><i class="glyphicon glyphicon-ok"></i></div>');
            } else if ("FAIL" == record.status) {
                var badgeDiv = $('<div class="timeline-badge danger"><i class="glyphicon glyphicon-remove-sign"></i></div>');
            } else {
                var badgeDiv = $('<div class="timeline-badge info"><i class="glyphicon glyphicon-repeat"></i></div>');
            }
            var pannelDiv = $('<div class="timeline-panel"></div>');
            var headingDiv = $('<div class="timeline-heading"></div>');
            var headingH4 = $('<h4 class="timeline-title">'+record.status+'</h4>');
            var headingParam = $('<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>'+record.timestamp+'</small></p>');
            var bodyDiv = $('<div class="timeline-body"></div>');
            var bodyParamUser = $('<p>操作人:'+record.username+'</p>');
            var bodyParamTag = $('<p>升级版本:'+record.version+'</p>');
            var bodyParamDuration = $('<p>升级耗时:'+record.duration+'s</p>');

            headingDiv.append(headingH4);
            headingDiv.append(headingParam);

            bodyDiv.append(bodyParamUser);
            bodyDiv.append(bodyParamTag);
            bodyDiv.append(bodyParamDuration);

            pannelDiv.append(headingDiv);
            pannelDiv.append(bodyDiv);

            itemLi.append(badgeDiv);
            itemLi.append(pannelDiv);

            timelineUl.append(itemLi);

        });
        $("#historyModalBody").append(timelineUl);
    }
}

$("#historyModalBtnClose").click(function(){
    $("#historyModal").modal("toggle");
});
