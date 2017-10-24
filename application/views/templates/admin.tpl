{* Smarty *}
<br />
<div class="container">
    <div class="btn-tullbar pull-right" role="toolbar">
        <button type="button" class="btn btn-default btn-sm" id="userBtnNew">
            <span class="glyphicon glyphicon-user"  aria-hidden="true"></span>添加
        </button>
        <button type="button" class="btn btn-default btn-sm" id="authBtnNew">
            <span class="glyphicon glyphicon-plus"  aria-hidden="true"></span>授权
        </button>
    </div>
</div>
<br />
<div class="container">
    <table id="userTable" class="table table-striped table-hover datatable">
        <thead>
        <tr>
            <th>用户名</th>
            <th>联系电话</th>
            <th>Email</th>
            <th>账号状态</th>
        </tr>
        </thead>
    </table>
</div>

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="userModalLabel">添加用户</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="userModalFieldUsername">用户名:</label>
                        <input type="text" class="form-control" id="userModalFieldUsername" placeholder="User Name">
                    </div>
                    <div class="form-group">
                        <label for="userModalFieldTel">手机号码:</label>
                        <input type="text" class="form-control" id="userModalFieldTel" placeholder="Cell Phone Number">
                    </div>
                    <div class="form-group">
                        <label for="userModalFieldEmail">电子邮件:</label>
                        <input type="text" class="form-control" id="userModalFieldEmail" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <label for="userModalFieldPassword">初始密码:</label>
                        <input type="password" class="form-control" id="userModalFieldPassword" placeholder="Initial Password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="userModalBtnCommit">确定</button>
                <button type="button" class="btn btn-primary" id="userModalBtnCancel">取消</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="authModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="authModalLabel">授权</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group" id="userDiv">
                    </div>
                    <div class="form-group" id="roleDiv">
                    </div>
                    <div class="form-group" id="serviceDiv">
                        <label for="serviceChecked">选中服务:</label>
                        <div id="serviceChecked">
                        </div>
                    </div>
                    <div class="form-group" id="srvx">
                       <ul id="srvTree" class="ztree"></ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="authModalBtnCommit">确定</button>
                <button type="button" class="btn btn-primary" id="authModalBtnCancel">取消</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="msgModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="msgModalLabel"><span id="msgModalTitleName"></span>消息</h4>
            </div>
            <div id="msgModalBody" class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="msgModalBtnOK">知道了</button>
            </div>
        </div>
    </div>
</div>

<script src="/application/views/js/jquery.dataTables.min.js"></script>
<script src="/application/views/js/dataTables.bootstrap.min.js"></script>
<script src="/application/views/js/ztree/jquery.ztree.core.js"></script>
<script src="/application/views/js/ztree/jquery.ztree.excheck.js"></script>
<script src="/application/views/js/app/admin.js"></script>
