<?php
namespace App\Modules\Gallery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryFormRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
		'file_name' => 'required|max:150',
		'path'      => 'required|max:150|url',
		'caption'   => 'required|max:150',
		'type'      => 'required'
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
}