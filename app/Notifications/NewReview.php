<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReview extends Notification
{
    use Queueable;

    protected $review;

    /**
     * Create a new notification instance.
     */
    public function __construct($review)
    {
        $this->review = $review;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'review_id' => $this->review->id,
            'reviewer_name' => $this->review->reviewer->name,
            'rating' => $this->review->rating,
            'comment' => \Illuminate\Support\Str::limit($this->review->comment, 50),
            'message' => 'You received a new ' . $this->review->rating . '-star review from ' . $this->review->reviewer->name,
            'link' => '#'
        ];
    }
}
