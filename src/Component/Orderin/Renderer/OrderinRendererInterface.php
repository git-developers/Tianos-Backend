<?php

declare(strict_types=1);

namespace Component\Orderin\Renderer;

use Component\Orderin\Definition\Action;
use Component\Orderin\Definition\Field;
use Component\Orderin\Definition\Filter;
use Component\Orderin\View\OneToManyViewInterface;
use Bundle\CoreBundle\Services\Button;

interface OrderinRendererInterface
{

//    public function renderModalFooter(?string $template = null); // Button $button,
//    public function renderButton(Button $button, ?string $template = null);
    public function orderQuantity(array $orders = [], $id);



    /*
    public function render(OneToManyViewInterface $gridView, ?string $template = null);

    public function renderField(OneToManyViewInterface $gridView, Field $field, $data);

    public function renderAction(OneToManyViewInterface $gridView, Action $action, $data = null);

    public function renderFilter(OneToManyViewInterface $gridView, Filter $filter);
    */
}
