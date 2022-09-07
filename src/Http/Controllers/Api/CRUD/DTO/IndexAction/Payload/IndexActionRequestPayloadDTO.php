<?php

declare(strict_types=1);

namespace Khazhinov\LaravelLighty\Http\Controllers\Api\CRUD\DTO\IndexAction\Payload;

use Khazhinov\LaravelLighty\DTO\DataTransferObject;
use Khazhinov\LaravelLighty\DTO\Validation\ArrayOfScalar;
use Khazhinov\LaravelLighty\DTO\Validation\NumberBetween;
use Khazhinov\LaravelLighty\Enums\ScalarTypeEnum;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;

class IndexActionRequestPayloadDTO extends DataTransferObject
{
    /**
     * @var IndexActionRequestPayloadFilterDTO[]
     */
    #[CastWith(ArrayCaster::class, itemType: IndexActionRequestPayloadFilterDTO::class)]
    public array $filter = [];

    /**
     * @var int
     */
    public int $page = 1;

    #[NumberBetween(1, 300)]
    public int $limit = 10;

    /**
     * @var array<string>|null
     */
    #[ArrayOfScalar(ScalarTypeEnum::String, true)]
    public array|null $order = null;

    /**
     * @var array<string, mixed>|null
     */
    public array|null $with = null;

    /**
     * @var IndexActionRequestPayloadExportDTO[]
     */
    #[CastWith(ArrayCaster::class, itemType: IndexActionRequestPayloadExportDTO::class)]
    public array $export = [];

    /**
     * @return array<string, string>
     */
    public function getExportColumns(): array
    {
        $result = [];
        foreach ($this->export as $export_object) {
            $result[$export_object->column] = $export_object->alias;
        }

        return $result;
    }

    public function hasExportColumns(): bool
    {
        return (bool) count($this->export);
    }
}