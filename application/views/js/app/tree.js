var setting = {
    async: {
        autoParam:["id"],
        dataType: "json",
        enable: true,
        type: "post",
        url: "./ajaxTreeNode"
    },
    view: {
        selectedMulti: false,
        dblClickExpand: false
    },
    check: {
        enable: false
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
        //beforeClick: beforeClick,
        //onClick: onClick,
        beforeDblClick: beforeDblClick,
        onDblClick: onDblClick
    }
};

// global vars
var currentId, currentName;

// Click Event
function beforeClick(treeId, treeNode, clickFlag){
    alert("before click: " +
            treeId + ", " + 
            treeNode.tId + ", " + 
            treeNode.name + ", " + 
            treeNode.parentTId);
}

function onClick(event, treeId, treeNode) {
    var tId = treeNode.tId;
    var treeObj = $.fn.zTree.getZTreeObj("srvTree");
    var node = treeObj.getNodeByTId(tId);
    treeObj.expandNode(node, true, false, true);
}

// Double Click Event
function beforeDblClick(treeId, treeNode) {
    return true;
}

function onDblClick(event, treeId, treeNode) {
    if(treeNode.id == currentId) {
        return;
    } else {
        changeService(treeNode.id, treeNode.name);
        currentId = treeNode.id;
        currentName = treeNode.name;
    }
}

// initialization
function initTree(setting, nodes) {
    $.fn.zTree.init($("#srvTree"), setting, nodes);
}

function refreshChild() {
    var treeObj = $.fn.zTree.getZTreeObj("srvTree");
    var nodes = treeObj.getSelectedNodes();
    var id = nodes[0].tId;
    var node = treeObj.getNodeByTId(id);
    treeObj.reAsyncChildNodes(node, "refresh");
}

function refreshParent() {
    var treeObj = $.fn.zTree.getZTreeObj("srvTree");
    var nodes = treeObj.getSelectedNodes();
    var pId = nodes[0].parentTId;
    var pnode = treeObj.getNodeByTId(pId);
    treeObj.reAsyncChildNodes(pnode, "refresh");
}

function refreshTree() {
    var nodes = null;
    $.fn.zTree.destroy("srvTree");
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
            alert("AJAX错误!");
        }         
    });
}

$(document).ready(function(){
    currentId = 1;
    currentName = 'SRE';
    var nodes = null;

    // set div height
    headerHeight = $('.navbar').height();
    windowHeight = $(window).height();
    contentHeight = windowHeight - headerHeight - 5;
    $('.sidebar').height(contentHeight);
    $('.content').height(contentHeight);

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
            alert("AJAX错误!");
        }         
    });

    // initialize content
    changeService(currentId, currentName);
});

// resize tree div
$(window).resize(function() {
    // set div height
    headerHeight = $('.navbar').height();
    windowHeight = $(window).height();
    contentHeight = windowHeight - headerHeight - 5;
    $('.sidebar').height(contentHeight);
    $('.content').height(contentHeight);
});
