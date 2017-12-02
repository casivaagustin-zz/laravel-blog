<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class ApiTagController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth')->except(['index']);
    }
    public function index(Request $request)
    {
        $result = Tag::paginate(5);

        if ($request->get('page', 1) > $result->lastPage()) {
            return new JsonResponse(['error' => 'la pagina no existe'], 400);
        }

        return $result;
    }
}
