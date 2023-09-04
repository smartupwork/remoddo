<?php


namespace App\DTO\Admin\Attribute;


use App\DTO\DTOInterface;
use Illuminate\Foundation\Http\FormRequest;

class AttributeDTO implements DTOInterface
{

    private string $title;
    private string $name;
    private ?bool $is_required = false;
    private ?bool $is_show = false;
    private ?bool $is_multiple = false;
    private ?bool $show_in_products_table = false;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsRequired(): ?bool
    {
        return $this->is_required;
    }

    /**
     * @param bool|null $is_required
     * @return self
     */
    public function setIsRequired(?bool $is_required): self
    {
        $this->is_required = $is_required;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsShow(): ?bool
    {
        return $this->is_show;
    }

    /**
     * @param bool|null $is_show
     * @return self
     */
    public function setIsShow(?bool $is_show): self
    {
        $this->is_show = $is_show;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsMultiple(): ?bool
    {
        return $this->is_multiple;
    }

    /**
     * @param bool|null $is_multiple
     * @return self
     */
    public function setIsMultiple(?bool $is_multiple): self
    {
        $this->is_multiple = $is_multiple;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getShowInProductsTable(): ?bool
    {
        return $this->show_in_products_table;
    }

    /**
     * @param bool|null $show_in_products_table
     * @return self
     */
    public function setShowInProductsTable(?bool $show_in_products_table): self
    {
        $this->show_in_products_table = $show_in_products_table;
        return $this;
    }


    public function make(FormRequest $request)
    {
        return $this->setName($request->get('name'))
            ->setTitle($request->get('title'))
            ->setIsRequired($request->get('is_required') === 'on')
            ->setIsShow($request->get('is_show') === 'on')
            ->setIsMultiple($request->get('is_multiple') === 'on')
            ->setShowInProductsTable($request->get('show_in_products_table') === 'on');
    }
}
