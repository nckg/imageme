<?php namespace Nckg\ImageMe;

use Illuminate\Support\Collection;

class Request
{
    /**#@+
     * Available options
     */
    const REQUEST_PARAM_WIDTH = 'w';
    const REQUEST_PARAM_HEIGHT = 'h';
    const REQUEST_PARAM_FIT = 'f';
    const REQUEST_PARAM_QUALITY = 'q';
    const REQUEST_PARAM_CROP = 'c';
    /**#@-*/

    /**
     * A list of available options and the transformers that come
     * with it
     *
     * @var array
     */
    protected $chalkList = array(
        self::REQUEST_PARAM_WIDTH   => '\Nckg\ImageMe\Transformers\Resize',
        self::REQUEST_PARAM_HEIGHT  => '\Nckg\ImageMe\Transformers\Resize',
    );

    /**
     * Parse parameters and return the altering classes
     *
     * @param  mixed $parameters
     * @return \Illuminate\Support\Collection
     */
    public function parse($parameters)
    {
        // Fetch parameters. If the variable is an array nothing will happen.
        // If it's a string, it will be tokenized and will return as an array.
        $params = $this->getParameters($parameters);


        $collection = new Collection;

        foreach ($params as $token => $value) {
            // create the manipulator
            $manipulator = $this->createManipulator($token);
            $className = get_class($manipulator);

            // get the classname
            if ($collection->has($className)) {
                $manipulator = $collection->get($className);
            }

            // set values
            if ($token === self::REQUEST_PARAM_WIDTH) {
                $manipulator->setWidth($value);
            } elseif ($token === self::REQUEST_PARAM_HEIGHT) {
                $manipulator->setHeight($value);
            }

            // put in the colllection
            $collection->put($className, $manipulator);
        }

        return $collection;
    }

    /**
     * Return parameters
     *
     * @param  mixed $parameters
     * @return array
     */
    private function getParameters($parameters)
    {
        if (is_array($parameters)) {
            return $parameters;
        }

        return $this->tokenize($parameters);
    }

    /**
     * Tokenizes a string into an parameter array
     *
     * @param  string $string
     * @return array
     */
    private function tokenize($string)
    {
        $params = array();

        // tokenize the first set
        $param = strtok($string, '-');

        // loopedyloop
        while ($param !== false) {
            if (strlen($param) > 1) {
                // The name of each parameter should be the first
                // character of the parameter string and the value of
                // each parameter should be the remaining characters
                // of the parameter string
                $params[$param[0]] = substr($param, 1);
            }

            $param = strtok('-');
        }

        return $params;
    }

    /**
     * Creates a type
     *
     * @param string $type a known type key
     *
     * @return \Nckg\ImageMe\Chalk\ChalkInterface a new instance of ChalkInterface
     * @throws \InvalidArgumentException
     */
    public function createManipulator($type)
    {
        // Throw an error if the item doesn't exist inside the chalklist.
        if ( ! array_key_exists($type, $this->chalkList)) {
            throw new \InvalidArgumentException("$type is not valid transformer");
        }

        $className = $this->chalkList[$type];

        return new $className;
    }
}