<div>
    <!-- زر فتح المودال -->
    <button  wire:click="$set('isParentModalOpen', true)"
        class="px-4 py-2 text-white rounded-lg bg-brand-500">
        إضافة ولي أمر
    </button>

    <!-- المودال -->
    @if($isParentModalOpen)
    <div class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999">

        <div class="fixed inset-0 bg-gray-400/50 backdrop-blur-[32px]"
             wire:click="$set('isParentModalOpen', false)"></div>

        <div class="relative w-full max-w-[800px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
            <form wire:submit.prevent="addParent">
                <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
                    إضافة ولي أمر جديد
                </h4>

                <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

                    <div>
                        <label class="mb-1.5 block text-sm">الاسم بالعربية *</label>
                        <input type="text" wire:model.lazy="parentForm.name_ar"
                               class="w-full h-11 border rounded-lg px-4">
                        @error('parentForm.name_ar') <span class="text-error-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm">الاسم بالإنجليزية *</label>
                        <input type="text" wire:model.lazy="parentForm.name_en"
                               class="w-full h-11 border rounded-lg px-4">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm">رقم الهاتف *</label>
                        <input type="tel" wire:model.lazy="parentForm.phone"
                               class="w-full h-11 border rounded-lg px-4">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm">البريد الإلكتروني</label>
                        <input type="email" wire:model.lazy="parentForm.email"
                               class="w-full h-11 border rounded-lg px-4">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm">رقم الهوية</label>
                        <input type="text" wire:model.lazy="parentForm.national_id"
                               class="w-full h-11 border rounded-lg px-4">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm">المسمى الوظيفي</label>
                        <input type="text" wire:model.lazy="parentForm.job_title"
                               class="w-full h-11 border rounded-lg px-4">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm">مكان العمل</label>
                        <input type="text" wire:model.lazy="parentForm.workplace"
                               class="w-full h-11 border rounded-lg px-4">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm">رقم الجوال</label>
                        <input type="tel" wire:model.lazy="parentForm.mobile"
                               class="w-full h-11 border rounded-lg px-4">
                    </div>

                </div>

                <!-- قيم ثابتة -->
                <input type="hidden" wire:model="parentForm.relationship">
                <input type="hidden" wire:model="parentForm.gender">

                <div class="flex items-center justify-end w-full gap-3 mt-6">

                    <button type="button"
                        wire:click="$set('isParentModalOpen', false)"
                        class="border px-4 py-2 rounded-lg">
                        إغلاق
                    </button>

                    <button type="submit"
                        wire:loading.attr="disabled"
                        class="px-4 py-2 text-white rounded-lg bg-brand-500">
                        <span wire:loading.remove>إضافة ولي الأمر</span>
                        <span wire:loading>جاري الإضافة...</span>
                    </button>

                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- رسالة نجاح -->
    @if (session()->has('success'))
        <div class="mt-4 text-success-600">
            {{ session('success') }}
        </div>
    @endif
</div>
