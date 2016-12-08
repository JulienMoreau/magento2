<?php
require __DIR__.'/../_tools/init.php';

// Initialize the client
$client = new \SmileCoreTest\RestClient();
$client->setDebug(true);
$client->setMagentoParams($params);
$client->connect();


//$client->get('rest/V1/products/24-UB02');
//$client->get('rest/V1/categories/3');
/*$client->get('rest/V1/products', [
    'searchCriteria' => [
        'filterGroups' => [
            [
                'filters' => [
                    [
                        'field' => 'name',
                        'conditionType' => 'like',
                        'value' => '%bruno%'
                    ]
                ]
            ],
            [
                'filters' => [
                    [
                        'field' => 'description',
                        'conditionType' => 'like',
                        'value' => '%comfortable%'
                    ]
                ]
            ]
        ],
        'sortOrders' => [
            [
                'field' => 'name',
                'direction' => 'DESC'
            ]
        ],
        'pageSize' => 6
    ]
]);*/
$client->get('rest/V1/seller/id/1');
$client->get('rest/V1/seller/id/1');
$client->get('rest/V1/seller/', [
    'searchCriteria' => [
        'filterGroups' => [
            [
                'filters' => [
                    [
                        'field' => 'name',
                        'conditionType' => 'like',
                        'value' => '%main%'
                    ]
                ]
            ],
        ],
        'sortOrders' => [
            [
                'field' => 'name',
                'direction' => 'DESC'
            ]
        ],
        'pageSize' => 6
    ]
]);