<?php
use App\Enums\TransactionItemType;
 
// enumの日本語化対応configのlocaleをjaに変更済み

return [
    TransactionItemType::class => [
        TransactionItemType::ingredients => '食材費',
        TransactionItemType::eatout => '外食費',
        TransactionItemType::eachA => '個別A',
        TransactionItemType::eachB => '個別B',
        TransactionItemType::daily => '日用費',
        TransactionItemType::entertainment => '交遊費',
        TransactionItemType::children => '養育費',
        TransactionItemType::luxury => '贅沢費',
        TransactionItemType::special => '特別費',
        TransactionItemType::profits => '雑益',
        TransactionItemType::loss => '雑損',
        TransactionItemType::advanceA => '立替A',
        TransactionItemType::advanceB => '立替B',
    ],
];