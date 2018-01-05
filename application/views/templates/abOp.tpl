{* Smarty *}

<div class="container app-container-gap">
    <h1 class="page-header">操作内容</h1>
    <div id="abOpDiv">
        <form>
              <div class="form-group">
                  <label for="abOp_redis">Redis:</label>
                  <select class="form-control" id="abOp_redis">
                    {foreach $redisList as $redis }
                    <option value="{$redis@value}">{$redis@key}({$redis@value})</option>
                    {/foreach}
                  </select>
              </div>
              <div class="form-group">
                  <label for="abOp_key">Key:</label>
                  <select class="form-control" id="abOp_key">
                    {foreach $redisKeys as $redisKey }
                    <option value="{$redisKey@value}">{$redisKey@key}({$redisKey@value})</option>
                    {/foreach}
                  </select>
              </div>
              <div class="form-group">
                  <label for="abOp_op">OpTpye:</label>
                  <select class="form-control" id="abOp_op">
                    <option value="add">加入小流量(SADD)</option>
                    <option value="remove">移除小流量(SREM)</option>
                    <option value="comfirmOne">确认一个(SISMEMBER)</option>
                    <option value="queryCount">查询数量(SCARD)</option>
                    <option value="queryAll">查询全部(SMEMBERS)</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="abOp_sep">Separator:</label>
                  <select class="form-control" id="abOp_sep">
                    <option value="comma">逗号</option>
                    <option value="space">空格</option>
                    <option value="lf">换行</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="abOp_ids">IDs:</label>
                  <textarea rows="5" class="form-control" id="abOp_ids"></textarea>
              </div>
              <button type="button" class="btn btn-danger" id="abOpOK">走你</button>
        </form>
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

<script src="/application/views/js/app/abOp.js"></script>
