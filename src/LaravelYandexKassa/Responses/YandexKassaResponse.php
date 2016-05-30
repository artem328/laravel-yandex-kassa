<?php
namespace Artem328\LaravelYandexKassa\Responses;

use ArrayAccess;
use Artem328\LaravelYandexKassa\Requests\YandexKassaRequest;
use Illuminate\Http\Response;

class YandexKassaResponse extends Response implements ArrayAccess
{
    /**
     * Attributes of response
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * @var \Artem328\LaravelYandexKassa\Requests\YandexKassaRequest
     */
    protected $request;

    /**
     * Response type. Using on xml output as root tag
     *
     * @var string
     */
    protected $type;

    public function __construct(YandexKassaRequest $request, $type)
    {
        $this->request = $request;
        $this->type = $type;
        $this->initDefaultAttributes();
        parent::__construct();
    }

    /**
     * Returns attribute value by its name
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : $default;
    }

    /**
     * Magic method. An alias to method get
     * @see \Artem328\LaravelYandexKassa\Responses\YandexKassaResponse::get()
     * 
     * @param string $key
     * @return mixed|null
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Set attribute value
     * 
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Magic method. Alias for set method
     * @see \Artem328\LaravelYandexKassa\Responses\YandexKassaResponse::set()
     * 
     * @param string $key
     * @param mixed $value
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Delete attribute
     * 
     * @param string $key
     */
    public function delete($key)
    {
        unset($this->attributes[$key]);
    }

    /**
     * Magic method. Alias for delete method
     * @see \Artem328\LaravelYandexKassa\Responses\YandexKassaResponse::delete()
     * 
     * @param string $key
     */
    public function __unset($key)
    {
        $this->delete($key);
    }

    public function has($key)
    {
        return isset($this->attributes[$key]);
    }
    
    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        $this->delete($offset);
    }

    /**
     * Shortcut for setting code attribute
     *
     * @param integer $code
     */
    public function setCode($code)
    {
        $this->set('code', $code);
    }

    /**
     * Shortcut for setting message attribute
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->set('message', $message);
    }

    /**
     * Returns xml response with attributes
     *
     * @return $this
     */
    public function prepare()
    {
        return $this->setContent($this->getXml())
            ->header('Content-Type', 'application/xml');
    }

    /**
     * @return string
     */
    protected function getType()
    {
        return $this->type . 'Response';
    }

    /**
     * Generate xml code for response
     * 
     * @return string
     */
    protected function getXml()
    {
        $xml = [
            '<?xml version="1.0" encoding="UTF-8"?>',
            '<',
            $this->getType(),
            $this->getAttributesAsString(),
            '/>'
        ];

        return implode('', $xml);
    }

    /**
     * Generates attribute string from attributes
     * 
     * @return string
     */
    protected function getAttributesAsString()
    {
        $attributes = [];

        foreach ($this->attributes as $name => $value) {
            if (is_string($name)) {
                $attributes[] = htmlspecialchars($name, ENT_XML1) . '="' . htmlspecialchars($value, ENT_XML1) . '"';
            }
        }

        return !empty($attributes) ? ' ' . implode(' ', $attributes) : '';
    }

    protected function initDefaultAttributes()
    {
        $this->set('performedDatetime', date(DATE_RFC3339, time()));
        $this->set('code', $this->request->isValidHash() ? 0 : 1);
        $this->set('invoiceId', $this->request->get('invoiceId'));
        $this->set('shopId', yandex_kassa_shop_id());
    }
}