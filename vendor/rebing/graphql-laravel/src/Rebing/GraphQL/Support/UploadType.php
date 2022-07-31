<?php

namespace Rebing\GraphQL\Support;

use GraphQL\Error\Error;
use GraphQL\Error\InvariantViolation;
use GraphQL\Type\Definition\ScalarType;

class UploadType extends ScalarType
{
    /**
     * @var string
     */
    public $name = 'Upload';
    /**
     * @var string
     */
    public $description =
        'The `Upload` special type represents a file to be uploaded in the same HTTP request as specified by
 [graphql-multipart-request-spec](https://github.com/jaydenseric/graphql-multipart-request-spec).';

    public function __construct($name = 'Upload')
    {
        $this->name = $name;

        parent::__construct();
    }

    /**
     * Serializes an internal value to include in a response.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function serialize($value)
    {
        throw new InvariantViolation('`Upload` cannot be serialized');
    }

    /**
     * Parses an externally provided value (query variable) to use as an input.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function parseValue($value)
    {
        return $value;
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input.
     *
     * @param \GraphQL\Language\AST\Node $valueNode
     *
     * @return mixed
     */
    public function parseLiteral($valueNode, ?array $variables = null)
    {
        throw new Error('`Upload` cannot be hardcoded in query, be sure to conform to GraphQL multipart request specification. Instead got: '.$valueNode->kind, [$valueNode]);
    }

    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }

        return $inst;
    }
}
