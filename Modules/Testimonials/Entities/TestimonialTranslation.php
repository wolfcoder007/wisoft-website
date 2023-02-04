<?php

namespace Modules\Testimonials\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Testimonials\Events\TestimonialContentIsRendering;

class TestimonialTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'author', 'content'];
    protected $table = 'testimonials__testimonial_translations';
    
    public function getContentAttribute($content)
    {
        event($event = new TestimonialContentIsRendering($content));

        return $event->getContent();
    }
}
