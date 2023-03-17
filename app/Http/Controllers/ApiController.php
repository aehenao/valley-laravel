<?php
/**
 * Por motivo de pruebas, se crea un solo controlador para manejar el pequeño CRUD.
 * En este controlador se manejaran los Posts y Comments.
 * @author Andres S. Henao <andrestivenhenao@gmail.com>
 */

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

     /**
      * Posts
      */
      public function createPost(PostRequest $request)
      {
        $validateData = $request->validated();
        try {
            $new_post = Post::create($validateData);

            return response()->json([
                'status' => 201,
                'data'   => $new_post
            ], 201);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'error'  => $ex->getMessage() 
            ], 500);
        }
      }

      /**
       * Listo los Posts
       */
      public function getPosts()
      {
        return response()->json([
            'status' => 200,
            'data' => Post::with('comments')->get()
        ]);
      }

      /** Fin Posts */

      /** Comentarios */
      public function createComment(CommentRequest $request)
      {
        $validateData = $request->validated();
        try {
            $new_comment = Comment::create($validateData);

            return response()->json([
                'status' => 201,
                'data'   => $new_comment
            ], 201);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 500,
                'error'  => $ex->getMessage() 
            ], 500);
        }
      }

      /**
       * Obtengo la información del usuario, incluyendo sus Publicaciones y Comentarios
       */
      public function getUserData($user_id)
      {
        return response()->json([
            'status' => 200,
            'data' => User::with(['posts', 'comments'])->find($user_id)
        ]);
      }

      // Elimino
      public function deleteComment(Request $request)
      {
        $validateData = Validator::make($request->all(), [
            'id' => 'required',
        ])->validate();
        $comment = Comment::find($validateData['id']);

        if($comment){
            $comment->delete();
            return response()->json([
                'status' => 200,
                'msg' => 'Se ha eliminado el comentario'
            ], 200);
        }

        return response()->json([
            'status' => 202,
            'msg' => 'No se encontró el comentario'
        ], 202);
      }

      /** Fin Comentarios */
}
