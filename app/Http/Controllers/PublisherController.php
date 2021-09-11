<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class PublisherController extends Controller
{
    /**
     * List of users
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::all();

        return view('publisher.index',compact('users'));
    }

    /**
     * list posts of this publisher
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {

        $this->authorize('view', $user);

        $posts = $user->posts;

        return view('publisher.show',compact('posts','user'));
    }

    /**
     * Block this publisher
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block(User $user)
    {
        $this->authorize('update', $user);

        $user->update([
            'status'    => 0
        ]);

        session()->flash('success', 'User is blocked successfully');

        return redirect()->route('publisher.index');
    }

    /**
     * Unblock this publisher
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblock(User $user)
    {
        $this->authorize('update', $user);

        $user->update([
            'status'    => 1
        ]);

        session()->flash('success', 'User is Unblocked successfully');

        return redirect()->route('publisher.index');
    }
}
