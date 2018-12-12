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
	
        // SERVICES
	    $tickets = $this->get('tianos.repository.ticket')->findAll();
//	    $tickets = $this->getSerialize($tickets, 'crud');
	
	    $out = [];
	    foreach ($tickets as $key => $ticket) {
		
		    $out[] = [
		    	'title' => $ticket->getName(),
		    	'start' => $ticket->getDateTicket(),
		    	'backgroundColor' => '#449d44',
		    	'borderColor' => '#398439'
		    ];
	    }
	
	    $tickets = json_encode($out);
	
	    return $this->render($template, [
            'form' => null,
            'tickets' => $tickets
        ]);
    }
}
