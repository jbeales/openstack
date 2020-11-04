<?php

require 'vendor/autoload.php';



$openstack = new OpenStack\OpenStack([
    'authUrl' => '{authUrl}',
    'region'  => '{region}',
    'user'    => [
        'id'       => '{userId}',
        'password' => '{password}'
    ],
    'scope'   => ['project' => ['id' => '{projectId}']]
]);

$options = [
    'name'   => '{objectName}',
    'stream' => \GuzzleHttp\Psr7\Utils::streamFor(fopen('{largeObjectFile}', 'r')),
];

// optional: specify the size of each segment in bytes
$options['segmentSize'] = '{segmentSize}';

// optional: specify the container where the segments live. This does not necessarily have to be the
// same as the container which holds the manifest file
$options['segmentContainer'] = '{segmentContainer}';


/** @var \OpenStack\ObjectStore\v1\Models\StorageObject $object */
$object = $openstack->objectStoreV1()
                    ->getContainer('{containerName}')
                    ->createLargeObject($options);
