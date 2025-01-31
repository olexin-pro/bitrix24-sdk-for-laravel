<?php

namespace OlexinPro\Bitrix24\Enums;

enum StringConstantsBitrix: string
{
    case Lead = 'LEAD';
    case Deal = 'DEAL';
    case Contact = 'CONTACT';
    case Company = 'COMPANY';
    case InvoiceOld = 'INVOICE';
    case Invoice = 'SMART_INVOICE';
    case Offer = 'QUOTE';
    case Requisite = 'REQUISITE';
}
