<?php

namespace Gruppe\Petlocator;

class Owner
{
    private string $phonenumber;

    /**
     * @return string
     */
    public function getPhonenumber(): string
    {
        return $this->phonenumber;
    }



    private string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @param string $name
     * @param string $phonenumber
     */
    public function __construct(string $name, string $phonenumber)
    {
        $this->name = $name;
        $this->phonenumber = $phonenumber;
    }

    public function __toString()
    {
        return $this->getName().' ('.$this->getPhonenumber().')';
    }

}