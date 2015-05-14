<?php namespace App\Modules\Gallery;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model {

    protected $table    = 'albums';
    protected $fillable = ['user_id','album_name'];

    public function galleries()
    {
        return $this->belongsToMany('App\Modules\Gallery\Gallery',
            'album_galleries',
            'album_id',
            'gallery_id')->withTimestamps();
    }
     
    public static function boot()
    {
        parent::boot();

        Albums::deleting(function($album)
        {
            $album->galleries()->detach();
        });
    }
}
