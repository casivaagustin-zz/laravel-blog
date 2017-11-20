<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostsTags;
use App\Section;
use App\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiPostController extends Controller
{
	public function __construct()
	{
		$this->middleware('jwt.auth');
	}
    public function index(Request $request) {
        $result = Post::with('section')->paginate(3);

        if ($request->get('page', 1) > $result->lastPage()) {
            return new JsonResponse(['error' => 'la pagina no existe'], 400);
        }
        return Post::with('section')->paginate(3);
    }

    public function create(Request $request) {
        $json = $request->json()->all();
        $validator = Validator::make($json, [
            'title' => 'numeric'
        ]);
        if ($validator->fails()) {
            return new JsonResponse($validator->errors()->all(), 401);
        }

        $post = new Post();
        $post->title = $json['title'];
        $post->body = $json['body'];

        $section = Section::where('section', $json['section'])->get()->first();
        $post->section_id = $section->id;
        $post->save();

        if (!empty($json['tags'])) {
            $tags = Tag::whereIn('tag', $json['tags'])->get()->keyBy(function ($item) {
                return strtolower($item->tag);
            });

            foreach ( $json['tags'] as $tag ) {
                if (!empty($tags[strtolower($tag)])) {
                    $postTag = new PostsTags();
                    $postTag->post_id = $post->id;
                    $postTag->tag_id = $tags[strtolower($tag)]->id;
                    $postTag->save();
                }
            }
        }

        return $post;
    }
}
