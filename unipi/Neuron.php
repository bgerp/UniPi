<?php

/**
 * This class is dedicated to transfer information from and to NeuronS series.
 *
 * @see https://evok.api-docs.io/1.0/rest
 */
class Neuron
{

    #region Variables

    /**
     * JSON data container.
     *
     * @var object
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

    #endregion

    #region Constructor

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

    #endregion

    #region Getters and Setters

    /**
     * Returns JSON response of the device.
     *
     * @return object Response of the device.
     */
    public function getJsonData()
    {
        return $this->json_data;
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
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * Returns port of the device.
     *
     * @return string Port of the device.
     */
    public function getPort()
    {
        return($this->port);
    }

    /**
     * Set port of the device.
     *
     * @param integer $port Port of the device.
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    #endregion

    #region Private Methods

    /**
     * Generate key data for $json_string.
     * This method is directly related to the EVOK REST API.
     *
     * @param string $uart UART interface.
     * @param integer $dev_id Modbus ID address of the device.
     * @param integer $register Modbus Registers address of the device.
     * @return string Circuit
     * @see https://evok.api-docs.io/1.0/json/get-uart-state-json
     */
    private function generateUartCircuit($uart, $dev_id, $register)
    {
        $value = 0;

        if($register < 10)
        {
            $value = '0'.$register;
        }
        else
        {
            $value = $register;
        }

        return $uart.'_'.$dev_id.'_'.$value;
    }

    /**
     * Get device parameter.
     *
     * @param string $parameter Parameter name.
     * @return null, mixed
     */
    private function getDeviceParameter($parameter)
    {
        $value = null;

        foreach ($this->json_data as $field)
        {
            if(isset($field['circuit']) &&
                isset($field['dev'])&&
                isset($field[$parameter]))
            {
                if(($field['circuit'] == '1') &&
                    ($field['dev'] == 'neuron'))
                {
                    $value = $field[$parameter];
                    break;
                }
            }
        }

        return $value;
    }

    #endregion

    #region Public Methods

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

        //print_r($response);
        
        // Convert to JSON.
        $this->json_data = json_decode($response, true);
    }

    /**
     * Get last connection time. [seconds]
     *
     * @return null, integer
     */
    public function getLastComTime()
    {
        return $this->getDeviceParameter('last_comm');
    }

    /**
     * Get device model.
     *
     * @return null, string
     */
    public function getDeviceModel()
    {
        return $this->getDeviceParameter('model');
    }

    /**
     * Get device serial number.
     *
     * @return null, integer
     */
    public function getDeviceSerialNumber()
    {
        return $this->getDeviceParameter('sn');
    }

    /**
     * Get device version.
     *
     * @return null, string
     */
    public function getDeviceVersion()
    {
        return $this->getDeviceParameter('ver2');
    }

    /**
     * Get register data of the device.
     *
     * @param integer $dev_id Modbus ID address of the device.
     * @param integer $register Register address of the device.
     * @return string Register value.
     */
    public function getUartRegister($uart, $dev_id, $register)
    {
        /** @var integer UART register value. $value */
        $value = 0;

        foreach ($this->json_data as $field)
        {
            if(isset($field['circuit']))
            {
                if($field['circuit'] == $this->generateUartCircuit($uart, $dev_id, $register))
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
     * Get registers data of the UART device.
     *
     * @param string $uart UART interface.
     * @param integer $dev_id Modbus ID address of the device.
     * @param integer $registers Modbus Registers address of the device.
     * @return array Registers values.
     */
    public function getUartRegisters($uart, $dev_id, $registers)
    {
        /** @var array Registers values. $values */
        $values = array();

        if (empty($registers))
        {
            throw new InvalidArgumentException("Invalid registers.");
        }

        foreach ($registers as $register)
        {
            $values[$register] = $this->getUartRegister($uart, $dev_id, $register);
        }

        return $values;
    }

    /**
     * Get register data of the UART device.
     *
     * @param string $uart UART interface.
     * @param integer $dev_id Modbus ID address of the device.
     * @param integer $register Modbus register address of the device.
     * @param integer $value Modbus register value to be set.
     * @return mixed JSON response data.
     */
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
     * Turn the LED state.
     * This method is directly related to the EVOK REST API.
     *
     * @param integer $index [1-4].
     * @param integer $state [0-1].
     * @return string Returns the state of the LED.
     * @see https://evok.api-docs.io/1.0/rest/change-uled-state
     */
    public function turnLed($index, $state)
    {
        // Create CURL resource.
        $ch = curl_init();

        // Set URL.
        curl_setopt($ch, CURLOPT_URL, 'http://'.$this->ip.':'.$this->port.'/rest/led/1_0'.$index);

        // Return the transfer as a string.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Type POST.
        curl_setopt($ch, CURLOPT_POST,           1 );

        // Fields
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "value=".$state ); 

        // $content Contains the output string.
        $content = curl_exec($ch);

        // Close curl resource to free up system resources.
        curl_close($ch);

        // Returns the state of the LED.
        return $content;
    }
        
    /**
     * Turn the Relay state.
     * This method is directly related to the EVOK REST API.
     *
     * @param integer $index [1-4].
     * @param integer $state [0-1].
     * @return string Returns the state of the Relay.
     * @see https://evok.api-docs.io/1.0/rest/change-relay-state
     */
    public function turnRelay($index, $state)
    {
        // Create CURL resource.
        $ch = curl_init();

        // Set URL.
        curl_setopt($ch, CURLOPT_URL, 'http://'.$this->ip.':'.$this->port.'/rest/relay/1_0'.$index);

        // Return the transfer as a string.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Type POST.
        curl_setopt($ch, CURLOPT_POST,           1 );

        // Fields
        curl_setopt($ch, CURLOPT_POSTFIELDS,     "value=".$state ); 

        // $content Contains the output string.
        $content = curl_exec($ch);

        // Close curl resource to free up system resources.
        curl_close($ch);

        // Returns the state of the LED.
        return $content;
    }
             
    /**
     * Turn the analog output state.
     * This method is directly related to the EVOK REST API.
     *
     * @param integer $index [1].
     * @param integer $state [0-1].
     * @return string Returns the state of the Relay.
     * @see https://evok.api-docs.io/1.0/rest/change-output-state-relay-alias
     */
    public function turnOutput($index, $state)
    {
        // Create CURL resource.
        $ch = curl_init();

        // Set URL.
        curl_setopt($ch, CURLOPT_URL, 'http://' . $this->ip . ':' . $this->port . '/rest/output/1_0' . $index);

        // Return the transfer as a string.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Type POST.
        curl_setopt($ch, CURLOPT_POST, 1);

        // Fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, "value=" . $state);

        // $content Contains the output string.
        $content = curl_exec($ch);

        // Close curl resource to free up system resources.
        curl_close($ch);

        // Returns the state of the LED.
        return $content;
    }

    #endregion

}

