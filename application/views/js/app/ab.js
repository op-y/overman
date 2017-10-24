$('[data-toggle="tooltip"]').tooltip();

$("#groupModalBtnOK").click(function(){
    $("#groupModal").modal("toggle");
});

$("#groupSearch").click(function(){
    var groupID = $("#groupID").val();
    query(groupID);
});

function query(groupID) {
    $.ajax({ 
        type:"POST",
        url:"./ajaxGetABTest", 
        data:{id:groupID},
        datatype: "json",
        beforeSend:function(){
            clear();
        },
        complete: function(){
            $("#groupModal").modal("toggle");
        },
        success: function(data){
            groupInfo = $.parseJSON(data);
            fill(groupID, groupInfo);
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

function clear() {
    $("#groupModalTitleName").text("");
    $("#groupModalTitleID").text("");
    $("#groupModalBody").empty();
}

function fill(groupID, groupInfo) {
    if (null == groupInfo.group) {
        var para=$('<p>没有ID为'+groupID+'的集团</p>');
        $("#groupModalBody").append(para);
    } else if (null == groupInfo.abtest || 0 == groupInfo.abtest.length) {
        $("#groupModalTitleName").text(groupInfo.group.groupName);
        $("#groupModalTitleID").text("("+groupID+")");

        var para=$('<p>该集团没有在小流量测试中</p>');
        $("#groupModalBody").append(para);
    } else {
        $("#groupModalTitleName").text(groupInfo.group.groupName);
        $("#groupModalTitleID").text("("+groupID+")");

        $.each(groupInfo.abtest, function(i, test) {
            var h = $('<h3 class="text-left">'+test.name+'('+test.domain+')</h3>');
            var ul = $('<ul class="text-left"></ul>');
            $.each(test.func, function(j, f) {
                var li = $('<li>'+f+'</li>');
                ul.append(li);
            });

            $("#groupModalBody").append(h);
            $("#groupModalBody").append(ul);
        });
    }
}

$("#detailModalBtnOK").click(function(){
    $("#detailModal").modal("toggle");
});

function show(itemkey) {
    $.ajax({ 
        type:"POST",
        url:"./ajaxGetTestGroups", 
        data:{key:itemkey},
        datatype: "json",
        beforeSend:function(){
            $("#detailModalTitleName").text("");
            $('#detailModalBody').empty();
        },
        complete: function(){
            $("#detailModal").modal("toggle");
        },
        success: function(data){
            info = $.parseJSON(data);
            list(info);
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

function list(info) {
    if (null == info.name) {
        var para=$('<p>没有该项小流量测试!</p>');
        $("#detailModalBody").append(para);
    } else if (null == info.groups || 0 == info.groups.length) {
        $("#detailModalTitleName").text(info.name);

        var para=$('<p>没有集团命中该项小流量测试</p>');
        $("#detailModalBody").append(para);
    } else {
        $("#detailModalTitleName").text(info.name);

        var table=$('<table class="table table-striped table-hover"></table>');
        $.each(info.groups, function(i, group) {
            var tr = $('<tr></tr>');
            var tdID = $('<td>'+group.groupID+'</td>');
            var tdName = $('<td>'+group.groupName+'</td>');

            tr.append(tdID);
            tr.append(tdName);
            table.append(tr);
        });

        $("#detailModalBody").append(table);
    }
}
