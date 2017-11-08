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

function show(itemkey) {
    var url = "/index.php/abGroups/" + itemkey;
    $(location).attr('href', url);
}
