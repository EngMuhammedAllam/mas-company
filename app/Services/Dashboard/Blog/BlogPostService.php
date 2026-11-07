<?php

namespace App\Services\Dashboard\Blog;

use App\Models\Blog\BlogPost;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BlogPostService
{
    public function getAllPosts()
    {
        return BlogPost::with('category')->latest()->paginate(10);
    }

    public function createPost(array $data, ?UploadedFile $image = null): BlogPost
    {
        if ($image) {
            $data['image'] = $image->store('blog', 'public');
        }

        return BlogPost::create($data);
    }

    public function updatePost(BlogPost $post, array $data, ?UploadedFile $image = null): bool
    {
        if ($image) {
            // Optional: Delete old image if exists? Logic preservation says we just store new one.
            $data['image'] = $image->store('blog', 'public');
        }

        return $post->update($data);
    }

    public function deletePost(BlogPost $post): ?bool
    {
        // Optional: Delete image from storage? Logic preservation says just delete record.
        return $post->delete();
    }
}
