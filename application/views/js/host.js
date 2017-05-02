var dts = $('#hosts_table').dataTable({
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
    ajax: "./ajaxGetHosts",
    columns: [
        { data: 'hostname' },
        { data: 'ip' },
        { data: 'idcName' },
        { data: 'cpu' },
        { data: 'memory' },
        { data: 'disk' },
        { data: 'ssd' },
        { data: 'raid' },
        { data: 'nic' },
    ],
    "columnDefs": [{
         "targets" : 9,
         "render" : function(data, type, row) {
             var hostId = data.id;
             var hostName = data.hostname;
             var hostIP = data.ip;
             var hostIdc = data.idc;
             var hostCPU = data.cpu;
             var hostMemory = data.memory;
             var hostDisk = data.disk;
             var hostSSD = data.ssd;
             var hostRAID = data.raid;
             var hostNIC = data.nic;
             var html = "<a href='javascript:void(0);' onclick='showUpdate("+hostId+",\""+hostName+"\",\""+hostIP+"\",\""+hostIdc+"\",\""+hostCPU+"\")' class='btn btn-warning btn-xs btn-del'>修改</a>";
             html += "&nbsp;";
             html += "<a href='javascript:void(0);' onclick='del("+hostId+")' class='btn btn-danger btn-xs'>删除</a>";
             return html;
         }
    }],
    order: [1, 'asc'],
});

function clear() {
    $("#idc_modalField_id").val("");
    $("#idc_modalField_name").val("");
    $("#idc_modalField_address").val("");
    $("#idc_modalField_administrator").val("");
    $("#idc_modalField_tel").val("");
};

function fill(id, name, address, administrator, tel) {
    $("#idc_modalField_id").val(id);
    $("#idc_modalField_name").val(name);
    $("#idc_modalField_address").val(address);
    $("#idc_modalField_administrator").val(administrator);
    $("#idc_modalField_tel").val(tel);
};

$("#host_btn_new").click(function(){
    clear();
    $("#host_modal").modal("toggle");
});

function showUpdate(id, name, address, administrator, tel){
    fill(id, name, address, administrator, tel);
    $("#idc_modal").modal("toggle");
}

$("#host_modalBtn_commit").click(function(){
    var valueId = $("#host_modalField_id").val();
    if("" == valueId || typeof(valueId) == "undefined") {
        add();
    } else {
        update();
    }
});

function add() {
    var valueName = $("#idc_modalField_name").val();
    var valueAddress = $("#idc_modalField_address").val();
    var valueAdministrator = $("#idc_modalField_administrator").val();
    var valueTel =$("#idc_modalField_tel").val();
    $.ajax({ 
        type:"POST",
        url:"./ajaxAddIdc", 
        context: document.body, 
        data:{name:valueName, address:valueAddress, administrator:valueAdministrator, tel:valueTel},
        datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
        beforeSend:function(){
        },
        complete: function(){
            $("#idc_modal").modal("toggle");
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
}

function update() {
    var valueId = $("#idc_modalField_id").val();
    var valueName = $("#idc_modalField_name").val();
    var valueAddress = $("#idc_modalField_address").val();
    var valueAdministrator = $("#idc_modalField_administrator").val();
    var valueTel =$("#idc_modalField_tel").val();
    $.ajax({ 
        type:"POST",
        url:"./ajaxUpdateIdc", 
        data:{id:valueId, name:valueName, address:valueAddress, administrator:valueAdministrator, tel:valueTel},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
            $("#idc_modal").modal("toggle");
            clear();
            flush();
        },
        success: function(data){
            alert("更新成功!");
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

function del(idcId) {
    $.ajax({ 
        type:"POST",
        url:"./ajaxDeleteIdc", 
        data:{id:idcId},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
            flush();
        },
        success: function(data){
            alert("删除成功!");
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

$("#host_modalBtn_cancel").click(function(){
    clear();
    $("#host_modal").modal("toggle");
});

function flush() {
    window.location.reload()
}
