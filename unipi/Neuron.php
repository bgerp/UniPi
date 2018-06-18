<?php

/**
 * This class is dedicated to transfer information from and to NeuronS series.
 *
 * @see https://evok.api-docs.io/1.0/rest
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
     * @see https://evok.api-docs.io/1.0/rest   
     */ 
    public function update()
    {
        // Create CURL resource.
        $ch = curl_init();

        // Set URL.
        curl_setopt($ch, CURLOPT_URL, 'http://'.$this->ip.':'.$this->port.'/rest/all');

        // Return the transfer as a string.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $response Contains the output string.
        $response = curl_exec($ch);

        // Get error.
        $err = curl_error($ch);

        // Close curl resource to free up system resources.
        curl_close($ch);  

        if ($err)
        {
          echo "cURL Error #:" . $err;
        }        
        
        // Convert to JSON.
        $this->json_data = json_decode($response, true);
    }

    /**
     * Get register data of the device.
     *
     * @param integer $dev_id Modbus ID address of the device.
     * @param integer $register Register address of the device.
     * @return integer register value.
     */
    public function getUartRegister($uart, $dev_id, $register)
    {
        $value = 0;
        foreach ($this->json_data as $field)
        {
            if(isset($field['circuit']))
            {
                $circuit = $field['circuit'];
                if($circuit == $this->generateUartCircuit($uart, $dev_id, $register))        
                {
                    if(isset($field['value']))
                    {
                        $value = $field['value'];
                        break;
                    }
                }
            }
        }

        return $value;
    }        

    /**
     * Get registers data of the device.
     *
     * @param string $uart Modbus ID address of the device.
     * @param integer $dev_id Modbus ID address of the device.
     * @param integer $register Register address of the device.
     * @return integer register value.
     */
    public function getUartRegisters($uart, $dev_id, $registers)
    {
        $registers_data = array();
        
        foreach ($registers as $index)
        {
            $registers_data[$index] = $this->getUartRegister($uart, $dev_id, $index);            
        }
        
        return $registers_data;
    }

    
    public function setUartRegister($uart, $dev_id, $register, $value)
    {
        // Generate circuit name.
        $circuit = $this->generateUartCircuit($uart, $dev_id, $register);
        
        // Init CURL object.
        $ch = curl_init();

        curl_setopt_array($ch, array(
          CURLOPT_URL => "http://".$this->ip.":".$this->port."/rest/register/".$circuit,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "value=".$value,
        ));

        // 
        $response = curl_exec($ch);
        $err = curl_error($ch);

        // Clear CURL object.
        curl_close($ch);

        if ($err) {
          echo "cURL Error #:" . $err;
        }
        
        // Convert to JSON.
        return json_decode($response, true); 
    }


    
    /**
     * Generate key data for $json_string.
     * This method is directly related to the EVOK REST API.
     *
     * @param integer Register index.
     * @return string Key of register data.
     * @see https://evok.api-docs.io/1.0/rest/get-watchdog-state-watchdog-alias
     */ 
    private function generateUartCircuit($uart, $dev_id, $register_index)
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
        
        return $uart.'_'.$dev_id.'_'.$value;
    }

    public function turnLedOn()
    {
        // Create CURL resource.
        $ch = curl_init();

        // Set URL.
        curl_setopt($ch, CURLOPT_URL, 'http://'.$this->ip.':'.$this->port.'/rest/led/1_01');

        // Return the transfer as a string.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Type POST.
        curl_setopt($ch, CURLOPT_POST,           1 );

        // Fields
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "value=1" ); 

        // $content Contains the output string.
        $content = curl_exec($ch);

        // Close curl resource to free up system resources.
        curl_close($ch);      
    }
    
    public function turnLedOff()
    {
        // Create CURL resource.
        $ch = curl_init();

        // Set URL.
        curl_setopt($ch, CURLOPT_URL, 'http://'.$this->ip.':'.$this->port.'/rest/led/1_01');

        // Return the transfer as a string.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Type POST.
        curl_setopt($ch, CURLOPT_POST,           1 );

        // Fields
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "value=0" ); 

        // $content Contains the output string.
        $content = curl_exec($ch);

        // Close curl resource to free up system resources.
        curl_close($ch);      
    }
    
}
