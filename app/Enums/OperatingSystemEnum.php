<?php

namespace App\Enums;

enum OperatingSystemEnum: string
{
    case LINUX = 'linux';
    case WINDOWS = 'windows';
    case MAC = 'mac';
    case ANDROID = 'android';
}
