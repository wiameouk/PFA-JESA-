<?php
namespace App\Enum;

enum ProjectPhase: string
{
    case IDENTIFY = 'IDENTIFY';
    case EVALUATE = 'EVALUATE';
    case DEFINE = 'DEFINE';
    case DESIGN = 'DESIGN';
    case BUILD = 'BUILD';
    case COMMISSIONING_HANDOVER = 'COMMISSIONING/HANDOVER';
    case ASSET_MANAGEMENT = 'ASSET_MANAGEMENT';
}
