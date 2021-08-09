<form wire:submit.prevent="submit" class="footer__box__newsletter__form">
    <input type="email" placeholder="ایمیل خود را وارد کنید" livewire:model="email">
    <button class="clickable" type="submit">عضویت</button>
    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
</form>

@push('add_scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = () => {
            Livewire.on('newsletterSubmitted', () => {
                Swal.fire({
                    title: 'ایمیل شما ثبت شد.',
                    text: 'درخواست شما برای ثبت اشتراک در خبرنامه ارزکو با موفقیت ثبت شد لطفا از طریق ایمیل خود آدرس وارد شده را تایید فرمایید.',
                    icon: 'success',
                    confirmButtonText: 'حله'
                })
            })
        }
    </script>
@endpush
