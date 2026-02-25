<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Url;

class PropertyFilters extends Component
{
    #[Url(history: true)]
    public $location = '';

    #[Url(history: true)]
    public $type = '';

    #[Url(history: true)]
    public $minPrice = '';

    #[Url(history: true)]
    public $maxPrice = '';

    #[Url(history: true)]
    public $bedrooms = '';

    #[Url(history: true)]
    public $amenities = [];

    public function mount()
    {
        // Initialize state from request if not already set by #[Url]
        $this->location = request('location', $this->location);
        $this->type = request('type', $this->type);
        $this->minPrice = request('minPrice', $this->minPrice);
        $this->maxPrice = request('maxPrice', $this->maxPrice);
        $this->bedrooms = request('bedrooms', $this->bedrooms);
        $this->amenities = request('amenities', []);
    }

    public function applyFilters()
    {
        $params = [
            'location' => $this->location,
            'type' => $this->type,
            'minPrice' => $this->minPrice,
            'maxPrice' => $this->maxPrice,
            'bedrooms' => $this->bedrooms,
            'amenities' => $this->amenities,
        ];

        return redirect()->route('properties.index', array_filter($params));
    }

    public function resetFilters()
    {
        $this->reset(['location', 'type', 'minPrice', 'maxPrice', 'bedrooms', 'amenities']);
        return redirect()->route('properties.index');
    }

    public function render()
    {
        return view('livewire.property-filters');
    }
}
