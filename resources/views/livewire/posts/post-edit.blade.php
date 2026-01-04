<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-950 via-indigo-950 to-slate-900 px-4 py-0 mt-0">

    <div class="w-full max-w-xl bg-slate-900/80 backdrop-blur-xl rounded-[32px] shadow-[0_40px_120px_rgba(0,0,0,0.75)] p-10  border border-slate-800 mt-0">

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
                {{ __('Edit Post') }}
            </flux:heading>

            <flux:subheading size="lg" class="mt-2 text-slate-400">
                {{ __('Update your post') }}
            </flux:subheading>

            <div class="mt-6">
                <flux:separator variant="subtle" class="bg-indigo-700/40" />
            </div>
        </div>
        
        

        <!-- Form -->
        <form  wire:submit="updatePost"
            class="flex flex-col gap-8"
        >
            @csrf

            <!-- Title -->
            <div class="space-y-2">
                <flux:input
                    wire:model="form.title"
                    label="Title"
                    type="text"
                    placeholder="Enter post title"
                    class="text-slate-100 rounded-xl"
                />
            </div>

           <!-- Images -->
<div class="space-y-2">
    <flux:input
        wire:model="form.images"
        label="Images"
        type="file"
        multiple
        class="text-slate-200 rounded-xl
               file:bg-indigo-600 file:text-white
               file:rounded-lg file:px-4 file:py-2 file:border-0"
    />
</div>

<!-- Preview -->
@if (!empty($form->images))
    <div class="grid grid-cols-3 gap-3 mt-4">
        @foreach ($form->images as $image)
            <img src="{{ $image->temporaryUrl() }}"
                 class="h-24 w-full object-cover rounded-xl border border-slate-700">
        @endforeach
    </div>
@endif

            <!-- Content -->
            <div class="space-y-2">
                <flux:textarea
                    wire:model="form.content"
                    label="Content"
                    rows="5"
                    placeholder="Write your content here..."
                    class="text-slate-100 rounded-xl"
                />
            </div>

            <!-- Submit -->
            <flux:button 
                variant="primary" 
                type="submit" 
                class="w-full mt-4 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 transition-all duration-300 rounded-2xl py-4 text-primary font-semibold text-lg shadow-xl"
            >
                🚀 Update
            </flux:button>
        </form>

    </div>

</div>

