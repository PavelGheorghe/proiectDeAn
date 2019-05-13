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
                    {{trans('lang.sms_history')}}
                </h1>
            </div>
        </div>
        @include('smsHistory.chunk.search')
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
                            <h2>{{trans('lang.sms_history')}}</h2>
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
                                            <th data-class="expand">{{ trans('lang.phone_number') }}</th>
                                            <th>{{ trans('lang.sms_text') }}</th>
                                            <th>{{ trans('lang.send_status') }}</th>
                                            <th>{{ trans('lang.send_message') }}</th>
                                            <th>{{ trans('lang.clients') }}</th>
                                            <th>{{ trans('lang.created_at') }}</th>
                                            <th style="width:70px">{{ trans('lang.action') }}</th>
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
    $(document).ready(function() {

        $('input[type=text]').keyup(function(e) {
            if (e.keyCode == 13) {
                $('.search').click();
            }
        });

        $('#startdate').datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            onSelect: function(selectedDate) {
                $('#finishdate').datepicker('option', 'minDate', selectedDate);
            }
        });

        $('#finishdate').datepicker({
            dateFormat: 'yy-mm-dd',
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            onSelect: function(selectedDate) {
                $('#startdate').datepicker('option', 'maxDate', selectedDate);
            }
        });


    });
</script>
<script>
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
                url: 'sms_history/datatable',
                type: 'POST',
                data: function() {
                    dataArray = $(".search-container input,select").serializeArray();
                    var data = {};
                    $(dataArray).each(function(index, obj) {
                        data[obj.name] = obj.value;
                    });
                    return data;
                }
            },
            "pageLength": 15,
            "processing": true,
            "serverSide": true,
            "bDestroy": true,
            columns: [{
                    data: 'phone_number',
                    name: 'phone_number'
                },
                {
                    data: 'sms_text',
                    name: 'sms_text'
                },
                {
                    data: 'send_status',
                    name: 'send_status',
                },
                {
                    data: 'send_message',
                    name: 'send_message'
                },
                {
                    data: 'client_id',
                    name: 'client_id'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
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
        
        if (sessionStorage.client_id) {
            $('select[name=client_id]').val(sessionStorage.getItem("client_id"));
            sessionStorage.removeItem("client_id");
            otable.draw();
        }

        $('.search').click(function(e) {
            e.preventDefault();
            dataArray = $(".search-container input,select").serializeArray();
            var data = {};
            $(dataArray).each(function(index, obj) {
                data[obj.name] = obj.value;
            });
            otable.draw()
            console.log(data);

        })

        $('.reset').click(function(e) {
            e.preventDefault();
            $(this).closest('form').find("input[type=text],select").val("");
            otable.draw()
        })


    });
</script>
<script>
    $('.export').click(function(e) {
        e.preventDefault();
        dataArray = $(".search-container input,select").serializeArray();
        var data = {};
        $(dataArray).each(function(index, obj) {
            data[obj.name] = obj.value;
        });

        $.ajax({
            type: "POST",
            url: "/sms_history/export",
            data: data,

            success: function(response) {
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