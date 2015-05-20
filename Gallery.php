<?php namespace App\Modules\Gallery;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {

    /**
     * Spescify the storage table.
     * 
     * @var table
     */
    protected $table    = 'gallery';

    /**
     * Specify the fields allowed for the mass assignment.
     * 
     * @var fillable
     */
    protected $fillable = ['user_id','file_name', 'path', 'caption', 'type'];

    /**
     * Return the path of the gallery based on
     * the gallery type.
     *
     * @param  string $value
     * @return string
     */
    public function getPathAttribute($value)
    {
        if ($this->attributes['type'] == 'photo')
        {
            return url("uploads/images/$value");
        }
        else
        {
            return url("https://www.youtube.com/embed/$value");
        }
    }

    /**
     * Return the path where the gallery
     * is stored.The path will be valid 
     * for photo type only.
     * 
     * @return string
     */
    public function getStoragePathAttribute()
    {
        return "uploads/images/" . $this->attributes['path'];
    }

    /**
     * Return the path of the video gallery type.
     * 
     * @return string
     */
    public function getVideoPathAttribute()
    {
        return $this->attributes['path'];
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
        return "uploads/images/" . substr($this->attributes['path'], 0, 8);
    }

    /**
     * Get the gallery albums.
     * 
     * @return collection
     */
    public function albums()
    {
        return $this->belongsToMany('App\Modules\Gallery\Albums',
                                    'album_galleries',
                                    'gallery_id',
                                    'album_id')->withTimestamps();
    }

    /**
     * Get the gallery thumbnails.
     * 
     * @return collection
     */
    public function thumbnails()
    {
        return $this->hasMany('App\Modules\Gallery\Thumbnail', 'photo_id');
    }

    public static function boot()
    {
        parent::boot();

        /**
         * Remove the thumbnails and albums
         * related to the deleted gallery ,
         * also delete the gallery and it's
         * thumbnails from the physical storage.
         */
        Gallery::deleting(function($gallery)
        {
            foreach ($gallery->thumbnails as $thumbnail) 
            {
              if (file_exists($thumbnail->storage_path)) unlink($thumbnail->storage_path);
                $thumbnail->delete();
            }

            if ($gallery->type =="photo") 
            {
                if (file_exists($gallery->storage_path)) unlink($gallery->storage_path);
            }
            
            $gallery->albums()->detach();
      });
    }
}
