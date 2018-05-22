var onlineTimer = null;
var grayTimer = null;

function changeService(id, name) {
    clearInterval(onlineTimer);
    clearInterval(grayTimer);
    refreshTitle(name);
    refreshStatus();

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

function refreshStatus(){
    $('#grayImageSpan').text("nil");
    $('#grayStatusSpan').text("nil");
    $('#grayExpectSpan').text("nil");
    $('#grayCurrentSpan').text("nil");
    $('#grayAvaliableSpan').text("nil");
    $('#grayBadSpan').text("nil");
    $('#grayUpdateSpan').text("nil");

    $('#onlineImageSpan').text("nil");
    $('#onlineStatusSpan').text("nil");
    $('#onlineExpectSpan').text("nil");
    $('#onlineCurrentSpan').text("nil");
    $('#onlineAvaliableSpan').text("nil");
    $('#onlineBadSpan').text("nil");
    $('#onlineUpdateSpan').text("nil");
}

function refreshDeployment(id, name, data){
    if(data.deployment == null) {
        $("#deploymentPanelDiv").addClass("hidden");
        $("#grayStatusDiv").addClass("hidden");
        $("#onlineStatusDiv").addClass("hidden");
        $("#AbOpDiv").addClass("hidden");
        $("#abStart").attr("href", "#");
        $("#abStop").attr("href", "#");
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
        $("#grayStatusDiv").addClass("hidden");
        $("#onlineStatusDiv").addClass("hidden");
        $("#AbOpDiv").addClass("hidden");
        $("#abStart").attr("href", "#");
        $("#abStop").attr("href", "#");
        $("#deploymentAlertDiv").addClass("hidden");
        $("#deploymentBlockDiv").removeClass("hidden");
        $("#deploymentUpdateInfoDiv").addClass("hidden");
        $("#deploymentRollbackInfoDiv").addClass("hidden");

        $("#deployment_env").val("");
        $("#deployment_idc").val("");
        $("#deployment_registry").val("");
        $("#deployment_module").val("");

    } else if (data.deployment.grayEnabled == 0) {
        $("#deployment_env").val(data.deployment.namespace);
        $("#deployment_idc").val(data.deployment.idc);
        $("#deployment_registry").val(data.deployment.imageRepoURL);
        $("#deployment_module").val(data.deployment.k8sServiceName);

        $("#deploymentPanelDiv").removeClass("hidden");
        $("#grayStatusDiv").addClass("hidden");
        $("#onlineStatusDiv").removeClass("hidden");
        $("#AbOpDiv").addClass("hidden");
        $("#abStart").attr("href", "#");
        $("#abStop").attr("href", "#");
        $("#deploymentAlertDiv").addClass("hidden");
        $("#deploymentBlockDiv").addClass("hidden");
        $("#deploymentUpdateInfoDiv").removeClass("hidden");
        $("#deploymentRollbackInfoDiv").removeClass("hidden");

       onlineTimer = setInterval(getOnlineStatus, 6000);
    } else {
        $("#deployment_env").val(data.deployment.namespace);
        $("#deployment_idc").val(data.deployment.idc);
        $("#deployment_registry").val(data.deployment.imageRepoURL);
        $("#deployment_module").val(data.deployment.k8sServiceName);

        $("#deploymentPanelDiv").removeClass("hidden");
        $("#grayStatusDiv").removeClass("hidden");
        $("#onlineStatusDiv").removeClass("hidden");
        $("#AbOpDiv").removeClass("hidden");
        $("#abStart").attr("href", "http://172.16.0.50:9878/setGray?serviceName="+data.deployment.k8sServiceName);
        $("#abStop").attr("href", "http://172.16.0.50:9878/Service_finishGray?serviceName="+data.deployment.k8sServiceName);
        $("#deploymentAlertDiv").addClass("hidden");
        $("#deploymentBlockDiv").addClass("hidden");
        $("#deploymentUpdateInfoDiv").removeClass("hidden");
        $("#deploymentRollbackInfoDiv").removeClass("hidden");

        onlineTimer = setInterval(getOnlineStatus, 6000);
        grayTimer = setInterval(getGrayStatus, 6000);
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
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
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

$("#msgModalBtnOK").click(function(){
    $("#msgModal").modal("toggle");
})

$("#abUpdate").click(function(){
    var serviceId = currentId;
    var env      = $("#deployment_env").val();
    var idc      = $("#deployment_idc").val();
    var module   = $("#deployment_module").val() + "-gray";
    var imageTag = $("#deployment_imageTag").val();
    $(this).attr("disabled",true); 
    $.ajax({ 
        type:"POST",
        url:"./ajaxGrayUpdate", 
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
                $("#backendMessage").text("灰度部署升级开始");break;
            case 1011:
                $("#backendMessage").text("找不到对应灰度部署的Namespace");break;
            case 1012:
                $("#backendMessage").text("找不到对应灰度部署Deployment");break;
            case 1013:
                $("#backendMessage").text("找不到对应Image");break;
            case 1014:
                $("#backendMessage").text("找不到对应Container");break;
            case 1015:
                $("#backendMessage").text("灰度部署当前版本和升级版本一致");break;
            default:
                $("#backendMessage").text(result.updateMsg);break;
            }
            $("#updateModal").modal("toggle");
        },
        error: function(){
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
        }         
    });
    $(this).attr("disabled",false); 
});

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
                $("#backendCode").text("开始升级："+result.updateCode+" 然后 暂停："+result.pauseCode);
                $("#backendMessage").text("升级开始了，系统更新一个实例后暂停升级，你去机器上检查日志和效果，确认正常后一定要回来点一下[继续]！如果苗头不对，回来点[回滚]！");
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
                $("#backendMessage").text(result.updateMsg);break;
            }
            $("#updateModal").modal("toggle");
        },
        error: function(){
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
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
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
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
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
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
                $("#backendMessage").text("状态调整为继续，并且已经开始回滚!");
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
                $("#backendMessage").text(result.rollbackMsg);break;
            }
            $("#updateModal").modal("toggle");
        },
        error: function(){
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
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
 * show reboot modal
 */
$("#deploymentReboot").click(function(){
    $("#rebootModal").modal("toggle");
});

/*
 * reboot
 */
$("#rebootModalBtnOK").click(function(){
    $("#rebootModal").modal("toggle");

    var serviceId = currentId;
    var env      = $("#deployment_env").val();
    var idc      = $("#deployment_idc").val();
    var module   = $("#deployment_module").val();

    $(this).attr("disabled",true); 
    $.ajax({ 
        type:"POST",
        url:"./ajaxReboot", 
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
            case 200:
                $("#backendMessage").text("正在重启中...");
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
                $("#backendMessage").text("未知状态");break;
            }
            $("#updateModal").modal("toggle");
        },
        error: function(){
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
        }         
    });
    $(this).attr("disabled",false); 
});

/*
 * close reboot modal
 */
$("#rebootModalBtnClose").click(function(){
    $("#rebootModal").modal("toggle");
});


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
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
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
            } else if ("BACK" == record.status) {
                var badgeDiv = $('<div class="timeline-badge warning"><i class="glyphicon glyphicon-arrow-left"></i></div>');
            } else if ("BOOT" == record.status) {
                var badgeDiv = $('<div class="timeline-badge warning"><i class="glyphicon glyphicon-refresh"></i></div>');
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
            //bodyDiv.append(bodyParamDuration);

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

// timer
function getOnlineStatus(){
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
            $("#onlineLoadingImg").removeClass("hidden");
        },
        complete: function(){
            $("#onlineLoadingImg").addClass("hidden");
        },
        success: function(data){
            stat = $.parseJSON(data);
            changeOnlineStatus(stat);
        },
        error: function(){
            console.log("AJAX Error: 获取线上部署状态失败")
        }         
    });
}

function changeOnlineStatus(stat) {
    var imageTag = "";

    if (stat.code != 200) {
        return;
    }

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

    $('#onlineImageSpan').text("最终镜像:" + imageTag);
    $('#onlineStatusSpan').text("状态:" + updateStatus);
    $('#onlineExpectSpan').text("期待POD:" + stat.message.expected);
    $('#onlineCurrentSpan').text("当前POD:" + stat.message.current);
    $('#onlineAvaliableSpan').text("生效POD:" + stat.message.available);
    $('#onlineBadSpan').text("失效POD:" + stat.message.unavailable);
    $('#onlineUpdateSpan').text("更新POD:" + stat.message.update);
}

function getGrayStatus(){
    var env    = $("#deployment_env").val();
    var idc    = $("#deployment_idc").val();
    var module = $("#deployment_module").val() + "-gray";

    $.ajax({ 
        type:"POST",
        url:"./ajaxGetDeploymentStatus", 
        context: document.body, 
        data:{circumstance:env, idc:idc, serviceName:module},
        datatype: "json",
        beforeSend:function(){
            $("#grayLoadingImg").removeClass("hidden");
        },
        complete: function(){
            $("#grayLoadingImg").addClass("hidden");
        },
        success: function(data){
            stat = $.parseJSON(data);
            changeGrayStatus(stat);
        },
        error: function(){
            console.log("AJAX Error: 获取灰度部署状态失败")
        }         
    });
}

function changeGrayStatus(stat) {
    var imageTag = "";

    if (stat.code != 200) {
        return;
    }

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

    $('#grayImageSpan').text("最终镜像:" + imageTag);
    $('#grayStatusSpan').text("状态:" + updateStatus);
    $('#grayExpectSpan').text("期待POD:" + stat.message.expected);
    $('#grayCurrentSpan').text("当前POD:" + stat.message.current);
    $('#grayAvaliableSpan').text("生效POD:" + stat.message.available);
    $('#grayBadSpan').text("失效POD:" + stat.message.unavailable);
    $('#grayUpdateSpan').text("更新POD:" + stat.message.update);
}
