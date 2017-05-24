<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <i class="fa fa-question"></i>
            <a class="accordion-toggle" data-toggle="collapse"
               data-parent="#search-result" href="#collapse_{{isset($faq) ? $faq->id : ''}}">
                {{isset($faq) ? $faq->question : ''}}
            </a>
        </h4>
    </div>
    <div id="collapse_{{isset($faq) ? $faq->id : ''}}" class="panel-collapse collapse">
        <div class="panel-body">
            {!! isset($faq) ? $faq->answer : '' !!}
        </div>
    </div>
</div>