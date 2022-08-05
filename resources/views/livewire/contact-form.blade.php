<div>
    <div style="display: none" x-data='{show:false}' x-show="show"
        x-init="@this.on('created', () =>{ show = true; setTimeout(() => { show = false },2000)})"
        class="alert alert-success">
        {{ session('success') }}
</div>
<form class="ud-contact-form" wire:submit.prevent="contactFormSubmit">
    <div class="ud-form-group">
        <label for="fullName">Full Name*</label>
        <input required type="text" wire:model="name" placeholder="Enter Name" class="@error('message') border-danger @enderror"/>
        @error('name') <span class="invalid-feedback">{{ $message }}</span>@enderror
    </div>
    <div class="ud-form-group">
        <label for="email">Email*</label>
        <input required type="email" wire:model="email" placeholder="Enter Email" class="@error('message') border-danger @enderror"/>
        @error('email') <span class="invalid-feedback">{{ $message }}</span>@enderror
    </div>
    <div class="ud-form-group">
        <label for="phone">Phone*</label>
        <input required type="text" wire:model="phone" placeholder="Enter Phone Number" class="@error('message') border-danger @enderror"/>
        @error('phone') <span class="invalid-feedback">{{ $message }}</span>@enderror
    </div>
    <div class="ud-form-group">
        <label for="message">Message*</label>
        <textarea required wire:model="message" rows="5" placeholder="type your message here" class="@error('message') border-danger @enderror"></textarea>
        @error('message') <span class="invalid-feedback">{{ $message }}</span>@enderror
    </div>
    <div class="ud-form-group mb-0">
        <button type="submit" class="ud-main-btn">
            Send Message
        </button>
    </div>
</form>
</div>
