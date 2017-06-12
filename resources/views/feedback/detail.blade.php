<div class="row form">
    <div class="col-md-12 form-body">
        <div class="row form-group">
            <label class="col-md-3 control-label">Người gửi</label>
            <div class="col-md-9">
                {{$feedback->name}}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3 control-label">Email</label>
            <div class="col-md-9">
                {{$feedback->email ? Html::mailto($feedback->email) : ''}}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3 control-label">Nội dung</label>
            <div class="col-md-9">
                <div class="input-group">
                    {{$feedback->message}}
                </div>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3 control-label">Loại</label>
            <div class="col-md-9">
                <span class="label label-{{App\Models\Feedback::TYPE_LABEL[$feedback->type]}}">{{App\Models\Feedback::TYPE[$feedback->type]}}</span>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3 control-label">Gửi lúc</label>
            <div class="col-md-9">
                {{$feedback->created_at}}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3 control-label">IP</label>
            <div class="col-md-9">
                {{$feedback->ip}}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3 control-label">Tình trạng</label>
            <div class="col-md-9">
                <span class="label label-{{App\Models\Feedback::STATUS_LABEL[$feedback->status]}}">{{App\Models\Feedback::STATUS[$feedback->status]}}</span>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3 control-label">Cập nhật lúc</label>
            <div class="col-md-9">
                {{$feedback->updated_at}}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3 control-label">Người xử lý</label>
            <div class="col-md-9">
                {!! $feedback->user ? $feedback->user->name : '<i>Chưa có ai</i>' !!}
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    @if($feedback->status === 0)
                        <a href="javascript:" onclick="bootbox.ajaxConfirm({status: 10}, '{!! route('manage.feedback.process', $feedback->id) !!}')"
                           class="btn btn-sm blue">
                            Tiếp nhận
                        </a>
                    @endif
                    @if($feedback->status !== 100)
                        <a href="javascript:" onclick="bootbox.ajaxConfirm({status: 100}, '{!! route('manage.feedback.process', $feedback->id) !!}')"
                           class="btn btn-sm green">
                            <i class="fa fa-check"></i> Xong
                        </a>
                    @endif
                    <a href="javascript:" class="btn btn-sm red" onclick="bootbox.deleteDialog({}, '{!! route('manage.feedback.delete', $feedback->id) !!}')">
                        <i class="fa fa-trash-o"></i> Xoá
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>