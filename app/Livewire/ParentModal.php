<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ParentModel;


class ParentModal extends Component
{
    public $isParentModalOpen = false;
    public $isLoading = false;
    public $type = 'father'; 

    public $parentForm = []; 

    protected function rules()
    {
        return [
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
            'parentForm.is_active'    => 'boolean',
        ];
    }


    public function mount($type = 'father')
    {
        $this->type = $type;
        $this->resetForm(); 
    }

    public function addParent()
    {
        $this->validate();
        $this->isLoading = true;

        $this->parentForm['relationship'] = ($this->type === 'mother' ? 'mother' : 'father');
        $this->parentForm['gender'] = ($this->type === 'mother' ? 'female' : 'male');
        $this->parentForm['is_active'] = true; 

        $parent = ParentModel::create($this->parentForm);

        $this->dispatch('parentAdded', [
            'type'   => $this->type,
            'parent' => $parent,
        ]);

        $this->resetForm();
        $this->isParentModalOpen = false;
        $this->isLoading = false;

        $this->dispatch('swal:modal', [
            'icon'  => 'success',
            'title' => 'تمت العملية بنجاح!',
            'text'  => 'تم إضافة ولي الأمر بنجاح بنوع: ' . ($this->type == 'mother' ? 'أم' : 'أب'),
        ]);
    }

    public function resetForm()
    {
        $this->parentForm = [
            'name_ar'     => '',
            'name_en'     => '',
            'phone'       => '',
            'email'       => '',
            'national_id' => '',
            'relationship' => ($this->type === 'mother' ? 'mother' : 'father'),
            'gender'       => ($this->type === 'mother' ? 'female' : 'male'),
            'job_title'    => '',
            'workplace'    => '',
            'mobile'       => '',
            'is_active'    => true,
        ];
    }

    public function render()
    {
        return view('livewire.parent-modal');
    }
}