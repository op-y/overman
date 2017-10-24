var dts = $('#userTable').dataTable({
    paging: true,
    pagingType: "full_numbers",
    language: {
        sProcessing: "处理中...",
        sLengthMenu: "显示 _MENU_ 项结果",
        sZeroRecords: "没有匹配结果",
        sInfo: "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
        sInfoEmpty: "显示第 0 至 0 项结果，共 0 项",
        sInfoFiltered: "(由 _MAX_ 项结果过滤)",
        sInfoPostFix: "",
        search: "在表格中搜索:",
        sUrl: "",
        sEmptyTable: "表中数据为空",
        sLoadingRecords: "载入中...",
        sInfoThousands: ",",
        oPaginate: {
            "sFirst": "首页",
            "sPrevious": "上页",
            "sNext": "下页",
            "sLast": "末页"
        },
        oAria: {
            "sSortAscending": ": 以升序排列此列",
            "sSortDescending": ": 以降序排列此列"
        },
    },
    process: true,
    serverSide: false,
    ajax: "./ajaxGetUsers",
    columns: [
        { data: 'username' },
        { data: 'tel' },
        { data: 'email' },
        { data: 'status' },
    ],
    order: [1, 'asc'],
});

$("#userBtnNew").click(function(){
    $("#userModal").modal("toggle");
});


$("#authBtnNew").click(function(){
    $("#authModal").modal("toggle");
});

$("#msgModalBtnOK").click(function(){
    $("#msgModal").modal("toggle");
});

$('#authModal').on('show.bs.modal',function() {
    fillUserSelector();
    fillRoleSelector();
    //fillServiceSelector();
});

function fillUserSelector() {
    $.ajax({ 
        type:"POST",
        url:"./ajaxGetUserOpts", 
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            var users = $.parseJSON(data);
            $("#userDiv").empty();
            var label=$('<label for="authModalFieldUser">用户:</label>');
            var selector=$('<select class="form-control" id="authModalFieldUser"></select>');
            $.each(users, function(i, user){
                selector.append('<option value="'+user.id+'">'+user.username+'</option>');
            });
            $("#userDiv").append(label);
            $("#userDiv").append(selector);
        },
        error: function(){
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
        }         
    });
}

function fillRoleSelector() {
    $.ajax({ 
        type:"POST",
        url:"./ajaxGetRoleOpts", 
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            var roles = $.parseJSON(data);
            $("#roleDiv").empty();
            var label=$('<label for="authModalFieldRole">角色:</label>');
            var selector=$('<select class="form-control" id="authModalFieldRole"></select>');
            $.each(roles, function(i, role){
                selector.append('<option value="'+role.id+'">'+role.rolename+'</option>');
            });
            $("#roleDiv").append(label);
            $("#roleDiv").append(selector);
        },
        error: function(){
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
        }         
    });
}

//function fillServiceSelector() {
//    $.ajax({ 
//        type:"POST",
//        url:"./ajaxGetServiceOpts", 
//        datatype: "json",
//        beforeSend:function(){
//        },
//        complete: function(){
//        },
//        success: function(data){
//            var services = $.parseJSON(data);
//            $("#serviceDiv").empty();
//            var label=$('<label for="authModalFieldService">服务:</label>');
//            var selector=$('<select class="form-control" id="authModalFieldService"></select>');
//            $.each(services, function(i, service){
//                selector.append('<option value="'+service.id+'">'+service.name+'</option>');
//            });
//            $("#serviceDiv").append(label);
//            $("#serviceDiv").append(selector);
//        },
//        error: function(){
//            alert("AJAX错误!");
//        }         
//    });
//}

$("#userModalBtnCommit").click(function(){
    addUser();
});

function addUser() {
    var username = $("#userModalFieldUsername").val();
    var tel = $("#userModalFieldTel").val();
    var email = $("#userModalFieldEmail").val();
    var password = $("#userModalFieldPassword").val();
    $.ajax({ 
        type:"POST",
        url:"./ajaxAddUser", 
        context: document.body, 
        data:{username:username, tel:tel, email:email, password:password},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
            $("#userModal").modal("toggle");
            $("#userModalFieldUsername").val("");
            $("#userModalFieldTel").val("");
            $("#userModalFieldEmail").val("");
            $("#userModalFieldPassword").val("");
            flush();
        },
        success: function(data){
            info = $.parseJSON(data);
            $("#msgModalBody").empty();
            var para=$('<p>' + info.status + ':' + info.message + '</p>');
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
}

$("#userModalBtnCancel").click(function(){
    $("#userModal").modal("toggle");
});


$("#authModalBtnCommit").click(function(){
    addAuth();
});

function addAuth() {
    var userId = $("#authModalFieldUser").val();
    var roleId = $("#authModalFieldRole").val();

    var srvIds = "";
    $("#serviceChecked").children().each(function(){
        var spanId = $(this).attr("id");
        var srvId = spanId.split("_")[1];
        srvIds += srvId+"-";
    });

    $.ajax({ 
        type:"POST",
        url:"./ajaxAddAuth", 
        context: document.body, 
        data:{userId:userId, roleId:roleId, srvIds:srvIds},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
            $("#authModal").modal("toggle");
            flush();
        },
        success: function(data){
            info = $.parseJSON(data);
            $("#msgModalBody").empty();
            var para=$('<p>新增权限:'+info.cnt+'</p>');
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
}

$("#authModalBtnCancel").click(function(){
    $("#authModal").modal("toggle");
});

function flush() {
    window.location.reload()
}

var setting = {
    view: {
        selectedMulti: false,
        dblClickExpand: false
    },
    check: {
        autoCheckTrigger: false,
        chkboxType:{ "Y" : "", "N" : "" },
        chkStyle:"checkbox",
        enable: true
    },
    data: {
        simpleData: {
            enable: true
        }
    },
    edit: {
        enable: false
    },
    callback: {
        onCheck: onCheck
    }
};

$(document).ready(function(){
    var nodes = null;

    // init tree
    $.ajax({ 
        type:"GET",
        url:"./ajaxTreeServices", 
        beforeSend:function(){
        },
        complete: function(){
        },
        success: function(data){
            nodes = $.parseJSON(data);
            initTree(setting, nodes);
        },
        error: function(){
            $("#msgModalBody").empty();
            var para=$('<p>"AJAX错误!</p>');
            $("#msgModalBody").append(para);
            $("#msgModal").modal("toggle");
        }         
    });
});

// initialization
function initTree(setting, nodes) {
    $.fn.zTree.init($("#srvTree"), setting, nodes);
}

function onCheck(event, treeId, treeNode) {
    var checked = treeNode.checked;
    var id = treeNode.id;
    var spanId = "checked_"+id;
    var name = treeNode.name;

    if(checked) {
        var span=$('<span class="label label-primary" id="'+spanId+'">'+name+'</span>');
        $("#serviceChecked").append(span);
    } else {
        $("#"+spanId).remove();
    }
}
