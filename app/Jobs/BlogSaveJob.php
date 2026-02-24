<?php

namespace App\Jobs;

use App\Models\Blog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class BlogSaveJob implements ShouldQueue
{
    use Queueable;

    protected $title;
    protected $description;
    /**
     * Create a new job instance.
     */
    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Blog::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);
    }
}
