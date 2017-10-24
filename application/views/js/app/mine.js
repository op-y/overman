var dts = $('#authTable').dataTable({
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
    ajax: "./ajaxGetMineAuth",
    columns: [
        { data: 'serviceName' },
        { data: 'roleName' },
    ],
    "columnDefs": [{
         "targets" : 2,
         "data" : null,
         "render" : function(data, type, row) {
             var serviceName = data.serviceName;
             var roleName = data.roleName;
             var html = "<a href='javascript:void(0);' class='btn btn-danger btn-xs'>删除</a>";
             return html;
         }
    }],
    order: [1, 'asc'],
});

$("#mineBtnApply").click(function(){
    $("#mineModal").modal("toggle");
});

$("#mineModalBtnCancel").click(function(){
    $("#mineModal").modal("toggle");
});

$("#mineModalBtnCommit").click(function(){
    $("#mineModal").modal("toggle");
});

function flush() {
    window.location.reload()
}
