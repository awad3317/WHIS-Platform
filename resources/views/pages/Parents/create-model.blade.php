<!-- المودال المحدث مع جميع الحقول -->
<div x-data="{ 
    
    parentForm: {
        name_ar: '',
        name_en: '',
        phone: '',
        email: '',
        national_id: '',
        relationship: 'father',
        job_title: '',
        workplace: '',
        mobile: '',
        gender: 'male'
    },
    isLoading: false,
    
    async addParent() {
        this.isLoading = true;
        
        try {
            const response = await fetch('{{ route("parents.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(this.parentForm)
            });

            const data = await response.json();

            if (data.success) {
                // إضافة ولي الأمر الجديد للـ select
                const parentSelect = document.getElementById('parent_id');
                const relationshipText = this.getRelationshipText(data.parent.relationship);
                const displayText = `${data.parent.name_ar} - ${data.parent.phone} (${relationshipText})`;
                const newOption = new Option(displayText, data.parent.id, false, false);
                parentSelect.appendChild(newOption);
                
                // تحديد ولي الأمر المضاف حديثاً
                parentSelect.value = data.parent.id;
                
                // إغلاق المودال وإعادة تعيين النموذج
                this.isParentModalOpen = false;
                this.resetForm();
                
                // إظهار رسالة نجاح
                alert('تم إضافة ولي الأمر بنجاح');
            } else {
                alert(data.message || 'حدث خطأ أثناء الإضافة');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('حدث خطأ في الاتصال بالخادم');
        } finally {
            this.isLoading = false;
        }
    },
    
    resetForm() {
        this.parentForm = {
            name_ar: '',
            name_en: '',
            phone: '',
            email: '',
            national_id: '',
            relationship: 'father',
            job_title: '',
            workplace: '',
            mobile: '',
            gender: 'male'
        };
    },
    
    updateRelationshipDisplay(relationship) {
        const relationshipDisplay = document.getElementById('relationship_display');
        if (relationshipDisplay && relationship) {
            
        }
    },
    
    getRelationshipText(relationship) {
        const relationships = {
            'father': 'أب',
            'mother': 'أم', 
            'guardian': 'وصي',
            'other': 'آخر'
        };
        
        return relationships[relationship] || '';
    }
}">
    
    <!-- المودال -->
    <div x-show="isParentModalOpen" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999"
        style="display: none;">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]" 
             @click="isParentModalOpen = false">
        </div>

        <div @click.outside="isParentModalOpen = false"
            class="relative w-full max-w-[800px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
            <form @submit.prevent="addParent()">
                @csrf
                <h4 class="mb-6 text-lg font-medium text-gray-800 dark:text-white/90">
                    إضافة ولي أمر جديد
                </h4>
                
                <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">
                    <!-- الاسم بالعربية -->
                    <div class="col-span-1">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            الاسم بالعربية *
                        </label>
                        <input type="text" 
                               placeholder="اسم ولي الأمر بالعربية" 
                               x-model="parentForm.name_ar" 
                               required
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- الاسم بالإنجليزية -->
                    <div class="col-span-1">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            الاسم بالإنجليزية *
                        </label>
                        <input type="text" 
                               placeholder="اسم ولي الأمر بالإنجليزية" 
                               x-model="parentForm.name_en" 
                               required
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- رقم الهاتف -->
                    <div class="col-span-1">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            رقم الهاتف *
                        </label>
                        <input type="tel" 
                               placeholder="05XXXXXXXX" 
                               x-model="parentForm.phone" 
                               required
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- البريد الإلكتروني -->
                    <div class="col-span-1">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            البريد الإلكتروني
                        </label>
                        <input type="email" 
                               placeholder="email@example.com" 
                               x-model="parentForm.email"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- رقم الهوية الوطنية -->
                    <div class="col-span-1">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            رقم الهوية الوطنية
                        </label>
                        <input type="text" 
                               placeholder="XXXXXXXXXXXXX" 
                               x-model="parentForm.national_id"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- صلة القرابة -->
                    <input type="hidden" x-model="parentForm.relationship value="father">

                    <!-- المسمى الوظيفي -->
                    <div class="col-span-1">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            المسمى الوظيفي
                        </label>
                        <input type="text" 
                               placeholder="المسمى الوظيفي" 
                               x-model="parentForm.job_title"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- مكان العمل -->
                    <div class="col-span-1">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            مكان العمل
                        </label>
                        <input type="text" 
                               placeholder="مكان العمل" 
                               x-model="parentForm.workplace"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- رقم الجوال -->
                    <div class="col-span-1">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            رقم الجوال
                        </label>
                        <input type="tel" 
                               placeholder="05XXXXXXXX" 
                               x-model="parentForm.mobile"
                               class="hover:border-brand-500 dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs focus:border-brand-500 focus:ring-1 focus:ring-brand-500 dark:border-gray-600 dark:text-white">
                    </div>

                    <!-- الجنس -->
                    <input type="hidden" x-model="parentForm.gender" value="male">
                </div>

                <div class="flex items-center justify-end w-full gap-3 mt-6">
                    <button @click="isParentModalOpen = false" type="button"
                        class="hover:border-brand-500 flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-3 text-sm font-medium text-gray-700 sm:w-auto">
                        إغلاق
                    </button>
                    <button type="submit" :disabled="isLoading"
                        class="flex justify-center hover:bg-brand-600 w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 disabled:bg-gray-400 disabled:cursor-not-allowed"
                        x-text="isLoading ? 'جاري الإضافة...' : 'إضافة ولي الأمر'">
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>