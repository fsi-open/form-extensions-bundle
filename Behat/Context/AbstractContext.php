<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace FSi\Bundle\FormExtensionsBundle\Behat\Context;

use Behat\Mink\Mink;
use Behat\MinkExtension\Context\MinkAwareContext;
use RuntimeException;
use SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;

abstract class AbstractContext extends PageObjectContext implements MinkAwareContext
{
    /**
     * @var Mink|null
     */
    private $mink;

    /**
     * @var array<mixed>|null
     */
    private $minkParameters;

    public function getPage($name)
    {
        $this->startIfSessionNotStarted();
        return parent::getPage($name);
    }

    public function getElement($name)
    {
        $this->startIfSessionNotStarted();
        return parent::getElement($name);
    }

    public function setMink(Mink $mink): void
    {
        $this->mink = $mink;
    }

    public function getMink()
    {
        if (null === $this->mink) {
            throw new RuntimeException(
                'Mink instance has not been set on Mink context class. ' .
                'Have you enabled the Mink Extension?'
            );
        }

        return $this->mink;
    }

    public function setMinkParameters(array $parameters)
    {
        $this->minkParameters = $parameters;
    }

    protected function startIfSessionNotStarted(): void
    {
        if (false === $this->getMink()->getSession()->isStarted()) {
            $this->getMink()->getSession()->start();
        }
    }
}
