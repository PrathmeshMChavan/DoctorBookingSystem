<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadProfilePhoto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $image;
    protected $destinationPath;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $image
     * @param $destinationPath
     */
    public function __construct($user, $image, $destinationPath)
    {
        $this->user = $user;
        $this->image = $image;
        $this->destinationPath = $destinationPath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $photoPath = $this->image->store($this->destinationPath, 'public');

            $this->user->update([
                'profile_photo' => $photoPath,
            ]);
        } catch (\Exception $e) {
            Log::error('Error uploading profile photo: ' . $e->getMessage());
        }
    }
}
