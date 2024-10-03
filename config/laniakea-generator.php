<?php

declare(strict_types=1);

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
        'getResourceModel()' => 'get{resource:singular:ucfirst}()',
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
        [
            'stub_class' => 'Stubs\Actions\CreateActionStub',
            'stub_path' => 'Actions/CreateActionStub.php',
            'target_class' => '{namespace}\Actions\Create{resource:singular:ucfirst}',
            'target_path' => '{path}/Actions/Create{resource:singular:ucfirst}.php',
        ],
        [
            'stub_class' => 'Stubs\Actions\UpdateActionStub',
            'stub_path' => 'Actions/UpdateActionStub.php',
            'target_class' => '{namespace}\Actions\Update{resource:singular:ucfirst}',
            'target_path' => '{path}/Actions/Update{resource:singular:ucfirst}.php',
        ],
        [
            'stub_class' => 'Stubs\Actions\DestroyActionStub',
            'stub_path' => 'Actions/DestroyActionStub.php',
            'target_class' => '{namespace}\Actions\Destroy{resource:singular:ucfirst}',
            'target_path' => '{path}/Actions/Destroy{resource:singular:ucfirst}.php',
        ],
        [
            'stub_class' => 'Stubs\Exceptions\NotFoundExceptionStub',
            'stub_path' => 'Exceptions/NotFoundExceptionStub.php',
            'target_class' => '{namespace}\Exceptions\{resource:singular:ucfirst}NotFoundException',
            'target_path' => '{path}/Exceptions/{resource:singular:ucfirst}NotFoundException.php',
        ],
        [
            'stub_class' => 'Stubs\Forms\AbstractFormStub',
            'stub_path' => 'Forms/AbstractFormStub.php',
            'target_class' => '{namespace}\Forms\Abstract{resource:singular:ucfirst}Form',
            'target_path' => '{path}/Forms/Abstract{resource:singular:ucfirst}Form.php',
        ],
        [
            'stub_class' => 'Stubs\Forms\CreateFormStub',
            'stub_path' => 'Forms/CreateFormStub.php',
            'target_class' => '{namespace}\Forms\Create{resource:singular:ucfirst}Form',
            'target_path' => '{path}/Forms/Create{resource:singular:ucfirst}Form.php',
        ],
        [
            'stub_class' => 'Stubs\Forms\EditFormStub',
            'stub_path' => 'Forms/EditFormStub.php',
            'target_class' => '{namespace}\Forms\Edit{resource:singular:ucfirst}Form',
            'target_path' => '{path}/Forms/Edit{resource:singular:ucfirst}Form.php',
        ],
        [
            'stub_class' => 'Stubs\Http\Requests\ListRequestStub',
            'stub_path' => 'Http/Requests/ListRequestStub.php',
            'target_class' => '{namespace}\Http\Requests\List{resource:plural:ucfirst}Request',
            'target_path' => '{path}/Http/Requests/List{resource:plural:ucfirst}Request.php',
        ],
        [
            'stub_class' => 'Stubs\Http\Requests\CreateRequestStub',
            'stub_path' => 'Http/Requests/CreateRequestStub.php',
            'target_class' => '{namespace}\Http\Requests\Create{resource:singular:ucfirst}Request',
            'target_path' => '{path}/Http/Requests/Create{resource:singular:ucfirst}Request.php',
        ],
        [
            'stub_class' => 'Stubs\Http\Requests\StoreRequestStub',
            'stub_path' => 'Http/Requests/StoreRequestStub.php',
            'target_class' => '{namespace}\Http\Requests\Store{resource:singular:ucfirst}Request',
            'target_path' => '{path}/Http/Requests/Store{resource:singular:ucfirst}Request.php',
        ],
        [
            'stub_class' => 'Stubs\Http\Requests\ViewRequestStub',
            'stub_path' => 'Http/Requests/ViewRequestStub.php',
            'target_class' => '{namespace}\Http\Requests\View{resource:singular:ucfirst}Request',
            'target_path' => '{path}/Http/Requests/View{resource:singular:ucfirst}Request.php',
        ],
        [
            'stub_class' => 'Stubs\Http\Requests\EditRequestStub',
            'stub_path' => 'Http/Requests/EditRequestStub.php',
            'target_class' => '{namespace}\Http\Requests\Edit{resource:singular:ucfirst}Request',
            'target_path' => '{path}/Http/Requests/Edit{resource:singular:ucfirst}Request.php',
        ],
        [
            'stub_class' => 'Stubs\Http\Requests\UpdateRequestStub',
            'stub_path' => 'Http/Requests/UpdateRequestStub.php',
            'target_class' => '{namespace}\Http\Requests\Update{resource:singular:ucfirst}Request',
            'target_path' => '{path}/Http/Requests/Update{resource:singular:ucfirst}Request.php',
        ],
        [
            'stub_class' => 'Stubs\Http\Requests\DestroyRequestStub',
            'stub_path' => 'Http/Requests/DestroyRequestStub.php',
            'target_class' => '{namespace}\Http\Requests\Destroy{resource:singular:ucfirst}Request',
            'target_path' => '{path}/Http/Requests/Destroy{resource:singular:ucfirst}Request.php',
        ],
        [
            'stub_class' => 'Stubs\Http\ApiControllerStub',
            'stub_path' => 'Http/ApiControllerStub.php',
            'target_class' => '{namespace}\Http\{resource:plural:ucfirst}ApiController',
            'target_path' => '{path}/Http/{resource:plural:ucfirst}ApiController.php',
        ],
        [
            'stub_class' => 'Stubs\Http\ControllerStub',
            'stub_path' => 'Http/ControllerStub.php',
            'target_class' => '{namespace}\Http\{resource:plural:ucfirst}Controller',
            'target_path' => '{path}/Http/{resource:plural:ucfirst}Controller.php',
        ],
        [
            'stub_class' => 'Stubs\Models\ModelStub',
            'stub_path' => 'Models/ModelStub.php',
            'target_class' => '{namespace}\Models\{resource:singular:ucfirst}',
            'target_path' => '{path}/Models/{resource:singular:ucfirst}.php',
        ],
        [
            'stub_class' => 'Stubs\Repositories\RepositoryStub',
            'stub_path' => 'Repositories/RepositoryStub.php',
            'target_class' => '{namespace}\Repositories\{resource:plural:ucfirst}Repository',
            'target_path' => '{path}/Repositories/{resource:plural:ucfirst}Repository.php',
        ],
        [
            'stub_class' => 'Stubs\Resources\ResourceStub',
            'stub_path' => 'Resources/ResourceStub.php',
            'target_class' => '{namespace}\Resources\{resource:plural:ucfirst}Resource',
            'target_path' => '{path}/Resources/{resource:plural:ucfirst}Resource.php',
        ],
        [
            'stub_class' => 'Stubs\Resources\ResourceRegistrarStub',
            'stub_path' => 'Resources/ResourceRegistrarStub.php',
            'target_class' => '{namespace}\Resources\{resource:plural:ucfirst}Registrar',
            'target_path' => '{path}/Resources/{resource:plural:ucfirst}Registrar.php',
        ],
        [
            'stub_class' => 'Stubs\Transformers\TransformerStub',
            'stub_path' => 'Transformers/TransformerStub.php',
            'target_class' => '{namespace}\Transformers\{resource:singular:ucfirst}Transformer',
            'target_path' => '{path}/Transformers/{resource:singular:ucfirst}Transformer.php',
        ],
    ],
];
