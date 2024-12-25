<?php

namespace App\Enums;

enum NotificationTypeEnum: string
{
    case GLOBAL = 'global';
    case GROUP = 'group';
    case SINGLE = 'single';
}
