<?php

declare(strict_types=1);

namespace Khazhinov\LaravelLighty\Http\Controllers\Api\CRUD\DTO;

use Khazhinov\LaravelLighty\DTO\DataTransferObject;
use Khazhinov\LaravelLighty\DTO\Validation\ClassExists;
use Khazhinov\LaravelLighty\DTO\Validation\ExistsInParents;
use ReflectionException;
use RuntimeException;

class ApiCRUDControllerActionInitDTO extends DataTransferObject
{
    public string $action_name;

    /**
     * @var array<mixed>
     */
    public array $action_options;

    #[ClassExists]
    #[ExistsInParents(parent: ApiCRUDControllerOptionDTO::class)]
    public string $action_option_class;

    /**
     * @throws ReflectionException
     */
    public function getActionOptionDTO(): ApiCRUDControllerOptionDTO
    {
        if ($this->action_options) {
            $action_option_dto = new $this->action_option_class($this->action_options);
        } else {
            $action_option_dto = new $this->action_option_class();
        }

        if (! is_a($action_option_dto, ApiCRUDControllerOptionDTO::class, true)) {
            $tmp_class = $action_option_dto;
            $tmp_base_class = ApiCRUDControllerOptionDTO::class;

            throw new RuntimeException("Class $tmp_class must be inherited from class $tmp_base_class");
        }

        return $action_option_dto;
    }
}