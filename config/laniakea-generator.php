<?php

declare(strict_types=1);

use Laniakea\Generator\Enums\Stub;

return [
    /*
     * Root namespace that will be used in all generated classes.
     * This namespace should not include name of resource.
     *
     * If set to null, user will be prompted to enter root namespace.
     */
    'root_namespace' => env('LANIAKEA_GENERATOR_ROOT_NAMESPACE'),

    /**
     * Root directory that will be used as base for saving all generated classes.
     * This directory should not include name of resource.
     *
     * If set to null, user will be prompted to enter root path.
     */
    'root_path' => env('LANIAKEA_GENERATOR_ROOT_PATH'),

    /**
     * Location of custom stubs that will be used for generating classes.
     * You can override specific stubs only. If any stub is missing from
     * custom directory, default stub will be used.
     */
    'stubs_dir' => null,

    /**
     * Custom replacements that will be applied to all generated classes.
     * You can use specific template tags to replace with resource name.
     *
     * - {namespace} - root namespace without trailing slash (e.g. App\Services);
     * - {resource:singular} - singular camel-cased resource name (e.g. user or postComment);
     * - {resource:singular:snake} – singular snake-cased resource name (e.g. user or post_comment);
     * - {resource:singular:ucfirst} - singular camel-cased resource name with first letter capitalized (e.g. User or PostComment);
     * - {resource:singular:words} - singular resource name with spaces between words (e.g. user or post comment);
     * - {resource:singular:words:title} - singular resource name with spaces between words and first letter of each word capitalized (e.g. User or Post Comment);
     * - {resource:plural} - plural camel-cased resource name (e.g. users or postComments);
     * - {resource:plural:snake} – plural snake-cased resource name (e.g. users or post_comments);
     * - {resource:plural:ucfirst} - plural camel-cased resource name with first letter capitalized (e.g. Users or PostComments);
     * - {resource:plural:words} - plural resource name with spaces between words (e.g. users or post comments);
     * - {resource:plural:words:title} - plural resource name with spaces between words and first letter of each word capitalized (e.g. Users or Post Comments);
     */
    'custom_replacements' => [
        'Stubs\Vendor\AbstractDataTable' => 'Virgo\Application\DataTables\AbstractDataTable',
        'Stubs\Vendor\AbstractForm' => 'Virgo\Application\Forms\AbstractForm',
        'Stubs\Vendor\AbstractTransformer' => 'Virgo\Application\Fractal\AbstractTransformer',
        'getResource()' => 'get{resource:singular:ucfirst}()',
        '$this->model' => '$this->{resource:singular}',
        '$model' => '${resource:singular}',
    ],

    /**
     * List of available stubs & their target FCQN and location.
     * The 'class' and 'path' keys can contain template tags that will be replaced with resource name (see above).
     *
     * Additional {path} tag can be used to specify root directory (only in 'path' key of each stub).
     */
    'stubs' => [
        Stub::CREATE_ACTION->value => [
            'class' => '{namespace}\Actions\Create{resource:singular:ucfirst}Action',
            'path' => '{path}/Actions/Create{resource:singular:ucfirst}Action.php',
        ],
        Stub::UPDATE_ACTION->value => [
            'class' => '{namespace}\Actions\Update{resource:singular:ucfirst}Action',
            'path' => '{path}/Actions/Update{resource:singular:ucfirst}Action.php',
        ],
        Stub::DESTROY_ACTION->value => [
            'class' => '{namespace}\Actions\Destroy{resource:singular:ucfirst}Action',
            'path' => '{path}/Actions/Destroy{resource:singular:ucfirst}Action.php',
        ],
        Stub::DATATABLE->value => [
            'class' => '{namespace}\DataTables\{resource:plural:ucfirst}DataTable',
            'path' => '{path}/DataTables/{resource:plural:ucfirst}DataTable.php',
        ],
        Stub::NOT_FOUND_EXCEPTION->value => [
            'class' => '{namespace}\Exceptions\{resource:singular:ucfirst}NotFoundException',
            'path' => '{path}/Exceptions/{resource:singular:ucfirst}NotFoundException.php',
        ],
        Stub::ABSTRACT_FORM->value => [
            'class' => '{namespace}\Forms\Abstract{resource:singular:ucfirst}Form',
            'path' => '{path}/Forms/Abstract{resource:singular:ucfirst}Form.php',
        ],
        Stub::CREATE_FORM->value => [
            'class' => '{namespace}\Forms\Create{resource:singular:ucfirst}Form',
            'path' => '{path}/Forms/Create{resource:singular:ucfirst}Form.php',
        ],
        Stub::EDIT_FORM->value => [
            'class' => '{namespace}\Forms\Edit{resource:singular:ucfirst}Form',
            'path' => '{path}/Forms/Edit{resource:singular:ucfirst}Form.php',
        ],
        Stub::LIST_REQUEST->value => [
            'class' => '{namespace}\Http\Requests\List{resource:plural:ucfirst}Request',
            'path' => '{path}/Http/Requests/List{resource:plural:ucfirst}Request.php',
        ],
        Stub::CREATE_REQUEST->value => [
            'class' => '{namespace}\Http\Requests\Create{resource:singular:ucfirst}Request',
            'path' => '{path}/Http/Requests/Create{resource:singular:ucfirst}Request.php',
        ],
        Stub::STORE_REQUEST->value => [
            'class' => '{namespace}\Http\Requests\Store{resource:singular:ucfirst}Request',
            'path' => '{path}/Http/Requests/Store{resource:singular:ucfirst}Request.php',
        ],
        Stub::VIEW_REQUEST->value => [
            'class' => '{namespace}\Http\Requests\View{resource:singular:ucfirst}Request',
            'path' => '{path}/Http/Requests/View{resource:singular:ucfirst}Request.php',
        ],
        Stub::EDIT_REQUEST->value => [
            'class' => '{namespace}\Http\Requests\Edit{resource:singular:ucfirst}Request',
            'path' => '{path}/Http/Requests/Edit{resource:singular:ucfirst}Request.php',
        ],
        Stub::UPDATE_REQUEST->value => [
            'class' => '{namespace}\Http\Requests\Update{resource:singular:ucfirst}Request',
            'path' => '{path}/Http/Requests/Update{resource:singular:ucfirst}Request.php',
        ],
        Stub::DESTROY_REQUEST->value => [
            'class' => '{namespace}\Http\Requests\Destroy{resource:singular:ucfirst}Request',
            'path' => '{path}/Http/Requests/Destroy{resource:singular:ucfirst}Request.php',
        ],
        Stub::API_CONTROLLER->value => [
            'class' => '{namespace}\Http\Controllers\Api\{resource:plural:ucfirst}Controller',
            'path' => '{path}/Http/{resource:plural:ucfirst}ApiController.php',
        ],
        Stub::WEB_CONTROLLER->value => [
            'class' => '{namespace}\Http\Controllers\Web\{resource:plural:ucfirst}Controller',
            'path' => '{path}/Http/{resource:plural:ucfirst}Controller.php',
        ],
        Stub::MODEL->value => [
            'class' => '{namespace}\Models\{resource:singular:ucfirst}',
            'path' => '{path}/Models/{resource:singular:ucfirst}.php',
        ],
        Stub::REPOSITORY->value => [
            'class' => '{namespace}\Repositories\{resource:plural:ucfirst}Repository',
            'path' => '{path}/Repositories/{resource:plural:ucfirst}Repository.php',
        ],
        Stub::RESOURCE->value => [
            'class' => '{namespace}\Resources\{resource:plural:ucfirst}Resource',
            'path' => '{path}/Resources/{resource:plural:ucfirst}Resource.php',
        ],
        Stub::RESOURCE_REGISTRAR->value => [
            'class' => '{namespace}\Resources\{resource:plural:ucfirst}Registrar',
            'path' => '{path}/Resources/{resource:plural:ucfirst}Registrar.php',
        ],
        Stub::TRANSFORMER->value => [
            'class' => '{namespace}\Transformers\{resource:singular:ucfirst}Transformer',
            'path' => '{path}/Transformers/{resource:singular:ucfirst}Transformer.php',
        ],
    ],
];
