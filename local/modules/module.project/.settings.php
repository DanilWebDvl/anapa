<?php
return array(
    'controllers' => array(
        'value' => array(
            'namespaces' => array(
                '\\Module\\Project\\Controller' => 'api',
            ),
            'defaultNamespace' => '\\Module\\Project\\Controller',
        ),
        'readonly' => true,
    )
);

/**
 * <script>
 * var request = BX.ajax.runAction('module:project.api.test.example', {
 * data: {
 * param1: 'hhh'
 * }
 * });
 *
 * request.then(function(response){
 * console.dir(response);
 * });
 * </script>
 */