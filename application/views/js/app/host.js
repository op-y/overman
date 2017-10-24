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
        { data: 'os' },
        { data: 'kernel' },
        { data: 'rack' },
    ],
    "columnDefs": [{
         "targets" : 12,
         "data" : null,
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
             var hostOS = data.os;
             var hostKernel = data.kernel;
             var hostRack = data.rack;
             var html = "<a href='javascript:void(0);' onclick='showUpdate("+hostId+",\""+hostName+"\",\""+hostIP+"\","+hostIdc+",\""+hostCPU+"\",\""+hostMemory+"\",\""+hostDisk+"\",\""+hostSSD+"\",\""+hostRAID+"\",\""+hostNIC+"\",\""+hostOS+"\",\""+hostKernel+"\",\""+hostRack+"\")' class='btn btn-warning btn-xs btn-del'>修改</a>";
             html += "&nbsp;";
             html += "<a href='javascript:void(0);' onclick='del("+hostId+")' class='btn btn-danger btn-xs'>删除</a>";
             return html;
         }
    }],
    order: [1, 'asc'],
});

$.getJSON("./ajaxGetIdcs",function(result){
    var selector=$('<select class="form-control" id="host_modalField_idc"></select>');
    $.each(result.data, function(i, field){
        selector.append('<option value="'+field.id+'">'+field.name+'</option>');
    });
    $("#host_modalField_idcLabel").append(selector);
    var firstValue=$("#host_modalField_idc option:first").val();
    $("#host_modalField_idc").val(firstValue);
});

function clear() {
    $("#host_modalField_id").val("");
    $("#host_modalField_name").val("localhost");
    $("#host_modalField_ip").val("127.0.0.1");

    var firstValue=$("#host_modalField_idc option:first").val();
    $("#host_modalField_idc").val(firstValue);

    $("#host_modalField_cpu").val("");
    $("#host_modalField_memory").val("");
    $("#host_modalField_disk").val("");
    $("#host_modalField_ssd").val("");
    $("#host_modalField_raid").val("");
    $("#host_modalField_nic").val("");
    $("#host_modalField_os").val("");
    $("#host_modalField_kernel").val("");
    $("#host_modalField_rack").val("");
};

function fill(id, hostname, ip, idc, cpu, memory, disk, ssd, raid, nic, os, kernel, rack) {
    $("#host_modalField_id").val(id);
    $("#host_modalField_hostname").val(hostname);
    $("#host_modalField_ip").val(ip);
    $("#host_modalField_idc").val(idc);
    $("#host_modalField_cpu").val(cpu);
    $("#host_modalField_memory").val(memory);
    $("#host_modalField_disk").val(disk);
    $("#host_modalField_ssd").val(ssd);
    $("#host_modalField_raid").val(raid);
    $("#host_modalField_nic").val(nic);
    $("#host_modalField_os").val(os);
    $("#host_modalField_kernel").val(kernel);
    $("#host_modalField_rack").val(rack);
};

$("#host_btn_new").click(function(){
    clear();
    $("#host_modal").modal("toggle");
});

function showUpdate(id, hostname, ip, idc, cpu, memory, disk, ssd, raid, nic, os, kernel, rack){
    fill(id, hostname, ip, idc, cpu, memory, disk, ssd, raid, nic, os, kernel, rack);
    $("#host_modal").modal("toggle");
}

$("#host_modalBtn_cancel").click(function(){
    clear();
    $("#host_modal").modal("toggle");
});

$("#host_modalBtn_commit").click(function(){
    var valueId = $("#host_modalField_id").val();
    if("" == valueId || typeof(valueId) == "undefined") {
        add();
    } else {
        update();
    }
});

function add() {
    var valueHostname = $("#host_modalField_hostname").val();
    var valueIP = $("#host_modalField_ip").val();
    var valueIDC = $("#host_modalField_idc").val();
    var valueCPU =$("#host_modalField_cpu").val();
    var valueMemory =$("#host_modalField_memory").val();
    var valueDisk =$("#host_modalField_disk").val();
    var valueSSD =$("#host_modalField_ssd").val();
    var valueRAID =$("#host_modalField_raid").val();
    var valueNIC =$("#host_modalField_nic").val();
    var valueOS =$("#host_modalField_os").val();
    var valueKernel =$("#host_modalField_kernel").val();
    var valueRack =$("#host_modalField_rack").val();
    $.ajax({ 
        type:"POST",
        url:"./ajaxAddHost", 
        context: document.body, 
        data:{hostname:valueHostname, ip:valueIP, idc:valueIDC, cpu:valueCPU, memory:valueMemory, disk:valueDisk, ssd:valueSSD, raid:valueRAID, nic:valueNIC, os:valueOS, kernel:valueKernel, rack:valueRack},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
            $("#host_modal").modal("toggle");
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
    var valueId = $("#host_modalField_id").val();
    var valueHostname = $("#host_modalField_hostname").val();
    var valueIP = $("#host_modalField_ip").val();
    var valueIDC = $("#host_modalField_idc").val();
    var valueCPU =$("#host_modalField_cpu").val();
    var valueMemory =$("#host_modalField_memory").val();
    var valueDisk =$("#host_modalField_disk").val();
    var valueSSD =$("#host_modalField_ssd").val();
    var valueRAID =$("#host_modalField_raid").val();
    var valueNIC =$("#host_modalField_nic").val();
    var valueOS =$("#host_modalField_os").val();
    var valueKernel =$("#host_modalField_kernel").val();
    var valueRack =$("#host_modalField_rack").val();
    $.ajax({ 
        type:"POST",
        url:"./ajaxUpdateHost", 
        data:{id:valueId, hostname:valueHostname, ip:valueIP, idc:valueIDC, cpu:valueCPU, memory:valueMemory, disk:valueDisk, ssd:valueSSD, raid:valueRAID, nic:valueNIC, os:valueOS, kernel:valueKernel, rack:valueRack},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
            $("#host_modal").modal("toggle");
            clear();
            flush();
        },
        success: function(data){
            alert(data);
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

function del(hostId) {
    $.ajax({ 
        type:"POST",
        url:"./ajaxDeleteHost", 
        data:{id:hostId},
        datatype: "json",
        beforeSend:function(){
        },
        complete: function(){
            flush();
        },
        success: function(data){
            alert(data);
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

function flush() {
    window.location.reload()
}
