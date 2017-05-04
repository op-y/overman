{* Smarty *}
<br />
<div class="container">
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
    <div class="btn-group">
        <button type="button" class="btn btn-default" id="event_btn_new">
            <span class="glyphicon glyphicon-th-list"  aria-hidden="true"></span>计划
        </button>
    </div>
</div>
<br />

<div class="container">
    <div>
        <h3 id="dateTitle"></h3>
    </div>
    <hr />
    <div class="calendar" id="calendar"></div>
</div>

<div class="modal fade" id="info-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>事件</h3>
            </div>
            <div class="modal-body" style="height: 400px">
            </div>
            <div class="modal-footer">
               <a href="#" data-dismiss="modal" class="btn">关闭</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="event-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>添加计划事件</h3>
                <blockquote><p>Tips: 每天的事件最好不要超过4个,不然日视图很难看!(这个OP很懒,不想改第三方插件...)</p></blockquote>
            </div>
            <div class="modal-body" style="height: 400px">
                <form>
                    <div class="form-group">
                        <label for="event_modalField_title">事件名称:</label>
                        <input type="text" class="form-control" id="event_modalField_title" placeholder="Event Name">
                    </div>
                    <div class="form-group">
                        <label for="event_modalField_url">详情链接:</label>
                        <input type="text" class="form-control" id="event_modalField_url" placeholder="Event URL">
                    </div>
                    <div class="form-group">
                        <label for="event_modalField_class">事件等级:</label>
                        <select class="form-control" id="event_modalField_class">
                            <option value="event-info">普通操作(blue)</option>
                            <option value="event-warning">风险操作(yellow)</option>
                            <option value="event-important">高危操作(red)</option>
                            <option value="event-special">特殊事件(purple)</option>
                            <option value="event-succes">值班安排(green)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="event_modalField_start">开始时间:</label>
                        <input type="datetime-local" class="form-control" id="event_modalField_start" placeholder="Start Time">
                    </div>
                    <div class="form-group">
                        <label for="event_modalField_end">结束时间:</label>
                        <input type="datetime-local" class="form-control" id="event_modalField_end" placeholder="End Time">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="event_modalBtn_commit">提交</button>
                <button type="button" class="btn btn-primary" id="event_modalBtn_cancel">取消</button>
            </div>
        </div>
    </div>
</div>

<script src="/application/views/js/calendar.min.js"></script>
<script src="/application/views/js/underscore-min.js"></script>
<script src="/application/views/js/calendar-language/zh-CN.js"></script>
<script src="/application/views/js/event.js"></script>
