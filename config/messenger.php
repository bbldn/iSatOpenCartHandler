<?php

use Symfony\Component\Messenger\Bridge\Redis\Transport\Connection;
use Symfony\Component\Messenger\Bridge\Redis\Transport\RedisSender;
use Symfony\Component\Messenger\Bridge\Redis\Transport\RedisReceiver;
use Symfony\Component\Messenger\Transport\Serialization\PhpSerializer;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface as Serializer;

return [
    'serializer' => PhpSerializer::class,
    'sender' => static fn(string $queue, Serializer $serializer) => new RedisSender(Connection::fromDsn($queue), $serializer),
    'receiver' => static fn(string $queue, Serializer $serializer) => new RedisReceiver(Connection::fromDsn($queue), $serializer),

    'handlers' => [],
    'queues' => [
        'failed' => env('FAILED_MESSENGER_TRANSPORT_DSN'),
        'synchronizer_ua' => env('SYNCHRONIZER_UA_MESSENGER_TRANSPORT_DSN'),
    ],
];