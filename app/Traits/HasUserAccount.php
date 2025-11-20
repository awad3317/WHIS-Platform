<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait HasUserAccount
{
    public static function bootHasUserAccount()
    {

        static::creating(function ($model) {
            $model->createUserAccount();
        });

        static::updating(function ($model) {
            $model->updateUserAccount();
        });

        static::deleting(function ($model) {
            if (method_exists($model, 'trashed') && !$model->isForceDeleting()) {
                $model->toggleAccountStatus(false);
            } else {
                $model->deleteUserAccount();
            }
        });
        static::restoring(function ($model) {
            $model->toggleAccountStatus(true);
        });
    }

    
    protected function createUserAccount()
    {
        if ($this->user_id) {
            return;
        }

        $userData = $this->createUserData();
        
        if (!$userData) {
            return;
        }

        $user = User::create($userData);
        $this->user_id = $user->id;
    }

    protected function updateUserAccount()
    {
        if (!$this->user_id) {
            return;
        }

        $user = User::find($this->user_id);
        if ($user) {
            $userData = $this->updateUserData();
            if ($userData) {
                $user->update($userData);
            }
        }
    }

    protected function deleteUserAccount()
    {
        if ($this->user_id) {
            User::where('id', $this->user_id)->delete();
        }
    }

    abstract protected function createUserData(): array;
    abstract protected function updateUserData(): array;

    public function getAccountInfo(): ?array
    {
        if (!$this->user_id) {
            return null;
        }

        $user = $this->user;
        return [
            'phone' => $user->phone,
            'user_type' => $user->user_type,
            'is_active' => $user->is_active,
            'created_at' => $user->created_at
        ];
    }

    public function toggleAccountStatus(bool $status): void
    {
        if ($this->user_id) {
            User::where('id', $this->user_id)->update(['is_active' => $status]);
        }
    }
}