{* Smarty *}
<div class="container">
    <div class="app-container-gap">
        <h1>{$teams.sre.display}</h1>
    </div>

    <div>
        <div class="btn-group">
            <button type="button" class="btn btn-default" id="duty_btn_update">
                <span class="glyphicon glyphicon-calendar"  aria-hidden="true"></span>值班调整
            </button>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-default" id="team_btn_show" data-toggle="collapse" data-target="#collapseMembers" aria-expanded="false" aria-controls="collapseMembers">
                <span class="glyphicon glyphicon-user"></span>团队成员
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary" data-calendar-nav="prev">&lt;&lt;</button>
            <button type="button" class="btn btn-default" data-calendar-nav="today">今日</button>
            <button type="button" class="btn btn-primary" data-calendar-nav="next">&gt;&gt;</button>
        </div>
        <div class="btn-group">
            <button class="btn btn-warning" data-calendar-view="year">年</button>
            <button class="btn btn-warning active" data-calendar-view="month">月</button>
            <button class="btn btn-warning" data-calendar-view="week">周</button>
            <button class="btn btn-warning" data-calendar-view="day">日</button>
        </div>
    </div>
    <br />

    <div class="collapse well" id="collapseMembers">
        <div class="row">
            {foreach $teams.sre.members as $name => $op }
            <div class="col-md-3" style="text-overflow:ellipsis;">
                <h4>{$op.display}</h4>
                <p>Tel: {$op.tel}</p>
                <p>Email: {$op.email}</p>
                <p>Duty: {$op.duty}</p>
            </div>
            {if 3 == $op@index%4 || $op@last}
            </div>
            <br />
            <div class="row">
            {/if}
            {/foreach}
        </div>
    </div>

    <div>
        <div class="calendar" id="calendar"></div>
    </div>
</div>

<div class="modal fade" id="info-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>值班</h3>
            </div>
            <div class="modal-body" style="height: 400px">
            </div>
            <div class="modal-footer">
               <a href="#" data-dismiss="modal" class="btn">关闭</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="duty-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>修改值班人</h3>
            </div>
            <div class="modal-body" style="height: 400px">
                <form>
                    <div class="form-group">
                        <label for="duty_modalField_date">值班日期:</label>
                        <input type="date" class="form-control" id="duty_modalField_date">
                    </div>
                    <div class="form-group">
                        <label for="duty_modalField_op">值班人:</label>
                        <select class="form-control" id="duty_modalField_op">
                            {foreach $teams.sre.members as $name => $op }
                            <option value="{$name}">{$op.display}</option>
                            {/foreach}
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="duty_modalBtn_commit">提交</button>
                <button type="button" class="btn btn-primary" id="duty_modalBtn_cancel">取消</button>
            </div>
        </div>
    </div>
</div>


<script src="/application/views/js/calendar.min.js"></script>
<script src="/application/views/js/underscore-min.js"></script>
<script src="/application/views/js/calendar-language/zh-CN.js"></script>
<script src="/application/views/js/app/team.js"></script>
