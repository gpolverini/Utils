<?php

namespace Utils;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Utils\Collections\InvalidTypedCollection;

/**
 * @author Gabriel Polverini <polverini.gabriel@gmail.com>
 */
class TypedCollectionTest extends TestCase
{
    const INSTANCE_MODEL = 'Utils\TestModel';
    /**
     * @test
     */
    public function testInvalidArgumentException()
    {
        try {
            $ret = new InvalidTypedCollection();
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof \InvalidArgumentException);
        }
    }

    /**
     * @test
     */
    public function testInstance()
    {
        $model = new TestModelCollection();

        $this->assertTrue($model instanceof TestModelCollection);

        return $model;
    }

    /**
     * @test
     */
    public function testCount()
    {
        $model = new TestModelCollection();

        $this->assertTrue($model->count() === 0);

        $model[] = $this->getMockForAbstractClass(self::INSTANCE_MODEL);

        $this->assertTrue($model->count() === 1);
    }

    /**
     * @test
     */
    public function testCurrent()
    {
        $model = new TestModelCollection();

        $this->assertFalse($model->current());

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;
        $data2 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data2->setPropertyOne('Two');
        $model[] = $data2;

        $this->assertEquals($data1, $model->current());
        $model->next();
        $this->assertEquals($data2, $model->current());
    }

    /**
     * @test
     */
    public function testKey()
    {
        $model = new TestModelCollection();

        $this->assertNull($model->key());

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;
        $data2 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data2->setPropertyOne('Two');
        $model[] = $data2;

        $this->assertEquals(0, $model->key());
        $model->next();
        $this->assertEquals(1, $model->key());
    }

    /**
     * @test
     */
    public function testNext()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;
        $data2 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data2->setPropertyOne('Two');
        $model[] = $data2;

        $this->assertEquals($data1, $model->current());
        $model->next();
        $this->assertEquals($data2, $model->current());
    }

    /**
     * @test
     */
    public function testRewind()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;
        $data2 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data2->setPropertyOne('Two');
        $model[] = $data2;

        $this->assertEquals($data1, $model->current());
        $model->next();
        $this->assertEquals($data2, $model->current());
        $model->rewind();
        $this->assertEquals($data1, $model->current());
    }

    /**
     * @test
     */
    public function testValid()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;

        $this->assertTrue($model->valid());
    }

    /**
     * @test
     */
    public function testOffsetExists()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $model[] = $data1;

        $this->assertTrue($model->offsetExists(0));
        $this->assertFalse($model->offsetExists(1));
    }

    /**
     * @test
     */
    public function testOffsetGet()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $model[] = $data1;

        $this->assertEquals($data1, $model->offsetGet(0));
        $this->assertNull($model->offsetGet(1));
    }

    /**
     * @test
     */
    public function testOffsetSetInvalidArgumentException()
    {
        $model = new TestModelCollection();

        $data = $this->getMockForAbstractClass('\StdClass');

        try {
            $model->offsetSet(0, $data);
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof \InvalidArgumentException);
        }
    }

    /**
     * @test
     */
    public function testOffsetSetNullOffset()
    {
        $model = new TestModelCollection();

        $data = $this->getMockForAbstractClass(self::INSTANCE_MODEL);

        $model->offsetSet(null, $data);

        $this->assertEquals($data, $model[0]);
    }

    /**
     * @test
     */
    public function testOffsetSet()
    {
        $model = new TestModelCollection();

        $data = $this->getMockForAbstractClass(self::INSTANCE_MODEL);

        $model->offsetSet(0, $data);

        $this->assertEquals($data, $model[0]);
    }

    /**
     * @test
     */
    public function testOffsetUnset()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $model[] = $data1;

        $this->assertEquals(1, count($model));
        $model->offsetUnset(0);
        $this->assertEquals(0, count($model));
    }

    /**
     * @test
     */
    public function testAdd()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);

        $this->assertEquals(0, count($model));
        $model->add($data1);
        $this->assertEquals($data1, $model[0]);
    }

    /**
     * @test
     */
    public function testClear()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $model[] = $data1;

        $this->assertEquals(1, count($model));
        $this->assertEquals($data1, $model[0]);
        $model->clear();
        $this->assertEquals(0, count($model));
    }

    /**
     * @test
     */
    public function testContains()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;
        $data2 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data2->setPropertyOne('Two');

        $this->assertTrue($model->contains($data1));
        $this->assertFalse($model->contains($data2));
    }

    /**
     * @test
     */
    public function testIndexOf()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;
        $data2 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data2->setPropertyOne('Two');

        $this->assertEquals(0, $model->indexOf($data1));
        $this->assertFalse($model->indexOf($data2));
    }

    /**
     * @test
     *
     * @expectedException \OutOfRangeException
     */
    public function testInsertOutOfRangeException()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;
        $data2 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data2->setPropertyOne('Two');
        $model[] = $data2;
        $data3 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data3->setPropertyOne('Three');

        $model->insert(2, $data3);
    }

    /**
     * @test
     */
    public function testInsertInvalidArgumentException()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;

        $data2 = $this->getMockForAbstractClass('\StdClass');

        try {
            $model->insert(0, $data2);
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof \InvalidArgumentException);
        }
    }

    /**
     * @test
     */
    public function testInsert()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;
        $data2 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data2->setPropertyOne('Two');
        $model[] = $data2;
        $data3 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data3->setPropertyOne('Three');

        $model->insert(0, $data3);

        $this->assertEquals($data3, $model[0]);
    }

    /**
     * @test
     */
    public function testRemove()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;
        $data2 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data2->setPropertyOne('Two');
        $model[] = $data2;

        $this->assertEquals(2, count($model));
        $this->assertEquals($data1, $model[0]);
        $model->remove($data1);
        $this->assertEquals(1, count($model));
        $this->assertEquals($data2, $model[0]);
    }

    /**
     * @test
     */
    public function testRemoveAt()
    {
        $model = new TestModelCollection();

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;
        $data2 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data2->setPropertyOne('Two');
        $model[] = $data2;

        $this->assertEquals(2, count($model));
        $this->assertEquals($data1, $model[0]);
        $model->removeAt(0);
        $this->assertEquals(1, count($model));
        $this->assertEquals($data2, $model[0]);
    }

    /**
     * @test
     */
    public function testToArray()
    {
        $model = new TestModelCollection();

        $this->assertEquals(0, count($model->toArray()));

        $data1 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data1->setPropertyOne('One');
        $model[] = $data1;
        $data2 = $this->getMockForAbstractClass(self::INSTANCE_MODEL);
        $data2->setPropertyOne('Two');
        $model[] = $data2;

        $this->assertEquals(2, count($model->toArray()));
    }
}