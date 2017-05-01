var dts = $('#idcs_table').dataTable({
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
    ajax: "./ajaxGetIdcs",
    columns: [
        { data: 'name' },
        { data: 'address' },
        { data: 'administrator' },
        { data: 'tel' },
    ],
    "columnDefs": [{
         "targets" : 4,
         "data" : {data:'id'},
         "render" : function(data, type, row) {
             //var id = '"' + row.id + '"';
             var idcId = data.id;
             var idcName = data.name;
             var idcAddress = data.address;
             var idcAdministrator = data.administrator;
             var idcTel = data.tel;
             var html = "<a href='javascript:void(0);' onclick='showUpdate("+idcId+",\""+idcName+"\",\""+idcAddress+"\",\""+idcAdministrator+"\",\""+idcTel+"\")' class='btn btn-warning btn-xs btn-del'>修改</a>";
             html += "&nbsp;";
             html += "<a href='javascript:void(0);' onclick='del("+idcId+")' class='btn btn-danger btn-xs'>删除</a>";
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

$("#idc_btn_new").click(function(){
    clear();
    $("#idc_modal").modal("toggle");
});

function showUpdate(id, name, address, administrator, tel){
    fill(id, name, address, administrator, tel);
    $("#idc_modal").modal("toggle");
}

$("#idc_modalBtn_commit").click(function(){
    var valueId = $("#idc_modalField_id").val();
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
            dts.fnDraw();
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
            dts.fnDraw();
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
            dts.fnDraw();
        },
        success: function(data){
            alert("删除成功!");
        },
        error: function(){
            alert("AJAX错误!");
        }         
    });
}

$("#idc_modalBtn_cancel").click(function(){
    clear();
    $("#idc_modal").modal("toggle");
});
