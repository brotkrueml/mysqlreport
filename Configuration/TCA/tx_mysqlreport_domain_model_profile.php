<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

return [
    'ctrl' => [
        'title'	=> 'Profile',
        'label' => 'uid',
        'crdate' => 'crdate',
        'hideTable' => true,
    ],
    'columns' => [
        'query_id' => [
            'exclude' => 0,
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'mode' => [
            'exclude' => 0,
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'unique_call_identifier' => [
            'exclude' => 0,
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'duration' => [
            'exclude' => 0,
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'query' => [
            'exclude' => 0,
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'query_type' => [
            'exclude' => 0,
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
    'types' => [
        '1' => ['showitem' => ''],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
];
