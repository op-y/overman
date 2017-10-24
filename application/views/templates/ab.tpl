{* Smarty *}

<div class="container app-container-gap">

    <table class="table table-hover table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center"><span>小流量类型</span></th>
                <th class="text-center"><span>小流量作用域名</span></th>
                <th class="text-center"><span>当前小流量集团数<span></th>
            </tr>
        </thead>
        <tbody>
        {foreach $abTest as $test }
            <tr>
                <td>
                    <a data-toggle="tooltip" data-placement="bottom" data-original-title="{$test.tips}">{$test.name}</a>
                </td>
                <td>
                    <strong>{$test.domain}</strong>
                </td>
                <td>
                    <span class="label label-primary" onclick='show("{$test.itemkey}")'>{$test.count}</span>
                </td>
            </tr>
        {/foreach}
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    <div class="input-group">
                        <input id="groupID" type="text" class="form-control" placeholder="Group ID">
                        <span class="input-group-btn">
                            <button id="groupSearch" class="btn btn-default" type="button">集团查询</button>
                        </span>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>

<div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="groupModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="groupModalLabel"><span id="groupModalTitleName"></span>集团<span id="groupModalTitleID"></span>命中小流量信息</h4>
            </div>
            <div id="groupModalBody" class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="groupModalBtnOK">知道了</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="detailModalLabel"><span id="detailModalTitleName"></span>小流量集团列表</h4>
            </div>
            <div id="detailModalBody" class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="detailModalBtnOK">知道了</button>
            </div>
        </div>
    </div>
</div>

</div>

<script src="/application/views/js/app/ab.js"></script>
