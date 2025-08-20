<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $download_url
 * @property string $description
 * @property string $category
 * @property string $version
 * @property string $size
 * @property string $icon_url
 * @property float $rating
 * @property int $download_count
 * @property bool $is_free
 */
class App extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'version',
        'size',
        'download_url',
        'icon_url',
        'rating',
        'download_count',
        'is_free'
    ];

    protected $casts = [
        'rating' => 'float',
        'download_count' => 'integer',
        'is_free' => 'boolean'
    ];
}
