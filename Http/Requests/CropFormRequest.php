<?php
namespace App\Modules\Gallery\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CropFormRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
		'x'          => 'required|Integer',
		'y'          => 'required|Integer',
		'width'      => 'required|Integer',
		'height'     => 'required|Integer',
		'thumb_name' => 'required|unique:thumbnails|max:150'
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