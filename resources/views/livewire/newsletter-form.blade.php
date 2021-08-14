<form wire:submit.prevent="submit" class="footer__box__newsletter__form" style="position: relative">
    <input type="email" placeholder="ایمیل خود را وارد کنید" wire:model="email">
    <button class="clickable" type="submit">عضویت</button>
    @error('email') <span class="bg-danger text-white"
            style="display:inline-block;position: absolute; top:-2rem;right:0;">{{ $message }}</span>
    @enderror
</form>

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
