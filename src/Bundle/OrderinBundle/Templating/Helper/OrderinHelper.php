<?php

declare(strict_types=1);

namespace Bundle\OrderinBundle\Templating\Helper;

use Component\OneToMany\Definition\Action;
use Component\OneToMany\Definition\Field;
use Component\OneToMany\Definition\Filter;
//use Component\OneToMany\Renderer\OneToManyRendererInterface;
use Component\Orderin\Renderer\OrderinRendererInterface;
use Component\OneToMany\View\OneToManyView;
use Bundle\CoreBundle\Services\Button;
use Symfony\Component\Templating\Helper\Helper;

class OrderinHelper extends Helper
{
    /**
     * @var OneToManyRendererInterface
     */
    private $gridRenderer;

    /**
     * @param OneToManyRendererInterface $gridRenderer
     */
    public function __construct(OrderinRendererInterface $gridRenderer)
    {
        $this->gridRenderer = $gridRenderer;
    }

    //    JAFETH
    public function orderQuantity(array $orders = [], $id)
    {

        if(empty($orders)){
            return;
        }

        foreach ($orders as $key => $order){

            if( !is_object($order) || !is_object($order->getProduct()) ){
                continue;
            }

            if($order->getProduct()->getId() === $id){
                return $order->getQuantity();
            }
        }

        return;

//        return $this->twig->render($template ?: $this->defaultTemplate, ['template' => $template]);
    }


    /*

    //        JAFETH
    public function renderModalFooter(?string $template = null) // Button $button,
    {
        return $this->gridRenderer->renderModalFooter($template); // $button,
    }

    //        JAFETH
    public function renderButton(Button $button, ?string $template = null)
    {
        return $this->gridRenderer->renderButton($button, $template);
    }

    public function renderOneToMany(OneToManyView $gridView, ?string $template = null)
    {
        //JAFETH
        return $this->gridRenderer->render($gridView, $template);
    }

    public function renderField(OneToManyView $gridView, Field $field, $data)
    {
        return $this->gridRenderer->renderField($gridView, $field, $data);
    }

    public function renderAction(OneToManyView $gridView, Action $action, $data = null)
    {
        return $this->gridRenderer->renderAction($gridView, $action, $data);
    }

    public function renderFilter(OneToManyView $gridView, Filter $filter)
    {
        return $this->gridRenderer->renderFilter($gridView, $filter);
    }
    */

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'orderin_helper';
    }
}
