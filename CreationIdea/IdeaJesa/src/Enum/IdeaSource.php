<?php 
namespace App\Enum;

enum IdeaSource: string
{
    case JESA = 'JESA';
    case CUSTOMER = 'CUSTOMER';
    case BOTH = 'BOTH';
}
