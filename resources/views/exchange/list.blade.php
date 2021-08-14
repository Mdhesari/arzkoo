@extends('layouts.app')

@section('content')
    <x-searchly :isBuy="$isBuy" :showMetaData="false" className="box-bottom-header py-5" :crypto="$crypto"></x-searchly>
    <section class="filters-main py-4">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h1 class="title-section py-2">
                        عبارت مورد نظر رو بر اساس فیلترها پیدا کنید
                    </h1>
                </div>
            </div> --}}
            <livewire:exchange-list :crypto="$crypto" :isBuy="$isBuy" />
        </div>
    </section>
@endsection

@push('add_scripts')
    <script>
        window.onload = () => {
            const filters = Array.from(document.querySelectorAll('.slider-filter'))

            filters.map((filter) => {
                filter.addEventListener('click', (e) => {
                    // alert('hi')
                })
            })
        }
    </script>
@endpush
