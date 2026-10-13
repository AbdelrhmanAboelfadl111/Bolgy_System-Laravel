<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ["title", "author_name", "body"];

    protected $appends = ['formatted_created_at'];

    protected function formattedCreatedAt(): Attribute
    {
        return Attribute::get(
            fn () => $this->created_at?->format('F j, Y, g:i a')
        );
    }

    protected function body(): Attribute
    {
        return Attribute::get(
            fn ($value) => Str::limit($value, 100, '...')
        );
    }

    protected function fullBody(): Attribute
    {
        return Attribute::get(
            fn () => $this->getRawOriginal('body')
        );
    }
}
