<?php


namespace App\DTO\Admin\Attribute;


use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class AttributeValueDTO implements DTOInterface
{

    private string $value;
    private int $attribute_id;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getAttributeId(): int
    {
        return $this->attribute_id;
    }

    /**
     * @param int $attribute_id
     * @return self
     */
    public function setAttributeId(int $attribute_id): self
    {
        $this->attribute_id = $attribute_id;
        return $this;
    }


    public function make(FormRequest $request)
    {
        return $this->setValue($request->get('value'))
            ->setAttributeId($request->get('attribute_id'));
    }
}
