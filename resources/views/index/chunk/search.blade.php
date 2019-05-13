<!-- widget grid -->
<section id="widget-grid" class="">
    <!-- row -->
    <div class="row">
        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false" data-widget-colorbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-collapsed="false" data-widget-sortable="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-search"></i> </span>
                    <h2>{{trans('lang.search')}}</h2>
                </header>
                <!-- widget div-->
                <div>
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->
                    <!-- widget content -->
                    <form id="search-form">
                        <div class="row smart-form search-container">
                            <section class="col col-lg-4">
                                <label for="client_id">{{trans('lang.clients')}}</label>
                                <label class="select">
                                    <select name="client_id">
                                        <option value=''>{{trans('lang.select_client')}}</option>
                                        @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select> <i></i> </label>
                            </section>
                            <section class="col col-lg-4">
                                <label for="status">{{trans('lang.send_status')}}</label>
                                <label class="select">
                                    <select name="status">
                                        <option value="">{{trans('lang.select_status')}}</option>
                                        @foreach($statuses as $key=> $value)
                                        <option value="{{$value}}">{{strtoupper($key)}}</option>
                                        @endforeach
                                    </select> <i></i> </label>
                            </section>
                            <section class="col col-lg-4">
                                <label for="sms_sender">{{trans('lang.sms_sender')}}</label>
                                <label class="input"> <i class="icon-prepend fa  fa-info-circle"></i>
                                    <input type="text" name="phone_sender" placeholder="{{trans('lang.sms_sender')}}">
                                </label>
                            </section>
                            <section class="col col-lg-4">
                                <label for="client_id">{{trans('lang.sent_startdate')}}</label>
                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="created_startdate" id="startdate" autocomplete="off" placeholder="Expected start date">
                                </label>
                            </section>
                            <section class="col col-lg-4">
                                <label for="client_id">{{trans('lang.sent_finishdate')}}</label>
                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="created_finishdate" id="finishdate" autocomplete="off" placeholder="Expected finish date">
                                </label>
                            </section>
                            <section class="col col-lg-4">
                                <label for="phone_number">{{trans('lang.phone_number')}}</label>
                                <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                    <input type="text" name="phone_number" placeholder="{{trans('lang.phone_number')}}">
                                </label>
                            </section>
                        </div>

                        <div class="row">
                            <div class="col-xs-7 col-sm-5 col-lg-8">

                            </div>
                            <div class="col-xs-5 col-sm-7 col-lg-4 padding-10">
                                <a href="#" class="btn btn-success pull-right search margin-right-10">
                                    <i class="fa fa-search"></i> {{trans('lang.search')}}
                                </a>
                                <a href="#" class="btn btn-danger pull-right reset margin-right-10">
                                    <i class="fa fa-refresh"></i> {{trans('lang.reset')}}
                                </a>
                                <a href="#" class="btn btn-danger pull-right export margin-right-10">
                                    <i class="fa fa-file-excel-o"></i> {{trans('lang.export')}}
                                </a>
                            </div>
                        </div>
                    </form>
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