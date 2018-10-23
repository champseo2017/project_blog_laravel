<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Model\user\post;
use App\Model\user\tag;
use App\Model\user\category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        $posts = post::orderBy('created_at','DESC')->get();
        return view('admin.post.show')->with(compact('posts'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('posts.create')) {

            $tags = tag::all();
            $categories = category::all();
            return view('admin.post.post',compact('tags','categories'));

        }
        return redirect(route('admin.home'));
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $this->validate($request, [
            'body' => 'required'
        ]);

        $post = new post;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $str = strtolower($request->slug);
        $post->slug = preg_replace('/\s+/', '-', $str);
        $post->body = $request->body;
        $post->status = $request->has('status');
        $post->save();
         if ($request->hasFile('image')) {
        $imgName = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('user/imgpost'), $imgName);
        $post->image = $imgName;
        $post->save();
        }
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);
        return redirect(route('post.index'))->with('success','You have Add successfully.');
        

       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->can('posts.update')) {
        $post = post::with('tags','categories')->where('id',$id)->first();
        $tags = tag::all();
        $categories = category::all();
        return view('admin.post.edit',compact('post','tags','categories'));
        }
        return redirect(route('admin.home'));
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

         $this->validate($request, [
            'body' => 'required'
        ]);

        $post =post::find($id);
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $str = strtolower($request->slug);
        $post->slug = preg_replace('/\s+/', '-', $str);
        $post->body = $request->body;
        $post->status = $request->has('status');
        $post->save();
         if ($request->hasFile('image')) {
        $imgName = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('user/imgpost'), $imgName);
        $post->image = $imgName;
        $post->save();
        }
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);
        return redirect(route('post.index'))->with('success','You have Edit successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        post::where('id',$id)->delete();
        return redirect()->back();
    }
}
