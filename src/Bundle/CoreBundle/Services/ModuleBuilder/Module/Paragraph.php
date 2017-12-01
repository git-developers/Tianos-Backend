<?php

namespace CoreBundle\Services\ModuleBuilder\Module;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use CoreBundle\Services\ModuleBuilder\ExtendsClass\Base;
use CoreBundle\Services\ModuleBuilder\Interfaces\IModule;
use Symfony\Component\DependencyInjection\Container;
use CoreBundle\Entity\TemplateHasModule;
use CoreBundle\Entity\TemplateEParagraph;

class Paragraph extends Base implements IModule
{

    public function __construct(Container $container)
    {
        parent::__construct($container);

    }

    public function insModuleTemplate()
    {
        $template = $this->getBundleName() . ':' . $this->getControllerName() . '/Modules:3_paragraph.html.twig';

        if($this->templating->exists($template)) {
            return $template;
        }

        return $this->getBundleName() . ':' . $this->getControllerName() . '/Modules:99_error.html.twig';
    }

    public function insModuleObject(TemplateHasModule $templateHasModule)
    {
        $templateHasModuleId = $templateHasModule->getIdIncrement();
        $paragraphs = $this->entityManager->getRepository(TemplateEParagraph::class)->findOneByTemplateHasModule($templateHasModuleId);

        if($paragraphs){
            $paragraphs = array_shift($paragraphs);
            return unserialize($paragraphs);
        }

        return;
    }

    public function insSave(TemplateHasModule $templateHasModule)
    {
        $paragraphObj = $this->entityManager->getRepository(TemplateEParagraph::class)->findOneByTemplateHasModuleObj($templateHasModule);

        if (!$paragraphObj) {
            $paragraphObj = new TemplateEParagraph();
        }

        $request = $this->requestStack->getCurrentRequest();
        $paragraph = $request->get('paragraph');
        $paragraph = serialize($paragraph);

        $paragraphObj->setParagraph($paragraph);
        $paragraphObj->setTemplateHasModule($templateHasModule);
        $this->entityManager->persist($paragraphObj);
        $this->entityManager->flush();

        return $paragraphObj->getIdIncrement();
    }

    public function insCrudDefaults()
    {
        return;
    }

    public function insCrudDataTable()
    {
        return;
    }

}