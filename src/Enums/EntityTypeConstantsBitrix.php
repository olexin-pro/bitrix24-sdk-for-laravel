<?php

namespace OlexinPro\Bitrix24\Enums;

enum EntityTypeConstantsBitrix: string
{
    case Lead = 'CRM_LEAD';
    case Deal = 'CRM_DEAL';
    case Contact = 'CRM_CONTACT';
    case Company = 'CRM_COMPANY';
    case InvoiceOld = 'CRM_INVOICE';
    case Invoice = 'CRM_SMART_INVOICE';
    case Offer = 'CRM_QUOTE';
    case Requisite = 'CRM_REQUISITE';
}
