<div>
    <section class="mx-auto max-w-md rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-black">دخول للنظام</h1>

        <form wire:submit="authenticate" class="mt-6 flex flex-col gap-4">
            <label class="flex flex-col gap-2">
                <span class="text-sm font-bold">البريد الإلكتروني</span>
                <input type="email" wire:model="email" required class="rounded-md border border-zinc-300 px-3 py-2 text-left focus:border-teal-700 focus:outline-none" dir="ltr">
                @error('email') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
            </label>

            <label class="flex flex-col gap-2">
                <span class="text-sm font-bold">كلمة المرور</span>
                <input type="password" wire:model="password" required class="rounded-md border border-zinc-300 px-3 py-2 text-left focus:border-teal-700 focus:outline-none" dir="ltr">
                @error('password') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
            </label>

            <label class="flex items-center gap-2 text-sm text-zinc-700">
                <input type="checkbox" wire:model="remember" class="h-4 w-4 rounded border-zinc-300 text-teal-700">
                تذكرني
            </label>

            <button class="rounded-md bg-teal-700 px-4 py-3 font-bold text-white hover:bg-teal-800" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="authenticate">دخول</span>
                <span wire:loading wire:target="authenticate">جارٍ الدخول...</span>
            </button>
        </form>
    </section>
</div>
