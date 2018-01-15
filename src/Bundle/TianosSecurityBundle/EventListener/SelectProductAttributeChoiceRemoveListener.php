<?php

declare(strict_types=1);

namespace Sylius\Bundle\CRUD_DUMMYBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Sylius\Component\Attribute\AttributeType\SelectAttributeType;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeInterface;
use Sylius\Component\CRUD_DUMMY\Model\CRUD_DUMMYAttributeValueInterface;
use Sylius\Component\CRUD_DUMMY\Repository\CRUD_DUMMYAttributeValueRepositoryInterface;

final class SelectCRUD_DUMMYAttributeChoiceRemoveListener
{
    /**
     * @var string
     */
    private $productAttributeValueClass;

    /**
     * @param string $productAttributeValueClass
     */
    public function __construct(string $productAttributeValueClass)
    {
        $this->productAttributeValueClass = $productAttributeValueClass;
    }

    /**
     * @param LifecycleEventArgs $event
     */
    public function postUpdate(LifecycleEventArgs $event): void
    {
        /** @var CRUD_DUMMYAttributeInterface $productAttribute */
        $productAttribute = $event->getEntity();

        if (!($productAttribute instanceof CRUD_DUMMYAttributeInterface)) {
            return;
        }

        if ($productAttribute->getType() !== SelectAttributeType::TYPE) {
            return;
        }

        $entityManager = $event->getEntityManager();

        $unitOfWork = $entityManager->getUnitOfWork();
        $changeSet = $unitOfWork->getEntityChangeSet($productAttribute);

        $oldChoices = $changeSet['configuration'][0]['choices'] ?? [];
        $newChoices = $changeSet['configuration'][1]['choices'] ?? [];

        $removedChoices = array_diff_key($oldChoices, $newChoices);
        if (!empty($removedChoices)) {
            $this->removeValues($entityManager, array_keys($removedChoices));
        }
    }

    /**
     * @param ObjectManager $entityManager
     * @param array|string[] $choiceKeys
     */
    public function removeValues(ObjectManager $entityManager, array $choiceKeys): void
    {
        /** @var CRUD_DUMMYAttributeValueRepositoryInterface $productAttributeValueRepository */
        $productAttributeValueRepository = $entityManager->getRepository($this->productAttributeValueClass);
        foreach ($choiceKeys as $choiceKey) {
            $productAttributeValues = $productAttributeValueRepository->findByJsonChoiceKey($choiceKey);

            /** @var CRUD_DUMMYAttributeValueInterface $productAttributeValue */
            foreach ($productAttributeValues as $productAttributeValue) {
                $newValue = array_diff($productAttributeValue->getValue(), [$choiceKey]);
                if (!empty($newValue)) {
                    $productAttributeValue->setValue($newValue);

                    continue;
                }

                $entityManager->remove($productAttributeValue);
            }
        }

        $entityManager->flush();
    }
}
