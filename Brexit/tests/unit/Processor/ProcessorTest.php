<?php


namespace Anguis\Brexit\Tests\unit\Processor;

use PHPUnit\Framework\TestCase;
use Anguis\Brexit\Entity\ProcessorRule;
use Anguis\Brexit\Processor\ProcessorInterface;
use Anguis\Brexit\Processor\ProductProcessor;


final class ProcessorTest extends TestCase
{

    public function testShouldImplementsProperInterface()
    {
        // Given
        $processor = $this->createStub(ProductProcessor::class);

        // Then
        $this->assertInstanceOf(ProcessorInterface::class, $processor);
    }
}