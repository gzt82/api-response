<?php return array(
    'root' => array(
        'name' => 'ryantao/api-response',
        'pretty_version' => 'dev-master',
        'version' => 'dev-master',
        'reference' => '7c22a707b616592139054c556a0560d8b38b0214',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        'monolog/monolog' => array(
            'pretty_version' => '2.9.2',
            'version' => '2.9.2.0',
            'reference' => '437cb3628f4cf6042cc10ae97fc2b8472e48ca1f',
            'type' => 'library',
            'install_path' => __DIR__ . '/../monolog/monolog',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'psr/log' => array(
            'pretty_version' => '3.0.0',
            'version' => '3.0.0.0',
            'reference' => 'fe5ea303b0887d5caefd3d431c3e61ad47037001',
            'type' => 'library',
            'install_path' => __DIR__ . '/../psr/log',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'psr/log-implementation' => array(
            'dev_requirement' => false,
            'provided' => array(
                0 => '1.0.0 || 2.0.0 || 3.0.0',
            ),
        ),
        'roave/security-advisories' => array(
            'pretty_version' => 'dev-latest',
            'version' => 'dev-latest',
            'reference' => '7a1a6552ac2f0fd7131d2552be221f2dd6eb19fa',
            'type' => 'metapackage',
            'install_path' => null,
            'aliases' => array(
                0 => '9999999-dev',
            ),
            'dev_requirement' => true,
        ),
        'ryantao/api-response' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'reference' => '7c22a707b616592139054c556a0560d8b38b0214',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
    ),
);
