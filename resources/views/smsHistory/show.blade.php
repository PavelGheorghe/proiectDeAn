<style>
    .btn-group .btn-sm {
        padding: 6px 70px 5px;
    }
</style>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('lang.sms_details') }}</h4>
</div>
<div id="result"></div>
<div class="modal-body no-padding">
    <form id="update-user-form" method="post" class="smart-form">
        <input name="_method" type="hidden" value="PUT">
        <fieldset>
            <div class="row">
                <section class="col col-4">
                    <label class="label">{{ trans('lang.clients') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" value="{{$sms->client->name}}" disabled>
                    </label>
                </section>
                <section class="col col-4">
                    <label class="label">{{ trans('lang.phone_number') }}</label>
                    <label class="input"> <i class="icon-append fa fa-phone"></i>
                        <input type="text" value="{{$sms->phone_number}}" disabled>
                    </label>
                </section>

                <section class="col col-4">
                    <label class="label">{{ trans('lang.send_status') }}</label>
                    <label class="input"> <i class="icon-append fa fa-check"></i>
                        <input type="text" class="text-uppercase" value="<?php echo array_search($sms->send_status, config('ctrl.status.sms')); ?>" disalbled>
                    </label>
                </section>
                <section class="col col-xs-12">
                    <label class="label">{{ trans('lang.send_message') }}</label>
                    <textarea name="" style="width:100%" rows="3" disabled>{{$sms->send_message}}</textarea>
                </section>
                <section class="col col-6">
                    <label class="label">{{ trans('lang.send_desc') }}</label>
                    <label class="input"> <i class="icon-append fa  fa-info-circle"></i>
                        <input type="text" value="{{$sms->send_desc}}" disabled>
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">{{ trans('lang.phone_sender') }}</label>
                    <label class="input"> <i class="icon-append fa fa-phone"></i>
                        <input type="text" value="{{$sms->phone_sender}}" disabled>
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">{{ trans('lang.provider') }}</label>
                    <label class="input"> <i class="icon-append fa fa-info-circle"></i>
                        <input type="text" value="{{$sms->provider}}" disabled>
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">{{ trans('lang.tag1') }}</label>
                    <label class="input"> <i class="icon-append fa fa-info-circle"></i>
                        <input type="text" value="{{$sms->tag1}}" disabled>
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">{{ trans('lang.tag1') }}</label>
                    <label class="input"> <i class="icon-append fa fa-info-circle"></i>
                        <input type="text" value="{{$sms->tag2}}" disabled>
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">{{ trans('lang.created_at') }}</label>
                    <label class="input"> <i class="icon-append fa fa-info-circle"></i>
                        <input type="text" value="{{$sms->created_at}}" disabled>
                    </label>
                </section>
            </div>
        </fieldset>
        <footer>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                {{ trans('lang.cancel') }}
            </button>
        </footer>
    </form>

</div>


<!-- PAGE RELATED PLUGIN(S) -->