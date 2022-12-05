<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Rating;
use App\Models\Comment;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(PostRequest $request)
    {
        $create = $request->validated();
        $create['author_id'] = auth()->user()->id;
        $post = Post::create($create);

        $tags = explode(" ", $request->get('tags'));
        foreach ($tags as $tag) {
            $attach = Tag::where('tag',$tag)->first();

            if (empty($attach)) {
                $attach = Tag::create(['tag' => $tag]);
            }

            $post->tags()->attach($attach);

        }
        
        return view('post');
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

    public function search(Request $request)
    {
        if(empty($request->get('question')))
        {
            return redirect('/');
        }
        else
        {
            $posts = Post::where('name', 'like', "%".$request->get('question')."%")->get(); 
            $posts->tags= Tag::all();   
            foreach ($posts as $post)
            {
                //Подсчёт рейтинга
                try {
                    $post['rating']=(Rating::where('post_id',$post->id)->sum('rating'))/(Rating::where('post_id',$post->id)->count('rating'));
                
                } catch (\Throwable $th) {
                    $post['rating']=0;
                } 
                
                $masstags= $post->tags;
                $tags=[];
                foreach ($masstags as $tag) {
                    array_push($tags, $tag->tag);
                }
                $post['tags'] = $tags;
            }
            return view('dashboard',['posts'=>$posts]);
        }
    }

    public function search_tag($tag)
    {
        $tag = Tag::where('tag', $tag)->get()->first();
        $posts = $tag->posts;
        //найти все посты что имеют нужный $tag
        $posts->tags= Tag::all(); 

        //------------------

        foreach ($posts as $post)
        {
            //Подсчёт рейтинга
            try {
                $post['rating']=(Rating::where('post_id',$post->id)->sum('rating'))/(Rating::where('post_id',$post->id)->count('rating'));
                
            } catch (\Throwable $th) {
                $post['rating']=0;
            } 
                
            $masstags= $post->tags;
            $tags=[];
            foreach ($masstags as $tag) {
                array_push($tags, $tag->tag);
            }
            $post['tags'] = $tags;
            
        }
        return view('dashboard',['posts'=>$posts]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $input = explode(" ", $post['input_variables']);
        $post['input_variables']=$input;
        //Подсчёт рейтинга
        try {
            $post['rating']=(Rating::where('post_id',$post->id)->sum('rating'))/(Rating::where('post_id',$post->id)->count('rating'));
        } catch (\Throwable $th) {
            $post['rating']=0;
        }
        
        $masstags= $post->tags;
        $tags=[];
        foreach ($masstags as $tag) {
            array_push($tags, $tag->tag);
        }
        $post['tags'] = $tags;

        $post['comments']= $post->comments;

        return view('show', compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if (auth()->user()->id===$post->author_id||auth()->user()->role->name==='Администратор')
        {
            $masstags= $post->tags;
            $tags='';
            foreach ($masstags as $tag) {
                $tags=$tags." ".$tag->tag;
            }
            $post['tags'] = $tags;
            return view('edit-post',compact('post'));
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    $post=Post::where('id',$id)->first();

    $post->name=$request->get('name');
    $post->description=$request->get('description');
    $post->view_formula=$request->get('view_formula');
    $post->formula=$request->get('formula');
    $post->input_variables=$request->get('input_variables');
    $post->output_variables=$request->get('output_variables');
    $post->save(); 

    $tags = explode(" ", $request->get('tags'));

    $updatedTags = array();

    foreach ($tags as $tag) {
        $attach = Tag::where('tag',$tag)->first();

        if (empty($attach)) {
            $attach = Tag::create(['tag' => $tag]);
        }

        array_push($updatedTags, $attach->id);
    }

    $post->tags()->sync($updatedTags);

    return redirect()->route('dashboard');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (auth()->user()->id===$post->author_id||auth()->user()->role->name==='Администратор')
        {
            Post::where('id',$id)->delete(); 
        }
        return redirect('/');
    }

    public function rating(Request $request, $post)
    {
        $rating = Rating::where('user_id', auth()->user()->id)->where('post_id', $post)->first();

        if (empty($rating)) {
            $rating = [
                'post_id'=>$post,
                'user_id'=>auth()->user()->id,
                'rating'=>$request->get('rating')
            ];
            Rating::create($rating);
        }
        else {
            $rating->rating = $request->get('rating');
            $rating->save();
        }   

        return redirect('post/'.$post);
    }

    public function comment(Request $request, $post)
    {
        $commentary = [
            'post_id'=>$post,
            'user_id'=>auth()->user()->id,
            'comment'=>$request->get('comment')
        ];
        Comment::create($commentary);

        return redirect('post/'.$post);
    }

    public function destroy_comment($post,$id)
    {
        $comment = Comment::find($id);
        
        if (auth()->user()->id===$comment->user_id||auth()->user()->role->name==='Администратор')
        {
            Comment::where('id',$id)->delete(); 
        }
        return redirect('post/'.$post);
    }

    public function welcome()
    {
        $posts = Post::all();

        return view('welcome',['posts'=>$posts]);
    }
}