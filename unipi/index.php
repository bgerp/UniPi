<?php

// Neuron API.
require_once('Neuron.php');

// SDM120 API.
require_once('SDM120.php');

// SDM630 API.
require_once('SDM630.php');

// Start

// From DB.
$ip = "176.33.1.25";
//$ip = "10.0.0.111";
$port = 8080;
$device_id = 2;
$uart = "UART_1";

// Master device.
$neuron = new Neuron($ip, $port);
$neuron->update();
$neuron->turnLed(1, 1);
$neuron->turnLed(2, 1);
$neuron->turnLed(3, 1);
$neuron->turnLed(4, 1);

$neuron->turnRelay(1, 1);
$neuron->turnRelay(2, 1);
$neuron->turnRelay(3, 1);
$neuron->turnRelay(4, 1);
$ledon = $neuron->turnOutput(1, 0);

//$neuron->setUartRegister("UART_1", 2, 0, 0);
//$neuron->setUartRegister("UART_1", 2, 1, 0);

try
{
    /** @var Modbus registers IDs. $sdm120_registers_indexes */
    $sdm120_registers_ids = SDM120::getRegistersIDs();

    /** @var Modbus registers values. $sdm120_registers_values */
    $sdm120_registers_values = $neuron->getUartRegisters($uart, $device_id, $sdm120_registers_ids);

    /** @var Parameters values. $sdm120_parameters_values */
    $sdm120_parameters_values = SDM120::getParammeters($sdm120_registers_values);
}
catch(Exception $e)
{
    echo("Problem with 1 phase power meter.");
}

$sdm630_registers_values = [];
try
{
    /** @var Modbus registers IDs. $sdm630_registers_ids */
    $sdm630_registers_ids = SDM630::getRegistersIDs();

    /** @var Modbus registers values. $sdm630_registers_values */
    $sdm630_registers_values = $neuron->getUartRegisters($uart, $device_id, $sdm630_registers_ids);

    /** @var Parameters values. $sdm630_parameters_values */
    $sdm630_parameters_values = SDM630::getParammeters($sdm630_registers_values);
}
catch(Exception $e)
{
    echo("Problem with 3 phase power meter.");
}

$neuron->turnLed(1, 0);
$neuron->turnLed(2, 0);
$neuron->turnLed(3, 0);
$neuron->turnLed(4, 0);
$neuron->turnRelay(1, 0);
$neuron->turnRelay(2, 0);
$neuron->turnRelay(3, 0);
$neuron->turnRelay(4, 0);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SDM120 - 2</title>
    </head>
    <body>
        <br>
        <font size="5">1 phase</font>
        <br>
        <table>
            <col width="170">
            <col width="160">
            <col width="60">
            <tr>
                <th>Name</th>
                <th>Value</th>
                <th>Unit</th>
            </tr>
            <tr>
                <td>Voltage</td>
                <td><?php echo number_format($sdm120_parameters_values['Voltage'], 3); ?></td>
                <td>[V]<td>
            </tr>
            <tr>
                <td>Current</td>
                <td><?php echo number_format($sdm120_parameters_values['Current'], 3); ?></td>
                <td>[A]</td>
            </tr>
            <tr>
                <td>Active Power</td>
                <td><?php echo number_format($sdm120_parameters_values['ActivePower'], 3); ?></td>
                <td>[W]</td>
            </tr>
            <tr>
                <td>Apparent Power</td>
                <td><?php echo number_format($sdm120_parameters_values['ApparentPower'], 3); ?></td>
                <td>[W]</td>
            </tr>
            <tr>
                <td>Reactive Power</td>
                <td><?php echo number_format($sdm120_parameters_values['ReactivePower'], 3); ?></td>
                <td>[W]</td>
            </tr>
            <tr>
                <td>Power Factor</td>
                <td><?php echo number_format($sdm120_parameters_values['PowerFactor'], 3); ?></td>
                <td>[&#176]</td>
            </tr>
            <tr>
                <td>Frequency</td>
                <td><?php echo number_format($sdm120_parameters_values['Frequency'], 3); ?></td>
                <td>[Hz]</td>
            </tr>
            <tr>
                <td>Import Active Energy</td>
                <td><?php echo number_format($sdm120_parameters_values['ImportActiveEnergy'], 3); ?></td>
                <td>[W]</td>
            </tr>
            <tr>
                <td>Export Active Energy</td>
                <td><?php echo number_format($sdm120_parameters_values['ExportActiveEnergy'], 3); ?></td>
                <td>[W]</td>
            </tr>
            <tr>
                <td>Import Reactive Energy</td>
                <td><?php echo number_format($sdm120_parameters_values['ImportReactiveEnergy'], 3); ?></td>
                <td>[W]</td>
            </tr>
            <tr>
                <td>Export Reactive Energy</td>
                <td><?php echo number_format($sdm120_parameters_values['ExportReactiveEnergy'], 3); ?></td>
                <td>[W]</td>
            </tr>
        </table>
        <br>
        <br>
        <p style="font-size:110%;">3 phase</p>
        <br>
        <table>
            <col width="150">
            <col width="60">
            <col width="60">
            <col width="60">
            <col width="60">
            <tr>
                <th>Name</th>
                <th>L1</th>
                <th>L2</th>
                <th>L3</th>
                <th>Unit</th>
            </tr>
            <tr>
                <td>Voltage</td>
                <td><?php echo number_format($sdm630_parameters_values['Phase1LineToNeutralVolts'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase2LineToNeutralVolts'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase3LineToNeutralVolts'], 3); ?></td>
                <td>[V]<td>
            </tr>
            <tr>
                <td>Current</td>
                <td><?php echo number_format($sdm630_parameters_values['Phase1Current'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase2Current'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase3Current'], 3); ?></td>
                <td>[A]<td>
            </tr>
            <tr>
                <td>Power</td>
                <td><?php echo number_format($sdm630_parameters_values['Phase1Power'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase2Power'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase3Power'], 3); ?></td>
                <td>[W]<td>
            </tr>
            <tr>
                <td>Volt amps.</td>
                <td><?php echo number_format($sdm630_parameters_values['Phase1VA'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase2VA'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase3VA'], 3); ?></td>
                <td>[VA]<td>
            </tr>
            <tr>
                <td>Volt amps reactive</td>
                <td><?php echo number_format($sdm630_parameters_values['Phase1VAReactive'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase2VAReactive'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase3VAReactive'], 3); ?></td>
                <td>[VAr]<td>
            </tr>
            <tr>
                <td>Power factor</td>
                <td><?php echo number_format($sdm630_parameters_values['Phase1PowerFactor'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase2PowerFactor'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase3PowerFactor'], 3); ?></td>
                <td>[&#176]<td>
            </tr>
        </table>
        <br>
        <input type="button" value="Refresh Page" onClick="window.location.reload()">
    </body>
</html> 
