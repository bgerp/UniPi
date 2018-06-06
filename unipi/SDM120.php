<?php

/**
 * This class is dedicated to interpret information between NeuronS series and SDM120 energy meter.
 *
 * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf
 */
class SDM120
{
    
    const volts1 = 0;
    const volts2 = 1;
    const current1 = 6;
    const current2 = 7;
    const activePower1 = 12;
    const activePower2 = 13;
    const apparentPower1 = 18;
    const apparentPower2 = 19;
    const reactivePower1 = 24;
    const reactivePower2 = 25;
    const powerFactor1 = 30;
    const powerFactor2 = 31;
    const frequency1 = 70;
    const frequency2 = 71;
    const importActiveEnergy1 = 72;
    const importActiveEnergy2 = 73;
    const exportActiveEnergy1 = 74;
    const exportActiveEnergy2 = 75;
    const importReactiveEnergy1 = 76;
    const importReactiveEnergy2 = 77;
    const exportReactiveEnergy1 = 78;
    const exportReactiveEnergy2 = 79;
    
    /**
     * Master device.
     *
     * @var Neuron
     */    
    private $master = "";

    /**
     * MODBUS-RTU device ID.
     *
     * @var integer.
     */ 
    private $dev_id = 1;

    /**
     * Class constructor.
     *
     * @param Neuron $master Master device.
     * @param integer $dev_id modbus device id.
     */
    public function __construct($master, $dev_id)
    {
        $this->SetMaster($master);
        $this->SetDeviceID($dev_id);
    }

    /**
     * Returns master device.
     *
     * @return Neuron Master device.
     */
    public function getMaster()
    {
        return($this->master);
    }

    /**
     * Set master device.
     *
     * @param Neuron $master Master device.
     * @return void
     */
    public function setMaster($master)
    {
        $this->master = $master;
    }

    /**
     * Returns ID of the device.
     *
     * @return integer ID of the device.
     */
    public function getDeviceID()
    {
        return($this->dev_id);
    }

    /**
     * Set ID of the device.
     *
     * @param integer $dev_id ID of the device.
     * @return void
     */
    public function setDeviceID($dev_id)
    {
        $this->dev_id = $dev_id;
    }

    /**
     * Gets voltage value of the device.
     * This method is directly related to the memory map of the SDM120.
     *
     * @return float Voltage.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */    
    public function getVoltage()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM120::volts1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM120::volts2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets current value of the device.
     * This method is directly related to the memory map of the SDM120.
     *
     * @return float Current.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */ 
    public function getCurrent()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM120::current1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM120::current2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets active power value of the device.
     * This method is directly related to the memory map of the SDM120.
     *
     * @return float Active Power.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */
    public function getActivePower()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM120::activePower1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM120::activePower2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets apparent power value of the device.
     * This method is directly related to the memory map of the SDM120.
     *
     * @return float Apparent Power.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */
    public function getApparentPower()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM120::apparentPower1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM120::apparentPower2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets reactive power value of the device.
     * This method is directly related to the memory map of the SDM120.
     *
     * @return float Reactive Power.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */
    public function getReactivePower()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM120::reactivePower1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM120::reactivePower2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets power factor value of the device.
     * This method is directly related to the memory map of the SDM120.
     *
     * @return float Power Factor.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */
    public function getPowerFactor()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM120::powerFactor1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM120::powerFactor2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets frequency value of the device.
     * This method is directly related to the memory map of the SDM120.
     *
     * @return float Frequency.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */
    public function getFrequency()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM120::frequency1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM120::frequency2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets import active energy value of the device.
     * This method is directly related to the memory map of the SDM120.
     *
     * @return float Import Active Energy.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */
    public function getImportActiveEnergy()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM120::importActiveEnergy1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM120::importActiveEnergy2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets export active energy value of the device.
     * This method is directly related to the memory map of the SDM120.
     *
     * @return float Export Active Energy.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */
    public function getExportActiveEnergy()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM120::exportActiveEnergy1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM120::exportActiveEnergy2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets import reactive energy value of the device.
     * This method is directly related to the memory map of the SDM120.
     *
     * @return float Import Reactive Energy.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */
    public function getImportReactiveEnergy()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM120::importReactiveEnergy1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM120::importReactiveEnergy2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }
    
    /**
     * Gets export reactive energy value of the device.
     * This method is directly related to the memory map of the SDM120.
     *
     * @return float Export Reactive Energy.
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */
    public function getExportReactiveEnergy()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM120::exportReactiveEnergy1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM120::exportReactiveEnergy2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }
    
    /**
     * Make request to the device to update the data.
     * This method is directly related to the EVOK REST API.
     *
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */ 
    public function update()
    {
        $this->master->Update();
    }

    /**
     * Convert two registers to float.
     *
     * @param integer $reg_value1 Register 1.
     * @param integer $reg_value2 Register 2.
     * @return float Value from two registers.
     * @see https://evok.api-docs.io/1.0/rest/get-watchdog-state-watchdog-alias
     */     
    private function registersToFlaot($reg_value1, $reg_value2)
    {
        // Pack the data.
        $packed_data = pack("nn", $reg_value1, $reg_value2);

        // Unpack data.
        $unpacked_data = unpack("G", $packed_data);

        // Return value.       
        return $unpacked_data[1];
    }

}
