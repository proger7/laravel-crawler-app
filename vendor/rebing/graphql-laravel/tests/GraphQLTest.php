<?php

use GraphQL\Error\Error;
use GraphQL\Type\Schema;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use Rebing\GraphQL\Error\ValidationError;

class GraphQLTest extends TestCase
{
    /**
     * Test schema default.
     *
     * @test
     */
    public function testSchema()
    {
        $schema = GraphQL::schema();

        $this->assertGraphQLSchema($schema);
        $this->assertGraphQLSchemaHasQuery($schema, 'examples');
        $this->assertGraphQLSchemaHasMutation($schema, 'updateExample');
        $this->assertArrayHasKey('Example', $schema->getTypeMap());
    }

    /**
     * Test schema with object.
     *
     * @test
     */
    public function testSchemaWithSchemaObject()
    {
        $schemaObject = new Schema([
            'query' => new ObjectType([
                'name' => 'Query',
            ]),
            'mutation' => new ObjectType([
                'name' => 'Mutation',
            ]),
            'types' => [],
        ]);
        $schema = GraphQL::schema($schemaObject);

        $this->assertGraphQLSchema($schema);
    }

    /**
     * Test schema with name.
     *
     * @test
     */
    public function testSchemaWithName()
    {
        $schema = GraphQL::schema('custom');

        $this->assertGraphQLSchema($schema);
        $this->assertGraphQLSchemaHasQuery($schema, 'examplesCustom');
        $this->assertGraphQLSchemaHasMutation($schema, 'updateExampleCustom');
        $this->assertArrayHasKey('Example', $schema->getTypeMap());
    }

    /**
     * Test schema custom.
     *
     * @test
     */
    public function testSchemaWithArray()
    {
        $schema = GraphQL::schema([
            'query' => [
                'examplesCustom' => ExamplesQuery::class,
            ],
            'mutation' => [
                'updateExampleCustom' => UpdateExampleMutation::class,
            ],
            'types' => [
                CustomExampleType::class,
            ],
        ]);

        $this->assertGraphQLSchema($schema);
        $this->assertGraphQLSchemaHasQuery($schema, 'examplesCustom');
        $this->assertGraphQLSchemaHasMutation($schema, 'updateExampleCustom');
        $this->assertArrayHasKey('CustomExample', $schema->getTypeMap());
    }

    /**
     * Test schema with wrong name.
     *
     * @test
     * @expectedException \Rebing\GraphQL\Exception\SchemaNotFound
     */
    public function testSchemaWithWrongName()
    {
        $schema = GraphQL::schema('wrong');
    }

    /**
     * Test type.
     *
     * @test
     */
    public function testType()
    {
        $type = GraphQL::type('Example');
        $this->assertInstanceOf(\GraphQL\Type\Definition\ObjectType::class, $type);

        $typeOther = GraphQL::type('Example');
        $this->assertTrue($type === $typeOther);

        $typeOther = GraphQL::type('Example', true);
        $this->assertFalse($type === $typeOther);
    }

    /**
     * Test wrong type.
     *
     * @test
     * @expectedException \Exception
     */
    public function testWrongType()
    {
        $typeWrong = GraphQL::type('ExampleWrong');
    }

    /**
     * Test objectType.
     *
     * @test
     */
    public function testObjectType()
    {
        $objectType = new ObjectType([
            'name' => 'ObjectType',
        ]);
        $type = GraphQL::objectType($objectType, [
            'name' => 'ExampleType',
        ]);

        $this->assertInstanceOf(\GraphQL\Type\Definition\ObjectType::class, $type);
        $this->assertEquals($objectType, $type);
        $this->assertEquals($type->name, 'ExampleType');
    }

    public function testObjectTypeFromFields()
    {
        $type = GraphQL::objectType([
            'test' => [
                'type'        => Type::string(),
                'description' => 'A test field',
            ],
        ], [
            'name' => 'ExampleType',
        ]);

        $this->assertInstanceOf(\GraphQL\Type\Definition\ObjectType::class, $type);
        $this->assertEquals($type->name, 'ExampleType');
        $fields = $type->getFields();
        $this->assertArrayHasKey('test', $fields);
    }

    public function testObjectTypeClass()
    {
        $type = GraphQL::objectType(ExampleType::class, [
            'name' => 'ExampleType',
        ]);

        $this->assertInstanceOf(\GraphQL\Type\Definition\ObjectType::class, $type);
        $this->assertEquals($type->name, 'ExampleType');
        $fields = $type->getFields();
        $this->assertArrayHasKey('test', $fields);
    }

    public function testFormatError()
    {
        $result = GraphQL::queryAndReturnResult($this->queries['examplesWithError']);
        $error = GraphQL::formatError($result->errors[0]);

        $this->assertInternalType('array', $error);
        $this->assertArrayHasKey('message', $error);
        $this->assertArrayHasKey('locations', $error);
        $expectedError = [
            'message' => 'Cannot query field "examplesQueryNotFound" on type "Query". Did you mean "examplesPagination"?',
            'extensions' => [
                'category' => 'graphql',
            ],
            'locations' => [
                [
                    'line'   => 3,
                    'column' => 13,
                ],
            ],
        ];
        $this->assertEquals($expectedError, $error);
    }

    public function testFormatValidationError()
    {
        $validator = Validator::make([], [
            'test' => 'required',
        ]);
        $validator->fails();
        $validationError = with(new ValidationError('validation'))->setValidator($validator);
        $error = new Error('error', null, null, null, null, $validationError);
        $error = GraphQL::formatError($error);

        $this->assertInternalType('array', $error);
        $this->assertArrayHasKey('validation', $error);
        $this->assertTrue($error['validation']->has('test'));
    }

    /**
     * Test add type.
     *
     * @test
     */
    public function testAddType()
    {
        GraphQL::addType(CustomExampleType::class);

        $types = GraphQL::getTypes();
        $this->assertArrayHasKey('CustomExample', $types);

        $type = app($types['CustomExample']);
        $this->assertInstanceOf(CustomExampleType::class, $type);

        $type = GraphQL::type('CustomExample');
        $this->assertInstanceOf(\GraphQL\Type\Definition\ObjectType::class, $type);
    }

    /**
     * Test add type with a name.
     *
     * @test
     */
    public function testAddTypeWithName()
    {
        GraphQL::addType(ExampleType::class, 'CustomExample');

        $types = GraphQL::getTypes();
        $this->assertArrayHasKey('CustomExample', $types);

        $type = app($types['CustomExample']);
        $this->assertInstanceOf(ExampleType::class, $type);

        $type = GraphQL::type('CustomExample');
        $this->assertInstanceOf(\GraphQL\Type\Definition\ObjectType::class, $type);
    }

    /**
     * Test get types.
     *
     * @test
     */
    public function testGetTypes()
    {
        $types = GraphQL::getTypes();
        $this->assertArrayHasKey('Example', $types);

        $type = app($types['Example']);
        $this->assertInstanceOf(\ExampleType::class, $type);
    }

    /**
     * Test add schema.
     *
     * @test
     */
    public function testAddSchema()
    {
        GraphQL::addSchema('custom_add', [
            'query'    => [
                'examplesCustom' => ExamplesQuery::class,
            ],
            'mutation' => [
                'updateExampleCustom' => UpdateExampleMutation::class,
            ],
            'types'    => [
                CustomExampleType::class,
            ],
        ]);

        $schemas = GraphQL::getSchemas();
        $this->assertArrayHasKey('custom_add', $schemas);
    }

    /**
     * Test merge schema.
     *
     * @test
     */
    public function testMergeSchema()
    {
        GraphQL::addSchema('custom_add', [
            'query'    => [
                'examplesCustom' => ExamplesQuery::class,
            ],
            'mutation' => [
                'updateExampleCustom' => UpdateExampleMutation::class,
            ],
            'types'    => [
                CustomExampleType::class,
            ],
        ]);

        GraphQL::addSchema('custom_add_another', [
            'query' => [
                'examplesCustom' => ExamplesQuery::class,
            ],
            'mutation' => [
                'updateExampleCustom' => UpdateExampleMutation::class,
            ],
            'types' => [
                CustomExampleType::class,
            ],
        ]);

        $schemas = GraphQL::getSchemas();
        $this->assertArrayHasKey('custom_add', $schemas);
        $this->assertArrayHasKey('custom_add_another', $schemas);

        GraphQL::addSchema('custom_add_another', [
            'query' => [
                'examplesCustomAnother' => ExamplesQuery::class,
            ],
        ]);

        $schemas = GraphQL::getSchemas();
        $this->assertArrayHasKey('custom_add_another', $schemas);

        $querys = $schemas['custom_add_another']['query'];
        $this->assertArrayHasKey('examplesCustom', $querys);
        $this->assertArrayHasKey('examplesCustomAnother', $querys);
    }

    /**
     * Test get schemas.
     *
     * @test
     */
    public function testGetSchemas()
    {
        $schemas = GraphQL::getSchemas();
        $this->assertArrayHasKey('default', $schemas);
        $this->assertArrayHasKey('custom', $schemas);
        $this->assertInternalType('array', $schemas['default']);
    }
}
