<?php

return [
    'host' => [env('ELASTIC_HOST')],
    'index' => env('ELASTIC_INDEX', 'sguet')
];