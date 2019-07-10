<?php

namespace MustafatTOKER\NovaCreateOrAdd\Traits;

use Laravel\Nova\Nova;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Http\Requests\NovaRequest;

trait HasChildren
{
    protected function getRelation($resource, $attribute)
    {
        return $resource->attribute;
    }

    /**
     * Add children.
     *
     * @param mixed $resource
     * @param mixed $attribute
     *
     * @return self
     */
    protected function setChildren($resource, $attribute)
    {
        return $this->withMeta([
            'children' => $this->getRelation($resource, $attribute)->get()->map(function ($model, $index) {
                return $this->setChild($model, $index);
            }),
        ]);
    }

    /**
     * Set child.
     *
     * @param mixed $index
     *
     * @return self
     */
    protected function setChild(Model $model, $index = self::INDEX)
    {
        $this->setPrefix($index + 1)->setAttribute($index);

        $array = [
            'resourceId'      => $model->id,
            'resourceName'    => Nova::resourceForModel($this->getRelation()->getRelated())::uriKey(),
            'viaResource'     => $this->viaResource,
            'viaRelationship' => $this->viaRelationship,
            'viaResourceId'   => $this->viaResourceId,
            'heading'         => $this->getHeading(),
            'attribute'       => self::ATTRIBUTE_PREFIX.$this->attribute,
            'opened'          => isset($this->meta['opened']) && ('only first' === $this->meta['opened'] ? 0 === $index : $this->meta['opened']),
            'fields'          => $this->setFieldsAttribute($this->updateFields($model))->values(),
            'max'             => $this->meta['max'] ?? 0,
            'min'             => $this->meta['min'] ?? 0,
            self::STATUS      => null,
        ];

        $this->removePrefix()->removeAttribute();

        return $array;
    }

    /**
     * Get fields.
     *
     * @param Model       $model
     * @param null|string $type
     *
     * @return FieldCollection
     */
    private function updateFields(Model $model)
    {
        return (new $this->relatedResource($model))->updateFields(NovaRequest::create('/'));
    }
}
