<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;
use App\User;

class Url extends Model
{
    use SoftDeletes;

    // protected $fillable = [
    //     'user_id', 'original_url', 'short_url'
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function shortenUrl($originalUrl)
    {
        $link = self::create(['original_url' => $originalUrl]);
        $link->short_url = Hashids::encode($link->id);
        $link->save();

        return $link;
    }

    public static function getOriginalUrl($shortUrl)
    {
        $linkId = Hashids::decode($shortUrl);
        $link = self::find($linkId);

        return $link ? $link->original_url : null;
    }
}
