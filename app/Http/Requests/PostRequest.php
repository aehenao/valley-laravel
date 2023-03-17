<?php
/**
 * Request personalizado para validar la información enviada del front y validarla
 * antes que llegue al controlador
 * @author Andres S. Henao <andrestivenhenao@gmail.com>
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required|max:250',
            'description' => 'required|max:400',
            'user_id'     => 'required'
        ];
    }
}