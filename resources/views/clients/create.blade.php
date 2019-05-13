<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('lang.clients') }}</h4>
</div>
<div id="result"></div>

<div class="modal-body no-padding">

    <form action="clients" id="add-clients-form" method="post" class="smart-form">
        <fieldset>
            <div class="row">
                <section class="col col-xs-6">
                    <label class="label">{{ trans('lang.name') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="name" placeholder="{{ trans('lang.name') }}">
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">{{ trans('lang.email') }}</label>
                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                        <input type="email" name="email" placeholder="{{ trans('lang.email') }}" autocomplete="off">
                    </label>
                </section>
            </div>
            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.credits') }}</label>
                    <label class="input"> <i class="icon-append fa fa-money"></i>
                        <input type="text" name="credits" placeholder="{{ trans('lang.credits') }}" autocomplete="off">
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">&nbsp</label>
                    <label class="toggle">
                        <input type="checkbox" name="status" checked="checked">
                        <i data-swchon-text="ON" data-swchoff-text="OFF"></i>{{trans('lang.enable_activity')}}</label>
                </section>
            </div>
        </fieldset>
        <footer>
            <button type="submit" class="btn btn-primary">
                {{ trans('lang.save') }} {{ trans('lang.clients') }}
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                {{ trans('lang.cancel') }}
            </button>
        </footer>
    </form>

</div>

<script>
    var errorClass = 'invalid';
    var errorElement = 'em';

    var $registerForm = $("#add-clients-form").validate({
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
            submit_form('#add-clients-form', '#result')
        }
    });
</script>