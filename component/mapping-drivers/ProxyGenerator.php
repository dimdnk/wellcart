<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\Common\Proxy;

use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\Common\Proxy\Exception\InvalidArgumentException;
use Doctrine\Common\Proxy\Exception\UnexpectedValueException;
use Doctrine\Common\Util\ClassUtils;

/**
 * This factory is used to generate proxy classes.
 * It builds proxies from given parameters, a template and class metadata.
 *
 * @author Marco Pivetta <ocramius@gmail.com>
 * @since  2.4
 */
class ProxyGenerator
{
    /**
     * Used to match very simple id methods that don't need
     * to be decorated since the identifier is known.
     */
    const PATTERN_MATCH_ID_METHOD = '((public\s+)?(function\s+%s\s*\(\)\s*)\s*(?::\s*\\\\?[a-z_\x7f-\xff][\w\x7f-\xff]*(?:\\\\[a-z_\x7f-\xff][\w\x7f-\xff]*)*\s*)?{\s*return\s*\$this->%s;\s*})i';
    /**
     * Map of callables used to fill in placeholders set in the template.
     *
     * @var string[]|callable[]
     */
    protected $placeholders
        = [
            'baseProxyInterface'   => Proxy::class,
            'additionalProperties' => '',
        ];
    /**
     * Template used as a blueprint to generate proxies.
     *
     * @var string
     */
    protected $proxyClassTemplate
        = '<?php

namespace <namespace>;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE\'S PROXY GENERATOR
 */
class <proxyShortClassName> extends \<className> implements \<baseProxyInterface>
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [<lazyPropertiesDefaults>];

<additionalProperties>

<constructorImpl>

<magicGet>

<magicSet>

<magicIsset>

<sleepImpl>

<wakeupImpl>

<cloneImpl>

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, \'__load\', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    <methods>
}
';
    /**
     * The namespace that contains all proxy classes.
     *
     * @var string
     */
    private $proxyNamespace;
    /**
     * The directory that contains all proxy classes.
     *
     * @var string
     */
    private $proxyDirectory;

    /**
     * Initializes a new instance of the <tt>ProxyFactory</tt> class that is
     * connected to the given <tt>EntityManager</tt>.
     *
     * @param string $proxyDirectory The directory to use for the proxy classes. It must exist.
     * @param string $proxyNamespace The namespace to use for the proxy classes.
     *
     * @throws InvalidArgumentException
     */
    public function __construct($proxyDirectory, $proxyNamespace)
    {
        if (!$proxyDirectory) {
            throw InvalidArgumentException::proxyDirectoryRequired();
        }

        if (!$proxyNamespace) {
            throw InvalidArgumentException::proxyNamespaceRequired();
        }

        $this->proxyDirectory = $proxyDirectory;
        $this->proxyNamespace = $proxyNamespace;
    }

    /**
     * Sets a placeholder to be replaced in the template.
     *
     * @param string          $name
     * @param string|callable $placeholder
     *
     * @throws InvalidArgumentException
     */
    public function setPlaceholder($name, $placeholder)
    {
        if (!is_string($placeholder) && !is_callable($placeholder)) {
            throw InvalidArgumentException::invalidPlaceholder($name);
        }

        $this->placeholders[$name] = $placeholder;
    }

    /**
     * Sets the base template used to create proxy classes.
     *
     * @param string $proxyClassTemplate
     */
    public function setProxyClassTemplate($proxyClassTemplate)
    {
        $this->proxyClassTemplate = (string)$proxyClassTemplate;
    }

    /**
     * Generates a proxy class file.
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class    Metadata for the original class.
     * @param string|bool                                        $fileName Filename (full path) for the generated class. If none is given, eval() is used.
     *
     * @throws UnexpectedValueException
     */
    public function generateProxyClass(ClassMetadata $class, $fileName = false)
    {
        preg_match_all(
            '(<([a-zA-Z]+)>)', $this->proxyClassTemplate, $placeholderMatches
        );

        $placeholderMatches = array_combine(
            $placeholderMatches[0], $placeholderMatches[1]
        );
        $placeholders = [];

        foreach ($placeholderMatches as $placeholder => $name) {
            $placeholders[$placeholder] = isset($this->placeholders[$name])
                ? $this->placeholders[$name]
                : [$this, 'generate' . $name];
        }

        foreach ($placeholders as & $placeholder) {
            if (is_callable($placeholder)) {
                $placeholder = call_user_func($placeholder, $class);
            }
        }

        $proxyCode = strtr($this->proxyClassTemplate, $placeholders);

        if (!$fileName) {
            $proxyClassName = $this->generateNamespace($class) . '\\'
                . $this->generateProxyShortClassName($class);

            if (!class_exists($proxyClassName)) {
                eval(substr($proxyCode, 5));
            }

            return;
        }

        $parentDirectory = dirname($fileName);

        if (!is_dir($parentDirectory)
            && (false === @mkdir(
                    $parentDirectory, 0775, true
                ))
        ) {
            throw UnexpectedValueException::proxyDirectoryNotWritable(
                $this->proxyDirectory
            );
        }

        if (!is_writable($parentDirectory)) {
            throw UnexpectedValueException::proxyDirectoryNotWritable(
                $this->proxyDirectory
            );
        }

        $tmpFileName = $fileName . '.' . uniqid('', true);

        file_put_contents($tmpFileName, $proxyCode);
        @chmod($tmpFileName, 0664);
        rename($tmpFileName, $fileName);
    }

    /**
     * Generates the proxy namespace.
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return string
     */
    private function generateNamespace(ClassMetadata $class)
    {
        $proxyClassName = ClassUtils::generateProxyClassName(
            $class->getName(), $this->proxyNamespace
        );
        $parts = explode('\\', strrev($proxyClassName), 2);

        return strrev($parts[1]);
    }

    /**
     * Generates the proxy short class name to be used in the template.
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return string
     */
    private function generateProxyShortClassName(ClassMetadata $class)
    {
        $proxyClassName = ClassUtils::generateProxyClassName(
            $class->getName(), $this->proxyNamespace
        );
        $parts = explode('\\', strrev($proxyClassName), 2);

        return strrev($parts[0]);
    }

    /**
     * Generates the Proxy file name.
     *
     * @param string $className
     * @param string $baseDirectory Optional base directory for proxy file name generation.
     *                              If not specified, the directory configured on the Configuration of the
     *                              EntityManager will be used by this factory.
     *
     * @return string
     */
    public function getProxyFileName($className, $baseDirectory = null)
    {
        $baseDirectory = $baseDirectory ?: $this->proxyDirectory;

        return rtrim($baseDirectory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR
        . Proxy::MARKER
        . str_replace('\\', '', $className) . '.php';
    }

    /**
     * Generates the original class name.
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return string
     */
    private function generateClassName(ClassMetadata $class)
    {
        return ltrim($class->getName(), '\\');
    }

    /**
     * Generates the array representation of lazy loaded public properties and their default values.
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return string
     */
    private function generateLazyPropertiesDefaults(ClassMetadata $class)
    {
        $lazyPublicProperties = $this->getLazyLoadedPublicProperties($class);
        $values = [];

        foreach ($lazyPublicProperties as $key => $value) {
            $values[] = var_export($key, true) . ' => ' . var_export(
                    $value, true
                );
        }

        return implode(', ', $values);
    }

    /**
     * Generates the list of public properties to be lazy loaded, with their default values.
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return mixed[]
     */
    private function getLazyLoadedPublicProperties(ClassMetadata $class)
    {
        $defaultProperties = $class->getReflectionClass()->getDefaultProperties(
        );
        $properties = [];

        foreach (
            $class->getReflectionClass()->getProperties(
                \ReflectionProperty::IS_PUBLIC
            ) as $property
        ) {
            $name = $property->getName();

            if (($class->hasField($name) || $class->hasAssociation($name))
                && !$class->isIdentifier($name)
            ) {
                $properties[$name] = $defaultProperties[$name];
            }
        }

        return $properties;
    }

    /**
     * Generates the constructor code (un-setting public lazy loaded properties, setting identifier field values).
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return string
     */
    private function generateConstructorImpl(ClassMetadata $class)
    {
        $constructorImpl
            = <<<'EOT'
    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

EOT;
        $toUnset = [];

        foreach (
            $this->getLazyLoadedPublicProperties($class) as $lazyPublicProperty
        => $unused
        ) {
            $toUnset[] = '$this->' . $lazyPublicProperty;
        }

        $constructorImpl .= (empty($toUnset)
                ? ''
                : '        unset(' . implode(
                    ', ', $toUnset
                ) . ");\n")
            . <<<'EOT'

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }
EOT;

        return $constructorImpl;
    }

    /**
     * Generates the magic getter invoked when lazy loaded public properties are requested.
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return string
     */
    private function generateMagicGet(ClassMetadata $class)
    {
        $lazyPublicProperties = array_keys(
            $this->getLazyLoadedPublicProperties($class)
        );
        $reflectionClass = $class->getReflectionClass();
        $hasParentGet = false;
        $returnReference = '';
        $inheritDoc = '';

        if ($reflectionClass->hasMethod('__get')) {
            $hasParentGet = true;
            $inheritDoc = '{@inheritDoc}';

            if ($reflectionClass->getMethod('__get')->returnsReference()) {
                $returnReference = '& ';
            }
        }

        if (empty($lazyPublicProperties) && !$hasParentGet) {
            return '';
        }

        $magicGet
            = <<<EOT
    /**
     * $inheritDoc
     * @param string \$name
     */
    public function {$returnReference}__get(\$name)
    {

EOT;

        if (!empty($lazyPublicProperties)) {
            $magicGet
                .= <<<'EOT'
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__get', [$name]);

            return $this->$name;
        }


EOT;
        }

        if ($hasParentGet) {
            $magicGet
                .= <<<'EOT'
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__get', [$name]);

        return parent::__get($name);

EOT;
        } else {
            $magicGet
                .= <<<'EOT'
        trigger_error(sprintf('Undefined property: %s::$%s', __CLASS__, $name), E_USER_NOTICE);

EOT;
        }

        $magicGet .= "    }";

        return $magicGet;
    }

    /**
     * Generates the magic setter (currently unused).
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return string
     */
    private function generateMagicSet(ClassMetadata $class)
    {
        $lazyPublicProperties = $this->getLazyLoadedPublicProperties($class);
        $hasParentSet = $class->getReflectionClass()->hasMethod('__set');

        if (empty($lazyPublicProperties) && !$hasParentSet) {
            return '';
        }

        $inheritDoc = $hasParentSet ? '{@inheritDoc}' : '';
        $magicSet
            = <<<EOT
    /**
     * $inheritDoc
     * @param string \$name
     * @param mixed  \$value
     */
    public function __set(\$name, \$value)
    {

EOT;

        if (!empty($lazyPublicProperties)) {
            $magicSet
                .= <<<'EOT'
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__set', [$name, $value]);

            $this->$name = $value;

            return;
        }


EOT;
        }

        if ($hasParentSet) {
            $magicSet
                .= <<<'EOT'
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__set', [$name, $value]);

        return parent::__set($name, $value);
EOT;
        } else {
            $magicSet .= "        \$this->\$name = \$value;";
        }

        $magicSet .= "\n    }";

        return $magicSet;
    }

    /**
     * Generates the magic issetter invoked when lazy loaded public properties are checked against isset().
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return string
     */
    private function generateMagicIsset(ClassMetadata $class)
    {
        $lazyPublicProperties = array_keys(
            $this->getLazyLoadedPublicProperties($class)
        );
        $hasParentIsset = $class->getReflectionClass()->hasMethod('__isset');

        if (empty($lazyPublicProperties) && !$hasParentIsset) {
            return '';
        }

        $inheritDoc = $hasParentIsset ? '{@inheritDoc}' : '';
        $magicIsset
            = <<<EOT
    /**
     * $inheritDoc
     * @param  string \$name
     * @return boolean
     */
    public function __isset(\$name)
    {

EOT;

        if (!empty($lazyPublicProperties)) {
            $magicIsset
                .= <<<'EOT'
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__isset', [$name]);

            return isset($this->$name);
        }


EOT;
        }

        if ($hasParentIsset) {
            $magicIsset
                .= <<<'EOT'
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__isset', [$name]);

        return parent::__isset($name);

EOT;
        } else {
            $magicIsset .= "        return false;";
        }

        return $magicIsset . "\n    }";
    }

    /**
     * Generates implementation for the `__sleep` method of proxies.
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return string
     */
    private function generateSleepImpl(ClassMetadata $class)
    {
        $hasParentSleep = $class->getReflectionClass()->hasMethod('__sleep');
        $inheritDoc = $hasParentSleep ? '{@inheritDoc}' : '';
        $sleepImpl
            = <<<EOT
    /**
     * $inheritDoc
     * @return array
     */
    public function __sleep()
    {

EOT;

        if ($hasParentSleep) {
            return $sleepImpl . <<<'EOT'
        $properties = array_merge(['__isInitialized__'], parent::__sleep());

        if ($this->__isInitialized__) {
            $properties = array_diff($properties, array_keys($this->__getLazyProperties()));
        }

        return $properties;
    }
EOT;
        }

        $allProperties = ['__isInitialized__'];

        /* @var $prop \ReflectionProperty */
        foreach ($class->getReflectionClass()->getProperties() as $prop) {
            if ($prop->isStatic()) {
                continue;
            }

            $allProperties[] = $prop->isPrivate()
                ? "\0" . $prop->getDeclaringClass()->getName() . "\0"
                . $prop->getName()
                : $prop->getName();
        }

        $lazyPublicProperties = array_keys(
            $this->getLazyLoadedPublicProperties($class)
        );
        $protectedProperties = array_diff(
            $allProperties, $lazyPublicProperties
        );

        foreach ($allProperties as &$property) {
            $property = var_export($property, true);
        }

        foreach ($protectedProperties as &$property) {
            $property = var_export($property, true);
        }

        $allProperties = implode(', ', $allProperties);
        $protectedProperties = implode(', ', $protectedProperties);

        return $sleepImpl . <<<EOT
        if (\$this->__isInitialized__) {
            return [$allProperties];
        }

        return [$protectedProperties];
    }
EOT;
    }

    /**
     * Generates implementation for the `__wakeup` method of proxies.
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return string
     */
    private function generateWakeupImpl(ClassMetadata $class)
    {
        $unsetPublicProperties = [];
        $hasWakeup = $class->getReflectionClass()->hasMethod('__wakeup');

        foreach (
            array_keys($this->getLazyLoadedPublicProperties($class)) as
            $lazyPublicProperty
        ) {
            $unsetPublicProperties[] = '$this->' . $lazyPublicProperty;
        }

        $shortName = $this->generateProxyShortClassName($class);
        $inheritDoc = $hasWakeup ? '{@inheritDoc}' : '';
        $wakeupImpl
            = <<<EOT
    /**
     * $inheritDoc
     */
    public function __wakeup()
    {
        if ( ! \$this->__isInitialized__) {
            \$this->__initializer__ = function ($shortName \$proxy) {
                \$proxy->__setInitializer(null);
                \$proxy->__setCloner(null);

                \$existingProperties = get_object_vars(\$proxy);

                foreach (\$proxy->__getLazyProperties() as \$property => \$defaultValue) {
                    if ( ! array_key_exists(\$property, \$existingProperties)) {
                        \$proxy->\$property = \$defaultValue;
                    }
                }
            };

EOT;

        if (!empty($unsetPublicProperties)) {
            $wakeupImpl .= "\n            unset(" . implode(
                    ', ', $unsetPublicProperties
                ) . ");";
        }

        $wakeupImpl .= "\n        }";

        if ($hasWakeup) {
            $wakeupImpl .= "\n        parent::__wakeup();";
        }

        $wakeupImpl .= "\n    }";

        return $wakeupImpl;
    }

    /**
     * Generates implementation for the `__clone` method of proxies.
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return string
     */
    private function generateCloneImpl(ClassMetadata $class)
    {
        $hasParentClone = $class->getReflectionClass()->hasMethod('__clone');
        $inheritDoc = $hasParentClone ? '{@inheritDoc}' : '';
        $callParentClone = $hasParentClone ? "\n        parent::__clone();\n"
            : '';

        return <<<EOT
    /**
     * $inheritDoc
     */
    public function __clone()
    {
        \$this->__cloner__ && \$this->__cloner__->__invoke(\$this, '__clone', []);
$callParentClone    }
EOT;
    }

    /**
     * Generates decorated methods by picking those available in the parent class.
     *
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return string
     */
    private function generateMethods(ClassMetadata $class)
    {
        $methods = '';
        $methodNames = [];
        $reflectionMethods = $class->getReflectionClass()->getMethods(
            \ReflectionMethod::IS_PUBLIC
        );
        $skippedMethods = [
            '__sleep'  => true,
            '__clone'  => true,
            '__wakeup' => true,
            '__get'    => true,
            '__set'    => true,
            '__isset'  => true,
        ];

        foreach ($reflectionMethods as $method) {
            $name = $method->getName();

            if (
                $method->isConstructor()
                || isset($skippedMethods[strtolower(
                        $name
                    )])
                || isset($methodNames[$name])
                || $method->isFinal()
                || $method->isStatic()
                || (!$method->isPublic())
            ) {
                continue;
            }

            $methodNames[$name] = true;
            $methods .= "\n    /**\n"
                . "     * {@inheritDoc}\n"
                . "     */\n"
                . '    public function ';

            if ($method->returnsReference()) {
                $methods .= '&';
            }

            $methods .= $name . '(' . $this->buildParametersString(
                    $class, $method, $method->getParameters()
                ) . ')';
            $methods .= $this->getMethodReturnType($method);
            $methods .= "\n" . '    {' . "\n";

            if ($this->isShortIdentifierGetter($method, $class)) {
                $identifier = lcfirst(substr($name, 3));
                $fieldType = $class->getTypeOfField($identifier);
                $cast = in_array($fieldType, ['integer', 'smallint']) ? '(int) '
                    : '';

                $methods .= '        if ($this->__isInitialized__ === false) {'
                    . "\n";
                $methods .= '            return ' . $cast . ' parent::'
                    . $method->getName() . "();\n";
                $methods .= '        }' . "\n\n";
            }

            $invokeParamsString = implode(
                ', ',
                $this->getParameterNamesForInvoke($method->getParameters())
            );
            $callParamsString = implode(
                ', ',
                $this->getParameterNamesForParentCall($method->getParameters())
            );

            $methods .= "\n        \$this->__initializer__ "
                . "&& \$this->__initializer__->__invoke(\$this, " . var_export(
                    $name, true
                )
                . ", [" . $invokeParamsString . "]);"
                . "\n\n        return parent::" . $name . '('
                . $callParamsString . ');'
                . "\n" . '    }' . "\n";
        }

        return $methods;
    }

    /**
     * @param ClassMetadata          $class
     * @param \ReflectionMethod      $method
     * @param \ReflectionParameter[] $parameters
     *
     * @return string
     */
    private function buildParametersString(ClassMetadata $class,
        \ReflectionMethod $method, array $parameters
    ) {
        $parameterDefinitions = [];

        /* @var $param \ReflectionParameter */
        foreach ($parameters as $param) {
            $parameterDefinition = '';

            if ($parameterType = $this->getParameterType(
                $class, $method, $param
            )
            ) {
                $parameterDefinition .= $parameterType . ' ';
            }

            if ($param->isPassedByReference()) {
                $parameterDefinition .= '&';
            }

            if (method_exists($param, 'isVariadic') && $param->isVariadic()) {
                $parameterDefinition .= '...';
            }

            $parameters[] = '$' . $param->getName();
            $parameterDefinition .= '$' . $param->getName();

            if ($param->isDefaultValueAvailable()) {
                $parameterDefinition .= ' = ' . var_export(
                        $param->getDefaultValue(), true
                    );
            }

            $parameterDefinitions[] = $parameterDefinition;
        }

        return implode(', ', $parameterDefinitions);
    }

    /**
     * @param ClassMetadata        $class
     * @param \ReflectionMethod    $method
     * @param \ReflectionParameter $parameter
     *
     * @return string|null
     */
    private function getParameterType(ClassMetadata $class,
        \ReflectionMethod $method, \ReflectionParameter $parameter
    ) {

        // We need to pick the type hint class too
        if ($parameter->isArray()) {
            return 'array';
        }

        if ($parameter->isCallable()) {
            return 'callable';
        }

        if (method_exists($parameter, 'hasType') && $parameter->hasType()
            && $parameter->getType()->isBuiltin()
        ) {
            return (string)$parameter->getType();
        }

        try {
            $parameterClass = $parameter->getClass();

            if ($parameterClass) {
                return '\\' . $parameterClass->getName();
            }
        } catch (\ReflectionException $previous) {
            throw UnexpectedValueException::invalidParameterTypeHint(
                $class->getName(),
                $method->getName(),
                $parameter->getName(),
                $previous
            );
        }

        return null;
    }

    /**
     * @Param \ReflectionMethod $method
     *
     * @return string
     */
    private function getMethodReturnType(\ReflectionMethod $method)
    {
        if (!(method_exists($method, 'hasReturnType')
            && $method->hasReturnType())
        ) {
            return '';
        }

        $returnType = $method->getReturnType();

        if ($returnType->isBuiltin()) {
            return ': ' . $returnType;
        }

        $nameLower = strtolower((string)$returnType);

        if ('self' === $nameLower) {
            return ': \\' . $method->getDeclaringClass()->getName();
        }

        if ('parent' === $nameLower) {
            return ': \\' . $method->getDeclaringClass()->getParentClass()
                ->getName();
        }

        return ': \\' . (string)$returnType;
    }

    /**
     * Checks if the method is a short identifier getter.
     *
     * What does this mean? For proxy objects the identifier is already known,
     * however accessing the getter for this identifier usually triggers the
     * lazy loading, leading to a query that may not be necessary if only the
     * ID is interesting for the userland code (for example in views that
     * generate links to the entity, but do not display anything else).
     *
     * @param \ReflectionMethod                                  $method
     * @param \Doctrine\Common\Persistence\Mapping\ClassMetadata $class
     *
     * @return boolean
     */
    private function isShortIdentifierGetter($method, ClassMetadata $class)
    {
        $identifier = lcfirst(substr($method->getName(), 3));
        $startLine = $method->getStartLine();
        $endLine = $method->getEndLine();
        $cheapCheck = (
            $method->getNumberOfParameters() == 0
            && substr($method->getName(), 0, 3) == 'get'
            && in_array($identifier, $class->getIdentifier(), true)
            && $class->hasField($identifier)
            && (($endLine - $startLine) <= 4)
        );

        if ($cheapCheck) {
            $code = file($method->getDeclaringClass()->getFileName());
            $code = trim(
                implode(
                    ' ', array_slice(
                        $code, $startLine - 1, $endLine - $startLine + 1
                    )
                )
            );

            $pattern = sprintf(
                self::PATTERN_MATCH_ID_METHOD, $method->getName(), $identifier
            );

            if (preg_match($pattern, $code)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param \ReflectionParameter[] $parameters
     *
     * @return string[]
     */
    private function getParameterNamesForInvoke(array $parameters)
    {
        return array_map(
            function (\ReflectionParameter $parameter) {
                return '$' . $parameter->getName();
            },
            $parameters
        );
    }

    /**
     * @param \ReflectionParameter[] $parameters
     *
     * @return string[]
     */
    private function getParameterNamesForParentCall(array $parameters)
    {
        return array_map(
            function (\ReflectionParameter $parameter) {
                $name = '';

                if (method_exists($parameter, 'isVariadic')
                    && $parameter->isVariadic()
                ) {
                    $name .= '...';
                }

                $name .= '$' . $parameter->getName();

                return $name;
            },
            $parameters
        );
    }
}
