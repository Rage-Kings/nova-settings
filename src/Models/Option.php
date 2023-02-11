<?php


namespace RageKings\NovaSettings\Models;

use RageKings\NovaSettings\Database\Factories\Models\OptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Option
 * @package Astreya\Settings\Models
 * @property string $key
 * @property mixed|null $value
 * @property string $panel
 * @property string $section
 * @property string $type
 * @property string $description
 * @property string $title
 * @property int $order
 * @property array $properties
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Option extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = ['key', 'value', 'panel', 'section', 'description', 'type', 'title', 'order', 'properties'];

    protected $casts = ['properties' => 'array'];

    protected static function newFactory(): OptionFactory
    {
        return OptionFactory::new();
    }
}