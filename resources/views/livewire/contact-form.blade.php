<form class="row your-informations" wire:submit.prevent="submit">
    <div class="col-md-6 col-xs-12">
        <div class="your-information">
            <label for="name">نام شما</label>
            <div class="input-holder">
                <i class="fas fa-user"></i>
                <input type="text" wire:model="name" id="name">
            </div>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="your-information">
            <label for="email">ایمیل شما</label>
            <div class="input-holder">
                <i class="fas fa-envelope-open"></i>
                <input type="email" wire:model="email" id="email">
            </div>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="your-information">
            <label for="mobile">شماره موبایل شما</label>
            <div class="input-holder">
                <i class="fas fa-mobile-alt"></i>
                <input type="number" wire:model="mobile" id="mobile">
            </div>
            @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="your-information">
            <label for="message">پیام شما</label>
            <div class="input-holder height-255">
                <textarea type="text" wire:model="message" id="message" cols="30" rows="10"></textarea>
            </div>
            @error('message') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="button-holder">
        <button class="btn btn-primery clickable">ارسال پیام</button>
    </div>
</form>

@push('add_scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            Livewire.on('contactSubmitted', () => {
                Swal.fire({
                    title: 'درخواست تماس ثبت شد',
                    text: 'درخواست تماس شما ثبت شد و به زودی با شما تماس خواهیم گرفت.',
                    icon: 'success',
                    confirmButtonText: 'حله'
                })
            })
        })
    </script>
@endpush
