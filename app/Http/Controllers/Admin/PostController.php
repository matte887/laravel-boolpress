<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Mail\NewPostEmailToAdmin;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(9);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validazione dati in arrivo
        $request->validate($this->getValidationRules());

        // Salvataggio dati in una variabile
        $data = $request->all();

        // Salvataggio immagine
        // Questo va fatto solo se effettivamente c'è l'immagine nel data
        if (isset($data['image'])) {
            //  Questa funzione salva il file caricato nell'input con name "image" nella cartella indicata. Inoltre, rinomina il file.
            $img_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $img_path;
        }

        // Creazione post
        $post = new Post();
        $post->fill($data);
        // $post->slug = Str::slug($post->title, '-');
        // $post->slug = $this->generatePostSlug($post->title);
        $post->slug = Post::generatePostSlug($post->title);
        $post->save();

        // Questo lo facciamo dopo save, perché solo dopo save avremo l'id del post.
        // In questo specifico caso potremmo usare anche "attach". Mentre in edit va usato questo (altrimenti bisognerebbe fare "attach" e "detach")
        // La facciamo solo se vengono selezionati tag
        if(isset($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }

        // Invio mail di notifica all'amministratore
        Mail::to('superadmin@boolpress.it')->send(new NewPostEmailToAdmin($post));

        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this_post = Post::findOrFail($id);
        $post_category = $this_post->category; // -> con questa sintassi andiamo a prendere la funzione "category" presente nel model "Post"
        // Se volessimo prelevare tutti i post relativi ad una categoria, basterebbe fare
        // $categoryPosts = $post_category->posts;
        $post_tags = $this_post->tags;
        return view('admin.posts.show', compact('this_post', 'post_category', 'post_tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this_post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('this_post', 'categories', 'tags'));
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
        $request->validate($this->getValidationRules());

        $data = $request->all();

        $post = Post::findOrFail($id);

        // Serve il post per questo, quindi va messa dopo averlo prelevato.
        if (isset($data['image'])) {
            if ($post->cover) {
                Storage::delete($post->cover);
            }
            $img_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $img_path;
        }

        // Questa non si può fare perché c'è lo slug che va rigenerato in base al nuovo titolo
        // $post->update($data);
        $post->fill($data);
        $post->slug = Post::generatePostSlug($post->title);
        $post->save();

        if(isset($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->sync([]);
        }
        return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_to_destroy = Post::findOrFail($id);
        // Questo serve ad eliminare i dati relativi a questo id anche nella tabella ponte (altrimenti potrebbe bloccarsi l'app)
        $post_to_destroy->tags()->sync([]);

        if ($post_to_destroy->cover) {
            Storage::delete($post_to_destroy->cover);
        }

        $post_to_destroy->delete();
        return redirect()->route('admin.posts.index');
    }

    private function getValidationRules() {
        return [
            'title' => 'required',
            // Questo controlla che sia un immagine. Max controlla le dimensioni massime (in Kb)
            'image' => 'image|max:512',
            'category_id' => 'nullable|exists:categories,id',
            'content' => 'required',
            'tags' => 'nullable|exists:tags,id'
        ];
    }

    // private function generatePostSlug($title) {
    //     $basic_slug = Str::slug($title, '-');
    //     $slug = $basic_slug;
    //     $counter = 1;
    //     $search_post = Post::where('slug', $slug)->first();
    //     while ($search_post) {
    //         $slug = $basic_slug . '-' . $counter;
    //         $search_post = Post::where('slug', '=', $slug)->first();
    //         $counter++;
    //     }

    //     return $slug;
    // }
}
