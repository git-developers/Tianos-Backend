<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CoreBundle\Command\TruncateTablesCommand;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

use Symfony\Bundle\FrameworkBundle\Console\Application;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    public function loadFixturesAction(Request $request)
    {

        if ($request->isMethod('POST')) {

            //truncate tables
            $command = new TruncateTablesCommand();
            $command->setContainer($this->container);
            $input = new ArrayInput(['status' => true]);
            $output = new BufferedOutput();
            $resultCode = $command->run($input, $output);
            //truncate tables



            //load fixtures
            $application = new Application($this->get('kernel'));
            $application->setAutoExit(false);

            $input = new ArrayInput(array(
                'command' => 'doctrine:fixtures:load',
            ));

            // You can use NullOutput() if you don't need the output
            $output = new BufferedOutput();
            $application->run($input, $output);

            // return the output, don't use if you used NullOutput()
            $content = $output->fetch();
            //load fixtures

            return $this->json([
                'content' => $content,
            ]);
        }

        return $this->render(
            'CoreBundle:Default:load_fixtures.html.twig',
            [
                'tree' => '',
            ]
        );
    }
}
