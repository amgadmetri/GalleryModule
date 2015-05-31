<?php namespace App\Modules\Gallery;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model {

    /**
     * Spescify the storage table.
     * 
     * @var table
     */
    protected $table    = 'albums';

    /**
     * Specify the fields allowed for the mass assignment.
     * 
     * @var fillable
     */
    protected $fillable = ['user_id','album_name'];

    /**
     * Get the name that will be displayed in the 
     * menu link.
     * 
     * @return string
     */
    public function getLinkNameAttribute()
    {
        return $this->attributes['album_name'];
    }

    /**
     * Get the album galleries.
     * 
     * @return collection
     */
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

        /**
         * Remove the galleries related to 
         * the deleted album.
         */
        Albums::deleting(function($album)
        {
            $album->galleries()->detach();
        });
    }
}
