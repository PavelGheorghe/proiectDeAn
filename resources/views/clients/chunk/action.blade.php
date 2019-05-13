<style>
    .smart-form .checkbox input+i:after {
        margin-left: 1px;
        margin-top: 1px;
    }

    .smart-form .checkbox i {
        width: 20px;
        height: 20px;
        margin-top: -3px;
    }
</style>
@include('layouts.buttons.edit_modal')
@include('layouts.buttons.remove')
<a class="btn btn-primary btn-xs view_history" data-id="{{$id}}" rel="tooltip" data-title="{{ trans('lang.view_history') }}" href="/{{ $resource }}/{{ $id }}/edit" style="width:25px;">
    <i class="fa fa-history"></i>
</a>

<div class="smart-form " 
    style=" width:25px; float:left" rel="tooltip" data-title="{{ trans('lang.change_status') }}">
    <label class="checkbox">
        <input  href="/change_status/{{ $id }}"  class="change_status" type="checkbox" @if($status) checked @endif name="checkbox">
        <i></i>
    </label>
</div>