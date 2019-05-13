@extends('layouts.app')

@section('content')
<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-4 col-md-offset-4">
                <div class="well no-padding">
                    <form  id="register-form" class="smart-form" method="post" action="reset">
                        {{ csrf_field() }}
                        <header>
                        {{trans('lang.reset_password')}}
                       </header>
                       <div id="result"></div>
                       <fieldset>
            
                        <section >
                            <label class="label">{{ trans('lang.e_mail') }}</label>
                            <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                <input type="email" name="email" placeholder="{{ trans('lang.e_mail') }}" autocomplete="off">
                            </label>
                        </section>

                    </fieldset>
                    <footer>
                     <a href="{{url('login')}}" class="btn btn-primary pull-left">
                            {{trans('lang.back')}}   
                        </a>
                        <button type="submit" class="btn btn-primary">
                            {{trans('lang.send')}}   
                        </button>
                    </footer>
                </form>

            </div>

        </div>
    </div>
</div>

</div>
@endsection
@section('custom_script')



<script type="text/javascript">
runAllForms();

$(function () {

    var errorClass = 'invalid';
    var errorElement = 'em';

    var $registerForm = $("#register-form").validate({
        errorClass: errorClass,
        errorElement: errorElement,
        highlight: function (element) {
            $(element).parent().removeClass('state-success').addClass("state-error");
            $(element).removeClass('valid');
        },
        unhighlight: function (element) {
            $(element).parent().removeClass("state-error").addClass('state-success');
            $(element).addClass('valid');
        },
        // Rules for form validation
        rules: {
          
            email: {
                required: true,
                email: true
            },
          
        },
        // Messages for form validation
        messages: {
          
            email: {
                required: "{{trans('lang.email_required')}}",
                email: "{{trans('lang.email_invalid')}}"
            },

        },
        // Do not change code below
        errorPlacement: function (error, element) {
            error.insertAfter(element.parent());
        },
        submitHandler: function (form) {
            submit_form('#register-form', '#result')
        }
    });
});
</script>
@endsection