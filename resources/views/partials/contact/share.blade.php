<div class="btn-group">
    <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false">
        <i class="fa fa-share"></i> Chia sẻ
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="javascript:;" onclick="copyToClipboard('{{route('contact.slug', $contact->slug)}}')">
                <i class="fa fa-copy"></i> Sao chép đường dẫn
            </a>
        </li>
    </ul>
</div>