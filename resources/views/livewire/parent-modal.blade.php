<div>
    <!-- زر فتح المودال -->
  <button
    type="button"
    wire:click="$set('isParentModalOpen', true)"
    class="px-4 py-2 text-white rounded-lg bg-brand-500">
    إضافة ولي أمر
</button>


    <!-- المودال -->
    @if($isParentModalOpen)
    <div class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999">

        <div class="fixed inset-0 bg-gray-400/50 backdrop-blur-[32px]"
             wire:click="$set('isParentModalOpen', false)"></div>

        <div class="relative w-full max-w-[600px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
            <form wire:submit.prevent="addParent">
                <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
                    إضافة ولي أمر جديد
                </h4>

                <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">الاسم بالعربية *</label>
                        <input type="text" wire:model.lazy="parentForm.name_ar"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                        @error('parentForm.name_ar') <span class="text-error-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">الاسم بالإنجليزية *</label>
                        <input type="text" wire:model.lazy="parentForm.name_en"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                        @error('parentForm.name_en') <span class="text-error-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">رقم الهاتف *</label>
                        <input type="tel" placeholder="05XXXXXXXX" wire:model.lazy="parentForm.phone"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">البريد الإلكتروني</label>
                        <input type="email" type="email" placeholder="email@example.com" wire:model.lazy="parentForm.email"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">رقم الهوية</label>
                        <input type="text" placeholder="XXXXXXXXXXXXX" wire:model.lazy="parentForm.national_id"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">المسمى الوظيفي</label>
                        <input type="text" placeholder="المسمى الوظيفي" wire:model.lazy="parentForm.job_title"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">مكان العمل</label>
                        <input type="text" placeholder="مكان العمل" wire:model.lazy="parentForm.workplace"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">رقم الجوال</label>
                        <input type="tel" placeholder="05XXXXXXXX" wire:model.lazy="parentForm.mobile"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">    
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
