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
        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');
	
        
	    // TICKETS
	    $events = $this->get('tianos.repository.ticket')->findAll();
	
	    $out = [];
	    foreach ($events as $key => $event) {
		
		    $out[] = [
			    'title' => $event->getName(),
			    'start' => $event->getDateTicket(),
			    'backgroundColor' => '#449d44',
			    'borderColor' => '#398439'
		    ];
	    }
	    $events = json_encode($out);
	    // TICKETS

	    return $this->render($template, [
            'form' => null,
            'events' => $events
        ]);
    }
}
