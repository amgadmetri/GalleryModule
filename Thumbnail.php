<?php namespace App\Modules\Gallery;

use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model {

	/**
     * Spescify the storage table.
     * 
     * @var table
     */
	protected $table    = 'thumbnails';

	/**
     * Specify the fields allowed for the mass assignment.
     * 
     * @var fillable
     */
	protected $fillable = ['photo_id', 'thumb_name', 'path', 'width', 'height'];

	/**
     * Return the path of the thumbnail.
     *
     * @param  string $value
     * @return string
     */
	public function getPathAttribute($value)
	{
		return url("uploads/thumbnails/$value");
	}

	/**
     * Return the path where the thumbnail
     * is stored.
     * 
     * @return string
     */
	public function getStoragePathAttribute()
	{
		return "uploads/thumbnails/" . $this->attributes['path'];
	}

	/**
     * Return the name of the file from the full path.
     * 
     * @return string
     */
	public function getUploadedFileNameAttribute()
	{
		return substr($this->attributes['path'], 8);
	}

	/**
     * Return the path of the file directory from the full path.
     * 
     * @return string
     */
	public function getDirectoryAttribute()
	{
		return "uploads/thumbnails/" . substr($this->attributes['path'], 0, 8);
	}

	/**
     * Get the thumbnail gallery.
     * 
     * @return collection
     */
	public function gallery()
	{
		return $this->belongsTo('App\Modules\Gallery\Gallery');
	}

	public static function boot()
    {
        parent::boot();

        /**
         * Remove the deleted thumbnails 
         * from the physical storage.
         */
        Thumbnail::deleting(function($thumbnail)
        {
        	if (file_exists($thumbnail->storage_path)) unlink($thumbnail->storage_path);
        });
    }
}
