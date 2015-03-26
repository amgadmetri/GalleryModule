<?php namespace App\Modules\Gallery;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {

    protected $table    = 'gallery';
    protected $fillable = ['user_id','file_name', 'path', 'caption', 'type'];

    //attributes//
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

    public function getStoragePathAttribute()
    {
        return public_path() . "/uploads/images/" . $this->attributes['path'];
    }

    public function getVideoPathAttribute()
    {
        return $this->attributes['path'];
    }

    public function getUploadedFileNameAttribute()
    {
        return substr($this->attributes['path'], 8);
    }

    public function getDirectoryAttribute()
    {
        return public_path() . "/uploads/images/" . substr($this->attributes['path'], 0, 8);
    }

    //relations//
    public function albums()
    {
        return $this->belongsToMany('App\Modules\Gallery\Albums',
            'album_galleries',
            'gallery_id',
            'album_id')->withTimestamps();
    }

    public function thumbnails()
    {
        return $this->hasMany('App\Modules\Gallery\Thumbnail', 'photo_id');
    }

    public static function boot()
    {
        parent::boot();

        Gallery::deleting(function($gallery)
        {
            foreach ($gallery->thumbnails as $thumbnail) 
            {
              if (file_exists($thumbnail->storage_path)) unlink($thumbnail->storage_path);
              $thumbnail->delete();
          }

          $gallery->albums()->detach();
      });
    }
}
