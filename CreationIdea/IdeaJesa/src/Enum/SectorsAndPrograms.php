<?php
namespace App\Enum;

enum SectorsAndPrograms: string
{
    case MINING = 'MINING';
    case FERTILIZER = 'FERTILIZER';
    case CENTRAL_AXIS = 'CENTRAL_AXIS';
    case PFC = 'PFC';
    case WATER = 'WATER';
    case ENERGY = 'ENERGY';
    case BUILDING = 'BUILDING';
    case TRANSPORT = 'TRANSPORT';
    case PORTS = 'PORTS';
    case ASSET_MANAGEMENT = 'ASSET_MANAGEMENT';
    case ADVISORY = 'ADVISORY';
    case JESA_TECHNOLOGY = 'JESA_TECHNOLOGY';
}
