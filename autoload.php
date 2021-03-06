<?php
// for phar
if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require_once(__DIR__.'/vendor/autoload.php');
} elseif (file_exists(__DIR__.'/../../autoload.php')) {
    require_once __DIR__ . '/../../autoload.php';
}

// @codingStandardsIgnoreStart
// loading WebDriver aliases
if (!class_exists('RemoteWebDriver') and class_exists('Facebook\WebDriver\Remote\RemoteWebDriver')) {
    class RemoteWebDriver extends \Facebook\WebDriver\Remote\RemoteWebDriver {};
    class InvalidSelectorException extends Facebook\WebDriver\Exception\InvalidSelectorException {};
    class NoSuchElementException extends Facebook\WebDriver\Exception\NoSuchElementException {};
    class WebDriverCurlException extends Facebook\WebDriver\Exception\WebDriverCurlException {};
    class WebDriverActions extends Facebook\WebDriver\Interactions\WebDriverActions {};
    class LocalFileDetector extends Facebook\WebDriver\Remote\LocalFileDetector {};
    class WebDriverCapabilityType extends Facebook\WebDriver\Remote\WebDriverCapabilityType {};
    class WebDriverAlert extends Facebook\WebDriver\WebDriverAlert {};
    class WebDriverBy extends Facebook\WebDriver\WebDriverBy {};
    class WebDriverDimension extends Facebook\WebDriver\WebDriverDimension {};
    class RemoteWebElement extends Facebook\WebDriver\Remote\RemoteWebElement {};
    class WebDriverExpectedCondition extends Facebook\WebDriver\WebDriverExpectedCondition {};
    class WebDriverKeys extends Facebook\WebDriver\WebDriverKeys {};
    class WebDriverSelect extends Facebook\WebDriver\WebDriverSelect {};
    class WebDriverTimeouts extends Facebook\WebDriver\WebDriverTimeouts {};
    class WebDriverWindow extends Facebook\WebDriver\WebDriverWindow {};
    interface WebDriverElement extends Facebook\WebDriver\WebDriverElement {};
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'symfony-shim.php';
// compat
if (PHP_MAJOR_VERSION < 7) {
    interface Throwable {};
    class ParseError extends \Exception {}
}
// @codingStandardsIgnoreEnd

if (!function_exists('json_last_error_msg')) {
    /**
     * Copied from http://php.net/manual/en/function.json-last-error-msg.php#117393
     * @return string
     */
    function json_last_error_msg()
    {
        static $errors = array(
            JSON_ERROR_NONE => 'No error',
            JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH => 'State mismatch (invalid or malformed JSON)',
            JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded',
            JSON_ERROR_SYNTAX => 'Syntax error',
            JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded'
        );

        $error = json_last_error();
        return isset($errors[$error]) ? $errors[$error] : 'Unknown error';
    }
}

// function not autoloaded in PHP, thus its a good place for them
function codecept_debug($data)
{
    \Codeception\Util\Debug::debug($data);
}

function codecept_root_dir($appendPath = '')
{
    return \Codeception\Configuration::projectDir() . $appendPath;
}

function codecept_output_dir($appendPath = '')
{
    return \Codeception\Configuration::outputDir() . $appendPath;
}

function codecept_log_dir($appendPath = '')
{
    return \Codeception\Configuration::outputDir() . $appendPath;
}

function codecept_data_dir($appendPath = '')
{
    return \Codeception\Configuration::dataDir() . $appendPath;
}

function codecept_relative_path($path)
{
    return substr($path, strlen(codecept_root_dir()));
}
