{* Smarty *}
<br />
<div class="container">
    <button type="button" class="btn btn-default btn-sm pull-right" id="idc_btn_new">
        <span class="glyphicon glyphicon-plus"  aria-hidden="true"></span>添加
    </button>
</div>
<br />
<div class="container col-sm-12 col-md-12 col-lg-12">
    <table id="idcs_table" class="table table-striped table-hover datatable">
        <thead>
        <tr>
            <th>IDC名称</th>
            <th>IDC代码</th>
            <th>地址</th>
            <th>联系人</th>
            <th>联系电话</th>
            <th>操作</th>
        </tr>
        </thead>
    </table>
</div>

<div class="modal fade" id="idc_modal" tabindex="-1" role="dialog" aria-labelledby="idc_modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="idc_modalLabel">IDC信息</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="text" class="hide" id="idc_modalField_id">
                    </div>
                    <div class="form-group">
                        <label for="idc_modalField_name">IDC名称:</label>
                        <input type="text" class="form-control" id="idc_modalField_name" placeholder="IDC Name">
                    </div>
                    <div class="form-group">
                        <label for="idc_modalField_code">IDC代码:</label>
                        <input type="text" class="form-control" id="idc_modalField_code" placeholder="IDC Name">
                    </div>
                    <div class="form-group">
                        <label for="idc_modalField_address">IDC地址:</label>
                        <input type="text" class="form-control" id="idc_modalField_address" placeholder="IDC Address">
                    </div>
                    <div class="form-group">
                        <label for="idc_modalField_administrator">联系人:</label>
                        <input type="text" class="form-control" id="idc_modalField_administrator" placeholder="联系人">
                    </div>
                    <div class="form-group">
                        <label for="idc_modalField_tel">联系电话:</label>
                        <input type="text" class="form-control" id="idc_modalField_tel" placeholder="联系电话">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="idc_modalBtn_commit">提交</button>
                <button type="button" class="btn btn-primary" id="idc_modalBtn_cancel">取消</button>
            </div>
        </div>
    </div>
</div>

<script src="/application/views/js/jquery.dataTables.min.js"></script>
<script src="/application/views/js/dataTables.bootstrap.min.js"></script>
<script src="/application/views/js/app/idc.js"></script>
