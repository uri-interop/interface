<?php return [
    'namespace' => 'UriInterop\\Interface\\',
    'directory' => dirname(__DIR__) . '/src',
    'template' => dirname(__DIR__) . '/resources/README.tpl.md',
    'interfaces' => [
        'UriStruct',
        'MutableUriStruct',
        'ImmutableUriStruct',
        'UriStructFactory',
        'UriStructNormalizer',
        'UriStructResolver',
        'UriStringParser',
        'UriThrowable',
        'UriTypeAliases',
    ],
];
