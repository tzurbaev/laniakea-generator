<?php

declare(strict_types=1);

namespace Laniakea\Generator\Enums;

use Illuminate\Support\Str;

enum Stub: string
{
    case CREATE_ACTION = 'create_action';
    case UPDATE_ACTION = 'update_action';
    case DESTROY_ACTION = 'destroy_action';

    case DATATABLE = 'datatable';

    case NOT_FOUND_EXCEPTION = 'not_found_exception';

    case ABSTRACT_FORM = 'abstract_form';
    case CREATE_FORM = 'create_form';
    case EDIT_FORM = 'edit_form';

    case LIST_REQUEST = 'list_request';
    case CREATE_REQUEST = 'create_request';
    case STORE_REQUEST = 'store_request';
    case VIEW_REQUEST = 'view_request';
    case EDIT_REQUEST = 'edit_request';
    case UPDATE_REQUEST = 'update_request';
    case DESTROY_REQUEST = 'destroy_request';

    case API_CONTROLLER = 'api_controller';
    case WEB_CONTROLLER = 'web_controller';

    case MODEL = 'model';

    case REPOSITORY = 'repository';

    case RESOURCE = 'resource';
    case RESOURCE_REGISTRAR = 'resource_registrar';

    case TRANSFORMER = 'transformer';

    /**
     * Get current stub's class name.
     *
     * @return string
     */
    public function getClass(): string
    {
        return self::getStubClasses()[$this->value];
    }

    /**
     * Get current stub's relative path.
     *
     * @return string
     */
    public function getPath(): string
    {
        $className = $this->getClass();

        return Str::replace(
            '\\',
            DIRECTORY_SEPARATOR,
            Str::replaceFirst('Stubs\\', '', $className),
        ).'.php';
    }

    /**
     * Get all stubs' class names.
     *
     * @return string[]
     */
    public static function getStubClasses(): array
    {
        return [
            self::CREATE_ACTION->value => 'Stubs\Actions\CreateActionStub',
            self::UPDATE_ACTION->value => 'Stubs\Actions\UpdateActionStub',
            self::DESTROY_ACTION->value => 'Stubs\Actions\DestroyActionStub',

            self::DATATABLE->value => 'Stubs\DataTables\DataTableStub',

            self::NOT_FOUND_EXCEPTION->value => 'Stubs\Exceptions\NotFoundExceptionStub',

            self::ABSTRACT_FORM->value => 'Stubs\Forms\AbstractFormStub',
            self::CREATE_FORM->value => 'Stubs\Forms\CreateFormStub',
            self::EDIT_FORM->value => 'Stubs\Forms\EditFormStub',

            self::LIST_REQUEST->value => 'Stubs\Http\Requests\ListRequestStub',
            self::STORE_REQUEST->value => 'Stubs\Http\Requests\StoreRequestStub',
            self::CREATE_REQUEST->value => 'Stubs\Http\Requests\CreateRequestStub',
            self::VIEW_REQUEST->value => 'Stubs\Http\Requests\ViewRequestStub',
            self::EDIT_REQUEST->value => 'Stubs\Http\Requests\EditRequestStub',
            self::UPDATE_REQUEST->value => 'Stubs\Http\Requests\UpdateRequestStub',
            self::DESTROY_REQUEST->value => 'Stubs\Http\Requests\DestroyRequestStub',

            self::API_CONTROLLER->value => 'Stubs\Http\ApiControllerStub',
            self::WEB_CONTROLLER->value => 'Stubs\Http\ControllerStub',

            self::MODEL->value => 'Stubs\Models\ModelStub',

            self::REPOSITORY->value => 'Stubs\Repositories\RepositoryStub',

            self::RESOURCE->value => 'Stubs\Resources\ResourceStub',
            self::RESOURCE_REGISTRAR->value => 'Stubs\Resources\ResourceRegistrarStub',

            self::TRANSFORMER->value => 'Stubs\Transformers\TransformerStub',
        ];
    }
}
