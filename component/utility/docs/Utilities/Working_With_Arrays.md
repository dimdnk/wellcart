# Array helper

--------------------------------------------------------

The array helper contains methods that can be useful when working with arrays.

--------------------------------------------------------

### Usage

The ```get``` method returns a value from an array using "dot notation".

    $array = ['foo' => ['bar' => 'baz']];

    $bar = Arr::get($array, 'foo.bar');

    // You can also specify a default value if the key doesn't exist

    $baz = Arr::get($array, 'foo.baz', 'nope');

The ```set``` method sets an array value using "dot notation".

    Arr::set($array, 'foo.baz', 'hello world');

The ```delete``` method deletes an array value using "dot notation".

    Arr::delete($array, 'foo.bar');

The ```random``` method returns a random array value.

    Arr::random(['green', 'blue', 'red', 'orange']);

The ```isAssoc``` method returns TRUE if the array is associative and FALSE if not.

    // $assoc will be set to FALSE

    $assoc = Arr::isAssoc([1, 2, 3]);

    // $assoc will be set to TRUE

    $assoc = Arr::isAssoc(['one' => 1, 'two' => 2, 'three' => 3]);

The ```pluck``` method returns the values from a single column of the input array, identified by the key.

    $fruits = 
    [
        ['name' => 'apple', 'color' => 'green'],
        ['name' => 'banana', 'color' => 'yellow'];
    ];

    $colors = Arr::pluck($fruits, 'color');

The ```divide``` function returns two arrays, one containing the keys, and the other containing the values of the original array.

    $array = array('foo' => 'bar');

    list($keys, $values) = Arr::divide($array);

The ```except``` method removes the given key / value pairs from the array.

    $array = Arr::except($array, array('keys', 'to', 'remove'));


The ```fetch``` method returns a flattened array containing the selected nested element.

    $array = array(
        array('developer' => array('name' => 'Taylor')),
        array('developer' => array('name' => 'Dayle')),
    );

    $array = Arr::fetch($array, 'developer.name');

    // array('Taylor', 'Dayle');

The ```only``` method will return only the specified key / value pairs from the array.

    $array = array('name' => 'Joe', 'age' => 27, 'votes' => 1);

    $array = Arr::only($array, array('name', 'votes'));

The ```first``` method returns the first element of an array passing a given truth test.

    $array = array(100, 200, 300);

    $value = Arr::first($array, function($key, $value)
    {
        return $value >= 150;
    });

A default value may also be passed as the third parameter:

    $value = Arr::first($array, $callback, $default);

The ```last``` method returns the last element of an array passing a given truth test.

    $array = array(350, 400, 500, 300, 200, 100);

    $value = Arr::last($array, function($key, $value)
    {
        return $value > 350;
    });

    // 500

A default value may also be passed as the third parameter:

    $value = Arr::last($array, $callback, $default);


The ```flatten``` method will flatten a multi-dimensional array into a single level.

    $array = array('name' => 'Joe', 'languages' => array('PHP', 'Ruby'));

    $array = Arr::flatten($array);

    // array('Joe', 'PHP', 'Ruby');


Filter the array using the given Closure.

    $array = array(100, '200', 300, '400', 500);

    $array = Arr::where($array, function($key, $value)
    {
        return is_string($value);
    });

    // Array ( [1] => 200 [3] => 400 )
