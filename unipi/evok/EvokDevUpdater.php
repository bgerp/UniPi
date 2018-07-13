<?php
/**
 * Created by PhpStorm.
 * User: POLYGONTeam Ltd
 * Date: 13.7.2018 г.
 * Time: 14:56
 */

class EvokDevUpdater
{
    private $ip = '';
    private $port = '';
    private $user = '';
    private $password = '';

    private $remote_hardware_definiotion_path = '/etc/hw_definitions/';

    public function __construct($ip, $port, $user, $password)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
    }

    public function addHardwareDefinition($file_path)
    {
        $file_name = pathinfo($file_path)['basename'];

        $connection = ssh2_connect($this->ip, $this->port);

        ssh2_auth_password($connection, $this->user, $this->password);

        ssh2_scp_send(
            $connection,
            $file_path,
            $this->remote_hardware_definiotion_path.$file_name,
            0644);

        //$sftp = ssh2_sftp($connection);

        // Create a new folder
        //ssh2_sftp_mkdir($sftp, './test_folder');

        unset($connection);
    }

    public function removeHardwareDefinition($file_name)
    {
        //$file_name = pathinfo($file_path)['basename'];

        $connection = ssh2_connect($this->ip, $this->port);

        ssh2_auth_password($connection, $this->user, $this->password);

        $sftp = ssh2_sftp($connection);

        //ssh2_sftp_unlink($sftp, '/home/username/myfile');

        unset($connection);
    }

    public function restartService()
    {
        $connection = ssh2_connect($this->ip, $this->port);

        ssh2_auth_password($connection, $this->user, $this->password);

        $stop_stream = ssh2_exec($connection, 'systemctl stop evok');

        $start_stream = ssh2_exec($connection, 'sudo python /opt/evok/evok.py');

        unset($connection);
    }
}