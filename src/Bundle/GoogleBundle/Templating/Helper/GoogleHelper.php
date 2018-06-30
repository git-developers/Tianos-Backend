<?php

declare(strict_types=1);

namespace Bundle\GoogleBundle\Templating\Helper;

use Component\Google\Definition\Action;
use Component\Google\Definition\Field;
use Component\Google\Definition\Filter;
use Component\Google\Renderer\GoogleRendererInterface;
use Component\Google\View\GoogleView;
use Bundle\CoreBundle\Services\Button;
use Symfony\Component\Templating\Helper\Helper;
use Bundle\GoogleBundle\Entity\GoogleDrive;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class GoogleHelper extends Helper
{
    /**
     * @var GoogleRendererInterface
     */
    private $gridRenderer;

    private $router;

    /**
     * @param GoogleRendererInterface $gridRenderer
     */
    public function __construct(GoogleRendererInterface $gridRenderer, Router $router)
    {
        $this->gridRenderer = $gridRenderer;
        $this->router = $router;
    }

    //    JAFETH
    public function googleSpanClass($mimeType)
    {

        if ($mimeType == GoogleDrive::GOOGLE_FOLDER) {
            return 'x-hand';
        }

        return;
    }

    public function googleMimeTypeIcon($mimeType)
    {
        $class = isset(GoogleDrive::MIME_TYPES[$mimeType]) ? GoogleDrive::MIME_TYPES[$mimeType] : 'file';

        return '<i class="fa fa-2x fa-fw fa-' . $class . '"></i>';
    }

    public function googleSpanUrlFilter($value)
    {
        if (isset($value['mimeType']) && ($value['mimeType'] == GoogleDrive::GOOGLE_FOLDER)) {

            return $this->router->generate(
                'backend_google_drive_index',
                [
                    'id' => $value['id'],
                    'name' => $value['name']
                ]
            );
        }

        return 'javascript:void(0)';
    }

    public function googleFileValues($value)
    {
//        $value = array_replace([
//            'id' => '',
//            'name' => '',
//            'iconLink' => '',
//            'mimeType' => '',
//            'size' => '',
//        ], $value);

        $value = [
            isset($value['id']) ? $value['id'] : '',
            isset($value['name']) ? $value['name'] : '',
            isset($value['iconLink']) ? $value['iconLink'] : '',
            isset($value['mimeType']) ? $value['mimeType'] : '',
            $this->formatBytesFilter($value['size']),
        ];

        return base64_encode(json_encode($value));
    }

    private function formatBytesFilter($bytes, $precision = 2)
    {

        if(empty($bytes)){
            return;
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        $power = $bytes > 0 ? floor(log(floatval($bytes), 1024)) : 0;

        return number_format($bytes / pow(1024, $power), $precision, '.', ',') . ' ' . $units[$power];
    }
    //    JAFETH

        /**
     * @param GoogleView $gridView
     * @param string|null $template
     *
     * @return mixed
     */
    public function renderGoogle(GoogleView $gridView, ?string $template = null)
    {
        //JAFETH
        return $this->gridRenderer->render($gridView, $template);
    }

    /**
     * @param GoogleView $gridView
     * @param Field $field
     * @param mixed $data
     *
     * @return mixed
     */
    public function renderField(GoogleView $gridView, Field $field, $data)
    {
        return $this->gridRenderer->renderField($gridView, $field, $data);
    }

    /**
     * @param GoogleView $gridView
     * @param Action $action
     * @param mixed|null $data
     *
     * @return mixed
     */
    public function renderAction(GoogleView $gridView, Action $action, $data = null)
    {
        return $this->gridRenderer->renderAction($gridView, $action, $data);
    }

    /**
     * @param GoogleView $gridView
     * @param Filter $filter
     *
     * @return mixed
     */
    public function renderFilter(GoogleView $gridView, Filter $filter)
    {
        return $this->gridRenderer->renderFilter($gridView, $filter);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'sylius_grid';
    }
}
