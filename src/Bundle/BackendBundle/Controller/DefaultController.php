<?php

declare(strict_types=1);

namespace Bundle\BackendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class DefaultController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        return $this->redirectUrl('backend_default_dashboard');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function dashboardAction(Request $request): Response
    {
        $userCount = $this->get('tianos.repository.user')->userCount();
        $visitCount = $this->get('tianos.repository.visit')->visitCount();


        /**
         * TIANOS
         */
        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        Assert::notNull($template, 'Template is not configured.');

        return $this->render($template, [
            'form' => null,
            'lastWeekdates' => $this->lastWeekdates(),
            'userCount' => $userCount,
            'visitCount' => $visitCount,
            'pdvHasProductCount' => 555,
            'pdvHasProductLastWeekCount' => 555,
            'productCount' => 555,
        ]);
    }

    public function lastWeekdates()
    {
        $now = new \DateTime('now');
        $now->sub(new \DateInterval('P7D'));

        $nextSevenDays = new \DatePeriod(
            $now, // Start date of the period
            new \DateInterval('P1D'), // Define the intervals as Periods of 1 Day
            6 // Apply the interval 6 times on top of the starting date
        );

        $weekDays = [];
        foreach ($nextSevenDays as $key => $day)
        {
            $weekDays[] = $day->format('d M, Y');
        }

        $first = reset($weekDays);
        $last = end($weekDays);

        return $first . ' - ' . $last; // 1 Jan, 2014 - 30 Jul, 2014
    }



}
