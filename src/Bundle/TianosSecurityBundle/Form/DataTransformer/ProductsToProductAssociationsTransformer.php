<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bundle\CRUD_DUMMYBundle\Form\DataTransformer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYAssociationInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYAssociationTypeInterface;
use Component\CRUD_DUMMY\Model\CRUD_DUMMYInterface;
use Component\CRUD_DUMMY\Repository\CRUD_DUMMYRepositoryInterface;
use Component\Resource\Factory\FactoryInterface;
use Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\DataTransformerInterface;

final class CRUD_DUMMYsToCRUD_DUMMYAssociationsTransformer implements DataTransformerInterface
{
    /**
     * @var FactoryInterface
     */
    private $productAssociationFactory;

    /**
     * @var CRUD_DUMMYRepositoryInterface
     */
    private $productRepository;

    /**
     * @var RepositoryInterface
     */
    private $productAssociationTypeRepository;

    /**
     * @var Collection
     */
    private $productAssociations;

    /**
     * @param FactoryInterface $productAssociationFactory
     * @param CRUD_DUMMYRepositoryInterface $productRepository
     * @param RepositoryInterface $productAssociationTypeRepository
     */
    public function __construct(
        FactoryInterface $productAssociationFactory,
        CRUD_DUMMYRepositoryInterface $productRepository,
        RepositoryInterface $productAssociationTypeRepository
    ) {
        $this->productAssociationFactory = $productAssociationFactory;
        $this->productRepository = $productRepository;
        $this->productAssociationTypeRepository = $productAssociationTypeRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($productAssociations)
    {
        $this->setCRUD_DUMMYAssociations($productAssociations);

        if (null === $productAssociations) {
            return '';
        }

        $values = [];

        /** @var CRUD_DUMMYAssociationInterface $productAssociation */
        foreach ($productAssociations as $productAssociation) {
            $productCodesAsString = $this->getCodesAsStringFromCRUD_DUMMYs($productAssociation->getAssociatedCRUD_DUMMYs());

            $values[$productAssociation->getType()->getCode()] = $productCodesAsString;
        }

        return $values;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($values): ?Collection
    {
        if (null === $values || '' === $values || !is_array($values)) {
            return null;
        }

        $productAssociations = new ArrayCollection();
        foreach ($values as $productAssociationTypeCode => $productCodes) {
            if (null === $productCodes) {
                continue;
            }

            /** @var CRUD_DUMMYAssociationInterface $productAssociation */
            $productAssociation = $this->getCRUD_DUMMYAssociationByTypeCode($productAssociationTypeCode);
            $this->setAssociatedCRUD_DUMMYsByCRUD_DUMMYCodes($productAssociation, $productCodes);
            $productAssociations->add($productAssociation);
        }

        $this->setCRUD_DUMMYAssociations(null);

        return $productAssociations;
    }

    /**
     * @param Collection $products
     *
     * @return string|null
     */
    private function getCodesAsStringFromCRUD_DUMMYs(Collection $products): ?string
    {
        if ($products->isEmpty()) {
            return null;
        }

        $codes = [];

        /** @var CRUD_DUMMYInterface $product */
        foreach ($products as $product) {
            $codes[] = $product->getCode();
        }

        return implode(',', $codes);
    }

    /**
     * @param string $productAssociationTypeCode
     *
     * @return CRUD_DUMMYAssociationInterface
     */
    private function getCRUD_DUMMYAssociationByTypeCode(string $productAssociationTypeCode): CRUD_DUMMYAssociationInterface
    {
        foreach ($this->productAssociations as $productAssociation) {
            if ($productAssociationTypeCode === $productAssociation->getType()->getCode()) {
                return $productAssociation;
            }
        }

        /** @var CRUD_DUMMYAssociationTypeInterface $productAssociationType */
        $productAssociationType = $this->productAssociationTypeRepository->findOneBy([
            'code' => $productAssociationTypeCode,
        ]);

        /** @var CRUD_DUMMYAssociationInterface $productAssociation */
        $productAssociation = $this->productAssociationFactory->createNew();
        $productAssociation->setType($productAssociationType);

        return $productAssociation;
    }

    /**
     * @param CRUD_DUMMYAssociationInterface $productAssociation
     * @param string $productCodes
     */
    private function setAssociatedCRUD_DUMMYsByCRUD_DUMMYCodes(
        CRUD_DUMMYAssociationInterface $productAssociation,
        string $productCodes
    ): void {
        $products = $this->productRepository->findBy(['code' => explode(',', $productCodes)]);

        $productAssociation->clearAssociatedCRUD_DUMMYs();
        foreach ($products as $product) {
            $productAssociation->addAssociatedCRUD_DUMMY($product);
        }
    }

    /**
     * @param Collection|null $productAssociations
     */
    private function setCRUD_DUMMYAssociations(?Collection $productAssociations): void
    {
        $this->productAssociations = $productAssociations;
    }
}
