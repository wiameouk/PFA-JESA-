<?php

namespace App\Enum;

enum ApprovalStatus: string
{
    case APPROVED = 'APPROVED';
    case REJECTED = 'REJECTED';
}