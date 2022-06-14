<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    /**
     * @var int
     */
    public const MIN_LENGTH_NAME = 2;

    /**
     * @var int
     */
    public const MAX_LENGTH_NAME = 255;

    /**
     * @var int
     */
    public const MAX_LENGTH_SHORT_DESCRIPTION = 300;

    /**
     * @var int
     */
    public const SIZE_PHONE = 11;

    /**
     * @inheritdoc
     */
    protected $table = 'card';
}
