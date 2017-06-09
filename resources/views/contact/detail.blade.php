<div class="row form margin-top-20">
    <div class="col-md-12 form-body">
        <div class="row form-group">
            <label class="col-md-3 control-label"><b></b></label>
            <div class="col-md-9">
                @include('partials.contact.action')
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3 control-label"><b>Tên</b></label>
            <div class="col-md-9">
                {{$contact->name}}
            </div>
        </div>
        @if($contact->description)
            <div class="row form-group">
                <label class="col-md-3 control-label"><b>Chức vụ</b></label>
                <div class="col-md-9">
                    {{$contact->description}}
                </div>
            </div>
        @endif
        @if($contact->phone_nr)
            <div class="row form-group">
                <label class="col-md-3 control-label"><b>SĐT nhà riêng</b></label>
                <div class="col-md-9">
                    {{$contact->phone_nr}}
                </div>
            </div>
        @endif
        @if($contact->phone_cq)
            <div class="row form-group">
                <label class="col-md-3 control-label"><b>SĐT cơ quan</b></label>
                <div class="col-md-9">
                    {{$contact->phone_cq}}
                </div>
            </div>
        @endif
        @if($contact->phone_dd)
            <div class="row form-group">
                <label class="col-md-3 control-label"><b>SĐT di động</b></label>
                <div class="col-md-9">
                    {{$contact->phone_dd}}
                </div>
            </div>
        @endif
        @if($contact->fax)
            <div class="row form-group">
                <label class="col-md-3 control-label"><b>Fax</b></label>
                <div class="col-md-9">
                    {{$contact->fax}}
                </div>
            </div>
        @endif
        @if($contact->email)
            <div class="row form-group">
                <label class="col-md-3 control-label"><b>Email</b></label>
                <div class="col-md-9">
                    {{Html::mailto($contact->email)}}
                </div>
            </div>
        @endif
        @if($contact->children->isNotEmpty())
            <div class="row form-group">
                <label class="col-md-3 control-label"><b>Các cán bộ/đơn vị</b></label>
                <div class="col-md-9">
                    @foreach($contact->children as $child)
                        <a href="javascript:" onclick="bootbox.detailDialog({}, '{{route('contact.show', $child->id)}}')">{{$child->name}} {{$child->description ? "($child->description)" : ""}}</a>
                        <br>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>