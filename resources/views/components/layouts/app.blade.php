<x-layouts.app.sidebar :title="$title ?? null">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
