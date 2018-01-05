$(document).ready(function() {

    var dts = $('#fileTable').dataTable({
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
        ordering: false,
        process: true,
        serverSide: true,
        ajax: "./ajaxGetLogfile",
        columns: [
            { data: 'id' },
            { data: 'shopid' },
            { data: 'deviceid' },
            { data: 'applicationname' },
            { data: 'timestamp' },
            { data: 'filename' },
            { data: 'storage' },
            { data: 'fileinfo' },
        ],
        "columnDefs": [{
             "targets" : 8,
             "data" : null,
             "render" : function(data, type, row) {
                 var fn = data.fileinfo
                 var html = "<a href='http://dohko.sre.hualala.com/storage/"+ fn +"' target='_blank' class='btn btn-primary btn-xs'>查看</a>";
                 return html;
             }
        }],
    });

});
