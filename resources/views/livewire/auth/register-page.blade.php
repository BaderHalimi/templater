<div>
    <section class="mx-auto max-w-md rounded-md border border-zinc-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-black">تسجيل حساب جديد</h1>
        <p class="mt-2 text-sm leading-6 text-zinc-600">بعد التسجيل ستنتقل مباشرة لإنشاء أول دعوة.</p>

        <form wire:submit="register" class="mt-6 flex flex-col gap-4">
            <label class="flex flex-col gap-2">
                <span class="text-sm font-bold">الاسم</span>
                <input wire:model="name" required class="rounded-md border border-zinc-300 px-3 py-2 focus:border-teal-700 focus:outline-none">
                @error('name') <span class="text-sm text-red-700">{{ $message }}</span> @enderror
            </label>

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

            <label class="flex flex-col gap-2">
                <span class="text-sm font-bold">تأكيد كلمة المرور</span>
                <input type="password" wire:model="passwordConfirmation" required class="rounded-md border border-zinc-300 px-3 py-2 text-left focus:border-teal-700 focus:outline-none" dir="ltr">
            </label>

            <button class="rounded-md bg-teal-700 px-4 py-3 font-bold text-white hover:bg-teal-800" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="register">تسجيل</span>
                <span wire:loading wire:target="register">جارٍ إنشاء الحساب...</span>
            </button>
        </form>
    </section>
</div>
