<div>
    <div style="display: none" x-data='{show:false}' x-show="show" x-init="@this.on('created', () => {
        show = true;
        setTimeout(() => { show = false }, 2000)
    })" class="alert alert-success">
        {{ session('success') }}
    </div>
    <form class="ud-contact-form" wire:submit.prevent="contactFormSubmit">
        <div class="ud-form-group">
            <label for="fullName">{{ __('Full Name') }}*</label>
            <input required type="text" wire:model="name" placeholder="{{ __('Full Name') }}"
                class="@error('message') border-danger @enderror" />
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="ud-form-group">
            <label for="email">{{ __('Email') }}*</label>
            <input required type="email" wire:model="email" placeholder="{{ __('Email') }}"
                class="@error('message') border-danger @enderror" />
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="ud-form-group">
            <label for="phone">{{ __('Phone') }}*</label>
            <input required type="text" wire:model="phone" placeholder="+123456789"
                class="@error('message') border-danger @enderror" />
            @error('phone')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="ud-form-group">
            <label for="message">{{ __('Message') }}*</label>
            <textarea required wire:model="message" rows="5" placeholder="{{ __('Message') }}"
                class="@error('message') border-danger @enderror"></textarea>
            @error('message')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="ud-form-group mb-0">
            <button type="submit" class="ud-main-btn">
                {{ __('Send Message') }}
            </button>
        </div>
    </form>
</div>
