{* Smarty *}
<div class="col-sm-9 col-md-10 col-lg-10 content">
    <h1 class="page-header">当前服务:<span class="text-primary" id="srvTitle"></span></h1>

    <div class="btn-toolbar" role="toolbar">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-success" id="srvBtnNew">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
            </button>
            <button type="button" class="btn btn-warning" id="srvBtnEdit">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>重命名
            </button>
            <button type="button" class="btn btn-danger" id="srvBtnDel">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>删除
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary" id="srvBtnDeploy">
                <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>部署
            </button>
        </div>
    </div>

    <br/>
    <br/>

    <div class="panel panel-primary">
        <div class="panel-heading">子服务列表</div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>服务ID</th>
                        <th>服务名称</th>
                        <th>服务类型</th>
                    </tr>
                </thead>
                <tbody id="srvSubServiceList">
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">服务部署配置</div>
        <div class="panel-body">
           <dl class="dl-horizontal">
               <dt>部署环境</dt><dd><span id="srvDeploymentEnv"><span></dd>
               <dt>部署机房</dt><dd><span id="srvDeploymentIDC"><span></dd>
               <dt>Jenkins任务名</dt><dd><span id="srvDeploymentJenkinsName"></span></dd>
               <dt>Git项目路径</dt><dd><span id="srvDeploymentGitRepoUrl"></span></dd>
               <dt>Git代码分支</dt><dd><span id="srvDeploymentGitBranch"></span></dd>
               <dt>编译参数</dt><dd><span id="srvDeploymentCompileParam"></span></dd>
               <dt>JAR包路径</dt><dd><span id="srvDeploymentJarPath"></span></dd>
               <dt>启动参数</dt><dd><span id="srvDeploymentRunParam"></span></dd>
               <dt>镜像仓库地址</dt><dd><span id="srvDeploymentImageRepoUrl"></span></dd>
               <dt>Kubernetes部署名</dt><dd><span id="srvDeploymentK8sName"></span></dd>
               <dt>Kubernetes服务端口</dt><dd><span id="srvDeploymentK8sPort"></span></dd>
           </dl>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">当前部署配置</div>
        <div class="panel-body">
            Endpoints
        </div>
    </div>

    <div class="modal fade" id="srvModal" tabindex="-1" role="dialog" aria-labelledby="srvModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="srvModalLabel">添加服务</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="srvModalFieldPid">PID:</label>
                            <input type="text" class="form-control" id="srvModalFieldPid" value="" disabled>
                        </div>
                        <div class="form-group">
                            <label for="srvModalFieldPname">Pname:</label>
                            <input type="text" class="form-control" id="srvModalFieldPname" value="" disabled>
                        </div>
                        <div class="form-group">
                            <label for="srvModalFieldName">服务名称:</label>
                            <input type="text" class="form-control" id="srvModalFieldName" placeholder="Service Name">
                        </div>
                        <div class="form-group">
                            <label for="srvModalFieldKind">服务类型:</label>
                            <select class="form-control" id="srvModalFieldKind">
                                <!--<option value="ROOT">根服务</option>-->
                                <option value="COMPANY">公司</option>
                                <option value="PRODUCT">产品线</option>
                                <option value="GROUP">服务</option>
                                <option value="UNIT" selected="selected">服务单元</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="srvModalBtnCommit">提交</button>
                    <button type="button" class="btn btn-primary" id="srvModalBtnCancel">取消</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deployModal" tabindex="-1" role="dialog" aria-labelledby="deployModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="deployModalLabel">服务部署配置</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="text" class="hide" id="deployModalFieldId">
                        </div>
                        <div class="form-group">
                            <label for="deployModalFieldServiceId">Service ID:</label>
                            <input type="text" class="form-control" id="deployModalServiceId" readonly>
                        </div>
                        <div class="form-group">
                            <label for="deployModalFieldEnv">Deployment Environment:</label>
                            <select class="form-control" id="deployModalFieldEnv">
                                <option value="pre">预上线(pre)</option>
                                <option value="www">线上(www)</option>
                                <option value="mis">内部线(mis)</option>
                                <option value="caidanmao">彩蛋猫(caidanmao)</option>
                                <option value="dingduoduo">订多多(dingduoduo)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deployModalFieldIDC">Deployment IDC:</label>
                            <select class="form-control" id="deployModalFieldIDC">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deployModalFieldJenkinsName">Jenkins Name:</label>
                            <input type="text" class="form-control" id="deployModalFieldJenkinsName" placeholder="Jenkins Job Name">
                        </div>
                        <div class="form-group">
                            <label for="deployModalFieldGitRepoUrl">Git Repository URL:</label>
                            <input type="text" class="form-control" id="deployModalFieldGitRepoUrl" placeholder="Git Repository URL">
                        </div>
                        <div class="form-group">
                            <label for="deployModalFieldGitBranch">Git Branch:</label>
                            <input type="text" class="form-control" id="deployModalFieldGitBranch" placeholder="Git Branch">
                        </div>
                        <div class="form-group">
                            <label for="deployModalFieldCompileParam">Compile Parameters:</label>
                            <input type="text" class="form-control" id="deployModalFieldCompileParam" placeholder="Compile Parameters">
                        </div>
                        <div class="form-group">
                            <label for="deployModalFieldJarPath">JAR Package Path:</label>
                            <input type="text" class="form-control" id="deployModalFieldJarPath" placeholder="JAR Package Path">
                        </div>
                        <div class="form-group">
                            <label for="deployModalFieldRunParam">Run Parameters:</label>
                            <input type="text" class="form-control" id="deployModalFieldRunParam" placeholder="Run Parameters">
                        </div>
                        <div class="form-group">
                            <label for="deployModalFieldImageRepoUrl">Image Registry URL:</label>
                            <input type="text" class="form-control" id="deployModalFieldImageRepoUrl" placeholder="Image Registry URL">
                        </div>
                        <div class="form-group">
                            <label for="deployModalFieldK8sName">Kubernetes Deployment Name:</label>
                            <input type="text" class="form-control" id="deployModalFieldK8sName" placeholder="Kubernetes Deployment Name">
                        </div>
                        <div class="form-group">
                            <label for="deployModalFieldK8sPort">Kubernetes Service Port:</label>
                            <input type="text" class="form-control" id="deployModalFieldK8sPort" placeholder="Kubernetes Service Port">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="deployModalBtnCommit">提交</button>
                    <button type="button" class="btn btn-primary" id="deployModalBtnCancel">取消</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="renameModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="renameModalLabel">服务重命名</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="text" class="hide" id="renameModalFieldId">
                        </div>
                        <div class="form-group">
                            <label for="renameModalFieldOldName">Old Name:</label>
                            <input type="text" class="form-control" id="renameModalFieldOldName" readonly>
                        </div>
                        <div class="form-group">
                            <label for="renameModalFieldNewName">New Name:</label>
                            <input type="text" class="form-control" id="renameModalFieldNewName" placeholder="New Service Name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="renameModalBtnCommit">提交</button>
                    <button type="button" class="btn btn-primary" id="renameModalBtnCancel">取消</button>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
<!-- end of row -->

<script src="/application/views/js/ztree/jquery.ztree.core.js"></script>
<script src="/application/views/js/ztree/jquery.ztree.excheck.js"></script>
<script src="/application/views/js/ztree/jquery.ztree.exedit.js"></script>
<script src="/application/views/js/app/tree.js"></script>
<script src="/application/views/js/app/service.js"></script>
