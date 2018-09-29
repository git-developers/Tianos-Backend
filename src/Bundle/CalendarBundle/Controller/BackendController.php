<?php

declare(strict_types=1);

namespace Bundle\CalendarBundle\Controller;

use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class BackendController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
//        return $this->redirectUrl('frontend_default_index');

        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        return $this->render($template, [
            'form' => null
        ]);
    }
}
