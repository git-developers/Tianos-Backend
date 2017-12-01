<?php

namespace CoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoreBundle\Entity\TemplateHasModule;

class Load_7_TemplateHasModuleData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $template = $this->getReference('template');
        $moduleIndex = $this->getReference('module-index');
        $moduleParagraph = $this->getReference('module-paragraph');
        $moduleItem = $this->getReference('module-item');
        $moduleBlog = $this->getReference('module-blog');
        $moduleBlogPost = $this->getReference('module-blog-post');

        $templateHasModuleParent2 = new TemplateHasModule();
        $templateHasModuleParent2->setTemplate($template);
        $templateHasModuleParent2->setModule($moduleBlog);
        $templateHasModuleParent2->setName('Blog');
        $templateHasModuleParent2->setPath('blog');
        $templateHasModuleParent2->setTemplateName(TemplateHasModule::HTML_BLOG);
        $templateHasModuleParent2->setIsParent(1);
        $manager->persist($templateHasModuleParent2);

        $templateHasModuleParent1 = new TemplateHasModule();
        $templateHasModuleParent1->setTemplate($template);
        $templateHasModuleParent1->setModule($moduleIndex);
        $templateHasModuleParent1->setName('Index');
        $templateHasModuleParent1->setPath('index');
        $templateHasModuleParent1->setTemplateName(TemplateHasModule::HTML_INDEX);
        $templateHasModuleParent1->setIsParent(1);
        $manager->persist($templateHasModuleParent1);


        /**
         * Parent 2
         */
        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleBlogPost);
        $entity->setName('Blog post - 1');
        $entity->setPath('blog_post/1');
        $entity->setTemplateHasModule($templateHasModuleParent2);
        $manager->persist($entity);


        /**
         * Parent 1
         */
        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleItem);
        $entity->setName('Item - 2');
        $entity->setPath('item/2');
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleItem);
        $entity->setName('Item - 1');
        $entity->setPath('item/1');
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleParagraph);
        $entity->setName('Paragraph - 11');
        $entity->setPath('paragraph/11');
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleParagraph);
        $entity->setName('Paragraph - 10');
        $entity->setPath('paragraph/10');
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleParagraph);
        $entity->setName('Paragraph - 9');
        $entity->setPath('paragraph/9');
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleParagraph);
        $entity->setName('Paragraph - 8');
        $entity->setPath('paragraph/8');
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleParagraph);
        $entity->setName('Paragraph - 7');
        $entity->setPath('paragraph/7');
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleParagraph);
        $entity->setName('Paragraph - 6');
        $entity->setPath('paragraph/6');
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleParagraph);
        $entity->setName('Paragraph - 5');
        $entity->setPath('paragraph/5');
        $entity->setSettings([
            'paragraph' => [
                'Label parrafo 1',
                'Label parrafo 2',
                'Label parrafo 3',
                'Label parrafo 4',
            ]
        ]);
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleParagraph);
        $entity->setName('Paragraph - 4');
        $entity->setPath('paragraph/4');
        $entity->setSettings([
            'paragraph' => [
                'Label parrafo 1',
                'Label parrafo 2',
                'Label parrafo 3',
                'Label parrafo 4',
                'Label parrafo 5',
                'Label parrafo 6',
            ]
        ]);
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleParagraph);
        $entity->setName('Paragraph - 3');
        $entity->setPath('paragraph/3');
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleParagraph);
        $entity->setName('Paragraph - 2');
        $entity->setPath('paragraph/2');
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $entity = new TemplateHasModule();
        $entity->setTemplate($template);
        $entity->setModule($moduleParagraph);
        $entity->setName('Paragraph - 1');
        $entity->setPath('paragraph/1');
        $entity->setSettings([
            'paragraph' => [
                'Label parrafo 1',
                'Label parrafo 2',
                'Label parrafo 3',
            ]
        ]);
        $entity->setTemplateHasModule($templateHasModuleParent1);
        $manager->persist($entity);

        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 10;
    }
}