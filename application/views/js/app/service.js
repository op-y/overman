$.ajax({ 
    type:"POST",
    url:"./ajaxGetIdcCode", 
    datatype: "json",
    beforeSend:function(){
    },
    complete: function(){
    },
    success: function(data){
        var info = $.parseJSON(data);
        $.each(info.idcs, function(index, idc) {
            var opt=$('<option value="'+idc.code+'">'+idc.name+'</option>');
            $("#deployModalFieldIDC").append(opt);
        });
    },
    error: function(){
        alert("AJAX错误!");
    }         
});

// interface for ztree
function changeService(id, name) {
    refreshTitle(name);

    $.ajax({ 
        type:"POST",
        url:"./ajaxSubServices", 
        data:{id:id},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            content = $.parseJSON(data);
            refreshSubServiceList(id, name, content);
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });

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
            refreshDeploymentConfig(id, name, deployment);
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}


function refreshTitle(name){
    $("#srvTitle").text(name);
}

function refreshSubServiceList(id, name, content){
    if(content.subservices == null) {
        $("#srvSubServiceList").empty();
        row=$('<tr></tr>');
        row.append('<td colspan="3">'+name+'没有子服务'+'</td>');
        $("#srvSubServiceList").append(row);
    } else {
        $("#srvSubServiceList").empty();
        $.each(content.subservices, function(index, element) {
            row=$('<tr></tr>');
            row.append('<td>'+element.id+'</td>');
            row.append('<td>'+element.name+'</td>');
            row.append('<td>'+element.kind+'</td>');
            $("#srvSubServiceList").append(row);
        });
    }
}

function refreshDeploymentConfig(id, name, data){
    if(data.deployment == null) {
        $("#srvDeploymentEnv").text("no configuration");
        $("#srvDeploymentIDC").text("no configuration");
        $("#srvDeploymentGray").text("no configuration");
        $("#srvDeploymentJenkinsName").text("no configuration");
        $("#srvDeploymentGitRepoUrl").text("no configuration");
        $("#srvDeploymentGitBranch").text("no configuration");
        $("#srvDeploymentCompileParam").text("no configuration");
        $("#srvDeploymentJarPath").text("no configuration");
        $("#srvDeploymentRunParam").text("no configuration");
        $("#srvDeploymentImageRepoUrl").text("no configuration");
        $("#srvDeploymentK8sName").text("no configuration");
        $("#srvDeploymentK8sPort").text("no configuration");

        $("#deployModalFieldId").val("");
        $("#deployModalServiceId").val(id);
        $("#deployModalFieldEnv").val("");
        $("#deployModalFieldIDC").val("");
        $("#deployModalFieldGray").val("");
        $("#deployModalFieldJenkinsName").val("");
        $("#deployModalFieldGitRepoUrl").val("");
        $("#deployModalFieldGitBranch").val("");
        $("#deployModalFieldCompileParam").val("");
        $("#deployModalFieldJarPath").val("");
        $("#deployModalFieldRunParam").val("");
        $("#deployModalFieldImageRepoUrl").val("");
        $("#deployModalFieldK8sName").val("");
        $("#deployModalFieldK8sPort").val("");
    } else {
        $("#srvDeploymentEnv").text(data.deployment.namespace);
        $("#srvDeploymentIDC").text(data.deployment.idc);
        if (data.deployment.grayEnabled == 1) {
            $("#srvDeploymentGray").text("开启");
        } else {
            $("#srvDeploymentGray").text("关闭");
        }
        $("#srvDeploymentJenkinsName").text(data.deployment.jenkinsJobName);
        $("#srvDeploymentGitRepoUrl").text(data.deployment.jenkinsRepoURL);
        $("#srvDeploymentGitBranch").text(data.deployment.jenkinsRepoBranch);
        $("#srvDeploymentCompileParam").text(data.deployment.jenkinsMavenParam);
        $("#srvDeploymentJarPath").text(data.deployment.jenkinsJarPath);
        $("#srvDeploymentRunParam").text(data.deployment.jenkinsRunParam);
        $("#srvDeploymentImageRepoUrl").text(data.deployment.imageRepoURL);
        $("#srvDeploymentK8sName").text(data.deployment.k8sServiceName);
        $("#srvDeploymentK8sPort").text(data.deployment.k8sServicePort);

        $("#deployModalFieldId").val(data.deployment.id);
        $("#deployModalServiceId").val(id);
        $("#deployModalFieldEnv").val(data.deployment.namespace);
        $("#deployModalFieldIDC").val(data.deployment.idc);
        $("#deployModalFieldGray").val(data.deployment.grayEnabled);
        $("#deployModalFieldJenkinsName").val(data.deployment.jenkinsJobName);
        $("#deployModalFieldGitRepoUrl").val(data.deployment.jenkinsRepoURL);
        $("#deployModalFieldGitBranch").val(data.deployment.jenkinsRepoBranch);
        $("#deployModalFieldCompileParam").val(data.deployment.jenkinsMavenParam);
        $("#deployModalFieldJarPath").val(data.deployment.jenkinsJarPath);
        $("#deployModalFieldRunParam").val(data.deployment.jenkinsRunParam);
        $("#deployModalFieldImageRepoUrl").val(data.deployment.imageRepoURL);
        $("#deployModalFieldK8sName").val(data.deployment.k8sServiceName);
        $("#deployModalFieldK8sPort").val(data.deployment.k8sServicePort);
    }
}

// operations
$("#srvBtnNew").click(function(){
    clear();
    $("#srvModal").modal("toggle");
});

$("#srvBtnEdit").click(function(){
    clearRename();
    $("#renameModal").modal("toggle");
});

$("#srvBtnDel").click(function(){
    alert("删除要小心，正在开发中...");
});

$("#srvBtnDeploy").click(function(){
    $("#deployModal").modal("toggle");
});

function clear() {
    $("#srvModalFieldPid").val(currentId);
    $("#srvModalFieldPname").val(currentName);
    $("#srvModalFieldName").val("");
    $("#srvModalFieldKind").val("UNIT");
};

$("#srvModalBtnCancel").click(function(){
    clear();
    $("#srvModal").modal("toggle");
});

$("#srvModalBtnCommit").click(function(){
    add();
});

function add() {
    var valuePid  = $("#srvModalFieldPid").val();
    var valueName = $("#srvModalFieldName").val();
    var valueKind = $('#srvModalFieldKind option:selected').val();
    $.ajax({ 
        type:"POST",
        url:"./ajaxAddService", 
        context: document.body, 
        data:{pid:valuePid, name:valueName, kind:valueKind},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
            $("#srvModal").modal("toggle");
            clear();
        },
        success: function(data){
            alert("添加成功!");
            refreshChild();
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

// rename service
function clearRename() {
    $("#renameModalFieldId").val(currentId);
    $("#renameModalFieldOldName").val(currentName);
    $("#renameModalFieldNewName").val("");
};

$("#renameModalBtnCancel").click(function(){
    clearRename();
    $("#renameModal").modal("toggle");
});

$("#renameModalBtnCommit").click(function(){
    rename();
});

function rename() {
    var valueId = $("#renameModalFieldId").val();
    var valueName = $("#renameModalFieldNewName").val();
    $.ajax({ 
        type:"POST",
        url:"./ajaxUpdateService", 
        data:{id:valueId, name:valueName},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
            $("#renameModal").modal("toggle");
            clearRename();
        },
        success: function(data){
            alert("更新成功!");
            refreshParent();
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

// delete service
function del(serviceId) {
    $.ajax({ 
        type:"POST",
        url:"./ajaxDeleteService", 
        data:{id:serviceId},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            alert("删除成功!");
            refreshTree();
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

// config deployment
$("#deployModalBtnCancel").click(function(){
    $("#deployModal").modal("toggle");
});

$("#deployModalBtnCommit").click(function(){
    updateDeployment();
});

function updateDeployment() {
    var valueId = $("#deployModalFieldId").val();
    var valueServiceId = $("#deployModalServiceId").val();
    var valueEnv = $("#deployModalFieldEnv").val();
    var valueIDC = $("#deployModalFieldIDC").val();
    var valueGray = $("#deployModalFieldGray").val();
    var valueJenkinName = $("#deployModalFieldJenkinsName").val();
    var valueGitRepoUrl = $("#deployModalFieldGitRepoUrl").val();
    var valueGitBranch = $("#deployModalFieldGitBranch").val();
    var valueCompileParam = $("#deployModalFieldCompileParam").val();
    var valueJarPath = $("#deployModalFieldJarPath").val();
    var valueRunParam = $("#deployModalFieldRunParam").val();
    var valueImageRepoUrl = $("#deployModalFieldImageRepoUrl").val();
    var valueK8sName = $("#deployModalFieldK8sName").val();
    var valueK8sPort = $("#deployModalFieldK8sPort").val();

    $.ajax({ 
        type:"POST",
        url:"./ajaxConfigDeployment", 
        data:{id:valueId, serviceid:valueServiceId, namespace:valueEnv, idc:valueIDC, gray:valueGray, jenkinsJobName:valueJenkinName, jenkinsRepoURL:valueGitRepoUrl, jenkinsRepoBranch:valueGitBranch, jenkinsMavenParam:valueCompileParam, jenkinsJarPath:valueJarPath, jenkinsRunParam:valueRunParam, imageRepoURL:valueImageRepoUrl, k8sServiceName:valueK8sName, k8sServicePort:valueK8sPort},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
            $("#deployModal").modal("toggle");
        },
        success: function(data){
            alert("更新成功!");
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}
