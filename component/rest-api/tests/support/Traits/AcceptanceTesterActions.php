<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2016 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
namespace WellCart\RestApi\Test\Traits;

trait AcceptanceTesterActions
{
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Alias to `haveHttpHeader`
     *
     * @param $name
     * @param $value
     *
     * @see \Codeception\Module\PhpBrowser::setHeader()
     */
    public function setHeader($name, $value)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('setHeader', func_get_args())
        );
    }

    /**
     * @return \Codeception\Scenario
     */
    abstract protected function getScenario();

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Authenticates user for HTTP_AUTH
     *
     * @param $username
     * @param $password
     *
     * @see \Codeception\Module\PhpBrowser::amHttpAuthenticated()
     */
    public function amHttpAuthenticated($username, $password)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Condition(
                'amHttpAuthenticated', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Open web page at the given absolute URL and sets its hostname as the base host.
     *
     * ``` php
     * <?php
     * $I->amOnUrl('http://codeception.com');
     * $I->amOnPage('/quickstart'); // moves to http://codeception.com/quickstart
     * ?>
     * ```
     *
     * @see \Codeception\Module\PhpBrowser::amOnUrl()
     */
    public function amOnUrl($url)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Condition('amOnUrl', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Changes the subdomain for the 'url' configuration parameter.
     * Does not open a page; use `amOnPage` for that.
     *
     * ``` php
     * <?php
     * // If config is: 'http://mysite.com'
     * // or config is: 'http://www.mysite.com'
     * // or config is: 'http://company.mysite.com'
     *
     * $I->amOnSubdomain('user');
     * $I->amOnPage('/');
     * // moves to http://user.mysite.com/
     * ?>
     * ```
     *
     * @param $subdomain
     *
     * @return mixed
     * @see \Codeception\Module\PhpBrowser::amOnSubdomain()
     */
    public function amOnSubdomain($subdomain)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Condition('amOnSubdomain', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Low-level API method.
     * If Codeception commands are not enough, use [Guzzle HTTP Client](http://guzzlephp.org/) methods directly
     *
     * Example:
     *
     * ``` php
     * <?php
     * $I->executeInGuzzle(function (\GuzzleHttp\Client $client) {
     *      $client->get('/get', ['query' => ['foo' => 'bar']]);
     * });
     * ?>
     * ```
     *
     * It is not recommended to use this command on a regular basis.
     * If Codeception lacks important Guzzle Client methods, implement them and submit patches.
     *
     * @param callable $function
     *
     * @see \Codeception\Module\PhpBrowser::executeInGuzzle()
     */
    public function executeInGuzzle($function)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('executeInGuzzle', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Sets the HTTP header to the passed value - which is used on
     * subsequent HTTP requests through PhpBrowser.
     *
     * Example:
     * ```php
     * <?php
     * $I->setHeader('X-Requested-With', 'Codeception');
     * $I->amOnPage('test-headers.php');
     * ?>
     * ```
     *
     * @param string $name  the name of the request header
     * @param string $value the value to set it to for subsequent
     *                      requests
     *
     * @see \Codeception\Lib\InnerBrowser::haveHttpHeader()
     */
    public function haveHttpHeader($name, $value)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('haveHttpHeader', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Deletes the header with the passed name.  Subsequent requests
     * will not have the deleted header in its request.
     *
     * Example:
     * ```php
     * <?php
     * $I->haveHttpHeader('X-Requested-With', 'Codeception');
     * $I->amOnPage('test-headers.php');
     * // ...
     * $I->deleteHeader('X-Requested-With');
     * $I->amOnPage('some-other-page.php');
     * ?>
     * ```
     *
     * @param string $name the name of the header to delete.
     *
     * @see \Codeception\Lib\InnerBrowser::deleteHeader()
     */
    public function deleteHeader($name)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('deleteHeader', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Opens the page for the given relative URI.
     *
     * ``` php
     * <?php
     * // opens front page
     * $I->amOnPage('/');
     * // opens /register page
     * $I->amOnPage('/register');
     * ```
     *
     * @param $page
     *
     * @see \Codeception\Lib\InnerBrowser::amOnPage()
     */
    public function amOnPage($page)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Condition('amOnPage', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Perform a click on a link or a button, given by a locator.
     * If a fuzzy locator is given, the page will be searched for a button, link, or image matching the locator string.
     * For buttons, the "value" attribute, "name" attribute, and inner text are searched.
     * For links, the link text is searched.
     * For images, the "alt" attribute and inner text of any parent links are searched.
     *
     * The second parameter is a context (CSS or XPath locator) to narrow the search.
     *
     * Note that if the locator matches a button of type `submit`, the form will be submitted.
     *
     * ``` php
     * <?php
     * // simple link
     * $I->click('Logout');
     * // button of form
     * $I->click('Submit');
     * // CSS button
     * $I->click('#form input[type=submit]');
     * // XPath
     * $I->click('//form/*[@type=submit]');
     * // link in context
     * $I->click('Logout', '#nav');
     * // using strict locator
     * $I->click(['link' => 'Login']);
     * ?>
     * ```
     *
     * @param $link
     * @param $context
     *
     * @see \Codeception\Lib\InnerBrowser::click()
     */
    public function click($link, $context = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('click', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current page contains the given string (case insensitive).
     *
     * You can specify a specific HTML element (via CSS or XPath) as the second
     * parameter to only search within that element.
     *
     * ``` php
     * <?php
     * $I->see('Logout');                 // I can suppose user is logged in
     * $I->see('Sign Up', 'h1');          // I can suppose it's a signup page
     * $I->see('Sign Up', '//body/h1');   // with XPath
     * ```
     *
     * Note that the search is done after stripping all HTML tags from the body,
     * so `$I->see('strong')` will return true for strings like:
     *
     *   - `<p>I am Stronger than thou</p>`
     *   - `<script>document.createElement('strong');</script>`
     *
     * But will *not* be true for strings like:
     *
     *   - `<strong>Home</strong>`
     *   - `<div class="strong">Home</strong>`
     *   - `<!-- strong -->`
     *
     * For checking the raw source code, use `seeInSource()`.
     *
     * @param      $text
     * @param null $selector
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::see()
     */
    public function canSee($text, $selector = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion('see', func_get_args())
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current page contains the given string (case insensitive).
     *
     * You can specify a specific HTML element (via CSS or XPath) as the second
     * parameter to only search within that element.
     *
     * ``` php
     * <?php
     * $I->see('Logout');                 // I can suppose user is logged in
     * $I->see('Sign Up', 'h1');          // I can suppose it's a signup page
     * $I->see('Sign Up', '//body/h1');   // with XPath
     * ```
     *
     * Note that the search is done after stripping all HTML tags from the body,
     * so `$I->see('strong')` will return true for strings like:
     *
     *   - `<p>I am Stronger than thou</p>`
     *   - `<script>document.createElement('strong');</script>`
     *
     * But will *not* be true for strings like:
     *
     *   - `<strong>Home</strong>`
     *   - `<div class="strong">Home</strong>`
     *   - `<!-- strong -->`
     *
     * For checking the raw source code, use `seeInSource()`.
     *
     * @param      $text
     * @param null $selector
     *
     * @see \Codeception\Lib\InnerBrowser::see()
     */
    public function see($text, $selector = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('see', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current page doesn't contain the text specified (case insensitive).
     * Give a locator as the second parameter to match a specific region.
     *
     * ```php
     * <?php
     * $I->dontSee('Login');                    // I can suppose user is already logged in
     * $I->dontSee('Sign Up','h1');             // I can suppose it's not a signup page
     * $I->dontSee('Sign Up','//body/h1');      // with XPath
     * ```
     *
     * Note that the search is done after stripping all HTML tags from the body,
     * so `$I->dontSee('strong')` will fail on strings like:
     *
     *   - `<p>I am Stronger than thou</p>`
     *   - `<script>document.createElement('strong');</script>`
     *
     * But will ignore strings like:
     *
     *   - `<strong>Home</strong>`
     *   - `<div class="strong">Home</strong>`
     *   - `<!-- strong -->`
     *
     * For checking the raw source code, use `seeInSource()`.
     *
     * @param      $text
     * @param null $selector
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::dontSee()
     */
    public function cantSee($text, $selector = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSee', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current page doesn't contain the text specified (case insensitive).
     * Give a locator as the second parameter to match a specific region.
     *
     * ```php
     * <?php
     * $I->dontSee('Login');                    // I can suppose user is already logged in
     * $I->dontSee('Sign Up','h1');             // I can suppose it's not a signup page
     * $I->dontSee('Sign Up','//body/h1');      // with XPath
     * ```
     *
     * Note that the search is done after stripping all HTML tags from the body,
     * so `$I->dontSee('strong')` will fail on strings like:
     *
     *   - `<p>I am Stronger than thou</p>`
     *   - `<script>document.createElement('strong');</script>`
     *
     * But will ignore strings like:
     *
     *   - `<strong>Home</strong>`
     *   - `<div class="strong">Home</strong>`
     *   - `<!-- strong -->`
     *
     * For checking the raw source code, use `seeInSource()`.
     *
     * @param      $text
     * @param null $selector
     *
     * @see \Codeception\Lib\InnerBrowser::dontSee()
     */
    public function dontSee($text, $selector = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('dontSee', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current page contains the given string in its
     * raw source code.
     *
     * ``` php
     * <?php
     * $I->seeInSource('<h1>Green eggs &amp; ham</h1>');
     * ```
     *
     * @param      $raw
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::seeInSource()
     */
    public function canSeeInSource($raw)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeInSource', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current page contains the given string in its
     * raw source code.
     *
     * ``` php
     * <?php
     * $I->seeInSource('<h1>Green eggs &amp; ham</h1>');
     * ```
     *
     * @param      $raw
     *
     * @see \Codeception\Lib\InnerBrowser::seeInSource()
     */
    public function seeInSource($raw)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('seeInSource', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current page contains the given string in its
     * raw source code.
     *
     * ```php
     * <?php
     * $I->dontSeeInSource('<h1>Green eggs &amp; ham</h1>');
     * ```
     *
     * @param      $raw
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeInSource()
     */
    public function cantSeeInSource($raw)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSeeInSource', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current page contains the given string in its
     * raw source code.
     *
     * ```php
     * <?php
     * $I->dontSeeInSource('<h1>Green eggs &amp; ham</h1>');
     * ```
     *
     * @param      $raw
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeInSource()
     */
    public function dontSeeInSource($raw)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('dontSeeInSource', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that there's a link with the specified text.
     * Give a full URL as the second parameter to match links with that exact URL.
     *
     * ``` php
     * <?php
     * $I->seeLink('Logout'); // matches <a href="#">Logout</a>
     * $I->seeLink('Logout','/logout'); // matches <a href="/logout">Logout</a>
     * ?>
     * ```
     *
     * @param      $text
     * @param null $url
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::seeLink()
     */
    public function canSeeLink($text, $url = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeLink', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that there's a link with the specified text.
     * Give a full URL as the second parameter to match links with that exact URL.
     *
     * ``` php
     * <?php
     * $I->seeLink('Logout'); // matches <a href="#">Logout</a>
     * $I->seeLink('Logout','/logout'); // matches <a href="/logout">Logout</a>
     * ?>
     * ```
     *
     * @param      $text
     * @param null $url
     *
     * @see \Codeception\Lib\InnerBrowser::seeLink()
     */
    public function seeLink($text, $url = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('seeLink', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the page doesn't contain a link with the given string.
     * If the second parameter is given, only links with a matching "href" attribute will be checked.
     *
     * ``` php
     * <?php
     * $I->dontSeeLink('Logout'); // I suppose user is not logged in
     * $I->dontSeeLink('Checkout now', '/store/cart.php');
     * ?>
     * ```
     *
     * @param      $text
     * @param null $url
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeLink()
     */
    public function cantSeeLink($text, $url = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSeeLink', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the page doesn't contain a link with the given string.
     * If the second parameter is given, only links with a matching "href" attribute will be checked.
     *
     * ``` php
     * <?php
     * $I->dontSeeLink('Logout'); // I suppose user is not logged in
     * $I->dontSeeLink('Checkout now', '/store/cart.php');
     * ?>
     * ```
     *
     * @param      $text
     * @param null $url
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeLink()
     */
    public function dontSeeLink($text, $url = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('dontSeeLink', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that current URI contains the given string.
     *
     * ``` php
     * <?php
     * // to match: /home/dashboard
     * $I->seeInCurrentUrl('home');
     * // to match: /users/1
     * $I->seeInCurrentUrl('/users/');
     * ?>
     * ```
     *
     * @param $uri
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::seeInCurrentUrl()
     */
    public function canSeeInCurrentUrl($uri)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeInCurrentUrl', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that current URI contains the given string.
     *
     * ``` php
     * <?php
     * // to match: /home/dashboard
     * $I->seeInCurrentUrl('home');
     * // to match: /users/1
     * $I->seeInCurrentUrl('/users/');
     * ?>
     * ```
     *
     * @param $uri
     *
     * @see \Codeception\Lib\InnerBrowser::seeInCurrentUrl()
     */
    public function seeInCurrentUrl($uri)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('seeInCurrentUrl', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current URI doesn't contain the given string.
     *
     * ``` php
     * <?php
     * $I->dontSeeInCurrentUrl('/users/');
     * ?>
     * ```
     *
     * @param $uri
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeInCurrentUrl()
     */
    public function cantSeeInCurrentUrl($uri)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSeeInCurrentUrl', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current URI doesn't contain the given string.
     *
     * ``` php
     * <?php
     * $I->dontSeeInCurrentUrl('/users/');
     * ?>
     * ```
     *
     * @param $uri
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeInCurrentUrl()
     */
    public function dontSeeInCurrentUrl($uri)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion(
                'dontSeeInCurrentUrl', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current URL is equal to the given string.
     * Unlike `seeInCurrentUrl`, this only matches the full URL.
     *
     * ``` php
     * <?php
     * // to match root url
     * $I->seeCurrentUrlEquals('/');
     * ?>
     * ```
     *
     * @param $uri
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::seeCurrentUrlEquals()
     */
    public function canSeeCurrentUrlEquals($uri)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeCurrentUrlEquals', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current URL is equal to the given string.
     * Unlike `seeInCurrentUrl`, this only matches the full URL.
     *
     * ``` php
     * <?php
     * // to match root url
     * $I->seeCurrentUrlEquals('/');
     * ?>
     * ```
     *
     * @param $uri
     *
     * @see \Codeception\Lib\InnerBrowser::seeCurrentUrlEquals()
     */
    public function seeCurrentUrlEquals($uri)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion(
                'seeCurrentUrlEquals', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current URL doesn't equal the given string.
     * Unlike `dontSeeInCurrentUrl`, this only matches the full URL.
     *
     * ``` php
     * <?php
     * // current url is not root
     * $I->dontSeeCurrentUrlEquals('/');
     * ?>
     * ```
     *
     * @param $uri
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeCurrentUrlEquals()
     */
    public function cantSeeCurrentUrlEquals($uri)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSeeCurrentUrlEquals', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current URL doesn't equal the given string.
     * Unlike `dontSeeInCurrentUrl`, this only matches the full URL.
     *
     * ``` php
     * <?php
     * // current url is not root
     * $I->dontSeeCurrentUrlEquals('/');
     * ?>
     * ```
     *
     * @param $uri
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeCurrentUrlEquals()
     */
    public function dontSeeCurrentUrlEquals($uri)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion(
                'dontSeeCurrentUrlEquals', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current URL matches the given regular expression.
     *
     * ``` php
     * <?php
     * // to match root url
     * $I->seeCurrentUrlMatches('~$/users/(\d+)~');
     * ?>
     * ```
     *
     * @param $uri
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::seeCurrentUrlMatches()
     */
    public function canSeeCurrentUrlMatches($uri)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeCurrentUrlMatches', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the current URL matches the given regular expression.
     *
     * ``` php
     * <?php
     * // to match root url
     * $I->seeCurrentUrlMatches('~$/users/(\d+)~');
     * ?>
     * ```
     *
     * @param $uri
     *
     * @see \Codeception\Lib\InnerBrowser::seeCurrentUrlMatches()
     */
    public function seeCurrentUrlMatches($uri)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion(
                'seeCurrentUrlMatches', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that current url doesn't match the given regular expression.
     *
     * ``` php
     * <?php
     * // to match root url
     * $I->dontSeeCurrentUrlMatches('~$/users/(\d+)~');
     * ?>
     * ```
     *
     * @param $uri
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeCurrentUrlMatches()
     */
    public function cantSeeCurrentUrlMatches($uri)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSeeCurrentUrlMatches', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that current url doesn't match the given regular expression.
     *
     * ``` php
     * <?php
     * // to match root url
     * $I->dontSeeCurrentUrlMatches('~$/users/(\d+)~');
     * ?>
     * ```
     *
     * @param $uri
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeCurrentUrlMatches()
     */
    public function dontSeeCurrentUrlMatches($uri)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion(
                'dontSeeCurrentUrlMatches', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Executes the given regular expression against the current URI and returns the first match.
     * If no parameters are provided, the full URI is returned.
     *
     * ``` php
     * <?php
     * $user_id = $I->grabFromCurrentUrl('~$/user/(\d+)/~');
     * $uri = $I->grabFromCurrentUrl();
     * ?>
     * ```
     *
     * @param null $uri
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::grabFromCurrentUrl()
     */
    public function grabFromCurrentUrl($uri = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('grabFromCurrentUrl', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the specified checkbox is checked.
     *
     * ``` php
     * <?php
     * $I->seeCheckboxIsChecked('#agree'); // I suppose user agreed to terms
     * $I->seeCheckboxIsChecked('#signup_form input[type=checkbox]'); // I suppose user agreed to terms, If there is only one checkbox in form.
     * $I->seeCheckboxIsChecked('//form/input[@type=checkbox and @name=agree]');
     * ?>
     * ```
     *
     * @param $checkbox
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::seeCheckboxIsChecked()
     */
    public function canSeeCheckboxIsChecked($checkbox)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeCheckboxIsChecked', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the specified checkbox is checked.
     *
     * ``` php
     * <?php
     * $I->seeCheckboxIsChecked('#agree'); // I suppose user agreed to terms
     * $I->seeCheckboxIsChecked('#signup_form input[type=checkbox]'); // I suppose user agreed to terms, If there is only one checkbox in form.
     * $I->seeCheckboxIsChecked('//form/input[@type=checkbox and @name=agree]');
     * ?>
     * ```
     *
     * @param $checkbox
     *
     * @see \Codeception\Lib\InnerBrowser::seeCheckboxIsChecked()
     */
    public function seeCheckboxIsChecked($checkbox)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion(
                'seeCheckboxIsChecked', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Check that the specified checkbox is unchecked.
     *
     * ``` php
     * <?php
     * $I->dontSeeCheckboxIsChecked('#agree'); // I suppose user didn't agree to terms
     * $I->seeCheckboxIsChecked('#signup_form input[type=checkbox]'); // I suppose user didn't check the first checkbox in form.
     * ?>
     * ```
     *
     * @param $checkbox
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeCheckboxIsChecked()
     */
    public function cantSeeCheckboxIsChecked($checkbox)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSeeCheckboxIsChecked', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Check that the specified checkbox is unchecked.
     *
     * ``` php
     * <?php
     * $I->dontSeeCheckboxIsChecked('#agree'); // I suppose user didn't agree to terms
     * $I->seeCheckboxIsChecked('#signup_form input[type=checkbox]'); // I suppose user didn't check the first checkbox in form.
     * ?>
     * ```
     *
     * @param $checkbox
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeCheckboxIsChecked()
     */
    public function dontSeeCheckboxIsChecked($checkbox)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion(
                'dontSeeCheckboxIsChecked', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the given input field or textarea contains the given value.
     * For fuzzy locators, fields are matched by label text, the "name" attribute, CSS, and XPath.
     *
     * ``` php
     * <?php
     * $I->seeInField('Body','Type your comment here');
     * $I->seeInField('form textarea[name=body]','Type your comment here');
     * $I->seeInField('form input[type=hidden]','hidden_value');
     * $I->seeInField('#searchform input','Search');
     * $I->seeInField('//form/*[@name=search]','Search');
     * $I->seeInField(['name' => 'search'], 'Search');
     * ?>
     * ```
     *
     * @param $field
     * @param $value
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::seeInField()
     */
    public function canSeeInField($field, $value)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeInField', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the given input field or textarea contains the given value.
     * For fuzzy locators, fields are matched by label text, the "name" attribute, CSS, and XPath.
     *
     * ``` php
     * <?php
     * $I->seeInField('Body','Type your comment here');
     * $I->seeInField('form textarea[name=body]','Type your comment here');
     * $I->seeInField('form input[type=hidden]','hidden_value');
     * $I->seeInField('#searchform input','Search');
     * $I->seeInField('//form/*[@name=search]','Search');
     * $I->seeInField(['name' => 'search'], 'Search');
     * ?>
     * ```
     *
     * @param $field
     * @param $value
     *
     * @see \Codeception\Lib\InnerBrowser::seeInField()
     */
    public function seeInField($field, $value)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('seeInField', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that an input field or textarea doesn't contain the given value.
     * For fuzzy locators, the field is matched by label text, CSS and XPath.
     *
     * ``` php
     * <?php
     * $I->dontSeeInField('Body','Type your comment here');
     * $I->dontSeeInField('form textarea[name=body]','Type your comment here');
     * $I->dontSeeInField('form input[type=hidden]','hidden_value');
     * $I->dontSeeInField('#searchform input','Search');
     * $I->dontSeeInField('//form/*[@name=search]','Search');
     * $I->dontSeeInField(['name' => 'search'], 'Search');
     * ?>
     * ```
     *
     * @param $field
     * @param $value
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeInField()
     */
    public function cantSeeInField($field, $value)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSeeInField', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that an input field or textarea doesn't contain the given value.
     * For fuzzy locators, the field is matched by label text, CSS and XPath.
     *
     * ``` php
     * <?php
     * $I->dontSeeInField('Body','Type your comment here');
     * $I->dontSeeInField('form textarea[name=body]','Type your comment here');
     * $I->dontSeeInField('form input[type=hidden]','hidden_value');
     * $I->dontSeeInField('#searchform input','Search');
     * $I->dontSeeInField('//form/*[@name=search]','Search');
     * $I->dontSeeInField(['name' => 'search'], 'Search');
     * ?>
     * ```
     *
     * @param $field
     * @param $value
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeInField()
     */
    public function dontSeeInField($field, $value)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('dontSeeInField', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks if the array of form parameters (name => value) are set on the form matched with the
     * passed selector.
     *
     * ``` php
     * <?php
     * $I->seeInFormFields('form[name=myform]', [
     *      'input1' => 'value',
     *      'input2' => 'other value',
     * ]);
     * ?>
     * ```
     *
     * For multi-select elements, or to check values of multiple elements with the same name, an
     * array may be passed:
     *
     * ``` php
     * <?php
     * $I->seeInFormFields('.form-class', [
     *      'multiselect' => [
     *          'value1',
     *          'value2',
     *      ],
     *      'checkbox[]' => [
     *          'a checked value',
     *          'another checked value',
     *      ],
     * ]);
     * ?>
     * ```
     *
     * Additionally, checkbox values can be checked with a boolean.
     *
     * ``` php
     * <?php
     * $I->seeInFormFields('#form-id', [
     *      'checkbox1' => true,        // passes if checked
     *      'checkbox2' => false,       // passes if unchecked
     * ]);
     * ?>
     * ```
     *
     * Pair this with submitForm for quick testing magic.
     *
     * ``` php
     * <?php
     * $form = [
     *      'field1' => 'value',
     *      'field2' => 'another value',
     *      'checkbox1' => true,
     *      // ...
     * ];
     * $I->submitForm('//form[@id=my-form]', $form, 'submitButton');
     * // $I->amOnPage('/path/to/form-page') may be needed
     * $I->seeInFormFields('//form[@id=my-form]', $form);
     * ?>
     * ```
     *
     * @param $formSelector
     * @param $params
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::seeInFormFields()
     */
    public function canSeeInFormFields($formSelector, $params)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeInFormFields', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks if the array of form parameters (name => value) are set on the form matched with the
     * passed selector.
     *
     * ``` php
     * <?php
     * $I->seeInFormFields('form[name=myform]', [
     *      'input1' => 'value',
     *      'input2' => 'other value',
     * ]);
     * ?>
     * ```
     *
     * For multi-select elements, or to check values of multiple elements with the same name, an
     * array may be passed:
     *
     * ``` php
     * <?php
     * $I->seeInFormFields('.form-class', [
     *      'multiselect' => [
     *          'value1',
     *          'value2',
     *      ],
     *      'checkbox[]' => [
     *          'a checked value',
     *          'another checked value',
     *      ],
     * ]);
     * ?>
     * ```
     *
     * Additionally, checkbox values can be checked with a boolean.
     *
     * ``` php
     * <?php
     * $I->seeInFormFields('#form-id', [
     *      'checkbox1' => true,        // passes if checked
     *      'checkbox2' => false,       // passes if unchecked
     * ]);
     * ?>
     * ```
     *
     * Pair this with submitForm for quick testing magic.
     *
     * ``` php
     * <?php
     * $form = [
     *      'field1' => 'value',
     *      'field2' => 'another value',
     *      'checkbox1' => true,
     *      // ...
     * ];
     * $I->submitForm('//form[@id=my-form]', $form, 'submitButton');
     * // $I->amOnPage('/path/to/form-page') may be needed
     * $I->seeInFormFields('//form[@id=my-form]', $form);
     * ?>
     * ```
     *
     * @param $formSelector
     * @param $params
     *
     * @see \Codeception\Lib\InnerBrowser::seeInFormFields()
     */
    public function seeInFormFields($formSelector, $params)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('seeInFormFields', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks if the array of form parameters (name => value) are not set on the form matched with
     * the passed selector.
     *
     * ``` php
     * <?php
     * $I->dontSeeInFormFields('form[name=myform]', [
     *      'input1' => 'non-existent value',
     *      'input2' => 'other non-existent value',
     * ]);
     * ?>
     * ```
     *
     * To check that an element hasn't been assigned any one of many values, an array can be passed
     * as the value:
     *
     * ``` php
     * <?php
     * $I->dontSeeInFormFields('.form-class', [
     *      'fieldName' => [
     *          'This value shouldn\'t be set',
     *          'And this value shouldn\'t be set',
     *      ],
     * ]);
     * ?>
     * ```
     *
     * Additionally, checkbox values can be checked with a boolean.
     *
     * ``` php
     * <?php
     * $I->dontSeeInFormFields('#form-id', [
     *      'checkbox1' => true,        // fails if checked
     *      'checkbox2' => false,       // fails if unchecked
     * ]);
     * ?>
     * ```
     *
     * @param $formSelector
     * @param $params
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeInFormFields()
     */
    public function cantSeeInFormFields($formSelector, $params)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSeeInFormFields', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks if the array of form parameters (name => value) are not set on the form matched with
     * the passed selector.
     *
     * ``` php
     * <?php
     * $I->dontSeeInFormFields('form[name=myform]', [
     *      'input1' => 'non-existent value',
     *      'input2' => 'other non-existent value',
     * ]);
     * ?>
     * ```
     *
     * To check that an element hasn't been assigned any one of many values, an array can be passed
     * as the value:
     *
     * ``` php
     * <?php
     * $I->dontSeeInFormFields('.form-class', [
     *      'fieldName' => [
     *          'This value shouldn\'t be set',
     *          'And this value shouldn\'t be set',
     *      ],
     * ]);
     * ?>
     * ```
     *
     * Additionally, checkbox values can be checked with a boolean.
     *
     * ``` php
     * <?php
     * $I->dontSeeInFormFields('#form-id', [
     *      'checkbox1' => true,        // fails if checked
     *      'checkbox2' => false,       // fails if unchecked
     * ]);
     * ?>
     * ```
     *
     * @param $formSelector
     * @param $params
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeInFormFields()
     */
    public function dontSeeInFormFields($formSelector, $params)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion(
                'dontSeeInFormFields', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Submits the given form on the page, optionally with the given form
     * values.  Pass the form field's values as an array in the second
     * parameter.
     *
     * Although this function can be used as a short-hand version of
     * `fillField()`, `selectOption()`, `click()` etc. it has some important
     * differences:
     *
     *  * Only field *names* may be used, not CSS/XPath selectors nor field labels
     *  * If a field is sent to this function that does *not* exist on the page,
     *    it will silently be added to the HTTP request.  This is helpful for testing
     *    some types of forms, but be aware that you will *not* get an exception
     *    like you would if you called `fillField()` or `selectOption()` with
     *    a missing field.
     *
     * Fields that are not provided will be filled by their values from the page,
     * or from any previous calls to `fillField()`, `selectOption()` etc.
     * You don't need to click the 'Submit' button afterwards.
     * This command itself triggers the request to form's action.
     *
     * You can optionally specify which button's value to include
     * in the request with the last parameter (as an alternative to
     * explicitly setting its value in the second parameter), as
     * button values are not otherwise included in the request.
     *
     * Examples:
     *
     * ``` php
     * <?php
     * $I->submitForm('#login', [
     *     'login' => 'davert',
     *     'password' => '123456'
     * ]);
     * // or
     * $I->submitForm('#login', [
     *     'login' => 'davert',
     *     'password' => '123456'
     * ], 'submitButtonName');
     *
     * ```
     *
     * For example, given this sample "Sign Up" form:
     *
     * ``` html
     * <form action="/sign_up">
     *     Login:
     *     <input type="text" name="user[login]" /><br/>
     *     Password:
     *     <input type="password" name="user[password]" /><br/>
     *     Do you agree to our terms?
     *     <input type="checkbox" name="user[agree]" /><br/>
     *     Select pricing plan:
     *     <select name="plan">
     *         <option value="1">Free</option>
     *         <option value="2" selected="selected">Paid</option>
     *     </select>
     *     <input type="submit" name="submitButton" value="Submit" />
     * </form>
     * ```
     *
     * You could write the following to submit it:
     *
     * ``` php
     * <?php
     * $I->submitForm(
     *     '#userForm',
     *     [
     *         'user' => [
     *             'login' => 'Davert',
     *             'password' => '123456',
     *             'agree' => true
     *         ]
     *     ],
     *     'submitButton'
     * );
     * ```
     * Note that "2" will be the submitted value for the "plan" field, as it is
     * the selected option.
     *
     * You can also emulate a JavaScript submission by not specifying any
     * buttons in the third parameter to submitForm.
     *
     * ```php
     * <?php
     * $I->submitForm(
     *     '#userForm',
     *     [
     *         'user' => [
     *             'login' => 'Davert',
     *             'password' => '123456',
     *             'agree' => true
     *         ]
     *     ]
     * );
     * ```
     *
     * This function works well when paired with `seeInFormFields()`
     * for quickly testing CRUD interfaces and form validation logic.
     *
     * ``` php
     * <?php
     * $form = [
     *      'field1' => 'value',
     *      'field2' => 'another value',
     *      'checkbox1' => true,
     *      // ...
     * ];
     * $I->submitForm('#my-form', $form, 'submitButton');
     * // $I->amOnPage('/path/to/form-page') may be needed
     * $I->seeInFormFields('#my-form', $form);
     * ```
     *
     * Parameter values can be set to arrays for multiple input fields
     * of the same name, or multi-select combo boxes.  For checkboxes,
     * you can use either the string value or boolean `true`/`false` which will
     * be replaced by the checkbox's value in the DOM.
     *
     * ``` php
     * <?php
     * $I->submitForm('#my-form', [
     *      'field1' => 'value',
     *      'checkbox' => [
     *          'value of first checkbox',
     *          'value of second checkbox',
     *      ],
     *      'otherCheckboxes' => [
     *          true,
     *          false,
     *          false
     *      ],
     *      'multiselect' => [
     *          'first option value',
     *          'second option value'
     *      ]
     * ]);
     * ```
     *
     * Mixing string and boolean values for a checkbox's value is not supported
     * and may produce unexpected results.
     *
     * Field names ending in `[]` must be passed without the trailing square
     * bracket characters, and must contain an array for its value.  This allows
     * submitting multiple values with the same name, consider:
     *
     * ```php
     * <?php
     * // This will NOT work correctly
     * $I->submitForm('#my-form', [
     *     'field[]' => 'value',
     *     'field[]' => 'another value',  // 'field[]' is already a defined key
     * ]);
     * ```
     *
     * The solution is to pass an array value:
     *
     * ```php
     * <?php
     * // This way both values are submitted
     * $I->submitForm('#my-form', [
     *     'field' => [
     *         'value',
     *         'another value',
     *     ]
     * ]);
     * ```
     *
     * @param $selector
     * @param $params
     * @param $button
     *
     * @see \Codeception\Lib\InnerBrowser::submitForm()
     */
    public function submitForm($selector, $params, $button = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('submitForm', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Fills a text field or textarea with the given string.
     *
     * ``` php
     * <?php
     * $I->fillField("//input[@type='text']", "Hello World!");
     * $I->fillField(['name' => 'email'], 'jon@mail.com');
     * ?>
     * ```
     *
     * @param $field
     * @param $value
     *
     * @see \Codeception\Lib\InnerBrowser::fillField()
     */
    public function fillField($field, $value)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('fillField', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Selects an option in a select tag or in radio button group.
     *
     * ``` php
     * <?php
     * $I->selectOption('form select[name=account]', 'Premium');
     * $I->selectOption('form input[name=payment]', 'Monthly');
     * $I->selectOption('//form/select[@name=account]', 'Monthly');
     * ?>
     * ```
     *
     * Provide an array for the second argument to select multiple options:
     *
     * ``` php
     * <?php
     * $I->selectOption('Which OS do you use?', array('Windows','Linux'));
     * ?>
     * ```
     *
     * Or provide an associative array for the second argument to specifically define which selection method should be used:
     *
     * ``` php
     * <?php
     * $I->selectOption('Which OS do you use?', array('text' => 'Windows')); // Only search by text 'Windows'
     * $I->selectOption('Which OS do you use?', array('value' => 'windows')); // Only search by value 'windows'
     * ?>
     * + ```
     *
     * @param $select
     * @param $option
     *
     * @see \Codeception\Lib\InnerBrowser::selectOption()
     */
    public function selectOption($select, $option)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('selectOption', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Ticks a checkbox. For radio buttons, use the `selectOption` method instead.
     *
     * ``` php
     * <?php
     * $I->checkOption('#agree');
     * ?>
     * ```
     *
     * @param $option
     *
     * @see \Codeception\Lib\InnerBrowser::checkOption()
     */
    public function checkOption($option)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('checkOption', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Unticks a checkbox.
     *
     * ``` php
     * <?php
     * $I->uncheckOption('#notify');
     * ?>
     * ```
     *
     * @param $option
     *
     * @see \Codeception\Lib\InnerBrowser::uncheckOption()
     */
    public function uncheckOption($option)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('uncheckOption', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Attaches a file relative to the Codeception data directory to the given file upload field.
     *
     * ``` php
     * <?php
     * // file is stored in 'tests/_data/prices.xls'
     * $I->attachFile('input[@type="file"]', 'prices.xls');
     * ?>
     * ```
     *
     * @param $field
     * @param $filename
     *
     * @see \Codeception\Lib\InnerBrowser::attachFile()
     */
    public function attachFile($field, $filename)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('attachFile', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * If your page triggers an ajax request, you can perform it manually.
     * This action sends a GET ajax request with specified params.
     *
     * See ->sendAjaxPostRequest for examples.
     *
     * @param $uri
     * @param $params
     *
     * @see \Codeception\Lib\InnerBrowser::sendAjaxGetRequest()
     */
    public function sendAjaxGetRequest($uri, $params = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('sendAjaxGetRequest', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * If your page triggers an ajax request, you can perform it manually.
     * This action sends a POST ajax request with specified params.
     * Additional params can be passed as array.
     *
     * Example:
     *
     * Imagine that by clicking checkbox you trigger ajax request which updates user settings.
     * We emulate that click by running this ajax request manually.
     *
     * ``` php
     * <?php
     * $I->sendAjaxPostRequest('/updateSettings', array('notifications' => true)); // POST
     * $I->sendAjaxGetRequest('/updateSettings', array('notifications' => true)); // GET
     *
     * ```
     *
     * @param $uri
     * @param $params
     *
     * @see \Codeception\Lib\InnerBrowser::sendAjaxPostRequest()
     */
    public function sendAjaxPostRequest($uri, $params = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('sendAjaxPostRequest', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * If your page triggers an ajax request, you can perform it manually.
     * This action sends an ajax request with specified method and params.
     *
     * Example:
     *
     * You need to perform an ajax request specifying the HTTP method.
     *
     * ``` php
     * <?php
     * $I->sendAjaxRequest('PUT', '/posts/7', array('title' => 'new title'));
     *
     * ```
     *
     * @param $method
     * @param $uri
     * @param $params
     *
     * @see \Codeception\Lib\InnerBrowser::sendAjaxRequest()
     */
    public function sendAjaxRequest($method, $uri, $params = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('sendAjaxRequest', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Finds and returns the text contents of the given element.
     * If a fuzzy locator is used, the element is found using CSS, XPath,
     * and by matching the full page source by regular expression.
     *
     * ``` php
     * <?php
     * $heading = $I->grabTextFrom('h1');
     * $heading = $I->grabTextFrom('descendant-or-self::h1');
     * $value = $I->grabTextFrom('~<input value=(.*?)]~sgi'); // match with a regex
     * ?>
     * ```
     *
     * @param $cssOrXPathOrRegex
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::grabTextFrom()
     */
    public function grabTextFrom($cssOrXPathOrRegex)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('grabTextFrom', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Grabs the value of the given attribute value from the given element.
     * Fails if element is not found.
     *
     * ``` php
     * <?php
     * $I->grabAttributeFrom('#tooltip', 'title');
     * ?>
     * ```
     *
     *
     * @param $cssOrXpath
     * @param $attribute
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::grabAttributeFrom()
     */
    public function grabAttributeFrom($cssOrXpath, $attribute)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('grabAttributeFrom', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Grabs either the text content, or attribute values, of nodes
     * matched by $cssOrXpath and returns them as an array.
     *
     * ```html
     * <a href="#first">First</a>
     * <a href="#second">Second</a>
     * <a href="#third">Third</a>
     * ```
     *
     * ```php
     * <?php
     * // would return ['First', 'Second', 'Third']
     * $aLinkText = $I->grabMultiple('a');
     *
     * // would return ['#first', '#second', '#third']
     * $aLinks = $I->grabMultiple('a', 'href');
     * ?>
     * ```
     *
     * @param $cssOrXpath
     * @param $attribute
     *
     * @return string[]
     * @see \Codeception\Lib\InnerBrowser::grabMultiple()
     */
    public function grabMultiple($cssOrXpath, $attribute = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('grabMultiple', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * @param $field
     *
     * @return array|mixed|null|string
     * @see \Codeception\Lib\InnerBrowser::grabValueFrom()
     */
    public function grabValueFrom($field)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('grabValueFrom', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Sets a cookie with the given name and value.
     * You can set additional cookie params like `domain`, `path`, `expires`, `secure` in array passed as last argument.
     *
     * ``` php
     * <?php
     * $I->setCookie('PHPSESSID', 'el4ukv0kqbvoirg7nkp4dncpk3');
     * ?>
     * ```
     *
     * @param       $name
     * @param       $val
     * @param array $params
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::setCookie()
     */
    public function setCookie($name, $val, $params = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('setCookie', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Grabs a cookie value.
     * You can set additional cookie params like `domain`, `path` in array passed as last argument.
     *
     * @param       $cookie
     *
     * @param array $params
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::grabCookie()
     */
    public function grabCookie($cookie, $params = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('grabCookie', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that a cookie with the given name is set.
     * You can set additional cookie params like `domain`, `path` as array passed in last argument.
     *
     * ``` php
     * <?php
     * $I->seeCookie('PHPSESSID');
     * ?>
     * ```
     *
     * @param       $cookie
     * @param array $params
     *
     * @return mixed
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Lib\InnerBrowser::seeCookie()
     */
    public function canSeeCookie($cookie, $params = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeCookie', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that a cookie with the given name is set.
     * You can set additional cookie params like `domain`, `path` as array passed in last argument.
     *
     * ``` php
     * <?php
     * $I->seeCookie('PHPSESSID');
     * ?>
     * ```
     *
     * @param       $cookie
     * @param array $params
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::seeCookie()
     */
    public function seeCookie($cookie, $params = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('seeCookie', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that there isn't a cookie with the given name.
     * You can set additional cookie params like `domain`, `path` as array passed in last argument.
     *
     * @param       $cookie
     *
     * @param array $params
     *
     * @return mixed
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Lib\InnerBrowser::dontSeeCookie()
     */
    public function cantSeeCookie($cookie, $params = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSeeCookie', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that there isn't a cookie with the given name.
     * You can set additional cookie params like `domain`, `path` as array passed in last argument.
     *
     * @param       $cookie
     *
     * @param array $params
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::dontSeeCookie()
     */
    public function dontSeeCookie($cookie, $params = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('dontSeeCookie', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Unsets cookie with the given name.
     * You can set additional cookie params like `domain`, `path` in array passed as last argument.
     *
     * @param       $cookie
     *
     * @param array $params
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::resetCookie()
     */
    public function resetCookie($name, $params = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('resetCookie', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the given element exists on the page and is visible.
     * You can also specify expected attributes of this element.
     *
     * ``` php
     * <?php
     * $I->seeElement('.error');
     * $I->seeElement('//form/input[1]');
     * $I->seeElement('input', ['name' => 'login']);
     * $I->seeElement('input', ['value' => '123456']);
     *
     * // strict locator in first arg, attributes in second
     * $I->seeElement(['css' => 'form input'], ['name' => 'login']);
     * ?>
     * ```
     *
     * @param       $selector
     * @param array $attributes
     *
     * @return
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Lib\InnerBrowser::seeElement()
     */
    public function canSeeElement($selector, $attributes = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeElement', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the given element exists on the page and is visible.
     * You can also specify expected attributes of this element.
     *
     * ``` php
     * <?php
     * $I->seeElement('.error');
     * $I->seeElement('//form/input[1]');
     * $I->seeElement('input', ['name' => 'login']);
     * $I->seeElement('input', ['value' => '123456']);
     *
     * // strict locator in first arg, attributes in second
     * $I->seeElement(['css' => 'form input'], ['name' => 'login']);
     * ?>
     * ```
     *
     * @param       $selector
     * @param array $attributes
     *
     * @return
     * @see \Codeception\Lib\InnerBrowser::seeElement()
     */
    public function seeElement($selector, $attributes = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('seeElement', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the given element is invisible or not present on the page.
     * You can also specify expected attributes of this element.
     *
     * ``` php
     * <?php
     * $I->dontSeeElement('.error');
     * $I->dontSeeElement('//form/input[1]');
     * $I->dontSeeElement('input', ['name' => 'login']);
     * $I->dontSeeElement('input', ['value' => '123456']);
     * ?>
     * ```
     *
     * @param       $selector
     * @param array $attributes
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeElement()
     */
    public function cantSeeElement($selector, $attributes = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSeeElement', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the given element is invisible or not present on the page.
     * You can also specify expected attributes of this element.
     *
     * ``` php
     * <?php
     * $I->dontSeeElement('.error');
     * $I->dontSeeElement('//form/input[1]');
     * $I->dontSeeElement('input', ['name' => 'login']);
     * $I->dontSeeElement('input', ['value' => '123456']);
     * ?>
     * ```
     *
     * @param       $selector
     * @param array $attributes
     *
     * @see \Codeception\Lib\InnerBrowser::dontSeeElement()
     */
    public function dontSeeElement($selector, $attributes = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('dontSeeElement', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that there are a certain number of elements matched by the given locator on the page.
     *
     * ``` php
     * <?php
     * $I->seeNumberOfElements('tr', 10);
     * $I->seeNumberOfElements('tr', [0,10]); //between 0 and 10 elements
     * ?>
     * ```
     *
     * @param       $selector
     * @param mixed $expected :
     *                        - string: strict number
     *                        - array: range of numbers [0,10]
     *                        Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::seeNumberOfElements()
     */
    public function canSeeNumberOfElements($selector, $expected)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeNumberOfElements', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that there are a certain number of elements matched by the given locator on the page.
     *
     * ``` php
     * <?php
     * $I->seeNumberOfElements('tr', 10);
     * $I->seeNumberOfElements('tr', [0,10]); //between 0 and 10 elements
     * ?>
     * ```
     *
     * @param       $selector
     * @param mixed $expected :
     *                        - string: strict number
     *                        - array: range of numbers [0,10]
     *
     * @see \Codeception\Lib\InnerBrowser::seeNumberOfElements()
     */
    public function seeNumberOfElements($selector, $expected)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion(
                'seeNumberOfElements', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the given option is selected.
     *
     * ``` php
     * <?php
     * $I->seeOptionIsSelected('#form input[name=payment]', 'Visa');
     * ?>
     * ```
     *
     * @param $selector
     * @param $optionText
     *
     * @return mixed
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Lib\InnerBrowser::seeOptionIsSelected()
     */
    public function canSeeOptionIsSelected($selector, $optionText)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeOptionIsSelected', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the given option is selected.
     *
     * ``` php
     * <?php
     * $I->seeOptionIsSelected('#form input[name=payment]', 'Visa');
     * ?>
     * ```
     *
     * @param $selector
     * @param $optionText
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::seeOptionIsSelected()
     */
    public function seeOptionIsSelected($selector, $optionText)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion(
                'seeOptionIsSelected', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the given option is not selected.
     *
     * ``` php
     * <?php
     * $I->dontSeeOptionIsSelected('#form input[name=payment]', 'Visa');
     * ?>
     * ```
     *
     * @param $selector
     * @param $optionText
     *
     * @return mixed
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Lib\InnerBrowser::dontSeeOptionIsSelected()
     */
    public function cantSeeOptionIsSelected($selector, $optionText)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSeeOptionIsSelected', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the given option is not selected.
     *
     * ``` php
     * <?php
     * $I->dontSeeOptionIsSelected('#form input[name=payment]', 'Visa');
     * ?>
     * ```
     *
     * @param $selector
     * @param $optionText
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::dontSeeOptionIsSelected()
     */
    public function dontSeeOptionIsSelected($selector, $optionText)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion(
                'dontSeeOptionIsSelected', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Asserts that current page has 404 response status code.
     * Conditional Assertion: Test won't be stopped on fail
     *
     * @see \Codeception\Lib\InnerBrowser::seePageNotFound()
     */
    public function canSeePageNotFound()
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seePageNotFound', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Asserts that current page has 404 response status code.
     *
     * @see \Codeception\Lib\InnerBrowser::seePageNotFound()
     */
    public function seePageNotFound()
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('seePageNotFound', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that response code is equal to value provided.
     *
     * @param $code
     *
     * @return mixed
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Lib\InnerBrowser::seeResponseCodeIs()
     */
    public function canSeeResponseCodeIs($code)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeResponseCodeIs', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that response code is equal to value provided.
     *
     * @param $code
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::seeResponseCodeIs()
     */
    public function seeResponseCodeIs($code)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion(
                'seeResponseCodeIs', func_get_args()
            )
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the page title contains the given string.
     *
     * ``` php
     * <?php
     * $I->seeInTitle('Blog - Post #1');
     * ?>
     * ```
     *
     * @param $title
     *
     * @return mixed
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Lib\InnerBrowser::seeInTitle()
     */
    public function canSeeInTitle($title)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'seeInTitle', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the page title contains the given string.
     *
     * ``` php
     * <?php
     * $I->seeInTitle('Blog - Post #1');
     * ?>
     * ```
     *
     * @param $title
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::seeInTitle()
     */
    public function seeInTitle($title)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('seeInTitle', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the page title does not contain the given string.
     *
     * @param $title
     *
     * @return mixed
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Lib\InnerBrowser::dontSeeInTitle()
     */
    public function cantSeeInTitle($title)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\ConditionalAssertion(
                'dontSeeInTitle', func_get_args()
            )
        );
    }

    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that the page title does not contain the given string.
     *
     * @param $title
     *
     * @return mixed
     * @see \Codeception\Lib\InnerBrowser::dontSeeInTitle()
     */
    public function dontSeeInTitle($title)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Assertion('dontSeeInTitle', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Switch to iframe or frame on the page.
     *
     * Example:
     * ``` html
     * <iframe name="another_frame" src="http://example.com">
     * ```
     *
     * ``` php
     * <?php
     * # switch to iframe
     * $I->switchToIframe("another_frame");
     * ```
     *
     * @param string $name
     *
     * @see \Codeception\Lib\InnerBrowser::switchToIframe()
     */
    public function switchToIframe($name)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('switchToIframe', func_get_args())
        );
    }


    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Moves back in history.
     *
     * @param int $numberOfSteps (default value 1)
     *
     * @see \Codeception\Lib\InnerBrowser::moveBack()
     */
    public function moveBack($numberOfSteps = null)
    {
        return $this->getScenario()->runStep(
            new \Codeception\Step\Action('moveBack', func_get_args())
        );
    }
}
