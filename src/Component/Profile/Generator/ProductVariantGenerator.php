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

namespace Component\Product\Generator;

use Component\Product\Checker\ProductVariantsParityCheckerInterface;
use Component\Product\Factory\ProductVariantFactoryInterface;
use Component\Product\Model\ProductInterface;
use Component\Product\Model\ProductVariantInterface;
use Webmozart\Assert\Assert;

final class ProductVariantGenerator implements ProductVariantGeneratorInterface
{
    /**
     * @var ProductVariantFactoryInterface
     */
    private $productVariantFactory;

    /**
     * @var CartesianSetBuilder
     */
    private $setBuilder;

    /**
     * @var ProductVariantsParityCheckerInterface
     */
    private $variantsParityChecker;

    /**
     * @param ProductVariantFactoryInterface $productVariantFactory
     * @param ProductVariantsParityCheckerInterface $variantsParityChecker
     */
    public function __construct(
        ProductVariantFactoryInterface $productVariantFactory,
        ProductVariantsParityCheckerInterface $variantsParityChecker
    ) {
        $this->productVariantFactory = $productVariantFactory;
        $this->setBuilder = new CartesianSetBuilder();
        $this->variantsParityChecker = $variantsParityChecker;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(ProductInterface $product): void
    {
        Assert::true($product->hasOptions(), 'Cannot generate variants for an object without options.');

        $optionSet = [];
        $optionMap = [];

        foreach ($product->getOptions() as $key => $option) {
            foreach ($option->getValues() as $value) {
                $optionSet[$key][] = $value->getCode();
                $optionMap[$value->getCode()] = $value;
            }
        }

        $permutations = $this->setBuilder->build($optionSet);

        foreach ($permutations as $permutation) {
            $variant = $this->createVariant($product, $optionMap, $permutation);

            if (!$this->variantsParityChecker->checkParity($variant, $product)) {
                $product->addVariant($variant);
            }
        }
    }

    /**
     * @param ProductInterface $product
     * @param array $optionMap
     * @param mixed $permutation
     *
     * @return ProductVariantInterface
     */
    private function createVariant(ProductInterface $product, array $optionMap, $permutation): ProductVariantInterface
    {
        /** @var ProductVariantInterface $variant */
        $variant = $this->productVariantFactory->createForProduct($product);
        $this->addOptionValue($variant, $optionMap, $permutation);

        return $variant;
    }

    /**
     * @param ProductVariantInterface $variant
     * @param array $optionMap
     * @param mixed $permutation
     */
    private function addOptionValue(ProductVariantInterface $variant, array $optionMap, $permutation): void
    {
        if (!is_array($permutation)) {
            $variant->addOptionValue($optionMap[$permutation]);

            return;
        }

        foreach ($permutation as $code) {
            $variant->addOptionValue($optionMap[$code]);
        }
    }
}
