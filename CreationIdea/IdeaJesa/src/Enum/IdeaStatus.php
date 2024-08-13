<?php
namespace App\Enum;

enum IdeaStatus: string
{
    case PENDING = 'PENDING';
    case APPROVED_BY_JESA_PM = 'APPROVED_BY_JESA_PM';
    case APPROVED_BY_CUSTOMER = 'APPROVED_BY_CUSTOMER';
    case REJECTED = 'REJECTED';
    
}
