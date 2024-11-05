<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;

class CreateThumbnail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imagePath;
    /**
     * Create a new job instance.
     */
    public function __construct($imagePath)
    {
        //
        $this->imagePath = $imagePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        try {
            $img = ImageManager::imagick()->read(storage_path('app/public/' . $this->imagePath));
            $img->resize(150, 150);
            $img->save(storage_path('app/public/thumbnails/' . basename($this->imagePath)));
        } catch (\Exception $e) {
            dd($e->getMessage(), $img);
        }
    }
}
