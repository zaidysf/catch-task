<?php

return [
    'order' => [
        'export_source_file' => env(
            'ORDER_EXPORT_SOURCE_FILE',
            'https://s3-ap-southeast-2.amazonaws.com/catch-code-challenge/challenge-1-in.jsonl'
        ),
    ]
];
