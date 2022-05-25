<div>
    <form wire:submit.prevent="submit">
        <textarea wire:model="body" name="body" id="body" cols="30" rows="5"></textarea>
        @error('body') <span class="error">{{ $message }}</span> @enderror
        <div class="btns-holder">
            <button class="btn btn-default-outline" type="submit"> ثبت نظر</button>
        </div>
    </form>
</div>

@push('add_scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function () {
            Livewire.on('unauthorized', () => {
                Swal.fire({
                    title: 'نیاز به احراز هویت دارید',
                    text: 'برای ثبت کامنت نیاز به احراز هویت دارید.',
                    icon: 'error',
                    confirmButtonText: 'حله'
                })
            })

            Livewire.on('new-comment', () => {
                Swal.fire({
                    title: 'کامنت شما با موفقیت ثبت شد',
                    icon: 'success',
                    confirmButtonText: 'اوکی'
                })
            })
        })
    </script>
@endpush
