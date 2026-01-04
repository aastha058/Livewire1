<div style="max-width:1100px;margin:30px auto;font-family:Inter,system-ui;background:#ffffff;border-radius:18px;box-shadow:0 20px 45px rgba(0,0,0,0.08);overflow:hidden;">

    <!-- Page Heading -->
    <div style="padding:24px 26px;border-bottom:1px solid #e5e7eb;">
        <flux:heading size="xl" level="1">Posts</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage your posts</flux:subheading>
        <flux:separator variant="subtle" />

        <!-- Add Post Button -->
        <div style="margin-top:16px;">
            <a href="{{ route('posts.create') }}" wire:navigate
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
                + Add Post
</a>
        </div>
    </div>

    <!-- Table Header -->
    <div style="padding:20px 26px;background:#f8fafc;font-size:20px;font-weight:600;color:#1e293b;">
        Posts Management
    </div>
   @if (session()->has('message'))
    <div style="background:#dcfce7;color:#166534;padding:12px;margin-bottom:12px;border-radius:8px;">
        {{ session('message') }}
    </div>
@endif
    <!-- Table -->
    <table style="width:100%;border-collapse:collapse;">
        <thead style="background:#f1f5f9;">
            <tr>
                <th style="padding:14px 20px;font-size:12px;color:#64748b;text-transform:uppercase;">ID</th>
                <th style="padding:14px 20px;font-size:12px;color:#64748b;text-transform:uppercase;">Post title</th>
                <th style="padding:14px 20px;font-size:12px;color:#64748b;text-transform:uppercase;">content </th>
                <th style="padding:14px 20px;font-size:12px;color:#64748b;text-transform:uppercase;">Image</th>
                <th style="padding:14px 20px;font-size:12px;color:#64748b;text-transform:uppercase;">Actions</th>
            </tr>
        </thead>

        <tbody>
            <!-- Row 1 -->
             @forelse($posts as $post)
            <tr style="border-bottom:1px solid #e5e7eb;">
                <td style="padding:16px 20px;">
                    <span style="background:#eef2ff;color:#4338ca;padding:6px 12px;border-radius:999px;font-size:12px;font-weight:600;">
                        {{ $post->id }}
                    </span>
                </td>
                <td style="padding:16px 20px;font-weight:500;color:#1e293b;">{{ $post->title }}</td>
                <td style="padding:16px 20px;color:#475569;">{{ $post->content }}</td>
                <td style="padding:16px 20px;">
    @if ($post->image)
        <img
            src="{{ asset('storage/' . $post->image) }}"
            alt="Post Image"
            style="
                width:70px;
                height:70px;
                object-fit:cover;
                border-radius:12px;
                box-shadow:0 4px 12px rgba(0,0,0,0.15);
                border:1px solid #e5e7eb;
            "
        >
    @else
        <span style="font-size:12px;color:#94a3b8;">No Image</span>
    @endif
</td>

                <td style="padding:16px 20px;">
                    <div style="display:flex;gap:8px;">
                        <button style="padding:7px 14px;border-radius:10px;font-size:13px;border:none;background:#e0e7ff;color:#3730a3;cursor:pointer;">View</button>
                        <a href="{{ route('posts.edit', $post->id) }}" style="padding:7px 14px;border-radius:10px;font-size:13px;border:none;background:#dcfce7;color:#166534;cursor:pointer;">Edit</a>
                        <button
    onclick="if(confirm('Are you sure you want to delete Post #{{ $post->id }}?')) { @this.deletePost({{ $post->id }}); }"
    style="padding:7px 14px;border-radius:10px;font-size:13px;border:none;background:#fee2e2;color:#991b1b;cursor:pointer;"
>
    Delete
</button>


                    </div>
                </td>
            </tr>
            @empty
            <h2> no Posts</h2>

           @endforelse
        </tbody>
    </table>
</div>
   <!-- JS confirmation -->
    <script>
    Livewire.on('confirmDelete', id => {
        if (confirm('Are you sure you want to delete this post?')) {
            Livewire.emit('deleteConfirmed', id);
        }
    });
</script>



