<?php
abstract class BaseShipping {
    public $from;
    public $to;
    public $weight;
    protected $_maxWeight;

    abstract public function calculate();
    abstract public function getMaxWeight();

    public function setRoute($from,$to){
        $this->from = $from;
        $this->to = $to;
    }
    public function setWeight($value){
        $this->weight = $value;
    }
    public function setMaxWeight($value){
        $this->_maxWeight = $value;
    }

    public function getPackages($leftWeight = false)
    {
        $packages = array();
        $leftWeight = $leftWeight ? $leftWeight : $this->weight;
        $maxWeight = $this->getMaxWeight();

        if($leftWeight > $maxWeight){
            $leftWeight = $leftWeight - $maxWeight;
            $packages[] = $maxWeight;
            foreach ($this->getPackages($leftWeight) as $package)
                $packages[] = $package;
        }else{
            $packages[] = $leftWeight;
        }

        return $packages;
    }
}