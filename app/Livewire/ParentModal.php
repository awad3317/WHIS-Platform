<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ParentModel;

class ParentModal extends Component
{
    public $isParentModalOpen = false;
    public $isLoading = false;
    public $type = 'father';

    public $parentForm = [
        'name_ar'     => '',
        'name_en'     => '',
        'phone'       => '',
        'email'       => '',
        'national_id' => '',
        'relationship' => 'father',
        'job_title'   => '',
        'workplace'   => '',
        'mobile'      => '',
        'gender'      => 'male',
        'is_active'   => false
    ];

    protected $rules = [
        'parentForm.name_ar'      => 'required|string|max:255',
        'parentForm.name_en'      => 'required|string|max:255',
        'parentForm.phone'        => 'required|string|max:20',
        'parentForm.email'        => 'nullable|email',
        'parentForm.national_id'  => 'nullable|string|max:20',
        'parentForm.relationship' => 'required|string',
        'parentForm.job_title'    => 'nullable|string|max:255',
        'parentForm.workplace'    => 'nullable|string|max:255',
        'parentForm.mobile'       => 'nullable|string|max:20',
        'parentForm.gender'       => 'required|string',
    ];

    protected $messages = [
        'parentForm.name_ar.required'      => 'الاسم بالعربية مطلوب',
        'parentForm.name_en.required'      => 'الاسم بالإنجليزية مطلوب',
        'parentForm.phone.required'        => 'رقم الهاتف مطلوب',
        'parentForm.email.email'            => 'البريد الإلكتروني غير صحيح',
        'parentForm.national_id.max'        => 'رقم الهوية طويل جداً',
        'parentForm.relationship.required' => 'صلة القرابة مطلوبة',
        'parentForm.job_title.string'       => 'المسمى الوظيفي غير صحيح',
        'parentForm.workplace.string'       => 'جهة العمل غير صحيحة',
        'parentForm.mobile.max'             => 'رقم الجوال غير صحيح',
        'parentForm.gender.required'        => 'الجنس مطلوب',
    ];

    public function mount($type = 'father')
    {
        $this->type = $type;

        if ($type === 'mother') {
            $this->parentForm['gender'] = 'female';
            $this->parentForm['relationship'] = 'mother';
        } else {
            $this->parentForm['gender'] = 'male';
            $this->parentForm['relationship'] = 'father';
        }
    }

    public function addParent()
    {
        $this->validate();

        $this->isLoading = true;

        $parent = ParentModel::create($this->parentForm);

        $this->dispatch('parentAdded', [
            'type'   => $this->type,
            'parent' => $parent,
        ]);

        $this->resetForm();

        $this->isParentModalOpen = false;
        $this->isLoading = false;

        session()->flash('success', 'تمت إضافة ولي الأمر بنجاح');
    }

    public function resetForm()
    {
        $this->parentForm = [
            'name_ar'     => '',
            'name_en'     => '',
            'phone'       => '',
            'email'       => '',
            'national_id' => '',
            'relationship' => $this->type === 'mother' ? 'mother' : 'father',
            'job_title'   => '',
            'workplace'   => '',
            'mobile'      => '',
            'gender'      => $this->type === 'mother' ? 'female' : 'male',
        ];
    }

    public function render()
    {
        return view('livewire.parent-modal');
    }
}
