<?php declare(strict_types=1);

namespace App\Enums;

enum VisibilityEnum : string
{
    case public = 'public';
    case friends = 'friends';
    case private = 'private';
}
