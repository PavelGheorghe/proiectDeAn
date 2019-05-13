<style>
    .btn-group .btn-sm {
        padding: 6px 70px 5px;
    }
</style>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('lang.edit_clients') }}</h4>
</div>

<div id="result"></div>
<div class="modal-body no-padding">
    <form action="clients/{{$client->id}}" id="update-client-form" method="post" class="smart-form">
        <input name="_method" type="hidden" value="PUT">
        <fieldset>
            <div class="row">
                <section class="col col-xs-6">
                    <label class="label">{{ trans('lang.name') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" value={{$client->name}} name="name" placeholder="{{ trans('lang.name') }}">
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">{{ trans('lang.email') }}</label>
                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                        <input type="email" value={{$client->email}} name="email" placeholder="{{ trans('lang.email') }}" autocomplete="off">
                    </label>
                </section>
            </div>
            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.credits') }}</label>
                    <label class="input"> <i class="icon-append fa fa-money"></i>
                        <input type="text" value={{$client->credits}} name="credits" placeholder="{{ trans('lang.credits') }}" autocomplete="off">
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">&nbsp</label>
                    <label class="toggle">
                        <input type="checkbox" name="status" @if($client->status) checked @endif>
                        <i data-swchoff-text="OFF" data-swchon-text="ON"></i>{{trans('lang.enable_activity')}}</label>
                </section>
            </div>
        </fieldset>

        <footer>
            <button type="submit" class="btn btn-primary">
                {{ trans('lang.edit') }} {{ trans('lang.clients') }}
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                {{ trans('lang.cancel') }}
            </button>
        </footer>
    </form>

</div>


<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/jquery_form/jquery.form.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        var errorClass = 'invalid';
        var errorElement = 'em';

        var $registerForm = $("#update-client-form").validate({
            errorClass: errorClass,
            errorElement: errorElement,
            highlight: function(element) {
                $(element).parent().removeClass('state-success').addClass("state-error");
                $(element).removeClass('valid');
            },
            unhighlight: function(element) {
                $(element).parent().removeClass("state-error").addClass('state-success');
                $(element).addClass('valid');
            },
            // Rules for form validation
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                credits: {
                    required: true,
                    number: true
                },
            },
            // Messages for form validation
            messages: {

            },
            // Do not change code below
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
                if (element.attr("name") == "company" || element.attr("name") == "type_company") {
                    error.parent().find('.bootstrap-select').removeClass('setvalid').addClass('notvalid');
                }
            },
            submitHandler: function(form) {
                submit_form('#update-client-form', '#result')
            }
        });
    });
</script>