<?php

namespace App\Http\Traits;

trait ComponentHelperTrait
{
    /**
     * Indicates whether the modal is currently visible.
     */
    public bool $showModal = false;

    /**
     * Indicates whether the password field should be shown as plain text.
     */
    public bool $showPassword = false;

    /**
     * Open the modal window.
     */
    public function openModal(): void
    {
        $this->showModal = true;
    }

    /**
     * Close the modal window.
     *
     * @param  bool  $reset Whether to reset the component's properties.
     */
    public function closeModal(bool $reset = true): void
    {
        if ($reset) {
            $this->reset();
        }

        $this->resetValidation();
        $this->showModal = false;
    }

    /**
     * Toggle the visibility of the password field.
     */
    public function togglePasswordVisibility(): void
    {
        $this->showPassword = ! $this->showPassword;
    }
}
