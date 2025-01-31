<?php

declare(strict_types=1);

namespace OlexinPro\Bitrix24\Enums;

enum ShortStringConstantsBitrix: string
{
    case Lead = 'L';
    case Deal = 'D';
    case Contact = 'C';
    case Company = 'CO';
    case InvoiceOld = 'I';
    case Invoice = 'SI';
    case Offer = 'Q';
    case Requisite = 'RQ';
}
