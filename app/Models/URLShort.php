<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class URLShort extends Model
{
   protected $table = 'url_short';
   protected $primaryKey = 'id';
   protected $fillable = ['url', 'short_url', 'redirect_count', 'user_id'];

   public static function generateShortUrl()
   {
      $shortUrl = substr(md5(microtime()), rand(0, 26), 6);
      if (self::where('short_url', $shortUrl)->exists()) {
         return $this->generateShortUrl();
      }
      return $shortUrl;
   }
}
