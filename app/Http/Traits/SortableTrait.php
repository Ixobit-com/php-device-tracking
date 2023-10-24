<?php

namespace App\Http\Traits;

trait SortableTrait
{
    /**
     * Order by field with default 'id'.
     */
    public string $orderBy = 'id';

    /**
     * Order asc\desc, default 'asc'.
     */
    public bool $orderAsc = true;

    /**
     * Sort the data by the specified field.
     */
    public function sortBy(string $field): void
    {
        if ($this->orderBy === $field) {
            $this->orderAsc = ! $this->orderAsc;
        } else {
            $this->orderAsc = true;
        }

        $this->orderBy = $field;
    }

    /**
     * Get the sort icon for the specified field.
     */
    public function getSortIcon(string $field): string
    {
        if ($this->orderBy === $field) {
            if ($this->orderAsc) {
                return '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
            </svg>';
            } else {
                return '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
            </svg>';
            }
        }

        return '';
    }
}
