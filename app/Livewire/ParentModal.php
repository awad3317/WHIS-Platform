<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ParentModel;
use App\Models\Student;

class ParentModal extends Component
{
    public $isParentModalOpen = false;
    public $isLoading = false;
public $type = 'father'; // father | mother

public function mount($type = 'father')
{
    $this->type = $type;

    if ($this->type === 'mother') {
        $this->parentForm['gender'] = 'female';
        $this->parentForm['relationship'] = 'mother';
    } else {
        $this->parentForm['gender'] = 'male';
        $this->parentForm['relationship'] = 'father';
    }
}

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
    ];

    protected $rules = [
        'parentForm.name_ar' => 'required|string|max:255',
        'parentForm.name_en' => 'required|string|max:255',
        'parentForm.phone'   => 'required|string|max:20',
        'parentForm.email'   => 'nullable|email',
        'parentForm.national_id' => 'nullable|string|max:20',
        'parentForm.relationship' => 'required|string',
        'parentForm.job_title' => 'nullable|string|max:255',
        'parentForm.workplace' => 'nullable|string|max:255',
        'parentForm.mobile' => 'nullable|string|max:20',
        'parentForm.gender' => 'required|string',
    ];

 public function addParent()
{
    $this->validate();

    $this->isLoading = true;

    $parent = ParentModel::create($this->parentForm);

    // نرسل نوع الأب / الأم + البيانات
    $this->dispatch('parentAdded', [
        'type'   => $this->type,
        'parent' => $parent
    ]);

    $this->resetForm();

    $this->isParentModalOpen = false;
    $this->isLoading = false;
}

    public function resetForm()
    {
        $this->parentForm = [
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
        ];
    }


    public function render()
    {
        return view('livewire.parent-modal');
    }
}