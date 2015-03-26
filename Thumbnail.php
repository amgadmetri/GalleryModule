<?php namespace App\Modules\Gallery;

use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model {

	protected $table    = 'thumbnails';
	protected $fillable = ['photo_id', 'thumb_name', 'path', 'width', 'height'];

	public function getPathAttribute($value)
	{
		return url("uploads/thumbnails/$value");
	}

	public function getStoragePathAttribute()
	{
		return public_path() . "/uploads/thumbnails/" . $this->attributes['path'];
	}

	public function getUploadedFileNameAttribute()
	{
		return substr($this->attributes['path'], 8);
	}

	public function getDirectoryAttribute()
	{
		return public_path() . "/uploads/thumbnails/" . substr($this->attributes['path'], 0, 8);
	}

	public function gallery()
	{
		return $this->belongsTo('App\Modules\Gallery\Gallery');
	}
}
