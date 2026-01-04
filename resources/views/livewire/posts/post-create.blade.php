<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-950 via-indigo-950 to-slate-900 px-4">

    <div class="w-full max-w-xl bg-slate-900/80 backdrop-blur-xl rounded-[32px]
        shadow-[0_40px_120px_rgba(0,0,0,0.75)]
        p-10 border border-slate-800">


        <!-- back page -->
        <div style="margin-top:16px;">
            <a href="{{ route('posts.index') }}" wire:navigate
                style="
                    padding:10px 18px;
                    background:linear-gradient(135deg,#6366f1,#4f46e5);
                    color:white;
                    border:none;
                    border-radius:12px;
                    font-size:14px;
                    font-weight:600;
                    cursor:pointer;
                    box-shadow:0 8px 20px rgba(99,102,241,0.35);
                "
            >
                Back
</a>
        </div>
        <!-- Header -->
        <div class="mb-10 text-center">
            <flux:heading size="xl" level="1" class="text-indigo-300 tracking-wide">
                {{ __('Create Post') }}
            </flux:heading>

            <flux:subheading size="lg" class="mt-2 text-slate-400">
                {{ __('Publish something amazing') }}
            </flux:subheading>

            <div class="mt-6">
                <flux:separator variant="subtle" class="bg-indigo-700/40" />
            </div>
        </div>

        <!-- Form -->
        <form wire:submit="savePost" class="flex flex-col gap-8">
            @csrf

            <!-- Title -->
            <div class="space-y-2">
                <flux:input
                    wire:model.defer="form.title"
                    label="Title"
                    type="text"
                    placeholder="Enter post title"
                    class="text-slate-100 rounded-xl"
                />
                @error('form.title')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image -->
            <div class="space-y-3">
                <flux:input
                    wire:model="form.image"
                    label="Image"
                    type="file"
                    class="text-slate-200 rounded-xl
                        file:bg-indigo-600 file:text-white
                        file:rounded-lg file:px-4 file:py-2 file:border-0"
                />

                <!-- Image Preview -->
                @if ($form->image)
                    <div class="mt-4">
                        <img
    src="{{ $form->image->temporaryUrl() }}"
    class="rounded-xl w-full max-w-full max-h-64 object-cover shadow-lg border border-slate-700"
>
                    </div>
                @endif

                @error('form.image')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Content -->
            <div class="space-y-2">
                <flux:textarea
                    wire:model.defer="form.content"
                    label="Content"
                    rows="5"
                    placeholder="Write your content here..."
                    class="text-slate-100 rounded-xl"
                />
                @error('form.content')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit -->
            <flux:button
                variant="primary"
                type="submit"
                class="w-full mt-4 bg-gradient-to-r from-indigo-600 to-violet-600
                    hover:from-indigo-500 hover:to-violet-500
                    transition-all duration-300 rounded-2xl py-4
                    font-semibold text-lg shadow-xl"
            >
                🚀 Create Post
            </flux:button>
        </form>

    </div>
</div>
@if (session()->has('success'))
<div x-data="{showMassage: true}" x-show="{showMassage}" id="toast-success" class="flex items-center w-full max-w-sm p-4 text-body bg-neutral-primary-soft rounded-base shadow-xs border border-default" role="alert">
    <div class="inline-flex items-center justify-center shrink-0 w-7 h-7 text-fg-success bg-success-soft rounded">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/></svg>
        <span class="sr-only">Check icon</span>
    </div>
    <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
    <button type="button" class="ms-auto flex items-center justify-center text-body hover:text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded text-sm h-8 w-8 focus:outline-none" data-dismiss-target="#toast-success" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
    </button>
</div>

@endif