<div class=" col-md-12 bars">
    @foreach ($data as $key => $value)
        @php $value = round($value) @endphp
        <div class="bar">
            <div class="title">
                <span>{{ __('exchanges.rates.' . $key) }}</span>
            </div>
            <div class="rate-holder">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ ($value * 2) * 10 }}%"
                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="label">
                    <span>
                        {{ $value }}
                    </span>
                </div>
            </div>
        </div>
    @endforeach
    {{-- <div class="bar">
        <div class="title">
            <span>راحتی استفاده </span>
        </div>
        <div class="rate-holder">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <div class="label">
                <span>
                    4.8
                </span>
            </div>
        </div>
    </div>
    <div class="bar">
        <div class="title">
            <span>راحتی استفاده </span>
        </div>
        <div class="rate-holder">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <div class="label">
                <span>
                    4.8
                </span>
            </div>
        </div>
    </div> --}}
</div>
