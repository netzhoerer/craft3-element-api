<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        'news.json' => [
            'elementType' => Entry::class,
            'criteria' => ['section' => 'news'],
            'transformer' => function (Entry $entry) {
                return [
                    'title' => $entry->title,
                    'url' => $entry->url,
                    'jsonUrl' => UrlHelper::url("news/{$entry->id}.json"),
                    'summary' => $entry->summary,
                    '_id' => $entry->id,
                ];
            },
        ],
        'all.json' => [
            'elementType' => Entry::class,
            'criteria' => ['section' => 'news'],
            'transformer' => function (Entry $entry) {
                $output = [];
                foreach ($entry as $key => $value) {
                    $output[$key] = $value;
                }
                $output['_id'] = $entry->id;
                $output['jsonUrl'] = UrlHelper::url("news/{$entry->slug}.json");
                return $output;
            },
        ],
        // all with slug
        'news/<entrieSlug:\S+>.json' => function ($entrieSlug) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['slug' => $entrieSlug],
                'one' => true,
                'transformer' => function (Entry $entry) {
                    return [
                        'title' => $entry->title,
                        'url' => $entry->url,
                        'summary' => $entry->summary,
                        'body' => $entry->body,
                        'test2' => $entry->test2,
                    ];
                },
            ];
        },
//        'news/<entryId:\d+>.json' => function ($entryId) {
//            return [
//                'elementType' => Entry::class,
//                'criteria' => ['id' => $entryId],
//                'one' => true,
//                'transformer' => function (Entry $entry) {
//                    return [
//                        'title' => $entry->title,
//                        'url' => $entry->url,
//                        'summary' => $entry->summary,
//                        'body' => $entry->body,
//                        'test2' => $entry->test2,
//                    ];
//                },
//            ];
//        },
    ]
];