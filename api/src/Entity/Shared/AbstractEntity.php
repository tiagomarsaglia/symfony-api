<?php

namespace App\Entity\Shared;

abstract class AbstractEntity
{
    /**
     * @var array
     */
    private $_data;

    /**
     * @param array $data
     */
    public function __construct($data = null)
    {
        if (isset($data)) {
            $this->setValues($data);
        }
    }

    /**
     * @param mixed $value
     */
    public function setValue(string $key, $value)
    {
        $this->_data[$key] = $value;
        $method = 'set'.ucfirst($key);
        if (method_exists($this, $method)) {
            $this->$method($value);
        }
    }

    /**
     * @param array $data
     */
    public function setValues($data)
    {
        foreach ($data as $key => $value) {
            $attributs = array_keys(get_class_vars($this::class));
            if (\in_array($key, $attributs, true)) {
                $this->setValue($key, $value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getValue(string $key)
    {
        return $this->_data[$key];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @param mixed $input
     *
     * @throws \Exception
     *
     * @return \DateTime|null
     */
    private function convertToDate($input)
    {
        if (!empty($input)) {
            return new \DateTime($input);
        }

        return null;
    }
}
