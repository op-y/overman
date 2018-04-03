{* Smarty Content *}
<div class="col-sm-9 col-md-10 col-lg-10 content">
    <h1 class="page-header">当前服务:<span class="text-primary" id="srvTitle">pre-shopcenter-nativemonitor-api</span></h1>
    <div id="deploymentPanelDiv" class="hidden">
        <form>
              <div class="form-group">
                  <label for="deployment_env">上线环境:</label>
                  <input type="text" class="form-control" id="deployment_env" disabled>
              </div>
              <div class="form-group">
                  <label for="deployment_idc">上线机房:</label>
                  <input type="text" class="form-control" id="deployment_idc" disabled>
              </div>
              <div class="form-group">
                  <label for="deployment_registry">镜像仓库URL:</label>
                  <input type="text" class="form-control" id="deployment_registry" disabled>
              </div>
              <div class="form-group">
                  <label for="deployment_module">模块名称:</label>
                  <input type="text" class="form-control" id="deployment_module" disabled>
              </div>
              <div class="form-group" id="ImageDiv">
              </div>
              <div class="btn-group" role="group">
                  <button type="button" class="btn btn-primary" id="deploymentUpdate">升级</button>
                  <button type="button" class="btn btn-warning" id="deploymentPause">暂停</button>
                  <button type="button" class="btn btn-success" id="deploymentResume">继续</button>
                  <button type="button" class="btn btn-danger" id="deploymentRollback">回滚</button>
              </div>
              <button type="button" class="btn btn-info" id="deploymentStatus">状态</button>
              <button type="button" class="btn btn-info" id="deploymentHistory">历史</button>
        </form>
    </div>
    <br />
    <div class="alert alert-danger hidden" id="deploymentAlertDiv" role="alert">请在服务管理页面添加服务部署配置!</div>
    <div class="alert alert-warning hidden" id="deploymentBlockDiv" role="alert">当前服务高峰期(上午11:00-13:30,下午16:00-20:00)禁止发版!</div>
    <div class="alert alert-info hidden" id="deploymentUpdateInfoDiv" role="alert">注意:服务上线流程已经修改为默认暂停,即点击"升级"之后只会更新1-2个实例,请确认新启动实例正常之后点击"继续"完成升级操作!!!</div>
    <div class="alert alert-info hidden" id="deploymentRollbackInfoDiv"  role="alert">提示:如果上线发生异常，请直接点击"回滚"</div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="updateModalLabel">升级操作结果</h4>
            </div>
            <div class="modal-body" id="updateModalBody">
                <p>后端状态:<span id="backendCode"></span></p>
                <p>后端消息:<span id="backendMessage"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateModalBtnOK">知道了</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="rollbackModal" tabindex="-1" role="dialog" aria-labelledby="rollbackModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="rollbackModalLabel">请确认</h4>
            </div>
            <div class="modal-body" id="rollbackModalBody">
                <h1>回滚操作会将服务回滚到最近一个镜像，不论该镜像是否能正常启动，确认要回滚?</h1>
                <p>我们建议选择Image Tag升级, 实现回滚到指定版本操作.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="rollbackModalBtnOK">回滚</button>
                <button type="button" class="btn btn-default" id="rollbackModalBtnClose">认怂</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="statusModalLabel">部署状态(持续更新)</h4>
            </div>
            <div class="modal-body" id="statusModalBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="statusModalBtnClose">关闭</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="historyModalLabel">部署历史</h4>
            </div>
            <div class="modal-body" id="historyModalBody">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="historyModalBtnClose">关闭</button>
            </div>
        </div>
    </div>
</div>

</div>
<!-- end of row -->

<!-- zTree -->
<script src="/application/views/js/ztree/jquery.ztree.core.js"></script>
<script src="/application/views/js/ztree/jquery.ztree.excheck.js"></script>
<script src="/application/views/js/ztree/jquery.ztree.exedit.js"></script>
<script src="/application/views/js/app/tree.js"></script>
<script src="/application/views/js/app/deployment.js"></script>
