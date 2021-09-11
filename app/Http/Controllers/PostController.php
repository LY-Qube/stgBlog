<?php

namespace App\Http\Controllers;

use App\Events\PostStore;
use App\Http\Requests\Post\PostCreateRequest;
use App\Http\Requests\Post\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * list post with paginate and filter
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get filter vars
        $order = $this->orderPost();
        $published = $this->publishedPost();

        // get posts from database
        $query = Post::with('category')
            ->orderBy('created_at', $order)
            ->where('published', $published);
        // check if is admin for get trashed post
        if (auth()->user()->is_admin) {
            $query->withTrashed();
        }

        $posts = $query->paginate(15)->withQueryString();

        return view('post.index', compact('posts'))->with([
            'published' => $published,
            'order' => $order
        ]);

    }

    /**
     * define order in query string
     *
     * @return string
     */
    private function orderPost(): string
    {
        return (request()->order === "desc") ? "desc" : "asc";
    }

    /**
     * define published in query string
     *
     * @return bool
     */
    private function publishedPost(): bool
    {
        return (request()->published) ? true : false;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        $categories = Category::orderby('name')->get();

        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $this->authorize('create', Post::class);

        // store image
        $image = $this->storeImage($request);

        // add attributes to request
        $request->request->add([
            'image' => $image,
            'slug' => Str::of($request->title)->slug('-'),
            'category_id' => $request->category
        ]);

        // store post
        $post = auth()->user()->posts()->create(
            $request->all([
                'title', 'slug', 'body', 'image', 'category_id', 'published'
            ])
        );

        // get Admin
        $user = Role::where('role', 'admin')->first()->users[0];

        // notify admin with event
        event(new PostStore($user, $post));

        // success message
        session()->flash('success', 'New blog created successfully');

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param string $post_id
     * @return View
     * @internal param string $post
     */
    public function show(string $post_id): View
    {
        // get post
        $post = Post::withTrashed()->where('id', $post_id)->first();
        if ($post) {
            // check if soft deleted
            if ($post->deleted_at) {
                // check if im admin
                if (!auth()->user()->is_admin) {
                    return abort(404);
                }
            }
            $posts = $post->creator->posts()->where('id', '!=', $post->id)->limit(6)->orderby('created_at')->get();

            return view('post.show', compact('post', 'posts'));
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::orderby('name')->get();

        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        // update image
        $image = $this->updateImage($request, $post);
        if ($image) {
            $post->image = $image;
        }

        // update attributes
        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = Str::of($request->title)->slug('-');
        $post->category_id = $request->category;
        $post->published = $request->published;
        $post->update();

        // success flash
        session()->flash('success', 'Your post is updated successfully');

        return redirect()->route('post.index');
    }

    /**
     * remove image if exist and store new one if exist
     *
     * @param PostRequest $request
     * @param Post $post
     * @return null|string
     */
    private function updateImage(PostRequest $request, Post $post): ?string
    {
        if ($request->file('image_')) {
            $this->removeImage($post);
            return $this->storeImage($request);
        }
        return null;
    }

    private function removeImage(Post $post)
    {
        if (file_exists("storage/{$post->image}")) {
            unlink("storage/{$post->image}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // force delete if im admin
        if (auth()->user()->is_admin) {

            $this->forceDelete($post);

        }

        // soft delete if is my post
        else {
            $post->delete();
        }

        session()->flash('success', 'Post is deleted successfully');

        return redirect()->route('post.index');
    }

    /**
     * Force Delete
     *
     * @param Post $post
     * @return void
     */
    public function forceDelete(Post $post)
    {
        // unlink image
        $this->removeImage($post);

        // force delete post
        $post->forceDelete();

    }

    /**
     * @param string $post_id
     * @return RedirectResponse
     */
    public function restore(string $post_id): RedirectResponse
    {
        $this->authorize('restore', Post::class);

        Post::withTrashed()
            ->where('id', $post_id)
            ->restore();

        session()->flash('success', 'post is restored');

        return redirect()->route('post.show', compact('post'));
    }

    /**
     * store image
     *
     * @param PostRequest $request
     * @return string storage path of image
     */
    private function storeImage(PostRequest $request): string
    {
        // storage image
        $image = $request->file('image_')->storePublicly('public');

        // refactor image path
        return str_replace('public/', '', $image);
    }

    /**
     * Approve Post
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function approve(Post $post): RedirectResponse
    {
        $post->update([
            'approve_at'    => now()
        ]);

        session()->flash('success', 'post is approve it');

        return redirect()->route('post.show', compact('post'));
    }



}
