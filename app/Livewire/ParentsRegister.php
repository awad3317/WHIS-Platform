<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ParentModel;
use Livewire\Attributes\On;

class ParentsRegister extends Component
{
    public $fatherQuery = '';
    public $motherQuery = '';

    public $fatherResults = [];
    public $motherResults = [];

    public $fatherId = null;
    public $motherId = null;

    // بيانات الأب
    public $father_name_ar, $father_name_en, $father_phone, $father_mobile,
        $father_email, $father_national_id, $father_job_title,
        $father_workplace, $father_gender;

    // بيانات الأم
    public $mother_name_ar, $mother_name_en, $mother_phone, $mother_mobile,
        $mother_email, $mother_national_id, $mother_job_title,
        $mother_workplace, $mother_gender;
    #[On('parentAdded')]
    public function handleParentAdded($data)
    {
        if ($data['type'] === 'father') {

            $this->fatherId            = $data['parent']['id'];
            $this->fatherQuery          = $data['parent']['name_ar'];

            $this->father_name_ar       = $data['parent']['name_ar'];
            $this->father_name_en       = $data['parent']['name_en'];
            $this->father_phone         = $data['parent']['phone'];
            $this->father_mobile        = $data['parent']['mobile'];
            $this->father_email         = $data['parent']['email'];
            $this->father_national_id   = $data['parent']['national_id'];
            $this->father_job_title     = $data['parent']['job_title'];
            $this->father_workplace      = $data['parent']['workplace'];
            $this->father_gender         = $data['parent']['gender'];
        }

        if ($data['type'] === 'mother') {

            $this->motherId             = $data['parent']['id'];
            $this->motherQuery           = $data['parent']['name_ar'];

            $this->mother_name_ar        = $data['parent']['name_ar'];
            $this->mother_name_en        = $data['parent']['name_en'];
            $this->mother_phone          = $data['parent']['phone'];
            $this->mother_mobile         = $data['parent']['mobile'];
            $this->mother_email          = $data['parent']['email'];
            $this->mother_national_id    = $data['parent']['national_id'];
            $this->mother_job_title      = $data['parent']['job_title'];
            $this->mother_workplace      = $data['parent']['workplace'];
            $this->mother_gender         = $data['parent']['gender'];
        }
    }

    public function updatedFatherQuery()
    {
        if (strlen($this->fatherQuery) < 2) {
            $this->fatherResults = [];
            return;
        }

        $this->fatherResults = ParentModel::active()
            ->where(function ($q) {
                $q->where('name_ar', 'like', "%{$this->fatherQuery}%")
                    ->orWhere('name_en', 'like', "%{$this->fatherQuery}%")
                    ->orWhere('phone', 'like', "%{$this->fatherQuery}%")
                    ->orWhere('national_id', 'like', "%{$this->fatherQuery}%");
            })
            ->where('gender', 'male')
            ->limit(10)
            ->get();
    }

    public function updatedMotherQuery()
    {
        if (strlen($this->motherQuery) < 2) {
            $this->motherResults = [];
            return;
        }

        $this->motherResults = ParentModel::active()
            ->where(function ($q) {
                $q->where('name_ar', 'like', "%{$this->motherQuery}%")
                    ->orWhere('name_en', 'like', "%{$this->motherQuery}%")
                    ->orWhere('phone', 'like', "%{$this->motherQuery}%")
                    ->orWhere('national_id', 'like', "%{$this->motherQuery}%");
            })
            ->where('gender', 'female')
            ->limit(10)
            ->get();
    }

    public function selectFather($id)
    {
        $father = ParentModel::findOrFail($id);

        $this->fatherId            = $father->id;
        $this->fatherQuery          = $father->name_ar;

        $this->father_name_ar       = $father->name_ar;
        $this->father_name_en       = $father->name_en;
        $this->father_phone         = $father->phone;
        $this->father_mobile        = $father->mobile;
        $this->father_email         = $father->email;
        $this->father_national_id   = $father->national_id;
        $this->father_job_title     = $father->job_title;
        $this->father_workplace      = $father->workplace;
        $this->father_gender         = $father->gender;

        $this->fatherResults = [];
    }

    public function selectMother($id)
    {
        $mother = ParentModel::findOrFail($id);

        $this->motherId             = $mother->id;
        $this->motherQuery           = $mother->name_ar;

        $this->mother_name_ar        = $mother->name_ar;
        $this->mother_name_en        = $mother->name_en;
        $this->mother_phone          = $mother->phone;
        $this->mother_mobile         = $mother->mobile;
        $this->mother_email          = $mother->email;
        $this->mother_national_id    = $mother->national_id;
        $this->mother_job_title      = $mother->job_title;
        $this->mother_workplace      = $mother->workplace;
        $this->mother_gender         = $mother->gender;

        $this->motherResults = [];
    }

    public function render()
    {
        return view('livewire.parents-register');
    }
}