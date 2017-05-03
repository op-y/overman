{* Smarty *}
<br />
<div class="container">
    <button type="button" class="btn btn-default btn-sm pull-right" id="host_btn_new">
        <span class="glyphicon glyphicon-plus"  aria-hidden="true"></span>添加
    </button>
</div>
<div class="container">
    <table id="hosts_table" class="table table-striped table-hover datatable">
        <thead>
        <tr>
            <th>机器名</th>
            <th>IP</th>
            <th>IDC</th>
            <th>CPU</th>
            <th>内存</th>
            <th>磁盘</th>
            <th>SSD</th>
            <th>RAID</th>
            <th>网卡</th>
            <th>操作</th>
        </tr>
        </thead>
    </table>
</div>

<div class="modal fade" id="host_modal" tabindex="-1" role="dialog" aria-labelledby="host_modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="host_modalLabel">机器信息</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="text" class="hide" id="host_modalField_id">
                    </div>
                    <div class="form-group">
                        <label for="host_modalField_hostname">机器名:</label>
                        <input type="text" class="form-control" id="host_modalField_hostname" placeholder="localhost">
                    </div>
                    <div class="form-group">
                        <label for="host_modalField_ip">IP:</label>
                        <input type="text" class="form-control" id="host_modalField_ip" placeholder="127.0.0.1">
                    </div>
                    <div class="form-group">
                        <label for="host_modalField_idc">IDC:</label>
                        <select class="form-control" id="host_modalField_idc">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="host_modalField_cpu">CPU:</label>
                        <input type="text" class="form-control" id="host_modalField_cpu" placeholder="CPU">
                    </div>
                    <div class="form-group">
                        <label for="host_modalField_memory">内存:</label>
                        <input type="text" class="form-control" id="host_modalField_memory" placeholder="Memory">
                    </div>
                    <div class="form-group">
                        <label for="host_modalField_disk">磁盘:</label>
                        <input type="text" class="form-control" id="host_modalField_disk" placeholder="Disk">
                    </div>
                    <div class="form-group">
                        <label for="host_modalField_ssd">SSD:</label>
                        <input type="text" class="form-control" id="host_modalField_ssd" placeholder="SSD">
                    </div>
                    <div class="form-group">
                        <label for="host_modalField_raid">RAID:</label>
                        <input type="text" class="form-control" id="host_modalField_raid" placeholder="RAID">
                    </div>
                    <div class="form-group">
                        <label for="host_modalField_nic">网卡:</label>
                        <input type="text" class="form-control" id="host_modalField_nic" placeholder="NIC">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="host_modalBtn_commit">提交</button>
                <button type="button" class="btn btn-primary" id="host_modalBtn_cancel">取消</button>
            </div>
        </div>
    </div>
</div>

<script src="/application/views/js/jquery.dataTables.min.js"></script>
<script src="/application/views/js/dataTables.bootstrap.min.js"></script>
<script src="/application/views/js/host.js"></script>
