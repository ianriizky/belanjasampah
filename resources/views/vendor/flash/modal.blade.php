<div class="modal fade {{ $modalClass or '' }}" id="flash-overlay-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="defaultModalLabel">{{ $title }}</h4>
            </div>
            <div class="modal-body">
                <p>{!! $body !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>
