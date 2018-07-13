<?php

/**
 * This class is EVOK configuration .
 */
class EvokDevCfgGenerator
{

    #region Variables

    /**
     * Device registers.
     *
     * @var array
     */
    private $configuration = array();

    #endregion

    #region Construcotr

    /**
     * EvokDevCfgGenerator constructor.
     */
    public function __construct()
    {
    }

    #endregion

    #region Getters and Setters

    /**
     * Returns the configuration array.
     *
     * @return array
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    #endregion

    #region Public Methods

    /**
     * Add device tyep (name).
     *
     * @param $type
     */
    public function addType($type)
    {
        $this->configuration['type'] = $type;
    }

    /**
     * Add mmodbus register block.
     *
     * @param integer $board_index Board index in the bus.
     * @param integer $start_reg Starting register.
     * @param integer $count Quantyty of the registers.
     * @param integer int $frequency Update frequency.
     */
    public function addModbusRegisterBlocks($board_index, $start_reg, $count, $frequency = 60)
    {
        $block = array();

        $block['board_index'] = $board_index;
        $block['start_reg'] = $start_reg;
        $block['count'] = $count;
        $block['frequency'] = $frequency;

        if(!isset($this->configuration['modbus_register_blocks']))
        {
            $this->configuration['modbus_register_blocks'] = array();
        }

        array_push($this->configuration['modbus_register_blocks'], $block);
    }

    /**
     * Add mmodbus register feture.
     *
     * @param string $type Register feature type.
     * @param integer $major_group Major group.
     * @param integer $count Quantyty of the registers.
     * @param integer $start_reg Starting register.
     */
    public function addModbusFeatures($type, $major_group, $count, $start_reg)
    {
        $feture = array();

        $feture['type'] = $type;
        $feture['major_group'] = $major_group;
        $feture['count'] = $count;
        $feture['start_reg'] = $start_reg;

        if(!isset($this->configuration['modbus_features']))
        {
            $this->configuration['modbus_features'] = array();
        }

        array_push($this->configuration['modbus_features'], $feture);
    }

    /**
     * Create configuration from registers data.
     *
     * @param string $type
     * @param integer $board_index Board index in the bus.
     * @param $frequency Update frequency.
     * @param $major_group Major group.
     * @param $regsters Modbus registers.
     * @return array Settings
     */
    public static function createFromRegisters($type, $board_index, $frequency, $major_group, $regsters)
    {
        $configuration = new EvokDevCfgGenerator();

        $configuration->addType($type);

        foreach ($regsters as $key => $register)
        {
            $addresses = $register->getAdresses();
            $addresses_count = count($addresses);
            $configuration->addModbusRegisterBlocks($board_index, $addresses[0], $addresses_count, $frequency);
            $configuration->addModbusFeatures('REGISTER', $major_group, $addresses_count, $addresses[0]);
        }

        return $configuration->getConfiguration();
    }

    #endregion


}