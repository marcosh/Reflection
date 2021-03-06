<?php
/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2010-2015 Mike van Riel<mike@phpdoc.org>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Reflection\Php;

use \Mockery as m;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\Fqsen;

/**
 * Tests the functionality for the Trait_ class.
 * @coversDefaultClass phpDocumentor\Reflection\Php\Trait_
 */
// @codingStandardsIgnoreStart
class Trait_Test extends \PHPUnit_Framework_TestCase
// @codingStandardsIgnoreEnd
{
    /** @var Trait_ $fixture */
    protected $fixture;

    /**
     * @var Fqsen
     */
    private $fqsen;

    /**
     * @var DocBlock
     */
    private $docBlock;

    /**
     * Creates a new (empty) fixture object.
     */
    protected function setUp()
    {
        $this->fqsen = new Fqsen('\MyTrait');
        $this->docBlock = new DocBlock('');
        $this->fixture = new Trait_($this->fqsen, $this->docBlock);

    }

    /**
     * @covers ::getFqsen
     * @covers ::getName
     * @covers ::__construct
     */
    public function testGetFqsenAndGetName()
    {
        $this->assertSame($this->fqsen, $this->fixture->getFqsen());
        $this->assertEquals($this->fqsen->getName(), $this->fixture->getName());
    }

    /**
     * @covers ::addProperty
     * @covers ::getProperties
     */
    public function testAddAndGettingProperties()
    {
        $this->assertEquals(array(), $this->fixture->getProperties());

        $property = new Property(new Fqsen('\MyTrait::$myProperty'));

        $this->fixture->addProperty($property);

        $this->assertEquals(array('\MyTrait::$myProperty' => $property), $this->fixture->getProperties());
    }

    /**
     * @covers ::addMethod
     * @covers ::getMethods
     */
    public function testAddAndGettingMethods()
    {
        $this->assertEquals(array(), $this->fixture->getMethods());

        $method = new Method(new Fqsen('\MyTrait::myMethod()'));

        $this->fixture->addMethod($method);

        $this->assertEquals(array('\MyTrait::myMethod()' => $method), $this->fixture->getMethods());
    }

    /**
     * @covers ::getUsedTraits
     * @covers ::AddUsedTrait
     */
    public function testAddAndGettingUsedTrait()
    {
        $this->assertEmpty($this->fixture->getUsedTraits());

        $trait = new Fqsen('\MyTrait');

        $this->fixture->addUsedTrait($trait);

        $this->assertSame(array('\MyTrait' => $trait), $this->fixture->getUsedTraits());
    }

    /**
     * @covers ::__construct
     * @covers ::getDocBlock
     */
    public function testGetDocblock()
    {
        $this->assertSame($this->docBlock, $this->fixture->getDocBlock());
    }
}
