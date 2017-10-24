{* Smarty Content *}
<div class="col-sm-9 col-md-10 col-lg-10 content">
    <h1 class="page-header">当前服务:<span class="text-primary" id="srvTitle"></span></h1>
    <div id="statusDiv">
        <form>
            <div class="form-group">
                <label for="statusEnv">Deployment:</label>
                <input type="text" class="form-control" id="statusDeploy" disabled>
            </div>
            <div class="form-group">
                <label for="statusEnv">环境:</label>
                <input type="text" class="form-control" id="statusEnv" disabled>
            </div>
            <div class="form-group">
                <label for="statusIDC">机房:</label>
                <input type="text" class="form-control" id="statusIDC" disabled>
            </div>
            <div class="form-group">
                <label for="statusJDKCommand">JDK命令:</label>
                <select class="form-control" id="statusJDKCommand">
                    <option value="jstack">jstack</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary" id="statusJDKStatusBtn">JDK状态</button>
            <button type="button" class="btn btn-primary" id="statusPodLogBtn">Pod日志</button>
        </form>
    </div>
    <br />
    <div class="hide" id="linkDiv">
        <div class="alert alert-success" id="links" role="alert">
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

</div>
<!-- end of row -->

<!-- zTree -->
<script src="/application/views/js/ztree/jquery.ztree.core.js"></script>
<script src="/application/views/js/app/tree.js"></script>
<script src="/application/views/js/app/status.js"></script>
