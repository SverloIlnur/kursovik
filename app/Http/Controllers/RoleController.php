<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(auth()->user()->role->name);
        if(auth()->user()->role->name==='Администратор'){
            $users = User::all();
            $posts = Post::all();
            $tags = Tag::all();
            
            $data = [
                'users'=>$users,
                'posts'=>$posts,
                'tags'=>$tags
            ];
            return view('admin',['data'=>$data]);
        }
        else
        {
            return redirect('dashboard');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function search_user(Request $request)
    {
        $users = User::where('name', 'like', "%".$request->get('question')."%")->get();
        $posts = Post::all();
        $tags = Tag::all();
        $data = [
            'users'=>$users,
            'posts'=>$posts,
            'tags'=>$tags
        ];
        return view('admin',['data'=>$data]);
    }

    public function search_post(Request $request)
    {
        $posts = Post::where('name', 'like', "%".$request->get('question')."%")->get();
        $users = User::all();
        $tags = Tag::all();
        $data = [
            'users'=>$users,
            'posts'=>$posts,
            'tags'=>$tags
        ];
        return view('admin',['data'=>$data]);
    }

    public function search_tag(Request $request)
    {
        $tags = Tag::where('tag', 'like', "%".$request->get('question')."%")->get();
        $users = User::all();
        $posts = Post::all();
        $data = [
            'users'=>$users,
            'posts'=>$posts,
            'tags'=>$tags
        ];
        return view('admin',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */

    public function user_destroy($id)
    {
        $user = User::find($id);
        if (auth()->user()->role->name==='Администратор'||auth()->user()->id==$id)
        {
            User::where('id',$id)->delete(); 
        }
        return redirect('admin');
    }

    public function post_destroy($id)
    {
        $post = Post::find($id);
        if (auth()->user()->role->name==='Администратор')
        {
            Post::where('id',$id)->delete(); 
        }
        return redirect('admin');
    }

    public function tag_destroy($id)
    {
        $post = Post::find($id);
        if (auth()->user()->role->name==='Администратор')
        {
            Tag::where('id',$id)->delete(); 
        }
        return redirect('admin');
    }
}
