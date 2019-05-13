@extends('layouts.master')

@section('content')
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">
        <!-- breadcrumb -->
        <!-- <ol class="breadcrumb">
                <li>{{ trans('lang.dashboard') }}</li>
                <li>{{ trans('lang.products') }}</li>
            </ol> -->

    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">
            <div class="col-xs-7 col-sm-5 col-lg-8">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-table fa-fw "></i>
                    {{trans('lang.clients')}}
                </h1>
            </div>
            <div class="col-xs-5 col-sm-7 col-lg-4 padding-10">

                <a href="#" ajax_target="clients/create" class="btn btn-success pull-right remote_modal">
                    <i class="fa fa-plus"></i> {{trans('lang.add')}} {{trans('lang.clients')}}
                </a>

                <a href="#" class="btn btn-danger pull-right export margin-right-10">
                    <i class="fa fa-file-excel-o"></i> {{trans('lang.export')}}
                </a>
            </div>
        </div>

        <!-- widget grid -->
        <section id="widget-grid" class="">
            <!-- row -->
            <div class="row">
                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-collapsed="false" data-widget-sortable="false">
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                            <h2>{{trans('lang.clients')}}</h2>
                        </header>
                        <!-- widget div-->
                        <div>
                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->
                            </div>
                            <!-- end widget edit box -->
                            <!-- widget content -->
                            <div class="widget-body no-padding">
                                <table id="datatable_fixed" class="table table-striped table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="hasinput smart-form">
                                                <input type="text" name='name' class="form-control" placeholder="{{ trans('lang.name') }}" />
                                            </th>
                                            <th class="hasinput smart-form">
                                                <input type="text" name='email' class="form-control" placeholder="{{ trans('lang.email') }}" />
                                            </th>
                                            <th class="hasinput smart-form">
                                                <label class="select">
                                                    <select name='status'>
                                                        <option value=""> {{trans('lang.select_status')}}</option>
                                                        <option value="{{App\Models\Clients::CLIENT_STATUS_ENABLE}}">{{trans('lang.enable')}}</option>
                                                        <option value="{{App\Models\Clients::CLIENT_STATUS_DISABLE}}">{{trans('lang.disable')}}</option>
                                                    </select>
                                                    <i></i>
                                                </label>
                                            </th>
                                            <th class="hasinput smart-form">
                                                <input type="text" name='credits' class="form-control" placeholder="{{ trans('lang.credits') }}" />
                                            </th>
                                            <th class="hasinput smart-form">
                                                <input type="text" name='token' class="form-control" placeholder="{{ trans('lang.token') }}" />
                                            </th>
                                            <th class="hasinput smart-form">
                                                <input type="text" class="datepicker form-control" data-dateformat="{{config('date.datepicker_format')}}" autocomplete="off" placeholder="{{ trans('lang.date') }}" name="created_at">
                                            </th>
                                            <th style="width: 100px;"></th>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('lang.name') }}</th>
                                            <th>{{ trans('lang.email') }}</th>
                                            <th>{{ trans('lang.status') }}</th>
                                            <th>{{ trans('lang.credits') }}</th>
                                            <th>{{ trans('lang.token') }}</th>
                                            <th>{{ trans('lang.created_at') }}</th>
                                            <th>{{ trans('lang.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                
                            </div>
                            <!-- end widget content -->
                        </div>
                        <!-- end widget div -->
                    </div>
                    <!-- end widget -->
                </article>
                <!-- WIDGET END -->
            </div>
            <!-- end row -->
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->
</div>

@endsection

@section('custom_plugin')
<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

@endsection

@section('custom_script')

<script>
    $(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });

    $(document).ready(function() {
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;
        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };
        otable = $('#datatable_fixed').DataTable({
            "ajax": {
                url: 'clients/datatable',
                type: 'POST'
            },
            "pageLength": 15,
            "processing": true,
            "serverSide": true,
            "bDestroy": true,
            columns: [
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'credits',
                    name: 'credits'
                },
                {
                    data: 'token',
                    name: 'token'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            "order": [
                [0, 'asc']
            ],
            "sDom": "<'dt-toolbar'<'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,
            "oLanguage": {
                "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
            },
            "preDrawCallback": function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_fixed_column) {
                    responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed'), breakpointDefinition);
                }
            },
            "rowCallback": function(nRow) {
                responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
            },
            "drawCallback": function(oSettings) {
                responsiveHelper_datatable_fixed_column.respond();
                $("[rel=tooltip]").tooltip();
                if ($('.reorder.sorting_asc').hasClass('sorting_asc')) {
                    $('.reorder.sorting_asc').removeClass('sorting_asc');
                }
            }
        });
        $("#datatable_fixed thead th input[type=text]").on('keyup', function(e) {
            if (e.keyCode == 13) {
                otable.column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();
            }
        });
        $("#datatable_fixed thead th select").on('change', function(e) {
            otable.column($(this).parent().parent().index() + ':visible')
                .search(this.value)
                .draw();
        });

    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('submit', '.remove-resource', function(e) {
            e.preventDefault();
            var form = $(this);
            $.SmartMessageBox({
                title: '<i class="fa fa-trash"></i> {{ trans('lang.confirm_removing ') }}',
                content: '{{ trans('lang.confirm_remove').''.trans('lang.users ') }}?',
                buttons: '[{{ trans('lang.cancel') }}][{{ trans('OK') }}]'
            }, function(btn) {
                if (btn === '{{ trans('OK') }}') {
                    $.ajax({
                        type: form.attr('method'),
                        url: form.attr('action'),
                        data: form.serialize(),
                        beforeSend: function() {
                            form.find('button').each(function() {
                                $(this).data('actual-content', $(this).html());
                                $(this).html('<i class="fa fa-refresh fa-spin"></i>');
                                $(this).prop('disabled', true);
                            });
                        },
                        success: function(response) {
                            otable.ajax.reload(function() {
                                if (response.type == "error") {
                                    $.smallBox({
                                        title: '{{ trans('lang.error ') }}',
                                        content: '<i class="fa fa-times"></i> <i>' + response.message + '</i>',
                                        color: '#C46A69',
                                        iconSmall: 'fa fa-times fa-2x fadeInRight animated',
                                        timeout: 4000
                                    });
                                } else {
                                    $.smallBox({
                                        title: '{{ trans('lang.success ') }}',
                                        content: '<i class="fa fa-check"></i> <i>' + response.message + '</i>',
                                        color: '#659265',
                                        iconSmall: 'fa fa-check fa-2x fadeInRight animated',
                                        timeout: 4000
                                    });
                                }

                                form.find('button').each(function() {
                                    $(this).prop('disabled', false);
                                    $(this).html($(this).data('actual-content'));
                                    $(this).removeData('actual-content');
                                });
                            });
                        },
                        error: function(response) {
                            $.smallBox({
                                title: '{{ trans('lang.error ') }}',
                                content: '<i class="fa fa-times"></i> <i>' + response.message + '</i>',
                                color: '#C46A69',
                                iconSmall: 'fa fa-times fa-2x fadeInRight animated',
                                timeout: 4000
                            });
                            form.find('button').each(function() {
                                $(this).prop('disabled', false);
                                $(this).html($(this).data('actual-content'));
                                $(this).removeData('actual-content');
                            });
                        }
                    });
                }
            });
        });

    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('change', '.change_status', function(e) {
            $.ajax({
                type: 'GET',
                url:  $(this).attr('href'),
                success: function(response) {
                      $.smallBox({
                            title: '{{ trans('lang.success ') }}',
                            content: '<i class="fa fa-check"></i> <i>' + response.message + '</i>',
                            color: '#659265',
                            iconSmall: 'fa fa-check fa-2x fadeInRight animated',
                            timeout: 4000
                        });
                    otable.ajax.reload();
                        
                }
            });
                
            });
        });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.view_history', function(e) {
                 e.preventDefault();
                 sessionStorage.setItem("client_id", $(this).attr('data-id'));
                 document.location.href = '/sms_history';
            });
        });
</script>
  <script>
      $('.export').click(function(e){
          e.preventDefault();
          dataArray=$("#datatable_fixed_wrapper thead input,select").serializeArray();
          var data = {};
          $(dataArray).each(function(index, obj){
                data[obj.name] = obj.value;
            });

               console.log(data) ;
          $.ajax({
            type:  "POST",
            url: "/clients/export",
            data: data,
            
            success: function(response){
               var a = document.createElement("a");
                        a.href = response.file; 
                        a.download = response.name;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
            },
        });
      })
</script>




@endsection