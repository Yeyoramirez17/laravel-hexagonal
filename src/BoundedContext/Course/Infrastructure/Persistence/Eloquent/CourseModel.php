<?php

namespace Core\BoundedContext\Course\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 */
final class CourseModel extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    protected $table = 'courses';
    public $incrementing = false;
    public $timestamps = true;

    public function __construct(array $attributes = [])
    {
        $this->setConnection('mysql');
        parent::__construct($attributes);
    }
    protected static function newFactory(): Factory
    {
        return CourseModelFactory::new();
    }
}
