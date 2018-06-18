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
     * Content dictionary.
     *
     * @var Neuron
     */    
    private $content = array();
    
    /**
     * Class constructor.
     *
     * @param Neuron $master Master device.
     * @param string $uart UART interface.
     * @param integer $dev_id modbus device id.
     */
    public function __construct($content)
    {
        $this->setContetnt($content);
    }
    
    /**
     * Get RAW content.
     *
     * @return RAW content.
     */
    public function getContetnt()
    {
        return($this->content);
    }

    /**
     * Set RAW content.
     *
     * @param RAW content.
     * @return void
     */
    public function setContetnt($content)
    {
        $this->content = $content;
    }

    /**
     * Get registers IDs.
     *
     * @return Registers IDs.
     */
    public static function getRegistersIDs()
    {
        // Registers
        $registers_ids = array(
            SDM120::volts1, 
            SDM120::volts2, 
            SDM120::current1, 
            SDM120::current2, 
            SDM120::activePower1, 
            SDM120::activePower2, 
            SDM120::apparentPower1, 
            SDM120::apparentPower2, 
            SDM120::reactivePower1, 
            SDM120::reactivePower2, 
            SDM120::powerFactor1, 
            SDM120::powerFactor2, 
            SDM120::frequency1, 
            SDM120::frequency2, 
            SDM120::importActiveEnergy1, 
            SDM120::importActiveEnergy2, 
            SDM120::exportActiveEnergy1, 
            SDM120::exportActiveEnergy2, 
            SDM120::importReactiveEnergy1, 
            SDM120::importReactiveEnergy2, 
            SDM120::exportReactiveEnergy1, 
            SDM120::exportReactiveEnergy2
            );
        
        return $registers_ids;
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
        $reg1 = $this->content[SDM120::volts1];
        $reg2 = $this->content[SDM120::volts2];
        
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
        $reg1 = $this->content[SDM120::current1];
        $reg2 = $this->content[SDM120::current2];
        
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
        $reg1 = $this->content[SDM120::activePower1];
        $reg2 = $this->content[SDM120::activePower2];
        
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
        $reg1 = $this->content[SDM120::apparentPower1];
        $reg2 = $this->content[SDM120::apparentPower2];
        
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
        $reg1 = $this->content[SDM120::reactivePower1];
        $reg2 = $this->content[SDM120::reactivePower2];
        
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
        $reg1 = $this->content[SDM120::powerFactor1];
        $reg2 = $this->content[SDM120::powerFactor2];
        
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
        $reg1 = $this->content[SDM120::frequency1];
        $reg2 = $this->content[SDM120::frequency2];
        
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
        $reg1 = $this->content[SDM120::importActiveEnergy1];
        $reg2 = $this->content[SDM120::importActiveEnergy2];
        
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
        $reg1 = $this->content[SDM120::exportActiveEnergy1];
        $reg2 = $this->content[SDM120::exportActiveEnergy2];
        
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
        $reg1 = $this->content[SDM120::importReactiveEnergy1];
        $reg2 = $this->content[SDM120::importReactiveEnergy2];
        
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
        $reg1 = $this->content[SDM120::exportReactiveEnergy1];
        $reg2 = $this->content[SDM120::exportReactiveEnergy2];
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
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
