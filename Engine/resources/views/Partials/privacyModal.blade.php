<div id="ModalPrivacy" class="modal fade ModalMore ModalPrivacy" role="dialog">
    <div class="modal-dialog">
                    
        <div class="modal-content">

            <div class="modal-body">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="desc">
                	@php
                    $privacyContent = \App\Models\Page::NotDeleted()->where('status',1)->where('title','سياسة الخصوصية')->first();
                    @endphp
                    {!! $privacyContent->description !!}
                </div>
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">اغلاق</button>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>