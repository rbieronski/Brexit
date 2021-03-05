<?php


namespace Anguis\Brexit\Tests\Render;

use PHPUnit\Framework\TestCase;
use Anguis\Brexit\Renderer\CliRenderer;
use Anguis\Brexit\Renderer\RendererInterface;

class RenderTest extends TestCase
{

    public function testShouldImplementsProperInterface()
    {
        // Given
        $renderer = $this->createStub(CliRenderer::class);

        // Then
        $this->assertInstanceOf(RendererInterface::class, $renderer);
    }

    public function testShouldReturnProperStringByGivenData()
    {
        // Given
        $givenArray = array(
            array('id', 'price', 'sell_factor'),
            array('1ST_PRODUCT', 11.20, 1),
            array('2ND_PRODUCT', 14.50, 3),
            array('3RD_PRODUCT', 23.66, 5)
        );

        // When


        // Then
    }
}