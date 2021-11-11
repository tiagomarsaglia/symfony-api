<?php
namespace App\Controller\Shared;

trait ValidationTrait
{
    /**
     *
     * @var array
     */
    private $_data;

    /**
     *
     * @param string $key
     * @param mixed $value
     */
    public function setValue(string $key, $value)
    {
        $this->_data[$key] = $value;
        $this->$key = $value;
    }

    /**
     *
     * @param array $data
     */
    public function setValues($data)
    {
        foreach ($data as $key => $value ) {
            $attributs = array_keys(get_class_vars($this::class));
            if(in_array($key, $attributs)){
                $this->setValue($key, $value);
            }
        }
    }

    /**
     *
     * @param string $key
     * @return mixed
     */
    public function getValue(string $key)
    {
        return $this->_data[$key];
    }

    /**
     *
     * @return array
     */
    public function getValues()
    {
        return $this->_data;
    }

    /**
     *
     * @return array
     */
    public function toArray() {
        return get_object_vars($this);
    }

}
