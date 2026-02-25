<?php

use Livewire\Attributes\Validate;
use App\Models\Tour;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public Property $property;

    #[Validate('required|date|after_or_equal:today')]
    public $date;

    #[Validate('required')]
    public $time;

    #[Validate('required|string|max:255')]
    public $name;

    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('required|string|max:20')]
    public $phone;

    public $message;
    public $success = false;

    public function mount(Property $property)
    {
        $this->property = $property;
        if (Auth::check()) {
            $this->name = Auth::user()->name;
            $this->email = Auth::user()->email;
        }
    }

    public function bookTour()
    {
        $this->validate();

        Tour::create([
            'property_id' => $this->property->id,
            'user_id' => Auth::id(),
            'guest_name' => Auth::check() ? null : $this->name,
            'guest_email' => Auth::check() ? null : $this->email,
            'guest_phone' => $this->phone,
            'preferred_date' => $this->date,
            'preferred_time' => $this->time,
            'message' => $this->message,
            'status' => 'pending',
        ]);

        $this->success = true;
        $this->reset(['date', 'time', 'message', 'name', 'email', 'phone']);
        
        if (Auth::check()) {
            $this->name = Auth::user()->name;
            $this->email = Auth::user()->email;
        }
    }
};
?>

<div class="bg-indigo-50 rounded-xl p-6 border border-indigo-100 shadow-sm mt-6">
    <div class="flex items-center mb-4">
        <div class="p-2 bg-indigo-600 rounded-lg text-white mr-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-900">Book a Viewing</h3>
    </div>

    @if($success)
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm transition-all duration-300">
            <p class="font-bold">Tour Requested!</p>
            <p>The agent will contact you shortly to confirm the appointment.</p>
            <button wire:click="$set('success', false)" class="mt-2 text-xs underline font-medium">Book another slot</button>
        </div>
    @else
        <form wire:submit.prevent="bookTour" class="space-y-4">
            <div class="grid grid-cols-2 gap-3">
                <div class="col-span-1">
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Date</label>
                    <input type="date" wire:model="date" min="{{ date('Y-m-d') }}"
                           class="w-full rounded-lg border-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-1">
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Time</label>
                    <select wire:model="time" class="w-full rounded-lg border-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Time</option>
                        <option value="morning">Morning (9AM - 12PM)</option>
                        <option value="afternoon">Afternoon (12PM - 4PM)</option>
                        <option value="evening">Evening (4PM - 6PM)</option>
                    </select>
                    @error('time') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Name</label>
                <input type="text" wire:model="name" placeholder="Your Name"
                       class="w-full rounded-lg border-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Email</label>
                    <input type="email" wire:model="email" placeholder="Email"
                           class="w-full rounded-lg border-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Phone</label>
                    <input type="tel" wire:model="phone" placeholder="Phone"
                           class="w-full rounded-lg border-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Message (Optional)</label>
                <textarea wire:model="message" rows="2" placeholder="Any specific requirements?"
                          class="w-full rounded-lg border-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            </div>

            <button type="submit" wire:loading.attr="disabled"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl transition duration-150 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <span wire:loading.remove>Schedule Tour</span>
                <span wire:loading>Scheduling...</span>
            </button>
        </form>
    @endif
</div>