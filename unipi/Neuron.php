<?php

/**
 * This class is dedicated to transfer information from and to NeuronS series.
 *
 * @see https://evok.api-docs.io/1.0/rest/get-watchdog-state-watchdog-alias
 */
class Neuron
{

    /**
     * JSON data container.
     *
     * @var structure
     */
    private $json_data = '';

    /**
     * IP address of the device.
     *
     * @var string
     */    
    private $ip = '127.0.0.1';

    /**
     * Port of the device.
     *
     * @var integer
     */ 
    private $port = 80;

    /**
     * Class constructor.
     *
     * @param string $ip IP address of the device.
     * @param integer $port Port of the device.
     */
    public function __construct($ip, $port)
    {
        $this->setIp($ip);
        $this->setPort($port);
    }

    /**
     * Returns IP address of the device.
     *
     * @return string IP address of the device.
     */
    public function getIp()
    {
        return($this->ip);
    }

    /**
     * Set IP address of the device.
     *
     * @param string $ip IP address of the device.
     * @return void
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Returns port of the device.
     *
     * @return integer Port of the device.
     */
    public function getPort()
    {
        return($this->port);
    }

    /**
     * Set port of the device.
     *
     * @param integer $port Port of the device.
     * @return void
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * Returns raw JSON data of the device.
     *
     * @return JSON data of the device.
     */
    public function getRawJSON()
    {
        return($this->json_data);
    }

    /**
     * Make request to the device to update the data.
     * This method is directly related to the EVOK REST API.
     *
     * @see http://www.eastrongroup.com/data/uploads/Eastron_SDM120-Modbus_protocol_V2_3_(1).pdf     
     */ 
    public function update()
    {
        // Get data from the device.
        $content = file_get_contents('http://'.$this->ip.':'.$this->port.'/rest/all');
        // Convert to JSON.
        $this->json_data = json_decode($content, true);
    }

    /**
     * Get register data of the device.
     *
     * @param integer $dev_id Modbus ID address of the device.
     * @param integer $register Register address of the device.
     * @return integer register value.
     */
    public function getRegister($dev_id, $register)
    {
        $value = 0;

        foreach ($this->json_data as $field)
        {
            if(isset($field['glob_dev_id']))
            {
                $glob_dev_id = $field['glob_dev_id'];
                if(isset($field['circuit']))
                {
                    $circuit = $field['circuit'];
                
                    if($glob_dev_id == $dev_id && $circuit == $this->GenrateRegisterID($register))        
                    {
                        $value = $field['value'];
                    }
                }
            }
        }
        
        return $value;
    }        

    /**
     * Generate key data for $json_string.
     * This method is directly related to the EVOK REST API.
     *
     * @param integer Register index.
     * @return string Key of register data.
     * @see https://evok.api-docs.io/1.0/rest/get-watchdog-state-watchdog-alias
     */ 
    private function genrateRegisterID($register_index)
    {
        $value = 0;
        
        if($register_index < 10)
        {
            $value = '0'.$register_index;
        }
        else
        {
            $value = $register_index;
        }
        
        return 'UART_1_2_'.$value;
    }

}
