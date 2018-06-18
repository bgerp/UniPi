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
     * Content from slave device.
     *
     * @var content
     */    
    private $content = array();
    
    /**
     * Class constructor.
     *
     * @param dictionary $content Content from slave device.
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
     * @return dictionary
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
            SDM630::phase1LineToNeutralVolts1,
            SDM630::phase1LineToNeutralVolts2,
            SDM630::phase2LineToNeutralVolts1,
            SDM630::phase2LineToNeutralVolts2,
            SDM630::phase3LineToNeutralVolts1,
            SDM630::phase3LineToNeutralVolts2,
            SDM630::phase1Current1,
            SDM630::phase1Current2,
            SDM630::phase2Current1,
            SDM630::phase2Current2,
            SDM630::phase3Current1,
            SDM630::phase3Current2,
            SDM630::phase1Power1,
            SDM630::phase1Power2,
            SDM630::phase2Power1,
            SDM630::phase2Power2,
            SDM630::phase3Power1,
            SDM630::phase3Power2,
            SDM630::phase1VoltAmps1,
            SDM630::phase1VoltAmps2,
            SDM630::phase2VoltAmps1,
            SDM630::phase2VoltAmps2,
            SDM630::phase3VoltAmps1,
            SDM630::phase3VoltAmps2,
            SDM630::phase1VoltAmpsReactive1,
            SDM630::phase1VoltAmpsReactive2,
            SDM630::phase2VoltAmpsReactive1,
            SDM630::phase2VoltAmpsReactive2,
            SDM630::phase3VoltAmpsReactive1,
            SDM630::phase3VoltAmpsReactive2,
            SDM630::phase1PowerFactor1,
            SDM630::phase1PowerFactor2,
            SDM630::phase2PowerFactor1,
            SDM630::phase2PowerFactor2,
            SDM630::phase3PowerFactor1,
            SDM630::phase3PowerFactor2
            );
        
        return $registers_ids;
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
        $reg1 = $this->content[SDM630::phase1LineToNeutralVolts1];
        $reg2 = $this->content[SDM630::phase1LineToNeutralVolts2];
        
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
        $reg1 = $this->content[SDM630::phase2LineToNeutralVolts1];
        $reg2 = $this->content[SDM630::phase2LineToNeutralVolts2];
        
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
        $reg1 = $this->content[SDM630::phase3LineToNeutralVolts1];
        $reg2 = $this->content[SDM630::phase3LineToNeutralVolts2];
        
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
        $reg1 = $this->content[SDM630::phase1Current1];
        $reg2 = $this->content[SDM630::phase1Current2];
        
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
        $reg1 = $this->content[SDM630::phase2Current1];
        $reg2 = $this->content[SDM630::phase2Current2];
        
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
        $reg1 = $this->content[SDM630::phase3Current1];
        $reg2 = $this->content[SDM630::phase3Current2];
        
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
        $reg1 = $this->content[SDM630::phase1Power1];
        $reg2 = $this->content[SDM630::phase1Power2];
        
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
        $reg1 = $this->content[SDM630::phase2Power1];
        $reg2 = $this->content[SDM630::phase2Power2];
        
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
        $reg1 = $this->content[SDM630::phase3Power1];
        $reg2 = $this->content[SDM630::phase3Power2];
        
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
        $reg1 = $this->content[SDM630::phase1VoltAmps1];
        $reg2 = $this->content[SDM630::phase1VoltAmps2];
        
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
        $reg1 = $this->content[SDM630::phase2VoltAmps1];
        $reg2 = $this->content[SDM630::phase2VoltAmps2];
        
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
        $reg1 = $this->content[SDM630::phase3VoltAmps1];
        $reg2 = $this->content[SDM630::phase3VoltAmps2];
        
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
        $reg1 = $this->content[SDM630::phase1VoltAmpsReactive1];
        $reg2 = $this->content[SDM630::phase1VoltAmpsReactive2];
        
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
        $reg1 = $this->content[SDM630::phase2VoltAmpsReactive1];
        $reg2 = $this->content[SDM630::phase2VoltAmpsReactive2];
        
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
        $reg1 = $this->content[SDM630::phase3VoltAmpsReactive1];
        $reg2 = $this->content[SDM630::phase3VoltAmpsReactive2];
        
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
        $reg1 = $this->content[SDM630::phase1PowerFactor1];
        $reg2 = $this->content[SDM630::phase1PowerFactor2];
        
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
        $reg1 = $this->content[SDM630::phase2PowerFactor1];
        $reg2 = $this->content[SDM630::phase2PowerFactor2];
        
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
        $reg1 = $this->content[SDM630::phase3PowerFactor1];
        $reg2 = $this->content[SDM630::phase3PowerFactor2];
        
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
