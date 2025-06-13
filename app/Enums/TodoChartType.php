<?php

namespace App\Enums;

enum TodoChartType: string
{
    case TYPE_STATUS = 'status';
    case TYPE_PRIORITY = 'priority';
    case TYPE_ASSIGNEE = 'assignee';
}