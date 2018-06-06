<?php

/**
 * This class is dedicated to interpret information between NeuronS series and SDM120 energy meter.
 *
 * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf
 */
class SDM630
{
    
    const phase1LineToNeutralVolts1 = 0;
    const phase1LineToNeutralVolts2 = 1;
    const phase2LineToNeutralVolts1 = 3;
    const phase2LineToNeutralVolts2 = 2;
    const phase3LineToNeutralVolts1 = 4;
    const phase3LineToNeutralVolts2 = 5;
    const phase1Current1 = 6;
    const phase1Current2 = 7;
    const phase2Current1 = 8;
    const phase2Current2 = 9;
    const phase3Current1 = 10;
    const phase3Current2 = 11;
    const phase1Power1 = 12;
    const phase1Power2 = 13;
    const phase2Power1 = 14;
    const phase2Power2 = 15;
    const phase3Power1 = 16;
    const phase3Power2 = 17;
    const phase1VoltAmps1 = 18;
    const phase1VoltAmps2 = 19;
    const phase2VoltAmps1 = 20;
    const phase2VoltAmps2 = 21;
    const phase3VoltAmps1 = 22;
    const phase3VoltAmps2 = 23;
    const phase1VoltAmpsReactive1 = 24;
    const phase1VoltAmpsReactive2 = 25;
    const phase2VoltAmpsReactive1 = 26;
    const phase2VoltAmpsReactive2 = 27;
    const phase3VoltAmpsReactive1 = 28;
    const phase3VoltAmpsReactive2 = 29;
    const phase1PowerFactor1 = 30;
    const phase1PowerFactor2 = 31;
    const phase2PowerFactor1 = 32;
    const phase2PowerFactor2 = 33;
    const phase3PowerFactor1 = 34;
    const phase3PowerFactor2 = 35;

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
     * Gets Phase 1 line to neutral volts.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float Voltage.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */    
    public function getPhase1Voltage()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase1LineToNeutralVolts1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase1LineToNeutralVolts2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets Phase 2 line to neutral volts.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float Voltage.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */    
    public function getPhase2Voltage()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase2LineToNeutralVolts1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase2LineToNeutralVolts2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets Phase 3 line to neutral volts.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float Voltage.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */    
    public function getPhase3Voltage()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase3LineToNeutralVolts1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase3LineToNeutralVolts2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }
    
    /**
     * Gets Phase 1 current.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float Current.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */ 
    public function getPhase1Current()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase1Current1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase1Current2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets Phase 2 current.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float Current.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */ 
    public function getPhase2Current()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase2Current1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase2Current2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }
    
    /**
     * Gets Phase 3 current.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float Current.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */ 
    public function getPhase3Current()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase3Current1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase3Current2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets Phase 1 power
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float Power.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    public function getPhase1Power()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase1Power1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase1Power2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets Phase 2 power
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float Power.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    public function getPhase2Power()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase2Power1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase2Power2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets Phase 3 power
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float Power.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    public function getPhase3Power()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase3Power1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase3Power2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets Phase 1 VA.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float VA.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    public function getPhase1VA()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase1VoltAmps1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase1VoltAmps2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets Phase 2 VA.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float VA.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    public function getPhase2VA()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase2VoltAmps1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase2VoltAmps2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;

    }

    /**
     * Gets Phase 3 VA.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float VA.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    public function getPhase3VA()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase3VoltAmps1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase3VoltAmps2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets Phase 1 volt amps reactive.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float VA reactive.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    public function getPhase1VAReactive()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase1VoltAmpsReactive1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase1VoltAmpsReactive2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets Phase 2 volt amps reactive.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float VA reactive.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    public function getPhase2VAReactive()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase2VoltAmpsReactive1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase2VoltAmpsReactive2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }
    
    /**
     * Gets Phase 3 volt amps reactive.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float VA reactive.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    public function getPhase3VAReactive()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase3VoltAmpsReactive1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase3VoltAmpsReactive2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets Phase 1 power factor.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float Phase 1 power factor.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    public function getPhase1PowerFactor()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase1PowerFactor1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase1PowerFactor2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }    

    /**
     * Gets Phase 2 power factor.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float Phase 2 power factor.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    public function getPhase2PowerFactor()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase2PowerFactor1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase2PowerFactor2);
        
        $filed = $this->registersToFlaot($reg1, $reg2);
        
        return $filed;
    }

    /**
     * Gets Phase 3 power factor.
     * This method is directly related to the memory map of the SDM630.
     *
     * @return float Phase 3 power factor.
     * @see https://bg-etech.de/download/manual/SDM630Register1-5.pdf
     */
    public function getPhase3PowerFactor()
    {
        $reg1 = $this->master->getRegister($this->dev_id, SDM630::phase3PowerFactor1);
        $reg2 = $this->master->getRegister($this->dev_id, SDM630::phase3PowerFactor2);
        
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
