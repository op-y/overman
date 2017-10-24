{* Smarty *}
<br />
<div class="container">
    <button type="button" class="btn btn-default btn-sm pull-right" id="mineBtnApply">
        <span class="glyphicon glyphicon-plus"  aria-hidden="true"></span>申请权限
    </button>
</div>
<br />
<div class="container">
    <table id="authTable" class="table table-striped table-hover datatable">
        <thead>
        <tr>
            <th>服务名</th>
            <th>你的角色</th>
            <th>操作</th>
        </tr>
        </thead>
    </table>
</div>

<div class="modal fade" id="mineModal" tabindex="-1" role="dialog" aria-labelledby="mineModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mineModalLabel">权限申请</h4>
            </div>
            <div class="modal-body">
                <p>暂不开放申请</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="mineModalBtnCommit">提交</button>
                <button type="button" class="btn btn-primary" id="mineModalBtnCancel">取消</button>
            </div>
        </div>
    </div>
</div>

<script src="/application/views/js/jquery.dataTables.min.js"></script>
<script src="/application/views/js/dataTables.bootstrap.min.js"></script>
<script src="/application/views/js/app/mine.js"></script>
