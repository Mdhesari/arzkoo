<div class="input-group">

    <input type="text" class="form-control" placeholder="{{$placeholder}}" aria-label="{{$name}}"
        aria-describedby="{{$name}}" id="{{$name}}" name="{{$name}}">
    {{-- <input type="text" style="display: none" class="form-control" placeholder="" aria-label="{{$name}}"
    aria-describedby="{{$name}}"> --}}
    <div class="input-group-prepend">
        <span class="input-group-text cursor-pointer"><i class="fa fa-calendar"></i></span>
    </div>
</div>

@push('add_scripts')

<script type="text/javascript">
    //     $('#{{$name}}').MdPersianDateTimePicker({
// targetTextSelector: '{{"#input$name"}}',
// enableTimePicker: true,
// targetDateSelector: '{{"#input1$name"}}',
// modalMode: true,
// dateFormat: 'yyyy-MM-dd HH:mm',
// textFormat: 'yyyy-MM-dd HH:mm',
// });

jQuery(function($) {

    $('#{{$name}}').persianDatepicker({
        format: 'YYYY-M-D H:m',
        timePicker: {
            enabled: true,
            second: {
                enabled: false
            }
        },
        persianDigit: false
    });

})
</script>
@endpush