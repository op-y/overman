{* Smarty *}
<br />
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-3 col-sm-4 col-sm-offset-2 profile-box">
            <form>
                  <div class="form-group">
                      <label for="username">用户名:</label>
                      <input type="text" class="form-control" id="username" value="{$user->username}" disabled>
                  </div>
                  <div class="form-group">
                      <label for="tel">联系电话:</label>
                      <input type="text" class="form-control" id="tel" value="{$user->tel}">
                  </div>
                  <div class="form-group">
                      <label for="email">电子邮件:</label>
                      <input type="text" class="form-control" id="email" value="{$user->email}">
                  </div>
                  <div class="btn-group" role="group">
                      <button type="button" class="btn btn-primary" id="profileUpdate">更新</button>
                  </div>
            </form>
        </div>

        <div class="col-md-3 col-sm-4 profile-box">
            <form>
                  <div class="form-group">
                      <label for="oldPassword">旧密码:</label>
                      <input type="password" class="form-control" id="oldPassword">
                  </div>
                  <div class="form-group">
                      <label for="newPassword">新密码:</label>
                      <input type="password" class="form-control" id="newPassword">
                  </div>
                  <div class="form-group">
                      <label for="newPassword2">确认新密码:</label>
                      <input type="password" class="form-control" id="newPassword2">
                  </div>
                  <div class="btn-group" role="group">
                      <button type="button" class="btn btn-primary" id="passwordUpdate">更新</button>
                  </div>
            </form>
        <div>
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

<script src="/application/views/js/app/profile.js"></script>
